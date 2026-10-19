<div class="wrap section narrow center">
  <p class="code-404">404</p>
  <h1 class="section-title">Cette page n'existe pas (encore)</h1>
  <p class="muted section-lead">La ressource recherchée a peut-être été déplacée.
  Reprenez votre parcours depuis le catalogue.</p>
  <div class="btn-row center">
    <a class="btn-primary" href="<?= e(url('/')) ?>">Retour à l'accueil</a>
    <a class="btn-ghost" href="<?= e(url('/ressources')) ?>">Voir toutes les ressources</a>
  </div>
  <?php if (($path ?? '/') !== '/'): ?>
    <p class="muted stats-line">Chemin demandé : <code><?= e((string) $path) ?></code></p>
  <?php endif; ?>
</div>
