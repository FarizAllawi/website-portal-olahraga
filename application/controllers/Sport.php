<?php 

class Sport extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('M_Sport_Type', 'M_Sport_Club', 'M_League'));
    }

    /**
     * SPORT TYPE
     */
    public function sportType() {
        echo "INDEX SPORTTYPE";
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function sportType_actions() {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportType' => !empty($id) ? $this->M_Sport_Type->get($id) : null,
        ];

        $this->form_validation->set_rules('name_type', 'Type Nama', 'required', array('required'=> "Type Nama tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_Sport_Type->actions($id);
            else $this->M_Sport_Type->actions();
            redirect('admin/sport-type');
        }
        $this->load->view('Admin/sport-type/actions', $context);
    }

    public function sportType_delete() {
        $id = $this->uri->segment(4);
        $this->M_Sport_Type->delete($id);
        redirect('admin/sport-type');
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

    /**
     * SPORT CLUB
     */
    public function sportClub() {
        echo "INDEX SPORTCLUB";
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function sportClub_actions() {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportClub' => !empty($id) ? $this->M_Sport_Club->get($id) : null,
            'data_league' => $this->M_League->get(),
        ];

        $this->form_validation->set_rules('name_type', 'Type Nama', 'required', array('required'=> "Type Nama tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_Sport_Type->actions($id);
            else $this->M_Sport_Type->actions();
            redirect('admin/sport-type');
        }
        $this->load->view('Admin/sport-club/actions', $context);
    }

    public function sportClub_delete() {
        $id = $this->uri->segment(4);
        $this->M_Sport_Type->delete($id);
        redirect('admin/sport-type');
    }
}