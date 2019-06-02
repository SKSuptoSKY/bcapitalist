<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

	$leftloc="member";
	$s_page = "shopbag.php";

	if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/shopbag.skin.php";
	if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";

?>
<script language="javascript">
function del_go(it_id){
	result00=confirm('\n선택하신 항목을 삭제 하시겠습니까?\n');

	if(result00==true){
		location.href="./shopbag_update.php?mode=D&ct_id="+it_id;
	}

}
</script>