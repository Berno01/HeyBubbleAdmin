var tabla;

function init(){
	$('.select2').select2();
    $('#sabor').select2();
    $('#buba').select2();
    $('#tamaño').select2();
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
	$("#total_venta").val("");
	$("#total_venta_qr").val("");
	$(".filas").remove();
	$("#total").html("0");
	$("#total_qr").html("");
	$("#cliente_venta").val("");
	
    

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarBuba").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function listar(){
    tabla=$('#tbllistado').DataTable(
        {
            "lengthMenu": [ 10, 25, 50, 75, 100 ],//mostramos el menú de registros a revisar
            "Processing": true,//Activamos el procesamiento del datatables
            "ServerSide": true,//Paginación y filtrado realizados por el servidor
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [		          
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
            "ajax":
                    {
                        url: '../ajax/venta.php?op=10',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "Destroy": true,
            "iDisplayLength": 10,//Paginación
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        });
}



//Función para guardar o editar

function guardaryeditar(e)
{
	modificarSubototales();
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/venta.php?op=1",
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
				'Venta registrada :)',
				mensaje[1],
				'success'

				);           
	          mostrarform(false);
	          
			  setTimeout(function() {
				window.location.href = 'venta1.php';
			}, 1200);
			}
			else{
				mesaje[1]="Por favor agrega un vaso a la venta";
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

function mostrar(id_venta) {
    var qr = 0;
    $.post("../ajax/venta.php?op=3", {id_venta: id_venta}, function(data, status) {
        data = JSON.parse(data);		
        mostrarform(true);

        $("#cliente_venta").val(data.cliente_venta);
        qr = data.total_venta_qr;
        total = data.total_venta;

        // Ocultar y mostrar los botones
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnAgregarBuba").hide();

        // Obtener detalles
        $.post("../ajax/venta.php?op=4&id=" + id_venta + "&qr=" + qr + "&total=" + total, function(response) {
            var detalles = JSON.parse(response);
            detalles.forEach(function(detalle) {
                agregarFilaDetalle(detalle);
            });

            $("#total").html("Bs/." + total);
            $("#total_qr").html("QR/." + qr);
            // Aquí puedes agregar más lógica para actualizar cualquier otra parte de la interfaz.
        });
    });
}

function agregarFilaDetalle(detalle) {
    var subtotal = detalle.cant_venta * detalle.precio_venta;
    var fila = '<tr class="filas" id="fila' + detalle.id + '">' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + detalle.id + ')">X</button></td>' +
        '<td><input type="number" name="cantidad[]" value="' + detalle.cant_venta + '" onblur="modificarSubtotal(' + detalle.id + ')"></td>' +
        '<td><select name="sabor[]" id="sabor' + detalle.id + '" class="id_sabor"></select></td>' +
        '<td><select name="buba[]" id="buba' + detalle.id + '" class="id_buba"></select></td>' +
        '<td><select name="tamanio[]" id="tamanio' + detalle.id + '" class="id_tamanio"></select></td>' +
        '<td><select name="pago[]" id="pago' + detalle.id + '" class="id_pago"></select></td>' +
        '<td><input type="text" name="precio_venta[]" id="precio_venta[]" value="' + detalle.precio_venta + '"></td>' +
        '<td><span name="subtotal[]" id="subtotal' + detalle.id + '">' + subtotal + '</span></td>' +
        '<td><button type="button" class="btn btn-info" onclick="refreshDetalle(' + detalle.id + ')">Refresh</button></td>' +
        '</tr>';

    $("#detalles").append(fila);

    // Aquí puedes llamar a las funciones que cargan los valores de los selects
    cargarSabores(detalle.id, detalle.id_sabor);
    cargarBubas(detalle.id, detalle.id_buba);
    cargarTamanios(detalle.id, detalle.id_tamanio);
    cargarTiposPago(detalle.id, detalle.id_tipo_pago);
    modificarSubototales(); 
}
function reporte()
{
	
	$.post("../ajax/venta.php?op=6", function(r) {
		console.log(r);
		var parrafo = document.getElementById('reporte_txt');

// Cambia el texto del elemento <p>
	parrafo.innerHTML = r;
		mostrarReport(true);

		
	});
 	
}

function mostrarReport(flag)
{
	
	if (flag)
	{
		
		$('#reporte').modal('show');
		
	}
	else
	{
		$('#reporte').modal('hide');
	}
}

//Función cancelarform
function cancelarReport()
{
	
	mostrarReport(false);
}



//Función para anular registros
function cancelar(id_venta)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿En serio desea cancelar el pedido?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Salir',
		confirmButtonText: 'Cancelar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/venta.php?op=2", {id_venta : id_venta}, function(e){
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

function entregar(id_venta)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea entregar el pedido?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Entregar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/venta.php?op=5", {id_venta : id_venta}, function(e){
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

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var cont=0;
var detalles=0;
var i=0;
//$("#guardar").hide();
$("#btnGuardar").hide();


function agregarBubaB() {
    var cantidad = 1;
    var precio_venta = 14;
    var subtotal = cantidad * precio_venta;

    var fila = '<tr class="filas" id="fila' + cont + '">' +
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
        '<td><input type="text" class="form-control" name="cantidad[]" id="cantidad[]" value="' + cantidad + '"></td>' +
        '<td><select class="select2 id_sabor" name="id_sabor[]" id="id_sabor[]' + cont + '"></select></td>' +
        '<td><select class="select2 id_buba" name="id_buba[]"></select></td>' +
        '<td><select class="select2 id_tamanio" name="id_tamanio[]" onchange="actualizarTamanio(this)"></select></td>' +
        '<td><select class="select2" name="tipo_pago[]"><option value="0">Efect</option><option value="2">QR</option></td>' +
        '<td><input type="text" class="form-control" name="precio_venta[]" id="precio_venta[]" value="' + precio_venta + '"></td>' +
        '<td><span name="subtotal[]" id="subtotal[]' + cont + '">' + subtotal + '</span></td>' +
        '<td><button type="button" onclick="modificarSubototales()" class="btn btn-warning"><i class="fa-solid fa-rotate-right"></i></button></td>' +
        '</tr>';
    cont++;
    detalles++;
    $('#detalles').append(fila);
    cargarSabores();
    cargarBubas();
    cargarTamanios();
    modificarSubototales();
}

function actualizarTamanio(select) {
    var opcionSeleccionada = $(select).find('option:selected').text();
    var fila = $(select).closest('tr'); // Encuentra la fila más cercana

    // Actualiza el campo precio_venta con el texto de la opción seleccionada
    fila.find('input[name="precio_venta[]"]').val(opcionSeleccionada);

    // Actualiza el subtotal
    var cantidad = fila.find('input[name="cantidad[]"]').val();
    var nuevoSubtotal = cantidad * parseFloat(opcionSeleccionada);
    fila.find('span[name="subtotal[]"]').text(nuevoSubtotal.toFixed(2));
    
    modificarSubototales(); // Actualiza los subtotales generales
}
function cargarTamanios(id, selectedTamanio = null) {
    var select = id ? $("#id_tamanio" + id) : $(".id_tamanio");
    
    select.each(function() {
        var selectElem = $(this);
        var selectedValue = selectElem.val(); // Guarda el valor seleccionado actualmente

        $.post("../ajax/tamanio.php?op=5", function(data) {
            // Añadir una opción vacía al inicio del select
            selectElem.html('<option value="" disabled>Seleccione un tamaño</option>' + data);

            // Restaurar el valor seleccionado si existe
            if (selectedValue) {
                selectElem.val(selectedValue);
            }

            // Si el valor seleccionado no existe en las nuevas opciones, selecciona la opción vacía
            if (!selectElem.val()) {
                selectElem.val('');
            }
            selectElem.trigger('change.select2');
        });
    });
}

function cargarSabores(id, selectedSabor = null) {
    var select = id ? $("#id_sabor" + id) : $(".id_sabor");
    
    select.each(function() {
        var selectElem = $(this);
        var selectedValue = selectElem.val(); // Guarda el valor seleccionado actualmente

        $.post("../ajax/sabor.php?op=5", function(data) {
            // Añadir una opción vacía al inicio del select
            selectElem.html('<option value="" disabled>Seleccione un sabor</option>' + data);

            // Restaurar el valor seleccionado si existe
            if (selectedValue) {
                selectElem.val(selectedValue);
            }

            // Si el valor seleccionado no existe en las nuevas opciones, selecciona la opción vacía
            if (!selectElem.val()) {
                selectElem.val('');
            }
            selectElem.trigger('change.select2');
        });
    });
}

function cargarBubas(id, selectedBuba = null) {
    var select = id ? $("#id_buba" + id) : $(".id_buba");
    
    select.each(function() {
        var selectElem = $(this);
        var selectedValue = selectElem.val(); // Guarda el valor seleccionado actualmente

        $.post("../ajax/buba.php?op=5", function(data) {
            // Añadir una opción vacía al inicio del select
            selectElem.html('<option value="" disabled>Seleccione una buba</option>' + data);

            // Restaurar el valor seleccionado si existe
            if (selectedValue) {
                selectElem.val(selectedValue);
            }

            // Si el valor seleccionado no existe en las nuevas opciones, selecciona la opción vacía
            if (!selectElem.val()) {
                selectElem.val('');
            }
            selectElem.trigger('change.select2');
        });
    });
}

function cargarTiposPago(id, selectedPago = null) {
    var select = id ? $("#pago" + id) : $(".id_pago");
    
    select.each(function() {
        var selectElem = $(this);
        $.post("../ajax/sabor.php?op=6", function(data) {
            // Aquí asumimos que 'data' ya es HTML válido
            selectElem.html(data);
            if (selectedPago) {
                selectElem.val(selectedPago);
            }
            selectElem.trigger('change.select2');
        });
    });
}

function modificarSubototales()
{
    var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var sub = document.getElementsByName("subtotal[]");

    for (var i = 0; i <cant.length; i++) {
        var inpC=cant[i];
        var inpP=prec[i];
        var inpS=sub[i];
        inpS.value=inpC.value * inpP.value;
        document.getElementsByName("subtotal[]")[i].innerHTML = inpS.value;
    }
    calcularTotales();

}
function calcularTotales(){
    var sub = document.getElementsByName("subtotal[]");
    var total = 0.0;

    for (var i = 0; i <sub.length; i++) {
        total += document.getElementsByName("subtotal[]")[i].value;
    }
    $("#total").html("Bs/. " + total);
    $("#total_venta").val(total);
    evaluar();
}

function evaluar(){
    if (detalles>0)
    {
        $("#btnGuardar").show();
    }
    else
    {
        $("#btnGuardar").hide(); 
        cont=0;
    }
}

function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calcularTotales();
    detalles=detalles-1;
    evaluar();
}

init();