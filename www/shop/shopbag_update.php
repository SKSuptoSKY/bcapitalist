<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

if($_POST[sw_direct]){  // 바로구매일때 세션을 다시 만든다 이유는 바로구매일때 장바구니 세션과 별개로 하기 위함

    session_register("ss_od_on_uid");
    $ss_od_on_uid = $_SESSION[ss_od_on_uid] = get_unique_id();
	if($_SESSION[ss_od_on_uid]) $new_ss_on_uid = $_SESSION[ss_od_on_uid];
}else{
	$new_ss_on_uid = $_SESSION[ss_on_uid];
}

// 브라우저에서 쿠키를 허용하지 않은 경우라고 볼 수 있음.
if (!$new_ss_on_uid) {
    alert("더 이상 작업을 진행할 수 없습니다.\\n\\n브라우저의 쿠키 허용을 사용하지 않음으로 설정한것 같습니다.\\n\\n브라우저의 인터넷 옵션에서 쿠키 허용을 사용으로 설정해 주십시오.\\n\\n그래도 진행이 되지 않는다면 쇼핑몰 운영자에게 문의 바랍니다.");
}


// 레벨(권한)이 상품구매 레벨보다 작다면 상품을 구입할 수 없음.
if ($_SESSION["userlevel"] < $default[de_level_sell]) {
    alert("상품을 구매할 수 있는 권한이 없습니다.");
}


if ($mode == "D") {    // 삭제이면

    $sql = " delete from {$GnTable[shopcart]}
              where ct_id = '$ct_id'
                and on_uid = '$new_ss_on_uid' ";
    sql_query($sql);
	// 추가입력폼 삭제
    $sql = " delete from {$GnTable[shopinput]}
              where u_cid = '$ct_id'
                and u_uid = '$new_ss_on_uid' ";
    sql_query($sql);
}else if($mode == "SC"){ // 취소라면
	$sql = " update {$GnTable[shopcart]} set ct_status='취소' where ct_id = '".$ct_id."' and on_uid = '".$on_uid."' ";
	sql_query($sql);

	$sql = " select a.*, b.it_name from {$GnTable[shopcart]} a left join {$GnTable[shopitem]} b on(a.it_id=b.it_id)
			  where a.on_uid = '".$on_uid."'
				and a.ct_id  = '".$ct_id."' ";
	$ct = sql_fetch($sql);		

		$ex_it_op_data = explode(";",$ct[it_opt1]);
		$ex_it_op_data[0]; // 옵션넘버
		$re_it_op_data1 = explode("|",$ex_it_op_data[0]);
		$ex_it_op_data[1]; // 옵션구매수량
		$re_it_op_data2 = explode(",",$ex_it_op_data[1]);

		$stock_use = $ct[ct_stock_use];
		$point_use = $ct[ct_point_use];

	// 옵션재고를 더한다
		if ($stock_use) {
			$stock_use = 0;

				// 옵션재고를 더한다
				if($ct[it_opt1] != ""){
					for($x=0; $x < count($re_it_op_data1); $x++){
						sql_query("update Gn_Shop_Add_option set itop_stock = itop_stock + {$re_it_op_data2[$x]} where itop_no='".$re_it_op_data1[$x]."'");
					}
				}
				
				// 재고에 다시 더한다.
				$sql =" update {$GnTable[shopitem]} set it_stock = it_stock + '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
				sql_query($sql);					

		}
		
		// 재고에 다시 더한다.
		$sql =" update {$GnTable[shopitem]} set it_stock = it_stock + '$ct[ct_qty]' where it_id = '$ct[it_id]' ";
		sql_query($sql);	
		
		if($_SESSION[userid] != "" && $point_use != 0){
			if ($GnShop[point_chk]=="1" && $ct[ct_point_use] == 0) {
				$point_use = 0;
				$sql="update $GnTable[member] set mem_point=mem_point-{$ct[ct_point]}, mshop_total=mshop_total-{$ct[ct_point]}, mshop_count=mshop_count-{$ct[ct_qty]}  where mem_id='{$mb_id}' ";
				sql_query($sql);

				$sql="insert into {$GnTable[shopcart]} (p_member, p_time, p_memo, p_point) values('{$_SESSION[userid]}', '{$datetime}', '주문번호 {$od_id} 상품:({$ct[it_name]}[상품번호:{$ct[it_id]}]) {$ct_status}', '-{$ct[ct_point]}') ";
				sql_query($sql);
			}
		}
		alert("취소가 완료되었습니다","/shop/myorder_view.php?od_id=".$od_id."&on_uid=".$on_uid.""); 
} else if ($mode == "AD") {   // 모두 삭제이면

    $sql = " delete from {$GnTable[shopcart]}
              where on_uid = '$new_ss_on_uid' ";
    sql_query($sql);

	// 추가입력폼 삭제
    $sql = " delete from {$GnTable[shopinput]}
              where u_uid = '$new_ss_on_uid' ";
    sql_query($sql);
} else if ($mode == "AE") { // 수량 변경이면 : 모두 수정이면

    $fldcnt = count($_POST[ct_id]);

    // 수량 변경, 재고등을 검사
    $error = "";
	for ($i=0; $i<$fldcnt; $i++) {

        // 재고 구함
        $stock_qty = get_it_op_stock_qty($_POST[it_opt1],$_POST[it_id][$i]);

        // 변경된 수량이 재고수량보다 크면 오류
        if ($_POST[ct_qty][$i] > $stock_qty)
            $error .= "{$_POST[it_name][$i]} 의 재고수량이 부족합니다. 현재 재고수량 : $stock_qty 개\\n\\n";
	}

    // 오류가 있다면 오류메세지 출력
    if ($error != "") { alert($error); }

	for ($i=0; $i<$fldcnt; $i++) {

		/*
		$pay = item_payresult($_POST[it_id][$i]); /// 제품가격을 불러옵니다.
		$present = item_presentresult($pay[pay]*$_POST[ct_qty][$i],"1",$_POST[it_id][$i]); // 증정품을 불러옵니다.
		$result_point = 0;

		$result_point = ($pay[pay] * $_POST[ct_qty][$i]) * 0.01 * $GnShop[point_use];

		if($default[use_point]){
			$result_point = (int)($result_point + $pay[point] * $_POST[ct_qty][$i]);
		}
		*/
		$ex_it_op_data = null;
		$result_point = null;
		$option_amount = null;
		$pay = item_payresult($_POST[it_id][$i]); /// 제품가격을 불러옵니다.
		$present = item_presentresult($pay[pay]*$_POST[ct_qty][$i],"1",$_POST[it_id][$i]); // 증정품을 불러옵니다.
		/*장바구니 수량 변경으로 인해 변화되야할 적립금 관련으로 옵션 가격을 설정 합니다*/

		$ex_it_op_data = explode(";",$_POST[it_opt1][$i]);
		if($ex_it_op_data[0] != null and $ex_it_op_data[1] == null){ //단일 구입 옵션이고 옵션이 존재 할때만 옵션 가격을 새로히 계산합니다

			$rows = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$ex_it_op_data[0]."'");
			$option_amount = $rows[itop_amount] * $_POST[ct_qty][$i];

		}
		$result_point = ($pay[pay] * $_POST[ct_qty][$i]  + $option_amount) * 0.01 * $GnShop[point_use];

		//$result_pay =  $pay[pay] * $_POST[ct_qty]  + $total_option_amount;
        $sql = " update {$GnTable[shopcart]}
                    set	ct_qty			= '{$_POST[ct_qty][$i]}',
						ct_amount    = '$pay[pay]',
						ct_paytype   = '$pay[type]',
						ct_point		= '$result_point',
						ct_present	 = '$present'
                  where ct_id  = '{$_POST[ct_id][$i]}'
                    and on_uid = '$new_ss_on_uid' ";
        sql_query($sql);
    }
} else if ($mode == "multi") { // 온라인견적(등)에서 여러개의 상품이 한꺼번에 들어옴.

    // 1.04.05
    // 보관함에서 금액이 제대로 반영되지 않던 오류를 수정
    $records = count($_POST[it_name]);
	// 재고등을 검사
    $error = "";
	for ($i=0; $i<$records; $i++) {
        if ($_POST[it_id][$i]) {
			// 이미 장바구니에 있는 같은 상품의 수량합계를 구한다.
			$sql = " select SUM(ct_qty) as cnt from {$GnTable[shopcart]} where it_id = '{$_POST[it_id][$i]}' and on_uid = '$new_ss_on_uid' ";
			$row = sql_fetch($sql);
			$sum_qty = $row[cnt];

			// 재고 구함
			$it_stock_qty = get_it_op_stock_qty($_POST[it_opt1],$_POST[it_id][$i]);

			if ($_POST[ct_qty][$i] + $sum_qty > $it_stock_qty) {
				$error .= "{$_POST[it_name][$i]} 의 재고수량이 부족합니다. 현재 재고수량 : $it_stock_qty\\n\\n";
			}
		}
    }

    // 오류가 있다면 오류메세지 출력
    if ($error != "") { alert($error); }

	for ($i=0; $i<$records; $i++) {
        if ($_POST[it_id][$i]) {

			// 포인트 사용하지 않는다면
			if (!$default[use_point]) $_POST[it_point][$i] = 0;

			$pay = item_payresult($_POST[it_id][$i]); /// 제품가격을 불러옵니다.
			$present = item_presentresult($pay[pay]*$_POST[ct_qty][$i],"1",$_POST[it_id][$i]); // 증정품을 불러옵니다.

			// 장바구니에 Insert
			$sql = " insert {$GnTable[shopcart]}
						set on_uid       = '$new_ss_on_uid',
							it_id        = '{$_POST[it_id][$i]}',
							ct_status    = '쇼핑',
							ct_amount    = '$pay[pay]',
							ct_paytype   = '$pay[type]',
							ct_present	 = '$present',
							ct_point     = '{$_POST[it_point][$i]}',
							ct_point_use = '0',
							ct_stock_use = '0',
							ct_qty       = '{$_POST[ct_qty][$i]}',
							ap_id        = '{$_POST[ap_id][$i]}',
							bi_id        = '{$_POST[bi_id][$i]}',
							ct_time      = '$datetime',
							ct_ip        = '$REMOTE_ADDR' ";

			if($_POST[ct_qty][$i]>0) { // 주문수량이 있을경우만 저장합니다.
				sql_query($sql);
			}
		}
    }
} else if ($mode == "LO") { // 로그인후 가격 수정

	$sql = " select *  from {$GnTable[shopcart]} where on_uid = '$new_ss_on_uid' ";
	$result = sql_query($sql);;

	for ($i=0; $row=mysql_fetch_array($result); $i++) {

		$pay = item_payresult($row[it_id]); /// 제품가격을 불러옵니다.
		$present = item_presentresult($pay[pay]*$row[ct_qty],"1",$row[it_id]); // 증정품을 불러옵니다.

        $sql = " update {$GnTable[shopcart]}
                    set	ct_amount    = '$pay[pay]',
						ct_paytype    = '$pay[type]',
						ct_present	 = '$present'
                  where ct_id  = '$row[ct_id]'
                    and on_uid = '$new_ss_on_uid' ";
        sql_query($sql);
    }
} else  {   // 장바구니에 담기

//print_r2($_POST[itop_no]);
//exit;
    if (!$_POST[it_id])
        alert("장바구니에 담을 상품을 선택하여 주십시오.");

    if ($_POST[ct_qty] < 1)
        alert("수량은 1 이상 입력해 주십시오.");

   //--------------------------------------------------------
    //  재고 검사
    //--------------------------------------------------------
    // 이미 장바구니에 있는 같은 상품의 수량합계를 구한다.
    $sql = " select SUM(ct_qty) as cnt from {$GnTable[shopcart]}
	            where it_id = '$_POST[it_id]'
				and op_name='$op_name'
                and on_uid = '$new_ss_on_uid' and it_opt1 = '$_POST[it_opt1]'";
    $row = sql_fetch($sql);
    $sum_qty = $row[cnt];


    // 포인트 사용하지 않는다면
    if (!$default[use_point]) $_POST[it_point] = 0;

	$pay = item_payresult($_POST[it_id]); /// 제품가격을 불러옵니다.
	$present = item_presentresult($pay[pay]*$_POST[ct_qty],"1",$_POST[it_id]); // 증정품을 불러옵니다.

    // 장바구니에 Insert

	//다중옵션s

	//다중옵션s

	if($wish_flag == "ok"){
		$ex_it_opt1 = explode(";",$_POST[it_opt1]);
		$_POST[itop_no] = explode("|",$ex_it_opt1[0]);
		$_POST[option_qty]= explode(",",$ex_it_opt1[1]);
	}
	
	//if ($it_opt_use=="2" and count($_POST[itop_no]) > 0) {

	/* ------------------------------------------------------------- [ 다중옵션일때 - START ] ------------------------------------------------------------- */
	if ($it_opt_use=="2") {
		
		// 선택한 옵션 갯수
		$op_select_count = count($_POST[option_qty]);

		if($op_select_count > 0){
			$Re_ct_qty = $_POST[ct_qty];
			$_POST[ct_qty] = "0";
		}
		
		$_POST[it_opt1] = "";

		for($i=0; $i < $op_select_count; $i++){
			if($_POST[it_opt1] == "") $_POST[it_opt1] = $_POST[itop_no][$i];
			else $_POST[it_opt1] = $_POST[it_opt1]."|".$_POST[itop_no][$i];

			// 재고 구함
		   $it_stock_qty = get_it_op_stock_qty($_POST[itop_no][$i],$_POST[it_id]);
			if ($ct_qty + $sum_qty > $it_stock_qty) {
				$row = sql_fetch("select itop_opt1 from Gn_Shop_Add_option where itop_no='".$_POST[itop_no][$i]."'");
			   alert("$it_name(".$row[itop_opt1].") 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
		  }
		}
		if($op_select_count > 0){  //추가
		$_POST[it_opt1] .=";";
		}
		for($i=0; $i < $op_select_count; $i++){
			if($i == 0) $_POST[it_opt1] .= $_POST[option_qty][$i];
			else $_POST[it_opt1] .= ",".$_POST[option_qty][$i];
			if($_POST[it_opt_use2] == "1") {
				$_POST[ct_qty] += $_POST[option_qty][$i];
			}else{
				$_POST[ct_qty] = $Re_ct_qty;
			}
		}

		// 새로운 옵션 형태 저장될 변수 만들기  -- 추가mj
		if( is_array($_POST[itop_no])==TRUE ) {
			$ct_option_no = implode(",",$_POST[itop_no]);
		}
		if( is_array($_POST[option_qty])==TRUE ) {
			$ct_option_qty = implode(",",$_POST[option_qty]);
		}
		
	}
	/* ------------------------------------------------------------- [ 단일옵션 일때는 옵션테이블에서 해당 옵션넘버의 재고를 신청수량과 비교한다.. - START ] ------------------------------------------------------------- */
	else if($it_opt_use=="1")
	{
		// 옵션을 고르지 않은 상태면 기존 재고로 판단한다.
		if( $_POST[it_opt1] == "" ) {
			$it_stock_qty = $_POST[it_stock];
		} else {
			// 재고 구하는 함수 추가 mj
			$it_stock_qty = get_it_op_stock_qty_danil_option($_POST[it_opt1]);
			if ($ct_qty > $it_stock_qty) {
			   alert("$it_name 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
			} else {
				// 변수 만들기
				//$_POST[it_opt1] =$_POST[it_opt1];
				//$_POST[it_opt1] .=";";
				//$_POST[it_opt1] .=$ct_qty;
			}
		}
		
		// 새로운 옵션 형태 저장될 변수 만들기  -- 추가mj
		if( is_array($_POST[opt_no_array])==TRUE ) {
			echo $ct_option_no = implode(",",$_POST[opt_no_array]);
		}
		if( is_array($_POST[opt_qty_array])==TRUE ) {
			echo $ct_option_qty = implode(",",$_POST[opt_qty_array]);
		}
		
	} 
	/* ------------------------------------------------------------- [ 옵션 미사용일때는 상품테이블에서 재고를 신청수량과 비교 한다. - START ] ------------------------------------------------------------- */
	else 
	{	
		$it_stock_qty = get_it_op_stock_qty_no_option($_POST[it_id]);
		if ($ct_qty > $it_stock_qty) {
		   alert("$it_name 의 재고수량이 부족합니다.\\n\\n현재 재고수량 : " . number_format($it_stock_qty) . " 개");
		}
	}


$total_option_amount = 0;

for($op=1;$op <= 6;$op++){
	$op_name = "it_opt".$op;
	if($_POST[$op_name]){
		$ex_it_opt = explode(";",$_POST[$op_name]);
		$ex_it_opt_num = explode("|",$ex_it_opt[0]);
		$ex_it_opt_qty = explode(",",$ex_it_opt[1]);
		if(strlen($_POST[$op_name])>0){
			for($a=0; $a < count($ex_it_opt_num); $a++){
				$rows = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$ex_it_opt_num[$a]."'");
				// 단일옵션인지 다중인지 구분하는것이 이부분 (단일이면 옵션수량이 없고 선택 수량이다)
				if(!$ex_it_opt_qty[$a])  $ex_it_opt_qty[$a] = $_POST[ct_qty];
				$rows[itop_amount] = $rows[itop_amount];
				//-------------------------------------   적립금과 옵션 + - 관련  ----------------------------------------
				//기존
				//if($rows[itop_amount] * $ex_it_opt_qty[$a] > 100) $option_amount1 += $rows[itop_amount] * $ex_it_opt_qty[$a];
				// 기존 소스 : 적립금이 무조건 + 조건으로 선택한 옵션가격이 총액에 더해진다. 
				// $result_point = ($pay[pay] * $_POST[ct_qty]  + $option_amount1) * 0.01 * $GnShop[point_use];
				// +냐 -냐를 옵션테이블에서 해당 옵션넘버로 가져와서 계산하게 수정해야한다.
				// 주의 : 해당 포인트가 소수점인경우 포인트가 저장되는 필드 타입을 기존 int 형식에서 float.로 변경해줘야 한다.
				// 2014.3.6 mj 수정	
				if($rows[itop_amount_op]=="+") {
					$option_amount += $rows[itop_amount] * $ex_it_opt_qty[$a];
				} else if($rows[itop_amount_op]=="-") {
					$option_amount -= $rows[itop_amount] * $ex_it_opt_qty[$a];
				}
				//echo $option_amount."<br>";
			}
		}
		$total_option_amount += $option_amount;
		$option_amount = 0;
	}
}

	$result_pay =  $pay[pay] * $_POST[ct_qty]  + $total_option_amount;
	$result_point = ($pay[pay] * $_POST[ct_qty]  + $total_option_amount) * 0.01 * $GnShop[point_use];

	if($_POST[wi_packing_pay] > 0) $ct_packing_pay = $_POST[wi_packing_pay];    

	 $sql = " insert {$GnTable[shopcart]}
                set on_uid       = '$new_ss_on_uid',
                    it_id        = '$_POST[it_id]',
					ct_option_no = '$ct_option_no',
					ct_option_qty = '$ct_option_qty',
                    it_opt1      = '$_POST[it_opt1]',
                    it_opt2      = '$_POST[it_opt2]',
                    it_opt3      = '$_POST[it_opt3]',
                    it_opt4      = '$_POST[it_opt4]',
                    it_opt5      = '$_POST[it_opt5]',
                    it_opt6      = '$_POST[it_opt6]',
                    ct_status    = '쇼핑',
                    ct_amount    = '$result_pay',
					ct_paytype   = '$pay[type]',
					ct_present	 = '$present',
                    ct_point     = '$result_point',
                    ct_point_use = '0',
                    ct_stock_use = '0',
                    ct_qty       = '$_POST[ct_qty]',
                    ct_time      = '$datetime',
                    ct_ip        = '$REMOTE_ADDR',
                    ap_id        = '$_POST[ap_id]',
                    op_name        = '$op_name',
                    bi_id        = '$_POST[bi_id]' 
                 ";

	if($_POST[ct_qty]>0) { // 주문수량이 있을경우만 저장합니다.
		sql_query($sql);
	}

	// 입력된 장바구니의 코드번호를 구한다
	$CID = mysql_insert_id();

	// 추가 입력 사항을 저장합니다.
	$u_subject = @implode("|",$u_subject);

	for($i=0; $i<15; $i++) {
		if ($_FILES["u_opt{$i}"][name])
		{
			$Upfile = explode(".",$_FILES["u_opt{$i}"][name]);
			$Upfile_total = count($Upfile) - 1;
			$Upfile_Rename = "[$CID]".$PC_member."_".$Upfile[0].".".$Upfile[$Upfile_total];
			$upfile = "u_opt".$i;
			$$upfile = $Upfile_Rename;

			upload_file($_FILES["u_opt{$i}"][tmp_name], $Upfile_Rename, $GnShop[data_dir]."/user/");
		}
	}

	$sql = " insert {$GnTable[shopinput]} set
				u_cid = '$CID',
				u_uid = '$new_ss_on_uid',
				u_subject = '$u_subject',
				u_opt0 = '$_POST[u_opt0]',
				u_opt1 = '$_POST[u_opt1]',
				u_opt2 = '$_POST[u_opt2]',
				u_opt3 = '$_POST[u_opt3]',
				u_opt4 = '$_POST[u_opt4]',
				u_opt5 = '$_POST[u_opt5]',
				u_opt6 = '$u_opt6',
				u_opt7 = '$u_opt7',
				u_opt8 = '$u_opt8',
				u_opt9 = '$u_opt9',
				u_opt10 = '$u_opt10',
				u_opt11 = '$_POST[u_opt11]',
				u_opt12 = '$_POST[u_opt12]',
				u_opt13 = '$_POST[u_opt13]',
				u_opt14 = '$_POST[u_opt14]',
				u_opt15 = '$_POST[u_opt15]' ";
   sql_query($sql);
}

// 바로 구매일 경우
if ($sw_direct) {
		goto_url("./order_form.php?tmp_on_uid=".$new_ss_on_uid."");
} else {
		goto_url("./shopbag.php");
}
?>
