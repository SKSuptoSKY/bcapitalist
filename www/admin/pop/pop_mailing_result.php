<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	Admin_check();

$table="mailing_list";
if(!$qmode){
	$sql = sql_query("select email from Gn_Mailing_List where mail_num='$mail_num' and result='$state'");
	if($state=="succeed"){
		$mode_title="발송성공 상세보기";
	}
	else if($state=="fail"){
		$mode_title="발송실패 상세보기";
	}
?>
<body style="background:url(../img/bg/pop_bg.jpg) repeat-x">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="vertical-align:top; text-align:center; padding-left:10px; padding-top:10px;">
			<table width="97%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<th align="left">회원그룹메일링》<font color="#FF6600"><?=$mode_title?></font></th>
				</tr>
			</table>
			<table class="edit_tb" width="97%" border="0" cellspacing="0" cellpadding="2" style="margin-top:5px;">
				<col width="80">
				<col>
				<col>
				<col>
				<tr>
					<th>이메일주소</th>
					<td>
<?
$i = 0;
while($row = mysql_fetch_array($sql)){
	if($i) echo ", ";
	echo $row[0];
	$i++;
}
?>
						&nbsp;
					</td>
				</tr>
			</table>
			<br>
		</td>
	</tr>
</table>
</body>
</html>
<?}?>
