<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];

for ($m=0; $m<count($_POST[od_id]); $m++) {

    // 배송회사와 운송장번호가 있는것만 수정
    if ($_POST[dl_id][$m] && trim($_POST[od_invoice][$m])) {
		$od_invoice_time_var = "od_invoice_time_$m";
        $sql = "update $PG_table 
                   set od_invoice_time = '{$_POST[$od_invoice_time_var]}',
                       dl_id           = '{$_POST[dl_id][$m]}',
                       od_invoice      = '{$_POST[od_invoice][$m]}'
                 where od_id           = '{$_POST[od_id][$m]}' ";
        sql_query($sql);

            $od_id = $_POST[od_id][$m];

            // 1.04.22
            // 장바구니 상태가 '주문', '준비' 일 경우 '배송' 으로 상태를 변경
            $on_uid = $_POST[on_uid][$m];
            $sql = " update $JO_table
                        set ct_status = '배송'
                      where ct_status in ('주문', '준비')
                        and on_uid = '$on_uid' ";
            sql_query($sql);

           $send_mail = "1";
			//include "./order_mail.inc.php";

            // 재고 반영
            $sql2 = " select it_id, ct_id, ct_stock_use,it_opt1, ct_qty from $JO_table 
                       where on_uid = '$on_uid' 
                         and ct_stock_use = '0' ";
            $result2 = sql_query($sql2);
            for ($k=0; $row2=mysql_fetch_array($result2); $k++) 
            {
				
				$ex_it_opt = explode(";",$row2[it_opt1]);
				$it_op_data = mysql_fetch_array(mysql_query("select it_opt1 from {$GnTable[shopitem]} where it_id = '$row2[it_id]'"));
				 $ex_it_opt2 = explode("\n",$it_op_data[it_opt1]);
					for($l=0; $l < count($ex_it_opt2); $l++){
						 $ex_it_opt3 = explode(";",$ex_it_opt2[$l]);
						 if($ex_it_opt3[0] == $ex_it_opt[0]){
							$sum_qty = $ex_it_opt3[3]-$row2[ct_qty];
							$re_it_op = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$ex_it_opt3[3];
							$re_it_op_sum = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$sum_qty;
							break;
						 }
					}
				
				if(!$row2[it_opt1]){// 옵션제고가 아니라면 옵션 replace하지않고 전체 제고만 업데이트한다
					$re_it_op = "";
					$re_it_op_sum = "";
				}

                $sql3 =" update {$GnTable[shopitem]} set it_stock = it_stock - '$row2[ct_qty]', it_opt1 =REPLACE(it_opt1,'{$re_it_op}','{$re_it_op_sum}') where it_id = '$row2[it_id]' ";
                sql_query($sql3);

                $sql4 = " update $JO_table
                            set ct_stock_use  = '1',
                                ct_history    = CONCAT(ct_history,'\n배송일괄|$isnow|$REMOTE_ADDR')
                          where on_uid = '$on_uid'
                            and ct_id  = '$row2[ct_id]' ";
                sql_query($sql4);
            }

		// 회원정보를 업데이트합니다.
		put_totalorder("{$_POST[mb_id][$m]}");
		// 여기까지입니다.	

    }
}

goto_url("./inpay_list.php?sort1=$sort1&sort2=$sort2&sel_ca_id=$sel_ca_id&sel_field=$sel_field&search=$search&page=$page");
?>
