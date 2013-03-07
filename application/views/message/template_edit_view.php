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
    });
</script>
<div id="container">
    <h3 align="center">Cập nhật mẫu tin nhắn</h3>
    <form action="<?=base_url();?>message/template_update" method="post">
    
    <table width="60%" align="center" style="margin-left: 350px; padding-top: 30px;">   
    <?php foreach($data as $rs):?>
        <input type="hidden" name="template_id_txt" value="<?=$rs['template_id'];?>">        
        <tr>
            <th>Tiêu đề</th>
            <td><input type="text" name="title" value="<?=$rs['title'];?>"></td>
        </tr>
        <tr>
            <th>Nội dung</th>
            <td><textarea cols="50" rows="4" class="textarea" name="content_template"><?=$rs['content'];?></textarea></td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" name="save_bt" value="Cập nhật" class="btn"></td>
            <td align="left">
                <input type="button" name="back_bt" value="Quay lại" onclick="history.back();" class="btn">
            </td>
        </tr>
    <?php endforeach;?>
    </table>
    </form>
</div>
