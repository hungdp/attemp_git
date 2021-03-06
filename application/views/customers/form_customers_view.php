<?php
if(!isset($customer)){
    $customer_name='';
    $customer_mobile='';
    $customer_id = '';
    $operator_id  = '';
    $title = 'Thêm khách hàng mới';
    $action='customers/action_customer';
}
else
{
    $customer_name=$customer->row()->customer_name;
    $title = 'Sửa khách hàng '.$customer->row()->customer_name;
    $customer_mobile=$customer->row()->customer_mobile;
    $operator_id =$customer->row()->operator_id ;
    $customer_id=$customer->row()->customer_id;
    $action='customers/action_customer/'.$customer_id;
}
?>
<style type="text/css">
    .overlay{
        background:url("<?=base_url();?>public/img/overlay.png") repeat top left;
        position: fixed;
        top:0px;
        bottom: 0px;
        left:0px;
        right:0px;
        z-index: 100;
}
div.sending{
        position:fixed;
        top:200px;
        left:50%;
        right: 30%;
        z-index: 101;
    }
 </style>
 <div class="overlay" style="display: none;"></div>
 
<div class="folder-header">
    <h3>Quản trị danh sách khách hàng</h3>
</div>
<div class="folder-tab">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#"><?=$title?></a>
        </li>
    </ul>
</div>
<div class="folder-content">
<div class="sending" style="display: none;"><img src="<?=base_url();?>public/img/loadinfo.gif"/></div>
    <form action="<?=$action?>" class="form-horizontal" method="post" style="width:500px" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label">Kiểu dữ liệu:</label>
            <div class="controls">
                <label class="radio inline">
                    <input class="typeData" type="radio" checked="" value="1" name="type">
                    Nhập tay
                </label>
                <label class="radio inline">
                    <input class="typeData" type="radio" value="2" name="type">
                    File excel
                </label>
                <label class="radio inline">
                    <input class="typeData" type="radio" value="3" name="type">
                    File text
                </label>
            </div>
        </div>
        <div class="default">
        <div class="control-group">
            <label class="control-label">Tên khách hàng:</label>
            <div class="controls">
                <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="customer_name" value="<?=$customer_name?>"/>
            </div>
        </div><!--control-group-->
        <div class="control-group">
            <label class="control-label">Số điện thoại:</label>
            <div class="controls">
                <input type="text" data-val="true" data-val-required="" class="input-xlarge" name="customer_mobile" value="<?=$customer_mobile?>"/>
            </div>
        </div><!--control-group-->
        <div class="control-group">
            <label class="control-label">Hệ điều hành:</label>
            <div class="controls">
                <select name="operator_id" id="sl-group" class="input-xlarge">
                    <option value="0">Tất cả</option>
                    <?php
                    for ($i = 0; $i < $operator->num_rows(); $i++) {
                        if($operator_id == $operator->row($i)->operator_id)
                            $sl = 'selected';
                        else
                            $sl = '';
                        ?>
                        <option <?=$sl?> value="<?=$operator->row($i)->operator_id?>"><?=$operator->row($i)->operator_name?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div><!--control-group-->
        </div>
        <div class="import" style="display: none;">
            <div class="control-group">
            <label class="control-label">Chọn file:</label>
            <div class="controls">
                <input type="file" name="userfile" size="60">
                <!--<input id="lefile" type="file" style="display:none" name="userfile">
                <div class="input-append">
                    <input id="photoCover" class="input-large" type="text">
                    <a class="btn" onclick="$('#lefile').click();">Chọn</a>
                </div> -->
            </div>
            <div style="margin-left: 120px;">Download <a href="<?=base_url().'customers/download/customers.xls';?>">file</a> excel mẫu</div>  
            <div style="margin-left: 120px;">Download <a href="<?=base_url().'customers/download/list.txt';?>">file</a> text mẫu</div>
        </div>
        </div>
        <hr>
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Lưu</button>
                <button class="btn" type="reset">Huỷ bỏ</button>
            </div>
        </div>
    </form><!--form-horizontal-->
</div>
<script type="text/javascript">
    $(function() {
        $('.typeData').click(function(){
            if($(this).val() == 1){
                $('.import').hide();
                $('.default').show();
            }
            else{
                $('.import').show();
                $('.default').hide();
            }
        });
        $('.btn-primary').click(function(){
            var type=0;
            $('input[name=type]').each(function(){
                if($(this).attr('checked')){
                    type = $(this).attr('value');
                }
            });   
            if(type!=1){            
                $('div.sending').fadeIn('fast');
                $('div.overlay').fadeIn('fast');
            }
        });
    });
</script>