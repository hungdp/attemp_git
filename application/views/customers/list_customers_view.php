<div class="folder-header">
    <h3>Quản trị danh sách khách hàng</h3>
</div><!--folder-header-->
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?=base_url()?>customers/">Danh sách khách hàng</a></li>
    </ul>
</div><!--folder-tab-->
<div class="folder-content">
    <div class="form-horizontal">
        <div class="control-group">
            <a class="btn btn-primary" href="<?=base_url()?>customers/add">Thêm khách hàng</a>
            <a class="btn" href="<?=base_url()?>">Quay về trang chính</a>
        </div>
        <!--control-group-->
        <hr/>
        <div class="control-group">
            <span class="control-left">Có <b><?=$count?></b> khách hàng</span>
        </div>
        <!--control-group-->
        <table border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tbody>
            <tr class="info">
                <td>ID</td>
                <td>Tên khách hàng</td>
                <td>Số điện thoại</td>
                <td>Hệ điều hành</td>
                <td width="10%">Sửa</td>
                <td width="10%">Xóa</td>
            </tr>
            <?php
            for ($i = 0; $i < $customers->num_rows(); $i++) {
                ?>
            <tr>
                <td><?=$customers->row($i)->customer_id?></td>
                <td><?=$customers->row($i)->customer_name?></td>
                <td><?=$customers->row($i)->customer_mobile?></td>
                <?php for ($j = 0; $j < $operator->num_rows(); $j++) {
                if ($operator->row($j)->operator_id == $customers->row($i)->operator_id) {
                    echo '<td>' . $operator->row($j)->operator_name . '</td>';
                }
            }//end for operator
                if ($customers->row($i)->operator_id == 0 || $customers->row($i)->operator_id == null) {
                    echo '<td>Không rõ</td>';
                }?>
                <td><a href="<?=base_url()?>customers/edit/<?=$customers->row($i)->customer_id?>">Sửa</a></td>
                <td><a data-confirm="Bạn có muốn xóa?"
                       href="<?=base_url()?>customers/delete/<?=$customers->row($i)->customer_id?>">Xóa</a></td>
            </tr>
                <?php
            }//end for customers
            ?>
            </tbody>
        </table>
        <div class="control-group">
            <div id="paging" class="pagination pagination-right pull-right">
                <?php
                if (isset($paginate)) {
                    echo $paginate;
                }
                ?>
            </div>
        </div>
    </div>
    <!--form-horizontal-->
</div><!--folder-content-->
