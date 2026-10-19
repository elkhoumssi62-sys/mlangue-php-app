# Mlangue.medelkhoumssi

**La plateforme du prof EL KHOUMSSI pour apprendre et enseigner le français langue étrangère.**

Application PHP 8 — sans framework, sans dépendance Composer — reprenant intégralement
l'architecture et le design system de la plateforme : documents authentiques, transcription
synchronisée, lexique, exercices interactifs corrigés automatiquement et fiches pédagogiques
téléchargeables.

---

## 1. Prérequis

| Élément | Version minimale |
|---|---|
| PHP | 8.0 (8.2+ recommandé) |
| Extensions | `pdo`, `pdo_pgsql` **ou** `pdo_sqlite`, `mbstring`, `json`, `session` |
| Base de données | PostgreSQL, MySQL **ou** SQLite (aucune si SQLite) |

## 2. Installation rapide (développement)

```bash
cd mlangue-php
php -S localhost:8000 -t public
```

Puis ouvrez <http://localhost:8000>. La base est créée et alimentée automatiquement au
premier appel (tables `ml_*` + contenu éditorial).

## 3. Installation en production

1. Copier le dossier `mlangue-php/` sur l'hébergement.
2. Pointer le virtual host vers le dossier **`public/`** (seul dossier exposé).
3. Configurer l'accès à la base par variable d'environnement :

```bash
# PostgreSQL / MySQL (format hébergeur)
export DATABASE_URL="postgresql://user:pass@127.0.0.1:5432/mlangue"

# ou directement en DSN PDO
export MLANGUE_DSN="pgsql:host=127.0.0.1;port=5432;dbname=mlangue;charset=utf8"
export MLANGUE_USER="user"
export MLANGUE_PASS="pass"
```

Sans configuration, la plateforme bascule sur SQLite (`data/mlangue.sqlite`) puis, si aucun
pilote PDO n'est disponible, sur le mode « contenu » : le site reste consultable, seules les
écritures (scores, abonnements) sont ignorées.

### Apache

```apache
<VirtualHost *:80>
    ServerName mlangue-medelkhoumssi.test
    DocumentRoot /var/www/mlangue-php/public
    <Directory /var/www/mlangue-php/public>
        AllowOverride All
        Require all granted
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [QSA,L]
    </Directory>
    SetEnv DATABASE_URL "postgresql://user:pass@127.0.0.1:5432/mlangue"
</VirtualHost>
```

### Nginx + PHP-FPM

```nginx
root /var/www/mlangue-php/public;
index index.php;
location / { try_files $uri $uri/ /index.php?$query_string; }
location ~ \.php$ {
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

## 4. Variables d'environnement

| Variable | Rôle | Défaut |
|---|---|---|
| `DATABASE_URL` | URL de connexion (PostgreSQL / MySQL) | — |
| `MLANGUE_DSN` | DSN PDO complet (prioritaire) | — |
| `MLANGUE_USER` / `MLANGUE_PASS` | Identifiants SQL | — |
| `MLANGUE_SQLITE` | Chemin du fichier SQLite | `data/mlangue.sqlite` |
| `MLANGUE_BASE_PATH` | Sous-dossier de déploiement | auto-détecté |

## 5. Arborescence

```
mlangue-php/
├── public/                     ← seul dossier exposé au web
│   ├── index.php               contrôleur frontal (routage)
│   └── assets/
│       ├── css/styles.css      design system complet (clair + sombre)
│       └── js/app.js           exercices interactifs, onglets, transcription
├── src/
│   ├── bootstrap.php           amorçage + session + installation BDD
│   ├── config.php              constantes, configuration, chemins
│   ├── helpers.php             échappement, URLs, CECRL, vues, CSRF
│   ├── Database.php            PDO multi-serveur (PostgreSQL/MySQL/SQLite)
│   ├── Repository.php          accès données + installation + statistiques
│   ├── partials.php            composants (cartes ressources, fiches)
│   ├── pages.php               contrôleurs des pages publiques
│   ├── api.php                 points d'entrée API
│   ├── fiches.php              génération des fiches téléchargeables
│   └── content.php             contenu éditorial (ressources + exercices)
├── views/
│   ├── layout.php              en-tête, navigation, pied de page, newsletter
│   ├── home.php                accueil (hero, filtres, thématiques)
│   ├── resources.php           catalogue filtrable
│   ├── resource.php            page exercice (lecteur + 4 onglets)
│   ├── learners.php            espace apprenants
│   ├── teachers.php            espace enseignants
│   ├── search.php              recherche plein texte
│   ├── sitemap.php             plan du site
│   ├── legal.php · accessibility.php · 404.php
├── sql/schema.sql              schéma de référence (déploiement manuel)
└── README.md
```

## 6. Routes

| Méthode | Route | Rôle |
|---|---|---|
| GET | `/` | Accueil : hero, filtres par niveau, thématiques, enseignants |
| GET | `/ressources` | Catalogue (`?niveau=&theme=&public=&q=`) |
| GET | `/ressources/{slug}` | Page exercice (`?onglet=fiche`) |
| GET | `/apprenants` | Espace apprenants |
| GET | `/enseignants` | Espace enseignants |
| GET | `/recherche` | Recherche plein texte |
| GET | `/plan-du-site` | Arborescence complète |
| GET | `/mentions-legales` · `/accessibilite` | Pages institutionnelles |
| GET | `/api/fiches/{slug}?format=doc\|pdf` | Fiche pédagogique téléchargeable |
| POST | `/api/attempt` | Enregistrement d'un résultat d'exercice |
| POST | `/api/newsletter` | Abonnement à la lettre hebdomadaire |

## 7. Modules d'exercices

Les quatre modules sont rendus côté serveur et pilotés côté client par `assets/js/app.js` :

| Type | Payload JSON | Correction |
|---|---|---|
| `qcm` | `questions[].options[].correct` + `feedback` | immédiate, explication par item |
| `texte-trous` | `text` (trous `___`) + `blanks[].answers` | tolérante (accents, casse, ponctuation) |
| `glisser-deposer` | `categories` + `items[].categoryId` | par catégorie, version clavier |
| `reordonner` | `items[]` dans l'ordre attendu | position par position + solution |

Chaque validation envoie `POST /api/attempt` : les scores alimentent la table `ml_attempts`
et la statistique de réussite moyenne affichée sur la page.

## 8. Sécurité

- Échappement systématique par `e()` (`htmlspecialchars` + `ENT_QUOTES`).
- Requêtes **préparées** exclusivement (aucune concaténation SQL).
- Jeton CSRF de session pour les formulaires HTML.
- Session cookie `HttpOnly` + `SameSite=Lax`.
- Validation d'e-mail par `filter_var`, types bornés sur les entrées d'API.

## 9. Accessibilité

Conformité visée WCAG 2.1 niveau AA : lien d'évitement, navigation clavier complète
(onglets à flèches, glisser-déposer cliquable, réordonnancement à boutons), contrastes ≥ 4,5:1,
`aria-live` sur les messages d'état, respect de `prefers-reduced-motion`.

---

© Mlangue.medelkhoumssi — Prof. EL KHOUMSSI. Usage pédagogique.
