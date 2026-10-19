<?php
/** @var string $title @var string $description @var string $content */
$extraHead = $extraHead ?? '';
$bodyClass = $bodyClass ?? '';
$nav       = [
    '/'             => 'Accueil',
    '/ressources'   => 'Ressources',
    '/apprenants'   => 'Apprenants',
    '/enseignants'  => 'Enseignants',
    '/plan-du-site' => 'Plan du site',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="color-scheme" content="light dark">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>">
<meta name="author" content="<?= e(MLANGUE_AUTHOR) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= e(asset('css/styles.css')) ?>">
<?= $extraHead ?>
<script>
(function(){try{var s=localStorage.getItem('mlangue-theme');var d=s?s==='dark':window.matchMedia('(prefers-color-scheme: dark)').matches;if(d)document.documentElement.classList.add('dark');}catch(e){}})();
</script>
</head>
<body class="<?= e($bodyClass) ?>">
<a href="#contenu" class="skip-link btn-accent">Aller au contenu principal</a>

<header class="site-header">
  <div class="wrap header-row">
    <a class="brand" href="<?= e(url('/')) ?>" aria-label="<?= e(MLANGUE_NAME) ?>, retour à l'accueil">
      <span class="brand-mark" aria-hidden="true">M</span>
      <span class="brand-text">
        <strong><?= e(MLANGUE_MARK) ?></strong>
        <small>medelkhoumssi · <?= e(MLANGUE_AUTHOR) ?></small>
      </span>
    </a>

    <form class="header-search" role="search" method="get" action="<?= e(url('/recherche')) ?>">
      <label class="sr-only" for="q">Rechercher une ressource, un niveau, un thème</label>
      <span aria-hidden="true">🔍</span>
      <input id="q" type="search" name="q" placeholder="Rechercher : subjonctif, Dakar, café…" value="<?= e(query_value('q')) ?>">
    </form>

    <nav class="header-nav" aria-label="Navigation principale">
      <?php foreach ($nav as $href => $label): ?>
        <?php if ($href !== '/plan-du-site'): ?>
          <a href="<?= e(url($href)) ?>"<?= is_active($href) ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>

    <button class="icon-btn" type="button" data-theme-toggle
            aria-label="Basculer entre mode clair et mode sombre">🌙</button>

    <button class="icon-btn menu-toggle" type="button" data-menu-toggle
            aria-expanded="false" aria-controls="menu-mobile" aria-label="Ouvrir le menu">☰</button>
  </div>

  <div class="header-levels wrap">
    <span class="header-levels-label">Niveau CECRL :</span>
    <?php foreach (levels() as $level): ?>
      <a class="level-link <?= e($level['tint']) ?>" href="<?= e(url('/ressources?niveau=' . level_slug($level['short']))) ?>"><?= e($level['short']) ?></a>
    <?php endforeach; ?>
  </div>

  <div id="menu-mobile" class="mobile-menu" hidden>
    <ul>
      <?php foreach ($nav as $href => $label): ?>
        <li><a href="<?= e(url($href)) ?>"><?= e($label) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</header>

<main id="contenu">
<?= $content ?>
</main>

<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <div class="brand">
        <span class="brand-mark brand-mark--light" aria-hidden="true">M</span>
        <span class="brand-text"><strong><?= e(MLANGUE_NAME) ?></strong></span>
      </div>
      <p class="footer-lead">La plateforme du prof <?= e(MLANGUE_AUTHOR) ?> pour apprendre et enseigner
      le français langue étrangère : documents authentiques, exercices corrigés automatiquement et
      fiches de classe prêtes à l'emploi.</p>
      <ul class="socials">
        <li><a href="#" aria-label="YouTube">▶</a></li>
        <li><a href="#" aria-label="Instagram">◎</a></li>
        <li><a href="#" aria-label="Facebook">f</a></li>
        <li><a href="#" aria-label="X">✕</a></li>
        <li><a href="#" aria-label="LinkedIn">in</a></li>
      </ul>
    </div>

    <nav aria-label="Apprendre">
      <h2>Apprendre</h2>
      <ul>
        <?php foreach (levels() as $level): ?>
          <li><a href="<?= e(url('/ressources?niveau=' . ($level['short'] === 'C1/C2' ? 'C1' : $level['short']))) ?>">Niveau <?= e($level['short']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="<?= e(url('/apprenants')) ?>">Espace apprenants</a></li>
        <li><a href="<?= e(url('/ressources')) ?>">Toutes les ressources</a></li>
      </ul>
    </nav>

    <nav aria-label="Thématiques">
      <h2>Thématiques</h2>
      <ul>
        <?php foreach (themes() as $id => $theme): ?>
          <li><a href="<?= e(url('/ressources?theme=' . $id)) ?>"><?= e($theme['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div>
      <h2>La lettre du dimanche</h2>
      <p class="footer-lead">Une ressource, un exercice et un conseil pédagogique chaque semaine.</p>
      <form class="newsletter" method="post" action="<?= e(url('/api/newsletter')) ?>" data-newsletter novalidate>
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <label for="nl-email">Adresse e-mail</label>
        <input id="nl-email" name="email" type="email" required placeholder="prenom.nom@exemple.fr">
        <div class="newsletter-row">
          <span>
            <label for="nl-profile">Je suis</label>
            <select id="nl-profile" name="profile">
              <option value="apprenant">Apprenant</option>
              <option value="enseignant">Enseignant</option>
              <option value="formateur">Formateur</option>
            </select>
          </span>
          <span>
            <label for="nl-level">Niveau</label>
            <select id="nl-level" name="level">
              <?php foreach (levels() as $level): ?>
                <option value="<?= e(level_slug($level['short'])) ?>"><?= e($level['short']) ?></option>
              <?php endforeach; ?>
            </select>
          </span>
        </div>
        <button class="btn-accent" type="submit">S'abonner à la lettre</button>
        <p class="newsletter-status" role="status" aria-live="polite"></p>
      </form>
    </div>
  </div>

  <div class="wrap footer-bottom">
    <ul>
      <li><a href="<?= e(url('/plan-du-site')) ?>">Plan du site</a></li>
      <li><a href="<?= e(url('/mentions-legales')) ?>">Mentions légales</a></li>
      <li><a href="<?= e(url('/accessibilite')) ?>">Accessibilité WCAG 2.1 AA</a></li>
      <li><a href="<?= e(url('/plan-du-site#contact')) ?>">Contact</a></li>
    </ul>
    <p>© <?= date('Y') ?> <?= e(MLANGUE_NAME) ?> — <?= e(MLANGUE_AUTHOR) ?>. PHP <?= e(PHP_VERSION) ?>.</p>
  </div>
</footer>

<script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>
