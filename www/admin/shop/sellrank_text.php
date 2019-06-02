<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();

if (!$to_date) {
	$to_date = date("Ymd", time());
	$fr_date = date("Ymd", time());
}

if ($sort1 == "") $sort1 = "ct_status_sum";
if ($sort2 == "") $sort2 = "desc";

$sql  = " select a.it_id,
                 b.*,
                 SUM(IF(ct_status = '쇼핑',ct_qty, 0)) as ct_status_1,
				 SUM(IF(ct_status = '주문',ct_qty, 0)) as ct_status_2,
                 SUM(IF(ct_status = '준비',ct_qty, 0)) as ct_status_3,
                 SUM(IF(ct_status = '배송',ct_qty, 0)) as ct_status_4,
                 SUM(IF(ct_status = '완료',ct_qty, 0)) as ct_status_5,
                 SUM(IF(ct_status = '취소',ct_qty, 0)) as ct_status_6,
                 SUM(IF(ct_status = '반품',ct_qty, 0)) as ct_status_7,
                 SUM(IF(ct_status = '품절',ct_qty, 0)) as ct_status_8,
                 SUM(ct_qty) as ct_status_sum
            from shop_cart a, shop_item b ";
$sql .= " where a.it_id = b.it_id ";
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



if($mode=="") {
include "../head.php";

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$rank = ($page - 1) * $rows;

$sql = $sql . " limit $from_record, $rows ";
$result = sql_query($sql);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
$qstr1 = "fr_date=$fr_date&to_date=$to_date&sel_ca_id=$sel_ca_id";

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>                       
		<td height="30" bgcolor="f5f5f5" style="padding-left:5px;"><strong><font color="#004080"><img src="../btn/images/bu_blue.gif" width="10" height="9">제품별주문수량</font></strong></td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>
<br>


<table width=100% cellpadding=0 cellspacing=0>
<form name=flist>
<input type=hidden name=doc   value="<? echo $doc ?>">
<input type=hidden name=sort1 value="<? echo $sort1 ?>">
<input type=hidden name=sort2 value="<? echo $sort2 ?>">
<input type=hidden name=page  value="<? echo $page ?>">
<tr>
    <td width=10%>&nbsp;</td>
    <td width=70% align=center>
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
        <input type=image src='/btn/search_btn.gif' align=absmiddle>
    </td>
    <td width=20% align=right>건수 : <? echo $total_count ?>&nbsp;&nbsp;&nbsp;| <a href="<?="./sellrank_text.php?mode=exle&sel_ca_id=$sel_ca_id&fr_date=$fr_date&to_date=$to_date"?>">액셀다운</a></td>
</tr>
</table><br>

<table cellpadding=4 cellspacing=1 width=100%>
<tr><td colspan=20 height=3 bgcolor=0E87F9></td></tr>
<tr align=center>
    <td width=45>순위</td>
    <td width=''>상품명</td>
    <td width=45><a href='<?=title_sort("ct_status_1",1)."&$qstr1"?>'>쇼핑</a></td>
    <td width=45><a href='<?=title_sort("ct_status_2",1)."&$qstr1"?>'>주문</a></td>
    <td width=45><a href='<?=title_sort("ct_status_3",1)."&$qstr1"?>'>준비</a></td>
    <td width=45><a href='<?=title_sort("ct_status_4",1)."&$qstr1"?>'>배송</a></td>
    <td width=45><a href='<?=title_sort("ct_status_5",1)."&$qstr1"?>'>완료</a></td>
    <td width=45><a href='<?=title_sort("ct_status_6",1)."&$qstr1"?>'>취소</a></td>
    <td width=45><a href='<?=title_sort("ct_status_7",1)."&$qstr1"?>'>반품</a></td>
    <td width=45><a href='<?=title_sort("ct_status_8",1)."&$qstr1"?>'>품절</a></td>
    <td width=45><a href='<?=title_sort("ct_status_sum",1)."&$qstr1"?>'>합계</a></td>
</tr>
<tr><td colspan=20 height=1 bgcolor=#CCCCCC></td></tr>
<tr><td colspan=20 height=3 bgcolor=#F8F8F8></td></tr>

<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {

    echo "
    <tr $mouseover align=center>
        <td>".($rank+$i+1)."</td>
        <td align=left><a href='/shop/item.php?it_id=$row[it_id]'>".cut_str($row[it_name],40)."</a></td>
        <td>".number_format($row[ct_status_1])."</td>
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


<table width=100%>
<tr>
    <td width=50%>&nbsp;</td>
    <td width=50% align=right>
        <?=get_paging($default[de_write_pages], $page, $total_page, "./sellrank_text.php?$qstr&$qstr1&page=");?>
    </td>
</tr>
</table><br>

* 수량을 합산하여 순위를 출력합니다.

<? include "../foot.php"; ?>



<? 
	} else if($mode=="exle"){
		$result = sql_query($sql);

    header('Content-Type: application/vnd.ms-excel');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="' . date("ymd", time()) . '.xls"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
?>
<table cellpadding=4 cellspacing=1 width=100%>
<tr align=center>
    <td width=45>순위</td>
    <td width=150>상품명</td>
    <td width=45><a href='<?=title_sort("ct_status_2",1)."&$qstr1"?>'>주문</a></td>
    <td width=45><a href='<?=title_sort("ct_status_3",1)."&$qstr1"?>'>준비</a></td>
    <td width=45><a href='<?=title_sort("ct_status_4",1)."&$qstr1"?>'>배송</a></td>
    <td width=45><a href='<?=title_sort("ct_status_5",1)."&$qstr1"?>'>완료</a></td>
    <td width=45><a href='<?=title_sort("ct_status_6",1)."&$qstr1"?>'>취소</a></td>
    <td width=45><a href='<?=title_sort("ct_status_7",1)."&$qstr1"?>'>반품</a></td>
    <td width=45><a href='<?=title_sort("ct_status_8",1)."&$qstr1"?>'>품절</a></td>
    <td width=45><a href='<?=title_sort("ct_status_sum",1)."&$qstr1"?>'>합계</a></td>
</tr>
<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {

    echo "
    <tr $mouseover align=center>
        <td>".($rank+$i+1)."</td>
        <td align=left>".$row[it_name]."</td>
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
</table>
<?
	}
?>