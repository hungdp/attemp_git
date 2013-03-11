<div class="folder-header">
    <h3>Quản trị phân quyền</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>grouproles/">Danh sách phân quyền</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn" href="<?=base_url()?>">Quay về trang chính</a>
        </div>
        <!--control-group-->
        <hr/>
        <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tbody>
            <tr class="info">
                <td>&nbsp;</td>
                <?php
                for ($i = 0; $i < $groups->num_rows(); $i++) {
                    ?>
                    <td><?=$groups->row($i)->group_name?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
            for ($i = 0; $i < $role->num_rows(); $i++) {
                ?>
            <tr>
                <td><?=$role->row($i)->role_name?></td>
                <?php
                    for($j = 0; $j<$groups->num_rows(); $j++)
                    {
                        echo ' <td><input ';
                        for($k = 0; $k<$group_role->num_rows(); $k++){
                                    if($groups->row($j)->group_id == $group_role->row($k)->group_id && $role->row($i)->role_id == $group_role->row($k)->role_id){
                                        echo 'checked="checked"';
                                    }
                                }
                        echo ' name=groupRoles[] roles="'.$role->row($i)->role_id.'" group="'.$groups->row($j)->group_id.'" type="checkbox"/></td>';
                    }
                ?>
            </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="control-group">
            <button type="button" onclick="edit()" class="btn btn-primary">Lưu thay đổi</button>
        </div>
        <!--control-group-->
    </div>
    <!--form-horizontal-->
</div><!--folder-content-->
<script type="text/javascript">
    edit = function(){
        var grouproles = [];
        var i=0;
        $('input[type=checkbox]').each(function(){
            if($(this).is(':checked')){
                grouproles[i] = {};
                grouproles[i].groupId = parseInt($(this).attr('group'));
                grouproles[i].roleId = parseInt($(this).attr('roles'));
                i++;
            }
        });

        popup.confirm("Bạn có chắc chắn muốn lưu danh sách phân quyền này?", function(){
            $.ajax({
                url: 'grouproles/ajax_submit',
                type: 'post',
                dataType: 'json',
                data:{
                    groupRoles:JSON.stringify(grouproles)
                },
                success: function() {
                    popup.msg('Lưu thay đổi thành công');
                }

            });
        });
    }
</script>