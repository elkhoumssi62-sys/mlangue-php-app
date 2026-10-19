<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — couche d'accès aux données.
 *
 * Deux sources possibles, avec la même forme de données en sortie :
 *   - la base (PostgreSQL / MySQL / SQLite) lorsque PDO est disponible ;
 *   - le fichier src/content.php en repli (mode « contenu »).
 */
final class Repository
{
    private static ?array $content = null;

    /* ------------------------------------------------------------ contenu */

    private static function content(): array
    {
        if (self::$content === null) {
            self::$content = (array) require app_root() . '/src/content.php';
        }
        return self::$content;
    }

    /** @return array<int, array<string, mixed>> */
    private static function contentResources(): array
    {
        return array_values(array_map(
            static fn(array $row, int $i): array => self::hydrate(
                [
                    'id'          => $i + 1,
                    'slug'        => $row['slug'],
                    'title'       => $row['title'],
                    'subtitle'    => $row['subtitle'],
                    'level'       => $row['level'],
                    'theme'       => $row['theme'],
                    'audience'    => $row['audience'],
                    'media_type'  => $row['mediaType'],
                    'media_url'   => $row['mediaUrl'],
                    'poster_url'  => $row['posterUrl'],
                    'duration'    => $row['durationLabel'],
                    'seconds'     => $row['durationSeconds'],
                    'excerpt'     => $row['excerpt'],
                    'description' => $row['description'],
                    'objectives'  => json_encode($row['objectives'], JSON_UNESCAPED_UNICODE),
                    'transcript'  => json_encode($row['transcript'], JSON_UNESCAPED_UNICODE),
                    'vocabulary'  => json_encode($row['vocabulary'], JSON_UNESCAPED_UNICODE),
                    'sheet'       => $row['teachingSheet'] !== null
                        ? json_encode($row['teachingSheet'], JSON_UNESCAPED_UNICODE)
                        : null,
                    'featured'    => (int) $row['featured'],
                    'views'       => (int) $row['views'],
                    'published_at'=> gmdate('c', time() - $i * 86400),
                ],
                $i + 1
            ),
            self::content()['resources'],
            array_keys(self::content()['resources'])
        ));
    }

    /** @return array<int, array<string, mixed>> */
    private static function contentExercises(string $slug): array
    {
        $out = [];
        $id = 1000;
        foreach (self::content()['resources'] as $resource) {
            if ($resource['slug'] !== $slug) {
                continue;
            }
            foreach ($resource['exercises'] as $position => $exercise) {
                $id++;
                $out[] = [
                    'id'           => $id,
                    'resource_slug'=> $slug,
                    'position'     => $position + 1,
                    'type'         => $exercise['type'],
                    'title'        => $exercise['title'],
                    'instructions' => $exercise['instructions'],
                    'skill'        => $exercise['skill'],
                    'explanation'  => $exercise['explanation'],
                    'payload'      => json_encode($exercise['payload'], JSON_UNESCAPED_UNICODE),
                ];
            }
        }
        return $out;
    }

    private static function hydrate(array $row, ?int $fallbackId = null): array
    {
        $row['id'] = (int) ($row['id'] ?? $fallbackId ?? 0);
        $row['objectives'] = self::decode((string) ($row['objectives'] ?? '[]'), []);
        $row['transcript'] = self::decode((string) ($row['transcript'] ?? '[]'), []);
        $row['vocabulary'] = self::decode((string) ($row['vocabulary'] ?? '[]'), []);
        $row['sheet']      = isset($row['sheet']) && $row['sheet'] !== null
            ? self::decode((string) $row['sheet'], null)
            : null;
        $row['featured']   = (bool) ($row['featured'] ?? false);
        $row['views']      = (int) ($row['views'] ?? 0);
        $row['seconds']    = (int) ($row['seconds'] ?? 0);
        return $row;
    }

    private static function decode(string $json, mixed $default): mixed
    {
        $decoded = json_decode($json, true);
        return $decoded === null ? $default : $decoded;
    }

    private static function decodeExercise(array $row): array
    {
        $payload = self::decode((string) $row['payload'], []);
        $row['id']       = (int) $row['id'];
        $row['position'] = (int) $row['position'];
        $row['payload']  = $payload;
        return $row;
    }

    /* ------------------------------------------------------- installation */

    public static function install(): void
    {
        if (!Database::writable()) {
            return;
        }

        $serial = Database::mode() === 'sqlite'
            ? 'INTEGER PRIMARY KEY AUTOINCREMENT'
            : 'BIGSERIAL PRIMARY KEY';
        $text   = Database::mode() === 'pgsql' ? 'TEXT' : 'LONGTEXT';

        Database::run("CREATE TABLE IF NOT EXISTS ml_resources (
            id {$serial},
            slug VARCHAR(180) NOT NULL UNIQUE,
            title {$text} NOT NULL,
            subtitle {$text} NOT NULL,
            level VARCHAR(4) NOT NULL,
            theme VARCHAR(32) NOT NULL,
            audience VARCHAR(16) NOT NULL DEFAULT 'tous',
            media_type VARCHAR(10) NOT NULL DEFAULT 'video',
            media_url {$text} NOT NULL,
            poster_url {$text} NOT NULL,
            duration VARCHAR(24) NOT NULL,
            seconds INT NOT NULL DEFAULT 0,
            excerpt {$text} NOT NULL,
            description {$text} NOT NULL,
            objectives {$text} NOT NULL,
            transcript {$text} NOT NULL,
            vocabulary {$text} NOT NULL,
            sheet {$text} NULL,
            featured SMALLINT NOT NULL DEFAULT 0,
            views INT NOT NULL DEFAULT 0,
            published_at VARCHAR(32) NOT NULL
        )");

        Database::run("CREATE TABLE IF NOT EXISTS ml_exercises (
            id {$serial},
            resource_slug VARCHAR(180) NOT NULL,
            position INT NOT NULL DEFAULT 1,
            type VARCHAR(20) NOT NULL,
            title {$text} NOT NULL,
            instructions {$text} NOT NULL,
            skill VARCHAR(60) NOT NULL,
            explanation {$text} NOT NULL,
            payload {$text} NOT NULL
        )");

        Database::run("CREATE TABLE IF NOT EXISTS ml_teaching (
            id {$serial},
            slug VARCHAR(180) NOT NULL UNIQUE,
            title {$text} NOT NULL,
            level VARCHAR(4) NOT NULL,
            theme VARCHAR(32) NOT NULL,
            format VARCHAR(10) NOT NULL,
            duration VARCHAR(24) NOT NULL,
            description {$text} NOT NULL,
            objectives {$text} NOT NULL,
            steps {$text} NOT NULL,
            downloads INT NOT NULL DEFAULT 0
        )");

        Database::run("CREATE TABLE IF NOT EXISTS ml_attempts (
            id {$serial},
            resource_slug VARCHAR(180) NOT NULL,
            exercise_id INT NOT NULL,
            exercise_type VARCHAR(20) NOT NULL,
            correct INT NOT NULL DEFAULT 0,
            total INT NOT NULL DEFAULT 0,
            created_at VARCHAR(32) NOT NULL
        )");

        Database::run("CREATE TABLE IF NOT EXISTS ml_newsletter (
            id {$serial},
            email VARCHAR(240) NOT NULL UNIQUE,
            profile VARCHAR(20) NOT NULL DEFAULT 'apprenant',
            level VARCHAR(8) NULL,
            created_at VARCHAR(32) NOT NULL
        )");

        self::seed();
    }

    private static function seed(): void
    {
        $content = self::content();

        if (Database::scalar('SELECT COUNT(*) FROM ml_resources') === 0) {
            foreach ($content['resources'] as $index => $row) {
                Database::run(
                    'INSERT INTO ml_resources
                     (slug, title, subtitle, level, theme, audience, media_type, media_url, poster_url,
                      duration, seconds, excerpt, description, objectives, transcript, vocabulary, sheet,
                      featured, views, published_at)
                     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                    [
                        $row['slug'], $row['title'], $row['subtitle'], $row['level'], $row['theme'],
                        $row['audience'], $row['mediaType'], $row['mediaUrl'], $row['posterUrl'],
                        $row['durationLabel'], $row['durationSeconds'], $row['excerpt'], $row['description'],
                        json_encode($row['objectives'], JSON_UNESCAPED_UNICODE),
                        json_encode($row['transcript'], JSON_UNESCAPED_UNICODE),
                        json_encode($row['vocabulary'], JSON_UNESCAPED_UNICODE),
                        $row['teachingSheet'] !== null
                            ? json_encode($row['teachingSheet'], JSON_UNESCAPED_UNICODE)
                            : null,
                        (int) $row['featured'], $row['views'],
                        gmdate('c', time() - $index * 86400),
                    ]
                );
            }
        }

        if (Database::scalar('SELECT COUNT(*) FROM ml_exercises') === 0) {
            foreach ($content['resources'] as $row) {
                foreach ($row['exercises'] as $position => $exercise) {
                    Database::run(
                        'INSERT INTO ml_exercises
                         (resource_slug, position, type, title, instructions, skill, explanation, payload)
                         VALUES (?,?,?,?,?,?,?,?)',
                        [
                            $row['slug'], $position + 1, $exercise['type'], $exercise['title'],
                            $exercise['instructions'], $exercise['skill'], $exercise['explanation'],
                            json_encode($exercise['payload'], JSON_UNESCAPED_UNICODE),
                        ]
                    );
                }
            }
        }

        if (Database::scalar('SELECT COUNT(*) FROM ml_teaching') === 0) {
            foreach ($content['teaching'] as $row) {
                Database::run(
                    'INSERT INTO ml_teaching
                     (slug, title, level, theme, format, duration, description, objectives, steps, downloads)
                     VALUES (?,?,?,?,?,?,?,?,?,?)',
                    [
                        $row['slug'], $row['title'], $row['level'], $row['theme'], $row['format'],
                        $row['durationLabel'], $row['description'],
                        json_encode($row['objectives'], JSON_UNESCAPED_UNICODE),
                        json_encode($row['steps'], JSON_UNESCAPED_UNICODE),
                        $row['downloads'],
                    ]
                );
            }
        }
    }

    /* ------------------------------------------------------------ lecture */

    /** @return array<int, array<string, mixed>> */
    public static function resources(array $f = []): array
    {
        if (!Database::writable()) {
            $rows = self::contentResources();
            return self::filterInMemory($rows, $f);
        }

        $where  = [];
        $params = [];
        if (!empty($f['level'])) {
            $where[] = 'level = ?';
            $params[] = $f['level'];
        }
        if (!empty($f['theme'])) {
            $where[] = 'theme = ?';
            $params[] = $f['theme'];
        }
        if (!empty($f['audience']) && $f['audience'] !== 'tous') {
            $where[] = '(audience = ? OR audience = ?)';
            $params[] = $f['audience'];
            $params[] = 'tous';
        }
        if (!empty($f['q'])) {
            $needle = '%' . $f['q'] . '%';
            $where[] = '(LOWER(title) LIKE ? OR LOWER(subtitle) LIKE ? OR LOWER(excerpt) LIKE ? OR LOWER(description) LIKE ?)';
            array_push($params, strtolower($needle), strtolower($needle), strtolower($needle), strtolower($needle));
        }

        $sql = 'SELECT * FROM ml_resources' . ($where ? ' WHERE ' . implode(' AND ', $where) : '')
             . ' ORDER BY featured DESC, published_at DESC';
        if (!empty($f['limit'])) {
            $sql .= Database::mode() === 'mysql' ? ' LIMIT ' . (int) $f['limit'] : ' LIMIT ' . (int) $f['limit'];
        }

        $rows = array_map(
            static fn(array $row): array => self::hydrate($row),
            Database::all($sql, $params)
        );

        return self::filterInMemory($rows, $f);
    }

    /** @param array<int, array<string, mixed>> $rows */
    private static function filterInMemory(array $rows, array $f): array
    {
        if (!empty($f['q']) && Database::writable()) {
            $needle = mb_strtolower((string) $f['q'], 'UTF-8');
            $rows = array_values(array_filter(
                $rows,
                static fn(array $r): bool => str_contains(
                    mb_strtolower($r['title'] . ' ' . $r['subtitle'] . ' ' . $r['excerpt'] . ' ' . $r['description'], 'UTF-8'),
                    $needle
                )
            ));
        }
        if (!empty($f['level']) && Database::writable()) {
            $rows = array_values(array_filter($rows, static fn(array $r): bool => $r['level'] === $f['level']));
        }
        if (!empty($f['theme']) && Database::writable()) {
            $rows = array_values(array_filter($rows, static fn(array $r): bool => $r['theme'] === $f['theme']));
        }
        // Mode « contenu » : on reproduit le tri SQL (à la une d'abord, plus récent ensuite).
        if (!Database::writable()) {
            usort($rows, static function (array $a, array $b): int {
                if ($a['featured'] !== $b['featured']) {
                    return $b['featured'] ? 1 : -1;
                }
                return strcmp((string) $b['published_at'], (string) $a['published_at']);
            });
        }
        if (!empty($f['limit'])) {
            $rows = array_slice($rows, 0, (int) $f['limit']);
        }
        return $rows;
    }

    public static function resource(string $slug): ?array
    {
        if (!Database::writable()) {
            foreach (self::contentResources() as $row) {
                if ($row['slug'] === $slug) {
                    return ['resource' => $row, 'exercises' => self::exercisesFallback($slug)];
                }
            }
            return null;
        }

        $row = Database::first('SELECT * FROM ml_resources WHERE slug = ?', [$slug]);
        if ($row === null) {
            return null;
        }

        $exercises = array_map(
            static fn(array $e): array => self::decodeExercise($e),
            Database::all('SELECT * FROM ml_exercises WHERE resource_slug = ? ORDER BY position ASC', [$slug])
        );

        return [
            'resource'  => self::hydrate($row),
            'exercises' => $exercises ?: self::exercisesFallback($slug),
        ];
    }

    /** @return array<int, array<string, mixed>> */
    private static function exercisesFallback(string $slug): array
    {
        return array_map(
            static fn(array $e): array => self::decodeExercise($e),
            self::contentExercises($slug)
        );
    }

    /** @return array<int, array<string, mixed>> */
    public static function teaching(array $f = []): array
    {
        if (!Database::writable()) {
            $rows = array_map(
                static fn(array $row, int $i): array => [
                    'id'          => $i + 1,
                    'slug'        => $row['slug'],
                    'title'       => $row['title'],
                    'level'       => $row['level'],
                    'theme'       => $row['theme'],
                    'format'      => $row['format'],
                    'duration'    => $row['durationLabel'],
                    'description' => $row['description'],
                    'objectives'  => $row['objectives'],
                    'steps'       => $row['steps'],
                    'downloads'   => $row['downloads'],
                ],
                self::content()['teaching'],
                array_keys(self::content()['teaching'])
            );
            if (!empty($f['level'])) {
                $rows = array_values(array_filter($rows, static fn(array $r): bool => $r['level'] === $f['level']));
            }
            return $rows;
        }

        $where  = [];
        $params = [];
        if (!empty($f['level'])) {
            $where[]  = 'level = ?';
            $params[] = $f['level'];
        }
        if (!empty($f['q'])) {
            $where[]  = 'LOWER(title) LIKE ?';
            $params[] = '%' . mb_strtolower((string) $f['q'], 'UTF-8') . '%';
        }

        $rows = Database::all(
            'SELECT * FROM ml_teaching' . ($where ? ' WHERE ' . implode(' AND ', $where) : '') . ' ORDER BY downloads DESC',
            $params
        );

        return array_map(static function (array $row): array {
            $row['id']         = (int) $row['id'];
            $row['downloads']  = (int) $row['downloads'];
            $row['objectives'] = self::decode((string) $row['objectives'], []);
            $row['steps']      = self::decode((string) $row['steps'], []);
            return $row;
        }, $rows);
    }

    public static function teachingSheet(string $slug): ?array
    {
        foreach (self::teaching() as $row) {
            if ($row['slug'] === $slug) {
                return $row;
            }
        }
        return null;
    }

    public static function stats(): array
    {
        $resources = self::resources();
        $exercises = 0;
        foreach (self::content()['resources'] as $row) {
            $exercises += count($row['exercises']);
        }
        $seconds = array_sum(array_map(static fn(array $r): int => (int) $r['seconds'], $resources));

        return [
            'resources'  => count($resources),
            'exercises'  => max($exercises, Database::writable() ? Database::scalar('SELECT COUNT(*) FROM ml_exercises') : 0),
            'sheets'     => count(self::teaching()),
            'minutes'    => (int) round($seconds / 60),
            'attempts'   => Database::writable() ? Database::scalar('SELECT COUNT(*) FROM ml_attempts') : 0,
            'mode'       => Database::mode(),
        ];
    }

    public static function resourceStats(string $slug): array
    {
        if (!Database::writable()) {
            return ['attempts' => 0, 'average' => 0];
        }
        $row = Database::first(
            'SELECT COUNT(*) AS n, COALESCE(AVG(CASE WHEN total > 0 THEN correct * 100.0 / total ELSE 0 END), 0) AS avg
             FROM ml_attempts WHERE resource_slug = ?',
            [$slug]
        );
        return [
            'attempts' => (int) ($row['n'] ?? 0),
            'average'  => (int) round((float) ($row['avg'] ?? 0)),
        ];
    }

    /* ------------------------------------------------------------ écriture */

    public static function recordAttempt(array $in): bool
    {
        if (!Database::writable()) {
            return false;
        }
        return Database::run(
            'INSERT INTO ml_attempts (resource_slug, exercise_id, exercise_type, correct, total, created_at)
             VALUES (?,?,?,?,?,?)',
            [
                (string) $in['resource_slug'],
                (int) $in['exercise_id'],
                (string) $in['exercise_type'],
                max(0, (int) $in['correct']),
                max(0, (int) $in['total']),
                gmdate('c'),
            ]
        );
    }

    /** @return array{ok:bool, already:bool, error?:string} */
    public static function subscribe(string $email, string $profile, string $level): array
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['ok' => false, 'already' => false, 'error' => 'Adresse e-mail invalide.'];
        }
        if (!Database::writable()) {
            return ['ok' => true, 'already' => false];
        }
        try {
            $existing = Database::first('SELECT id FROM ml_newsletter WHERE email = ?', [mb_strtolower($email, 'UTF-8')]);
            if ($existing !== null) {
                return ['ok' => true, 'already' => true];
            }
            Database::run(
                'INSERT INTO ml_newsletter (email, profile, level, created_at) VALUES (?,?,?,?)',
                [mb_strtolower($email, 'UTF-8'), $profile, $level, gmdate('c')]
            );
            return ['ok' => true, 'already' => false];
        } catch (Throwable $e) {
            error_log('[Mlangue] Abonnement impossible : ' . $e->getMessage());
            return ['ok' => false, 'already' => false, 'error' => 'Enregistrement impossible pour le moment.'];
        }
    }

    public static function incrementViews(string $slug): void
    {
        if (!Database::writable()) {
            return;
        }
        Database::run('UPDATE ml_resources SET views = views + 1 WHERE slug = ?', [$slug]);
    }

    public static function incrementDownloads(string $slug): void
    {
        if (!Database::writable()) {
            return;
        }
        Database::run('UPDATE ml_teaching SET downloads = downloads + 1 WHERE slug = ?', [$slug]);
    }
}
