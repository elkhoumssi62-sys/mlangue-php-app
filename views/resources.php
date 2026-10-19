<?php
/** @var array $resources @var array $filters @var array $levels @var array $themes */
$buildHref = static function (array $patch) use ($filters): string {
    $merged = array_merge([
        'niveau'  => $filters['level'],
        'theme'   => $filters['theme'],
        'public'  => $filters['audience'],
        'q'       => $filters['q'],
    ], $patch);
    $params = [];
    foreach ($merged as $key => $value) {
        if ($value !== null && $value !== '') {
            $params[$key] = $value;
        }
    }
    $qs = http_build_query($params);
    return url('/ressources' . ($qs !== '' ? '?' . $qs : ''));
};
?>
<div class="wrap section">
  <p class="eyebrow">Catalogue</p>
  <h1 class="section-title">Toutes les ressources</h1>
  <p class="muted section-lead"><?= count($resources) ?> document(s) authentique(s) avec transcription,
  lexique, exercices corrigés et fiche enseignant.</p>

  <form class="card search-form" role="search" method="get" action="<?= e(url('/ressources')) ?>">
    <span class="filter-search">
      <label class="sr-only" for="q">Rechercher dans le catalogue</label>
      <span aria-hidden="true">🔍</span>
      <input id="q" name="q" type="search" value="<?= e((string) $filters['q']) ?>" placeholder="Mot-clé, thème, titre…">
    </span>
    <?php if ($filters['level']): ?><input type="hidden" name="niveau" value="<?= e((string) $filters['level']) ?>"><?php endif; ?>
    <?php if ($filters['theme']): ?><input type="hidden" name="theme" value="<?= e((string) $filters['theme']) ?>"><?php endif; ?>
    <span>
      <label class="sr-only" for="public">Public</label>
      <select id="public" name="public">
        <option value="">Tous les publics</option>
        <option value="apprenants"<?= $filters['audience'] === 'apprenants' ? ' selected' : '' ?>>Apprenants</option>
        <option value="enseignants"<?= $filters['audience'] === 'enseignants' ? ' selected' : '' ?>>Enseignants</option>
      </select>
    </span>
    <button class="btn-primary" type="submit">Rechercher</button>
  </form>

  <div class="catalog-layout">
    <aside class="catalog-aside">
      <section class="card">
        <h2 class="aside-title">Niveau</h2>
        <ul class="aside-list">
          <li><a href="<?= e($buildHref(['niveau' => null])) ?>"<?= $filters['level'] === null ? ' class="is-current"' : '' ?>>Tous les niveaux</a></li>
          <?php foreach ($levels as $id => $level): ?>
            <li>
              <a href="<?= e($buildHref(['niveau' => $id])) ?>" class="<?= e($level['tint']) ?><?= $filters['level'] === $id ? ' is-current' : '' ?>">
                <?= e($level['label']) ?><span><?= e($level['short']) ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>

      <section class="card">
        <h2 class="aside-title">Thématique</h2>
        <ul class="aside-list">
          <li><a href="<?= e($buildHref(['theme' => null])) ?>"<?= $filters['theme'] === null ? ' class="is-current"' : '' ?>>Toutes les thématiques</a></li>
          <?php foreach ($themes as $id => $theme): ?>
            <li>
              <a href="<?= e($buildHref(['theme' => $id])) ?>" class="<?= $filters['theme'] === $id ? 'is-current tint-accent' : '' ?>">
                <span aria-hidden="true"><?= e($theme['icon']) ?></span> <?= e($theme['label']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </aside>

    <div>
      <?php if ($filters['level'] || $filters['theme'] || $filters['q']): ?>
        <div class="chip-row active-filters">
          <span class="muted">Filtres actifs :</span>
          <?php if ($filters['level']): ?>
            <a class="chip tint-brand" href="<?= e($buildHref(['niveau' => null])) ?>">Niveau <?= e((string) $filters['level']) ?> ✕</a>
          <?php endif; ?>
          <?php if ($filters['theme']): ?>
            <a class="chip tint-accent" href="<?= e($buildHref(['theme' => null])) ?>"><?= e($themes[$filters['theme']]['label'] ?? '') ?> ✕</a>
          <?php endif; ?>
          <?php if ($filters['q']): ?>
            <a class="chip" href="<?= e($buildHref(['q' => null])) ?>">« <?= e((string) $filters['q']) ?> » ✕</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ($resources === []): ?>
        <div class="card empty-state">
          <p class="section-title">Aucun résultat</p>
          <p class="muted">Essayez d'élargir vos critères de recherche.</p>
          <a class="btn-primary" href="<?= e(url('/ressources')) ?>">Réinitialiser les filtres</a>
        </div>
      <?php else: ?>
        <ul class="card-grid">
          <?php foreach ($resources as $r): ?>
            <li><?= resource_card_html($r) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
