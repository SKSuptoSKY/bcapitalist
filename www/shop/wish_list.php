<?
    include $_SERVER["DOCUMENT_ROOT"]."/head.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

if (!$_SESSION[userid] || $_SESSION[userid]=="GUEST") 
    alert("회원 전용 서비스 입니다.", "/member/login.php?url=".urlencode($url));

	$leftloc="member";

	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/whish_list.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
    include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; 
?>
