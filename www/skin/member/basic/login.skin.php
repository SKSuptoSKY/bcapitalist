<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
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

	if(strLen(form.mb_pass,5,20) == false) {
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

<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%; border:1px solid #d9d9d9;" >
 <tr>
    <td><table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
			 <tr>
			   <td><p style="font-size:18px;line-height:34px;margin-top:40px;color:#333; margin-bottom:10px;"><span style="font-size:34px;font-weight:bold;line-height:34px;margin-top:20px;color:#333;">LOGIN</span>&nbsp;&nbsp;l&nbsp;&nbsp;로그인</p>
			   </td>
			</tr>
			<tr>
				<td><p style="font-size:13px; color:#333;"> 방문해 주셔서 감사합니다. 항상 고객 여러분을 위해서 노력하겠습니다.<br />
												불편하신 사항이 있으시면 고객센터로 문의하여 주시기 바랍니다.</p></td>
			</tr>
			<tr><td height="20" bgcolor="#ffffff"></td></tr>
			<tr>
				<td>
				  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <form name=login autocomplete="off" style="margin:0px;"  method="post" onsubmit="login_chk(document.login); return false">
				  <input type="hidden" name="URL" value="<?=$URL?>">
				  <input type="hidden" name="mode" value="Login">
						<tr>
							<td height="80" style="background-color:#f0f0f0;">
								<div align="center" class="login_wrap">
								<div class="login_id">아이디 <label for="mb_id"></label><input name="mb_id" id="mb_id" type="text" style="width:130px; height:26px; color:#666666;background-color:#ffffff; border:1px solid #DFDFDF" size="22"/></div>
								<div class="login_pw">비밀번호 <label for="pw"></label><input name="mb_pass" type="password" style="width:130px; height:26px; color:#666666;background-color:#ffffff; border:1px solid #DFDFDF" size="22" id="pw"/></div>
								<!-- <input name="image" type=image src="/images/login_btn.gif"> -->
								<button class="login_btn" >로그인</button >
								</div>
						    </td>
						</tr>
			      </form>
				 </table>
				</td>
			 </tr>
			 <tr>
				 <td height="15"></td>
			</tr>
			 <tr>
				 <td><div align="right" style="margin:30px 0;">
				 <a href="/member/join.php?URL=<?=$URL?>" style="text-decoration:none">회원이 아니신가요? <img src="<?=$G_member["skin_url"]?>/images/join_btn.jpg" border="0"></a>
				 <a href="javascript:id_search('<?=$ssl_url?>');" style="text-decoration:none">아이디/비밀번호를 분실하셨나요? <img src="<?=$G_member["skin_url"]?>/images/id_btn.jpg" border="0"></a>
				 </div></td>
				</tr>
				</table>
			</td>
	  </tr>
</table>

<?
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>
