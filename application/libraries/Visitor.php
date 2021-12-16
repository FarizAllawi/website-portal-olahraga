<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor {
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('M_Visitor');

    }

    public function count()
    {
        // check is user with ip and url exist in database
        $data = [
            'ip' => $this->CI->input->ip_address(),
            'url' => site_url(uri_string()),
            'date' => date('Y-m-d'),
        ];

       
        if ($this->CI->M_Visitor->check_visitor($data) === 0) {
            // if user with ip and url not exist in database, save visitor data
            $data['user_id'] =!empty($this->CI->session->userdata('id')) ? $this->CI->session->userdata('id') : '2';
            $data['user_agent'] = $this->CI->input->user_agent();
            $this->CI->M_Visitor->save($data);
        }
        //
    }
}