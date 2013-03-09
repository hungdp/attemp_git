<script type="text/javascript">
    $(document).ready(function(){
        $('input[type=submit]').click(function(){
            var title = $('input[name=title]').attr('value');
            if(title==''){
                alert('Bạn không được bỏ trống tiêu đề');
                $('input[name=title]').focus();
                return false;
            }
            var content = $('textarea[name=content_template]').val();
            if(content==''){
                alert('Bạn không được bỏ trống nội dung tin nhắn');
                $('textarea[name=content_template]').focus();
                return false;
            }
        });
        //dem do dai tin nhan
         $('textarea[name=content_template]').keyup(function(){
            countMessageLength();
        });
        $('textarea[name=content_template]').focus(function(){
            countMessageLength();
        });
    });
</script>
<div id="container">
    <h3 align="center">Tạo mới mẫu tin nhắn</h3>
    <form action="" method="post">
    
    <table width="60%" align="center" style="margin-left: 350px; padding-top: 30px;">       
        <tr>
            <th>Tiêu đề</th>
            <td><input type="text" name="title" value="" style="width: 275px;"></td>
        </tr>
        <tr>
            <th>Nội dung</th>
            <td><textarea cols="50" rows="4" class="textarea" name="content_template" id="content_message" style="width:275px;"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>Số kí tự <span class="count" style="color: red;"></span> số tin nhắn <span class="mess_length" style="color: red;"></span></td>
        </tr> 
        <tr>
            <td align="right">
                <input type="submit" name="save_bt" value="Tạo mới" class="btn"></td>
            <td align="left">
                <input type="button" name="back_bt" value="Quay lại" onclick="history.back();" class="btn">
            </td>
        </tr>
                
    </table>
    </form>
</div>         