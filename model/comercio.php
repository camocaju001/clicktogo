<?php
class Comercio_model extends CI_Model  {

   function __construct(){
		$this->load->database();
   }
   
   function listarComercios(){
		$query = $this->db->get_where('comercios', array('idcomercio' => $id));
		return $query->row_array();
   }
}
?>
