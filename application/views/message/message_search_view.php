<script type="text/javascript">
    $(document).ready(function(){
        $('#from_date').datepicker();
        $('#end_date').datepicker();
    });
</script>
<div id="container">
    <form action="<?=base_url();?>message/history" method="post" id="frm_search" name="frm_search">
        <fieldset>
            <legend>Thông tin tìm kiếm</legend>
            <table width="90%">
                <tr>
                    <th align="right">Số điện thoại:</th>
                    <td><input type="text" name="txt_number" value="<?=$this->session->userdata('number');?>"></td>
                    <th align="right">Hệ điều hành:</th>
                    <td>
                        <select name="slt_operator" id="slt_operator">
                            <option value="">Chọn</option>
                            <?php if(count($operator)==0):?>
                                <option value="none">Chưa có</option>
                            <?php else:?>
                                 <?php foreach($operator as $rs):?>
                                    <option value="<?=$rs['operator_id'];?>"
                                    <?php if($rs['operator_id']==$this->session->userdata('operator')):?>
                                        selected="selected"
                                    <?php endif;?>
                                    ><?=$rs['operator_name'];?></option>
                                 <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th align="right">Từ ngày:</th>
                    <td><input type="text" name="from_date" id="from_date" class="from_date" value="<?=$this->session->userdata('from_date');?>"></td>
                    <th align="right">Đến ngày:</th>
                    <td><input type="text" name="end_date" id="end_date" value="<?=$this->session->userdata('end_date');?>"></td>
                </tr>
                <tr>
                    <th align="right">Trạng thái:</th>
                    <td>
                        <select name="slt_status" id="slt_status">
                            <option value=""  
                            <?php $flag = true; if($this->session->userdata('status')==''):?> selected="selected" <?php $flag = false; endif;?>
                            >Tất cả</option>
                            <option value="0" 
                            <?php if($flag&&$this->session->userdata('status')==0):?> selected="selected" <?php $flag =false; endif;?>
                            >Thất bại</option>
                            <option value="1" 
                            <?php if($flag&&$this->session->userdata('status')==1):?> selected="selected" <?php $flag =false; endif;?>
                            >Thành công</option>
                            <option value="2"
                            <?php if($flag&&$this->session->userdata('status')==2):?> selected="selected" <?php $flag =false; endif;?>
                            >Đang đợi</option>
                        </select>
                    </td>
                    <th align="right">Nội dung:</th>
                    <td>
                        <textarea style="width: 250px; height: 60px;" name="ta_content" id="ta_content"><?=$this->session->userdata('message');?></textarea>
                    </td>
                </tr>  
                <tr>
                    <td colspan="4" align="center">
                        <input type="submit" value="Tìm" id="submit_search" name="submit_search" class="btn">
                        <input type="button" value="Quay lại" id="bt_back" name="bt_back" onclick="history.back();" class="btn">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>   
    <fieldset>
        <legend>Thống kê tin nhắn</legend>
        <p style="font-style: italic;font-size: 1.3em;">Tổng số tin nhắn tìm thấy: <span class="total" style="color: red;"><?=$total;?></span></p>
        <table width="90%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
            <tr align="center" style="color: blue; font-size: 1.1em;" class="info">
                <td>STT</td>
                <td>Ngày gửi</td>
                <td>Người gửi</td>
                <td>Người nhận</td>
                <td>Nội dung</td>
                <td>Số tin</td>
                <td>Trạng thái</td>
            </tr>
            <?php if(count($inbox)==0):?>
                 <tr align="center">
                    <td colspan="7" style="color: red; font-size: 1.2em;">Chưa có tin nhắn nào</td>
                 </tr>
            <?php else:?>
                <?php $i=1; foreach($inbox as $rs):?>
                    <tr align="center">
                        <td><?=$i;?></td>
                        <td width="15%"><?=$rs['create_time'];?></td>
                        <td><?=$this->session->userdata('username');?></td>
                        <td><?=$rs['receiver'];?></td>
                        <td width="30%"><?=$rs['message'];?></td>
                        <td><?=$rs['message_length'];?></td>
                        <td><?php if($rs['status']==0) echo 'Thất bại'; else if($rs['status']==1) echo 'Thành công'; else echo 'Đang đợi';?></td>
                    </tr>
                <?php $i++; endforeach;?>
            <?php endif;?>
        </table>
        <?php if(isset($page_nav)){ 
            echo "<div id='pagination_nav'>";
            echo $page_nav;
            echo "</div>";
        }       ?>
    </fieldset>
</div>
