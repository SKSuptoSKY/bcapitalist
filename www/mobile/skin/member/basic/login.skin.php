<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.php";
?>
<script language="Javascript">
function login_chk(form)
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
/*
	if(strLen(form.mb_pass,5,10) == false) {
		form.mb_pass.value='';
		form.mb_pass.focus();
		return;
	}
*/
	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/mobile/member/login.php";
	<? }else{ ?>
		form.action = "/mobile/member/login.php";
	<? } ?>

    form.submit();
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #d9d9d9;" >
 <tr>
    <td><table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
			 <tr>
			   <td><p style="font-size:18px;line-height:34px;margin-top:40px;color:#333; margin-bottom:10px;"><span style="font-size:34px;font-weight:bold;line-height:34px;margin-top:20px;color:#333;">LOGIN</span>&nbsp;&nbsp;l&nbsp;&nbsp;로그인</p>
			   </td>
			</tr>
			<tr>
				<td><p style="font-size:13px; color:#333;"> 방문해 주셔서 감사합니다. <br />항상 고객 여러분을 위해서 노력하겠습니다.
			</tr>
			<tr><td height="20" bgcolor="#ffffff"></td></tr>
			<tr>
				<td>
				  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="mobile_loginWrap">
				  <form name=login onsubmit="login_chk(document.login); return false;" autocomplete="off" style="margin:0px;"  method="post">
				  <input type="hidden" name="URL" value="<?=$URL?>">
				  <input type="hidden" name="mode" value="Login">
				  <input type=hidden name=mobile_flag value="ok">
						<colgroup>
							<col width="30%"/>
							<col width="70%"/>
						</colgroup>
						<tr>
							<td colspan="2" style="height:10px"></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td><label for="mb_id"></label><input name="mb_id" id="mb_id" type="text" class="input_mobile_login" size="22"/></td>
						</tr>
						<tr>
							<th>비밀번호</th>
							<td><label for="pw"></label><input name="mb_pass" type="password" class="input_mobile_login" size="22" id="pw"/></td>
						</tr>
						<tr>
							<td colspan="2" style="height:10px"></td>
						</tr>
						<tr>
							<td colspan="2"  height="40" class="btn_login_mobileWrap">
								<button class="login_btn_mobile">로그인</button >
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height:10px"></td>
						</tr>
			      </form>
				 </table>
				</td>
			 </tr>
			 <tr>
				 <td height="15"></td>
			</tr>
			 <tr>
				 <td><div align="left" style="margin:30px 0;">
				 <a href="/mobile/member/join.php?mobile_flag=ok" style="text-decoration:none">회원이 아니신가요? <img src="<?=$G_member["skin_url"]?>/images/join_btn.jpg" border="0"></a><br />
				 <a href="javascript:id_search('<?=$ssl_url?>');" style="text-decoration:none; display:inline-block; margin-top:5px;">아이디/비밀번호를 분실하셨나요? <img src="<?=$G_member["skin_url"]?>/images/id_btn.jpg" border="0"></a>
				 </div></td>
				</tr>
				</table>
			</td>
	  </tr>
</table>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.php";
?>
