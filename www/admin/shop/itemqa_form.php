<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopinquire"];
$JO_table = $GnTable["member"];

$html_title = "상품문의관리";

if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * from $PG_table a
			   left join $JO_table b on (a.mb_id = b.mem_id)
			  where iq_id = '$iq_id' ";
	$view = sql_fetch($sql);

	$name = $view[mem_name];

	if (!$view[mb_id]) alert("등록된 자료가 없습니다.");
} else {
	alert("글이 등록되었습니다."); //잘못된 경로로 접근하셨습니다.
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

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<form name=frmitemqaform method=post action="./itemqa_update.php">
<input type=hidden name=mode     value='<? echo $mode ?>'>
<input type=hidden name=iq_id value='<? echo $iq_id ?>'>
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>
<colgroup width=120 class=tdsl></colgroup>
<colgroup width='' bgcolor=#ffffff></colgroup>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">이름</td>
		<td><?=$name?></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
		<td>
			<input type="text"  name="iq_subject" value="<?=stripslashes($view[iq_subject])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">질문</td>
		<td>
			<textarea name="iq_question" rows="7" style='width:99%;' class=edit required itemname='질문'><? echo stripslashes($view[iq_question]) ?></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">답변</td>
		<td>
			<textarea name="iq_answer" rows="7" style='width:99%;' class=edit itemname='답변'><? echo stripslashes($view[iq_answer]) ?></textarea>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./itemqa_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>