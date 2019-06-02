<?
include "../head.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];
/////// DB에 들어갈 값들을 정리합니다.

	$poll_subject = addslashes($poll_subject);
	//$poll_content = addslashes($poll_content);

$input_value = "
	poll_subject			= '$poll_subject',
	poll_content			= '$poll_content',
	poll_question			= '$poll_question',
	poll_sdate			= '$poll_sdate',
	poll_edate			= '$poll_edate',
	poll_state			= '$poll_state'
";


if($mode == "W") {
	$sql = " insert $PG_table set $input_value , poll_modify = '$datetime' , poll_regist = '$datetime'";
	sql_query($sql);
	alert("설문조사가 등록되었습니다.","./poll_list.php");
}else if ($mode == "E") {
    $sql = " update $PG_table set $input_value , poll_modify = '$datetime' where  poll_num = '$poll_num' ";
    sql_query($sql);
	alert("설문조사가 수정되었습니다.","./poll_list.php");
}else if ($mode == "D") {
	/*
	$poll_question_sql = "select * from $JO_table where poll_parent='{$poll_num}' order by poll_sort desc, poll_num desc";
	$poll_question_result = mysql_query($poll_question_sql);
	$poll_question_num = mysql_num_rows($poll_question_result);

	if($poll_question_num){
	while ($poll_question_arr = mysql_fetch_array($poll_question_result)) {
			$sql = " delete from $SO_table where poll_parent = '{$poll_question_arr[poll_num]}' ";
			sql_query($sql);
		}
	}

    $sql = " delete from $JO_table where poll_parent = '$poll_num' ";
    sql_query($sql);
	*/
    $sql = " delete from $PG_table where poll_num = '$poll_num' ";
    sql_query($sql);
	alert("설문조사가 삭제되었습니다.","./poll_list.php");
}

?>
