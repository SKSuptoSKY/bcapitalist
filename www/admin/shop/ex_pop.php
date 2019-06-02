<? 
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

$PG_table = $GnTable["shopinput"];
$JO_table = "";

// 추가입력사항
$sql = " select * from $PG_table where u_cid = '".$ucid."' ";
$result = sql_query($sql);
?>
<script language='javascript' src='/admin/lib/javascript.js'></script>
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 17px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;} 
A:hover    {text-decoration:none;      color:#7EABD2;}
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
body { margin:0; }
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<body>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="42" bgcolor="#F6F6F6"><div align="center"><strong>추가 입력사항</strong></div></td>
	</tr>
	<tr>
		<td valign="top">
			<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
			<colgroup width="20%"></colgroup>
			<colgroup width=""></colgroup>
<?
	for($i=0;$row = mysql_fetch_array($result);$i++){
	$subject = explode("|",$row["u_subject"]);
		for($k=0;$k<count($subject);$k++){
?>
				<tr>
					<td align="center" height="22"><?=$subject[$k]?> </td>
<?
	$datafile	= $_SERVER["DOCUMENT_ROOT"]."/shop/data/user/".$row["u_opt".$k];
	if(file_exists($datafile)){
		$filedown = "<a href='./ex_pop_down.php?file={$row["u_opt".$k]}'>{$row["u_opt".$k]}</a>"; 
	}else{ $filedown = "{$row["u_opt".$k]}"; }
?>
					<td><?=$filedown?>&nbsp;</td>
				</tr>
<? } } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="30"><div align="right"><input type=button onClick="MM_callJS('window.close();')" value="닫기">&nbsp;&nbsp;</div></td>
	</tr>
</table>
</body>
