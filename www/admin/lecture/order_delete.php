<?
	include "../head.php";
	include "./lib/lib.php"; // Ȯ���� ����Լ�

if ($order_idxx)
{
    // �������� ����
    sql_query(" delete from Gn_Lecture_History where order_idxx = '$order_idxx'");
}

if ($return_url)
{
    goto_url("$return_url");
}
else
{
    $qstr = "sel_ca_id=$sel_ca_id&sel_field=$sel_field&search=$search&sort1=$sort1&sort2=$sort2&page=$page";
    goto_url("./order_list.php?$qstr");
}
?>
