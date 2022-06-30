function getresult(url) {
    $.ajax({
        url: url,
        type: "GET",
        data: {rowcount:$("#rowcount").val()},
        beforeSend: function(){$("#overlay").show();},
        success: function(data){
        $("#pagination-result").html(data);
        $("#overlay").hide();
        $('#div_height').hide();
        },
        error: function() 
        {} 	        
   });
}
getresult("php/api/getNoticeList.php");