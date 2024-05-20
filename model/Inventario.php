<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Inventario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM articulo";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_articulo, $cantidad_articulo)
	{
		$validacion=$this->comprueba_duplicados($nombre_articulo,0, $cantidad_articulo);
		if($validacion==0){
			$sql="INSERT INTO articulo (nombre_articulo, cantidad_articulo)
			VALUES ('$nombre_articulo', $cantidad_articulo)";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_articulo,$nombre_articulo, $cantidad_articulo)
	{
		$validacion=$this->comprueba_duplicados($nombre_articulo,$id_articulo, $cantidad_articulo);
		if($validacion==0){
			$sql="UPDATE articulo SET nombre_articulo='$nombre_articulo', cantidad_articulo=$cantidad_articulo
			WHERE id_articulo='$id_articulo'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_articulo)
	{
		$sql="UPDATE articulo SET estado_articulo=0 WHERE id_articulo='$id_articulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_articulo)
	{
		$sql="UPDATE articulo SET estado_articulo=1 WHERE id_articulo='$id_articulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_articulo)
	{
		$sql="SELECT id_articulo, nombre_articulo, cantidad_articulo FROM articulo WHERE id_articulo='$id_articulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_articulo, nombre_articulo FROM articulo WHERE estado_articulo=0 ORDER BY nombre_articulo ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id, $cantidad_articulo)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_articulo) AS id_articulo FROM articulo WHERE (nombre_articulo='$codigo') AND (id_articulo<>$id) 
        AND (cantidad_articulo<>$cantidad_articulo)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_articulo'];		
	}

}

?>