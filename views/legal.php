<div class="wrap section narrow">
  <h1 class="section-title">Mentions légales</h1>
  <div class="legal">
    <section>
      <h2>Éditeur</h2>
      <p><strong><?= e(MLANGUE_NAME) ?></strong> est la plateforme pédagogique conçue par
      <?= e(MLANGUE_AUTHOR) ?> pour l'apprentissage du français langue étrangère.
      Contact : <?= e(MLANGUE_EMAIL) ?></p>
    </section>
    <section>
      <h2>Hébergement</h2>
      <p>Application PHP <?= e(PHP_VERSION) ?>. Les contenus pédagogiques sont enregistrés dans une base
      de données (PostgreSQL, MySQL ou SQLite selon l'hébergement). Le mode de stockage actif est :
      <strong><?= e(Repository::mode()) ?></strong>.</p>
    </section>
    <section>
      <h2>Données personnelles</h2>
      <p>Seules l'adresse e-mail et le profil déclarés dans le formulaire d'abonnement à la lettre
      hebdomadaire sont conservés, ainsi que les scores d'exercices de façon anonyme. Vous pouvez
      demander la suppression de vos données par e-mail.</p>
    </section>
    <section>
      <h2>Propriété intellectuelle</h2>
      <p>Les documents authentiques, transcriptions et fiches pédagogiques sont mis à disposition à des
      fins exclusivement éducatives, en usage classe. Les visuels proviennent de banques d'images libres
      de droits.</p>
    </section>
    <section>
      <h2>Crédits</h2>
      <p>Direction éditoriale et conception pédagogique : <?= e(MLANGUE_AUTHOR) ?>.</p>
    </section>
  </div>
</div>
