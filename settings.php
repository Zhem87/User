    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/privacy.js"
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

          
        .btn-betting{
            margin-top: 3%;
        }
        #btn_changepassword{
            background: #FF9300;
        }
        .btn-group{
            width: 100%;
        }
        .btn-group button {
            border: none;
            margin-top: 2%;
            font-family: 'Roboto';
            background-color: #888888;
            color: white;
            padding: 9px 15px; 
            cursor: pointer; 
            border: 0;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            float: left;
            height: 50px;
            margin-left: 1%;
        }

        input,
        input::-webkit-input-placeholder {
            font-size: 1rem;
        }
     
        .btn-group .privacy_info{
            margin-top: 2%;
            height: 50px;
            background: #EEEEEE;
            border-radius: 10px;
            margin-left: 5%;
            padding-left: 2%;
            border: none;
        }

        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }
        .btn-group button:not(:last-child) {
            border-right: none;
        }

        .btn-group1{
            width: 100%;
        }
        .btn-group1 button {
            border: none;
            margin-top: 2%;
            font-family: 'Roboto';
            background-color: #888888;
            color: white;
            padding: 9px 15px; 
            cursor: pointer; 
            border: 0;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 400;
            float: left;
            height: 50px;

        }
     
        .btn-group1 .privacy_info{
            margin-top: 2%;
            height: 50px;
            background: #EEEEEE;
            border-radius: 10px;
            margin-left: 2%;
            padding-left: 2%;
            border: none;
        }

        .btn-group1:after {
            content: "";
            clear: both;
            display: table;
        }
        .btn-group1 button:not(:last-child) {
            border-right: none;
        }
     

        body::-webkit-scrollbar{
            display: none;
        }
      
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 700px;
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
        .btn_id{
            background: #888888;
            border-radius: 10px;
            width: 154px;
            height: 44px;
            color: #FFFFFF;
            margin: 15% 5% 0%;

        }
        .btn_nickname{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;

        }
        .btn_currentpass{
            background: #888888;
            border-radius: 10px;
            width: 150px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 5%;
        }
        .btn_accountholder{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;
        }
        .btn_accountbank{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 4%;
        }
        .btn_accountnumber{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 3% 4%;
        }
        .btn_recommendedpoint{
            background: #888888;
            border-radius: 10px;
            width: 155px;
            height: 44px;
            color: #FFFFFF;
            margin: 0% 4%;
        }
       
       
        .accountid{
            width: 100%;
            height: 44px;
            border: none;
            margin: 15% 0% 0%;
            background: #EEEEEE;
        }
        
        .accountnickname{
            background: 
            width: 100%;
            height: 44px;
            border: none;
            margin: 3% 0% 0% 0%;
            background: #EEEEEE;
        }

        .accountholder{
            width: 100%;
            height: 44px;
            border: none;
            background: #EEEEEE;
            margin: 3% 0% 0% 0%;
        }
        .accountbank{
            width: 100%;
            height: 44px;
            border: none;
            margin: 0% 0% 0% 0%;
        }
        .accountno{
            width: 100%;
            height: 44px;
            border: none;
            margin: 3% 0% 0% 0%;
        }
        .recommendedpoint{
            width: 100%;
            height: 44px;
            border: none;
            margin: 0% 0% 0% 0%;
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
            font-weight: 700;
            font-size: 20px;
            color: #FF9300;
        }
        .input_amnt::placeholder{
            
        }
        .inline_grp{
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
            grid-template-columns: 30% 67%;
            padding: 10px 30px;
        }
        .currentAcmount{
            float: right;
            width: 80%;
            background: #EEEEEE;
            border-radius: 10px;
            height: 44px;
            border: none;
            color: #888888;
            font-size: 20px;
            text-align: right;
            padding: 7px 15px;
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
        }
     
        #modal-change_password .modal-footer{
            border-top: none;
        }
        #modal-change_password .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }
        
        #modal-change_password .message{
            color: #FFFFFF;
            font-size: 14px;
        }
        #modal-change_password .close{
            color: #FFFFFF;
            font-size: 25px;
        }

        

        #modal-change_password1 .modal-footer{
            border-top: none;
        }
        #modal-change_password1 .btn_alert{
            background: #1072BA;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            width: 150px;
            height: 44px;
            font-weight: 700;
            font-size: 24px;
            color: #FFFFFF;
        }
        
        #modal-change_password1 .message{
            color: #FFFFFF;
            font-size: 14px;
        }
        #modal-change_password1 .close{
            color: #FFFFFF;
            font-size: 25px;
        }

        #password_maintenance{
            position: absolute;
            width: 600px;
            height: 210px;
            left: 660px;
            top: 270px;
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            display:none;
        }

        .maintenance_details{
            width: 80%;
            height: 38px;
            top: 28px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 32px;
            line-height: 38px;
            color: #FFFFFF;
            margin: 10% 10%;
        }

        @media only screen and (max-width : 576px){
            #modal-change_password1 .modal-content {
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                width: 80%;
                margin-left: 3%;
            }
            #modal-change_password1 .modal-title {
                text-align: center;
                font-size: 1.8rem;
            }
            #modal-change_password1 .modal-footer .btn-user-orange {
                width: 90px;
                height: 40px;
                background: #FF9300;
                box-shadow: inset 2px 2px 4px rgb(0 0 0 / 25%);
                border-radius: 10px;
                font-size: 1rem;
                color: #FFFFFF;
            }
        }

        @media only screen and (max-width : 510px){
            #modal-change_password1 .modal-content {
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                width: 70%;
                margin-left: 4%;
            }
            #modal-change_password1 .btn-group1 button {
                height: 40px;
                font-size: .60rem;
            }
            #modal-change_password1 .modal-title {
                text-align: center;
                font-size: 1.5rem;
            }
        }

        @media only screen and (max-width : 460px){
            #modal-change_password1 .modal-content {
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                width: 60%;
                margin-left: 2%;
            }
            #modal-change_password1 .btn-group1 button {
                height: 40px;
                font-size: .50rem;
            }
        }

        @media only screen and (max-width : 390px){
            #modal-change_password1 .modal-header {
                border-bottom: none;
                height: 30px;
                float: right;
            }
            #modal-change_password1 .modal-content {
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                width: 55%;
                margin-left: 2%;
            }
            #modal-change_password1 .btn-group1 button {
                height: 40px;
                font-size: .50rem;
            }
            .container {
                width: 100%;
                padding-right: 0;
                padding-left: 0;
                margin-right: auto;
                margin-left: auto;
            }

        }




      

        @media only screen and (max-width : 360px){
            body{
                background: #393E46;
            }
           
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 100%;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 5%;
                font-size: 12px;
                letter-spacing: -3px;
            }
           
           
            #modal-change_password .modal-title{
                font-weight: 500;
                font-size: 2px;
                margin: -10%;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 12px;
        }

        }
        @media screen and (max-width : 1000px){
            .btn-group1 button {
                height: 40px;
                font-size: .80rem;
            }
            .btn-group1 .privacy_info {
                height: 40px;
                font-size: .80rem;
            }
            .page-deposit{
                padding: 20px 10%;
                width: 100%;
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 50px;
                height: 44px;
                font-size: 14px;
                margin-top: 6px;
                font-weight: 500;
                margin: 0% 0% 0% 2%;
            }
            .btn-group{
                margin: 0 10%;
                width: 75%;
            }
            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 154px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 5% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 0% 0% 0%;
               
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
            .accountid{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 15% 0% 0%;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 235px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                margin: 0% 0% 0% 5%;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
                font-weight: 700;
                font-size: 30px;
                margin: -10%;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 16px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 12px;
        }



        }
        @media screen and (min-width : 1001px){
            .page-deposit{
                padding: 20px 10%;
                width: 100%; 
            }
            .div_layout, .div_layout_note{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
           
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 100px;
                height: 44px;
                font-size: 14px;
                margin-top: 2px;
                margin: 0% 0% 0% 2%;
                font-weight: 600;
            }
            .btn-group{
                margin: 0 20%;
                width: 60%;
            }

            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 164px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 4% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 165px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
        
            .accountid{
                width: 100%;
                height: 44px;
                margin: 15% 0% 0%;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 700;
                border-radius: 8px;
                background: #DDDDDE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 420px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
                font-weight: 700;
            }
            #modal-change_password .modal-content{
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% -20%;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 1% -20%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 10px;
                    color: #FFFFFF;
                    width: 55%;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% -20%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 30%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 30%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 300px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 30%;
                    text-align:left;
            }
        


        }
        @media screen and (min-width : 1920px){
            .card-header{
                background: #393E46;
                text-align: center;
                color: #FFF200;
                font-size: 32px;
                line-height: 38px;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                border-radius: 10px 10px 00px 0px !important;
                height: 70px;
                padding-top: 20px;
            }
            .page-deposit{
                padding: 20px 20%;
                width: 100%; 
            }
            .div_layout{
                width: 100%;
                margin: 0 auto;
                grid-gap: 5px;
                grid-template-columns: 100%;
                padding-bottom: 30px;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 30%;
                height: 44px;
                font-size: 14px;
                margin-top: 2px;
                margin: 0% 0% 0% 2%;
                font-weight: 600;
            }
            .btn-group{
                margin: 0 20%;
                width: 60%;
            }
            .btn_id{
                background: #888888;
                border-radius: 10px;
                width: 154px;
                height: 44px;
                color: #FFFFFF;
                margin: 15% 4% 0%;
            }
            .btn_nickname{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 257px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 3% 4%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 155px;
                height: 44px;
                color: #FFFFFF;
                margin: 0% 4%;
            }
        
        
            .accountid{
                width: 100%;
                height: 44px;
                margin: 15% 0% 0%;
                border-radius: 8px;
                background: #EEEEEE;
                font-weight: 600;
            }
            
            .accountnickname{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
            }

            .accountholder{
                width: 100%;
                height: 44px;
                margin: 3% 0% 0% 0%;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
            }
            .accountbank{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 0% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 3% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 44px;
                font-weight: 600;
                border-radius: 8px;
                background: #EEEEEE;
                margin: 0% 0% 0% 0%;
            }


            .current_password{
                border-radius: 10px;
                width: 900px;
                height: 44px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 20px;
                color: #FF9300;
            }
            .input_amnt::placeholder{
                
            }

            #modal-change_password .modal-title{
           font-weight: 700;
        }
        #modal-change_password .modal-content{
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            
        }
        #modal-change_password .modal-header{
            border-bottom: none;
        }
        #modal-change_password .btn_currpassword{
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 4% -35%;
        }
        #modal-change_password .btn_newpassword{
                background: #888888;
                border-radius: 10px;
                color: #FFFFFF;
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 1% -35%;
                letter-spacing: -2px
              
        }
        #modal-change_password .btn_reenterpassword{
                background: #888888;
                border-radius: 10px;
                color: #FFFFFF;
                width: 55%;
                font-size: 20px;
                height: 40px;
                margin: 4% -35%;
                letter-spacing: -2px
        }
        #modal-change_password .textinput1{
                width: 300px;
                font-size: 20px;
                height: 40px;
                margin: 4% 45%;
                text-align:left;
                border-radius:10px;
        }
        #modal-change_password .textinput2{
                width: 300px;
                font-size: 20px;
                height: 40px;
                border-radius:10px;
                margin: 1% 45%;
                text-align:left;
        }
        #modal-change_password .textinput3{
                width: 300px;
                font-size: 20px;
                height: 40px;
                border-radius:10px;
                margin: 4% 45%;
                text-align:left;
        }
       

        }
        @media only screen and (min-width: 360px) and (max-width: 767px){
            .card-body {
                padding: 0.5rem;
            }
            body{
                background: #393E46;
            }
            .btn-group button {
                font-size: .60rem;
                height: 40px;
                margin-top: 1%;
            }
            .btn-group .privacy_info {
                margin-top: 1%;
                height: 40px;
                background: #EEEEEE;
                border-radius: 10px;
                margin-left: 5%;
                padding-left: 2%;
                font-size: .60rem;
                margin-left: 2%;
            }
            .page-deposit{
                padding: 22px;
                width: 100%; 
            }
            .current_stocks_mobile{
                font-size: 16px;
                font-family: Tahoma, sans-serif;
                font-weight: 600;
                height: 46px;
            }
            .current_stocks_mobile .current_stocks{
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 20px;
                line-height: 23px;
                color: #FFFFFF;
            }
            .dollar_mint{
                width: 32px;
                height: 32px;
                margin: 2%;
                
            }
            .footer_brand .footer_logo{
                font-size: 30px;
                font-weight: 600;
                margin-top: -30%;
                font-family: Tahoma, sans-serif;
            }
            .div_layout .card{
                height: 110%;
                margin-top: 0%;
            }
            .btn_changepassword{
                background: #FF9300;
                border-radius: 10px;
                width: 50px;
                height: 34px;
                font-size: .60rem;
                font-weight: 500;
                margin: 3% 3% 0%;
            }
            .btn-group{
                margin: 0% 0%;
                width: 100%;
            }
            .btn_id{
                font-size: 12px;
                background: #888888;
                border-radius: 10px;
                width: 82px;
                height: 34px;
                color: #FFFFFF;
                margin: 5% 5% 0;
            }
            .btn_nickname{
                background: #888888;
                font-size: 12px;
                border-radius: 10px;
                width: 84px;
                height: 34px;
                color: #FFFFFF;
                margin: 3% 5% 0;
            }
            .btn_currentpass{
                background: #888888;
                border-radius: 10px;
                width: 68px;
                font-size: 12px;
                height: 34px;
                color: #FFFFFF;
                margin: 3% 5%;
                font-align: center;
                letter-spacing: -2px;
            }
            .btn_accountholder{
                background: #888888;
                border-radius: 10px;
                font-size: 12px;
                width: 85px;
                height: 34px;
                color: #FFFFFF;
                margin: 0% 5%;
            }
            .btn_accountbank{
                background: #888888;
                border-radius: 10px;
                width: 85px;
                height: 34px;
                font-size: 12px;
                color: #FFFFFF;
                margin: 3% 5%;
            }
            .btn_accountnumber{
                background: #888888;
                border-radius: 10px;
                font-size: 12px;
                width: 81px;
                height: 34px;
                color: #FFFFFF;
                letter-spacing: -2px;
                margin: 0% 5%;
            }
            .btn_recommendedpoint{
                background: #888888;
                border-radius: 10px;
                width: 81px;
                height: 34px;
                color: #FFFFFF;
                font-size: 12px;
                letter-spacing: -2px;
                margin: 3% 5%;
            }
        
            
       
            .accountid{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 5% 0% 0%;
            }
            
            .accountnickname{
                width: 100%;
                font-size: 12px;
                height: 34px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
               
            }

            .accountholder{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 0% 0% 0% 0%;
            }
            .accountbank{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 3% 0% 0% 0%;
            }
            .accountno{
                width: 100%;
                font-size: 12px;
                height: 34px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 0% 0% 0% 0%;
            }
            .recommendedpoint{
                width: 100%;
                height: 34px;
                font-size: 12px;
                border-radius: 8px;
                background: #DDDDDE;
                font-weight: 700;
                margin: 3% 0% 0% 0%;
            }

            .current_password{
                border-radius: 10px;
                width: 100%;
                height: 34px;
                background: #EEEEEE;
                border: 0.5px solid #888888;
                box-sizing: border-box;
                box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px;
                font-weight: 700;
                font-size: 12px;
                color: #FF9300;
                margin: 3% 0% 3% 0%;
            }

            #modal-change_password .modal-title{
                font-weight: 700;
                font-size: 20px;
                margin: -10%;
            }
            #modal-change_password .modal-lg{
                width: 95%; 
            }
            #modal-change_password .modal-content{
                background: #393E46;
            }
            #modal-change_password .modal-header{
                border-bottom: none;
            }
            #modal-change_password .btn_currpassword{
                    width: 53%;
                    font-size: 12px;
                    height: 40px;
                    margin: 4% -25%;
                    border-radius: 5px;
            }
            #modal-change_password .btn_newpassword{
                    background: #888888;
                    border-radius: 5px;
                    color: #FFFFFF;
                    width: 85%;
                    font-size: 12px;
                    height: 40px;
                    margin: 1% -25%;
                    letter-spacing: -2px
                
            }
            #modal-change_password .btn_reenterpassword{
                    background: #888888;
                    border-radius: 5px;
                    color: #FFFFFF;
                    width: 85%;
                    font-size: 12px;
                    height: 40px;
                    margin: 4% -25%;
                    letter-spacing: -2px
            }
            #modal-change_password .textinput1{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    margin: 4% 35%;
                    text-align:left;
                    border-radius:10px;
            }
            #modal-change_password .textinput2{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 1% 35%;
                    text-align:left;
            }
            #modal-change_password .textinput3{
                    width: 170px;
                    font-size: 20px;
                    height: 40px;
                    border-radius:10px;
                    margin: 4% 35%;
                    text-align:left;
            }
        
            #modal-change_password .message{
            color: #FFFFFF;
            font-size: 10px;
            margin: 1%;
        }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- registration Section -->
    <div class="page-deposit">
        <div class="div_layout">
            <div class="card">
                <div class="card-header">
                개인정보 설정
                </div>
                <div class="card-body">
                    <div class="btn-betting">
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>아이디</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="accountid" placeholder="아이디" disabled>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>닉네임</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="accountnickname" placeholder="닉네임" disabled>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>비밀번호</button>
                                <input type="text" class="privacy_info" style="width: 56%;" name="current_password" id="" placeholder="********" disabled>
                                <button style="width: 18%;" id="btn_changepassword" type="button" style="background: #FF9300;">변경</button>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>예금주</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="accountholder" placeholder="홍 X 동" disabled>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>은행</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="bank" placeholder="길동은행" disabled>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>계좌번호</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="accountno" placeholder="123****567" disabled>
                            </div>
                            <div class="btn-group">
                                <button style="width: 25%;" type="button" disabled>추천지점</button>
                                <input type="text" class="privacy_info" style="width: 75%;" id="recommendedpoint" placeholder="강남점" disabled>
                            </div>
                           
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div id="password_maintenance">
            <p class="maintenance_details">수리 작업 중입니다! 나중에 다시 오시기 바랍니다. 고맙습니다</p>
    </div>


    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>
