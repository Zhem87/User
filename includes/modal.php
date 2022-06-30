<!-- signup notification -->
<div class="modal fade" id="modal-notif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">회원가입 신청</h3>
            <div class="modal-body">
                <div class="container">
                    <h4 class="text-center text-white modal-notif-body">신청이 완료되었습니다.</h4>
                    <h4 class="text-center text-white modal-notif-body">회원가입이 승인되면 이용가능합니다.</h4>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"><a href="./">확인</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login modal popup -->
<div class="modal fade" id="modal-login" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1 class="modal-title text-white mb-2">BITWIN</h1>
                    <form method="POST" class="form_login">
                        <div class="form-group text-left">
                            <label for="accountid"><h4 class="text-yellow">아이디</h4></label>
                            <input type="text" class="form-control textinput" id="account_code" name="account_code" placeholder="아이디를 입력해 주세요." autofocus>
                        </div>
                        <div class="form-group text-left">
                            <label for="password"><h4 class="text-yellow">비밀번호</h4></label>
                            <input type="password" class="form-control textinput" id="password" name="password" placeholder="비밀번호를 입력해 주세요.">
                        </div>
                        <div class="display_error text-center"></div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-user-gray" data-dismiss="modal">취소</button>
                            <button type="submit" class="btn btn-user-orange">로그인</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Maintenance -->
<div class="modal fade" id="modal-maintenance" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body1">
                <div class="container">
                    <h2 class="modal-title text-white mb-2">서비스 준비 중입니다!</h2>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- display binance 1m result -->
<div class="modal fade" id="modal-bi_1m_result" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #000000; text-align: center;">
                <span style="color: #FFF200; font-size: 20px;"><center>실현데이터</center></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Maintenance for BTC only-->
<div class="modal fade" id="modal-prevent" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <div class="container">
                    <h2 class="modal-title text-white mb-2">서비스 준비 중입니다!</h1>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h3 id="maintenance_btc" class="modal-title text-white mb-2"></h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- display deposit alert -->
<div class="modal fade" id="modal-deposit_alert" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">입금신청 알람</h3>
            <div class="modal-body">
                <div class="container">
                    <h4 class="text-center text-white modal-notif-body">입금 최소금액은 10,000원입니다. 입금금액을 다시 확인하시고 신청부탁드립니다.</h4>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn_alert" onclick="location.reload()">확인</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- display deposit alert -->
<div class="modal fade" id="modal-withdraw_alert_minimum" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청 알림</h3>
            <div class="modal-body">
                <div class="container">
                    <h4 class="text-center text-white modal-notif-body">출금 최소금액은 10,000원입니다. 출금금액을 다시 확인하시고 신청부탁드립니다.</h4>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn_alert" onclick="location.reload()">확인</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- display deposit alert -->
<div class="modal fade" id="modal-withdraw_alert_maximum" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청 알림</h3>
            <div class="modal-body">
                <div class="container">
                    <h4 class="text-center text-white modal-notif-body">1회 최대 출금금액은 50,000,000원입니다. 출금금액을 다시 확인하시고 신청부탁드립니다.</h4>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn_alert" onclick="location.reload()">확인</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- display deposit alert 30secs-->
<div class="modal fade" id="modal-deposit_alert_30sec" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h3 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">입금신청 알람</h3>
            <div class="modal-body">
                <div class="container">
                    <h4 class="text-center text-white modal-notif-body">30초 후에 다시 입금신청 부탁드립니다. 감사합니다.</h4>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- display deposit alert success-->
<div class="modal fade" id="modal-deposit_alert_success" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청이 완료되었습니다.</h4>
        </div>
    </div>
</div>

<!-- display deposit submit -->
<div class="modal fade" id="modal-deposit_submit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">입금신청 완료</h4>
            <div class="modal-body">
                <div class="container">
                    <div class="inline_grp">
                        <button class="btn btn_amount" type="button">예금주</button>
                        <input type="text" id="depositamount_s" name="depositamount_s" class="input_amnt form-control">
                        <input type="hidden" id="new_balance_s" name="new_balance_s">
                    </div>
                    <p class="message">입금 신청이 완료되었습니다.</p>
                    <center><button class="btn btn_deposit_save" type="submit">확인</button></center>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="modal fade" id="modal-change_password" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1 class="modal-title text-white mb-2">비밀번호 변경</h1>
                    <form method="POST" class="form_changepassword">
                        <div class="btn-group">
                            <button class="btn btn_currpassword" type="button">현재 비밀번호</button>
                            <input type="password" class="form-control textinput1" id="account_currentpassword" name="account_currentpassword" placeholder="********" autofocus>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn_newpassword" type="button">변경할 비밀번호</button>
                            <input type="password" class="form-control textinput2" id="s_password" name="s_password" placeholder="********" autofocus>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn_reenterpassword" type="button">비밀번호 재입력</button>
                            <input type="password" class="form-control textinput3" id="chk_password" name="chk_password" placeholder="********" autofocus>
                        </div>
                        <div class="display_error text-center"></div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-user-orange">변경하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->



<div class="modal fade" id="modal-change_password1" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1 class="modal-title text-white mb-2">비밀번호 변경</h1>
                    <form method="POST" class="form_changepassword">
                        <div class="btn-group1">
                            <button style="width: 30%;" type="button">현재 비밀번호</button>
                            <input type="password" class="privacy_info" style="width: 67%;" id="account_currentpassword" name="account_currentpassword" placeholder="**********" >
                        </div>
                        <div class="btn-group1">
                            <button style="width: 30%;" type="button">변경할 비밀번호</button>
                            <input type="password" class="privacy_info" style="width: 67%;" id="s_password" name="s_password" placeholder="4 ~ 14 영숫자" >
                        </div>
                        <div class="btn-group1">
                            <button style="width: 30%;" type="button">비밀번호 재입력</button>
                            <input type="password" class="privacy_info" style="width: 67%;" id="chk_password" name="chk_password" placeholder="4 ~ 14 영숫자" >
                        </div>
                        <div class="display_error text-center"></div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-user-orange">변경하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- display withdraw alert -->
<div class="modal fade" id="modal-withdraw_alert" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청 알람</h4>
            <div class="modal-body">
                <div class="container">
                    <h3 class="text-center text-white modal-notif-body">출금금액을 다시 확인하시고 신청부탁드립니다.</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- display withdraw alert 2hrs -->
<div class="modal fade" id="modal-withdraw_alert_2hrs" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청 알람</h4>
            <div class="modal-body">
                <div class="container">
                    <h3 class="text-center text-white modal-notif-body">2시간 후에 다시 출금신청 부탁드립니다. 감사합니다.</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- display withdraw alert success -->
<div class="modal fade" id="modal-withdraw_alert_success" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금 요청 성공!</h4>
        </div>
    </div>
</div>



<!-- display withdraw submit -->
<div class="modal fade" id="modal-withdraw_submit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title text-white mt-n4 mb-2 modal-notif-title mb-3">출금신청 완료</h4>
            <div class="modal-body">
                <div class="container">
                    <div class="inline_grp">
                        <button class="btn btn_amount" type="button">출금금액</button>
                        <input type="text" id="withdrawamount_s" name="withdrawamount_s" class="input_amnt form-control">
                        <input type="hidden" id="new_balance_s" name="new_balance_s">
                    </div>
                    <p class="message">출금 신청이 완료되었습니다.</p>
                    <center><button class="btn btn_withdraw_save" type="submit">확인</button></center>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- display inquiry submit -->
<div class="modal fade" id="modal-inquiry_submit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <h4 class="modal-title mt-n4 mb-2 modal-notif-title mb-3">1:1 문의하기</h4>
            <div class="modal-body">
                <div class="container">
                    <form class="formInquiry" method="POST">
                        <div class="inline_grp">
                            <button class="btn btn_title" type="button">제목</button>
                            <input type="text" id="inquiry_title" name="inquiry_title" placeholder="제목을 입력해 주세요." class="form-control">
                            <div class="errortitle"></div>
                        </div>
                        <div class="inline_grp">
                            <button class="btn btn_title" type="button">문의내용</button>
                            <textarea type="text" id="inquiry_details" name="inquiry_details" placeholder="문의내용을 입력해 주세요." class="form-control"></textarea>
                            <div class="errordetails"></div>
                        </div>
                        <center><button class="btn btn_inquiry_save" type="submit">문의하기</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Maintenance -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-server_maintenance" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-white mb-2">서비스 안내</h1>
            </div>
            <div class="modal-body1">
                <div class="container">
                    <h4 id="maintenance_details" class="modal-title text-white mb-2"></h1>
                </div>
            </div>
        </div>
    </div>
</div>

