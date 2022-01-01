/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'hamburger-navigation' );

	// Return early if the navigation don't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const btnOpen = siteNavigation.querySelector( '.menu-toggle.open' );
	const btnClose = siteNavigation.querySelector( '.menu-toggle.close' );

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	const items = menu.querySelectorAll('li');
	const container = siteNavigation.querySelector('div');

	items?.forEach((item, index) => {
		const delay = (index + 1) * 0.25;
		item.style.animationDelay = delay + 's';
	})

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	btnOpen.addEventListener( 'click', function() {
		siteNavigation.classList.add( 'opened' );
		siteNavigation.classList.remove( 'closed' );
		container.style.transitionDelay = '0s';
		btnClose.style.transitionDelay = '0s';
		btnOpen.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	});

	btnClose.addEventListener( 'click', function() {
		siteNavigation.classList.remove( 'opened' );
		siteNavigation.classList.add( 'closed' );
		container.style.transitionDelay = `${items ? items.length * 0.25 : 0}s`;
		btnClose.style.transitionDelay = `${items ? items.length * 0.25 : 0}s`;
		btnClose.setAttribute( 'aria-expanded', 'false' );
		
		setTimeout(() => {
			document.body.style.overflow = '';
		}, items ? items.length * 250 : 0)
	});

}());

/**
 * Handles search bar functionality
 */
( function() {
	const search = document.getElementById( 'search' );
	const searchForm = document.querySelector('#primary-navigation .woocommerce-product-search');

	search?.addEventListener('click', () => {
		searchForm?.classList.toggle('visible');
	});

	searchForm?.querySelector('input[type=search]')?.addEventListener('blur', () => {
		searchForm?.classList.remove('visible');
	});

}());
