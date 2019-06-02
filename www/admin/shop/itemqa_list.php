<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopinquire"];
$JO_table = $GnTable["shopitem"];

$html_title = "상품후기";

$sql_search = " where 1 ";
if ($search != "") {
	if ($sel_field != "") {
    	$sql_search .= " and $sel_field like '%$search%' ";
    }
}

if ($sel_ca_id != "") {
    $sql_search .= " and ca_id like '$sel_ca_id%' ";
}

if ($it_id != "") {
    	$sql_search .= " and a.it_id = '$it_id' ";
}

if ($sel_field == "")  $sel_field = "it_name";
if (!$sort1) $sort1 = "iq_id";
if (!$sort2) $sort2 = "desc";

$sql_common = "  from $PG_table a
                 left join $JO_table b on (a.it_id = b.it_id)
                 left join {$GnTable[member]} c on (a.mb_id = c.mem_id) ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
// 전체 페이지 계산
$total_page  = ceil($total_count / $rows);
// 페이지가 없으면 첫 페이지 (1 페이지)
if ($page == "") $page = 1;
// 시작 레코드 구함
$from_record = ($page - 1) * $rows;

$sql  = " select *
          $sql_common
          order by $sort1 $sort2, iq_id desc
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	$list[$i][iq_subject] = cut_str($row[iq_subject], 50, "...");
}

$list_total = count($list);

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./itemqa_update.php?mode=D&iq_id=" +code+"&<?=$qstr?>";
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 상품후기 관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<script language='JavaScript' src='./lib/javascript.js'></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td width="50"><a href='<?=$_SERVER[PHP_SELF]?>'>처음</a></td>
					<td width="" align=center>
						<select name="sel_ca_id" onChange="submit();">
							<option value=''>전체분류
							<?
							$sql1 = " select ca_id, ca_name from {$GnTable[shopcategory]} order by ca_id ";
							$result1 = sql_query($sql1);
							for ($i=0; $row1=mysql_fetch_array($result1); $i++) {
								$len = strlen($row1[ca_id]) / 2 - 1;
								$nbsp = "";
								for ($i=0; $i<$len; $i++) $nbsp .= "&nbsp;&nbsp;&nbsp;";
								echo "<option value='$row1[ca_id]'>$nbsp$row1[ca_name]\n";
							}
							?>
						</select>
						<script> document.search.sel_ca_id.value = '<?=$sel_ca_id?>';</script>
						<select name=it_id>
							<option value='' selected>---상품선택---
							<?
							$sql1 = " select it_id, it_name from $JO_table where ca_id = '$sel_ca_id'";
							$result1 = sql_query($sql1);
							for ($i=0; $row1=mysql_fetch_array($result1); $i++) {
								echo "<option value='$row1[it_id]'>$row1[it_name]\n";
							}
							?>
						</select>
						<? if ($sel_field) echo "<script> document.search.it_id.value = '$it_id';</script>"; ?>
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
					<td width="50" align="right">건수 : <? echo $total_count ?>&nbsp;</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width=120></td>
					<td width=80 ><a href='<? echo title_sort("mem_name"); ?>'>이름</a></td>
					<td width=130 ><a href='<? echo title_sort("is_time"); ?>'>등록일</a></td>
					<td width=200><a href='<? echo title_sort("it_name"); ?>'>상품명</a></td>
					<td width><a href='<? echo title_sort("iq_subject"); ?>'>질문</a></td>
					<td width=30 ><a href='<? echo title_sort("iq_answer"); ?>'>답변</a></td>
				</tr>
			<?
				for ($i=0; $i<$list_total; $i++) {
					$name = $list[$i][mem_name];
					//$answer = $row[iq_answer] ? "Y" : "&nbsp;";
					$answer = $list[$i][iq_answer];
			?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./itemqa_form.php?mode=E&iq_id=<?=$list[$i]["iq_id"]?>&<?=$qstr?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["iq_id"]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align=center><?=$name?></td>
					<td><?=$list[$i][iq_time]?></td>
					<td align="left"><a href='/shop/item.php?it_id=<?=$list[$i][it_id]?>'><?=cut_str($list[$i][it_name],30)?></a></td>
					<td align="left"><?=$list[$i][iq_subject]?></td>
					<td align="left"><?=$answer?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 후기가 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr>
					<td width="100%" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>