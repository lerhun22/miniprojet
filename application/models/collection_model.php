<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection_model extends CI_Model{
    function __construct() {
        $this->userTbl = '_collect';
    }
    /*
     * get rows from the users table
     */
	
	public function getall(){
		$this->db->select('*');
        $this->db->from($this->userTbl);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
			 
	public function getByLogin($val){
		$this->db->from($this->userTbl);
		$this->db->where('collector_login',$val);
		$query = $this->db->get();
/*
		echo $query->num_rows();

		foreach ($query->result() as $row)
		{
			echo $row->pokemon_id; // access attributes
			echo $row->collector_login; // or methods defined on the 'User' class
		}
*/
		return $query->result();
	}
	
    /*
     * Insert user information
     */
	Public function add($data){
		$this->db->insert($this->userTbl, $data);
		return $this->db->insert_id();
	}

	Public function get_by_id(){
		$this->db->from($this->userTbl);
		$this->db->where('pokemon_id',$id);
		
		$query=$this->db->get();
		return $query->row();
	}

	Public function delete_by_pokemon_id(){
		$this->db->where('pokemon_id',$id);
		$this->db->delete($this->userTbl);
	}

	Public function delete_by_id_by_name($id,$name){
//		settype($id, "integer");
//		settype($name, "string");
		
		$this->db->where('pokemon_id',$id);
		$this->db->where('collector_login',$name);
		$this->db->delete($this->userTbl);
	}
}
