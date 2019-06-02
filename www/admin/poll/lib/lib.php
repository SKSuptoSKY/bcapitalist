<?
// 설문조사 문항 함수
function get_poll_list_count($table_name, $poll_num) {
	$sql = "SELECT poll_num FROM {$table_name} WHERE poll_parent='$poll_num' ";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	return $count;
}

function get_poll_value($poll_num, $field){
	global $GnTable;
	$poll_sql = "SELECT $field FROM {$GnTable[poll]} WHERE poll_num='".$poll_num."'";
	$poll_query = mysql_query($poll_sql);
	$poll_row = mysql_fetch_array($poll_query);
 
	$poll_value = $poll_row[$field];
	return $poll_value;
}



?>