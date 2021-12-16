<?php 

class M_League extends CI_Model {
    
    public function get($sportType_id = NULL, $id = NULL)
    {
        if (!empty($id)) {
            return $this->db->get_where('league', array('id' => $id))->row();
        }
        else {
            return $this->db->get_where('league', array('sport_type' => $sportType_id))->result();
        }
    }

    public function get_by_name($name) {
        return $this->db->query("SELECT * FROM `league` WHERE league.name_league LIKE '%$name%'")->row();
    }

    public function get_all_league() {
        return $this->db->get('league')->result();
    }

    public function actions($sportType_id , $id = NULL) 
    {
        $data = [
            'sport_type' => $sportType_id,
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