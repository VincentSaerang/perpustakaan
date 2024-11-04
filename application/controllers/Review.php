<?php

class Review extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
        $this->load->model('system');
        $this->auth->cek_login();
    }

    public function index()
    {
        redirect(base_url('dashboard'));
    }

    public function add()
    {
        $userid = $this->input->post('userid');
        $bookid = $this->input->post('bookid');
        $ulasan = $this->input->post('ulasan');
        $rating = $this->input->post('rating');
        $catid = $this->input->post('catid');


        $process = $this->system->addrev($userid, $bookid, $ulasan, $rating, $catid);

        if ($process == 0) {
            redirect(base_url("book/view/$bookid"));
        } else if ($process == 1) {
            echo $process;
            $this->session->set_flashdata('message', 'Kamu sudah pernah memberikan buku ini ulasan.');
            // redirect('dashboard');
        }
    }

}