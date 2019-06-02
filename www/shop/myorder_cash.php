<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
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

if(!$od[od_receipt_bank]){
	alert("현금 입금내역이 없으면 영수증을 발급하실 수 없습니다.");
}

if($od[od_receipt_bank] > 0) {
	$getpay_all = $od[od_receipt_bank];
	$getpay_vp = $od[od_receipt_bank] * 0.1;
	$getpay_item = $od[od_receipt_bank] - $getpay_vp;
}

if($getpay_all<$default[de_cash_pay]){
	alert("입금금액이 5천원 미만일 경우 영수증을 발급하실 수 없습니다. ");
}

if(!$od[od_invoice] && $od[od_invoice_time] == '0000-00-00 00:00:00'){
	alert("주문이 완료되어야 영수증을 발급받으실 수 있습니다.");
}

$sql = "select *
         from {$GnTable[shoppoint]}
        where po_id = '$po_id'
          and mb_id = '$mb_id' and po_content = '발급' ";
$result = sql_query($sql);
$ch = mysql_fetch_array($result);
mysql_free_result($result);
if ($ch[od_id] != ""){
		alert("이미 현금영수증을 발급받으셨습니다.");
}

if($od[od_bank_account]=="실시간 계좌이체") $cashPay_type = "2";
	else  $cashPay_type = "1";

$page_loc = "member";

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_cash.skin.php";
if($default[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>