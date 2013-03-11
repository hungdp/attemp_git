<?php
if(!isset($role)){
    $role_name='';
    $action='';
    $description='';
    $title = 'Thêm quyền mới';
    $actionn='roles/action_roles';
}
else
{
    $role_name=$role->row()->role_name;
    $title = 'Sửa quyền '.$role->row()->role_name;
    $action=$role->row()->action;
    $description=$role->row()->description;
    $role_id=$role->row()->role_id;
    $actionn='roles/action_roles/'.$role_id;
}
?>
<div class="folder-header">
    <h3>Quản trị phân quyền</h3>
</div>
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#"><?=$title?></a>
        </li>
    </ul>
</div>
<div class="folder-content">
    <form action="<?=$actionn?>" class="form-horizontal" method="post" style="width:500px">
    <div class="control-group">
        <label class="control-label">Tên quyền:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="role_name" value="<?=$role_name?>"/>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Hành động:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="action" value="<?=$action?>"/>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Mô tả:</label>
        <div class="controls">
            <textarea rows="3" data-val="true" data-val-required="" class="input-xlarge" name="description"><?=$description?></textarea>
        </div>
    </div><!--control-group-->
        <hr>
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Lưu</button>
                <button class="btn" type="reset">Huỷ bỏ</button>
            </div>
        </div>
</form><!--form-horizontal-->
</div>