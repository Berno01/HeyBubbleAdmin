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
	$("#impuesto").val("0");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");
	
    //Marcamos el primer tipo_documento
    $("#tipo_comprobante").val("1");
	$('#tipo_comprobante').trigger('change.select2');

    /*
    $.post("../ajax/proveedor.php?op=5", function(r){
        console.log(r);
	    $("#proveedor").html(r);
		$('#proveedor').trigger('change.select2');
	});
    */

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
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
                        url: '../ajax/venta.php?op=0',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "Destroy": true,
            "iDisplayLength": 10,//Paginación
            "order": false//Ordenar (columna,orden)
        });
}



//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
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

function mostrar(id_venta)
{
	var qr=0;
	$.post("../ajax/venta.php?op=3",{id_venta : id_venta}, function(data, status)
	{
        
		data = JSON.parse(data);		
		mostrarform(true);

		$("#cliente_venta").val(data.cliente_venta);
		qr=data.total_venta_qr;
		total=data.total_venta;
		//$("#fecha_hora").val(data.fecha);
		//$("#idingreso").val(data.idingreso);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarBuba").hide();
		$.post("../ajax/venta.php?op=7&id="+id_venta+"&qr="+qr+"&total="+total,function(r){
			$("#detalles").html(r);
		});

 	});
 	
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
var impuesto=15;
var cont=0;
var detalles=0;
var i=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto); 
    }
    else
    {
        $("#impuesto").val("0"); 
    }
  }

  function agregarBubaB() {
    var cantidad=1;
    var precio_venta=0;

    
        var subtotal=cantidad*precio_venta;
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="number" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><select class="select2 id_sabor" name="id_sabor[]" id="id_sabor[]'+i+'" ><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2 id_buba" name="id_buba[]"><option value="AP">Apples</option><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2 id_tamanio" name="id_tamanio[]"><option value="AP">Apples</option><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2" name="tipo_pago[]"><option value="AP">Efectivo</option><option value="NL">QR</option></select> </td>'+
        '<td><input type="number" class="form-control" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><span name="subtotal[]" id="subtotal[]'+cont+'">'+subtotal+'</span></td>'+
        '<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa-solid fa-rotate-right"></i></button></td>'+
        '</tr>';
    cont++;
    detalles++;
    $('#detalles').append(fila);
    cargarSabores();
	cargarBubas();
	cargarTamanios();
    modificarSubototales();
}

function cargarSabores() {
    $('.id_sabor').each(function() {
        var select = $(this);
        $.post("../ajax/sabor.php?op=5", function(r) {
            select.html(r);
            select.trigger('change.select2');
            
        });
    });
}

function cargarBubas() {
    $('.id_buba').each(function() {
        var select = $(this);
        $.post("../ajax/buba.php?op=5", function(r) {
            select.html(r);
            select.trigger('change.select2');
            
        });
    });
}

function cargarTamanios() {
    $('.id_tamanio').each(function() {
        var select = $(this);
        $.post("../ajax/tamanio.php?op=5", function(r) {
            select.html(r);
            select.trigger('change.select2');
            
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