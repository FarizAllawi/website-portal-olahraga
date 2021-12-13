<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MatchController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(array('M_Match', 'M_Sport_Club'));
        $this->load->library('form_validation');
    }

    public function indexAdmin() {
        echo "INDEX MATCH";
        $context = [
            'data_match' => $this->M_Match->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function actions() {
        $id_sport_type = $this->uri->segment(4);
        $id_league = $this->uri->segment(5);
        $id_match = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : NULL;
        
        if (empty($id_sport_type) && empty($id_league)) {
            show_404();
        } else {
            $context = [
                'data_sportClub' => $this->M_Sport_Club->get_by_league($id_league),
                'data_match' => !empty($id_match) ? $this->M_Match->get($id_match) : null,
            ];
    
            $this->form_validation->set_rules('sport_club_1', 'Sport Club 1', 'required', array('required'=> "*Sport Club 1 tidak boleh kosong"));
            $this->form_validation->set_rules('sport_club_2', 'Sport Club 2', 'required|callback_check_club',array('required'=> "*Sport Club 2 tidak boleh kosong"));
            $this->form_validation->set_rules('match_date', 'Match Date', 'required',array('required'=> "*Match Date tidak boleh kosong"));
            $this->form_validation->set_rules('match_time', 'Match Time', 'required',array('required'=> "*Match Time tidak boleh kosong"));
            $this->form_validation->set_rules('match_status', 'Match Status', 'required',array('required'=> "*Match Status tidak boleh kosong"));
            
            if ($this->input->method() === 'post'){

                if (!empty($id_match)) {
                    $this->form_validation->set_rules('club_1_score', 'Club 1 Score', 'required', array('required'=> "*Club 1 Score tidak boleh kosong"));
                    $this->form_validation->set_rules('club_2_score', 'Club 2 Score', 'required',array('required'=> "*Club 2 Score tidak boleh kosong"));
                }
                
                if ($this->form_validation->run() === TRUE)
                {
                    if (!empty($id_match)) $this->M_Match->actions($id_match);
                    else $this->M_Match->actions();
                    redirect('admin/match');
                }
                
            }
            
            $this->load->view('Admin/match/actions', $context);
        }
    }

    public function check_club($str){
        if ($str === $this->input->post('sport_club_1'))
        {
                $this->form_validation->set_message('check_club', 'Sport Club  2 tidak boleh sama dengan Sport Club 1');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->M_Match->delete($id);
        redirect('admin/match');
    }
}