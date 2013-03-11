<?php
/**
 * User: hungdp
 * Date: 3/7/13
 * Time: 4:26 PM
 */
class grouproles extends CI_Controller
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
        $data['title'] = 'Quản trị phân quyền';
        $data['groups'] = $this->Model->get_data('groups');
        $data['role'] = $this->Model->get_data('role');
        $data['group_role'] = $this->Model->get_data('group_role');
        $data['count'] = $data['group_role']->num_rows();
        $data['content'] = 'grouproles/list_grouproles_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function action edit group roles
     */
    function ajax_submit()
    {
        if($this->input->is_ajax_request()) //Check if the request is ajax request
        {
            $this->Model->deleteAll('group_role');
            $groupRoles = json_decode($_POST['groupRoles'], false);
            foreach ($groupRoles as $gRole) {
                $groupId = $gRole->groupId;
                $role_id = $gRole->roleId;
                $data = array('group_id' => $groupId, 'role_id' => $role_id);
                $this->Model->insert('group_role', $data);
            }
        }
    }
}