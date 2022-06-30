<?php
    if(count(@$_SESSION)){
        echo '
            <div class="current_stocks_mobile">
                <a href="./betting" style="text-decoration: none;"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span>원</span></a>
            </div>
            <div class="jumbotron jumbotron-fluid headers" style="margin: 0;">
                <div class="header_grid">
                    <div>
                        <h1 class="display-4 header_title">무한한 잠재력을 가진 디지털 자산 투자의 시대에 필요한 전략적인 거래</h1>
                        <p class="header_subtitle">거래 분석전문가와 함께 <br> 안전하고 실현가능한 가치에 투자하세요.</p>
                    </div>
                    <div class="header_btn">
                        <a href="./btc_usd" button type="button" class="btn btn-white">거래 시작</a></button>
                    </div>
                </div>
            </div>
        ';
    }else{
        echo '
            <div class="jumbotron jumbotron-fluid headers" style="margin: 0;">
                <div class="header_grid">
                    <div>
                        <h1 class="display-4 header_title">무한한 잠재력을 가진 디지털 자산 투자의 시대에 필요한 전략적인 거래</h1>
                        <p class="header_subtitle">거래 분석전문가와 함께 안전하고 실현가능한 가치에 투자하세요.</p>
                    </div>
                    <div class="header_btn">
                        <button type="button" class="btn btn-white modal-popup-login mr-3">거래 시작</button>
                    </div>
                </div>
            </div>
        ';
    }
?>