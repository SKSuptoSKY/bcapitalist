<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";
if($_SESSION["userlevel"]<10) alert("권한이 없습니다.", "/main.php");

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];
$sql = " select * from $PG_table where poll_num = '$poll_num' ";
$poll = sql_fetch($sql);
?>
<script language='javascript'>
function pollChk(form) {
		/*
		if(!form.poll_username.value) {
			alert('이름을 입력하세요');
			form.poll_username.focus();
			return false;
		}

		if(!form.poll_mobile.value) {
			alert('전화번호를 입력하세요');
			form.poll_mobile.focus();
			return false;
		}
		*/
		/*
		var ds = form.elements['poll_score[]']; //d[] 이름을 가진 모든 양식 가져와서... 
		alert(ds.length);
		for(var i=0;i<ds.length;i++){ 
			//여기에 ds[i] 로 양식 객체 받아와서 처리. 
		} 
		alert(123);
	return false;
	*/
	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/poll/poll_update.php";
	<? }else{ ?>
		form.action = "/poll/poll_update.php";
	<? } ?>
	
	form.submit();
	return;
}


/* ------------------------------------------------------------- [ 이메일 정규식 체크 - Start ] ------------------------------------------------------------- */
function blur_email_input(value){
	$.ajax({
		type:"POST",
		url:"/GnAjax/check_valid/email_value.php", 

		data: 
		{ 
			email: value
		},

		success:function(result) {
			if (result=="true"){
				$("#email_valid_result_area").css("color","blue").html("사용가능한 이메일 주소입니다.")
			} else {
				$("#email_valid_result_area").css("color","#ff0000").html("이메일 형식이 올바르지 않습니다.");
				$("#email").attr("value","");
			}
		}
	});
};
/* ------------------------------------------------------------- [ 이메일 정규식 체크 - End ] ------------------------------------------------------------- */
</script>
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
<!-- 참여하기  -->
<form name="pollform" id="test" method="post" enctype="multipart/form-data" validate="UTF-8" onsubmit="pollChk(this); return false;">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="poll_parent" value="<?=$poll[poll_num]?>">
<input type="hidden" name="url" value="<?=$PHP_SELF?>?<?=$QUERY_STRING?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="poll_username" value="<?=$_SESSION["username"]?>">
<input type="hidden" name="poll_mobile" value="<?=$_SESSION["mobile"]?>">
<input type="hidden" name="poll_email" value="<?=$_SESSION["email"]?>">

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

<?/*?>
<div class="mt30">
	<p class="t_2">참여자 정보</p>
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="list_tbl mt10">
	<colgroup>
	<col width="8%" />
	<col width="15%" />
	<col width="8%" />
	<col width="15%" />
	</colgroup>
	<tr>
		<th>이름</th>
		<td class="talign_left"><input type="text" name="poll_username" id="poll_username" value="<?=$_SESSION["username"]?>" class="form_input1"></td>
		<th>전화번호</th>
		<td class="talign_left"><input type="text" name="poll_mobile" id="poll_mobile" value="<?=$_SESSION["mobile"]?>" class="form_input1"></td>
	</tr>
	<tr>
		<th>소속</th>
		<td class="talign_left"><input type="text" name="poll_ex1" id="poll_ex1" class="form_input1"></td>
		<th>직책</th>
		<td class="talign_left"><input type="text" name="poll_ex2" id="poll_ex2" class="form_input1"></td>
	</tr>
	<tr >
		<th>e-mail</th>
		<td colspan="3" class="talign_left">
		<input type="text" name="poll_email" id="poll_email" class="form_input1" onblur="blur_email_input(this.value);" value="<?=$_SESSION["email"]?>" style="width:60%;">
		<!-- 이메일형식 정규식 체크 출력부 -->
		&nbsp;<span id="email_valid_result_area"></span>
		</td>
	</tr>
	</table>
</div>
<?*/?>

<div class="mt30">
	<p class="t_2">설문조사 질문</p>
	<?
	$poll_question_sql = "select * from $JO_table where poll_parent='{$poll[poll_num]}' and poll_use = 1 order by poll_sort desc, poll_num desc";
	$poll_question_result = mysql_query($poll_question_sql);
	$poll_question_num = mysql_num_rows($poll_question_result);
	if($poll_question_num){
	$count_num = 1;
	$q_array = 0;
	while ($poll_question_arr = mysql_fetch_array($poll_question_result)) {
		$poll_answer = explode("|*1*|", $poll_question_arr["poll_answer"]);
	?>
	<input type="hidden" name="poll_question_idx[<?=$q_array?>]" value="<?=$poll_question_arr["poll_num"]?>">
	<div class="mt10 question">
		<h4 class="head_view"><?=$count_num?>. <?=$poll_question_arr[poll_question]?></h4>
		<ul class="mt10">
			<?
			for($i=0;$i<count($poll_answer);$i++){
			?>
			<li><input type="radio" name="poll_score_<?=$poll_question_arr["poll_num"]?>" id="poll_score__<?=$poll_question_arr["poll_num"]?>" value="<?=$i+1?>" class="radio">&nbsp;<?=$poll_answer[$i]?></li>
			<?
			}
			?>
		</ul>
	</div>
	<?$count_num++;$q_array++;}}?>
</div>

<div style="width:100%;text-align:right;padding-top:20px;">
<input type="submit" value="확인" style="width:70px; height:27px; background:#f8f8f8;  font-weight:700; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:1.5; vertical-align:top; cursor:pointer; font-family:Nanumgothic;"> 
<a href="/poll/poll_list.php"><div style="width:70px; height:22px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;padding-top:3px">목록</div></a>
</div>
</form>


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
