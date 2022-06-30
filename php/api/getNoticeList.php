<?php  
    include_once '../config/Database.php';
	include_once '../class/Pagination.class.php';
	include_once '../class/UserInfo.php';

    $database = new Database();
    $perPage = new PerPage();
    $db = $database->getConnection();

    $query = new UserInfo($db);

	$sql = $query->getNoticeList();
    $sql1 = $query->getNoticeRowCount();
	$rows = $sql1->fetchAll(PDO::FETCH_ASSOC);
    $row_count = count($rows);
				
	$paginationlink = "php/api/getNoticeList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
	$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$query =  $sql . " ORDER BY n_Registration_Time DESC OFFSET " . $start . " ROWS FETCH NEXT " . $perPage->perpage . " ROWS ONLY"; 
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
    $output .= '공지사항';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 100%;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table notice">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th style="width:18%">번호</th>';
	$output .= '<th style="width:57%">제목</th>';
	$output .= '<th style="width:25%">작성자</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody>';
	if($row_count > 0){
		foreach($data as $key => $val){
			$output .= '<tr class="rowaccordion">';
			$output .= '<td>'.$sNum.'</td>';
			$output .= '<td style="text-align: left;">'.$val["n_Title"].'</td>';
			$output .= '<td>관리자</td>';
			$output .= '</tr>';
			$output .= '<tr class="rowContent">';
			$output .= '<td style="padding-left: 30%;" colspan="4">'.$val["n_Details"].'</td>';
			$output .= '</tr>';
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
		$output .= '<span style="text-align: center !important; padding-bottom:10px;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
	
    print $output;
?>
<script>
	$('.rowContent').hide();
	$(".notice .rowaccordion").click(function(){
	$(".rowContent").not($(this).next()).hide();
		$(this).next(".rowContent").toggle();
	})
</script>