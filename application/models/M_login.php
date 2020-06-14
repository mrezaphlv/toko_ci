<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_login extends CI_model{
 function cek_login($where){
return $this->db->get_where('users',$where);
 }

	function data_loginAdmin($username) {
	    // $pass = password_verify($password, $hash);
		$this->db->where('username', $username);
	    // $this->db->where('password', $password);
		return $this->db->get('users')->row();
	}
	function last_login($username){
		$date = date('Y-m-d H:i:s');
		$upd = array('last_login' => $date);
		$this->db->where('username', $username);
		$this->db->update('users',$upd);
	}
 }
 ?>