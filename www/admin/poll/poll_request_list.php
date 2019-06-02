<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $SO_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = $default[page_rows];;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "poll_num";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";

// 출력할 레코드를 얻음
$sql  = " select * from $SO_table
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	$count_sql = " select count(*) as cnt from $SO_table";
	$count_row = sql_fetch($count_sql,FALSE);
	$list[$i][total] = $count_row[cnt];
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 설문조사 신청 관리</font></strong>
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
					<td>건수 : <?=$total_count?>&nbsp;</td>
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
							<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
								<option value="poll_username" <?if($findType=="poll_username"){?>selected<?}?>>이름</option>
								<option value="poll_mobile" <?if($findType=="poll_mobile"){?>selected<?}?>>전화번호</option>
							</select> 
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">
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
					<td width=150></td>
					<td>신청한 설문조사</td>
					<td width="150">아이디</td>
					<td width="150">이름</td>
					<td width="150">전화번호</td>
					<!--
					<td width="150">소속</td>
					<td width="150">직책</td>
					-->
					<td width="300">이메일</td>
					<td width="150">등록일</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;height:30px;">
						<a href="./poll_request_form.php?mode=E&poll_num=<?=$list[$i][poll_num]?>&page=<?=$page?>"><font color=#0033FF>확인</font></a> / 
						<a href='javascript:del("./poll_request_update.php?mode=D&poll_num=<?=$list[$i][poll_num]?>")'><font color=#FF3300>삭제</font></a>
					</td>
					<td align=left>
					<a href="/admin/poll/poll_view.php?poll_num=<?=$list[$i][poll_parent]?>">
					<?=get_poll_value($list[$i][poll_parent],"poll_subject")?>
					</a>
					</td>
					<td>
					<?if($list[$i][poll_user_id] != "GUEST"){?>
					<a href="/admin/member/member_form.php?mode=E&id=<?=$list[$i][poll_user_id]?>">
						<?=$list[$i][poll_user_id]?>
					</a>
					<?}else{?>
						<?=$list[$i][poll_user_id]?>
					<?}?>
					</td>
					<td><?=stripslashes($list[$i][poll_username])?></td>
					<td><?=stripslashes($list[$i][poll_mobile])?></td>
					<!--
					<td><?=stripslashes($list[$i][poll_ex1])?></td>
					<td><?=stripslashes($list[$i][poll_ex2])?></td>
					-->
					<td><?=stripslashes($list[$i][poll_email])?></td>
					<td><?=cut_str($list[$i][poll_regist],10,'')?></td>
				</tr>
			<? } ?>
			<?if($i==0){?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="9" height="150">신청된 설문조사가 없습니다</td>
				</tr>
			<?}?>

			</table>
		</td>
	</tr>
	<tr>
		<td height="50" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>


