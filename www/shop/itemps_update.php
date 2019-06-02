<? 
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";
if($mode=="delete"){
	sql_query("delete from {$GnTable[shopafter]} where is_id='$is_id' ");
	
}else{
	if (!$_SESSION[userid] || $_SESSION[userid]=="GUEST") alert("회원만 가능합니다.");
	if (!$is_subject || !$is_content) alert("제목과 내용을 입력하십시오.");
	
	$sql = " select max(is_id) from {$GnTable[shopafter]} ";
	$row = sql_fetch($sql);
	$max_is_id = $row[0];
	
	$sql = " select max(is_id) from {$GnTable[shopafter]}
			  where it_id = '$it_id'
				and mb_id = '$_SESSION[userid]' ";
	$row = sql_fetch($sql);
	if ($row[0] && $row[0] == $max_is_id) alert("계속해서 평가하실 수 없습니다.");
	
	$is_subject = addslashes($is_subject);
	$is_content = addslashes($is_content);
	$sql = "is_score='$is_score', ";
	$sql.= "is_subject='$is_subject', ";
	$sql.= "is_content='$is_content' ";

	if($is_id!=""){
	sql_query("update {$GnTable[shopafter]} set $sql where is_id='$is_id' ");
	}else{
		sql_query("insert {$GnTable[shopafter]} set it_id = '$it_id',mb_id = '$_SESSION[userid]',$sql,is_time = '$datetime',is_ip = '$REMOTE_ADDR'");
	}
}


goto_url($HTTP_REFERER);
?>
