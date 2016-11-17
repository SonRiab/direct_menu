$(document).ready(function () {
	$('#direct_menu input').change(function() {
			var value = 'no';
			if (this.checked) {
				value = 'yes';
			}
			$(this).attr('value', value);
	});
	
	$('#direct_menu-hideAppName').change(function() {
		if (this.checked) {
			$('#header a.menutoggle').hide();
			$('#navigation div ul').css('margin-left', 0);
			$('#navigation a svg').css('opacity', 0.5);
		} else {
			$('#header a.menutoggle').show();
			$('#navigation div ul').css('margin-left', '170px');
			$('#navigation a svg').css('opacity', 0.9);
		}
		$.post(OC.generateUrl('/apps/direct_menu/ajax/setHideAppName'),	{
			value: $(this).attr('value')
		}).done(function(response) {
			OC.msg.finishedSaving('#direct_menu_settings_msg', response);
		}).fail(function(response) {
			OC.msg.finishedSaving('#direct_menu_settings_msg', response);
		});
	});
});