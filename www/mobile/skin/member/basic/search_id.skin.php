<?
$default["site_url"] = "http://test19.gamgakdesign.com/";
$G_member["skin_url"] = "skin/member/basic/";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>회원정보 메일입니다.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
td {font-family: "NanumGothic"; color: #666666; font-size: 9pt; line-height: 20px;}

A:link {
	COLOR: #666666; TEXT-DECORATION: none
}
A:visited {
	COLOR: #666666; TEXT-DECORATION: none
}
A:active {
	COLOR: #666666; TEXT-DECORATION: none
}
A:hover {
	COLOR: #529cff; TEXT-DECORATION: underline
}
</style>
</head>

<body>

<Table width="650px;" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #bbb">

<tr>
	<td valign="top">
		<Table width="615px;" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="50">
				<font color="#000000"><strong>
				<?=$default[site_name]?> 정보메일입니다.</strong></font>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="eeeeee"></td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="80" bgcolor="f0f0f0">
						<div align="center">
							<table width="289" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td height="30" colspan="2">
									<strong><font color="#000000">
									<?=$member[mem_name]?>
									</font></strong> 회원님의 정보입니다.</td>
									</tr>
									<tr>
									<td width="94"><strong><font color="#000000">아이디</font></strong></td>
									<td width="195">
									<?=$member[mem_id]
									?>
								</td>
							</tr>
							</table>
						</div>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td><div width="150px" align="right"><a href="<?=$default["site_url"]?>" target="_blank" style="background:#333; color:#fff; width:150px; height:30px; display:block; text-decoration:none;  text-align:center; border-radius:20px; line-height:2.3; font-size:13px; ">사이트 바로가기</a></div></td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

</body>
</html>
