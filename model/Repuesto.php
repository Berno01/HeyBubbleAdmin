<?php 
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";

Class Repuesto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM repuesto";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $id_categoria, $stock, $stock_minimo, $precio_sugerido, $codigo_repuesto,
    $medida, $descripcion)
	{
		$validacion=$this->comprueba_duplicados($nombre,0, $id_categoria, $stock, $stock_minimo, $precio_sugerido, $codigo_repuesto,
        $medida, $descripcion);
		if($validacion==0){
			$sql="INSERT INTO repuesto (nombre_repuesto, id_categoria, stock_repuesto, stock_minimo, precio_sugerido, 
            codigo_repuesto, medida, descripcion_repuesto)
			VALUES ('$nombre_repuesto', $id_categoria, $stock, $stock_minimo, $precio_sugerido, '$codigo_repuesto',
        '$medida', '$descripcion')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_repuesto,$nombre_repuesto)
	{
		$validacion=$this->comprueba_duplicados($nombre_repuesto,$id_repuesto, $id_categoria, $stock, $stock_minimo, $precio_sugerido, $codigo_repuesto,
        $medida, $descripcion);
		if($validacion==0){
			$sql="UPDATE repuesto SET nombre_repuesto='$nombre_repuesto' 
			WHERE id_repuesto='$id_repuesto'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_repuesto)
	{
		$sql="UPDATE repuesto SET estado_repuesto=FALSE WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_repuesto)
	{
		$sql="UPDATE repuesto SET estado_repuesto=TRUE WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_repuesto)
	{
		$sql="SELECT id_repuesto, nombre_repuesto FROM repuesto WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_repuesto, nombre_repuesto FROM repuesto ORDER BY nombre_repuesto ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo,$id, $id_categoria, $stock, $stock_minimo, $precio_sugerido, $codigo_repuesto,
    $medida, $descripcion)
	{
		$resultado=0;
		$sql="SELECT COUNT(id_repuesto) AS id_repuesto FROM repuesto WHERE (nombre_repuesto='$codigo') AND (id_repuesto<>$id)
        AND (id_categoria='$id_categoria') AND (stock_repuesto='$stock') AND (stock_minimo='$stock_minimo') AND 
        (precio_sugerido='$precio_sugerido') AND (codigo_repuesto ='$codigo_repuesto') AND (medida='$medida') AND 
        (descripcion='$descripcion');"
        ;
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_repuesto'];		
	}

}

?>