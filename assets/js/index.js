var ok = false;

$(document).ready(function(){    
    loadstation();

});


function loadstation(){
    // $("#station_data").load("php/api/user/checkForceLogout.php");
        $.ajax({
            "url": "php/api/user/checkForceLogout.php",
            "type": "GET",
            "contentType": "application/json",
            "async": false,
            success: function(response) {
                var resultSound = new Audio('../assets/audio/query.mp3');
                var remaining_balance;
                var balance;
                var soundChecker;
                if(response['balance'] != null){
                    remaining_balance = response['balance'][0]['t_Amount_in_Total'];
                    soundChecker = response['sounds'][0]['u_Access_Code'];
                    balance = new Intl.NumberFormat().format(remaining_balance);
                    $('.cash_balance').text(balance);

                    // Refresher for new message && Sound
                    if(soundChecker == 1){
                        if(response.messageCnt != 0){
                            resultSound.play();
                            muteMeSoy();
                            setTimeout(function(){
                                resultSound.pause();
                                window.location.reload();
                             }, 2000);
                        }
                        else{
                        }
                    }
                    else if(soundChecker == 0){
                        if(response.messageCnt != 0){
                            muteMeSoy();
                            setTimeout(function(){
                                window.location.reload();
                             }, 2000);
                        }
                        else{
                        }
                    }

                    // console.log(response['games'][0]['g_BTCUSD']);
                    // console.log(response['games'][0]['g_ETHUSD']);
                    
                    //Sound Checker
                    if(soundChecker == 0){
                        $('#sound_img_on').css('display', 'none');
                        $('#sound_img_off').css('display', 'block');
                    }   
                    else if(soundChecker == 1){
                        $('#sound_img_on').css('display', 'block');
                        $('#sound_img_off').css('display', 'none');
                    }

                    if(response['checkBTCMaintenance'][0]['s_Status'] == 0 || response['games'][0]['g_BTCUSD'] == 0){
                        let details = response['checkBTCMaintenance'][0]['s_Details'];
                        $('#btn_btc_yes').css('display','none');
                        $('#btn_btc_no').css('display','block');
                        $('#btn_btc_yes_mobile').css('display','none');
                        $('#btn_btc_no_mobile').css('display','block');
                        $('#maintenance_btc').text(details);
                    }else if(response['checkBTCMaintenance'][0]['s_Status'] == 1 || response['games'][0]['g_BTCUSD'] == 1){
                        $('#btn_btc_yes').css('display','block');
                        $('#btn_btc_no').css('display','none');
                        $('#btn_btc_yes_mobile').css('display','block');
                        $('#btn_btc_no_mobile').css('display','none');
                    }


                    if(response['checkBTCMaintenance'][1]['s_Status'] == 0 || response['games'][0]['g_ETHUSD'] == 0){
                        let details = response['checkBTCMaintenance'][1]['s_Details'];
                        $('#btn_eth_yes').css('display','none');
                        $('#btn_eth_no').css('display','block');
                        $('#btn_eth_yes_mobile').css('display','none');
                        $('#btn_eth_no_mobile').css('display','block');
                        $('#maintenance_btc').text(details);
                    }else{
                        $('#btn_eth_yes').css('display','block');
                        $('#btn_eth_no').css('display','none');
                        $('#btn_eth_yes_mobile').css('display','block');
                        $('#btn_eth_no_mobile').css('display','none');
                    }

                    // modal maintenance
                    if(response['checkMaintenance'][0]['s_Status'] == 1){
                        let details = response['checkMaintenance'][0]['s_Details'];
                        $('#modal-server_maintenance').modal('show');
                        $('#maintenance_details').text(details);
                    }
                    else if(response['checkMaintenance'][0]['s_Status'] == 0){
                        $('#modal-server_maintenance').modal('hide');
                    }
    
                    //Note Counter
                    if(response.noteCnt != 0){
                        // resultSound.play();
                        $(".note_notification").text(response.noteCnt);
                        $(".note_notification").css('display','block');
                        $(".info_content").css('display','block');
                    }
                    else{
                        $(".note_notification").css('display','none');
                        $(".info_content").css('display','none');
                    }

                    //Force Logout
                    var state = response['check'][0]['u_State'];
                    if(response['check'][0]['u_State'] == 3){
                        window.location.href="./logout.php?code=state";
                    }
                }else{
                    if(response[0]['s_Status'] == 1){
                        let details = response[0]['s_Details'];
                        $('#modal-server_maintenance').modal('show');
                        $('#maintenance_details').text(details);
                    }
                    else if(response[0]['s_Status'] == 0){
                        $('#modal-server_maintenance').modal('hide');
                    }
                }

           }
        });

    setTimeout(loadstation, 1000);
}

function muteMeSoy(){
    $.post('../php/api/user/updateRefresh.php?setMute=1', function(req){})
}


// $('#userinfo').click(function(){
//     $('#sound_img_on').click(function(){
//         $('.dropdown-content').css('display','block');
//     })
//     $('#sound_img_off').click(function(){
//         $('.dropdown-content').css('display','block');
//     })
// })


$('#sound_img_on').click(function(){    
    muteResultSound();
});

$('#sound_img_off').click(function(){    
    unmuteResultSound();
});


function muteResultSound(){
    $.post('../php/api/user/updateRefreshSound.php?setMute=0', function(req){})
}
function unmuteResultSound(){
    $.post('../php/api/user/updateRefreshSound.php?setMute=1', function(req){})
}

$(function(){
    $("#btn_btc_no").click(function(){
        $("#modal-prevent").modal('show');
    });
    $("#btn_eth_no").click(function(){
        $("#modal-prevent").modal('show');
    });
    // modal
    $(".modal-popup-login").click(function(){
        $("#modal-login").modal('show');
    });
    $(".modal-popup-maintenance").click(function(){
        $("#modal-maintenance").modal('show');
    });
    
    //toggle noticeguide
    $('.dropdown-noticeguide').mouseover(function() {
        $('.notgui').show();
    })

    $('.dropdown-noticeguide').mouseout(function() {
        t = setTimeout(function() {
            $('.notgui').hide();
        }, 100);

        $('.notgui').on('mouseenter', function() {
            $('.notgui').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.notgui').hide();
        })
    })
    //toggle depositwithdraw
    $('.dropdown-depositwithdraw').mouseover(function() {
        $('.depwid').show();
    })

    $('.dropdown-depositwithdraw').mouseout(function() {
        t = setTimeout(function() {
            $('.depwid').hide();
        }, 100);

        $('.depwid').on('mouseenter', function() {
            $('.depwid').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.depwid').hide();
        })
    })
    //toggle inqfaq
    $('.dropdown-inquiryfaq').mouseover(function() {
        $('.inqfaq').show();
    })

    $('.dropdown-inquiryfaq').mouseout(function() {
        t = setTimeout(function() {
            $('.inqfaq').hide();
        }, 100);

        $('.inqfaq').on('mouseenter', function() {
            $('.inqfaq').show();
            clearTimeout(t);
        }).on('mouseleave', function() {
            $('.inqfaq').hide();
        })
    })

  
    $('#navbar-collapse-1').click(function(){
        $('.display_log').css('display','none');
        $('.display_nonlog').css('display','none');
        $('.navbar-collapse-1-mobile').toggle();
        // if ($(".footer").hasClass('fixed_bottom')) {
        //     $( ".footer" ).addClass( 'fixed_bottom');
        // } else {
        //   $( ".footer" ).addClass( 'fixed_bottom');
        // }
        // if ($(".navbar-custom").hasClass('fixed_top')) {
        //     $( ".navbar-custom" ).addClass( 'fixed_top');
        // } else {
        //   $( ".navbar-custom" ).addClass( 'fixed_top');
        // }
    });
    $('#navbar-collapse-login').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-login0').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-login1').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
        $('#navbar-collapse-login2').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-login3').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-login4').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-login5').click(function(){
        $('.display_nonlog').css('display','block');
        $('.navbar-collapse-1-mobile').css('display','none');
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-2').click(function(){
        $('.navbar-collapse-1-mobile').css('display','none');
        $('.display_log').css('display','none');
        $('.display_nonlog').toggle();
        if ($(".footer").hasClass('fixed_bottom')) {
            $( ".footer" ).addClass( 'fixed_bottom');
        } else {
          $( ".footer" ).addClass( 'fixed_bottom');
        }
        if ($(".navbar-custom").hasClass('fixed_top')) {
            $( ".navbar-custom" ).addClass( 'fixed_top');
        } else {
          $( ".navbar-custom" ).addClass( 'fixed_top');
        }
    });
    $('#navbar-collapse-3').click(function(){
        $('.navbar-collapse-1-mobile').css('display','none');
        $('.display_nonlog').css('display','none');
        $('.display_log').toggle();
        // if ($(".footer").hasClass('fixed_bottom')) {
        //     $( ".footer" ).addClass( 'fixed_bottom');
        // } else {
        //   $( ".footer" ).addClass( 'fixed_bottom');
        // }
        // if ($(".navbar-custom").hasClass('fixed_top')) {
        //     $( ".navbar-custom" ).addClass( 'fixed_top');
        // } else {
        //   $( ".navbar-custom" ).addClass( 'fixed_top');
        // }
    });
    //fetching cash balance
    $.ajax({
        "url": "php/api/user/getUserCashBalance.php",
        "type": "GET",
        "contentType": "application/json",
        "async": false,
        success: function(response) {
            var formatter = new Intl.NumberFormat();
            var balance = response.t_Amount_in_Total;
            $('.cash_balance').text(formatter.format(balance));
        }
    })
    //fetching available game
    // $.ajax({
    //     "url": "php/api/user/getAvailableGame.php",
    //     "type": "GET",
    //     "contentType": "application/json",
    //     "async": false,
    //     success: function(response) {
    //         console.log(response[0]['g_BTCUSD']);
    //         if(response[0]['g_BTCUSD'] == 0){
    //             $('#btn_btc_no').css('display','block');
    //             $('#btn_btc_yes').css('display','none');
    //         }
    //         else{
    //             $('#btn_btc_no').css('display','none');
    //             $('#btn_btc_yes').css('display','block');
    //         }
    //    }
    // })
})