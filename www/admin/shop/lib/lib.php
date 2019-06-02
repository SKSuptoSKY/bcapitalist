<?
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	쇼핑몰 기본 환경변수 설정  - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	
|	* 업로드 이미지관련 설정 / 
|	* 쇼핑몰 기본 디렉토리 설정 / 
|	* 계좌번호 리스트 셀렉트박스 옵션 생성 / 
|	* 상품가격 관련 변수설정 / 
|	* 미수금 Query
|	* 장바구니 키값생성 / 
|	
|	
|	2015-02 / 수정시 각 파트별 배치 순서에 주의 !		*/


// 관리자 환경설정값 배열변수 ( $GnShop ) 생성
$sql = " select * from {$GnTable[shopconfig]} ";
$GnShop = sql_fetch($sql);

// 상품 고유번호 it_id 생성
if( empty($it_id) == TRUE ) { $it_id = time(); }


/* ------------------------------------------------------------- [ 업로드 이미지관련 설정 - START ] ------------------------------------------------------------- */
// 업로드할 이미지 총 갯수 ( 갯수만큼 썸네일 2개가 생성된다, 중, 소 )
$GnShop["max_img_count"] = 4; // 1~10개까지 가능

// 업로드할 이미지의 퀄리티 권장 (60~100) - 중,소 이미지에만 퀄리티 적용
$GnShop["img_quality"] = 100;

// 업로드 이미지가 없을때의 no_image 이미지 경로
$GnShop["no_img_src"] = "/skin/shop/basic/images/no_image.jpg";
/* ------------------------------------------------------------- [ 업로드 이미지관련 설정 - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 쇼핑몰 기본 디렉토리 설정 - START ] ------------------------------------------------------------- */
// 쇼핑몰 스킨 경로
if($GnShop[shop_skin] == "") $GnShop[shop_skin] = "basic";
$GnShop["skin_url"] = "/skin/shop/".$GnShop[shop_skin];
$GnShop["skin_dir"] = $_SERVER["DOCUMENT_ROOT"].$GnShop["skin_url"];

// 쇼핑몰 url
if($GnShop[shop_url] == "") $GnShop[shop_url] = "http://".$_SERVER["SERVER_NAME"];

// 쇼핑몰 업로드 디렉토리

$GnShop['data_url']					=	"/shop/data/item";
$GnShop['data_dir']					=	$_SERVER["DOCUMENT_ROOT"].$GnShop['data_url'];

// 상품 이미지가 업로드될 경로
$GnShop["shop_item_url"]= "/shop/data/item/".$it_id;
$GnShop["shop_item_dir"]= $_SERVER["DOCUMENT_ROOT"].$GnShop["shop_item_url"];

// 메일 스킨 경로
$mail_skin = "/admin/shop/mailskin/basic";
/* ------------------------------------------------------------- [ 쇼핑몰 기본 디렉토리 설정 - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 계좌번호 리스트 셀렉트박스 옵션 생성 - START ] ------------------------------------------------------------- */
// 기존 소스 수정 안됨
// 계좌번호 옵션값 만들기
$str = explode("\n", $GnShop[bankinfo]);
$default[bankoption] = "<option value=''>------------ 선택하십시오 ------------\n";
for ($i=0; $i<count($str); $i++){
	$str[$i] = str_replace("\r", "", $str[$i]);
	$default[bankoption]  .= "<option value='$str[$i]'>$str[$i] \n";
}
/* ------------------------------------------------------------- [ 계좌번호 리스트 셀렉트박스 옵션 생성 - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 상품가격 관련 변수설정 - START ] ------------------------------------------------------------- */
// 기존 소스 수정 안됨
// 부가세 %적용
$GnShop['vat_num'] = "8";

/// 쇼핑몰에서 사용할 변수값을 정합니다 ////
$default[de_code_dup_use]			= 0;     //// 코드값 중복체크 사용여부
$default[page_rows]					= 20;   ////  페이지 나누기
$default[de_write_pages]			= 10;
$default[or_mnum]					= 20;   //// 한번에 주문 가능한 수량
$default[de_level_sell]				= 0;
$default[de_cash_pay]				= 5000;   //// 현금영수증 발급 최소금액
$default[point_days]				= 0;		// 포인트 적립 반영일자

//// 주문가격별 구분을 위한 변수값 텍스트 변환값
$default_paytype[0] = "일반상품";
$default_paytype[1] = "<font color='#0000FF'><b>특가상품</b></font>";
$default_paytype[2] = "<font color='#000000'><b>회원할인</b></font>";
$default_paytype[3] = "<font color='#000000'><b>가족할인</b></font>";
$default_paytype[4] = "<font color='#000000'><b>해외할인</b></font>";
$default_paytype[5] = "<font color='#000000'><b>기업할인</b></font>";
$default_paytype[p] = "<font color='#FF0000'><b>증정품</b></font>";
/* ------------------------------------------------------------- [ 상품가격 관련 변수설정 - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 미수금 Query - START ] ------------------------------------------------------------- */
// 기존 쿼리 수정 안됨
$misuqry = "
count(distinct a.od_id) as ordercount, /* 주문서건수 */
	count(b.ct_id) as itemcount, /* 상품건수 */
	(a.od_temp_bank + a.od_temp_card) as orderamount , /* 주문합계 */
	(SUM(IF(b.ct_status = '취소' OR b.ct_status = '반품' OR b.ct_status = '품절', b.ct_amount * b.ct_qty, 0))) as ordercancel, /* 주문취소 */
	(a.od_receipt_bank + a.od_receipt_card + a.od_receipt_point) as receiptamount, /* 입금합계 */
	(a.od_refund_amount + a.od_cancel_card) as receiptcancel, /* 입금취소 */
	(
		(a.od_temp_bank + a.od_temp_card) -
		(SUM(IF(b.ct_status = '취소' OR b.ct_status = '반품' OR b.ct_status = '품절', b.ct_amount * b.ct_qty, 0))) -
		a.od_dc_amount -
		(a.od_receipt_bank + a.od_receipt_card + a.od_receipt_point) +
		(a.od_refund_amount + a.od_cancel_card)
	) as misu
";
/* ------------------------------------------------------------- [ 미수금 Query - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 장바구니 키값생성 - START ] ------------------------------------------------------------- */
// 기존 소스 수정 안됨
if (($g_on_uid = $_SESSION[ss_on_uid]) == false) {
    if (PHP_VERSION < '5.3.0'){
		if (!function_exists('session_register')){
			$ss_on_uid = $_SESSION["ss_on_uid"] = get_unique_id();
			$g_on_uid = $ss_on_uid;
		}else{
			session_register("ss_on_uid");
			$ss_on_uid = $_SESSION["ss_on_uid"] = get_unique_id();
			$g_on_uid = $ss_on_uid;
		}
	}else{
		$ss_on_uid = $_SESSION["ss_on_uid"] = get_unique_id();
		$g_on_uid = $ss_on_uid;
	}
}
/* ------------------------------------------------------------- [ 장바구니 키값생성 - END ] ------------------------------------------------------------- */

$it_opt1 = "";

//pgs관리
$pas_flag = "L"; // LG텔레콤(L) / 올더게이트(A),이니시스 (I)

/*
|
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	쇼핑몰 기본 환경 변수 설정 - End
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/







/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	쇼핑몰 사용시 적용되는 function - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	* /admin/lib/function.php로드 후 추가로 쇼핑몰 사용시에만 로드되는 함수 모음입니다.
|	* 함수 추가시 /admin/lib/function.php 와 함수명이 같은것이 존재하지 않도록 주의 !
|	
|	~ 2015
|
*/

// 유일키를 생성
function get_unique_id($len=32)
{
	global $GnTable;
	$unique = false;
	srand(time());
	do
	{
		$uid = substr(md5(rand()),0,$len);

		// 혹시 장바구니에도 겹치는게 있을 수 있으므로 ...
		$sql = "select COUNT(*) as cnt from {$GnTable[shopcart]} where on_uid = '$uid' ";
		$result = sql_query($sql);
		$row = mysql_fetch_array($result);
		$cnt = $row[cnt];
		if ($cnt == 0)
			$unique = true;
		mysql_free_result($result);
	}
	while ($unique == false);

	return $uid;
}

//-------------------------------------------------------------------------------------------------
// 세션값을 체크하여 비어있으면 메인으로 
// ( 타사이트에서 쇼핑몰에 접근, 유알엘 강제입력으로 접근등 )
function session_check()
{
	if ($_SESSION[ss_on_uid] == "")
		goto_url("/");
}
//-------------------------------------------------------------------------------------------------

// 이미지를 얻는다
function get_image($img, $width=0, $height=0, $resize=0, $tag='')
{
	global $GnShop;
	$full_img = $GnShop["shop_dir"]."/".$img;

	if (file_exists($full_img) && $img)
	{
		$size = getimagesize($full_img);
		$tr_width = $size[0];
		$tr_height = $size[1];

		if ($resize==1) {
			$re_width=ImgResize($size[0],$size[1],"width",$width,$height);
			$re_height=ImgResize($size[0],$size[1],"height",$width,$height);
		}
		else {
			$re_width=$width;
			$re_height=$height;
		}

		$str = "<img id='$img' src='$GnShop[shop_url]/shop/data/item/$img' width='$re_width' height='$re_height' border='0' {$tag}>";
	}
	else
	{
		$str = "<img id='$img' src='{$GnShop[no_img_src]}' border='0' ";
		if ($width)
			$str .= "width='$width' height='$height'";
		else
			$str .= " ";
		$str .= " {$tag}>";
	}


	return $str;
}
// 상품 이미지
function get_it_image($img, $width=0, $height=0, $id="", $resize=0)
{
	$str = get_image($img, $width, $height,$resize);
	if ($id) {
		$str = "<a href='/shop/item.php?it_id=$id'>$str</a>";
	}
	return $str;
}

// 상품 큰 이미지
function get_large_image($img, $it_id, $width="", $height="")
{
	global $GnShop;
	if (file_exists($GnShop["shop_dir"]."/".$img) == true && $img != "") {

		if(!$width) {
			$size   = getimagesize($GnShop["shop_dir"]."/".$img);
			$width  = $size[0];
			$height = $size[1];
		}

		$returnV = "onclick=\"javascript:popup_large_image('$it_id', '$img', $width, $height, '$cart_dir')\"  style='cursor:hand'";
	}
	else
		$returnV = "";
	return $returnV;
}

// 상품 옵션

function get_item_options__($subject,  $index, $fmode='0',$it_id="",$op_type="")
{
	
	$subject = trim($subject);
	if (!$subject || !$it_id) return "";
		
	$arr = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it_id."' and itop_type='".$index."' and itop_flag != 'x' order by itop_no asc;");

	if($fmode == 1) $onchange_text="onchange='amount_change(this.value); qty_flag(this.value);'";
	else if($fmode == 2) $onchange_text="onchange='add_option(this.value);'";

	// 옵션이 하나일 경우
		$str = "<select name=it_opt{$index} id='it_opt{$index}' {$onchange_text}>\n";
		$str.= "<option value=''> -선택- </option>";
		for ($k=0; $k<count($arr); $k++) {
			$str .= "<option value='".$arr[$k][itop_no]."'>{$arr[$k][itop_opt1]}";
			// 옵션에 금액이 있다면
			if ($arr[$k][itop_amount] != 0) {
				$str .= " (";
				// - 금액이 아니라면 모두 + 금액으로
				if($arr[$k][itop_amount_op] == "+") $str .= "+";
				else $str .= "-";
				$str .= display_amount($arr[$k][itop_amount]) . ")";
			}
			if(get_it_op_stock_qty($arr[$k][itop_no],$it_id) <= 0) $str .="<span style='color:#ff0000'>[품절]</span>";
			$str .= "</option>\n";
		}
		$str .= "</select>\n<input type=hidden name=it_opt{$index}_subject value='$subject'>\n";

	return $str;
}


function get_item_options($subject,  $index, $fmode='0',$it_id="",$op_type="")
{
	
	$subject = trim($subject);
	if (!$subject || !$it_id) return "";
		
	//$arr = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it_id."' and itop_type='".$index."' and itop_flag != 'x' order by itop_no asc;");
	$arr = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it_id."' and itop_type='".$index."' and itop_flag != 'x' and itop_flag != 'h' order by itop_no asc;");
	//if($fmode == 1) $onchange_text="onchange='amount_change(this.value); qty_flag(this.value);'";
	if($fmode == 1) $onchange_text="onchange='amount_this_change(this.value,{$index});'";
	else if($fmode == 2) $onchange_text="onchange='add_option(this.value);'";

	// 옵션이 하나일 경우
		$str = "<select name=it_opt{$index} id='it_opt{$index}' {$onchange_text}>\n";
		$str.= "<option value=''> -선택- </option>";
		for ($k=0; $k<count($arr); $k++) {
			$str .= "<option value='".$arr[$k][itop_no]."'>{$arr[$k][itop_opt1]}";
			// 옵션에 금액이 있다면
			if ($arr[$k][itop_amount] != 0) {
				$str .= " (";
				// - 금액이 아니라면 모두 + 금액으로
				if($arr[$k][itop_amount_op] == "+") $str .= "+";
				else $str .= "-";
				$str .= display_amount($arr[$k][itop_amount]) . ")";
			}

			if(get_it_op_stock_qty($arr[$k][itop_no],$it_id) <= 0) $str .="<span style='color:#ff0000'>[품절]</span>";
			$str .= "</option>\n";
		}
		$str .= "</select>\n<input type=hidden name=it_opt{$index}_subject value='$subject'>\n";
		
	return $str;
}


// 상품 옵션
function get_item_options_bk($subject, $option, $index)
{
	$subject = trim($subject);
	$option  = trim($option);

	if (!$subject || !$option) return "";

	$str = "";

	$arr = explode("\n", $option);
	// 옵션이 하나일 경우
	if (count($arr) == 1) {
		$str = $option;
	} else {
		$str = "<select name=it_opt{$index} onchange='amount_change()'>\n";
		for ($k=0; $k<count($arr); $k++) {
			$arr[$k] = str_replace("\r", "", $arr[$k]);
			$opt = explode(";", trim($arr[$k]));
			$str .= "<option value='$arr[$k]'>{$opt[0]}";
			// 옵션에 금액이 있다면
			if ($opt[1] != 0) {
				$str .= " (";
				// - 금액이 아니라면 모두 + 금액으로
				if (!ereg("[-]", $opt[1]))
					$str .= "+";
				$str .= display_amount($opt[1]) . ")";
			}
			$str .= "</option>\n";
		}
		$str .= "</select>\n<input type=hidden name=it_opt{$index}_subject value='$subject'>\n";
	}

	return $str;
}

// 상품옵션
// 인수는 $it_id, $it_opt1, ..., $it_opt6 까지 넘어옴
function print_item_options()
{
	global $GnTable;
		$it_id = func_get_arg(0);
		$sql = " select it_opt1_subject,
						it_opt2_subject,
						it_opt3_subject,
						it_opt4_subject,
						it_opt5_subject,
						it_opt6_subject
				   from {$GnTable[shopitem]}
				  where it_id = '$it_id' ";
		$it = sql_fetch($sql);

		$it_name = $str_split = "";
		for ($i=1; $i<=6; $i++) {

			$it_opt = trim(func_get_arg($i));
			// 1.04.25
			// 상품옵션에서 0은 제외되는 현상을 수정
			//if (!$it_opt) continue;
			if ($it_opt==null) continue;
			
			$ex_it_opt = explode(";",$it_opt);

			$it_opt = explode("|",$ex_it_opt[0]);
			$it_opt2 = explode(",",$ex_it_opt[1]);

			
			for($z=0; $z < count($it_opt); $z++){
					$it_name .= $str_split;
					$it_opt_subject = $it["it_opt{$i}_subject"];
					$opt_row_arr = Get_list_array("Gn_Shop_Add_option","where itop_no='".$it_opt[$z]."'");
					$it_name.="<table border='0' cellpadding='0' cellspacing='0'><tr><td valign='top'>- $it_opt_subject : </td><td>";
					for ($f=0; $f<count($opt_row_arr); $f++) {
						if (!$f) $it_name.= $opt_row_arr[$f]['itop_opt'.$i];
						else $it_name.= "<br>".$opt_row_arr[$f]['itop_opt'.$i];

						if ($opt_row_arr[$f]['itop_amount'] != 0) {
							$it_name .= " (";
							if ($opt_row_arr[$f]['itop_amount_op'] == "+") $it_name .= "+";
							else $it_name .= "-";
							$it_name .= display_amount($opt_row_arr[$f]['itop_amount']) . ")";
						}
						 if($it_opt2[$z] != "") $it_name .= "&nbsp; [".$it_opt2[$z]."개]";
						//$str_split = "<br>";
					}
					$it_name.="</td></tr></table>";
			}
		}
	return $it_name;
}

// 상품의 재고 (창고재고수량 - 주문대기수량)
function get_it_stock_qty($it_id)
{
	global $GnTable;
		$sql = " select it_stock from {$GnTable[shopitem]} where it_id = '$it_id' ";
		$row = sql_fetch($sql);
		$jaego = $row[it_stock];

		// 재고에서 빼지 않았고 주문인것만
		$sql = " select SUM(ct_qty) as cnt
				   from {$GnTable[shopcart]}
				  where it_id = '$it_id'
					and ct_stock_use = 0
					and ct_status in ('주문', '준비') ";
		$row = sql_fetch($sql);
		$daegi = $row[cnt];

	return (int)$jaego - $daegi;
}

function get_it_op_stock_qty($it_opt,$it_id)
{

		global $GnTable;
		
		// 재고에서 빼지 않았고 주문인것만
		$sql = " select SUM(ct_qty) as cnt
				   from {$GnTable[shopcart]}
				  where it_id = '$it_id'
					and ct_stock_use = 0
					and ct_status in ('주문', '준비') ";

					if(strlen($it_opt) > 0) {
						$row = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$it_opt."'");
						
						$jaego = $row[itop_stock];
						$op_stock_qty = $row[itop_opt1]."|".$row[itop_stock];
						$sql .="and op_name = '".$row[itop_opt1]."'";
					}else{
						$sql2 = " select it_stock from {$GnTable[shopitem]} where it_id = '$it_id' ";
						$row = sql_fetch($sql2);
						$jaego = $row[it_stock];
					}

		$row = sql_fetch($sql);
		$daegi = $row[cnt];


	return (int)$jaego - $daegi;
}


 ################## [ 단일옵션 전용 재고구하기 - START ] ##################
 // 인자 ( 옵션 고유넘버 )
function get_it_op_stock_qty_danil_option($op_no)
{
		global $GnTable;
		
		// 재고에서 빼지 않았고 주문인것만
		$sql = " select itop_stock 
				   from Gn_Shop_Add_option 
				  where itop_no = '$op_no'";

		$row = sql_fetch($sql);
		$qty = $row[itop_stock];
	return (int)$qty;
}

 ################## [ 옵션미사용일때 재고 구하기 - START ] ##################
function get_it_op_stock_qty_no_option($it_id)
{
		global $GnTable;
		
		// 재고에서 빼지 않았고 주문인것만
		$sql = " select it_stock 
				   from Gn_Shop_Item 
				  where it_id = '$it_id'";

		$row = sql_fetch($sql);
		$qty = $row[it_stock];
	return (int)$qty;
}



function item_payresult($it_id){ // 제품 가격을 구합니다.
	global $GnTable;
	$sql = " select * from {$GnTable[shopitem]} where it_id='$it_id' ";
	$item = sql_fetch($sql);
		if( Login_check() ) {
			if($item[it_epay]) {
				$pay[pay] = $item[it_epay];
				$pay[type] = "1";   /// 특가할인
			} else {
				$sql = " select * from {$GnTable[memberlevel]} where leb_level='$_SESSION[userlevel]' ";
				$dc = sql_fetch($sql);

				if($dc[leb_dc]) {
				$pay[pay] = ($item[it_pay] - ($item[it_pay]*($dc[leb_dc]/100)))/10;
				$pay[pay] = sprintf("%d0",$pay[pay]);
					if($dc[leb_level]=="10") $pay[type]  = "2";  /// 회원할인
					if($dc[leb_level]=="20") $pay[type]  = "3";  /// 가족할인
					if($dc[leb_level]=="30") $pay[type]  = "4";  /// 해외할인
					if($dc[leb_level]>40) $pay[type]  = "5";  /// 기업할인
				} else {
					$pay[pay] = $item[it_pay];
					$pay[type] = "0";
				}
			}
		} else {
			$pay[pay] = $item[it_pay];
			$pay[type] = "0";   /// 일반구매
		}
	return $pay;
}

function item_presentresult($pay,$type,$it_id){ // 증정품을 불러옵니다.
	global $GnShop, $GnTable;

	if($type) {
		$present_item = explode(",", $GnShop[present_item]);
		$ispresent_item = "";
		$present = "";
		for($k=0; $k < count($present_item); $k++) {
			if($_SESSION["userlevel"]==$present_item[$k]) {
				$sql = " select pritem_num,pr_num,odto_pay from {$GnTable[shoppresent]} where pr_type='1' and item_num ='$it_id' and odto_pay  < $pay order by odto_pay desc";
				$result = sql_query($sql);
				for($i=0; $row = sql_fetch_array($result); $i++) {
					if($row[pr_num] && !$present) $present = $row[pritem_num].",".$row[pr_num].",".$row[odto_pay];
						else if($row[pr_num] && $present) {
							$presents = explode("|", $present);
							for($p=0; $presents[$p]; $p++) {
								$present_item = explode(",", $presents[$p]);
								if($present_item[2]==$row[odto_pay]) $present .= "|".$row[pritem_num].",".$row[pr_num].",".$row[odto_pay];
							}
						}
				}
			}
		}
	} else { /// 주문금액별 증정품일경우

		$present_pay = explode(",", $GnShop[present_pay]);
		$ispresent_pay = "";
		for($k=0; $k < count($present_pay); $k++) {
			if($_SESSION["userlevel"]==$present_pay[$k]) {
				$ispresent_pay = "OK";
			}
		}

		if($ispresent_pay) {
			$sql = "select a.odto_pay, a.pr_num , b.it_id, b.it_name from {$GnTable[shoppresent]} a, {$GnTable[shopitem]} b where b.it_id = a.pritem_num and  a.pr_state = '1' and a.pr_type='0' and a.odto_pay < $pay order by a.odto_pay desc";
			$present = sql_fetch($sql);
		}
	}
	return $present;
}

// 장바구니 건수 검사
function get_cart_count($on_uid)
{
	global $GnTable;
		$sql = " select count(ct_id) from {$GnTable[shopcart]} where on_uid = '$on_uid' ";
		$result = sql_query($sql);
		$row = mysql_fetch_row($result);
		$cnt = (int)$row[0];
		mysql_free_result($result);
		return $cnt;
}

function display_amount($amount, $tel_inq=false){
	if ($tel_inq)
		$amount = "구입불가";
	else
		$amount = number_format($amount, 0) . "원";

	return $amount;
}

function display_point($point){
	if($point>0){
		$view = number_format($point,0)." 포인트";
	}
	return $view;
}

/// 상품을 불러오는 Select 박스의 option 값을 얻는다.
function item_namelist($id)
{
	global $GnTable;
		$sql = " select * from {$GnTable[shopitem]} order by it_name asc";
		$result = sql_query($sql);

		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			if($id==$row[it_id])  $isch = "selected"; else $isch = "";
			$option .= "<option value='$row[it_id]' $isch>$row[it_name]</option>\n";
		}
		echo $option;
}

// 주문서 번호를 얻는다.
/*
function get_new_od_id()
{
	global $GnTable;
		// 주문서 테이블 Lock 걸고
		@mysql_query(" LOCK TABLES {$GnTable[shoporder]} READ, {$GnTable[shoporder]} WRITE ");
		// 주문서 번호를 만든다.
		$date = date("ymd", time());    // 2002년 3월 7일 일경우 020307
		$sql = " select max(od_id) as cnt from {$GnTable[shoporder]} where SUBSTRING(od_id, 1, 6) = '$date' ";
		$result = sql_query($sql);
		$row = sql_fetch_array($result);
		$od_id = $row[cnt];
		if ($od_id == 0)
			$od_id = 1;
		else
		{
			$od_id = (int)substr($od_id, -4);
			$od_id++;
		}
		$od_id = $date . substr("0000" . $od_id, -4);
		// 주문서 테이블 Lock 풀고
		@mysql_query(" UNLOCK TABLES ");

		return $od_id;
}
*/

function get_new_od_id()
{
	global $GnTable;
		// 주문서 테이블 Lock 걸고
		@mysql_query(" LOCK TABLES {$GnTable[shoporder]} READ, {$GnTable[shoporder]} WRITE ");
		// 주문서 번호를 만든다.
		while(1){
			$date = rand(1, 9999999999);    // 2002년 3월 7일 일경우 020307
			for($i=strlen($date); $i < 10; $i++){
				$date = "0".$date;
			}
			$sql = " select count(*) as cnt from {$GnTable[shoporder]} where od_id = '$date' ";
			$result = sql_query($sql);
			$row = sql_fetch_array($result);
			$od_id_ch = $row[cnt];
			if($od_id_ch == "0") break;
		}

		// 주문서 테이블 Lock 풀고
		@mysql_query(" UNLOCK TABLES ");

		return $date;
}

// 회원DB에 주문정보를 업데이트합니다.
function put_totalorder($mb_id)
{
	global $GnTable, $GnShop;
			 $sql_tbl = " {$GnTable[member]} c left join {$GnTable[shoporder]} a on (a.mb_id = c.mem_id and (a.od_invoice_time > '0000-00-00 00:00:00' or a.od_invoice > 0) )";
			 $sql_selec = " c.* , count(distinct a.od_id) as oder_count ,(sum(a.od_receipt_bank + a.od_receipt_card)) as total_pay";
			 $sql_where = " where c.mem_id = '$mb_id' GROUP BY c.mem_id";

			 $sql = "select $sql_selec from $sql_tbl $sql_where ";
			 $result = sql_query($sql);

			 for ($i=0; $row=sql_fetch_array($result); $i++) {
					$sql = "UPDATE `{$GnTable[member]}` SET mshop_total = '{$row[total_pay]}', mshop_count = '{$row[oder_count]}' where mem_id = '{$row[mem_id]}' ";
					sql_query($sql);
			}
}

/// 상품 출력
function main_type($skin, $type, $list_mod, $list_row, $img_width, $img_height, $ca_id="",$list_start="")
{
	global $GnTable, $GnShop;

	// 상품의 갯수
	$items = $list_mod * $list_row;
	$list_start = $list_start ? $list_start : 0;
	
	$field = "it_id, it_name, it_cust_amount, it_pay, it_epay, it_point, it_basic, it_tel_inq, it_stock";
	$field.= ", it_type1, it_type2, it_type3, it_type4, it_type5 ";
	$sql = " select $field from {$GnTable[shopitem]}
			  where it_use = '1' ";
	if ($type) $sql .= " and it_type{$type} = '1' ";
	if ($ca_id) $sql .= " and ca_id like '$ca_id%' ";
	$sql .= " order by it_order desc, it_id desc limit $list_start,$items ";
	$result = sql_query($sql);
	if (!mysql_num_rows($result)) {
		return false;
	}

	$file = $_SERVER["DOCUMENT_ROOT"]."/skin/shop/{$GnShop[shop_skin]}/type_{$skin}.skin.php";
	if (!file_exists($file)) {
		echo "<span class=point>{$file} 파일을 찾을 수 없습니다.</span>";
	} else {
		$td_width = (int)(100 / $list_mod);

	ob_start();
	include $file;
	$file = ob_get_contents();
	ob_end_clean();

		return $file;
	}
}
function main_type1($skin, $type, $list_mod, $list_row, $img_width, $img_height, $ca_id="",$list_start="")
{
	global $GnTable, $GnShop;

	// 상품의 갯수
	$items = $list_mod * $list_row;
	$list_start = $list_start ? $list_start : 0;
	
	$field = "it_id, it_name, it_cust_amount, it_pay, it_epay, it_point, it_basic, it_tel_inq, it_stock";
	$field.= ", it_type1, it_type2, it_type3, it_type4, it_type5 ";
	$sql = " select $field from {$GnTable[shopitem]}
			  where it_use = '1' ";
	$sql .= " and it_type4 = '1' ";
	if ($ca_id) $sql .= " and ca_id like '$ca_id%' ";
	$sql .= " order by it_order desc, it_id desc limit $list_start,$items ";
	$result = sql_query($sql);
	if (!mysql_num_rows($result)) {
		return false;
	}

	$file = $_SERVER["DOCUMENT_ROOT"]."/skin/shop/{$GnShop[shop_skin]}/type_{$skin}.skin.php";
	if (!file_exists($file)) {
		echo "<span class=point>{$file} 파일을 찾을 수 없습니다.</span>";
	} else {
		$td_width = (int)(100 / $list_mod);

	ob_start();
	include $file;
	$file = ob_get_contents();
	ob_end_clean();

		return $file;
	}
}
// 관련 상품 출력
function view_type($skin,$img_width, $img_height, $ca_id)
{
	global $GnTable, $GnShop;

	// 상품의 갯수
	
	//$field = "it_other1 , it_other2 , it_other3 , it_other4 , it_other5 , it_other6 ";
	$sql = " select * from {$GnTable[shopitem]}
			  where it_use = '1' and it_id='$ca_id'";
   
	$result = sql_query($sql);
	if (!mysql_num_rows($result)) {
		return false;
	}

	$file = $_SERVER["DOCUMENT_ROOT"]."/skin/shop/{$GnShop[shop_skin]}/type_{$skin}.skin.php";


	ob_start();
	include $file;
	$file = ob_get_contents();
	ob_end_clean();

		return $file;
	
}
//관련상품 정확한 아이디 값인지 체크
function other_check($id)
{
	global $GnTable, $GnShop;

	$sql = "select * from   {$GnTable[shopitem]}
			  where it_use = '1' and it_id ='$id' ";
	
	$row = sql_fetch($sql);
	return $row;
}


function insert_point($mb_id, $point, $content='')
{
	global $GnTable,$GnShop,$default,$default, $isday, $datetime;

	// 포인트 사용을 하지 않는면
	if (!$default[use_point]) return;
	// 포인트가 없으면
	if ($point == 0) { return; }
	// 회원아이디가 없으면
	if ($mb_id == "") { return; }

	// 포인트 내용추가
	$sql = " insert {$GnTable[shoppoint]}
				set mb_id = '$mb_id',
					po_datetime = '$datetime',
					po_content = '$content',
					po_point = '$point' ";
	//sql_query($sql);

	// 포인트 합 구하기 (회원 포인트)
	$sql = " select sum(p_point) as point from {$GnTable[point]} where p_member = '$mb_id' ";
	$row_mem = sql_fetch($sql);
	
	// 포인트 합 구하기 (쇼핑몰 포인트)
	$sql = " select sum(po_point) as point from {$GnTable[shoppoint]} where mb_id = '$mb_id' ";
	$row_shop = sql_fetch($sql);
	// 포인트 누적
	$point = $row_mem['point'] + $row_shop['point'];
	$sql = " update {$GnTable[member]}
				set mem_point = '$point'
			  where mem_id = '$mb_id' ";
	sql_query($sql);
}

// 별이미지 구하기
function get_star($score)
{
	if ($score > 8) $star = "5";
	else if ($score > 6) $star = "4";
	else if ($score > 4) $star = "3";
	else if ($score > 2) $star = "2";
	else if ($score > 0) $star = "1";
	else $star = "";

	return $star;
}

// 배너출력
function print_brand($skin="", $type="", $num="")
{
	global $default, $DOCUMENT_ROOT;

	if($type=="rand") {
		$sql_order = 	"order by RAND()";
	} else {
		$sql_order = 	"order by br_order, br_id desc";
	}

	if($num) {
		$sql_num = 	"limit $num";
	} else {
		$sql_num = 	"";
	}

	$sql = " select * from {$GnTable[shopbrand]}
			  where br_use = '1'
			  $sql_order $sql_num ";

	$result = sql_query($sql);

	for ($i=0; $row=mysql_fetch_array($result); $i++) {
		$brand[$i] = $row;

		$brand[$i][img] = "/shop/data/brand/{$brand[$i][br_id]}";
		$brand[$i][imgurl] = $_SERVER["DOCUMENT_ROOT"]."/shop/data/brand/{$brand[$i][br_id]}";

		if ($brand[$i][br_url] && $brand[$i][br_url] != "http://") {
			// 1.00.06
		   $brand[$i][link] = $brand[$i][br_url];
		} else {
			$brand[$i][link] = "#";
		}
	}

	$file = $_SERVER["DOCUMENT_ROOT"]."/shop/brand.php";

	ob_start();
	include $file;
	$file = ob_get_contents();
	ob_end_clean();

	return $file;
}

// 패턴의 내용대로 해당 디렉토리에서 정렬하여 <select> 태그에 적용할 수 있게 반환
function get_file_options($pattern, $dirname="./")
{
	$str = "";

	unset($arr);
	$handle = opendir($dirname);
	while ($file = readdir($handle)) {
		if (preg_match("/$pattern/", $file, $matches)) {
			$arr[] = $matches[0];
		}
	}
	closedir($handle);

	sort($arr);
	foreach($arr as $key=>$value) {
		$str .= "<option value='$arr[$key]'>$arr[$key]</option>\n";
	}

	return $str;
}

// 상단 카테고리 위치 가져오기
function get_location($ca_id) {
	global $GnTable;
	$ca_point1="<b>";
	$ca_point2="</b>";
	$ca_len=strlen($ca_id);
	$substr_len=0;
	for ($c=0; $c<4; $c++) {
		$substr_len+=2;
		${"ca_num".$substr_len}=substr($ca_id,0,$substr_len);
		$sql="select ca_name from {$GnTable[shopcategory]} where ca_id='".${"ca_num".$substr_len}."' ";
		${"row_num".$substr_len}=sql_fetch($sql);
	}
	if ($ca_len==2) $ca_loc="{$ca_point1}{$row_num2[ca_name]}{$ca_point2}";
	if ($ca_len==4) $ca_loc="{$row_num2[ca_name]} > {$ca_point1}{$row_num4[ca_name]}{$ca_point1}";
	if ($ca_len==6) $ca_loc="{$row_num2[ca_name]} > {$row_num4[ca_name]} > {$ca_point1}{$row_num6[ca_name]}{$ca_point2}";			
	if ($ca_len==8) $ca_loc="{$row_num2[ca_name]} > {$row_num4[ca_name]} > {$row_num6[ca_name]} > {$ca_point1}{$row_num8[ca_name]}{$ca_point2}";			
	return $ca_loc;
}

// 등록코드의 이름을 불러옵니다.
function get_cate_name($cate) {
	global $GnTable;
	// 테이블의 전체 레코드수만 얻음
	$sql = " select ca_name from {$GnTable[shopcategory]} where ca_id='$cate'";
	$row = sql_fetch($sql);
	return $row[ca_name];
}

// 카테고리 내역을 불러옵니다.
function get_cate_option($Cvalue, $Cstyle="SELECT", $length='2') {
	global $GnTable;
	// 테이블의 전체 레코드수만 얻음

	if($length>2) {
		$ca_se = $length-2;
		$ch_val = substr($Cvalue,0,$ca_se);
		$where = " and left(ca_id,$ca_se)='$ch_val' ";
	}

	$sql = " select * from {$GnTable[shopcategory]} where length(ca_id)=$length $where order by ca_id ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++)
	{
			if($Cstyle=="SELECT") {
				if($Cvalue==$row[ca_id]) $selected = "selected"; else $selected = "";
				$Coption .= "<option value='$row[ca_id]' $selected>$row[ca_name]";
			}
			if($Cstyle=="ARR") {
				$Coption[$i] = $row;
			}
	}
	return $Coption;
}

// 은행계좌정보 가져오기 위한 함수
function Shop_BankList() {
	global $GnTable, $GnShop;
		// 계좌번호 옵션값 만들기
		$str = explode("\n", $GnShop[bankinfo]);
		$banklist = "";
		for ($i=0; $i<count($str); $i++)
		{
			$str[$i] = str_replace("\r", "", $str[$i]);
			$banklist  .= "<option value='$str[$i]'>$str[$i] \n";
		}

	return $banklist;
}


// 브랜드 옵션을 불러옵니다.
function get_brand_option($Cvalue,$Cstyle,$Cname) {
	global $GnTable, $GnShop;
		$sql = " select * from {$GnTable[shopbrand]} where br_use='1' order by br_order ";
		$result = sql_query($sql);

		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
				if($Cstyle=="SELECT") {
					if($Cvalue==$row[br_id]) $selected = "selected"; else $selected = "";
					$Coption .= "<option value='$row[br_id]' $selected>$row[br_name]";
				}
				if($Cstyle=="ARR") {
					$Coption[$i] = $row;
				}
				if($Cstyle=="RADIO") {
					if($Cvalue==$row[br_id]) $selected = "checked"; else $selected = "";
					$Coption .= "<input type='radio' name='$Cname' value='{$row[br_id]}' $selected>{$row[br_name]} ";
				}
		}

	return $Coption;
}

function shop_title($ca_id){
	$data = sql_fetch("select ca_name from Gn_Shop_Category where ca_id='$ca_id'");
	return $data[ca_name];
}
//옵션 속성 갯수
function it_op_count($op){
	$ex_it_opt = explode("\n",$op);
	return count($ex_it_opt);
}



// 상품의 옵션 타입이 어떤건지 반환 20140625 mj
function get_it_opt_use($it_id) 
{
	$find_sql = "SELECT it_opt_use,it_opt_use2 FROM Gn_Shop_Item WHERE it_id = '".$it_id."'";
	$find_query = mysql_query($find_sql);
	$find_row = mysql_fetch_array($find_query);
	
	if($find_row["it_opt_use2"]=="1") 
	{
		$option_type = "다중원가포함옵션";
	} 
	else 
	{
		$this_option = $find_row["it_opt_use"];
		switch($this_option) 
		{
			case "0" : 
				$option_type = "사용안함";
				break;
			case "1" : 
				$option_type = "단일옵션";
				break;
			case "2" : 
				$option_type = "다중옵션";
				break;
		}
	}
	return $option_type;
}


function get_option_amount($option_num) {
	$sql = "SELECT itop_amount_op, itop_amount FROM Gn_Shop_Add_option WHERE itop_no='$option_num' ";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	
	// 옵션이 +인지 -인지 구분
	$amount = $row[itop_amount_op].$row[itop_amount];
	return $amount;
}

function get_state_amount($on_uid, $state) {
	$cancel_sql = "SELECT * FROM Gn_Shop_Cart WHERE on_uid='$on_uid' and ct_status='$state' ";
	$cancel_query = mysql_query($cancel_sql);
	$cancel_count = mysql_num_rows($cancel_query);

	for($i=0; $i < $cancel_count; $i++) {
		$cart_row[$i] = mysql_fetch_array($cancel_query);
		$this_option_amount += $cart_row[$i][ct_amount];
	}
	return $this_option_amount;
}


// it_id로 해당 원하는 필드의 이름 알아내기------------------------------------------------
function get_it_value($it_id, $field) {
	$product_sql = "SELECT $field FROM Gn_Shop_Item WHERE it_id='".$it_id."'";
	$product_query = mysql_query($product_sql);
	$product_row = mysql_fetch_array($product_query);
  
	$it_value = $product_row[$field];
	return $it_value;
}

// 옵션넘버로 옵션값 가져오기 + - 기호 포함
function option_amount($option_no) {
	$option_sql = "SELECT itop_amount_op,itop_amount FROM Gn_Shop_Add_option WHERE itop_no='$option_no'";
	$option_query = mysql_query($option_sql);
	$option_row = mysql_fetch_array($option_query);
	
	return $option_amount = $itop_amount_op.$option_row[itop_amount];
}
//-----------------------------------------------------------------------------------------------------


// it_id, 상품인덱스번호를 인자로 받아 이미지 파일네임을 배열인덱스로 반환함.
// 반환형태 : 배열인덱스 s,m,l 을 키로 하는 벨류값(파일네임)을 반환한다.
function get_it_file_size_array( $it_id, $file_index ) {	
	global $GnShop;
	$get_file_sql = "SELECT it_file{$file_index} FROM Gn_Shop_Item WHERE it_id = '$it_id' ";
	$get_file_query = mysql_query($get_file_sql);
	$get_file_rows = mysql_fetch_array($get_file_query);
	$field_file_name = $get_file_rows["it_file".$file_index];
	
	$it_file_array["l"] = $field_file_name;
	$it_file_array["m"] = str_replace($it_id."_l", $it_id."_m", $field_file_name);
	$it_file_array["s"] = str_replace($it_id."_l", $it_id."_s", $field_file_name);
	
	return $it_file_array;
}

/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	쇼핑몰 사용시 적용되는 function - End
|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
?>