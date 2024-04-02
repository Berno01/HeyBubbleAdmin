<?php 
require_once "../model/Sabor.php";

$sabor=new Sabor();

$id_sabor=isset($_POST["id_sabor"])? $_POST["id_sabor"]:"";
$nombre_sabor=isset($_POST["nombre_sabor"])? mb_strtoupper($_POST["nombre_sabor"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$sabor->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"1"=>($reg['estado_sabor']=='0')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_sabor'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_sabor'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_sabor'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_sabor'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_sabor'],
				"2"=>$reg['id_sabor']
				
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
		if (empty($id_sabor)){
			$rspta=$sabor->insertar($nombre_sabor);
			echo $rspta ? "1:La sabor fue registrada" : "0:sabor ya registrada";
		}
		else {
			$rspta=$sabor->editar($id_sabor,$nombre_sabor);
			echo $rspta ? "1:La sabor fué actualizada" : "0:sabor ya registrada";
		}
	break;

	case '2':
		$rspta=$sabor->desactivar($id_sabor);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$sabor->activar($id_sabor);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$sabor->mostrar($id_sabor);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $sabor->select();
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_sabor'] . '>' . $reg['nombre_sabor'] . '</option>';
		}
			echo '<option value="crearC">AGREGAR sabor</option>'; 
	break;
}
?>