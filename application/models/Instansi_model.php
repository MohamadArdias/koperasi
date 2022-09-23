<?php 

class Instansi_model extends  CI_Model{
    public function getAllInstansi()
    {
        return $this->db->get('instan')->result_array();
    }

    public function getInstansi($limit, $start)
    {
        return $this->db->get('instan', $limit, $start)->result_array();
    }

    public function countAllInstansi()
    {
        return $this->db->get('instan')->num_rows();
    }
}

?>