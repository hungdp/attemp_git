<?php
if(!isset($operator)){
    $operator_name='';
    $title='Thêm hệ điều hành mới';
    $action='operator/action_operator';
}
else
{
    $operator_name=$operator->row()->operator_name;
    $operator_id=$operator->row()->operator_id;
    $title='Sửa hệ điều hành '.$operator->row()->operator_name;
    $action='operator/action_operator/'.$operator_id;
}
?>
<div class="folder-header">
    <h3>Quản trị hệ điều hành</h3>
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
            <label class="control-label">Tên hệ điều hành:</label>
            <div class="controls">
                <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="operator_name" value="<?=$operator_name?>"/>
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