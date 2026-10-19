<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — fonctions utilitaires (échappement, URLs, CECRL, vues).
 */

require_once __DIR__ . '/config.php';

/* ------------------------------------------------------------------ sortie */

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/* -------------------------------------------------------------------- urls */

function url(string $path = '/'): string
{
    $base = base_path();
    if ($path === '' || $path === '/') {
        return $base . '/';
    }
    if (str_starts_with($path, 'assets/') || str_starts_with($path, '?')) {
        return $base . '/' . $path;
    }
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/')) . '?v=' . MLANGUE_VERSION;
}

function current_path(): string
{
    $path = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    $path = is_string($path) ? $path : '/';
    $base = base_path();
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base));
    }
    $path = '/' . ltrim((string) $path, '/');
    return $path === '/' ? '/' : rtrim($path, '/');
}

function is_active(string $path, string $prefix = ''): bool
{
    $current = current_path();
    $target  = url($path);
    $compare = $prefix !== '' ? $prefix : $target;
    $compare = '/' . ltrim(parse_url($compare, PHP_URL_PATH) ?? $compare, '/');
    return $current === $compare || ($compare !== '/' && str_starts_with($current, $compare . '/'));
}

/* -------------------------------------------------------- référentiel CECRL */

function levels(): array
{
    return [
        'A1' => ['short' => 'A1',    'label' => 'A1 — Débutant',       'name' => 'Débutant',      'tint' => 'tint-sky',      'description' => 'Mots isolés, formules de survie, présent de l\'indicatif.'],
        'A2' => ['short' => 'A2',    'label' => 'A2 — Élémentaire',    'name' => 'Élémentaire',   'tint' => 'tint-emerald',  'description' => 'Échanges simples, passé composé, vie quotidienne.'],
        'B1' => ['short' => 'B1',    'label' => 'B1 — Intermédiaire',  'name' => 'Intermédiaire', 'tint' => 'tint-brand',    'description' => 'Autonomie, opinions, imparfait / passé composé.'],
        'B2' => ['short' => 'B2',    'label' => 'B2 — Avancé',         'name' => 'Avancé',        'tint' => 'tint-accent',   'description' => 'Argumentation, presse, subjonctif, connecteurs.'],
        'C1' => ['short' => 'C1/C2', 'label' => 'C1 / C2 — Autonome',  'name' => 'Autonome',      'tint' => 'tint-fuchsia',  'description' => 'Nuances, registres, littérature, idiomes.'],
    ];
}

function themes(): array
{
    return [
        'culture'      => ['label' => 'Culture & société', 'icon' => '🎭', 'tagline' => 'Arts, fêtes, pratiques sociales du monde francophone.', 'gradient' => 'grad-culture'],
        'actualite'    => ['label' => 'Actualité',         'icon' => '📰', 'tagline' => 'Journal parlant, reportages et médias d\'information.', 'gradient' => 'grad-actualite'],
        'grammaire'    => ['label' => 'Grammaire',         'icon' => '🧩', 'tagline' => 'Points de langue mis en situation dans des documents authentiques.', 'gradient' => 'grad-grammaire'],
        'vocabulaire'  => ['label' => 'Vocabulaire',       'icon' => '📚', 'tagline' => 'Champs lexicaux, collocations et registres de langue.', 'gradient' => 'grad-vocabulaire'],
        'francophonie' => ['label' => 'Francophonie',      'icon' => '🌍', 'tagline' => 'Afrique, Amérique, Europe : la diversité des accents.', 'gradient' => 'grad-francophonie'],
        'litterature'  => ['label' => 'Littérature',       'icon' => '✒️', 'tagline' => 'Extraits d\'œuvres, lectures et écriture créative.', 'gradient' => 'grad-litterature'],
    ];
}

function exercise_types(): array
{
    return [
        'qcm'             => ['label' => 'QCM',             'icon' => '◉'],
        'texte-trous'     => ['label' => 'Texte à trous',   'icon' => '▁'],
        'glisser-deposer' => ['label' => 'Glisser-déposer', 'icon' => '⇄'],
        'reordonner'      => ['label' => 'Réordonner',      'icon' => '≡'],
    ];
}

function level_meta(?string $id): array
{
    $levels = levels();
    return $levels[$id] ?? $levels['B1'];
}

function theme_meta(?string $id): array
{
    $themes = themes();
    return $themes[$id] ?? $themes['culture'];
}

function exercise_type_meta(string $type): array
{
    $types = exercise_types();
    return $types[$type] ?? ['label' => $type, 'icon' => '•'];
}

/* ------------------------------------------------------------------ divers */

function fr_date(?string $iso): string
{
    if (!$iso) {
        return '';
    }
    $time = strtotime($iso);
    if ($time === false) {
        return '';
    }
    $mois = [1 => 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    return (int) date('j', $time) . ' ' . $mois[(int) date('n', $time)] . ' ' . date('Y', $time);
}

function fr_number(int|float $value): string
{
    return number_format((float) $value, 0, ',', ' ');
}

function time_code(int $seconds): string
{
    $seconds = max(0, $seconds);
    return sprintf('%02d:%02d', intdiv($seconds, 60), $seconds % 60);
}

/**
 * Normalisation d'une réponse : accents, casse, ponctuation et apostrophes ignorés.
 * Identique à la règle appliquée côté correction automatique.
 */
function normalize_answer(string $value): string
{
    $value = mb_strtolower(trim($value), 'UTF-8');

    // Retrait des diacritiques : intl si disponible, sinon iconv.
    if (function_exists('normalizer_normalize')) {
        $decomposed = normalizer_normalize($value, Normalizer::FORM_D);
        if ($decomposed !== false) {
            $value = $decomposed;
        }
        $value = preg_replace('/\p{Mn}+/u', '', $value) ?? $value;
    } elseif (function_exists('iconv')) {
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        if (is_string($ascii) && $ascii !== '') {
            $value = $ascii;
        }
    }

    $value = str_replace(["’", "‘", "`"], "'", $value);
    $value = preg_replace('/[.,!?;:«»"]+/u', '', $value) ?? $value;
    $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

    return trim($value);
}

/* -------------------------------------------------------------- formulaires */

function post_value(string $key, string $default = ''): string
{
    $value = $_POST[$key] ?? $default;
    return is_string($value) ? trim($value) : $default;
}

function query_value(string $key, string $default = ''): string
{
    $value = $_GET[$key] ?? $default;
    return is_string($value) ? trim($value) : $default;
}

function csrf_token(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_valid(): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $token = (string) ($_POST['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''));
    return $token !== '' && hash_equals((string) ($_SESSION['csrf'] ?? ''), $token);
}

function json_input(): array
{
    $raw = (string) ($_SERVER['MLANGUE_BODY'] ?? file_get_contents('php://input'));
    if ($raw === '') {
        return $_POST;
    }
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : [];
}

function json_response(array $payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

/* -------------------------------------------------------------------- vues */

function view(string $template, array $vars = []): string
{
    $file = app_root() . '/views/' . $template . '.php';
    if (!is_file($file)) {
        throw new RuntimeException('Vue introuvable : ' . $template);
    }
    extract($vars, EXTR_SKIP);
    ob_start();
    require $file;
    return (string) ob_get_clean();
}

function render(string $template, array $vars = [], array $layoutVars = []): void
{
    $content = view($template, $vars);
    echo view('layout', array_merge([
        'title'       => MLANGUE_NAME,
        'description' => MLANGUE_TAGLINE,
        'content'     => $content,
    ], $layoutVars));
}

function render_raw(string $html, array $layoutVars = []): void
{
    echo view('layout', array_merge([
        'title'       => MLANGUE_NAME,
        'description' => MLANGUE_TAGLINE,
        'content'     => $html,
    ], $layoutVars));
}
