<?php

class M_User extends CI_Model {

    public function get($id = NULL)
    {
        if (!empty($id))
            return $this->db->get_where('user', array('id'=>$id))->row();
        else 
            return $this->db->get('user')->result();
    }

    public function get_by_username($username) {
        return $this->db->get_where('user', array('username'=>$username));
    }

    public function actions($id = NULL)
    {
        if (!empty($id)) {
            $data = [
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'gender' => !empty($this->input->post('gender')) ? $this->input->post('gender') : $this->input->post('gender-lama'),
                'role' => $this->input->post('role'),
            ];
            return $this->db->update('user', $data, array('id'=> $id));
        } 
        else {
            $data = [
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
                'gender' => $this->input->post('gender'),
                'role' => $this->input->post('role'),
            ];
            return $this->db->insert('user', $data);
        }
        
    }

    public function delete($id) 
    {
        return $this->db->delete('user', array('id'=>$id));
    }

    public function check_username($str , $id = NULL)
    {
        if ($this->db->get('user', array('username'=>$str))->num_rows() > 0)
            return true;
        return false;
    }

    public function check_email($str, $id = NULL)
    {
        if ($this->db->get('user', array('email'=>$str))->num_rows() > 0)
            return true;
        return false;
    }
}