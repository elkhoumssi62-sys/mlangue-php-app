<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — points d'entrée API.
 *
 * POST /api/newsletter  { email, profile, level }
 * POST /api/attempt     { resourceSlug, exerciseId, exerciseType, correct, total }
 * GET  /api/fiches/{slug}?format=doc|pdf
 */

function api_newsletter(): void
{
    $in      = json_input();
    $email   = (string) ($in['email'] ?? post_value('email'));
    $profile = (string) ($in['profile'] ?? post_value('profile', 'apprenant'));
    $level   = (string) ($in['level'] ?? post_value('level', 'B1'));

    // Requête envoyée par le formulaire HTML classique (sans JS) : protection CSRF.
    $isForm = isset($_POST['csrf']);
    if ($isForm && !csrf_valid()) {
        http_response_code(400);
        render_raw('<div class="card p-8 text-center"><h1 class="section-title">Jeton de sécurité invalide</h1></div>');
        return;
    }

    $result = Repository::subscribe(trim($email), $profile, $level);

    if ($isForm) {
        $message = $result['ok']
            ? ($result['already']
                ? 'Cette adresse est déjà abonnée à la lettre du dimanche.'
                : 'Merci ! Votre première lettre arrive dimanche.')
            : (string) $result['error'];
        render_raw(
            '<div class="card p-8 text-center">'
            . '<h1 class="section-title">' . e($message) . '</h1>'
            . '<p class="mt-4"><a class="btn-primary" href="' . e(url('/')) . '">Retour à l\'accueil</a></p>'
            . '</div>'
        );
        return;
    }

    json_response($result, $result['ok'] ? 200 : 400);
}

function api_attempt(): void
{
    $in = json_input();

    $slug = (string) ($in['resourceSlug'] ?? '');
    $id   = (int) ($in['exerciseId'] ?? 0);
    if ($slug === '' || $id <= 0) {
        json_response(['ok' => false, 'error' => 'Données incomplètes.'], 400);
        return;
    }

    $allowed = ['qcm', 'texte-trous', 'glisser-deposer', 'reordonner'];
    $type    = (string) ($in['exerciseType'] ?? 'qcm');
    if (!in_array($type, $allowed, true)) {
        $type = 'qcm';
    }

    $ok = Repository::recordAttempt([
        'resource_slug' => $slug,
        'exercise_id'   => $id,
        'exercise_type' => $type,
        'correct'       => (int) ($in['correct'] ?? 0),
        'total'         => (int) ($in['total'] ?? 0),
    ]);

    json_response(['ok' => true, 'stored' => $ok, 'mode' => Database::mode()]);
}

function api_fiche(string $slug): void
{
    $format = strtolower(query_value('format', 'doc'));
    $html   = build_fiche_html($slug);

    if ($html === null) {
        http_response_code(404);
        render_raw('<div class="card p-8 text-center"><h1 class="section-title">Fiche introuvable</h1></div>');
        return;
    }

    Repository::incrementDownloads($slug);

    header('Content-Type: ' . ($format === 'doc'
        ? 'application/msword; charset=utf-8'
        : 'application/xhtml+xml; charset=utf-8'));
    header('Content-Disposition: attachment; filename="' . $slug . '.doc"');
    header('Cache-Control: public, max-age=300');
    echo $html;
}
