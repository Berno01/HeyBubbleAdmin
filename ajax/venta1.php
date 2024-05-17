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
	

	case '3':
		$qr=16.5;
        $total_venta = floatval($total_venta);
        $total_venta = $total_venta - $qr;
        $rspta = $total_venta;
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	

}
?>