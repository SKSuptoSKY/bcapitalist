<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];

if ($od_bank_time) {
    if (check_datetime($od_bank_time) == false)
        alert("무통장 입금일시 오류입니다.");
}

if ($od_card_time) {
    if (check_datetime($od_card_time) == false)
        alert("신용카드 입금일시 오류입니다.");
}

$sql = " update $PG_table
            set od_deposit_name  = '$od_deposit_name',
                od_bank_account  = '$od_bank_account',
                od_bank_time     = '$od_bank_time',
                od_card_time     = '$od_card_time',
                od_receipt_bank  = '$od_receipt_bank',
                od_receipt_card  = '$od_receipt_card',
                od_cancel_card   = '$od_cancel_card',
                od_dc_amount     = '$od_dc_amount',
                od_refund_amount = '$od_refund_amount',
                dl_id            = '$dl_id',
                od_invoice       = '$od_invoice',
                od_invoice_time  = '$od_invoice_time'
          where od_id = '$od_id' ";
sql_query($sql);


// 메일발송
include "./order_mail.inc.php"; 

// 회원정보를 업데이트합니다.
//put_totalorder($mb_id);
// 여기까지입니다.

$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";

goto_url("./order_view.php?od_id=$od_id&$qstr");
?>