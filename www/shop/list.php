<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";


//값정리
$PG_table = $GnTable["shopitem"];
$JO_table = $GnTable["shopcategory"];

if(!$ca_id) $ca_id="10";


//베스트아이템추출
$sql="select * from $PG_table where it_type1='1' and it_use='1' order by it_id desc limit 0,4";
$res_best=sql_query($sql);


for ($b=0; $row_best=mysql_fetch_array($res_best); $b++) {
	$list_best[$b]=$row_best;
	if($list_best[$b][it_epay]>0) $list_best[$b][it_pay] = $list_best[$b][it_epay];
	

	$it_file_array = get_it_file_size_array( $list_best[$b]["it_id"], "1" );
	$list_best[$b]["list_img"] = $it_file_array["s"];

	//$img="/shop/data/item/{$list_best[$b][it_id]}_s";
	//$list_best[$b]["list_img"] = img_resize_tag("/shop/data/item/{$row_best[it_id]}_s",$GnShop[simg_width]-1,$GnShop[simg_height]-1);
}


//카테고리불러옴
$sql_cainfo = " select * from $JO_table where ca_id like '$ca_id%' ";
$Cateinfo = sql_fetch($sql_cainfo);

$sql_where = "where ca_id like '$ca_id%' and it_use=1";
$sql_order = " order by ";


//검색
if($search) $sql_where .= " and it_name = '%$search%' ";

// 메인, 헤드등에서 상품을 검색했다면
if($item_search) {
	$sql_where = " where it_name like '%$item_search%' and it_use='1' ";
}

if ($sort1==TRUE) $sql_order .= " $sort1 $sort2 ";
else $sql_order .= " it_order desc, it_id desc";
if($sort2=="desc") $NextSort = "";
else $NextSort = "desc";


//상품카운트
$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 40;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


//상품불러옴
$sql="select * from $PG_table $sql_where $sql_order limit $from_record, $rows ";	
$result=sql_query($sql);

for ($i=0; $row=mysql_fetch_array($result); $i++) {
	$list[$i] = $row;
	//$list[$i]["list_img"] = img_resize_tag("/shop/data/item/{$row[it_id]}_s",$GnShop[simg_width],$GnShop[simg_height]);
	################## [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력. - START ] ##################
	$file_name[$i]["small"] = str_replace($list[$i][it_id]."_l", $list[$i][it_id]."_s", $list[$i]["it_file1"]);
	if($list[$i]["it_file1"] != "") {
		$list[$i]["list_img_src"] = $GnShop['data_url']."/".$list[$i]["it_id"]."/".$file_name[$i]["small"];
	} 
	$list[$i]["list_img"] = img_resize_tag($list[$i]["list_img_src"],$GnShop["simg_width"],$GnShop["simg_height"]);
	##################   [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력 - END ]  ##################
	

	// 상품제고현황
	if($list[$i][it_epay]>0) $list[$i][it_pay] = $list[$i][it_epay];
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
	if ($GnShop[use_type1]) { 
		//if($list[$i][it_type1]==1) $item_type[$i] .="<img src='{$GnShop[skin_url]}/images/icon_type1.gif' border=0 align='absmiddle' alt='메인추출상품'> ";
	}
	if ($GnShop[use_type2]) { 
		if($list[$i][it_type2]==1) $item_type[$i] .="<img src='{$GnShop[skin_url]}/images/icon_type1.gif' border=0 align='absmiddle' alt='신상품'> ";
	}
	if ($GnShop[use_type3]) { 
		if($list[$i][it_type3]==1) $item_type[$i] .="<img src='{$GnShop[skin_url]}/images/icon_type2.gif' border=0 align='absmiddle' alt='베스트상품'> ";
	}
	if ($GnShop[use_type4]) { 
		if($list[$i][it_type4]==1) $item_type[$i] .="<img src='{$GnShop[skin_url]}/images/icon_type4.gif' border=0 align='absmiddle' alt='히트상품'> ";
	}
	if ($GnShop[use_type5]) { 
		if($list[$i][it_type5]==1) $item_type[$i] .="<img src='{$GnShop[skin_url]}/images/icon_type5.gif' border=0 align='absmiddle' alt='사은품제공상품'> ";
	}
	
}

$list_count = count($list);	//	리스트 갯수

//꼬리값
$qstr="ca_id=$ca_id&page=$page&sort1=$sort1&sort2=$sort2";

//현재위치(스타일에맞게펑션수정)
$ca_loc = get_location($ca_id);

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/list.skin.php";
if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>

