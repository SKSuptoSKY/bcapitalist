<?
	include "../head.php";

	$PG_table = $GnTable["counter"];

	if (empty($fr_date)) $fr_date = $date;
	if (empty($to_date)) $to_date = $date;

	if ($domain) {
		$sql_search .= " and ref_site like '%$domain%' ";
	}

	// 출력할 레코드를 얻음
	$sql = " select SUBSTRING(con_time,1,2) as hour, count(con_id) as cnt from $PG_table where con_date between '$fr_date' and '$to_date' $sql_search group by hour order by hour ";
	$result = sql_query($sql,FALSE);

	$max = 0;
	$sum_count = 0;

	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$arr[$row[hour]] = $row[cnt];

		if ($row[cnt] > $max) $max = $row[cnt];

		$sum_count += $row[cnt];
	}

	if ($i) {
		for ($i=0; $i<24; $i++) {
			$hour = sprintf("%02d", $i);
			$list[$i]["hour"] = $hour;
			$list[$i]["count"] = (int)$arr[$hour];

			$rate = ($list[$i]["count"] / $sum_count * 100);
			$list[$i]["rate"] = number_format($rate, 1);

			$bar = (int)($list[$i]["count"] / $max * 100);
			$list[$i]["graph"] = "<img src='/admin/images/graph.gif' width='$rate%' height='18'>";
		}
	}

	$list_total = count($list);

	$qstr = "fr_date=$fr_date&to_date=$to_date&domain=$domain&sort1=$sort1&sort2=$sort2";
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0" colspan="2"></td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 시간별 접속자 통계</font></strong>
		</td>
		<td height="30" bgcolor="#F5F5F5" style="padding-right:5px;" align="right">
			<a href="/admin/counter/counter_total_time.php"><strong>[시간별]</strong></a> 
			<a href="/admin/counter/counter_total_week.php"><strong>[요일별]</strong></a> 
			<a href="/admin/counter/counter_total_date.php"><strong>[일   별]</strong></a> 
			<a href="/admin/counter/counter_total_mon.php"><strong>[월   별]</strong></a> 
			<a href="/admin/counter/counter_total_year.php"><strong>[년   별]</strong></a>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0" colspan="2"></td>
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
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width="80">시간</td>
					<td width="80">방문자수</td>
					<td width="80">비율(%)</td>
					<td>그래프</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td><?=$list[$i]["hour"]?></td>
					<td><?=$list[$i]["count"]?></td>
					<td><?=$list[$i]["rate"]?></td>
					<td align="left"><?=$list[$i]["graph"]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } else { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td>합계</td>
					<td><?=number_format($sum_count)?></td>
					<td></td>
					<td></td>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>