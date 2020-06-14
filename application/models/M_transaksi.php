<?php
class M_transaksi extends CI_Model{
  var $table = 'transaksi';
  var $column_order = array(null,'kd_trans', 'nama_cust','tanggal',null,null, null); //set column field database for datatable orderable
  var $column_search = array('kd_trans','nama_cust','tanggal'); //set column field database for datatable searchable
  var $order = array('id_tr' => 'asc'); // default order
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  /* --- fungsi serverside datatabeles */
  private function _get_datatables_query()
  {

    $this->db->from($this->table);

    $i = 0;

    foreach ($this->column_search as $item) // loop column
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {

        if($i===0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }


  /* --- END fungsi serverside datatabeles */
  function getdata(){
    $this->db->from('transaksi');
$this->db->order_by("id_tr asc");
$query = $this->db->get();
return $query;

  }
function getmember(){
    $this->db->select('*');
    $this->db->from('member');
    $this->db->order_by("id_m asc");
$query = $this->db->get()->result();
return $query;

  }
function get_pelanggan($id_m)
  {
    return $this->db
      ->select('id_m, kd_m, nama_m, email_m, telp')
      ->where('id_m', $id_m)
      ->limit(1)
      ->get('member');
  }

  function get_stok_barang($kode)
  {
    return $this->db
      ->select('nama_barang, jumlah_barang')
      ->where('kd_barang', $kode)
      ->limit(1)
      ->get('barang');
  }

    function input_data($isi,$tbl){
    $this->db->insert($tbl,$isi);
  }
  function hapus_barang($id_barang){
    $hasil=$this->db->query("DELETE FROM barang WHERE id_barang='$id_barang'");
    return $hasil;
  }
  function get_barang_by_id($id_b){
    $hsl=$this->db->query("SELECT * FROM barang WHERE id_barang='$id_b'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'nama_barang' => $data->nama_barang,
          'kd_barang' =>$data->kd_barang,
          'deskripsi' => $data->deskripsi,
          'harga_beli' => $data->harga_beli,
          'harga_jual' => $data->harga_jual,
          'jumlah_barang' => $data->jumlah_barang,
          'tanggal_pembelian' => $data->tanggal_pembelian
          );
      }
    }
    return $hasil;
  }
  function get_transaksi_by_id($id_b){
    $hsl=$this->db->query("SELECT * FROM transaksi WHERE kd_trans='$id_b'");
    if($hsl->num_rows()>0){
      foreach ($hsl->result() as $data) {
        $hasil=array(
          'kd_transs' =>$data->kd_trans,
          'nama_cust' => $data->nama_cust
          );
      }
    }
    return $hasil;
  }

  function update($whr,$upd){
    $this->db->where($whr);
    $this->db->update('barang',$upd);
  }
  function save_transaksi($head){
    $this->db->insert('transaksi',$head);
  }
   function save_tr_transaksi($isi){
    $this->db->insert('tr_barang',$isi);
  }
  function get_detail_tr($id){
    $this->db->select('*');
		$this->db->from('tr_barang');
		$this->db->where('kd_tr',$id);
		$query = $this->db->get();
return $query;
  }
}
 ?>
