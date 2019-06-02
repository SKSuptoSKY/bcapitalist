<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php"; 
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$PG_table = $GnTable["shopafter"];
	$JO_table = "";

	$sql_where = "where mb_id = '{$_SESSION[userid]}'";
	$sql_order = " order by is_time desc";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select * from $PG_table $sql_where $sql_order limit $from_record, $rows";
	$result = sql_query($sql);
	for ($i=0; $i<$total_count; $i++) {
		$ps[$i] = mysql_fetch_array($result);

		$sql_item = "select it_name from {$GnTable[shopitem]} where it_id = '{$ps[$i][it_id]}' ";
		$item = sql_fetch($sql_item);

		$ps[$i][name] = $item[it_name];
		$ps[$i][is_subject] = stripslashes(cut_str($ps[$i][is_subject], 50, "..."));
		$ps[$i][is_content] = nl2br(stripslashes($ps[$i][is_content]));
		$ps[$i][star] = get_star($ps[$i][is_score]);
		if(!$ps[$i][is_confirm]) $ps[$i][is_confirm] = "검토중"; else $ps[$i][is_confirm] = "게시중";
		$ps[$i][time] = substr($ps[$i][is_time], 2, 14);;

	}

	$qstr = "ca_id=$ca_id&page=$page&sort1=$sort1&sort2=$sort2";

	$page_loc = "member";

	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_pslist.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; 
?>