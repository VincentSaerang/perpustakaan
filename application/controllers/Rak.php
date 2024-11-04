<?php

class Rak extends CI_Controller
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
        redirect(base_url('dashboard/category'));
    }


    public function add()
    {
        $name = $this->input->post('namerak');

        $process = $this->system->addrak($name);
        
        if ($process == 0) {
            redirect('dashboard/rak');
        } else if ($process == 1) {
            $this->session->set_flashdata('message', 'Rak sudah ada');
            redirect('dashboard/rak');
        }

    }

    public function delete()
    {
        $id = $this->input->post('rakid');
        $this->system->deleterak($id);
        redirect('dashboard/rak');
    }

    public function deletebook()
    {
        $id = $this->input->post('bookid');
        $catid = $this->input->post('catid');
        $this->system->deletebook($id);
        redirect(base_url('rak/detail/' . $catid));
    }

    public function edit()
    {
        $id = $this->input->post('rakid');
        $newname = $this->input->post('namerak');
        $this->system->editrak($id, $newname);
        redirect('dashboard/rak');
    }

    public function detail()
    {
        $catid = $this->uri->segment('3');
        $rak = $this->db->get_where("rakbuku", array('RakID' => "$catid"));
        if ($rak->num_rows() <= 0) {
            redirect('dashboard/rak');
        }
        $this->data['rak'] = $this->db->get_where("rakbuku", array('RakID' => "$catid"))->row();
        $this->data['raks'] = $this->db->query("SELECT * FROM buku WHERE RakID  = '$catid'");
        $this->data['allrak'] = $this->db->query("SELECT * FROM rakbuku");
        $this->data['allcat'] = $this->db->query("SELECT * FROM kategoribuku");
        $this->data['act_6'] = true;


        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/rak_detail_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function addbook()
    {
        $isbn = $this->input->post('isbn');
        $title = $this->input->post('book');
        $writer = $this->input->post('bookwriter');
        $publisher = $this->input->post('bookpublisher');
        $pubyear = $this->input->post('bookyear');
        $bookstok = $this->input->post('bookstok');
        $bookrak = $this->input->post('bookrak');
        $bookcat = $this->input->post('bookcat');


        $process = $this->system->addbuku($isbn, $title, $writer, $publisher, $pubyear, $bookcat, $bookstok, $bookrak);

        if ($process == 0) {
            redirect(base_url("rak/detail/$bookrak"));
        } else if ($process == 1) {
            echo $process;
            $this->session->set_flashdata('message', 'Book exist');
            // redirect('dashboard');
        }
    }

}