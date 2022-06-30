    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/transaction.js"
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
        .page-transactionlist{
            padding: 20px 0;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            width: 104%;
            margin-left: -2%;
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
            border-radius: 10px 10px 00px 0px !important;
        }
        .body-header{
            padding: 5px;
        }
        .body-header table tr th{
            text-align: center;
            background: #DDDDDE;
            font-size: 20px;
        }
        .body-header table tr td{
            text-align: center;
            font-size: 16px;
            background: #FFFFFF;
        }
        table.usertransaction tr{
            cursor: pointer;
        }
        table.usertransaction tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
        }



        @media only screen and (min-width: 360px) and (max-width: 768px){
        
            .current_stocks_mobile{
                font-size: 16px;
                font-family: Tahoma, sans-serif;
                font-weight: 600;
                height: 46px;
            }
            .hide_info_mobile{
                display: none;
            }
            body{
                background: #393E46;
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
           

            .body-header table tr th{
                text-align: center;
                background: #DDDDDE;
                font-size: 1px;
            }
            body::-webkit-scrollbar{
                display: none;
            }
            .page-history{
                padding: 10px 0;
                width: 100%;
            }
            .card{
                margin: 2.5%;
                width: 95%;
                box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
                border-radius: 10px 10px 4px 4px;
                height: 470px;
                padding-bottom: 10px;
            }
            .card-header{
                background: #393E46;
                text-align: center;
                color: #FFF200;
                font-size: 16px;
                line-height: 15px;
                font-family: 'Roboto';
                border-radius: 10px 10px 00px 0px !important;
            }
        
            .body-header table tr th{
                text-align: center;
                background: #DDDDDE;
                font-size: 9px;
                line-height: 5px;
            
            }
            .body-header table tr td{
                text-align: center;
                font-size: 9px;
                background: #FFFFFF;
            }
            .history_time{
                width: 20%;
            }
            .rowaccordion .game_type{
                text-align: center;
            }
    
}
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>
    <!-- header -->
    <!-- registration Section -->
    <div class="container page-transactionlist">
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
