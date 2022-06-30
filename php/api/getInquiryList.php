<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new Userinfo($db);

	$sql = $query->getInquiryList();
    $sql1 = $query->getInquiryRowCount();
    $rows = $sql1->fetchAll(PDO::FETCH_ASSOC);
    $row_count = count($rows);
				
	$paginationlink = "php/api/getInquiryList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
	$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$query =  $sql . " ORDER BY t_Inquiry_Date DESC OFFSET " . $start . " ROWS FETCH NEXT " . $perPage->perpage . " ROWS ONLY"; 
	$faq = $db->prepare($query);
    $faq->execute();

	if(empty($_GET["rowcount"])) {
	    $_GET["rowcount"] = $row_count;
	}

	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);

    $data = $faq->fetchAll(PDO::FETCH_ASSOC);
	$counter = ($_GET["page"] > 1) ? ($_GET["page"] * COUNT($data)) - COUNT($data) : 0;
	$sNum = $counter + 1;

	$output = '';
    $output .= '<div class="card">';
    $output .= '<div class="card-header">';
    $output .= '1 : 1 문의하기 <button class="inq_reg">문의등록</button><button class="inq_toggle" id="toggle-inquiry">문의등록</button>';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 100%;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table inquiry">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th style="width:10%;" class="inquiry_number_header">번호</th>';
	$output .= '<th style="width:60%;" class="inquiry_title_header">제목/답변</th>';
	$output .= '<th style="width:10%;" class="inquiry_status_header">상태</th>';
	$output .= '<th style="width:20%;" class="inquiry_date_header">등록시간 / 답변시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
    if($row_count > 0){
        foreach($data as $key => $val){

            $t = $val["t_Inquiry_Date"];
            $s = new DateTime($t);
            $result = $s->format('m-d - h:i');

            $t1 = $val["t_Response_Time"];
            $s1 = new DateTime($t1);
            $result1 = $s1->format('m-d - h:i');

            $output .= '<tr class="rowaccordion">';
            $output .= '<td style="width:10%;">'.$sNum.'</td>';
            $output .= '<td style="width:60%;" class="inquiry_title_inq">'.$val["t_Inquiry_Title"].'</td>';
            ($val["t_Inquiry_Status_Id"] == 0) 
            ? $output .= '<td class="inq_details" style="color: #FF9300;width:10%;">답변 대기</td>' 
            : $output .= '<td class="inq_details" style="color: #1072BA;width:10%;">답변 완료</td>';
            $output .= '<td style="width:20%;" class="inq_date">'. $result.'</td>';

            $output .= '</tr>';
            $output .= '<tr class="rowContent">';   
            $output .= '<td style="width:10%;" class="row_reply">[ 문의 ]</td>';
            $output .= '<th colspan="2" class = "inquiry_details">'.$val["t_Inquiry_Details"].'</td>';
            $output .= '<td style="background: #EEEEEE; text-align:center;width:20%;"></td>';
            $output .= '</tr>';
            if($val["t_Manager_Reply"] && $val["t_Inquiry_Status_Id"] == 1){
                $output .= '<tr class="rowContent1">';
                $output .= '<td class="row_reply" style="background:#DDDDDE;width:10%;">[ 답변 ]</td>';
                $output .= '<th colspan="2" class="inq_manager_reply">'.$val["t_Manager_Reply"].'</td>';
                $output .= '<td style="width:20%;" class="reply_time">'.$result1.'</td>';
                
                $output .= '</tr>';
            }
            $sNum ++;
        }
    }else{
        $output .= '<tr style="text-align: center; height: 40px;">';
        $output .= '<td colspan="4">기록을 찾을 수 없습니다.</td>';
        $output .= '</tr>';
    }
	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
    $output .= '</div>';
	if(!empty($perpageresult)) {
		$output .= '<span class="pagination_footer" style="text-align: center !important; padding-bottom:10px;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
    $output .= '</div>';
    $output .= '</div>';
    print $output;
?>
<script>
	$('.rowContent').hide();
	$('.rowContent1').hide();
	$(".inquiry .rowaccordion").click(function(){
        $(".rowContent").not($(this).next()).hide();
        $(".rowContent1").not($(this).next().next()).hide();
		$(this).next(".rowContent").toggle();
        $(this).next().next(".rowContent1").toggle();
	})
    $('.inq_reg').click(function(){
        $("#modal-inquiry_submit").modal('show');
    })
    $('#toggle-inquiry').click(function(){
        $(".display_inquiry").fadeIn("slow");
        $(".card").hide("slow");
        $(".footer").addClass("fixed-position");
    });
    $('.toggle-close').click(function(){
        $(".display_inquiry").fadeOut("slow");
        $(".card").show("slow");
        $(".footer").removeClass("fixed-position");
    });
</script>