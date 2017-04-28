'use strict';

var sidebar = (function () {

	let $document = $(document);
	let $sidebar = $('#sidebar');

	function toggle() {
		$sidebar.toggleClass('min-250');
	}

	function calculate() {
		if($document.width() >= 1000){
			// TODO : Na ucitavanju da postavlja duzinu
			// $sidebar.addClass('min-250');
		}
	}

	$('body').on('click', '#sidebarToggle', toggle);
	$(window).on('load', calculate);

})();

var enableProfileDeleting = (function() {

	let $buttonEnable = $('#enableProfileDelete');
	let $buttonDelete = $('#profileDelete');
	let $hiddenInput = $('#profileDeleteHidden');

	function enableDelete(event) {
		$buttonEnable.remove();
		$buttonDelete.prop('disabled', false);
		$hiddenInput.show();
	}

	$('body').on('dblclick', $buttonEnable, enableDelete);

})();