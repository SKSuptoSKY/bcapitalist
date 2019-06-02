<?
$body = "
<html>
<head>
<title>{$from_com}에 오신걸 환영합니다.</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel='stylesheet' href='{$mail_root}/mail_style.css' type='text/css'>
<style type='text/css'>
<!--
body,td,th {
	font-size: 12px;
}
.style2 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style></head>

<body>
<table width='720' border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td><a href='{$site_root}/' target='_blank'><img src='{$mail_root}/img/mail_top.jpg' border='0'></a></td>
	</tr>
	<tr>
		<td style='background-image:url({$mail_root}/img/mail_ttbg.jpg); background-repeat:no-repeat;padding-left:60px;height:23px;' class='mail_title'>$subject</td>
	</tr>
	<tr>
		<td>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td><img src='{$mail_root}/img/box01_top.jpg' border='0'></td>
				</tr>
				<tr>
					<td style='background-image:url({$mail_root}/img/box01_body.jpg); background-repeat:repeat-y;'>
						<table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
								<td>
									<table width='100%' border='0' cellspacing='0' cellpadding='0'>
										<tr>
											<td style='padding-left:36px;'>".stripslashes($m_content)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='10'></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td><img src='{$mail_root}/img/box01_top.jpg' border='0'></td>
				</tr>
				<tr>
					<td><img src='{$mail_root}/img/box01_bottom.jpg' border='0'></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src='{$mail_root}/img/mail_copyright.jpg' border='0'></td>
	</tr>
</table>
</body>
</html>
";
?>