<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

session_check();

// 장바구니가 비어있는가?
if (get_cart_count($_SESSION[ss_on_uid]) == 0 && get_cart_count($_SESSION[ss_od_on_uid]) == 0)
	alert("장바구니가 비어 있습니다.", "./shopbag.php");

// 희망배송일 사용한다면
if ($default[de_hope_date_use])
{
	ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $od_hope_date, $hope_date);
	if ($od_hope_date == "") ; // 통과
	else if (checkdate($hope_date[2], $hope_date[3], $hope_date[1]) == false)
		alert("희망배송일을 올바르게 입력해 주십시오.");
	else if ($od_hope_date < date("Y-m-d", time()+86400*$default[de_hope_date_after]))
		alert("희망배송일은 오늘부터 {$default[de_hope_date_after]}일 후 부터 입력해 주십시오.");
}

// 회원 로그인 중이라면 회원비밀번호를 주문서에 넣어줌
if ($Get_Login)
	$od_pwd = $_SESSION["shopup"];
else
	$od_pwd = sql_password($od_pwd);

$od_zip1		= substr($od_zip,0,3);
$od_zip2		= substr($od_zip,3,3);
$od_b_zip1		= substr($od_b_zip,0,3);
$od_b_zip2		= substr($od_b_zip,3,3);

// 세금계산서 정보
$od_bill_info = @implode("|",$bill_info);
$leftloc="etc";


if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";


/* ------------------------------------------------------------- [ 관리자 연동 스킨 불러오기 - START ] ------------------------------------------------------------- */
// 관리자 연동 모듈 스킨경로 분기 변수
$order_receipt_skin["moo"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt.skin.php";

if( $GnShop["pg_module"] == "LG" ) 
{
	$order_receipt_skin["card"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_LG_card.skin.php";
	$order_receipt_skin["trans"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_LG_transfer.skin.php";
	$order_receipt_skin["virtual"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_LG_virtual.skin.php";
	$order_receipt_skin["mobile"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_LG_mobile.skin.php";
} 
else if( $GnShop["pg_module"] == "INICIS" ) 
{
	$order_receipt_skin["card"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_INI_card.skin.php";
	$order_receipt_skin["trans"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_INI_transfer.skin.php";
	$order_receipt_skin["virtual"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_INI_virtual.skin.php";
	$order_receipt_skin["mobile"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_INI_mobile.skin.php";
} 
else if( $GnShop["pg_module"] == "KCP" ) 
{
	$order_receipt_skin["card"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_KCP_card.skin.php";
	$order_receipt_skin["trans"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_KCP_transfer.skin.php";
	$order_receipt_skin["virtual"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_KCP_virtual.skin.php";
	$order_receipt_skin["mobile"]	= $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_receipt_KCP_mobile.skin.php";
}

// 스킨 불러오기 
if( $od_settle_case == "무통장" ) 
{
	include_once $order_receipt_skin["moo"];
} 
else if( $od_settle_case == "신용카드" ) 
{
	include_once $order_receipt_skin["card"];
} 
else if($od_settle_case == "계좌이체") 
{
	include_once $order_receipt_skin["trans"];
} 
else if($od_settle_case == "가상계좌") 
{
	include_once $order_receipt_skin["virtual"];
} 
else if($od_settle_case == "휴대폰") 
{
	include_once $order_receipt_skin["mobile"];
}
/* ------------------------------------------------------------- [ 관리자 연동 스킨 불러오기 - END ] ------------------------------------------------------------- */


if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>