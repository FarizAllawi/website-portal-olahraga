<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Memanggil library visitor dengan method count
        $this->visitor->count();
        $this->load->library('form_validation');
        $this->load->model('M_User');
    }

    public function loginUser() {
       echo "Login USER";
    }

    public function loginAdmin() {
        if ((!empty($this->session->id) && !empty($this->session->role))&&
            ($this->session->role != 'guest' || $this->session->role != 'user')) 
        {
            redirect('admin/dashboard');
        } 
        $this->form_validation->set_rules('username', 'Username', 'required', array("required"=>"*Username tidak boleh kosong"));
        $this->form_validation->set_rules('password', 'Password', 'required', array("required"=>"*Password tidak boleh kosong"));
        if ($this->form_validation->run() === TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->M_User->get_by_username($username);

            if ($user->num_rows() > 0) {
                $user = $user->row();
                if ($user->role === 'guest' || $user->role === 'user') {
                    redirect('login');
                }

                if ($username === $user->username && password_verify($password, $user->password)) {
                    $data = [
                        'id' => $user->id,
                        'username' => $user->username,
                        'role' => $user->role
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin/dashboard');
                }
                else {
                    $this->session->set_flashdata('failed', "Password salah !");
                }
            } else {
                $this->session->set_flashdata('failed', "Username tidak tersedia !");
            }
        }
        $this->load->view('Admin/auth/signIn');
    }

    public function signup_user() {

    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    public function index() {
        isAdminLogin();
        $context = [
            'data_user' => $this->M_User->get(),
        ];
        $this->template->show('admin/user/index',$context);

    }

    public function actions() {
        isAdminLogin();
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
        if (!empty($id)) {
            $this->form_validation->set_rules('gender-lama', 'Gender', 'required',array('required'=> "*Gender tidak boleh kosong"));
        }else {
            $this->form_validation->set_rules('gender', 'Gender', 'required',array('required'=> "*Gender tidak boleh kosong"));
            $this->form_validation->set_rules('password', 'Password', 'required',array('required'=> "*Password tidak boleh kosong"));
        }
        $this->form_validation->set_rules('role', 'Role', 'required',array('required'=> "*Role tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_User->actions($id);
            else $this->M_User->actions();
            $this->session->set_flashdata('success', 'Sukses melakukan perubahan pada data user');
            redirect('admin/user');
        }
        $this->template->show('Admin/user/actions', $context);
    }

    public function delete() {
        isAdminLogin();
        $id = $this->uri->segment(4);
        $this->M_User->delete($id);
        $this->session->set_flashdata('success', 'Sukses melakukan perubahan pada data user');
        redirect('admin/user');
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