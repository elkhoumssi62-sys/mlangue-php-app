<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — amorçage de l'application.
 */

error_reporting(E_ALL);
ini_set('display_errors', '0');
mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Paris');

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Repository.php';
require_once __DIR__ . '/partials.php';
require_once __DIR__ . '/pages.php';
require_once __DIR__ . '/api.php';
require_once __DIR__ . '/fiches.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

Repository::install();
