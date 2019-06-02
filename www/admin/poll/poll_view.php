<?
$page_loc = "site";
include "../head.php";

$html_title = "설문조사 보기";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

$sql = " select * from $PG_table where poll_num = '$poll_num' ";
$poll = sql_fetch($sql);

?>

<style type="text/css">
<!--
.style1 {color: #333333}
-->
</style>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$html_title?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="20"></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">

	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">설문조사 기간</td>
					<td><?=$poll[poll_sdate]?> ~ <?=$poll[poll_edate]?></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
					<td><?=stripslashes($poll[poll_subject]) ?></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">상태</td>
					<td>
					<?if($poll[poll_state] == 1){?>
					결과보기
					<?}else{?>
					비공개
					<?}?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
					<td><?=$poll[poll_content]?></td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">문항</td>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<?
						$poll_question_sql = "select * from $JO_table where poll_parent='{$poll[poll_num]}' and poll_use = 1 order by poll_sort desc, poll_num desc";
						$poll_question_result = mysql_query($poll_question_sql);
						$poll_question_num = mysql_num_rows($poll_question_result);
						if($poll_question_num){
						while ($poll_question_arr = mysql_fetch_array($poll_question_result)) {
							$poll_answer = explode("|*1*|", $poll_question_arr["poll_answer"]);
							
							$poll_answer_total = 0;//각 문항의 총계 초기화
							$count_result=mysql_query("select * from $SO_table where poll_parent='{$poll[poll_num]}' ");
							while ($count_result_arr = mysql_fetch_array($count_result)) {
								$poll_score_array2 = explode("|*1*|", $count_result_arr["poll_score"]);
								for($t=0; $t < count($poll_score_array2);$t++){
									$poll_score_array1 = explode("|",$poll_score_array2[$t]);
									if($poll_score_array1[0] == $poll_question_arr["poll_num"]){
										$poll_answer_total++;//각 문항의 총계 산출
									}
								}
							}
							//echo $poll_answer_total;
						?>
						<!-- 문항 -->
						<tr>
							<td width="5" bgcolor="#FFFFFF" style="background-repeat:repeat-y"></td>
							<td align="left" style="padding:20px 20px 20px 20px;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td style="font-size:12px; color:#993400;"><strong><span class="style1"><?=$poll_question_arr[poll_question]?></span></strong></td>
										<td align="right" class="link_11_666666"></td>
									</tr>
								</table>
								<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:20px 0px 0px 0px;">
									<tr>
										<td height="10" valign="top"></td>
									</tr>
									<tr>
										<td valign="top" style="padding:10px; border:5px solid #f4f4f4;">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<?
											for($i=0;$i<count($poll_answer);$i++){

												$poll_answer_result = 0; //문항 선택 결과 초기화
												$count_result=mysql_query("select * from $SO_table where poll_parent='{$poll[poll_num]}' ");
												while ($count_result_arr = mysql_fetch_array($count_result)) {
													$poll_count_total = explode("|*1*|", $count_result_arr["poll_score"]);
													for($t=0; $t < count($poll_count_total);$t++){
														$poll_count_total2 = explode("|",$poll_count_total[$t]);
														if($poll_count_total2[0] == $poll_question_arr["poll_num"] and $poll_count_total2[1] == $i + 1){
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
												<td width="50%" height="25" class="link_11_666666"><?=$poll_answer[$i]?></td>
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
							<td width="5" bgcolor="#FFFFFF" style="background-repeat:repeat-y"></td>
						</tr>
						<!-- 문항 -->
						<?}}?>
						</table>
					</td>
				</tr>












			</table>
		</td>
	</tr>

</table>


<table width="100%">
	<tr>
		<td align=center height=50>
			<a href="./poll_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>