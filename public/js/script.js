var sidebar = (function () {

	let $document = $(document);
	let $sidebar = $('#sidebar');

	function expend() {
		$sidebar.toggleClass('min-250');
	}

	function calculate() {
		if($document.width() >= 1000){
			// TODO : Na ucitavanju da postavlja duzinu
			// $sidebar.addClass('min-250');
		}
	}

	$('body').on('click', '#sidebarToggle', expend);
	$(window).on('load', calculate);

})();

var deleteProfile = (function() {

	let $enableProfileDelete = $('#enableProfileDelete');
	let $profileDelete = $('#profileDelete');
	// let $usernameProfileDelete = $('#usernameProfileDelete');
	let $usernameProfileDeleteDiv = $('#usernameProfileDeleteDiv');


	function enableDelete(event) {
		$enableProfileDelete.remove();
		$profileDelete.prop('disabled', false);
		// $usernameProfileDelete.attr('type', 'text');
		$usernameProfileDeleteDiv.show();
	}

	$('body').on('dblclick', $enableProfileDelete, enableDelete);

})();