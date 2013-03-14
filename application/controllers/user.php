<?php
/**
 * User: hungdp
 * Date: 3/7/13
 * Time: 11:13 AM
 */
class user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('base');
        $this->base->checkRoles();
    }

    public function index()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Danh sách người dùng';
        $data['user'] = $this->Model->get_data('users');
        $data['groups'] = $this->Model->get_data('groups');
        $data['count'] = $data['user']->num_rows();
        $data['content'] = 'user/list_user_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function add user
     */
    public function add()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Thêm người dùng mới';
        $data['groups'] = $this->Model->get_data('groups');
        $data['content'] = 'user/form_user_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function edit user
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->base->base_data();
        $data['user'] = $this->Model->get_one('users', 'user_id', $id);
        $data['title'] = 'Sửa người dùng ' . $data['user']->row()->usename;
        $data['groups'] = $this->Model->get_data('groups');
        $data['content'] = 'user/form_user_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function action add or edit user
     * @param null $user_id
     */
    function action_user($user_id = NULL)
    {
        $data['user'] = $this->Model->get_one('users', 'user_id', $user_id);
        $userName = $this->input->post('usename');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $pass = $this->input->post('newpassword');
        $groupId = $this->input->post('groupId');
        if (!empty($pass)) {
            $newpassword = md5($this->input->post('newpassword'));
        } else {
            $newpassword = $data['user']->row()->password;
        }
        $data = array('usename' => $userName, 'group_id' => $groupId, 'password' => $newpassword, 'email' => $email, 'name' => $name, 'mobile' => $mobile);
        if (!isset($user_id)) {
            $row = $this->Model->insert('users', $data);
        } else {
            $row = $this->Model->update('user_id', $user_id, 'users', $data);
        }
        redirect(base_url() . 'user', 'location');
    }

    /**
     *Function delete
     */
    function delete()
    {
        if($this->input->is_ajax_request()) //Check if the request is ajax request
        {
            $user = $this->Model->get_data('users');
            if($user->num_rows() == 1){
                echo json_encode(array('err' => 1, 'msg' => 'Không được xóa khi chỉ còn 1 thành viên.'));
            }else{
                $user_id = $_POST['id'];
                $this->Model->delete('users', 'user_id', $user_id);
                echo json_encode(array('err' => 0, 'msg' => 'Xóa thành công'));
            }
        }
    }

}