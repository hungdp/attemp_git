<?php if(! defined('BASEPATH')) exit("No direct script access allowed");
  class Modem extends CI_Controller{
      public function __construc(){
          parent::__construct();
      }
      
      //function quan lý hệ điều hành
      public function operator(){
            $data = array();
            $data['content'] = 'modem/operator_show_view';
            $data['data'] =  $this->model->getData('operator');  
            $this->load->view('master_view',$data);
      }
  }
?>
