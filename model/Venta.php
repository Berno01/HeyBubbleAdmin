<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Venta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

//Implementamos un método para insertar registros
	public function insertar($cliente_venta,$total_venta,$cant_venta,$id_buba,$id_tamanio,$id_sabor,$precio_venta, $tipo_pago)
	{
	    $fecha_HoraActual= date('Y-m-d H:i:s');
	    $fecha_utc_4=date('Y-m-d H:i:s', strtotime($fecha_HoraActual .' -4 hours'));
		$sql="INSERT INTO venta (cliente_venta, total_venta,total_venta_qr, fecha_venta) VALUES('$cliente_venta',$total_venta,0, '$fecha_utc_4');";
		ejecutarConsulta($sql);
		
		$id_venta_new = retornarUltimoID();
		$num_elementos=0;
		$qr=0;
		$sw=true;
		// Convertir $total_venta de cadena a float
		$total_venta = floatval($total_venta);

		while ($num_elementos < count($id_tamanio))
		{
			if($tipo_pago[$num_elementos]=='1'||$tipo_pago[$num_elementos]=='2' ){
				$qr=$qr + ($cant_venta[$num_elementos]*$precio_venta[$num_elementos]);
				
				
			}
			$sql_detalle = "INSERT INTO detalle_venta
			(id_venta, id_tamanio, id_sabor, id_buba, cant_venta,precio_venta, id_tipo_pago) 
            VALUES 
			('$id_venta_new', '$id_tamanio[$num_elementos]', '$id_sabor[$num_elementos]', '$id_buba[$num_elementos]'
			,'$cant_venta[$num_elementos]','$precio_venta[$num_elementos]','$tipo_pago[$num_elementos]')";
			ejecutarConsulta($sql_detalle);
			$num_elementos=$num_elementos + 1;
		}// Restar $qr de $total_venta
		$total_venta =$total_venta - $qr;
		$sql="update venta set total_venta_qr=$qr, total_venta =$total_venta where id_venta=$id_venta_new;";
		ejecutarConsulta($sql);
		return $sw;
	}
	
	//Implementamos un método para anular categorías
	public function cancelar($id_venta)
	{
		//0 cancelado, 1 pendiente (defecto), 2 entregado 
		$sql="UPDATE venta SET estado_venta='0' WHERE id_venta='$id_venta'";
		return ejecutarConsulta($sql);
	}

	public function entregar($id_venta)
	{
		//0 cancelado, 1 pendiente (defecto), 2 entregado 
		$sql="UPDATE venta SET estado_venta='2' WHERE id_venta='$id_venta'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_venta)
	{
		$sql="SELECT * from venta where id_venta='$id_venta';";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_venta)
	{
		$sql="SELECT di.id_venta, di.id_buba, b.nombre_buba, di.id_sabor, s.nombre_sabor, di.id_tamanio,t.precio_tamanio,di.precio_venta , di.cant_venta, di.precio_venta, di.id_tipo_pago, tp.nombre_tipo_pago FROM detalle_venta di inner join buba b on di.id_buba=b.id_buba inner join sabor s on di.id_sabor=s.id_sabor inner join tamanio t on di.id_tamanio=t.id_tamanio inner join pago tp on di.id_tipo_pago=tp.id_tipo_pago where di.id_venta='$id_venta';";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
{
    $sql = "SELECT v.id_venta, v.cliente_venta, v.fecha_venta, v.total_venta,v.total_venta_qr, SUM(d.cant_venta) as cant_vasos, v.estado_venta 
            FROM venta v 
            JOIN detalle_venta d ON v.id_venta = d.id_venta 
            GROUP BY v.id_venta 
            ORDER BY v.fecha_venta DESC"; // Ordenar por fecha de venta de la más antigua a la más reciente
    
    return ejecutarConsulta($sql);        
}

	public function listar1()
	{
		$fecha_HoraActual= date('Y-m-d H:i:s');
	    $fecha_utc_4=date('Y-m-d H:i:s', strtotime($fecha_HoraActual .' -4 hours'));
		// Obtener la fecha actual en formato YYYY-MM-DD
		$fecha_actual = date('Y-m-d', strtotime($fecha_utc_4));
		
		// Consulta SQL para seleccionar las ventas del día actual
		$sql = "SELECT v.id_venta, v.cliente_venta, v.fecha_venta, v.total_venta,v.total_venta_qr, SUM(d.cant_venta) as cant_vasos, v.estado_venta 
				FROM venta v 
				JOIN detalle_venta d ON v.id_venta = d.id_venta 
				WHERE DATE(v.fecha_venta) = '$fecha_actual' 
				GROUP BY v.id_venta
				ORDER BY v.fecha_venta DESC";
		
		// Ejecutar la consulta y devolver el resultado
		return ejecutarConsulta($sql);        
	}


	public function reporte()
	{
		$fecha_HoraActual= date('Y-m-d H:i:s');
	    $fecha_utc_4=date('Y-m-d H:i:s', strtotime($fecha_HoraActual .' -4 hours'));
		// Obtener la fecha actual en formato YYYY-MM-DD
		$fecha_actual = date('Y-m-d', strtotime($fecha_utc_4));
		
		
		// Consulta SQL para seleccionar las ventas del día actual
		$sql = "SELECT 
		(SELECT SUM(total_venta) FROM venta WHERE fecha_venta LIKE '$fecha_actual%' AND estado_venta = 2) AS suma_total_venta,
		(SELECT SUM(total_venta_qr) FROM venta WHERE fecha_venta LIKE '$fecha_actual%' AND estado_venta = 2) AS suma_total_venta_qr,
		(SELECT SUM(dv.cant_venta)
		 FROM venta v
		 JOIN detalle_venta dv ON v.id_venta = dv.id_venta
		 WHERE v.fecha_venta LIKE '$fecha_actual%' AND v.estado_venta = 2) AS total_vasos_vendidos";
		
		// Ejecutar la consulta y devolver el resultado
		return ejecutarConsulta($sql);        
	}

	
	
	public function ventacabecera($idventa){
		$sql="SELECT i.idventa, i.idproveedor,p.personanombre as proveedornombre, p.personaap as proveedorap, p.personaam as proveedoram,u.idusuario,pr.personanombre as usuarionombre, pr.personaap as usuarioap, pr.personaam as usuarioam,i.ventatipo_comprobante,i.ventaserie_comprobante,i.ventanumero_comprobante,i.ventatotal_compra,i.ventaimpuesto,i.ventacondicion FROM venta i, persona p, proveedor r, persona pr, usuario u WHERE i.idproveedor=r.idproveedor AND r.idpersona=p.idpersona AND u.idusuario=i.idusuario AND u.idpersona=pr.idpersona AND i.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.articulonombre as articulo,a.articulocodigo,d.detalle_ventacantidad,d.detalle_ventaprecio_compra,d.detalle_ventaprecio_venta,(d.detalle_ventacantidad*d.detalle_ventaprecio_compra) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}
}

?>