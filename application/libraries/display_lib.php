<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    class Display_lib{
        
        //function chuyen sang tieng viet ko dau
        public function stripUnicode($str){
           if(!$str) return false;
           $unicode = array(
              'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
              'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
              'd'=>'đ',
              'D'=>'Đ',
              'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
              'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
              'i'=>'í|ì|ỉ|ĩ|ị',
              'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
              'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
              'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
              'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
              'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
              'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
              'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
           );
           foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
           return $str;
        }
        
        //function chuyen dinh dang ngay thang sang dung dinh dang thoi gian trong database
        public function timeDatabase($time){          
            $date = explode('/',$time); 
            return $date[2].'-'.$date[1].'-'.$date[0];
        }
        
        /** Ham gui tin nhan send_message
        * input params: receivers, message
        * receivers la mot chuoi so dien thoai nguoi nhan, moi so cach nhau dau phay vd: 84971234567,84987654321,...
        * message la noi dung tin nhan gui di
        * output param: status 
        * status la trang thai tin nhan sau khi gui di co the la 1 trong 3 trang thai
        *  - thanh cong
        *  - that bai
        *  - dang doi
        * 
        * */
        public function send_message($receivers,$message,$count_message){
             /***
             * thuc hien gui du lieu di va nhan ve trang thai $status
             * neu gui thanh cong $status=1;
             * neu gui that bai $status=0;
             * neu o trang thai dang doi $status=2;
             */
             $CI = & get_instance();
             $status = $this->get_status(0,2);
             /*thuc hien chen vao db sau khi gui*/
             if($status!=0){
                 $data = array('create_time'=>date('Y-m-d H:i:s',time()),'message'=>$message,
                     'message_length'=>$count_message,'status'=>$status,
                     'user_id'=>$CI->session->userdata('user_id'));
                 while(true){//save vao db khi save xong se thoat
                     $sms_id = $CI->model->insertData('sms',$data);
                     if($sms_id>0){
                         $save = false;
                         $numbers = explode(',',$receivers);
                         $insertReceiver = array();
                         foreach($numbers as $value){
                             $insertReceiver[] = array('sms_id'=>$sms_id,'receiver'=>$value); 
                         }  
                         while(true){
                              $re = $CI->model->insert_batch('sms_receiver',$insertReceiver);
                              if($re>0){
                                  $save = true;
                                  break;
                              }
                         }
                         if($save==true){
                             break;
                         }
                     }
                 }
                 return true;
             }
             return false;
        }
        
        /**
        * ham lay thong tin trang thai cua modem
        * @input param: $modem_id
        *  - $modem_id la id cua modem trong database
        * @param out: $data la mang du lieu chua cac thong tin ve modem gom:
        * $data['status']=1 or 0 tuong ung trang thai kha dung hay khong kha dung
        * $data['sms_total'] la tong so sms da gui di cua modem do
        * $data['sms_avail'] la tong so sms con lai co the gui duoc cua modem
        */
        public function get_modem_status(){ 
            /***
            * thuc hien lay cac thong tin ve
            * $data['status']
            * $data['sms_total']
            * $data['sms_avail']
            * 
            */ 
            $CI = & get_instance();
            $modem = $CI->model->getData('modem');
            foreach($modem as $rs){
                $data = array();
                $data['balance'] = $this->get_status(0,100000);
                $data['total_sms'] = $this->get_status(0,1000000);
                if($data['balance']!=0){
                    $data['status'] = 1;
                }else {
                    $data['status'] = 0;
                }             
                $CI->model->update('modem_id',$rs['modem_id'],'modem',$data);
            } 
        }
        /**
        * get status when send sms or update status
        * 
        * @param mixed $min
        * @param mixed $max
        * @return int
        */
        public function get_status($min, $max){
            return rand($min,$max);
        }
        
        /**
        * function update status
        * @param:null
        * 
        */
        public function update_status(){
           $CI = & get_instance();
           $CI->model->update_expire();
           //get all messages have status=2 
           $data = $CI->model->get_update_status();   
           foreach($data as $rs){
               $status = $this->get_status(0,2); 
               $CI->model->update('sms_id',$rs['sms_id'],'sms',array('status'=>$status));
           }
           
        }
        
    }
  
?>
