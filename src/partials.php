<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — composants réutilisables (cartes, badges, listes).
 */

function level_slug(string $short): string
{
    return $short === 'C1/C2' ? 'C1' : $short;
}

function resource_card_html(array $r): string
{
    $level = level_meta((string) $r['level']);
    $theme = theme_meta((string) $r['theme']);
    $href  = url('/ressources/' . $r['slug']);

    return '<article class="card card-hover resource-card">
  <a href="' . e($href) . '">
    <div class="resource-media">
      <img src="' . e((string) $r['poster_url']) . '" alt="" loading="lazy">
      <span class="chip chip-float-left ' . e($level['tint']) . '">' . e($level['short']) . '</span>
      <span class="chip chip-float-right">▶ ' . e((string) $r['duration']) . '</span>
      <span class="resource-theme">' . e($theme['icon']) . ' ' . e($theme['label']) . '</span>
    </div>
  </a>
  <div class="resource-body">
    <h3><a href="' . e($href) . '">' . e((string) $r['title']) . '</a></h3>
    <p class="resource-subtitle">' . e((string) $r['subtitle']) . '</p>
    <p class="resource-excerpt">' . e((string) $r['excerpt']) . '</p>
    <div class="resource-foot">
      <span>' . e(fr_date((string) $r['published_at'])) . '</span>
      <span>👁 ' . e(fr_number((int) $r['views'])) . '</span>
    </div>
  </div>
</article>';
}

function fiche_card_html(array $s): string
{
    $theme  = theme_meta((string) $s['theme']);
    $total  = 0;
    foreach ((array) $s['steps'] as $step) {
        $total += (int) $step['minutes'];
    }
    $stepsHtml = '';
    foreach ((array) $s['steps'] as $i => $step) {
        $stepsHtml .= '<li><strong>' . ((int) $i + 1) . '. ' . e((string) $step['title']) . '</strong> ('
            . (int) $step['minutes'] . ' min) — ' . e((string) $step['detail']) . '</li>';
    }

    return '<article class="card card-hover fiche-card">
  <div class="chip-row">
    <span class="chip tint-brand">Niveau ' . e((string) $s['level']) . '</span>
    <span class="chip">' . e($theme['icon']) . ' ' . e($theme['label']) . '</span>
    <span class="chip tint-accent">' . e((string) $s['format']) . '</span>
  </div>
  <h3>' . e((string) $s['title']) . '</h3>
  <p class="muted">' . e((string) $s['description']) . '</p>
  <dl class="fiche-stats">
    <div><dt>Durée</dt><dd>' . e((string) $s['duration']) . '</dd></div>
    <div><dt>Étapes</dt><dd>' . count((array) $s['steps']) . '</dd></div>
    <div><dt>Total minuté</dt><dd>' . $total . ' min</dd></div>
  </dl>
  <details>
    <summary>Voir le déroulé</summary>
    <ol class="steps-list">' . $stepsHtml . '</ol>
  </details>
  <div class="fiche-actions">
    <a class="btn-primary" href="' . e(url('/api/fiches/' . $s['slug'] . '?format=doc')) . '">⤓ Word (.doc)</a>
    <a class="btn-ghost" href="' . e(url('/api/fiches/' . $s['slug'] . '?format=pdf')) . '">⤓ PDF / imprimable</a>
    <span class="fiche-count">' . e(fr_number((int) $s['downloads'])) . ' téléchargements</span>
  </div>
</article>';
}

function exercise_badge_html(string $type): string
{
    $meta = exercise_type_meta($type);
    return '<span class="chip tint-brand"><span aria-hidden="true">' . e($meta['icon'])
        . '</span> ' . e($meta['label']) . '</span>';
}
