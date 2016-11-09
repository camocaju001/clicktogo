$( document ).ready(function() {
    $('.treeview-menu a').on("click", function() {
    	event.preventDefault();
    	var menu_rel = $(this).attr('href');
    	cargarVista(menu_rel);
	});
});

function cargarVista(menu_rel){
	alert("cargarVista "+menu_rel);
	$('.content-wrapper').load(menu_rel);
}