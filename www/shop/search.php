<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$PG_table = $GnTable["shopitem"];
	$JO_table = "";

	$sql_where = "where it_use=1";
	$sql_order = " order by ";

	//// 검색리스트 출력 /////////////////
	if($search) {
		$search_word = quotemeta(trim($search));
		$sql_where .= " and it_name like '%$search_word%' ";
	}

	//// 정렬순서 출력 //////////////////
	if($sort1) {
		$sql_order .= " $sort1 $sort2 ,";
	}

	$sql_order .= " it_order desc";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select * from $PG_table $sql_where $sql_order limit $from_record, $rows ";
	$result = sql_query($sql);
	for ($i=0; $row=@mysql_fetch_array($result); $i++) {
		$list[$i] = $row;

		// 상품제고현황
		$itstock = get_it_stock_qty($list[$i][it_id]);
		if($itstock < 1) {
			$list[$i][max_text] = "<font color=red>[품절]</font>";
			$list[$i][Get_pay] = "<font color=red>[품절]</font>";
		} else {
			$list[$i][max_text] = "";
			if($default[or_mnum] < $itstock) $list[$i][max_num] = $default[or_mnum];
				else  $list[$i][max_num] = $itstock;
			$list[$i][Get_pay] = number_format($list[$i][it_pay])."원 ";
		}

		// 상품 타입 이미지
		$item_type[$i] ="";
		if($list[$i][it_type1]==1) $item_type[$i] .="<img src='/shop/img/icon_type1.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type2]==1) $item_type[$i] .="<img src='/shop/img/icon_type2.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type3]==1) $item_type[$i] .="<img src='/shop/img/icon_type3.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type4]==1) $item_type[$i] .="<img src='/shop/img/icon_type4.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type5]==1) $item_type[$i] .="<img src='/shop/img/icon_type5.gif' border=0 align='absmiddle'>";

		if($list[$i][it_epay]>0) $list[$i][it_pay] = $list[$i][it_epay];
	}

	$qstr = "ca_id=$ca_id&page=$page&sort1=$sort1&sort2=$sort2";

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
include $DOCUMENT_ROOT."/skin/shop/$GnShop[shop_skin]/search.skin.php";
if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>