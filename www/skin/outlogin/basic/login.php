<table width="178" align="center" height="102" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="35"><img src="<?=$skinurl?>/images/login_title.jpg" width="178" height="35"></td>
	</tr>
	<tr>
		<td align="center" background="<?=$skinurl?>/images/login_bg.gif">
			<table width="92%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align=center>
						<?=$name?>님 환영합니다. <br>
						<? if ($sitemenu["mn_shop_use"]) { ?>
						적립금 : <a href="/member/member_point.php"><?=$point?></a> <br>
						<? } ?>
						마이캐쉬 : <?=$cash?> <a href="javascript:cash_save('');">[충전]</a> <br>
						<?=$admin?> <?if($default["use_memo"]==TRUE){?><a href="javascript:My_memo();"><?if($memo>0){ echo "<b>"; }?>[쪽지 <?=$memo?>통]</a><?}?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="27" align="center" background="<?=$skinurl?>/images/login_foot.gif" valign="middle"><a href="/member/member_form.php?mode=INFO"><img src="<?=$skinurl?>/images/myinfo.gif" border="0" align="absmiddle"></a>&nbsp;<a href="/member/logout.php"><img src="<?=$skinurl?>/images/logout.gif" border="0" align="absmiddle"></a></td>
	</tr>
</table>