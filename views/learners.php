<?php
/** @var array $resources @var array $stats @var array $levels @var array $types */
$steps = [
    ['Choisissez votre niveau', "Un test rapide ou une simple intuition : A1 débutant à C1/C2 autonome."],
    ['Regardez le document', 'Vidéo courte, sous-titrée par la transcription synchronisée.'],
    ['Retenez le lexique', 'Ajoutez les mots nouveaux à votre carnet de vocabulaire.'],
    ['Entraînez-vous', 'QCM, texte à trous, glisser-déposer, réordonnancement — corrigés instantanément.'],
];
?>
<div class="wrap section">
  <header class="hero-banner hero-banner--blue">
    <p class="eyebrow eyebrow-light">Espace apprenants</p>
    <h1>Apprenez à votre rythme, avec de vrais documents</h1>
    <p class="hero-banner-lead"><?= (int) $stats['resources'] ?> ressources, <?= (int) $stats['exercises'] ?>
    exercices corrigés automatiquement et un carnet de vocabulaire personnel : tout ce qu'il faut pour
    progresser du A1 au C2.</p>
    <a class="btn-accent" href="#parcours">Voir comment ça marche ↓</a>
  </header>

  <section id="parcours" class="block" aria-labelledby="parcours-titre">
    <h2 class="section-title" id="parcours-titre">Votre parcours en quatre étapes</h2>
    <ol class="grid-4">
      <?php foreach ($steps as $i => $step): ?>
        <li class="card step-card">
          <span class="step-index"><?= $i + 1 ?></span>
          <h3><?= e($step[0]) ?></h3>
          <p class="muted"><?= e($step[1]) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </section>

  <section class="block" aria-labelledby="niveaux-titre">
    <h2 class="section-title" id="niveaux-titre">Choisissez votre niveau</h2>
    <ul class="level-grid">
      <?php foreach ($levels as $id => $level): ?>
        <li>
          <a class="card card-hover level-card <?= e($level['tint']) ?>" href="<?= e(url('/ressources?niveau=' . $id)) ?>">
            <span class="level-card-mark big"><?= e($level['short']) ?></span>
            <strong><?= e($level['name']) ?></strong>
            <small><?= e($level['description']) ?></small>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section class="block" aria-labelledby="types-titre">
    <h2 class="section-title" id="types-titre">Les types d'exercices</h2>
    <ul class="grid-4">
      <?php foreach ($types as $type): ?>
        <li class="card module-card">
          <span class="module-icon" aria-hidden="true"><?= e($type['icon']) ?></span>
          <h3><?= e($type['label']) ?></h3>
          <p class="muted">Correction automatique et explication pédagogique après validation.</p>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <section aria-labelledby="commencer-titre">
    <h2 class="section-title" id="commencer-titre">Par où commencer ?</h2>
    <ul class="card-grid">
      <?php foreach ($resources as $r): ?>
        <li><?= resource_card_html($r) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>
</div>
