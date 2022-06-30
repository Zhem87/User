$(document).ready(function() { 
    function getServerTime() {
        return $.ajax({async: false}).getResponseHeader( 'Date' );
    }

    var formatter = new Intl.NumberFormat();
    var times;
    var minimum;
    var maximum;
    var priceWon = 0;
    var bet = 0;
    var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));

    $.ajax({
        "url": "php/api/user/getBettingSettings.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            times = response[1]['s_Multiplier'];
            minimum = response[1]['s_Minimum'];
            
            if(response[1]['s_Maximum'] == 0){
                maximum = 9999999999999;
            }else{
                maximum = response[1]['s_Maximum'];
            }

            $('#multiplier').text('x '+times);
            $('#minimum_bet').text(minimum+' 원');

       }
    })


    $('#bet10k').click(function(){
        bet += 10000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet50k').click(function(){
        bet += 50000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet100k').click(function(){
        bet += 100000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet500k').click(function(){
        bet += 500000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet1m').click(function(){
        bet += 1000000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#bet5m').click(function(){
        bet += 5000000;
        priceWon = bet * times;
        betting(bet,current,priceWon);

        if(bet > current){ bet = 0; }
    })
    $('#reset').click(function(){
        document.getElementById("betAmount").value="";
        document.getElementById("totalBetAmount").value="";
        document.getElementById("betAmount").disabled = false;
        bet = 0;
        priceWon = 0;
    })
    $('#max').click(function(){
        current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
        bet = current;
        document.getElementById("betAmount").disabled = true;
        document.getElementById('totalBetAmount').disabled = true;
        $("#betAmount").val(formatter.format(bet));
        priceWon = Math.round(times * current);
        $('#totalBetAmount').val(formatter.format(priceWon));
    })
    $('input#betAmount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
        
    });
    $('#betAmount').on('change click keyup input paste',(function (event) {
        var formatter = new Intl.NumberFormat();
        var inputValue = Number($(this).val().replace(/[^0-9\.-]+/g,""));
        bet = inputValue;
        document.getElementById('totalBetAmount').disabled = true;
        priceWon = Math.round(times * inputValue);
        var input = ($(this).val() == '') ? 0 : $(this).val();
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",") ;
        });
        if(inputValue > current){
            bet = 0;
            priceWon = 0;
            function showPopUp(){
                my_popup_failed.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                my_popup_failed.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        $('#totalBetAmount').val(formatter.format(priceWon));
    }));
    $('#sellBtn').click(function(){
        //1 - sell , 2 - buy

        if(bet < minimum){
            function showPopUp(){
                $('#min_bet').text(minimum);
                minimum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                minimum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        else if(bet > maximum){
            function showPopUp(){
                $('#max_bet').text(maximum);
                maximum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                maximum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }

        else{
            var mytime = moment.tz(moment(getServerTime()),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
            var mytimeunix = conunix / 1000;
            var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
            var totalBetAmount = Number($('#totalBetAmount').val().replace(/[^0-9\.-]+/g,""));
            var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
            var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : times, trend: 2}];

            if(betAmount > current){
                function showPopUp(){
                    my_popup_failed.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup_failed.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
            }
            else{
                betDisabled();

                function showPopUp(){
                    my_popup.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
                var time = [{time: mytimeunix}];
                    $.post( "php/api/user/checkTimeBetPerMinETH.php", JSON.stringify(time), function( res ) {
                        if(res.length > 0){
                        }else{
                            $.post( "php/api/user/postPurchaserequestETH.php", JSON.stringify(arr), function( res ) {
                                priceWon = 0;
                                bet = 0;
                                getBettinguserhistory();
                            })
                        }
                    })

               
            }
        }
               
  
    })
    $('#buyBtn').click(function(){
        
        if(bet < minimum){
            function showPopUp(){
                $('#min_bet').text(minimum);
                minimum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                minimum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        else if(bet > maximum){
            function showPopUp(){
                $('#max_bet').text(maximum);
                maximum_transaction.style.display="block";
            }
            showPopUp();
            function ClosePopUp(){
                maximum_transaction.style.display="none";
                document.getElementById("betAmount").value="";
                document.getElementById("totalBetAmount").value="";
            }
            setTimeout(ClosePopUp, 2000)
        }
        else{
            var mytime = moment.tz(moment(getServerTime()),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix = Math.floor(new Date(mytime).getTime() + 1000 * 60);
            var mytimeunix = conunix / 1000;
            var betAmount = Number($('#betAmount').val().replace(/[^0-9\.-]+/g,""));
            var totalBetAmount = Number($('#totalBetAmount').val().replace(/[^0-9\.-]+/g,""));
            var arr = [{time: mytimeunix, betAmount : betAmount, totalBetAmount : totalBetAmount, multiplyby : times, trend: 1}];
            var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));

            if(betAmount > current){
                function showPopUp(){
                    my_popup_failed.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup_failed.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";
                }
                setTimeout(ClosePopUp, 2000)
            }
            else{
                betDisabled();

                function showPopUp(){
                    my_popup.style.display="block";
                }
                showPopUp();
                function ClosePopUp(){
                    my_popup.style.display="none";
                    document.getElementById("betAmount").value="";
                    document.getElementById("totalBetAmount").value="";

                }
                setTimeout(ClosePopUp, 2000)
                var time = [{time: mytimeunix}];
                $.post( "php/api/user/checkTimeBetPerMinETH.php", JSON.stringify(time), function( res ) {
                    if(res.length > 0){
                        priceWon = 0;
                        bet = 0;
                        getBettinguserhistory();
                    }else{
                        $.post( "php/api/user/postPurchaserequestETH.php", JSON.stringify(arr), function( response ) {
                        }) 
                    }
                })
                
              
        }
    }
    })
    window.setInterval(function() {
        $('#container_data').scrollLeft($('#container_data').scrollLeft() + 904);
      }, 1);
    //load files
})  


function betting(bet,current,priceWon){
    var formatter = new Intl.NumberFormat();

    document.getElementById('betAmount').disabled = true;
    document.getElementById('totalBetAmount').disabled = true;
    if(bet > current){
        function showPopUp(){
            my_popup_failed.style.display="block";
        }
        showPopUp();
        function ClosePopUp(){
            my_popup_failed.style.display="none";
            document.getElementById("betAmount").value="";
            document.getElementById("totalBetAmount").value="";
        }
        setTimeout(ClosePopUp, 2000)
    }else{
        $('#betAmount').val(formatter.format(bet));
        $('#totalBetAmount').val(formatter.format(priceWon));
    }
}

// function disabledBtnOnBet(){
//     var mytime = moment.tz(moment().add('1','minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
//     var conunix = Math.floor(new Date(mytime).getTime());
//     var mytimeunix = conunix / 1000;
//     var time = [{time: mytimeunix}];
//     $.post( "php/api/user/checkTimeBetPerMinETH.php", JSON.stringify(time), function( res ) {
//         if(res.length > 0){
//             $('.btn_bet').attr('disabled',true);
//             betDisabled();
//         }
//     })
// }

function unlockField(){
    $('#editField').click(function(){
        document.getElementById('betAmount').disabled = false;
    })
}

//Trading Button
function betDisabled(){
    $('#betAmount').attr('disabled',true);
    $('#totalBetAmount').attr('disabled',true);
    $('.btn_dis').attr('disabled',true);
    $('.disabler').css('display','block');
    $('#totalBetAmount').val('');
    $('#betAmount').val('');
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

unlockField();
getBettinguserhistory();