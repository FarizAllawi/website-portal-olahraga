<?php 

class M_Sport_Type extends CI_Model {
    
    public function get($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM sport_type WHERE id = $id")->row();
        }
        else {
            return $this->db->get('sport_type')->result();
        }
    }

    public function actions($id = NULL) 
    {
        if (!empty($id)) {
            $data = ['name_type' => $this->input->post('name_type')];
            return $this->db->update('sport_type', $data, array('id' => $id));
        }
        else {
            $data = ['name_type' => $this->input->post('name_type')];
            return $this->db->insert('sport_type', $data);
        }
    }

    public function delete($id)
    {
        return $this->db->delete('sport_type', array('id'=>$id));
    }

}