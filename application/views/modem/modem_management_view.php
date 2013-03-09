 <div id="container">
    <fieldset>
        <legend>Thông tin thiết bị</legend>
        <table class="table table-bordered table-hover" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr align="center" class="info">
                    <td>STT</td>
                    <td>Tên thiết bị</td>
                    <td>Tin nhắn khả dụng</td>
                    <td>Tin nhắn đã gửi</td>
                    <td>Trạng thái hiện tại</td>
                </tr>
                <?php if(count($modem)==0):?>
                    <tr>
                        <td colspan="5">Không tìm thấy thiết bị nào</td>
                    </tr>
                <?php else:?>
                    <?php $i=1; foreach($modem as $rs):?>
                        <tr>
                            <td><?=$i;?></td>  
                            <td><?=$rs['modem_name'];?></td>  
                            <td><?=$rs['balance'];?></td>  
                            <td>1000000</td>  
                            <td>
                                <?php if($rs['status']==0) echo 'Không khả dụng'; else echo 'Khả dụng';?>
                            </td>  
                        </tr>
                    <?php $i++; endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </fieldset>
 </div>
