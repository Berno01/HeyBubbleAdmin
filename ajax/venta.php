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
			$hora = date_format($date, "H:i:s");
			$date = date_format($date,"d/m/Y");	
			
			$data[]=array(
				"0"=>($reg['estado_venta']=='1')?'<span class="badge bg-light">Pendiente</span>':
					(($reg['estado_venta']=='0')?'<span class="badge bg-danger">Cancelado</span>':
					'<span class="badge bg-success">Entregado</span>'),
					
                "1"=>$reg['cliente_venta'],
                "2"=>$reg['cant_vasos'],
				"3"=>$date,
				"4"=>$hora,
                "5"=>$reg['total_venta'],
				"6"=>$reg['total_venta_qr'],
				"7"=>'<button class="btn btn-warning" onclick="mostrarSE('.$reg['id_venta'].')"><i class="fa-solid fa-eye"></i></button>',
				"8"=>$reg['id_venta']
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
			echo $rspta ? "1:No olvides confirmar la entrega después" : "0:No se pudieron registrar todos los datos del ingreso";
		}
		else{
			$rspta=$venta->actualizar($id_venta, $cliente_venta, $total_venta,
			$_POST["cantidad"], $_POST["id_buba"],$_POST["id_tamanio"],$_POST["id_sabor"],$_POST["precio_venta"],$_POST["tipo_pago"]);
			echo $rspta ? "1:Pedido Actualizado! :D" : "0:No se pudieron registrar todos los datos del ingreso";
		}
	break;

	case '2':
		$rspta=$venta->cancelar($id_venta);
 		echo $rspta ? "1:El pedido fue cancelado" : "0:Pedido no se puede anular";
	break;

	case '3':
		$rspta=$venta->mostrar($id_venta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '4':
		// Recibimos el id_venta
		$id = $_GET['id'];
		$qr = $_GET['qr'];
		$total_ventaklk = $_GET['total'];
		$rspta = $venta->listarDetalle($id);
		
		$detalles = array();
		while ($reg = mysqli_fetch_assoc($rspta)){
			$detalles[] = array(
				'id' => $reg['id_detalle_venta'], // Asegúrate de tener un identificador único para cada detalle
				'cant_venta' => $reg['cant_venta'],
				'id_sabor' => $reg['id_sabor'],
				'id_buba' => $reg['id_buba'],
				'id_tamanio' => $reg['id_tamanio'],
				'id_tipo_pago' => $reg['id_tipo_pago'],
				'precio_venta' => $reg['precio_venta']
			);
		}
		
		echo json_encode($detalles);
		break;
	case '5':
		$rspta=$venta->entregar($id_venta);
 		echo $rspta ? "1:El pedido fue entregado!" : "0:Pedido no se pudo entregar";
	break;

	case '6':
			$rspta = $venta->reporte();
			$data = array();
		
			// Verifica si la consulta devolvió resultados
			if ($rspta) {
				// Obtenemos el resultado como un array asociativo
				$row = $rspta->fetch_assoc();
		
				// Verificamos que se obtuvieron datos
				if ($row) {
					// Construimos la cadena con los valores obtenidos y usando <br> para saltos de línea
					$response = 'REPORTE DIARIO DE VENTAS<br>' .
								'--Vasos de 14: ' . $row['vasos14'] . '<br>' .
								'--Vasos de 16: ' . $row['vasos16'] . '<br>' .
								'--Vasos de 20: ' . $row['vasos20'] . '<br>' .
								'--Botellas de 22: ' . $row['vasos22'] . '<br>' .
								'--Vasos de 25: ' . $row['vasos25'] . '<br>' .
								'Total de vasos vendidos: ' . $row['total_vasos_vendidos'] . '<br>' .
								'Total en efectivo: ' . $row['suma_total_venta'] . '<br>' .
								'Total de ventas en QR: ' . $row['suma_total_venta_qr'];
				}
			}
			echo json_encode($response);
	break;


	case '7':
		//Recibimos el id_venta
		$id=$_GET['id'];
		$qr=$_GET['qr'];
		$total_ventaklk=$_GET['total'];
		$rspta = $venta->listarDetalle($id);
		
		echo '<thead style="background-color:#f378b1">
									<th>Op</th>
									<th>Cantidad</th>
                                    <th>Sabor</th>
                                    <th>Buba</th>
                                    <th>Tamaño</th>
									<th>Pago</th>
									<th>Precio Unitario</th>
                                    <th>Subtotal</th>
									<th>Refresh</th>
                                </thead>';

        while ($reg = mysqli_fetch_assoc($rspta)){	
					echo '<tr class="filas">
							<td></td>
							<td>'.$reg['cant_venta'].'</td>
							<td>'.$reg['nombre_sabor'].'</td>
							<td>'.$reg['nombre_buba'].'</td>
							<td>'.$reg['precio_tamanio'].'</td>
							<td>'.$reg['nombre_tipo_pago'].'</td>
							<td>'.$reg['precio_venta'].'</td>
							<td>'.$reg['precio_venta']*$reg['cant_venta'].'</td>
							<td></td>
						 </tr>';
					
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
									<th></th>
                                    <th><h4 id="total">Bs/.'.$total_ventaklk.'</h4><input type="hidden" name="total_total_venta" id="total_total_venta"></th> 
									<th><h4 id="total_qr">QR/.'.$qr.'</h4><input type="hidden" name="total_total_venta_qr" id="total_total_venta_qr"></th> 
									<th></th>
                                </tfoot>';
	break;

	case '10':
		$rspta=$venta->listar1();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){	
            $date = date_create($reg['fecha_venta']);
			$hora = date_format($date, "H:i:s");
			$data[]=array(
				"0"=>($reg['estado_venta']=='1')?'<span class="badge bg-light">Pendiente</span>':
					(($reg['estado_venta']=='0')?'<span class="badge bg-danger">Cancelado</span>':
					'<span class="badge bg-success">Entregado</span>'),
					
                "1"=>$reg['cliente_venta'],
                "2"=>$reg['cant_vasos'],
				"3"=>$hora,
                "4"=>$reg['total_venta'],
				"5"=>$reg['total_venta_qr'],
				"6"=>($reg['estado_venta']=='1')?'<button class="btn btn-warning" onclick="mostrar('.$reg['id_venta'].')"><i class="fa-solid fa-pencil"></i></button>'.
					'<button class="btn btn-success" onclick="entregar('.$reg['id_venta'].')"><i class="fa-solid fa-thumbs-up"></i></button>'.
					'<button class="btn btn-danger" onclick="cancelar('.$reg['id_venta'].')"><i class="fa-solid fa-trash-can"></i></button>' :
					'<button class="btn btn-warning" onclick="mostrarSE('.$reg['id_venta'].')"><i class="fa-solid fa-eye"></i></button>',
				"7"=>$reg['id_venta']
				);
				
		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	


		


}
?>