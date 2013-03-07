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
    }

    public function index()
    {
        $data['content']='home_view'; 
        $this->load->view('master_view',$data);
    }

}
?>
