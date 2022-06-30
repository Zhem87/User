
    <!-- custom style/script -->
    <?php
        $linkcss = array(
            "assets/css/pagination.css"
        );
        $scriptjs = array(
            "assets/js/guide.js"
        );
    ?>
    <!-- header html -->
    <?php include __DIR__ . '/includes/head_html.php';?>
  
    <style>

        .rowContent .guide_details{
            width: 150px;
        }

        body::-webkit-scrollbar{
            display: none;
        }
        .page-guide{
            padding: 20px;
            width: 100%;
        }
        .card{
            box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.25);
            border-radius: 10px 10px 4px 4px;
            height: 747px;
            width: 108%;
            margin-left: -4%;
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
        table.guide tr{
            cursor: pointer;
        }
        table.guide tr.rowContent td:nth-child(odd) {
            background-color: #DDDDDE;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
        }
        
        @media only screen and (min-width : 360px) and (max-width : 991px){
            .page-guide {
                padding: 20px 20px;
                width: 100%;
                }
 
            body{
                background: #393E46;
            }
            .card{
                height: 451px;
                width: 95%;
                margin-left: auto;
                margin-right: auto;
            }
            .card #pagination{
                padding-bottom: 10px;
            }
            .card .card-header{
                font-size: 16px;
                padding: 3px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 14px;
            }
            .card table.faq{
                height: 400px;
            }
           
        }

        @media screen and (max-width : 992px){
            .page-guide{
                padding: 20px 20px;
                width: 100%;
            }
            .card-header{
                font-size: 22px;
                padding: 3px;
            }
            .body-header table tr th, .body-header table tr td{
                font-size: 12px;
            }
        }
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>

    <!-- registration Section -->
    <div class="container page-guide">
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