 <script type="text/javascript">
    $(document).ready(function(){
          
        //check ten he dieu hanh co bi trung ko
        $('input[name=txt_operator_name]').blur(function(){
             var value = $(this).attr('value');
             if(value!=''){
                $('.btn-primary').attr('disabled',false);
                var data = {};
                data['value'] = value;
                $.post('<?=base_url();?>modem/name_duplicate',data,function(result){
                    if(result=='available'){
                       $('.btn-primary').attr('disabled',false); 
                       $('#notify').text('khả dụng').css('color','green');
                    }else{
                        $('.btn-primary').attr('disabled',true);
                        $('#notify').text('Không khả dụng').css('color','red');
                    }
                });
             }else{
                $('.btn-primary').attr('disabled',true);
             }
        });
        
        //disable button save
        $('.btn-primary,.btn-primary1').attr('disabled',true);
        //enable button save when keyup text name
        $('input[name=txt_operator_name]').keyup(function(){
            var value = $(this).attr('value');
            if(value!=''){
                $('.btn-primary').attr('disabled',false);
            }else{
                $('.btn-primary').attr('disabled',true);
            }
        });
        
        //thuc hien them moi
        $('.btn-primary').click(function(){
            var data = {};
            data['value'] = $('input[name=txt_operator_name]').attr('value');
            $.post('<?=base_url();?>modem/add_new',data,function(result){
                if(result=='success'){
                    alert('Thêm hệ điều hành thành công!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }else{
                    alert('Có lỗi xảy ra, thêm hệ điều hành thất bại!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }
            });
        });
        
        //khi cap nhat he dieu hanh
        $('a.btn1').click(function(){
            var id = $(this).attr('name');
            var name = $(this).attr('title');
            $('input[name=edit_operator_name]').attr('value',name);
            $('input[name=edit_operator_name]').attr('class',id);
        });
        
        //check ten he dieu hanh co bi trung ko
        $('input[name=edit_operator_name]').blur(function(){
             var value = $(this).attr('value');
             if(value!=''){
                $('.btn-primary1').attr('disabled',false);
                var data = {};
                data['value'] = value;
                data['id'] = $(this).attr('class');
                $.post('<?=base_url();?>modem/name_duplicate_edit',data,function(result){
                    if(result=='available'){
                       $('.btn-primary1').attr('disabled',false); 
                       $('#editModal #notify').text('khả dụng').css('color','green');
                    }else{
                        $('.btn-primary1').attr('disabled',true);
                        $('#editModal #notify').text('Không khả dụng').css('color','red');
                    }
                });
             }else{
                $('.btn-primary1').attr('disabled',true);
             }
        });
        
        //enable button save when keyup text name
        $('input[name=edit_operator_name]').keyup(function(){
            var value = $(this).attr('value');
            if(value!=''){
                $('.btn-primary1').attr('disabled',false);
            }else{
                $('.btn-primary1').attr('disabled',true);
            }
        });
        //thuc hien them moi
        $('.btn-primary1').click(function(){
            var data = {};
            data['value'] = $('input[name=edit_operator_name]').attr('value');
            data['id'] = $('input[name=edit_operator_name]').attr('class');
            
            $.post('<?=base_url();?>modem/update',data,function(result){
                if(result=='success'){
                    alert('Cập nhật hệ điều hành thành công!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }else{
                    alert('Có lỗi xảy ra, Cập nhật hệ điều hành thất bại!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }
            });
        });
        
        //khi xóa he dieu hanh check xem co nguoi dung chua
        $('a.btn-del').click(function(){
            var id = $(this).attr('name'); //alert(id);
            var name = $(this).attr('title');       
            $('p.name_cls').attr('id',id);
            var data = {};
            data['id'] = id;
            $.post('<?=base_url();?>modem/check_operator_use',data,function(result){
                if(result=='ok'){
                    $('p.del_result').text('Bạn có muốn xóa HĐH '+name+' không?');
                    $('.btn-primary-del').attr('disabled',false);
                }else{
                    $('p.del_result').text('Không thể xóa vì HĐH '+name+' đã được dùng?');
                    $('.btn-primary-del').attr('disabled',true);
                }
            });
        });
        
        //thuc hien xoa he dieu hanh
        $('.btn-primary-del').click(function(){
            var data = {};     
            data['id'] = $('p.name_cls').attr('id');
            
            $.post('<?=base_url();?>modem/delete',data,function(result){
                if(result=='success'){
                    alert('Xóa hệ điều hành thành công!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }else{
                    alert('Có lỗi xảy ra, xóa hệ điều hành thất bại!');
                    $(location).attr('href','<?=base_url();?>modem/operator');
                }
            });
        });
    });                      
 </script>
 <div id="result_id"></div>
<div id = "container">
    <fieldset>
        <legend>Thông tin các hệ điều hành</legend>
        <div id="add_id" style="margin-left: 1050px; margin-bottom: 20px; cursor: pointer;">
            <a href="#myModal" role="button" class="btn btn-add" data-toggle="modal">Thêm mới</a>
        </div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tr class="info">
                <td>STT</td>
                <td>Tên hệ điều hành</td>   
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
                        <td><?=$rs['operator_name'];?></td> 
                        <td><a href="#editModal" role="button" class="btn1" data-toggle="modal" name="<?=$rs['operator_id'];?>" title="<?=$rs['operator_name'];?>"><img src="<?=base_url();?>/public/img/x-mini-edit.png" alt="edit"></a></td> 
                        <td><a href="#delModal" role="button" class="btn-del" data-toggle="modal" name="<?=$rs['operator_id'];?>" title="<?=$rs['operator_name'];?>"><img src="<?=base_url();?>/public/img/x-mini-delete.png" alt="edit"></a></td>  
                    </tr>
               <?php $i++; endforeach;?>
            <?php endif;?>
        </table>
    </fieldset>
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 id="myModalLabel">Thêm hệ điều hành</h4>
      </div>
      <div class="modal-body">
        <p>Tên: <input type="text" value="" name="txt_operator_name"></p>
        <p align="center" id="notify" style="font-size: 0.9em;"></p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
        <button class="btn btn-primary">Thêm mới</button>
      </div>
    </div>
    
<!--    edit modal-->
    <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 id="myModalLabel">Cập nhật hệ điều hành</h4>
      </div>
      <div class="modal-body">
        <p>Tên: <input type="text" value="" name="edit_operator_name"></p>
        <p align="center" id="notify" style="font-size: 0.9em;"></p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
        <button class="btn btn-primary1">Cập nhật</button>
      </div>
    </div>
<!--    delete modal-->
    <div id="delModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 id="myModalLabel">Xóa hệ điều hành</h4>
        <p class="name_cls" align="center"></p>
      </div>
      <div class="modal-body">      
        <p class="del_result">Bạn có muốn xóa không?</p>
        <p align="center" id="notify" style="font-size: 0.9em;"></p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
        <button class="btn btn-primary-del">Xóa</button>
      </div>
    </div>
</div>

