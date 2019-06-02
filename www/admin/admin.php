<?
	include "./head.php";

// 접속자 통계를 가져오기 위한 함수
	$Gcount = counter_total_list();
// 회원 통계를 가져오기 위한 함수
	$total = Get_MemTotal();
// 회원등급 배열에 저장
	$level = Get_level("","ARR","where leb_level > 0");
	$level_count = count($level);

	/*통계 관련 프로그램입니다*/
	$today=date("Y-m-d");
	$yesterday=date("Y-m-d",strtotime("-1 day"));
	$fr_date = date("Y",$now)."-".date("m",$now)."-01";
	$oldmonth = date("Y-m",strtotime("-1 month"));
	
	$sql = " select con_date as day, count(con_id) as tcount from Gn_Counter where con_date = '$today' group by day";
	$counter_today_total = sql_fetch($sql);
	$sql = " select con_date as day, count(con_id) as tcount from Gn_Counter where con_date = '$yesterday' group by day";
	$counter_yesterday_total = sql_fetch($sql);

	$sql = " select SUBSTRING(con_date,1,7) as mon, count(con_id) as tcount from Gn_Counter where con_date between '$fr_date' and '$date'  group by mon order by mon ";
	$counter_month_total = sql_fetch($sql);
	$sql = " select SUBSTRING(con_date,1,7) as mon, count(con_id) as tcount from Gn_Counter where SUBSTRING(con_date,1,7) = '$oldmonth' group by mon order by mon ";
	$counter_oldmonth_total = sql_fetch($sql);

	$sql = " select con_date as day, count(con_id) as tcount from Gn_Counter where 1=1 group by day order by day ";
	$result = sql_query($sql,FALSE);
	$counter_result_total = 0;
	for ($i=0; $row=sql_fetch_array($result); $i++) {
	$counter_result_total += $row[tcount]."<br>";
	}
	/*통계 관련 프로그램입니다*/
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?")) 
	document.location.href = "./level_update.php?mode=D&page=<?=$page?>&id=" +code;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 관리자 모드 입니다.</font></strong>
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
		<td valign="top">
		<!-- 회원수 통계 -->
		<strong><font color="#004080">* 회원수 통계</font></strong>
			<table width="95%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td>오늘 가입</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[today])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>어제 가입</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[yesterday])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>이달 가입</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[tomonth])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>전체 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[total])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>탈퇴 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[exitm])?>명</td>
				</tr>
			</table>
		</td>
		<td valign="top">
		<!-- 가입수 통계 -->
		<strong><font color="#004080">* 접속 통계</font></strong>
			<table width="95%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td>오늘 접속자수</td>
					<td align="right" style="padding-right:5px"><?//=number_format($Gcount[today_cnt])?><?=number_format($counter_today_total[tcount])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>어제 접속자수</td>
					<td align="right" style="padding-right:5px"><?//=number_format($Gcount[ysday_cnt])?><?=number_format($counter_yesterday_total[tcount])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>이달 접속자수</td>
					<td align="right" style="padding-right:5px"><?//=number_format($Gcount[tomon_cnt])?><?=number_format($counter_month_total[tcount])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>지난달 접속자수</td>
					<td align="right" style="padding-right:5px"><?//=number_format($Gcount[ysmon_cnt])?><?=number_format($counter_oldmonth_total[tcount])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>전체 접속자수</td>
					<td align="right" style="padding-right:5px"><?//=number_format($Gcount[total_cnt])?><?=number_format($counter_result_total)?>명</td>
				</tr>
			</table>
		</td>
		<td valign="top">
		<!-- 미확인 신청서 미리보기 -->
		<strong><font color="#004080">* 미확인 신청서</font></strong>
			<table width="95%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width="">
				<colgroup width="">
				<tr bgcolor="#FFFFFF" align="center"> 
					<td>신청자명</td>
					<td>신청일자</td>
				</tr>
<?
		$sql = " select num, type, username, regist from {$GnTable[online]} where viewch  =0 order by regist desc limit 0,4";
		$result = sql_query($sql,FALSE);
		for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
?>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td><a href="/admin/online/online_view.php?mode=E&type=<?=$row[type];?>&num=<?=$row[num];?>"><?=$row["username"]?></a></td>
					<td><?=date("Y/m/d H시",$row[regist]);?></td>
				</tr>
<? } ?>
<? if($i==0) { ?>
				<tr bgcolor="#FFFFFF" align="center"> 
					<td colspan="2" height="87">미확인 신청서가 없습니다.</td>
				</tr>
<? } ?>
			</table>
		</td>
	</tr>
	<tr><td colspan="3" height="10"></td></tr>
	<tr>
<?
	$sql = " select dbname, title from {$GnTable[bbsconfig]} where dbname != 'shop_review' and dbname != 'shop_qna' and view = '1' order by dbname";
	$result = sql_query($sql,FALSE);
	for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
		if($i%3==0 && $i!=0) echo "</tr><tr>";
?>
		<td valign="top">
		<strong><font color="#004080">* <?=$row["title"]?> 최근 등록/수정 게시물</font></strong>
			<table width="95%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width="">
				<colgroup width="">
				<tr bgcolor="#FFFFFF" align="center">
					<td><?=latest($row["dbname"], "bbs", "basic_admin", 5, 50,"order by b_modify desc")?></td>
				</tr>
			</table>
		</td>
<? } ?>
<?
	if($i%3!=2) {
		for ($i; $i%3==2; $i++) {
			echo "<td></td>";
		}
	}
?>
	</tr>
</table>