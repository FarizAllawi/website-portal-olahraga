<?php

class LeagueController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(array('M_League', 'M_Sport_Type', 'M_News','M_Match', 'M_Sport_Club'));
    }

    public function league() {
        $slug = str_replace('-', ' ',$this->uri->segment(2));
        $league = $this->M_League->get_by_name($slug);
        $context = [
            'lastest_news_result' => $this->M_News->get_lastest_news_result(),
            'data_sportType' => $this->M_Sport_Type->get(),
            'data_league' => $league,
            'data_sportClub' => $this->M_Sport_Club->get($league->id),
            'data_news' => $this->M_News->getNews_by_league($league->id),
            'data_match' => $this->M_Match->getMatch_today($league->id)
        ];
        $this->template->user_template('User/league', $context);
    }

    public function league_match() {
        $slug = str_replace('-', ' ',$this->uri->segment(2));
        $league = $this->M_League->get_by_name($slug);
        $context = [
            'lastest_news_result' => $this->M_News->get_lastest_news_result(),
            'data_sportType' => $this->M_Sport_Type->get(),
            'data_league' => $league,
            'data_sportClub' => $this->M_Sport_Club->get($league->id),
            'data_news' => $this->M_News->getNews_by_league($league->id),
            'data_match' => $this->M_Match->getMatch_today($league->id)
        ];
        $this->template->user_template('User/league-match', $context);
    }

    public function select_sportType() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/league/select', $context);
    }

    public function indexAdmin() {
        isAdminLogin();
        $sportType_id = $this->uri->segment(3);
        $context = [
            'data_league' => $this->M_League->get($sportType_id),
        ];
        $this->template->show('admin/league/index', $context);
    }

    public function actions() {
        isAdminLogin();
        $sportType_id = $this->uri->segment(4);
        $id = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;

        $context = [
            'data_league' => !empty($id) ? $this->M_League->get($sportType_id, $id) : null,
        ];

        $this->form_validation->set_rules('name_league', 'Nama Liga', 'required', array('required'=> "Nama Liga tidak boleh kosong"));

        if ($this->form_validation->run() === TRUE)
        {
            if (!empty($id)) $this->M_League->actions($sportType_id, $id);
            else $this->M_League->actions($sportType_id);
            redirect("admin/league/$sportType_id");
        }

        // var_dump($context);die;
        $this->template->show('Admin/league/actions', $context);
    }

    public function delete() {
        isAdminLogin();
        $id = $this->uri->segment(4);
        $this->M_League->delete($id);
        echo "<script>history.back()</script>";
    }
}