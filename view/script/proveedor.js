function init(){
    //Para validación
	

	//$('#nombre').validacion(' abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#');
	mostrarform(false);
    listarProveedor();
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
}
function limpiar()
{
	$("#nombre_categoria").val("");
	$("#id_categoria").val("");
}
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

function listarProveedor() {
    fetch('../ajax/proveedor.php?op=0')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud AJAX');
                    }
                    return response.json(); // Convertir la respuesta a JSON
                })
                .then(data => {
                    var datos = data.aaData;
                    
                    var div = document.getElementById('listaProveedor');


                    datos.forEach(item => {
                        div.innerHTML += `<div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-right ">
                                                        ${item[3]}
                                                    </div>
                                                    <div class="m-t-20 text-center">
                                                        <div class="avatar avatar-image" style="height: 100px; width: 100px;">
                                                            <img src="../public/images/avatars/user.png" alt="">
                                                        </div>
                                                        <h4 class="m-t-30">${item[0]}</h4>
                                                        <p>${item[1]}</p>
                                                    </div>
                                                    <div class="text-center m-t-30">
                                                        <a href="https://wa.me/+591${item[2]}" class="btn btn-primary btn-tone">
                                                            <i class="anticon anticon-mail"></i>
                                                            <span class="m-l-5">${item[2]}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                        
                    });
   
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
}


function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/proveedor.php?op=1",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {    
			console.log(datos);
			mensaje=datos.split(":");
			if(mensaje[0]=="1"){               
			swal.fire(
				'Mensaje de Confirmación',
				mensaje[1],
				'success'
                );           
	          mostrarform(false);
              setTimeout(function() {
                location.reload();
              }, 1200);
            
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

function mostrar(id_proveedor)
{
	$.post("../ajax/proveedor.php?op=4",{id_proveedor : id_proveedor}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre_proveedor").val(data.nombre_proveedor);
 		$("#id_proveedor").val(data.id_proveedor);
        $("#descripcion_proveedor").val(data.descripcion_proveedor);
        $("#telef_proveedor").val(data.telef_proveedor);
        
 	});
}


function desactivar(id_proveedor)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea desactivar el Proveedor?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Desactivar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/proveedor.php?op=2", {id_proveedor : id_proveedor}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);
                        setTimeout(function() {
                            location.reload();
                        }, 1200);  
						
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
function activar(id_proveedor)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea activar el Proveedor?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Activar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/proveedor.php?op=3", {id_proveedor : id_proveedor}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
                        setTimeout(function() {
                            location.reload();
                        }, 1200);
						
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

init()
