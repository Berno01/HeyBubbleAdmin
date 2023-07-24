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

                    //div.innerHTML = '<p>'+datos[0][0]+'</p>';


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


init()
