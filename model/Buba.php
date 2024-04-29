<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class buba
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM buba";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_buba)
	{
		$validacion=$this->comprueba_duplicados($nombre_buba,0);
		if($validacion==0){
			$sql="INSERT INTO buba (nombre_buba)
			VALUES ('$nombre_buba')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_buba,$nombre_buba)
	{
		$validacion=$this->comprueba_duplicados($nombre_buba,$id_buba);
		if($validacion==0){
			$sql="UPDATE buba SET nombre_buba='$nombre_buba' 
			WHERE id_buba='$id_buba'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_buba)
	{
		$sql="UPDATE buba SET estado_buba=0 WHERE id_buba='$id_buba'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_buba)
	{
		$sql="UPDATE buba SET estado_buba=1 WHERE id_buba='$id_buba'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_buba)
	{
		$sql="SELECT id_buba, nombre_buba FROM buba WHERE id_buba='$id_buba'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_buba, nombre_buba FROM buba WHERE estado_buba=1 ORDER BY nombre_buba ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_buba) AS id_buba FROM buba WHERE (nombre_buba='$codigo') AND (id_buba<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_buba'];		
	}

}

?>