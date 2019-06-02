<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";
$html_title = "설문조사 신청서 보기";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

$sql = " select * from $SO_table where poll_num = '$poll_num' ";
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
		<td valign="top">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
				<colgroup width=150>
				<colgroup width="">

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">신청한 설문조사</td>
					<td>
						<a href="/admin/poll/poll_view.php?poll_num=<?=$poll[poll_parent]?>">
						<?=get_poll_value($poll[poll_parent],"poll_subject")?>
						</a>
					</td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">아이디</td>
					<td>
						<?if($poll[poll_user_id] != "GUEST"){?>
						<a href="/admin/member/member_form.php?mode=E&id=<?=$poll[poll_user_id]?>">
							<?=$poll[poll_user_id]?>
						</a>
						<?}else{?>
							<?=$poll[poll_user_id]?>
						<?}?>
					</td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">이름</td>
					<td><?=stripslashes($poll[poll_username])?></td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">전화번호</td>
					<td><?=stripslashes($poll[poll_mobile])?></td>
				</tr>
				<!--
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">소속</td>
					<td><?=stripslashes($poll[poll_ex1])?></td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">직책</td>
					<td><?=stripslashes($poll[poll_ex2])?></td>
				</tr>
				-->
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">이메일</td>
					<td><?=stripslashes($poll[poll_email])?></td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">등록일</td>
					<td><?=$poll[poll_regist]?></td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">문항</td>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<?
						$poll_question_sql = "select * from $JO_table where poll_parent='{$poll[poll_parent]}' and poll_use = 1 order by poll_sort desc, poll_num desc";
						$poll_question_result = mysql_query($poll_question_sql);
						$poll_question_num = mysql_num_rows($poll_question_result);
						if($poll_question_num){
						while ($poll_question_arr = mysql_fetch_array($poll_question_result)) {
							$poll_answer = explode("|*1*|", $poll_question_arr["poll_answer"]);
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
													$poll_count_total = explode("|*1*|", $poll["poll_score"]);
													for($t=0; $t < count($poll_count_total);$t++){
														$poll_count_total2 = explode("|",$poll_count_total[$t]);
														if($poll_count_total2[0] == $poll_question_arr["poll_num"] and $poll_count_total2[1] == $i + 1){
															//$i + 1 이란 설문 통계 선택시 항목에 대한 값을 뜻함 1번부터 시작이므로
															//구분자로 구분한 값 $poll_count_total2[0] 은 문항에 대한 idx이고 $poll_count_total2[1] 은 항목에 대한 선택
															$poll_answer_result++;//문항 선택 결과 추출
														}
													}

											?>

											<tr>
												<td width="100%" height="25" class="link_11_666666">
												<?=$poll_answer[$i]?>

												<?if($poll_answer_result){?>
													<span style="padding-left:20px;color:red;font-weight:bold;">checked</span>
												<?}?>
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
			<a href="./poll_request_list.php?page=<?=$page?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>