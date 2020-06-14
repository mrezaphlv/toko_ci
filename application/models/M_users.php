<?php 
class M_users extends CI_Model{
	var $table = 'users';
	var $column_order = array('name', 'email','username','last_login', null); //set column field database for datatable orderable
	var $column_search = array('name', 'email','username','last_login'); //set column field database for datatable searchable 
	var $order = array('user_id' => 'asc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/* --- fungsi serverside datatabeles */
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->where('level','2');
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
		$this->db->where('level','2');
		return $this->db->count_all_results();
	}


	/* --- END fungsi serverside datatabeles */
	function getdata(){
		$this->db->from('users');
$this->db->order_by("user_id asc");
$query = $this->db->get(); 
return $query;
		
	}
	function input_data($isi,$tbl){
		$this->db->insert($tbl,$isi);
	 }
	function hapus($user_id){
		$hasil=$this->db->query("DELETE FROM users WHERE user_id='$user_id'");
		return $hasil;
	}
	function get_id($id_b){
		$hsl=$this->db->query("SELECT * FROM users WHERE user_id='$id_b'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'name' => $data->name,
					'email' => $data->email,
					'username' => $data->username,
					'password' => $data->password
					);
			}
		}
		return $hasil;
	}
	function update($whr,$upd){
		$this->db->where($whr);
		$this->db->update('users',$upd);
	}
	// function update($whr,$upd){
	// 	$this->db->where($whr);
	// 	$this->db->update('barang',$upd);
	// }
}
 ?>