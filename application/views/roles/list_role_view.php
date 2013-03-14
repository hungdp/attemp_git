<div class="folder-header">
    <h3>Quản trị danh sách quyền</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>roles/">Danh sách quyền hạn</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn btn-primary" href="<?=base_url()?>roles/add">Thêm quyền hạn mới</a>
            <a class="btn" href="<?=base_url()?>">Quay về trang chính</a>
        </div><!--control-group-->
        <hr />
        <div class="control-group">
            <span class="control-left">Có <b><?=$count?></b> kết quả</span>
        </div><!--control-group-->
        <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tbody>
            <tr class="info">
                <td width="5%">ID</td>
                <td width="15%">Tên quyền</td>
                <td width="25%">Hành động</td>
                <td>Chú thích</td>
                <td width="10%"><p>Sửa</p></td>
                <td width="10%"><p>Xóa</p></td>
            </tr>
            <?php
                for($i=0;$i<$role->num_rows();$i++){
            ?>
            <tr>
                <td><?=$role->row($i)->role_id?></td>
                <td><?=$role->row($i)->role_name?></td>
                <td><?=$role->row($i)->action?></td>
                <td><?=$role->row($i)->description?></td>
                <td><a href="<?=base_url()?>roles/edit/<?=$role->row($i)->role_id?>">Sửa</a></td>
                <td><a data-confirm="Bạn có muốn xóa?" href="<?=base_url()?>roles/delete/<?=$role->row($i)->role_id?>">Xóa</a></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
        </table>
    </div><!--form-horizontal-->
</div><!--folder-content-->