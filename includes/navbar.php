
<nav class="navbar navbar-expand-lg navbar-custom" role="navigation">
    
    <button class="navbar-toggler" type="button" id="navbar-collapse-1">
        <span class="navbar-toggler-icon"></span>
        <a class="navbar-brand-mobile" href="./">BITWIN</a>
    </button>
   
    <?php
        if(@$_SESSION["user_session"]){
            echo '
            <button class="navbar-toggler dropdown-toggle" type="button">
            <a href="#"><div class="info_content" title="note notification"><span class="note_notification"></span></div></a>
            <a href="./note"><span class="ic_rounds1"><img src="assets/icons/ic_round-local-post-office.png" class="ic_round1"></span></a>
                <img src="assets/icons/user_orange.png" id="navbar-collapse-3">
            </button>
            ';
        }else{
            echo '
                <button class="navbar-toggler" type="button" id="navbar-collapse-2">
                    <img src="assets/icons/user_white.png">
                </button>
            ';
        }
        
    ?> 


    <!-- 1920 pixels -->
    <div class="collapse navbar-collapse">
        <?php
            if(@$_SESSION["user_session"]){
            echo '
            <a id="brand_desk" href="./">BITWIN</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" id="btn_btc_yes" href="./btc_usd" style="display: block;">BTC/USD</a>
                    <a class="nav-link" id="btn_btc_no" href="#" style="display: none;">BTC/USD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_eth_yes" href="./eth_usd" style="display: block;">ETH/USD</a>
                    <a class="nav-link" id="btn_eth_no" href="#" style="display: none;">ETH/USD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link modal-popup-maintenance" href="#">XRP/USD</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-noticeguide" style="text-decoration: none;" href="#" id="drnoticeguide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        공지 및 이용
                    </a>
                    <div class="dropdown-menu notgui" aria-labelledby="drnoticeguide">
                        <a class="dropdown-item" href="./notice">공지사항</a>
                        <a class="dropdown-item" href="./guide">이용안내</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-depositwithdraw" style="text-decoration: none;" href="#" id="withdrawdeposit" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        입출금 신청
                    </a>
                    <div class="dropdown-menu depwid" aria-labelledby="withdrawdeposit">
                        <a class="dropdown-item" href="./deposit">입금신청</a>
                        <a class="dropdown-item" href="./withdraw">출금신청</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-inquiryfaq" style="text-decoration: none;" href="#" id="inquiryfaq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        고객센터
                    </a>
                    <div class="dropdown-menu inqfaq" aria-labelledby="inquiryfaq">
                        <a class="dropdown-item" href="./inquiry">1:1문의</a>
                        <a class="dropdown-item" href="./faq">FAQ</a>
                    </div>
                </li>
            </ul>';
            }else{
                echo '
                <a id="brand_desk" href="./">BITWIN</a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item modal-popup-login">
                        <a class="nav-link" href="#">BTC/USD</a>
                    </li>
                    <li class="nav-item modal-popup-maintenance">
                        <a class="nav-link" href="#">ETH/USD</a>
                    </li>
                    <li class="nav-item modal-popup-maintenance">
                        <a class="nav-link" href="#">XRP/USD</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-noticeguide" style="text-decoration: none;" href="#" id="drnoticeguide" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            공지 및 이용
                        </a>
                        <div class="dropdown-menu notgui" aria-labelledby="drnoticeguide">
                            <a class="dropdown-item" href="./notice">공지사항</a>
                            <a class="dropdown-item" href="./guide">이용안내</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown modal-popup-login">
                        <a class="nav-link dropdown-depositwithdraw" style="text-decoration: none;" href="#" id="withdrawdeposit" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            입출금 신청
                        </a>
                        <div class="dropdown-menu depwid" aria-labelledby="withdrawdeposit">
                            <a class="dropdown-item modal-popup-login" href="#">입금신청</a>
                            <a class="dropdown-item modal-popup-login" href="#">출금신청</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-inquiryfaq" style="text-decoration: none;" href="#" id="inquiryfaq" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            고객센터
                        </a>
                        <div class="dropdown-menu inqfaq" aria-labelledby="inquiryfaq">
                            <a class="dropdown-item modal-popup-login" href="#">1:1문의</a>
                            <a class="dropdown-item modal-popup-login" href="#">FAQ</a>
                        </div>
                    </li>
                </ul>';
            }
        ?>
        <span class="nav_layout_btn">
            <ul class="navbar-nav mr-auto">
                <?php
                    if(@$_SESSION["user_session"]){
                        echo '<li class="nav-item">
                                <a href="./betting" style="text-decoration: none;"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span>원</span></a>
                            </li>
                            <li class="nav-item">
                            <a href="#"><div class="info_content" title="note notification"><span class="note_notification"></span></div></a>
                            <a href="./note"><span class="ic_rounds"><img src="assets/icons/ic_round-local-post-office.png" class="ic_round"></span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <span class="user_oranges" onclick="dropdown()"><img src="assets/icons/user_orange.png" id="userinfo" class="user_orange dropbtn"></span>
                                    <div id="myDropdown" class="dropdown-content" style="padding: 15px; background: #DDDDDE; ">
                                        <div style="background: #F7F7F7;  border-radius: 10px; font-size: 16px; height: 44px; font-weight: 700; padding: 10px;">
                                            '.(@$_SESSION["user_session"]["u_Nickname"]).'
                                            <button type="buttton" id="sound_img_on" class="sound_img" style="float:right; border: 1px #ffffff; background: #F7F7F7;"><img src="assets/icons/akar-icons_sound-on.png"></button>
                                            <button type="buttton" id="sound_img_off" class="sound_img" style="float:right; border: 1px #ffffff; background: #F7F7F7; display:none;"><img src="assets/icons/akar-icons_sound-off.png"></button>
                                        </div>
                                        <p style="margin-top: 10px; margin-left: 10px; color: #888888; font-size: 14px;">'.(@$_SESSION["user_session"]["u_Recommended_Point"]).'</p>
                                        <div style="background: #C4C4C4; border-radius: 10px; height: 157px; width: 100%; padding: 10px; margin-bottom: 5px;">
                                            <a href="./transaction" button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">입출금 내역</a></button>
                                            <a href="./betting" button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">거래내역</a></button>
                                            <a href="./settings" button type="button" class="btn" style="width: 100%; margin-bottom: 10px; text-align: left; font-weight: 700;">개인정보 설정</a></button>
                                        </div>
                                            <center>
                                                <a href="#" data-code="'.@$_SESSION["user_session"]["u_Account_Code"].'" type="button" class="btn btnlogout" style="border-radius: 10px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); box-sizing: border-box; border: 0.5px solid #FFFFFF; text-align: center; background: #f1f1f1; height: 40px; width: 120px;">
                                                    로그아웃
                                                </a>
                                            </center>
                                    </div>
                                </div>
                            </li>
                            ';
                    }else{
                        echo '
                            <div class="form-inline my-2 my-lg-0 btn_group_nav">
                                    <button type="button" class="btn btn-primary modal-popup-login mr-3">로그인</button>
                                    <button type="button" class="btn btn-primary text-white"><a href="./signup" class="btn-signup">회원가입</a></button>
                                </div>
                            </div>';
                    }
                ?>
            </ul>
            
        </span>
    </div>
    
</nav>

<?php
    if(@$_SESSION["user_session"]){
        echo '<div class="navbar-collapse-1-mobile">
                <div class="navbar_mobile_grid">
                    <div>
                    <a class="btn-mob text-yellow nav-item" id="btn_btc_yes_mobile" href="./btc_usd" style="display: block; text-align:center; padding-top: 13px;">BTC/USD</a>
                    <a class="btn-mob text-yellow nav-item" id="btn_btc_no_mobile" href="#" style="display: none; text-align:center; padding-top: 13px;">BTC/USD</a>
                    </div>
                    <div>
                    <a class="btn-mob text-yellow nav-item" id="btn_eth_yes_mobile" href="./eth_usd" style="display: block; text-align:center; padding-top: 13px;">ETH/USD</a>
                    <a class="btn-mob text-yellow nav-item" id="btn_eth_no_mobile" href="#" style="display: none; text-align:center; padding-top: 13px;">ETH/USD</a>
                    </div>
                    
                    <a href="#" button type="button" class="btn-mob text-yellow nav-item modal-popup-maintenance">XRP/USD</a>
                </div>
                <div class="navbar_mobile_grid">
                    <a href="./notice" button type="button" class="btn-mob text-white">공지사항</a>
                    <a href="./guide" button type="button" class="btn-mob text-white">이용안내</a>
                    <a href="./inquiry" button type="button" class="btn-mob text-white">1:1문의</a>
                </div>
                <div class="navbar_mobile_grid">
                    <a href="./faq" button type="button" class="btn-mob text-orange">FAQ</a>
                    <a href="./deposit" button type="button" class="btn-mob text-orange">입금신청</a>
                    <a href="./withdraw" button type="button" class="btn-mob text-orange">출금신청</a>
                </div>
            </div>';
        } else{
            echo '<div class="navbar-collapse-1-mobile">
            <div class="navbar_mobile_grid">
                <a href="#" button type="button" id="navbar-collapse-login" class="btn-mob text-yellow navbar-toggler">BTC/USD</a>
                <a href="#" button type="button" id="navbar-collapse-login5" class="btn-mob text-yellow navbar-toggler">ETH/USD</a>
                <a href="#" button type="button" class="btn-mob text-yellow nav-item modal-popup-maintenance">XRP/USD</a>
            </div>
            <div class="navbar_mobile_grid">
                <a href="./notice" button type="button" class="btn-mob text-white">공지사항</a>
                <a href="./guide" button type="button" class="btn-mob text-white">이용안내</a>
                <a href="#" button type="button" id="navbar-collapse-login1" class="btn-mob text-white navbar-toggler">1:1문의</a>
            </div>
            <div class="navbar_mobile_grid">
                <a href="#" button type="button" id="navbar-collapse-login2" class="btn-mob text-orange navbar-toggler">FAQ</a>
                <a href="#" button type="button" id="navbar-collapse-login3" class="btn-mob text-orange navbar-toggler">입금신청</a>
                <a href="#" button type="button" id="navbar-collapse-login4" class="btn-mob text-orange navbar-toggler">출금신청</a>
            </div>
            </div>';
        }
?>

<div class="display_nonlog">
    <form method="POST" class="form_login_mobile">
        <div class="form-group text-left mt-4">
            <label for="accountid"><h5 class="text-yellow">아이디</h5></label>
            <input type="text" class="form-control textinput" id="m_account_code" name="account_code" placeholder="아이디를 입력해 주세요." autofocus>
        </div>
        <div class="form-group text-left mt-3">
            <label for="password"><h5 class="text-yellow">비밀번호</h5></label>
            <input type="password" class="form-control textinput" id="m_password" name="password" placeholder="비밀번호를 입력해 주세요.">
        </div>
        <div class="display_error text-center"></div>
        <div style="text-align:center">
            <button type="button" class="btn btn-user-blue btn-log text-white"><a href="./signup" class="text-white">회원가입</a></button>
            <button type="submit" class="btn btn-user-orange btn-log text-white">로그인</button>
        </div>
    </form>
</div>

<div class="display_log">
<?php
    if(@$_SESSION["user_session"]){
        echo '<div style="text-align:center">
                <div class="nickname_mobile">
                    '.(@$_SESSION["user_session"]["u_Nickname"]).'
                    <button type="buttton" style="float:right; border: 1px rgb(255, 255, 255);background: rgb(247, 247, 247);display: block;"><img src="assets/icons/akar-icons_sound-on.png"></button>
                </div>
                <p class="rec_point">'.(@$_SESSION["user_session"]["u_Recommended_Point"]).'</p>
                <div class="layout_bg">
                    <a href="./transaction" button type="button" class="btn btn_withdraw_deposit">입출금 내역</a></button>
                    <a href="./betting" button type="button" class="btn btn_transaction_history">거래내역</a></button>
                    <a href="./settings" button type="button" class="btn btn_privacy_settings">개인정보 설정</a></button>
                </div>
                <div class="logout_mobile">
                    <a href="#" data-code="'.$_SESSION["user_session"]["u_Account_Code"].'" type = "button" class="btn btn_logout_mobile">로그아웃</a>
                </div>
            </div>
        </div>';
    } else{
        echo '<div style="text-align:center">
            <button type="button" class="btn btn-gray btn_log_mobile"><img src="assets/icons/akar-icons_sound-on.png" class="soung_img"></button>
            <p class="rec_point"></p>
            <div class="layout_bg">
                <a href="./transaction" button type="button" class="btn btn_withdraw_deposit">입출금 내역</a></button>
                <a href="./betting" button type="button" class="btn btn_transaction_history">거래내역</a></button>
                <a href="./settings" button type="button" class="btn btn_privacy_settings">개인정보 설정</a></button>
            </div>
            <div class="logout_mobile">
                <a href="#" data-code="<?=$_SESSION["user_session"]["u_Account_Code"]?>" type = "button" class="btn btn_logout_mobile">로그아웃</a>
            </div>
        </div>
    </div>';
    }
    
    
    ?>

<!-- <div class="current_stocks_mobile">
        <a href="#"><span class="current_stocks"><img src="assets/icons/dollar_mint.png" class="dollar_mint"><span class="cash_balance"></span> 원</span></a>
</div> -->