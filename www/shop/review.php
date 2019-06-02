<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	if(!$ca_id) $ca_id="10";
	
	$PG_table = $GnTable["shopitem"];
	$JO_table = "";

	$pslist_pagenum = 10 ;

// 상품후기 ##############################################
	$sql_where = " where it_id = '$it_id' and is_confirm = 1 ";
	$sql_order = " order by is_time desc";

	$sql = " select count(*) as cnt from {$GnTable[shopafter]} $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	// 전체 페이지 계산
	$total_page  = ceil($total_count / $pslist_pagenum);
	// 페이지가 없으면 첫 페이지 (1 페이지)
	if ($page == "") $page = 1;
	// 시작 레코드 구함
	$from_record = ($page - 1) * $pslist_pagenum;

	$sql  = " select * from {$GnTable[shopafter]} $sql_where $sql_order limit $from_record, $default[page_rows]";
	$result = sql_query($sql);
	for ($i=0; $i<$total_count; $i++) {
		$ps[$i] = mysql_fetch_array($result);

		$sql = " select mem_name from {$GnTable[member]} where mem_id='{$ps[$i][mb_id]}' ";
		$isch= sql_fetch($sql);
		if($isch[mem_name]) $name= $isch[mem_name]; else $name = "";

		$ps[$i][is_subject] = stripslashes(cut_str($ps[$i][is_subject], 50, "..."));

		if($name) $ps[$i][name] = $name; else $ps[$i][name] = $ps[$i][mb_id];

		$ps[$i][is_content] = nl2br(stripslashes($ps[$i][is_content]));

		$ps[$i][star] = get_star($ps[$i][is_score]);

		$ps[$i][time] = substr($ps[$i][is_time], 2, 14);;

	} 
// 상품후기여기까지 #########################################
?>
<script language='javascript' src='/admin/shop/lib/javascript.js'></script>
<?
	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/review.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>