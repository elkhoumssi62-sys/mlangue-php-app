<?php
/** @var array $resources @var array $sheets @var array $levels @var array $themes */
$nodes = [
    [
        'label' => 'Accueil',
        'href'  => '/',
        'note'  => "Hero à la une · filtre par niveau · thématiques · espace enseignants · modules d'exercices",
        'children' => [
            ['label' => "Bannière principale (ressource du jour)", 'note' => "appel à l'action « Commencer l'activité »"],
            ['label' => 'Par niveau CECRL', 'note' => 'cartes interactives filtrant le catalogue en direct'],
            ['label' => 'Thématiques & collections', 'note' => implode(' · ', array_column($themes, 'label'))],
            ['label' => 'Espace enseignants (aperçu)', 'note' => '3 fiches pédagogiques mises en avant'],
        ],
    ],
    [
        'label' => 'Ressources (catalogue)',
        'href'  => '/ressources',
        'note'  => 'recherche plein texte + filtres niveau / thématique / public',
        'children' => array_map(static function (array $r): array {
            return [
                'label' => (string) $r['title'],
                'href'  => '/ressources/' . $r['slug'],
                'note'  => 'Niveau ' . $r['level'] . ' · ' . $r['duration'],
                'children' => [
                    ['label' => 'Lecteur vidéo / audio', 'note' => 'vitesse, boucle, sous-titres'],
                    ['label' => 'Onglet Transcription', 'note' => 'clic sur une réplique = lecture synchronisée'],
                    ['label' => 'Onglet Vocabulaire', 'note' => 'carnet personnel persistant'],
                    ['label' => 'Onglet Exercices', 'note' => 'QCM · texte à trous · glisser-déposer · réordonnancement'],
                    ['label' => 'Onglet Fiche enseignant', 'note' => 'déroulé minuté + export Word / PDF'],
                ],
            ];
        }, $resources),
    ],
    [
        'label' => 'Espace apprenants',
        'href'  => '/apprenants',
        'note'  => 'parcours en 4 étapes, niveaux A1 → C1/C2, types d\'exercices',
        'children' => array_map(
            static fn(array $level): array => ['label' => 'Niveau ' . $level['short'], 'href' => '/ressources?niveau=' . level_slug($level['short'])],
            array_values($levels)
        ),
    ],
    [
        'label' => 'Espace enseignants',
        'href'  => '/enseignants',
        'note'  => 'conseils méthodologiques + fiches téléchargeables',
        'children' => array_map(
            static fn(array $s): array => ['label' => (string) $s['title'], 'href' => '#fiches', 'note' => $s['format'] . ' · ' . $s['duration'] . ' · ' . $s['downloads'] . ' téléchargements'],
            $sheets
        ),
    ],
    ['label' => 'Recherche', 'href' => '/recherche', 'note' => 'ressources + fiches pédagogiques'],
    ['label' => 'Plan du site', 'href' => '/plan-du-site', 'note' => 'cette page'],
    [
        'label' => 'Pages institutionnelles',
        'children' => [
            ['label' => 'Mentions légales', 'href' => '/mentions-legales'],
            ['label' => 'Accessibilité (WCAG 2.1 AA)', 'href' => '/accessibilite'],
        ],
    ],
    [
        'label' => 'API (données ouvertes)',
        'note'  => "points d'entrée utilisés par l'interface",
        'children' => [
            ['label' => 'GET /api/fiches/{slug}', 'note' => 'fiche téléchargeable (.doc)'],
            ['label' => 'POST /api/attempt', 'note' => 'enregistrement des résultats d\'exercices'],
            ['label' => 'POST /api/newsletter', 'note' => 'abonnement à la lettre hebdomadaire'],
        ],
    ],
];

if (!function_exists('sitemap_tree')) {
    function sitemap_tree(array $nodes, int $depth = 0): string
    {
    $html = '<ul class="sitemap-list">';
    foreach ($nodes as $node) {
        $html .= '<li><span class="sitemap-line">';
        if (!empty($node['href'])) {
            $html .= '<a href="' . e(url((string) $node['href'])) . '">' . e((string) $node['label']) . '</a>';
        } else {
            $html .= '<strong>' . e((string) $node['label']) . '</strong>';
        }
        if (!empty($node['note'])) {
            $html .= '<small> — ' . e((string) $node['note']) . '</small>';
        }
        $html .= '</span>';
        if (!empty($node['children'])) {
            $html .= sitemap_tree($node['children'], $depth + 1);
        }
        $html .= '</li>';
    }
    return $html . '</ul>';
    }
}
?>
<div class="wrap section">
  <p class="eyebrow">Architecture de l'information</p>
  <h1 class="section-title">Plan du site</h1>
  <p class="muted section-lead">L'arborescence suit la logique de l'apprenant : on entre par le niveau ou par la
  thématique, on arrive sur un document authentique, et l'onglet « Exercices » porte toujours la même interface.
  Les enseignants disposent d'un espace parallèle orienté préparation de classe.</p>

  <div id="contact" class="card sitemap-card"><?= sitemap_tree($nodes) ?></div>

  <section class="grid-3 block">
    <div class="card"><h2>Contact</h2><p class="muted">Équipe pédagogique : <?= e(MLANGUE_EMAIL) ?></p></div>
    <div class="card"><h2>Accessibilité</h2><p><a href="<?= e(url('/accessibilite')) ?>">Déclaration de conformité WCAG 2.1 AA →</a></p></div>
    <div class="card"><h2>Mentions légales</h2><p><a href="<?= e(url('/mentions-legales')) ?>">Éditeur, hébergement, données personnelles →</a></p></div>
  </section>
</div>
