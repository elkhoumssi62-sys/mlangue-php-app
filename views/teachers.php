<?php
/** @var array $sheets @var array $stats @var array $levels @var array $themes */
$conseils = [
    ['🎯', 'Partir du document, pas de la règle', "Faites émerger la règle à partir des occurrences repérées dans le document : la mémorisation est plus durable."],
    ['🔁', 'Trois écoutes, trois objectifs', 'Écoute 1 : sens global. Écoute 2 : formes linguistiques. Écoute 3 : production orale imitative.'],
    ['🧑‍🤝‍🧑', 'Différencier par les rôles', "Attribuez des rôles d'écoute différents à chaque groupe, puis faites-les mettre en commun."],
    ['📐', 'Évaluer sur des critères lisibles', "Trois critères maximum par tâche, annoncés avant l'activité, coches pendant la production."],
];
?>
<div class="wrap section">
  <header class="hero-banner hero-banner--accent">
    <p class="eyebrow eyebrow-light">Espace enseignants</p>
    <h1>Des scénarios de classe prêts à l'emploi</h1>
    <p class="hero-banner-lead"><?= (int) $stats['sheets'] ?> fiches téléchargeables (PDF / Word), des déroulés
    minutés, du matériel et des grilles d'évaluation : gagnez du temps de préparation.</p>
    <div class="btn-row">
      <a class="btn-light" href="#fiches">Télécharger les fiches ↓</a>
      <a class="btn-outline-light" href="<?= e(url('/ressources')) ?>">Voir les ressources associées</a>
    </div>
  </header>

  <section class="block" aria-labelledby="conseils-titre">
    <h2 class="section-title" id="conseils-titre">Conseils méthodologiques</h2>
    <ul class="grid-2">
      <?php foreach ($conseils as $conseil): ?>
        <li class="card conseil-card">
          <span class="conseil-icon" aria-hidden="true"><?= e($conseil[0]) ?></span>
          <span>
            <h3><?= e($conseil[1]) ?></h3>
            <p class="muted"><?= e($conseil[2]) ?></p>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section id="fiches" class="block" aria-labelledby="fiches-titre">
    <div class="section-head">
      <div>
        <h2 class="section-title" id="fiches-titre">Fiches pédagogiques</h2>
        <p class="muted section-lead">Chaque fiche s'ouvre avec ses objectifs, son déroulé et sa grille d'évaluation.</p>
      </div>
      <ul class="chip-row">
        <?php foreach ($levels as $level): ?>
          <li><a class="chip <?= e($level['tint']) ?>" href="<?= e(url('/ressources?niveau=' . level_slug($level['short']))) ?>"><?= e($level['short']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <ul class="grid-2">
      <?php foreach ($sheets as $sheet): ?>
        <li><?= fiche_card_html($sheet) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>
</div>
