$('#depositamount').on('change click keyup input paste',(function (event) {
  var current = Number($('#cashb').text().replace(/[^0-9\.-]+/g,""));
  var newbal = Number($(this).val().replace(/[^0-9\.-]+/g,""));
  var formatter = new Intl.NumberFormat();
  $('.new_balance').text(formatter.format(current + newbal));
}));
function numberFormat(){
    $('input#depositamount').keyup(function(event) {
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
$('.btn_deposit').click(function(){

  var time_checker =  moment.tz(moment(getServerTime()),'Asia/Seoul').subtract(30, 'seconds').format("YYYY-MM-DD HH:mm:ss");
  var deposit_time =  moment.tz(moment(getServerTime()),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss");
  var deposit = Number($('#depositamount').val().replace(/[^0-9\.-]+/g,""));
  var arr = [{depositamount : deposit, deposittime : deposit_time}];

  $.post("./php/api/user/checkTimeDeposit.php", function(res){
    if(res.length != 0){
      if(time_checker < res[0]['h_Contract_Time']){
        $('#modal-deposit_alert_30sec').modal('show');
        return false;
      }
      else{
        if(deposit < 10000){
          $('#modal-deposit_alert').modal('show');
          return false;
        }
        else{
          $('#modal-deposit_alert_success').modal('show');
          $.post("./php/api/postDeposit.php", JSON.stringify(arr), function( response ) {
            $('#modal-deposit_submit').modal('hide')
            if(response == true){
              $('#modal-deposit_alert_success').modal('hide');
              $('#depositamount').val('');
            }
          })
       }
      }
    }
    else{
      if(deposit < 10000){
        $('#modal-deposit_alert').modal('show');
        return false;
      }
      else{
        $('#modal-deposit_alert_success').modal('show');
        $.post("./php/api/postDeposit.php", JSON.stringify(arr), function( response ) {
          $('#modal-deposit_submit').modal('hide')
          if(response == true){
            $('#modal-deposit_alert_success').modal('hide');
            $('#depositamount').val('');
          }
        })
     }
    }
  });

})

function getServerTime() {
  return $.ajax({async: false}).getResponseHeader( 'Date' );
}

numberFormat();