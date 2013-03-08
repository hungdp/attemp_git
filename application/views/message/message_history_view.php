  
 <script type="text/javascript">
    $(document).ready(function(){
/*        alert('ok');*/
        $('#from_date').datepicker();
        $('#end_date').datepicker();
    });
 </script>
 <div id="container">
    <form action="" method="post" id="frm_search" name="frm_search">
        <fieldset>
            <legend>Thông tin tìm kiếm</legend>
            <table width="90%">
                <tr>
                    <th align="right">Số điện thoại:</th>
                    <td><input type="text" name="txt_number"></td>
                    <th align="right">Hệ điều hành:</th>
                    <td>
                        <select name="slt_operator" id="slt_operator">
                            <option value="">Chọn</option>
                            <?php if(count($operator)==0):?>
                                <option value="none">Chưa có</option>
                            <?php else:?>
                                 <?php foreach($operator as $rs):?>
                                    <option value="<?=$rs['operator_id'];?>"><?=$rs['operator_name'];?></option>
                                 <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th align="right">Từ ngày:</th>
                    <td><input type="text" name="from_date" id="from_date" class="from_date"></td>
                    <th align="right">Đến ngày:</th>
                    <td><input type="text" name="end_date" id="end_date"></td>
                </tr>
                <tr>
                    <th align="right">Trạng thái:</th>
                    <td>
                        <select name="slt_status" id="slt_status">
                            <option value="">Tất cả</option>
                            <option value="0">Thất bại</option>
                            <option value="1">Thành công</option>
                            <option value="2">Đang đợi</option>
                        </select>
                    </td>
                    <th align="right">Nội dung:</th>
                    <td>
                        <textarea style="width: 250px; height: 60px;" name="ta_content" id="ta_content"></textarea>
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
 </div>

