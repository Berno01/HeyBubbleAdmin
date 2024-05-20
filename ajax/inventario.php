<?php 
require_once "../model/Inventario.php";

$articulo=new Inventario();

$id_articulo=isset($_POST["id_articulo"])? $_POST["id_articulo"]:"";
$nombre_articulo=isset($_POST["nombre_articulo"])? strtoupper($_POST["nombre_articulo"]):"";
$cantidad_articulo=isset($_POST["cantidad_articulo"])? $_POST["cantidad_articulo"]:"";

switch ($_GET["op"]){
	case '0':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg = mysqli_fetch_assoc($rspta)){			
			$data[]=array(
				"2"=>($reg['estado_articulo']=='1')?'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_articulo'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-danger btn-rounded btn-tone btn-sm " onclick="desactivar('.$reg['id_articulo'].')"><i class="anticon anticon-delete"></i></button>':
					'<button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" onclick="mostrar('.$reg['id_articulo'].')"><i class="anticon anticon-edit"></i></button>'.
					'<button class="btn btn-icon btn-success btn-rounded btn-tone btn-sm pull-right" onclick="activar('.$reg['id_articulo'].')"><i class="anticon anticon-delete"></i></button>',
				"0"=>$reg['nombre_articulo'],
                "1"=>$reg['cantidad_articulo'],
				"3"=>$reg['id_articulo']
				
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
		if (empty($id_articulo)){
			$rspta=$articulo->insertar($nombre_articulo, $cantidad_articulo);
			echo $rspta ? "1:La articulo fue registrada" : "0:articulo ya registrada";
		}
		else {
			$rspta=$articulo->editar($id_articulo,$nombre_articulo, $cantidad_articulo);
			echo $rspta ? "1:La articulo fué actualizada" : "0:articulo ya registrada";
		}
        echo $rspta ? "1:La articulo fué actualizada" : "0:articulo ya registrada";
	break;

	case '2':
		$rspta=$articulo->desactivar($id_articulo);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Desactivada" : "0:a acción para la Hoja de Ruta no fué Desactivada";
	break;

	case '3':
		$rspta=$articulo->activar($id_articulo);
 		echo $rspta ? "1:a acción para la Hoja de Ruta fué Activada" : "0:a acción para la Hoja de Ruta no fué Activada";
	break;

	case '4':
		$rspta=$articulo->mostrar($id_articulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case '5':
		$rspta = $articulo->select();
		while ($reg = mysqli_fetch_assoc($rspta))
		{
			echo '<option value=' . $reg['id_articulo'] . '>' . $reg['nombre_articulo'] . '</option>';
		}
			echo '<option value="crearC">AGREGAR articulo</option>'; 
	break;
}
?>