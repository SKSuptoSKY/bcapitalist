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

	if(strLen(form.mb_pass,5,15) == false) {
		form.mb_pass.value='';
		form.mb_pass.focus();
		return;
	}

    form.action = "/member/login.php";
    form.submit();
}

function order_chk(form)
{
	if (form.od_id.value==""){
		alert("주문번호을 입력하십시오!");
		form.od_id.focus();
		return;
    }
	if (form.od_pwd.value==""){
		alert("패스워드를 입력하십시오!");
		form.od_pwd.focus();
		return;
    }

		form.action="/shop/myorder_list.php";
		form.submit();
}

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

   <tr>
     <td width="100%" style="padding:0 0 0 6px;"><table width="690" border="0" cellspacing="0" cellpadding="0">
    <?
			$img = "/shop/data/design/{$view[ca_id]}_Top";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$img)) {
		?>
    <? } ?>

  </table></td>
   </tr>
   <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0"  style="border:1px solid #ddd;">
                  <tr>
                    <td align="center">






<table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="680" border="0" cellspacing="0" cellpadding="0" align="center" >
		<tr>
		   <td><p style="font-size:18px;line-height:34px;margin-top:40px;color:#333; margin-bottom:10px;"><span style="font-size:34px;font-weight:bold;line-height:34px;margin-top:20px;color:#333;">LOGIN</span>&nbsp;&nbsp;l&nbsp;&nbsp;로그인</p>
		   </td>
		</tr>
		<tr>
			<td><p style="font-size:13px; color:#333; margin-bottom:10px;"> 방문해 주셔서 감사합니다. 항상 고객 여러분을 위해서 노력하겠습니다.<br />
											불편하신 사항이 있으시면 고객센터로 문의하여 주시기 바랍니다.</p></td>
		</tr>
  <tr>
          <td width="100%" align="right">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
						<form name=login autocomplete="off" style="margin:0px;"  method="post" onsubmit="login_chk(document.login); return false">
						<input type="hidden" name="URL" value="<?=$URL?>">
						<input type="hidden" name="mode" value="Login">
							<tr>
							<td height="80" style="background-color:#f0f0f0;">
								<div align="center" class="login_wrap">
								<div class="login_id">아이디 <label for="mb_id"></label><input name="mb_id" id="mb_id" type="text" style="width:130px; height:22px; color:#666666;background-color:#ffffff; border:1px solid #DFDFDF" size="22"/></div>
								<div class="login_pw">비밀번호 <label for="pw"></label><input name="mb_pass" type="password" style="width:130px; height:22px; color:#666666;background-color:#ffffff; border:1px solid #DFDFDF" size="22" id="pw"/></div>
								<!-- <input name="image" type=image src="/images/login_btn.gif"> -->
								<button class="login_btn" >로그인</button >
								</div>
						    </td>
							</tr>
						</table>
					</form>
		    </table>
		  </td>
        </tr>
        <tr>
          <td align="right" style="padding:30px 0 0 0;"><a href="/member/join.php?URL=<?=$URL?>" onFocus="this.blur()" style="text-decoration:none;">회원이 아니신가요? <img src="<?=$G_member["skin_url"]?>/images/join_btn.jpg" border="0"></a>
		  <a href="javascript:id_search();" onFocus="this.blur()"  style="text-decoration:none;">아이디/비밀번호를 분실하셨나요? <img src="<?=$G_member["skin_url"]?>/images/id_btn.jpg" border="0"></a></td>
	    </tr>
        <tr>
			 <td height="30">&nbsp;</td>
	    </tr>
      </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
		<td height="40" style="font-size:20px; font-weight:bold; color:#444;">비회원조회</td>
	</tr>
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #ddd;">
	<tr>
	<td><div align="center">
				<table width="276" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td height="30">&nbsp;</td>
					</tr>
						<form name=login autocomplete="off" style="margin:0px;"  method="post" onsubmit="order_chk(document.fitem); return false">
						<input type="hidden" name="url" value="<?=$url?>">
							<tr>
								<td width="100" style="font-size:13px; font-weight:bold; color:#444">주문번호</td>
								<td width="158" rowspan="3" align="center">
									<table width="145" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><input name="od_id" type="text" style="width:130px; height:18px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" size="22"></td>
										</tr>
										<tr>
											<td height="2"></td>
										</tr>
										<tr>
											<td><input name="od_pwd" type="password" style="width:130px; height:18px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" size="22"></td>
										</tr>
									</table>
								</td>
								<td width="59" rowspan="3"><input type="submit" value="조회" style="border:0;" class="confirm1"></td>
							</tr>
							<tr>
								<td height="2"></td>
							</tr>
							<tr>
								<td style="font-size:13px; font-weight:bold; color:#444">비밀번호</td>
							</tr>
							<tr>
								<td height="30">&nbsp;</td>
							</tr>
						</form>
						</table></div></td>
  </tr>
</table></td>
        </tr>
      </table>

<style>
.confirm1{width:70px; float:left; height:45px; font-size:14px; font-weight:bold; color:#fff; background-color:#555; border:none;}
</style>