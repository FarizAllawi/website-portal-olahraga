<?php

class LeagueController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('M_League', 'M_Sport_Type'));
    }

    public function indexAdmin() {
        echo "INDEX SPORTTYPE";
        $context = [
            'data_sportType' => $this->M_League->get(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function actions() {
        $id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $context = [
            'data_league' => !empty($id) ? $this->M_League->get($id) : null,
            'data_sportType' => $this->M_Sport_Type->get()
        ];

        $this->form_validation->set_rules('sport_type', 'Type Nama', 'required', array('required'=> "Type Nama tidak boleh kosong"));
        $this->form_validation->set_rules('name_league', 'Nama Liga', 'required', array('required'=> "Nama Liga tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_League->actions($id);
            else $this->M_League->actions();
            redirect('admin/league');
        }

        // var_dump($context);die;
        $this->load->view('Admin/league/actions', $context);
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->M_League->delete($id);
        redirect('admin/sport-type');
    }
}