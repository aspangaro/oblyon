/* InfraS add : fichier ajoute par InfraS (2026-10) */
/* ================================================================================================
   oblyon/js/takepos.js (3.9.0)
   Role       : caisse TakePOS : dispositions Comptoir / Tablette / Superette, edition rapide des lignes, raccourcis clavier,
                couleurs des categories
   Charge par : ActionsOblyon::addHtmlHeader(), sur takepos/index.php seulement (defer) ; reglages dans window.oblyonPos
   Regles     : aucun libelle en dur (window.oblyonPos.labels) ; toutes les actions passent par TakePOS lui-meme (invoice.php :
                updateqty / updatereduction ; fonctions Edit, deleteline, CloseBill, LoadProducts) : memes droits, memes controles.
                Les fonctions et variables globales de TakePOS (place, currentcat, editaction, editnumber, selectedline) sont lues
                ou appelees, jamais redefinies, sauf LoadProducts, enveloppee pour suivre la categorie affichee
   ================================================================================================ */
(function () {
	'use strict';

	var cfg			= window.oblyonPos || {};
	var labels		= cfg.labels || {};
	var root		= document.documentElement;
	var layout		= cfg.layout || '';							// counter | tablet | scanner | '' (natif, natif ameliore)
	var editing		= !!cfg.theme && cfg.theme !== 'native';	// edition rapide des lignes et raccourcis : tous les themes sauf natif
	var colors		= {};
	var catLabels	= {};
	var selectedId	= '';	// identifiant (tr) de la derniere ligne choisie : resselectionnee apres chaque rechargement du ticket
	var lastUrl		= '';	// derniere adresse appelee en ajax : le pave en panneau se referme apres une modification
	var doneState	= '';	// apres un paiement : 'done' (vente terminee, bouton Nouvelle vente) puis 'reprint' (vente suivante, reimpression possible)
	var doneTimer	= null;	// compte a rebours de la nouvelle vente automatique

	function byId(id) {
		return document.getElementById(id);
	}

	function esc(text) {
		var div	= document.createElement('div');
		div.textContent	= (text === undefined || text === null) ? '' : String(text);
		return div.innerHTML;
	}

	function ticketLines() {
		var box	= byId('poslines');
		return box ? Array.prototype.slice.call(box.querySelectorAll('tr.posinvoiceline')) : [];
	}

	function selectedLine() {
		var box	= byId('poslines');
		return box ? box.querySelector('tr.posinvoiceline.selected') : null;
	}

	function clickLine(tr) {
		if (tr && window.jQuery) {
			window.jQuery(tr).trigger('click');	// gestionnaire de TakePOS (invoice.php) : selectedline, selectedtext, classe selected
		}
	}

	function loadTicket(action, idline, number) {
		if (!window.jQuery || !idline) {
			return;
		}
		selectedId	= String(idline);
		window.jQuery('#poslines').load('invoice.php?action=' + action + '&token=' + encodeURIComponent(cfg.token || '') + '&place=' + encodeURIComponent(window.place === undefined ? 0 : window.place) + '&idline=' + encodeURIComponent(idline) + '&number=' + encodeURIComponent(number));
	}

	/* Couleurs des categories ****************************************************************** */
	function collect(list) {
		if (!list) {
			return;
		}
		Object.keys(list).forEach(function (key) {
			var cat	= list[key];
			if (!cat) {
				return;
			}
			catLabels[String(cat.rowid)]	= cat.label;
			if (/^[0-9a-fA-F]{6}$/.test(cat.color || '')) {
				colors[String(cat.rowid)]	= '#' + cat.color;
			}
		});
	}

	function paint(tile) {
		var color	= '';
		var rowid	= tile.getAttribute('data-rowid');
		var search	= byId('search');
		if (tile.className.indexOf('divempty') < 0 && rowid) {
			if (tile.id.indexOf('catdiv') === 0 || tile.getAttribute('data-iscat') == '1') {
				color	= colors[rowid] || '';
			} else if (!search || search.value === '') {
				color	= colors[String(window.currentcat)] || '';
			}
		}
		if (color) {
			tile.style.setProperty('--oblyon-pos-cat', color);
		} else {
			tile.style.removeProperty('--oblyon-pos-cat');
		}
		if (tile.classList.contains('oblyon-pos-hascat') !== (color !== '')) {
			tile.classList.toggle('oblyon-pos-hascat');	// seulement si l'etat change : l'observateur surveille l'attribut class
		}
	}

	function initColors() {
		if (!cfg.catcolors) {
			return;
		}
		var observer	= new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) {
				paint(mutation.target);
			});
		});
		document.querySelectorAll('div.div4 div[id^="catdiv"], div.div5 div[id^="prodiv"]').forEach(function (tile) {
			paint(tile);
			observer.observe(tile, {attributes: true, attributeFilter: ['data-rowid', 'data-iscat', 'class']});
		});
	}

	function markActiveCategory() {
		document.querySelectorAll('div.div4 div[id^="catdiv"]').forEach(function (tile) {
			var active	= tile.getAttribute('data-rowid') !== null && tile.getAttribute('data-rowid') === String(window.currentcat);
			if (tile.classList.contains('oblyon-pos-activecat') !== active) {
				tile.classList.toggle('oblyon-pos-activecat');
			}
		});
	}

	/* Edition rapide des lignes **************************************************************** */
	// le hook completeTakePosInvoiceLine ajoute une cellule -/+ juste apres la description ; on la fond dans la colonne Qte de TakePOS
	// (derniere cellule td.linecolqty de l'en-tete) sous forme de selecteur [ - ] quantite [ + ], puis on retire la cellule et son en-tete vide.
	// Sans en-tete reconnu, la cellule reste en place (repli : boutons dans leur propre colonne)
	function decorateLines() {
		var table	= document.querySelector('#poslines table#tablelines');
		var head	= table ? table.querySelector('tr.liste_titre') : null;
		var headCtl	= head ? head.querySelector('td.oblyon-pos-linectl') : null;
		if (!headCtl) {
			return;
		}
		var index	= -1;
		Array.prototype.forEach.call(head.children, function (td, position) {
			if (td.classList.contains('linecolqty')) {
				index	= position;
			}
		});
		if (index < 0) {
			return;
		}
		head.children[index].classList.add('oblyon-pos-qtycell');	// en-tete Qte centre au-dessus du selecteur
		ticketLines().forEach(function (tr) {
			var ctl		= tr.querySelector('td.oblyon-pos-linectl');
			var qtyCell	= tr.children[index];
			if (!ctl || !qtyCell || qtyCell === ctl) {
				return;
			}
			var stepper	= document.createElement('span');
			var value	= document.createElement('span');
			var first	= qtyCell.firstChild;
			stepper.className	= 'oblyon-pos-stepper';
			stepper.setAttribute('data-qty', ctl.getAttribute('data-qty'));
			value.className		= 'oblyon-pos-qtyval';
			if (first && first.nodeType === 3 && first.textContent.trim() !== '') {
				value.textContent	= first.textContent.trim();	// quantite imprimee par TakePOS
				qtyCell.removeChild(first);
			} else {
				value.textContent	= ctl.getAttribute('data-qty');
			}
			stepper.appendChild(ctl.querySelector('.oblyon-pos-minus'));
			stepper.appendChild(value);
			stepper.appendChild(ctl.querySelector('.oblyon-pos-plus'));
			qtyCell.insertBefore(stepper, qtyCell.firstChild);
			qtyCell.classList.add('oblyon-pos-qtycell');
			tr.removeChild(ctl);
		});
		head.removeChild(headCtl);
	}

	function stepLine(tr, step) {
		if (!tr) {
			return;
		}
		var cell	= tr.querySelector('[data-qty]');	// selecteur dans la colonne Qte, ou cellule du hook (repli)
		var qty		= cell ? parseFloat(cell.getAttribute('data-qty')) : NaN;
		if (isNaN(qty) || isNaN(step)) {
			return;
		}
		var next	= Math.round((qty + step) * 1000) / 1000;
		if (next > 0) {
			loadTicket('updateqty', tr.id, next);
			return;
		}
		window.selectedline	= tr.id;	// quantite a zero : suppression de la ligne par TakePOS (deleteline supprime la ligne selectionnee)
		selectedId			= '';
		if (typeof window.deleteline === 'function') {
			window.deleteline();
		}
	}

	function discount(pct) {
		var tr	= selectedLine() || ticketLines().slice(-1)[0];
		if (tr) {
			loadTicket('updatereduction', tr.id, pct);
		}
	}

	// mode du pave (qty | p | r) : un nombre tape dans la recherche (clavier) est applique a la ligne, sinon le bouton du pave est arme
	function armMode(mode, buttonId) {
		var search	= byId('search');
		var value	= search ? search.value.trim().replace(',', '.') : '';
		if (!selectedLine()) {
			clickLine(ticketLines().slice(-1)[0]);
		}
		if (/^\d+(\.\d+)?$/.test(value) && typeof window.Edit === 'function' && selectedLine()) {
			window.editaction	= mode;
			window.editnumber	= value;
			window.Edit(mode);	// mode deja arme + nombre saisi : TakePOS envoie la modification (invoice.php)
			if (typeof window.ClearSearch === 'function') {
				window.ClearSearch(true);
			}
		} else if (byId(buttonId)) {
			byId(buttonId).click();
		}
	}

	function moveSelection(direction) {
		var list	= ticketLines();
		if (!list.length) {
			return;
		}
		var index	= list.indexOf(selectedLine());
		index		= index < 0 ? (direction > 0 ? 0 : list.length - 1) : Math.max(0, Math.min(list.length - 1, index + direction));
		clickLine(list[index]);
	}

	function onKey(event) {
		if (event.key === 'F9') {
			event.preventDefault();
			if (doneState === 'done') {
				newSale();	// vente terminee : F9 demarre la vente suivante
			} else if (typeof window.CloseBill === 'function') {
				window.CloseBill();
			}
			return;
		}
		if (event.key === 'Escape') {
			root.classList.remove('oblyon-pos-numpad-open');
			return;
		}
		if (!event.altKey || event.ctrlKey || event.metaKey) {
			return;
		}
		var key		= event.key.toLowerCase();
		var handled	= true;
		if (key === 'q') {
			armMode('qty', 'qty');
		} else if (key === 'p') {
			armMode('p', 'price');
		} else if (key === 'r') {
			armMode('r', 'reduction');
		} else if (key === 'arrowup' || key === 'arrowdown') {
			moveSelection(key === 'arrowup' ? -1 : 1);
		} else if (key === 'arrowleft' || key === 'arrowright') {
			stepLine(selectedLine(), key === 'arrowleft' ? -1 : 1);
		} else if (key === 'x' || key === 'delete') {
			if (typeof window.deleteline === 'function') {
				window.deleteline();
			}
		} else if (key === 'n' && layout && layout !== 'tablet') {
			root.classList.toggle('oblyon-pos-numpad-open');
		} else {
			handled	= false;
		}
		if (handled) {
			event.preventDefault();
		}
	}

	function onClick(event) {
		var target	= event.target;
		if (!target.closest) {
			return;
		}
		var button	= target.closest('.oblyon-pos-qtybtn');
		if (button) {
			event.preventDefault();
			event.stopPropagation();	// le clic sur +/- ne passe pas au gestionnaire de la ligne
			stepLine(button.closest('tr.posinvoiceline'), parseFloat(button.getAttribute('data-step')));
			return;
		}
		var tr		= target.closest('tr.posinvoiceline');
		if (tr && tr.id) {
			selectedId	= tr.id;
			if (layout === 'counter') {
				root.classList.add('oblyon-pos-numpad-open');	// Comptoir : toucher une ligne ouvre le pave
			}
		}
	}

	/* Apres le paiement ************************************************************************ */
	// TakePOS garde le ticket paye affiche jusqu'a un clic sur Nouveau (absent en mode bar / restaurant) et vide les tuiles produits.
	// Ici : barre « Vente terminee » (boutons d'impression du ticket paye recopies, bouton Nouvelle vente avec compte a rebours),
	// puis nouvelle vente par la meme action que le bouton Nouveau de TakePOS (invoice.php action=delete : ne vide que le brouillon
	// de la table, jamais une facture validee) et rechargement des produits de la categorie affichee
	function reloadCategory() {
		if (typeof window.LoadProducts !== 'function') {
			return;
		}
		var tiles	= Array.prototype.slice.call(document.querySelectorAll('div.div4 div[id^="catdiv"]'));
		var active	= tiles.filter(function (tile) {
			return tile.getAttribute('data-rowid') !== null && tile.getAttribute('data-rowid') === String(window.currentcat);
		})[0];
		var tile	= active || tiles.filter(function (tile) {
			return tile.getAttribute('data-rowid');
		})[0];
		if (tile) {
			window.LoadProducts(parseInt(tile.id.replace('catdiv', ''), 10));
		}
	}

	function stopTimer() {
		if (doneTimer) {
			window.clearInterval(doneTimer);
			doneTimer	= null;
		}
	}

	function clearDone() {
		stopTimer();
		doneState	= '';
		root.classList.remove('oblyon-pos-done');
		var bar	= document.querySelector('.oblyon-pos-donebar');
		if (bar) {
			bar.parentNode.removeChild(bar);
		}
	}

	function newSale() {
		stopTimer();
		root.classList.remove('oblyon-pos-done');
		doneState	= 'reprint';
		var button	= document.querySelector('.oblyon-pos-newsale');
		if (button) {
			button.parentNode.removeChild(button);
		}
		selectedId	= '';
		if (window.jQuery) {
			window.jQuery('#poslines').load('invoice.php?action=delete&token=' + encodeURIComponent(cfg.token || '') + '&place=' + encodeURIComponent(window.place === undefined ? 0 : window.place));
		}
		reloadCategory();
	}

	function enterDone() {
		clearDone();
		var paybar	= document.querySelector('.oblyon-pos-paybar');
		if (!paybar) {
			return;	// Natif ameliore : pas de barre de paiement, fonctionnement d'origine de TakePOS (bouton Nouveau)
		}
		doneState	= 'done';
		if (paybar) {
			var bar		= document.createElement('div');
			bar.className	= 'oblyon-pos-donebar';
			bar.innerHTML	= '<div class="oblyon-pos-done-title"><span class="fa fa-check-circle"></span> ' + esc(labels.saleDone) + '</div><div class="oblyon-pos-reprint"></div>'
				+ '<button type="button" class="oblyon-pos-newsale"><span class="fa fa-plus-circle"></span> <span class="oblyon-pos-newsale-label">' + esc(labels.newSale) + '</span></button>';
			// boutons d'impression du ticket paye (TakePOS) recopies : leur onclick porte l'identifiant de la facture, ils restent valables apres la nouvelle vente
			document.querySelectorAll('#poslines button[onclick]').forEach(function (button) {
				if (/Print|Printing|PrintBox|TakeposConnector/.test(button.getAttribute('onclick'))) {
					var copy	= button.cloneNode(true);
					copy.removeAttribute('id');
					copy.className	= 'oblyon-pos-reprintbtn';
					bar.querySelector('.oblyon-pos-reprint').appendChild(copy);
				}
			});
			bar.querySelector('.oblyon-pos-newsale').addEventListener('click', newSale);
			paybar.insertBefore(bar, paybar.firstChild);
			root.classList.add('oblyon-pos-done');
		}
		var seconds	= parseInt(cfg.autoNewSale, 10) || 0;
		if (seconds > 0) {
			var label	= document.querySelector('.oblyon-pos-newsale-label');
			if (label) {
				label.textContent	= labels.newSale + ' (' + seconds + ')';
			}
			doneTimer	= window.setInterval(function () {
				seconds--;
				if (label) {
					label.textContent	= labels.newSale + ' (' + seconds + ')';
				}
				if (seconds <= 0) {
					newSale();
				}
			}, 1000);
		}
	}

	function syncTotal() {
		var spans	= document.querySelectorAll('#poslines #linecolht-span-total');
		var value	= spans.length ? spans[spans.length - 1].textContent.trim() : '';
		document.querySelectorAll('.oblyon-pos-total-value, .oblyon-pos-pay-amount').forEach(function (el) {
			el.textContent	= value;
		});
	}

	function afterTicket() {
		if (editing) {
			if (/action=valid/.test(lastUrl)) {
				enterDone();	// paiement valide (invoice.php action=valid appele par pay.php)
			} else if (doneState === 'done' || (doneState === 'reprint' && !/action=delete/.test(lastUrl))) {
				clearDone();	// article ajoute, autre ticket ouvert : fin de l'etat apres paiement
			}
			decorateLines();
			if (!selectedLine() && selectedId) {
				var tr	= byId(selectedId);
				if (tr && tr.classList.contains('posinvoiceline')) {
					clickLine(tr);
				}
			}
			if (window.editnumber === '') {
				window.editaction	= 'qty';	// apres une modification, le pave revient en mode quantite
			}
		}
		if (layout) {
			syncTotal();
			if (/action=update/.test(lastUrl)) {
				root.classList.remove('oblyon-pos-numpad-open');
			}
		}
	}

	/* Dispositions ***************************************************************************** */
	function buildLayout() {
		var container	= document.querySelector('body.bodytakepos div.container');
		if (!container) {
			return;
		}
		// barre de paiement : remises en un appui, pave (Comptoir, Superette), total, bouton Reglement de TakePOS deplace ici
		var bar		= document.createElement('div');
		var html	= '<div class="oblyon-pos-quick">';
		bar.className	= 'oblyon-pos-paybar';
		(cfg.discounts || []).forEach(function (pct) {
			html	+= '<button type="button" class="oblyon-pos-disc" data-pct="' + esc(pct) + '">-' + esc(pct) + '&nbsp;%</button>';
		});
		if (layout !== 'tablet') {
			html	+= '<button type="button" class="oblyon-pos-numpadbtn" title="' + esc(labels.numpad) + '"><span class="fa fa-calculator"></span></button>';
		}
		html	+= '</div><div class="oblyon-pos-total"><span class="oblyon-pos-total-label">' + esc(labels.total) + '</span><span class="oblyon-pos-total-value"></span></div>';
		bar.innerHTML	= html;
		var pay	= document.querySelector('div.div3 button.actionbutton[onclick^="CloseBill"]');
		if (pay) {
			pay.classList.add('oblyon-pos-pay');
			pay.insertAdjacentHTML('beforeend', '<span class="oblyon-pos-pay-amount"></span>');
			bar.appendChild(pay);
		}
		container.appendChild(bar);
		bar.addEventListener('click', function (event) {
			var disc	= event.target.closest('.oblyon-pos-disc');
			if (disc) {
				discount(disc.getAttribute('data-pct'));
			} else if (event.target.closest('.oblyon-pos-numpadbtn')) {
				root.classList.toggle('oblyon-pos-numpad-open');
			}
		});
		// pave en panneau (Comptoir, Superette) : bouton de fermeture
		var pad	= document.querySelector('div.div2');
		if (pad && layout !== 'tablet') {
			var close	= document.createElement('button');
			close.type		= 'button';
			close.className	= 'oblyon-pos-padclose';
			close.title		= labels.close || '';
			close.innerHTML	= '<span class="fa fa-times"></span>';
			close.addEventListener('click', function () {
				root.classList.remove('oblyon-pos-numpad-open');
			});
			pad.appendChild(close);
		}
		// Superette : aide des raccourcis clavier
		if (layout === 'scanner') {
			var keys	= document.createElement('div');
			var rows	= [['F9', labels.pay], ['Alt+Q', labels.qty], ['Alt+R', labels.discount], ['Alt+P', labels.price], ['Alt+↑ ↓', labels.lines], ['Alt+← →', labels.step], ['Alt+X', labels.del], ['Alt+N', labels.numpad]];
			keys.className	= 'oblyon-pos-keys';
			keys.innerHTML	= '<div class="oblyon-pos-keys-title">' + esc(labels.keys) + '</div>' + rows.map(function (row) {
				return '<div class="oblyon-pos-key"><kbd>' + esc(row[0]) + '</kbd><span>' + esc(row[1]) + '</span></div>';
			}).join('') + '<div class="oblyon-pos-keys-hint">' + esc(labels.numberHint) + '</div>';
			container.appendChild(keys);
		}
		// Tablette : grille des categories, puis grille des produits avec un bouton de retour
		var div5	= document.querySelector('div.div5');
		if (layout === 'tablet' && div5) {
			var back	= document.createElement('div');
			back.className	= 'oblyon-pos-back';
			back.innerHTML	= '<button type="button"><span class="fa fa-arrow-left"></span> ' + esc(labels.back) + '</button><span class="oblyon-pos-back-label"></span>';
			back.querySelector('button').addEventListener('click', function () {
				root.classList.remove('oblyon-pos-show-products');
				var search	= byId('search');
				if (search && search.value !== '' && typeof window.ClearSearch === 'function') {
					window.ClearSearch(true);
				}
			});
			div5.insertBefore(back, div5.firstChild);
			var input	= byId('search');
			if (input) {
				input.addEventListener('input', function () {
					if (input.value !== '') {
						root.classList.add('oblyon-pos-show-products');	// une recherche affiche les produits trouves
					}
				});
			}
		}
		// suivi de la categorie affichee (onglet actif, titre de la Tablette)
		if (typeof window.LoadProducts === 'function') {
			var original	= window.LoadProducts;
			window.LoadProducts	= function () {
				var result	= original.apply(this, arguments);
				markActiveCategory();
				if (layout === 'tablet') {
					root.classList.add('oblyon-pos-show-products');
					var title	= document.querySelector('.oblyon-pos-back-label');
					if (title) {
						title.textContent	= catLabels[String(window.currentcat)] || '';
					}
				}
				return result;
			};
		}
		markActiveCategory();
	}

	function init() {
		collect(window.categories);
		collect(window.subcategories);
		initColors();
		if (layout) {
			buildLayout();
		}
		if (window.jQuery) {
			window.jQuery(document).ajaxSend(function (event, xhr, settings) {
				if (settings && settings.url && settings.url.indexOf('invoice.php') !== -1) {
					lastUrl	= settings.url;	// appels du ticket seulement (le rechargement des produits part en meme temps qu'une nouvelle vente)
				}
			});
		}
		if (editing) {
			document.addEventListener('click', onClick, true);
			document.addEventListener('keydown', onKey);
			// TakePOS vide toutes les tuiles produits a chaque frappe dans une recherche vide (Alt+..., fin de paiement) : si le champ etait
			// deja vide, la grille est laissee telle quelle ; s'il vient d'etre vide, TakePOS l'efface puis la categorie affichee est rechargee
			if (typeof window.Search2 === 'function') {
				var search2		= window.Search2;
				var lastTerm	= '';
				window.Search2	= function (keyCodeForEnter, moreorless) {
					var input	= byId('search');
					var term	= input ? input.value : '';
					var paging	= !(moreorless === undefined || moreorless === null);
					if (!paging && term === '' && lastTerm === '') {
						return;
					}
					var result	= search2.apply(this, arguments);
					if (!paging) {
						if (term === '') {
							reloadCategory();
						}
						lastTerm	= term;
					}
					return result;
				};
			}
		}
		var box	= byId('poslines');
		if (box && (editing || layout)) {
			new MutationObserver(function () {
				window.setTimeout(afterTicket, 0);	// apres l'execution du script d'invoice.php (gestionnaires des lignes)
			}).observe(box, {childList: true});
			afterTicket();
		}
	}

	// apres le $(document).ready de TakePOS (PrintCategories, LoadProducts, Refresh), enregistre avant ce script
	if (window.jQuery) {
		window.jQuery(function () {
			window.setTimeout(init, 0);
		});
	} else {
		document.addEventListener('DOMContentLoaded', init);
	}
})();
