<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$sql = " select * from {$GnTable[shoporder]} 
              where on_uid = '$id' ";
    $result = sql_query($sql);
	$od = mysql_fetch_array($result);

$leftloc="etc";
if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_print.skin.php";
if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>