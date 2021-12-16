<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_News', 'M_League', 'M_Sport_Type'));

        // Memanggil library visitor dengan method count
        $this->visitor->count();
    }

    public function indexUser(){
        $data_league = $this->M_League->get_all_league();
        $data_news =  [];
        foreach ($data_league as $league) {
            $data_news[$league->name_league] = $this->M_News->getNews($league->id);
        }
        $context = [
            'lastest_news' => $this->M_News->get_lastest_news(),
            'lastest_news_result' => $this->M_News->get_lastest_news_result(),
            'data_league' => $data_league,
            'data_news' => $data_news,
            'data_sportType' => $this->M_Sport_Type->get()
        ];
        $this->template->user_template('User/Home',$context);
    }

    public function indexAdmin() {
        isAdminLogin();
        echo "Dashboard";
    }

    public function sport() {

    }

    public function league() {
        
    }
}