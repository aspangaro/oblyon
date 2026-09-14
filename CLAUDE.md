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
- Compatibilité Dolibarr : `18.0.0` à `24.0.x`
- Compatibilité PHP : `7.1` à `8.4`
- Dernière version locale : `3.3.2` (2026-09)
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
│   ├── oblyon.js              # JS module (mode tactile tap-to-toggle + décalage dynamique du contenu sous le menu haut inversé)
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
│   ├── data.sql               # Constantes initiales (~200 INSERT, exhaustif ; preset « Oblyon Blue » par défaut)
│   └── update_3.2.0_oblyon_to_eldy.sql  # Migration OBLYON_* → THEME_ELDY_* (manuelle, à l'upgrade)
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

1. Contrôle/déploiement du thème `htdocs/theme/oblyon/` (`deployTheme()`, **avant toute écriture en base**) : thème présent et identique à `themeoblyon/` → rien ; absent ou différent et répertoire inscriptible → copie par écrasement (jamais de suppression préalable) ; présent mais non inscriptible → avertissement et activation poursuivie ; absent et non inscriptible → `$this->error` + retour 0 (activation refusée proprement, aucune constante insérée)
2. Chargement SQL (`_load_tables('/oblyon/sql/')`)
3. Restauration des constantes module (`oblyon_restore_module`)
4. Détection du répertoire FontAwesome le plus récent (`fontawesome-N`) et enregistrement dans `MAIN_FONTAWESOME_DIRECTORY`
5. Suppression des anciens fichiers menu manager du core (`core/menus/standard/oblyon_menu.php`, `oblyon.lib.php`)
6. Activation du thème Oblyon (`MAIN_THEME` = `oblyon`)
7. Restauration de `MAIN_MENU_INVERT` depuis sauvegarde
8. Suppression de `OBLYON_SHOW_COMPNAME` (incompatible menu inversé)
9. Migration de la constante kanban : `OBLYON_DISABLE_KANBAN_VIEW_IN_LIST` → `DISABLE_KANBAN_VIEW_IN_LIST`, puis suppression de l'ancienne

### Désactivation (Lifecycle : `remove()`)

`remove()` effectue :

- Sauvegarde module (`oblyon_bkup_module`)
- Restauration du thème par défaut (`MAIN_THEME` = `eldy`)
- Le thème `htdocs/theme/oblyon/` n'est **jamais supprimé** (depuis 3.3.2)
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

Fichiers SQL (`sql/`) :

- `data.sql` : constantes initiales (~200), **exhaustif** (toutes les constantes lues par le thème sont semées) ; les couleurs par défaut correspondent au preset **« Oblyon Blue »**. Organisé en sections commentées (Menus, Couleurs, Tableau de bord, Options, Réglages complémentaires). `__ENTITY__` est remplacé par l'entité courante à l'exécution (`run_sql`). Ne sème qu'à l'installation (INSERT simples, doublons tolérés).
- `update_3.2.0_oblyon_to_eldy.sql` : **migration manuelle** (préfixe `update_` → non exécutée par `_load_tables`) recopiant les anciennes constantes `OBLYON_*` vers les nouvelles `THEME_ELDY_*` — voir « Migration de constantes (oblyon → eldy) ».

Le mécanisme de backup/restore sauvegarde/restaure les constantes du module dans `DOL_DATA_ROOT/<entity>/oblyon/sql/update.<entity>` ; la sauvegarde combine des préfixes LIKE et la liste exhaustive de `data.sql` (voir Notes techniques).

## Constantes de configuration (Key settings)

Le module utilise un grand nombre de constantes (~200, cf. `data.sql` exhaustif) organisées par catégorie :

### Menus

| Constante | Description | Valeur par défaut |
|-----------|-------------|-------------------|
| `MAIN_MENU_INVERT` | Menu inversé (horizontal) | `0` |
| `OBLYON_FULLSIZE_TOPBAR` | Barre supérieure pleine largeur | `0` |
| `MAIN_SHOW_LOGO` | Afficher le logo dans le menu | `0` |
| `OBLYON_STICKY_TOPBAR` → `THEME_STICKY_TOPMENU` | Barre supérieure collante (migrée, cf. groupe A) | `0` |
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

- Fond bouton d'action : `THEME_ELDY_BTNACTION` (ex-`OBLYON_COLOR_BUTTON_ACTION1`, migrée) et `OBLYON_COLOR_BUTTON_ACTION2`
- Texte bouton d'action : `THEME_ELDY_TEXTBTNACTION`
- Suppression : `OBLYON_COLOR_BUTTON_DELETE1`, `_DELETE2`

### Couleurs — Messages

- `OBLYON_COLOR_INFO_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_WARNING_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_ERROR_BORDER`, `_BCKGRD`, `_TEXT`
- `OBLYON_COLOR_NOTIF_*_BCKGRD`, `_TEXT` (info, warning, error)

### Couleurs — Options générales

- `OBLYON_COLOR_MAIN`, `_BCKGRD`, `_LOGO_BCKGRD`, `_LOGIN_BCKGRD`
- `OBLYON_COLOR_BTITLE`, `_STITLE` (texte des titres migré vers `THEME_ELDY_TEXTTITLE`, ex-`OBLYON_COLOR_FTITLE`)
- `OBLYON_COLOR_BLINE`, `_FLINE`, `_FLINE_HOVER` (survol de ligne migré vers `THEME_ELDY_USE_HOVER`, + coché `THEME_ELDY_USE_CHECKED`, ex-`OBLYON_COLOR_BLINE_HOVER`)
- `OBLYON_COLOR_FDATE_DEFAULT`, `_FDATE_SELECTED`
- `OBLYON_COLOR_TEXTTABACTIVE`, `_INPUT_BCKGRD`
- `OBLYON_COLOR_AUTOCOMPLETE_BCKGRD`, `_TEXT` (fond et texte de la ligne surlignée en autocomplétion produit — select2 `--highlighted` + autocomplétion jQuery UI `search-to-select`)
- `OBLYON_COLOR_RESULT_BCKGRD`, `_TEXT` (fond et texte des **étiquettes sélectionnées affichées dans le champ** multi-select — chips `.select2-selection__choice`, ex. tags/catégories ; le bouton × reprend la couleur du texte)
- `OBLYON_COLOR_CHIP_BCKGRD`, `_TEXT` (fond et texte des **options déjà sélectionnées dans la liste déroulante** de proposition — `.select2-results__option[aria-selected=true]`, remplacent le gris `#ddd` par défaut de select2)
- ⚠️ Noms contre-intuitifs (historique) : `RESULT_*` pilote les étiquettes **du champ**, `CHIP_*` pilote les options **déjà cochées de la liste**. Les options non sélectionnées de la liste gardent le rendu par défaut ; le survol reste géré par `OBLYON_COLOR_AUTOCOMPLETE_*`
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
| `OBLYON_FONT_FAMILY` → `THEME_FONT_FAMILY` | Famille de police (migrée, cf. groupe A) | `Arial` |
| `OBLYON_FONT_SIZE` → `THEME_ELDY_FONT_SIZE1` | Taille de police (migrée, cf. groupe A) | `14` |
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

- Le thème est **servi depuis `htdocs/theme/oblyon/`** (Dolibarr résout `/theme/oblyon/style.css.php` via `dol_buildpath`, racine principale d'abord, et une quinzaine de pages du core incluent `DOL_DOCUMENT_ROOT.'/theme/'.$conf->theme.'/theme_vars.inc.php'` en chemin dur). Ce répertoire est une **copie** de la source éditable `custom/oblyon/themeoblyon/` : livré avec l'instance (base LTS), ou copié par `init()` quand le répertoire est inscriptible. ⚠️ Après édition de `themeoblyon/`, resynchroniser `theme/oblyon/` (sinon rien n'est servi) + vider le cache CSS (Ctrl+F5)
- `deployTheme()` (3.3.2) compare récursivement `themeoblyon/` et `theme/oblyon/` (taille + md5 de chaque fichier source ; les fichiers supplémentaires côté `theme/oblyon/`, ex. `modules/<module>.inc.php` propre à l'instance, sont ignorés). Le user PHP‑FPM n'a pas les droits d'écriture dans `htdocs/theme/` sur le serveur (ACL `www-data:r-x`) : le thème doit donc être livré avec l'instance ; le module ne le supprime jamais et ne le copie que s'il en a le droit. Incident 2026-08 sur dolinfras24 : l'ancien `init()` (suppression puis recopie systématique) échouait en `Permission denied` alors que le thème était déjà en place
- Le fichier `global.inc.php` fait ~11000 lignes ; les modifications CSS doivent être ciblées
- La version est lue depuis le fichier `VERSION` à la racine du module (pas de `changelog.xml`)
- Le changelog est affiché via Parsedown (`CHANGELOG.md`)
- Le module force le gestionnaire de menus (`MAIN_MENU*_FORCED` → `oblyon_menu.php`)
- La désactivation du module restaure le thème `eldy` et nettoie toutes les constantes de thème
- La sauvegarde (`oblyon_bkup_module`) couvre des préfixes LIKE (`OBLYON_%`, `THEME_%`, `MAIN_FONTAWESOME_%`, `FIX_*`, `MAIN_DISABLE_BLOCK_*`, …) **plus** la liste exhaustive des constantes déclarées dans `data.sql`
- L'extension CSS pour modules externes est dans `themeoblyon/modules/` (quicklist, scaninvoices, subtotal)
- Le backport `v21` contient des fonctions rétro-compatibles pour les anciennes versions de Dolibarr
- Compatibilité Easya : si `EASYA_VERSION >= 2024`, les versions min PHP/Dolibarr sont lues depuis `.easya_info.json`
- Le `config.php` remonte les répertoires parents pour trouver `main.inc.php` (compatibilité multi-déploiement)

## Dernières mises à jour (Recent updates)

- `3.3.2` (2026-09) : activation/désactivation sans suppression du thème. `init()` ne supprime plus puis ne recopie plus `htdocs/theme/oblyon/` : nouvelle méthode privée `deployTheme()` (contrôle par comparaison taille + md5, copie par écrasement seulement si nécessaire et possible, avertissement si présent mais non modifiable, refus propre avec message explicite si absent et non créable), exécutée **avant** `_load_tables()` pour ne plus laisser de constantes en base après un échec. `remove()` ne supprime plus le thème (sans droit d'écriture, la désactivation échouait à mi-chemin : module encore actif mais `MAIN_THEME=eldy` et constantes de menu effacées). Heuristique `htdocs/VERSION` abandonnée. Clés `OblyonDeleteThemeError`/`OblyonCopyThemeError` remplacées par `OblyonThemeSourceMissing`, `OblyonThemeMissingNotWritable`, `OblyonThemeNotUpdated`
- `3.3.1` (2026-07) : fix chevauchement du dropdown des boutons d'action (`dropdown.inc.php` : sélecteur `.dropdown-holder` sans son point initial, jamais appliqué ; `.dropdown-content` sans ancrage par défaut `bottom:0`/`transform:translateY(100%)` ni `z-index:5`, contrairement à eldy — le menu pouvait recouvrir les blocs « Fichiers joints » / « Derniers événements ») ; complément du correctif `FIX_ABSOLUTE_BUTTONS_ACTION_CARD` (`global.inc.php`) avec le `transform: translateY(-100%)` manquant pour que l'ouverture vers le haut de la barre d'action sticky fonctionne réellement
- `3.3.0` (2026-07) : regroupe l'ensemble des évolutions 2026-07 listées ci-dessous (options couleurs autocomplétion + multi-select, fix menu inversé sticky, fix fallback FontAwesome, migration constantes → eldy, consolidation CSS boutons, data.sql exhaustif). Version portée dans `VERSION` et `CHANGELOG.md`
- (2026-07) Migration des constantes propres au thème vers les constantes standard Dolibarr/Eldy (groupe A) : `OBLYON_FONT_FAMILY`→`THEME_FONT_FAMILY`, `OBLYON_FONT_SIZE`→`THEME_ELDY_FONT_SIZE1`, `OBLYON_STICKY_TOPBAR`→`THEME_STICKY_TOPMENU`, `OBLYON_COLOR_BUTTON_ACTION1`→`THEME_ELDY_BTNACTION`, `OBLYON_COLOR_FTITLE`→`THEME_ELDY_TEXTTITLE`, `OBLYON_COLOR_BLINE_HOVER`→`THEME_ELDY_USE_HOVER` (+ `_USE_CHECKED`) ; nouveau `sql/update_3.2.0_oblyon_to_eldy.sql`
- (2026-07) `data.sql` rendu **exhaustif** et **preset par défaut passé à « Oblyon Blue »**
- (2026-07) Consolidation du CSS des boutons dans `btn.inc.php` (`.button*`, `.butAction*` fusionnés, paiement, submit) ; retrait des blocs correspondants de `global.inc.php`
- (2026-07) Refactor : valeurs PHP réinjectées via variables CSS `:root` (`--fontsize`, `--colorButtonAction1/2`, `--colorTextButtonAction`, `--left`/`--right`, couleurs badges, etc.)
- (2026-07) Copie/suppression du thème réactivée dans `init()`/`remove()`, conditionnée à l'absence de `htdocs/VERSION`
- (2026-07) Migration de la constante kanban (`OBLYON_DISABLE_KANBAN_VIEW_IN_LIST` → `DISABLE_KANBAN_VIEW_IN_LIST`) dans `init()` + `admin/options.php`
- (2026-07) `oblyon_bkup_module` : sauvegarde exhaustive (préfixes LIKE + constantes de `data.sql`)
- (2026-07) `oblyon_restore_module` : sortie **silencieuse par défaut** (correction du `$silent` inversé de `run_sql`)
- (2026-07) Fix `Undefined variable $infras_radius` (calcul déplacé avant le bloc `:root`) — rétablit les arrondis
- (2026-07) Nouvelles options couleur `OBLYON_COLOR_AUTOCOMPLETE_BCKGRD` / `_TEXT` : pilotent le fond et le texte de la ligne surlignée en **autocomplétion produit** (select2) — remplacent le fond `var(--colorbackhmenu1)` et le texte `#fff` codés auparavant
- (2026-07) Règle CSS ciblée `.ui-autocomplete .ui-state-active` : applique aussi `OBLYON_COLOR_AUTOCOMPLETE_*` à l'**autocomplétion jQuery UI** (`PRODUIT_USE_SEARCH_TO_SELECT`), sans impacter les autres états `.ui-state-active`
- (2026-07) Nouvelles options couleur multi-select select2 (5 presets + data.sql + `oblyon_bkup_module()` via préfixe `OBLYON_%`) : `OBLYON_COLOR_RESULT_*` = **étiquettes sélectionnées dans le champ** (`.select2-selection__choice`, ex-fond info-box `var(--color1BckgrdInfobox)` sans couleur de texte) ; `OBLYON_COLOR_CHIP_*` = **options déjà sélectionnées dans la liste déroulante** (`.select2-results__option[aria-selected=true]`, remplace le gris `#ddd` de select2). Noms contre-intuitifs conservés (RESULT→champ, CHIP→liste) pour ne pas orpheliner les valeurs déjà en base ; mapping inversé après retour utilisateur, options non cochées de la liste laissées au rendu par défaut
- (2026-07) Fix fallback FontAwesome à la désactivation : `remove()` ne supprimait que `MAIN_FONTAWESOME_ICON_STYLE`/`_WEIGHT` (à `$conf->entity`), laissant `_DIRECTORY` et `_FAMILY` orphelines → le pack FA choisi (ex. `fontawesome-6p` Pro) restait actif au lieu de revenir au défaut natif du core (`/theme/common/fontawesome-5`, `fas`, `Font Awesome 5 Free`). Corrigé : suppression des **4** constantes `MAIN_FONTAWESOME_*` sur **toutes les entités** (`dolibarr_del_const(..., -1)`, le filtre entité n'est appliqué que si `entity >= 0`). NB : `init()` pose volontairement `_DIRECTORY` (et `style.css.php` `_FAMILY`) à l'**entité 0** = défaut global, écrasé par l'override par entité d'`icons.php` (précédence `conf.class.php` : `entity IN (0, courante) ORDER BY entity`) — ne pas basculer `init()` sur `$conf->entity` sous peine d'écraser le choix admin à chaque réactivation
- (2026-07) Fix menu inversé (`MAIN_MENU_INVERT` + `THEME_STICKY_TOPMENU`) : quand la barre haute `#tmenu_tooltipinvert` (`position: fixed`) déborde sur plusieurs lignes, le contenu (`#id-left`, `#id-right`→`.fiche`) gardait un `padding-top` codé en dur (40/52px) → haut du contenu masqué. Correctif **JS** dans `js/oblyon.js` : recalcul du `padding-top` de `#id-left`/`#id-right` selon la hauteur réelle de la barre (au chargement + `load` + `resize`). Le CSS n'est pas touché (clipper la barre est exclu : `overflow` couperait aussi les sous-menus `.sec-nav__sub-list` en `position: absolute` qui débordent sous la barre)
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

Le descripteur force `MAIN_THEME=oblyon`. Dolibarr construit `$conf->css = "/theme/oblyon/style.css.php"` et le résout via `dol_buildpath(..., 1)`, qui teste **d'abord la racine principale** → c'est donc `htdocs/theme/oblyon/` qui est servi, **pas** la source `custom/oblyon/themeoblyon/`. Le décalage de nom (`themeoblyon` ≠ `theme/oblyon`) empêche le mécanisme « alt‑root » de servir la source directement : un `theme/oblyon/` physique est requis (fourni en LTS, ou (re)créé par `init()` sur Dolibarr standard). La source `themeoblyon/` reste le répertoire à éditer, puis à resynchroniser vers `theme/oblyon/`.

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

1. **Sauvegarde** (`oblyon_bkup_module`) : génère un dump `INSERT ... ON DUPLICATE KEY UPDATE` dans `DOL_DATA_ROOT/<entity>/oblyon/sql/update.<entity>`. La sélection combine des **préfixes LIKE** (`OBLYON_%`, `THEME_%`, `MAIN_FONTAWESOME_%`, `FIX_*`, `MAIN_DISABLE_BLOCK_*`, `MAIN_USE_TOP_MENU_%`, …) **et** la **liste exhaustive lue dans `data.sql`** (clause `name IN (…)`) → toute constante du module est sauvegardée.
2. **Restauration** (`oblyon_restore_module`) : exécute le fichier via `run_sql()`, **silencieux par défaut** (`$silent = !MAIN_DISPLAY_SQL_INSTALL_LOG`) ; activer `MAIN_DISPLAY_SQL_INSTALL_LOG` pour afficher le détail SQL.
3. Une copie horodatée est conservée dans `DOL_DATA_ROOT/<entity>/admin/`.

### Migration de constantes (oblyon → eldy)

Certaines constantes propres au thème ont été remplacées par les constantes standard Dolibarr/Eldy (réutilisation du socle natif) :

| Ancienne (`OBLYON_*`) | Nouvelle | Portée |
|---|---|---|
| `OBLYON_FONT_FAMILY` | `THEME_FONT_FAMILY` | police |
| `OBLYON_FONT_SIZE` | `THEME_ELDY_FONT_SIZE1` | taille de police |
| `OBLYON_STICKY_TOPBAR` | `THEME_STICKY_TOPMENU` | barre haute collante |
| `OBLYON_COLOR_BUTTON_ACTION1` | `THEME_ELDY_BTNACTION` | fond bouton d'action |
| `OBLYON_COLOR_FTITLE` | `THEME_ELDY_TEXTTITLE` | texte des titres |
| `OBLYON_COLOR_BLINE_HOVER` | `THEME_ELDY_USE_HOVER` (+ `_USE_CHECKED`) | survol / coché des lignes |
| `OBLYON_DISABLE_KANBAN_VIEW_IN_LIST` | `DISABLE_KANBAN_VIEW_IN_LIST` | masquage vue kanban |

- Le code lit désormais les constantes de droite (repli sur les défauts de `theme_vars.inc.php`).
- `sql/update_3.2.0_oblyon_to_eldy.sql` recopie l'ancienne valeur vers la nouvelle à l'upgrade d'une instance existante (**manuel** : `mariadb … alarmexpo < sql/update_3.2.0_oblyon_to_eldy.sql`).
- La constante kanban est migrée automatiquement par `init()` et à l'ouverture de `admin/options.php`.

### CSS des boutons (consolidé dans `btn.inc.php`)

Tout le CSS des boutons est regroupé dans le fichier dédié `btn.inc.php` : boutons génériques `.button*`, boutons d'action `.butAction*` (fusion de l'ancienne implémentation de `global.inc.php`), boutons form/submit (`input.button`, `input[type=submit]`) et boutons de paiement (`.buttonpayment*`). Les couleurs passent par les variables CSS `--colorButtonAction1/2`, `--colorTextButtonAction`, `--colorButtonDelete1/2` (issues des constantes migrées). Restent en place (contextuels, non déplacés) : `.websitebar .button`, `.searchpage .button`, `.liste_titre input[type=submit]`, `th .button`, `.ui-state-*`, `cke_*`. Les boutons de paiement conservent un style propre (`#9999bb`, page publique `public/payment/newpayment.php`).

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