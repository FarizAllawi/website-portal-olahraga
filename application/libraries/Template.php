<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
    protected $_CI;

    function __construct() {
        $this->_CI =& get_instance();
    }

    function show($template , $data=null) {
        $data['content'] = $this->_CI->load->view($template ,$data , true);
        $this->_CI->load->view('layouts/layout-admin.php',$data);
    }

    function user_template($template , $data=null) {
        $data['content'] = $this->_CI->load->view($template ,$data , true);
        $this->_CI->load->view('layouts/layout-user.php',$data);
    }
}