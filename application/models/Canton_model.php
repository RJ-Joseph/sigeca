<?php
class Canton_model extends CI_model {

	function lista_cantones(){
		 $canton= $this->db->get('canton0');
		 return $canton;
	}

	function lista_cantonesA(){
		 $canton= $this->db->get('canton1');
		 return $canton;
	}




 	function canton( $id){
 		$canton = $this->db->query('select * from canton where idcanton="'. $id.'"');
 		return $canton;
 	}

 	function save($array)
 	{
		$condition = "idcanton =" . "'" . $array['idcanton'] . "'";
		$this->db->select('*');
		$this->db->from('canton');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
		   $this->db->insert("canton", $array);
		   if( $this->db->affected_rows()>0){
			    return true;
		   }else{
			    return false;
		   }
	   }else{
		    return false;
		   }
 	}

 	function update($id,$array_item)
 	{
 		$this->db->where('idcanton',$id);
 		$this->db->update('canton',$array_item);
	}
 


 	public function delete($id)
	{
 		$this->db->where('idcanton',$id);
		$this->db->delete('canton');
    		if($this->db->affected_rows()==1)
			$result=true;
		else
			$result=false;
		return $result;
 	}

 	function quitar($id)
	{

        $this->db->select('*');
		$this->db->from('canton0');
 		$this->db->where('idcanton',$id);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() != 0) {
	 	  	$this->db->where('idcanton',$id);
			$this->db->update('canton', array('eliminado'=>1));
			$result=true;
        }else{
            $result=false;
        }
		return $result;
 	}

	function elprimero()
	{
		$query=$this->db->order_by("idcanton")->get('canton');
		if($query->num_rows()>0)
		{
			return $query->first_row('array');
		}	
			return array();

	}



	function elultimo()
	{
		$query=$this->db->order_by("idcanton")->get('canton');
		if($query->num_rows()>0)
		{
			return $query->last_row('array');
		}	
			return array();

	}


	
 	function siguiente($id){
 		$canton = $this->db->select("idcanton")->order_by("idcanton")->get('canton')->result_array();
		$arr=array("idcanton"=>$id);
		$clave=array_search($arr,$canton);
	   if(array_key_exists($clave+1,$canton))
		 {

 		$canton = $this->db->query('select * from canton where idcanton="'. $canton[$clave+1]["idcanton"].'"');
		 }else{

 		$canton = $this->db->query('select * from canton where idcanton="'. $id.'"');
		 }
		 	
 		return $canton;
 	}



 	function anterior($id){
 		$canton = $this->db->select("idcanton")->order_by("idcanton")->get('canton')->result_array();
		$arr=array("idcanton"=>$id);
		$clave=array_search($arr,$canton);
	   if(array_key_exists($clave-1,$canton))
		 {

 		$canton = $this->db->query('select * from canton where idcanton="'. $canton[$clave-1]["idcanton"].'"');
		 }else{

 		$canton = $this->db->query('select * from canton where idcanton="'. $id.'"');
		 }
		 	
 		return $canton;
 	}








}
