
$("#form_agregar_comercio").submit(function(e) {
	e.preventDefault();
    $.ajax({
       type: "POST",
       url: "comercios/crearComercio",
       data: $("#form_agregar_comercio").serialize(), // serializes the form's elements.
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Comercio creado');
				$('#createModal').modal('toggle');
			}
			else{
				alertify.error('Campos obligatorios');
			}
       }
     });
});
function EliminarComercio(id){
	$.ajax({
       type: "POST",
       url: "comercios/eliminarComercio",
       data: {"id":id}, 
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Comercio Eliminado');
			}
			else{
				alertify.error('Error eliminando el comercio');
			}
       }
     });
}


$("#form_agregar_categoria").submit(function(e) {
	e.preventDefault();
    $.ajax({
       type: "POST",
       url: "comercios/crearCategoria",
       data: $("#form_agregar_categoria").serialize(), // serializes the form's elements.
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Comercio creado');
				$('#createModal').modal('toggle');
			}
			else{
				alertify.error('Campos obligatorios');
			}
       }
     });
});
function EliminarCategoria(id){
	$.ajax({
       type: "POST",
       url: "comercios/eliminarCategoria",
       data: {"id":id}, 
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Categoria Eliminada');
			}
			else{
				alertify.error('Error eliminando la categoria');
			}
       }
     });
}
function obtenerHorario(){
	var horario = new Array();
	var flag = "true";
	$('.item').each(function( index ) {
		var d_hi = $( this ).find('.hora_inicio').val();
		var d_hf = $( this ).find('.hora_final').val();
		var d_na = $( this ).find('.hora_noatencion').val();
		if(d_hi!= ""){
			$( this ).find('.hora_inicio').css('border','1px solid  #d2d6de');
		}else{
			$( this ).find('.hora_inicio').css('border','1px solid  #CC3B13');
			flag = "false";
		}
		if(d_hf!= ""){
			$( this ).find('.hora_final').css('border','1px solid  #d2d6de');			
		}else{
			$( this ).find('.hora_final').css('border','1px solid #CC3B13');
			flag = "false";
		}
		if(d_na =="on"){
			$( this ).find('.hora_inicio').css('border','1px solid  #d2d6de');
			flag="true";
		}
		if(flag!="false"){
			var dia = {dia:(index+1), inicio:d_hi, final:d_hf};
			horario.push(JSON.stringify(dia));	
		}else{
			alertify.error('Debes completar el horario de la sucursal.');
		}
	});
	if(flag!="false"){
		$('#sucursal_horario').val(horario);
	}else{
		$('#sucursal_horario').val("");
	}
	console.log(horario);
	
}
$("#form_agregar_sucursal").submit(function(e) {
	obtenerHorario();
	e.preventDefault();
    $.ajax({
       type: "POST",
       url: "comercios/crearSucursal",
       data: $("#form_agregar_sucursal").serialize(), // serializes the form's elements.
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Sucursal creada');
			}
			else{
				alertify.error('Campos obligatorios');
			}
       }
     });
});
$('.sucursal_direccion').on('change', function() { 
	current_dir = $('.sucursal_direccion').val();
	var current_dir_fo = current_dir.replace(" ", "+");
	url_pet="https://maps.googleapis.com/maps/api/geocode/json?address="+current_dir_fo+"&key=";
	$.ajax({
	  dataType: "json",
	  url: url_pet,
	  success: function(data){
	  	var long_lat = data.results[0].geometry.location;
	  	$('.sucursal_long_lat').val(long_lat.lng+","+long_lat.lat);
	  	$('#iframe_space').html('<iframe src="http://maps.google.com/maps?q='+long_lat.lat+','+long_lat.lng+'&z=15&output=embed" style="border:0;width: 80%"></iframe>');
	  }
	});
	
});

function EliminarSucursal(id){
	$.ajax({
       type: "POST",
       url: "comercios/eliminarSucursal",
       data: {"id":id}, 
       success: function(data)
       {
			if(data!="false"){
				alertify.success('Sucursal Eliminada');
			}
			else{
				alertify.error('Error eliminando la Sucursal');
			}
       }
     });
}

$('.check_lun_a_vier').on('change', function() { 
	var dia_padre = $(this).parent().parent();
	var hora_noatencion =dia_padre.find('.hora_noatencion').is(':checked');
	if(hora_noatencion){
		dia_padre.find('.hora_inicio').slice(0,4).prop('disabled', true);
		dia_padre.find('.hora_final').slice(0,4).prop('disabled', true);
		dia_padre.siblings('.item').find('.hora_noatencion').slice(0,4).prop('checked', true);
		dia_padre.siblings('.item').find('.hora_inicio').slice(0,4).prop('disabled', true);
		dia_padre.siblings('.item').find('.hora_final').slice(0,4).prop('disabled', true);
		dia_padre.siblings('.item').find('.hora_inicio').val("");
		dia_padre.siblings('.item').find('.hora_final').val("");
	}else{
		dia_padre.find('.hora_inicio').slice(0,4).prop('disabled', false);
		dia_padre.find('.hora_final').slice(0,4).prop('disabled', false);
		dia_padre.siblings('.item').find('.hora_noatencion').prop('checked', false);
		dia_padre.siblings('.item').find('.hora_inicio').slice(0,4).prop('disabled', false);
		dia_padre.siblings('.item').find('.hora_final').slice(0,4).prop('disabled', false);
       	var hora_inicio = dia_padre.find('.hora_inicio').val();
       	var hora_final = dia_padre.find('.hora_final').val();
       	dia_padre.siblings('.item').find('.hora_inicio').slice(0,4).val(hora_inicio);
		dia_padre.siblings('.item').find('.hora_final').slice(0,4).val(hora_final);
	}
      
});

$('.check_hora_noatencion').on('change', function() { 
	$('.check_lun_a_vier').prop('checked', false);
});