<?
//공통변수
include "../head.php";

?>
<style>
.sub_tb						{border-top:1px solid #CCCCCC; border-left:1px solid #CCCCCC}
.sub_tb th						{border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC; background-color:#F6F6F6; text-align:center; color:#000000; height:30px;}
.sub_tb td						{border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC; padding:2px; color:#000000;}
</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<table class="sub_tb" width="100%" border="0" cellpadding="0" cellspacing="0">
				<col width="20%">
				<col width="30%">
				<col width="30%">
				<col width="20%">
				<thead>
				<tr>
					<th height="25">발송일시</th>
					<th>발송성공</th>
					<th>발송실패</th>
					<th>메일내용</th>
				</tr>
				</thead>
				<?
	$sql = sql_query("select mail_num, send_date from Gn_Mailing order by idx desc");
	while($row = mysql_fetch_array($sql)){
		$mSql = sql_query("select result, count(*) from Gn_Mailing_List where mail_num='$row[0]' group by result");
		while($mRow = mysql_fetch_array($mSql)){
			if($mRow[0]=="succeed") $succeed = $mRow[1];
			else if($mRow[0]=="fail") $fail = $mRow[1];
		}
				?>
				<tr>
					<td height="25"><?=date("Y-m-d H:i:s", $row[1])?></td>
					<td>
						<?=number_format($succeed)?>건&nbsp;
						<button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="Js_mail_result('<?=$row[0]?>');">상세보기</button>
					</td>
					<td>
						<?=number_format($fail)?>건&nbsp;
						<button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="Js_mail_result2('<?=$row[0]?>');">상세보기</button>
					</td>
					<td><button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="Js_mail('<?=$row[0]?>');">보기</button></td>
				</tr>

				<?
	}
				?>
			</table>
		</td>
	</tr>
</table>
<script language="JavaScript">
<!--
function Js_mail(num){
	window.open('../pop/pop_mailing.php?mail_num='+num, 'MailPre', 'width=100, height=100, status=no, scrollbars=yes, resizable=yes');
}
function Js_mail_result(num){
	window.open('../pop/pop_mailing_result.php?mail_num='+num+'&state=succeed', 'MailPre', 'width=600, height=500, status=no, scrollbars=yes, resizable=yes');
}
function Js_mail_result2(num){
	window.open('../pop/pop_mailing_result.php?mail_num='+num+'&state=fail', 'MailPre', 'width=600, height=500, status=no, scrollbars=yes, resizable=yes');
}
//-->
</script>
