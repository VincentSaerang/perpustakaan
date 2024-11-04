<?php

class Register extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
    }

    public function index()
    {
        $this->load->view('register/register_view');
    }

    public function make_acc()
    {

        $rules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|max_length[255]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[255]'
            ],
            [
                'field' => 'fullname',
                'label' => 'Full Name',
                'rules' => 'required|max_length[255]'
            ],
            [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required|max_length[255]'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[1]|max_length[255]'
            ],
            [
                'field' => 'rpassword',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]|max_length[255]'
            ]

        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $fullname = $this->input->post('fullname');
            $address = $this->input->post('address');
            $password = $this->input->post('password');
            $rpassword = $this->input->post('rpassword');

            if ($password !== $rpassword) {
                $this->session->set_flashdata('error', 'Password tidak sama');
                redirect('register');
            }

            $process = $this->auth->register($username, $email, $fullname, $address, $password, $rpassword, '0');

            if ($process == 1) {
                $this->session->set_flashdata('error', "Username sudah ada");
                redirect('register');
            } else if ($process == 2) {
                $this->session->set_flashdata('error', "Email sudah ada");
                redirect('register');
            } else {
                $this->session->set_flashdata('message', 'Berhasil membuat pengguna baru');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('register');
        }
    }
}