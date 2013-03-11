<?php
/**
 * User: hungdp
 * Date: 3/6/13
 * Time: 2:39 PM
 */
class home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('base');
    }

    public function index()
    {
        $data=$this->base->base_data();
        $data['title']='Quản trị sms appota';
        $data['content']='home_view';
        $this->load->view('master_view',$data);
    }

    /**
     * Function no permission
     */
    public function nopermission()
    {
        $data=$this->base->base_data();
        $data['title']='Lỗi';
        $data['content']='false_view';
        $this->load->view('master_view',$data);
    }
}
?>
