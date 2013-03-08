 <script type="text/javascript">
    $(document).ready(function(){
        $('div#add_id').click(function(){
           $(location).attr('href','<?=base_url();?>message/template_new');
        });
        //delete template click
        $('img.del_template_cls').click(function(){
            var data = {};
            data['template_id'] = $(this).attr('name'); //alert(data['template_id']);
            var answer = confirm('Bạn có muốn xóa mẫu tin nhắn này không?');
            if(answer==false){
                return false;
            }
            $('#result_id').load('<?=base_url();?>message/template_delete',data,function(result){});
        });
    });                      
 </script>
 <div id="result_id"></div>
<div id = "container">
    <h3 align="center">Quản lý mẫu tin nhắn</h3>
    <div id="add_id" style="margin-left: 1150px; margin-bottom: 20px; cursor: pointer;"><img src="<?=base_url();?>public/img/table_plus.png" alt="Thêm mới"></div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
        <tr align="center" style="color: red;">
            <td>STT</td>
            <td>Tiêu đề</td>
            <td>Nội dung</td>
            <td>Sửa</td>
            <td>Xóa</td>
        </tr>
        <?php if(count($data)==0):?>
        <tr align="center">
            <td colspan="5" style="color: red;">Chưa có mẫu tin nhắn nào!</td>
        </tr>
        <?php else:?>        
           <?php $i = 1;
           foreach($data as $rs):?>
                <tr align="center">
                    <td><?=$i;?></td>
                    <td><?=$rs['title'];?></td> 
                    <td><?=$rs['content'];?></td> 
                    <td><a href="<?=base_url();?>message/template_edit/<?=$rs['template_id'];?>"><img src="<?=base_url();?>/public/img/x-mini-edit.png" alt="edit"></a></td> 
                    <td><img name="<?=$rs['template_id'];?>" class="del_template_cls" style="cursor: pointer;" src="<?=base_url();?>/public/img/x-mini-delete.png" alt="edit"></td>  
                </tr>
           <?php $i++; endforeach;?>
        <?php endif;?>
    </table>
</div>
