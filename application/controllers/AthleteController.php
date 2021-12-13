<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AthleteController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_Sport_Athlete', 'M_Sport_Type','M_Sport_Club', 'M_Match'));
        $this->load->library('form_validation');
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
        if (!$this->upload->do_upload('photo')) return $this->upload->display_errors();
        else return $this->upload->data();
    }

    /**
     * ATHLETE
     */
    public function athlete()
    {
        echo "INDEX PLAYER TYPE";
        $context = [
            'data_athlete' => $this->M_Sport_Athlete->getAthlete(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function actions()
    {
        $id_sport_type = $this->uri->segment(4);
        $id_athlete = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $context = [
            'data_athlete' => !empty($id_athlete) ? $this->M_Sport_Athlete->getAthlete($id_athlete) : null,
            'data_playerType' => $this->M_Sport_Athlete->getPlayerType_by_sporType($id_sport_type),
            'data_sportClub' => $this->M_Sport_Club->get_by_sportType($id_sport_type),
        ];

        if (empty($id_sport_type)) {
            show_404();
        }
        else {
            $this->form_validation->set_rules('name', 'Nama', 'required', array('required' => "Nama Athlete tidak boleh kosong"));
            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => "Gender tidak boleh kosong"));
            $this->form_validation->set_rules('height', 'Height', 'required', array('required' => "Height tidak boleh kosong"));
            $this->form_validation->set_rules('weight', 'Weight', 'required', array('required' => "Weight tidak boleh kosong"));
            $this->form_validation->set_rules('date_birth', 'Date Birth', 'required', array('required' => "Tanggal Lahir tidak boleh kosong"));
            $this->form_validation->set_rules('player_type', 'Player Type', 'required', array('required' => "Player Type tidak boleh kosong"));
            $this->form_validation->set_rules('sport_club', 'Sport Club', 'required', array('required' => "Sport Club tidak boleh kosong"));


            if ($this->input->method() === 'post') {
                if (!empty($id_athlete)) {
                    $this->form_validation->set_rules('photo-lama', 'Photo', 'required', array('required' => "Photo tidak boleh kosong")); 
                } else {
                    if (empty($_FILES['photo']['name']))
                            $this->form_validation->set_rules('photo', 'Photo', 'required', array('required' => "Photo tidak boleh kosong"));
                }
                if ($this->form_validation->run() === TRUE) {
                    $upload = null;
                    if (!empty($_FILES['photo']['name'])) {
                        $upload = $this->upload_data();
                    }

                    if (empty($id_athlete)) {
                        if (!empty($upload['file_name'])) $this->M_Sport_Athlete->actions(NULL, $upload['file_name']);
                        else $this->M_Sport_Club->actions();
                        redirect('admin/athlete');
                    }
                    else {
                        if (!empty($upload['file_name'])) $this->M_Sport_Athlete->actions($id_athlete, $upload['file_name']);
                        else $this->M_Sport_Club->actions($id_athlete);
                        redirect('admin/athlete');
                    }
                }
            }

            $this->load->view('admin/athlete/actions', $context);
        }

    }

    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->delete($id);
        redirect('admin/athlete');
    }

    /**
     * SPORT TYPE
     */
    public function playerType()
    {
        echo "INDEX PLAYER TYPE";
        $context = [
            'data_playerType' => $this->M_Sport_Athlete->getPlayerType(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function playerType_actions()
    {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
            'data_playerType' => !empty($id) ? $this->M_Sport_Athlete->getPlayerType($id) : null,
        ];

        $this->form_validation->set_rules('player_type', 'Type Nama', 'required', array('required' => "Type Nama tidak boleh kosong"));
        $this->form_validation->set_rules('sport_type', 'Type Olahraga', 'required', array('required' => "Type Olahraga tidak boleh kosong"));


        if ($this->form_validation->run() === TRUE) {
            if (!empty($id)) $this->M_Sport_Athlete->actionsPlayerType($id);
            else $this->M_Sport_Athlete->actionsPlayerType();
            redirect('admin/player-type');
        }

        $this->load->view('admin/player-type/actions', $context);
    }

    public function playerType_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deletePlayerType($id);
        redirect('admin/player-type');
    }

    /**
     * FOUL TYPE
     */
    public function foulType()
    {
        echo "INDEX FOUL TYPE";
        $context = [
            'data_foulType' => $this->M_Sport_Athlete->getFoulType(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function foulType_actions()
    {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_sportType' => $this->M_Sport_Type->get(),
            'data_foulType' => !empty($id) ? $this->M_Sport_Athlete->getFoulType($id) : null,
        ];

        $this->form_validation->set_rules('foul_name', 'Type Nama', 'required', array('required' => "Type Nama tidak boleh kosong"));
        $this->form_validation->set_rules('sport_type', 'Type Olahraga', 'required', array('required' => "Type Olahraga tidak boleh kosong"));


        if ($this->form_validation->run() === TRUE) {
            if (!empty($id)) $this->M_Sport_Athlete->actionsFoulType($id);
            else $this->M_Sport_Athlete->actionsFoulType();
            redirect('admin/foul-type');
        }

        $this->load->view('admin/foul-type/actions', $context);
    }

    public function foulType_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deleteFoulType($id);
        redirect('admin/foul-type');
    }

    /**
     * FOUL
     */
    public function foul()
    {
        echo "INDEX FOUL";
        $context = [
            'data_foul' => $this->M_Sport_Athlete->getFoul(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function foul_actions()
    {
        $id_sport_type = $this->uri->segment(4);
        $id_foul = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        if (empty($id_sport_type)) 
        {
            show_404();
        }
        else {
            $context = [
                'data_foulType' => $this->M_Sport_Athlete->getFoulType(),
                'data_match' => $this->M_Match->getMatch_Club(),
                'data_player' => $this->M_Sport_Athlete->getAthlete(),
                'data_foul' => !empty($id_foul) ? $this->M_Sport_Athlete->getFoul($id_foul) : null,
            ];
    
            $this->form_validation->set_rules('match_time', 'Menit Pelanggaran', 'required', array('required' => "*Menit tidak boleh kosong"));
            $this->form_validation->set_rules('foul_type', 'Type Olahraga', 'required', array('required' => "*Type Olahraga tidak boleh kosong"));
            $this->form_validation->set_rules('match', 'Match', 'required', array('required' => "*Match tidak boleh kosong"));
            $this->form_validation->set_rules('player', 'Player', 'required', array('required' => "*Player tidak boleh kosong"));
            
    
            if ($this->form_validation->run() === TRUE) {
                if (!empty($id_foul)) $this->M_Sport_Athlete->actionsFoul($id_foul);
                else $this->M_Sport_Athlete->actionsFoul();
                redirect('admin/foul');
            }
    
            $this->load->view('admin/foul/actions', $context);
        }
    }

    public function foul_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deleteFoul($id);
        redirect('admin/foul');
    }
}