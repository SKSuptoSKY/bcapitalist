<?
include "../head.php";

$PG_table = $GnTable["bbsgroup"];
$JO_table = "";

	$sql_search = " where 1 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 40;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1)
{
    $sort1  = "gr_id";
    $sort2 = "asc";
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
	if($row[p_view]==TRUE) $list[$i][view] = "<font color=red>공개중</font>"; else $list[$i][view]  = "<font color=gray>비공개</font>";
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./bbs_group_update.php?mode=D&page=<?=$page?>&id=" +code;
}

//select박스이동소스s
function Change_SelectOption(option_num,cso_type) {
	
		var cso_main = document.getElementById(option_num);
		if(cso_main.options.selectedIndex == -1) {
			alert('선택된게 없으니 첫번째 항목을 선택합니다.');
			cso_main.options[0].selected = true;
		} else {
			
			if(cso_type == "up") {
				if(cso_main.options.selectedIndex == 0) {
					alert('위로 올리지 못합니다.');
				} else {
					Change_SelectOption_Command(option_num,'-');
				}
			} else{
				if(cso_type == "down") {
					if(cso_main.options.selectedIndex == cso_main.options.length-1) {
						alert('아래로 내리지 못합니다.');
					} else {
						Change_SelectOption_Command(option_num,'+');
					}
				}
			}

		}
	
}

function Change_SelectOption_Command(option_num,csoc_type){
	var cso_temp = new Array();

		var cso_main = document.getElementById(option_num);
		with(document.fcategorylist) {
		cso_temp[0] = cso_main.options.selectedIndex;
		cso_temp[1] = eval('cso_main.options[cso_temp[0]'+csoc_type+'1].text');
		cso_temp[2] = eval('cso_main.options[cso_temp[0]'+csoc_type+'1].value');
		eval('cso_main.options[cso_temp[0]'+csoc_type+'1] = new Option(cso_main.options[cso_temp[0]].text,cso_main.options[cso_temp[0]].value)');
		cso_main.options[cso_temp[0]] = new Option(cso_temp[1],cso_temp[2]);
		eval('cso_main.options[cso_temp[0]'+csoc_type+'1].selected = true');
	}
}
//select박스이동소스e

function menu_proc(option_num,mode) {
	var f=document.fcategorylist;
	var hidden_value,selected;
	var cso_main = document.getElementById(option_num);
	with(document.fcategorylist) {
		if (mode=="sort") {
			for (i=0; i<cso_main.options.length; i++) {
				if (!i)	hidden_value=cso_main.options[i].value;
				else hidden_value+="|"+cso_main.options[i].value;
			}
		}
		else if (mode=="del") {
			if(cso_main.options.selectedIndex == -1) {
				alert('삭제할 항목을 선택해주세요.');
				return false;
			}
			selected=cso_main.options.selectedIndex;
			hidden_value=cso_main.options[selected].value;
		}
	}
	f.sort_value.value=hidden_value;
	f.action="./bbs_group_ifame.php?mode="+mode;
	f.target="ifrm";
	f.submit();

}

</script>

<iframe name="ifrm" frameborder="0" style="display:none;"></iframe>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 메뉴 관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
						<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
							<option value="gr_id" <?if($findType=="gr_id"){?>selected<?}?>>메뉴코드</option>
							<option value="gr_name" <?if($findType=="gr_name"){?>selected<?}?>>메뉴명</option>
						</select>
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?$findword?>"> <input type=image src='/btn/btn_search.gif' align="absmiddle">
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
					<td width=120><a href="./bbs_group_form.php?mode=W"><img src="/btn/btn_newup.gif" border=0></a></td>
					<td width=80>메뉴코드</td>
					<td>메뉴명</td>
				</tr>
<form name=fcategorylist method='post' action='./bbs_group_listup.php' autocomplete='off' style="margin:0px;">
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
<input type="hidden" name="sort_value" value="">
			<?
				for ($i=0; $i<$list_total; $i++) {
					$s_level = "";
					$level = strlen($list[$i][gr_id]) / 2 - 1;
					if ($level > 0) // 2단계 이상
					{
						$s_level = "&nbsp;&nbsp;<img src='/btn/icon_cate.gif' border=0 width=17 height=15 align=absmiddle alt='".($level+1)."단계 메뉴'>";
						for ($k=1; $k<$level; $k++) $s_level = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $s_level;
						$bgcolor="#ffffff";
					}
					else // 1단계
					{
						$bgcolor="#ccffff";
					}
			?>
				<tr align="center" bgcolor="<?=$bgcolor?>">
				<input type=hidden name='gr_id[<?=$i?>]' value='<?=$list[$i][gr_id]?>'>
					<td style="font-weight:bold;padding-left:5px;" align="left">
						<a href="bbs_group_form.php?mode=E&id=<?=$list[$i][gr_id];?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i][gr_id];?>')"><font color="#FF3300">삭제</font></a>
					<? if($level<5) { ?> /
						<a href="bbs_group_form.php?mode=W&id=<?=$list[$i][gr_id];?>"><font color="#0C9060">하위</font></a>
					<? } ?>
					</td>
					<td><?=$list[$i]["gr_id"]?></td>
					<td align="left">
						<table border="0" cellpadding="0" cellspacing="0"> 
							<tr>
								<td valign="top"><?=$s_level?></td>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<input type="text" size="25" name='gr_name[<?=$i?>]' value='<?=get_text($list[$i][gr_name])?>' title='<?=$list[$i][gr_id]?>' required itemname='메뉴명'>&nbsp;&nbsp;<input type="button" value="추가" onclick="MM_openBrWindow('./bbs_group_pop.php?gr_id=<?=$list[$i][gr_id]?>','추가','scrollbars=yes,resizable=yes,width=500,height=150');"></td>
											</td>
										</tr>
										<?
										$sql="select dbname as code,title as title,boardsort as fsort,'게시판' as gubun,'1' as gubun2 from {$GnTable[bbsconfig]} a where boardgroup='{$list[$i][gr_id]}' UNION ALL ";
										$sql.="select pg_code as code,pg_subject as title ,pg_sort as fsort,'페이지' as gubun,'2' as gubun2 from {$GnTable[pageitem]} b where pg_group='{$list[$i][gr_id]}' ";
										$sql.="order by fsort asc ";
										$res_list=sql_query($sql);
										$res_total=mysql_num_rows($res_list);

										if ($res_total) {
										?>
										<tr>
											<td>
												<select name="cso_main_<?=$i?>" id="cso_main_<?=$i?>" size="<?=$res_total?>">
													<?
													for ($l=0; $row_list=mysql_fetch_array($res_list); $l++) {
													?>
													<option value="<?=$row_list[gubun2]?>/<?=$row_list[code]?>"><b>·</b> [<?=$row_list[gubun]?>] <?=$row_list[title]?> (<?=$row_list[code]?>)</option>
													<? } ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<input type="button" value="위로" onclick="Change_SelectOption('cso_main_<?=$i?>','up');">
												<input type="button" value="아래로" onclick="Change_SelectOption('cso_main_<?=$i?>','down');">
												<input type="button" value="위치저장" onclick="menu_proc('cso_main_<?=$i?>','sort');">
												<input type="button" value="선택삭제" onclick="menu_proc('cso_main_<?=$i?>','del');">
											</td>
										</tr>
										<? } ?>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } else { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="30"><input type=submit class=btn1 value='일괄수정'></td>
				</tr>
			<? } ?>
</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>


<SCRIPT LANGUAGE="JavaScript">
<!--
	//alert (document.fcategorylist.cso_main.options[0].value);
//-->
</SCRIPT>


<div id="ssss">
</div>

							
