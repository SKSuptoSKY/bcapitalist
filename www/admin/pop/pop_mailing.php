<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	Admin_check();
if(!$mail_num){
	$fname = $default["site_name"];
	$site_root = $default["site_url"];
	$mail_root = $default["site_url"]."/mail";
	if($skin_type == "1"){
		include "../../mail/mail_admin.php";
	}else if($skin_type == "2"){
		$body = $m_content;
	}
}
else{
	$sql = sql_query("select content from Gn_Mailing where mail_num='$mail_num'");
	$row = mysql_fetch_array($sql);
	$body = $row[0];
}
?>
<html>
<head>
<title> 메일 내용보기 </title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<meta name="Generator" content="EditPlus">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<!-- <link href="../css/adminstyle.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript">
<!--
function winResize(){
	var Dwidth = parseInt(document.body.scrollWidth);
	var Dheight = parseInt(document.body.scrollHeight);
	var divEl = document.createElement("div");
	divEl.style.position = "absolute";
	divEl.style.left = "0px";
	divEl.style.top = "0px";
	divEl.style.width = "100%";
	divEl.style.height = "100%";

	document.body.appendChild(divEl);

	window.resizeBy(Dwidth-divEl.offsetWidth, Dheight-divEl.offsetHeight);
	document.body.removeChild(divEl);
}
//-->
</script>
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 15px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#E0820A;}

td.tmenu {font-family: "돋음"; color: #FFFFFF; font-size: 9pt; line-height: 15px;}
A.tmenu:link     {text-decoration:none;      color:#FFFFFF;}
A.tmenu:visited  {text-decoration:none;      color:#FFFFFF;}
A.tmenu:active   {text-decoration:none;      color:#FFFFFF;}
A.tmenu:hover    {text-decoration:none;      color:#FFFFFF;}

input.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
select.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
textarea.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
img { border:0; }
form,p									{margin:0px;  padding:0px;}
</style>
</head>
<body onload="winResize();" style="background:url(../images/bg/pop_bg.jpg) repeat-x">
<table width="600">
	<tr>
		<td height="5%" style="font-size:9pt;"> ※ 메일 내용보기</td>
	</tr>
	<tr>
		<td><?=stripslashes($body)?></td>
	</tr>
	<tr>
		<td height="5%" align="center"><button type="button" class="adm_btnN" style="width:95px;" onfocus="blur()" Onclick="window.self.close();">창닫기</button></td>
	</tr>
</table>
</body>
</html>
