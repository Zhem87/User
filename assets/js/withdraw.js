$('#withdrawamount').on('change click keyup input paste',(function (event) {
    var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
    var newbal = Number($(this).val().replace(/[^0-9\.-]+/g,""));
    var formatter = new Intl.NumberFormat();
    $('.new_balance').text(formatter.format(current - newbal));

  }));
  function numberFormat(){
      $('input#withdrawamount').keyup(function(event) {
          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40) return;
        
          // format number
          $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          });
      });
  }

  $('.btn_withdraw').click(function(){
    var time_checker =  moment.tz(moment(getServerTime()),'Asia/Seoul').subtract(7200, 'seconds').format("YYYY-MM-DD HH:mm:ss");
    var withdraw_time =  moment.tz(moment(getServerTime()),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss");
    var withdraw = Number($('#withdrawamount').val().replace(/[^0-9\.-]+/g,""));
    var arr = [{withdrawtamount : withdraw, withdrawtime: withdraw_time}];
    var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));

    if(withdraw <= 0){
      $('#modal-withdraw_alert').modal('show');
      return false;
    }
    else if(withdraw > current){
      $('#modal-withdraw_alert').modal('show');
      return false;
    }

    $.post("./php/api/user/checkTimeWithdraw.php", function(res){


    if(res.length !=0){
        let last_withdraw_time = res[0]['h_Contract_Time'];
        let last_withdraw_status = res[0]['h_Status'];
        if(last_withdraw_status == 0 || last_withdraw_status == 1){
          //2hrs interval
          if(time_checker < last_withdraw_time){
            $('#modal-withdraw_alert_2hrs').modal('show');
            return false;
          }
          else{
            $('#modal-withdraw_alert_success').modal('show');
            $.post("./php/api/postWithdraw.php", JSON.stringify(arr), function( response ) {
              if(response == true){
                $('#modal-withdraw_alert_success').modal('hide');
                $('#withdrawamount').val('');
              }
          })
          }
        }
        else if(last_withdraw_status > 1){
          $('#modal-withdraw_alert_success').modal('show');
          $.post("./php/api/postWithdraw.php", JSON.stringify(arr), function( response ) {
              if(response == true){
                $('#modal-withdraw_alert_success').modal('hide');
                $('#withdrawamount').val('');
              }
          })
        }
    }
    else{
        $('#modal-withdraw_alert_success').modal('show');
        $.post("./php/api/postWithdraw.php", JSON.stringify(arr), function( response ) {
            if(response == true){
              $('#modal-withdraw_alert_success').modal('hide');
              $('#withdrawamount').val('');
            }
        })
    }
      
    });
   
  })
  
  
  //fetching user bank info
  $.ajax({
    "url": "./php/api/user/getUserBankInfo.php",
    "type": "GET",
    "contentType": "application/json",
    "async": false,
    success: function(response) {
        var str = response.u_Account_Number;
        var replacer = replaceRange(str, 3, 7, "****");
        $('#bank').val(response.m_Bank_Name);
        $('#accountno').val(replacer);
        $('#accountholder').val(response.u_Bank_Holder_Name);
    }
  })

  function replaceRange(s, start, end, substitute) {
    return s.substring(0, start) + substitute + s.substring(end);
  }

  function getServerTime() {
    return $.ajax({async: false}).getResponseHeader( 'Date' );
  }

  numberFormat();