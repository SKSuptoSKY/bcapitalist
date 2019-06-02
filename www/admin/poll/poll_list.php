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
$sql = " select count(*) as cnt from $PG_table $sql_search";
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
$sql  = " select * from $PG_table
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	$count_sql = " select count(*) as cnt from $PG_table";
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
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 설문조사 관리</font></strong>
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
								<option value="poll_subject" <?if($findType=="poll_subject"){?>selected<?}?>>제목</option>
								<option value="poll_sdate" <?if($findType=="poll_sdate"){?>selected<?}?>>시작일시</option>
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
					<td width=150><a href="./poll_form.php"><img src="/btn/btn_newup.gif" border="0"></a></td>
					<td>제목</td>
					<td width="150">시작일시</td>
					<td width="150">종료일시</td>
					<td width="150">상태</td>
					<td width="150">문항관리</td>
					<td width="150">등록일</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;height:30px;">
						<a href="./poll_form.php?mode=E&poll_num=<?=$list[$i][poll_num]?>"><font color=#0033FF>수정</font></a> / 
						<a href='javascript:del("./poll_update.php?mode=D&poll_num=<?=$list[$i][poll_num]?>")'><font color=#FF3300>삭제</font></a> /
						<a href='./poll_view.php?poll_num=<?=$list[$i][poll_num]?>'><font color=#00cc00>보기</font></a>
					</td>
					<td align=left><?=$list[$i][poll_subject]?></td>
					<td><?=cut_str($list[$i][poll_sdate],10,'')?></td>
					<td><?=cut_str($list[$i][poll_edate],10,'')?></td>
					<td>
					<?if($list[$i][poll_state]){?>
						결과보기
					<?}else{?>
						비공개
					<?}?>
					</td>
					<td>
						<a href="./poll_question_list.php?poll_parent=<?=$list[$i]["poll_num"]?>"><span style="color:blue;">상세등록</span></a>
						&nbsp;[ <?=get_poll_list_count($JO_table, $list[$i]["poll_num"]);?> ]
					</td>
					<td><?=cut_str($list[$i][poll_regist],10,'')?></td>
				</tr>
			<? } ?>
			<?if($i==0){?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="7" height="150">등록된 설문조사가 없습니다</td>
				</tr>
			<?}?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>


