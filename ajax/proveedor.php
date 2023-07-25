<?php 
require_once "../model/Proveedor.php";

$proveedor=new Proveedor();

$id_proveedor=isset($_POST["id_proveedor"])? $_POST["id_proveedor"]:"";
$nombre_proveedor=isset($_POST["nombre_proveedor"])? mb_strtoupper($_POST["nombre_proveedor"]):"";
$descripcion_proveedor=isset($_POST["descripcion_proveedor"])? mb_strtoupper($_POST["descripcion_proveedor"]):"";
$telef_proveedor=isset($_POST["telef_proveedor"])? mb_strtoupper($_POST["telef_proveedor"]):"";


switch ($_GET["op"]){
	case '0':
		$rspta=$proveedor->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = pg_fetch_assoc($rspta)){			
			$data[]=array(
				"0"=>$reg['nombre_proveedor'],
                "1"=>$reg['descripcion_proveedor'],
                "2"=>$reg['telef_proveedor'],
                "3"=>($reg['estado_proveedor']=='t')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_proveedor'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_proveedor'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_proveedor'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_proveedor'].')"><i class="anticon anticon-delete"></i></button>',
				"4"=>$reg['id_proveedor']
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
		if (empty($id_proveedor)){
			$rspta=$proveedor->insertar($nombre_proveedor, $descripcion_proveedor, $telef_proveedor);
			echo $rspta ? "1:La acción para la Hoja de Ruta fué registrada" : "0:a acción para la Hoja de Ruta no fué registrada";
		}
		else {
			$rspta=$proveedor->editar($id_proveedor,$nombre_proveedor, $descripcion_proveedor, $telef_proveedor);
			echo $rspta ? "1:a acción para la Hoja de Ruta fué actualizada" : "0:a acción para la Hoja de Ruta no fué actualizada";
		}
	break;

	case '2':
		$rspta=$proveedor->desactivar($id_proveedor);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$proveedor->activar($id_proveedor);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$proveedor->mostrar($id_proveedor);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $categoria->select();
		while ($reg = pg_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_categoria'] . '>' . $reg['nombre_categoria'] . '</option>';
		}
	break;
}
?>