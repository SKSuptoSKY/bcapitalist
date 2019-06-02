<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
if(!$poll_num){
	alert_close("정상적으로 접근해주세요.");
}
$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

$sql = "select * from $JO_table where poll_num = $poll_num";
$question = sql_fetch($sql);
$poll_answer=explode("|*1*|", $question[poll_answer]);

$result=mysql_query("select * from $SO_table where poll_parent=$poll_num");
$total_count=mysql_num_rows($result);

$poll_answer_total = 0;//문항의 총계 초기화
$count_result=mysql_query("select * from $SO_table where poll_parent='{$question[poll_parent]}' ");

while ($count_result_arr = mysql_fetch_array($count_result)) {
	$poll_score_array2 = explode("|*1*|", $count_result_arr["poll_score"]);
	
	for($t=0; $t < count($poll_score_array2);$t++){
		$poll_score_array1 = explode("|",$poll_score_array2[$t]);
		if($poll_score_array1[0] == $question["poll_num"]){
			$poll_answer_total++;//문항의 총계 산출
		}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" href="/css/common.css" type="text/css">
<!-- 추가 CSS -->
<link rel="stylesheet" href="/css/style.css" type="text/css">
<!-- 디자인 CSS -->
<style type="text/css">
<!--
.style1 {color: #333333}
-->
</style>
</head>
<body>
<table width="615" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="3" height="5" bgcolor="#18619a"></td>
</tr>

<tr>
	<td width="5" bgcolor="#18619a" style="background-repeat:repeat-y"></td>
	<td align="center" style="padding:20px 20px 20px 20px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px; color:#993400;"><strong><span class="style1"><?=$question[poll_question]?></span></strong></td>
				<td align="right" class="link_11_666666"></td>
			</tr>
		</table>
		<table width="555" border="0" cellspacing="0" cellpadding="0" style="margin:20px 0 0 0px;">
			<tr>
				<td height="10" valign="top"></td>
			</tr>
			<tr>
				<td valign="top" style="padding:10px; border:5px solid #f4f4f4;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<?
					for($i=0;$i<count($poll_answer);$i++){
						$poll_answer_result = 0; //문항 선택 결과 초기화
						$count_result=mysql_query("select * from $SO_table where poll_parent='{$question[poll_parent]}' ");
						while ($count_result_arr = mysql_fetch_array($count_result)) {
							$poll_count_total = explode("|*1*|", $count_result_arr["poll_score"]);
							for($t=0; $t < count($poll_count_total);$t++){
								$poll_count_total2 = explode("|",$poll_count_total[$t]);
								if($poll_count_total2[0] == $question["poll_num"] and $poll_count_total2[1] == $i + 1){
									//$i + 1 이란 설문 통계 선택시 항목에 대한 값을 뜻함 1번부터 시작이므로
									//구분자로 구분한 값 $poll_count_total2[0] 은 문항에 대한 idx이고 $poll_count_total2[1] 은 항목에 대한 선택
									$poll_answer_result++;//문항 선택 결과 추출
								}
							}
						}
						if($poll_answer_result!=0){
							$percent=round($poll_answer_result/$poll_answer_total*100, 0);
						}
						else{
							$percent=0;
						}
					?>
					<tr>
						<td width="75%" height="25" class="link_11_666666"><?=$poll_answer[$i]?></td>
						<td align="left">
							<table width="100" border="0" cellspacing="0" cellpadding="0">
							<?if($percent == 0){?>
							<tr>
								<td width="77" style="padding-left:5px;" colspan="2"><?=$poll_answer_result?></td>
							</tr>
							<?}else{?>
							<tr>
								<td width="<?=$percent?>" height="5" bgcolor="#FF3300"></td>
								<td width="77" style="padding-left:5px;"><?=$poll_answer_result?></td>
							</tr>
							<?}?>
							</table>
						</td>
					</tr>

					<?
					}
					?>
					</table>
				</td>
			</tr>
		</table>
	</td>
	<td width="5" bgcolor="#18619a" style="background-repeat:repeat-y"></td>
</tr>

<tr>
	<td colspan="3" height="5" bgcolor="#18619a"></td>
</tr>
</table>
</body>
</html>
