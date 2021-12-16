<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SportController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('M_Sport_Type', 'M_Sport_Club', 'M_League','M_News'));
    }  

    public function sport()
    {
        $slug = str_replace('-', ' ',$this->uri->segment(2));
        $sport = $this->M_Sport_Type->get_by_name($slug);
        $data_league = $this->M_League->get($sport->id);
        $data_news =  [];
        foreach ($data_league as $league) {
            $data_news[$league->name_league] = $this->M_News->getNews($league->id);
        }
        $context = [
            'lastest_news_result' => $this->M_News->getSport_lastest_news_result($sport->id),
            'lastest_news' => $this->M_News->getSport_lastest_news($sport->id),
            'data_sportType' => $this->M_Sport_Type->get(),
            'data_sport' => $sport,
            'data_league' => $data_league,
            'data_news' => $data_news,
            // 'data_match' => $this->M_Match->getMatch_today($league->id)
        ];

        $this->template->user_template('User/sport', $context);
    }

    public function upload_data() 
    {
        $config['upload_path']          = FCPATH.'upload';
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
        isAdminLogin();
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
        ];
        $this->template->show('admin/sport-type/index',$context);

    }

    public function sportType_actions()
    {
        isAdminLogin();
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
        $this->template->show('Admin/sport-type/actions', $context);
    }

    public function sportType_delete()
    {
        isAdminLogin();
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
    public function select_sportType() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/sport-club/select-sportType', $context);
    }

    public function select_league() {
        isAdminLogin();
        $sportType_id = $this->uri->segment(4);
        if (empty($sportType_id)) {
            show_404();
        }
        $context = [
            'data_league' => $this->M_League->get($sportType_id)
        ];
        $this->template->show('Admin/sport-club/select-league', $context);
    }

    public function sportClub()
    {
        isAdminLogin();
        $liga_id = $this->uri->segment(4);
        $context = [
            'data_club' => $this->M_Sport_Club->get($liga_id),
        ];
        $this->template->show('admin/sport-club/index', $context);

    }

    public function sportClub_actions()
    {
        isAdminLogin();
        $league_id = $this->uri->segment(4);
        $id = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;

        if (empty($league_id)){
            redirect('admin/sport-club');
        }

        $context = [
            'data_sportClub' => !empty($id) ? $this->M_Sport_Club->get($league_id, $id) : null
        ];

        $this->form_validation->set_rules('name', 'Nama Club', 'required', array('required' => "Nama Club tidak boleh kosong"));
        $this->form_validation->set_rules('country', 'Negara', 'required', array('required' => "Negara tidak boleh kosong"));
        
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
                    $this->M_Sport_Club->actions(NULL, $league_id , $upload['file_name']);
                    redirect('admin/sport-club/league/'.$league_id);
                }
                else {
                    if (!empty($upload['file_name'])) $this->M_Sport_Club->actions($id, $league_id, $upload['file_name']);
                    else $this->M_Sport_Club->actions($id, $league_id);
                    redirect('admin/sport-club/league/'.$league_id);
                }
            }
        }

        $this->template->show('Admin/sport-club/actions', $context);
    }

    public function sportClub_delete()
    {
        isAdminLogin();
        $id = $this->uri->segment(4);
        $this->M_Sport_Club->delete($id);
        echo "<script>history.back()</script>";
    }
}
