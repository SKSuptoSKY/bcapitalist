<?
$default["site_url"] = "http://test19.gamgakdesign.com/";
$G_member["skin_url"] = "skin/member/basic/";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex,nofollow">
<? if($default[keyword]==TRUE) { ?>
<meta name="keywords" content="<?=$default[keyword]?>">
<? } ?>
<title><?=$default[site_name]?> - <?=$default[title]?></title>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 17px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#7EABD2;}
img { border:0; }
</style>
</head>
<script language='javascript' src='/admin/lib/javascript.js'></script>
<script language='javascript' src='/css/esd.js'></script>


<body>
<div style="padding-top:20px;"></div>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<Table width="615px;" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td align="right" class="title"><?=$default[site_name]?></td>
				</tr>
				<tr>
					<td height="15px;"></td>
				</tr>
				<tr>
					<Td style="border-top:2px solid #88bf4a;">&nbsp;</td>
				</tr>
				<tr>
					<td height="40px;"></td>
				</tr>
				<tr>
					<td style="padding-left:35px;">
						<Table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td valign="top">
												<table width="100%" cellpadding="0" cellspacing="0" border="0">
													<Tr>
														<Td><img src="<?=$default["site_url"].$G_member["skin_url"]?>/images/welcome.jpg"></td>
													</tr>
													<tr>
														<td height="30px;"></td>
													</tr>
													<tr>
														<td><strong style="font-size:15px;">안녕하세요.</strong> <strong style="color:#449929; font-size:15px;"><?=$mem_name?>님!</strong></td>
													</tr>
													<tr>
														<td height="20px;"></td>
													</tr>
													<tr>
														<td>회원가입을 진심으로 축하합니다.<br/>
														회원님의 성원에 보답하고자 더욱 더 열심히 하겠습니다.<br/>
														감사합니다. </td>
													</tr>
												</table>
											</td>
											<td align="right" valign="top"><img src="<?=$default["site_url"].$G_member["skin_url"]?>/images/com.jpg"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="25px;"></td>
							</tr>
							<tr>
								<td width="552" style="border:1px solid #dddddd; padding:10px;">
									<table  cellpadding="0" cellspacing="0" border="0" >
										<Tr>
											<td style="line-height:20px;">
											본 메일은 고객님께서 <strong>메일수신을 동의</strong> 하셨기에 정보통신망 이용촉진 및 정보보호 등에 관한<br/>
											법률 시행령 제23조의6 제2항 별표에 의거 (광고), (성인광고) 또는 @를 표시하지 않았습니다. <br/>
											발신전용 메일이므로 회신을 통한 문의는 처리되지 않습니다.<br/> 메일수신을 원치 않는 고객님께서는
											<strong>수신거부</strong>를 클릭하여 주시기 바랍니다.<br/>
											자세한 사항은 고객센터를 이용해 주시기 바랍니다. <br/>
											If you do not wish to receive further mailings, click here.</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="25px;"></td>
							</tr>
							<tr>
								<td align="center"><a href="http://<?=$_SERVER[SERVER_NAME]?>" target="_blank"><img src="<?=$default["site_url"].$G_member["skin_url"]?>/images/homego.jpg"></a></td>
							</tr>
							<tr>
								<td height="20px;"></td>
							</tr>

						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>


