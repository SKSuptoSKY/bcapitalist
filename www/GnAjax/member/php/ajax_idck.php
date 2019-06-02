<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$ay_prohibit_id = array("administrator","관리자","운영자","어드민","주인장","webmaster","웹마스터","sysop","시삽","시샵","manager","매니저","메니저","루트","su","guest","방문객");      
$re_prohibit_id = implode(",",$ay_prohibit_id);

if (strlen($id) < 5) {
    echo "200"; // 5보다 작은 회원아이디
} else if(strlen($id) > 15){
	 echo "210"; // 15보다 큰 회원아이디
}else {
	$query = "Select mem_id from Gn_Member where mem_id = '$id' ";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	if($row[mem_id]){
		echo "300";
	}else {
        if (preg_match("/[\,]?{$id}/i", $re_prohibit_id))
            echo "400"; // 예약어로 금지된 회원아이디
        else
            echo "500"; // 정상
	}
}

/*
if (preg_match("/[^0-9a-z_]+/i", $id)) {
    echo "100"; // 유효하지 않은 회원아이디
} else if (strlen($id) < 5) {
    echo "200"; // 5보다 작은 회원아이디
} else if(strlen($id) > 15){
	 echo "210"; // 15보다 큰 회원아이디
}else {
	$query = "Select mem_id from Gn_Member where mem_id = '$id' ";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	if($row[mem_id]){
		echo "300";
	}else {
        if (preg_match("/[\,]?{$id}/i", $re_prohibit_id))
            echo "400"; // 예약어로 금지된 회원아이디
        else
            echo "500"; // 정상
	}
}
*/
?>