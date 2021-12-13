<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SportController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('M_Sport_Type', 'M_Sport_Club', 'M_League'));
    }

    public function upload_data() 
    {
        $config['upload_path']          = FCPATH.'uploads';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('logo')) return $this->upload->display_errors();
        else return $this->upload->data();
    }

    /**
     * SPORT TYPE
     */
    public function sportType()
    {
        echo "INDEX SPORTTYPE";
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function sportType_actions()
    {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportType' => !empty($id) ? $this->M_Sport_Type->get($id) : null,
        ];

        $this->form_validation->set_rules('name_type', 'Type Nama', 'required', array('required' => "Type Nama tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE) {
            if (!empty($id)) $this->M_Sport_Type->actions($id);
            else $this->M_Sport_Type->actions();
            redirect('admin/sport-type');
        }
        $this->load->view('Admin/sport-type/actions', $context);
    }

    public function sportType_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Type->delete($id);
        redirect('admin/sport-type');
    }

    public function email_check($str)
    {
        if ($this->M_User->check_email($str) === TRUE) return TRUE;
        $this->form_validation->set_message('email_check', '*e-mail sudah digunakan');
        return FALSE;
    }

    public function username_check($str)
    {
        if ($this->M_User->check_username($str) === TRUE) return TRUE;
        $this->form_validation->set_message('username_check', '*Username sudah digunakan');
        return FALSE;
    }

    /**
     * SPORT CLUB
     */
    public function sportClub()
    {
        echo "INDEX SPORTCLUB";
        $context = [
            'data_sportType' => $this->M_Sport_Club->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function sportClub_actions()
    {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportClub' => !empty($id) ? $this->M_Sport_Club->get($id) : null,
            'data_league' => $this->M_League->get(),
        ];

        $this->form_validation->set_rules('name', 'Nama Club', 'required', array('required' => "Nama Club tidak boleh kosong"));
        $this->form_validation->set_rules('country', 'Negara', 'required', array('required' => "Negara tidak boleh kosong"));
        $this->form_validation->set_rules('liga', 'Liga', 'required', array('required' => "Liga tidak boleh kosong"));
        
        if ($this->input->method() === 'post') {
            if (!empty($id)) {
                $this->form_validation->set_rules('logo-lama', 'Logo', 'required', array('required' => "Logo tidak boleh kosong")); 
            } else {
                if (empty($_FILES['logo']['name']))
                         $this->form_validation->set_rules('logo', 'Logo', 'required', array('required' => "Logo tidak boleh kosong"));
            }
            if ($this->form_validation->run() === TRUE) {
                $upload = null;
                if (!empty($_FILES['logo']['name'])) {
                    $upload = $this->upload_data();
                }

                if (empty($id)) {
                    if (!empty($upload['file_name'])) $this->M_Sport_Club->actions(NULL, $upload['file_name']);
                    else $this->M_Sport_Club->actions();
                    redirect('admin/sport-club');
                }
                else {
                    if (!empty($upload['file_name'])) $this->M_Sport_Club->actions($id, $upload['file_name']);
                    else $this->M_Sport_Club->actions($id);
                    redirect('admin/sport-club');
                }
            }
        }

        $this->load->view('Admin/sport-club/actions', $context);
    }

    public function sportClub_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Club->delete($id);
        redirect('admin/sport-club');
    }
}
