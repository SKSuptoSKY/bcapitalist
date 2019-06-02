<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/product/lib/lib.php";

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


//상품이미지
for ($m=1; $m<=$GnProd["max_img_count"]; $m++) {
	if ($m==1) $style_img="display:;";
	else $style_img="display:none;";

	// 디비에 파일이름이 저장된것에 대해서만 [s],[m],[l] 배열을 생성한다.
	$it_file_array = get_it_file_size_array( $view["it_id"], $m );	
	foreach ($it_file_array as $key => $value) 
	{
		if ( $it_file_array[$key] )
		{
			// s,m,l 이미지의 url을 저장한다.  
			// $view["s_img_1_src"], $view["m_img_1_src"] , $view["l_img_1_src"] 의 형태
			$view[$key."_img_".$m."_src"] = $GnProd["prod_item_url"]."/".$it_file_array[$key];
			
			// 뷰 이미지 체인지 효과를 주는 더 작은 이미지용 변수
			$view["s_img_".$m."_resize"] = img_resize_tag($view["s_img_".$m."_src"],70,70,"onmouseover=\"change_img('{$m}')\" style='vertical-align:middle; cursor:pointer;' border='0'");

			// mj_basic1 스킨 사용시 필요
			$view["m_img_".$m."_resize"] = img_resize_tag($view["m_img_".$m."_src"],118,82,"onclick='click_small_img(this.src)'\" style='vertical-align:middle; cursor:pointer;' border='0'");
		}
	}
	$img = $view["l_img_".$m."_src"];

	// 출력 관련 -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//$view["s_img_".$m] = "<img src='".$view["s_img_".$m."_src"]."' id='main_img{$m}' onmouseover=\"change_img('{$m}')\"  border='0'>";	// S 이미지만 뽑아내려면 사용
	if($view["m_img_".$m."_src"] != "") {
		//$view["m_img_".$m] = "<img src='".$view["m_img_".$m."_src"]."' id='main_img{$m}' onclick=\"pop_imgResize('{$img}')\"  style='vertical-align:middle; cursor:pointer;{$style_img}' border='0'>";
		$view["m_img_".$m] = "<img src='".$view["m_img_".$m."_src"]."' id='main_img{$m}' onclick=\"pop_imgResize('{$img}')\" style='vertical-align:middle; cursor:pointer;{$style_img}' border='0'>";
	} else {
		$view["m_img_".$m] = "no-images";
	}
	//$view["l_img_".$m] = "<img src='".$view["l_img_".$m."_src"]."' id='main_img{$m}'  border='0'>";		// L 이미지만 뽑아내려면 사용
	// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}


//상품출력데이타정리
//상품설명
if($view[it_explan_html]) $view[it_explan] = str_replace("\n","",stripslashes($view[it_explan]));

//상품 큰이미지 보기
//$bigimg_link = get_large_image($it_id."_l1", $it_id,"300","250");

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

//카테고리불러옴
$sql_code = "select * from {$JO_table} where ca_id='$view[ca_id]'";
$code = sql_fetch($sql_code);
$view[category_name] = $code[ca_name];
$ca_id=$view["ca_id"];


//꼬리값
$qstr="it_id=$it_id&sort1=$sort1&sort2=$sort2";


include $_SERVER["DOCUMENT_ROOT"]."/skin/product/basic/item.skin.php";
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>