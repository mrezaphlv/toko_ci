<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
function __construct(){
parent::__construct();
if($this->session->userdata('status') != "login"){
      //redirect(base_url("login"));
  //echo '<script>alert("Login dulu boy");document.location.href="'.base_url('login').'";</script>';
  redirect('Login');  }
  $this->load->model('M_transaksi');
}

  public function index()
  {
    $data['result'] = $this->M_transaksi->getdata()->result();
    $this->load->view('v_transaksi',$data);
  }
  function get_data_id(){
    $id_b=$this->input->get('id');
    $data=$this->M_transaksi->get_barang_by_id($id_b);
    echo json_encode($data);
  }
  public function add_transaksi(){
    $x['d_mem'] = $this->M_transaksi->getmember();
    $this->load->view('transaksi/add_transaksi',$x);
  }
 public function ajax_pelanggan()
  {
    if($this->input->is_ajax_request())
    {
      $id_m = $this->input->post('id_m');
      $this->load->model('M_transaksi');

      $data = $this->M_transaksi->get_pelanggan($id_m)->row();
      $json['kd_m']     = $data->kd_m;
      //$json['nama_m']     = $data->nama_m;
      $json['nama_m']     = ( ! empty($data->nama_m)) ? $data->nama_m : "Tidak ada";
      $json['telp']     = $data->telp;
      $json['email_m']     = $data->email_m;
      // $json['alamat']     = ( ! empty($data->alamat)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->alamat) : "<small><i>Tidak ada</i></small>";
      // $json['info_tambahan']  = ( ! empty($data->info_tambahan)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->info_tambahan) : "<small><i>Tidak ada</i></small>";
      echo json_encode($json);
    }
  }
  public function ajax_list()
  {
    $list = $this->M_transaksi->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $kk) {
      $no++;
      $row = array();
      $row[] = $no;
      //$row[] = '<img src="'.base_url().'gambar/'.$kk->foto_barang.'" width="45px" height="45px">';
      $row[] =$kk->kd_trans;
      $row[] = $kk->nama_cust;
      $row[] = date('d F Y', strtotime($kk->tanggal));
      $row[] = $kk->total_harga;
      $row[] = $kk->bayar;
      $row[] = $kk->kembali;
      $row[] = '<div class="">
      <a href="'.base_url('Transaksi/detail_trans/').$kk->kd_trans.'" class="btn btn-sm btn-info">Detail | Cetak Struk</a></div>';
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_transaksi->count_all(),
            "recordsFiltered" => $this->M_transaksi->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
  }

  public function ajax_kode()
  {
    if($this->input->is_ajax_request())
    {
      $keyword  = $this->input->post('keyword');
      $registered = $this->input->post('registered');

      $this->load->model('M_barang');

      $barang = $this->M_barang->cari_kode($keyword, $registered);

      if($barang->num_rows() > 0)
      {
        $json['status']   = 1;
        $json['datanya']  = "<ul id='daftar-autocomplete'>";
        foreach($barang->result() as $b)
        {
          $json['datanya'] .= "
            <li>
              <b>Kode</b> :
              <span id='kodenya'>".$b->kd_barang."</span> <br />
              <span id='barangnya'>".$b->nama_barang."</span>
              <span id='harganya' style='display:none;'>".$b->harga_jual."</span>
            </li>
          ";
        }
        $json['datanya'] .= "</ul>";
      }
      else
      {
        $json['status']   = 0;
      }

      echo json_encode($json);
    }
  }

public function cek_stok()
  {
    if($this->input->is_ajax_request())
    {

      $kode = $this->input->post('kode_barang');
      $stok = $this->input->post('stok');

      $get_stok = $this->M_transaksi->get_stok_barang($kode);
      if($stok > $get_stok->row()->jumlah_barang)
      {
        echo json_encode(array('status' => 0, 'pesan' => "Stok untuk <b>".$get_stok->row()->nama_barang."</b> saat ini hanya tersisa <b>".$get_stok->row()->total_stok."</b> !"));
      }
      else
      {
        echo json_encode(array('status' => 1));
      }
    }
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
function get_transaksi(){
  $id_b=$this->input->get('id');
    $data=$this->M_transaksi->get_transaksi_by_id($id_b);
    echo json_encode($data);
}


public function transaksi_save(){
  $this->form_validation->set_rules('nama_m','Nama Pelanggan','required');
  //$this->form_validation->set_rules('kd_m','Kode Pelanggan','required');
if ($this->form_validation->run() == false) {
  redirect('transaksi/add_transaksi');
}
else{
  $id_m = $this->input->post('id_m');
  $kd_tr = $this->input->post('kd_tr');
  $kd_m = $this->input->post('kd_m');
  $nama_m = $this->input->post('nama_m');
  $telp = $this->input->post('telp');
  $email_m = $this->input->post('email_m');
  $tanggal = $this->input->post('tanggal');
  $bayar = $this->input->post('cash');
  $total_bayar = $this->input->post('total_bayar');
  $kembali = preg_replace('/[^0-9]/', '', $this->input->post('uangkembali'));
  //$kembali = $this->input->post('uangkembali',true);
  $head = array(
    'kd_trans' => $kd_tr,
    'id_cust' => $id_m,
    'nama_cust' => $nama_m,
    'tanggal' => $tanggal,
    'total_harga' => $total_bayar,
    'bayar' => $bayar,
    'kembali' => $kembali
    );
  $this->M_transaksi->save_transaksi($head);
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $harga_satuan = $_POST['harga_satuan'];
  $jumlah_beli = $_POST['jumlah_beli'];
  $sub_total = $_POST['sub_total'];
  for ($i=0; $i < count($kode_barang); $i++) {
 if ($kode_barang[$i] == NULL) {
      break;
    }
     $isi = array(
    'kd_tr' => $kd_tr,
    'id_cust' => $id_m,
    'kd_cust' => $kd_m,
    'nama_cust' => $nama_m,
    'kd_barang' => $kode_barang[$i],
    'nama_barang' => $nama_barang[$i],
    'harga' => $harga_satuan[$i],
    'jumlah' => $jumlah_beli[$i],
    'sub_total' => $sub_total[$i],
    'tanggal' => $tanggal
    );
   $this->M_transaksi->save_tr_transaksi($isi);
 }
     $this->session->set_flashdata('berhasil','berhasil input data transaksi');
    redirect('transaksi');

}

}

function detail_trans($id){
$get_cust = $this->db->get_where('transaksi',array('kd_trans'=>$id))->result();
foreach ($get_cust as $k) {
  $data['nama_cust'] = $k->nama_cust;
  $data['kd_trans'] = $k->kd_trans;
  $data['tanggal'] = $k->tanggal;
  $data['total_harga'] = $k->total_harga;
  $data['bayar'] = $k->bayar;
  $data['kembali'] = $k->kembali;
}
$data['barang'] = $this->M_transaksi->get_detail_tr($id)->result();
$this->load->view('transaksi/detail',$data);
}

function cetak_pdf(){
   $this->load->library('pdf');
       $pdf = new FPDF('l','mm','A4');
       // membuat halaman baru
       $pdf->AddPage();
       // setting jenis font yang akan digunakan
       $pdf->SetFont('Arial','B',16);
       // mencetak string
       $pdf->Cell(190,7,'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA',0,1,'C');
       $pdf->SetFont('Arial','B',12);
       $pdf->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');
       // Memberikan space kebawah agar tidak terlalu rapat
       $pdf->Cell(10,7,'',0,1);
       $pdf->SetFont('Arial','B',10);
       $pdf->Cell(20,6,'NIM',1,0);
       $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
       $pdf->Cell(27,6,'NO HP',1,0);
       $pdf->Cell(25,6,'TANGGAL LHR',1,1);
       $pdf->SetFont('Arial','',10);
       $mahasiswa = $this->db->get('mahasiswa')->result();
       foreach ($mahasiswa as $row){
           $pdf->Cell(20,6,$row->nim,1,0);
           $pdf->Cell(85,6,$row->nama_lengkap,1,0);
           $pdf->Cell(27,6,$row->no_hp,1,0);
           $pdf->Cell(25,6,$row->tanggal_lahir,1,1);
       }
       $pdf->Output();
   }

}


?>
