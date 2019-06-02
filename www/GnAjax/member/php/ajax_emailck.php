<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

//$query = "Select mem_id,mem_email from Gn_Member where mem_email = '$email' and mem_id = '$id'";
$query = "Select mem_id,mem_email from Gn_Member where mem_email = '$email' ";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

if(!$email){
	echo "100";
}else if($row[mem_id]){
	
	if($_SESSION["email"] == $row[mem_email]) {
		// 자신의 이메일인경우
		echo "500";
	} else {
		// 자신이 아닌 다른 누군가 사용하는 경우
		echo "200";
	}

}else {
	if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $email)) echo "300";
	else echo "400";
}

?>