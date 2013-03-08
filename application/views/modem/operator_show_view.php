 <script type="text/javascript">
    $(document).ready(function(){
        
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
    <fieldset>
        <legend>Thông tin các hệ điều hành</legend>
        <div id="add_id" style="margin-left: 1050px; margin-bottom: 20px; cursor: pointer;">
            <a href="#myModal" role="button" class="btn" data-toggle="modal">Thêm mới</a>
        </div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tr align="center" style="color: red;">
                <td>STT</td>
                <td>Tên hệ điều hành</td>   
                <td>Sửa</td>
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
                        <td><?=$rs['operator_name'];?></td> 
                        <td><a href="<?=base_url();?>message/template_edit/<?=$rs['operator_id'];?>"><img src="<?=base_url();?>/public/img/x-mini-edit.png" alt="edit"></a></td> 
                    </tr>
               <?php $i++; endforeach;?>
            <?php endif;?>
        </table>
    </fieldset>
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
      </div>
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
      </div>
    </div>
</div>
