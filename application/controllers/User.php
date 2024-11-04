<?php

class User extends CI_Controller
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
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $fullname = $this->input->post('fullname');
        $address = $this->input->post('address');
        $level = $this->input->post('level');
        $rpassword = $this->input->post('rpassword');

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
            if ($password !== $rpassword) {
                $this->session->set_flashdata('error', 'Password tidak sama');
                redirect('dashboard/users');
            }

            $process = $this->auth->addacc($username, $email, $fullname, $address, $password, $rpassword, $level);

            if ($process == 1) {
                $this->session->set_flashdata('error', "Username sudah ada");
                redirect('dashboard/users');
            } else if ($process == 2) {
                $this->session->set_flashdata('error', "Email sudah ada");
                redirect('dashboard/users');
            } else {
                $this->session->set_flashdata('message', 'Berhasil membuat pengguna baru');
                redirect('dashboard/users');
            }

            redirect('dashboard/users');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dashboard/users');
        }
    }

    public function edit()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $fullname = $this->input->post('fullname');
        $address = $this->input->post('address');
        $level = $this->input->post('level');
        $rpassword = $this->input->post('rpassword');
        $userid = $this->input->post('userid');

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
            ]

        ];

        $this->form_validation->set_rules($rules);


        if ($this->form_validation->run() == true) {
            if ($password !== $rpassword) {
                $this->session->set_flashdata('error', 'Password tidak sama');
                redirect('dashboard/users');
            }


            $process = $this->auth->editacc($username, $email, $fullname, $address, $password, $rpassword, $level, $userid);

            if ($process == 1) {
                $this->session->set_flashdata('error', "Pengguna tidak ditemukan");
                redirect('dashboard/users');
            } else if ($process == 2) {
                $this->session->set_flashdata('error', "Username sudah ada");
                redirect('dashboard/users');
            } else if ($process == 3) {
                $this->session->set_flashdata('error', "Email sudah ada");
                redirect('dashboard/users');
            } else {
                $this->session->set_flashdata('message', "<strong>$username ($fullname)</strong> data telah di edit");
                redirect('dashboard/users');
            }

            redirect('dashboard/users');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dashboard/users');
        }
    }

    public function delete()
    {
        $userid = $this->input->post('userid');
        $this->auth->deleteuser($userid);
        $this->session->set_flashdata('message', 'Pengguna telah dihapus');
        redirect(base_url('dashboard/users'));
    }

    public function view()
    {
        $bookid = $this->uri->segment('3');
        $this->data['book'] = $this->system->getbook($bookid);
        $this->data['category'] = $this->system->getcat($this->data['book']->KategoriID);
        $this->data['reviews'] = $this->db->query('SELECT * FROM ulasanbuku WHERE BukuID = ' . $this->data['book']->BukuID);
        $this->data['act_2'] = true;

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $this->data);
        $this->load->view('data/book_view', $this->data);
        $this->load->view('templates/footer');
    }

}