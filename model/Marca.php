<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class marca
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM marca";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_marca)
	{
		$validacion=$this->comprueba_duplicados($nombre_marca,0);
		if($validacion==0){
			$sql="INSERT INTO marca (nombre_marca)
			VALUES ('$nombre_marca')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_marca,$nombre_marca)
	{
		$validacion=$this->comprueba_duplicados($nombre_marca,$id_marca);
		if($validacion==0){
			$sql="UPDATE marca SET nombre_marca='$nombre_marca' 
			WHERE id_marca='$id_marca'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_marca)
	{
		$sql="UPDATE marca SET estado_marca=1 WHERE id_marca='$id_marca'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_marca)
	{
		$sql="UPDATE marca SET estado_marca=0 WHERE id_marca='$id_marca'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_marca)
	{
		$sql="SELECT id_marca, nombre_marca FROM marca WHERE id_marca='$id_marca'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_marca, nombre_marca FROM marca where estado_marca=0 ORDER BY nombre_marca ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_marca) AS id_marca FROM marca WHERE (nombre_marca='$codigo') AND (id_marca<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_marca'];		
	}

}

?>