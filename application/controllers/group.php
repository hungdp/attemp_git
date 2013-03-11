<?php
/**
 * User: hungdp
 * Date: 3/7/13
 * Time: 2:50 PM
 */
class group extends CI_Controller
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
        $data['title'] = 'Quản trị nhóm người dùng';
        $data['groups'] = $this->Model->get_data('groups');
        $data['count'] = $data['groups']->num_rows();
        $data['content'] = 'group/list_group_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function add user
     */
    public function add()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Thêm nhóm người dùng mới';
        $data['content'] = 'group/form_group_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function edit group
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->base->base_data();
        $data['groups'] = $this->Model->get_one('groups', 'group_id', $id);
        $data['title'] = 'Sửa nhóm ' . $data['groups']->row()->group_name;
        $data['content'] = 'group/form_group_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function action add or edit group
     * @param null $group_id
     */
    function action_group($group_id = NULL)
    {
        $group_name = $this->input->post('group_name');
        $description = $this->input->post('description');
        $data = array('group_name' => $group_name, 'description' => $description);
        if (!isset($group_id)) {
            $row = $this->Model->insert('groups', $data);
        } else {
            $row = $this->Model->update('group_id', $group_id, 'groups', $data);
        }
        redirect(base_url() . 'group', 'location');
    }

    /**
     *Function delete group
     * @param $group_id
     */
    function delete($group_id)
    {
        $this->Model->delete('groups', 'group_id', $group_id);
        redirect(base_url() . 'group', 'location');
    }
}