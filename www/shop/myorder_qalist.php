<?
 	include $_SERVER["DOCUMENT_ROOT"]."/head.php"; 
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$PG_table = $GnTable["shopinquire"];
	$JO_table = "";

	$sql_where = "where mb_id = '{$_SESSION[userid]}'";
	$sql_order = " order by iq_id desc";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

			$sql  = " select * from $PG_table $sql_where $sql_order limit $from_record, $rows ";
			$result = sql_query($sql);

			for ($i=0; $qa[$i] =mysql_fetch_array($result); $i++) {

					$sql_item = "select it_name from {$GnTable[shopitem]} where it_id = '{$qa[$i][it_id]}' ";
					$item = sql_fetch($sql_item);

                    $qa[$i][name] = $item[it_name];
					$qa[$i][star] = get_star($qa[$i][iq_score]);
                    $qa[$i][iq_subject]		= stripslashes($qa[$i][iq_subject]);
                    $qa[$i][iq_question]	= stripslashes($qa[$i][iq_question]);
                    $qa[$i][iq_answer]		= stripslashes($qa[$i][iq_answer]);
                    $qa[$i][iq_time]			= substr($qa[$i][iq_time], 2, 14);

                    $qa[$i][qa]					= "<img src='$cfg[d_url]/$cart_skin/icon_poll_q.gif' border=0>";
                    if ($qa[$i][iq_answer]) $qa[$i][qa] .= "<img src='$cfg[d_url]/$cart_skin/icon_answer.gif' border=0>";
                    $qa[$i][qa]					= "{$qa[$i][qa]}";
			}

	$qstr = "ca_id=$ca_id&page=$page&sort1=$sort1&sort2=$sort2";

	$page_loc = "member";

	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_qalist.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; 
?>