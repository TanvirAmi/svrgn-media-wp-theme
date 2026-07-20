/**
 * Hooks up "Choose Image" / "Remove" buttons inside .svrgn-image-field
 * wrappers (see svrgn_widget_row() in inc/widget-base.php) to the native
 * WordPress media library. Uses plain event delegation so it keeps working
 * after the Widgets screen re-renders a widget via AJAX (add/save/drag).
 */
(function () {
	function openMediaFrame( button ) {
		var wrap = button.closest( '.svrgn-image-field' );
		if ( ! wrap || typeof wp === 'undefined' || ! wp.media ) return;

		var input = wrap.querySelector( '.svrgn-image-url' );
		var preview = wrap.querySelector( '.svrgn-image-preview' );
		var removeBtn = wrap.querySelector( '.svrgn-image-remove' );

		var frame = wp.media( {
			title: 'Select Image',
			button: { text: 'Use this image' },
			multiple: false
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			var url = attachment.sizes && attachment.sizes.large ? attachment.sizes.large.url : attachment.url;
			input.value = url;
			preview.innerHTML = '<img src="' + url + '" style="max-width:100%;height:auto;display:block;">';
			if ( removeBtn ) removeBtn.style.display = 'inline-block';
		} );

		frame.open();
	}

	document.addEventListener( 'click', function ( e ) {
		if ( e.target.classList.contains( 'svrgn-image-select' ) ) {
			e.preventDefault();
			openMediaFrame( e.target );
		}
		if ( e.target.classList.contains( 'svrgn-image-remove' ) ) {
			e.preventDefault();
			var wrap = e.target.closest( '.svrgn-image-field' );
			if ( ! wrap ) return;
			wrap.querySelector( '.svrgn-image-url' ).value = '';
			wrap.querySelector( '.svrgn-image-preview' ).innerHTML = '';
			e.target.style.display = 'none';
		}
	} );
})();
