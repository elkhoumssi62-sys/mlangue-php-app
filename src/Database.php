<?php
declare(strict_types=1);

/**
 * Mlangue.medelkhoumssi — connexion PDO multi-serveur.
 *
 * Ordre de résolution :
 *   1. MLANGUE_DSN (DSN PDO complet) + MLANGUE_USER / MLANGUE_PASS
 *   2. DATABASE_URL (PostgreSQL / MySQL) — format hébergeur
 *   3. SQLite local (aucune configuration nécessaire)
 *
 * Si aucun pilote PDO n'est disponible, la plateforme bascule en mode
 * « contenu » : le site reste consultable, seules les écritures sont ignorées.
 */
final class Database
{
    private static ?PDO $pdo = null;
    private static ?string $mode = null;

    public static function pdo(): ?PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $candidates = self::candidates();

        foreach ($candidates as $candidate) {
            try {
                $pdo = new PDO(
                    $candidate['dsn'],
                    $candidate['user'],
                    $candidate['pass'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
                self::$pdo  = $pdo;
                self::$mode = $candidate['mode'];
                return $pdo;
            } catch (Throwable $e) {
                error_log('[Mlangue] Connexion ' . $candidate['mode'] . ' impossible : ' . $e->getMessage());
            }
        }

        self::$mode = 'contenu';
        return null;
    }

    /** @return array<int, array{dsn:string, user:string, pass:string, mode:string}> */
    private static function candidates(): array
    {
        $list = [];

        $dsn  = mlangue_config('dsn');
        if ($dsn !== null) {
            $list[] = [
                'dsn'  => $dsn,
                'user' => (string) mlangue_config('user', ''),
                'pass' => (string) mlangue_config('pass', ''),
                'mode' => str_starts_with($dsn, 'pgsql') ? 'pgsql' : (str_starts_with($dsn, 'mysql') ? 'mysql' : 'pdo'),
            ];
        }

        $databaseUrl = getenv('DATABASE_URL') ?: '';
        if ($databaseUrl !== '') {
            $parts = parse_url($databaseUrl);
            if (is_array($parts) && isset($parts['host'], $parts['path'])) {
                $scheme = $parts['scheme'] ?? 'pgsql';
                $port   = (int) ($parts['port'] ?? ($scheme === 'mysql' ? 3306 : 5432));
                $db     = ltrim($parts['path'], '/');
                $user   = urldecode((string) ($parts['user'] ?? ''));
                $pass   = urldecode((string) ($parts['pass'] ?? ''));
                if (in_array($scheme, ['postgres', 'postgresql'], true)) {
                    $scheme = 'pgsql';
                }
                $list[] = [
                    'dsn'  => sprintf('%s:host=%s;port=%d;dbname=%s;charset=utf8', $scheme, $parts['host'], $port, $db),
                    'user' => $user,
                    'pass' => $pass,
                    'mode' => $scheme,
                ];
            }
        }

        $sqlitePath = mlangue_config('sqlite', app_root() . '/data/mlangue.sqlite');
        if (in_array('sqlite', PDO::getAvailableDrivers(), true)) {
            $dir = dirname((string) $sqlitePath);
            if (!is_dir($dir)) {
                @mkdir($dir, 0775, true);
            }
            $list[] = ['dsn' => 'sqlite:' . $sqlitePath, 'user' => '', 'pass' => '', 'mode' => 'sqlite'];
        }

        return $list;
    }

    public static function mode(): string
    {
        if (self::$mode === null) {
            self::pdo();
        }
        return self::$mode ?? 'contenu';
    }

    public static function writable(): bool
    {
        return self::pdo() instanceof PDO;
    }

    /** @return array<int, array<string, mixed>> */
    public static function all(string $sql, array $params = []): array
    {
        $pdo = self::pdo();
        if (!$pdo instanceof PDO) {
            return [];
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: [];
    }

    /** @return array<string, mixed>|null */
    public static function first(string $sql, array $params = []): ?array
    {
        $rows = self::all($sql, $params);
        return $rows[0] ?? null;
    }

    public static function scalar(string $sql, array $params = [], int $default = 0): int
    {
        $row = self::first($sql, $params);
        if ($row === null) {
            return $default;
        }
        $value = reset($row);
        return (int) $value;
    }

    public static function run(string $sql, array $params = []): bool
    {
        $pdo = self::pdo();
        if (!$pdo instanceof PDO) {
            return false;
        }
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public static function lastId(): int
    {
        $pdo = self::pdo();
        return $pdo instanceof PDO ? (int) $pdo->lastInsertId() : 0;
    }
}
