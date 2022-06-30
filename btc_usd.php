<!-- header html -->
<?php
    $linkcss = array(
        "plugins/jquery-confirm-3.3.2/css/jquery-confirm.min.css",
    );
    $scriptjs = array(
        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js",
        "https://momentjs.com/downloads/moment-timezone-with-data.min.js",
        "https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js",
        "plugins/jquery-confirm-3.3.2/js/jquery-confirm.min.js",
        "assets/js/admin/candle_chart.js",
        "assets/js/admin/betting.js",
        "assets/js/register.js",
    );

?>
<?php include __DIR__ . '/includes/head_html.php';?>
<?php
    if(!$user->is_logged_in()){
        $user->redirect('./');
    }
?>
    <style>
      
        
        .btn-betting{
            margin-top: 5px;
            position: relative;
        }
        .disabler{
            width: 100%;
            height: 100%;
            background: #c4c4c4;
            opacity: .5;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            display: none;
        }
        .btn-group{
            width: 100%;
        }
        .btn-group button {
            font-family: 'Roboto';
            background-color: #2b3257;
            color: white;
            border: .5px solid #ffffff;
            padding: 9px 15px; 
            cursor: pointer; 
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            float: left;
        }
        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }
        .btn-group button:not(:last-child) {
            border-right: none;
        }
     
        #tradingview_9a3a8{
            height: 500px;
        }

        .user_field_group {
            height: 541px;
        }
  
        .page_btc{ 
            width: 96%;
            margin-left: 2%;
        }
        .nav-item {
            padding-right: 6px;
        }

        .betting_details{
            height: 550px;
        }
        .game_details{
            height: 100%;
        }
        .game_details1{
            height: 100%;
        }

        
        #my_popup{
            z-index: 20;
            position: absolute;
            width: 600px;
            height: 200px;
            left: 660px;
            top: 270px;
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            display:none;
        }

        .success-btc{
            z-index: 20;
            width: 100%;
            height: 38px;
            top: 28px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 32px;
            line-height: 38px;
            color: #FFFFFF;
            margin: 10% 30%;
        }

        #my_popup_failed{
            z-index: 20;
            position: absolute;
            width: 600px;
            height: 200px;
            left: 660px;
            top: 270px;
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            display:none;
        }

        .failed-btc{
            z-index: 20;

            width: 100%;
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

        #minimum_transaction{
            z-index: 20;

            position: absolute;
            width: 600px;
            height: 200px;
            left: 660px;
            top: 270px;
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            display:none;
        }

        .minimum_transaction-btc{
            z-index: 20;
            width: 100%;
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

        #maximum_transaction{
            z-index: 20;

            position: absolute;
            width: 600px;
            height: 200px;
            left: 660px;
            top: 270px;
            background: #393E46;
            border: 4px solid #B4BAC8;
            box-sizing: border-box;
            border-radius: 10px;
            display:none;
        }

        .maximum_transaction-btc{
            z-index: 20;
            width: 100%;
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

        .navbar-collapse-1-mobile{
            padding: 200px 20px 0 20px;
        }
       
        .chr{
            width: 100% !important;
            height:600px !important;
        }
        .timeclock{
            color: #FF9300;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            padding-left: 30px;
        }
        .container_chart {
            position: relative;
            text-align: center;
            border-radius: 0px 0px 10px 10px;
        }
        .cont_opacity{
            background: rgb(0,0,0,0.7);
        }
        /* .display_result{
            display: none;
        } */

        .result_new{
            position: inherit;
            top: 0;
        }
        .nav-pills { 
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-gap: 0rem;
            height: 40px;
            grid-template-columns: 52% 50%;
        }
        .nav-pills .nav-link{
            font-weight: bold;
            padding-top: 13px;
            text-align: center;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            height: 48px;
        }
        .nav-pills .result{
            background: #888888;
            color: #FFFFFF;
            font-size: 20px;
            
        }
        .nav-pills .result.active{
            background: #393E46;
            color: #FFF200;
            font-size: 20px;
            
        }
        .nav-pills .history{
            background: #888888;
            color: #FFFFFF;
            font-size: 20px;
            
        }
        .nav-pills .history.active{
            background: #393E46;
            color: #FFF200;
            font-size: 20px;
            
        }
        .btc_header_trade .nav-pills .nav-item .nav-link:hover::after {
            transform: scaleX(0);
        }
        .tab-content{
            width: 100%;
            height: auto;
        }
        .tab-pane{
            margin-top: -19px; 
            margin-left: -19px; 
            margin-right: -19px; 
            margin-bottom: -30px; 
        }
        .tab-pane table th,.tab-pane table td{
            height: 36px;
            text-align: center;
            font-weight: 700;
            font-size: .80rem;
        }
        .tab-pane table th{
            background: #DDDDDE;
        }
        #result table {
            border-collapse: collapse;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .card-body{
            height: 576px;
            overflow: auto;
        }
        .container_data{
            height: 576px;
            margin: 0;
        }
       
        .trend_output{
            border-radius: 100px;
            color: #FFFFFF;
            width: 40px;
            height: 40px;
            margin: 3px;
            padding: 0;
            text-align: center;
            font-size: 12px;
        }
        p{
            margin-top: 0;
            margin-bottom: 1px;
        }
        .cards_result {
            --visible-cols: 10;
            --col-gap: 20px;
            --col-hint: 0px;
            --scrollbar-padding: 0%;
            --col-size: calc((100% / var(--visible-cols)) - var(--col-gap) - var(--col-hint));
            display: grid;
            grid-auto-flow: column;
            grid-template-columns: var(--col-size);
            grid-auto-columns: var(--col-size);
            overflow-x: auto;
            overflow-y: auto;
            grid-gap: var(--col-gap);
            padding-bottom: var(--scrollbar-padding);
            direction: lft;
            height: 540px;
        }
        @media only screen and (min-width: 1701px) and (max-width: 1920px){
            .nav-item {
                padding-right: 0px;
            }
            .result_bg{
            background: #333333; 
            opacity: .7;
            height: 119%;
        }
            .page_btc{ 
                width: 100%;
                margin: auto;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: .9rem;
            }
            
            #history_data {
                width: 95%;
                font-size: 18px;
                margin-left: 3px;
            }
            .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                margin-top: -2%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_red{
                width: 51%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_blue{
                width: 52%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_max{
                background: #2B3257;
                width: 104.3%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                margin-top: -2%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -5px;
            }
            .bet_reset{
                margin-left: -2%;
                margin-top: -2%;
                width: 104.5%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }
            
        }

        @media only screen and (min-width: 1601px) and (max-width: 1700px){
            .result_bg{
            background: #333333; 
            opacity: .7;
            height: 119%;
        }
            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -10%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -10%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -10%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }


            .nav-item {
                padding-right: 0px;
            }
            .page_btc{ 
                width: 85%;
                margin: auto;
            }
              .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_red{
                width: 50%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_blue{
                width: 53%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_max{
                background: #2B3257;
                width: 103.8%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -5px;
            }
            .bet_reset{
                margin-left: -2%;
                margin-top: -2%;
                width: 104%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                border-radius: 5px;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: 1rem;
            }

        }


        @media only screen and (min-width: 1224px) and (max-width: 1600px){
            .result_bg{
            background: #333333; 
            opacity: .7;
            height: 119%;
        }

            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -30%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -30%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -30%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 3%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }

            .nav-item {
                padding-right: 0px;
            }
            .page_btc{ 
                width: 90%;
                margin: auto;
            }
            .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_red{
                width: 50%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_blue{
                width: 53%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_max{
                background: #2B3257;
                width: 104%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -5px;
            }
            .bet_reset{
                margin-left: -1.5%;
                margin-top: -2%;
                width: 104%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }
              .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: .8rem;
            }
            
        }


        @media only screen and (min-width: 1080px) and (max-width: 1180px){
            .result_bg{
            background: #333333; 
            opacity: .7;
            height: 119%;
        }

            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: 13px;
            }
            .nav-item {
                padding-right: 0px;
            }
        }


        @media only screen and (min-width: 1000px) and (max-width: 1224px){
            .result_bg{
            background: #333333; 
            opacity: .7;
            height: 119%;
        }
            .text_result {
                background: transparent;
            }
            
            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -40%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -40%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -40%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            .nav-item {
                padding-right: 0px;
            }
            .nav-pills .result {
                font-size: 14px;
            }
            .nav-pills .result.active {
                font-size: 14px;
            }
            .tab-pane table th {
                background: #DDDDDE;
                font-size: 12px;
            }
            #history_data {
                font-size: 14px;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: .6rem;
            }
            .fchild, .lchild {
                font-size: 14px;
            }
            .cash_balance {
                font-size: 14px;
            }

            .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_red{
                width: 50%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_blue{
                width: 53%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_max{
                background: #2B3257;
                width: 104%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -5px;
            }
            .bet_reset{
                margin-left: -1.8%;
                margin-top: -2%;
                width: 104%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }
            
        }

        @media only screen and (min-width: 901px) and (max-width: 1000px){
            .text_result {
                background: transparent;
            }
            
            .btn-group button {
                font-family: 'Roboto';
                background-color: #2b3257;
                color: white;
                border: .5px solid #ffffff;
                padding: 9px 15px; 
                cursor: pointer; 
                border-radius: 5px;
                font-size: 1rem;
                font-weight: 600;
                float: left;
                line-height: 20px;
            }

            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -50%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -50%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 40%;
                height: 100px;
                margin-left: -50%;
                top: 30%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 4%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }



            .nav-item {
                padding-right: 0px;
            }
            .nav-pills .result {
                font-size: 14px;
            }
            .nav-pills .result.active {
                font-size: 14px;
            }
            .tab-pane table th {
                background: #DDDDDE;
                font-size: 12px;
            }
            #history_data {
                font-size: 14px;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: .60rem;
            }
            .fchild, .lchild {
                font-size: 14px;
            }
            .cash_balance {
                font-size: 20px;
            }

            .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                font-size: 14px;
                margin-top: -2%;
                text-align: center;
            }
            .bet_red{
                width: 50%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_blue{
                width: 53%;
                height: 40px;
                font-size: 16px;
                margin-top: -2%;
            }
            .bet_max{
                background: #2B3257;
                width: 104%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 5px;
                margin-top: -2%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -5px;
            }
            .bet_reset{
                margin-left: -1.8%;
                margin-top: -2%;
                width: 104%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }
        }

        @media only screen and (min-width: 600px) and (max-width: 900px){

            .text_result {
                background: transparent;
            }

            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 77%;
                height: 100px;
                left: auto;
                right: auto;
                top: 60%;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 77%;
                height: 100px;
                left: auto;
                right: auto;
                top: 600px;
                background: #393E46;
                border: 2px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 77%;
                height: 100px;
                left: auto;
                right: auto;
                top: 600px;
                background: #393E46;
                border: 2px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1.5rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }


            #tradingview_9a3a8{
                height: 100%;
                width: 100%;
            }
            .nav-item {
                padding-right: 0px;
            }
            .game_title {
                text-align: center;
                width: 100%;
            }
            .user_field_group {
                height: 450px;
            }
            /* .betting_details {
                height: 550px;
                margin-left: 5%;
            } */
            .page_btc{ 
                width: 90%;
                margin: auto;
            }
            .fchild, .lchild {
                font-size: 12px;
            }
            .cash_balance {
                font-size: 14px;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: 10px;
            }
            #history_data {
                width: 96%;
                font-size: 13px;
                margin-left: 3px;

            }
            .nav-pills .result.active {
                font-size: 14px;
            }
            .nav-pills .result {
                font-size: 14psx;
            }
            .bet_orange1{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1px;
                margin-top: 0%;
                margin-left: -3%;
                font-size: 14px;
                text-align: center;
            }
            .bet_orange2{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1px;
                font-size: 14px;
                margin-top: 0%;

                text-align: center;
            }
            .bet_orange3{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange4{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1.5px;
                margin-top: 0%;
                font-size: 14px;
                margin-left: -3%;
                text-align: center;
            }
            .bet_orange5{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1.5px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_orange6{
                background: #2B3257;
                width: 34%;
                height: 40px; 
                color: #EEEEEE;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1px;
                font-size: 14px;
                margin-top: 0%;
                text-align: center;
            }
            .bet_red, .bet_blue{
                width: 51%;
                height: 40px;
                font-size: 16px;
                margin-top: 0;
            }
            .bet_max{
                background: #2B3257;
                width: 103%;
                height: 40px; 
                margin: 0%;
                color: #EEEEEE;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                border-radius: 1px;
                margin-top: 0%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                margin-left: -8px;
            }
            .bet_reset{
                margin-left: -2%;
                margin-top: 0%;
                width: 104%;
                height: 40px; 
                color: #FFFFFF;
                background: #4A4A4A;
                border: 1px solid #434242;
                box-sizing: border-box;
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
            }
            .user_field_group {
                height: 540px;
            }

            .nav-pills .result {
                font-size: 16px;
            }
            #history_data {
                font-size: 16px;
            }
            .nav-pills .result.active {
                font-size: 16px;
            }
            .tab-pane table th, .tab-pane table td {
                height: 36px;
                text-align: center;
                font-weight: 700;
                font-size: 14px;
            }
            .fchild, .lchild {
                font-size: 14px;
            }
            .cash_balance {
                font-size: 16px;
            }

            }   
        @media only screen and (min-width: 360px) and (max-width: 600px){
            .text_result {
                background: transparent;
            }
  
            .nav-item {
                padding-right: 0px;
            }

            #my_popup, #my_popup_failed{
                z-index: 20;
                position: absolute;
                width: 80%;
                height: 100px;
                left: 40px;
                top: 600px;
                background: #393E46;
                border: 4px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            
            .success-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
             .failed-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #minimum_transaction {
                z-index: 20;
                position: absolute;
                width: 80%;
                height: 100px;
                left: auto;
                right: auto;
                top: 600px;
                background: #393E46;
                border: 2px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .minimum_transaction-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }
            #maximum_transaction {
                z-index: 20;
                position: absolute;
                width: 80%;
                height: 100px;
                left: auto;
                right: auto;
                top: 600px;
                background: #393E46;
                border: 2px solid #B4BAC8;
                box-sizing: border-box;
                border-radius: 10px;
                display: none;
            }
            .maximum_transaction-btc{
                margin-top: 7%;
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                font-size: 1rem;
                line-height: 38px;
                color: #FFFFFF;
                margin-left: 0;
                margin-right: 0;
                text-align: center;
            }


            body{
                background: #393E46;
            }
            #tradingview_9a3a8{
                height: 100%;
            }
            .candle_chart_field .candle_chart{ 
                height: 150px;
            }
            .game_details{
                height: 100%;
            }
            .table-bordered thead th, .table-bordered thead td {
                border-bottom-width: 2px;
                font-size: 10px;
            }
            .table-bordered th, .table-bordered td {
                border: 1px solid #dee2e6;
                font-size: 10px;
            }
            .game_details1{
                height: 60%;
            }
            .user_title{
                margin-top: -250px;
                margin-bottom: 8px;
            }
            #history_data{
                margin-left: 2px;
            }
           
            .user_time{
                font-size: 12px;
            }
            .user_trend{
                font-size: 12px;
            }
            .user_amount{
                font-size: 12px;
            }
            .user_result{
                font-size: 12px;
            }
            .user_result_header{
                font-size: 14px;
            }
            .binance_result{
                font-size: 13px;
            }
            .binance_result_header{
                font-size: 14px;
            }
            .cards_result {
                --visible-cols: 10;
                --col-gap: 20px;
                --col-hint: 0px;
                --scrollbar-padding: 0%;
                --col-size: calc((100% / var(--visible-cols)) - var(--col-gap) - var(--col-hint));
                display: grid;
                grid-auto-flow: column;
                grid-template-columns: var(--col-size);
                grid-auto-columns: var(--col-size);
                overflow-x: auto;
                overflow-y: auto;
                grid-gap: var(--col-gap);
                padding-bottom: var(--scrollbar-padding);
                direction: lft;
                height: 440px;
            }
            .user_field_group {
                height: 450px;
                margin-bottom: 250px;
            }



        }

       
        
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- header -->
    <?php
        if(count($_SESSION)){
            echo '
                <div class="current_stocks_mobile">
                    <a href="#"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance" id="cashb"></span> 원</span></a>
                </div>'
            ;
        }

        
    ?>
         
    <!-- btc Section -->
    <div class="page_btc">
        <div class="game_grid">
            <div class="game_details">
                <div class="game_title">
                    비트코인 BTC / USD 1분
                    <span class="game_title_timer">남은 거래 시간 : <span class="initializeTime"><span class="timeclock"></span></span></span>
                </div>
                <div class="game_field" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); border-radius: 0px 0px 5px 5px;">
                        <div id="tradingview_9a3a8">
                            <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                            <script type="text/javascript">
                            new TradingView.widget(
                            {
                                "autosize": true,
                                "symbol": "BINANCE:BTCUSDT",
                                "interval": "1",
                                "timezone": "Asia/Seoul",
                                "theme": "light",
                                "style": "1",
                                "locale": "kr",
                                "toolbar_bg": "#f1f3f6",
                                "hide_top_toolbar": true,
                                "enable_publishing": false,
                                "allow_symbol_change": true,
                                "save_image": false,
                            }
                            );
                            </script>
                        </div>
                        <div class="candle_chart_field">
                            <div id="candle_chart" style="width: 1px; height: 1px; background: #000000; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); border-radius: 0px 0px 5px 5px;"></div>
                        </div>
                   
                    <div class="text_result">
                        <div class="result_bg"></div>
                        <div class="result_new">
                            <p class="result_title">거래 결과</p>
                            <div class="result_field">
                                    <table class="result_table">
                                        <tr>
                                            <td style="border-radius: 8px;" class="rfchild">거래 결과</td>
                                            <td class="rmid"></td>
                                            <td style="border-radius: 8px;" class="rlchild time_result"></td>
                                        </tr>
                                        <tr style="height: 10px;"><td></td></tr>
                                        <tr>
                                            <td style="border-radius: 8px;" class="rfchild">결정가격</td>
                                            <td class="rmid"></td>
                                            <td style="border-radius: 8px;" class="rlchild price_result"></td>
                                        </tr>
                                    </table>
                                <p id="text_title_result"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div>남은 거래 시간 : <span class="initializeTime"><span class="mtimeclock"></span></span></div>
                </div>
            </div>
            <div class="betting_details">
                <div class="betting_title">
                    TRADING
                </div>
                <div class="betting_field">
                    <table class="betting_table">
                        <tr>
                            <td class="fchild">계약시간</td>
                            <td class="lchild" id="datetoday"></td>
                        </tr>
                        <tr>
                            <td class="fchild">투자종목</td>
                            <td class="lchild">BTC/USD 1분</td>
                        </tr>
                        <tr>
                            <td class="fchild">실현실격</td>
                            <td class="lchild"><img src="assets/icons/ic_baseline-plus-minus.png"> 1 USD</td>
                        </tr>
                        <tr>
                            <td class="fchild">보유금액</td>
                            <td class="lchild cblance"><span class="cash_balance"></span> 원</td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td class="fchild fchild1" style="padding-top: 13px;">예상실현금액</td>
                            <td class="lchild" style="padding-top: 13px;"><input type="text" placeholder="0" id="totalBetAmount" disabled></td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td colspan="2" id="multiplier" class="lchild acomp">-</td>
                        </tr>
                        <tr style="background: #DDDDDE;">
                            <td class="fchild fchild1">체결거래금액</td>
                            <td class="ablchild">
                                <input type="text" placeholder="0" id="betAmount" class="betAmount">
                                <span class="bchild">최소거래금액 :</span>
                                <span id="minimum_bet" class="bchild pull-right">-</span><br>
                            </td>
                        </tr>
                    </table>
                    <div class="btn-betting">
                        <div class="disabler"></div>
                            <div class="btn-group">
                                <button type="button" class="btn_dis" id="bet10k" style="width: 33.33%;">1 만</button>
                                <button type="button" class="btn_dis" id="bet50k" style="width: 33.33%;">5 만</button>
                                <button type="button" class="btn_dis" id="bet100k" style="width: 33.33%;">10 만</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn_dis" id="bet500k" style="width: 33.33%;">50 만</button>
                                <button type="button" class="btn_dis" id="bet1m" style="width: 33.33%;">100 만</button>
                                <button type="button" class="btn_dis" id="bet5m" style="width: 33.33%;">500 만</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn_dis" id="max" style="width: 99.99%;">MAX</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn_dis" id="buyBtn" style="width: 49.995%; background: #E32529;">매수</button>
                                <button type="button" class="btn_dis" id="sellBtn" style="width: 49.995%; background: #2855AD;">매도</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn_dis" id="reset" style="width: 99.99%; background: #4A4A4A">RESET</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="my_popup">
            <p class="success-btc">성공적으로 베팅!</p>
        </div>
        <div id="my_popup_failed">
            <p class="failed-btc">당신은 균형이 충분하지 않습니다!</p>
        </div>
        <div id="minimum_transaction">
            <p class="minimum_transaction-btc">최소 거래 금액은 <span id="min_bet"></span>입니다.!</p>
        </div>
        <div id="maximum_transaction">
            <p class="maximum_transaction-btc">최대 거래 금액은 <span id="max_bet"></span> 입니다!</p>
        </div>

        <span hidden class="cash_balance" id="cashb"></span>

        <div class="game_list" id="reloadPage">
            <div class="game_details1">
                <div class="game_title">
                    비트코인 BTC / USD 출목표
                </div>
                <div class="user_field_group" id="container_data" style="overflow-y: hidden; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); border-radius: 0px 0px 5px 5px;">
                    <!-- <table style="width: 100%; ">
                        <span id="display_trade_group"></span>
                    </table> -->
                    <div id="display_trade_group" class="cards_result"></div>
                </div>
            </div>
            <div class="user_details">
                <div class="user_title">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link result active" data-toggle="pill" href="#result">거래 결과</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link history" id = "history_data" data-toggle="pill" href="#history">나의 거래내역</a>
                        </li>
                    </ul>
                </div>
                <div class="user_field">
                    <div class="tab-content" style="overflow-y: auto; overflow-x: hidden; height: 100%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); border-radius: 0px 0px 5px 5px;">
                        <div id="result" class="tab-pane active">
                            <div class="table-responsive" style="padding: 28px 19px;">
                                <table class="table table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="binance_result_header">계약시간</th>
                                            <th class="binance_result_header">시가</th>
                                            <th class="binance_result_header">결과</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="history" class="tab-pane fade">
                            <div class="table-responsive" style="padding: 28px 19px;">
                                <table class="table table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="user_result_header">계약시간</th>
                                            <th class="user_result_header">구분</th>
                                            <th class="user_result_header">체결대금</th>
                                            <th class="user_result_header">결과</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_history">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card_item">
                <div class="card btc_header_trade">
                    <div class="c_header_trade" style="text-align: center; padding-top: 8px;">비트코인 BTC / USD 출목표</div>
                </div>
                <div class="container_data" id="container_data">
                    <table>
                        <span id="display_trade_group"></span>
                    </table>
                </div>
            </div>
            <div class="card_item">
                <div class="card btc_header_trade">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link result active" data-toggle="pill" href="#result">거래 결과</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link history" data-toggle="pill" href="#history">나의 거래내역</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div id="result" class="tab-pane active">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>계약시간</th>
                                        <th>시가</th>
                                        <th>결과</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                        <div id="history" class="tab-pane fade">
                            <table class="table table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>계약시간</th>
                                        <th>구분</th>
                                        <th>체결대금</th>
                                        <th>결과</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_history">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
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

<script>
        $(document).ready(function(){
            $('#display_trade_group').scrollLeft($(this).height())
        })
</script>