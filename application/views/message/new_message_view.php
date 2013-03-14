 
 <script type="text/javascript">
    $(document).ready(function(){
         $('#template_choice').click(function(){
             var data = {};
             $('#template_result').load('<?=base_url();?>message/get_template',function(result){});
         });
         
         //dem do dai tin nhan
         $('#content_message').keyup(function(){
            countMessageLength();
        });
        $('#content_message').focus(function(){
            countMessageLength();
        });
        
        //valid data before send message
        $('#send_bt').click(function(){
               var data = {};
               var i = 0;
               var check = true;
               var check_receiver = false;
               //lay nhan nhan dung he dieu hanh nao
               data['operator'] = {};
               $('.operator_cls').each(function(){
                   if($(this).attr('checked')){
                       data['operator'][i] = $(this).attr('value'); //alert(data['operator'][i]);
                       i++;
                       check_receiver = true;
                   }
               });
               
               //lay so dien thoai duoc nhap them vao
               data['numbers'] = $('#receiver_numbers').val();
               
               //check so dien thoai dung ko
               if(data['numbers']!=''){
                   var validate_number = checkMobile(data['numbers']); 
                   if(!validate_number){
                        alert('Số điện thoại bạn nhập chưa đúng định dạng!');
                        $('#receiver_numbers').focus();
                        return false;
                   }
               }                                                                                                    
               //check xem da co so dien thoai chua
               if(!check_receiver&&data['numbers']==''){
                   alert('Bạn chưa chọn số điện thoại để gửi đi!');
                   return false;
               }
               
               //check noi dung tin nhan
               data['message'] = $('#content_message').val();
               if(data['message']==''){
                   alert('Bạn cần nhập nội dung tin nhắn!');
                   $('#content_message').focus();
                   return false;
               }
               //do dai ban tin gui di
               data['message_length'] = $('span.mess_length').text();// alert(data['message_length']);
               //validate data ok, send to controller to proccess
               $('#send_message_id').load('<?=base_url();?>message/send_sms',data,function(result){});
               $('div.sending').html('<img src="<?=base_url();?>public/img/loadinfo.gif"/>');
               $('div.overlay').fadeIn('fast');  
        });
         
    });
 </script>
 <style type="text/css">
    .overlay{
        background:url("<?=base_url();?>public/img/overlay.png") repeat top left;
        position: fixed;
        top:0px;
        bottom: 0px;
        left:0px;
        right:0px;
        z-index: 100;
}
div.sending{
        position:fixed;
        top:200px;
        left:50%;
        right: 30%;
        z-index: 101;
    }
 </style>
  
  <div class="sending"></div>
 <div id="container">
 <div class="overlay" style="display: none;"></div>
    <div id="send_message_id"></div>
    <div id="receiver_id">
        <fieldset>
            <legend>Người nhận</legend>
            <fieldset id="receiver_fieldset">
                <legend>Chọn nhóm</legend>
                <table width="90%">
                    <tr align="center">
                    <?php if(count($operator)==0):?>
                        <td>Chưa có nhóm hệ điều hành nào được tạo</td>
                    <?php else:?>
                        <?php foreach($operator as $rs):?>
                        <td><?=$rs['operator_name'];?><br> <input type="checkbox" value="<?=$rs['operator_id'];?>" class="operator_cls" style="margin-bottom: 5px;"></td>
                        <?php endforeach;?>
                    <?php endif;?>
                    </tr>
                </table>
            </fieldset>
            <fieldset id="receiver_number_fieldset">
                <legend >Thêm số điện thoại</legend> 
                <span>VD: 0981234567,0912666888,...</span>
                <div>
                    <textarea style="width: 480px; height: 60px;" id="receiver_numbers"></textarea>
                </div>  
            </fieldset>
        </fieldset>
    
        <fieldset>
            <legend>Nội dung tin nhắn</legend>
            <fieldset>
                <legend><span style="cursor: pointer; font-style: italic;" id="template_choice"><u>Chọn mẫu tin nhắn</u></span></legend>
                <div id="template_result"></div>
            </fieldset>
            <fieldset>
                <legend>Nội dung</legend>
                <div id="template_content" style="margin-left: 20px;">
                    Số kí tự <span class="count" style="color: red;"></span> số tin nhắn <span class="mess_length" style="color: red;"></span>
                    <textarea style="width: 980px; height: 60px;" name="content_message" id="content_message" onkeyup="isMaxlengthSend(this);"></textarea>
                </div>
            </fieldset>
        </fieldset>
    </div>
    <div align="center">
        <input type="button" name="send_bt" id="send_bt" value="Gửi tin nhắn" class="btn"></td> 
        <input type="button" name="back_bt" value="Quay lại" onclick="history.back();" class="btn">
    </div>
 </div>
