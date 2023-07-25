<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Proveedor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM proveedor";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_proveedor, $descripcion_proveedor, $telef_proveedor)
	{
		$validacion=$this->comprueba_duplicados($nombre_proveedor,0, $descripcion_proveedor, $telef_proveedor);
		if($validacion==0){
			$sql="INSERT INTO proveedor (nombre_proveedor, descripcion_proveedor, telef_proveedor)
			VALUES ('$nombre_proveedor', '$descripcion_proveedor', '$telef_proveedor')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_proveedor,$nombre_proveedor, $descripcion_proveedor, $telef_proveedor)
	{
		$validacion=$this->comprueba_duplicados($nombre_proveedor,$id_proveedor, $descripcion_proveedor, $telef_proveedor);
		if($validacion==0){
			$sql="UPDATE proveedor SET nombre_proveedor='$nombre_proveedor', descripcion_proveedor ='$descripcion_proveedor', 
			telef_proveedor='$telef_proveedor' 
			WHERE id_proveedor='$id_proveedor'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_proveedor)
	{
		$sql="UPDATE proveedor SET estado_proveedor=FALSE WHERE id_proveedor='$id_proveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_proveedor)
	{
		$sql="UPDATE proveedor SET estado_proveedor=TRUE WHERE id_proveedor='$id_proveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_proveedor)
	{
		$sql="SELECT * FROM proveedor WHERE id_proveedor='$id_proveedor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_proveedor, nombre_proveedor FROM proveedor ORDER BY nombre_proveedor ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id, $descripcion, $telef)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_proveedor) AS id_proveedor FROM proveedor WHERE (nombre_proveedor='$codigo') AND 
		(id_proveedor<>$id) AND (descripcion_proveedor='$descripcion') AND (telef_proveedor='$telef')";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_proveedor'];		
	}

}

?>