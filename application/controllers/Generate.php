<?php class Generate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
        $this->load->model('system');
        $this->auth->cek_login();
        $this->auth->cek_perms();
    }
    function users()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Pengguna";
        $data["users"] = $this->db->query('SELECT * FROM user');
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf/data_user', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function category()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Kategori";
        $data["categories"] = $this->db->query('SELECT * FROM kategoribuku');
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf/data_category', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function allcat()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Semua Kategori";
        $data["categories"] = $this->db->query('SELECT * FROM kategoribuku');
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf/data_all_cat', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function books()
    {
        $categoryid = $this->uri->segment('3');

        $this->load->library('pdfgenerator');
        $data['title'] = "Data Buku";
        $data["books"] = $this->db->query("SELECT * FROM buku WHERE KategoriID = '$categoryid'");
        $data["category"] = $this->db->query("SELECT * FROM kategoribuku WHERE KategoriID = '$categoryid'");
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf/data_books', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    function borrow()
    {
        $this->load->library('pdfgenerator');
        $data['title'] = "Data Peminjaman";
        $data["borrows"] = $this->db->query('SELECT * FROM peminjaman');
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf/data_borrows', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}