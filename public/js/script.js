/**
 * User: hungdp
 * Date: 3/12/13
 * Time: 5:37 PM
 */
$(function() {
    //BEGIN DELETE USER
    deleteUser = function(id){
        popup.confirm("Bạn có chắc chắn muốn xóa thành viên này?", function(){
            $.ajax({
                url: 'user/delete',
                type: 'post',
                dataType: 'json',
                data:{
                    id:id
                },
                success: function(result) {
                    popup.msg(result.msg);
                    if(result.err == 0){
                        $('.user-'+id).remove();
                    }
                }

            });
        });
    }
    //END DELETE USER

    //BEGIN EDIT GROUP ROLES
    editgrouproles = function(){
        var grouproles = [];
        var i=0;
        $('input[type=checkbox]').each(function(){
            if($(this).is(':checked')){
                grouproles[i] = {};
                grouproles[i].groupId = parseInt($(this).attr('group'));
                grouproles[i].roleId = parseInt($(this).attr('roles'));
                i++;
            }
        });

        popup.confirm("Bạn có chắc chắn muốn lưu danh sách phân quyền này?", function(){
            $.ajax({
                url: 'grouproles/ajax_submit',
                type: 'post',
                dataType: 'json',
                data:{
                    groupRoles:JSON.stringify(grouproles)
                },
                success: function() {
                    popup.msg('Lưu thay đổi thành công');
                }

            });
        });
    }
    //END EDIT GROUP ROLES

});