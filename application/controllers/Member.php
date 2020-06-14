<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
function __construct(){
parent::__construct();
if($this->session->userdata('status') != "login"){
      //redirect(base_url("login"));
  //echo '<script>alert("Login dulu boy");document.location.href="'.base_url('login').'";</script>';
  redirect('Login');  }
  $this->load->model('M_member');
}

  public function index()
  {
    $data['result'] = $this->M_member->getdata()->result();
    $this->load->view('v_member',$data);
  }
  function get_users(){
    $id_b=$this->input->get('id');
    $data=$this->M_member->get_id($id_b);
    echo json_encode($data);
  }
  public function ajax_list()
  {
    $list = $this->M_member->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $kk) {
      $no++;
      $row = array();
      $row[0] = $no;
      //$row[] = '<img src="'.base_url().'gambar/'.$kk->foto_barang.'" width="45px" height="45px">';
      $row[1] = $kk->kd_m;
      $row[2] = $kk->nama_m;
      $row[3] = $kk->email_m;
       $row[4] = '<div class="btn-group"><a href="javascript:;" data="'.$kk->id_m.'" class="btn btn-sm btn-info item_edit">Edit</a><a href="javascript:;" class="btn btn-sm btn-danger" id="item_hapus" data="'.$kk->id_m.'">Hapus</a></div>';
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_member->count_all(),
            "recordsFiltered" => $this->M_member->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }
  public function add(){
 $this->form_validation->set_rules('kode_m','Kode Member','required|is_unique[member.kd_m]');
         $this->form_validation->set_rules('nama_m','nama','required');
         $this->form_validation->set_rules('email_m', 'Email', 'required|valid_email');
          //$now = date("Y-m-d H:i:s");
          if($this->form_validation->run() == false){
            $data['result'] = $this->M_member->getdata()->result();
    $this->load->view('v_member',$data);
          }
          else{
  

    $isi = array(
      'kd_m'=> $this->input->post('kode_m'),
      'nama_m' => $this->input->post('nama_m'),
      'email_m' => $this->input->post('email_m')
      );
    $masuk = $this->M_member->input_data($isi);
if($masuk = true){

  $this->session->set_flashdata('berhasil', 'anda berhasil menambah data');
  redirect('Member');
}
          }
    
  }

  function delete($id){
    $data=$this->M_member->hapus($id);
    if ($data) {
    $sflash = $this->session->set_flashdata('berhasil', 'anda berhasil menghapus data member');
    redirect('Member');
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
