
$('#btn_changepassword').click(function(){
    $('#modal-change_password1').modal('show')

$(function(){
    $("form[class='form_changepassword']").validate({
     
        submitHandler: function() {
            $.ajax({
                "url": "./php/api/user/getUserPrivacyInfo.php",
                "type": "GET",
                "contentType": "application/json",
                "async": false,
                success: function(response) {
                    var current_pass = response.Password;
                    var enter_current_pass = $('#account_currentpassword').val();
                    var new_password = $('#s_password').val();
                    var reenter_password = $("#chk_password").val();

                    if (!(/^(.{4,14}$)/.test(new_password))) {
                        $('.display_error').text('4 ~ 14 영숫자');
                        return;
                    }
                    if (!(/^(.{4,14}$)/.test(reenter_password))) {
                        $('.display_error').text('4 ~ 14 영숫자');
                        return;
                    }
                    if(current_pass == enter_current_pass){
                        if(new_password == '' && reenter_password == '') {
                            $('.display_error').text('암호 불일치!');
                        }
                        else if(new_password != reenter_password){
                            $('.display_error').text('새 비밀번호가 일치하지 않습니다!');
                        }
                        else if(new_password == reenter_password){
                            let formData = $('.form_changepassword').serialize();
                            $.ajax({
                                type: 'POST',
                                url: './php/api/user/postChangePass.php',
                                data: {formData},
                                success: function(request){
                                    $("#modal-change_password").modal('hide');
                                    if(request == true){
                                        izitoast('성공적으로 제출되었습니다!','','fa fa-check-square-o','green','./settings');
                                    }else{
                                        izitoast('실패!','다시 시도하십시오.','fa fa-times-circle-o','red','./settings');
                                    }
                                }
                            })
                        }
                    }else{
                        $('.display_error').text('잘못된 현재 비밀번호!');
                    }
                }
            })
           
        }
    });
})
})

//fetching user bank info
  $.ajax({
    "url": "./php/api/user/getUserPrivacyInfo.php",
    "type": "GET",
    "contentType": "application/json",
    "async": false,
    success: function(response) {
        var str = response.Account_Number;
        var replacer = replaceRange(str, 3, 7, "****");
        $('#accountid').val(response.Account_Code);
        $('#accountnickname').val(response.Nickname);
        $('#current_password').val(response.Password);
        $('#accountholder').val(response.Account_Holder);
        $('#bank').val(response.BankName);
        $('#accountno').val(replacer);
        $('#recommendedpoint').val(response.Recommended_Point);
    }
  })

  function replaceRange(s, start, end, substitute) {
    return s.substring(0, start) + substitute + s.substring(end);
  }
