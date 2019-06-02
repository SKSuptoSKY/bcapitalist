<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

$sql = "select *
         from {$GnTable[shoporder]}
        where od_id = '$od_id'
          and on_uid = '$on_uid' ";
$result = sql_query($sql);
$od = mysql_fetch_array($result);
mysql_free_result($result);
if ($od[od_id] == "")
    alert("조회하실 주문서가 없습니다.");

// 배송회사 정보 가져오기
$sql = "select *
         from {$GnTable[shopdelivery]}
        where dl_id = '{$od[dl_id]}' ";
$result = sql_query($sql);
$dec = mysql_fetch_array($result);
mysql_free_result($result);


$sql = "select *
         from {$GnTable[shoppoint]}
        where po_id = '$po_id'
          and mb_id = '$mb_id'  and po_content = '발급' ";
$result = sql_query($sql);
$ch = mysql_fetch_array($result);
mysql_free_result($result);

$cash_checktime = date("Y-m-d",time()-31536000);

$page_loc = "member";

	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_view.skin.php";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";  
?>