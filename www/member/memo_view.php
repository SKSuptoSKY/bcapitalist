<?
include_once($_SERVER["DOCUMENT_ROOT"]."/head.lib.php");

	if(Login_check()==FALSE) alert_close("회원만 이용하실 수 있습니다.\n\n로그인 해주세요","/member/login.php");

	if($default["use_memo"]==FALSE) alert_close("회원 쪽지기능을 사용할 수 없습니다.");

	if($mode=="SAVE") {
		$PG_table = $GnTable["memosave"];
		$sql_where = "where m_save_id = '{$_SESSION[userid]}' ";
		$Page_Title = "저장한 쪽지 읽기";
	} else if($mode=="RECV") {
		$PG_table = $GnTable["memo"];
		$sql_where = "where m_recv_id = '{$_SESSION[userid]}' ";
		$Page_Title = "보낸 쪽지 읽기";
	} else if($mode=="SEND") {
		$PG_table = $GnTable["memo"];
		$sql_where = "where m_send_id = '{$_SESSION[userid]}' ";
		$Page_Title = "받은 쪽지 읽기";
	} else {
		alert_close("정상적인 접근이 아닙니다.");
	}

	$sql = " select * from $PG_table $sql_where and m_no = '$id'";
	$view = sql_fetch($sql);
	$memo = stripslashes($view["m_memo"]);
	$recv_name = Get_Nick($view["m_recv_id"]);
	$send_name = Get_Nick($view["m_send_id"]);
	$save_name = Get_Nick($view["m_save_id"]);
	$send_time = $view["m_send_time"];
	if($view["m_save_time"]==TRUE) $save_time = "<div align='right'>저장일 : ".$view["m_save_time"]."</div>";
		else $save_time = "";

	if(is_null_time($view["m_read_time"])==TRUE && $mode=="SEND") {
		sql_query(" update $PG_table set m_read_time = '$datetime' where m_no = '$id' "); // 읽은날짜 저장
	}

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/memo_view.skin.php";

include_once($_SERVER["DOCUMENT_ROOT"]."/foot.lib.php");
?>
