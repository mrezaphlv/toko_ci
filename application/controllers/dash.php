<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {
	function __construct(){
parent::__construct();
if($this->session->userdata('status') != "login"){
			//redirect(base_url("login"));
	//echo '<script>alert("Login dulu boy");document.location.href="'.base_url('login').'";</script>';
	redirect('Login');	}
	
}

	public function index()
	{
		$this->load->view('v_dash');
	}
}
