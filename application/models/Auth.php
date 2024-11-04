<?php
class Auth extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function register($username, $email, $fullname, $address, $password, $rpassword, $level)
    {

        $search = $this->db->get_where('user', array('Username' => $username));
        $search2 = $this->db->get_where('user', array('Email' => $email));
        $total = $this->db->get_where('user');

        if ($search->num_rows() > 0) {
            return 1;
        } else {

            if ($search2->num_rows() > 0) {
                return 2;
            } else {
                $totalusr = $total->num_rows() + 1;
                $uid = sprintf('%04d',$totalusr);
                $data_user = array(
                    'UserID' => "USR$uid",
                    'Username' => $username,
                    'Password' => md5($password),
                    'Email' => $email,
                    'NamaLengkap' => $fullname,
                    'Alamat' => $address,
                    'Level' => $level
                );
                $this->db->insert('user', $data_user);
            }

        }
    }
    function addacc($username, $email, $fullname, $address, $password, $rpassword, $level)
    {

        $search = $this->db->get_where('user', array('Username' => $username));
        $search2 = $this->db->get_where('user', array('Email' => $email));
        $total = $this->db->get_where('user');

        if ($search->num_rows() > 0) {
            return 1;
        } else {

            if ($search2->num_rows() > 0) {
                return 2;
            } else {
                $totalusr = $total->num_rows() + 1;
                $uid = sprintf('%04d',$totalusr);
                $data_user = array(
                    'UserID' => "USR$uid",
                    'Username' => $username,
                    'Password' => md5($password),
                    'Email' => $email,
                    'NamaLengkap' => $fullname,
                    'Alamat' => $address,
                    'Level' => $level
                );
                $this->db->insert('user', $data_user);
            }

        }
    }

    function editacc($username, $email, $fullname, $address, $password, $rpassword, $level, $userid)
    {

        $searchacc = $this->db->get_where('user', array('UserID' => $userid));

        if ($searchacc->num_rows() < 0) {
            return 1;
        }

        $search = $this->db->get_where('user', array('Username' => $username));
        $search2 = $this->db->get_where('user', array('Email' => $email));

        if ($search->num_rows() > 0 && $search->row()->UserID !== $userid) {
            return 2;
        } else if ($search2->num_rows() > 0 && $search2->row()->UserID !== $userid) {
            return 3;
        }

        $inpass = $searchacc->row()->Password;

        if ($password !== '') {
            $inpass = md5($password);
        }

        $this->db->query("UPDATE user SET Username = '$username', Password = '$inpass', Email = '$email', NamaLengkap = '$fullname', Alamat = '$address', Level = '$level' WHERE UserID = $userid");

    }

    function login_user($username, $password)
    {
        $query = $this->db->get_where('user', array('Username' => $username));
        if ($query->num_rows() > 0) {
            $data_user = $query->row();
            if (md5($password) == $data_user->Password) {
                $this->session->set_userdata('user_data', $data_user);
                $this->session->set_userdata('level', $data_user->Level);
                $this->session->set_userdata('logged', TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $query2 = $this->db->get_where('user', array('Email' => $username));

            if ($query2->num_rows() > 0) {
                $data_user = $query2->row();
                if (md5($password) == $data_user->Password) {
                    $this->session->set_userdata('user_data', $data_user);
                    $this->session->set_userdata('level', $data_user->Level);
                    $this->session->set_userdata('logged', TRUE);
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    function cek_login()
    {
        if (empty($this->session->userdata('logged'))) {
            redirect('login');
        }
    }

    function cek_perms()
    {
        if ($this->session->userdata('level') == '0') {
            redirect(base_url('dashboard'));
        }
    }
    function cek_admin()
    {
        if ($this->session->userdata('level') !== '1') {
            redirect(base_url('dashboard'));
        }
    }
    
    function deleteuser($id)
    {
        $this->db->delete('user', array('UserID' => $id));
        $this->db->delete('peminjaman', array('UserID' => $id));
        if ($this->session->userdata('user_data')->UserID == $id) {
            $this->session->set_flashdata('error', 'Kamu dikeluarkan karena akun ada sudah dihapus');
            redirect(base_url('login/logout'));
        }
    }
}
?>