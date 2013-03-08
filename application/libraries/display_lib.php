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
        
        /* Hàm gửi tin nhắn send_message
        * input params: receivers, message
        * receivers là một chuỗi các số điện thoại người nhận cách nhau dấu phẩy (,)
        * message là nội dung tin nhắn gửi đi
        * output param: status 
        * status là trạng thái nhận về sau khi gửi dữ liệu có thể là 3 trạng thái
        *  - thành công
        *  - thất bại
        *  - đang đợi
        * 
        * */
        public function send_message($receivers,$message,&$status){
             //thuc hien gui du lieu di va nhận về trạng thái status
        }
    }
  
?>
