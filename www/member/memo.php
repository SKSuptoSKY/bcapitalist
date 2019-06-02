<?
include_once($_SERVER["DOCUMENT_ROOT"]."/head.lib.php");

	if(Login_check()==FALSE) alert_close("회원만 이용하실 수 있습니다.\\n\\n로그인 해주세요","/member/login.php");

	if($default["use_memo"]==FALSE) alert_close("회원 쪽지기능을 사용할 수 없습니다.");


	// 받은 메모중 설정일이 지난 읽은 메모 삭제
	$MemoDelTime = date("Y-m-d H:i:s", $now - (86400 * $default["memo_del"]));
	$sql = "delete from {$GnTable[memo]} where m_send_id = '{$_SESSION[userid]}' and m_read_time < '$MemoDelTime' and m_read_time != '0000-00-00 00:00:00' ";
	sql_query($sql);

	if ($mode==FALSE) $mode = "SEND";

	if($mode=="RECV") {
		$PG_table = $GnTable["memo"];
		$sql_where = "where m_recv_id = '{$_SESSION[userid]}' and m_recv_del = '0' ";
		$Page_Title = "보낸";
	} else if($mode=="SEND") {
		$PG_table = $GnTable["memo"];
		$sql_where = "where m_send_id = '{$_SESSION[userid]}' and m_send_del = '0'";
		$Page_Title = "받은";
	} else  if($mode=="SAVE") {
		$PG_table = $GnTable["memosave"];
		$sql_where = "where m_save_id = '{$_SESSION[userid]}' ";
		$Page_Title = "저장한";
	} else {
		alert_close("정상적인 접근이 아닙니다.");
	}
	$JO_table = $GnTable["member"];

	$sql = " select count(*) as cnt from $PG_table $sql_where ";
	$row = sql_fetch($sql);
	$total_count = number_format($row[cnt]);

	$rows = 10;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$list = array();

	$sql = " select * from $PG_table $sql_where order by m_no desc limit $from_record, $rows";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++)
	{
		$list[$i] = $row;

		if (substr($row[m_read_time],0,1) == '0') $list[$i]["m_read_time"] = '아직 읽지 않음';
			else $list[$i]["read_time"] = $row["m_read_time"];
		if (substr($row[m_read_time],0,1) == '0') $list[$i]["send_time"] = "<b>".$row["m_send_time"]."</b>";
			else $list[$i]["send_time"] = $row["m_send_time"];

		$list[$i]["recv_name"] = Get_Nick($row["m_recv_id"]);
		$list[$i]["send_name"] = Get_Nick($row["m_send_id"]);
		$list[$i]["save_time"] = $row["m_save_time"];

		$list[$i]["Url_view"] = "./memo_view.php?id=$row[m_no]&mode=$mode&page=$page";
		if($mode=="SAVE") { $list[$i]["Url_dele"] = "./memo_update.php?mode=SD&id=$row[m_no]&page=$page"; } else { $list[$i]["Url_dele"] = "./memo_update.php?mode=D&id=$row[m_no]&type=$mode&page=$page"; }
		$list[$i]["Url_save"] = "./memo_update.php?mode=S&id=$row[m_no]&page=$page";
	}

	$list_total = count($list);

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/memo.skin.php";

include_once($_SERVER["DOCUMENT_ROOT"]."/foot.lib.php");
?>
