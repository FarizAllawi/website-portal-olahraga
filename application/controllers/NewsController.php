<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Memanggil library visitor dengan method count
        $this->visitor->count();
        $this->load->library('form_validation');
        $this->load->model(array('M_News', 'M_Review', 'M_Sport_Type', 'M_League', 'M_Match'));

    }

    public function news_page() 
    {
        $news_slug = $this->uri->segment(2);
        $news = $this->M_News->getNews_by_slug($news_slug);
        $context = [
            'lastest_news_result' => $this->M_News->get_lastest_news_result(),
            'data_sportType' => $this->M_Sport_Type->get(),
            'news' => $news,
            'data_match' => $this->M_Match->getMatch_today($news->sport_league)
        ];
        $this->template->user_template('User/news-detail', $context);
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
        if (!$this->upload->do_upload('thumbnail')) return $this->upload->display_errors();
        else return $this->upload->data();
    }

    /**
     * NEWS
     */
    public function select_sportType() {
        isAdminLogin();
        $context = [
            'sport_type' => $this->M_Sport_Type->get()
        ];
        $this->template->show('Admin/news/select-sportType', $context);
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
        $this->template->show('Admin/news/select-league', $context);
    }

    public function news()
    {
        isAdminLogin();
        $league_id = $this->uri->segment(4);
        $context = [
            'data_news' => $this->M_News->getNews($league_id),
        ];
        $this->template->show('Admin/news/index', $context);
    }

    public function news_actions()
    {
        isAdminLogin();
        $league_id = $this->uri->segment(4);
        $id_news = !empty($this->uri->segment(5)) ? $this->uri->segment(5) : NULL;
        $context = [
            'data_news' => !empty($id_news) ? $this->M_News->getNews($league_id,$id_news) : null,
        ];

        if (empty($league_id)) {
            show_404();
        }
        else {

            $this->form_validation->set_rules('title', 'Title', 'required', array('required' => "Title tidak boleh kosong"));
            $this->form_validation->set_rules('description', 'Description', 'required', array('required' => "Description tidak boleh kosong"));
            $this->form_validation->set_rules('body', 'Weight', 'required', array('required' => "Body tidak boleh kosong"));
            $this->form_validation->set_rules('news_status', 'News Status', 'required', array('required' => "News Status tidak boleh kosong"));
            if (!empty($id_news)) {
                $this->form_validation->set_rules('thumbnail-lama', 'Thumbnail', 'required', array('required' => "Thumbnail tidak boleh kosong")); 
            } else {
                if (empty($_FILES['thumbnail']['name']))
                        $this->form_validation->set_rules('thumbnail', 'Thumbnail', 'required', array('required' => "Thumbnail tidak boleh kosong"));
            }

            

            if ($this->input->method() === 'post') {
                if ($this->form_validation->run() === TRUE) {
                    $upload = null;
                    if (!empty($_FILES['thumbnail']['name'])) {
                        $upload = $this->upload_data();
                    }

                    if (empty($id_news)) {
                        if (!empty($upload['file_name'])) $this->M_News->actions($league_id, NULL, $upload['file_name']);
                        else $this->M_News->actions($league_id);
                        redirect('admin/news/league/'.$league_id);
                    }
                    else {
                        if (!empty($upload['file_name'])) $this->M_News->actions($league_id, $id_news, $upload['file_name']);
                        else $this->M_News->actions($league_id , $id_news);
                        redirect('admin/news/league/'.$league_id);
                    }
                }
            }

            $this->template->show('admin/news/actions', $context);
        }

    }

    public function news_delete()
    {
        $id = $this->uri->segment(4);
        $this->M_News->delete($id);
        echo "<script>history.back()</script>";

    }


    /**
     * REVIEW
     */
    public function reviews()
    {
        echo "INDEX REVIEW";
        $context = [
            'data_review' => $this->M_Review->getReview(),
        ];
        echo '<pre>';
        echo var_dump($context);
    }

    public function reviews_actions()
    {
        $news_id =  $this->uri->segment(3);
        $review_id = !empty($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;

        $context = [
            'data_review' => !empty($review_id) ? $this->M_Review->getReview($news_id, $review_id) : null,
        ];

        if (empty($news_id)) {
            show_404();
        } else {
            $this->form_validation->set_rules('rating', 'Type Nama', 'required', array('required'=> "Rating tidak boleh kosong"));

            if ($this->form_validation->run() === TRUE)
            {
                if (!empty($review_id)) $this->M_Review->reviewActions($news_id, $review_id);
                else $this->M_Review->reviewActions($news_id);
                redirect('review');
            }

            // var_dump($context);die;
            $this->load->view('User/review/actions', $context);
        }
    }

    public function reviews_delete()
    {
        $id = $this->uri->segment(3);
        $this->M_Review->reviewDelete($id);
        redirect('review');
    }
}