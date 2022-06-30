
$(function(){

    // $.post("php/api/user/postGameResultUpdateETH.php",function(jsondata) {
    //     for(i = 0; i < jsondata.length; i++){
    //     var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
        
    //     $.post("php/api/user/postbettingTransactionETH.php", JSON.stringify(arr), function(jsondata) {
    //         if(jsondata){
    //             getBettinguserhistory();
    //         }
    //     });
    //     }
    // });

    $.post("php/api/user/getTotalBinanceHistoryGroupETH.php",function(jsondata) {
        for(i=0 ; i < jsondata.length ; i++){
            if(i < 150){
            }else{
                var arr = {"r_Id": jsondata[i].r_Id};
                $.post("php/api/user/postHistoryGroupUpdateETH.php", JSON.stringify(arr), function(jsondata) {
                    if(jsondata){
                        getBettingHistoryGroup();
                    }
                });
            }
        }

    });

    // var resultSound;
    // function loadstation(){
    //         $.ajax({
    //             "url": "php/api/user/checkForceLogout.php",
    //             "type": "GET",
    //             "contentType": "application/json",
    //             "async": false,
    //             success: function(response) {
    //                 var soundChecker;
    //                 soundChecker = response['sounds'][0]['u_Access_Code'];
    //                 // Refresher for new message && Sound
    //                 console.log(soundChecker);
    //                 if(soundChecker == 1){
    //                     resultSound = new Audio('../assets/audio/result.mp3');
    //                     resultSound.muted = false;
    //                     resultSound.pause();
    //                 }
    //                 else{
    //                     resultSound = new Audio('../assets/audio/query.mp3');
    //                     resultSound.muted = true;
    //                     resultSound.pause();
    //                 }
    //             }
    //         });
    //     setTimeout(loadstation, 10000);
    // }


    init();
    var isBet;
    var isDone;
    var oldTime;
    var serverTime;
    
    function init() {
        websocket = new WebSocket('wss://stream.binance.com:9443/ws');
        websocket.onopen = function() { //connection is open //
            websocket.send(JSON.stringify ({
                'method': 'SUBSCRIBE',
                'params': ['ethusdt@trade'],
                'id': 2
            }))
        }

        websocket.onmessage = function(e) {
            var stock = JSON.parse(e.data); 
            var timekr =  moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(timekr).getTime());
            var mytimeunix = conunix / 1000;
            var time = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm");

            if(mytimeunix != oldTime){
                betRemDisabled();
                
                oldTime = mytimeunix;
                serverTime = time;
                datetime_today(timekr);

                isBet = false;
                isDone = false;

                var now = Date.parse(serverTime);
                var seconds = Math.floor((now / 1000) % 60);
                var minutes = Math.floor((now / 1000 / 60) % 60);
                var left_to_min = 60 * 60 * 1000 - (minutes * 60 + seconds) * 1000;
                var timeclock = new Date(now + left_to_min);

                initializeClock('.initializeTime', timeclock);
            }

        };


        websocket.onerror = function(ev){
            console.log("Error"+ ev);

        };
        websocket.onclose = function(ev) {
            console.log("Close "+ ev);

            init();
        };
    }

    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((new Date() / 1000 / 60) % 60);
        // var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        // var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
          'total': t,
        //'days': days,
        //'hours': hours,
          //'minutes': minutes,
          'seconds': seconds
        };
    }
    


    
    function initializeClock(cl, endtime) {
        getBettinghistory();
        getBettingHistoryGroup();

        var clock = document.querySelector(cl);
        var sTimeClock = clock.querySelector('.timeclock');
        var start;
        var end;

        $.ajax({
            "url": "php/api/user/getBettingSettings.php",
            "type": "GET",
            "contentType": "application/json",
            "async": false,
            success: function(response) {
                start = response[0]['s_Start'];
                end = response[0]['s_End']; 
           }
        })

        function updateClock() {
            var t = getTimeRemaining(endtime);
            sTimeClock.innerHTML = ('0' + t.seconds).slice(-2) + '초';
            $('.mtimeclock').text(('0' + t.seconds).slice(-2) + '초');

            var mytime = moment.tz(moment(serverTime),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
            var mytimeunix = conunix / 1000;
            var time = [{time: mytimeunix}];

            var conunix1 = Math.floor(new Date(mytime).getTime());
            var mytimeunix1 = conunix1 / 1000;
            var unixtime = mytimeunix1;

            if(!isBet){
                $.post( "php/api/user/checkTimeBetPerMinETH.php", JSON.stringify(time), function( res ) {
                
                    if(res.length > 0){
                        isBet = true;
                    }else{
                        isBet = false;
                    }
                });
            }

            if(!isDone){
                $.post("php/api/user/getGameResultETH.php", JSON.stringify(unixtime), function(jsondata) {
                    if(jsondata[0].r_Time_Unix == unixtime){
                    isDone = true;
                    // resultSound.play();
    
                    $('.text_result').css('display','block');
                    $('.game_field').addClass('game_field_opa');
                    ///////update result
                    ///////game result
    
                    var check = convertUnixtoTime(jsondata[0].r_Time_Unix);
    
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('.price_result').html('<span style="color: #E32529;">'+jsondata[0].r_Price_Result+'</span>');
                    }else{
                        $('.price_result').html('<span style="color: #0066ff;">'+jsondata[0].r_Price_Result+'</span>');
                    }
                    $('.time_result').html('<span style="color: #000000;">'+check+'</span>');
                    if(jsondata[0].r_Game_Result == '매수'){
                        $('#text_title_result').html('<span style="color: #E32529; font-weight: 700;">매수 실현.</span>');
                    }else if(jsondata[0].r_Game_Result == '매도'){
                        $('#text_title_result').html('<span style="color: #0066ff; font-weight: 700;">매도 실현.</span>');
                    }else{
                        $('#text_title_result').html('<span style="color: #FFFFFF; font-weight: 700;">무효처리 되었습니다.</span>');
                    }
    
                    $.post("php/api/user/postGameResultUpdateETH.php", function(jsondata) {
                        for(i = 0; i < jsondata.length; i++){
                            var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
                            $.post("php/api/user/postbettingTransactionETH.php", JSON.stringify(arr), function(jsondata) {});
                        }
                    });
                  
                   
                    $.post("php/api/user/getTotalBinanceHistoryGroupETH.php",function(jsondata) {
                        for(i=0 ; i < jsondata.length ; i++){
                            if(i < 150){
                            }else{
                                var arr = {"r_Id": jsondata[i].r_Id};
                                $.post("php/api/user/postHistoryGroupUpdateETH.php", JSON.stringify(arr), function(jsondata) {
                                    if(jsondata){
                                        getBettingHistoryGroup();
                                    }
                                });
                            }
                        }
                    });
                    setTimeout(closeResult, 3000)
                    }
                });
            }

            if(end >= t.seconds || isBet == true){
                betDisabled();
            }
            if(start <= t.seconds && isBet == false){
                betRemDisabled();
            }
            
            if(t.seconds < 0){
                location.reload(true);
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
    }


    function closeResult(){
        getBettinghistory();
        getBettinguserhistory();
        getBettingHistoryGroup();
        $('.game_field').removeClass('game_field_opa');
        $('.text_result').css('display','none');
    }

    function datetime_today(time){
        var date = new Date(time);
        var d = date.getDate().toString().substr(-2);
        var h = ("0" + date.getHours()).substr(-2);
        var m = ("0" + date.getMinutes()).substr(-2);
        var formattedTime = d + '일 ' + h + '시 '+ m + '분';
    
        $('#datetoday').text(formattedTime);
    }
    
    //display user all bet history
    function getBettinghistory(){
        var html = '';
        $.ajax({
            "url": "php/api/user/getBinanceHistoryETH.php",
            "type": "GET",
            "contentType": "application/json",
            "async": false,
            success: function(response) {
                // console.log(response[0].r_Game_Result);
                var nextprocessTime =  convertUnixtoTimeplus1(response[0].r_Time_Unix);
                var onprocessTime = (response[0].r_StatusId != 0) ? convertUnixtoTimeplus1(response[0].r_Time_Unix) : convertUnixtoTime(response[0].r_Time_Unix);
                var open = parseFloat(response[0].r_Open);

                html += '<tr>';
                html += '<td class="binance_result">'+onprocessTime+'</td>';
                html += '<td>-</td>';
                html += '<td class="binance_result">진행중</td>';
                html += '</tr>';
                response.forEach(function(element){
                    var open = parseFloat(element.r_Open);
                    if(element.r_StatusId > 0){
                        html += '<tr>';
                        html += '<td class="binance_result">'+convertUnixtoTime(element.r_Time_Unix)+'</td>';
                        html += '<td class="binance_result">'+element.r_Open+'</td>';
                        if(element.r_Game_Result == "매수"){
                            html += '<td class="binance_result" style = "color: #ED5659" >매수</td>';
                        }
                        else if(element.r_Game_Result == "매도"){
                            html += '<td class="binance_result" style = "color: #1072BA" >매도</td>';
                        }
                        else{
                            html += '<td class="binance_result" style = "color: #888888" >무효</td>';
                        }
                        html += '</tr>';
                    }
                })
                $('#tbody').html(html);
            }
        })
    }
    //display user bet history
    function getBettinguserhistory(){
        var html = '';
        var formatter = new Intl.NumberFormat();
        $.ajax({
            "url": "php/api/user/getBinanceUserHistoryETH.php",
            "type": "GET",
            "contentType": "application/json",
            "async": false,
            success: function(response) {
                response.forEach(function(element){
                    html += '<tr>';
                    html += '<td class="user_time">'+convertUnixtoTime(element.b_time)+'</td>';
                    if(element.b_Trend == "매수"){
                        html += '<td class="user_trend" style="color: #ED5659;">매수</td>';
                    }else{
                        html += '<td class="user_trend" style="color: #1072BA;">매도</td>';
                    }
                    html += '<td class="user_amount">'+formatter.format(element.b_betAmount)+'</td>';
                    if(element.b_Result == 0 || element.b_Result == null){
                        html += '<td class="user_result" style="color: #000000;">진행중</td>';
                    }else if(element.b_Result == 1){
                        html += '<td class="user_result" style="color: #1072BA;">실현</td>';
                    }else if(element.b_Result == 2){
                        html += '<td class="user_result" style="color: #ED5659;">실격</td>';
                    }else{
                        html += '<td class="user_result" style="color: #888888;">무효</td>';
                    }
                    html += '</tr>';
                })
                $('#tbody_history').html(html);
            }
        })
    }

    function getBettingHistoryGroup(){
        $.ajax({
            "url": "php/api/user/getBettingHistoryGroupETH.php",
            "type": "GET",
            "contentType": "application/json",
            "async": false,
            success: function(response) {
                
                $(document).ready(function(){
                    $('#display_trade_group').scrollLeft(5000);
                })

                result = [];
                response.reduce(function (r, a) {
                    if (a.r_Game_Result !== r) {
                        result.push([]);
                    }
                    result[result.length - 1].push(a);
                    return a.r_Game_Result;
                    }, undefined);
                var d = JSON.stringify(result, 0, 4);
                var jsonParse = JSON.parse(d);
                var html = '';
                html += '<tr>';
                jsonParse.forEach(function(el){
                    html += '<td>';
                    if(el[0].r_Game_Result == '매수'){
                        html += '<p style="background: #EEEEEE; color: #ED5659; padding: 3px 0 0 8px; font-weight: 700; height: 30px;">매수</p>';
                    }else if(el[0].r_Game_Result == '매도'){
                        html += '<p style="background: #EEEEEE; color: #1072BA; padding: 3px 0 0 8px; font-weight: 700; height: 30px;">매도</p>';
                    }else{
                        html += '<p style="background: #EEEEEE; color: #888888; padding: 3px 0 0 8px; font-weight: 700; height: 30px;">무효</p>';
                    }
                    el.forEach(function(ele){
                        if(ele.r_Game_Result == '매수'){
                            html += '<button type="button" class="btn trend_output btn_result" style="background: #ED5659;" data-time="'+ele.r_Time_Unix+'">'+convertUnixtoTimeTrade(ele.r_Time_Unix)+'</button><br>';
                        }else if(ele.r_Game_Result == '매도'){
                            html += '<button type="button" class="btn trend_output btn_result" style="background: #1072BA;" data-time="'+ele.r_Time_Unix+'">'+convertUnixtoTimeTrade(ele.r_Time_Unix)+'</button><br>';
                        }else{
                            html += '<button type="button" class="btn trend_output btn_result" style="background: #888888;" data-time="'+ele.r_Time_Unix+'">'+convertUnixtoTimeTrade(ele.r_Time_Unix)+'</button><br>';
                        }
                    })
                    html += '</td>';
                })
                html += '</tr>';
                $('#display_trade_group').html(html);
                $(".btn_result").click(function(){
                    var time = $(this).data('time');
                    
                    $.ajax({
                        "url": "php/api/user/getWssResultPerMinETH.php",
                        "type": "POST",
                        "contentType": "application/json",
                        "async": false,
                        "data": JSON.stringify(time),
                        success: function(response) {
                            var json = JSON.parse(response);
                            var result = json.result;
                            var lastresult = json.lastresult;
                            var dresult = '';
                            dresult += '<div class="continer-fluid" style="overflow-y: scroll; height: 800px;">';
                            dresult += '<table class="table table-bordered table-striped">';
                            dresult += '<thead style="position: sticky; top: -1px;">';
                            dresult += '<tr style="background: #545454; color: #FFFFFF; text-align: center;">';
                            dresult += '<th>거래 ID</th>';
                            dresult += '<th>UTC Time</th>';
                            dresult += '<th>Korea Time</th>';
                            dresult += '<th>Price</th>';
                            dresult += '</tr>';
                            dresult += '</thead>';
                            result.forEach(function(element){
                                dresult += '<tr style="text-align: center;">';
                                dresult += '<td>'+element.w_Transaction_Id+'</td>';
                                dresult += '<td>'+element.w_Time_Min_Unix+'</td>';
                                dresult += '<td>'+dateAMPM2(element.w_Time_Kor)+'</td>';
                                dresult += '<td style="font-weight: 700;">'+element.w_Current_Price+'</td>';
                                dresult += '</tr>';
                            })
                            dresult += '<tr style="text-align: center;">';
                            dresult += '<td>'+lastresult.w_Transaction_Id+'</td>';
                            dresult += '<td>'+lastresult.w_Time_Min_Unix+'</td>';
                            dresult += '<td>'+dateAMPM2(lastresult.w_Time_Kor)+'</td>';
                            dresult += '<td style="background: #FF9300; color: #FFFFFF;">'+lastresult.w_Current_Price+'</td>';
                            dresult += '</tr>';
                            dresult += '</tbody>';
                            dresult += '</table>';
                            dresult += '<tbody>';
                            dresult += '</div>';
                            $('.modal-body').html(dresult);
                        }
                    })
                    $("#modal-bi_1m_result").modal('show');
                });
            },error: function (request, status, error) {
                var html = '';
                if(status == 'error'){
                    html += '<p style="text-align: center; color: #888888; padding: 10px;">No records found</p>';
                }
                $('#display_trade_group').html(html);
            }
        })
    }

    function convertUnixtoTime(unix){
        let unix_timestamp = unix
      
        var date = new Date(unix_timestamp * 1000);
        var days = ("0" + date.getDate()).substr(-2);
        var hours = ("0" + date.getHours()).substr(-2);
        var minutes = ("0" + date.getMinutes()).substr(-2);
        var formattedTime = days + '일 ' + hours + '시 '+ minutes + '분';

        return formattedTime;
    }

    function convertUnixtoTimeplus1(unix){
        let unix_timestamp = unix
     
        var date = new Date(unix_timestamp * 1000 + 1000 * 60);
        var days = ("0" + date.getDate()).substr(-2);
        var hours = ("0" + date.getHours()).substr(-2);
        var minutes = ("0" + date.getMinutes()).substr(-2);
        var formattedTime = days + '일 ' + hours + '시 '+ minutes + '분';

        return formattedTime;
    }


    function convertUnixtoTimeTrade(unix){
        let unix_timestamp = unix
       
        var date = new Date(unix_timestamp * 1000);
        var hours = ("0" + date.getHours()).substr(-2);
        var minutes = ("0" + date.getMinutes()).substr(-2);

        var formattedTime = hours + ':'+ minutes;

        return formattedTime;
    } 

    //Trading Button
    function betDisabled(){
        $('#betAmount').attr('disabled',true);
        $('#totalBetAmount').attr('disabled',true);
        $('.btn_dis').attr('disabled',true);
        $('#totalBetAmount').val('');
        $('#betAmount').val('');
        $('.disabler').css('display','block');
    }
    function betRemDisabled(){
        $('#betAmount').attr('disabled',false);
        $('#totalBetAmount').attr('disabled',false);
        $('.btn_dis').attr('disabled',false);
        $('.disabler').css('display','none');
    }

    //Conversion
    function dateAMPM2(time){
        var dateString = time.substr(5, 5);
        var timeString = time.substr(11, 2);
        var timeMins = time.substr(14, 2);
        var timeSec = time.substr(16, 7);
    
        var H = + timeString.substr(0, 2);
        var h = H % 12 || 12;
        var ampm = (H < 12 || H === 24) ? "am" : "pm";
        timeString = dateString + ' ' + h + timeString.substr(2, 3) + ':' + timeMins+timeSec;
        return timeString;
    }

    loadstation();
})


