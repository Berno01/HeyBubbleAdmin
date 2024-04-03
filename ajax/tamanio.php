<?php 
require_once "../model/Tamanio.php";

$tamanio=new tamanio();

$id_tamanio=isset($_POST["id_tamanio"])? $_POST["id_tamanio"]:"";
$precio_tamanio=isset($_POST["precio_tamanio"])? mb_strtoupper($_POST["precio_tamanio"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$tamanio->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"1"=>($reg['estado_tamanio']=='1')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_tamanio'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_tamanio'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_tamanio'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_tamanio'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['precio_tamanio'],
				"2"=>$reg['id_tamanio']
				
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
		if (empty($id_tamanio)){
			$rspta=$tamanio->insertar($precio_tamanio);
			echo $rspta ? "1:La tamanio fue registrada" : "0:tamanio ya registrada";
		}
		else {
			$rspta=$tamanio->editar($id_tamanio,$precio_tamanio);
			echo $rspta ? "1:La tamanio fué actualizada" : "0:tamanio ya registrada";
		}
	break;

	case '2':
		$rspta=$tamanio->desactivar($id_tamanio);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$tamanio->activar($id_tamanio);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$tamanio->mostrar($id_tamanio);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $tamanio->select();
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_tamanio'] . '>' . $reg['precio_tamanio'] . '</option>';
		}
			echo '<option value="crearC">AGREGAR tamanio</option>'; 
	break;
}
?>