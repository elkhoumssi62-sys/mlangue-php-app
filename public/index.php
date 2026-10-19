<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — contrôleur frontal.
 *
 * Point d'entrée unique de l'application : toutes les requêtes passent ici.
 * Déploiement :
 *   php -S localhost:8000 -t public        (développement)
 *   DocumentRoot …/public                  (Apache / Nginx + PHP-FPM)
 */

require_once dirname(__DIR__) . '/src/bootstrap.php';

$path = current_path();

/* ------------------------------------------------------- fichiers statiques */
if (preg_match('#^/assets/(.+)$#', $path, $m) === 1) {
    $file = realpath(app_root() . '/public/assets/' . basename(dirname('/' . $m[1])) . '/' . basename($m[1]));
    if ($file !== false && str_starts_with($file, app_root() . '/public/assets/')) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $mime = match ($ext) {
            'css'   => 'text/css; charset=utf-8',
            'js'    => 'application/javascript; charset=utf-8',
            'svg'   => 'image/svg+xml',
            'png'   => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'webp'  => 'image/webp',
            'ico'   => 'image/x-icon',
            default => 'application/octet-stream',
        };
        header('Content-Type: ' . $mime);
        header('Cache-Control: public, max-age=3600');
        readfile($file);
        exit;
    }
}

/* ------------------------------------------------------------------ routage */

$method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));

try {
    if ($method === 'POST') {
        if ($path === '/api/newsletter') {
            api_newsletter();
            exit;
        }
        if ($path === '/api/attempt') {
            api_attempt();
            exit;
        }
    }

    if ($method === 'GET') {
        if (preg_match('#^/api/fiches/([a-z0-9\-]+)$#', $path, $m) === 1) {
            api_fiche($m[1]);
            exit;
        }

        switch ($path) {
            case '/':
                page_home();
                break;
            case '/ressources':
                page_resources();
                break;
            case '/apprenants':
                page_learners();
                break;
            case '/enseignants':
                page_teachers();
                break;
            case '/recherche':
                page_search();
                break;
            case '/plan-du-site':
                page_sitemap();
                break;
            case '/mentions-legales':
                page_legal();
                break;
            case '/accessibilite':
                page_accessibility();
                break;
            default:
                if (preg_match('#^/ressources/([a-z0-9\-]+)$#', $path, $m) === 1) {
                    page_resource($m[1]);
                    break;
                }
                http_response_code(404);
                page_not_found($path);
        }
        exit;
    }

    http_response_code(405);
    header('Allow: GET, POST');
    render_raw('<div class="card p-8 text-center"><h1 class="section-title">Méthode non autorisée</h1></div>');
} catch (Throwable $e) {
    error_log('[Mlangue] ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
    http_response_code(500);
    if ($method === 'POST') {
        json_response(['ok' => false, 'error' => 'Erreur interne du serveur.'], 500);
        exit;
    }
    render_raw(
        '<div class="card p-8 text-center">'
        . '<p class="chip tint-accent">Erreur 500</p>'
        . '<h1 class="section-title mt-3">Une erreur est survenue</h1>'
        . '<p class="muted mt-2 text-sm">L\'équipe pédagogique a été prévenue. Merci de réessayer dans un instant.</p>'
        . '<p class="mt-4"><a class="btn-primary" href="' . e(url('/')) . '">Retour à l\'accueil</a></p>'
        . '</div>'
    );
}
