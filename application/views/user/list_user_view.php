<div class="folder-header">
    <h3>Quản trị người dùng</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>user">Danh sách người dùng</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn btn-primary" href="<?=base_url()?>user/add">Thêm người dùng mới</a>
            <a class="btn" href="<?=base_url()?>">Quay về trang chính</a>
        </div><!--control-group-->
        <hr />
        <div class="control-group">
            <span class="control-left">Có <b><?=$count?></b> người dùng</span>
        </div><!--control-group-->
        <table id="tbl-list" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tbody>
            <tr class="info">
                <td width="5%">ID</td>
                <td width="15%">Tên đăng nhập</td>
                <td width="15%">Tên thật</td>
                <td width="25%">Email</td>
                <td width="10%">Sửa</td>
                <td width="10%">Xóa</td>
            </tr>
            <?php
                for($i=0;$i<$user->num_rows();$i++){
            ?>
            <tr class="user-<?=$user->row($i)->user_id?>">
                <td><?=$user->row($i)->user_id?></td>
                <td><?=$user->row($i)->usename?></td>
                <td><?=$user->row($i)->name?></td>
                <td><?=$user->row($i)->email?></td>
                <td><a href="<?=base_url()?>user/edit/<?=$user->row($i)->user_id?>">Sửa</a></td>
                <td><a onclick="deleteUser(<?=$user->row($i)->user_id?>)">Xóa</a></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div><!--form-horizontal-->
</div><!--folder-content-->