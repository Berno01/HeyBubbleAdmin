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
		$sql="select r.id_repuesto, r.codigo_repuesto, c.nombre_categoria, m.nombre_marca, r.descripcion_repuesto, r.medida_repuesto,
		r.stock_repuesto, r.precio_sugerido, r.estado_repuesto 
		from repuesto r, categoria c, marca m
		where r.id_categoria=c.id_categoria and r.id_marca=m.id_marca";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($codigo_repuesto, $id_marca, $id_categoria, $descripcion_repuesto, $medida_repuesto,
	$stock_repuesto, $stock_minimo, $precio_sugerido)
	{
		$validacion=0;
		//$validacion=$this->comprueba_duplicados($nombre,0, $id_categoria, $stock, $stock_minimo, $precio_sugerido, $codigo_repuesto,
        //$medida, $descripcion);
		if($validacion==0){
			$sql="INSERT INTO repuesto (codigo_repuesto, id_marca, id_categoria, descripcion_repuesto, medida_repuesto,
			stock_repuesto, stock_minimo, precio_sugerido)
			VALUES ('$codigo_repuesto', $id_marca, $id_categoria, '$descripcion_repuesto', '$medida_repuesto',
			$stock_repuesto, $stock_minimo, '$precio_sugerido')";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($id_repuesto, $codigo_repuesto, $id_marca, $id_categoria, $descripcion_repuesto, $medida_repuesto,
	$stock_repuesto, $stock_minimo, $precio_sugerido)
	{
		
		$validacion=$this->comprueba_duplicados($codigo_repuesto,$id_marca, $id_categoria, $stock_repuesto, $stock_minimo, $precio_sugerido,
		$medida_repuesto, $descripcion_repuesto);
		if($validacion==0){
			$sql="UPDATE repuesto SET codigo_repuesto='$codigo_repuesto', id_marca=$id_marca,
			id_categoria=$id_categoria, descripcion_repuesto='$descripcion_repuesto', 
			stock_repuesto=$stock_repuesto, stock_minimo=$stock_minimo, precio_sugerido=$precio_sugerido
			WHERE id_repuesto='$id_repuesto'";
			return ejecutarConsulta($sql);
		}
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_repuesto)
	{
		$sql="UPDATE repuesto SET estado_repuesto=1 WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_repuesto)
	{
		$sql="UPDATE repuesto SET estado_repuesto=0 WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_repuesto)
	{
		$sql="SELECT * FROM repuesto WHERE id_repuesto='$id_repuesto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT id_repuesto, nombre_repuesto FROM repuesto ORDER BY nombre_repuesto ASC";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($codigo_repuesto,$id_marca, $id_categoria, $stock_repuesto, $stock_minimo, $precio_sugerido,
    $medida_repuesto, $descripcion_repuesto)
	{
		
		$resultado=0;
		$sql="select count(id_repuesto) AS id_repuesto FROM repuesto WHERE id_categoria = $id_categoria AND 
		codigo_repuesto='$codigo_repuesto' AND id_marca = $id_marca AND 
		medida_repuesto='$medida_repuesto' AND stock_repuesto= $stock_repuesto AND 
		stock_minimo=$stock_minimo AND precio_sugerido=$precio_sugerido AND 
		descripcion_repuesto='$descripcion_repuesto';";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['id_repuesto'];		
	}

}

?>