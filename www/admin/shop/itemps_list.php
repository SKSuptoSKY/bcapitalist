<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopafter"];
$JO_table = $GnTable["shopitem"];

$sql_search = " where 1";
//$sql_search = " where b.it_id=a.it_id and c.userid=a.mb_id and a.is_id > 0";
if ($it_id != "") {
    	$sql_search .= " and it_id = '$it_id' ";
}

if ($sel_field == "")  $sel_field = "it_name";
if (!$sort1) $sort1 = "is_id";
if (!$sort2) $sort2 = "desc";

//$sql_common = "  from $tbl  a  left join shop_item b on (a.it_id = b.it_id) left join member c on (a.mb_id = c.userid) ";
$sql_common = "  from $PG_table ";
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
          order by $sort1 $sort2, is_id desc
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	//$list[$i]["IMG"] = get_it_image($row["it_id"]."_s", 50, 50);
	$list[$i]["URL"] = "/shop/item.php?it_id={$row[it_id]}";
	$list[$i]["NAME"] = htmlspecialchars2(cut_str($row[it_name],250, ""));
}

$list_total = count($list);

$qstr = "sort1=$sort1&sort2=$sort2&sel_ca_id=$sel_ca_id&search=$search";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./itemps_update.php?mode=D&is_id=" +code+"&<?=$qstr?>";
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
					<td width=80></td>
					<td width=150>상품명</td>
					<td width=80 >이름</td>
					<td width='' ><a href='<? echo title_sort("is_subject"); ?>'>제목</a></td>
					<td width=30 ><a href='<? echo title_sort("is_score"); ?>'>점수</a></td>
					<td width=130 ><a href='<? echo title_sort("is_time"); ?>'>등록일</a></td>
					<!--
					<td width=30 ><a href='<? echo title_sort("is_confirm"); ?>'>확인</a></td>
					-->
				</tr>
			<?
				for ($i=0; $i<$list_total; $i++) {
					$sql = " select mem_name from {$GnTable[member]} where mem_id='$list[$i][mb_id]' ";
//					$mem = sql_fetch($sql);
					$sql = " select it_name, it_id from {$GnTable[shopitem]} where it_id='$list[$i][it_id]' ";
//					$gitem = sql_fetch($sql);

					$list[$i][is_subject] = cut_str($list[$i][is_subject], 30, "...");

					if($mem[mem_name]) $name = $mem[mem_name]; else $name = $list[$i][mb_id];
					$confirm = $row[is_confirm] ? "Y" : "&nbsp;";
			?>
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./itemps_form.php?mode=E&is_id=<?=$list[$i]["is_id"]?>&<?=$qstr?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["is_id"]?>')"><font color="#FF3300">삭제</font></a>
					</td>
					<td align="left"><a href='/shop/item.php?it_id=<?=$list[$i][it_id]?>'><?=item_name($list[$i][it_id ])?></a></td>
					<td align=center><?=$name?></td>
					<td align="left"><?=$list[$i][is_subject]?></td>
					<td align=center><?=$list[$i][is_score]?></td>
					<td align=center><?=$list[$i][is_time]?></td>
					<!--
					<td align=center><?=$confirm?></td>
					-->
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