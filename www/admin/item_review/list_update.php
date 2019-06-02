<?
	include_once $_SERVER[DOCUMENT_ROOT]."/admin/lib/lib.php";
	$Table = "banner_pr";
	for($i=0; $i < count($_POST[list_num]); $i++){
		sql_query("update $GnTable[bbsitem]{$Table} set b_ex11='".$_POST[b_ex11][$i]."',b_ex12='".$_POST[b_ex12][$i]."',b_ex13='".$_POST[b_ex13][$i]."' where b_no='".$_POST[list_num][$i]."'");
	}
	alert("변경 처리 되었습니다","./list.php?{$qstr}");
?>