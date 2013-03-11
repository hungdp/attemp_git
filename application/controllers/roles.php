<?php
/**
 * User: hungdp
 * Date: 3/7/13
 * Time: 3:38 PM
 */
class roles extends CI_Controller
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
        $data['title'] = 'Quản trị danh sách quyền';
        $data['role'] = $this->Model->get_data('role');
        $data['count'] = $data['role']->num_rows();
        $data['content'] = 'roles/list_role_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function add roles
     */
    public function add()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Thêm quyền mới';
        $data['content'] = 'roles/form_roles_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function edit roles
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->base->base_data();
        $data['role'] = $this->Model->get_one('role', 'role_id', $id);
        $data['title'] = 'Sửa quyền ' . $data['role']->row()->role_name ;
        $data['content'] = 'roles/form_roles_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function action add or edit roles
     * @param null $role_id
     */
    function action_roles($role_id = NULL)
    {
        $role_name = $this->input->post('role_name');
        $action = $this->input->post('action');
        $description = $this->input->post('description');
        $data = array('role_name' => $role_name, 'action' => $action, 'description' => $description);
        if (!isset($role_id)) {
            $row = $this->Model->insert('role', $data);
        } else {
            $row = $this->Model->update('role_id', $role_id, 'role', $data);
        }
        redirect(base_url() . 'roles', 'location');
    }

    /**
     *Function delete roles
     * @param $role_id
     */
    function delete($role_id)
    {
        $this->Model->delete('role', 'role_id', $role_id);
        redirect(base_url() . 'roles', 'location');
    }
}