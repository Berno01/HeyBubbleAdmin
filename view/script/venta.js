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
    $.post("../ajax/sabor.php?op=5", function(r){
        console.log(r);
	    $("#sabor").html(r);
		$('#sabor').trigger('change.select2');
	});
}

//Función limpiar
function limpiar()
{
	$("#impuesto").val("0");

	$("#total_compra").val("");
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
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        });
}



//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ingreso.php?op=1",
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

function mostrar(idingreso)
{
	$.post("../ajax/ingreso.php?op=3",{idingreso : idingreso}, function(data, status)
	{
        console.log(data);
		data = JSON.parse(data);		
		mostrarform(true);

		$("#tipo_comprobante").val(data.ingresotipo_comprobante);
		$('#tipo_comprobante').trigger('change.select2');
		$("#serie_comprobante").val(data.ingresoserie_comprobante);
		$("#num_comprobante").val(data.ingresonumero_comprobante);
		$("#fecha_hora").val(data.fecha);
		$("#impuesto").val(data.ingresoimpuesto);
		$("#idingreso").val(data.idingreso);

        $.post("../ajax/proveedor.php?op=5", function(r){
            $("#proveedor").html(r);
            $('select[name=proveedor]').val(data.idproveedor);
            $('#proveedor').trigger('change.select2');
        });

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarBuba").hide();

 	});

 	$.post("../ajax/ingreso.php?op=4&id="+idingreso,function(r){
	    $("#detalles").html(r);
	});
}

//Función para anular registros
function anular(idingreso)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea desactivar el Registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Anular'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/ingreso.php?op=2", {idingreso : idingreso}, function(e){
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

function agregarBubaB()
{
    var cantidad=1;
    var precio_venta=1;

    
        var subtotal=cantidad*precio_venta;
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="number" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><select class="select2" name="id_sabor[]" ><option value="AP">Apples</option><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2" name="id_buba[]"><option value="AP">Apples</option><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2" name="id_tamanio[]"><option value="AP">Apples</option><option value="NL">Nails</option></select> </td>'+
        '<td><select class="select2" name="tipo_pago[]"><option value="AP">Efectivo</option><option value="NL">QR</option></select> </td>'+
        '<td><input type="number" class="form-control" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
        '<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="mdi mdi-refresh"></i></button></td>'+
        '</tr>';
        cont++;
        detalles=detalles+1;
        $('#detalles').append(fila);
        modificarSubototales();
    
}


function modificarSubototales()
{
    var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i <cant.length; i++) {
        var inpC=cant[i];
        var inpP=prec[i];
        var inpS=sub[i];

        inpS.value=inpC.value * inpP.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();

}
function calcularTotales(){
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;

    for (var i = 0; i <sub.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
    }
    $("#total").html("Bs/. " + total);
    $("#total_compra").val(total);
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