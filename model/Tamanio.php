<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Tamanio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tamanio";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($precio_tamanio)
	{
		$validacion=$this->comprueba_duplicados($precio_tamanio,0);
		if($validacion==0){
			$sql="INSERT INTO tamanio (precio_tamanio)
			VALUES ('$precio_tamanio')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_tamanio,$precio_tamanio)
	{
		$validacion=$this->comprueba_duplicados($precio_tamanio,$id_tamanio);
		if($validacion==0){
			$sql="UPDATE tamanio SET precio_tamanio='$precio_tamanio' 
			WHERE id_tamanio='$id_tamanio'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_tamanio)
	{
		$sql="UPDATE tamanio SET estado_tamanio=1 WHERE id_tamanio='$id_tamanio'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_tamanio)
	{
		$sql="UPDATE tamanio SET estado_tamanio=0 WHERE id_tamanio='$id_tamanio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_tamanio)
	{
		$sql="SELECT id_tamanio, precio_tamanio FROM tamanio WHERE id_tamanio='$id_tamanio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_tamanio, precio_tamanio FROM tamanio WHERE estado_tamanio=0 ORDER BY precio_tamanio ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_tamanio) AS id_tamanio FROM tamanio WHERE (precio_tamanio='$codigo') AND (id_tamanio<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_tamanio'];		
	}

}

?>