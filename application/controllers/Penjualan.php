<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
function __construct(){
parent::__construct();
if($this->session->userdata('status') != "login"){
  redirect('Login');  }
  $this->load->model('M_penjualan');
}

  public function index()
  {
    $data['form_barang'] = $this->M_penjualan->get_list_barang();
    $this->load->view('v_penjualan', $data);
  }

  function get_barang(){
    $id_b=$this->input->get('id');
    $data=$this->M_barang->get_barang_by_id($id_b);
    echo json_encode($data);
  }
 public function ajax_list()
  {
    $list = $this->M_penjualan->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $c) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $c->kd_tr;
      $row[] = $c->kd_cust;
      $row[] = $c->nama_cust;
      $row[] = $c->kd_barang;
      $row[] = $c->nama_barang;
      $row[] = $c->harga;
      $row[] = $c->jumlah;
      $row[] = $c->sub_total;
      $row[] = $c->tanggal;
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_penjualan->count_all(),
            "recordsFiltered" => $this->M_penjualan->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }
  public function add(){
    
   //$this->form_validation->set_rules('foto_barang','Foto Barang','callback_cek_upload');
              $harga_beli = preg_replace('/[^0-9]/', '', $this->input->post('harga_beli'));
            $harga_jual = preg_replace('/[^0-9]/', '', $this->input->post('harga_jual'));
 $this->form_validation->set_rules('nama_barang','Nama Barang','required');
         $this->form_validation->set_rules('harga_beli','Harga Beli','required');
         $this->form_validation->set_rules('harga_jual','Harga jual','required');
          $this->form_validation->set_rules('jumlah_barang','Jumlah Barang','required|numeric');
          $now = date("Y-m-d H:i:s");
          $tanggal_pembelian = date("Y-m-d", strtotime($this->input->post('tanggal_pembelian')));
          if($this->form_validation->run() == false){
            $data['result'] = $this->M_barang->getdata()->result();
    $this->load->view('v_barang',$data);
          }
          else{
  

    $isi = array(
      'nama_barang'=> $this->input->post('nama_barang'),
      'deskripsi' => $this->input->post('deskripsi'),
      'harga_beli' => $harga_beli,
      'harga_jual' => $harga_jual,
      'jumlah_barang' => $this->input->post('jumlah_barang'),
      'tanggal_pembelian' => $tanggal_pembelian);
    $masuk = $this->M_barang->input_data($isi,'barang');
if($masuk = true){

  $this->session->set_flashdata('berhasil', 'anda berhasil menambah data');
  redirect('Barang');
}
          }
    
  }

  function delete($id_barang){
    $data=$this->M_barang->hapus_barang($id_barang);
    if ($data) {
    $sflash = $this->session->set_flashdata('berhasil', 'anda berhasil menghapus data');
    redirect('Barang');
    }
    
    //echo json_encode($data);
    // if ($data) {
    //  echo json_encode(array('message'=> $sflash));
  }
  function edit_exe(){
    $id_b = $this->input->post('ed_id');
     $harga_beli = preg_replace('/[^0-9]/', '', $this->input->post('ed_harga_beli'));
            $harga_jual = preg_replace('/[^0-9]/', '', $this->input->post('ed_harga_jual'));
          $tanggal_pembelian = date("Y-m-d", strtotime($this->input->post('ed_tanggal_pembelian')));
        $whr = array('id_barang' => $id_b);
    $upd = array( 'nama_barang'=> $this->input->post('ed_nama_barang'),
      'deskripsi' => $this->input->post('ed_deskripsi'),
      'harga_beli' => $harga_beli,
      'harga_jual' => $harga_jual,
      'jumlah_barang' => $this->input->post('ed_jumlah_barang'),
      'tanggal_pembelian' => $tanggal_pembelian);
    $updat = $this->M_barang->update($whr,$upd);
    if ($updat = true) {
     $this->session->set_flashdata('berhasil', 'anda berhasil edit data');
    redirect('Barang');
    }

  }



}
	

?>
