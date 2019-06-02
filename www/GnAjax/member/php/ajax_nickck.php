<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

function str_count($str){
 $kChar = 0;
 for( $i = 0 ; $i < strlen($str) ;$i++){
  $lastChar = ord($str[$i]);
  if($lastChar >= 127){
   $i= $i+2;
  }
  $kChar++;
 }
 return $kChar;
}

if (str_count($nick) < 2) {
    echo "100"; // 4글자 이상 입력
}else if(str_count($nick) > 6){
	echo "110"; // 6글자 이상 입력
}else {
	$query = "Select mem_id from Gn_Member where mem_nick = '$nick' and mem_id <> '$id'";
	$result = mysql_query($query);
	$row = @mysql_fetch_array($result);	// 20141121 @처리 추가 : row 한개도 없을때를 대비
    if ($row[mem_id]) {
        echo "200"; // 이미 존재하는 별명
    } else {
        echo "300"; // 정상
    }
}
?>