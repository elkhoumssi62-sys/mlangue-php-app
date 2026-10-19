<?php
/** @var string $q @var array $resources @var array $sheets */
?>
<div class="wrap section">
  <h1 class="section-title">Recherche</h1>
  <form class="search-form card" role="search" method="get" action="<?= e(url('/recherche')) ?>">
    <span class="filter-search">
      <label class="sr-only" for="q">Votre recherche</label>
      <span aria-hidden="true">🔍</span>
      <input id="q" name="q" type="search" value="<?= e($q) ?>"
             placeholder="Rechercher une ressource, un point de langue, un pays…">
    </span>
    <button class="btn-primary" type="submit">Rechercher</button>
  </form>

  <?php if ($q !== ''): ?>
    <p class="muted stats-line" role="status" aria-live="polite">
      <?= count($resources) + count($sheets) ?> résultat(s) pour «&nbsp;<strong><?= e($q) ?></strong>&nbsp;»
    </p>

    <?php if ($sheets !== []): ?>
      <section class="block">
        <h2 class="section-subtitle">Fiches pédagogiques</h2>
        <ul class="grid-2">
          <?php foreach ($sheets as $sheet): ?>
            <li><?= fiche_card_html($sheet) ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>

    <section class="block">
      <h2 class="section-subtitle">Ressources</h2>
      <?php if ($resources === []): ?>
        <p class="muted">Aucune ressource ne correspond. Essayez « café », « francophonie », « subjonctif »…</p>
      <?php else: ?>
        <ul class="card-grid">
          <?php foreach ($resources as $r): ?>
            <li><?= resource_card_html($r) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  <?php else: ?>
    <p class="muted stats-line">Saisissez un mot-clé pour lancer une recherche dans les ressources et les fiches pédagogiques.</p>
  <?php endif; ?>
</div>
