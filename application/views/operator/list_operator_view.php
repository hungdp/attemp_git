<div class="folder-header">
    <h3>Quản trị danh sách hệ điều hành</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>operator/">Danh sách hệ điều hành</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn btn-primary" href="<?=base_url()?>operator/add">Thêm hệ điều hành mới</a>
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
                <td width="15%">Tên hệ điều hành</td>
                <td width="10%"><p>Sửa</p></td>
                <td width="10%"><p>Xóa</p></td>
            </tr>
            <?php
            for($i=0;$i<$operator->num_rows();$i++){
                ?>
            <tr>
                <td><?=$operator->row($i)->operator_id?></td>
                <td><?=$operator->row($i)->operator_name?></td>
                <td><a href="<?=base_url()?>operator/edit/<?=$operator->row($i)->operator_id?>">Sửa</a></td>
                <td><a data-confirm="Are you sure you want to delete?" href="<?=base_url()?>operator/delete/<?=$operator->row($i)->operator_id?>">Xóa</a></td>
            </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div><!--form-horizontal-->
</div><!--folder-content-->