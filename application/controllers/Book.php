<?php

class Book extends CI_Controller
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
        $isbn = $this->input->post('isbn');
        $title = $this->input->post('book');
        $writer = $this->input->post('bookwriter');
        $publisher = $this->input->post('bookpublisher');
        $pubyear = $this->input->post('bookyear');
        $bookstok = $this->input->post('bookstok');
        $bookrak = $this->input->post('bookrak');
        $bookclass = $this->input->post('bookclass');
        $bookcity = $this->input->post('bookcity');
        $catid = $this->input->post('catid');
        $gambar =  $_FILES["bookimg"]["tmp_name"];
        // $gambar = $_FILES["bookimg"]["tmp_name"];


        $process = $this->system->addbuku($isbn, $title, $writer, $publisher, $pubyear, $catid, $bookstok, $bookrak, $bookclass, $bookcity, $gambar);

        if ($process == 0) {
            redirect(base_url("category/detail/$catid"));
        } else if ($process == 1) {
            echo $process;
            $this->session->set_flashdata('message', 'Book exist');
            // redirect('dashboard');
        }
    }


    public function edit()
    {
        $bookid = $this->input->post('bookid');
        $title = $this->input->post('book');
        $writer = $this->input->post('bookwriter');
        $publisher = $this->input->post('bookpublisher');
        $pubyear = $this->input->post('bookyear');
        $bookstok = $this->input->post('bookstok');
        $bookrak = $this->input->post('bookrak');
        $bookcat = $this->input->post('bookcat');
        $link = $this->input->post('link');

        $this->system->editbook($bookid, $title, $writer, $publisher, $pubyear, $bookcat, $bookstok, "category/detail/$catid", $bookrak);
        if (!isset($link)) {
            redirect('category/detail/' . $catid);
        } else {
            redirect("$link");
        }
    }

    public function edit_view()
    {
        $title = $this->input->post('book');
        $writer = $this->input->post('bookwriter');
        $publisher = $this->input->post('bookpublisher');
        $pubyear = $this->input->post('bookyear');
        $bookid = $this->input->post('bookid');
        $catid = $this->input->post('catid');
        $bookstok = $this->input->post('bookstok');

        $this->system->editbook($title, $writer, $publisher, $pubyear, $bookid, $catid, $bookstok, "book/view/$bookid");
        redirect('book/view/' . $bookid);
    }

    public function delete()
    {
        $id = $this->input->post('bookid');
        $catid = $this->input->post('catid');
        $this->system->deletebook($id);
        redirect(base_url('category/detail/' . $catid));
    }

    public function view()
    {
        $bookid = $this->uri->segment('3');
        $this->data['book'] = $this->system->getbook($bookid);
        $this->data['category'] = $this->system->getcat($this->data['book']->KategoriID);
        $this->data['rak'] = $this->db->get_where('rakbuku', array('RakID' => $this->data['book']->RakID))->row();
        $this->data['reviews'] = $this->db->query("SELECT * FROM ulasanbuku WHERE BukuID = '$bookid'");
        $this->data['categorys'] = $this->db->query("SELECT * FROM kategoribuku");
        $this->data['raks'] = $this->db->query("SELECT * FROM rakbuku");
        $this->data['act_2'] = true;
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/book_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function borrow()
    {
        $bookid = $this->uri->segment('3');
        $takeborrow = $this->input->post('takeborrow');
        // $takeborrow = 5;

        $process = $this->system->addborrow($bookid, $takeborrow);

        if ($process == 0) {
            redirect(base_url("category/detail/$bookid"));
        } else if ($process == 1) {
            $this->session->set_flashdata('message', 'Buku sudah ada');
            // redirect('dashboard');
            // redirect(base_url("category/detail/$catid"));
        }
    }

}