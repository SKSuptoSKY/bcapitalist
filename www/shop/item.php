<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

//퀵
$saved = false;
$tv_idx = (int)get_session("ss_tv_idx");
if ($tv_idx > 0) {
    for ($i=1; $i<=$tv_idx; $i++) {
        if (get_session("ss_tv[$i]") == $it_id) {
            $saved = true;
            break;
        }
    }
}

if (!$saved) {
    $tv_idx++;
    set_session("ss_tv_idx", $tv_idx);
    set_session("ss_tv[$tv_idx]", $it_id);
}


//값정리
$PG_table = $GnTable["shopitem"];
$PG_table2 = $GnTable["shopconfig"];
$JO_table = $GnTable["shopcategory"];
$PG_table3 = $GnTable["shopoption"];

if (!$ca_id) $ca_id="10";
$pslist_pagenum = 10 ;
	

//조회수 증가
if ($_COOKIE[ck_it_id] != $it_id) {
	sql_query(" update $PG_table set it_hit = it_hit + 1 where it_id = '$it_id' "); // 1증가
	setcookie("ck_it_id", $it_id, time() + 3600, "/",$_SERVER["SERVER_NAME"]); // 1시간동안 저장
}


//보안검사
if (!$it_id) alert("상품정보가 없습니다.","/");


//상품정보
$sql = "select * from $PG_table where it_id = '$it_id' ";
$view = sql_fetch($sql);

//옵션 단일과 다중일때 카운터설정 * 다중일때는 opt 한개만 사용하기때문
if($view[it_opt_use] == "1") 
{
	//$OpFlag = "6";
	// 등록한 옵션의 갯수
	$option_count_sql = "select itop_no from {$PG_table3} where itop_it_id = '$it_id' and itop_opt1 != '' GROUP BY itop_type";
	$option_count_query = mysql_query($option_count_sql);
	$OpFlag = mysql_num_rows($option_count_query);
}
if($view[it_opt_use] == "2") $OpFlag = "1";

//상품이미지
for ($m=1; $m<=$GnShop["max_img_count"]; $m++) 
{
	if ($m==1) $style_img="display:;";
	else $style_img="display:none;";
	
	// 디비에 파일이름이 저장된것에 대해서만 [s],[m],[l] 배열을 생성한다.
	$it_file_array = get_it_file_size_array( $view["it_id"], $m );	
	foreach ($it_file_array as $key => $value) 
	{
		if ( $it_file_array[$key] )
		{
			// s,m,l 이미지의 url을 저장한다.  // $view["s_img_1_src"], $view["m_img_1_src"] , $view["l_img_1_src"] 의 형태
			$view[$key."_img_".$m."_src"] = $GnShop["shop_item_url"]."/".$it_file_array[$key];
			
			// 뷰 이미지 체인지 효과를 주는 더 작은 이미지용 변수
			$view["s_img_".$m."_resize"] = img_resize_tag($view["s_img_".$m."_src"],70,70,"onmouseover=\"change_img('{$m}')\" style='vertical-align:middle; cursor:pointer;' border='0'");
		}

	}
	$img = $view["l_img_".$m."_src"];

	//$view["s_img_".$m] = "<img src='".$view["s_img_".$m."_src"]."' id='main_img{$m}' onmouseover=\"change_img('{$m}')\"  border='0'>";	// S 이미지만 뽑아내려면 사용
	$view["m_img_".$m] = "<img src='".$view["m_img_".$m."_src"]."' id='main_img{$m}' onmouseover=\"change_img('{$m}')\" onclick=\"pop_imgResize('{$img}')\"  style='cursor:pointer;{$style_img}' border='0'>";
	//$view["l_img_".$m] = "<img src='".$view["l_img_".$m."_src"]."' id='main_img{$m}' onmouseover=\"change_img('{$m}')\" border='0'>";		// L 이미지만 뽑아내려면 사용
}


//상품출력데이타정리

// 상품재고
/*
$itstock = get_it_stock_qty($it_id);
if($itstock < 1) $max_text = "<font color=red>품절</font>";
else if($default[or_mnum] < $itstock) $max_num = $default[or_mnum];
else $max_num = $itstock;
*/
//상품설명
if($view[it_explan_html]) $view[it_explan] = str_replace("\n","",stripslashes($view[it_explan]));

//상품 큰이미지 보기
//$bigimg_link = get_large_image($it_id."_l1", $it_id,"300","250");

//상품 옵션
for ($i=1; $i<=6; $i++) {
	//옵션에 문자가 존재한다면
	$view["it_opt{$i}"] = get_item_options(trim($view["it_opt{$i}_subject"]), $i, $view["it_opt_use"],$it_id,$view["it_opt{$i}"]);
	//$view["it_opt{$i}"] = get_item_options(trim($view["it_opt{$i}_subject"]), $i, $view["it_opt_use"],$it_id,$view["it_opt{$i}"]);//회원 등급별 옵션 가격 차별로 추가
}

//상품타입이미지
$item_type ="";
if ($GnShop[use_type1]) { 
	//if($view[it_type1]==1) $item_type .="<img src='{$GnShop[skin_url]}/images/icon_type1.gif' border=0 align='absmiddle' alt='메인추출상품'> ";
}
if ($GnShop[use_type2]) { 
	if($view[it_type2]==1) $item_type .="<img src='{$GnShop[skin_url]}/images/icon_type1.gif' border=0 align='absmiddle' alt='신상품'> ";
}
if ($GnShop[use_type3]) { 
	if($view[it_type3]==1) $item_type .="<img src='{$GnShop[skin_url]}/images/icon_type2.gif' border=0 align='absmiddle' alt='베스트상품'> ";
}
if ($GnShop[use_type4]) { 
	if($view[it_type4]==1) $item_type .="<img src='{$GnShop[skin_url]}/images/icon_type4.gif' border=0 align='absmiddle' alt='히트상품'> ";
}
if ($GnShop[use_type5]) { 
	if($view[it_type5]==1) $item_type .="<img src='{$GnShop[skin_url]}/images/icon_type5.gif' border=0 align='absmiddle' alt='사은품제공상품'> ";
}
if($view[it_stock] == "0"){
	$item_type .="<span style=\"color:#ff0000;\"> [품 절]</span> ";
}

//상품가격적용
$view[it_opay]= $view[it_pay];  //	정가보존변수
if($view[it_epay]>0) {
	$view[it_pay] = $view[it_epay];
}

$real_pay = $view[it_pay];

//카테고리불러옴
$sql_code = "select * from {$JO_table} where ca_id='$view[ca_id]'";
$code = sql_fetch($sql_code);
$view[category_name] = $code[ca_name];
$ca_id=$view["ca_id"];


//상품후기불러옴
$sql_where = " where it_id = '$it_id' and is_confirm = 1 ";
$sql_order = " order by is_time desc";

$sql = " select count(*) as cnt from {$GnTable[shopafter]}	 $sql_where $sql_order";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$total_page  = ceil($total_count / $pslist_pagenum);
if ($page == "") $page = 1;
$from_record = ($page - 1) * $pslist_pagenum;
$sql = "select a.*,  b.mem_name  from {$GnTable[shopafter]} a, {$GnTable[member]} b
  		   where a.it_id = '$it_id' and a.mb_id = b.mem_id
		   order by a.is_id desc ";
$result = sql_query($sql);

for ($i=0; $ps[$i] =mysql_fetch_array($result); $i++) {
	$ps[$i][is_subject] = stripslashes(cut_str($ps[$i][is_subject], 50, "..."));
	$ps[$i][is_content] = nl2br(stripslashes($ps[$i][is_content]));
	$ps[$i][star] = get_star($ps[$i][is_score]);
	$ps[$i][is_time] = substr($ps[$i][is_time], 2, 14);
}


//상품문의불러옴
$sql = "select a.*,  b.mem_name  from {$GnTable[shopinquire]} a, {$GnTable[member]} b
		   where a.it_id = '$it_id' and a.mb_id = b.mem_id
		   order by a.iq_id desc ";
$result = sql_query($sql);

for ($i=0; $qa[$i] =mysql_fetch_array($result); $i++) {
	$qa[$i][star] = get_star($qa[$i][iq_score]);
	$qa[$i][iq_subject]		= stripslashes($qa[$i][iq_subject]);
	$qa[$i][iq_question]	= stripslashes($qa[$i][iq_question]);
	$qa[$i][iq_answer]		= stripslashes($qa[$i][iq_answer]);
	$qa[$i][iq_time]		= substr($qa[$i][iq_time], 2, 14);

	$qa[$i][qa]				= "<img src='$cfg[d_url]/$cart_skin/icon_poll_q.gif' border=0>";
	if ($qa[$i][iq_answer]) $qa[$i][qa] .= "<img src='$cfg[d_url]/$cart_skin/icon_answer.gif' border=0>";
	$qa[$i][qa]				= "{$qa[$i][qa]}";
}


//포인트계산
$point_end=round(($GnShop[point_use]*$view[it_pay])/100);


//관련상품불러옴
if ($view[it_order]) {
	$it_order_arr=explode(",",$view[it_other]);
	for ($o=0; $o<count($it_order_arr); $o++) {
		$it_order_sql.="and it_id='{$it_order_arr[$o]}'";
	}
	$sql="select * from {$PG_table} where 1 and it_use='1' {$it_order_sql} limit 4";
	$res_other=sql_query($sql);

	for ($o=0; $row_other=mysql_fetch_array($res_other); $o++) {
		$list_other[$o]=$row_other;
		$list_other[$o]["list_img"]=img_resize_tag("/shop/data/item/{$list_other[$o][it_id]}_s",$GnShop["simg_width"],$GnShop["simg_height"]);
	}
	$total_other=count($list_other);
}


//꼬리값
$qstr="it_id=$it_id&sort1=$sort1&sort2=$sort2";

//------------------------------------------------추가코드s------------------------------------------------
//현재위치(스타일에맞게펑션수정)
$ca_loc = get_location($ca_id);

//다중옵션관련
$option_max_add=50; //옵션최대추가 시도갯수 
$option_max=30; //옵션을 추가할수 있는 총갯수
$option_buy_max=30; //한옵션에서 구매할수있는 최대 갯수
//------------------------------------------------추가코드e------------------------------------------------

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";


/* ------------------------------------------------------------- [ 상품 옵션에 따른 상품상세페이지 스킨 - START ] ------------------------------------------------------------- */
if($view[it_opt_use] == "0") { include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/item.skin.php"; }						// [ 사용안함 ]
if($view[it_opt_use] == "1") { include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/item_option1.skin.php"; }			// [ 단일옵션 ]
if($view[it_opt_use] == "2") {																																	// [ 다중 옵션 ]
	if($view[it_opt_use2]=="0") { include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/item_option2_1.skin.php"; }		//  원가 미포함
	if($view[it_opt_use2]=="1") { include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/item_option2_2.skin.php"; }		//  원가 포함
}
/* ------------------------------------------------------------- [ 상품 옵션에 따른 상품상세페이지 스킨 - END ] ------------------------------------------------------------- */


if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>