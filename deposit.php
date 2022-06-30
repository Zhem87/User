
    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js",
            "https://momentjs.com/downloads/moment-timezone-with-data.min.js",
            "assets/js/deposit.js"
        );
    ?>
    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
    <?php
        if(!$user->is_logged_in()){
            $user->redirect('./');
        }
    ?>
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
        .page-deposit{
            width: 100%;
            padding: 20px 250px;
        }
      
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 10px 10px;
            height: 345px;
        }
        .card{
            width: 95%;
            margin-left: 2%;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 32px;
            line-height: 38px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            border-radius: 10px 10px 0px 0px !important;
        }
        .div_layout, .div_layout_note{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 5px;
            grid-template-columns: 50% 5% 50%;
            padding-bottom: 30px;
        }
        .div_layout .arrow_icon{
            padding: 10px;
            margin-top: auto;
            margin-bottom: auto;
        }
        .div_layout_note .card-header{
            background: #DDDDDE;
            color: #333333;
        }
        .btn_accountno,.btn_accountholder,.btn_amount{
            background: #888888;
            border-radius: 10px;
            width: 140px;
            height: 44px;
            color: #FFFFFF;
        }
        .accountno,.accountholder{
            background: #EEEEEE;
            border-radius: 10px;
            width: 100%;
            height: 44px;
            border: none;
        }
        .input_amnt{
            border-radius: 10px;
            width: 100%;
            height: 44px;
            background: #EEEEEE;
            border: 0.5px solid #888888;
            box-sizing: border-box;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            text-align: right;
            font-weight: 700;
            font-size: 20px;
            color: #FF9300;
        }
        .input_amnt::placeholder{
            text-align: right;
            color: #FF9300;
        }
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 30% 67%;
            padding: 10px 30px;
        }
        .btn_deposit{
            background: #FF9300;
            border-radius: 10px;
            width: 140px;
            height: 50px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 16px;
            margin-top: 20px;
            font-weight: 700;
        }
        .currentAcmount{
            float: right;
            width: 80%;
            background: #EEEEEE;
            height: 44px;
            border: 1px;
            color: #888888;
            font-size: 20px;
            text-align: right;
            padding: 7px 15px;
            border: 0.5px solid #888888;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px
        }
        .ntitle{
            width: 100%; 
            font-weight: 700;
            font-size: 20px;
        }
        .ntitleacc{
            width: 100%; 
            padding-top: 20px; 
            color: #1F8FAE; 
            font-weight: 700;
            font-size: 20px;
        }
        ol {
            padding: 5px 15px;
            counter-reset: item;
            list-style-type: none;
        }
        ol li:before {
            content: counter(item, decimal) '. ';
            counter-increment: item;
        }
        ol li{
            margin-bottom: 10px;
            color: #545454;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
        }
        .arrow_down_orange{
            display: none;
        }
        .arrow_left_orange{
            display: block;
        }
        .currentAcmount{
            color: #1F8FAE;
            font-weight: 700;
            font-size: 20px;
            border: 0.5px solid #888888;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px
        }
        #modal-deposit_alert,#modal-deposit_submit{
            padding: 200px 100px;
        }
        #modal-deposit_alert .modal-content,#modal-deposit_submit .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            text-align: center;
        }
        #modal-deposit_alert .modal-header,#modal-deposit_submit .modal-header{
            border-bottom: none;
        }
        #modal-deposit_alert .modal-footer,#modal-deposit_submit .modal-footer{
            border-top: none;
        }
        #modal-deposit_alert .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }

        #modal-deposit_alert_30sec,#modal-deposit_submit{
            padding: 200px 100px;
        }
        #modal-deposit_alert_30sec .modal-content,#modal-deposit_submit .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            text-align: center;
        }
        #modal-deposit_alert_30sec .modal-header,#modal-deposit_submit .modal-header{
            border-bottom: none;
        }
        #modal-deposit_alert_30sec .modal-footer,#modal-deposit_submit .modal-footer{
            border-top: none;
        }
        #modal-deposit_alert_30sec .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }

        #modal-deposit_alert_success,#modal-deposit_submit{
            padding: 200px 100px;
        }
        #modal-deposit_alert_success .modal-content,#modal-deposit_submit .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            text-align: center;
        }
        #modal-deposit_alert_success .modal-header,#modal-deposit_submit .modal-header{
            border-bottom: none;
        }
        #modal-deposit_alert_success .modal-footer,#modal-deposit_submit .modal-footer{
            border-top: none;
        }
        #modal-deposit_alert_success .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }


        #modal-deposit_submit .btn_deposit_save{
            background: #FF9300;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            font-weight: 700;
            font-size: 24px;
            padding: 10px 20px;
            width: 150px;
            color: #FFFFFF;
        }
        #modal-deposit_submit .message{
            color: #FFFFFF;
            font-size: 28px;
        }
        #modal-deposit_alert .close,#modal-deposit_submit .close{
            color: #FFFFFF;
            font-size: 25px;
        }
        #modal-deposit_submit .btn_amount{
            width: 120px;
        }
        @media only screen and (min-width : 768px) and (max-width : 991px){

            .page-deposit {
                width: 100%;
                padding: 20px 40px;
                margin-left: -20px;
            }
            .card-body {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 5px;
            }
            .btn_accountno, .btn_accountholder, .btn_amount {
                background: #888888;
                border-radius: 10px;
                width: 112%;
                height: 44px;
                color: #FFFFFF;
                margin-left: 0;
                font-size: 12px;
                text-align: center;
            }
            .inline_grp {
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 1rem;
                grid-template-columns: 20% 76%;
                padding: 10px 8px;
            }
            .div_layout, .div_layout_note {
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 50% 4% 50%;
                padding-bottom: 30px;
            }
            .card {
                width: 100%;
                margin-left: 0;
            }
            .arrow_left_orange {
                display: block;
                margin-left: -8px;
            }
            .accountno, .accountholder {
                background: #EEEEEE;
                border-radius: 10px;
                width: 100%;
                height: 44px;
                border: none;
                font-size: 12px;
            }
            .card-header {
                background: #393E46;
                text-align: center;
                color: #FFF200;
                font-size: 22px;
                line-height: 38px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                height: 50px;
                border-radius: 10px 10px 0px 0px !important;
            }
            .input_amnt {
                border-radius: 10px;
                width: 100%;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgb(0 0 0 / 25%);
                border-radius: 10px;
                text-align: right;
                font-weight: 700;
                font-size: 14px;
                color: #FF9300;
            }
            .btn_deposit {
                background: #FF9300;
                border-radius: 10px;
                width: 120px;
                height: 40px;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                padding: 8px 16px;
                margin-top: 10px;
                font-weight: 700;
                font-size: 14px;
            }

            .ntitle {
                width: 100%;
                font-weight: 700;
                font-size: 18px;
                padding: 10px 10px;
            }
            .ntitleacc {
                width: 100%;
                padding-top: 20px;
                color: #1F8FAE;
                font-weight: 700;
                font-size: 18px;
                padding: 20px 10px 0px;
            }
            .cash_balance {
                font-size: 16px;
            }
            .currentAcmount {
                color: #1F8FAE;
                font-weight: 700;
                font-size: 16px;
                border: 0.5px solid #888888;
                box-shadow: 4px 4px 4px rgb(0 0 0 / 25%);
                border-radius: 10px;
            }
            ol li {
                margin-bottom: 10px;
                color: #545454;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 13px;
                letter-spacing: 1px;
            }

            .div_layout .card, .div_layout_note .card {
                box-shadow: 2px 0px 4px rgb(0 0 0 / 25%);
                border-radius: 10px 10px 10px 10px;
                height: 100%;
            }
        }


        @media only screen and (min-width : 360px) and (max-width : 767px){
            body{
                background: #393E46;
            }
            .page-deposit{
                padding: 10px 0px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .div_layout, .div_layout_note{
                grid-template-columns: 100%;
            }
            .div_layout .card{
                height: 100%;
            }
            .div_layout_note .card{
                height: 100%;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 90%;
                margin-left: -15px;
                height: 90%;
                font-size: 12px;
            }
            .accountno,.accountholder{
                background: #EEEEEE;
                border-radius: 10px;
                width: 110%;
                height: 44px;
                border: none;
                font-size: 10px;
                margin-left: -20px;

            }
            .btn_deposit {
                background: #FF9300;
                border-radius: 10px;
                width: 50%;
                height: 40px;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                padding: 8px 16px;
                margin-top: 10px;
                font-weight: 700;
                font-size: 14px;

            }
            .input_amnt{
                width: 110%;
                margin-left: -20px;
            }
            .div_layout .arrow_icon{
                padding: 10px;
                margin-left: auto;
                margin-right: auto;
            }
            .ntitle {
                width: 100%;
                font-weight: 700;
                font-size: 16px;
            }
            .ntitleacc {
                width: 100%;
                padding-top: 10px;
                color: #1F8FAE;
                font-weight: 700;
                font-size: 16px;
            }
            .currentAcmount {
                color: #1F8FAE;
                font-weight: 700;
                font-size: 16px;
                border: 0.5px solid #888888;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px
            }
            .div_layout .arrow_down_orange{
                display: block;
            }
            .div_layout .arrow_left_orange{
                display: none;
            }
            ol li{
                font-size: 14px;
                line-height: 20px;
            }
            #modal-deposit_alert,#modal-deposit_submit{
                padding: 200px 20px;
            }
            #modal-deposit_alert .modal-notif-title,#modal-deposit_submit .modal-notif-title{
                font-size: 20px;
            }
            #modal-deposit_alert .modal-notif-body,#modal-deposit_submit .modal-notif-body{
                font-size: 16px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 5px 5px;
            }
            #modal-deposit_submit .modal-body{
                padding: 5px 5px;
            }
            #modal-deposit_submit .btn_amount{
                width: 80px;
            }
            #modal-deposit_submit .message{
                font-size: 16px;
            }
            #modal-deposit_submit .btn_deposit_save{
                padding: 10px 20px;
                font-size: 18px;
                width: 100px;
                height: 42px;
            }
        }
     
        @media screen and (min-width : 992px){
            .page-deposit{
                padding: 30px 50px;
                width: 100%;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 48% 5% 46%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 100%;
                padding: 5px 5px;
            }
            ol li{
                font-size: 16px;
                line-height: 20px;
            }
        }
        @media screen and (min-width : 1200px){
            .page-deposit{
                padding: 30px 100px;
                width: 100%;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 48% 5% 46%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 100%;
                padding: 5px 5px;
            }
            ol li{
                font-size: 16px;
                line-height: 20px;
            }
        }
        
        @media screen and (min-width : 1440px){
            .page-deposit{
                padding: 30px 200px;
                width: 100%;
            }
        }
        
        @media screen and (min-width : 1200px) and (max-width : 1439px){
            .page-deposit{
                padding: 30px 80px;
                width: 100%;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 48% 5% 46%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .inline_grp{
                grid-template-columns: 30% 67%;
                padding: 10px 5px;
            }
            .btn_accountno,.btn_accountholder,.btn_amount{
                width: 100%;
                padding: 5px 5px;
            }
            ol li{
                font-size: 16px;
                line-height: 20px;
            }
        }

        

        @media screen and (min-width : 1920px){
            .page-deposit{
                padding: 20px 350px;
                width: 100%;
                letter-spacing: 1.5px;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                display: grid;
                grid-gap: 5px;
                grid-template-columns: 50% 4% 46%;
                padding-bottom: 30px;
            }
        }
       
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <?php
        if(count($_SESSION)){
            echo '
                <div class="current_stocks_mobile">
                    <a href="#"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span> 원</span></a>
                </div>'
            ;
        }
    ?>

    <!-- registration Section -->
    <div class="page-deposit">
        <div class="div_layout">
            <div class="card">
                <div class="card-header">
                    입금 신청하기
                </div>
                <div class="card-body">
                    <div class="inline_grp">
                        <button class="btn btn_accountno" type="button">입금 계좌</button>
                        <input type="text" disabled class="accountno" placeholder="  입금 계좌는 고객센터로 문의주시기 바랍니다.">
                    </div>
                    <div class="inline_grp">
                        <button class="btn btn_accountholder" type="button">예금주</button>
                        <input type="text" disabled class="accountholder form-control" placeholder="입금 계좌는 고객센터로 문의주시기 바랍니다.">
                    </div>
                    <div class="inline_grp">
                        <button class="btn btn_amount" type="button">입금신청</button>
                        <input type="text" id="depositamount" name="depositamount" class="input_amnt form-control" placeholder="원">
                    </div>
                    <center><button class="btn btn_deposit" type="button">입금 신청하기</button></center>
                </div>
            </div>
            <div class="arrow_icon">
                <img src="assets/icons/arrow_down_orange.png" alt="arrow" class="arrow_down_orange">
                <img src="assets/icons/arrow_left_orange.png" alt="arrow" class="arrow_left_orange">
            </div>
            <div class="card">
                <div class="card-header">
                    보유 금액
                </div>
                <div class="card-body">
                    <label class="ntitle">현재 보유 금액</label>
                    <div class="currentAcmount" style="color: #888888;"><span class="cash_balance" id="cashb"></span> 원</div>
                    <label class="ntitleacc">입금 후 예상 보유 금액</label>
                    <div class="currentAcmount"><span class="new_balance"></span> 원</div>
                </div>
            </div>
        </div>
        <div class="div_layout_note">
            <div class="card">
                <div class="card-header">
                    입금신청 이용방법
                </div>
                <div class="card-body">
                    <ol>
                        <li>고객센터를 통해 입금계좌 정보 문의하기</li>
                        <li>답변받은 입금계좌로 충정하실 금액을 입금</li>
                        <li>상단의 “입금 신청하기”를 이용하여, 입금하신 금액 입력 후 입금 신청하기 버튼을 클릭.</li>
                    </ol>
                </div>
            </div>
            <div class="arrow_icon"></div>
            <div class="card">
                <div class="card-header">
                    주의사항
                </div>
                <div class="card-body">
                    <ol>
                        <li>입금 신청 대상자는 가입 시 본인인증을 통해 입력한 고객명을 기준으로 표시됩니다.</li>
                        <li>본인의 보유액을 다른 회원에게 양도 및 양수 할 수 없습니다.</li>
                        <li>고객 ID, 고객명은 수정되지 않습니다. 단, 개명을 하신 경우 고객센터로 문의주시기 바랍니다.</li>
                        <li>빠른 업무 처리를 위해 반드시 입금 완료 후 입금 신청을 해주시기 바랍니다. 미입금상태에서 입금요청시 입금처리가 늦어질 수 있습니다.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>