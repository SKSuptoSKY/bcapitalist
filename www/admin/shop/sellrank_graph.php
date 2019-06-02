<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();

if (!$to_date) {
	$to_date = date("Ymd", time());
	$fr_date = date("Ymd", time());
}

if ($sort1 == "") $sort1 = "ct_status_pay";
if ($sort2 == "") $sort2 = "desc";

$sql  = " select a.it_id, b.*, ";
$sql  .=     " SUM(ct_qty) as ct_status_sum , SUM((ct_amount * ct_qty)) as ct_status_pay";
$sql  .=     " from shop_cart a, shop_item b ";
$sql .= " where a.it_id = b.it_id ";

if($sel_state=="")			$sql  .=     " and ( ct_status = '배송' or ct_status = '완료' ) ";
else if($sel_state=="주문")		$sql  .=     " and ct_status = '주문' ";
else if($sel_state=="준비")		$sql  .=     " and ct_status = '준비' ";
else if($sel_state=="배송")		$sql  .=     " and ct_status = '배송' ";
else if($sel_state=="완료")		$sql  .=     " and ct_status = '완료' ";
else if($sel_state=="취소")		$sql  .=     " and ct_status = '취소' ";
else if($sel_state=="반품")		$sql  .=     " and ct_status = '반품' ";
else if($sel_state=="품절")		$sql  .=     " and ct_status = '품절' ";


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
          order by $sort1 $sort2 ";
$result = sql_query($sql);
$total_count = mysql_num_rows($result);

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$rank = ($page - 1) * $rows;

//$sql = $sql . " limit $from_record, $rows ";
$result = sql_query($sql);


$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
$qstr1 = "fr_date=$fr_date&to_date=$to_date&sel_ca_id=$sel_ca_id";

$total_get_sum = "0";
$total_get_pay = "0";

for ($i=0; $row=mysql_fetch_array($result); $i++) {
	$list[$i] = $row;

	$total_get_sum = $total_get_sum + $row[ct_status_sum];
	$total_get_pay = $total_get_pay + $row[ct_status_pay];
}

if($mode=="") {
include "../head.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>                       
		<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9">제품별매출분석</font></strong></td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>
<br>

<table width=100% cellpadding=0 cellspacing=0 height=40>
<form name=flist>
<input type=hidden name=doc   value="<? echo $doc ?>">
<input type=hidden name=sort1 value="<? echo $sort1 ?>">
<input type=hidden name=sort2 value="<? echo $sort2 ?>">
<input type=hidden name=page  value="<? echo $page ?>">
<tr>
    <td align=center>
        <select name="sel_ca_id">
            <option value=''>전체분류
            <?
            $sql1 = " select ca_id, ca_name from shop_category order by ca_id ";
            $result1 = sql_query($sql1);
            for ($i=0; $row1=mysql_fetch_array($result1); $i++) {
                $len = strlen($row1[ca_id]) / 2 - 1;
                $nbsp = "";
                for ($i=0; $i<$len; $i++) $nbsp .= "&nbsp;&nbsp;&nbsp;";
                echo "<option value='$row1[ca_id]'>$nbsp$row1[ca_name]\n";
            }
            ?>
        </select>
        <script> document.flist.sel_ca_id.value = '<?=$sel_ca_id?>';</script>

        기간 : <input type=text name=fr_date size=8 maxlength=8 itemname='기간' value='<?=$fr_date?>'> ~ <input type=text name=to_date size=8 maxlength=8 itemname='기간' value='<?=$to_date?>'>

		<select name="sel_state">
            <option value='' <?if($sel_state=="") {?>selected<?}?>>배송완료</option>
			<option value='주문' <?if($sel_state=="주문") {?>selected<?}?>>주문</option>
			<option value='준비' <?if($sel_state=="준비") {?>selected<?}?>>준비</option>
			<option value='배송' <?if($sel_state=="배송") {?>selected<?}?>>배송</option>
			<option value='완료' <?if($sel_state=="완료") {?>selected<?}?>>완료</option>
			<option value='취소' <?if($sel_state=="취소") {?>selected<?}?>>취소</option>
			<option value='반품' <?if($sel_state=="반품") {?>selected<?}?>>반품</option>
			<option value='품절' <?if($sel_state=="품절") {?>selected<?}?>>품절</option>
        </select>
        <input type=image src='/btn/search_btn.gif' align=absmiddle>
    </td>
    <td align=right>총 판매량 : <?=number_format($total_get_sum)?>&nbsp;&nbsp;총 판매금액 : <?=number_format($total_get_pay)?>&nbsp;&nbsp;건수 : <? echo $total_count ?>&nbsp;&nbsp;&nbsp;| <a href="<?="./sellrank_graph.php?mode=exle&sel_ca_id=$sel_ca_id&fr_date=$fr_date&to_date=$to_date&sel_state=$sel_state"?>">액셀다운</a></td>
</tr>
</table><br>

<table cellpadding=4 cellspacing=1 width=100%>
<tr><td colspan=20 height=3 bgcolor=0E87F9></td></tr>
<tr align=center>
    <td width=45>순위</td>
    <td width=300>상품명</td>
    <td width=50><a href='<?=title_sort("ct_status_sum",1)."&$qstr1"?>'>합계</a></td>
	<td width=80><a href='<?=title_sort("ct_status_pay",1)."&$qstr1"?>'>판매금액</a></td>
	<td width=50>점유율</td>
	<td width='600'>판매량</td>
</tr>
<tr><td colspan=20 height=1 bgcolor=#CCCCCC></td></tr>
<tr><td colspan=20 height=3 bgcolor=#F8F8F8></td></tr>

<?
for ($i=0; $list[$i][it_id]; $i++) {

if($sort1=="ct_status_sum") {
	$iswidth = ($list[$i][ct_status_sum]*100) / $total_get_sum;
} else {
	$iswidth = ($list[$i][ct_status_pay]*100) / $total_get_pay;
}
//$iswidth = sprintf("%d",$iswidth);
$iswidth = sprintf("%2.2f",$iswidth);

$iswidthP = 100 - $iswidth;

$printtable = "<table width=100% height=5 background='/admin/shop/img/graph.gif' cellpadding=0 cellspacing=0 border=0><tr><td align=right height=5><img src='/admin/shop/img/graph-1.gif' width='$iswidthP%' height=5></td></tr></table>";

	echo "
    <tr $mouseover align=center>
        <td>".($rank+$i+1)."</td>
        <td align=left><a href='/shop/item.php?it_id={$list[$i][it_id]}'>".cut_str($list[$i][it_name],30)."</a></td>  
		<td align=right>".number_format($list[$i][ct_status_sum])."</td>
		<td align=right>".number_format($list[$i][ct_status_pay])."</td>
		<td>$iswidth%</td>
		<td align=left>
			$printtable
		</td> 
    </tr><tr><td colspan=20 height=1 bgcolor=F5F5F5></td></tr>";
}                         

if ($i == 0) {
    echo "<tr><td colspan=20 align=center height=100 bgcolor=#ffffff><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
}
?>
<tr><td colspan=20 height=1 bgcolor=CCCCCC></td></tr>
</table>

<br>

* 수량을 합산하여 순위를 출력합니다.

<? include "../foot.php"; ?>


<? 
	} else if($mode=="exle"){

    header('Content-Type: application/vnd.ms-excel');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="' . date("ymd", time()) . '.xls"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
?>
<table cellpadding=4 cellspacing=1 width=100%>
<tr align=center>
    <td width=45>순위</td>
    <td width=300>상품명</td>
    <td width=50>합계</td>
	<td width=80>판매금액</td>
	<td width=60>점유율</td>
</tr>
<?
for ($i=0; $list[$i][it_id]; $i++) {

if($sort1=="ct_status_sum") {
	$iswidth = ($list[$i][ct_status_sum]*100) / $total_get_sum;
} else {
	$iswidth = ($list[$i][ct_status_pay]*100) / $total_get_pay;
}
//$iswidth = sprintf("%d",$iswidth);
$iswidth = sprintf("%2.2f",$iswidth);

$iswidthP = 100 - $iswidth;
	echo "
    <tr $mouseover align=center>
        <td>".($rank+$i+1)."</td>
        <td align=left>".$list[$i][it_name]."</td>  
		<td align=right>".number_format($list[$i][ct_status_sum])."</td>
		<td align=right>".number_format($list[$i][ct_status_pay])."</td>
		<td>$iswidth%</td>
    ";
}                         

if ($i == 0) {
    echo "<tr><td colspan=20 align=center height=100 bgcolor=#ffffff><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
}
?>
</table>
<?
	}
?>