<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();

if($time_type == "mon") {
	$time_sqlserch = " left(ct_time,7) as get_time ";
	$html_title = "월간 매출분석";

	if (!$to_date) {
		$to_date = date("Y", time())."1231";
		$fr_date = date("Y", time())."0101";
	}
} else if($time_type == "year") {
	$time_sqlserch = " left(ct_time,4) as get_time ";
	$html_title = "년간 매출분석";

	if (!$to_date) {
		$to_date = date("Y", time())."1231";
		$fr_date = "20030101";
	}
} else {
	$time_type = "day";
	$time_sqlserch = " left(ct_time,10) as get_time ";
	$html_title = "기간 매출분석";

	if (!$to_date) {
		$to_date = date("Ymd", time());
		$fr_date = date("Ymd", time());
	}
}

if ($sort1 == "") $sort1 = "get_time";
if ($sort2 == "") $sort2 = "asc";

$sql  = " select *, ";
$sql  .=     " SUM(ct_qty) as ct_status_sum , SUM((ct_amount * ct_qty)) as ct_status_pay, $time_sqlserch , count(on_uid) as total_count";
$sql  .=     " from shop_cart where 1 ";

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

$sql .= " group by get_time
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
$qstr1 = "time_type=$time_type&fr_date=$fr_date&to_date=$to_date&sel_ca_id=$sel_ca_id";

$total_get_sum = "0";
$total_get_pay = "0";

for ($i=0; $row=mysql_fetch_array($result); $i++) {
	$list[$i] = $row;

	$total_get_sum = $total_get_sum + $row[ct_status_sum];
	$total_get_pay = $total_get_pay + $row[ct_status_pay];
	$total_get_od = $total_get_od + $row[total_count];
}

if($sort1=="ct_status_sum") $sort_text = "(판매수량)";
	else $sort_text = "(판매금액)";

if($mode=="") {
include "../head.php";
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td height="1" bgcolor="#E0E0E0" colspan=2> </td>
	</tr>
	<tr>                       
		<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9"> <?=$html_title?> <?=$sort_text?></font></strong></td>
		<td bgcolor="f5f5f5" style="padding-right:5px;" align=right><a href="./sellrank_time.php?time_type=day">기간 매출분석</a> | <a href="./sellrank_time.php?time_type=mon">월간 매출분석</a> | <a href="./sellrank_time.php?time_type=year">년간 매출분석</a></td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0" colspan=2> </td>
	</tr>
</table>
<br>
<table width=100% cellpadding=0 cellspacing=0 height=40>
<form name=flist>
<input type=hidden name=sort1 value="<? echo $sort1 ?>">
<input type=hidden name=sort2 value="<? echo $sort2 ?>">
<input type=hidden name=page  value="<? echo $page ?>">
<input type=hidden name=time_type  value="<? echo $time_type ?>">
<tr>
    <td align=center>
<? if($time_type == "day") { ?>
        기간 : <input type=text name=fr_date size=8 maxlength=8 itemname='기간' value='<?=$fr_date?>'> ~ <input type=text name=to_date size=8 maxlength=8 itemname='기간' value='<?=$to_date?>'>
        <input type=image src='/btn/search_btn.gif' align=absmiddle>
<? } else if($time_type == "mon") { ?>
		<? $chy = date("Y",time()); ?>
		기간 : 
		<select name="fr_date">
		<? for($y=2003; $y<=$chy; $y++) { ?>
			<option value='<?=$y?>0101' <?if(substr($fr_date,0,4)==$y) {?>selected<?}?>><?=$y?></option>
		<? } ?>
        </select> ~ 
		<select name="to_date">
		<? for($y=2003; $y<=$chy; $y++) { ?>
			<option value='<?=$y?>1231' <?if(substr($to_date,0,4)==$y) {?>selected<?}?>><?=$y?></option>
		<? } ?>
        </select>
        <input type=image src='/btn/search_btn.gif' align=absmiddle>
<? } else if($time_type == "year") { ?>
		2003년 부터 현재까지 &nbsp;&nbsp;&nbsp;
<? } ?>
    </td>
    <td align=right>총 판매량 : <?=number_format($total_get_sum)?>&nbsp;&nbsp;총 판매금액 : <?=number_format($total_get_pay)?>&nbsp;&nbsp;건수 : <? echo $total_get_od ?>&nbsp;&nbsp;&nbsp;| <a href="<?="./sellrank_time.php?mode=exle&time_type=$time_type&fr_date=$fr_date&to_date=$to_date"?>">액셀다운</a></td>
</tr>
</table>

<table cellpadding=4 cellspacing=1 width=100%>
<tr><td colspan=20 height=3 bgcolor=0E87F9></td></tr>
<tr align=center>
    <td width=45>순위</td>
    <td width=100><a href='<?=title_sort("get_time",1)."&$qstr1"?>'>날짜</a></td>
    <td width=80><a href='<?=title_sort("ct_status_sum",1)."&$qstr1"?>'>물품합계</a></td>
	<td width=80><a href='<?=title_sort("ct_status_pay",1)."&$qstr1"?>'>판매금액</a></td>
	<td width=100>주문수</td>
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
        <td>".$list[$i][get_time]."</td>  
		<td align=right>".number_format($list[$i][ct_status_sum])."</td>
		<td align=right>".number_format($list[$i][ct_status_pay])."</td>
		<td>{$list[$i][total_count]}건</td>
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
    <td width=100><a href='<?=title_sort("get_time",1)."&$qstr1"?>'>날짜</a></td>
    <td width=80><a href='<?=title_sort("ct_status_sum",1)."&$qstr1"?>'>물품합계</a></td>
	<td width=80><a href='<?=title_sort("ct_status_pay",1)."&$qstr1"?>'>판매금액</a></td>
	<td width=100>주문수</td>
	<td width=50>점유율</td>
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
        <td>".$list[$i][get_time]."</td>  
		<td align=right>".number_format($list[$i][ct_status_sum])."</td>
		<td align=right>".number_format($list[$i][ct_status_pay])."</td>
		<td>{$list[$i][total_count]}건</td>
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