<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

if($mode=="E") {
	if($type==2) $html_title = "갤러리 수정";
	else $html_title = "메인 이미지 수정";
	$sql = " select * from $PG_table where bn_no = '$bn_no' ";
	$bn = sql_fetch($sql);
	$content = $bn[bn_content];
	$this_type = $bn[type];	// 배너의 타입
	
	// 관리자 이미지 사이즈
	$admin_banner_width = $b_width[$this_type] / 2;

	if ( file_exists($_SERVER["DOCUMENT_ROOT"].$bn[bn_dir]."/".$bn[bn_rname]) ) {
		$bn[bn_img]="<img src='{$bn[bn_dir]}/{$bn[bn_rname]}' width='{$admin_banner_width}'>&nbsp;&nbsp;<input type='checkbox' name='bn_img_del' value='1'> 삭제<br>";
	}
	if($bn[bn_no]==FALSE) alert("등록된 자료가 없습니다.");
}else{
	if($type==2) $html_title = "갤러리 등록";
	else $html_title = "메인 이미지 등록";
}
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

}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">&nbsp;<?=$html_title?></font></strong>
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
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="bn_link_target" value="_blank">

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<!-- <tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">카테고리</td>
					<td>
						<select name="bn_category">
							<option value="1" <?if($bn[bn_category]=="1") { ?>selected="selected"<? } ?>>In-House</option>
							<option value="2" <?if($bn[bn_category]=="2") { ?>selected="selected"<? } ?>>Open Course</option>
						</select>
					</td>
				</tr> -->
				<tr bgcolor="#FFFFFF"> 
					<?if($type==0 || $type==1 or $type==100 or $type==101){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">배너제목</td>
					<?}?>
					<?if($type==2){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
					<?}?>
					<td><input type=text class=ed name=bn_subject size=80 value="<?=stripslashes($bn[bn_subject]) ?>"></td>
				</tr>
				<?if($type==2){?>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
						<td><textarea name="bn_content" rows=7 cols=82><?=$bn[bn_content]?></textarea></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">제목(영문)</td>
						<td><input type=text class=ed name=bn_subject_en size=80 value="<?=stripslashes($bn[bn_subject_en]) ?>"></td>
					</tr>
					<tr bgcolor="#FFFFFF"> 
						<td bgcolor="#F0F0F0" style="padding-left:10px">내용(영문)</td>
						<td><textarea name="bn_content_en" rows=7 cols=82><?=$bn[bn_content_en]?></textarea></td>
					</tr>
				<?}?>
				<!--
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
					<td><?//=myEditor(1,'./editor','frmbanner','bn_content','100%','350','euc-kr');?></td>
				</tr>
				-->
				<tr bgcolor="#FFFFFF"> 
					<?if($type==0 || $type==1 or $type==100 or $type==101){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">배너이미지</td>
					<?}?>
					<?if($type==2){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">이미지</td>
					<?}?>
					<td>
						<?=$bn[bn_img]?>
						<input type="file" class=ed name="bn_img" size="80">
						<br>
						<span style="font-size:8pt; color:#ff0000;">권장 업로드 사이즈 : <?=$b_width[$type]?> x <?=$b_height[$type]?> (px)</span>
						<input type="hidden" name="old_file" value="<?=$bn["bn_rname"]?>">
					</td>
				</tr>
				<!-- <tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너링크</td>
					<td><input type="text" class=ed name="bn_link" size=80 value="<?=$bn[bn_link]?>"> (<b>http://</b>로 시작되는 url 주소를 입력해주세요.)
					</td>
				</tr> -->
				<!-- <tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">배너링크타겟</td>
					<td>
						<input type="radio" class=ed name="bn_link_target" value="_self" <? if (!$bn[bn_link_target] || $bn[bn_link_target]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
						<input type="radio" class=ed name="bn_link_target" value="_blank" <? if ($bn[bn_link_target]=="_blank") { ?>checked<? } ?>> 새창
					</td>
				</tr> -->
				<tr bgcolor="#FFFFFF">
					<?if($type==0 || $type==1 or $type==100 or $type==101){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">배너정렬순서</td>
						<td>
							<input type="text" class=ed name="bn_sort" value="<?=$bn[bn_sort]?>">
							<span>숫자가 낮을수록 우선출력 됩니다.</span>
						</td>
					<?}?>
					<?if($type==2){?>
						<td bgcolor="#F0F0F0" style="padding-left:10px">정렬순서</td>
						<td>
							<input type="text" class=ed name="bn_sort" value="<?=$bn[bn_sort]?>">
							<span>숫자가 높을수록 우선출력 됩니다.</span>
						</td>
					<?}?>
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