<?php
/** @var array|null $hero @var array $resources @var array $featured @var array $sheets
 *  @var array $stats @var array $themes @var array $themeCounts */
?>
<section class="hero">
  <div class="hero-media" aria-hidden="true">
    <img src="<?= e((string) ($hero['poster_url'] ?? '')) ?>" alt="">
  </div>
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <p class="chip chip-live"><span class="dot" aria-hidden="true"></span> À la une aujourd'hui</p>
      <h1>Apprendre le français avec des documents authentiques</h1>
      <p class="hero-lead">
        Vidéos du monde francophone, exercices corrigés instantanément et fiches pédagogiques prêtes
        à imprimer — du A1 au C2, pour apprendre seul ou en classe avec <?= e(MLANGUE_AUTHOR) ?>.
      </p>
      <dl class="hero-stats">
        <div><dt>Ressources</dt><dd><?= e(fr_number($stats['resources'])) ?></dd></div>
        <div><dt>Exercices</dt><dd><?= e(fr_number($stats['exercises'])) ?></dd></div>
        <div><dt>Fiches</dt><dd><?= e(fr_number($stats['sheets'])) ?></dd></div>
        <div><dt>Minutes</dt><dd><?= e(fr_number($stats['minutes'])) ?></dd></div>
      </dl>
    </div>

    <?php if ($hero !== null): ?>
      <?php $heroLevel = level_meta((string) $hero['level']); $heroTheme = theme_meta((string) $hero['theme']); ?>
      <div class="hero-card">
        <img class="hero-card-media" src="<?= e((string) $hero['poster_url']) ?>" alt="">
        <div class="hero-card-body">
          <div class="chip-row">
            <span class="chip"><?= e($heroLevel['short']) ?></span>
            <span class="chip"><?= e($heroTheme['icon']) ?> <?= e($heroTheme['label']) ?></span>
            <span class="chip">▶ <?= e((string) $hero['duration']) ?></span>
          </div>
          <h2><?= e((string) $hero['title']) ?></h2>
          <p><?= e((string) $hero['excerpt']) ?></p>
          <div class="btn-row">
            <a class="btn-accent" href="<?= e(url('/ressources/' . $hero['slug'])) ?>">Commencer l'activité →</a>
            <a class="btn-outline-light" href="<?= e(url('/ressources/' . $hero['slug'] . '?onglet=fiche')) ?>">Fiche enseignant</a>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section wrap" aria-labelledby="niveaux-titre">
  <p class="eyebrow">Parcours guidé</p>
  <h2 class="section-title" id="niveaux-titre">Trouvez votre niveau en un clic</h2>
  <p class="muted section-lead">Sélectionnez une carte du CECRL pour filtrer instantanément le catalogue.
  Combinez avec une thématique ou un mot-clé pour affiner.</p>

  <ul class="level-grid" data-filter-levels>
    <?php foreach (levels() as $id => $level): ?>
      <?php $count = 0; foreach ($resources as $r) { if ($r['level'] === $id) { $count++; } } ?>
      <li>
        <button type="button" class="card card-hover level-card <?= e($level['tint']) ?>"
                data-level="<?= e($id) ?>" aria-pressed="false">
          <span class="level-card-top">
            <span class="level-card-mark"><?= e($level['short']) ?></span>
            <span class="level-card-count"><?= $count ?></span>
          </span>
          <strong><?= e($level['name']) ?></strong>
          <small><?= e($level['description']) ?></small>
        </button>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="card filter-bar">
    <span class="filter-search">
      <label class="sr-only" for="filter-q">Filtrer les ressources par mot-clé</label>
      <span aria-hidden="true">🔍</span>
      <input id="filter-q" type="search" placeholder="Filtrer en direct…" data-filter-text>
    </span>
    <ul class="filter-themes" aria-label="Filtrer par thématique">
      <?php foreach ($themes as $id => $theme): ?>
        <li>
          <button type="button" class="chip chip-btn" data-theme="<?= e($id) ?>" aria-pressed="false">
            <span aria-hidden="true"><?= e($theme['icon']) ?></span> <?= e($theme['label']) ?>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="filter-status">
      <p role="status" aria-live="polite"><span data-filter-count><?= count($resources) ?></span> ressource(s)</p>
      <button type="button" class="link-reset" data-filter-reset hidden>Réinitialiser</button>
    </div>
  </div>

  <ul class="card-grid" data-filter-list>
    <?php foreach ($resources as $r): ?>
      <li data-level="<?= e((string) $r['level']) ?>" data-theme="<?= e((string) $r['theme']) ?>"
          data-search="<?= e(mb_strtolower((string) $r['title'] . ' ' . $r['subtitle'] . ' ' . $r['excerpt'], 'UTF-8')) ?>">
        <?= resource_card_html($r) ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <p class="filter-empty card" data-filter-none hidden>Aucune ressource ne correspond à ces critères.</p>

  <p class="see-all"><a href="<?= e(url('/ressources')) ?>">Voir le catalogue complet avec recherche avancée →</a></p>
</section>

<section class="section section-alt" aria-labelledby="thematiques-titre">
  <div class="wrap">
    <p class="eyebrow">Collections</p>
    <h2 class="section-title" id="thematiques-titre">Thématiques &amp; collections</h2>
    <ul class="theme-grid">
      <?php foreach ($themes as $id => $theme): ?>
        <li>
          <a class="theme-card <?= e($theme['gradient']) ?>" href="<?= e(url('/ressources?theme=' . $id)) ?>">
            <span class="theme-icon" aria-hidden="true"><?= e($theme['icon']) ?></span>
            <span class="theme-copy">
              <strong><?= e($theme['label']) ?></strong>
              <small><?= e($theme['tagline']) ?></small>
            </span>
            <span class="theme-count"><?= (int) ($themeCounts[$id] ?? 0) ?> ressource(s)
              <em aria-hidden="true">→</em></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section wrap" aria-labelledby="une-titre">
  <p class="eyebrow">Sélection de la rédaction</p>
  <h2 class="section-title" id="une-titre">Trois ressources pour progresser</h2>
  <ul class="card-grid">
    <?php foreach ($featured as $r): ?>
      <li><?= resource_card_html($r) ?></li>
    <?php endforeach; ?>
  </ul>
</section>

<section class="section section-dark" aria-labelledby="enseignants-titre">
  <div class="wrap">
    <div class="section-head">
      <div>
        <p class="eyebrow eyebrow-light">Espace enseignants</p>
        <h2 class="section-title" id="enseignants-titre">Fiches pédagogiques et scénarios de classe</h2>
        <p class="section-lead-light">Des séquences prêtes à l'emploi, avec objectifs, déroulé minuté,
        matériel et grille d'évaluation. Téléchargeables au format Word ou imprimables en PDF.</p>
      </div>
      <a class="btn-accent" href="<?= e(url('/enseignants')) ?>">Tout l'espace enseignants →</a>
    </div>
    <ul class="grid-3">
      <?php foreach ($sheets as $s): ?>
        <li class="dark-card">
          <div class="chip-row">
            <span class="chip">Niveau <?= e((string) $s['level']) ?></span>
            <span class="chip chip-accent-light"><?= e((string) $s['format']) ?></span>
          </div>
          <h3><?= e((string) $s['title']) ?></h3>
          <p><?= e((string) $s['description']) ?></p>
          <dl class="dark-stats">
            <div><dt>Durée</dt><dd><?= e((string) $s['duration']) ?></dd></div>
            <div><dt>Étapes</dt><dd><?= count((array) $s['steps']) ?></dd></div>
          </dl>
          <a class="btn-outline-light block" href="<?= e(url('/api/fiches/' . $s['slug'] . '?format=doc')) ?>">⤓ Télécharger la fiche</a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section wrap" aria-labelledby="modules-titre">
  <p class="eyebrow">Entraînement</p>
  <h2 class="section-title" id="modules-titre">Quatre modules d'exercices corrigés automatiquement</h2>
  <ul class="grid-4">
    <?php foreach (exercise_types() as $type): ?>
      <li class="card module-card">
        <span class="module-icon" aria-hidden="true"><?= e($type['icon']) ?></span>
        <h3><?= e($type['label']) ?></h3>
        <p class="muted">
          <?php if ($type['label'] === 'QCM'): ?>Choix multiples avec explication immédiate après validation.
          <?php elseif ($type['label'] === 'Texte à trous'): ?>Compléter un texte, tolérance sur les accents et les majuscules.
          <?php elseif ($type['label'] === 'Glisser-déposer'): ?>Classer des éléments par catégorie, avec version clavier.
          <?php else: ?>Remettre un dialogue ou une phrase dans le bon ordre.
          <?php endif; ?>
        </p>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
