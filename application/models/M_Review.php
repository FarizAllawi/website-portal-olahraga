<?php

class M_Review extends CI_Model {
    public function getReview($news_id = NULL, $review_id = NULL) 
    {
        if (!empty($review_id) && !empty($news_id)) {
            return $this->db->query("SELECT * FROM review WHERE id = $review_id")->row();
        } 

        if (!empty($news_id)) {
            return $this->db->query("SELECT * FROM review WHERE news_id = $news_id")->result();
        }
        return $this->db->get('review')->result();
    }

    public function reviewActions($news_id, $review_id = NULL)
    {
        if (!empty($review_id)) {
            $data = [
                'comment' => $this->input->post('comment'),
                'rating' => !empty($this->input->post('rating')) ? $this->input->post('rating') : $this->input->post('rating-lama'),
                'user_id' => 1,
                'news_id' => $news_id
            ];
            return $this->db->update('review', $data, array('id' => $review_id));
        } else {
            $data = [
                'comment' => $this->input->post('comment'),
                'rating' => $this->input->post('rating'),
                'user_id' => 1,
                'news_id' => $news_id
            ];
            return $this->db->insert('review', $data);
        }
    }


    public function reviewDelete($id)
    {
        return $this->db->delete('review', array('id'=>$id));
    }
}