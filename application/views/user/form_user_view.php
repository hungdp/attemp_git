<?php
if(!isset($user)){
    $userName='';
    $email='';
    $name='';
    $mobile='';
    $group_id ='';
    $title ='Thêm người dùng mới';
    $vali = 'data-val="true" data-val-required=""';
    $action='user/action_user';
}
else
{
    $userName=$user->row()->usename;
    $title ='Sửa người dùng '.$user->row()->usename;
    $email=$user->row()->email;
    $name=$user->row()->name;
    $user_id=$user->row()->user_id;
    $group_id=$user->row()->group_id;
    $mobile=$user->row()->mobile;
    $vali = '';
    $action='user/action_user/'.$user_id;
}
?>
<div class="folder-header">
    <h3>Quản trị người dùng</h3>
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
        <label class="control-label">Thuộc nhóm:</label>
        <div class="controls">
            <select name="groupId" id="sl-group" class="input-xlarge">
                <option value="0">Tất cả</option>
                <?php
                for ($i = 0; $i < $groups->num_rows(); $i++) {
                    if($group_id == $groups->row($i)->group_id)
                        $sl = 'selected';
                    else
                        $sl = '';
                    ?>
                    <option <?=$sl?> value="<?=$groups->row($i)->group_id?>"><?=$groups->row($i)->group_name?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Tên đăng nhập:</label>
        <div class="controls">
            <input type="text" class="input-xlarge" data-val="true" data-val-required="" name="usename" value="<?=$userName?>"/>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Mật khẩu:</label>
        <div class="controls">
            <input type="password" <?=$vali?> class="input-xlarge" name="newpassword"/>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Địa chỉ email:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="email" value="<?=$email?>"/>
        </div
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Tên thật:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="name" value="<?=$name?>"/>
        </div>
    </div><!--control-group-->
    <div class="control-group">
        <label class="control-label">Số điện thoại:</label>
        <div class="controls">
            <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="mobile" value="<?=$mobile?>"/>
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