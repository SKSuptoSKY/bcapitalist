<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopafter"];
$JO_table = $GnTable["shopitem"];

$is_subject = addslashes($is_subject); 
$is_content = addslashes($is_content); 

$iv = sql_fetch(" select * from $PG_table  where is_id = '$is_id' ");
if (!$iv[is_id]) {
    alert("등록된 자료가 없습니다.");
}

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";

if ($mode == "E") {
    $sql = "update $PG_table 
               set is_subject = '$is_subject',
                   is_content = '$is_content',
                   is_confirm = '$is_confirm'
             where is_id = '$is_id' ";
    sql_query($sql);

    alert ("수정되었습니다.","./itemps_form.php?mode=$mode&is_id=$is_id&$qstr");
} else if ($mode == "D") {
    $sql = "delete from $PG_table  where is_id = '$is_id' ";
    sql_query($sql);

   alert ("삭제되었습니다.","./itemps_list.php?$qstr");
} else {
    alert();
}
?>
