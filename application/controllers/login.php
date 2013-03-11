<?php
/**
 * User: hungdp
 * Date: 3/6/13
 * Time: 5:29 PM
 */
class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->database();
        $this->load->library('session');
        $this->model = new Model;
    }

    public function index()
    {
        #BEGIN: CHECK IF LOGIN
        if($this->session->userdata('sessionIdAdmin'))
        {
            redirect(base_url().'home', 'location');
            die();
        }
        #END CHECK IF LOGIN
        $data['title'] = 'Đăng nhập hệ thống';
        $data['content'] = 'user/login_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function check login
     */
    function checkLogin()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $data = array('usename' => $username, 'password' => $password);
        $sql = $this->model->get_data('users', $data);
        if ($sql->num_rows() == 1) {
            $sessionLogin = array(
                'sessionUserAdmin' => $sql->row()->usename,
                'sessionIdAdmin' => $sql->row()->user_id,
                'sessionGroupAdmin' => $sql->row()->group_id,
                'user_id' => $sql->row()->user_id
            );
            $this->session->set_userdata($sessionLogin);
            redirect(base_url().'home', 'location');
        } else {
            redirect(base_url().'login', 'location');
        }
    }

    /**
     * Function logout
     */
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'login', 'location');
    }
}

?>
