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
