<?
	include "../head.php";

	$PG_table = $GnTable["online"];

if($mode=="E") {
	$title_page = "신청내용 보기";

	$qry =" UPDATE $PG_table set viewch = '1' where num = '$num' ";
	sql_query($qry);

	$sql = " select * from $PG_table where num = '$num' ";
	$view = sql_fetch($sql);
}

if($type==0) {
	$OptionValue = array("option1"=>"확장1","option2"=>"확장2","option3"=>"확장3","option4"=>"확장4","option5"=>"확장5");
} else if($type==1) {
	$OptionValue = array("option1"=>"확장1","option2"=>"확장2","option3"=>"확장3","option4"=>"확장4","option5"=>"확장5");
}

$qstr  = "type=$type&page=$page";
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

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=F method=post action="./online_up.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="type"  value="<?=$type?>">
<input type=hidden name="page"  value="<?=$page?>">
<input type=hidden name="num"  value="<?=$num?>">
	<tr>
		<td valign="top">
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">작성자</td>
					<td><?=$view[username];?><input type=hidden name=username value="<?=$view[username];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
					<td><?=$view[subject];?><input type=hidden name=subject value="<?=$view[subject];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">전화번호</td>
					<td><?=$view[phone];?><input type=hidden name=phone value="<?=$view[phone];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">핸드폰</td>
					<td><?=$view[mobile];?><input type=hidden name=mobile value="<?=$view[mobile];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">팩스</td>
					<td><?=$view[fax];?><input type=hidden name=fax value="<?=$view[fax];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">이메일</td>
					<td><?=$view[email];?><input type=hidden name=email value="<?=$view[email];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">방문예정일</td>
					<td><?=($view[visiteDate]==TRUE) ? date("Y/m/d H시",$view[visiteDate]) : "";?><input type=hidden name=visiteDate value="<?=$view[visiteDate];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">신청내용</td>
					<td><?=stripslashes(nl2br($view[content]));?><input type=hidden name=content value="<?=$view[content];?>"></td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">링크1</td>
					<td><?=$view[link1];?><input type=hidden name=link1 value="<?=$view[link1];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">링크2</td>
					<td><?=$view[link2];?><input type=hidden name=link2 value="<?=$view[link2];?>"></td>
				</tr>
			<? for($i=1; $i<=3; $i++){ ?>
				<? if($view["userfile".$i]) {?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">파일<?=$i?></td>
					<td><a href="./online_down.php?file=<?=$view["userfile".$i]?>"><?=$view["userfile".$i]?></a></td>
				</tr>
				<? }?>
			<?} ?>
			<? for ($i=1; $i<=count($OptionValue); $i++) { ?>
				<? if($view["option$i"]==TRUE) {?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px"><?=$OptionValue["option$i"]?></td>
					<td><?=$view["option$i"];?><input type=hidden name="option<?=$i?>" value="<?=$view["option$i"];?>"></td>
				</tr>
				<? } ?>
			<? } ?>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">등록일</td>
					<td><?=date("Y/m/d H시",$view[regist]);?><input type=hidden name=regist value="<?=$view[regist];?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">관리메모</td>
					<td><textarea name=memo style="width:100%; height:150px"><?=stripslashes(($view[memo]));?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_modify.gif" border=0>
			<a href="./online_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>