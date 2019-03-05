$(document).ready(function(){
    $("#image").on('change', function(){
    	//$('.imageLabel').text('Downloaded '+ $(this).val());
		$('.imageLabel').text($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
});