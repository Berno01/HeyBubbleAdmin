<?php 
require_once "../model/Buba.php";

$buba=new Buba();

$id_buba=isset($_POST["id_buba"])? $_POST["id_buba"]:"";
$nombre_buba=isset($_POST["nombre_buba"])? mb_strtoupper($_POST["nombre_buba"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$buba->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"1"=>($reg['estado_buba']=='1')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_buba'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_buba'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_buba'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_buba'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_buba'],
				"2"=>$reg['id_buba']
				
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
		if (empty($id_buba)){
			$rspta=$buba->insertar($nombre_buba);
			echo $rspta ? "1:La buba fue registrada" : "0:Buba ya registrada";
		}
		else {
			$rspta=$buba->editar($id_buba,$nombre_buba);
			echo $rspta ? "1:La buba fué actualizada" : "0:buba ya registrada";
		}
	break;

	case '2':
		$rspta=$buba->desactivar($id_buba);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$buba->activar($id_buba);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$buba->mostrar($id_buba);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $buba->select();
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_buba'] . '>' . $reg['nombre_buba'] . '</option>';
		}
		
	break;
}
?>