<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include "./lib/lib.php"; // 확장팩 사용함수

	$PG_table = $GnTable["shopconfig"];
	
	$add_sql="";
	if($_POST[explan_trans] != ""){
		$go_url = "./explan_trans.php";
		$add_sql .= "explan_trans = '".$_POST[explan_trans]."'";
	}else if($_POST[explan_chan] != ""){
		$go_url = "./explan_chan.php";
		$add_sql .= "explan_chan = '".$_POST[explan_chan]."'";
	}else if($_POST[explan_other] != ""){
		$go_url = "./explan_other.php";
		$add_sql .= "explan_other = '".$_POST[explan_other]."'";
	}
	
	sql_query("update $PG_table set $add_sql where site = '{$default[site_code]}'");
	alert("수정되었습니다",$go_url);
?>