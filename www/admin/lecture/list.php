<?
$page_loc = "lecture";

include "../head.php";
include "./lib/lib.php";

$Ex_table = "Gn_Lecture_History";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from Gn_Lecture";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql_search = " where 1";

if($sfl) $sql_search .= " and $sfl LIKE '%$stx%'";

if (!$sst)
{
    $sst  = "lec_order";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

// 출력할 레코드를 얻음
$sql  = " select * from Gn_Lecture $sql_search $sql_order limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for($i=0; $row = mysql_fetch_array($result); $i++){
	$list[$i] = $row;
}

$list_total = count($list);

$qstr  = "sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./update.php?mode=D&page=<?=$page?>&lec_no=" +code;
}
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">&nbsp;과정 관리</font></strong>
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
					<td width="50"><a href='<?=$_SERVER[PHP_SELF]?>'>처음</a></td>
					<td width="" align=center>
						<select name=sfl>
							<option value='lec_subject' <?if($sfl=="lec_subject"){?>selected<?}?>>과정명</option>
							<!-- <option value='lec_period' <?if($sfl=="lec_period"){?>selected<?}?>>강의일정</option> -->
							<option value='lec_pay' <?if($sfl=="lec_pay"){?>selected<?}?>>가격</option>
						</select>
						<? if ($sel_field) echo "<script> document.flist.sel_field.value = '$sel_field';</script>"; ?>
						<input type=text name=stx value='<?=$stx?>'>
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
					<td width="50" align="right">건수 : <? echo $total_count ?>&nbsp;</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<form name=fitemlistupdate method=post action="./list_up.php" autocomplete='off'>
			<input type=hidden name=sca  value="<?=$sca?>">
			<input type=hidden name=sst  value="<?=$sst?>">
			<input type=hidden name=sod  value="<?=$sod?>">
			<input type=hidden name=sfl  value="<?=$sfl?>">
			<input type=hidden name=stx  value="<?=$stx?>">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup>
					<col style="width : 5%"/>
					<col style="width : 27%"/>
					<col style="width : 17%"/>
					<col style="width : 8%"/>
					<col style="width : 7%"/>
					<col style="width : 5%"/>
					<col style="width : 5%"/>
				</colgroup>
				<tr align="center" bgcolor="#F6F6F6">
				<td width=120><a href='./form.php?mode=W'><img src="/btn/btn_newup.gif" border=0 title='강의등록'></a></td>
				<td width=''><?=subject_sort_link("lec_subject", "sca=$sca")?>과정명</a></td>
				<td width='200'>과정일정</a></td>
				<td width=70><?=subject_sort_link("lec_pay", "sca=$sca")?>가격</a></td>
				<td width="120">신청목록</td>
				<td width=60><?=subject_sort_link("it_use", "sca=$sca", 1)?>노출여부</a></td>
				<td width=30><?=subject_sort_link("it_order", "sca=$sca", 1)?>순서</a></td>
			</tr>
			<?for ($i=0; $i<$list_total; $i++) {?>
				<input type="hidden" name="lec_no[<?=$i?>]" value="<?=$list[$i]["lec_no"]?>">
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./form.php?mode=E&no=<?=$list[$i][lec_no]?>&<?=$qstr?>&page=<?=$page?>">
						<font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i][lec_no]?>')"><font color="#FF3300">삭제</font></a> 
					</td>
					<td align="left">
						<!-- 
						<input type="text" name="lec_subject[<?=$i?>]" value="<?=$list[$i][lec_subject]?>" style="width : 100%;" class="text">
						-->
						<?=$list[$i][lec_subject]?>
					</td>
					<td>
						<!-- 
						<input type="text" name="lec_period[<?=$i?>]" value="<?=$list[$i][lec_period]?>" style="width : 100%;" class="text"> 
						-->
						<?=substr($list[$i]["lec_frDT"],0,10)?> ~ <?=substr($list[$i]["lec_enDT"],0,10)?>
					</td>
					<td width="70" align="center">
						<input type="text" name="lec_pay[<?=$i?>]" value="<?=number_format($list[$i]["lec_pay"])?>" class="text" size="7" style="text-align:right;"> 원
						<!-- <?=number_format($list[$i][lec_pay])?>원 -->
					</td>

					<td align="center">
						<a href="./detail_list.php?no=<?=$list[$i][lec_no]?>"><span style="color:blue;">신청목록
						&nbsp;[  <?=get_ex_list_count($Ex_table, $list[$i]["lec_no"]);?>  ] </span></a>
					</td>
					<td align="center"><input type="checkbox" name="lec_use[<?=$i?>]" <?=$list[$i]["lec_use"] ? "checked" : "";?> value="1"></td>
					<td align="center"><input type="number" name="lec_order[<?=$i?>]" style="width : 80%" value="<?=$list[$i]["lec_order"]?>"></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 강의가 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr>
					<td width="50%"><input type="submit" value="일괄수정" accesskey="s"></td>
					<td width="50%" align="right"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>