var tabla;

function init(){
    //Para validación
	

	$('#nombre').validacion(' abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#');
	mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
}

//Función limpiar
function limpiar()
{
	$("#nombre_categoria").val("");
	$("#id_categoria").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		
		$('#exampleModalCenter').modal('show');
		
	}
	else
	{
		$('#exampleModalCenter').modal('hide');
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function listar(){
    tabla=$('#data-table').DataTable(
        {
            "lengthMenu": [10, 25, 50],//mostramos el menú de registros a revisar
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            dom: 'Bfrltip',//Definimos los elementos del control de tabla
            
            "ajax":
                    {
                        url: '../ajax/categoria.php?op=0',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    }
        });
}

//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/categoria.php?op=1",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {    
			mensaje=datos.split(":");
			if(mensaje[0]=="1"){               
			swal.fire(
				'Mensaje de Confirmación',
				mensaje[1],
				'success'

				);           
	          mostrarform(false);
	          tabla.ajax.reload();
			}
			else{
				Swal.fire({
					type: 'error',
					title: 'Error',
					text: mensaje[1],
					footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
				});
			}
	    }

	});
	limpiar();
}

function mostrar(id_categoria)
{
	$.post("../ajax/categoria.php?op=4",{id_categoria : id_categoria}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre_categoria").val(data.nombre_categoria);
 		$("#id_categoria").val(data.id_categoria);
 	});
}

//Función para desactivar registros
function desactivar(id_categoria)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea desactivar el Registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Desactivar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/categoria.php?op=2", {id_categoria : id_categoria}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
					}	
					else{
						Swal.fire({
							type: 'error',
							title: 'Error',
							text: mensaje[1],
							footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
						});
					}			
        	});	
		}
	});   
}

//Función para activar registros
function activar(id_categoria)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea activar el Registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Activar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/categoria.php?op=3", {id_categoria : id_categoria}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
					}	
					else{
						Swal.fire({
							type: 'error',
							title: 'Error',
							text: mensaje[1],
							footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
						});
					}			
        	});	
		}
	}); 
}

init();