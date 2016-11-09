<?php
class Conectar{
    function __construct()
    {
		$conexion = mysqli_connect('localhost', 'root', '', 'admin_clicktogo');
		if (!$conexion) {
			 die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
			return FALSE;			
		}else
		{
			return $conexion;			
		}	
	}
    public function conexion()
	{
		$conexion = mysqli_connect('localhost', 'root', '', 'admin_clicktogo');
	
		if (!$conexion) 
			 die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		else
		{
			return $conexion;			
		}	
	}
 	protected function query($SQL){
 		$resultado = $this->conexion->query($SQL);
		return $resultado;
 	}
	protected function insert($table_name,$cols,$vals,$debug = false)
	{
		$SQL_INSERT = "INSERT INTO $table_name ($cols) VALUES ($vals)";
		if($debug)
			$this->debuger($SQL_INSERT,array());
		
		
		$stmt = mysqli_prepare($this->conexion, $SQL_INSERT);
		/* Execute the statement */
		$answer = mysqli_stmt_execute($stmt);
		if(!$answer){
			 die('INSERT no válida: ' . mysqli_stmt_error($stmt));
		}
		else{
			/* close statement */
			mysqli_stmt_close($stmt);
			return true;
		}
	}

	 protected function select($SQL,$debug = false)
    {
    	$array_return = array();
    	
    	if( strlen( $SQL ) > 0 )
    	{
    		if ($result = mysqli_query($this->conexion, $SQL)) 
    		{
    			while ($row = mysqli_fetch_row($result)) 
    			{
    				$array_return[] = $row;
    			}
    			/* free result set */
    			mysqli_free_result($result);
    		}
    		
    		/*debug para revisar si el sql que se pasa es el correcto y las respuestas del array*/
    		if($debug){
    			$this->debuger($SQL,$array_return);
    		}
    	}
    	
    	return $array_return;
	}

	protected function update($table, $cols, $vals, $clauses = '', $debug = false)
	{	
		$salida = "";
		$AND = '1=1 ';
		$columns = explode(',', $cols);
		$values = explode(',', $vals);
		if($clauses == ''){
			$clauses = array();
		}
		else{
			$clauses = explode(',', $clauses);
		}
		if((count($columns)) != (count($values)))
		{
			if($debug)
				$this->debuger("No son iguales las columnas a los valores",array());
			return false;
		}
		else{
			$sets = '';
			$i=0;
			foreach ($columns as $column) {
				$sets .="$column = ".$values[$i].", ";
				++$i;
			}
			if(count($clauses)>0){
				foreach ($clauses as $clause) {
					$AND .="AND $clause ";
				}	
			}
			
			$sets = substr($sets , 0, -2); //quita la ',' y el espacio final
			$AND = substr($AND , 0, -1); //quita el espacio final
			$SQL_UPDATE = "UPDATE $table SET $sets WHERE $AND";

			//echo $SQL_UPDATE;
		
			if($debug){
				$this->debuger($SQL_UPDATE,array());
			}
			
			$stmt = mysqli_prepare($this->conexion, $SQL_UPDATE);
			$answer = mysqli_stmt_execute($stmt);
			if(!$answer){
				 die('actualización no válida: ' . mysqli_stmt_error($stmt));
				 return false;
			}
			else{
				mysqli_stmt_close($stmt);
				return true;
			}
		}
	}

	protected function delete($table, $clauses = '', $debug = false){
		$AND = '1=1 ';
		if($clauses == ''){
			$clauses = array();
		}
		else{
			$clauses = explode(',', $clauses);
		}
		
		if(count($clauses)>0){
			foreach ($clauses as $clause){
				$AND .="AND $clause ";
			}	
		}
		$SQL_DELETE = "DELETE FROM $table WHERE $AND";
		
		//debug del sql
		if($debug){
			$this->debuger($SQL_DELETE,array());
		}
		
		$stmt = mysqli_prepare($this->conexion, $SQL_DELETE);
		$answer = mysqli_stmt_execute($stmt);
	    if(!$answer){
			 die('eliminacion no válida: ' . mysqli_stmt_error($stmt));
	    }
		else{
			mysqli_stmt_close($stmt);
			return true;
		}
	}
}
?>
