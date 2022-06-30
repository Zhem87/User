    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/history.js"
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
            padding: 20px;
        }
        .div_layout{
            width: 100%;
            margin: 0 auto;
            grid-template-columns: 120%;
            padding-bottom: 10px;
        }
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 778px;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            width: 111%;
            margin-left: -6%;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 26px;
            line-height: 18px;
            font-family: 'Roboto';
            font-style: normal;
            border-radius: 10px 10px 00px 0px !important;
            height: 70px;
        }
        
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 21px;
            
        }
        .body-header table tr td{
            text-align: center;
            font-size: 14px;
            background: #FFFFFF;
            font-weight: 540;
            padding-bottom: 0;
        }
        table.userhistory tr{
            cursor: pointer;
        }
        table.userhistory tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
        }

        /* @media only screen and (max-width: 360px){
        body{
            background: #393E46;
        }
        } */
        @media only screen and (min-width: 360px) and (max-width: 767px){
            .div_layout .card,.div_layout_note .card{
                box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px 10px 4px 4px;
                height: 450px;
            }
            .hide_info_mobile{
                display: none;
            }
            body{
                background: #393E46;
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
                font-size: 20px;
                font-weight: 600;
                font-family: Tahoma, sans-serif;
            }
          

            .body-header table tr th{
                text-align: center;
                background: #DDDDDE;
                font-size: 1px;
            }
            body::-webkit-scrollbar{
                display: none;
            }
            .page-history{
                padding: 0 0;
                width: 100%;
            }
            .card{
                margin: 0%;
                width: 100%;
                box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px 10px 4px 4px;
            }
            .card-header{
                background: #393E46;
                text-align: center;
                color: #FFF200;
                font-size: 16px;
                font-family: 'Roboto';
                font-style: normal;
                border-radius: 10px 10px 00px 0px !important;
                height: 40px;
            }
            .body-header table tr th{
                text-align: center;
                background: #DDDDDE;
                font-size: 10px;
                line-height: 5px;
            }
            .body-header table tr td{
                text-align: center;
                font-size: 8px;
                background: #FFFFFF;
            }
            .table th{
                padding: 0;
                padding-left: 5px;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-right: 5px;
            }
            .history_time{
                width: 20%;
            }
          

        
    }
       
        @media screen and (min-width : 768px) and (max-width : 1199px){
    
        body::-webkit-scrollbar{
            display: none;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 28px;
            line-height: 38px;
            font-family: 'Roboto';
            font-style: normal;
            border-radius: 10px 10px 00px 0px !important;
            padding-top: 20px;
        }
       
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 14px;
            line-height: 10px;
        }
        .body-header table tr td{
            text-align: center;
            font-size: 14px;
            background: #FFFFFF;
        }
        table.userhistory tr{
            cursor: pointer;
        }
        table.userhistory tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
        }

        .display_log .btn_log_mobile{
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 8px 8px 8px 16px;
            position: absolute;
            width: 400px;
            height: 44px;
            left: 190px; 
            top: 116px;
            background: #F7F7F7;
            border-radius: 10px;
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 19px;
            padding-left: 16px;
            }
        .display_log .soung_img{
            padding-left: 220px; 
            }
        }
        @media only screen and (min-width: 1200px) and (max-width: 1700px){
    
        body::-webkit-scrollbar{
            display: none;
        }
        .page-deposit{
            width: 90%;
            margin-left: 0%;
            margin-right: 0%;

        }
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 778px;
        }

        .div_layout{
                padding-bottom: 10px;
            }
        .card{ 
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            margin: 0;

        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 32px;
            line-height: 38px;
            font-family: 'Roboto';
            font-style: normal;
            border-radius: 10px 10px 00px 0px !important;
            padding-top: 20px;
        }

        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 18px;
        }
        .body-header table tr td{
            text-align: center;
            font-size: 14px;
            background: #FFFFFF;
        }
        table.userhistory tr{
            cursor: pointer;
        }
        table.userhistory tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
        }

    }
        
        @media only screen and (min-width: 1700px) and (max-width: 1920px ){
      
        body::-webkit-scrollbar{
            display: none;
        }
        .page-deposit{
            width: 100%; 
        }
        .div_layout{
            width: 100%;
            margin: 0 auto;
            grid-template-columns: 120%;
            padding-bottom: 10px;
        }
        .div_layout .card,.div_layout_note .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 778px;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
        }
        .card-header{
            background: #393E46;
            text-align: center;
            color: #FFF200;
            font-size: 32px;
            line-height: 38px;
            font-family: 'Roboto';
            font-style: normal;
            border-radius: 10px 10px 00px 0px !important;
            padding-top: 20px;
        }
        
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 21px;
            
        }
        .body-header table tr td{
            text-align: center;
            font-size: 14px;
            background: #FFFFFF;
            font-weight: 540;
        }
        table.userhistory tr{
            cursor: pointer;
        }
        table.userhistory tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
        }

       
    }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>
    <!-- header -->

    <!-- registration Section -->
    <div class="container page-history">
        <div id="div_height" style="height: 490px;"><img id="overlay" src="../assets/img/loader6.gif" style="position:relative; z-index: 10; margin-left: auto; margin-right: auto; margin-top: 20%; width: 50%; display: block;"/></div>
        <div id="pagination-result">
            <input type="hidden" name="rowcount" id="rowcount" />
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
