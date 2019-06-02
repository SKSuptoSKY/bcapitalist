<?
include "../head.php";
include "./lib/lib.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];


/* ------------------------------------------------------------- [ 데이터 정리 - START ] ------------------------------------------------------------- */
$poll_question = addslashes($poll_question);
if(is_array($poll_answer)) $poll_answer = implode("|*1*|",$poll_answer);
/* ------------------------------------------------------------- [ 데이터 정리 - END ] ------------------------------------------------------------- */

/* ------------------------------------------------------------- [ 필드 - START ] ------------------------------------------------------------- */
$input_value = "
	poll_parent				= '$poll_parent',
	poll_question				= '$poll_question',
	poll_answer				= '$poll_answer',
	poll_use				= '$poll_use',
	poll_sort				= '$poll_sort'
";
/* ------------------------------------------------------------- [ 필드 - END ] ------------------------------------------------------------- */



/* ------------------------------------------------------------- [ 모드 처리 - START ] ------------------------------------------------------------- */

//////// 등록
if ($mode=="W")	
{
    if (!trim($poll_parent)) 
	{
        alert("설문조사가 없으므로 문항을 추가하실 수 없습니다.");
    }

	// 데이터베이스 인서트
    $sql = " insert $JO_table set $input_value , poll_regist='$datetime' ";
    sql_query($sql);
	$instert_num = mysql_insert_id();
}

//////// 수정
else if ($mode=="E")
{
	// 데이터 베이스 업데이트
	$sql = " update $JO_table set $input_value where poll_num = '$poll_num' ";
	sql_query($sql);
}

//////// 삭제
else if ($mode=="D")
{
	// 데이터베이스 로우 삭제
	$sql = " delete from $JO_table where poll_num = '$poll_num' ";
	sql_query($sql);
	//$sql = " delete from $SO_table where poll_parent = '$poll_num' ";
	//sql_query($sql);
}
/* ------------------------------------------------------------- [ 모드 처리 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 페이지 이동 - START ] ------------------------------------------------------------- */
$qstr = "$qstr&poll_parent=$poll_parent&sca=$sca&page=$page";
if ($mode=="E" || $mode == "D")  {
	goto_url("./poll_question_list.php?$qstr");
}

?>

<script>
	if (confirm("계속 입력하시겠습니까?"))
		location.href = "<?="./poll_question_form.php?mode=W&$qstr"?>";
	else
		location.href = "<?="./poll_question_list.php?$qstr"?>";
</script>