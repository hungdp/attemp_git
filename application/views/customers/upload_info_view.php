<div id="container">
    <fieldset>
         <legend>Thông tin import khách hàng</legend>
         <p>Tổng số khách hàng import thành công: <?=$info['success'];?></p>
         <p>Tổng số khách hàng bị trùng số điện thoại: <?=$info['duplicate'];?></p>
         <p>Tổng số khách hàng có số điện thoại sai: <?=$info['invalid'];?></p> 
         <a href="<?=$link_back;?>" title="Back">Quay lại</a>
    </fieldset>  
</div>
