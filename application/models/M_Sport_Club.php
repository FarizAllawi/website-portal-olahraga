<?php 

class M_Sport_Club extends CI_Model {
    
    public function get($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM sport_club WHERE id = $id")->row();
        }
        else {
            return $this->db->get('sport_club')->result();
        }
    }

    public function actions($id = NULL) 
    {
        $data = [
            'name' => $this->input->post('name'),
            'country' => $this->input->post('country'),
            'logo' => $this->input->post('logo'),
            'sport_league' => $this->input->post('sport_league'),
        ];
        if (!empty($id)) return $this->db->update('sport_club', $data, array('id' => $id));
        else return $this->db->insert('sport_club', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('sport_club', array('id'=>$id));
    }

}