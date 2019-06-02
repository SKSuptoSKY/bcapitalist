<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopinquire"];
$JO_table = $GnTable["shopitem"];

$iq_subject = addslashes($iq_subject); 
$iq_question = addslashes($iq_question); 

$iq = sql_fetch(" select * from {$PG_table} where iq_id = '$iq_id' ");
if (!$iq[iq_id]) {
    alert("등록된 자료가 없습니다.");
}

$qstr = "page=$page&sort1=$sort1&sort2=$sort2";

if ($mode == "E") {
    $sql = "update $PG_table
               set iq_subject = '$iq_subject',
                   iq_question = '$iq_question',
                   iq_answer = '$iq_answer'
             where iq_id = '$iq_id' ";
    sql_query($sql);

    goto_url("./itemqa_form.php?w=$mode&iq_id=$iq_id&$qstr");
} else if ($mode == "D") {
    $sql = "delete from $PG_table where iq_id = '$iq_id' ";
    sql_query($sql);
    
	alert ("삭제되었습니다.","./itemqa_list.php?$qstr");
} else {
    alert();
}
?>
