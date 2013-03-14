//function count message length
function countMessageLength(){
        var count   = $('#content_message').val();
        //var count   = input.length;  
        var number = Math.ceil(parseInt(count.length)/160);
        $('span.count').html(count.length);
        $('span.mess_length').html(number);
}

//function check valid number format from number of string mobile number (09123456789,09832323123..)
function checkMobile(numbers){
    var reg  = /^09(0|1|2|3|4|5|6|7|8)[0-9]{7}$/;
    var reg1 = /^099[3|4|5|6][0-9]{6}$/;
    var reg2 = /012[0-9][0-9]{7}$/;
    var reg3 = /^016(3|4|5|6|7|8|9)[0-9]{7}$/;
    var reg4 = /^0199[0-9]{7}$/;
    var number = {};
    number = numbers.split(',');
    for( var i =0;i< number.length; i++){
        if((reg.test(number[i])==false)&&(reg1.test(number[i])==false)&&
            (reg2.test(number[i])==false)&&(reg3.test(number[i])==false)&&(reg4.test(number[i])==false)){
            return false;
        }
    }
    return true;
}


//function limited number of characters in sms
function isMaxlengthSend(obj){
        var maxLength = 960;
        if(obj.value.length >maxLength){
            obj.value = obj.value.substring(0,maxLength);
        }
}

$(document).ready(function() {
    $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Xác nhận</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Hủy</button><a class="btn btn-primary" id="dataConfirmOK">Chấp nhận</a></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show:true});
        return false;
    });
});

