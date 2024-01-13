## Changelog ##

### Version 2.3.0 - Compatibility 14.0.x - 19-alpha (2023/11/12)
- NEW Use a lot of new color variables for compatibility with DARK_MODE
  - Add a lot of variables instead of hard coded values.
  - Add SQL constants for updates
- NEW system of extensions for external modules

### Version 2.2.12 - Compatibility 14.0.x - 19-alpha (2024/07/01)
- Remove login functionality

### Version 2.2.11 - Compatibility 14.0.x - 19-alpha (2023/09/12)
- Upgrade CSS Compatibility with v18/v19
- Fix token problem (CSRF) on icon page for Easya version
- Fix leftmenu min width with reduce menu (hover)

### Version 2.2.10 - Compatibility 14.0.x - 19-alpha (2023/09/12)
- NEW Add option to access directly in project list when you click in menu (PROJECT_FORCE_LIST_ACCESS)
- NEW Add option to show reconciliation link in menu bank (OBLYON_ENABLE_MENU_BANK_RECONCILIATE)
- Fix CSS #133 - Category Pup-Up don't show existing categories in DB v18

### Version 2.2.9 - Compatibility 14.0.x - 19-alpha (2023/09/01)
- NEW Add option to switch select column to the left (MAIN_CHECKBOX_LEFT_COLUMN) 
- Compatibility module Quicklist with function "Fix the reference banner and action buttons during vertical scrolling"
- Upgrade CSS Compatibility with v18/v19

### Version 2.2.8 - Compatibility 14.0.x - 18.0.x (2023/07/10)
- Add constant PROJECT_HIDE_MENU_TASKS_ACTIVITY to hide in project menu the link to manage activity
- Upgrade CSS

### Version 2.2.7 - Compatibility 14.0.x - 18beta (2023/06/21)
- Fix right access problem between personalized & tools menu
- Compatibility with Dolibarr 18-beta

### Version 2.2.6 - Compatibility 14.0.x - 18beta (2023/06/19)
- Fix CSS Dashboard on Easya 2022.5.3
- Fix Oblyon menu for problem in accountancy module
- Move Open-DSI to Easya Solutions
- Add support demand in about/support page
- Move customCCS to new version

### Version 2.2.5 - Compatibility 14.0.x - 18alpha (2023/05/09)
- Upgrade CSS
- Fix z-index for left menu if invert & with option fix area enabled
- Fix info-box in module page
- Compatibility with Dolibarr 17.0.x
- Compatibility with Dolibarr 18-alpha

### Version 2.2.4 - Compatibility 14.0.x - 17.0.x (2023/03/27)
- Fix color on line product selector when stock is ok (global.inc.php L5370 .product_line_stock_ok #33cc66 > #002000 | L5371 .product_line_stock_too_low #f07b6e > #884400) 
- Fix missing class
- Fix Align height of input on list
- Fix messages boxes being too large
- Add compatibility with module MyField 16.0.x
- Work in Progress - Compatibility with Dolibarr 17.0.x

### Version 2.2.3 - Compatibility 14.0.x - 17beta (2022/12/06)
- Temporary fix problem with bg color on icon bank_account - Problem of dolibarr's core (PR #23114)
- Unset minwidth on vmenu when menu is inverted
- Small ajust on accountancy menu
- Work in Progress - Compatibility v17beta

### Version 2.2.2 - Compatibility 14.0.x - 16.0.x (2022/11/28)
- Debug session

### Version 2.2.1 - Compatibility 14.0.x - 16.0.x (2022/11/16)
- Fix Help on color page setup : add a warning when color text is white
- Fix bis the administration menu was accessible for unpriviledged users

### Version 2.2.0 - Compatibility 14.0.x - 16.0.x (2022/11/08)
- New option height image on list
- Fix sticky header on list
- Fix the setup menu was accessible for unpriviledged users

### Version 2.1.0 - Compatibility 14.0.x - 16.0.x (2022/10/20)
- Fix topmenu-login-dropdown when using some external modules
- Add an option for Easya 2022.5.2 to fix the table column header on the elements during vertical scrolling
- Fix min width on left menu hover
- Fix select2 text align inherit

### Version 2.0.0 - Compatibility 14.0.x - 16.0.0 (2022/08/22)
- New versioning of the module / We start again with Oblyon v2
- Compatibility Dolibarr v16 / PHP 8 - Work in progress
- Fix some CSS
- Abandonment Markdown for Parsedown to read changelog (Compatibility PHP8)

### Version 14.0.2 - 16b1 (2022/06/01)
- Compatibility Dolibarr v15
- Compatibility Dolibarr v16b
- Add custom CSS page in admin
- More complete translation language en_US

### Version 14.0.2 - 15a1 (2022/04/24)
 - Compatibility Dolibarr v15

### Version 14.0.2 (2022/04/20)
 - Fix menu dropdown "checks" (cheque) with invert menu
 - Fix icon for new module reception
 - Fix icon in massaction
 - Fix link "date now"
 - Fix language in colors admin
 - Fix Settings save with multicompany (Thanks @SylvainLegrand)

### Version 14.0.1 (2022/03/06)
 - Compatibility Dolibarr v14 / Easya 2022.5
 - Fix restore backup system in oblyon admin
 - Fix problem with ul/ol on ticket message (Thanks @tnegre)
 - Fix problem of compatibility with infraSsearch & MBI Calls
 - Review informations

### Version 13.0.0 - 2021 xx xx
 - Compatibility Dolibarr v13

### Version 12.0.0 - 2020 06 30
 - Compatibility Dolibarr v12

### Version 11.0.0 - 2020 02 03
 - Compatibility Dolibarr v11
 
### Version 10.0 beta 3 - 2019 09 04
 - Fix Icon ticket module is missing

### Version 10.0 beta 2 - 2019 08 26
 - Standardize code & update - Compatibility with Dolibarr 10.0
 - New Add possibility in admin colors menu to manage colors of the buttons
 - WIP New Add Sticky bar for left menu
 
### Version 10.0 beta 1 - 2019 06 08
 - Standardize code & update - Compatibility with Dolibarr 10.0

### Version 9.1.2 - 2019 08 22
 - CSS | Add level3 for menu
 - Fix assets menu
 - New Add some icons on menu
 - Fix accountancy menu

### Version 9.1.1 - 2019 04 22
 - Improve login page

### Version 9.1.0 - 2019 04 08
 - Merge 8.1.0

### Version 9.0.1 - 2019 04 06
 - Update author for Mathieu -> Monogramm
 - Fix issue in admin menu display

### Version 9.0 - 2018 12 05
 - Standardize code & update - Compatibility with Dolibarr 9.0
 - Update copyright for Alexandre -> Open-DSI
 - Some improvement to display menu

### Version 8.1.1 - 2019 04 21
 - Fixed: Fix login action display

### Version 8.1.0 - 2019 04 08
 - Added: Improve cash desk display
 - Added: Improve borders and shadows
 - Added: New templates and properties
 - Added: Missing translations

### Version 8.0.1 - 2019 04 06
 - Added: install / usage info and move changelog to module

### Version 8.0 - 2018 10 29
 - Standardize code & update - Compatibility with Dolibarr 8.0

### Version 8.0 beta 1 - 2018 07 22
 - Standardize code & update - Compatibility with Dolibarr 8.0

### Version 7.0 beta 1 - 2018 03 08
 - Standardize code & update - Compatibility with Dolibarr 7.0 (Fix #13)

### Version 6.0 beta 1 - 2017 11 17
 - Standardize code & update - Compatibility with Dolibarr 6.0

### Version 4.0.0
 - Fixed: 4.0 Correct link to projects
 - Added: 5.0 Add editor name and link in module descriptor

### Version 4.0 beta 2
 - Added: 5.0 Add menu page index for accountancy module
 - Fixed: 5.0 Menu Accountancy Better terminology
 - Added: 5.0 Add menu system tool "Files integrity checker" to detect modified files
 - Added: 5.0 Pagination available on list of users
 - Fixed: 4.0 Missing a filter billed=0 into link of billable orders
 - Added: 5.0 Menu social contribution has moved
 - Added: 5.0 HRM Area has moved
 - Fixed: 4.0 Menu closing
 - Fixed: 4.0 Correct link to propals

### Version 4.0 beta 1
 - Added: Add template Oblyon Green & new options to configurate colors
 - Added: Compatibility with Dolibarr 4.0
 - Increase number version to align to Dolibarr version
 - Fixed: When the menu is inverted, search bar don't show
 - New: 4.0 Add icon external.png

### Version 2.2
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

### Version 2.2 RC
 - Fixed: Add new search bar for Dolibarr 3.9
 - New: Oblyon theme "forced" when oblyon module activated
 - Fixed: missing top icons with oblyon theme using eldy menu
 - Fixed: missing default logo and logo size
 - Added: user and help top icons for Dolibarr 3.9 (font-oblyon)
 - Added: printer_top.png and logout_top.png icons for Dolibarr 3.9 
 - Added: object_building, object_supplier_proposal, object_task_time and title_hrm
 - Fixed: css
 - Added: Add a button in color tab to restore default colors of Oblyon

### Version 2.2 beta 3
 - Updated: About page
 - Fixed: Missing language file for accountancy module
 - Fixed: Some links are modified for customers invoices in Dolibarr 3.8
 - Upgraded: Comptability with Dolibarr 3.9-beta (HRM)
 - Added: Possibility to define maincolor & color background of the template in admin color tab
 - Fixed: Add a max-width for logo display (200px max & 180 px with padding)
 - Added: icon helpdoc_top.png for Dolibarr 3.9
 - Fixed: Refactoring admin menu page & add missing language key
 - Added: Review menu of accountancy expert module since 3.7 (Specific development)

### Version 2.2 beta 2
 - Upgraded: Compatibility with Dolibarr 3.9-beta
 - Upgraded: Modify link for donation module
 - Added: a tab color in admin
	* Possibility to define color logo background

### Version 2.2 beta 1
 - Upgraded: Compatibility with Dolibarr 3.9-beta
 - Upgraded: Compatibility with Dolibarr 3.8
 - Fixed: Replace constant $conf->global->MAIN_VERSION_LAST_UPGRADE by DOL_VERSION in Oblyon Menu
	* The first constant are empty when it's a fresh install
 - Added: an entry in the menu for the new module expense report in hrm 
 - Added: object_gravatar
 - Added: object_printer
 - Fixed: Typo Dictionnary -> Dictionary

### Version 2.1
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

### Version 2.0
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

### Version 1.7
 - Updated: New license CC BY-NC 4.0	

### Version 1.6
 - Upgraded: Compatibility with Dolibarr 3.6 (thanks to A. Spangaro)
 
### Version 1.5
 - Added: Define Colors Feature (see style.css.php file, section Define Colors)
 - Fixed: Minor bugs
 
### Version 1.4
 - Added: Holiday category and icons 
 - Updated: ckeditor.js
 - Updated: Images license
 
### Version 1.3.1
 - Fixed: Icons display issue (Left Menu)
 
### Version 1.3
 - Added: Extra Cashdesk icons (oblyon/img/cashdesk)
 - Added: sort-asc and sort-desc icons
 - Added: Skype icon
 - Added: Reports module icon
 - Changed: Icons size (Left Menu)
 - Upgraded: Compatibility with **[DoliDroid](https://play.google.com/store/apps/details?id=com.nltechno.dolidroidpro "DoliDroid")** for Dolibarr v3.5 and v3.4.x (thanks to Eldy)

### Version 1.2
 - Stylized: Cashdesk module interface 
 - Removed: Message of the day style
 - Fixed: Background color for vertical menu when menus managers are different
 - Stylized: Notification area
 - Updated: Thumb Oblyon logo
 - Added: Extra weather icons (oblyon/img/weather)
 - Fixed: Minor bugs

### Version 1.1
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

### Version 1.0.1
 - Fixed: Warning PHP message 
 - Changed: Logo Oblyon

### Version 1.0
 - Initial release