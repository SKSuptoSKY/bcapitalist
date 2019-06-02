<?
	include "../head.php";

$PG_table = $GnTable["point"];
$MEM_table=$GnTable["member"];
$JO_table = "";

if($_POST[point_submit] == "ok"){
	sql_query("update Gn_SiteConfig set use_point ='".$_POST[use_point]."', join_point  ='".$_POST[join_point ]."'");
	alert("설정이 변경되었습니다",$_SERVER[PHP_SELF]);
}


if($mode=="U") {
	//$state = input_point($point,$memo,$member);
	//if($state) alert("적용되었습니다.","./member_point.php?$qstr");
	//	else  alert("적립금 적립에 실패하였습니다.","./member_point.php?$qstr");
	$sql="select count(*) as cnt from {$MEM_table} where mem_id='{$member}' ";
	$row_mem_cnt=sql_fetch($sql);
	if ($row_mem_cnt[cnt]=="0") {
		alert ("({$member}) 입력된 아이디가 존재하지 않습니다.","./member_point.php?$qstr");
	}
	$sql="update {$MEM_table} set mem_point=mem_point+{$point} where mem_id='{$member}' ";
	sql_query($sql);
	$sql="insert into {$PG_table} (p_member, p_time, p_memo, p_point) values('{$member}', '{$datetime}', '$memo', '{$point}') ";
	sql_query($sql);
	alert ("적용되었습니다.","./member_point.php?$qstr");
}

	$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = $default[page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1)
{
    $sort1  = "p_id";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";


// 출력할 레코드를 얻음
$sql  = " select * from $PG_table $sql_where $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;

	$list[$i][indate] = $list[$i][p_time];
	$list[$i][memo] = $list[$i][p_memo];
	$list[$i][cash] = number_format($list[$i][p_point]);
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
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 적립금 관리</font></strong>
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
	<form name="mem_point_form" method="POST">
	<input type="hidden" name="point_submit" value="ok">
	<tr>
		<td>회원가입시 적립금 : <input type="text" name="join_point" class="text" value="<?=$default["join_point"]?>"> 
		 <input type="checkbox" name="use_point" <?=($default["use_point"] == "1")?"checked":"";?> value="1">사용
		<input type="submit" value="설정"></td>
	</tr>
	</form>	
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="p_time" <?if($findType=="p_time"){?>selected<?}?>>날짜</option>
							<option value="p_member" <?if($findType=="p_member"){?>selected<?}?>>아이디</option>
							<option value="p_memo" <?if($findType=="p_memo"){?>selected<?}?>>내용</option>
						</select>
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>"> <input type=image src='/btn/btn_search.gif' align=absmiddle>
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
<colgroup width=180>
<colgroup width=100>
<colgroup width=100>
<colgroup width="">
				<tr align="center" bgcolor="#F6F6F6">
					<td>날짜</td>
					<td>아이디</td>
					<td>적립금</td>
					<td>내용</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td><?=$list[$i][indate]?></td>
					<td><a href="./member_point.php?mid=<?=$list[$i][p_member]?>&<?=$qstr?>"><?=$list[$i][p_member]?></a></td>
					<td><?=$list[$i][cash]?></td>
					<td align="left" style="padding-left:10px"><?=$list[$i][memo]?></td>
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
	<tr><td height="10"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 적립금 적립</font></strong>
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
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<form name=point_plus method=post action="<?=$PHP_SELF;?>">
			<input type="hidden" name="mode" value="U">
				<tr align="center" bgcolor="#F0F0F0">
					<td width="177" height="30"><strong>아이디</strong></td>
					<td width="177"><strong>적립금</strong></td>
					<td width=""><strong>내용</strong></td>
					<td width="80"></td>
				</tr>
				<tr height="25" align="center" bgcolor="#FFFFFF">
					<td><input type=text name="member" style="width:100%" class="text" value="<?=$mid?>"></td>
					<td><input type=text name="point" style="width:100%" class="text"></td>
					<td><input type=text name="memo" style="width:100%" class="text"></td>
					<td><img src="/btn/btn_up.gif" border=0 onclick="check_form();" style="cursor:pointer;"></td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function check_form() {
		var f=document.point_plus;
		if (!f.member.value) {
			alert ("아이디를 입력해주세요.");
			f.member.focus();
			return false;
		}
		if (!f.point.value) {
			alert ("포인트를 입력해주세요.");
			f.point.focus();
			return false;
		}
		if (!f.memo.value) {
			alert ("내용를 입력해주세요.");
			f.memo.focus();
			return false;
		}
		f.submit();
	}
//-->
</SCRIPT>