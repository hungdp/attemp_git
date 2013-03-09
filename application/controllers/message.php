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
          //neu lay theo he dieu hanh dien thoại, lay thong tin khah hang
          $receiver_operator = array();
          if(count($operator)!=0){
              $receiver_operator = $this->model->get_where_in('customers','operator_id',$operator);
              
          }
          echo "<pre>";
          print_r($receiver_operator);
          echo "</pre>";
          //lay danh sach so dien thoai khi khak hang nhap vao
          $numbers = $this->input->post('numbers');
          $mess_count = $this->input->post('message_length');    echo $mess_count;
          if($numbers!=''){
              $receiver = explode(',',$numbers);
              foreach($receiver as $item){
                  //chuyen ve dinh dang 849839...
                  $item = preg_replace('/^0/','84',$item); 
              }
          }
          
          //lay noi dung tin nhan va chuyen ve dang tieng viet ko dau  
          $message = $this->input->post('message');
          $message = $this->display_lib->stripUnicode($message); 
          
          //goi den thu vien va gui message di                   
      }
      
      //chuc năng thông ke tin nhắn
      public function history(){
          //khi co thong tin tim kiem
          if($this->input->post('submit_search')=='Tìm'){
               $number = $this->input->post('txt_number');
               if($number!=''){
                   $this->session->set_userdata('number',$number);
               }else{
                   $this->session->unset_userdata('number');
               }
               //lay he dieu hanh
               $operator = $this->input->post('slt_operator');
               if($operator!=''){
                   $this->session->set_userdata('operator',$operator);
               }else{
                   $this->session->unset_userdata('operator');
               }
               //lay thoi gian tu ngay
               $from_date = $this->input->post('from_date');
               if($from_date!=''){
                   $this->session->set_userdata('from_date',$from_date);
               }else{
                   $this->session->unset_userdata('from_date');
               }
               
               //lay thoi gian den ngay
               $end_date = $this->input->post('end_date');
               if($end_date!=''){
                   $this->session->set_userdata('end_date',$end_date);
               }else{
                   $this->session->unset_userdata('end_date');
               }
               
               //lay trang thai tin nhan
               $status = $this->input->post('slt_status');
               if($status!=''){
                   $this->session->set_userdata('status',$status);
               }else{
                   $this->session->unset_userdata('status');
               }
               //lay noi dung tim kiem 
               $message = $this->input->post('ta_content');
               if($message!=''){
                   $this->session->set_userdata('message',$message);
               }else{
                   $this->session->unset_userdata('message');
               }  
               //redirect sang trang search de lay thong tin va phan trang message
               redirect(base_url().'message/search/inbox');
               
          }else{
              $data['content'] = 'message/message_history_view';
              //lay thong tin ve he dieu hanh de thong ke
              $data['operator'] = $this->model->getData('operator');
          }
          $this->load->view('master_view',$data);
      }
      
      //function get all data search
      public function search($action,$start_from=0){
          //load library
          $this->load->library(array('pagination','pagination_lib')); 
          $limit = 3; //gioi han so ban ghi tren trang  
          $total = $this->model->get_data_search('count');   //tong so ban ghi lay duoc
          $data['total'] = $total;
          //config phan trang
          $settings = $this->pagination_lib->get_settings('sms',$action,$total,$limit); 
          $this->pagination->initialize($settings);
          $data['page_nav'] = $this->pagination->create_links(); 
                   
           //lay du lieu tu ban ghi vi tri thu start from
          $data['inbox']  =   $this->model->get_data_search('',$limit,$start_from);
          $data['operator'] = $this->model->getData('operator');  
          $data['content'] = 'message/message_search_view';
          $this->load->view('master_view',$data);
      }
      
  }
?>
