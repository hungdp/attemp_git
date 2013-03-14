<?php if(! defined('BASEPATH')) exit("No direct script access allowed");
  class Modem extends CI_Controller{
      public function __construct(){
          parent::__construct();
          $this->load->library('display_lib');
          $this->load->library('pagination_lib');
          
          $this->load->model('model');
          $this->load->database();
          $this->Model = new Model;
          $this->load->library('base');  
          $this->base->checkRoles();
      }
      
      //function quan lý hệ điều hành
      public function operator(){
            $data = array();
            $data=$this->base->base_data();
            $data['title'] = 'Quản lý hệ điều hành';
            $data['content'] = 'modem/operator_show_view';
            $data['data'] =  $this->model->getData('operator');  
            $this->load->view('master_view',$data);
      }
      
      //check operator name is duplicate?
      public function name_duplicate(){
          $name = $this->input->post('value');
          $info = $this->model->getData('operator',array('operator_name'=>$name));
          if(count($info)!=0){
              echo "fail";
          }else{
              echo "available";
          }
      }
      //check operator name is duplicate when edit
      public function name_duplicate_edit(){
          $name = $this->input->post('value');
          $id = $this->input->post('id');
          $info = $this->model->getData('operator',array('operator_name'=>$name,'operator_id !='=>$id));
          if(count($info)!=0){
              echo "fail";
          }else{
              echo "available";
          }
      }
      
      //function save new operation name
      public function add_new(){
          $name = $this->input->post('value');
          $result = $this->model->insert('operator',array('operator_name'=>$name));
          if($result>0){
              echo "success";
          }else{
              echo "fail";
          }
      }
      
      //function update  operation name
      public function update(){
          $name = $this->input->post('value');
          $id = $this->input->post('id');
          $result = $this->model->update('operator_id',$id,'operator',array('operator_name'=>$name));
          if($result>0){
              echo "success";
          }else{
              echo "fail";
          }
      }
      
      /*function modem management
      * Thanh Tien
      * 10:35 AM
      * 
      */
      public function show(){
          $data = array();
          $data=$this->base->base_data();
          $this->display_lib->get_modem_status();
          $data['title'] = 'Quản lý modem';
          $data['content'] = 'modem/modem_management_view';
          $data['modem'] = $this->model->getData('modem');
          $this->load->view('master_view',$data);
      }
      
      /* check operator to delete
      * 12:14
      */
      public function check_operator_use(){
          $id = $this->input->post('id');
          $data = $this->model->getData('customers',array('operator_id'=>$id));
          if(count($data)==0){
              echo "ok";
          }else{
              echo "fail";
          }
      }
      
      //function update  operation name
      public function delete(){       
          $id = $this->input->post('id');
          $result = $this->model->delete('operator','operator_id',$id);
          if($result>0){
              echo "success";
          }else{
              echo "fail";
          }
      } 
  }
?>
