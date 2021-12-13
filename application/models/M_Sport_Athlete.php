<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Sport_Athlete extends CI_Model {

    public function getAthlete($id = NULL) 
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM sport_athlete WHERE id = $id")->row();
        } else {
            return $this->db->get('sport_athlete')->result();
        }
    }

    public function actions($id = NULL, $photo = NULL)
    {
        if (!empty($id)) {
            $data = [
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'weight' => $this->input->post('weight'),
                'height' => $this->input->post('height'),
                'photo' => !empty($photo) ? site_url('upload/' . $photo) : $this->input->post('photo-lama'),
                'date_birth' => date('Y-m-d', strtotime($this->input->post('date_birth'))),
                'player_type' => $this->input->post('player_type'),
                'sport_club' => $this->input->post('sport_club'),
            ];
            return $this->db->update('sport_athlete', $data, array('id' => $id));
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'weight' => $this->input->post('weight'),
                'height' => $this->input->post('height'),
                'photo' => site_url('upload/' . $photo),
                'date_birth' => date('Y-m-d', strtotime($this->input->post('date_birth'))),
                'player_type' => $this->input->post('player_type'),
                'sport_club' => $this->input->post('sport_club'),
            ];
            return $this->db->insert('sport_athlete', $data);
        }
    }


    public function delete($id)
    {
        return $this->db->delete('sport_athlete', array('id'=>$id));
    }


    /**
     * Player Type
     */
    public function getPlayerType($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM player_type WHERE id = $id")->row();
        } else {
            return $this->db->get('player_type')->result();
        }
    }

    public function getPlayerType_by_sporType($id)
    {
        return $this->db->get('player_type', array('sport_type'=>$id))->result();
    }

    public function actionsPlayerType($id = NULL) 
    {
        if (!empty($id)) {
            $data = [
                'player_type' => $this->input->post('player_type'),
                'sport_type' => $this->input->post('sport_type'),
            ];
            return $this->db->update('player_type', $data, array('id' => $id));
        }
        else {
            $data = [
                'player_type' => $this->input->post('player_type'),
                'sport_type' => $this->input->post('sport_type'),
            ];
            return $this->db->insert('player_type', $data);
        }
    }

    public function deletePlayerType($id)
    {
        return $this->db->delete('player_type', array('id'=>$id));
    }

    /**
     * Foul Type
     */
    public function getFoulType($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM foul_type WHERE id = $id")->row();
        } else {
            return $this->db->get('foul_type')->result();
        }
    }

    public function actionsFoulType($id = NULL) 
    {
        if (!empty($id)) {
            $data = [
                'foul_name' => $this->input->post('foul_name'),
                'sport_type' => $this->input->post('sport_type'),
            ];
        }
        else {
            $data = [
                'foul_name' => $this->input->post('foul_name'),
                'sport_type' => $this->input->post('sport_type'),
            ];
            return $this->db->insert('foul_type', $data);
        }
    }

    public function deleteFoulType($id)
    {
        return $this->db->delete('foul_type', array('id'=>$id));
    }

    /**
     * Foul
     */
    public function getFoul($id = NULL)
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM foul WHERE id = $id")->row();
        } else {
            return $this->db->get('foul')->result();
        }
    }

    public function actionsFoul($id = NULL) 
    {
        if (!empty($id)) {
            $data = [
                'minute' => $this->input->post('match_time'),
                'foul_type' => $this->input->post('foul_type'),
                'match_id' => $this->input->post('match'),
                'athlete_id' => $this->input->post('player'),
            ];
            $this->db->update('foul', $data, array('id'=> $id));
        }
        else {
            $data = [
                'minute' => $this->input->post('match_time'),
                'foul_type' => $this->input->post('foul_type'),
                'match_id' => $this->input->post('match'),
                'athlete_id' => $this->input->post('player'),
            ];
            $this->db->insert('foul', $data);
        }
    }

    public function deleteFoul($id)
    {
        return $this->db->delete('foul', array('id'=>$id));
    }
}