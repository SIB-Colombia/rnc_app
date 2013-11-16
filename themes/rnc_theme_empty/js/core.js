/* Funciones para cambiar el tamaño del div de contenido dinámicamente */
$(document).ready(function() {
	/*$('#contenido').height($(window).height() - 79);
	$('#barralateral').height($(window).height() - 79);
	$('#page_wrapper').height($(window).height() - 79);
	$('#page_wrapper').width($(window).width() - $('#barralateral').width());
	$('#page').height($(window).height() - 79);
	$('#page_content').height($(window).height() - 120);
	$('.barralateral_secundaria').height($(window).height() - 79 - $('#barralateral_primaria').height());
	$('.barralateral_secundaria').jScrollPane();*/
});

$(window).resize(function() {
    /*$('#contenido').height($(window).height() - 79);
    $('#barralateral').height($(window).height() - 79);
    $('#page_wrapper').height($(window).height() - 79);
    $('#page_wrapper').width($(window).width() - $('#barralateral').width());
    $('#page').height($(window).height() - 79);
    $('#page_content').height($(window).height() - 120);
    $('.barralateral_secundaria').height($(window).height() - 79 - $('#barralateral_primaria').height());
    $('.barralateral_secundaria').jScrollPane();*/
});

$(window).trigger('resize');

$(function() {
	//$('.barralateral_secundaria').jScrollPane();
});