<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];
$IT_table = $GnTable["shopitem"];
$SE_table = $GnTable["shopsell"];
$MEM_table = $GnTable["member"];
$PO_table=$GnTable["point"];



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

			if($row[od_temp_bank] > 0) $input_data = "od_bank_time = '$isnow' , od_receipt_bank = od_temp_bank ";
			else if($row[od_temp_card] > 0) $input_data = "od_card_time = '$isnow' ,od_receipt_card = od_temp_card ";
			else $input_data = " ";

			if ($state[$od] == '준비') {
				$sql =" update $PG_table set $input_data where od_id = '{$od_id[$od]}' ";
				sql_query($sql);
			}

			$sql = " select * from $JO_table
					    where on_uid = '$row[on_uid]' ";
			$result = sql_query($sql);

			for ($ctc=0; $ct=mysql_fetch_array($result); $ctc++) {
			
				$ex_it_opt = explode(";",$ct[it_opt1]);
				$it_op_data = mysql_fetch_array(mysql_query("select it_opt1 from $IT_table where it_id = '$ct[it_id]'"));
				 $ex_it_opt2 = explode("\n",$it_op_data[it_opt1]);
					for($l=0; $l < count($ex_it_opt2); $l++){
						 $ex_it_opt3 = explode(";",$ex_it_opt2[$l]);
						 if($ex_it_opt3[0] == $ex_it_opt[0]){
							$sum_qty = $ex_it_opt3[3]-$ct[ct_qty];
							$add_qty = $ex_it_opt3[3]+$ct[ct_qty];
							$re_it_op = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$ex_it_opt3[3];
							$re_it_op_sum = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$sum_qty;
							$re_it_op_add = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$add_qty;
							break;
						 }
					}

				if(!$ct[it_opt1]) { // 옵션제고가 아니라면 옵션 replace하지않고 전체 제고만 업데이트한다
					$re_it_op = "";
					$re_it_op_sum = "";
					$re_it_op_add = "";
				}
				// 재고를 이미 사용했다면 (재고에서 이미 뺐다면)
				$stock_use = $ct[ct_stock_use];
				if ($ct[ct_stock_use]) {
					if ($state[$od] == '주문' || $state[$od] == '취소' || $state[$od] == '반품' || $state[$od] == '품절') {
						$stock_use = 0;
						// 재고에 다시 더한다.
						$sql =" update $IT_table set it_stock = it_stock + '$ct[ct_qty]' , it_opt1 =REPLACE(it_opt1,'{$re_it_op}','{$re_it_op_add}') where it_id = '$ct[it_id]' ";
						sql_query($sql);
					}


					if ($state[$od] == '완료') { // 포인트		



					if ($GnShop[point_chk]=="1") {
												//포인트,구입수,구입총액업데이트
												$sql = "select * from $PG_table where on_uid = '$row[on_uid]' ";
												$row = sql_fetch($sql);
												if($row[od_temp_bank]=="0"){$price = $row[od_temp_card];}else{$price = $row[od_temp_bank];}


												if($price > "0"){

														$amount = $price - $row[od_receipt_point];
														if($row[od_send_cost] > "0"){
															$amount = $amount-$row[od_send_cost];
														}else{
															$amount = $amount;
														}

												}else{

														$amount = $price;
														if($row[od_send_cost] > "0"){
															$amount = $amount-$row[od_send_cost];
														}else{
															$amount = $amount;
														}
												}
									
										$point_end=round(($GnShop[point_use]*$amount)/100);

										$sql="update {$MEM_table} set mem_point=mem_point+{$point_end}, mshop_total=mshop_total+{$amount}, mshop_count=mshop_count+{$ct[ct_qty]}  where mem_id='{$row[mb_id]}' ";
										sql_query($sql);
										$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$row[mb_id]}', '{$datetime}', '주문번호 {$row[od_id]} 구입', '{$point_end}') ";
										sql_query($sql);
					}

									//상품판매기록에 남김
									$sql="select count(*) as cnt from {$SE_table} where se_it_id='{$ct[it_id]}' ";
									$row_se=sql_fetch($sql);
									if ($row_se[cnt]>0) {
										$sql="update {$SE_table} set se_total_num=se_total_num+{$ct[ct_qty]}, se_total_amount=se_total_amount+{$ct[ct_amount]},se_wdate='{$datetime}' where se_it_id='{$ct[it_id]}'";
									}
									else {
										$sql="insert into {$SE_table} (se_it_id,se_total_amount,se_total_num,se_wdate) values('{$ct[it_id]}','{$ct[ct_amount]}','{$ct[ct_qty]}','{$datetime}') ";
									}



							sql_query($sql);
						//}
					}



				} 
				else {
					if ($state[$od] == '배송' || $state[$od] == '완료') {
						$stock_use = 1;
						// 재고에서 뺀다.
						$sql =" update $IT_table set it_stock = it_stock - '$ct[ct_qty]' , it_opt1 =REPLACE(it_opt1,'{$re_it_op}','{$re_it_op_sum}') where it_id = '$ct[it_id]' ";
						sql_query($sql);
					}
				}
				
				// 히스토리에 남길때는 작업|시간|IP|그리고 나머지 자료
				$ct_history="\n{$state[$od]}|$isnow|$REMOTE_ADDR";

				$sql = " update $JO_table
							set ct_stock_use  = '$stock_use',
							ct_status     = '{$state[$od]}',
							ct_history    = CONCAT(ct_history,'$ct_history')
							where on_uid = '$row[on_uid]'
							and ct_id  = '$ct[ct_id]' ";
				sql_query($sql);

				//문자전송(sms회사에 맞게 추후 수정)
				if ($state[$od]) {
					if ($state[$od]=="주문") $sms_content=$GnShop[sms_text1];
					if ($state[$od]=="준비") $sms_content=$GnShop[sms_text2];
					if ($state[$od]=="배송") $sms_content=$GnShop[sms_text3];
					if ($state[$od]=="완료") $sms_content=$GnShop[sms_text4];
					if ($state[$od]=="취소") $sms_content=$GnShop[sms_text5];
					if ($state[$od]=="반품") $sms_content=$GnShop[sms_text6];
					if ($state[$od]=="품절") $sms_content=$GnShop[sms_text7];
				}
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
	for ($i=0; $i<$cnt; $i++) {
		if ($_POST[ct_chk][$i]) {
			$ct_id = $_POST[ct_id][$i];


			$sql = " select * from $JO_table
					  where on_uid = '$on_uid'
						and ct_id  = '$ct_id' ";
			$ct = sql_fetch($sql);

				$ex_it_opt = explode(";",$ct[it_opt1]);
				$it_op_data = mysql_fetch_array(mysql_query("select it_opt1 from $IT_table where it_id = '$ct[it_id]'"));
				 $ex_it_opt2 = explode("\n",$it_op_data[it_opt1]);
					for($l=0; $l < count($ex_it_opt2); $l++){
						 $ex_it_opt3 = explode(";",$ex_it_opt2[$l]);
						 if($ex_it_opt3[0] == $ex_it_opt[0]){
							$sum_qty = $ex_it_opt3[3]-$ct[ct_qty];
							$add_qty = $ex_it_opt3[3]+$ct[ct_qty];
							$re_it_op = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$ex_it_opt3[3];
							$re_it_op_sum = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$sum_qty;
							$re_it_op_add = $ex_it_opt3[0].";".$ex_it_opt3[1].";".$ex_it_opt3[2].";".$add_qty;
							break;
						 }
					}
				if(!$ct[it_opt1]) { // 옵션제고가 아니라면 옵션 replace하지않고 전체 제고만 업데이트한다
					$re_it_op = "";
					$re_it_op_sum = "";
					$re_it_op_add = "";
				}
			// 재고를 이미 사용했다면 (재고에서 이미 뺐다면)
			$stock_use = $ct[ct_stock_use];
			if ($ct[ct_stock_use]) {
				if ($ct_status == '주문' || $ct_status == '취소' || $ct_status == '반품' || $ct_status == '품절') {
					$stock_use = 0;
					// 재고에 다시 더한다.
					$sql =" update $IT_table set it_stock = it_stock + '$ct[ct_qty]' , it_opt1 =REPLACE(it_opt1,'{$re_it_op}','{$re_it_op_add}') where it_id = '$ct[it_id]' ";
						sql_query($sql);


							//취소, 반품, 품절시 포인트 적립
							$sql = "select * from $PG_table where on_uid = '$_POST[on_uid]' ";
							$row = sql_fetch($sql);
							if($row[od_temp_bank]=="0"){$price = $row[od_temp_card];}else{$price = $row[od_temp_bank];}

										if($price > "0"){
												$amount = $price - $row[od_receipt_point];

												if($GnShop[trans_all] > $amount){
													$amount = $amount-$GnShop[trans_pay];
												}else{
													$amount = $amount;
												}

										}else{

												$amount = $price;

												if($GnShop[trans_all] > $amount){
													$amount = $amount-$GnShop[trans_pay];
												}else{
													$amount = $amount;
												}

										}
							$point_end=round(($GnShop[point_use]*$amount)/100);

							$sql="update {$MEM_table} set mem_point=mem_point+{$row[od_receipt_point]}-{$point_end}, mshop_total=mshop_total-{$amount}, mshop_count=mshop_count-{$ct[ct_qty]}  where mem_id='{$mb_id}' ";
							sql_query($sql);

							if($row[od_receipt_point]=="0"){}else{
								$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id}', '{$datetime}', '주문번호 {$row[od_id]} {$ct_status}', '{$row[od_receipt_point]}') ";
								sql_query($sql);
							}

							$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id}', '{$datetime}', '주문번호 {$row[od_id]} {$ct_status}', '-{$point_end}') ";
							sql_query($sql);



				}
			} 
			else {
				// 1.04.07
				// 재고 오류로 인한 수정
				// if ($ct_status == '주문' || $ct_status == '준비' || $ct_status == '배송' || $ct_status == '완료') {
				if ($ct_status == '배송' || $ct_status == '완료') {
					$stock_use = 1;
					// 재고에서 뺀다.

					$sql =" update $IT_table set it_stock = it_stock - '$ct[ct_qty]' , it_opt1 =REPLACE(it_opt1,'{$re_it_op}','{$re_it_op_sum}') where it_id = '$ct[it_id]' ";
						sql_query($sql);

					if ($ct_status == '완료') { // 포인트										
						if ($GnShop[point_chk]=="1") {


												//포인트,구입수,구입총액업데이트
												$sql = "select * from $PG_table where on_uid = '$_POST[on_uid]' ";
												$row = sql_fetch($sql);
												if($row[od_temp_bank]=="0"){
													$price = $row[od_temp_card];
												}else{
													$price = $row[od_temp_bank];
												}

												if($price > "0"){

														$amount = $price - $row[od_receipt_point];

														if($GnShop[trans_all] > $amount){
															$amount = $amount-$GnShop[trans_pay];
														}else{
															$amount = $amount;
														}

												}else{

														$amount = $price;

														if($GnShop[trans_all] > $amount){
															$amount = $amount-$GnShop[trans_pay];
														}else{
															$amount = $amount;
														}

												}
									
										$point_end=round(($GnShop[point_use]*$amount)/100);

										$sql="update {$MEM_table} set mem_point=mem_point+{$point_end}, mshop_total=mshop_total+{$amount}, mshop_count=mshop_count+{$ct[ct_qty]}  where mem_id='{$mb_id}' ";
										sql_query($sql);
										$sql="insert into {$PO_table} (p_member, p_time, p_memo, p_point) values('{$mb_id}', '{$datetime}', '주문번호 {$row[od_id]} 구입', '{$point_end}') ";
										sql_query($sql);
						}


									//상품판매기록에 남김
									$sql="select count(*) as cnt from {$SE_table} where se_it_id='{$ct[it_id]}' ";
									$row_se=sql_fetch($sql);
									if ($row_se[cnt]>0) {
										$sql="update {$SE_table} set se_total_num=se_total_num+{$ct[ct_qty]}, se_total_amount=se_total_amount+{$ct[ct_amount]},se_wdate='{$datetime}' where se_it_id='{$ct[it_id]}'";
									}
									else {
										$sql="insert into {$SE_table} (se_it_id,se_total_amount,se_total_num,se_wdate) values('{$ct[it_id]}','{$ct[ct_amount]}','{$ct[ct_qty]}','{$datetime}') ";
									}



							sql_query($sql);
					}
				}
			}

			// 히스토리에 남길때는 작업|시간|IP|그리고 나머지 자료
			$ct_history="\n$ct_status|$now|$REMOTE_ADDR";

			$sql = " update $JO_table
						set ct_stock_use  = '$stock_use',
							ct_status     = '$ct_status',
							ct_history    = CONCAT(ct_history,'$ct_history')
					  where on_uid = '$on_uid'
						and ct_id  = '$ct_id' ";
			sql_query($sql);
			
			//문자전송(sms회사에 맞게 추후 수정)
			if ($ct_status) {
				if ($ct_status=="주문") $sms_content=$GnShop[sms_text1];
				if ($ct_status=="준비") $sms_content=$GnShop[sms_text2];
				if ($ct_status=="배송") $sms_content=$GnShop[sms_text3];
				if ($ct_status=="완료") $sms_content=$GnShop[sms_text4];
				if ($ct_status=="취소") $sms_content=$GnShop[sms_text5];
				if ($ct_status=="반품") $sms_content=$GnShop[sms_text6];
				if ($ct_status=="품절") $sms_content=$GnShop[sms_text7];
			}
		}
	}
}

$qstr = "sort1=$sort1&sort2=$sort2&sel_field=$sel_field&search=$search&page=$page";

$url = "./order_view.php?od_id=$od_id&$qstr";

// 1.06.06
$od = sql_fetch(" select od_receipt_point from $PG_table where od_id = '$od_id' ");
				
goto_url($url);
?>
