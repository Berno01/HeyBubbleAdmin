<?php 
session_start();

require_once "../model/Venta.php";
$venta=new Venta();

$id_venta=isset($_POST["id_venta"])? $_POST["id_venta"]:"";
$cliente_venta=isset($_POST["cliente_venta"])? $_POST["cliente_venta"]:"";
$tipo_comprobante=isset($_POST["tipo_comprobante"])? $_POST["tipo_comprobante"]:"";
$serie_comprobante=isset($_POST["serie_comprobante"])? $_POST["serie_comprobante"]:"";
$num_comprobante=isset($_POST["num_comprobante"])? $_POST["num_comprobante"]:"";
$fecha_hora=isset($_POST["fecha_hora"])? $_POST["fecha_hora"]:"";
$impuesto=isset($_POST["impuesto"])? $_POST["impuesto"]:"";
$total_venta=isset($_POST["total_venta"])? $_POST["total_venta"]:"";

switch ($_GET["op"]){
	case '0':
		$rspta=$venta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){	
            $date = date_create($reg['fecha_venta']);
			$date = date_format($date,"d/m/Y");	
			$data[]=array(
				"0"=>($reg['estado_venta']=='1')?'<span class="badge bg-primary">Pendiente</span>':
					(($reg['estado_venta']=='0')?'<span class="badge bg-danger">Anulado</span>':
					'<span class="badge bg-primary">Entregado</span>'),
					
                "1"=>$reg['cliente_venta'],
                "2"=>$reg['cant_vasos'],
				"3"=>$date,
                "4"=>$reg['total_venta'],
				"5"=>($reg['estado_venta']=='1')?'<button class="btn btn-warning" onclick="mostrar('.$reg['id_venta'].')"><i class="fa-solid fa-pen"></i></button>'.
					'<button class="btn btn-success" onclick="entregar('.$reg['id_venta'].')"><i class="fa-solid fa-thumbs-up"></i></button>'.
					'<button class="btn btn-danger" onclick="cancelar('.$reg['id_venta'].')"><i class="fa-solid fa-trash-can"></i></button>' :
					'<button class="btn btn-warning" onclick="mostrar('.$reg['id_venta'].')"><i class="bx bx-search"></i></button>',
				"6"=>$reg['id_venta']
				);
		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case '1':
		if (empty($id_venta)){
			$rspta=$venta->insertar($cliente_venta, $total_venta,
			$_POST["cantidad"], $_POST["id_buba"],$_POST["id_tamanio"],$_POST["id_sabor"],$_POST["precio_venta"],$_POST["tipo_pago"]);
			echo $rspta ? "1:Ingreso registrado" : "0:No se pudieron registrar todos los datos del ingreso";
		}
	break;

	case '2':
		$rspta=$ingreso->anular($id_venta);
 		echo $rspta ? "1:Ingreso anulado" : "0:Ingreso no se puede anular";
	break;

	case '3':
		$rspta=$ingreso->mostrar($id_venta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '4':
		//Recibimos el id_venta
		$id=$_GET['id'];

		$rspta = $ingreso->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                </thead>';

        while ($reg = pg_fetch_assoc($rspta)){	
					echo '<tr class="filas"><td></td><td>'.$reg['articulonombre'].'</td><td>'.$reg['detalle_ingresocantidad'].'</td><td>'.$reg['detalle_ingresoprecio_compra'].'</td><td>'.$reg['detalle_ingresoprecio_venta'].'</td><td>'.$reg['detalle_ingresoprecio_compra']*$reg['detalle_ingresocantidad'].'</td></tr>';
					$total=$total+($reg['detalle_ingresoprecio_compra']*$reg['detalle_ingresocantidad']);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">Bs/.'.$total.'</h4><input type="hidden" name="total_total_venta" id="total_total_venta"></th> 
                                </tfoot>';
	break;
}
?>