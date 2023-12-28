<?php 
require_once "../model/Repuesto.php";

$repuesto=new Repuesto();

$id_repuesto=isset($_POST["id_repuesto"])? $_POST["id_repuesto"]:"";
$id_marca=isset($_POST["marca"])? $_POST["marca"]:"";
$id_categoria=isset($_POST["categoria"])? $_POST["categoria"]:"";
$codigo_repuesto=isset($_POST["codigo_repuesto"])? mb_strtoupper($_POST["codigo_repuesto"]):"";
$medida_repuesto=isset($_POST["medida_repuesto"])? mb_strtoupper($_POST["medida_repuesto"]):"";
$stock_repuesto=isset($_POST["stock_repuesto"])? $_POST["stock_repuesto"]:"";
$stock_minimo=isset($_POST["stock_minimo"])? $_POST["stock_minimo"]:"";
$precio_sugerido=isset($_POST["precio_sugerido"])? mb_strtoupper($_POST["precio_sugerido"]):"";
$descripcion_repuesto=isset($_POST["descripcion_repuesto"])? mb_strtoupper($_POST["descripcion_repuesto"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$repuesto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"5"=>($reg['estado_repuesto']=='0')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_repuesto'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_repuesto'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_repuesto'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_repuesto'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_categoria'],
                "1"=>$reg['codigo_repuesto'],
                "2"=>$reg['nombre_marca'],
                "3"=>$reg['medida_repuesto'],
                "4"=>$reg['stock_repuesto'],
				"6"=>$reg['id_repuesto']
				
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
		if (empty($id_repuesto)){
			$rspta=$repuesto->insertar($codigo_repuesto, $id_marca, $id_categoria, $descripcion_repuesto, $medida_repuesto,
            $stock_repuesto, $stock_minimo, $precio_sugerido);
			echo $rspta ? "1:La acción para la Hoja de Ruta fué registrada" : "0:El repuesto ya existe";
		}
		else {
			$rspta=$repuesto->editar($id_repuesto,$codigo_repuesto, $id_marca, $id_categoria, $descripcion_repuesto, $medida_repuesto,
            $stock_repuesto, $stock_minimo, $precio_sugerido);
			echo $rspta ? "1:a acción para la Hoja de Ruta fué actualizada" : "0:Ningun cambio registrado";
		}
	break;

	case '2':
		$rspta=$repuesto->desactivar($id_repuesto);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$repuesto->activar($id_repuesto);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$repuesto->mostrar($id_repuesto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $repuesto->select();
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_repuesto'] . '>' . $reg['nombre_repuesto'] . '</option>';
		}
	break;
}
?>