-- ===========================================================================
-- Mlangue.medelkhoumssi — schéma de la base de données
-- Le préfixe ml_ évite toute collision avec d'autres applications partagées.
--
-- L'application crée et alimente ces tables automatiquement au premier appel
-- (Repository::install()). Ce fichier est fourni pour un déploiement manuel ou
-- une installation sur un hébergement où le compte SQL n'a pas le droit CREATE.
-- ===========================================================================

-- ---------------------------------------------------------------- ressources
CREATE TABLE IF NOT EXISTS ml_resources (
    id            BIGSERIAL PRIMARY KEY,
    slug          VARCHAR(180) NOT NULL UNIQUE,
    title         TEXT NOT NULL,
    subtitle      TEXT NOT NULL,
    level         VARCHAR(4)  NOT NULL,             -- A1 | A2 | B1 | B2 | C1
    theme         VARCHAR(32) NOT NULL,             -- culture | actualite | ...
    audience      VARCHAR(16) NOT NULL DEFAULT 'tous',
    media_type    VARCHAR(10) NOT NULL DEFAULT 'video',
    media_url     TEXT NOT NULL,
    poster_url    TEXT NOT NULL,
    duration      VARCHAR(24) NOT NULL,
    seconds       INT NOT NULL DEFAULT 0,
    excerpt       TEXT NOT NULL,
    description   TEXT NOT NULL,
    objectives    TEXT NOT NULL,                    -- JSON : ["...", "..."]
    transcript    TEXT NOT NULL,                    -- JSON : [{t,speaker,text}]
    vocabulary    TEXT NOT NULL,                    -- JSON : [{term,definition,...}]
    sheet         TEXT NULL,                        -- JSON : fiche pédagogique
    featured      SMALLINT NOT NULL DEFAULT 0,
    views         INT NOT NULL DEFAULT 0,
    published_at  VARCHAR(32) NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_ml_resources_level ON ml_resources (level);
CREATE INDEX IF NOT EXISTS idx_ml_resources_theme ON ml_resources (theme);

-- ------------------------------------------------------------------ exercices
-- Le champ payload contient la structure de l'exercice en JSON :
--   qcm             -> { questions: [{ text, options: [{text,correct,feedback}] }] }
--   texte-trous     -> { text, blanks: [{answers,hint,explanation}], wordBank }
--   glisser-deposer -> { categories: [{id,label,hint}], items: [{id,text,categoryId}] }
--   reordonner      -> { items: [{id,text}], explanation }
CREATE TABLE IF NOT EXISTS ml_exercises (
    id            BIGSERIAL PRIMARY KEY,
    resource_slug VARCHAR(180) NOT NULL,
    position      INT NOT NULL DEFAULT 1,
    type          VARCHAR(20) NOT NULL,
    title         TEXT NOT NULL,
    instructions  TEXT NOT NULL,
    skill         VARCHAR(60) NOT NULL,
    explanation   TEXT NOT NULL,
    payload       TEXT NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_ml_exercises_slug ON ml_exercises (resource_slug, position);

-- ------------------------------------------------------ fiches pédagogiques
CREATE TABLE IF NOT EXISTS ml_teaching (
    id          BIGSERIAL PRIMARY KEY,
    slug        VARCHAR(180) NOT NULL UNIQUE,
    title       TEXT NOT NULL,
    level       VARCHAR(4) NOT NULL,
    theme       VARCHAR(32) NOT NULL,
    format      VARCHAR(10) NOT NULL DEFAULT 'PDF',
    duration    VARCHAR(24) NOT NULL,
    description TEXT NOT NULL,
    objectives  TEXT NOT NULL,   -- JSON
    steps       TEXT NOT NULL,   -- JSON : [{title,detail,minutes}]
    downloads   INT NOT NULL DEFAULT 0
);

-- ------------------------------------------------- résultats des apprenants
CREATE TABLE IF NOT EXISTS ml_attempts (
    id            BIGSERIAL PRIMARY KEY,
    resource_slug VARCHAR(180) NOT NULL,
    exercise_id   INT NOT NULL,
    exercise_type VARCHAR(20) NOT NULL,
    correct       INT NOT NULL DEFAULT 0,
    total         INT NOT NULL DEFAULT 0,
    created_at    VARCHAR(32) NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_ml_attempts_slug ON ml_attempts (resource_slug);

-- ---------------------------------------------------- lettre d'information
CREATE TABLE IF NOT EXISTS ml_newsletter (
    id         BIGSERIAL PRIMARY KEY,
    email      VARCHAR(240) NOT NULL UNIQUE,
    profile    VARCHAR(20) NOT NULL DEFAULT 'apprenant',
    level      VARCHAR(8) NULL,
    created_at VARCHAR(32) NOT NULL
);
