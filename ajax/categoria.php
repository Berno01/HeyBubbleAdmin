<?php 
require_once "../model/Categoria.php";

$categoria=new Categoria();

$id_categoria=isset($_POST["id_categoria"])? $_POST["id_categoria"]:"";
$nombre_categoria=isset($_POST["nombre_categoria"])? mb_strtoupper($_POST["nombre_categoria"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = pg_fetch_assoc($rspta)){			
			$data[]=array(
				"1"=>($reg['estado_categoria']=='t')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_categoria'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_categoria'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_categoria'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_categoria'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_categoria'],
				"2"=>$reg['id_categoria']
				
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
		if (empty($id_categoria)){
			$rspta=$categoria->insertar($nombre_categoria);
			echo $rspta ? "1:La acción para la Hoja de Ruta fué registrada" : "0:a acción para la Hoja de Ruta no fué registrada";
		}
		else {
			$rspta=$categoria->editar($id_categoria,$nombre_categoria);
			echo $rspta ? "1:a acción para la Hoja de Ruta fué actualizada" : "0:a acción para la Hoja de Ruta no fué actualizada";
		}
	break;

	case '2':
		$rspta=$categoria->desactivar($id_categoria);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$categoria->activar($id_categoria);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$categoria->mostrar($id_categoria);
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