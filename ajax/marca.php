<?php 
require_once "../model/Marca.php";

$marca=new Marca();

$id_marca=isset($_POST["id_marca"])? $_POST["id_marca"]:"";
$nombre_marca=isset($_POST["nombre_marca"])? mb_strtoupper($_POST["nombre_marca"]):"";
$descripcion_marca=isset($_POST["descripcion_marca"])? mb_strtoupper($_POST["descripcion_marca"]):"";

switch ($_GET["op"]){
	case '0':
		$rspta=$marca->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"2"=>($reg['estado_marca']=='1')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_marca'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_marca'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_marca'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_marca'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_marca'],
				"1"=>$reg['descripcion_marca'],
				"3"=>$reg['id_marca']
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
		if (empty($id_marca)){
			$rspta=$marca->insertar($nombre_marca, $descripcion_marca);
			echo $rspta ? "1:Marca registrada" : "0:La marca ya se encuentra registrada";
		}
		else {
			$rspta=$marca->editar($id_marca,$nombre_marca, $descripcion_marca);
			echo $rspta ? "1:Marca actualizada" : "0:No se registraron cambios";
		}
	break;

	case '2':
		$rspta=$marca->desactivar($id_marca);
 		echo $rspta ? "1:La marca fue desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$marca->activar($id_marca);
 		echo $rspta ? "1:La marca fue activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$marca->mostrar($id_marca);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $marca->select();
		
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_marca'] . '>' . $reg['nombre_marca'] . '</option>';
		}
		echo '<option value="crear">CREAR MARCA</option>';
		
	break;

}
?>