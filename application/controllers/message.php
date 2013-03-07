<?php
  class Message extends CI_Controller{
      public function __construct(){
          parent::__construct();     
          $this->load->Model('model'); 
          $session = array('user_id'=>2,'username'=>'tiennt','group_id'=>1);
          $this->session->set_userdata($session);  
          $this->load->library('display_lib');
      }
      
      //function template management
      public function template(){
            $data = array();
            $data['content'] = 'message/template_show_view';
            $data['data'] =  $this->model->getData('template',array('user_id'=>$this->session->userdata('user_id')));  
            $this->load->view('master_view',$data);
      }   
      
      //function edit template
      public function template_edit($id){
          $data = array();
          $data['data'] = $this->model->getData('template',array('user_id'=>$this->session->userdata('user_id'),'template_id'=>$id));
          if(count($data['data'])==0){
              $data['error_info'] = 'Có lỗi xảy ra, yêu cầu của bạn không đúng hoặc không tồn tại';
              $data['link_back'] = base_url().'message/template';
              $data['content'] = 'message/not_found_view';
          }else{
              $data['content'] = 'message/template_edit_view';
          }
          $this->load->view('master_view',$data);
      }
      
      //function update template
      public function template_update(){
            $template_id = $this->input->post('template_id_txt');
            $title = $this->input->post('title');
            $content = $this->input->post('content_template');
            //chuyen noi dung sang tieng viet khong dau    
            $content = $this->display_lib->stripUnicode($content);
            $data = array('title'=>$title,'content'=>$content);
            $result = $this->model->update('template_id',$template_id,'template',$data);
            $data = array();
            if($result>0){  
                $data['error_info'] = 'Cập nhật mẫu tin nhắn thành công';
            }else{     
                $data['error_info'] = 'Có lỗi xảy ra, cập nhật thất bại';      
            }
            $data['link_back'] = base_url().'message/template';
            $data['content'] = 'message/not_found_view';
            $this->load->view('master_view',$data);
      }
      
      //public function add new template
      public function template_new(){
          $data = array();
          if($this->input->post('save_bt')!=''){
             $title = $this->input->post('title');
             $content = $this->input->post('content_template');
            //chuyen noi dung sang tieng viet khong dau    
             $content = $this->display_lib->stripUnicode($content);
             $item = array('title'=>$title,'content'=>$content,'user_id'=>$this->session->userdata('user_id'));
             $result = $this->model->insert('template',$item);  
             if($result>0){  
                $data['error_info'] = 'Tạo mới mẫu tin nhắn thành công';
             }else{     
                $data['error_info'] = 'Có lỗi xảy ra, tạo mới thất bại';      
             }
             $data['link_back'] = base_url().'message/template';
             $data['content'] = 'message/not_found_view';
             $this->load->view('master_view',$data);
          }else{
                $data['content'] = 'message/template_new_view';
                $this->load->view('master_view',$data);
          }
      }
      
      //function delete template
      public function template_delete(){
          $data = array();
          $template_id = $this->input->post('template_id');
          $result = $this->model->delete('template','template_id',$template_id);
          echo "<script>";
          if($result>0){   
              echo "alert('Xóa mẫu tin nhắn thành công');";
              echo "location='".base_url().'message/template'."';";
          }else{
              echo "alert('Có lỗi, xóa mẫu tin nhắn thất bại');";
              echo "location='".base_url().'message/template'."';";
          }
          echo "</script>";   
      }
      
      //send message to customer 
      public function send_message(){
          $data = array();
          $data['content'] = 'message/new_message_view';
          $data['operator'] = $this->model->getData('operator');
          $this->load->view('master_view',$data);
      }
      
      //function get template to send sms
      public function get_template(){
          $data['template'] = $this->model->getData('template',array('user_id'=>$this->session->userdata('user_id')));
          $this->load->view('message/template_view',$data);
      }
      
      //function send message
      public function send_sms(){
          //get information to send message
          $operator = $this->input->post('operator');
          echo "<pre>";
          print_r($operator);
          echo "</pre>";
          
      }
  }
?>
