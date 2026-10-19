<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — contrôleurs des pages publiques.
 */

/* ----------------------------------------------------------------- accueil */

function page_home(): void
{
    $all       = Repository::resources();
    $featured  = Repository::resources(['limit' => 3]);
    $sheets    = Repository::teaching();
    $stats     = Repository::stats();

    $hero = null;
    foreach ($featured as $row) {
        if (!empty($row['featured'])) {
            $hero = $row;
            break;
        }
    }
    $hero = $hero ?? ($featured[0] ?? $all[0] ?? null);

    $themes      = themes();
    $themeCounts = [];
    foreach ($all as $row) {
        $themeCounts[$row['theme']] = ($themeCounts[$row['theme']] ?? 0) + 1;
    }

    render('home', [
        'hero'        => $hero,
        'resources'   => $all,
        'featured'    => $featured,
        'sheets'      => array_slice($sheets, 0, 3),
        'stats'       => $stats,
        'themes'      => $themes,
        'themeCounts' => $themeCounts,
    ], [
        'title'       => MLANGUE_NAME . ' — ' . MLANGUE_TAGLINE,
        'description' => 'Vidéos authentiques, exercices interactifs corrigés automatiquement et fiches pédagogiques : apprendre le FLE de A1 à C2 avec le prof EL KHOUMSSI.',
    ]);
}

/* --------------------------------------------------------------- catalogue */

function page_resources(): void
{
    $filters = [
        'level'    => query_value('niveau') ?: null,
        'theme'    => query_value('theme') ?: null,
        'audience' => query_value('public') ?: null,
        'q'        => query_value('q') ?: null,
    ];

    $resources = Repository::resources($filters);

    render('resources', [
        'resources' => $resources,
        'filters'   => $filters,
        'levels'    => levels(),
        'themes'    => themes(),
    ], [
        'title'       => 'Catalogue de ressources — ' . MLANGUE_MARK,
        'description' => 'Toutes les ressources FLE par niveau CECRL, thématique et public.',
    ]);
}

/* --------------------------------------------------------- page ressource */

function page_resource(string $slug): void
{
    $data = Repository::resource($slug);
    if ($data === null) {
        http_response_code(404);
        page_not_found('/ressources/' . $slug);
        return;
    }

    Repository::incrementViews($slug);

    $all      = Repository::resources();
    $others   = array_values(array_filter(
        $all,
        static fn(array $r): bool => $r['slug'] !== $slug && $r['level'] === $data['resource']['level']
    ));
    $sameLevel = $others;
    foreach ($all as $row) {
        if ($row['slug'] !== $slug && $row['level'] !== $data['resource']['level']) {
            $sameLevel[] = $row;
        }
    }

    render('resource', [
        'resource'    => $data['resource'],
        'exercises'   => $data['exercises'],
        'stats'       => Repository::resourceStats($slug),
        'suggestions' => array_slice($sameLevel, 0, 3),
    ], [
        'title'       => $data['resource']['title'] . ' — ' . MLANGUE_MARK,
        'description' => $data['resource']['excerpt'],
        'bodyClass'   => 'page-exercice',
        'extraHead'   => '<script>window.MLANGUE_SLUG = ' . json_encode($slug) . ';</script>'
            . '<script type="application/json" id="mlangue-exercises">'
            . json_encode(
                array_map(static fn(array $e): array => [
                    'id'          => $e['id'],
                    'type'        => $e['type'],
                    'title'       => $e['title'],
                    'skill'       => $e['skill'],
                    'instructions'=> $e['instructions'],
                    'explanation' => $e['explanation'],
                    'payload'     => $e['payload'],
                ], $data['exercises']),
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            )
            . '</script>',
    ]);
}

/* ---------------------------------------------------------------- espaces */

function page_learners(): void
{
    render('learners', [
        'resources' => array_slice(Repository::resources(), 0, 6),
        'stats'     => Repository::stats(),
        'levels'    => levels(),
        'types'     => exercise_types(),
    ], [
        'title'       => 'Espace apprenants — ' . MLANGUE_MARK,
        'description' => 'Progresser en français avec des vidéos, des exercices corrigés et un carnet de vocabulaire.',
    ]);
}

function page_teachers(): void
{
    render('teachers', [
        'sheets' => Repository::teaching(),
        'stats'  => Repository::stats(),
        'levels' => levels(),
        'themes' => themes(),
    ], [
        'title'       => 'Espace enseignants — ' . MLANGUE_MARK,
        'description' => 'Fiches pédagogiques téléchargeables, scénarios de classe minutés et conseils méthodologiques.',
    ]);
}

function page_search(): void
{
    $q         = query_value('q');
    $resources = $q !== '' ? Repository::resources(['q' => $q]) : [];
    $sheets    = $q !== '' ? Repository::teaching(['q' => $q]) : [];

    render('search', [
        'q'         => $q,
        'resources' => $resources,
        'sheets'    => $sheets,
    ], [
        'title' => 'Recherche — ' . MLANGUE_MARK,
    ]);
}

/* ------------------------------------------------------- pages annexes */

function page_sitemap(): void
{
    render('sitemap', [
        'resources' => Repository::resources(),
        'sheets'    => Repository::teaching(),
        'levels'    => levels(),
        'themes'    => themes(),
    ], [
        'title' => 'Plan du site — ' . MLANGUE_MARK,
    ]);
}

function page_legal(): void
{
    render('legal', [], ['title' => 'Mentions légales — ' . MLANGUE_MARK]);
}

function page_accessibility(): void
{
    render('accessibility', [], ['title' => 'Accessibilité — ' . MLANGUE_MARK]);
}

function page_not_found(string $path = '/'): void
{
    render('404', ['path' => $path], ['title' => 'Page introuvable — ' . MLANGUE_MARK]);
}
