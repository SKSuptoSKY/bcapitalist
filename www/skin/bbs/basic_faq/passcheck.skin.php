<script language=javascript>
function writeChk(form) {
	if(!form.passwd.value) {
		alert('��й�ȣ�� �Է��ϼ���');
		form.passwd.focus();
		return false;
	}
	return true;
}
</script>
<style type="text/css">
td {font-family: "����"; color: #666666; font-size: 9pt; line-height: 16px;}

A:link {
	COLOR: #818181; TEXT-DECORATION: none
}
A:visited {
	COLOR: #818181; TEXT-DECORATION: none
}
A:active {
	COLOR: #818181; TEXT-DECORATION: none
}
A:hover {
	COLOR: #B9B9B9; TEXT-DECORATION: underline
}

img { border:0; }
</style>
<br>
<form name="writeform" id="test" method="post" action="<?=$NextAction?>" enctype="multipart/form-data" validate="UTF-8" onsubmit="return writeChk(this)">
<!-- ######### �ֿ� ���� �ʵ� �������� ������ ########### -->
<input type="hidden" name="mode" value="<?=$type?>">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="num" value="<?=$num?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<!-- ######### �ֿ� ���� �ʵ� �������� ������ ########### -->
<table align="center" cellpadding="0" cellspacing="0" width="300">
    <tr>
        <td height="30" align="center">�ƢƢƢ� ��й�ȣ Ȯ���� �ʿ��մϴ�. �ƢƢƢ�</td>
    </tr>
<table>
<table align="center" cellpadding="0" cellspacing="0" width="300">
    <tr>
        <td height=14 background="<?=$Board_Admin["skin_dir"]?>/del_head_bg.gif"></td>
    </tr>
	<tr>
		<td height=25 valign=bottom style="border-bottom:1px solid #EFF3FF">��й�ȣ�� �Է��ϼ���</td>
	</tr>
	<TR>
		<TD align=right height=50 style="border-bottom:2px solid #ACB8D1">
			<b><font color=000084>��й�ȣ :</font></b> <input type="password" name="passwd" style="border:0; border-bottom:1px solid #94AAD6">
		</TD>
	</TR>
	<TR>
		<TD align=right height=40>
			<input type=submit value="ok~!" class=input style="color:#FFFFFF; background-color:#94AAD6; width:60; height:20; border:0">
			<input type=button value="back" class=input style="color:#FFFFFF; background-color:#94AAD6; width:60; height:20; border:0" onclick="history.back();">
		</TD>
	</TR>
</TABLE>
</form>