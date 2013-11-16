/* Funciones para cambiar el tamaño del div de contenido dinámicamente */
$(document).ready(function() {
	$('#contenido').height($(window).height() - 85);
});

$(window).resize(function() {
    $('#contenido').height($(window).height() - 85);
});

$(window).trigger('resize');