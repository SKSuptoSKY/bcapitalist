<?
include "../head.php";


if ($mode=="sort") {
	$sort_value_arr=explode("|",$sort_value);
	for ($i=0; $i<count($sort_value_arr); $i++) {
		$iplus=$i+1;
		$sort_value_arr2=explode("/",$sort_value_arr[$i]);
		if ($sort_value_arr2[0]=="1") {
			$sql="update {$GnTable[bbsconfig]} set boardsort='{$iplus}' where dbname='{$sort_value_arr2[1]}'"; 
			sql_query($sql);
		}
		else if ($sort_value_arr2[0]=="2") {
			$sql="update {$GnTable[pageitem]} set pg_sort='{$iplus}' where pg_code='{$sort_value_arr2[1]}'"; 
			sql_query($sql);
		}
	}
	alert2 ("위치가 저장되었습니다.");
}

if ($mode=="del") {
	$sort_value_arr=explode("/",$sort_value);
	if ($sort_value_arr[0]=="1") {
		$sql="update {$GnTable[bbsconfig]} set boardsort='0',boardgroup='' where dbname='{$sort_value_arr[1]}'"; 
		sql_query($sql);
	}
	else if ($sort_value_arr[0]=="2") {
		$sql="update {$GnTable[pageitem]} set pg_sort='0',pg_group='' where pg_code='{$sort_value_arr[1]}'"; 
		sql_query($sql);
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert ("선택한 항목이 삭제되었습니다.");
		parent.location.reload();
	//-->
	</SCRIPT>
	<?
}
?>