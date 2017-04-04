var sidebar = (function () {

	let $document = $(document);
	let $sidebar = $('#sidebar');

	function expend() {
		$sidebar.toggleClass('min-250');
	}

	function calculate() {
		if($document.width() >= 1000){
			$sidebar.addClass('min-250');
		}
	}

	$('body').on('click', '#sidebarToggle', expend);
	$(window).on('load', calculate);

})();