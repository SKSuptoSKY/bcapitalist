<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();

include "../head.php";

$sqltal = " select * from member where userid = '$mb_id' ";
$memb = sql_fetch($sqltal);
// 아이디별 주문 수량과 주문금액
$odrgetotal = number_format($memb[countshop]);
$paygetotal = number_format($memb[totalshop]);
// 회원등급
$releb = $DB->SELECT('member_level','leb_name',"where leb_level = '$memb[userlevel]' ");
$leb = $DB->ARR($releb[result]);
if($leb[leb_name]) $memleb = substr($leb[leb_name],0,4);
	else $memleb = "";

$where = " where mb_id = '$mb_id' ";

if ($sel_field == "")  $sel_field = "od_time";
if ($sort1 == "") $sort1 = "od_time";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from shop_order a
                left join shop_cart b on (a.on_uid=b.on_uid)
                $where ";

// 테이블의 전체 레코드수만 얻음
/*
$sql = " select count(od_id) ".$sql_common;
$result = sql_query($sql);
$row = mysql_fetch_row($result);
mysql_free_result($result);
$total_count = $row[0];
*/
// 1.06.06
// left join 으로 인해 데이타 건수를 잘못 계산함 아래의 코드로 대체
$result = sql_query(" select DISTINCT od_id ".$sql_common);
$total_count = mysql_num_rows($result);

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$sql  = " select a.od_id, 
                 a.*, ".$misuqry."
           $sql_common
           group by a.od_id 
           order by $sort1 $sort2
           limit $from_record, $rows ";
$result = sql_query($sql);

$qstr1 = "sel_ca_id=$sel_ca_id&sel_field=$sel_field&search=$search";
$qstr = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";
?>
<script language=javascript src="/admin/shop/lib/javascript.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>                       
		<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9"> 회원구매 리스트(<?=$memb[username]?>님 주문합계 : <?=$paygetotal."원 총 $odrgetotal 회"?>)</font></strong></td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr><td height=10></td></tr>
</table>

<table cellpadding=4 cellspacing=1 border=0 align=center>
<tr><td colspan=20 height=3 bgcolor=#0E87F9></td></tr>

<form name=frmorderlist>
<input type=hidden name=sort1 value="<? echo $sort1 ?>">
<input type=hidden name=sort2 value="<? echo $sort2 ?>">
<input type=hidden name=page  value="<? echo $page ?>">

<tr align=center>
    <td width="60"><a href='<?=title_sort("od_id", 1)."&$qstr1";?>'>주문번호</a></td>
    <td width="60"><a href='<?=title_sort("od_name")."&$qstr1";?>'>주문자</a></td>
    <td width="50"><a href='<?=title_sort("itemcount", 1)."&$qstr1";?>'>결제방법</a></td>
    <td width="80"><a href='<?=title_sort("od_deposit_name", 1)."&$qstr1";?>'>입금자</a></td>
    <td width="60"><a href='<?=title_sort("orderamount", 1)."&$qstr1";?>'><FONT COLOR="1275D3">주문금액</a></FONT></td>
    <td width="60"><a href='<?=title_sort("receiptamount")."&$qstr1";?>'><FONT COLOR="1275D3">입금합계</font></a></td>
	<td width="40">등급</td>
	<td width="80"><a href='<?=title_sort("od_time", 1)."&$qstr1";?>'>주문일자</a></td>
	<td width="60"><a href='<?=title_sort("od_invoice_time", 1)."&$qstr1";?>'>발송일</a></td>
	<td width="60"><a href='<?=title_sort("od_invoice", 1)."&$qstr1";?>'>운송장번호</a></td>
</tr>
<tr><td colspan=20 height=1 bgcolor=#CCCCCC></td></tr>
<tr><td colspan=20 height=3 bgcolor=#F8F8F8></td></tr>

<?
$tot_itemcnt       = 0;
$tot_orderamount   = 0;
$tot_ordercancel   = 0;
$tot_dc_amount     = 0;
$tot_receiptamount = 0;
$tot_receiptcancel = 0;
$tot_misuamount    = 0;
for ($i=0; $row=mysql_fetch_array($result); $i++) {

		$s_idsc = "./order_list.php?sort1=$sort1&sort2=$sort2&sel_field=mb_id&search=$row[mb_id]";
		$order_isID = "<a href='/admin/member/view.php?num=$memb[num]'>$row[mb_id]</a>";
    // 결제 수단
    $s_receipt_way = $s_br = "";
    if ($row[od_temp_bank] > 0 || $row[od_receipt_bank] > 0) {
        //$s_receipt_way = "무통장입금";
        $s_receipt_way = cut_str($row[od_bank_account],8,"");
        $s_br = "<br>";
    }

    if ($row[od_temp_card] > 0 || $row[od_receipt_card] > 0) {
        // 미수금이 없고 카드결제를 하지 않았다면 카드결제를 선택후 무통장 입금한 경우임
        if ($row[misuamount] <= 0 && $row[od_receipt_card] == 0)
            ; // 화면 출력하지 않음
        else {
            $s_receipt_way .= $s_br."카드";
            if ($row[od_receipt_card] == 0)
                $s_receipt_way .= "<span class=small><span class=point style='font-size:8pt;'>(미승인)</span></span>";
            $s_br = "<br>";
        }
    }

	$od_time = str_replace('-','.',substr($row[od_time],2,14));
	$od_invoice_time = is_null_time($row[od_invoice_time]) ? "" : str_replace('-','.',substr($row[od_invoice_time],2,8)); 

	if($row[od_memo]) $memo="<br><span title='$row[od_memo]' style='color=red'>[상담]</span>";
		else $memo="";

    if ($row[od_receipt_point] > 0)
        $s_receipt_way .= $s_br."포인트";     
	
	if($row[od_hp]) $od_tel = "$row[od_tel]<br>$row[od_hp]";
		else  $od_tel = "$row[od_tel]";

    $s_mod ="./order_view.php?od_id=$row[od_id]&$qstr";
    $s_del = icon("삭제", "javascript:del('./order_delete.php?od_id=$row[od_id]&on_uid=$row[on_uid]&mb_id=$row[mb_id]&$qstr');");

    echo "
    <tr $mouseover>
        <td align=center><a href='$s_mod'>$row[od_id]</a></td>
        <td align=center>".cut_str($row[od_name],8,"")."</a>$memo</td>
        <td align=center>$s_receipt_way</td>
		<td align=center>$row[od_deposit_name]</td>
        <td align=right><FONT COLOR=1275D3>".number_format($row[orderamount])."</font></td>
        <td align=right><FONT COLOR=1275D3>".number_format($row[receiptamount])."</font></td>
		<td align=center>$memleb</td>
		<td align=center>$od_time</td>
		<td align=center>$od_invoice_time</td>
		<td align=center>$row[od_invoice]</td>
    </tr><tr><td colspan=20 height=1 bgcolor=F5F5F5></td></tr>";

    $tot_itemcount     += $row[itemcount];
    $tot_orderamount   += $row[orderamount];
    $tot_ordercancel   += $row[ordercancel];
    $tot_dc_amount     += $row[od_dc_amount];
    $tot_receiptamount += $row[receiptamount];
    $tot_receiptcancel += $row[receiptcancel];
    $tot_misu          += $row[misu];
}
	$tot_odcount          = $i;
mysql_free_result($result);
if ($i == 0)
    echo "<tr><td colspan=20 align=center height=100 bgcolor=#ffffff><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
?>
</form>
<tr><td colspan=20 bgcolor=CCCCCC></td></tr>
<tr>
    <td colspan=3 align=center>합 계</td>
    <td align=center><?=(int)$tot_odcount?>건</td>
    <td align=right><FONT COLOR=1275D3><?=number_format($tot_orderamount)?></FONT></td>
    <td align=right><FONT COLOR=1275D3><?=number_format($tot_receiptamount)?></FONT></td>
    <td colspan=2></td>
</tr>
<tr><td colspan=20 bgcolor=CCCCCC></td></tr>
</table>

<table width=100%>
<tr bgcolor=#ffffff>
    <td width=50%></td>
    <td width=50% align=right>
        <?=get_paging($default[de_write_pages], $page, $total_page, "./order_list.php?$qstr&page=");?>
    </td>
</tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td height=30></td></tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>                       
		<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9"> 회원상품구매 리스트(<?=$memb[username]?>님 주문합계 : <?=$paygetotal."원 총 $odrgetotal 회"?>)</font></strong></td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr><td height=10></td></tr>
</table>
<?
$sql  = " select c.mb_id, b.it_id, b.it_name,
                 SUM(IF(ct_status = '주문',ct_qty, 0)) as ct_status_2,
                 SUM(IF(ct_status = '준비',ct_qty, 0)) as ct_status_3,
                 SUM(IF(ct_status = '배송',ct_qty, 0)) as ct_status_4,
                 SUM(IF(ct_status = '완료',ct_qty, 0)) as ct_status_5,
                 SUM(IF(ct_status = '취소',ct_qty, 0)) as ct_status_6,
                 SUM(IF(ct_status = '반품',ct_qty, 0)) as ct_status_7,
                 SUM(IF(ct_status = '품절',ct_qty, 0)) as ct_status_8,
                 SUM(ct_qty) as ct_status_sum
            from shop_order c left join shop_cart a on (c.on_uid = a.on_uid and ct_status !='쇼핑') left join  shop_item b on (a.it_id = b.it_id)";
$sql .= " where c.mb_id = '$mb_id'";
if ($fr_date && $to_date) 
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and ct_time between '$fr 00:00:00' and '$to 23:59:59' ";
}
if ($sel_ca_id)
{
    $sql .= " and b.ca_id like '$sel_ca_id%' ";
}
$sql .= " group by a.it_id
          order by ct_status_sum desc ";

$result = sql_query($sql);
?>

<table cellpadding=4 cellspacing=1 width=98% align=center>
<tr><td colspan=20 height=3 bgcolor=0E87F9></td></tr>
<tr align=center>
    <td width=45>순위</td>
    <td width=''>상품명</td>
    <td width=45>주문</td>
    <td width=45>준비</td>
    <td width=45>배송</td>
    <td width=45>완료</td>
    <td width=45>취소</td>
    <td width=45>반품</td>
    <td width=45>품절</td>
    <td width=45>합계</td>
</tr>
<tr><td colspan=20 height=1 bgcolor=#CCCCCC></td></tr>
<tr><td colspan=20 height=3 bgcolor=#F8F8F8></td></tr>

<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {

    echo "
    <tr $mouseover align=center>
        <td>".($rank+$i+1)."</td>
        <td align=left><a href='/shop/item.php?it_id=$row[it_id]'>".cut_str($row[it_name],40)."</a></td>
        <td>".number_format($row[ct_status_2])."</td>
        <td>".number_format($row[ct_status_3])."</td>
        <td>".number_format($row[ct_status_4])."</td>
        <td>".number_format($row[ct_status_5])."</td>
        <td>".number_format($row[ct_status_6])."</td>
        <td>".number_format($row[ct_status_7])."</td>
        <td>".number_format($row[ct_status_8])."</td>
        <td>".number_format($row[ct_status_sum])."</td>
    </tr><tr><td colspan=20 height=1 bgcolor=F5F5F5></td></tr>";
}                         

if ($i == 0) {
    echo "<tr><td colspan=20 align=center height=100 bgcolor=#ffffff><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
}
?>
<tr><td colspan=20 height=1 bgcolor=CCCCCC></td></tr>
</table>

* 수량을 합산하여 순위를 출력합니다.
<br><br>
<? include "../foot.php"; ?>
