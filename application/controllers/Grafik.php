<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller{
  function __construct(){
  parent::__construct();
  if($this->session->userdata('status') != "login"){
        //redirect(base_url("login"));
    //echo '<script>alert("Login dulu boy");document.location.href="'.base_url('login').'";</script>';
    redirect('Login');  }
    $this->load->model('M_grafik');
  }
  function index(){
        $x['data']=$this->M_grafik->grafik_stok();
        $this->load->view('v_grafik',$x);
    }
}?>
