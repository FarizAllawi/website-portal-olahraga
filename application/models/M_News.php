<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_News extends CI_Model {
    public function getNews($league_id, $id = NULL) 
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM news WHERE id = $id")->row();
        } else {
            return $this->db->get_where('news',array('sport_league'=>$league_id))->result();
        }
    }

    public function get_lastest_news(){
        return $this->db->query("SELECT news.*, user.fullname
                                 FROM `news`, user where news.user_id = user.id and news.news_status = 'published' order by news.created_at DESC;")->row();
    }

    public function getSport_lastest_news($sport_id) {
        return $this->db->query("SELECT news.*, user.fullname
        FROM `news`, user, league , sport_type where news.sport_league = league.id and league.sport_type = sport_type.id and sport_type = $sport_id and news.user_id = user.id and news.news_status = 'published' order by news.created_at DESC;")->row();
    }

    public function getSport_lastest_news_result($sport_id) {
        return $this->db->query("SELECT news.*, user.fullname
        FROM `news`, user, league , sport_type where news.sport_league = league.id and league.sport_type = sport_type.id and sport_type = $sport_id and news.user_id = user.id and news.news_status = 'published' ORDER BY created_at  DESC LIMIT 5;")->result();
    }

    public function get_lastest_news_result(){
        return $this->db->query("SELECT news.*, user.fullname 
                                 FROM `news`, user where news.user_id = user.id and news.news_status = 'published' ORDER BY created_at DESC LIMIT 5; ")->result();
    }

    public function getNews_by_slug($slug) {
        return $this->db->query("SELECT news.*, user.fullname 
                                 FROM `news`, user where news.user_id = user.id and news.news_status = 'published' and news.news_slug ='$slug' ")->row();
    }

    public function getNews_by_league($league_id) {
        return $this->db->query("SELECT news.*, user.fullname 
                                 FROM `news`, user where news.user_id = user.id and news.news_status = 'published' and news.sport_league ='$league_id' ")->result();
    }

    public function actions($league_id, $id = NULL, $photo = NULL)
    {
        if (!empty($id)) {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'body' => $this->input->post('body'),
                'news_status' => $this->input->post('news_status'),
                'news_slug' => str_replace(' ', '-', strtolower($this->input->post('title'))),
                'thumbnail' => !empty($photo) ? site_url('upload/' . $photo) : $this->input->post('thumbnail-lama'),
                'user_id' => '1',
                'sport_league' => $league_id,
            ];
            return $this->db->update('news', $data, array('id' => $id));
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'body' => $this->input->post('body'),
                'news_status' => $this->input->post('news_status'),
                'news_slug' => str_replace(' ', '-', strtolower($this->input->post('title'))),
                'thumbnail' => site_url('upload/' . $photo),
                'user_id' => '1',
                'sport_league' => $league_id,
            ];
            return $this->db->insert('news', $data);
        }
    }


    public function delete($id)
    {
        return $this->db->delete('news', array('id'=>$id));
    }
}