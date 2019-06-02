<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];
$IT_table = $GnTable["shopitem"];
$SE_table = $GnTable["shopsell"];
$MEM_table = $GnTable["member"];
$PO_table=$GnTable["point"];

if($isnow=="") {
	$isnow = date("Y-m-d H:i:s");
}


if($mode=="memo"){

	$sql = " update $PG_table
				set od_shop_memo = '$od_shop_memo'
		        where od_id = '$od_id' ";
	sql_query($sql);
} 
else if($mode=="listup") {

	$od_cnt = count($_POST[od_id]);
	for($od=0; $od<$od_cnt; $od++) {
		if($od_ck[$od]=="1" && $state[$od] != '배송') {
			$sql = "select * from $PG_table where od_id = '{$od_id[$od]}' ";
			$row = sql_fetch($sql);

			// 리스트에서 준비로 일괄 수정했을경우  입금금액이 있으면(포인트포함) 반영하여야 한다.
			// 포인트 입금금액이 있다면
			if($row["od_receipt_point"] > 0) {
				$od_receipt_bank = $row["od_temp_bank"] - $row["od_receipt_point"];
				$od_receipt_card = $row["od_temp_card"] - $row["od_receipt_point"];
			} else {
				$od_receipt_bank = $row["od_temp_bank"];
				$od_receipt_card = $row["od_temp_card"];
			}
			
			if($row[od_temp_bank] > 0) $input_data = "od_bank_time = '$isnow' , od_receipt_bank = '$od_receipt_bank' ";
			else if($row[od_temp_card] > 0) $input_data = "od_card_time = '$isnow' ,od_receipt_card = '$od_receipt_card' ";
			else $input_data = " ";

			if ($state[$od] == '준비') {
				$sql =" update $PG_table set $input_data where od_id = '{$od_id[$od]}' ";
				sql_query($sql);
			}

			$sql = " select a.*, b.it_name from $JO_table a left join $IT_table b on(a.it_id = b.it_id)
					  where a.on_uid = '$row[on_uid]' ";
					 
			$result = sql_query($sql);

			for ($ctc=0; $ct=mysql_fetch_array($result); $ctc++) {
			
				$ex_it_op_data = explode(";",$ct[it_opt1]);
				$ex_it_op_data[0]; // 옵션넘버
				$re_it_op_data1 = explode("|",$ex_it_op_data[0]);
				$ex_it_op_data[1]; // 옵션구매수량
				$re_it_op_data2 = explode(",",$ex_it_op_data[1]);
				 

				// 재고를 이미 사용했다면 (재고에서 이미 뺐다면)
				$stock_use = $ct[ct_stock_use];
								$point_use = $ct[ct_point_use];
									if ($state[$od] == '주문' || $state[$od] == '취소' || $state[$od] == '반품' || $state[$od] == '품절') {
										if($ct[ct_stock_use] == 1){
											$stock_use = 0;
											// 옵션재고를 더한다
											if($ct[it_opt1] != ""){
												for($x=0; $x < count($re_it_op_data1); $x++){
													//sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
													/*변경부분 s*/
													/*변경된 부분 s*/
													if($re_it_op_data2[$x]){
														sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
													}else{
														sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$ct[ct_qty]} where itop_no='".$re_it_op_data1[$x]."'");
													}
													/*변경된 부분 e*/
												}
											}
											
											// 재고에 다시 더한다.
											$sql =" update $IT_table set it_stock = it_stock + '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
											sql_query($sql);
										}
									}
									
									if ($state[$od] == '배송' || $state[$od] == '완료') {
										if ($ct[ct_stock_use] == 0) {
											$stock_use = 1;
											
											// 옵션재고에서 뺀다.
											if($ct[it_opt1] != ""){
												for($x=0; $x < count($re_it_op_data1); $x++){
													//sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
													/*변경된 부분 s*/
													if($re_it_op_data2[$x]){
														sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
													}else{
														sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$ct[ct_qty]} where itop_no='".$re_it_op_data1[$x]."'");
													}
													/*변경된 부분 e*/
												}
											}
											
											// 재고에서 뺀다.
											$sql =" update $IT_table set it_stock = it_stock - '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
											sql_query($sql);
										}

										if ($state[$od] == '완료' && $mb_id[$od] != "") { // 포인트적립
											if ($GnShop[point_chk]=="1" && $ct[ct_point_use] == 0) {
												$point_use = 1;
												################################################
												$sql="update {$MEM_table} set mem_point=mem_point+{$ct[ct_point]}, mshop_total=mshop_total+{$ct[ct_amount]}, mshop_count=mshop_count+{$ct[ct_qty]}  where mem_id='{$mb_id[$od]}' ";
												sql_query($sql);
												
												$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id[$od]}', '{$datetime}', '주문번호 {$row[od_id]} 상품:({$ct[it_name]}[상품번호:{$ct[it_id]}]) 구입적립', '{$ct[ct_point]}') ";
												sql_query($sql);
											}
										}
										################################################
									}
							
							
								// 히스토리에 남김
								// 히스토리에 남길때는 작업|시간|IP|그리고 나머지 자료
								$ct_history="\n{$state[$od]}|$isnow|$REMOTE_ADDR";
									
								$sql = " update $JO_table
											set ct_stock_use  = '$stock_use',
												ct_status     = '{$state[$od]}',
												ct_point_use     = '{$point_use}',
												ct_history    = CONCAT(ct_history,'$ct_history')
										  where on_uid = '$row[on_uid]'
											and ct_id  = '$ct[ct_id]' ";
								sql_query($sql);
			}
		}
	}

	// 회원정보를 업데이트합니다.
	put_totalorder($row[mb_id]);
	// 여기까지입니다.


	$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";
	$url = "./order_list.php?$qstr";
	goto_url($url);
} 
else {
	$cnt = count($_POST[ct_id]);

	for ($i=0; $i<$cnt; $i++) 
	{
		if ($_POST[ct_chk][$i]) 
		{
			$ct_id = $_POST[ct_id][$i];

			$sql = " select a.*, b.it_name from $JO_table a left join $IT_table b on(a.it_id=b.it_id)
					  where a.on_uid = '$on_uid'
						and a.ct_id  = '$ct_id' ";
			$ct = sql_fetch($sql);

			// 상품타입이 어떤건지 구분해 변수생성
			$get_it_opt_use = get_it_opt_use($ct[it_id]);
			
			// 조건 추가 ( 재고를 사용하는 다중옵션과 단일옵션에서만아래 변수를 사용한다.
			if($get_it_opt_use == "다중원가포함옵션" or $get_it_opt_use == "다중옵션" or $get_it_opt_use == "단일옵션") {
				$ex_it_op_data = explode(";",$ct[it_opt1]);
				$ex_it_op_data[0]; // 옵션넘버
				$re_it_op_data1 = explode("|",$ex_it_op_data[0]);
				$ex_it_op_data[1]; // 옵션구매수량
				$re_it_op_data2 = explode(",",$ex_it_op_data[1]);
			}

			$stock_use = $ct[ct_stock_use];
			$point_use = $ct[ct_point_use];
			
		
				if ($ct_status == '주문' || $ct_status == '취소' || $ct_status == '반품' || $ct_status == '품절') {
					// 재고에 다시 더한다.
						if ($ct[ct_stock_use]) {
							$stock_use = 0;
								
								// 다중,단일일때 옵션재고를 더한다
								if($ct[it_opt1] != ""){
									for($x=0; $x < count($re_it_op_data1); $x++){
										//단일 옵션 구입시 문제가 되어 추가했습니다. 단일 구입시 옵션 수량이 따라 오지 않으므로 옵션 수량이 아닌 구매한 제품수량으로 계산
											//sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
										/*변경된 부분 s*/
										if($re_it_op_data2[$x]){
											sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
										}else{
											sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$ct[ct_qty]} where itop_no='".$re_it_op_data1[$x]."'");
										}
										/*변경된 부분 e*/

									}
								}
								
								// 재고에 다시 더한다.
								$sql =" update $IT_table set it_stock = it_stock + '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
								sql_query($sql);	

						}
							
							//취소, 반품, 품절시 포인트 적립
							//취소시 구매할때 사용한 포인트는 수동으로 다시 지급해줘야한다
							if($mb_id != "" && $GnShop[point_chk]=="1"){
								if ( $ct[ct_point_use] == 1) {
									$point_use = 0;
									$sql="update {$MEM_table} set mem_point=mem_point-{$ct[ct_point]}, mshop_total=mshop_total-{$ct[ct_amount]}, mshop_count=mshop_count-{$ct[ct_qty]}  where mem_id='{$mb_id}' ";
									sql_query($sql);

									$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id}', '{$datetime}', '주문번호 {$od_id} 상품:({$ct[it_name]}[상품번호:{$ct[it_id]}]) {$ct_status}', '-{$ct[ct_point]}') ";
									sql_query($sql);
								}
							}
						}
				// 1.04.07
				// 재고 오류로 인한 수정
				// if ($ct_status == '주문' || $ct_status == '준비' || $ct_status == '배송' || $ct_status == '완료') {
				if ($ct_status == '배송' || $ct_status == '완료') {
					// 재고에서 뺀다.
					if ($ct[ct_stock_use] == 0) {
						$stock_use = 1;

						// 옵션재고에서 뺀다.
						if($ct[it_opt1] != ""){
							for($x=0; $x < count($re_it_op_data1); $x++){
								//단일 옵션 구입시 문제가 되어 추가했습니다. 단일 구입시 옵션 수량이 따라 오지 않으므로 옵션 수량이 아닌 구매한 제품수량으로 계산
								//sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
								/*변경부분 s*/
								if($re_it_op_data2[$x]){
									sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
								}else{
									sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock - {$ct[ct_qty]} where itop_no='".$re_it_op_data1[$x]."'");
								}
								/*변경부분 e*/
							}
						}
						
						// 재고에서 뺀다.
						$sql =" update $IT_table set it_stock = it_stock - '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
						sql_query($sql);
					}

					if ($ct_status == '완료' && $mb_id != "") { // 포인트	
						if ($GnShop[point_chk]=="1" && $ct[ct_point_use] == 0) {
							$point_use = 1;
							
							//포인트적립
							$sql="update {$MEM_table} set mem_point=mem_point+{$ct[ct_point]}, mshop_total=mshop_total+{$ct[ct_amount]}, mshop_count=mshop_count+{$ct[ct_qty]}  where mem_id='{$mb_id}' ";
							sql_query($sql);
							
							$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id}', '{$datetime}', '주문번호 {$od_id} 상품:({$ct[it_name]}[상품번호:{$ct[it_id]}]) 구입적립', '{$ct[ct_point]}') ";
							sql_query($sql);
						}
					}
				}

				// 히스토리에 남김
				// 히스토리에 남길때는 작업|시간|IP|그리고 나머지 자료
				$ct_history="\n$ct_status|$now|$REMOTE_ADDR";

				$sql = " update $JO_table
							set ct_stock_use  = '$stock_use',
								ct_status     = '$ct_status',
								ct_point_use     = '$point_use',
								ct_history    = CONCAT(ct_history,'$ct_history')
						  where on_uid = '$on_uid'
							and ct_id  = '$ct_id' ";
				sql_query($sql);
		}
	}
}

$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";
$url = "./order_view.php?od_id=$od_id&$qstr";

// 1.06.06
$od = sql_fetch(" select od_receipt_point from $PG_table where od_id = '$od_id' ");
				
goto_url($url);
?>
