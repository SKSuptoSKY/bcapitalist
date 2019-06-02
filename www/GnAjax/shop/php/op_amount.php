<?
	header("Content-type:text/plain; charset=utf-8");
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib2.php";

// echo "한글"로 출력하지 않는 이유는 Ajax 는 euc_kr 에서 한글을 제대로 인식하지 못하기 때문
// 여기에서 영문으로 echo 하여 Request 된 값을 Javascript 에서 한글로 메세지를 출력함
		/*
		$_POST[itop_no] = substr($_POST[itop_no],0,-1);
		$ex_itop_no = explode("|",$_POST[itop_no]);
		$add_sql = " itop_no in(";
		for($i=0; $i < count($ex_itop_no); $i++){
			if($i > 0) $add_sql .= ",";
			$add_sql .= "'".$ex_itop_no[$i]."'";

		}
		$add_sql .= ")";

		$sql = "select * from Gn_Shop_Add_option where ".$add_sql;
		$result = mysql_query($sql);
		while($rows = mysql_fetch_array($result)){
			if($rows[itop_stock] == 0 && $rows[itop_stock] != "") {
				$result_itop_amount = "품절";	
				break;
			}
			if($rows[itop_amount_op] == "+") $result_itop_amount += $rows[itop_amount];
			else $result_itop_amount -= $rows[itop_amount];
		}
		
		echo $result_itop_amount;
		*/

	//echo $_POST[itop_no];
	
	$row = sql_fetch("select * from Gn_Shop_Add_option where itop_no = '".$_POST[itop_no]."'");
		if($row[itop_stock] == 0 && $row[itop_stock] != ""){
		$row[itop_amount] = "품절";
	}else{
		$row[itop_amount] = $row[itop_amount];
	}
	// 수정mj + - 가 붙어있지 않다.
	// 기존 : echo $row[itop_amount];
	echo $row[itop_amount_op].$row[itop_amount];

	
?>