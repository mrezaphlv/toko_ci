<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->model('M_login');
		$this->load->helper('url');
		//$this->uri->segment('2');
	}

	public function index()
	{
		$this->load->view('v_login');
	}
	// 	 $this->load->helper(array('form', 'url'));
	// 	$user       = $this->input->post('username');
	// 	$password   = $this->input->post('password');
	// 	$loginAdmin = $this->login_model->loginAdmin($this->input->post('username'), $this->input->post('password'));
	// 	$ambilDataLogin   = $this->login_model->data_loginAdmin($this->input->post('username'));
	// 	$login = $this->login_model->login($this->input->post('username'), $this->input->post('password'));
	// 	$ambilData   = $this->login_model->data_login($this->input->post('username'));

	// 	$ambildata = array('' => '', );
	public function login_exe(){
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$where = array(
			'username'=>$username,
			'password'=>sha1($pass));
		$cek = $this->M_login->cek_login($where)->num_rows();
		if($cek ==1){
			$last_login = $this->M_login->last_login($username);
		$getLogin   = $this->M_login->data_loginAdmin($this->input->post('username'));
			$data_session = array(
				'nama' => $getLogin->name,
				'status' => "login",
				'last_login' => $getLogin->last_login,
				'level' => $getLogin->level
				);
			$this->session->set_userdata($data_session);
			redirect(base_url("dash"));
		
		}
		else{
			echo 'Gagal login';
		}
	}
		function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}
}
