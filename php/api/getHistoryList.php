<?php  
   include_once '../config/Database.php';
   include_once '../class/Pagination.class.php';
   include_once '../class/UserInfo.php';

   $database = new Database();
   $perPage = new PerPage();
   $db = $database->getConnection();

   $query = new UserInfo($db);

	$sql = $query->getUserHistoryList();
    $sql1 = $query->getUserHistoryRowCount();
    $rows = $sql1->fetchAll(PDO::FETCH_ASSOC);
    $row_count = count($rows);

	$paginationlink = "php/api/getHistoryList.php?page=";
					
	$page = 1;
	if(!empty($_GET["page"])) {
	$page = $_GET["page"];
	}

	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$query =  $sql . " ORDER BY h_Contract_Time DESC OFFSET " . $start . " ROWS FETCH NEXT " . $perPage->perpage . " ROWS ONLY"; 
	$faq = $db->prepare($query);
    $faq->execute();

	if(empty($_GET["rowcount"])) {
	    $_GET["rowcount"] = $row_count;
	}

	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);

    $data = $faq->fetchAll(PDO::FETCH_ASSOC);
	$counter = ($_GET["page"] > 1) ? ($_GET["page"] * COUNT($data)) - COUNT($data) : 0;
	$sNum = $counter + 1;

    //  print_r($data);

	$output = '';
    $output .= '<div class="page-deposit">';
    $output .= '<div class="div_layout">';
    $output .= '<div class="card">';
    $output .= '<div class="card-header">';
    $output .= '입출금 내역';
    $output .= '</div>';
	$output .= '<div class="table-responsive" style="overflow-y: scroll; height: 100%;">';
    $output .= '<div class="body-header">';
	$output .= '<table class="table userhistory">';
	$output .= '<thead>';
	$output .= '<tr>';
	$output .= '<th class="hide_info_mobile">번호</th>';
	$output .= '<th class="hide_info_mobile">은행</th>';
	$output .= '<th class="hide_info_mobile">계좌번호</th>';
	$output .= '<th class="hide_info_mobile">예금주</th>';
    $output .= '<th>입금/출금</th>';
    $output .= '<th>금액</th>';
    $output .= '<th>상태</th>';
    $output .= '<th>신청시간</th>';
    $output .= '<th>처리시간</th>';
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '<tbody align="center">';
	if($row_count > 0){
		foreach($data as $key => $val){
            $t = $val["h_Contract_Time"];
            $s = new DateTime($t);
            $result = $s->format('m-d H:i');

            $q = $val["h_Processing_Time"];
            $w = new DateTime($q);
            $result1 = $w->format('m-d H:i');

			$output .= '<tr>';
			$output .= '<td class="hide_info_mobile">'.$sNum.'</td>';
            // Bank Code
			if($val["u_Bank_Code"] == 1){
                $output .= '<td class="hide_info_mobile">KEB하나은행 </td>';
            }
            else if($val["u_Bank_Code"] == 2){
                $output .= '<td class="hide_info_mobile"> SC제일은행 </td>';
            }
			else if($val["u_Bank_Code"] == 3){
                $output .= '<td class="hide_info_mobile"> 국민은행 </td>';
            }
			else if($val["u_Bank_Code"] == 4){
                $output .= '<td class="hide_info_mobile"> 신한은행 </td>';
            }
			else if($val["u_Bank_Code"] == 5){
                $output .= '<td class="hide_info_mobile"> 우리은행 </td>';
            }
			else if($val["u_Bank_Code"] == 6){
                $output .= '<td class="hide_info_mobile"> 한국시티은행 </td>';
            }
			else if($val["u_Bank_Code"] == 7){
                $output .= '<td class="hide_info_mobile"> 경남은행 </td>';
            }
			else if($val["u_Bank_Code"] == 8){
                $output .= '<td class="hide_info_mobile"> 광주은행 </td>';
            }
			else if($val["u_Bank_Code"] == 9){
                $output .= '<td class="hide_info_mobile"> 대구은행 </td>';
            }
			else if($val["u_Bank_Code"] == 10){
                $output .= '<td class="hide_info_mobile"> 부산은행 </td>';
            }
			else if($val["u_Bank_Code"] == 11){
                $output .= '<td class="hide_info_mobile"> 전북은행 </td>';
            }
			else if($val["u_Bank_Code"] == 12){
                $output .= '<td class="hide_info_mobile"> 제주은행 </td>';
            }
			else if($val["u_Bank_Code"] == 13){
                $output .= '<td class="hide_info_mobile"> 기업은행 </td>';
            }
			else if($val["u_Bank_Code"] == 14){
                $output .= '<td class="hide_info_mobile"> 농협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 15){
                $output .= '<td class="hide_info_mobile"> 수협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 16){
                $output .= '<td class="hide_info_mobile"> 신협은행 </td>';
            }
			else if($val["u_Bank_Code"] == 17){
                $output .= '<td class="hide_info_mobile"> 새마을금고 </td>';
            }
			else if($val["u_Bank_Code"] == 18){
                $output .= '<td class="hide_info_mobile"> KDB산업은행 </td>';
            }
			else if($val["u_Bank_Code"] == 19){
                $output .= '<td class="hide_info_mobile"> 우체국 </td>';
            }
			else if($val["u_Bank_Code"] == 20){
                $output .= '<td class="hide_info_mobile"> 카카오뱅크 </td>';
            }
			else if($val["u_Bank_Code"] == 21){
                $output .= '<td class="hide_info_mobile"> 토스뱅크 </td>';
            }
			$output .= '<td class="hide_info_mobile">'.$val["u_Account_Number"].'</td>';
			$output .= '<td class="hide_info_mobile">'.$val["u_Bank_Holder_Name"].'</td>';
            
            //Deposit or Withdraw
            if($val["h_Event"] == "입금"){
                $output .= '<td><p><font color = "#ff9300">'.$val["h_Event"].'</p></td>';
            }
            else if($val["h_Event"] == "출금"){
                $output .= '<td><p><font color="#78A6FF">'.$val["h_Event"].'</p></td>';
            }
            else{
                $output .= '<td><p>'.$val["h_Event"].'</p></td>';
            }

            //Price
            if($val["h_Plus"] == 0){
                $output .= '<td><p><font color = "#78A6FF">'.$val["h_Minus"].'</p></td>';
            }
            else if($val["h_Minus"] == 0){
                $output .= '<td><p><font color = "#ff9300">'.$val["h_Plus"].'</p></td>';
            }
            //Status
			if($val["h_Status"] == 0){
                $output .= '<td>진행중</td>';
            }
            else if ($val["h_Status"] == 1){
                $output .= '<td>완료</td>';
            }
            else{
                $output .= '<td>취소</td>';
            }
            $output .= '<td class="history_time">'.$result.'</td>';
            if($val["h_Status"] == 0){
			$output .= '<td>-</td>';
            }
            else{
			$output .= '<td class="history_time">'.$result1.'</td>';
            }
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
		$output .= '<span style="text-align: center !important; padding-bottom: 10px;"><div id="pagination">' . $perpageresult . '</div></span>';
	}
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    print $output;

?>
