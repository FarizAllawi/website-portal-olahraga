<?php 

class M_League extends CI_Model {
    
    public function get($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM league WHERE id = $id")->row();
        }
        else {
            return $this->db->get('league')->result();
        }
    }

    public function actions($id = NULL) 
    {
        $data = [
            'sport_type' => $this->input->post('sport_type'),
            'name_league' => $this->input->post('name_league')
        ];
        if (!empty($id)) return $this->db->update('league', $data, array('id' => $id));
        else return $this->db->insert('league', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('league', array('id'=>$id));
    }

}