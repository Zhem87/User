$( document ).ready(function() {
    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('#chk2').prop('checked', true);
            $('#chk3').prop('checked', true);
            $('#chk2-error').css('display','none');
            $('#chk3-error').css('display','none');
        } else {
            $('#chk2').prop('checked', false);
            $('#chk3').prop('checked', false);
            $('#chk2-error').removeAttr("style");
            $('#chk3-error').removeAttr("style");
        }
    });
    $.validator.addMethod("accountcodeRegex", function (value, element) {
        let acctcode = value;
        if (!(/^(.{4,12}$)/.test(acctcode))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let acctcode = $(element).val();
        if (!(/^(.{4,12}$)/.test(acctcode))) {
            return '';
        }
        return false;
    });
    $.validator.addMethod("nicknameRegex", function (value, element) {
        let nname = value;
        if (!(/^(.{3,14}$)/.test(nname))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let nname = $(element).val();
        if (!(/^(.{3,14}$)/.test(nname))) {
            return '';
        }
        return false;
    });
    $.validator.addMethod("strong_password", function (value, element) {
        let password = value;
        if (!(/^(?=.*[0-9])(.{4,12}$)/.test(password))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let password = $(element).val();
        if (!(/^(.{4,12}$)/.test(password))) {
            return '';
        }
        else if (!(/^(?=.*[0-9])/.test(password))) {
            return '';
        }
        
        return false;
    });
    $.validator.addMethod("accountnoRegex", function (value, element) {
        let acctcode = value;
        if (!(/^(?=.*[0-9])(.{4,24}$)/.test(acctcode))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let acctcode = $(element).val();
        if (!(/^(.{4,24}$)/.test(acctcode))) {
            return '영어, 숫자 14자까지 가능합니다.';
        }
        else if (/^(?=.*[0-9])/.test(acctcode)) {
            return '영어, 숫자 14자까지 가능합니다.';
        }
        return false;
    });
  

    //register
    $("form[id='form_register']").validate({
        // Specify validation rules
        ignore: "not:hidden",
        rules: {
            dummy_code: "required",
            s_account_code:{
            required: true,
            accountcodeRegex: true,
            },
            dummy_nickname: "required",
            nickname: {
                required: true,
                nicknameRegex: true,
            },
            s_password: {
                required: true,
                strong_password: true
            },
            chk_password: {
                equalTo: "#s_password"
            },
            mobile_number: {
                required: true
            },
            account_holder: "required",
            bank_code: "required",
            account_number: {
                required: true,
                accountnoRegex: true,
            },
            chk1: "required",
            chk2: "required",
            chk3: "required",
            dummy_rec: "required",
            rec_point: {
                required: true
            }
        },
        // Specify validation error messages
        messages: {
            dummy_code: "",
            s_account_code: {
                required: "",
              //remote: "This username is already taken! Try another."
            },
            dummy_nickname: "",
            nickname: "",
            nickname_dup_chk: "Click button to check duplicate.",
            s_password: {
                required: ""
            },
            chk_password: "입력하신 비밀번호가 일치하지 않습니다.",
            mobile_number: {
                required: "휴대폰 번호를 입력해 주세요."
            },
            account_holder: "예금주를 입력해 주세요.",
            bank_code: "--이용하실 은행을 선택해 주세요.--",
            account_number: "계좌번호를 입력해 주세요.('-'표시없이 입력해주세요.)",
            chk1: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            chk2: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            chk3: "( 가입하려면 모든 회원 이용약관에 동의해야 합니다. )",
            dummy_rec: "",
            rec_point:{
                required: ""
            } 
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "s_account_code" ){
                error.insertAfter(".errorid");
            }
            else if  (element.attr("name") == "nickname" ){
                error.insertAfter(".errornickname");
            }
            else if  (element.attr("name") == "chk1" ){
                error.insertAfter(".errorchk1");
            }
            else if  (element.attr("name") == "chk2" ){
                error.insertAfter(".errorchk2");
            }
            else if  (element.attr("name") == "chk3" ){
                error.insertAfter(".errorchk3");
            }
            else{
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            $('#register_btn').attr('disabled',true);
            $('#register_btn').css('display','none');
            $('#loading_btn').css('display', 'block');
            let formData = $('#form_register').serialize();
            $.ajax({
                type: 'POST',
                url: './php/api/postRegistration.php',
                data: {formData},
                success: function(request){
                    if(request == true){
                        window.location.href='./?succ=1';
                    }else{
                        alert('error occured.')
                    }
                }
            })
        }
    });

    function check_account_exists(){
        $('#accnt_id_dup_chk').click(function(){
            let code = $('#s_account_code').val();
            if(code == ""){
                $('.error_id_chk').text('계정 이름 입력')
            }
            else{
            $.ajax({
                type: "POST",
                url: "./php/api/checkAccountIdifExists.php",
                "async": false,
                data: JSON.stringify(code),
                success: function(request){
                    if(request == 1){
                        //overlap
                        $('.error_id_chk').text('사용 불가')
                        $('#dummy_code').val('')
                    }
                    else if(request == 0){
                        //possible
                        $('.btn_signup_orange4').css('display','block')
                        $('.btn_signup_orange1').css('display','none')
                        $('.error_id_chk').text('사용 가능')
                        $('#dummy_code').val(1)
                    }
                }
            });
            return false;
        }
        })
    }

    function check_code_exists(){
        $('#code_dup_chk').click(function(){
            let rec = $('#rec_point').val();
            if(rec == ""){
                $('.error_code_chk').text('코드를 입력')
            }else{
            $.ajax({
                type: "POST",
                url: "./php/api/checkCodeifExists.php",
                "async": false,
                data: JSON.stringify(rec),
                success: function(request){
                    if(request == 1){
                        //correct
                        $('.btn_signup_orange6').css('display','block')
                        $('.btn_signup_orange3').css('display','none')
                        $('.error_code_chk').text('사용 가능')
                        $('#dummy_rec').val(1)
                    }
                    else{
                           //incorrect
                        $('.error_code_chk').text('사용 불가')
                        $('#dummy_rec').val('')
                    }
                }
            });
            return false;
            }
        })
    }


    function check_nickname_exists(){
        $('#nickname_dup_chk').click(function(){
            let nick = $('#nickname').val();
            if(nick == ""){
                $('.error_nn_chk').text('닉네임 입력')
            }
            else{
            $.ajax({
                type: "POST",
                url: "./php/api/checknicknameifexists.php",
                "async": false,
                data: JSON.stringify(nick),
                
                success: function(request){
                    if(request == 1){
                        //overlap
                        $('.error_nn_chk').text('사용 불가')
                        $('#dummy_nickname').val('')
                    }
                    else{
                           //possible
                        $('.btn_signup_orange5').css('display','block')
                        $('.btn_signup_orange2').css('display','none')
                        $('.error_nn_chk').text('사용 가능')
                        $('#dummy_nickname').val(1)
                        $('.errornickname').hide()
                    }
                }
            });
            return false;
        }
        })
    }

    function getBankList(){
        $.get('./php/api/getBankList.php', function(banklist){
            var html = '';
            html += '<option value="" disabled selected>--이용하실 은행을 선택해 주세요.-</option>';
            banklist.forEach(function(bank){
                
                html += '<option value="'+bank.m_BankId+'">'+bank.m_Bank_Name+'</option>';
            })
            $('#bank_code').html(html);
        })
    }

    $(document).keyup(function(event) {
        if (event.which === 13) {
            let code = $('#s_account_code').val();
            let nick = $('#nickname').val();
            let rec = $('#rec_point').val();

            if(code == "" && nick == "" && rec ==""){
                $('.error_id_chk').text('사용자 입력')
                $('.error_nn_chk').text('닉네임 입력')
                $('.error_code_chk').text('코드를 입력')
            }
            else if(code == "" && nick != "" && rec != ""){
                $('.error_id_chk').text('사용자 입력')
            }
            else if(code != "" && nick == "" && rec != ""){
                $('.error_nn_chk').text('닉네임 입력')
            }
            else if(code != "" && nick != "" && rec == ""){
                $('.error_code_chk').text('코드를 입력')
            }

            else if(code == "" && nick == "" && rec != ""){
                $('.error_id_chk').text('사용자 입력')
                $('.error_nn_chk').text('닉네임 입력')
            }
            else if(code == "" && nick != "" && rec == ""){
                $('.error_id_chk').text('사용자 입력')
                $('.error_code_chk').text('코드를 입력')
            }
            else if(code != "" && nick == "" && rec == ""){
                $('.error_nn_chk').text('닉네임 입력')
                $('.error_code_chk').text('코드를 입력')
            }
        }
    });

    function showLoader(){
        $(".loader").fadeIn("slow");
        $(".loader").show();
    }
    function hideLoader(){
        $(".loader").fadeOut("slow");
    }

    //load files
    check_account_exists();
    check_nickname_exists();
    check_code_exists();
    getBankList();
})