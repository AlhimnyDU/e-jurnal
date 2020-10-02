<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validasi_akun($table,$where,$username,$password){
  		$query = $this->db->where($where,$username)->where('Aktif','y')->get($table);
  		if($query->num_rows()==1){
  			$hash = $query->row('password');
  			if(password_verify($password,$hash)){
   				return $query->row();
  			} else {
   				return False;
  			}
  		}else{
  			return False;
  		}
    }

    public function insert($table,$data){
    	return $this->db->insert($table,$data);
    }

    public function delete($table,$where,$id){
    	return $this->db->where($where,$id)->delete($table);
    }

    public function update($table,$where,$id,$data){
    	return $this->db->where($where,$id)->update($table,$data);
	}
}

?>