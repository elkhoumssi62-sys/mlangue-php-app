<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — génération des fiches pédagogiques téléchargeables.
 *
 * Le document produit est un fichier HTML/Word autonome, ouvrable dans Word,
 * LibreOffice ou imprimable en PDF depuis le navigateur.
 */

function fiche_escape(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * @param array{title:string, level:string, duration:string, description?:string,
 *              objectives:array<int,string>, steps:array<int,array<string,mixed>>,
 *              extra?:array<int,array{heading:string, items:array<int,string>}>} $fiche
 */
function fiche_document(array $fiche): string
{
    $extra = '';
    foreach ($fiche['extra'] ?? [] as $block) {
        $items = '';
        foreach ($block['items'] as $item) {
            $items .= '<li>' . fiche_escape($item) . '</li>';
        }
        $extra .= '<h2>' . fiche_escape($block['heading']) . '</h2><ul>' . $items . '</ul>';
    }

    $steps = '';
    foreach ($fiche['steps'] as $index => $step) {
        $steps .= '<tr><td>' . ((int) $index + 1) . '. ' . fiche_escape((string) $step['title'])
            . '</td><td>' . fiche_escape((string) $step['detail'])
            . '</td><td>' . (int) $step['minutes'] . ' min</td></tr>';
    }

    $objectives = '';
    foreach ($fiche['objectives'] as $objective) {
        $objectives .= '<li>' . fiche_escape($objective) . '</li>';
    }

    return '<!DOCTYPE html>
<html lang="fr"><head><meta charset="utf-8">
<meta name="generator" content="Mlangue.medelkhoumssi">
<title>' . fiche_escape($fiche['title']) . '</title>
<style>
body{font-family:Calibri,Arial,sans-serif;color:#1f2937;margin:40px;line-height:1.6}
h1{color:#142f6f;font-size:24px;border-bottom:3px solid #f96d0b;padding-bottom:8px}
h2{color:#1f3fb5;font-size:16px;margin-top:24px}
table{border-collapse:collapse;width:100%;margin-top:8px}
td,th{border:1px solid #cbd5e1;padding:8px;font-size:13px;vertical-align:top}
th{background:#eef4ff;text-align:left}
.meta{background:#f1f5f9;padding:10px 14px;border-radius:8px;font-size:13px}
ul{margin-top:6px}
</style></head><body>
<h1>' . fiche_escape($fiche['title']) . '</h1>
<p class="meta"><strong>Plateforme :</strong> ' . MLANGUE_NAME . ' — ' . MLANGUE_AUTHOR
. ' &nbsp;|&nbsp; <strong>Niveau :</strong> ' . fiche_escape($fiche['level'])
. ' &nbsp;|&nbsp; <strong>Durée :</strong> ' . fiche_escape($fiche['duration']) . '</p>'
. (isset($fiche['description']) ? '<p>' . fiche_escape($fiche['description']) . '</p>' : '')
. '<h2>Objectifs</h2><ul>' . $objectives . '</ul>
<h2>Déroulé de la séance</h2>
<table><tr><th>Étape</th><th>Consigne / activité</th><th>Temps</th></tr>' . $steps . '</table>'
. $extra
. '<p style="margin-top:32px;font-size:12px;color:#64748b">' . MLANGUE_NAME
. ' — Apprendre et enseigner le français · Fiche générée automatiquement.</p>
</body></html>';
}

function build_fiche_html(string $slug): ?string
{
    $sheet = Repository::teachingSheet($slug);
    if ($sheet !== null) {
        return fiche_document([
            'title'       => $sheet['title'],
            'level'       => (string) $sheet['level'],
            'duration'    => (string) $sheet['duration'],
            'description' => (string) $sheet['description'],
            'objectives'  => (array) $sheet['objectives'],
            'steps'       => (array) $sheet['steps'],
        ]);
    }

    $data = Repository::resource($slug);
    if ($data === null) {
        return null;
    }

    $resource = $data['resource'];
    $sheet    = $resource['sheet'];

    $extra = [];
    if (is_array($sheet)) {
        $extra[] = ['heading' => 'Points de langue',  'items' => (array) ($sheet['languagePoints'] ?? [])];
        $extra[] = ['heading' => 'Matériel',          'items' => (array) ($sheet['materials'] ?? [])];
        $extra[] = ['heading' => 'Évaluation',        'items' => [(string) ($sheet['evaluation'] ?? '')]];
        $extra[] = ['heading' => 'Différenciation',   'items' => [(string) ($sheet['differentiation'] ?? '')]];
    }

    return fiche_document([
        'title'       => 'Fiche pédagogique — ' . (string) $resource['title'],
        'level'       => (string) $resource['level'],
        'duration'    => is_array($sheet) ? (string) ($sheet['durationLabel'] ?? '45 min') : '45 min',
        'description' => (string) $resource['description'],
        'objectives'  => (array) $resource['objectives'],
        'steps'       => is_array($sheet) ? (array) ($sheet['steps'] ?? []) : [],
        'extra'       => $extra,
    ]);
}
