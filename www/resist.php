<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	$sql_where = "where lec_use = '1'";
	//$sql_date = "and '$date' between lec_frDT and lec_enDT";
	//Paging 및 목록 생성
	$BoardSql = " select count(*) as cnt from Gn_Lecture $sql_where $sql_date order by lec_order desc";
	$row = sql_fetch($BoardSql,FALSE);
	$total_count = $row[cnt];

	$rows = 10;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql = "select * from Gn_Lecture $sql_where $sql_date order by lec_order desc limit $from_record,$rows";
	$result = sql_query($sql);
	
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list[$i] = $row;
	}
?>
<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
	
	<div id="sub_visual_wrap">
		<p style="background:url(/images/sub/sub-visual.jpg) center top no-repeat; height:571px;"></p>
	</div><!-- //sub_visual_wrap -->	

	<div id="sub_contents">
		<div class="inner">
			<div class="sub_tit">
				<span>01</span>
				<h2>과정등록</h2>
			</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list">
				<colgroup>
					<col width="412px" />
					<col width="351px" />
					<col width="231px" />
					<col width="206px" />
				</colgroup>
				<tr>
					<th>과정</th>
					<th>과정일정</th>
					<th>가격</th>
					<th>신청</th>
				</tr>
				<?for($i=0; $i<count($list); $i++){?>
				<tr>
					<td><?=$list[$i][lec_subject]?></td>
					<td><?=substr($list[$i][lec_frDT],0,10)?> ~ <?=substr($list[$i][lec_enDT],0,10)?></td>
					<td><?=number_format($list[$i][lec_pay])?>원</td>
					<td><a href="./resist02.php?no=<?=$list[$i][lec_no]?>">과정등록</a></td>
				</tr>
				<?}?>
			</table>

			<div class="paging_wrap">
				<ul class="paging">
					<?=custom_paging_story2($default[page_list],$page, $total_page, "$_SERVER[PHP_SELF]?$PageNext&$NextUrl&page=");?>
				</ul>
			</div>
		</div><!-- //inner -->
	</div><!-- //sub_contents -->

<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<?// include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>