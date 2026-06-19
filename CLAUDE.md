# CLAUDE.md — Contexte module oblyon

## Aperçu (Overview)

`oblyon` est un module externe Dolibarr de thème graphique et de personnalisation de l'interface utilisateur :

- thème CSS complet remplaçant le thème Dolibarr par défaut (eldy),
- gestionnaire de menus personnalisé (top, left, inversé, réduit),
- personnalisation avancée des couleurs (menus, boutons, messages, dashboard, lignes),
- sélection de packs d'icônes FontAwesome (Free/Pro),
- options de layout (sticky bars, menu caché/réduit, effets slide/push),
- personnalisation du dashboard (couleurs infobox, activation/désactivation des blocs),
- éditeur CSS personnalisé intégré (avec support CKEditor/Ace),
- compatibilité Easya.

Informations module (issues du code et du changelog local) :

- Éditeur : Inovea Conseil (Alexandre Spangaro)
- Contributeur : InfraS (Sylvain Legrand)
- Numéro module : `432573`
- Licence : GPL v3+
- Compatibilité Dolibarr : `18.0.0` à `23.0.x`
- Compatibilité PHP : `7.1` à `8.4`
- Dernière version locale : `3.2.0` (2026-06)
- Dépendances obligatoires : aucune
- Conflits : `modQuickUX`
- Emplacement : `htdocs/custom/oblyon/`

Convention de lecture du descripteur :

- Explications fonctionnelles en français
- Identifiants techniques conservés en anglais (`hooks`, classes, méthodes, constantes, clés de configuration)

## Structure (Summary)

```text
htdocs/custom/oblyon/
├── CLAUDE.md
├── CHANGELOG.md
├── README.md
├── VERSION
├── license.txt
├── metapackage.conf
├── .easya_info.json
├── admin/
│   ├── about.php              # Page À propos / Support
│   ├── changelog.php          # Page Changelog (Parsedown)
│   ├── colors.php             # Configuration des couleurs (~100 constantes)
│   ├── customcss.php          # Éditeur CSS personnalisé (Ace/CKEditor)
│   ├── dashboard.php          # Configuration du dashboard (infobox, blocs)
│   ├── icons.php              # Sélection pack FontAwesome
│   ├── menus.php              # Configuration des menus (inversé, réduit, effets)
│   └── options.php            # Options générales (police, taille, comportement)
├── backport/
│   └── v21/                   # Backport fonctions Dolibarr v21
├── class/
│   └── actions_oblyon.class.php   # Hook class (contexte main, quasi vide)
├── config.php                 # Chargeur main.inc.php standard
├── core/
│   ├── menus/
│   │   └── standard/
│   │       ├── oblyon_menu.php     # Gestionnaire de menus (MenuManager)
│   │       └── oblyon.lib.php      # Bibliothèque menus (~2400 lignes)
│   └── modules/
│       └── modOblyon.class.php     # Descripteur module
├── css/
│   ├── oblyon.css             # CSS module admin
│   ├── as_style.min.css       # CSS minifié complémentaire
│   └── font.css               # Polices personnalisées
├── img/                       # Images (logos, thèmes, icônes FA)
├── includes/
│   └── parsedown/             # Bibliothèque Parsedown (Markdown → HTML)
├── js/
│   ├── oblyon.js              # JS module (mode tactile des menus : tap-to-toggle)
│   ├── pushy.js               # Effet push menu latéral
│   ├── jscolor.js             # Sélecteur de couleurs
│   └── range-slider.js        # Curseur de plage
├── langs/
│   ├── en_US/oblyon.lang
│   ├── fr_FR/oblyon.lang
│   ├── fr_FR/inovea.lang
│   └── fr_FR/oldauthors.lang
├── lib/
│   ├── oblyon.lib.php         # Bibliothèque admin (onglets, backup/restore, helpers HTML)
│   └── inovea_common.lib.php  # Fonctions communes Inovea (changelog Parsedown)
├── sql/
│   └── data.sql               # Constantes initiales (~120 INSERT)
└── themeoblyon/               # Répertoire du thème CSS
    ├── style.css.php          # Point d'entrée CSS (~344 lignes)
    ├── global.inc.php         # Feuille de style principale (~11000 lignes)
    ├── custom.css.php         # CSS personnalisé utilisateur
    ├── theme_vars.inc.php     # Variables du thème (couleurs, polices)
    ├── font.css               # Polices embarquées
    ├── manifest.json.php      # Manifeste PWA dynamique
    ├── graph-color.php        # Couleurs des graphiques
    ├── badges.inc.php         # Styles badges
    ├── btn.inc.php            # Styles boutons
    ├── dropdown.inc.php       # Styles dropdown
    ├── touchmenu.inc.php      # Styles mode tactile des menus (classe .is-touch-open)
    ├── info-box.inc.php       # Styles infobox dashboard
    ├── login.inc.php          # Styles page de connexion
    ├── main_menu_fa_icons.inc.php  # Icônes FA menus
    ├── modules.inc.php        # Styles pages modules
    ├── modules/               # Extensions CSS modules externes
    │   ├── quicklist.inc.php
    │   ├── scaninvoices.inc.php
    │   └── subtotal.inc.php
    ├── progress.inc.php       # Styles barres de progression
    ├── timeline.inc.php       # Styles timeline
    ├── tpl/                   # Templates
    ├── img/                   # Images du thème
    └── fonts/                 # Polices du thème
```

## Descripteur module (Module descriptor : `modOblyon`)

Dans `core/modules/modOblyon.class.php` :

- **Module parts** :
	- `menus` : gestionnaire de menus Oblyon
	- `hooks` : contexte `main` (entité `0`, toutes les pages)
	- JS : `/oblyon/js/pushy.js`, `/oblyon/js/oblyon.js` (mode tactile)
	- CSS : `/oblyon/css/oblyon.css`, `/theme/oblyon/custom.css.php`, `/oblyon/css/font.css`
- **Dépendances** : aucune
- **Conflits** : `modQuickUX`
- **Dictionnaires** : aucun
- **Boxes** : aucune
- **Cron** : aucune tâche
- **Permissions** : aucune (accès réservé aux administrateurs via `$user->admin`)
- **Menus** : aucun (gérés directement par le `MenuManager` Oblyon)

### Initialisation (Lifecycle : `init()`)

`init()` effectue :

1. Chargement SQL (`_load_tables('/oblyon/sql/')`)
2. Restauration des constantes module (`oblyon_restore_module`)
3. Détection du répertoire FontAwesome le plus récent (`fontawesome-N`) et enregistrement dans `MAIN_FONTAWESOME_DIRECTORY`
4. Suppression des anciens fichiers menu manager du core (`core/menus/standard/oblyon_menu.php`, `oblyon.lib.php`)
5. Activation du thème Oblyon (`MAIN_THEME` = `oblyon`)
6. Restauration de `MAIN_MENU_INVERT` depuis sauvegarde
7. Suppression de `OBLYON_SHOW_COMPNAME` (incompatible menu inversé)

### Désactivation (Lifecycle : `remove()`)

`remove()` effectue :

- Sauvegarde module (`oblyon_bkup_module`)
- Restauration du thème par défaut (`MAIN_THEME` = `eldy`)
- Sauvegarde de `MAIN_MENU_INVERT` pour restauration future
- Nettoyage des constantes de menus forcés (`MAIN_MENU*_FORCED`)
- Nettoyage des constantes `THEME_ELDY_*` (couleurs Dolibarr)
- Nettoyage des constantes FontAwesome (`MAIN_FONTAWESOME_*`)

## Fonctionnement principal (Core behavior)

Le module s'appuie sur :

- `modOblyon.class.php` pour l'activation/désactivation du thème et la gestion du cycle de vie,
- `oblyon_menu.php` (`MenuManager`) pour le gestionnaire de menus complet (top + left),
- `oblyon.lib.php` (lib menus, ~2400 lignes) pour la construction des entrées de menus,
- `oblyon.lib.php` (lib admin) pour les onglets d'administration, backup/restore et helpers HTML,
- `inovea_common.lib.php` pour l'affichage du changelog via Parsedown,
- `actions_oblyon.class.php` pour les hooks (actuellement quasi vide, hook `addHtmlHeader` commenté),
- `themeoblyon/` pour l'ensemble du rendu CSS.

### Architecture du thème

Le thème est structuré en plusieurs couches :

1. **`style.css.php`** : point d'entrée principal, charge `theme_vars.inc.php` puis inclut tous les fichiers `.inc.php`
2. **`theme_vars.inc.php`** : lit les constantes `OBLYON_*` et `THEME_ELDY_*` pour définir les variables PHP utilisées dans le CSS
3. **`global.inc.php`** : feuille de style principale (~11000 lignes), définit les variables CSS `:root` et l'ensemble des règles
4. **Fichiers `.inc.php` spécialisés** : badges, boutons, dropdowns, infobox, login, menus FA, modules, progress, timeline
5. **`custom.css.php`** : CSS personnalisé saisi par l'utilisateur (constante `OBLYON_CUSTOM_CSS`)

### Gestionnaire de menus

Le module remplace le gestionnaire de menus standard de Dolibarr :

- Classe `MenuManager` dans `oblyon_menu.php`
- Force les constantes `MAIN_MENU_STANDARD_FORCED`, `MAIN_MENUFRONT_STANDARD_FORCED`, `MAIN_MENU_SMARTPHONE_FORCED` → `oblyon_menu.php`
- Support du mode inversé (`MAIN_MENU_INVERT`) : le menu gauche passe en barre horizontale en haut
- Support du menu réduit (`OBLYON_REDUCE_LEFTMENU`) avec effets hover
- Support du menu caché (`OBLYON_HIDE_LEFTMENU`) avec effets slide/push (`OBLYON_EFFECT_LEFTMENU`)
- Bibliothèque complète des entrées de menus dans `oblyon.lib.php` (~2400 lignes) couvrant tous les modules Dolibarr

## Hooks et comportement (Hook behavior)

La classe `ActionsOblyon` (dans `class/actions_oblyon.class.php`) est actuellement quasi vide :

- Contexte déclaré : `main` (toutes les pages, entité `0`)
- Hook `addHtmlHeader()` commenté (injectait le CSS personnalisé `OBLYON_CUSTOM_CSS`)
- La logique CSS personnalisé est désormais gérée directement par `custom.css.php` dans le thème

## Données / SQL (Data model)

Le module ne crée aucune table SQL propre. Toute la configuration est stockée dans `llx_const`.

Fichier SQL :

- `data.sql` : ~120 constantes initiales couvrant toutes les catégories de personnalisation

Le mécanisme de backup/restore sauvegarde et restaure les constantes `OBLYON_*`, `THEME_*`, `MAIN_*`, `FIX_*`, `DISABLE_*` dans `DOL_DATA_ROOT/<entity>/oblyon/sql/update.<entity>`.

## Constantes de configuration (Key settings)

Le module utilise un grand nombre de constantes (~120) organisées par catégorie :

### Menus

| Constante | Description | Valeur par défaut |
|-----------|-------------|-------------------|
| `MAIN_MENU_INVERT` | Menu inversé (horizontal) | `0` |
| `OBLYON_FULLSIZE_TOPBAR` | Barre supérieure pleine largeur | `0` |
| `MAIN_SHOW_LOGO` | Afficher le logo dans le menu | `0` |
| `OBLYON_STICKY_TOPBAR` | Barre supérieure collante | `0` |
| `OBLYON_HIDE_TOPICONS` | Masquer les icônes du menu supérieur | `0` |
| `OBLYON_STICKY_LEFTBAR` | Menu gauche collant | `0` |
| `OBLYON_HIDE_LEFTMENU` | Masquer le menu gauche | `0` |
| `OBLYON_EFFECT_LEFTMENU` | Effet du menu caché (`slide`/`push`) | `slide` |
| `OBLYON_HIDE_LEFTICONS` | Masquer les icônes du menu gauche | `0` |
| `OBLYON_REDUCE_LEFTMENU` | Réduire le menu gauche | `0` |
| `OBLYON_EFFECT_REDUCE_LEFTMENU` | Effet du menu réduit (`only`/`hover`) | `only` |
| `OBLYON_TOUCH_MENU` | Forcer le mode tactile des menus (tap-to-toggle) | `0` |

### Couleurs — Menus

- `OBLYON_COLOR_TOPMENU_BCKGRD`, `_BCKGRD_HOVER`, `_TXT`, `_TXT_ACTIVE`, `_TXT_HOVER`
- `OBLYON_COLOR_LEFTMENU_BCKGRD`, `_BCKGRD_HOVER`, `_TXT`, `_TXT_ACTIVE`, `_TXT_HOVER`

### Couleurs — Boutons

- `OBLYON_COLOR_BUTTON_ACTION1`, `_ACTION2`, `_DELETE1`, `_DELETE2`

### Couleurs — Messages

- `OBLYON_COLOR_INFO_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_WARNING_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_ERROR_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_NOTIF_*_BCKGRD`, `_TEXT` (info, warning, error)

### Couleurs — Options générales

- `OBLYON_COLOR_MAIN`, `_BCKGRD`, `_LOGO_BCKGRD`, `_LOGIN_BCKGRD`
- `OBLYON_COLOR_BTITLE`, `_FTITLE`, `_STITLE`
- `OBLYON_COLOR_BLINE`, `_BLINE_HOVER`, `_FLINE`, `_FLINE_HOVER`
- `OBLYON_COLOR_FDATE_DEFAULT`, `_FDATE_SELECTED`
- `OBLYON_COLOR_TEXTTABACTIVE`, `_INPUT_BCKGRD`
- `OBLYON_COLOR_INFOBOX_BCKGRD1`, `_BCKGRD2`, `_BORDER_ACTIONCOLUMN`
- `THEME_INVERT_RATIO_FILTER`

### Couleurs — Dolibarr core (THEME_ELDY_*)

- `THEME_ELDY_TOPBORDER_TITLE1`, `_BACKTITLE1`, `_BACKTABACTIVE`
- `THEME_ELDY_LINEPAIR1`, `_LINEPAIR2`, `_LINEIMPAIR1`, `_LINEIMPAIR2`, `_LINEBREAK`
- `THEME_ELDY_TEXTTITLENOTAB`, `_TEXTTITLE`, `_TEXT`, `_TEXTLINK`
- `THEME_ELDY_ENABLE_PERSONALIZED`

### Dashboard — Infobox

- `MAIN_DISABLE_GLOBAL_WORKBOARD`, `_GLOBAL_BOXSTATS`, `_METEO`
- `MAIN_DISABLE_BLOCK_*` (AGENDA, PROJECT, CUSTOMER, SUPPLIER, CONTRACT, BANK, ADHERENT, EXPENSEREPORT, HOLIDAY, TICKET, BOM)
- `THEME_INFOBOX_COLOR_ON_BACKGROUND`
- `OBLYON_INFOXBOX_SINGLE_WIDTH`
- `THEME_AGRESSIVENESS_RATIO`

### Dashboard — Couleurs infobox

- `OBLYON_INFOXBOX_BACKGROUND`, `_WEATHER_COLOR`
- `OBLYON_INFOXBOX_ACTION_COLOR`, `_PROJECT_COLOR`
- `OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR`, `_ORDER_COLOR`, `_INVOICE_COLOR`
- `OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR`, `_ORDER_COLOR`, `_INVOICE_COLOR`
- `OBLYON_INFOXBOX_CONTRAT_COLOR`, `_BANK_COLOR`, `_ADHERENT_COLOR`
- `OBLYON_INFOXBOX_EXPENSEREPORT_COLOR`, `_HOLIDAY_COLOR`, `_TICKET_COLOR`, `_MRP_COLOR`

### Options générales

| Constante | Description | Valeur par défaut |
|-----------|-------------|-------------------|
| `OBLYON_FONT_FAMILY` | Famille de police | `Arial` |
| `OBLYON_FONT_SIZE` | Taille de police | `14` |
| `OBLYON_IMAGE_HEIGHT_TABLE` | Hauteur max des images dans les tableaux | `24` |
| `MAIN_MAXTABS_IN_CARD` | Nombre max d'onglets par fiche | — |
| `OBLYON_DISABLE_VERSION` | Masquer la version Dolibarr | `1` |
| `MAIN_STATUS_USES_IMAGES` | Utiliser des images pour les statuts | `0` |
| `MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN` | Menu rapide dropdown | `0` |
| `MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN` | Favoris dropdown | `0` |
| `OBLYON_PADDING_RIGHT_BOTTOM` | Padding en bas à droite | `1` |
| `MAIN_LOGIN_RIGHT` | Login à droite | `0` |
| `FIX_AREAREF_TABACTION` | Fixer la bannière de référence au scroll | `0` |
| `MAIN_CHECKBOX_LEFT_COLUMN` | Colonne de sélection à gauche | `0` |
| `FIX_STICKY_HEADER_CARD` | En-tête de tableau collant | `0` |
| `OBLYON_CUSTOM_CSS` | CSS personnalisé | — |

### FontAwesome

| Constante | Description |
|-----------|-------------|
| `MAIN_FONTAWESOME_DIRECTORY` | Répertoire du pack FA (`/theme/common/fontawesome-N`) |
| `MAIN_FONTAWESOME_FAMILY` | Famille FA sélectionnée |
| `MAIN_FONTAWESOME_ICON_STYLE` | Style d'icônes (`fas`, `far`, `fal`, `fat`, `fad`) |
| `MAIN_FONTAWESOME_WEIGHT` | Poids de police FA (`100`-`900`) |

### CKEditor

- `FCKEDITOR_ALLOW_ANY_CONTENT`, `FCKEDITOR_ENABLE_SCAYT_AUTOSTARTUP`
- `MAIN_SECURITY_ALLOW_UNSECURED_LABELS_WITH_HTML`

Point de vigilance : les constantes `OBLYON_*` sont très nombreuses (~80+) ; éviter les changements massifs sans test visuel.

## Conventions de développement (Development conventions)

Respecter les règles Dolibarr du dépôt parent :

- compatibilité PHP (code base : 7.1–8.4),
- pas de framework lourd / pas de Composer en core (Parsedown vendorisé dans `includes/`),
- entrées utilisateur via `GETPOST*` avec type approprié,
- constantes via `getDolGlobalString()`, `getDolGlobalInt()`, `getDolGlobalBool()`,
- SQL sécurisé : cast `int`, échappement `$db->escape()` / `$db->escapeforlike()`,
- gestion multi-entité via `entity` / `getEntity()`,
- protection XSS : `dol_escape_htmltag()` sur `$_SERVER['PHP_SELF']` dans les formulaires,
- validation whitelist sur les constantes modifiées via regex `set_(.*)`.

## Workflow recommandé après changements structurels (Recommended workflow)

Si modification SQL / descripteur / thème CSS / menus / constantes :

1. Désactiver puis réactiver le module
2. Vérifier que le thème `oblyon` est bien actif (`MAIN_THEME`)
3. Vérifier les constantes de couleurs dans l'onglet Colors
4. Vider le cache navigateur (les CSS sont mis en cache)
5. Vérifier le rendu du menu (inversé / standard / réduit)
6. Vérifier le dashboard (couleurs infobox, blocs activés)
7. Vérifier la page de connexion
8. Si modification de `oblyon.lib.php` (menus) : tester toutes les entrées de menu principales

## Points d'attention (Watchpoints)

- Le thème est servi depuis `htdocs/custom/oblyon/themeoblyon/` et non depuis `htdocs/theme/oblyon/` (le mécanisme de copie a été désactivé par InfraS)
- Le fichier `global.inc.php` fait ~11000 lignes ; les modifications CSS doivent être ciblées
- La version est lue depuis le fichier `VERSION` à la racine du module (pas de `changelog.xml`)
- Le changelog est affiché via Parsedown (`CHANGELOG.md`)
- Le module force le gestionnaire de menus (`MAIN_MENU*_FORCED` → `oblyon_menu.php`)
- La désactivation du module restaure le thème `eldy` et nettoie toutes les constantes de thème
- Les constantes de backup/restore utilisent un pattern de LIKE SQL : `OBLYON_%`, `THEME_%`, `MAIN_%`, `FIX_%`
- L'extension CSS pour modules externes est dans `themeoblyon/modules/` (quicklist, scaninvoices, subtotal)
- Le backport `v21` contient des fonctions rétro-compatibles pour les anciennes versions de Dolibarr
- Compatibilité Easya : si `EASYA_VERSION >= 2024`, les versions min PHP/Dolibarr sont lues depuis `.easya_info.json`
- Le `config.php` remonte les répertoires parents pour trouver `main.inc.php` (compatibilité multi-déploiement)

## Dernières mises à jour (Recent updates)

- `3.2.0` (2026-06) : mode tactile des menus (tap-to-toggle) — corrige le repli incontrôlé des dropdowns sur écran tactile (dépendance au `:hover`). Auto-détection + option `OBLYON_TOUCH_MENU` ; nouveaux fichiers `themeoblyon/touchmenu.inc.php` et `js/oblyon.js`
- `3.1.0` (2025-11) : compatibilité Dolibarr v21/v22/v23
- `3.1.0` (2025-11) : ajout de l'onglet « Icons » pour sélection du pack FontAwesome
- `3.1.0` (2025-11) : option de changement de famille de police (`OBLYON_FONT_FAMILY`)
- `3.1.0` (2025-11) : séparation des options de couleur titres principaux/titres de lignes
- `3.1.0` (2025-11) : suppression du CSS Cashdesk, passage à Dolibarr v18 minimum
- `3.1.0` (2025-11) : CSS fixes divers, déplacement menu catégories (v22 → outils)
- `3.0.6` (2024-09) : fix CSS badges, `FIX_AREAREF_TABACTION`, `print_oblyon_menu` avec `$noout=1`
- `3.0.5` (2024-09) : fix Z-index, ajout landing page spécifique, fix dropdown action
- `3.0.4` (2024-07) : CSS drag & drop, fix ordres menu, détection Easya `.easya_info.json`
- Entrées du changelog par version au format Keep a Changelog

## Notes techniques (Technical notes)

### Mécanisme de thème

Oblyon est un thème « externe » : il est chargé depuis `htdocs/custom/oblyon/themeoblyon/` au lieu du répertoire standard `htdocs/theme/`. Le descripteur module force `MAIN_THEME=oblyon` et Dolibarr recherche d'abord dans les répertoires alternatifs (`$dolibarr_main_url_root_alt`) avant le répertoire standard.

### Flux de chargement CSS

```
Dolibarr charge le thème actif
    ↓
style.css.php est appelé (NOLOGIN, NOCSRFCHECK, NOTOKENRENEWAL)
    ↓
theme_vars.inc.php lit les constantes OBLYON_* et THEME_ELDY_*
    → Définit les variables PHP ($colorbackhmenu1, $fontlist, etc.)
    ↓
global.inc.php génère le CSS principal
    → Définit les variables CSS :root (--colorbackhmenu1, --fontawesomeFamily, etc.)
    → Inclut toutes les règles CSS (~11000 lignes)
    ↓
Fichiers .inc.php spécialisés (badges, btn, dropdown, info-box, login, etc.)
    ↓
custom.css.php injecte le CSS personnalisé (OBLYON_CUSTOM_CSS)
```

### Mécanisme de backup/restore

Le module implémente un système de sauvegarde/restauration des constantes :

1. **Sauvegarde** (`oblyon_bkup_module`) : génère un fichier SQL de type dump dans `DOL_DATA_ROOT/<entity>/oblyon/sql/update.<entity>` contenant tous les `INSERT ... ON DUPLICATE KEY UPDATE` pour les constantes `OBLYON_%`, `THEME_%`, `MAIN_%`, `FIX_%`
2. **Restauration** (`oblyon_restore_module`) : exécute le fichier SQL sauvegardé via `run_sql()`
3. Une copie horodatée est conservée dans `DOL_DATA_ROOT/<entity>/admin/`

### Gestionnaire de menus (MenuManager)

Le `MenuManager` Oblyon remplace le gestionnaire standard de Dolibarr :

- **Classe** : `MenuManager` dans `core/menus/standard/oblyon_menu.php`
- **Chargement** : `loadMenu()` charge les menus depuis la base via `Menubase` et `require_once` la bibliothèque `oblyon.lib.php`
- **Rendu top** : `showmenu()` génère le menu horizontal supérieur avec support dropdown
- **Rendu left** : affiche le menu latéral avec support des niveaux 0-3
- **Bibliothèque** : `oblyon.lib.php` (~2400 lignes) définit toutes les entrées de menus (home, thirdparties, products, commercial, compta, bank, projects, HRM, tools, members, admin)
- Le menu respecte les droits utilisateur (`$user->hasRight(...)`) et les modules activés (`isModEnabled(...)`)

### Pages d'administration

Toutes les pages d'administration suivent le même pattern :

1. Inclusion de `config.php` → charge `main.inc.php`
2. Contrôle d'accès : `if (!$user->admin) accessforbidden();`
3. Actions : `GETPOST('action', 'alpha')` avec support backup/restore, on/off (`set_*`), update (`update_*`)
4. Whitelist sur les constantes modifiables : `preg_match('/^(OBLYON_|THEME_|MAIN_|FIX_|DISABLE_)/', $confkey)`
5. Reset du cache : `$_SESSION['dol_resetcache']`
6. Rendu : `llxHeader()`, onglets via `oblyon_admin_prepare_head()`, `llxFooter()`

### Helpers HTML de la bibliothèque admin

La bibliothèque `lib/oblyon.lib.php` fournit des fonctions utilitaires pour les pages d'administration :

| Fonction | Description |
|----------|-------------|
| `oblyon_admin_prepare_head()` | Génère les onglets (Options, Menus, Icons, Colors, Dashboard, Custom CSS, About, Changelog) |
| `oblyon_bkup_module($name)` | Sauvegarde les constantes module en SQL |
| `oblyon_bkup_table($table, ...)` | Génère le SQL de backup d'une table |
| `oblyon_restore_module($name)` | Restaure les constantes depuis le fichier SQL |
| `oblyon_print_backup_restore()` | Affiche la section backup/restore HTML |
| `oblyon_print_colgroup($metas)` | Affiche un `<colgroup>` HTML |
| `oblyon_print_liste_titre($metas)` | Affiche un titre de liste HTML |
| `oblyon_print_btn_action($action)` | Affiche un bouton d'action (submit) |
| `oblyon_print_hr($cs1)` | Affiche un séparateur horizontal |
| `oblyon_print_final($cs1)` | Affiche une ligne finale |
| `oblyon_print_input($confkey, $tag, ...)` | Affiche un champ de formulaire (on/off, input, textarea, color, select, range) |