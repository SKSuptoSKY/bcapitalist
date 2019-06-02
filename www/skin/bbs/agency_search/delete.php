<?
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	

	$Table = $_GET[tbl];
	$num = $_GET[num];

	$del_sql = "DELETE FROM Gn_Board_Item_".$Table." WHERE b_no=".$num."";
	
	$del_query = mysql_query($del_sql);
	
	if ($del_query==TRUE)
	{
		alert("삭제 되었습니다.","/bbs/board.php?tbl=dealerstatus");
	}
?>