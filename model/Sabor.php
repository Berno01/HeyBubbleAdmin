<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Sabor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM sabor";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_sabor)
	{
		$validacion=$this->comprueba_duplicados($nombre_sabor,0);
		if($validacion==0){
			$sql="INSERT INTO sabor (nombre_sabor)
			VALUES ('$nombre_sabor')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_sabor,$nombre_sabor)
	{
		$validacion=$this->comprueba_duplicados($nombre_sabor,$id_sabor);
		if($validacion==0){
			$sql="UPDATE sabor SET nombre_sabor='$nombre_sabor' 
			WHERE id_sabor='$id_sabor'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_sabor)
	{
		$sql="UPDATE sabor SET estado_sabor=1 WHERE id_sabor='$id_sabor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_sabor)
	{
		$sql="UPDATE sabor SET estado_sabor=0 WHERE id_sabor='$id_sabor'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_sabor)
	{
		$sql="SELECT id_sabor, nombre_sabor FROM sabor WHERE id_sabor='$id_sabor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_sabor, nombre_sabor FROM sabor WHERE estado_sabor=0 ORDER BY nombre_sabor ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_sabor) AS id_sabor FROM sabor WHERE (nombre_sabor='$codigo') AND (id_sabor<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_sabor'];		
	}

}

?>