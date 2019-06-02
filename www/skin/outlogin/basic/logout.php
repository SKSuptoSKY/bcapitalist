<script language="Javascript">
function login_chk2(form)
{
	if(!form.mb_id.value) {
		alert('아이디를 입력해주세요.');
		form.mb_id.focus();
		return;
	}

	if(!form.mb_pass.value) {
		alert('비밀번호를 입력해주세요.');
		form.mb_pass.focus();
		return;
	}

	if(strLen(form.mb_pass,0,8) == false) {
		form.mb_pass.value='';
		form.mb_pass.focus();
		return;
	}

	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/member/login.php";
	<? }else{ ?>
		form.action = "/member/login.php";
	<? } ?>

    form.submit();
}
</script>
<table width="178" align="center" height="102" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="35"><img src="<?=$skinurl?>/images/login_title.jpg" width="178" height="35"></td>
	</tr>
	<tr>
		<td align="center" background="<?=$skinurl?>/images/login_bg.gif">
		<form name=search autocomplete="off" style="margin:0px;" onsubmit="return login_chk2(this);" method="post">
		<input type="hidden" name="URL" value="<?=$URL?>">
		<input type="hidden" name="mode" value="Login">
			<table width="92%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td><img src="<?=$skinurl?>/images/id.gif" width="19" height="11"></td>
					<td><input name="mb_id" type="text" style="height:18px;color:#666666;font-size:9pt;background-color:#FFFFFF;border:1 #D5D7D8 solid;ime-mode:inactive;" value="" size="14" tabindex="1"></td>
					<td width="47" rowspan="3"><input type=image src="<?=$skinurl?>/images/login_bt.gif" border="0" tabindex="3"></td>
				</tr>
				<tr> 
					<td height="2" colspan="2"></td>
				</tr>
				<tr> 
					<td><img src="<?=$skinurl?>/images/pw.gif" width="19" height="13"></td>
					<td><input name="mb_pass" type="password" style="height:18px; color:#666666; font-size:9pt; background-color:#FFFFFF; border:1 #D5D7D8 solid" value="" size="14" tabindex="2"></td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
	<tr>
		<td height="27" align="center" background="<?=$skinurl?>/images/login_foot.gif" valign="middle"><a href="/member/join.php"><img src="<?=$skinurl?>/images/register.gif" border="0" align="absmiddle"></a>&nbsp;<a href="javascript:id_search();"><img src="<?=$skinurl?>/images/search_id.gif" border="0" align="absmiddle"></a></td>
	</tr>
</table>