<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Visitor extends CI_Model {

    public function check_visitor($data){
        
        $sql = "SELECT * FROM visitor WHERE visitor.ip = '".$data['ip']."' AND visitor.url = '".$data['url']."' AND visitor.date = '".$data['date']."'";
        return $this->db->query($sql)->num_rows();
    }

    public function save($data) {
        return $this->db->insert('visitor',$data);
    }
}