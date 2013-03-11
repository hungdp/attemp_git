<?php
/**
 * User: hungdp
 * Date: 3/7/13
 * Time: 10:08 AM
 */
class Base extends CI_Controller
{
    public function base_data()
    {
        $this->load->library('session');
        #BEGIN: CHECK LOGIN
        if (!$this->session->userdata('sessionIdAdmin')) {
            redirect(base_url() . 'login', 'location');
            die();
        }
        #END CHECK LOGIN
        $data['userName']=$this->session->userdata('sessionUserAdmin');
        return $data;
    }

    /**
     * Function check roles
     */
    public function checkRoles()
    {
        $this->load->library('session');
        $groupId = $this->session->userdata('sessionGroupAdmin');
        $this->load->model('Model');
        $this->model = new Model;
        #BEGIN GET ACTION
        if($this->uri->segment(2)){
            $action = $this->uri->segment(1).'/'.$this->uri->segment(2);
        }else{
            $action = $this->uri->segment(1);
        }
        #END GET ACTION
        $roles = $this->Model->get_one('role', 'action', $action);
        $groupRoles = $this->Model->get_data('group_role', array('role_id '=>$roles->row()->role_id,'group_id'=>$groupId));
        if ($groupRoles->num_rows() > 0) {

        }else{
            redirect(base_url() . 'home/nopermission', 'location');
        }

    }

    public function do_upload()
    {     
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/public/import/'; 
        $config['allowed_types'] = 'txt|xls';
        $config['max_size']    = '50000';
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload())
        {
            $data = array('error' == $this->upload->display_errors());
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
        }   
        return $data;
    }

    public function nopermission()
    {
        $data=$this->base->base_data();
        $data['title']='Lỗi';
        $data['content']='false_view';
        $this->load->view('master_view',$data);
    }

}

?>