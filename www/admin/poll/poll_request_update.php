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
	$sql = " insert $SO_table set $input_value , poll_modify = '$datetime' , poll_regist = '$datetime'";
	sql_query($sql);
	alert("설문조사 신청서가 등록되었습니다.","./poll_request_list.php");
}else if ($mode == "E") {
    $sql = " update $SO_table set $input_value , poll_modify = '$datetime' where  poll_num = '$poll_num' ";
    sql_query($sql);
	alert("설문조사 신청서가 수정되었습니다.","./poll_request_list.php");
}else if ($mode == "D") {
    $sql = " delete from $SO_table where poll_num = '$poll_num' ";
    sql_query($sql);
	alert("설문조사 신청서가 삭제되었습니다.","./poll_request_list.php");
}

?>
