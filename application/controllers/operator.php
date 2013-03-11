<?php
/**
 * User: hungdp
 * Date: 3/8/13
 * Time: 10:45 AM
 */
class operator extends CI_Controller
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
        $data['title'] = 'Quản trị danh sách hệ điều hành';
        $data['operator'] = $this->Model->get_data('operator');
        $data['count'] = $data['operator']->num_rows();
        $data['content'] = 'operator/list_operator_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function add operator
     */
    public function add()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Thêm hệ điều hành mới';
        $data['content'] = 'operator/form_operator_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function edit operator
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->base->base_data();
        $data['operator'] = $this->Model->get_one('operator', 'operator_id', $id);
        $data['title'] = 'Sửa quyền ' . $data['operator']->row()->operator_name ;
        $data['content'] = 'operator/form_operator_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function action add or edit operator
     * @param null $operator_id
     */
    function action_operator($operator_id = NULL)
    {
        $operator_name = $this->input->post('operator_name');
        $data = array('operator_name' => $operator_name);
        if (!isset($operator_id)) {
            $row = $this->Model->insert('operator', $data);
        } else {
            $row = $this->Model->update('operator_id', $operator_id, 'operator', $data);
        }
        redirect(base_url() . 'operator', 'location');
    }

    /**
     *Function delete roles
     * @param $operator_id
     */
    function delete($operator_id)
    {
        $this->Model->delete('operator', 'operator_id', $operator_id);
        redirect(base_url() . 'operator', 'location');
    }
}