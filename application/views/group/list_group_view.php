<div class="folder-header">
    <h3>Quản trị nhóm người dùng</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>group/">Danh sách nhóm người dùng</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn btn-primary" href="<?=base_url()?>group/add">Thêm nhóm người dùng mới</a>
            <a class="btn" href="<?=base_url()?>">Quay về trang chính</a>
        </div><!--control-group-->
        <hr />
        <div class="control-group">
            <span class="control-left">Có <b><?=$count?></b> nhóm người dùng</span>
        </div><!--control-group-->
        <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tbody>
            <tr class="info">
                <td>ID</td>
                <td>Tên nhóm</td>
                <td>Mô tả:</td>
                <td width="10%">Sửa</td>
                <td width="10%">Xóa</td>
            </tr>
            <?php
                for($i=0;$i<$groups->num_rows();$i++){
            ?>
            <tr>
                <td><?=$groups->row($i)->group_id?></td>
                <td><?=$groups->row($i)->group_name?></td>
                <td><?=$groups->row($i)->description?></td>
                <td><a href="<?=base_url()?>group/edit/<?=$groups->row($i)->group_id?>">Sửa</a></td>
                <td><a data-confirm="Bạn có muốn xóa?" href="<?=base_url()?>group/delete/<?=$groups->row($i)->group_id?>">Xóa</a></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div><!--form-horizontal-->
</div><!--folder-content-->