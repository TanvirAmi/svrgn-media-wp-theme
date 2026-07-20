/**
 * Site-wide header behavior — hamburger toggle for the mobile drawer,
 * tap-to-expand submenus on mobile (desktop uses CSS :hover), and
 * closing the drawer via the scrim, Escape key, or a real nav link.
 */
document.addEventListener('DOMContentLoaded', function () {
	var toggle = document.getElementById('mobileMenuToggle');
	var scrim = document.getElementById('mobileNavScrim');
	var navLinks = document.getElementById('siteNavLinks');
	if (!toggle || !navLinks) return;

	function isMobile() {
		return window.matchMedia('(max-width: 980px)').matches;
	}

	function openMenu() {
		document.body.classList.add('svrgn-mobile-nav-open');
		toggle.setAttribute('aria-expanded', 'true');
	}

	function closeMenu() {
		document.body.classList.remove('svrgn-mobile-nav-open');
		toggle.setAttribute('aria-expanded', 'false');
		navLinks.querySelectorAll('.svrgn-submenu-open').forEach(function (li) {
			li.classList.remove('svrgn-submenu-open');
		});
	}

	toggle.addEventListener('click', function () {
		document.body.classList.contains('svrgn-mobile-nav-open') ? closeMenu() : openMenu();
	});

	if (scrim) scrim.addEventListener('click', closeMenu);

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') closeMenu();
	});

	// Tap-to-expand submenus on mobile; desktop keeps the CSS :hover dropdown.
	navLinks.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
		link.addEventListener('click', function (e) {
			if (!isMobile()) return;
			var parentLi = link.closest('li');
			var subMenu = parentLi && parentLi.querySelector(':scope > .sub-menu');
			if (subMenu) {
				e.preventDefault();
				parentLi.classList.toggle('svrgn-submenu-open');
			}
		});
	});

	// Close the drawer when a real (non-parent-toggle) link is tapped.
	navLinks.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', function () {
			if (!isMobile()) return;
			var parentLi = link.closest('li');
			if (parentLi && parentLi.classList.contains('menu-item-has-children') && link === parentLi.querySelector(':scope > a')) {
				return; // handled by the toggle listener above
			}
			closeMenu();
		});
	});

	window.addEventListener('resize', function () {
		if (!isMobile()) closeMenu();
	});
});
