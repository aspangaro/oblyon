# CHANGELOG OBLYON FOR [DOLIBARR ERP CRM](https://www.dolibarr.org)
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

### [3.9.1] - Compatibility 18.0.x - 24.0.x (2026/10/12)
### Fixed
- Left menu Tools > Export on Dolibarr 22: the entry still pointed to exports/index.php, a page removed by Dolibarr 22 (Import and Export merged into imports/index.php), so the link answered a 404 "Not Found". The merged Import / Export entry was only served from Dolibarr 23: it is now served from 22.0 (core/menus/standard/oblyon.lib.php). Reported on the alarmexpo instance.
### [3.9.0] - Compatibility 18.0.x - 24.0.x (2026/10/08)
### Fixed
- Point of sale (TakePOS) on a phone: with the mobile layout (OBLYON_MOBILE_LAYOUT), the two rules that keep the object lines table of the cards 640px wide and its description column 320px wide also applied to the TakePOS ticket (table#tablelines), which then scrolled sideways inside its column. They are cancelled on the point of sale screen (body.bodytakepos), whatever the point of sale theme (themeoblyon/modules/takepos.inc.php)
### Added
- TakePOS tab in the module setup (admin/takepos.php, shown only when the TakePOS module is enabled): point of sale themes, quick line editing, keyboard shortcuts, category colours
  - Point of sale theme (OBLYON_TAKEPOS_THEME, default native = original TakePOS rendering, nothing changes):
    - Enhanced native (classic): original layout, restyled in the colours of the instance preset (bigger spaced buttons and tiles, large total, visible selected line, numeric pad modes distinct from the digits, highlighted Payment button, price pills, payment window with the total on the main colour)
    - Counter (counter): categories as scrolling tabs, large product grid, ticket on the right with the compact action bar and a payment bar (quick discounts, large total, Payment button with the amount); the numeric pad opens as a panel (calculator button, Alt+N, or tapping a line)
    - Tablet (tablet): grid of the categories then grid of the products with a back button and the category title; ticket, numeric pad always visible and payment bar on the right
    - Grocery store (scanner): large scan / search field, wide ticket table, payment bar, actions and keyboard shortcut help on the right, categories and products as a band at the bottom
    - Mechanism: the TakePOS .container becomes a CSS grid, its two rows (.row1 / .row2) are displayed as contents and every zone takes a named area; the Payment button of TakePOS is moved into the payment bar (same button, same hooks). Under 900px the layouts fall back to a single column
  - Quick line editing (every theme except native): quantity stepper [ - ] qty [ + ] in the Qty column of the ticket (the minus becomes a trash at a quantity of 1 and deletes the line), one-tap discounts on the selected line (else the last one), the selected line stays selected after every reload of the ticket, the numeric pad goes back to the Qty mode after a change. Everything goes through TakePOS itself (invoice.php updateqty / updatereduction, deleteline, Edit): same rights, same minimum price checks
  - Keyboard shortcuts (every theme except native): F9 payment, Alt+Q / Alt+R / Alt+P quantity / discount / price (a number typed in the search field is applied to the selected line), Alt+Up / Alt+Down previous / next line, Alt+Left / Alt+Right quantity -1 / +1, Alt+X delete the line, Alt+N numeric pad, Escape closes the pad
  - After the payment (Counter, Tablet, Grocery store): TakePOS kept the paid ticket on screen until a click on New (missing in bar / restaurant mode) and emptied the product tiles. The payment bar now shows "Sale completed" with the print buttons of the paid ticket (copied, they keep working after the next sale starts, until its first item) and a New sale button (or F9) with a countdown: the next sale starts by itself at the end of the delay (OBLYON_TAKEPOS_AUTO_NEW_SALE, seconds, default 5, 0 = only on click), or as soon as an item is added. It uses the same action as the New button of TakePOS (invoice.php action=delete: only the draft of the place is emptied, never a validated invoice). The -/+ stepper is printed on draft tickets only
  - Product grid: TakePOS emptied every product tile on each key pressed in an empty search field (Alt shortcuts, end of payment); the grid is now kept when the field was already empty, and the displayed category is reloaded when the field has just been emptied
  - Quick discounts (OBLYON_TAKEPOS_QUICK_DISCOUNTS, default 5,10,20: up to 4 percentages between 0 and 100)
  - Category colours on the tiles (OBLYON_TAKEPOS_CATEGORY_COLORS, default off, any theme): category tiles (whole tab in Counter / Grocery store) take the colour of their Dolibarr category, product tiles a stripe of the colour of the displayed category (not during a search); read from the categories / subcategories arrays TakePOS already gives the page: no extra request
  - Files: themeoblyon/modules/takepos.inc.php (CSS, rules prefixed by the classes set on <html>, so that they win over takepos/css/pos.css.php loaded after the theme stylesheet; theme rules printed only for the chosen theme, saving a new theme increments MAIN_IHM_PARAMS_REV), js/takepos.js (layouts, quick editing, shortcuts, colours; settings and translated labels in window.oblyonPos, address versioned by the file date), class/actions_oblyon.class.php (addHtmlHeader: classes on the point of sale pages only - index, pay, reduction, freezone, split; never the TakePOS setup pages, whose scrolling the layouts blocked, nor the receipt or the public pages - settings and script on the point of sale screen; completeTakePosInvoiceHeader / completeTakePosInvoiceLine: quantity buttons), core/modules/modOblyon.class.php (new hook context takeposinvoice: disable then enable the module once, the tab shows a warning until then)
  - Seeded by data.sql, typography section of the presets, langs fr_FR / en_US (chapter "TakePOS (3.9.0)")
### [3.8.0] - Compatibility 18.0.x - 24.0.x (2026/09/21)

### Fixed
- Colour fields of the Colors tabs (module and user card): the jscolor picker (required by default) replaced an empty or '#' value (inherit / derived colour) by FFFFFF in the field, which was then saved as #FFFFFF (top menu active / hover / selected texts turned white on several instances although seeded '#'). Such a field now stays empty with an "Automatic" placeholder ({required:false}) and saves back '#' (module tab) or keeps the instance value (user tab); the theme treats '#' like '' for the automatic title text contrast (THEME_ELDY_TEXTTITLE)
- Advanced search field of the infrassearch module in the top bar too short (placeholder cut): the form, made inline-block for the vertical centring, shrank to the field's own size (size=15) and the 90 % width of the field was computed on that reduced width (148px instead of 171px in a 200px container). The form now takes the full width of its container (modules/infrassearch.inc.php)
- Breadcrumb dropdown of the infrassearch module: a third party took three lines (name, " -", basket icon) when a getNomUrl hook appends content after the object link (onepagebasket: link to the customer dashboard), because every link of the row was displayed as a flex block. The row is now a single flex line: the object link takes the available width, the content added by the hooks stays at the end of the line; the error row keeps its multi-line text (modules/infrassearch.inc.php)

### Changed
- Contrast report removed (added in 3.6.0, extended in 3.7.0): the warning block under the Colors tab of the module and of the user card, the warning icon on every preset card and the four functions behind them (oblyon_color_luminance, oblyon_contrast_ratio, oblyon_check_preset_contrast, oblyon_contrast_issue_text) plus the two lang keys. Too heavy for its use: ~70 text / background couples recomputed on every display of these pages, per preset card. oblyon_text_on() (dark or white text on a background: status badges, avatar) keeps its own luminance computation
- jNotify messages redesigned as cards under the top bar, on the right (380px): background and text of the "Messages and notifications" colours (OBLYON_COLOR_NOTIF_*, read by the theme but never painted until now, tokens --colorNotif* added to :root), 4px left rule and FontAwesome icon of the message type (check / warning / error), discreet close cross, slide-in on appearance (follows the Animations option); the login page and phone rules are untouched (widgets.inc.php)
- Options tab: every explanation is now a tooltip on the label (help icon) instead of a grey text under it (density, tab / button / status styles, form button colours, CKEditor skin; Menus tab: reduced menu effect, touch mode, mobile layout)
- Options tab: the switch "statuses displayed as icons" (MAIN_STATUS_USES_IMAGES) and the status badge style are merged into one select "Display of the statuses": icon / filled pill badge / outline badge / dot + text (the icon value sets MAIN_STATUS_USES_IMAGES = 1, any other value sets it to 0 and OBLYON_BADGE_STYLE)
- Buttons group of both Colors tabs (module, user card): every field now shows the colour really applied (hex value, picker swatch) instead of an empty "Automatic" field with an "empty = ..." hint; the labels are reduced to Background / Text / Border / Hover background / Hover text and the explanation moves to a tooltip on each family title. The derivation of the button colours (oblyon_button_tokens() of style.css.php) becomes oblyon_button_effective_colors() in lib/oblyon_colors.lib.php, shared by the stylesheet and the forms (a transparent background is shown as the page background, a transparent border as the button background). On save, a colour left equal to the value shown stays automatic ('#', it keeps following the button style and the base colours; oblyon_button_auto_values()), a changed colour is stored as is. The 15 OblyonBtnRoleAuto* lang keys are removed
- Options tab: the switch "taller table rows (comfort mode)" (THEME_ELDY_USECOMOACTROW) is removed, replaced by the interface density: an instance that had it on gets OBLYON_DENSITY = comfortable and the constant is deleted (migration when the Options tab opens and when the module is enabled; the CSS rule is kept for instances not migrated yet); removed from the typography section of the presets and from data.sql

### Added
- Interface density (Options tab, group General, OBLYON_DENSITY: compact / normal / comfortable, default compact = unchanged rendering): one setting drives the padding of the table cells, the line height of the rows, the height of the list headers, the vertical padding of the inputs and selects, the vertical padding of the action buttons and the inner margins of the cards. Computed in style.css.php (table of values) and printed as the :root tokens --oblyon-cell-py / --oblyon-cell-px / --oblyon-row-lh / --oblyon-head-h (existing) and --oblyon-control-py / --oblyon-btn-py / --oblyon-card-py (new, consumed by core.inc.php, btn.inc.php and cards.inc.php). Seeded by data.sql, part of the typography section of the presets
- Style of the card tabs (Options tab, group General, OBLYON_TABS_STYLE: boxed / underline / pills, default boxed = unchanged rendering). Underlined: flat tabs standing on a rule, the active one carries a 2px underline in the main colour, hover on the neutral background. Pills: rounded tabs, the active one on the new accent tint. Three shared :root tokens computed in style.css.php: --oblyon-accent-tint and --oblyon-accent-tint-strong (row background mixed with the main colour at 12 % / 20 %, oblyon_mix_colors()) and --oblyon-on-accent (readable text on the main colour, oblyon_text_on()), reused by the next interface styles. CSS branches at the end of the Tabs section of cards.inc.php; the phone layout (mobile.inc.php) keeps its own scrolling tab band. Seeded by data.sql, typography section of the presets. Pill tabs have their own settings, shown only while that style is selected: three colours in the Colors tab, group Tabs (OBLYON_COLOR_TAB_PILL_BCKGRD / _TXT / _BORDER, read by oblyon_color_setting_hex(): empty or '#' = derived value, i.e. accent tint, main colour, neutral frame; tokens --oblyon-tab-pill-bg / -txt / -bg-hover / -border, also on the Colors tab of the user card and in the contrast report) and two switches in the Options tab (OBLYON_TAB_PILL_BORDER: 1px border on every pill, OBLYON_TAB_PILL_SHADOW: light shadow, stronger on hover). The colour form of the module no longer rewrites a field that is not displayed (hidden pill colours, action column border without sticky column): the stored value is kept instead of being replaced by '#'. Underlined tabs redesigned as a neutral band with rounded top corners closed by a rule: inactive tabs in muted text, hover on the row background, active tab in the main colour on the row background with a 3px underline covering the rule (one line only: the link no longer carries its own), the right area (buttons, photo) sent to the end of the flex row (the core prints it first). Three colours of their own (OBLYON_COLOR_TAB_UNDER_BAND / _TXT / _LINE, empty = derived: neutral background, main colour, main colour; tokens --oblyon-tab-under-band / -txt / -line / -border, contrast couples). The Tabs group of both Colors tabs now shows only the colours of the selected tab style (oblyon_tab_color_visible(): boxed = the three historical colours, pills = OBLYON_COLOR_TAB_PILL_*, underlined = OBLYON_COLOR_TAB_UNDER_*)
- Style of the buttons (Options tab, group General, OBLYON_BUTTON_STYLE: filled / outline / soft, default filled = unchanged rendering), applied to the action buttons of the cards, to the Delete button and to the form buttons (.button: Save, Cancel, Search...). Outline: transparent background, 1px frame and text of the button colour, hover on a light tint of it. Soft: background tinted with the button colour (12 %), text of that colour, stronger tint on hover, no shadow. The Buttons group of both Colors tabs is reorganised by family (oblyon_button_families(): action buttons, Delete button, form buttons when OBLYON_BUTTON_FORM_OWN_COLORS is on), each with five roles named by what they paint (background, text, border, hover background, hover text); an empty colour takes the automatic value printed next to its label. The filled style uses the historical constants, which keep their role (THEME_ELDY_BTNACTION = background, OBLYON_COLOR_BUTTON_ACTION2 = hover background, THEME_ELDY_TEXTBTNACTION = text, OBLYON_COLOR_BUTTON_DELETE1 / 2 = Delete background / hover background; labels renamed accordingly) plus ten new ones (action border and hover text, Delete text / border / hover text, the five form colours); the outline and soft styles share their own set of fifteen constants (OBLYON_COLOR_BUTTON_[DELETE_|FORM_]FLAT_BCKGRD / _TXT / _BORDER / _BCKGRD_HOVER / _TXT_HOVER), because the filled text (white) and background would give an invisible flat button: empty = derived from the filled button colour (text and border = that colour, background transparent or tinted). Every new constant is seeded '#' = automatic, so each style looks right before anything is set and keeps its own tuning. Tokens --oblyon-btn-<family>-<role> resolved by oblyon_button_tokens() in style.css.php (contour: transparent background, border = text; soft: tinted background; filled: original defaults); one CSS block at the end of the action buttons section of btn.inc.php, printed only when it changes something (style other than filled, or a border / hover / Delete text / form colour set), so the default sheet stays identical; the entries of the action dropdowns and the payment buttons keep their own style. Contrast couples for the Delete and form texts. Seeded by data.sql, typography section of the presets

- Style of the status badges (Options tab, group General, OBLYON_BADGE_STYLE: pill / outline / dot, default pill = unchanged rendering). Outline: row background, 1px frame and text of the status colour (draft / closed keep their muted text). Dot: no background nor frame, row text (weight 500) preceded by an 8px disc of the status colour (10px in the card banner) drawn by ::before. The colours stay those of the Status badges group (OBLYON_COLOR_BADGE_*); the rules are printed per status by _createStatusBadgeCss() after the original ones (badges.inc.php), the primary / success / warning... badges of the core are untouched. Seeded by data.sql, typography section of the presets
- Pulse of the status of the open card (Options tab, right after the status display, OBLYON_STATUS_PULSE, default off): the status of the card banner (div.statusref: badge, or the disc only with the dot style, or the image with the icon display) fades between full opacity and 55 % over 2.4 s in its own colour, without resizing; paused on hover; never in the lists (the Animations option of the theme, next lot, is the single place that may disable it). @keyframes oblyon-status-pulse in badges.inc.php. Seeded by data.sql, typography section of the presets

- Style of the list headers (Options tab, group Lists, OBLYON_LIST_HEADER_STYLE: band / flat, default band = unchanged rendering). Flat: title row on the row background with a muted text (weight 600, .95em) closed by a 1px rule, no coloured top border, sorted column and hover in the main colour without background, filter row on a barely tinted background with padded cells and readable search / reset icons (they took the band text colour), \"like the header\" totals on the same background with a 2px rule above; the sticky header (FIX_STICKY_HEADER_CARD) takes the flat background. Widget titles (tr.box_titre) and the other uses of the title background are untouched. Four colours of their own in the Titles group of both Colors tabs, shown only in the flat style (OBLYON_COLOR_LISTHEAD_FLAT_BCKGRD / _TXT / _LINE / _SEL, '#' = derived: row background, row text mixed 25 % with the background, neutral frame, main colour), contrast couples; tokens --oblyon-listhead-bg / -txt / -line / -sel / -filter. CSS block at the end of fixes.inc.php (after tables.inc.php and public.inc.php, whose sorted-column rule would win otherwise). Seeded by data.sql, lists_cards section of the presets

- Animations (Options tab, group General, OBLYON_MOTION: normal / reduced, default normal; in both cases the reduced rules also apply when the device asks for reduced motion, which is the accessibility behaviour browsers expect). One place for every transition and animation of the theme: new file themeoblyon/motion.inc.php, included last by global.inc.php so that its rules win (menus, flyouts, mobile drawer, buttons, tabs, dashboard tiles, status pulse, timeline bounce). Reduced: --oblyon-transition and every transition-duration cut to 50 ms, animations reduced to one instant iteration, smooth scrolling off; normal: the same rules under @media (prefers-reduced-motion: reduce). Token --oblyon-motion (1 normal / 0 reduced) for the scripts. Seeded by data.sql, general section of the presets

- Notification center (Options tab, group General, OBLYON_NOTIFICATION_CENTER, default off): a bell printed in the top right area next to the user block (hook printTopRightMenu, class/actions_oblyon.class.php) keeps every message shown by jNotify: js/oblyon.js wraps $.jnotify (the original still displays the message briefly; errors and warnings are shown 6 s instead of staying sticky; jNotify queues the messages one after the other), records {type, text, date, read} in the browser (localStorage per user, 50 entries, 7 days, in-memory fallback when storage is blocked), shows a badge with the unread count, a panel with the list (left rule by type, unread in bold on the accent tint, relative time from the labels passed as data-lbl-* attributes, a cross on every entry to delete it), mark all read, clear all, closing on outside click and Escape; the bell inherits the size and alignment of the other icons of the bar; full width under the mobile bar. Styles in themeoblyon/notifcenter.inc.php (tokens of the bar carrying the login block, overlay background, status colours). No table, no server call. Seeded by data.sql, general section of the presets

- User block of the top bar (Menus tab, group Top menu, OBLYON_USER_BLOCK: default / initials / photo, default = unchanged rendering). Initials: the photo of the bar and of the user dropdown header becomes a circle of the main colour (text --oblyon-on-accent, ring of the bar text colour) carrying the initials (first name + last name, else the two first letters of the login, computed by the printTopRightMenu hook and passed to js/oblyon.js by a hidden marker; the script swaps the two images printed by the core, whose markup is untouched). Photo: same, only when the user has no photo. Both values also redesign the user dropdown (dropdown.inc.php, selectors on #topmenu-login-dropdown): floating card on the theme tokens (overlay background, border, radius, large shadow, 320px), centred header on the accent tint with the 72px photo / avatar ringed by the main colour, name in 600 and muted connection dates, body with the two "Show..." links of the core as clickable rows (neutral hover, main colour text), footer in flex on the neutral background with the Card / Logout buttons on the --oblyon-btn-action-* / --oblyon-btn-delete-* tokens (so they follow the button style and colours). Seeded by data.sql, menus section of the presets

- Style of the native agenda (Options tab, group General, OBLYON_AGENDA_STYLE: classic / modern, default classic = unchanged rendering), month, week and day views (comm/action/index.php, all printed in table.cal_month). Modern: days of the month on the row background, other days on the neutral background with a muted number, --oblyon-border rules and rounded frame, today on the accent tint with its number in a disc of the main colour, "+" shown on cell hover, flat day header (muted small caps), 72px cells; every event as a card tinted with its own colour: the core prints the type / user colour only as an inline left border, so js/oblyon.js reads it and sets --oblyon-ev-tint (14 % alpha) on the card (neutral background without JS), row text, theme radius, shadow on hover, "not busy" events faded. The previous Oblyon rendering painted every event in the main colour. CSS block at the end of the agenda section of widgets.inc.php, token --oblyon-agenda-modern for the script. Third-party agenda modules are untouched. Seeded by data.sql, typography section of the presets

### [3.7.0] - Compatibility 18.0.x - 24.0.x (2026/09/18)

### Added
- Seven colour tokens for elements that were hard-coded for a light background and became unreadable with a dark preset (audit of the instance preset infras-dark, 2026-09-18): OBLYON_COLOR_AMOUNT_TEXT (text of the amounts, span.amount, was #006666), OBLYON_COLOR_CAL_EVENT_TXT (text of the agenda events, whose background is the main colour, was #111111), OBLYON_COLOR_CAL_WEEKEND_BCKGRD and OBLYON_COLOR_CAL_HOLIDAY_BCKGRD (week-ends and days off of the timesheets and calendars, were #eee / #f4eede / #fdf6f2 ; the input of a day off takes the input background), OBLYON_COLOR_OVERLAY_BCKGRD (floating surfaces that were white: filter bar of the lists, modals, hovered entry of the columns selector, inline edit hover), OBLYON_COLOR_TOPMENU_BCKGRD_SEL and OBLYON_COLOR_TOPMENU_TXT_SEL (selected entry of the main menu, whose text was white whatever the preset ; the background defaults to the hover background). Offered on the Colors tab of the module (groups Top menu, General backgrounds, Amounts, new group Agenda / calendars) and on the Colors tab of the user card, seeded by data.sql, added to the seven preset files (version +1 ; the event text is white on the presets whose main colour is dark). New helper oblyon_color_setting_hex() (lib/oblyon_colors.lib.php): a token painted as a plain CSS colour falls back to its default when the value is not #RRGGBB
- Fifteen more colour tokens for the elements that stayed hard-coded for a light background: the nine status badge families OBLYON_COLOR_BADGE_DRAFT / VALIDATED / APPROVED / WAITING / ACTIVE / CLOSED / CANCELED / ERROR / DONE (background and border of the badges, replacing the fixed $badgeStatus* values of theme_vars.inc.php ; the badge text is no longer white or the row text according to the lightness but the dark or white candidate with the best WCAG contrast, oblyon_text_on() ; the closed / canceled badges keep a plain background whose text follows the same rule ; .font-statusN takes the status colour instead of the badge background, which was the row background for the border-only badges, so the coloured status texts were invisible), OBLYON_COLOR_STOCK_OK / STOCK_LOW / STOCK_EXIT (stock column of the product lines and stock movements), OBLYON_COLOR_ICON_TEXT (phone, mail, link, trash, play pictograms, the hovered trash takes the danger status colour), OBLYON_COLOR_TIMELINE_BCKGRD / TIMELINE_PRIVATE_BCKGRD (ticket timeline ; its texts, borders, buttons and icon circles follow the row text, border and neutral tokens). Groups Status badges, Stock and movements, Timeline (tickets) on both Colors tabs ; seeded by data.sql ; present in the seven preset files (dark tints on Night and on the instance dark preset) and checked by the contrast report (stock, pictograms, timeline). OBLYON_COLOR_FTITLE, not read by the theme since the migration to THEME_ELDY_TEXTTITLE, is removed from the preset files
- Without new tokens, on the existing ones: quick add dropdown texts (#444 on the page background), jQuery UI dialog and date picker header (#ccc), ECM layout panes (white), togglers and resizers, search tags, #tooltip text, DataTables length select, login info block, columns selector hints, timeline
- Contrast check of the presets and of the personal colours (oblyon_check_preset_contrast): 25 more couples as the theme paints them (main colour as file type icons and tab hover text with its own threshold 3, and as background of the agenda events, amounts on the rows, hovered / checked rows, notifications, natures, members, selected menu entry, floating surfaces, week-ends and days off, page title on the page background, date picker active day on the core top menu colour, dialogs on THEME_ELDY_BACKBODY), the 15 dashboard tiles (module colour as icon on the row background, or under a white icon when THEME_INFOBOX_COLOR_ON_BACKGROUND is on ; the dashboard section is read for that) and detection of the colour values the theme cannot read (e.g. 0.0.0 or 25.5.45: colorStringToArray() falls back to grey #585858 without any warning). New oblyon_contrast_issue_text() shared by the three reports (preset cards, user tab, user presets), new lang key OblyonPresetInvalidValue

### Changed
- Theme reorganisation, generated stylesheet unchanged (checked with the new dev/csscompare.php: 0 semantic difference, text identical apart from comments). (1) Deduplication of the 24 *.inc.php files: 160 identical copies of a rule (first occurrence removed, the later one already won the cascade), 22 earlier copies whose every property was overridden by a later copy, 31 dead declarations inside partially overridden copies, 30 empty rules, the 313 lines duplicated twice in the JMobile / POS / Public / cd-timeline sections, and the 250-line copy of the top bar section that login.inc.php carried since its creation and that, included later, defeated the fixes made in global.inc.php (.alogin:hover and div.login_block:hover:after took back the main colour, div.login a took the side menu text colour): login.inc.php now holds the login page only, its 8 rules without equivalent were moved to the top bar section, 4 hard-coded colours of that section (#f4f4f4, #fff, #444) take the tokens the removed copy already used. Rules that only add properties to an earlier one are kept. Rules containing PHP are never touched. (2) global.inc.php (11 000 lines) is split at its own section boundaries into core, tools, layout, cards, tables, widgets, public and fixes .inc.php, included in the original order; global.inc.php keeps the entry role, the historical includes and the conditional tail. (3) Every *.inc.php gets the same header after its guard (file, role, included by, rule "one rule, one place"); new CLI dev/csscompare.php compares two saved stylesheets on the final value of each property per selector
- Single storage format for the colours: '#RRGGBB'. The core "Display setup" pages (admin/ihm.php, user/param_ihm.php) still write 14 THEME_ELDY_* constants as 'r,g,b' and the old defaults of theme_vars.inc.php used that form; the module read them through colorStringToArray() and printed 20 CSS variables as rgb(r,g,b), the only place where that form survived (no rgba() composition depends on it). Now oblyon_color_setting() converts any 'r,g,b' value to hex (new oblyon_color_to_hex()), style.css.php normalizes the 20 Eldy colours to hex (oblyon_txt_color_hex() feeds txt_color()), global.inc.php prints them as is (the title link variable is built with colorHexToRgb()), the preset normalization and the current values read from the database convert 'r,g,b' to hex (so a preset compares equal to the database whatever the stored form), and the Colors tabs of the module and of the user card rewrite the stored 'r,g,b' values as hex when they open (oblyon_colors_normalize_stored(), idempotent, CSS revision bumped). 'r,g,b' stays accepted on input (import, user tab) but is never stored any more. Generated CSS unchanged (checked by diff after rgb -> hex normalization)
- Colors tab of the module: the colours stored in the database (not only the preset files) are checked, with the same report as the cards (couples below 4.5, values the theme cannot read such as 0.0.0)

### Fixed
- Hovered links of the menus and of the top bar (main menu label next to its hovered icon, side menu titles and entries, search / bookmarks / help blocks, company name, login link) took the main colour of the preset as text colour: with a main colour close to the hover background (Accessibility, Light, instance dark presets) the label vanished on hover. They now use the hover text tokens of their menu (OBLYON_COLOR_TOPMENU_TXT_HOVER / OBLYON_COLOR_LEFTMENU_TXT_HOVER, a '#' value still inherits the normal text colour)
- The six preset files pass the extended contrast check (0 warning): darker nature backgrounds under the white nature text (prospect #687A6D, customer #498050, vendor #477D8C), notification texts (warning #6B5A12, error #6B1A2E ; Blue keeps its inverted scheme with a #6B5A12 warning background and a #FFE4EA error text), date picker active day readable on the core top menu colour, Blue main colour #D9741F (was #E09430, 2.5 on white), Dark selected menu entry #006F8A, Night amounts in light tints ; the 16 dashboard tile colours, missing from the five historical presets (the database value stayed whatever the preset), are now part of every preset (Okabe-Ito set of the Accessibility preset on the light presets, light tints on Night) with THEME_INFOBOX_COLOR_ON_BACKGROUND = 0 and THEME_AGRESSIVENESS_RATIO = 0 so the colours are painted as stored
- Colors tab of the module: THEME_ELDY_TOPMENU_BACK1, THEME_ELDY_VERMENU_BACK1, THEME_ELDY_BACKBODY and THEME_ELDY_TEXTTITLELINK (read by the theme: date picker active day, select2 dropdowns, jQuery UI dialogs) were offered on the user tab only, so an invalid value written by the core "Display setup" page (0.0.0) could not be fixed from the module; new group "Other Dolibarr colours (Eldy theme)"
- en_US/oblyon.lang: 16 keys of 3.6.0 (Accessibility preset, user colours permission and user presets) existed in French only
- THEME_ELDY_LINEBREAK and THEME_ELDY_TEXTTITLELINK are now normalized like the other 'r,g,b' constants (style.css.php): a #RRGGBB value, the only form the Colors tab writes, was printed as is inside rgb() / rgba() and gave an invalid CSS variable (no border on hr)
- info-box.inc.php ignored THEME_AGRESSIVENESS_RATIO stored by the Dashboard tab and the presets and always used -50 for the dashboard tiles; the stored value is read, -50 stays the fallback when the constant is empty

### [3.6.0] - Compatibility 18.0.x - 24.0.x (2026/09/16)

### Added
- Presets as JSON files (Colors tab): the five color presets are now files of the module (presets/green.json, dark.json, blue.json, night.json, light.json, one file = one preset, converted from the former PHP array with a key by key check) and any instance can have its own presets in DOL_DATA_ROOT/[entity/]oblyon/presets. A preset carries optional sections, each with its white list of constants: colors, typography, menus, general, lists_cards, dashboard, custom_css (FontAwesome pack and security settings are excluded on purpose). Compact cards replace the thumbnails (the screenshot of the module for the five shipped presets, a drawing from the colors for instance presets): name (description and sections in the tooltip), small icons for the contrast warning, Download, Update this preset (instance preset that differs from the database) and Delete (instance presets only), then stacked buttons: Apply this preset (Discard the changes when the current preset differs from the database), Update this preset (instance preset that differs), Download, Delete (instance presets only); a preset is always applied, updated and saved as a whole; "Save as" creates an instance preset from every current setting (key with a help tooltip, displayed name, description), "Import" loads a JSON file (256 KB, same validation, key from the file name, optional replace); both forms are folded behind their title (native details element, no JS). Applying is one transaction (menus rules of the Menus tab replayed, OBLYON_CURRENT_PRESET stored, CSS revision refreshed); text / background couples below the WCAG 4.5 contrast are flagged on the card. New library lib/oblyon_presets.lib.php, new directory presets/, data directory oblyon/presets created at activation, constant OBLYON_CURRENT_PRESET (seeded to blue)
- Colours per user: new tab "Colors" on the user card (declared by the module descriptor, so the module must be disabled / enabled once to show it; a completeTabsHead hook puts it right after the core "Display setup" tab), laid out like the core "Display setup" tab: Parameter / Default value / "Use personal value" checkbox on the first row, then one row per colour of the theme (116 constants, grouped as in the Colors tab of the module plus the dashboard tiles and four Eldy colours that had no row before), greyed until the box is ticked. The user himself (user/self/write) or an administrator / user manager (user/user/write) can edit; reading someone else's tab needs user/user/read. When the box is ticked every colour is copied for the user into llx_user_param (flag OBLYON_USER_COLORS = 1, full snapshot pre-filled with the instance values, format checked, dol_set_user_param), the CSS revision is bumped and the page redirects (PRG); unticking removes the flag and every personal colour. The theme reads every colour through the new oblyon_color_setting() (lib/oblyon_colors.lib.php): the personal value when the flag is set and the value is a colour, else the instance value; pages without a user (login, password) keep the instance colours. A contrast warning (same 21 couples as the preset cards) is shown under the table when the personal palette has couples below 4.5. Made for colour-blind or visually impaired users
- Labels for THEME_ELDY_TOPMENU_BACK1, THEME_ELDY_VERMENU_BACK1, THEME_ELDY_BACKBODY and THEME_ELDY_TEXTTITLELINK (read by the theme, never offered before)
- Permission "Set his own personal colours" (oblyon / usercolors, id 4325730) declared by the module: the Colors tab of the user card is shown (tab condition) and reachable (page guard) only with it; granted to the administrators at activation, to the others through the Permissions tab or a group. Disable / enable the module once to register the new tab condition
- Colour presets on the Colors tab of the user card: the five Oblyon presets and the new "Oblyon Accessibility" preset (presets/accessible.json, meta "scope": "user" = offered on this tab only, never on the Colors tab of the module; light background, Okabe-Ito palette readable by colour-blind people, every text / background couple above 4.5), each with "Apply to my colours" (colours only, full snapshot of the 116 constants, personal colours switched on); the user can save the colours shown as a personal preset (documents/oblyon/userpresets/<id>/<key>.json, colours only, visible to him only, download and delete on the card). New library functions oblyon_user_presets_dir / oblyon_get_user_presets / oblyon_get_presets_for_user / oblyon_preset_user_colors / oblyon_user_current_colors / oblyon_apply_preset_to_user / oblyon_save_user_preset / oblyon_delete_user_preset / oblyon_print_user_preset_cards (lib/oblyon_colors.lib.php), shared card preview oblyon_preset_card_preview() (lib/oblyon_presets.lib.php)

### Fixed
- infrassearch breadcrumb dropdown (themeoblyon/modules/infrassearch.inc.php): the hovered entry took the main colour of the preset as text colour and vanished when that colour is dark (instance preset infras-dark: #303030); the hovered row now uses the row hover background and the line text colour of the preset, like lists
- New themeoblyon/modules/mbicalls.inc.php: the calls dropdown of the mbicalls module (its stylesheet hard-codes white rows, navy texts and light pills) now follows the theme tokens (row / hover / text / link / border / neutral backgrounds / action buttons) so it matches the current preset and the personal colours; the semantic state colours (answered, missed, transferred...) are kept
- Audit of the 3.6.0 features: imported preset values are validated by type (colours, numbers, on/off, free text without markup or quotes, custom CSS without '<') and the admin colour fields escape their value (a crafted JSON could store markup shown to every admin); "Update this preset" with a partial section list keeps the other sections; preset files are written atomically (.tmp + rename) after an is_writable() check; the current-preset detection runs once per session; preset keys reject a trailing newline; #RGB previews; line breaks in the name tooltip; a database error while applying gets its own message. Colours per user: an empty field keeps the instance value ('' = auto contrast) instead of storing '#'; the tab honours the historical THEME_ELDY_ENABLE_PERSONALIZED user flag and clears it when unticked; only 6-digit hex is accepted; 'r,g,b' values are accepted only for the constants the theme normalizes; the page initialises the user card hook contexts. Theme: .alilevel0 (jmobile menu) uses the line text / background tokens (was unreadable with Night); a PHP notice in the auto-contrast of the title text removed
- Colors tab, Tabs group: THEME_ELDY_BACKTABCARD1 (background of the active tab of a card) was not offered, so it stayed white in a dark preset with a near-white tab label; it now has its row and its label
- Login page with "login form on the right" (MAIN_LOGIN_RIGHT): the card sat near the top since 3.4.1 (padding-top 12vh had replaced the former margin-top 30vw); it is back under the middle of the screen as before, with an offset computed on the screen height (55vh, the equivalent of 30vw on a 16:9 screen) and capped so that 420px stay for the card on a low window
- css/oblyon.css and css/font.css are now served through css/oblyon.css.php and css/font.css.php (module descriptor): the address no longer ends with .css, so Dolibarr appends its lang / theme / revision parameters as it already does for custom.css.php. A bare address was kept one month by the public cache of Apache and then by Cloudflare, and a modified stylesheet stayed invisible whatever the browser refresh (preset cards broken on the Colors tab after the 3.6.0 update, 2026-09-17).
- Preset cards (Colors tab of the module and of the user card): the Download button showed the icon and the "Download" label, which overflowed the button in the two-button row; the button now shows the icon only (its title already carries the full label, OblyonPresetDownload).

### Changed
- themeoblyon/style.css.php, global.inc.php, info-box.inc.php: the 121 colour reads go through oblyon_color_setting() instead of getDolGlobalString(); the 13 THEME_ELDY_* lines that already tested the user param THEME_ELDY_ENABLE_PERSONALIZED keep that behaviour (the helper honours the historical flag). Generated CSS unchanged for a user without personal colours (checked by diff)
- style.css.php no longer writes THEME_ELDY_ENABLE_PERSONALIZED = 1 as a global constant on every stylesheet request (a DELETE + INSERT on llx_const for nothing: the tests read the user param, never the global). The value seeded by data.sql stays, nothing depends on it
- The five module presets pass the WCAG 4.5 contrast check on every text / background couple the theme paints (versions 2 of the JSON files): action buttons a shade darker (#0072AD for Blue, Green, Night; #006F8A for Dark, Light), title band of Dark and Green a shade darker (#006F8A) with white title text, white title text on the red band of Light, dark green text (#0B2E1A) on the bright green side menu of Green, Dark hover / autocomplete backgrounds #006F8A; Night is now fully dark as its description says (rows #4A4A4A / #3F3F3F, inputs #333333, active tab #444444, text #ECECEC, links #9CCBFF) - its list rows, inputs and active tab were light before, with a near-invisible active tab label and dark links on dark cards. Two theme rules that painted text outside the title band with the title text colour (edit pencil on hover, level 0 of category trees) now use the current text colour, so a white title text stays readable everywhere (themeoblyon/global.inc.php). The contrast check itself was realigned on the theme (text on rows and inputs, links on rows and cards, tab text on the active tab, page title on the page background): 21 couples instead of 16
- Colors tab: the "theme" GET link and its special case in the generic update block are gone (the block first rewrote every color with '#' before applying the preset); the preset thumbnails row of the colors table is replaced by the cards above the form

### [3.5.0] - Compatibility 18.0.x - 24.0.x (2026/09/15)

### Added
- Mobile layout (Menus tab, option "Mobile layout" = OBLYON_MOBILE_LAYOUT, on by default): below 600px of screen width - the width decides, not the user agent, so it also works in a narrowed desktop window - and whatever the menu mode chosen for the desktop, the page gets a single fixed 48px top bar (menu button, logo, login block icons, full width dropdowns) and the main menu becomes an off-canvas drawer: company name, search form and bookmarks, then every module on a 48px row with its icon and label and, behind a chevron, the whole tree of its sub-menus as an accordion (the tree already built for the flyout effect of 3.4.0, now printed whenever the mobile layout is on; the current module and the branch of the current page are unfolded on the first opening; links keep navigating). Overlay, close button and Escape key close the drawer; the side bar is collapsed and the content takes the whole width. New files themeoblyon/mobile.inc.php (CSS, breakpoints 600/900px, tokens --oblyon-mobile-bar-h / --oblyon-touch-target / --oblyon-mobile-gutter) and drawer logic in js/oblyon.js; the flyout positioning and the touch toggles stand aside while the drawer is active. Disable the option to get the previous phone behaviour back (slide menu + sub-menus in the top bar)
- Mobile layout, cards: below 600px the banner becomes navigation on top, photo + reference side by side, status under (never sticky), the tabs form one strip that scrolls with the finger, the key / value tables (tableforfield, tableforfieldcreate, tableforfieldedit) show each field on two lines (label above, value under), the action buttons are stacked full width (44px high, never sticky) and the "more actions" list opens over the bottom of the screen; below 900px the two halves of a card stack in one column and the action buttons wrap
- Mobile layout, lists: below 600px the table scrolls horizontally inside its frame (global.inc.php unsets the overflow of the frame for every screen, restored there) with the first column pinned (page color under the stripe of the row, ellipsis at 45% of the screen), cells stay on one line (long texts cut with an ellipsis at 60% of the screen), the filter row is folded behind a "Filters" button inserted above the table by js/oblyon.js (unfolded from the start, with the count, when a filter is set), the mass-action bar and the title pagination wrap, rows are a little taller and checkboxes bigger for the finger
- Mobile layout, forms and dialogs: below 600px the fields of the create / edit tables (inputs, selects, textareas, select2, CKEditor) take the whole width (short fields - dates, amounts, hours - keep their size), text at 16px so iOS no longer zooms on focus, Create / Cancel side by side on the whole width and 44px high; jQuery UI dialogs (confirmations, popups) become a bottom sheet on the whole width with stacked full-width buttons (tooltip dialogs untouched), the datepicker and select2 lists fit the screen, jNotify notifications span the width under the bar
- Mobile layout, cards: the object lines table (#tablelines) and any table with 6 columns or more get a 640px minimum width inside their scrolling frame instead of squeezing every column; the documents block of the cards (table.liste.formdoc) is excluded from the list rules (pinned column, one-line cells)
- Mobile layout, fix: select2 lists opened on a phone took the whole screen and could not be closed - the core gives the select2 dropdown the "ui-dialog" class (ajax.lib.php), so the bottom-sheet rules of the dialogs applied to them; select2 lists are now excluded from those rules
- Mobile layout, cards: the tabs grouped by the core under "+N" (a phone user agent is limited to one visible tab, whatever the "maximum tabs" option) join the scrolling strip as ordinary tabs; the description column of the object lines keeps 320px (global.inc.php shrank it to 150px below 767px, leaving the description editor 136px wide) and the CKEditor tools hidden by the theme below 768px are back on phones (buttons wrap on several rows, the format / font / size combos stay hidden)
- Mobile layout, dashboard and login: below 600px the dashboard tiles and widgets are in one column (widgets scroll horizontally inside their box, stats boxes two per row), the login page is one card on the whole width with the logo above the fields, 44px fields and button; dashboard tiles are flex rows (the icon column follows the height of the content)
- Mobile layout, fix: a blank area as tall as the window scroll appeared under the content of the cards - the horizontal overflow guard was set on html and body at once, so body (100% high in the theme) became a second scroll container; the guard now sits on html only and body keeps a visible overflow and an automatic height
- Mobile layout, polish: page titles no longer wrap word by word (the right cell of the title table only takes what it needs), same gutters between the blocks of a card, badges centered on their line, a visible press on rows, buttons, tabs and drawer entries, slightly tighter dashboard tiles
- Theme rule hiding every CKEditor tool except "maximize" below 768px removed (commented out in global.inc.php): with the mobile layout the editor has a readable width and the toolbar wraps on several rows

- Options tab, CKEditor section: "WYSIWYG editor skin" (FCKEDITOR_SKIN) - the skins found in the CKEditor directory of the instance (public/includes for Dolibarr 24 and above, includes before; only directories with an editor.css), shown only when there is a choice (several skins, CKEditor engine); a warning tells when the saved skin does not exist (the editor then stays invisible). Seeded to moono-lisa (a line already set by another module is kept)

### Changed
- While the mobile layout is on, the "small screen" flag of the core (set from the browser user agent, whatever the screen width) no longer drives the theme nor the menu manager (slide-menu button, sub-menus moved to the top bar, flyout effect disabled): a phone or a tablet held in landscape gets the desktop layout, and only the width switches to the drawer
- Module JS files are declared with the module version in their address (oblyon.js?v=3.5.0): the server caches .js files for 30 days and browsers kept the previous script after an update

### Changed
- Visual base of the theme modernised for every color preset, without any new option (colors keep coming from the constants): design tokens in :root (radius derived from THEME_ELDY_BORDER_RADIUS, 3 shadow levels, neutral greys computed from the preset line background / text colors, focus color = main color, single transition); cards (div.tabBar, table.noborder, popups, photo) with rounded corners and a light shadow instead of a fixed grey frame; card tabs with a 3px accent line on the active tab, rounded top corners and no more text-shadow (duplicated tab and action-bar definitions removed); form fields with a thin complete border, theme radius, focus ring in the main color (mouse and keyboard, :focus-visible) and checkboxes/radios in the main color (accent-color), select2 aligned; buttons with a single radius, soft shadow on hover only, no more blue/pink inset reflections, refused buttons flat and neutral; badges as pills, border-only status badges on the preset line colors; messages (info/warning/error) as rounded cards, flat tooltips on the theme colors (--tooltipbgcolor was declared but never used), dropdowns and notifications on the shared shadows; dashboard tiles (info-box, boxstats) as uniform cards (no more 6px left bar, single-corner radius nor 3px top line: $borderwidth 3 -> 1); login page card vertically centered (no more margin-top 30vw), soft shadow, visible focus, background driven by OBLYON_COLOR_LOGIN_BCKGRD (constant existed but had no effect) with a title color adapted to it; typography: system font stack as fallback behind the chosen font ("System font" entry added to the font list), headings scaled from the theme font size, line-height 1.45 in the content area, antialiased smoothing; lists: one compact density on every page (cell padding 5px 8px, row line-height 1.5em, header height 34px) instead of five different ones, neutral separators from the preset, page title slightly larger, pagination on the tokens, hard-coded green (#3c6) of totals removed

### Fixed
- Invalid CSS values #8888 (jNotify shadow) and #ffff (dropdown arrow) replaced
- Autofill background (#FDFFF0) now follows the input background color

### [3.4.0] - Compatibility 18.0.x - 24.0.x (2026/09/15)

### Added
- Flyout sub-menus: third opening effect of the reduced left menu (Menus tab, inverted menus + "Reduced left menu", OBLYON_EFFECT_REDUCE_LEFTMENU = flyout, next to "Deployed at mouse-over" and "Do not deploy"). The top bar no longer holds any menu entry (only the logo, the search and the login block). Hovering an icon of the side bar opens a panel on its right with the whole sub-menu tree of the module (levels 1 to 3, nested panels for entries with children). Every link is kept (the icon still leads to the module home page). Works with the sticky side bar and with the touch mode (tap-to-toggle); ignored on phones and when the left menu is hidden. Panels use the left menu colors and the main color (rounded corners, fade-in, accent bar on hover, current page highlighted, chevron on entries with children)

### Changed
- Menus tab: the opening effect of the reduced left menu now uses its own label (OpenEffectReduce) instead of the hidden left menu one

### Fixed
- Left menu built in silent mode (`$noout`) no longer prints the "show left menu" button nor the company name

### [3.3.1] - Compatibility 18.0.x - 23.0.x (2026/07/23)

### Fixed
- Action button dropdown menu (multi-choice buttons, e.g. propal card "Create order/intervention/contract/invoice"): `.dropdown-holder` selector was missing its leading dot and never applied, and `.dropdown-content` had no default anchor below the button (both present in eldy) - the menu could end up positioned over the "Linked files" / "Last events" blocks instead of right under the button
- Sticky action bar option (FIX_ABSOLUTE_BUTTONS_ACTION_CARD): the forced upward-opening override was missing the matching transform, so the menu stayed anchored at the top of the button and extended downward over the content below instead of opening upward

### [3.3.0] - Compatibility 18.0.x - 23.0.x (2026/07/16)

### Added
- Color options for the product autocomplete highlighted row (select2 and jQuery UI "search-to-select")
- Color options for the select2 multi-select fields (tags/categories): background and text of the selected tags shown in the field, and of the already-selected options in the drop-down list

### Changed
- Buttons CSS consolidated into a dedicated file (btn.inc.php); theme values exposed through :root CSS variables
- Initial data (data.sql) made exhaustive, with "Oblyon Blue" as the default preset
- Some theme-specific constants migrated to the standard Dolibarr/Eldy ones (font family, font size, sticky top bar, action button, line hover, main title text, kanban view)

### Fixed
- Inverted sticky top menu (MAIN_MENU_INVERT + sticky): when the bar wraps onto several lines, the content below is no longer hidden behind it (offset now follows the real bar height)
- Autocomplete highlighted-row colors were not applied to the jQuery UI autocomplete used by the product search (PRODUIT_USE_SEARCH_TO_SELECT)
- FontAwesome: on module disable, all MAIN_FONTAWESOME_* constants are now cleaned so Dolibarr falls back to its default icon pack
- Theme copy/removal on enable/disable now conditioned on the absence of htdocs/VERSION (skipped on LTS distributions where the theme is pre-installed)

### [3.2.0] - Compatibility 18.0.x - 23.0.x (2026/06/19)

### Added
- Touch screen menu mode (tap-to-toggle): drop-down menus open on tap instead of :hover. Auto-detected on touch devices, plus a new option to force it (Menus tab)

### Fixed
- Drop-down menus (inverted top menu, reduced left menu) collapsing uncontrollably on touch screens because they relied on :hover. A tap now opens the sub-menu and keeps it open without loading the parent page

### [3.1.0] - Compatibility 18.0.x - 23.0.x (2025/11/08)

### Added
- Option to change the Dolibarr font family
- In admin, new tab "Icons". If you want to use other FontAwesome Pack Free Or Pro, you can select easily your new pack to apply
- In admin, add possibility to disable thumb production (MRP) on the dashboard (v23+)
- Compatibility v21 / v22 / v23

### Fixed
- CSS
- Menu (Remove categories/tags in v22 -> move to tools)

### Changed
- Move ChangeLog to format 1.1.0 of "Keep a changelog" 
- Separate the option to change the text color of line titles and the main title
- Remove Cashdesk CSS
- Move to version v18 minimum

### [3.0.6] - Compatibility 14.0.x - 20.0.x (2024/09/30)
- Fix CSS badges
- Fix CSS for FIX_AREAREF_TABACTION
- Fix print_oblyon_menu function with $noout=1 still prints something (Thanks UltraViolet33 from Easya Solutions)

### [3.0.5] - Compatibility 14.0.x - 20.0.x (2024/09/01)
- Fix Z-index with option FIX_AREAREF_TABACTION activated
- Add Use specific landing page to home menu entry (Thanks Christophe from Altairis)
- Fix display of new dropdown action button 

### [3.0.4] - Compatibility 14.0.x - 20.0.x (2024/07/03)
- Add CSS for drag & drop card feature
- Fix menu orders (customer and supplier), problem on search_billed
- If Easya version detected, force json information for dlb_min_version & php_min_version

### [3.0.3] - Compatibility 14.0.x - 20-alpha (2024/05/24)
- Fix Contract expired services menu link (From Dolibarr 18.0.x)
- FIX can not show group when MULTICOMPANY_TRANSVERSE_MODE
- Move Import menu before export menu
- Move compatibility to minimum Dolibarr 18.0 (Easya 2024) for Easya distribution

### [3.0.2] - Compatibility 14.0.x - 20-alpha (2024/05/22)
- Update ckeditor configuration
- Fix deployment from another customdir 
- Add some missing link on menu (Module skills & holiday)
- Add some missing icons on menu (Module skills, knowledge management, builder, agenda)
- Add translation for missing label recruitment in core

### [3.0.1] - Compatibility 14.0.x - 20-alpha (2024/04/29)
- Fix problem with function Show company name in invert menu (Remove function for the moment)
- Fix Access problem on custom CSS on public page
- Finish move brand editor to "Inovea-Conseil"

### [3.0.0] - Compatibility 14.0.x - 20-alpha (2024/01/13)
- Merge theme & custom directory to simplify deployment - Copy of theme directory is made when module Oblyon is enabled
- Remove old library icomoons
- Fix admin display
- Fix CSS error
- Ajust template by default

### [2.3.0] - Compatibility 14.0.x - 19-alpha (2023/11/12)
- NEW Use a lot of new color variables for compatibility with DARK_MODE
- Add a lot of variables instead of hard coded values.
- Add SQL constants for updates
- NEW system of extensions for external modules

### [2.2.12] - Compatibility 14.0.x - 19-alpha (2024/07/01)
- Remove login functionality

### [2.2.11] - Compatibility 14.0.x - 19-alpha (2023/09/12)
- Upgrade CSS Compatibility with v18/v19
- Fix token problem (CSRF) on icon page for Easya version
- Fix leftmenu min width with reduce menu (hover)

### [2.2.10] - Compatibility 14.0.x - 19-alpha (2023/09/12)
- NEW Add option to access directly in project list when you click in menu (PROJECT_FORCE_LIST_ACCESS)
- NEW Add option to show reconciliation link in menu bank (OBLYON_ENABLE_MENU_BANK_RECONCILIATE)
- Fix CSS #133 - Category Pup-Up don't show existing categories in DB v18

### [2.2.9] - Compatibility 14.0.x - 19-alpha (2023/09/01)
- NEW Add option to switch select column to the left (MAIN_CHECKBOX_LEFT_COLUMN) 
- Compatibility module Quicklist with function "Fix the reference banner and action buttons during vertical scrolling"
- Upgrade CSS Compatibility with v18/v19

### [2.2.8] - Compatibility 14.0.x - 18.0.x (2023/07/10)
- Add constant PROJECT_HIDE_MENU_TASKS_ACTIVITY to hide in project menu the link to manage activity
- Upgrade CSS

### [2.2.7] - Compatibility 14.0.x - 18beta (2023/06/21)
- Fix right access problem between personalized & tools menu
- Compatibility with Dolibarr 18-beta

### [2.2.6] - Compatibility 14.0.x - 18beta (2023/06/19)
- Fix CSS Dashboard on Easya 2022.5.3
- Fix Oblyon menu for problem in accountancy module
- Move Open-DSI to Easya Solutions
- Add support demand in about/support page
- Move customCCS to new version

### [2.2.5] - Compatibility 14.0.x - 18alpha (2023/05/09)
- Upgrade CSS
- Fix z-index for left menu if invert & with option fix area enabled
- Fix info-box in module page
- Compatibility with Dolibarr 17.0.x
- Compatibility with Dolibarr 18-alpha

### [2.2.4] - Compatibility 14.0.x - 17.0.x (2023/03/27)
- Fix color on line product selector when stock is ok (global.inc.php L5370 .product_line_stock_ok #33cc66 > #002000 | L5371 .product_line_stock_too_low #f07b6e > #884400) 
- Fix missing class
- Fix Align height of input on list
- Fix messages boxes being too large
- Add compatibility with module MyField 16.0.x
- Work in Progress - Compatibility with Dolibarr 17.0.x

### [2.2.3] - Compatibility 14.0.x - 17beta (2022/12/06)
- Temporary fix problem with bg color on icon bank_account - Problem of dolibarr's core (PR #23114)
- Unset minwidth on vmenu when menu is inverted
- Small ajust on accountancy menu
- Work in Progress - Compatibility v17beta

### [2.2.2] - Compatibility 14.0.x - 16.0.x (2022/11/28)
- Debug session

### [2.2.1] - Compatibility 14.0.x - 16.0.x (2022/11/16)
- Fix Help on color page setup : add a warning when color text is white
- Fix bis the administration menu was accessible for unpriviledged users

### [2.2.0] - Compatibility 14.0.x - 16.0.x (2022/11/08)
- New option height image on list
- Fix sticky header on list
- Fix the setup menu was accessible for unpriviledged users

### [2.1.0] - Compatibility 14.0.x - 16.0.x (2022/10/20)
- Fix topmenu-login-dropdown when using some external modules
- Add an option for Easya 2022.5.2 to fix the table column header on the elements during vertical scrolling
- Fix min width on left menu hover
- Fix select2 text align inherit

### [2.0.0] - Compatibility 14.0.x - 16.0.0 (2022/08/22)
- New versioning of the module / We start again with Oblyon v2
- Compatibility Dolibarr v16 / PHP 8 - Work in progress
- Fix some CSS
- Abandonment Markdown for Parsedown to read changelog (Compatibility PHP8)

### [14.0.2] - 16b1 (2022/06/01)
- Compatibility Dolibarr v15
- Compatibility Dolibarr v16b
- Add custom CSS page in admin
- More complete translation language en_US

### [14.0.2] - 15a1 (2022/04/24)
 - Compatibility Dolibarr v15

### [14.0.2] (2022/04/20)
 - Fix menu dropdown "checks" (cheque) with invert menu
 - Fix icon for new module reception
 - Fix icon in massaction
 - Fix link "date now"
 - Fix language in colors admin
 - Fix Settings save with multicompany (Thanks @SylvainLegrand)

### [14.0.1] (2022/03/06)
 - Compatibility Dolibarr v14 / Easya 2022.5
 - Fix restore backup system in oblyon admin
 - Fix problem with ul/ol on ticket message (Thanks @tnegre)
 - Fix problem of compatibility with infraSsearch & MBI Calls
 - Review informations

### [13.0.0] - 2021 xx xx
 - Compatibility Dolibarr v13

### [12.0.0] - 2020 06 30
 - Compatibility Dolibarr v12

### [11.0.0] - 2020 02 03
 - Compatibility Dolibarr v11
 
### [10.0 beta 3] - 2019 09 04
 - Fix Icon ticket module is missing

### [10.0 beta 2] - 2019 08 26
 - Standardize code & update - Compatibility with Dolibarr 10.0
 - New Add possibility in admin colors menu to manage colors of the buttons
 - WIP New Add Sticky bar for left menu
 
### [10.0 beta 1] - 2019 06 08
 - Standardize code & update - Compatibility with Dolibarr 10.0

### [9.1.2] - 2019 08 22
 - CSS | Add level3 for menu
 - Fix assets menu
 - New Add some icons on menu
 - Fix accountancy menu

### [9.1.1] - 2019 04 22
 - Improve login page

### [9.1.0] - 2019 04 08
 - Merge 8.1.0

### [9.0.1] - 2019 04 06
 - Update author for Mathieu -> Monogramm
 - Fix issue in admin menu display

### [9.0.0] - 2018 12 05
 - Standardize code & update - Compatibility with Dolibarr 9.0
 - Update copyright for Alexandre -> Open-DSI
 - Some improvement to display menu

### [8.1.1] - 2019 04 21
 - Fixed: Fix login action display

### [8.1.0] - 2019 04 08
 - Added: Improve cash desk display
 - Added: Improve borders and shadows
 - Added: New templates and properties
 - Added: Missing translations

### [8.0.1] - 2019 04 06
 - Added: install / usage info and move changelog to module

### [8.0.0] - 2018 10 29
 - Standardize code & update - Compatibility with Dolibarr 8.0

### [8.0 beta 1] - 2018 07 22
 - Standardize code & update - Compatibility with Dolibarr 8.0

### [7.0 beta 1] - 2018 03 08
 - Standardize code & update - Compatibility with Dolibarr 7.0 (Fix #13)

### [6.0 beta 1] - 2017 11 17
 - Standardize code & update - Compatibility with Dolibarr 6.0

### [4.0.0]
 - Fixed: 4.0 Correct link to projects
 - Added: 5.0 Add editor name and link in module descriptor

### [4.0 beta 2]
 - Added: 5.0 Add menu page index for accountancy module
 - Fixed: 5.0 Menu Accountancy Better terminology
 - Added: 5.0 Add menu system tool "Files integrity checker" to detect modified files
 - Added: 5.0 Pagination available on list of users
 - Fixed: 4.0 Missing a filter billed=0 into link of billable orders
 - Added: 5.0 Menu social contribution has moved
 - Added: 5.0 HRM Area has moved
 - Fixed: 4.0 Menu closing
 - Fixed: 4.0 Correct link to propals

### [4.0 beta 1]
 - Added: Add template Oblyon Green & new options to configurate colors
 - Added: Compatibility with Dolibarr 4.0
 - Increase number [to align to Dolibarr version
 - Fixed: When the menu is inverted, search bar don't show
 - New: 4.0 Add icon external.png

### [2.2]
 - Fixed: old menu manager deletion if still exist
 - Added: jQuery modules Datatable and Select2
 - Added: Holiday module
 - Fixed: select2 plugin list display
 - Fixed: missing default logo when menu inverted
 - Fixed: missing icons in login area (Multicompany compatibility)
 - New: design of login block area (need improvment)
 - New: Dolibarr 4.0 Module Expense Report have moved into menu files
 - New: Css add badge & input for multicompany in login box
 - Fixed: Update bad link in menu Thirdparty for Dolibarr 3.9
 - New: 4.0 HRM Area has moved
 - New: 4.0 Add icon for website module
 - New: Try to make the theme more responsive

### [2.2 RC]
 - Fixed: Add new search bar for Dolibarr 3.9
 - New: Oblyon theme "forced" when oblyon module activated
 - Fixed: missing top icons with oblyon theme using eldy menu
 - Fixed: missing default logo and logo size
 - Added: user and help top icons for Dolibarr 3.9 (font-oblyon)
 - Added: printer_top.png and logout_top.png icons for Dolibarr 3.9 
 - Added: object_building, object_supplier_proposal, object_task_time and title_hrm
 - Fixed: css
 - Added: Add a button in color tab to restore default colors of Oblyon

### [2.2 beta 3]
 - Updated: About page
 - Fixed: Missing language file for accountancy module
 - Fixed: Some links are modified for customers invoices in Dolibarr 3.8
 - Upgraded: Comptability with Dolibarr 3.9-beta (HRM)
 - Added: Possibility to define maincolor & color background of the template in admin color tab
 - Fixed: Add a max-width for logo display (200px max & 180 px with padding)
 - Added: icon helpdoc_top.png for Dolibarr 3.9
 - Fixed: Refactoring admin menu page & add missing language key
 - Added: Review menu of accountancy expert module since 3.7 (Specific development)

### [2.2 beta 2]
 - Upgraded: Compatibility with Dolibarr 3.9-beta
 - Upgraded: Modify link for donation module
 - Added: a tab color in admin
	* Possibility to define color logo background

### [2.2 beta 1]
 - Upgraded: Compatibility with Dolibarr 3.9-beta
 - Upgraded: Compatibility with Dolibarr 3.8
 - Fixed: Replace constant $conf->global->MAIN_VERSION_LAST_UPGRADE by DOL_[in Oblyon Menu
	* The first constant are empty when it's a fresh install
 - Added: an entry in the menu for the new module expense report in hrm 
 - Added: object_gravatar
 - Added: object_printer
 - Fixed: Typo Dictionnary -> Dictionary

### [2.1]
 - Upgraded: Compatibility with Dolibarr 3.7
 - Upgraded: Compatibility with Dolibarr 3.5.x
 - Fixed: Menu entries for Dolibarr 3.5.x, 3.6.x and 3.7
 - Fixed: Skin of menu entries disabled 
 - Added: New option Eldy icons (v3.7)
 - Fixed: Eldy icons size
 - Updaded: ckeditor.js
 - Fixed: Login message error 
 - Changed: Login message skin available only for 3.7 and higher versions
 - Changed: Logo options shown only when logo activated
 - Added: New title images and missing images from previous versions

### [2.0]
 - Updated: New options panel 
 - Added: Invert menus option
 - Added: Pushy left menu
 - Added: Company name
 - Added: Fullsize Logo and mini logo on small devices (left menu)
 - Updated: Completely rewritten menus (OOCSS)
 - Updated: CSS code restructured and cleaned up
 - Updated: Right-to-left language ready
 - Added: Eric Meyer's Reset CSS
 - Added: New login area icons
 - Added: Transition effects
 - Fixed: Active tab background (a.tab.tabactive)
 - Fixed: Login page message
 - Added: Cursor not-allowed on input and select areas
 - Fixed: Bookmarks section links

### [1.7]
 - Updated: New license CC BY-NC 4.0	

### [1.6]
 - Upgraded: Compatibility with Dolibarr 3.6 (thanks to A. Spangaro)
 
### [1.5]
 - Added: Define Colors Feature (see style.css.php file, section Define Colors)
 - Fixed: Minor bugs
 
### [1.4]
 - Added: Holiday category and icons 
 - Updated: ckeditor.js
 - Updated: Images license
 
### [1.3.1]
 - Fixed: Icons display issue (Left Menu)
 
### [1.3]
 - Added: Extra Cashdesk icons (oblyon/img/cashdesk)
 - Added: sort-asc and sort-desc icons
 - Added: Skype icon
 - Added: Reports module icon
 - Changed: Icons size (Left Menu)
 - Upgraded: Compatibility with **[DoliDroid](https://play.google.com/store/apps/details?id=com.nltechno.dolidroidpro "DoliDroid")** for Dolibarr v3.5 and v3.4.x (thanks to Eldy)

### [1.2]
 - Stylized: Cashdesk module interface 
 - Removed: Message of the day style
 - Fixed: Background color for vertical menu when menus managers are different
 - Stylized: Notification area
 - Updated: Thumb Oblyon logo
 - Added: Extra weather icons (oblyon/img/weather)
 - Fixed: Minor bugs

### [1.1]
 - Stylized: Message of the day
 - Removed: Navigation bar in "print" mode.
 - Simplification of the help area. 
 - Changed: helpdoc.png icon
 - Added: grip_title.png and close_title.png icons (v3.5)
 - Stylized: Statistics box (v3.5)
 - Stylized: Graphs (colors can be easily changed in graph-color.php)
 - Changed: Fonts - font-family (mostly Open Sans)
 - Added: variables in style.css.php to change fonts
 - Added: Icons Scanner, BitTorrent, Cron and "Comptabilite Expert"
 - Fixed: Icons coming from external modules are now visible 
 - Changed: Generic icon (only one now)
 - Added: Changelog
 - Fixed: Visual corrections
 - Fixed: Minor bugs

### [1.0.1]
 - Fixed: Warning PHP message 
 - Changed: Logo Oblyon

### [1.0]
 - Initial release