<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$leftloc="etc";
	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_form.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>