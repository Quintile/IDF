$(document).ready(function(){
	$('.input > input[type=text]').focus(function(){
		$(this).parents('.input').addClass('on');
	}).blur(function(){
		if($(this).val() != '')
			return false;

		var $input = $(this).parents('.input');
		$input.removeClass('on');
	});

	$('.input').each(function(index, element){
		var $input = $(element).find('input');
		if($input.val())
			$(element).addClass('on');
	});
});