<?
$page_loc = "site";
include "../head.php";

if($mode=='E'){
	$sql = "select * from Gn_Link";
	$li = sql_fetch($sql);
}
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">&nbsp;하단 링크 관리</font></strong>
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

<form name="frmbanner" id="frmbanner" method=post action="./update.php" autocomplete="off" style="margin:0px;">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="qstr"  value="<?=$qstr?>">

	<table width="50%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
	<colgroup width=100>
	<colgroup width="">
		<tr bgcolor="#FFFFFF"> 
			<td bgcolor="#F0F0F0" style="padding-left:10px">분류</td>
			<td style="color : red">http://로 시작하는 URL을 입력해주세요. ex) http://www.naver.com</td>
		</tr>
		<tr bgcolor="#FFFFFF"> 
			<td bgcolor="#F0F0F0" style="padding-left:10px">네이버블로그</td>
			<td>
				<input type=text class=ed name=li_link size=80 value="<?=$li[li_link]?>">
				<input type="radio" class=ed name="li_target" value="_self" <? if (!$li[li_target] || $li[li_target]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
				<input type="radio" class=ed name="li_target" value="_blank" <? if ($li[li_target]=="_blank") { ?>checked<? } ?>> 새창
			</td>
		</tr>
		<tr bgcolor="#FFFFFF"> 
			<td bgcolor="#F0F0F0" style="padding-left:10px">FaceBook</td>
			<td>
				<input type=text class=ed name=li_link2 size=80 value="<?=$li[li_link2]?>">
				<input type="radio" class=ed name="li_target2" value="_self" <? if (!$li[li_target2] || $li[li_target2]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
				<input type="radio" class=ed name="li_target2" value="_blank" <? if ($li[li_target2]=="_blank") { ?>checked<? } ?>> 새창
			</td>
		</tr>
		<tr bgcolor="#FFFFFF"> 
			<td bgcolor="#F0F0F0" style="padding-left:10px">KakaoTalk</td>
			<td>
				<input type=text class=ed name=li_link3 size=80 value="<?=$li[li_link3]?>">
				<input type="radio" class=ed name="li_target3" value="_self" <? if (!$li[li_target3] || $li[li_target3]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
				<input type="radio" class=ed name="li_target3" value="_blank" <? if ($li[li_target3]=="_blank") { ?>checked<? } ?>> 새창
			</td>
		</tr>
		<tr bgcolor="#FFFFFF"> 
			<td bgcolor="#F0F0F0" style="padding-left:10px">Instagram</td>
			<td>
				<input type=text class=ed name=li_link4 size=80 value="<?=$li[li_link4]?>">
				<input type="radio" class=ed name="li_target4" value="_self" <? if (!$li[li_target4] || $li[li_target4]=="_self") { ?>checked<? } ?>> 기존창 &nbsp;
				<input type="radio" class=ed name="li_target4" value="_blank" <? if ($li[li_target4]=="_blank") { ?>checked<? } ?>> 새창
			</td>
		</tr>
	</table>


<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_modify.gif" border=0>
		</td>
	</tr>
</table>