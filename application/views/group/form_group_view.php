<?php
if(!isset($groups)){
    $group_name='';
    $description='';
    $title = 'Thêm nhóm mới';
    $action='group/action_group';
}
else
{
    $group_name=$groups->row()->group_name;
    $title = 'Sửa nhóm '.$groups->row()->group_name;
    $description=$groups->row()->description;
    $group_id=$groups->row()->group_id;
    $action='group/action_group/'.$group_id;
}
?>
<div class="folder-header">
    <h3>Quản trị nhóm người dùng</h3>
</div>
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#"><?=$title?></a>
        </li>
    </ul>
</div>
<div class="folder-content">
<form action="<?=$action?>" class="form-horizontal" method="post" style="width:500px">
    <div class="control-group">
        <label class="control-label">Tên nhóm:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="group_name" value="<?=$group_name?>"/>
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