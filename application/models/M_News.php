<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_News extends CI_Model {
    public function getNews($id = NULL) 
    {
        if (!empty($id)) {
            return $this->db->query("SELECT * FROM news WHERE id = $id")->row();
        } else {
            return $this->db->get('news')->result();
        }
    }

    public function actions($id = NULL, $photo = NULL)
    {
        if (!empty($id)) {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'body' => $this->input->post('body'),
                'news_status' => $this->input->post('news_status'),
                'thumbnail' => !empty($photo) ? site_url('upload/' . $photo) : $this->input->post('thumbnail-lama'),
                'user_id' => '1',
                'sport_type' => $this->uri->segment(4),
            ];
            return $this->db->update('news', $data, array('id' => $id));
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'body' => $this->input->post('body'),
                'news_status' => $this->input->post('news_status'),
                'thumbnail' => site_url('upload/' . $photo),
                'user_id' => '1',
                'sport_type' => $this->uri->segment(4),
            ];
            return $this->db->insert('news', $data);
        }
    }


    public function delete($id)
    {
        return $this->db->delete('news', array('id'=>$id));
    }
}