<?php 

function isAdminLogin() {

    $CI =& get_instance();
    if ((empty($CI->session->id) && empty($CI->session->role))&&
        ($CI->session->role != 'guest' || $CI->session->role != 'user')) 
    {
        redirect('admin/login');
    } 
}
