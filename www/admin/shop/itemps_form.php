<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopafter"];
$JO_table = $GnTable["shopitem"];

$title_page = "상품후기";

if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * 
			   from $PG_table  a
			   left join {$GnTable[member]} b on (a.mb_id = b.mem_id) 
			   left join $JO_table c on (a.it_id = c.it_id)
			  where is_id = '$is_id' ";
	$view = sql_fetch($sql);
	if (!$view[is_id]) alert("등록된 자료가 없습니다.");

	$name = $view[mem_name];
	if(!$name) $name = $view[mb_id];
} else {
	alert("잘못된 경로로 접근하셨습니다.");
}

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=WriteForm method=post action="./itemps_update.php"  enctype="MULTIPART/FORM-DATA" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="is_id" value="<?=$is_id ?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="sort1" value='<?=$sort1?>'>
<input type=hidden name="sort2" value='<?=$sort2?>'>

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=120 class=tdsl></colgroup>
<colgroup width='' bgcolor=#ffffff></colgroup>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품명</td>
		<td><a href='<?="./shop/item.php?it_id=$is[it_id]"?>'><?=$view[it_name]?></a></td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">이름</td>
		<td><?=$name?></td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">점수</td>
		<td><?=stripslashes($view[is_score]) ?> 점</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
		<td>
			<input type="text"  name="is_subject" value="<?=stripslashes($view[is_subject])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품명</td>
		<td>
			<input type="text"  name="it_name" value="<?=get_text(cut_str($view[it_name], 250, ""))?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
		<td>
			<textarea  name="is_content" rows="15" style="width:100%; color:#666666;" class="text"><?=stripslashes($view[is_content])?></textarea>
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF"> 
		<td bgcolor="#F0F0F0" style="padding-left:10px;">확인</td>
		<td><input type=checkbox name='is_confirm' <? echo ($view[is_confirm]) ? "checked" : ""; ?> value='1'> 확인하셔야 페이지에서 보입니다.</td>
	</tr>
	-->
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type="image" src="/btn/btn_write.gif" border=0>
			<a href="./itemps_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>