<?php
/** @var array $resource @var array $exercises @var array $stats @var array $suggestions */
$level = level_meta((string) $resource['level']);
$theme = theme_meta((string) $resource['theme']);
?>
<div class="wrap section">
  <nav class="breadcrumb" aria-label="Fil d'Ariane">
    <ol>
      <li><a href="<?= e(url('/')) ?>">Accueil</a></li>
      <li aria-hidden="true">/</li>
      <li><a href="<?= e(url('/ressources')) ?>">Ressources</a></li>
      <li aria-hidden="true">/</li>
      <li aria-current="page"><?= e((string) $resource['title']) ?></li>
    </ol>
  </nav>

  <header class="resource-head">
    <div class="chip-row">
      <span class="chip <?= e($level['tint']) ?>">Niveau <?= e($level['short']) ?></span>
      <span class="chip"><?= e($theme['icon']) ?> <?= e($theme['label']) ?></span>
      <span class="chip">▶ <?= e((string) $resource['duration']) ?></span>
      <span class="chip">👁 <?= e(fr_number((int) $resource['views'])) ?></span>
    </div>
    <h1><?= e((string) $resource['title']) ?></h1>
    <p class="resource-lede"><?= e((string) $resource['subtitle']) ?></p>
  </header>

  <div class="resource-layout">
    <div class="resource-main">
      <figure class="player">
        <video id="mlangue-player" src="<?= e((string) $resource['media_url']) ?>"
               poster="<?= e((string) $resource['poster_url']) ?>" controls playsinline preload="metadata"
               aria-label="Lecteur vidéo : <?= e((string) $resource['title']) ?>">
          <track kind="captions" label="Français" srclang="fr">
          Votre navigateur ne prend pas en charge la lecture vidéo.
        </video>
        <figcaption>
          <span class="player-kind"><?= $resource['media_type'] === 'audio' ? 'Document audio' : 'Document vidéo' ?></span>
          <span class="player-tools">
            <label class="sr-only" for="player-speed">Vitesse de lecture</label>
            <select id="player-speed">
              <option value="0.5">0,5×</option>
              <option value="0.75">0,75×</option>
              <option value="1" selected>1×</option>
              <option value="1.25">1,25×</option>
              <option value="1.5">1,5×</option>
            </select>
            <label class="loop-label"><input type="checkbox" id="player-loop"> Lecture en boucle</label>
          </span>
        </figcaption>
      </figure>

      <div class="tabs" data-tabs>
        <div class="tablist" role="tablist" aria-label="Sections de la ressource">
          <button type="button" role="tab" id="tab-transcription" aria-controls="panel-transcription"
                  aria-selected="true" tabindex="0">Transcription</button>
          <button type="button" role="tab" id="tab-vocabulaire" aria-controls="panel-vocabulaire"
                  aria-selected="false" tabindex="-1">Vocabulaire <span class="tab-badge"><?= count((array) $resource['vocabulary']) ?></span></button>
          <button type="button" role="tab" id="tab-exercices" aria-controls="panel-exercices"
                  aria-selected="false" tabindex="-1">Exercices <span class="tab-badge"><?= count($exercises) ?></span></button>
          <?php if (!empty($resource['sheet'])): ?>
            <button type="button" role="tab" id="tab-fiche" aria-controls="panel-fiche"
                    aria-selected="false" tabindex="-1">Fiche enseignant</button>
          <?php endif; ?>
        </div>

        <div class="tabpanel" role="tabpanel" id="panel-transcription" aria-labelledby="tab-transcription">
          <div class="panel-hint">
            <p>Cliquez sur une réplique pour relancer la lecture à cet endroit.</p>
            <button type="button" class="btn-ghost btn-sm" data-seek="0">⏮ Revenir au début</button>
          </div>
          <ol class="transcript">
            <?php foreach ((array) $resource['transcript'] as $i => $line): ?>
              <li>
                <button type="button" data-seek="<?= (int) $line['t'] ?>" data-start="<?= (int) $line['t'] ?>">
                  <span class="timecode"><?= e(time_code((int) $line['t'])) ?></span>
                  <span class="transcript-body">
                    <span class="speaker"><?= e((string) $line['speaker']) ?></span>
                    <span class="utterance"><?= e((string) $line['text']) ?></span>
                  </span>
                </button>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>

        <div class="tabpanel" role="tabpanel" id="panel-vocabulaire" aria-labelledby="tab-vocabulaire" hidden>
          <div class="panel-hint">
            <p>Ajoutez les mots difficiles à votre carnet : il reste sur cet appareil.</p>
            <span class="chip tint-brand">📓 <span data-carnet-count>0</span> mot(s) dans mon carnet</span>
          </div>
          <ul class="vocab-grid">
            <?php foreach ((array) $resource['vocabulary'] as $item): ?>
              <li class="card vocab-item" data-term="<?= e((string) $item['term']) ?>">
                <button type="button" class="carnet-toggle" aria-pressed="false"
                        aria-label="Ajouter « <?= e((string) $item['term']) ?> » au carnet">☆</button>
                <div>
                  <p class="vocab-term"><?= e((string) $item['term']) ?></p>
                  <span class="chip"><?= e((string) $item['category']) ?></span>
                  <p class="muted vocab-def"><?= e((string) $item['definition']) ?></p>
                  <button type="button" class="link-reset vocab-more" aria-expanded="false">Voir un exemple</button>
                  <p class="vocab-example">« <?= e((string) $item['example']) ?> »</p>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="tabpanel" role="tabpanel" id="panel-exercices" aria-labelledby="tab-exercices" hidden>
          <div class="card progress-card">
            <div class="progress-info">
              <span>Progression</span>
              <span role="status" aria-live="polite" data-progress-label>0/<?= count($exercises) ?> exercices · 0/0 points</span>
            </div>
            <div class="progress-track" role="progressbar" aria-label="Score global"
                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-progress>
              <span data-progress-bar style="width:0%"></span>
            </div>
            <div class="btn-row">
              <button type="button" class="btn-primary" data-check-all>Tout vérifier</button>
              <button type="button" class="btn-ghost" data-reset-all>Recommencer</button>
            </div>
          </div>
          <p class="muted stats-line">
            <?php if ($stats['attempts'] > 0): ?>
              <?= e(fr_number($stats['attempts'])) ?> correction(s) enregistrée(s) · réussite moyenne <?= (int) $stats['average'] ?> %
            <?php else: ?>
              Soyez le premier à valider ces exercices : vos résultats sont enregistrés.
            <?php endif; ?>
          </p>
          <ol class="exercise-list" data-exercise-list>
            <?php foreach ($exercises as $index => $exercise): ?>
              <li class="card exercise" data-exercise="<?= (int) $exercise['id'] ?>" data-type="<?= e((string) $exercise['type']) ?>">
                <header class="exercise-head">
                  <div>
                    <div class="chip-row">
                      <?= exercise_badge_html((string) $exercise['type']) ?>
                      <span class="skill"><?= e((string) $exercise['skill']) ?></span>
                    </div>
                    <h3>Exercice <?= $index + 1 ?> — <?= e((string) $exercise['title']) ?></h3>
                    <p class="muted"><?= e((string) $exercise['instructions']) ?></p>
                  </div>
                  <p class="score" data-exercise-score hidden></p>
                </header>
                <div class="exercise-body" data-exercise-body></div>
                <footer class="exercise-foot">
                  <button type="button" class="btn-accent" data-check>Vérifier cet exercice</button>
                  <button type="button" class="btn-ghost" data-reset>Effacer</button>
                  <details class="explain">
                    <summary>Explication pédagogique</summary>
                    <p><?= e((string) $exercise['explanation']) ?></p>
                  </details>
                </footer>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>

        <?php if (!empty($resource['sheet']) && is_array($resource['sheet'])): ?>
          <?php $sheet = $resource['sheet']; $totalMinutes = 0;
          foreach ((array) $sheet['steps'] as $s) { $totalMinutes += (int) $s['minutes']; } ?>
          <div class="tabpanel" role="tabpanel" id="panel-fiche" aria-labelledby="tab-fiche" hidden>
            <div class="card panel-hint">
              <div>
                <p class="panel-hint-title">Fiche pédagogique prête pour la classe</p>
                <p class="muted"><?= e((string) $sheet['durationLabel']) ?> · <?= e((string) $sheet['audienceLabel']) ?></p>
              </div>
              <div class="btn-row no-print">
                <a class="btn-accent" href="<?= e(url('/api/fiches/' . $resource['slug'] . '?format=doc')) ?>">⤓ Télécharger (.doc)</a>
                <button type="button" class="btn-ghost" data-print>🖨 Imprimer / PDF</button>
              </div>
            </div>
            <div class="fiche-grid">
              <section class="card">
                <h3>Objectifs communicatifs</h3>
                <ul class="arrow-list">
                  <?php foreach ((array) $sheet['languagePoints'] as $point): ?>
                    <li><?= e((string) $point) ?></li>
                  <?php endforeach; ?>
                </ul>
                <h3>Matériel</h3>
                <ul class="tag-list">
                  <?php foreach ((array) $sheet['materials'] as $material): ?>
                    <li><?= e((string) $material) ?></li>
                  <?php endforeach; ?>
                </ul>
              </section>
              <section class="card">
                <h3>Déroulé minuté (<?= $totalMinutes ?> min)</h3>
                <ol class="steps-list">
                  <?php foreach ((array) $sheet['steps'] as $i => $step): ?>
                    <li>
                      <strong><?= e((string) $step['title']) ?> <span class="muted">· <?= (int) $step['minutes'] ?> min</span></strong>
                      <span class="muted"><?= e((string) $step['detail']) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ol>
              </section>
              <section class="card"><h3>Évaluation</h3><p class="muted"><?= e((string) $sheet['evaluation']) ?></p></section>
              <section class="card"><h3>Différenciation</h3><p class="muted"><?= e((string) $sheet['differentiation']) ?></p></section>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <aside class="resource-aside">
      <section class="card">
        <h2>Objectifs de la séquence</h2>
        <ul class="check-list">
          <?php foreach ((array) $resource['objectives'] as $objective): ?>
            <li><?= e((string) $objective) ?></li>
          <?php endforeach; ?>
        </ul>
      </section>

      <section class="card">
        <h2>Modules d'exercices</h2>
        <ul class="mini-list">
          <?php foreach ($exercises as $i => $exercise): ?>
            <li>
              <span class="mini-index"><?= $i + 1 ?></span>
              <span><?= e((string) $exercise['title']) ?></span>
              <span aria-hidden="true"><?= e(exercise_type_meta((string) $exercise['type'])['icon']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>

      <section class="card">
        <h2>Le document en bref</h2>
        <p class="muted"><?= e((string) $resource['description']) ?></p>
      </section>

      <section class="card">
        <h2>À suivre au même niveau</h2>
        <ul class="suggestions">
          <?php foreach ($suggestions as $s): ?>
            <li>
              <a href="<?= e(url('/ressources/' . $s['slug'])) ?>">
                <img src="<?= e((string) $s['poster_url']) ?>" alt="" loading="lazy">
                <span>
                  <strong><?= e((string) $s['title']) ?></strong>
                  <small><?= e(level_meta((string) $s['level'])['short']) ?> · <?= e((string) $s['duration']) ?></small>
                </span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </aside>
  </div>
</div>
