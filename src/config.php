<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — configuration générale de la plateforme.
 *
 * Toutes les valeurs sont surchargeables par variables d'environnement,
 * ce qui permet un déploiement sans modifier le code.
 */

const MLANGUE_NAME    = 'Mlangue.medelkhoumssi';
const MLANGUE_MARK    = 'Mlangue';
const MLANGUE_AUTHOR  = 'Prof. EL KHOUMSSI';
const MLANGUE_TAGLINE = 'La plateforme du prof EL KHOUMSSI pour apprendre le français';
const MLANGUE_EMAIL   = 'contact@mlangue-medelkhoumssi.fr';

const MLANGUE_VERSION = '2.0.0';

/**
 * Retourne un paramètre de configuration (environnement prioritaire).
 */
function mlangue_config(string $key, ?string $default = null): ?string
{
    $value = getenv('MLANGUE_' . strtoupper($key));
    if ($value !== false && $value !== '') {
        return $value;
    }
    return $default;
}

/**
 * Chemin de base de l'application (utile si déployée dans un sous-dossier).
 */
function base_path(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }
    $fromEnv = mlangue_config('base_path');
    if ($fromEnv !== null) {
        return $base = '/' . trim($fromEnv, '/');
    }
    $script = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/')));
    $base   = ($script === '/' || $script === '.') ? '' : rtrim($script, '/');
    return $base;
}

/**
 * Racine du système de fichiers de l'application.
 */
function app_root(): string
{
    return dirname(__DIR__);
}
