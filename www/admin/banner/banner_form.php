<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";


$PG_table = $GnTable["banner"];


if($mode=="E") {
	$html_title = "배너 수정";
	$sql = " select * from $PG_table where bn_no = '$bn_no' ";
	$bn = sql_fetch($sql);
	$content = $bn[bn_content];
	if (file_exists($_SERVER["DOCUMENT_ROOT"]."/banner/item/{$bn_no}.jpg")) {
		$bn[bn_img]="<img src='/banner/item/{$bn_no}.jpg' width='{$bn_width}' height='{$bn_height}'>&nbsp;&nbsp;<input type='checkbox' name='bn_img_del' value='1'> 삭제<br>";
	}
	if($bn[bn_no]==FALSE) alert("등록된 자료가 없습니다.");
}else{
	$html_title = "배너 등록";

	//// 게시판 기본설정 값을 입력합니다.
	//$content = $bn["bn_content"];
}

//include_once('../editor/func_editor.php');

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="javascript">
function frmbanner_check(f) 

{
    errmsg = "";
    errfld = "";
    check_field(f.bn_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }              

//	editor_wr_ok();
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$html_title?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="20"></td>
	</tr>
</table>

<form name="frmbanner" id="frmbanner" method=post action="./banner_update.php" onsubmit="return frmbanner_check(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="bn_no" value="<?=$bn_no?>">
<input type="hidden" name="qstr"  value="<?=$qstr?>">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td width="50%" valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">시작일시</td>
					<td>
						<input type=text class=ed name=bn_begin_time size=21 maxlength=19 value="<?=$bn["bn_begin_time"]?>">
        <input type=checkbox name=bn_begin_chk value="<? echo date("Y-m-d H:i:s", $now); ?>" onclick="if (this.checked == true) this.form.bn_begin_time.value=this.form.bn_begin_chk.value; else this.form.bn_begin_time.value = this.form.bn_begin_time.defaultValue;">오늘
					</td>
				</tr>
			</table>
		</td>
		<td width="49%" valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">종료일시</td>
					<td>
						<input type=text class=ed name=bn_end_time size=21 maxlength=19 value="<?=$bn["bn_end_time"]?>">
        <input type=checkbox name=bn_end_chk value="<?=date("Y-m-d H:i:s", $now+(60*60*24*7)); ?>" onclick="if (this.checked == true) this.form.bn_end_time.value=this.form.bn_end_chk.value; else this.form.bn_end_time.value = this.form.bn_end_time.defaultValue;">오늘+7일
					</td>
				</tr>
			</table>		
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너제목</td>
					<td><input type=text class=ed name=bn_subject size=80 value="<?=stripslashes($bn[bn_subject]) ?>">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너구분</td>
					<td><input type=text class=ed name=bn_category size=20 value="<?=stripslashes($bn[bn_category]) ?>"> (배너간 구분사용시 구분값을 입력해주세요. (영문))
					</td>
				</tr>
				<!--
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
					<td><?//=myEditor(1,'./editor','frmbanner','bn_content','100%','350','euc-kr');?></td>
				</tr>
				-->
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너이미지</td>
					<td>
						<?=$bn[bn_img]?>
						<input type="file" class=ed name="bn_img" size="80">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너링크</td>
					<td><input type="text" class=ed name="bn_link" size=80 value="<?=$bn[bn_link]?>"> (<b>http://</b>로 시작되는 url 주소를 입력해주세요.)
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너링크타겟</td>
					<td>
						<input type="radio" class=ed name="bn_link_target" value="_self" <? if (!$bn[bn_link_target] || $bn[bn_link_target]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
						<input type="radio" class=ed name="bn_link_target" value="_blank" <? if ($bn[bn_link_target]=="_blank") { ?>checked<? } ?>> 새창
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너정렬순서</td>
					<td>
						<input type="text" class=ed name="bn_sort" value="<?=$bn[bn_sort]?>"> (숫자가 높을수록 상위게시됩니다.)
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./banner_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>
</form>