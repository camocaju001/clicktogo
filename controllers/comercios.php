<?php

class Comercios {
	function __construct()
    {
    	/*$this->load->database();
        $this->load->model('Comercio_model');*/
    }
	public function index()
	{
		
		/*$this->load->model('Comercio_model');
	    $comercioss = $this->Comercio_model->listarComercios();
		var_dump($comercioss);*/
		
		
		/*$this->load->model('Comercio_model');
		$comerci= $this->Comercio_model->listarComercios();
		var_dump($comerci);*/
		$categorias = array('categoria1','categoria2','categoria3');
		$sucursales = array('sucursal','sucursal2','sucursal3');
		$comercios = array('cmomercio1','cmomercio2','cmomercio3');
		//$comercios = $this->listarComercios();
		/*$this->load->model('comercioModel');
		$comercios=  $this->comercioModel->listarComercios();
		var_dump($comercios);*/
		$this->tp['comercios'] = $comercios;
		
		$this->tp['categorias'] = $categorias;
		
		$this->tp['sucursales'] = $sucursales;
		
		/*$dataView= $this->load->view('comercios/comercios','',true, $this->tp);
		echo($dataView);*/	
	}
	public function listarComercios(){
		$conec = new Conectar;
		/* $SQLGetAll = "SELECT * FROM comercios ";
        $SQLReturn = $this->select($SQLGetAll);
		var_dump($SQLReturn);
//		$query = new ParseQuery("comercio");
		//$results = $query->find();
		
		$comercios = array();		
		for ( $i = 0; $i < count($results); $i++ ) 
		{ 
			$object = $results[$i]; 
			
			$obj = (object)array();
			
			$obj->id = $object->getObjectId();
			$obj->costo_domicilio = $object->get('costo_domicilio');
			$obj->descripcion = $object->get('descripcion');
			$obj->nombre = $object->get('nombre');
			$obj->pedido_minimo = $object->get('pedido_minimo');
			$obj->categoriatId = $object->get('categoriatId');
			
			$comercios[] = $obj;
		}*/
		$comercio_in = new stdClass();
		$comercio_in->id  =1;
		$comercio_in->nombre="Comercio 1";
		$comercio_in->descripcion="Descripcion 1";  
		$comercio_in->pedido_minimo="1111";  
		$comercio_in->categoriatId="1";  
		$comercio_in->costo_domicilio="10100";
		$comercios = array($comercio_in,$comercio_in,$comercio_in);
		return $comercios;
	}

	public function getComercio($id){
		/*$query = new ParseQuery("comercio");
		try {
		  $comercio = $query->get($id);
		} catch (ParseException $ex) {
			$comercio = 'false';
		}
		return $comercio;*/
	}
	
	public function crearComercio()
	{
		if($_POST["comercio_nombre"]!="" && $_POST["comercio_descripcion"]!="" && $_POST["comercio_pedido"]!=""  && $_POST["comercio_categoria"]!="" && $_POST["comercio_domicilio"]!=""){
			$comercio = new ParseObject("comercio");
			$comercio->set("nombre", $_POST["comercio_nombre"]);
			$comercio->set("descripcion", $_POST["comercio_descripcion"]);
			$comercio->set("pedido_minimo", (int)$_POST["comercio_pedido"]);
			$comercio->set("categoriaId", (int)$_POST["comercio_categoria"]);
			$comercio->set("costo_domicilio", (int)$_POST["comercio_domicilio"]);
			
			try {
			  $comercio->save();
			  echo $comercio->getObjectId();
			} catch (ParseException $ex) {  
			  // Execute any logic that should take place if the save fails.
			  // error is a ParseException object with an error code and message.
			  // echo 'Failed to create new object, with error message: ' . $ex->getMessage();
			  echo 'false';
			}
		}else{
			echo 'false';
		}
	}
	public function eliminarComercio(){
		$query = new ParseQuery("comercio");
		try {
		  $comercio = $query->get($_POST["id"]);
		  $comercio->destroy();
		} catch (ParseException $ex) {
			echo 'false';
		}
		
	}
	
	
	public function listarCategoria(){
		$query_cat = new ParseQuery("categoria_comercio");
		$results_cat = $query_cat->find();
		
		$categorias = array();		
		for ( $i = 0; $i < count($results_cat); $i++ ) 
		{ 
			$object = $results_cat[$i]; 
			
			$obj = (object)array();
			
			$obj->id = $object->getObjectId();
			$obj->descripcion = $object->get('descripcion');
			$obj->nombre = $object->get('nombre');
			
			$categorias[] = $obj;
		}
		return $categorias;
	}
	public function crearCategoria()
	{
		var_dump($_POST);
		if($_POST["categoria_nombre"]!="" && $_POST["categoria_descripcion"]!=""){
			$categoria = new ParseObject("categoria_comercio");
			$categoria->set("nombre", $_POST["categoria_nombre"]);
			$categoria->set("descripcion", $_POST["categoria_descripcion"]);
			
			try {
			  $categoria->save();
			  echo $categoria->getObjectId();
			} catch (ParseException $ex) {  
			  // echo 'Failed to create new object, with error message: ' . $ex->getMessage();
			  echo 'false';
			}
		}else{
			echo 'false';
		}
	}
	public function eliminarCategoria(){
		$query = new ParseQuery("categoria_comercio");
		try {
		  $categoria = $query->get($_POST["id"]);
		  $categoria->destroy();
		} catch (ParseException $ex) {
			echo 'false';
		}
		
	}
	
	public function crearSucursal()
	{
		$hora_post = "[".$_POST["sucursal_horario"]."]" ;
		$comercio_relacionado = $this->getComercio($_POST["sucursal_comercio"]);
		//$array_hora = json_decode($hora_post);
		if($_POST["sucursal_nombre"]!="" && $_POST["sucursal_descripcion"]!=""){
			$sucursal_lat_long = explode(",", $_POST["sucursal_long_lat"]);;
			$point = new ParseGeoPoint($sucursal_lat_long[0],$sucursal_lat_long[1]);
			
			$sucursal = new ParseObject("sucursal");
			$sucursal->set("nombre", $_POST["sucursal_nombre"]);
			$sucursal->set("descripcion", $_POST["sucursal_descripcion"]);
			$sucursal->set("horario", $hora_post );
			$sucursal->set("direccion", $_POST["sucursal_direccion"]);
			$sucursal->set("comercio_id", $comercio_relacionado);
			$sucursal->set("long_lat", $point);
			
			try {
			  $sucursal->save();
			  echo $sucursal->getObjectId();
			} catch (ParseException $ex) {  
			  // echo 'Failed to create new object, with error message: ' . $ex->getMessage();
			  echo 'false';
			}
		}else{
			echo 'false';
		}
	}
	public function listarSucursal(){
		$query = new ParseQuery("sucursal");
		$results = $query->find();
		
		$sucursales = array();		
		for ( $i = 0; $i < count($results); $i++ ) 
		{ 
			$object = $results[$i]; 
			
			$obj = (object)array();
			
			$obj->id = $object->getObjectId();
			$obj->nombre = $object->get('nombre');
			$obj->descripcion = $object->get('descripcion');
			$obj->horario = $object->get('horario');
			$obj->direccion = $object->get('direccion');
			$obj->comercio_id = $object->get('comercio_id');
			$obj->long_lat = $object->get('long_lat');
			
			$sucursales[] = $obj;
		}
		return $sucursales;
	}
}
