<?
$page_loc = "lecture";

include "../head.php";
include "./lib/lib.php";

$sql = "select * from Gn_Lecture_History where tno = '$tno'";
$view = sql_fetch($sql);

$sql = "select * from Gn_Lecture where lec_no = '$view[order_lec]'";
$lec = sql_fetch($sql);

$qstr = "no=$no&sfl=$sfl&stx=$stx";
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">&nbsp;신청자 상세</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form method="POST" action="./detail_up.php"> 
	<input type="hidden" name="tno" value="<?=$tno?>">
	<input type="hidden" name="no" value="<?=$no?>">
	<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
		<colgroup>
			<col style="width : 50%"/>
			<col style="width : 50%"/>
		</colgroup>
		<tr>
			<td valign="top">
				<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">성명</td>
						<td><?=$view[order_name];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">회사/기관명</td>
						<td><?=$view[order_company];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">직책</td>
						<td><?=$view[order_position];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px;">휴대폰</td>
						<td><?=$view[order_mobile];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px;">이메일</td>
						<td><?=$view[order_email];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px;">남기실 말씀</td>
						<td><?=stripslashes(nl2br($view[order_coment]));?><input type=hidden name=content value="<?=$view[order_coment];?>"></td>
					</tr>
				</table>
			</td>
			<td valign="top">
				<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">강의명</td>
						<td><?=$lec[lec_subject];?></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">강의일정</td>
						<td><?=substr($lec[lec_frDT],0,10)?> ~ <?=substr($lec[lec_enDT],0,10)?></td>
					</tr>
					<!--
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">결제방법</td>
						<td><?=$view[type];?></td>
					</tr>
					-->
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">결제금액</td>
						<td><?=number_format($view[total_pay]);?>원</td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px;">상태</td>
						<td>
							<select name="status">
								<option value="미입금" <?if($view[status] == "미입금"){?>selected<?}?>>미입금</option>
								<option value="입금완료" <?if($view[status] == "입금완료"){?>selected<?}?>>입금완료</option>
								<option value="취소" <?if($view[status] == "취소"){?>selected<?}?>>취소</option>
							</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table width="100%">
		<tr>
			<td align=center height=50>
				<input type=image src="/btn/btn_modify.gif" border=0>
				<a href="javascript:location.href='./detail_list.php?<?=$qstr?>'"><img src="/btn/btn_list.gif" border=0></a>
			</td>
		</tr>
	</table>
</form>