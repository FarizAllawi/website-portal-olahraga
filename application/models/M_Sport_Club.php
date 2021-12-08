<?php

class M_Sport_Club extends CI_Model
{

    public function get($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM sport_club WHERE id = $id")->row();
        } else {
            return $this->db->get('sport_club')->result();
        }
    }

    public function actions($id = NULL)
    {
        $upload = isset($this->upload->data()) ? $this->upload->data() : '';
        if (!empty($id)) {
            $data = [
                'name' => $this->input->post('name'),
                'country' => $this->input->post('country'),
                'logo' => empty($this->upload->data()) ? site_url('upload/' . $upload['file_name']) : $this->input->post('logo-lama'),
                'sport_league' => $this->input->post('liga'),
            ];
            return $this->db->update('sport_club', $data, array('id' => $id));
        } else {
            die("TRUE");

            $data = [
                'name' => $this->input->post('name'),
                'country' => $this->input->post('country'),
                'logo' => site_url('upload/' . $upload['file_name']),
                'sport_league' => $this->input->post('liga'),
            ];
            return $this->db->insert('sport_club', $data);
        }
    }

    public function delete($id)
    {
        return $this->db->delete('sport_club', array('id' => $id));
    }
}
