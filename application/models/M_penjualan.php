<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model {

	var $table = 'tr_barang';
	var $column_order = array(null, 'kd_tr','kd_cust','nama_cust','kd_barang','nama_barang',null,null, null, null); //set column field database for datatable orderable
	var $column_search = array('kd_tr','kd_cust','nama_cust','kd_barang','nama_barang'); //set column field database for datatable searchable 
	var $order = array('id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
//datatables function---
	private function _get_datatables_query()
	{
		
		//add custom filter here
		if($this->input->post('nama_barang'))
		{
			$this->db->where('kd_barang', $this->input->post('nama_barang'));
		}
		// if($this->input->post('tanggal'))
		// {
		// 	$this->db->like('tanggal', $this->input->post('tanggal'));
		// }
		// if($this->input->post('LastName'))
		// {
		// 	$this->db->like('LastName', $this->input->post('LastName'));
		// }
		// if($this->input->post('address'))
		// {
		// 	$this->db->like('address', $this->input->post('address'));
		// }

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

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
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

	public function get_list_barang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->order_by('id_barang','asc');
		$query = $this->db->get();
		$result = $query->result();

		
		return $result;
	}
	//datatables function closed---

}
