<?php
class Categoria{
	function __construct()
    {
		$conec = new Conectar;
		$this->conect = $conec->conexion();
	}
	public function obtenerCategorias(){
		$resultado = $this->conect->query("SELECT * FROM categorias_comercios");
		$categorias = array();
		foreach($resultado as $resu){
			/*var_dump($resu);
			$comercio_in = new stdClass();
			$comercio_in->id  =$resu->idcategoria;
			$comercio_in->nombre=$resu->nombre;
			$comercio_in->descripcion=$resu->idcategoria;  
			$comercio_in->categoriaPadre=$resu->idcategoria;  
			$categorias.pus*/
			array_push($categorias, $resu);
		}	
		
		return $categorias;
	}
	public function obtenerCategoriaNombre($id){
		$nombre ="";
		$resultado = $this->conect->query("SELECT nombre FROM categorias_comercios WHERE idcategoria = ".$id);
		if($resultado){
			foreach($resultado as $resu){
				$nombre= $resu["nombre"];
				break;
			}
		}
		return $nombre;
	}
}
