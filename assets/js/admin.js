$(document).ready(function() {
	$('body').on('keydown', '.jq-numeric', function(event) {
		if (event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 9 && event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40 && event.keyCode != 188 && event.keyCode != 190 && event.keyCode != 110) {
			if (event.keyCode == 190) {
				event.preventDefault();
			}
			else {
				if (event.keyCode < 48) {
					event.preventDefault();
				}
				else {
					if (event.keyCode > 106) {
						event.preventDefault();
					}
					else {
						if (event.keyCode > 57) {
							if (event.keyCode < 95 || event.keyCode > 105) {
								event.preventDefault();
							}
						}
					}
				}
			}
		}
	});

	$('.jq-grid-footer-toggle').click(function(e) {
		e.preventDefault();
		$('.jq-grid-toggle').toggleClass("display-none")
	});

	$('.jq-alert-close').click(function(e) {
		e.preventDefault();
		$(this).parent().addClass("display-none")
	});

	$('#alert-box .jq-alert-close').click(function(e) {
		e.preventDefault();
		$('#alert-apla').hide();
		$('#alert-box').hide();
		$('#alert-box .jq-alert-submit').attr('href', '');
		$('#alert-box .header').text('');
	});

	$('.jq-alert').click(function(e) {
		e.preventDefault();
		$('#alert-box .jq-alert-submit').attr('href', $(this).attr('href'));
		$('#alert-box .header').text($(this).attr('jq-alert-title'));
		$('#alert-box .footer').show();
		$('#alert-apla').show();
		$('#alert-box').show();
	});

	$('.form-control.error').on("focus", function() {
		$(this).removeClass('error');
		$(this).parent().find('.form-error').hide();
	});

	$('.jq-menu-type').on('change', function() {
		if (parseInt($(this).find(":selected").val()) == 9) {
			$('.jq-menu-url').hide();
			$('.jq-menu-link').show();
		}
	});

	$('.jq-closest-form-submit').on('click', function(e) {
		e.preventDefault();
		$(this).closest('form').submit();
	});

	$('.jq-delete-uploaded-file').on('click', function(e) {
		e.preventDefault();
		$(this).parent().parent().find('img').hide();
		$(this).parent().parent().find('.jq-delete-file').val(true);
		$(this).parent().parent().find('.jq-file').removeClass('display-none');
		$(this).hide();
	});
	
	$('.jq-submit-form').on('click', function(e) {
		e.preventDefault();
		$('.' + $(this).attr('data-form-class')).submit();
	});
	
	$('.jq-menu-plus').on('click', function(e) {
		e.preventDefault();
		$('.jq-menu-' + $(this).attr('data-id')).toggleClass('display-none');
		$('.jq-menu-root-' + $(this).attr('data-id')).toggleClass('expand');
	});
		

	//$('#alert-box .jq-alert-submit').click(function(e)
	//{
	//	e.preventDefault();
	//	
	//	window.location.href = "https://stackoverflow.com";
	//});
});