<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Match extends CI_Model {

    public function get($id = NULL) {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM sport_match WHERE id = $id")->row();
        } else {
            return $this->db->get('sport_match')->result();
        }
    }

    public function getMatch_by_league($league_id){
        return $this->db->query("SELECT sport_match.*, 
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_1) as  'club_1',
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_2) as  'club_2',
                                        league.id as 'league'
                                from sport_match , sport_club, league
                                where sport_match.sport_club_1 = sport_club.id and sport_club.sport_league = league.id and league.id = $league_id;")->result();
    }

    public function getMatch_today_only($league_id) {
        return $this->db->query("SELECT sport_match.*, 
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_1) as  'club_1',
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_2) as  'club_2',
                                        league.id as 'league'
                                from sport_match , sport_club, league
                                where sport_match.sport_club_1 = sport_club.id and sport_club.sport_league = league.id and league.id = $league_id AND DATE(sport_match.match_date) = CURDATE();")->result();
    }

    public function getMatch_today($league_id) {
        return $this->db->query("SELECT sport_match.*, 
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_1) as  'club_1',
                                        (select sport_club.name from sport_club where sport_club.id = sport_match.sport_club_2) as  'club_2',
                                        (select sport_club.logo from sport_club where sport_club.id = sport_match.sport_club_1) as  'logo_club_1',
                                        (select sport_club.logo from sport_club where sport_club.id = sport_match.sport_club_2) as  'logo_club_2',
                                        league.id as 'league'
                                from sport_match , sport_club, league
                                where sport_match.sport_club_1 = sport_club.id and sport_club.sport_league = league.id and league.id = $league_id and DATE(sport_match.match_date) >= CURDATE();")->result();
    }

    public function actions($id = NULL) {
        $date = strtotime($this->input->post('match_date').$this->input->post('match_time'));
        if (!empty($id)) {
            $data = [
                'club_1_score' => $this->input->post('club_1_score'),
                'club_2_score' => $this->input->post('club_2_score'),
                'match_date' => date('Y-m-d H:i:s',$date),
                'match_status' => $this->input->post('match_status')
            ];
            return $this->db->update('sport_match',$data, array('id'=>$id));
        }else {
            $data = [
                'sport_club_1' => $this->input->post('sport_club_1'),
                'sport_club_2' => $this->input->post('sport_club_2'),
                'club_1_score' => 0,
                'club_2_score' => 0,
                'match_date' => date('Y-m-d H:i:s',$date),
                'match_status' => $this->input->post('match_status')
            ];
            return $this->db->insert('sport_match', $data);
        }
    }

    public function delete($id) {
        $this->db->delete('sport_match', array('id'=>$id));
    }

}