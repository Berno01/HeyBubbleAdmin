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
		$sql="INSERT INTO VENTA (cliente_venta, total_venta, fecha_venta) VALUES('$cliente_venta', $total_venta, now());SELECT LAST_INSERT_ID();";
		$id_venta_new=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($id_tamanio))
		{
			$sql_detalle = "INSERT INTO detalle_venta
			(id_venta, id_tamanio, id_sabor, id_buba, cant_venta,precio_venta, tipo_pago) 
            VALUES 
			('$id_venta_new', '$id_tamanio[$num_elementos]', '$id_sabor[$num_elementos]', '$id_buba[$num_elementos]'
			,'$cant_venta[$num_elementos]','$precio_venta[$num_elementos]','$tipo_pago[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	
	//Implementamos un método para anular categorías
	public function anular($idventa)
	{
		$sql="UPDATE venta SET ventacondicion='0' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idventa)
	{
		$sql="SELECT i.idventa,DATE(i.ventafecha_hora) as fecha, i.idproveedor,p.personanombre as proveedornombre, p.personaap as proveedorap, p.personaam as proveedoram,u.idusuario,pr.personanombre as usuarionombre, pr.personaap as usuarioap, pr.personaam as usuarioam,i.ventatipo_comprobante,i.ventaserie_comprobante,i.ventanumero_comprobante,i.ventatotal_compra,i.ventaimpuesto,i.ventacondicion FROM venta i, persona p, proveedor r, persona pr, usuario u WHERE i.idproveedor=r.idproveedor AND r.idpersona=p.idpersona AND u.idusuario=i.idusuario AND u.idpersona=pr.idpersona AND i.idventa='$idventa'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa)
	{
		$sql="SELECT di.idventa,di.idarticulo,a.articulonombre,di.detalle_ventacantidad,di.detalle_ventaprecio_compra,di.detalle_ventaprecio_venta FROM detalle_venta di inner join articulo a on di.idarticulo=a.idarticulo where di.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT v.id_venta, v.cliente_venta, v.fecha_venta, v.total_venta, sum(d.cant_venta) as cant_vasos, v.estado_venta from venta v join detalle_venta d on v.id_venta=d.id_venta group by id_venta";
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