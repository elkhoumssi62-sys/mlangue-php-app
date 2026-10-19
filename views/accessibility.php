<?php
$features = [
    ['Contrastes renforcés', "Les couples de couleurs texte / fond respectent un rapport d'au moins 4,5:1 en mode clair comme en mode sombre."],
    ['Navigation au clavier', "Onglets, cartes de niveaux, glisser-déposer et réordonnancement sont tous accessibles au clavier (flèches, Entrée, Tab)."],
    ["Lien d'évitement", "Un lien « Aller au contenu principal » permet d'ignorer l'en-tête de navigation."],
    ['Structure sémantique', 'Repères ARIA (tablist, tab, tabpanel, progressbar, aria-live), titres hiérarchisés et fil d\'Ariane.'],
    ['Formulaires aidés', "Chaque champ possède une étiquette explicite et les messages d'état sont annoncés aux lecteurs d'écran."],
    ['Mouvement réduit', 'Les animations sont désactivées lorsque le système déclare prefers-reduced-motion.'],
];
?>
<div class="wrap section narrow">
  <h1 class="section-title">Accessibilité</h1>
  <p class="muted section-lead"><strong><?= e(MLANGUE_NAME) ?></strong> vise la conformité au niveau <strong>AA</strong>
  des règles WCAG 2.1. Cette page documente les choix de conception mis en œuvre dans l'interface.</p>
  <ul class="grid-2">
    <?php foreach ($features as $feature): ?>
      <li class="card">
        <h2><?= e($feature[0]) ?></h2>
        <p class="muted"><?= e($feature[1]) ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
  <p class="muted stats-line">Vous rencontrez un obstacle ? Écrivez-nous à <?= e(MLANGUE_EMAIL) ?>
  en décrivant la page concernée : nous corrigeons les problèmes signalés en priorité.</p>
</div>
