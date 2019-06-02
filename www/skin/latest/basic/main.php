<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
	for($i=0; $i<count($list); $i++) { 
		if($newch[$i]==TRUE) $newicon = "<img src='$skin/images/new_img.gif' border='0'>"; else $newicon = "";
?>
	<tr>
		<td width="" height="20"><img src="images/board_blit.gif" width="5" height="9"><a href="<?=$list[$i]["latesturl"]?>"><?=$list[$i]["subject"]?></a>&nbsp;<?=$newicon?></td>
		<td width="75" align="right"><font color="80A2B4">[<?=cut_str($list[$i]["b_regist"],10,'');?>]</font></td>
	</tr>
<? } ?>
<? if($i==0) { ?>
	<tr> 
		<td height=80 align="center">등록된 게시물이 없습니다.</td>
	</tr>
<? } ?>
</table>