<?
$page_loc = "lecture";

include "../head.php";
include "./lib/lib.php";


// 테이블의 전체 레코드수만 얻음
$sql_search = " where 1 and order_lec = '$no'";

if($sfl) $sql_search .= " and $sfl LIKE '%$stx%'";

$sql = " select count(*) as cnt from Gn_Lecture_History $sql_search";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


if (!$sst)
{
    $sst  = "order_date";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";


$sql  = " select * from Gn_Lecture_History $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for($i=0; $row = mysql_fetch_array($result); $i++){
	$list[$i] = $row;
}

$qstr = "no=$no&sfl=$sfl&stx=$stx";

?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">&nbsp;신청 목록</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<!-- <script language='JavaScript' src='./lib/javascript.js'></script> -->
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=page value="<?=$page?>">
				<input type=hidden name="no" value="<?=$no?>">
					<td width="50"><a href='<?=$_SERVER[PHP_SELF]?>'>처음</a></td>
					<td width="" align=center>
						<select name=sfl>
							<option value='order_name' <?if($sfl == "order_name"){?>selected<?}?>>성명</option>
							<option value='order_company' <?if($sfl == "order_company"){?>selected<?}?>>회사</option>
							<option value='order_position' <?if($sfl == "order_position"){?>selected<?}?>>직책</option>
							<option value='order_team' <?if($sfl == "order_team"){?>selected<?}?>>부서명</option>
							<option value='order_email' <?if($sfl == "order_email"){?>selected<?}?>>이메일</option>
							<option value='order_mobile' <?if($sfl == "order_mobile"){?>selected<?}?>>휴대폰</option>
							<option value='order_referral' <?if($sfl == "order_referral"){?>selected<?}?>>추천인</option>
							<option value='order_root' <?if($sfl == "order_root"){?>selected<?}?>>신청 경로</option>
							<!-- <option value='type' <?if($sfl == "type"){?>selected<?}?>>결제방법</option> -->
							<option value='order_pay' <?if($sfl == "order_pay"){?>selected<?}?>>결제금액</option>
						</select>
						<? if ($sel_field) echo "<script> document.flist.sel_field.value = '$sel_field';</script>"; ?>
						<input type=text name=stx value='<?=$stx?>'>
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
			</form>
				<td style="padding-right:5px;vertical-align:middle; width:95px;" valign="top" align="right">
				&nbsp;&nbsp;<a href="./excel.php?<?=$qstr?>"><font color="green"><b>[엑셀다운로드]</b></font></a>
				</td>
				<td width="60" align="right">건수 : <? echo $total_count ?>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<form name=fitemlistupdate method=post action="./detail_listup.php" autocomplete='off'>
			<input type=hidden name=sca  value="<?=$sca?>">
			<input type=hidden name=sst  value="<?=$sst?>">
			<input type=hidden name=sod  value="<?=$sod?>">
			<input type=hidden name=sfl  value="<?=$sfl?>">
			<input type=hidden name=stx  value="<?=$stx?>">
			<input type=hidden name=page value="<?=$page?>">
			<input type="hidden" name="no" value="<?=$no?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup>
					<col style="width : 5%"/>
					<col style="width : 8%"/>
					<col style="width : 10%"/><!--추가한것-->
					<col style="width : 10%"/><!--추가한것-->
					<col style="width : 10%"/><!--추가한것-->
					<col style="width : 17%"/>
					<col style="width : 15%"/>
					<col style="width : 8%"/><!--추가한것-->
					<col style="width : 8%"/><!--추가한것-->
					<col style="width : 15%"/>
					<col style="width : 15%"/>
				</colgroup>
				<tr align="center" bgcolor="#F6F6F6">
				<td width=120><!-- <a href='./form.php?mode=W'><img src="/btn/btn_newup.gif" border=0 title='강의등록'></a></td> -->
				<td width=''>성명</td>
				<td width=''>회사</td><!--추가한것-->
				<td width=''>직책</td><!--추가한것-->
				<td width=''>부서명</td><!--추가한것-->
				<td width=70>이메일</td>
				<td width=100>휴대폰번호</td>
				<!-- <td width=100>결제방법</td> -->
				<td width=100>추천인</td><!--추가한것-->
				<td width=100>신청 경로</td><!--추가한것-->
				<td width=100>결제금액</td>
				<td width=60>상태</td>
			</tr>
			<?for ($i=0; $i<count($list); $i++) {?>
				<input type="hidden" name="tno[<?=$i?>]" value="<?=$list[$i]["tno"]?>">
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<!--
						<a href="./form.php?mode=E&no=<?=$list[$i][lec_no]?>&<?=$qstr?>&page=<?=$page?>">
						<font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i][lec_no]?>')"><font color="#FF3300">삭제</font></a> 
						-->
						<a href="./detail_view.php?tno=<?=$list[$i][tno]?>&<?=$qstr?>">상세</a>
					</td>
					<td><?=$list[$i][order_name]?></td>
					<td><?=$list[$i][order_company]?></td><!--추가한것-->
					<td><?=$list[$i][order_position]?></td><!--추가한것-->
					<td><?=$list[$i][order_team]?></td><!--추가한것-->
					<td><?=$list[$i][order_email]?></td>
					<td><?=$list[$i][order_mobile]?></td>
					<!-- <td><?=$list[$i][type]?></td> -->
					<td><?=$list[$i][order_referral]?></td><!--추가한것-->
					<td><?=$list[$i][order_root]?></td><!--추가한것-->
					<td><?=number_format($list[$i][total_pay])?>원</td>
					<td>
						<select name="status[<?=$i?>]">
							<option value="미입금" <?if($list[$i][status] == "미입금"){?>selected<?}?>>미입금</option>
							<option value="입금완료" <?if($list[$i][status] == "입금완료"){?>selected<?}?>>입금완료</option>
							<option value="취소" <?if($list[$i][status] == "취소"){?>selected<?}?>>취소</option>
						</select>
					</td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 신청자가 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr><td align="center" colspan=2><img src="/btn/btn_list.gif" style="cursor:pointer" onclick="javascript:location.href = './list.php'"></td></tr>
				<tr>
					<td width="50%"><input type="submit" value="일괄수정" accesskey="s"></td>
					<td width="50%" align="right"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>