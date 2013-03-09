 <script type="text/javascript">
    $(document).ready(function(){
        $('input.template_check').click(function(){
             var message = $(this).parent().siblings('.content_check').text();
             message = $('#content_message').val()+message;      
             $('#template_id').fadeOut(300);
             $('#content_message').attr('value',message);
             $('#content_message').focus();
        });
    });                      
 </script>
 <div id="result_id"></div>
<div id = "template_id">                                                             
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <tr align="center" style="color: red;" class="info">
            <td>Chọn</td>
            <td>Tiêu đề</td>
            <td>Nội dung</td>  
        </tr>
        <?php if(count($template)==0):?>
        <tr align="center">
            <td colspan="5" style="color: red;">Chưa có mẫu tin nhắn nào!</td>
        </tr>
        <?php else:?>        
           <?php foreach($template as $rs):?>
                <tr align="center">
                    <td><input type="radio" name="template_check" class="template_check"></td>
                    <td><?=$rs['title'];?></td> 
                    <td class="content_check"><?=$rs['content'];?></td> 
                </tr>
           <?php endforeach;?>
        <?php endif;?>
    </table>
</div>
