<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

if (!$_SESSION[userid] || $_SESSION[userid]=="GUEST")
    alert("회원 전용 서비스 입니다.", "/member/login.php?url=".urlencode($url));

if ($mode == "D")
{
    $wi_id = trim($_GET[wi_id]);
    $sql = " delete from {$GnTable[shopwish]}
              where wi_id = '$wi_id'
                and mb_id = '$_SESSION[userid]' ";
    sql_query($sql);

} else if ($mode == "multi") { // 온라인견적(등)에서 여러개의 상품이 한꺼번에 들어옴.

	for ($i=0; $i<$records; $i++) {
        if ($_POST[it_id][$i]) {
			// 보관함에 Insert
			$sql_common = " set mb_id = '$_SESSION[userid]',
								it_id = '{$_POST[it_id][$i]}',
								wi_time = '$datetime',
								wi_ip = '$REMOTE_ADDR' ";

			$sql = " select wi_id from {$GnTable[shopwish]}
					  where mb_id = '$_SESSION[userid]' and it_id = '{$_POST[it_id][$i]}' ";
			$row = sql_fetch($sql);
			if ($row[wi_id]) { // 이미 있다면 삭제함
				$sql = " delete from {$GnTable[shopwish]} where wi_id = '$row[wi_id]' ";
				sql_query($sql);
			}

			$sql = " insert {$GnTable[shopwish]}
						set mb_id = '$_SESSION[userid]',
							it_id = '{$_POST[it_id][$i]}',
							wi_time = '$datetime',
							wi_ip = '$REMOTE_ADDR' ";
			sql_query($sql);
		}
    }
} else {



	$pay = item_payresult($_POST[it_id]); /// 제품가격을 불러옵니다.

	//다중옵션s
	if ($it_opt_use=="2") {
		$Re_ct_qty = $_POST[ct_qty];
		$_POST[ct_qty] = "0";
		$_POST[it_opt1] = "";

		for($i=0; $i < count($_POST[itop_no]); $i++){
			if($_POST[it_opt1] == "") $_POST[it_opt1] = $_POST[itop_no][$i];
			else $_POST[it_opt1] = $_POST[it_opt1]."|".$_POST[itop_no][$i];

			// 재고 구함
		   $it_stock_qty = get_it_op_stock_qty($_POST[itop_no][$i],$_POST[it_id]);
			if ($ct_qty + $sum_qty > $it_stock_qty) {
				$row = sql_fetch("select itop_opt1 from Gn_Shop_Add_option where itop_no='".$_POST[itop_no][$i]."'");
			   alert("$it_name(".$row[itop_opt1].") 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
		  }

		}
		
		$_POST[it_opt1] .=";";
		for($i=0; $i < count($_POST[option_qty]); $i++){
			if($i == 0) $_POST[it_opt1] .= $_POST[option_qty][$i];
			else $_POST[it_opt1] .= ",".$_POST[option_qty][$i];
			if($_POST[it_opt_use2] == "1") {
				$_POST[ct_qty] += $_POST[option_qty][$i];
			}else{
				$_POST[ct_qty] = $Re_ct_qty;
			}
		}
	}else{
	// 재고 구함
	
		   $it_stock_qty = get_it_op_stock_qty($_POST[it_opt1],$_POST[it_id]);

			if ($ct_qty + $sum_qty > $it_stock_qty) {
			   alert("$it_name 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
		  }
	}
	//다중옵션e

	$ex_it_opt1 = explode(";",$_POST[it_opt1]);
	$ex_it_opt_num = explode("|",$ex_it_opt1[0]);
	$ex_it_opt_qty = explode(",",$ex_it_opt1[1]);
	if(strlen($_POST[it_opt1])>0){
		for($a=0; $a < count($ex_it_opt_num); $a++){
			$rows = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$ex_it_opt_num[$a]."'");
			if(!$ex_it_opt_qty[$a])  $ex_it_opt_qty[$a] = $_POST[ct_qty];
			if($rows[itop_amount] * $ex_it_opt_qty[$a] > 100) $option_amount += $rows[itop_amount] * $ex_it_opt_qty[$a];
		}
	}

	if($_POST[packing_option] > 0) $wi_packing_pay = $_POST[packing_option] * $_POST[ct_qty];

    $sql = " select wi_id from {$GnTable[shopwish]}
              where mb_id = '$_SESSION[userid]' and it_id = '$it_id' ";
    $row = sql_fetch($sql);
    if ($row[wi_id]) { // 이미 있다면 삭제함
        $sql = " delete from {$GnTable[shopwish]} where wi_id = '$row[wi_id]' ";
        sql_query($sql);
    }

    $sql = " insert {$GnTable[shopwish]}
                set mb_id = '$_SESSION[userid]',
                    it_id = '$it_id',
                    it_opt_use = '$it_opt_use',
                    it_opt_use2 = '$it_opt_use2',
                    it_opt1 = '$_POST[it_opt1]',
                    ct_amount = '$pay[pay]',
                    ct_qty = '$_POST[ct_qty]',
                    wi_time = '$datetime',
                    wi_packing_pay = '$wi_packing_pay',
                    wi_ip = '$REMOTE_ADDR' ";
    sql_query($sql);
}

goto_url("./wish_list.php");
?>