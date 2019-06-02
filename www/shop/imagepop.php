<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$sql = " select it_name from {$GnTable[shopitem]} where it_id='$it_id' ";
	$row = mysql_fetch_array(sql_query($sql));

	$file_dir = $_SERVER["DOCUMENT_ROOT"]."/shop/data/item";

	$imagefile = "/shop/data/item/$img";
	$size = getimagesize($_SERVER["DOCUMENT_ROOT"].$imagefile);

	// 상품이미지 변환
	if(file_exists("./data/item/{$it_id}_l1") == true) $bigimg_0 = "/shop/data/item/{$it_id}_l1"; else $bigimg_0 = "{$GnShop[skin_url]}/images/no_image.gif";
	if(file_exists("./data/item/{$it_id}_l2") == true) $bigimg_1 = "/shop/data/item/{$it_id}_l2"; else $bigimg_1 = "{$GnShop[skin_url]}/images/no_image.gif";
	if(file_exists("./data/item/{$it_id}_l3") == true) $bigimg_2 = "/shop/data/item/{$it_id}_l3"; else $bigimg_2 = "{$GnShop[skin_url]}/images/no_image.gif";
	if(file_exists("./data/item/{$it_id}_l4") == true) $bigimg_3 = "/shop/data/item/{$it_id}_l4"; else $bigimg_3 = "{$GnShop[skin_url]}/images/no_image.gif";


	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/imagepop.skin.php";

	@mysql_close();
?>