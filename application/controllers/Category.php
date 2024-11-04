<?php

class Category extends CI_Controller
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
        $name = $this->input->post('namecat');

        $process = $this->system->addcat($name);

        if ($process == 0) {
            redirect('dashboard/category');
        } else if ($process == 1) {
            $this->session->set_flashdata('message', 'Kategori sudah ada');
            redirect('dashboard/category');
        }

    }

    public function delete()
    {
        $id = $this->input->post('catid');
        $this->system->deletecat($id);
        redirect('dashboard/category');
    }

    public function edit()
    {
        $id = $this->input->post('catid');
        $newname = $this->input->post('namecat');
        $this->system->editcat($id, $newname);
        redirect('dashboard/category');
    }

    public function detail()
    {
        $catid = $this->uri->segment('3');
        $this->data['books'] = $this->db->query("SELECT * FROM buku WHERE KategoriID = '$catid'");
        $this->data['raks'] = $this->db->query("SELECT * FROM rakbuku");
        $this->data['categorys'] = $this->db->query("SELECT * FROM kategoribuku");
        $this->data['category'] = $this->system->getcat($catid);
        $this->data['act_2'] = true;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/books_view', $this->data);
        $this->load->view('templates/footer');
    }

}