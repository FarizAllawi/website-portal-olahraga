<?php 

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_User');
    }

    public function index() {
        echo "INDEX";
    }

    public function actions() {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_user' => !empty($id) ? $this->M_User->get($id) : null,
        ];

        $this->form_validation->set_rules('fullname', 'Full Name', 'required', array('required'=> "*Nama Lengkap tidak boleh kosong"));
        
        if (!empty($id) && $this->input->post('email') === $context['data_user']->email){
            $this->form_validation->set_rules('email', 
                                          'e-mail', 
                                          'required|valid_email', 
                                          array('required'=> "*e-mail tidak boleh kosong",
                                                'valid_email' => "*e-mail tidak valid"
                                          ));
        } else {
            $this->form_validation->set_rules('email', 
                                          'e-mail', 
                                          'required|valid_email|callback_email_check', 
                                          array('required'=> "*e-mail tidak boleh kosong",
                                                'valid_email' => "*e-mail tidak valid"
                                          ));
        }

        if (!empty($id) && $this->input->post('username') === $context['data_user']->username) {
            $this->form_validation->set_rules('username', 
                                          'Username', 
                                          'required', 
                                          array('required'=> "*Username tidak boleh kosong",
                                          ));
        } else {
            $this->form_validation->set_rules('username', 
                                          'Username', 
                                          'required|callback_username_check', 
                                          array('required'=> "*Username tidak boleh kosong",
                                          ));
        }
        $this->form_validation->set_rules('password', 'Password', 'required',array('required'=> "*Password tidak boleh kosong"));
        $this->form_validation->set_rules('gender', 'Gender', 'required',array('required'=> "*Gender tidak boleh kosong"));
        $this->form_validation->set_rules('role', 'Role', 'required',array('required'=> "*Role tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_User->actions($id);
            else $this->M_User->actions();
            redirect('user');
        }
        $this->load->view('Admin/user/actions', $context);
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->M_User->delete($id);
        redirect('user');
    }

    public function email_check($str) {
        if ($this->M_User->check_email($str) === TRUE) return TRUE;
        $this->form_validation->set_message('email_check', '*e-mail sudah digunakan');
        return FALSE;
    }

    public function username_check($str) {
        if ($this->M_User->check_username($str) === TRUE) return TRUE;
        $this->form_validation->set_message('username_check','*Username sudah digunakan');
        return FALSE;
            
    }
}