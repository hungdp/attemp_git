<?php
  class Message extends CI_Controller{
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
      
      //function template management
      public function template(){
            $data=$this->base->base_data();
            $data['content'] = 'message/template_show_view';
            $data['title'] = 'Quản lý mẫu tin';
            $data['data'] =  $this->model->getData('template',array('user_id'=>$this->session->userdata('user_id')));  
            $this->load->view('master_view',$data);
      }   
      
      //function edit template
      public function template_edit($id){
          $data=$this->base->base_data();
          $data['data'] = $this->model->getData('template',array('user_id'=>$this->session->userdata('user_id'),'template_id'=>$id));
          $data['title'] = 'Cập nhật mẫu tin';
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
            $data=$this->base->base_data();
            
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
          $data=$this->base->base_data(); 
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
          $data=$this->base->base_data();
          $data['title'] = 'Gửi mới tin nhắn';
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
          //lay danh sach so dien thoai khi khak hang nhap vao
          $numbers = $this->input->post('numbers');
          $mess_count = $this->input->post('message_length');    //echo $mess_count;
          $receiver_send ="";
          $count = 0;
          $max =30000;
          $j = 0;
          $number_array = array();
          if($numbers!=''){
              $receiver = explode(',',$numbers);
              foreach($receiver as $item){
                  //chuyen ve dinh dang 849839...
                  $item = preg_replace('/^0/','84',$item);
                  if($count>$max){
                      $count = 0;
                      $number_array[$j] = $receiver_send;
                      $receiver_send='';
                      $j++;
                  }
                  $receiver_send=$receiver_send.$item.",";
                  $count++; 
              }
          }
          //neu lay theo he dieu hanh dien thoại, lay thong tin khah hang
          $receiver_operator = array();
          if(count($operator)!=0&&$operator!=''){
              
              $receiver_operator = $this->model->get_where_in('customers','operator_id',$operator);
              foreach($receiver_operator as $rs){
                  if($count>$max){
                      $count = 0;
                      $number_array[$j] = $receiver_send;
                      $receiver_send = '';
                      $j++;
                  } 
                  $receiver_send = $receiver_send.$rs['customer_mobile'].",";  
                  $count++;
                  
              }
          }
          if($receiver_send!=''){
            $number_array[$j] = $receiver_send;
          } 
          $end = $count; 
          
          
          //lay noi dung tin nhan va chuyen ve dang tieng viet ko dau  
          $message = $this->input->post('message');
          $message = $this->display_lib->stripUnicode($message); 
          
          //goi den thu vien va gui message di
          $count = 0;
          $j = 0;
          if(count($number_array)!=0){
              foreach($number_array as $rs){
                  $rs = substr($rs,0,-1);
                  if(!$this->display_lib->send_message($rs,$message,$mess_count)){
                      echo "<script>";  
                        echo"alert('Có lỗi, gửi thất bại, ".$count." tin nhắn đã được gửi');";
                        echo "location='".base_url()."message/send_message';";
                      echo "</script>"; 
                      return; 
                  }
                  if($j!=count($number_array)-1){
                      $count = $count+$max+1;
                  }else{
                      $count = $count+$end; 
                  }
                  $j++;
              }
              echo "<script>";  
                echo"alert('Gủi tin nhắn thành công, ".$count." tin nhắn đã được gửi');";
                echo "location='".base_url()."message/send_message';";
              echo "</script>"; 
              return;
          }else{
              echo "<script>";  
                echo"alert('Không tìm thấy số điện thoại nào hợp lệ để gửi đi!');";
                //echo "location='".base_url()."message/send_message';";
              echo "</script>"; 
              return;
          }                   
      }
      
      //chuc năng thông ke tin nhắn
      public function history(){
          $data=$this->base->base_data();
          $data['title'] = 'Thống kê tin nhắn';
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
          $data=$this->base->base_data();
          $this->display_lib->update_status();
          $this->load->library(array('pagination','pagination_lib')); 
          $limit = 40; //gioi han so ban ghi tren trang  
          $total = $this->model->get_data_search('count');   //tong so ban ghi lay duoc
          $data['total'] = $total;  
          $data['sum']  =$this->model->get_data_search('sum');
          //config phan trang
          $settings = $this->pagination_lib->get_settings('sms',$action,$total,$limit); 
          $this->pagination->initialize($settings);
          $data['page_nav'] = $this->pagination->create_links(); 
                   
           //lay du lieu tu ban ghi vi tri thu start from
          $data['inbox']  =   $this->model->get_data_search('',$limit,$start_from);
          $data['title'] = 'Thống kê tin nhắn';
          $data['operator'] = $this->model->getData('operator');  
          $data['content'] = 'message/message_search_view';
          $this->load->view('master_view',$data);  
      }
      
  }
?>
