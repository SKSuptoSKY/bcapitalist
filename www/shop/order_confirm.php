<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

// 장바구니가 비어있는가?
if (get_cart_count($_SESSION[ss_temp_on_uid]) == 0)// 장바구니에 담기
    alert("장바구니가 비어 있습니다.\\n\\n이미 주문하셨거나 장바구니에 담긴 상품이 없는 경우입니다.", "./list.php");

$sql = " select * from {$GnTable[shoporder]} where on_uid = '$_SESSION[ss_temp_on_uid]' ";
$od = sql_fetch($sql);

//print_r2($od);

// 상품명만들기
$sql = " select a.it_id, b.it_name 
           from {$GnTable[shopcart]} a, {$GnTable[shopitem]} b
          where a.it_id = b.it_id 
            and a.on_uid = '$_SESSION[ss_temp_on_uid]' 
          order by ct_id
          limit 1 ";
$row = sql_fetch($sql);
// 1.03.11
// 상품명에 "(쌍따옴표)가 들어가면 오류 발생함
//$goods = $row[0];
$goods_it_id = $row[it_id];
$goods = addslashes($row[it_name]);
// 상품건수
$sql = " select count(*) - 1 from {$GnTable[shopcart]} where on_uid = '$_SESSION[ss_temp_on_uid]' ";
$row = sql_fetch($sql);
if ($row[0]) {
    $goods .= " 외 {$row[0]}건";
}
$goods_count = $row[0] + 1;

// 카드 사용이면서 카드결제금액이 0보다 크다면
// 신용카드 새창 띄우기
//==============================================================================
//if ($default[de_card_use] && $od[od_temp_card] > 0) 
//    include "$cart_dir/ordercard{$default[de_card_pg]}.inc.php";
//==============================================================================

//echo get_navigation($html_title);

	$leftloc="etc";
	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/order_confirm.skin.php";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>