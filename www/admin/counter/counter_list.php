<?
	include "../head.php";

	$PG_table = $GnTable["counter"];

	if (empty($fr_date)) $fr_date = $date;
	if (empty($to_date)) $to_date = $date;

	$sql_search = " where con_date between '$fr_date' and '$to_date' ";
	if ($domain) {
		$sql_search .= " and ref_site like '%$domain%' ";
	}

	// 테이블의 전체 레코드수만 얻음
	$sql = " select count(*) as cnt from $PG_table $sql_search";
	$row = sql_fetch($sql,FALSE);
	$total_count = $row[cnt];

	$rows = 20;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	if (!$sort1) 
	{
		$sort1  = "con_id";
		$sort2 = "desc";
	}
	$sql_order = "order by $sort1 $sort2";

	// 출력할 레코드를 얻음
	$sql  = " select * from $PG_table $sql_search $sql_order limit $from_record, $rows ";
	$result = sql_query($sql,FALSE);
	for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
		$list[$i] = $row;
		$list[$i][brow] = get_brow($row[get_agent]);
		$list[$i][os] = get_os($row[get_agent]);
		$list[$i][datetime] = $row[con_date]." ".$row[con_time];
	}

	$list_total = count($list);

	$qstr = "fr_date=$fr_date&to_date=$to_date&domain=$domain&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(id) {
    if(confirm("삭제하면 복구하실 수 없습니다.\n삭제하시겠습니까?")) 
	document.location.href = "./online_up.php?mode=D&type=<?=$type?>&page=<?=$page?>&num=" +id;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 접속리스트</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr> 
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td>
						기간 : <input type='text' name='fr_date' size=11 maxlength=10 value='<?=$fr_date?>' style="height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> - <input type='text' name='to_date' size=11 maxlength=10 value='<?=$to_date?>' style="height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
						&nbsp;&nbsp;
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" style="word-break:break-all;">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width="100">IP</td>
					<td width="150">접속 경로</td>
					<td>접속 주소</td>
					<td width="100">접속 페이지</td>
					<td width="80">접속 상세주소</td>
					<td width="50">브라우저</td>
					<td width="30">OS</td>
					<td width="120">일시</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td><?=$list[$i][con_ip]?></td>
					<td><?=$list[$i][ref_site]?></td>
					<td align="left"><a href="<?=$list[$i][ref_url]?>" target="_blank"><?=$list[$i][ref_url]?></a></td>
					<td><?=$list[$i][get_page]?></td>
					<td><a href="<?=$list[$i][get_page]?>?<?=$list[$i][get_query]?>" target="_blank">[바로가기]</a></td>
					<td><?=$list[$i][brow]?></td>
					<td><?=$list[$i][os]?></td>
					<td><?=$list[$i][datetime]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>