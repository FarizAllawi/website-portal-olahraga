<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AthleteController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_Sport_Athlete', 'M_Sport_Type','M_Sport_Club', 'M_Match', 'M_League'));
        $this->load->library('form_validation');
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
        if (!$this->upload->do_upload('photo')) return $this->upload->display_errors();
        else return $this->upload->data();
    }

    /**
     * ATHLETE
     */
    public function athlete_selectSport() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/athlete/select-sportType', $context);
    }

    public function athlete_selectLeague()  {
        isAdminLogin();
        $sportType_id = $this->uri->segment(4);
        if (empty($sportType_id)) {
            show_404();
        }
        $context = [
            'data_league' => $this->M_League->get($sportType_id)
        ];
        $this->template->show('Admin/athlete/select-league', $context);
    }

    public function athlete_selectClub() 
    {
        isAdminLogin();
        $league_id = $this->uri->segment(4);
        if (empty($league_id)) {
            show_404();
        }
        $context = [
            'data_club' => $this->M_Sport_Club->get($league_id)
        ];
        $this->template->show('Admin/athlete/select-club', $context);
    }

    public function athlete()
    {
        isAdminLogin();
        $club_id = $this->uri->segment(4);
        $context = [
            'data_athlete' => $this->M_Sport_Athlete->getAthlete($club_id),
        ];
        $this->template->show('Admin/athlete/index', $context);

    }

    public function actions()
    {
        $id_sport_club = $this->uri->segment(4);
        $id_athlete = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $sport_type = $this->M_Sport_Athlete->get_sportType($id_sport_club)->num_rows() > 0 ? $this->M_Sport_Athlete->get_sportType($id_sport_club)->row() : '';
        $id_sport_type = !empty($sport_type->id) ? $sport_type->id : '';
        $context = [
            'data_athlete' => !empty($id_athlete) ? $this->M_Sport_Athlete->getAthlete($id_sport_club ,$id_athlete) : null,
            'data_playerType' => $this->M_Sport_Athlete->getPlayerType_by_sporType($id_sport_type),
        ];

        if (empty($id_sport_club)) {
            show_404();
        }
        else {
            $this->form_validation->set_rules('name', 'Nama', 'required', array('required' => "Nama Athlete tidak boleh kosong"));
            $this->form_validation->set_rules('backNumber', 'Back Number', 'required', array('required' => "Back Number tidak boleh kosong"));
            $this->form_validation->set_rules('height', 'Height', 'required', array('required' => "Height tidak boleh kosong"));
            $this->form_validation->set_rules('weight', 'Weight', 'required', array('required' => "Weight tidak boleh kosong"));
            $this->form_validation->set_rules('date_birth', 'Date Birth', 'required', array('required' => "Tanggal Lahir tidak boleh kosong"));
            $this->form_validation->set_rules('player_type', 'Player Type', 'required', array('required' => "Player Type tidak boleh kosong"));

            

            if ($this->input->method() === 'post') {
                if (!empty($id_athlete)) {
                    $this->form_validation->set_rules('photo-lama', 'Photo', 'required', array('required' => "Photo tidak boleh kosong")); 
                    $this->form_validation->set_rules('gender-lama', 'Gender', 'required', array('required' => "Gender tidak boleh kosong")); 
                } else {
                    if (empty($_FILES['photo']['name']))
                        $this->form_validation->set_rules('photo', 'Photo', 'required', array('required' => "Photo tidak boleh kosong"));
                        $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => "Gender tidak boleh kosong"));
                }

                if ($this->form_validation->run() === TRUE) {
                    $upload = null;
                    if (!empty($_FILES['photo']['name'])) {
                        $upload = $this->upload_data();
                    }

                    if (empty($id_athlete)) {
                        if (!empty($upload['file_name'])) $this->M_Sport_Athlete->actions($id_sport_club, NULL, $upload['file_name']);
                        else $this->M_Sport_Athlete->actions($id_sport_club);
                        redirect('admin/athlete/club/'.$id_sport_club);
                    }
                    else {
                        if (!empty($upload['file_name'])) $this->M_Sport_Athlete->actions($id_sport_club ,$id_athlete, $upload['file_name']);
                        else $this->M_Sport_Athlete->actions($id_sport_club, $id_athlete);
                        redirect('admin/athlete/club/'.$id_sport_club);
                    }
                }
            }

            $this->template->show('admin/athlete/actions', $context);
        }

    }

    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->delete($id);
        echo "<script>history.back()</script>";
    }

    /**
     * SPORT TYPE
     */
    public function playerType_selectSport() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/player-type/select', $context);
    }

    public function playerType()
    {
        isAdminLogin();
        $sport_id = $this->uri->segment(3);
        $context = [
            'data_playerType' => $this->M_Sport_Athlete->getPlayerType($sport_id),
        ];
        $this->template->show('Admin/player-type/index', $context);

    }

    public function playerType_actions()
    {
        $sportType_id = $this->uri->segment(4);
        $id = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $context = [
            'data_playerType' => !empty($id) ? $this->M_Sport_Athlete->getPlayerType($sportType_id, $id) : null,
        ];

        $this->form_validation->set_rules('player_type', 'Type Nama', 'required', array('required' => "Type Nama tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE) {
            if (!empty($id)) $this->M_Sport_Athlete->actionsPlayerType($sportType_id, $id);
            else $this->M_Sport_Athlete->actionsPlayerType($sportType_id);
            redirect('admin/player-type/'.$sportType_id);
        }

        $this->template->show('admin/player-type/actions', $context);
    }

    public function playerType_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deletePlayerType($id);
        echo "<script>history.back()</script>";
    }

    /**
     * FOUL TYPE
     */
    public function foulType_selectSport() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/foul-type/select', $context);
    }

    public function foulType()
    {
        $sport_type = $this->uri->segment(3);
        $context = [
            'data_foulType' => $this->M_Sport_Athlete->getFoulType($sport_type),
        ];
        $this->template->show('admin/foul-type/index', $context);
    }

    public function foulType_actions()
    {
        $sport_type = $this->uri->segment(4);
        $id = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $context = [
            'data_foulType' => !empty($id) ? $this->M_Sport_Athlete->getFoulType($sport_type, $id) : null,
        ];

        $this->form_validation->set_rules('foul_name', 'Type Nama', 'required', array('required' => "Nama Pelanggaran tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE) {
            if (!empty($id)) $this->M_Sport_Athlete->actionsFoulType($sport_type, $id);
            else $this->M_Sport_Athlete->actionsFoulType($sport_type);
            redirect('admin/foul-type/'.$sport_type);
        }

        $this->template->show('admin/foul-type/actions', $context);
    }

    public function foulType_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deleteFoulType($id);
        echo "<script>history.back()</script>";
    }

    /**
     * FOUL
     */
    public function foul_selectSport() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/foul/select-sportType', $context);
    }

    public function foul_selectLeague()  {
        isAdminLogin();
        $sportType_id = $this->uri->segment(4);
        if (empty($sportType_id)) {
            show_404();
        }
        $context = [
            'data_league' => $this->M_League->get($sportType_id)
        ];
        $this->template->show('Admin/foul/select-league', $context);
    }

    public function foul()
    {
        isAdminLogin();
        $league_id = $this->uri->segment(4);
        $context = [
            'data_foul' => $this->M_Sport_Athlete->getFoul($league_id),
        ];
        $this->template->show('admin/foul/index', $context);

    }

    public function foul_actions()
    {
        $league_id = $this->uri->segment(4);
        $id_foul = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $sport_type = $this->M_League->get(NULL,$league_id)->sport_type;
        if (empty($league_id)) 
        {
            show_404($league_id);
        }
        else {
            $context = [
                'data_foulType' => $this->M_Sport_Athlete->getFoulType($sport_type),
                'data_match' => $this->M_Match->getMatch_by_league($league_id),
                'data_player' => $this->M_Sport_Athlete->getAthlete_by_league($league_id),
                'data_foul' => !empty($id_foul) ? $this->M_Sport_Athlete->getFoul($league_id, $id_foul) : null,
            ];
    
            $this->form_validation->set_rules('match_time', 'Menit Pelanggaran', 'required', array('required' => "*Menit tidak boleh kosong"));
            $this->form_validation->set_rules('foul_type', 'Type Olahraga', 'required', array('required' => "*Type Olahraga tidak boleh kosong"));
            $this->form_validation->set_rules('match', 'Match', 'required', array('required' => "*Match tidak boleh kosong"));
            $this->form_validation->set_rules('player', 'Player', 'required', array('required' => "*Player tidak boleh kosong"));
            
    
            if ($this->form_validation->run() === TRUE) {
                if (!empty($id_foul)) $this->M_Sport_Athlete->actionsFoul($id_foul);
                else $this->M_Sport_Athlete->actionsFoul();
                redirect('admin/foul/league/'.$league_id);
            }
    
            $this->template->show('admin/foul/actions', $context);
        }
    }

    public function foul_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_Sport_Athlete->deleteFoul($id);
        echo "<script>history.back()</script>";
    }
}