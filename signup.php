    <?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        include_once 'php/config/Database.php';
        include_once 'php/class/Getuseripaddress.class.php';
        $database = new Database();
        $db = $database->getConnection();
        $get_ip = new Getuseripaddress($db);
        $getipinfo = ($get_ip->GetIpAddress() == '192.168.20.10') ? '122.55.196.201' : $get_ip->GetIpAddress();
        
    ?>
    <?php include __DIR__ . '/includes/head_html.php';?>
    <?php
        $linkcss = array();
        $scriptjs = array(
            "assets/js/register.js"
        );
    ?>
    <style>
        .flex-container {
            display: flex;
            flex-wrap: nowrap;
        }

        .flex-container > button {
            width: 150px;
            margin: 10px;
            text-align: center;
        }
        
        .buttonload {
            background-color: #1072BA;
            width: 130px;
            height: 44px;
            box-shadow: inset 2px 2px 4px rgb(0 0 0 / 25%);
            border-radius: 10px;
            border: 1px solid transparent;
            margin-left: 10px;
            color: #FFFFFF;
            font-weight: 400;
            font-size: 24px;
        }
        .info_below{
            font-size: 14px;
            color: #888888;
            padding-left: 20px;
            padding-top: 5px;
        }
        .info_below_password{
            font-size: 14px;
            color: #888888;
            padding-left: 20px;
            padding-top: 10px;
        }
        .custom-select-lg{
            padding-left: 20px;
        }
        select {
            -webkit-appearance: none;
            appearance: none;
        }
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "▼";
            font-size: 1rem;
            color: #444444;
            top: 12px;
            right: 16px;
            position: absolute;
        }
        .text_signup{
            padding: 20px;
        }
        .justify-content-center{
            width: 200%;
            margin: 0% -50%;
        }
        #bank_code{
            height: 46px;
        }
        textarea {
            resize: none;
            height: 200px;
            width: 100%; 
            font-size: 16px;
            letter-spacing: 1px;
            }
        
        @media only screen and (min-width : 768px) and (max-width : 1500px){

            .signup-title{
                font-size: 32px;
            }
            .page-signup {
                margin-top: 10px;
                width: 45%;
                margin-bottom: 0;
                padding-left: 0;
                padding-right: 0;
                font-size: 20px;
            }
            #s_account_code, #nickname, #s_password, #chk_password, #mobile_number, #account_number, #account_holder, #rec_point{
                height: 50px;
                font-size: 20px;
            }
            .btn_signup_orange{
                height: 50px;
                font-size: 20px;
            }
            #bank_code{
                height: 50px;
                font-size: 20px;
            }
            .form-group {
                margin-bottom: 10px;
            }
            label {
                display: inline-block;
                margin-bottom: 5px;
            }
            .signup-subtitle {
                font-size: 24px;
                margin-top: 10px;
            }
            .page-signup{
                width: 35%;
            }
            .option_value{
                width: 150px;
            }

        }

        @media only screen and (min-width : 360px) and (max-width : 767px){

            .signup-title{
                font-size: 20px;
            }
            .page-signup {
                margin-top: 10px;
                width: 45%;
                margin-bottom: 0;
                padding-left: 0;
                padding-right: 0;
                font-size: 12px;
            }
            #s_account_code, #nickname, #s_password, #chk_password, #mobile_number, #account_number, #account_holder, #rec_point{
                height: 15px;
                font-size: 12px;
            }
            .btn_signup_orange{
                height: 43px;
                font-size: 12px;
            }
            #bank_code{
                height: 40px;
                font-size: 12px;
            }
            .form-group {
                margin-bottom: 10px;
            }
            label {
                display: inline-block;
                margin-bottom: 5px;
            }
            .signup-subtitle {
                font-size: 24px;
                margin-top: 10px;
            }
        }

        
    </style>
    <!-- navbar -->
    <?php include __DIR__ . '/includes/navbar.php';?>
    <!-- registration Section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container page-signup">
        <h3 class="text-center font-weight-bold signup-title">BITWIN 회원가입</h3>
        <form method="POST" id="form_register">
            <input type="hidden" name="domain" value="<?=$_SERVER["SERVER_NAME"]?>">
            <input type="hidden" name="userip" value="<?=$getipinfo?>">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label><b>회원 정보</b> <span class="error_acct_dup"></span></label><br>
                        <label>아이디 </label>
                        <div class="input-group">
                            <input type="text" id="s_account_code" name="s_account_code" class="form-control text_signup mr-2" placeholder="아이디를 입력해 주세요.">
                            <input type="hidden" name="dummy_code" id="dummy_code">
                            <button type="button" class="btn btn_signup_orange1 text-white btn-lg btn-shadow" id="accnt_id_dup_chk"><span class="error_id_chk">중복 확인</span></button>
                            <button type="button" class="btn btn_signup_orange4 text-white btn-lg btn-shadow" id="accnt_id_dup_chk"><span class="error_id_chk">중복 확인</span></button>
                        </div>
                        <p class="info_below"> 영어소문자+숫자 12자까지 가능합니다.<span class="errorid"></span></p>
                    </div>
                    <div class="form-group">
                        <label>닉네임 </label>
                        <div class="input-group">
                            <input type="text" id="nickname" name="nickname" class="form-control text_signup mr-2" placeholder="닉네임을 입력해 주세요.">
                            <input type="hidden" name="dummy_nickname" id="dummy_nickname">
                            <button type="button" class="btn btn_signup_orange2 text-white btn-lg btn-shadow" id="nickname_dup_chk"><span class="error_nn_chk">중복 확인</span></button>
                            <button type="button" class="btn btn_signup_orange5 text-white btn-lg btn-shadow" id="nickname_dup_chk"><span class="error_nn_chk">중복 확인</span></button>
                        </div>
                        <p class="info_below">한국 7자, 영어와 숫자 14자까지 가능합니다.<span class="errornickname" style="font-size: 16px; color: #FF787B;"></span></p>
                    </div>
                    <div class="form-group">
                        <label>비밀번호 </label>
                        <input type="password" id="s_password" name="s_password" class="form-control text_signup mr-2" placeholder="비밀번호를 입력해 주세요.">
                        <p class="info_below_password">영어와 숫자 혼합 4~14자까지 가능합니다.</p>
                    </div>
                    <div class="form-group">
                        <label>비밀번호 확인 </label>
                        <input type="password" id="chk_password" name="chk_password" class="form-control text_signup mr-2" placeholder="비밀번호를 한번 더 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>휴대폰 번호 </label>
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control text_signup mr-2" placeholder="휴대폰 번호를 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>예금주 </label>
                        <input type="text" id="account_holder" name="account_holder" class="form-control text_signup mr-2" placeholder="예금주를 입력해 주세요.">
                    </div>
                    <div class="form-group">
                        <label>은행 </label>
                        <div class="select-wrapper">
                            <select name="bank_code" id="bank_code" class="form-control custom-select-lg">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>계좌번호 </label>
                        <input type="text" id="account_number" name="account_number" class="form-control text_signup mr-2" placeholder="계좌번호를 입력해 주세요.('-'표시없이 입력해주세요.)">
                    </div>
                    <div class="form-group">
                        <label>추천지점 </label>
                        <div class="input-group">
                        <input type="text" id="rec_point" name="rec_point" class="form-control text_signup mr-2" placeholder="추천지점 또는 코드를 입력해 주세요.">
                        <input type="hidden" name="dummy_rec" id="dummy_rec">
                        <button type="button" class="btn btn_signup_orange3 text-white btn-lg btn-shadow" id="code_dup_chk"><span class="error_code_chk">중복 확인</span></button>
                        <button type="button" class="btn btn_signup_orange6 text-white btn-lg btn-shadow" id="code_dup_chk"><span class="error_code_chk">중복 확인</span></button>
                        </div>
                        <span class="errorid"></span>

                    </div>
                </div>
                <div class="col-sm-10">
                    <h3 class="font-weight-bold signup-subtitle">회원 가입약관</h3>
                    <p>회원가입약관 및 개인정보처리방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>
                    <div class="form-group">
                        <input type="checkbox" id="chk1" name="chk1" value="Yes" class="custom-checkbox selectall mr-2">
                        <label for="checkbox" class="label-text">전체 동의</label>
                        <span class="errorchk1"></span>
                    </div>
                    <h4 class="font-weight-bold signup-subtitle">개인정보수집 및 이용 동의서(필수)</h4>
                    <textarea>
개인정보수집 및 이용 동의서 (필수)
정보통신망법 및 개인정보보호법, 관계법령에 따라 BitForWin서비스 이용을 위한 회원가입을 신청하시는 고객님께 수집하는 개인정보의 항목, 수집 및 이용목적, 개인정보의 보유 및 이용기간을 안내드리오니 자세히 확인 후 동의하여 주시기 바랍니다.

1. 개인정보 수집.
회원가입 시점에 BitForWin이(가) 이용자로부터 수집하는 개인정보는 아래와 같습니다.
1) 개인식별정보 : 고객의 성명, 생년월일, 연락처, 성별, 국적,  DI, IP주소 등
2) 금융정보 : 은행명, 계좌번호 등
3) 선택항목 : 이메일, 주소 등
4) 휴대폰번호는 나이스평가정보에서 인증 받은 휴대폰 번호를 사용하고 있습니다.

서비스 이용과정에서 이용자로부터 수집하는 개인정보는 아래와 같습니다.
1) 거래정보 : 개설정보, 예탁금, 거래내역 등
2) 이용정보 : 접속 IP 및 쿠키, 서비스 이용기록, 기기정보, OS정보 등
3) 투자자정보 :  투자권유준칙 등에 따른 투자자정보 및 투자성향 등

기타 고객상담, BitForWin 내의 개별 서비스 이용,
고객의 문의사항에 대한 응답, 이벤트 응모 및 경품 신청 과정에서
해당 서비스의 이용자에 한해 추가 개인정보 수집이 발생할 수 있습니다.
추가로 개인정보를 수집할 경우에는 해당 개인정보의 수집 시점에서 이용자에게 수집하는 개인정보 항목 및 이용목적 등에 대해 안내 드리고 동의를 받습니다.

2. 개인정보 이용
고객님의 개인정보는 회원관리, 서비스제공 및 개선, 신규 서비스 개발 등을 위해 이용됩니다.
회원가입 시 또는 서비스의 이용과정에서 홈페이지 또는 별도 절차를 통해 서비스 제공을 위해 필요한 최소한의 개인정보를 수집하고 있습니다.

- 회원 시벽/가입의사 확인, 본인/연력 확인, 부정이용 방지
- 인구통계학적 특성에 따른 분석 및 서비스 제공
- 신규 서비스 개발, 다양한 서비스 제공, 문의사항 또는 불만처리, 공지사항 전달
- 서비스의 원활한 운영에 지장을 주는 행위(계정 도용 및 부정 이용 행위 등 포함)에 대한 방지 및 제재
- 마케팅 및 광고 등에 활용
- 서비스 이용 기록, 접속 빈도 및 서비스 이용에 대한 통계, 프라이버시 보호 측면의
    서비스 환경 구축, 맞춤형 서비스 제공, 서비스 개선에 활용


※ 개인정보의 보유기간 및 처리기간
- 당사는 수집, 이용에 관한 동의일로부터 (금융)거래 종료일 또는 동의서의 이용목적 달성 시까지 보유, 이용됩니다.
- 이용목적이 달성된 후에는 법령상 의무를 준수하기 위해 불가피한 경우,
    분쟁가능성이 소멸되지 않은 경우, 고객의 이익을 위해 필요한 경우, 다른 법령에 따라 위탁된 업무 수행 시 연장하여 보관 및 처리할 수 있습니다.
    
3. 개인정보 파기
당사는 전자적 파일 형태인 경우 복구 및 재생되지 않도록 안전하게 삭제하고,
그 밖에 기록물, 인쇄물, 서면 등의 경우 분쇄하거나 소각하여 파기합니다.
다만, 내부 방침에 보관 후 파기하는 정보는 아래와 같습니다.
    1) 아래 정보는 탈퇴일로부터 최대 5년간 보관 후 파기합니다.
    - CS 문의 대응을 위해 계정 내 문의 내역 보관 및 일부 개인정보를 암호화 하여 보관.
    -서비스 부정이용 기록.
    -전자상거래 등에서의 소비자 보호에 관한 법률에 따른 렌트 계약 서비스 이용기록.
    
또한, 당사는 '개인정보 유효기간제' 에 따라 1년간 서비스를 이용하지 않은 회원의 개인정보를 별도로 분리 보관하고 있으며, 
분리 보관된 개인정보는 3년간 보관 후 지체 없이 파기합니다.
    
당사는 보유기간이 경과한 개인정보는 정당한 사유가 없는 한 보유기간의 종료일로부터 5일 이내, 
처리목적의 달성, 해당 서비스의 폐지, 사업의 종료 등으로 
그 개인정보가 불필요하다고 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.
다만, 문서철에 포함된 개인정보는 매분기 단위로 보존 필요성을 확인하여 파기할 수 있습니다.
    
서비스 제공을 위해 필요한 최소한의 개인정보이므로 동의를 해 주셔야 서비스 이용이 가능합니다. 

이하) 개인정보 수집 및 이용 동의서 표준양식에 따릅니다.


정보통신망법 및 개인정보보호법, 관계법령에 따라 BitForWin 서비스 이용을 위한 회원가입을 신청하시는 고객님께 수집하는 개인정보의 항목, 수집 및 이용목적, 개인정보의 보유 및 이용기간을 안내드리오니 자세히 확인 후 동의하여 주시기 바랍니다.

1. 개인정보 수집.
회원가입 시점에 BitForWin이(가) 이용자로부터 수집하는 개인정보는 아래와 같습니다.
1) 개인식별정보 : 고객의 성명, 생년월일, 연락처, 성별, 국적, CI(고유식별변호), DI, IP주소 등
2) 금융정보 : 은행명, 계좌번호 등
3) 선택항목 : 이메일, 주소 등

서비스 이용과정에서 이용자로부터 수집하는 개인정보는 아래와 같습니다.
1) 거래정보 : 개설정보, 예탁금, 거래내역 등
2) 이용정보 : 접속 IP 및 쿠키, 서비스 이용기록, 기기정보, OS정보 등
3) 투자자정보 :  투자권유준칙 등에 따른 투자자정보 및 투자성향 등

기타 고객상담, BitForWin내의 개별 서비스 이용,
고객의 문의사항에 대한 응답, 이벤트 응모 및 경품 신청 과정에서
해당 서비스의 이용자에 한해 추가 개인정보 수집이 발생할 수 있습니다.
추가로 개인정보를 수집할 경우에는 해당 개인정보의 수집 시점에서 이용자에게 수집하는 개인정보 항목 및 이용목적 등에 대해 안내 드리고 동의를 받습니다.

2. 개인정보 이용
고객님의 개인정보는 회원관리, 서비스제공 및 개선, 신규 서비스 개발 등을 위해 이용됩니다.
회원가입 시 또는 서비스의 이용과정에서 홈페이지 또는 별도 절차를 통해 서비스 제공을 위해 필요한 최소한의 개인정보를 수집하고 있습니다.

- 회원 시벽/가입의사 확인, 본인/연력 확인, 부정이용 방지
- 인구통계학적 특성에 따른 분석 및 서비스 제공
- 신규 서비스 개발, 다양한 서비스 제공, 문의사항 또는 불만처리, 공지사항 전달
- 서비스의 원활한 운영에 지장을 주는 행위(계정 도용 및 부정 이용 행위 등 포함)에 대한     방지 및 제재
- 마케팅 및 광고 등에 활용
- 서비스 이용 기록, 접속 빈도 및 서비스 이용에 대한 통계, 프라이버시 보호 측면의
    서비스 환경 구축, 맞춤형 서비스 제공, 서비스 개선에 활용
    

※ 개인정보의 보유기간 및 처리기간
- 당사는 수집, 이용에 관한 동의일로부터 (금융)거래 종료일 또는 동의서의 이용목적 달성 시까지 보유, 이용됩니다.
- 이용목적이 달성된 후에는 법령상 의무를 준수하기 위해 불가피한 경우,
    분쟁가능성이 소멸되지 않은 경우, 고객의 이익을 위해 필요한 경우, 다른 법령에 따라 위탁된 업무 수행 시 연장하여 보관 및 처리할 수 있습니다.
    
3. 개인정보 파기
당사는 전자적 파일 형태인 경우 복구 및 재생되지 않도록 안전하게 삭제하고,
그 밖에 기록물, 인쇄물, 서면 등의 경우 분쇄하거나 소각하여 파기합니다.
다만, 내부 방침에 보관 후 파기하는 정보는 아래와 같습니다.
    1) 아래 정보는 탈퇴일로부터 최대 5년간 보관 후 파기합니다.
    - CS 문의 대응을 위해 계정 내 문의 내역 보관 및 일부 개인정보를 암호화 하여 보관.
    -서비스 부정이용 기록.
    -전자상거래 등에서의 소비자 보호에 관한 법률에 따른 렌트 계약 서비스 이용기록.
    
또한, 당사는 '개인정보 유효기간제' 에 따라 1년간 서비스를 이용하지 않은 회원의 개인정보를 별도로 분리 보관하고 있으며, 
분리 보관된 개인정보는 3년간 보관 후 지체 없이 파기합니다.
    
당사는 보유기간이 경과한 개인정보는 정당한 사유가 없는 한 보유기간의 종료일로부터 5일 이내, 
처리목적의 달성, 해당 서비스의 폐지, 사업의 종료 등으로 
그 개인정보가 불필요하다고 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.
다만, 문서철에 포함된 개인정보는 매분기 단위로 보존 필요성을 확인하여 파기할 수 있습니다.
    
서비스 제공을 위해 필요한 최소한의 개인정보이므로 동의를 해 주셔야 서비스 이용이 가능합니다. 

이하) 개인정보 수집 및 이용 동의서 표준양식에 따릅니다.
                    </textarea>
                    <div class="form-group mt-3">
                        <input type="checkbox" id="chk2" name="chk2" value="Yes" class="custom-checkbox mr-2">
                        <label for="checkbox" class="label-text">개인정보수집 및 이용 동의서에 동의합니다.</label>
                        <span class="onchk errorchk2"></span>
                    </div>
                    <h4 class="font-weight-bold signup-subtitle">서비스 이용약관(필수)</h4>
                    <textarea>
서비스 이용약관(필수)
BitForWin (웹사이트: http://bitforwin.com)는 PT. DAE SUNG GEOTEC INDONESIA가 제공하는 거래 플랫폼입니다. PT. DAE SUNG GEOTEC INDONESIA (이하 “PT. DAE SUNG GEOTEC INDONESIA”)는 인도네시아의 기업법에 의거하여 설립되었으며 회사 등록번호는 9120007120177 입니다.

본 서비스 이용약관은 본 문서에 명시되어 있는 다른 부록, 조항 및 문서와 함께 당사자들 간의 포괄적 합의를 구성합니다 (이를 통합하여, “약관” 이라 칭함). 본 서비스 이용약관과 다른 부록, 조항 및 문서 사이에 불일치가 있는 경우, 본 서비스 이용약관의 내용이 우선합니다. 거래 플랫폼을 통해 제공되는 그 밖의 모든 정보 또는 구두/서면 진술은 본 약관에서 배제되며, 이는 당사자들 간의 법적 계약에도 해당되지 않습니다. 거래 플랫폼 및 서비스 이용은 본 약관에 의해 규율됩니다.

본 거래 폴랫폼에 게시된 정보에 접속하거나, 이를 조회 또는 다운로드하고, PT. DAE SUNG GEOTEC INDONESIA이 제공하는 서비스를 이용함으로써 귀하는 본 약관을 읽었으며, 이를 이해하고 본 약관이 구속력을 가진다는 데 전적으로 동의합니다. PT. DAE SUNG GEOTEC INDONESIA은 별도의 고지 없이, 언제든지 본 약관의 내용을 변경할 수 있습니다. 귀하는 변경된 약관이 계속해서 귀하에게 구속력을 가지며, PT. DAE SUNG GEOTEC INDONESIA은 이러한 변경사항을 귀하에게 고지할 의무가 없다는 데 동의합니다. 귀하는 정기적으로 본 약관을 확인하여 변경 여부를 파악하는 것은 귀하의 책임이며, 변경된 약관이 게시된 후 거래 플랫폼 및 PT. DAE SUNG GEOTEC INDONESIA이 제공하는 서비스를 계속해서 사용할 경우 이러한 변경을 수락한다는 뜻임을 인정합니다.

거래 플랫폼 및 거래 플랫폼에 게시된 모든 텍스트, 그래픽, 이미지, 소프트웨어 및 그 밖의 모든 자료에 대한 저작권은 PT. DAE SUNG GEOTEC INDONESIA이 소유하며, 여기에는 거래 플랫폼 상의 자료 및 서비스 관련 모든 등록상표와 기타 지식재산권이 포함됩니다. 거래 플랫폼 상의 자료는 개인용 및 비상업용 목적으로만 사용할 수 있습니다.

귀하는 위에 명시된 목적으로만 거래 플랫폼의 발췌물을 컴퓨터 스크린에 표시하거나 인쇄할 수 있으며, 이러한 경우에도 첫 출력물 또는 다운로드에 표시된 일체의 저작권 및 기타 재산권 고지 또는 PT. DAE SUNG GEOTEC INDONESIA의 등록상표나 로고를 변조하거나 추가 또는 삭제하지 않고 그대로 보존해야 합니다. 본 정책에 분명하게 명시된 바를 제외하고, 귀하는 PT. DAE SUNG GEOTEC INDONESIA의 사전 서면 허가 없이 웹사이트의 자료를 다른 상업적 목적으로 변조, 수정, 배포 또는 사용할 수 없습니다.

귀하는 ‘BitForWin’ 및 BitForWin 로고가 PT. DAE SUNG GEOTEC INDONESIA의 등록 상표임을 인정합니다. 귀하는 위에서 허용한 최대 한도까지 본 거래 플랫폼에서 다운로드 한 자료에 표시된 등록 상표를 변조하지 않고 복제할 수 있으나, 다른 방식으로 이를 사용, 복사, 각색 또는 삭제할 수는 없습니다.

귀하는 어떠한 경우에도 거래 플랫폼에 대한, 또는 이와 관련된 권리 (본 약관 및 거래 플랫폼의 특정 서비스나 섹션에 적용되는 그 밖의 약관에 따라 플랫폼을 이용할 권리는 제외)를 획득하거나 귀하에게 플랫폼에 대한, 또는 이와 관련된 권리를 보유하고 있는 것처럼 표현할 수 없습니다.

귀하가 다음의 국가, 지역, 구역 및 장소에 위치하거나 전입 및 정착했거나 시민 또는 거주자인 경우, 본 서비스 또는 본 거래 플랫폼을 이용하거나 접속할 수 없습니다: (i)미국, 퀘벡 주 (캐나다), 홍콩, 인도네시아, 버뮤다 제도, 쿠바, 크림반도와 세바스토폴, 이란, 시리아, 북한 또는 수단; (ii) 미국이 금수조치를 취한 주, 국가 또는 관할구역; (iii) (귀하의 국적, 거주지, 시민권, 거소지 등의 이유로) 귀하에게 적용되는 준거법에 따라 본 서비스 또는 본 거래 플랫폼의 접속 또는 사용이 금지되는 관할구역; (iv) 본 서비스나 본 거래 플랫폼의 공개 또는 이용이 금지되거나 현지법 또는 규제에 반하는 장소 또는 PT. DAE SUNG GEOTEC INDONESIA의 멤버에게 현지 등록 또는 인허가를 받도록 하는 장소(이하 통칭하여, the “제한된 관할구역”). PT. DAE SUNG GEOTEC INDONESIA은 단독 재량에 따라 서비스 제한 지역 내에서의 본 서비스 또는 거래 플랫폼에 대한 접속을 제한하거나 제어할 수 있습니다. 만약, 거래 플랫폼 또는 본 서비스의 접속이 서비스 제한 지역에서 이루어진 것을 확인하거나 설립 및 창설 장소, 시민권, 거소지에 대하여 허위 진술을 한 것으로 판명되는 경우 또는 PT. DAE SUNG GEOTEC INDONESIA은 해당 이용자의 계정을 폐쇄하고, 현재 거래가 이루어지고 있는 오픈 포지션에 대해 즉시 청산할 수 있는 권리를 가집니다.


정의
본 약관에서:
“준거법” 이란 PT. DAE SUNG GEOTEC INDONESIA의 일원 또는 귀하가 서비스의 수령 또는 이행에 적용되는 모든 관할권에 구속되는 정부, 준정부, 행정 또는 규제 기관, 법원, 정부기관 또는 협회의 모든 민법 및 관습법, 법령, 제정법, 규정, 지시, 판결, 내규, 조례, 회람문, 법규, 명령, 고지, 요구, 칙령, 강제, 결의, 규칙, 및 판결을 의미합니다.

" BitForWin 모바일 어플리케이션 (앱)" 이란 PT. DAE SUNG GEOTEC INDONESIA에 의해 개발, 공개 및 배포되는 모바일 기반의 거래 플랫폼/어플리케이션을 의미합니다 (이는 종종 업데이트 될 수 있습니다).

"PT. DAE SUNG GEOTEC INDONESIA" 이란 PT. DAE SUNG GEOTEC INDONESIA과 그 자회사를 의미합니다.

"지식재산권" 이란 등록 여부와 상관 없이 전 세계 또는 모든 지역의 디자인 설계, 특허, 저작권, 데이터베이스권, 데이터보호권, 등록상표, 서비스 상표, 로고, 상호, 도메인권리, 공개되지 않거나 기밀 정보에 대한 권리(가령, 노하우, 영업비밀, (특허를 받을 수 있든 없든) 발명), 저작인격권 및 그 밖의 모든 지적 또는 산업재산권 및 해당 권리에 대한 등록신청을 의미합니다.

"회원" 이란 거래 플랫폼의 모든 등록 사용자를 의미합니다.

"서비스" 란 PT. DAE SUNG GEOTEC INDONESIA 그룹의 멤버에 의해 제공되는 웹사이트, 응용 프로그램 (어플리케이션) 및 기타 서비스를 의미하며, 아래의 사항을 포함합니다.

a) BitForWin 거래플랫폼 
b) PT. DAE SUNG GEOTEC INDONESIA의 웹사이트에서 다운로드가 가능한 자료;
c) PT. DAE SUNG GEOTEC INDONESIA에서 직접 공개하거나 제공하는 모든 정보, 콘텐츠 및 기타 자료로서 해당 주제와 관련된 모든 내용 일체(리서치/분석, 시장 데이터 또는 블로그 콘텐츠 포함);
d) 위 항목을 보조하는 모든 사람들이 제공하는 정보, 콘텐츠 또는 서비스를 포함.

"거래플랫폼" 이란 ---- 에서 접속할 수 있는 거래 플랫폼과 그 하위 도메인, 모바일 어플리케이션 (BitForWin 모바일 앱 포함), API 및 거래 플랫폼과 관련된 PT. DAE SUNG GEOTEC INDONESIA 소유의 기타 미디어를 의미합니다.


1. 접속 조건

1.1: 서비스 접속 및 이용 시에는 다음 각 호를 준수해야 합니다:

a) (i) 불법적인 활동(암호화폐 텀블러, 다크넷 마켓, 자금세탁 또는 테러 원조를 포함)에 관한 수익금을 포함하거나; (ii) 불법적인 자료나 정보를 공개, 배포, 전파하거나; (iii) 준거법에 위반되거나 위반될 수 있는 활동을 하여서는 아니 됩니다.
b) PT. DAE SUNG GEOTEC INDONESIA의 컴퓨팅 시스템이나 네트워크 또는 서비스가 제3자에 의해 호스팅 되는 경우, 제3자의 컴퓨팅 시스템 및 네트워크의 보안 또는 무결성을 손상시키려는 행위를 하여서는 아니 됩니다.
c) 서비스, 거래 플랫폼 또는 서비스를 제공하는데 사용되는 다른 시스템의 기능을 손상시키거나, 다른 사용자가 서비스 또는 거래 플랫폼을 사용하지 못하도록 방해할 수 있는 방법으로 본 서비스를 사용하거나 오용해서는 아니 됩니다.
d) 거래플랫폼이 호스팅 되어 있는 컴퓨터 시스템 또는 귀하가 명시적으로 접근 권한을 부여받은 자료 이외의 다른 자료에 무단으로 접근하려는 시도를 해서는 아니 됩니다.
e) 거래플랫폼에 다른 사람의 컴퓨터 장치나 소프트웨어에 손상을 입힐 수 있는 파일, 공격적일 수 있는 콘텐츠 또는 위법적인 자료나 데이터(귀하에게 사용할 권리가 없는 저작권이나 영업비밀로 보호되는 데이터 또는 기타 자료 포함)를 전송하거나 입력해서는 아니 됩니다.
f) 본 서비스나 거래플랫폼을 정상적으로 운영하기 위해 사용하는데 반드시 필요한 경우를 제외하고, 본 서비스를 전달하거나 본 거래 플랫폼을 운영하는데 사용되는 컴퓨터 프로그램을 수정, 복사, 편집, 복제, 분해, 디컴파일, 역설계하려는 시도를 하여서는 아니 됩니다.
g) 거래플랫폼에 접속하는데 필요한 모든 사용자 이름과 비밀번호를 안전하게 기밀로 보관하여야 합니다.
h) 귀하의 비밀번호 무단 사용이나 기타 보안 위반 문제가 발생한 경우 즉시 PT. DAE SUNG GEOTEC INDONESIA에 통지해야 하며, PT. DAE SUNG GEOTEC INDONESIA은 그러한 통지에 따라 비밀번호를 재설정합니다.

1.2: 본 서비스 이용에는 관련 어플리케이션 프로그램 인터페이스에 준하여 허용되는 거래량과 통화 횟수를 포함하되, 이에 국한되지 않는 제한 조건이 적용될 수 있습니다. 상기의 제한조건은 공지될 예정입니다.

1.3: 거래 플랫폼에 접속하거나, 회원으로서 서비스에 등록 또는 이를 이용함으로써 귀하는 다음 사항을 진술∙보증하며 이행합니다.

a) 귀하는 본 약관에 동의하였습니다;
b) 귀하는 만 18세 이상 성인이며 본 약관에 동의할 자격이 있습니다.
c) 귀하 (또는 합법적인 권한이 부여된 귀하의 대리인)는 PT. DAE SUNG GEOTEC INDONESIA 계정에 투자하는 자금의 법적 소유자이며 해당 자금의 출처는 합법적입니다;
d) 귀하의 본 서비스 이용은 준거법에 위반되지 아니합니다.
e) 귀하는 PT. DAE SUNG GEOTEC INDONESIA에서 제공하는 본 서비스 이용에 따른 거래 위험을 인지하고 있으며, 이에 관한 위험을 이해할 수 있는 경험과 지식을 보유하고 있습니다. 위와 같은 위험에는 상품 자체의 높은 변동성으로 인해, 시장이 귀하에게 불리하게 변할 경우 거래 계정의 자금 전체를 잃을 수 있다는 사실이 포함됩니다.
f) 만약 아래 사항에 모두 해당될 경우, 귀하는 귀하의 선택과 의지에 따라 직접 서비스를 이용하는 것을 인정하고 동의합니다:
i) 변동성이 매우 큰 시장에 대한 지식 및 경험을 보유하고 있으며;
ii) 손실 발생을 허용할 수 있는 범위의 거래를 하며;
iii) 거래 전반의 높은 위험성을 인지하고 있습니다;
g) 귀하는 위장 주문 등을 비롯한 모든 형태의 시장조작 행위에 가담하거나 이를 조직하지 않습니다.
h) 신원 확인 절차로서 귀하가 제공하는 정보 또는 문서는 정확하고, 진본이며, 최신 정보여야 합니다.
i) 입금 및 출금 계좌는 귀하의 소유이며 해당 계좌에 대한 전적인 통제권을 갖습니다.
j) 귀하가 서비스 제한 지역의 시민, 거주자, 또는 법인일 경우, 귀하는 서비스에 접속하거나 사용할 수 없으며, PT. DAE SUNG GEOTEC INDONESIA은 귀하가 서비스 제한 지역으로부터 서비스에 접속하고 있거나 귀하의 위치, 법인 설립 및 창설 지역, 시민권 또는 거주지에 대하여 허위 진술을 한 경우, 귀하의 계정을 즉시 해지하고 어떠한 오픈 포지션도 청산할 권리가 있습니다.
k) 귀하는 (i) 준거법을 위반하거나; (ii) 준거법에 따라 벌금이 부과되거나, 금지되거나, 제재받거나, 경제적 제재 관련 제한을 부과받거나, 처벌되거나; (iii) 준거법위반 또는 그 위반 가능성을 이유로 정부로부터 구두 또는 서면으로 통보를 받거나; (iv) 귀하가 준거법에 따른 제재, 제한, 벌칙, 집행 또는 조사의 대상이라는 점을 통보받은 사실이 없습니다(준거법에는 자금세탁방지법, 반테러원조법, 부패방지법이나 경제 제재 관련 법률이 포함되나, 이에 국한되지 않습니다).
l) 귀하 또는 귀하의 계열사는 (i) 제재를 받은 자에 의해 소유되거나 운영되고 있지 않고, (ii) 귀하 또는 귀하의 계열사가 본 서비스나 본 거래 플랫폼을 이용하거나 제공받는지 여부와는 무관하게 제재를 받을 위험이 있는 거래, 송금, 행동에 관여하고 있지 않으며; (iii) 서비스 제한 지역에 위치하거나 설립 및 창설되거나, 해당 구역의 시민이나 거주자가 아닙니다.

1.4: 귀하는 각 국가별 PM사에서 지정한 본인인증 절차를 통하여 직접 최초 계정을 만들 수 있습니다.

1.5: PT. DAE SUNG GEOTEC INDONESIA은 인도네시아 자금세탁방지법 또는 기타 준거법을 준수하기 위해 언제든지 귀하의 신원을 확인할 권리가 있습니다.

1.6: 당사는 귀하가 고객주의의무(CDD)를 수행하기 전에 특정 거래 한도를 부과합니다. 귀하는 이 과정에서 당사에게 협조하는 데 동의하고 당사가 만족할 정도로 귀하의 신원 및 사업 관계 목적을 확인하는 데 필요로 할 수 있는 모든 문서/정보를 제공하셔야 합니다.

1.7: 귀하는 귀하의 계정을 통해 제공받거나 실행된 어떠한 거래나 기타 지시사항들이 최종적인 것으로 간주되며, PT. DAE SUNG GEOTEC INDONESIA은 이에 대한 책임이나 의무없이 그러한 지시에 따라 행동할 수 있음에 동의합니다. 거래플랫폼을 통해 제공되는 APIs와 관련하여 귀하는 다음과 같은 사항을 인지하고 동의합니다.

a) PT. DAE SUNG GEOTEC INDONESIA은 귀하의 고유 API키를 가지고 있는 제3자와 귀하의 정보를 공유할 수 있고,
b) PT. DAE SUNG GEOTEC INDONESIA은 귀하의 고유 API키를 소유한 제3자의 지시 (주문 또는 포지션 폐쇄와 관련된 지시 사항을 포함하되 이에 국한되지 않음)를 신뢰하고 이에 따라 행동할 수 있으며, PT. DAE SUNG GEOTEC INDONESIA은 그로 인해 발생한 손실에 관하여 어떠한 책임도 지지 않습니다.

1.8: 당사는 귀하가 의심스러운 거래 또는 다른 활동에 관여했거나 위 보증 또는 본 약관의 조항을 위반했다고 판단되거나 의심할 만한 이유가 있는 경우, 어떠한 계정도 동결할 수 있습니다. 계정이 동결되면 귀하가 실행한 거래를 반대 매매하는 결과를 초래할 수 있습니다. 당사는 당사가 귀하의 거래 포지션을 조기에 폐쇄하거나 귀하가 거래플랫폼에서 거래 능력을 상실함으로 인하여 발생하는 일체의 손실이나 이익을 명시적으로 배제하며, 귀하는 귀하의 행위로 또는 당사의 포지션 조기 폐쇄로 인하여 야기된 제3자의 법적 조치와 관련하여 당사즐 전부 면책하는 데에 동의합니다. 귀하의 계정이 동결된 상태인 동안 당사는 조사를 실시하고, 귀하에게 당사의 조사에 대한 협조를 요구할 수 있습니다. 조사 단계에서 귀하는 귀하의 계정에 입금하거나 인출할 수 없으며 거래할 수도 없습니다. 조사가 끝난 후, 당사는 당사의 재량으로 귀하의 계정을 폐쇄하기로 결정할 수 있으며, 그에 대한 사유를 귀하에게 제공할 의무가 없습니다.

1.9: 당사는 자체 재량으로 언제든지 계정을 폐쇄할 수 있는 권리를 보유합니다.

1.10: 본 서비스를 이용함으로써 귀하는 PT. DAE SUNG GEOTEC INDONESIA이 수익 또는 손실 여부와 상관없이 언제든지 일체의 거래를 청산할 권리를 보유하는 데 동의합니다.

1.11: 당사에게 귀하의 입금 및 출금 계좌를 포함한 정확한 세부 정보를 제공하는 것은 전적으로 귀하의 책임입니다. 당사는 귀하가 잘못된 정보나 더 이상 쓸모 없는 정보를 제공함으로 인하여 인출한 금액을 수령하지 못하는 결과에 대한 일체의 법적 책임을 인정하지 않습니다. 또한 PT. DAE SUNG GEOTEC INDONESIA에 전송한 지시나 주문 또는 거래가 제대로 형식을 갖추고, 명확하며 정확한 통화로 표시되었는지 확인하는 것도 귀하의 책임입니다. PT. DAE SUNG GEOTEC INDONESIA은 계좌로 전송된 모든 잘못된 거래에 관하여 모든 책임을 부담하지 않습니다.

1.12: 당사는 질서 있는 시장을 유지하는 의무를 부담하며, 따라서 당사는 시장혼란 또는 기타 관련 외부 사건이 발생하는 경우 당사의 재량으로 거래플랫폼에서의 거래를 중단할 수 있습니다. 당사는 거래 중단으로 인해 발생했다고 주장하는 손실 또는 이익 상실에 대한 모든 법적 책임을 배제합니다.


2. 수수료

2.1: 귀하는 본 서비스를 이용함으로써 수수료가 부과된다는 것을 인정하고 동의합니다.

2.2: 수수료 관련 세부 내용은 각 PM사별 제공하는 링크에서 확인하실 수 있습니다. 

2.3: PT. DAE SUNG GEOTEC INDONESIA은 자체 재량에 따라 언제든지 해당 수수료를 변경하거나 업데이트 할 수 있습니다. 수수료에 대한 변경 또는 업데이트는 수수료 변경 또는 업데이트가 거래플랫폼에 공개된 효력발생일로부터 그 이후에 발생하는 서비스 (거래 플랫폼상의 거래 포함)에 전적으로 적용됩니다.


3. 지적재산권

3.1: 본 거래 플랫폼과 관련된 모든 지식재산권, 본 거래 플랫폼과 본 서비스에서 사용된 디자인, 구조, 레이아웃, 그래픽 이미지 및 기존 소스코드를 포함하나 이에 한정되지 아니하는 모든 자료는 PT. DAE SUNG GEOTEC INDONESIA에 속합니다. BITMAN365은 상기의 지적 재산권에 대한 모든 권리를 보유합니다.

3.2: 귀하는 당사자 간에 서면으로 별도 합의하지 않는 한, 본 거래 플랫폼과 본 서비스의 PT. DAE SUNG GEOTEC INDONESIA의 모든 지식재산권은 PT. DAE SUNG GEOTEC INDONESIA에 유지된다는 점을 인정합니다.

3.3: 귀하는 본 약관에 명시된 바에 의하거나, 아래 조건들에 따르지 아니하고는 어떠한 PT. DAE SUNG GEOTEC INDONESIA의 지식재산권을 사용할 권리가 없고 사용하여서는 안 됩니다:

a) 귀하는 본 서비스 및 거래플랫폼(또는 그 일부 또는 그 내용의 일부)을 귀하의 개인적 사용을 위하여만 보거나 사용할 수 있고, 본 서비스 및 거래플랫폼(또는 그 일부 또는 그 내용의 일부)를 개인적이지 않거나, 공개 또는 상업적 용도로 PT. DAE SUNG GEOTEC INDONESIA의 사전 서면 동의 없이 복사, 복제, 재출판, 업로드, 재게시, 수정, 전송, 배포하여서는 안 됩니다. 본 약관에서 본 서비스 및 거래플랫폼 사용과 관련된 모든 제한들은 API를 통해 이용 가능한 데이터에 적용됩니다.
b) 귀하는 본 서비스로부터 제공된 저작권, 상표 또는 기타 소유권 고지 문구를 제거하거나 수정할 수 없습니다.
c) 귀하는 어떠한 데이터 마이닝, 로봇 또는 유사한 데이터 수집 또는 추출법을 사용할 수 없습니다.

3.4: 귀하의 콘텐츠를 블로그, 게시판, 포럼 및 API를 포함하여 어떠한 방법으로든 거래플랫폼에 직접 또는 간접적(제3자를 통한 제출 여부와 상관없이)으로 제출하는 경우, 귀하는 PT. DAE SUNG GEOTEC INDONESIA에게 귀하의 콘텐츠(전부 또는 일부)를 사용, 복제, 수정, 개작, 출판, 번역, 2차적 저작물 창작, 배포, 공표하고 전시할 수 있으며, 이러한 콘텐츠에 존재하는 모든 권한의 기간 동안 현재 알려져 있거나 향후에 개발될 형태, 매체 또는 기술의 다른 저작물과 통합할 수 있는 영구적이고, 취소가 불능하며, 양도 가능하고, 서브 라이선스를 부여할 수 있는 비독점적 권리 및 라이선스를 무상으로 허여 합니다. PT. DAE SUNG GEOTEC INDONESIA은 귀하의 콘텐츠에 기반하거나 또는 어떠한 방식으로든 관계가 있는 PT. DAE SUNG GEOTEC INDONESIA에 의해 생산된 2차적저작물의 독점적 소유자이며, 귀하에게 추가적인 의무없이 어떠한 목적, 상업적 또는 기타 목적으로 해당 2차적 저작물을 사용할 권리가 있습니다. 귀하는 또한 거래 플랫폼의 다른 사용자가 개인 용도로 해당 콘텐츠에 접근, 표시, 열람, 저장 및 복제하는 것을 허용합니다. 귀하는 귀하가 세계 어디서든 해당 콘텐츠에 대한 권리를 가질 수 있는 모든 저작 인격권을 포기합니다 (포기할 수 없는 범위 내에서는 해당 권리를 주장하지 않기로 변경 불가능하게 동의합니다). PT. DAE SUNG GEOTEC INDONESIA는 거래플랫폼을 통해 제출된 모든 활동 및 콘텐츠를 감시할 권한이 있지만 의무는 없으며, 단독 재량으로 (i) 콘텐츠 게시, 삭제 또는 수정을 거부하거나 본 약관을 위반한다고 여겨지는 콘텐츠에 대한 접근을 중지할 수 있고, (ii) 귀하의 콘텐츠 제출, 게시 또는 업로드할 기회를 중지 또는 중단할 수 있습니다.

3.5: 귀하가 본 약관에 따라 콘텐츠를 거래플랫폼에 제출함으로써 귀하는 귀하가 본 약관에 따라 이를 제출할 수 있는 권리와 모든 필요한 지식재산권을 보유하고 있다는 것을 보증합니다.

3.6: PT. DAE SUNG GEOTEC INDONESIA은 귀하가 거래플랫폼에 게시하거나 업로드한 콘텐츠가 자신의 지식재산권 또는 프라이버시를 침해한다고 주장하는 제3자에게 귀하의 신원을 공개할 권리가 있습니다.


4. 개인정보 고지사항

4.1: PT. DAE SUNG GEOTEC INDONESIA의 개인정보 보호 및 데이터 보호 관행에 대한 자세한 내용은 웹페이지의 개인정보 보호 정책을 참조하십시오.  


5. 제3자 웹사이트

5.1: PT. DAE SUNG GEOTEC INDONESIA는 관계사가 아니거나 제휴되지 아니한 제3자의 웹사이트 등에 링크를 할 수 있으며 (거래 플랫폼 또는 서비스와 관련된 브랜딩, 광고 또는 링크는 웨바이트에 표시될 수 있음), PT. DAE SUNG GEOTEC INDONESIA는 귀하에게 광고 또는 판촉을 포함한 제3자에 대한 링크를 포함한 이메일 메시지를 보낼 수 있습니다. PT. DAE SUNG GEOTEC INDONESIA는 링크된 웹사이트에서 또는 해당 웹사이트에서 제공되는 모든 제품 및 서비스의 품질, 적합성, 기능성 또는 합법성에 대해 어떠한 보장도 하지 않습니다. 이 자료는 귀하의 관심과 편의를 위해서만 제공됩니다. PT. DAE SUNG GEOTEC INDONESIA는 그러한 제3자 웹사이트를 모니터하거나 조사하지 않으며 PT. DAE SUNG GEOTEC INDONESIA는 해당 콘텐츠로 인해 발생한 손실, 자료의 정확도 그리고 그 자료에서 표현된 의견에 대하여 어떠한 책임도 지지 않으며 해당 자료에 명시된 의견은 보증 또는 권장 사항 또는 PT. DAE SUNG GEOTEC INDONESIA의 구성원의 의견으로 간주되어서는 안 됩니다.

5.2: PT. DAE SUNG GEOTEC INDONESIA가 사전 동의를 제공하지 않는 한, 어떠한 경우에도 귀하는 거래플랫폼의 페이지에 하이퍼링크를 생성할 수 없습니다. 귀하가 본 거래 플랫폼의 페이지에 대하여 링크를 생성하는 경우 귀하는 링크의 직접 또는 간접적인 결과에 대한 모든 책임이 귀하에게 있음을 인정하며, 링크로부터 또는 링크와 관련하여 발생하는 모든 손실, 책임, 경비 또는 비용에 대한 요구가 있을 경우 즉시 PT. DAE SUNG GEOTEC INDONESIA의 각 구성원을 면책합니다.


6. 보증 및 진술

6.1: 귀하는 다음과 같은 사항을 진술, 보증 및 이행합니다.
a) 귀하는 본 서비스 및 거래플랫폼에 접속하고 사용할 수 있는 권한이 있습니다. 특히, 귀하가 위치하거나, 등록 또는 설립되거나 또는 귀하가 시민 또는 거주민인 곳의 각 관할 구역은 귀하가 본 거래 플랫폼과 본 서비스를 이용할 수 있도록 허락합니다.
b) 귀하가 타인 또는 기관의 이익을 위해 또는 대신하여 거래 플랫폼을 사용하는 경우, 이에 대한 권한이 있어야 합니다. 해당 관련자 또는 기관은 본 약관의 위반을 포함하여 귀하의 행동에 대해 책임을 져야합니다.
c) 거래플랫폼 및 본 서비스의 이용은 귀하의 책임하에 이루어집니다. 귀하는 PT. DAE SUNG GEOTEC INDONESIA이 귀하의 거래플랫폼 및 본 서비스 사용으로 인하여 발생하는 어떠한 손실에 대해서도 책임지지 않는다는 점에 동의합니다.

6.2: 귀하는 다음 사항을 인정하고 동의합니다.
a) 거래 플랫폼에 제공된 정보는 일반적인 정보만을 위한 것이며 선의로 제공됩니다. 그러나 해당 정보는 선택적이며 PT. DAE SUNG GEOTEC INDONESIA은 모든 정보를 검증하지 않을 수도 있습니다. 따라서 귀하의 목적을 위해 완전하지 않거나 정확하지 않을 수 있으므로 귀하는 해당 정보에 대한 추가적인 조사없이 신뢰해서는 아니 됩니다. 정보 및 서비스는 특정 방식으로 PT. DAE SUNG GEOTEC INDONESIA이 제공한 서비스를 거래하거나 참여시키기 위한 제안이나 권장으로 해석되어서는 안되며, 해당 정보는 특정인의 투자 목적이나 재정상황을 고려하지 않습니다.
b) PT. DAE SUNG GEOTEC INDONESIA은 거래플랫폼의 사용이 중단되지 않거나 오류가 없음을 보증하지 않습니다. 무엇보다도 공중전화 서비스, 컴퓨터 네트워크 및 인터넷을 포함하여 거래플랫폼에 접속하는 데 사용되는 시스템의 작동 및 가용성은 예측이 불가능하며, 거래플랫폼에 대한 접근을 때때로 방해하거나 차단할 수 있습니다. PT. DAE SUNG GEOTEC INDONESIA은 거래플랫폼 및 본 서비스의 접속 또는 사용을 방해하는 간섭에 관하여 어떠한 책임도 지지 않습니다.

6.3: PT. DAE SUNG GEOTEC INDONESIA은 거래 플랫폼에서 거래되는 상품을 거래하는 협력사를 가지고 있습니다. 협력사는 주로 시장조정자 역할을 합니다. 협력사는 거래플랫폼의 사업 부분과 구분되고 구별되도록 조직되었습니다. 구체적으로, 협력사와 거래플랫폼 사이에 경영 본부 인력이 공유되지 않으며, 협력사의 직원은 거래를 수행하는 동안 거래플랫폼의 직원과 분리되어 있어 협력사는 다른 플랫폼 사용자가 이용할 수 없는 조건으로 거래 플랫폼의 주문 흐름, 실행, 고객 또는 기타 정보에 접근할 수 없습니다. 또한 PT. DAE SUNG GEOTEC INDONESIA의 특정 상품 조항에 달리 명시되어 있지 않는 한, 협력사는 다른 사용자가 사용할 수 있는 것과 동일한 조건으로만 접속 및 거래 권한을 부여 받습니다.

6.4: 귀하는 거래플랫폼에 대한 접속 및 사용 권한을 취득하고 사업 목적을 위해 본 약관에 동의하고 있다는 점을 진술하고 보증하며, 관할 거주지역의 준거법이 허용하는 최대 범위 내에서 비사업적 소비자를 보호하기 위한 소비자 보호 조항 또는 법률은 본 약관에 따라 제공되는 거래 플랫폼에 적용되지 않음을 진술하고 보증합니다.


7. 서비스의 정확성 및 가용성

7.1: 귀하는 거래플랫폼을 통해 제공되는 어떠한 서비스도 귀하 또는 제3자에게 투자에 대한 자문 또는 특정 상품 또는 투자에 대한 홍보, 프로모션 제공에 해당하지 아니하함을 인정하고 이에 대해 동의하며 이해합니다. 귀하는 귀하가 PT. DAE SUNG GEOTEC INDONESIA이 본 서비스 이용과 관련하여 제공하는 데이터나 정보에 의존하여 발생하는 손실, 손해 또는 비용에 대해 전적으로 귀하에게 책임이 있음을 인정합니다. 귀하는 서비스 접근 및 사용을 위한 독자적인 결정을 내려야 합니다.

7.2: 준거법에 의거하여 허용되는 한도 내에서 PT. DAE SUNG GEOTEC INDONESIA이 제공하는 모든 상품, 서비스 또는 기타 품목은 “있는 그대로” 및 “사용 가능한대로” 제공되며, PT. DAE SUNG GEOTEC INDONESIA은 상품성, 특정 목적에의 적합성, 비침해에 대한 적합성, 수행과정에서 발생하는 보증을 포함하여 명시적 또는 묵시적인 어떠한 보증도 명시적으로 부인하고 귀하는 이러한 모든 보증을 포기합니다. 전술한 사항을 제한하지 않고, PT. DAE SUNG GEOTEC INDONESIA은 서비스가 정확하고 신뢰할 수 있으며 오류, 바이러스 또는 기타 유해한 요소가 없음을 진술하거나 보증하지 않습니다.

7.3: PT. DAE SUNG GEOTEC INDONESIA은 귀하가 서비스를 이용할 수 있도록 합리적인 노력을 기울여야 합니다. 그러나 필요한 유지보수, 기술적 문제, 네트워크 및 시스템 과부하 또는 PT. DAE SUNG GEOTEC INDONESIA의 통제를 벗어난 상황으로 인하여 서비스 접근이 때때로 중단될 수 있습니다. PT. DAE SUNG GEOTEC INDONESIA은 예상 피크 시간 동안 서비스 중지 시간 방지를 위해 상업적으로 합리적인 노력을 다하지만 서비스가 언제든지 또는 어느 기간에 중단되어도 (거래 관련 손실을 불문하고) 그에 대한 책임을 부담하지 않습니다.

7.4: 귀하는 다음 사항을 인정하고 이에 동의합니다:
a) PT. DAE SUNG GEOTEC INDONESIA은 정확성, 품질, 정확성, 보안, 완전성, 확실성, 성능, 적시성, 가격, 서비스의 지속성 (거래 플랫폼 포함), 서비스의 지연 또는 누락, 서비스에 대한 접속을 제공하거나 유지하는 연결 도는 통신 서비스의 고장, 귀하의 접속 방해 또는 PT. DAE SUNG GEOTEC INDONESIA과 귀하 간의 통신 오류 또는 장애에 대해 귀하 또는 제3자에게 어떠한 책임도 지지 않습니다.
b) PT. DAE SUNG GEOTEC INDONESIA은 서비스 또는 기술적 문제, 시스템 고장, 오작동, 통신회선 고장, 높은 인터넷 트래픽 또는 수요, 관련 문제, 보안 침해 또는 유사 기술적 문제 또는 결함에 대해 어떠한 의무 또는 책임을 지지 않습니다. 서비스를 이용할 목적으로 인터넷에 접속하기위해 발생하는 모든 비용은 귀하가 책임을 집니다.
c) 귀하는 서비스에 접속하는데 사용되는 귀하의 하드웨어에 관하여 책임이 있으며, 귀하의 하드웨어에 저장된 서비스 관련 데이터의 보전 및 적절한 저장에 대한 책임도 있습니다. 귀하는 바이러스, 악성 소프트웨어 및 부적절한 자료로부터 하드웨어 및 데이터를 보호하기 위해 적절한 조치를 취할 책임이 있습니다. 적용가능한 법률(준거법)에 명시된 경우를 제외하고, 귀하는 서비스를 통해 저장하거나 전송하는 모든 정보의 사본을 백업하고 유지할 책임이 있습니다. 귀하의 하드웨어 고장, 손상, 파손 또는 하드웨어에 저장된 기록 또는 데이터가 어떠한 이유로 손상되거나 손실되는 경우, PT. DAE SUNG GEOTEC INDONESIA은 귀하에게 어떠한 책임도 부담하지 않습니다.

7.5: 서비스 오작동, 거래 오류, 기타 서비스에 대한 접속 또는 사용에 부정적인 영향을 미치는 중대한 기능 불량, 또는 기타 연결 문제가 발생하는 경우, 귀하는 PT. DAE SUNG GEOTEC INDONESIA에게 즉시 통보해야 합니다.

7.6: 귀하는 서비스 제한 지역으로 여행하는 경우, 당사의 서비스를 이용할 수 없고 서비스에 대한 귀하의 접근이 차단될 수 있다는 것을 인정하고 동의하며 이해합니다. 귀하는 위와 같은 사항들이 거래플랫폼에서 거래하거나 기존 주문이나 오픈 포지션을 모니터링하거나 서비스를 사용하는 능력에 영향을 미칠 수 있음을 인정합니다. 인터넷 프로토콜 주소를 수정하기 위해 가상 사설 네트워크를 사용하는 것을 포함하여 이러한 제한을 피해가려는 시도를 해서는 안됩니다.

7.7: 귀하는 가격 제공에 대한 지연 대기시간을 포함하여 BitForWin 모바일 앱과 같은 모바일 거래 기술의 사용에 따른 일련의 내재적 위험요소가 있다는 것을 인정하고 동의합니다. PT. DAE SUNG GEOTEC INDONESIA은 귀하의 모바일 앱 사용과 관련하여 신호의 강도, 휴대폰 지연 시간, 귀하와 인터넷 서비스 제공 업체, 전화 서비스 제공 업체 또는 기타 서비스 제공 업체 간에 발생할 수 있는 기타 문제를 포함하여 네트워크 회선 상의 전송문제로 가격 제시가 지연되거나 또는 직접 통제할 수 없는 기타 문제가 발생하는 모든 상황에 관하여 책임을 지지 않습니다. 또한, 거래플랫폼에서 이용할 수 있는 기능 중 일부는 BitForWin 모바일 앱에서 이용할 수 없을 수도 있습니다. 또한 사용자는 서비스 제공을 유지하기 위해 BitForWin 모바일 앱의 업데이트 버전을 다운로드하고 설치하도록 요구받을 수 있습니다. 이를 실행하지 않으면 해당 업데이트가 다운로드 되고 설치될 때 까지 서비스의 특정부분 (거래 기능 포함)에 일시적으로 접속이 불가능할 수도 있습니다.

7.8: 귀하는 특정 서비스 (PT. DAE SUNG GEOTEC INDONESIA이 때때로 제작, 개발 또는 게시할 수 있는 소프트웨어 포함)가 배포 시점에 테스트중인 베타 버전 (이하 “개발서비스”)일 수 있음을 인정하고 이에 동의하고 이해합니다. 결과적으로 개발 서비스는 불안정하고 때때로 변경될 수 있습니다. PT. DAE SUNG GEOTEC INDONESIA은 개발 서비스의 기능이 귀하의 요구사항을 충족하거나 개발 서비스의 운영이 중단되지 않거나 오류가 없음을 보증하지 않습니다. PT. DAE SUNG GEOTEC INDONESIA은 어떠한 이유로든 (개발 서비스 포함) 서비스를 중단, 재설계, 수정, 향상 또는 변경할 수 있는 권한을 보유합니다.


8. 면책

8.1: 귀하는 귀하 또는 귀하의 권한을 위임받은 대리인이 아래의 각 호와 같은 행위로 인해 직접적 또는 간접적으로 발생하는 모든 요구, 주장, 고소, 소송, 조치, 조사, 책임 및 합리적인 변호사 비용을 포함한 손실, 비용 또는 경비에 대한 모든 클레임으로부터 PT. DAE SUNG GEOTEC INDONESIA의 각 구성원 및 이사, 임원, 직원, 대리인, 도급업자, 라이선스 제공자 (이하 “관련당사자”)를 요청에 따라 즉시 면책하고 보호하는데 동의합니다.
a) 서비스의 사용 또는 서비스와 관련한 행위,
b) 본 약관 또는 PT. DAE SUNG GEOTEC INDONESIA의 정책 위반, 또는
c) 적용가능한 법률(준거법) 위반, 타인 또는 기관의 권리 침해


9. 책임 한도

9.1: 본 약관의 어떤 조항도 PT. DAE SUNG GEOTEC INDONESIA 또는 관련 당사자들의 다음과 같은 책임을 배제하거나 제한하지 않습니다:

a) 사기; 또는
b) 관련법에 의해 제외되거나 제한될 수 없는 기타 사항

9.2: 전 항의 규정에 의거하여, 적용 가능한 법률(준거법)이 허용하는 최대 한도까지 다음 사항을 준수합니다:
a) 어떠한 경우에도 PT. DAE SUNG GEOTEC INDONESIA 또는 관련 당사자는 다음과 같은 사항에 대하여 책임을 지지 않습니다.
i) 간접적 또는 결과적 손실, 또는
ii) PT. DAE SUNG GEOTEC INDONESIA의 권한을 위임받은 대리인 또는 관련 당사자가 이러한 손해의 가능성을 알았거나 해당 사실을 알았어야 했음에도 불구하고, 계약의 위반, 불법행위 (과실 포함), 법적 의무의 위반, 본 약관 또는 서비스의 인가되거나 인가되지 않은 사용과 관련하여 발생한 모든 경우의 이익, 사업 기회, 수익 또는 영업권 손실에 대한 책임.
b) PT. DAE SUNG GEOTEC INDONESIA 그룹 및 관련 당사자의 본 약관의 의무이행으로 인하여 또는 관련하여 발생하는 하나 이상의 사고와 관련한 모든 채무불이행, 불법행위, 또는 기타 (과실 또는 부작위에 대한 책임을 포함)의 총 책임은 사고 발생일로부터 직전 6개월 동안 또는 일련의 연쇄 사고 중 본 약관에 따라 귀하가 제기한 청구가 발생한 첫 사고 발생일로 부터 직전 6개월 동안 PT. DAE SUNG GEOTEC INDONESIA이 귀하로부터 본 거래 플랫폼 사용 관련 거래수수료로 의 총 순액으로 제한됩니다.

10. 계산

10.1: 본 거래 플랫폼의 거래 (트레이딩) 엔진이 수행하는 모든 계산값은 PT. DAE SUNG GEOTEC INDONESIA에서 검증한 최종 값을 나타냅니다. 제7조에 명시된 바와 같이, PT. DAE SUNG GEOTEC INDONESIA은 거래플랫폼의 사용이 중단되거나 아무런 오류가 없다는 점을 보증하지 않습니다.


11. 귀하의 본 약관 귀반에 대한 해지 및 구제

11.1: PT. DAE SUNG GEOTEC INDONESIA은 본 약관 위반에 대해, 별도의 고지 없이 귀하의 계정을 제한, 정지 또는 해지하거나 귀하의 거래플랫폼 접속을 거부할 권리를 포함하나 이에 국한되지 않는, 법률상 및 형평법상 행사할 수 있는 모든 구제책을 모색할 권리를 보유합니다.
a) PT. DAE SUNG GEOTEC INDONESIA은 법 집행 기관의 문의 (귀하의 신원 및 개인정보를 포함하되, 이에 국한되지 아니함)에 대해 관련 법률에 따라 해당 문의가 의무적인지 여부에 관계없이 정보를 공개할 수 있습니다.


12. 비밀 유지

12.1: 귀하는 거래플랫폼을 이용하는 과정에서 습득할 수 있는 어떠한 기밀 정보를 타인에게 공개하거나 유출하지 않을 것을 약속합니다.

12.2: 본 약관에서 “비밀 정보” 란 비밀이거나 영업비밀, 또는 독점적인 정보로서 공개될 때 기밀임이 명확하게 식별되거나 합리적인 사람이라면 공개를 둘러싼 상황에서 비밀로 간주할 수 있는 모든 서면 정보(전자형식으로 제공된 정보 포함) 또는 구두 정보를 의미합니다. 위 조항에도 불구하고, 비밀정보는 다음의 사항을 포함하지 아니합니다; (i) 당사로부터 취득하기 전에 귀하가 이미 알고 있는 정보; (ii) 이미 공개적으로 알려진 정보 또는 귀하의 부당하지 아니한 행위에 의하여 공개적적으로 알려지게 된 정보; (iii) 귀하가 다른 관련 기밀 유지 의무 위반한 사실을 알지 못한 채로 제3자로부터 정당하게 취득한 정보; (iv) 귀하가 독자적으로 개발한 정보. 본 조항에 따른 비밀유지 의무는 귀하가 아래 규정된 사람 또는 기관에게 비밀 정보를 공개하는 것을 제한하지 않습니다. (A) 당사의 서면 허가에 의거한 제3자; 또는 (B) 관할 법원, 재판소, 정부, 행정 또는 규제기관의 권한이나 요구를 충족해야 할 경우 관련법에서 허용되는 범위에 따라 PT. DAE SUNG GEOTEC INDONESIA 측에 사전 고지를 하고 제공하는 경우


13. 포기 제한

13.1: PT. DAE SUNG GEOTEC INDONESIA이 본 약관에 대한 집행 또는 이에 따른 권리를 행사하지 아니하거나 지연하더라도 해당 권리를 포기하는 것으로 간주되지 않습니다.


14. 불가항력

14.1: 어느 당사자도 천재지변, 폭동, 전쟁, 악의적 손상 행위, 화재, 정전, 정부의 권한 및 법령 등 당사자의 합리적 통제 범위를 벗어난 사유로 인해 그 의무 이행이 지연된 점에 있어 책임이 부과되지 않습니다.


15. 조항의 독립성

15.1: 본 약관의 조항 중 법원이 무효, 집행 불능 또는 불법이라고 판결한 조항이 있더라도, 다른 조항의 효력과 집행 가능성에 영향을 미쳐서는 안 됩니다. 집행 불능인 것으로 판단되는 조항이 있을 경우, 귀하는 관련법에서 허용하는 한도까지, PT. DAE SUNG GEOTEC INDONESIA이 해당 조항이 조항 집행 취지를 갖도록 변경하는 데 동의합니다.


16. 준거법

본 약관 및 이와 관련하여 발생하는 비계약 상의 의무 등에 관한 사항은 모두 인도네시아 법률에 따라 규율되고 이에 따라 해석됩니다. 국제비즈니스기업법은 인도네시아에서 기준을 규준하는 주요 입법입니다.


17. 분쟁 해결

귀하의 관할권에 적용되는 관련 법률에 따라, 인도네시아 법원은 본 약관에서 발생하는 분쟁을 해결하기 위한 비독점적 관할권을 갖습니다 (이는, 본 약관의 성립 및 유효성, 종료에 관한 분쟁, 무효에 따른 결과에 관한 분쟁 및 본 약관과 관련되거나 본 약관으로 인하여 발생하는 비계약적 의무에 관한 분쟁을 포함합니다).
                    </textarea>
                    <div class="form-group mt-3">
                        <input type="checkbox" id="chk3" name="chk3" value="Yes" class="custom-checkbox mr-2">
                        <label for="checkbox" class="label-text">서비스 이용약관에 동의합니다.</label>
                        <span class="errorchk3"></span>
                    </div>
                </div>

                <div class="flex-container">
                    <button type="button" class="btn btn-signup_grp btn_signup_gray"><a href="./signup">취소</a></button>
                    <button class="buttonload btn-signup_grp" style="display: none;" id="loading_btn">
                        <i class="fa fa-spinner fa-spin"></i>로딩</button>
                    <button type="submit" id="register_btn" class="btn btn-signup_grp btn_signup_blue">회원가입</button>
                </div>
            </div>
        </form>
    </div>

    <!-- modal -->
    <?php include __DIR__ . '/includes/modal.php';?>

    <!-- Footer -->
    <?php include __DIR__ . '/includes/footer.php';?>

    <!-- script -->
    <?php include __DIR__ . '/includes/script.php';?>

    </body>
</html>
