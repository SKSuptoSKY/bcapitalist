<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	if(!$type) $type="1";
	// 카테고리 정보를 불러옵니다.

	$PG_table = $GnTable["shopitem"];
	$JO_table = "";

	$sql_where = "where it_type{$i} = '$type%' and it_use=1";
	$sql_order = " order by ";

	//// 검색리스트 출력 /////////////////
	if($search) {
		$sql_where .= " and it_name = '%$search%' ";
	}

	//// 정렬순서 출력 //////////////////
	if($sort1) {
		$sql_order .= " $sort1 $sort2 ,";
	}

	$sql_order .= " it_order desc, it_id";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order ";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select * from $PG_table $sql_where $sql_order limit $from_record, $rows ";
	$result = sql_query($sql);
	for ($i=0; $row=mysql_fetch_array($result); $i++) {
		$list[$i] = $row;

		// 상품제고현황
		$itstock = get_it_stock_qty($list[$i][it_id]);
		if($itstock < 1) {
			$list[$i][max_text] = "<font color=red>[품절]</font>";
			$list[$i][max_num] = "0";
		} else if($default[or_mnum] < $itstock) {
			$list[$i][max_text] = "";
			$list[$i][max_num] = $default[or_mnum];
		} else {
			$list[$i][max_text] = "";
			$list[$i][max_num] = $itstock;
		}

		// 상품 타입 이미지
		$item_type[$i] ="";
		if($list[$i][it_type1]==1) $item_type[$i] .="<img src='/shop/img/icon_type1.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type2]==1) $item_type[$i] .="<img src='/shop/img/icon_type2.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type3]==1) $item_type[$i] .="<img src='/shop/img/icon_type3.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type4]==1) $item_type[$i] .="<img src='/shop/img/icon_type4.gif' border=0 align='absmiddle'>";
		if($list[$i][it_type5]==1) $item_type[$i] .="<img src='/shop/img/icon_type5.gif' border=0 align='absmiddle'>";

		// 특별가격을 적용합니다.
		if($list[$i][it_epay]>0) $list[$i][it_pay] = $list[$i][it_epay];

		// 상품 옵션
		for ($option=1; $option<=6; $option++) {
			// 옵션에 문자가 존재한다면
			$list[$i]["it_opt{$option}"] = get_item_options(trim($list[$i]["it_opt{$option}_subject"]), trim($list[$i]["it_opt{$option}"]), $option);
		}

		$list[$i][score] = get_star_image($list[$i][it_id]);
		$list[$i][star] = "/skin/shop/{$GnShop[shop_skin]}/images/star.jpg";
	}

	///////////////// 현재 상세위치 보이기 ////////////////////////////////////////////////////////
	if($type==1) { $ca_name = "<a href='/shop/list_type.php?type=$type'>Newbook</a>"; }
	if($type==2) { $ca_name = "<a href='/shop/list_type.php?type=$type'>Bestseller</a>"; }
	if($type==3) { $ca_name = "<a href='/shop/list_type.php?type=$type'>Today book</a>"; }
	if($type==4) { $ca_name = "<a href='/shop/list_type.php?type=$type'>Must haves</a>"; }
	if($type==5) { $ca_name = "<a href='/shop/list_type.php?type=$type'>Hit items</a>"; }

	///////////////// 현재 위치 보이기 ////////////////////////////////////////////////////////
	$ca_loc = "Home > ".$ca_name;

	/////////////////////////////////////////////////////////////////////////////////////////////
	///////////////// 하위 카테고리 보이기 ///////////////////////////////////////////////////
	$ca_se = strlen($ca_id);
	$ca_len = $ca_se + 2;
		$sql  = " select * from shop_category where length(ca_id) = '$ca_len' and left(ca_id,$ca_se)='$ca_id' and ca_id != '$ca_id' ";
		$result = sql_query($sql);
		for ($i=0; $row=mysql_fetch_array($result); $i++) {
			$cate[$i] = $row;
		}
	/////////////////////////////////////////////////////////////////////////////////////////////

	$qstr = "ca_id=$ca_id&page=$page&sort1=$sort1&sort2=$sort2";

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
/// 카테고리 스킨정보가 있으면 스킨을 불러옵니다.
if($Cateinfo[ca_skin]) {
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/{$Cateinfo[ca_skin]}";
} else {
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/list.skin.10.php";
}
if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>