<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM categoria";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_categoria)
	{
		$validacion=$this->comprueba_duplicados($nombre_categoria,0);
		if($validacion==0){
			$sql="INSERT INTO categoria (nombre_categoria)
			VALUES ('$nombre_categoria')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_categoria,$nombre_categoria)
	{
		$validacion=$this->comprueba_duplicados($nombre_categoria,$id_categoria);
		if($validacion==0){
			$sql="UPDATE categoria SET nombre_categoria='$nombre_categoria' 
			WHERE id_categoria='$id_categoria'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_categoria)
	{
		$sql="UPDATE categoria SET estado_categoria=FALSE WHERE id_categoria='$id_categoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_categoria)
	{
		$sql="UPDATE categoria SET estado_categoria=TRUE WHERE id_categoria='$id_categoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_categoria)
	{
		$sql="SELECT id_categoria, nombre_categoria FROM categoria WHERE id_categoria='$id_categoria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_categoria, nombre_categoria FROM categoria ORDER BY nombre_categoria ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_categoria) AS id_categoria FROM categoria WHERE (nombre_categoria='$codigo') AND (id_categoria<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_categoria'];		
	}

}

?>