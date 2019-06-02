<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];
$sql = " select * from $PG_table where poll_num = '$poll_num' ";
$poll = sql_fetch($sql);
?>
<style>
.list_tbl{width:770px; border-top:2px #ccc solid;}
.list_tbl th{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc; padding:5px; font-size:13px;  font-weight:bold; color:#333; text-align:center;background-color:#f5f5f5;}
.list_tbl td{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;  color:#666; font-size: 13px; padding:5px; text-align:center;}
.form_input  {border: 1px solid #d6d9de; width:50%; height:24px; color:#676767; font-size:13px;}
.form_input1  {border: 1px solid #d6d9de; width:90%; height:24px; color:#676767; font-size:13px;}
.form_input2  {border: 1px solid #d6d9de; width:80px; height:24px; color:#676767; font-size:13px;}
.form_input3  {border: 1px solid #d6d9de; width:25%; height:24px; color:#676767; font-size:13px;}
.form_input4  {border: 1px solid #d6d9de; width:30%; height:24px; color:#676767; font-size:13px;}
.form_input5  {border: 1px solid #d6d9de; width:210px; height:24px; color:#676767; font-size:13px;}
.form_input6 {border: 1px solid #d6d9de; width:40%; height:24px; color:#676767; font-size:13px;}
.list_tbl .talign_left{text-align:left;}
.question{padding:10px; border-bottom:1px solid #ccc;}
.question ul {border-top:2px solid #b38d51;}
.question li{padding:4px 10px; background-color:#f5f5f5; line-height:18px;font-size:12px;}
.head_view{font-size:14px; font-weight:bold; color:#555;}
.research_percent{border-top:2px solid #b38d51; }
.graph_wrap{position:relative; width:100%; overflow:hidden;}
.graph_content{float:left; height:22px;}
.graph_txt{float:left;  height:22px;padding-left:10px;}
.red{color:#f83f3f; font-weight:bold;}
.t_2{font-size:18px; font-weight:bold; color:#333; line-height:28px;background:url(/images/sub/dot01.jpg) no-repeat 0 8px; padding-left:18px;}
</style>
<!-- 결과보기 -->
<div>
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="list_tbl">
	<colgroup>
	<col width="15%" />
	<col width="85%" />
	</colgroup>
	<tr>
		<th>제목</th>
		<td class="talign_left"><?=stripslashes($poll[poll_subject]) ?></td>
	</tr>
	<!-- <tr>
		<th>설문조사 기간</th>
		<td class="talign_left"><?=$poll[poll_sdate]?> ~ <?=$poll[poll_edate]?></td>
	</tr> -->
	<tr>
		<th>내용</th>
		<td class="talign_left">
			<div id="DivContents" style="line-height:1.4;word-break:break-all;">
				<?=$poll["poll_content"]?>
			</div>
		</td>
	</tr>
	</table>
</div>

<div class="mt30">
	<p class="t_2">설문조사 질문</p>
	<?
	$poll_question_sql = "select * from $JO_table where poll_parent='{$poll[poll_num]}' and poll_use = 1 order by poll_sort desc, poll_num desc";
	$poll_question_result = mysql_query($poll_question_sql);
	$poll_question_num = mysql_num_rows($poll_question_result);
	if($poll_question_num){
	$count_num = 1;
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


	?>
	<div class="mt10 question">
		<h4 class="head_view"><?=$count_num?>. <?=$poll_question_arr[poll_question]?></h4>
		<div class="research_percent mt10">
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
				if($i==0){
					$color = "#6bbb98";
				}else if($i==1){
					$color = "#396ebd";
				}else if($i==2){
					$color = "#ff6e17";
				}else if($i==3){
					$color = "#999999";
				}else if($i==4){
					$color = "#efb017";
				}else{
					$color = "#6bbb98";
				}
			?>
			<p class="mt10"><?=$poll_answer[$i]?></p>
			<div class="graph_wrap ">
				<div class="graph_content"style="width:<?=$percent?>%; background-color:<?=$color?>;"></div>
				<div class="graph_txt"> <?=$percent?>%</div>
			</div>
			<?
			}
			?>
		</div>
	</div>
	<?$count_num++;}}?>
</div>
<div style="width:100%;text-align:right;padding-top:20px;">
<a href="/poll/poll_list.php"><img src="/skin/bbs/basic_white/images/btn_list.gif"></a>
</div>



<?
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>
<script>
function imgResize()
{
    // DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌
    maxsize = 563; // 가로사이즈 ( 다른값으로 지정하면됨)
    var content = document.getElementById("DivContents");
    var img = content.getElementsByTagName("img");
    for(i=0; i<img.length; i++)
    {

        if ( eval('img[' + i + '].width > maxsize') )
        {
            var heightSize = ( eval('img[' + i + '].height')*maxsize )/eval('img[' + i + '].width') ;
            eval('img[' + i + '].width = maxsize') ;
            eval('img[' + i + '].height = heightSize') ;
        }
    }
}
window.onload = imgResize;
</script>
