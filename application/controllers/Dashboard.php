<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->data['act_1'] = true;

        $this->data['count_categorys'] = $this->db->query('SELECT * FROM kategoribuku')->num_rows();
        $this->data['count_books'] = $this->db->query('SELECT * FROM buku')->num_rows();
        $this->data['count_users'] = $this->db->query('SELECT * FROM user')->num_rows();
        $this->data['count_peminjaman'] = $this->db->query('SELECT * FROM peminjaman')->num_rows();
        $this->data['categorys'] = $this->db->query('SELECT * FROM kategoribuku');
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('dashboard/dashboard_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function category()
    {


        $this->data['categorys'] = $this->db->query('SELECT * FROM kategoribuku');
        $this->data['act_2'] = true;
        $this->data['count_categorys'] = $this->db->query('SELECT * FROM kategoribuku')->num_rows();
        $this->data['count_books'] = $this->db->query('SELECT * FROM buku')->num_rows();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/cat_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function rak()
    {


        $this->data['rak'] = $this->db->get_where('rakbuku');
        $this->data['books'] = $this->db->get_where('buku');
        $this->data['act_6'] = true;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/rak_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function users()
    {


        $this->data['users'] = $this->db->query('SELECT * FROM user');
        $this->data['act_3'] = true;
        $this->data['count_users'] = $this->db->query('SELECT * FROM user')->num_rows();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/users_view.php', $this->data);
        $this->load->view('templates/footer');
    }

    public function borrowing()
    {
        $this->system->checkborrow();
        $this->data['act_4'] = true;

        $this->data['count_peminjaman'] = $this->db->query('SELECT * FROM peminjaman')->num_rows();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);


        if ($this->session->userdata('level') !== '0') {
            $this->data['borrows'] = $this->db->query('SELECT * FROM peminjaman');
            $this->load->view('data/borrows_admin_view.php', $this->data);
        } else {

            $uid = $this->session->userdata('user_data')->UserID;

            $this->data['borrows'] = $this->db->query("SELECT * FROM peminjaman WHERE UserID = '$uid'");
            $this->load->view('data/borrows_view.php', $this->data);
        }

        $this->load->view('templates/footer');
    }
    public function settings()
    {
        $this->data['act_5'] = true;
        $this->auth->cek_admin();

        $this->data['settings'] = $this->db->query('SELECT * FROM pengaturan')->row();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/settings_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function returnborrow()
    {
        $id = $this->input->post('borrowid');
        $uid = $this->input->post('userid');
        $this->system->returnborrow($id,$uid);
        redirect('dashboard/borrowing');
    }

    public function approveborrow()
    {
        $id = $this->input->post('borrowid');
        $this->system->approveborrow($id);
        redirect('dashboard/borrowing');
    }

    public function deleteborrow()
    {
        $id = $this->input->post('borrowid');
        $this->system->deleteborrow($id);
        redirect('dashboard/borrowing');
    }
}