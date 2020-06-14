<?php
/**
 *
 */
class M_grafik extends CI_Model
{

  // function __construct(argument)
  // {
  //   // code...
  // }
  function grafik_stok(){
    $query = $this->db->query("SELECT * FROM barang");

        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
  }
}

 ?>
