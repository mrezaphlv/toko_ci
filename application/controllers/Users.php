<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
function __construct(){
parent::__construct();
if($this->session->userdata('status') != "login"){
      //redirect(base_url("login"));
  //echo '<script>alert("Login dulu boy");document.location.href="'.base_url('login').'";</script>';
  redirect('Login');  }
  $this->load->model('M_users');
}

  public function index()
  {
    $data['result'] = $this->M_users->getdata()->result();
    $this->load->view('v_users',$data);
  }
  function get_users(){
    $id_b=$this->input->get('id');
    $data=$this->M_users->get_id($id_b);
    echo json_encode($data);
  }
  public function ajax_list()
  {
    $list = $this->M_users->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $kk) {
      $no++;
      $row = array();
      $row[0] = $no;
      //$row[] = '<img src="'.base_url().'gambar/'.$kk->foto_barang.'" width="45px" height="45px">';
      $row[1] = $kk->name;
      $row[2] = $kk->email;
      $row[3] = $kk->username;
      $row[4] = $kk->last_login;
      if ($this->session->userdata('level') == 1) {
       $row[5] = '<div class="btn-group"><a href="javascript:;" data="'.$kk->user_id.'" class="btn btn-sm btn-info item_edit">Edit</a><a href="javascript:;" class="btn btn-sm btn-danger" id="item_hapus" data="'.$kk->user_id.'">Hapus</a></div>';
      }
      else{
        $row[5] = '<div class=""><a href="javascript:;" class="btn btn-sm btn-danger" id="item_hapus" data="'.$kk->user_id.'">Hapus</a></div>';
      }
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_users->count_all(),
            "recordsFiltered" => $this->M_users->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }
  public function add(){
 $this->form_validation->set_rules('in_name','Nama','required');
         $this->form_validation->set_rules('username','Username','required|is_unique[users.username]');
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('password', 'Password', 'required');
          $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
          $now = date("Y-m-d H:i:s");
          if($this->form_validation->run() == false){
            $data['result'] = $this->M_users->getdata()->result();
    $this->load->view('v_users',$data);
          }
          else{
  

    $isi = array(
      'name'=> $this->input->post('in_name'),
      'email' => $this->input->post('email'),
      'username' => $this->input->post('username'),
      'password' => sha1($this->input->post('password')),
      'last_login' => $now,
      'level' => '2');
    $masuk = $this->M_users->input_data($isi,'users');
if($masuk = true){

  $this->session->set_flashdata('berhasil', 'anda berhasil menambah data');
  redirect('Users');
}
          }
    
  }

  function delete($user_id){
    $data=$this->M_users->hapus($user_id);
    if ($data) {
    $sflash = $this->session->set_flashdata('berhasil', 'anda berhasil menghapus data user');
    redirect('Users');
    }
    
    //echo json_encode($data);
    // if ($data) {
    //  echo json_encode(array('message'=> $sflash));
  }
  function edit_exe(){
    $password = $this->input->post('password');
         $passconf = $this->input->post('passconf');
         if ($password == null && $passconf == null) {
          $this->form_validation->set_rules('ed_name','Nama','required');
         $this->form_validation->set_rules('ed_username','Username','required');
         $this->form_validation->set_rules('ed_email', 'Email', 'required|valid_email');
         if($this->form_validation->run() == false){
          $this->session->set_flashdata('gagal', 'Kurang isian formnya');
          redirect('Users');
         }
         else{
          $id_b = $this->input->post('ed_id');
        $whr = array('user_id' => $id_b);
    $upd = array(
     'name'=> $this->input->post('ed_name'),
      'email' => $this->input->post('ed_email'),
      'username' => $this->input->post('ed_username')
      );
    $updat = $this->M_users->update($whr,$upd);
    if ($updat = true) {
     $this->session->set_flashdata('berhasil', 'anda berhasil edit data users');
    redirect('Users');
    }
         }
    
         }
         else{
          $this->form_validation->set_rules('ed_name','Nama','required');
         $this->form_validation->set_rules('ed_username','Username','required');
         $this->form_validation->set_rules('ed_email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('password', 'Password', 'required');
          $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
         if($this->form_validation->run() == false){
          $this->session->set_flashdata('gagal', 'Kurang isian formnya');
          redirect('Users');
         }
         else{
          $id_b = $this->input->post('ed_id');
        $whr = array('user_id' => $id_b);
    $upd = array( 'name'=> $this->input->post('ed_name'),
      'email' => $this->input->post('ed_email'),
      'username' => $this->input->post('ed_username'),
      'password' => sha1($password),
      '' => $this->input->post('ed_jumlah_barang')
      );
    $updat = $this->M_users->update($whr,$upd);
    if ($updat = true) {
     $this->session->set_flashdata('berhasil', 'anda berhasil edit data users');
    redirect('Users');
    }
         }
    
         }
    

  }



}
	

?>
