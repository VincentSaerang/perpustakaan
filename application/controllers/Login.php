<?php
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
    }

    public function index()
    {
        $this->load->view('login/login_view');
    }

    public function auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->auth->login_user($username, $password)) {
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('logged');
        redirect(base_url('login'));
    }
}