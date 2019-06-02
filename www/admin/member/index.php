<?
	include "../head.php";

	$PG_table = $GnTable["member"];
	$JO_table = $GnTable["memberlevel"];

// 접속자 통계를 가져오기 위한 함수
// 회원 통계를 가져오기 위한 함수
	$total = Get_MemTotal();
// 회원등급 배열에 저장
	$level = Get_level("","ARR","where leb_level > 0");
	$level_count = count($level);
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
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 회원 통계</font></strong>
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
					<td>전체 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[total])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>탈퇴 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[exitm])?>명</td>
				</tr>
			<? for($i=0; $i<$level_count; $i++) { ?>
				<tr bgcolor="#FFFFFF"> 
					<td><?=$level[$i][leb_name]?> 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total["level_{$level[$i][leb_level]}"])?>명</td>
				</tr>
			<? } ?>
			</table>
		</td>
		<td valign="top">
		<!-- 가입수 통계 -->
		<strong><font color="#004080">* 가입수 통계</font></strong>
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
					<td>지난달 가입</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[yesmonth])?>명</td>
				</tr>
			</table>
		</td>
		<td valign="top">
		<!-- 회원 특징별 통계 -->
		<strong><font color="#004080">* 회원 특징별 통계</font></strong>
			<table width="95%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td>전체 남자 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[man])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>전체 여자 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[woman])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>메일 수락 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[yesmail])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>SMS 수락 회원 수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[yessms])?>명</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td>평균 접속 횟수</td>
					<td align="right" style="padding-right:5px"><?=number_format($total[visited])?>회</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
