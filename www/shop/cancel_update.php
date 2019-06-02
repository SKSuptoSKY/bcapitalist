<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

		//포인트로 구매했을시 다시 포인트를 되돌려준다
		$sql = "select * from Gn_Shop_Order where od_id='".$od_id."'";
		$row = sql_fetch($sql);
		
		if($row[mb_id] != ""){ //회원이라면..
			if($row[od_receipt_point] > 0){ // 포인트로 구매했다면..
				
				$sum_point =  $row[od_receipt_point];

				//포인트 내용 기록
				$sql="insert into $GnTable[point] (p_member, p_time, p_memo, p_point) values('".$row[mb_id]."', '".$datetime."', '주문번호 [".$od_id."] 주문시 포인트결제 - 입금전 취소로 인한 포인트 반환', '".$sum_point."') ";
				sql_query($sql);

				//멤법정보 변경 (전체포인트 계산)
				$sql="update $GnTable[member] set mem_point=mem_point+{$sum_point}, mshop_total=mshop_total-{$sum_point}  where mem_id='".$row[mb_id]."' ";
				sql_query($sql);

			}
		}

		//포인트 반환내역도 설정 - ct_point_use2 = 1로 설정  0일때만 반환됨 반환했기때문에 1로 설정)
		$sql = " update {$GnTable[shopcart]} set ct_status='취소',ct_point_use2 = '1' where on_uid = '".$on_uid."' ";
		sql_query($sql);
		sql_query("update Gn_Shop_Order set od_cancel_flag='1' where od_id='".$od_id."'");

		alert("취소가 완료되었습니다","/shop/myorder_view.php?od_id=".$od_id."&on_uid=".$on_uid."");
?>