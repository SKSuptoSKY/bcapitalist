<?
include_once($_SERVER["DOCUMENT_ROOT"]."/head.lib.php");

	if(Login_check()==FALSE) alert_close("회원만 이용하실 수 있습니다.\\n\\n로그인 해주세요","/member/login.php");

	if($default["use_memo"]==FALSE) alert_close("회원 쪽지기능을 사용할 수 없습니다.");

	$PG_table = $GnTable["memo"];
	$SG_table = $GnTable["memosave"];

if($mode=="W") {
	$memo = addslashes($memo);
	$send_id = explode(",", $send_id);
	$me_recv_mb_id_list = "";
	$comma1 = $comma2 = "";
	$mb_list = array();
	$mb_array = array();
	for ($i=0; $i<count($send_id); $i++) {
		$row = Get_member($send_id[$i]);
		if ($row["mem_id"]==FALSE || $row["mem_leb"]=="0") {
			$msg .= "$comma1$send_id[$i]";
			$comma1 = ",";
		} else if($row["mem_id"]==$_SESSION[userid]) {
			$msg2 = "본인에게는 쪽지를 보내실 수 없습니다.\\n\\n";
			$msg .= "$comma1$send_id[$i]";
			$comma1 = ",";
		} else {
			$me_recv_mb_id_list .= "$comma2$row[mem_nick]";
			$mb_list[] = $send_id[$i];
			$mb_array[] = $row;
			$comma2 = ",";
		}
	}

	if ($msg || $msg2 ) {
		alert("$msg2회원아이디 \'".$msg."\' 은(는) 쪽지를 발송할 수 없는 상태입니다.\\n\\n쪽지를 발송하지 않았습니다.");
	}


	for ($i=0; $i<count($mb_list); $i++) {
		if (trim($mb_list[$i])) {
			// 쪽지 INSERT
			$sql = " insert $PG_table set 
							m_recv_id = '{$_SESSION[userid]}',
							m_send_id = '{$mb_list[$i]}',
							m_memo = '$memo',
							m_send_time = '$datetime',
							m_addip = '{$_SERVER[REMOTE_ADDR]}',
							site = '{$default[site_code]}' ";
			sql_query($sql);
		}
	}

	alert("\'$me_recv_mb_id_list\' 님께 쪽지를 전달하였습니다.", "./memo.php?mode=SEND");
}

if($mode=="D") {
	if($id==FALSE) alert("삭제할 쪽지를 선택해 주세요");

	// 삭제할 쪽지를 불러옵니다.
	$sql = " select * from $PG_table where m_no = '$id'";
	$view = sql_fetch($sql);

	if($type=="RECV") {
		if(is_null_time($view["m_read_time"])==TRUE || $view["m_send_del"]=="1" ) {
			sql_query("delete from $PG_table where m_no ='$id' ");
		} else {
			sql_query("update $PG_table set m_recv_del = '1' where m_no ='$id' ");
		}
	} else if($type=="SEND") {
		if($view["m_recv_del"]=="1") {
			sql_query("delete from $PG_table where m_no ='$id' ");
		} else {
			sql_query("update $PG_table set m_send_del = '1' where m_no ='$id' ");
		}
	}

	alert("선택하신 쪽지를 삭제하였습니다.", "./memo.php?mode=$type");
}

if($mode=="S") {
	if($id==FALSE) alert("저장할 쪽지를 선택해 주세요");

	// 저장할 쪽지를 불러옵니다.
	$sql = " select * from $PG_table where m_no = '$id'";
	$view = sql_fetch($sql);

	// 저장된 쪽지가 있는지 불러옵니다.
	$sql = " select * from $SG_table where m_save_id = '{$_SESSION[userid]}' and m_memo = '{$view[m_memo]}'";
	$save = sql_fetch($sql);

	// 저장된 쪽지가 있으면 되돌려줍니다.
	if($save["m_no"]==TRUE) alert("이미 같은 내용의 쪽지가 저장되어 있습니다.");

	// 쪽지를 저장테이블에 저장합니다.
	$sql = " insert $SG_table set 
					m_save_id = '{$_SESSION[userid]}',
					m_recv_id = '{$view[m_recv_id]}',
					m_send_id = '{$view[m_send_id]}',
					m_memo = '{$view[m_memo]}',
					m_send_time = '{$view[m_send_time]}',
					m_read_time = '{$view[m_read_time]}',
					m_save_time = '$datetime',
					site = '{$default[site_code]}' ";
	sql_query($sql);

	alert("선택하신 쪽지를 보관하였습니다.", "./memo.php?mode=SAVE");
}

if($mode=="SD") {
	if($id==FALSE) alert("삭제할 쪽지를 선택해 주세요");

	$sql = "delete from $SG_table where m_no ='$id' ";
	sql_query($sql);

	alert("선택하신 쪽지를 삭제하였습니다.", "./memo.php?mode=SAVE");
}
?>
