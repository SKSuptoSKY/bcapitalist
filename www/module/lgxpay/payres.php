<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";
include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php"; 

/*
 * [최종결제요청 페이지(STEP2-2)]
 *
 * LG유플러스으로 부터 내려받은 LGD_PAYKEY(인증Key)를 가지고 최종 결제요청.(파라미터 전달시 POST를 사용하세요)
 */

$configPath = $_SERVER[DOCUMENT_ROOT]."/module/lgxpay/lgdacom";  //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf,/conf/mall.conf") 위치 지정. 

/*
 *************************************************
 * 1.최종결제 요청 - BEGIN
 *  (단, 최종 금액체크를 원하시는 경우 금액체크 부분 주석을 제거 하시면 됩니다.)
 *************************************************
 */
$CST_PLATFORM               = $HTTP_POST_VARS["CST_PLATFORM"];
$CST_MID                    = $HTTP_POST_VARS["CST_MID"];
$LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
$LGD_PAYKEY                 = $HTTP_POST_VARS["LGD_PAYKEY"];

require_once("./lgdacom/XPayClient.php");
$xpay = &new XPayClient($configPath, $CST_PLATFORM);
$xpay->Init_TX($LGD_MID);    

$xpay->Set("LGD_TXNAME", "PaymentByKey");
$xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);

//금액을 체크하시기 원하는 경우 아래 주석을 풀어서 이용하십시요.
//$DB_AMOUNT = "DB나 세션에서 가져온 금액"; //반드시 위변조가 불가능한 곳(DB나 세션)에서 금액을 가져오십시요.
//$xpay->Set("LGD_AMOUNTCHECKYN", "Y");
//$xpay->Set("LGD_AMOUNT", $DB_AMOUNT);
	
/*
 *************************************************
 * 1.최종결제 요청(수정하지 마세요) - END
 *************************************************
 */

/*
 * 2. 최종결제 요청 결과처리
 *
 * 최종 결제요청 결과 리턴 파라미터는 연동메뉴얼을 참고하시기 바랍니다.
 */
if ($xpay->TX()) 
{
	/* ------------------------------------------------------------- [ 리턴변수 정리 - START ] ------------------------------------------------------------- */
	$LGD_TID =  $xpay->Response("LGD_TID",0) ;									// 거래번호
	$LGD_MID =  $xpay->Response("LGD_MID",0) ;								// 상점아이디
	$LGD_OID =  $xpay->Response("LGD_OID",0) ;								// 상점주문번호
	$LGD_AMOUNT =  $xpay->Response("LGD_AMOUNT",0) ;					// 결제금액
	$LGD_RESPCODE =  $xpay->Response("LGD_RESPCODE",0) ;			// 결과코드
	$LGD_RESPMSG =  $xpay->Response("LGD_RESPMSG",0) ;				// 결과메세지
	
	// 추가
	$LGD_PAYER =	$xpay->Response('LGD_PAYER',0);						//	입금자
	$LGD_PAYTYPE	= $xpay->Response('LGD_PAYTYPE',0);					//	결제수단코드
	$LGD_FINANCECODE = $xpay->Response('LGD_FINANCECODE',0);	//	결제기관코드
	$LGD_FINANCENAME = $xpay->Response('LGD_FINANCENAME',0);		//	결제기관명
	$LGD_PAYDATE = $xpay->Response('LGD_PAYDATE',0);					//	결제일시
	$LGD_BUYEREMAIL = $xpay->Response('LGD_BUYEREMAIL',0);		//	구매자 이메일
	$LGD_BUYER	=	$xpay->Response('LGD_BUYER',0);						//	구매자명
	$LGD_PRODUCTINFO = $xpay->Response('LGD_PRODUCTINFO',0);	//	구매내역 (상품명)
	$LGD_ESCROWYN = $xpay->Response('LGD_ESCROWYN',0);			//	에스크로 최종 적용 여부
	$LGD_ACCOUNTNUM = $xpay->Response('LGD_ACCOUNTNUM',0);	//	가상계좌번호
	$LGD_CASSEQNO	=	$xpay->Response('LGD_CASSEQNO',0);		//	가상계좌일련번호
	/* ------------------------------------------------------------- [ 리턴변수 정리 - END ] ------------------------------------------------------------- */

	$keys = $xpay->Response_Names();
	foreach($keys as $name) {
		//echo $name . " = " . $xpay->Response($name, 0) . "<br>";
	}
	//echo "<p>";
	//$xpay->Response_Code();


	// 결제요청 성공일때 ---------------------------------------------------------------------------------------------------------------
	if( "0000" == $xpay->Response_Code() ) 
	{
		$isDBOK = true;	 //최종결제요청 결과 성공 DB처리 실패시 Rollback 처리

		if( !$isDBOK )		//DB처리 실패시 false로 변경해 주세요.
		{
			echo "<p>";
			$xpay->Rollback("상점 DB처리 실패로 인하여 Rollback 처리 [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
			echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br>";
			echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
				
			if( "0000" == $xpay->Response_Code() ) {
				echo "자동취소가 정상적으로 완료 되었습니다.<br>";
			}else{
				echo "자동취소가 정상적으로 처리되지 않았습니다.<br>";
			}
		}

		//---------------------------------------------------------[ 관리자 페이지에 결과 저장 쿼리 추가 ]-------------------------------------------	
		/* 
		$od_settle_case1 =$od_settle_case;	//		"신용카드" 라는 값이 넘어온다.	
		#####################################################################################################################
				결제 방식이 어떤건지 구분해서 관리자에 쌓아야 한다.
				수정이유 : 현재 이 페이지로는 무조건 $od_settle_case 의 값인 "신용카드" 가 넘어오는데 
				lg텔레콤모듈의 경우 신용카드 결제창에서 결제방식을 다시 선택하기 때문에 반환되는 값이 어떤거냐에 따라 결과를 처리해야한다.
		##################################################################################################################### */
		if($LGD_PAYTYPE == "SC0040")	//	무통장, 가상계좌의 코드 
		{
			$od_settle_case	=	"가상계좌";
			$cd_app_rt_flag	=	"입금대기";
		}
		if($LGD_PAYTYPE == "SC0010") 
		{
			$od_settle_case	=	"신용카드";
			$cd_app_rt_flag	=	"승인";
		}
		if($LGD_PAYTYPE == "SC0030") 
		{
			$od_settle_case	=	"계좌이체";
			$cd_app_rt_flag	=	"승인";
		}

		//최종결제요청 결과 성공 DB처리
		//---------------------------------------------------------[ 상점 관리자 페이지에 결과 저장 쿼리 추가 ]-------------------------------------------
		$od_receipt_point = (float)str_replace(",", "", $od_receipt_point);

		if($LGD_AMOUNT > 0) { 
			$od_temp_card = $LGD_AMOUNT + $od_receipt_point;
			$od_temp_bank = $LGD_AMOUNT + $od_receipt_point;
		}

		$sql = " insert {$GnTable[shoporder]}
		set od_id         = '$LGD_OID',
		od_mid			=	'$LGD_MID',
		on_uid            = '$s_on_uid',
		mb_id             = '$mem_id',
		od_pwd          = '$od_pwd',
		od_name        = '$od_name',
		od_email          = '$od_email',
		od_tel            = '$od_tel',
		od_hp             = '$od_hp',
		od_zip           = '$od_zip',
		od_zip1           = '$od_zip1',
		od_zip2           = '$od_zip2',
		od_addr1          = '$od_addr1',
		od_addr2          = '$od_addr2',
		od_b_name         = '$od_b_name',
		od_b_tel          = '$od_b_tel',
		od_b_hp           = '$od_b_hp',
		od_b_zip         = '$od_b_zip',
		od_b_zip1         = '$od_b_zip1',
		od_b_zip2         = '$od_b_zip2',
		od_b_addr1        = '$od_b_addr1',
		od_b_addr2        = '$od_b_addr2',
		od_deposit_name   = '$LGD_PAYER',
		od_memo           = '$od_memo',
		od_send_cost      = '$od_send_cost',
		od_receipt_point  = '$od_receipt_point',
		od_shop_memo      = '',
		od_present			= '$present_allre',
		od_hope_date      = '$od_hope_date',
		od_bill          = '$od_bill',
		od_billinfo      = '$od_bill_info',
		od_time           = '$datetime',
		od_ip             = '$REMOTE_ADDR' ";
		
		// 관리자에서 신용카드냐 가상계좌냐를 구분할때 해당필드에 값으로 구분
		if($od_settle_case=="신용카드") {
			$sql.= ", 
				od_card_time   = '$datetime',
				od_temp_bank		= '0',
				od_temp_card		= '$od_temp_card',
				od_receipt_bank	= '0',
				od_receipt_card	= '$LGD_AMOUNT',
				od_bank_account = '$od_settle_case',
				od_settle_case		= '$od_settle_case'
			";
		}
		if($od_settle_case=="가상계좌") {
			$sql.= " ,
				od_bank_time   = '$datetime',
				od_temp_bank		= '$od_temp_bank',
				od_temp_card		= '0',
				od_receipt_bank	= '0',
				od_receipt_card	= '0',
				od_bank_account = '$LGD_FINANCENAME $LGD_ACCOUNTNUM',
				od_settle_case = '가상계좌'
			";
		}
		if($od_settle_case=="계좌이체") {
			$sql.= ", 
				od_bank_time   = '$datetime',
				od_temp_bank		= '$od_temp_bank',
				od_temp_card		= '0',
				od_receipt_bank	= '$LGD_AMOUNT',
				od_receipt_card	= '0',
				od_bank_account = '$od_settle_case',
				od_settle_case		= '$od_settle_case'
			";
		} 
		sql_query($sql);
		
		//포인트 사용여부
		if($od_receipt_point>0){
			$plue_use = "1";
		}else{
			$plue_use = "0";
		}
	
		/* ------------------------------------------------------------- [ 장바구니 - START ] ------------------------------------------------------------- */
		if($od_settle_case=="신용카드" or $od_settle_case=="계좌이체") {
			$sql_ct_status	= "준비";
		}
		else if($od_settle_case=="가상계좌") {
			$sql_ct_status	= "주문";
		}

		$sql = "update {$GnTable[shopcart]} set 
					ct_status = '$sql_ct_status',
					ct_od_id = '$LGD_OID',
					ct_point_use = '$plue_use'
				where on_uid = '".$s_on_uid."' ";
		sql_query($sql);
		/* ------------------------------------------------------------- [ 장바구니 - END ] ------------------------------------------------------------- */

		// 회원이면서 포인트를 사용했다면 포인트 테이블에 사용을 추가
		if ($_SESSION[userid] && $od_receipt_point) {

			// 멤버 테이블에 총 포인트를 차감한다.
			$sql="update {$GnTable[member]} set mem_point=mem_point-{$od_receipt_point} where mem_id='{$_SESSION[userid]}' ";
			sql_query($sql);
			
			$sum_point = (-1) * $od_receipt_point;

			$sql="insert into $GnTable[point] (p_member, p_time, p_memo, p_point) values('".$_SESSION[userid]."', '".$datetime."', '주문번호 [".$LGD_OID."] 구입차감', '".$sum_point."') ";
			sql_query($sql);

			insert_point($_SESSION[userid], (-1) * $od_receipt_point, "주문번호 $LGD_OID 결제");	

		}
		
		// order_confirm 에서 사용하기 위해 tmp에 넣고
		session_register("ss_temp_on_uid");
		$ss_temp_on_uid = $_SESSION[ss_temp_on_uid] = $s_on_uid;
		
		session_unregister("ss_on_uid");		// ss_on_uid 기존자료 세션에서 제거(절대지우지말것)


		/* ------------------------------------------------------------- [ 구매내역 테이블에 저장 - START ] ------------------------------------------------------------- */
		$sql = " insert {$GnTable[shophistory]}
		   set od_id             = '".$xpay->Response('LGD_OID',0)."',
		   on_uid            = '".$s_on_uid."',
		   cd_mall_id            = '".$xpay->Response("LGD_MID",0)."',
		   cd_amount            = '".$xpay->Response('LGD_AMOUNT',0)."',
		   cd_app_no            = '".$xpay->Response('LGD_FINANCEAUTHNUM',0)."',
		   cd_app_rt            = '".$xpay->Response('LGD_RECEIVER',0)."',
		   cd_trade_ymd            = '".$xpay->Response('LGD_PAYDATE',0)."',
		   cd_opt01            = '".$cd_app_rt_flag."',
		   cd_time            = '".$datetime."',
		   cd_ip            = '".$REMOTE_ADDR."'
		   ";
		   sql_query($sql); 


		/* ------------------------------------------------------------- [ 메일보내기 관련 추가 - START ] ------------------------------------------------------------- */
		// 장바구니 가져오기
		$cart_view_sql = "SELECT * FROM {$GnTable[shopcart]} WHERE on_uid = '$s_on_uid' ORDER BY ct_id ASC";
		$cart_view_query = mysql_query($cart_view_sql);
		$cart_view_count = mysql_num_rows($cart_view_query);
		$cart_view_count_other = $cart_view_count - 1;
		for($z=0;$z<$cart_view_count;$z++) {
			$cart_view_rows[$z] = mysql_fetch_array($cart_view_query);
			$cart_view_rows[$z][it_name] = item_name($cart_view_rows[$z][it_id]);
		}
		
		// Loop 배열 자료를 만들고
				 $sql = " select b.it_sell_email,
						a.it_id,
						b.it_pay,
						b.it_epay,
						b.it_name,
						a.it_opt1,
						a.it_opt2,
						a.it_opt3,
						a.it_opt4,
						a.it_opt5,
						a.it_opt6,
						a.ct_qty,
						a.ct_amount,
						a.ct_paytype,
						a.ct_point,
						a.ct_present
				   from {$GnTable[shopcart]} a left join {$GnTable[shopitem]} b on (a.it_id = b.it_id)
				  where a.on_uid = '$s_on_uid'  ";
		$result = sql_query($sql);
		for ($i=0; $row=mysql_fetch_array($result); $i++)
		{
			$list[$i][g_dir] = $GnShop[shop_url];
			$list[$i][it_id]   = $row[it_id];

			//$list[$i][it_simg]=img_resize_tag2("/shop/data/item/{$row[it_id]}_s",$GnShop[simg_width],$GnShop[simg_width]);
			/* ------------------------------------------------------------- [ S 이미지 만들기 - START ] ------------------------------------------------------------- */
			$it_file_array = get_it_file_size_array( $row["it_id"], "1" );
			$row["s_img_1_src"] = $GnShop['data_url']."/".$row["it_id"]."/".$it_file_array[s];
			$row["s_img_1_resize"] = img_resize_tag2($row["s_img_1_src"],150,150," style='vertical-align:middle; cursor:pointer;' border='0'");
			$image = $row["s_img_1_resize"];
			/* ------------------------------------------------------------- [ S 이미지 만들기 - END ] ---------------------------------------------------------------- */
			$list[$i][it_simg]=$image;

			$list[$i][it_name]       = $row[it_name];
			$option_it_name= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);
						
			$ex_it_opt1 = explode(";",$row[it_opt1]);
			$ex_it_opt_num = explode("|",$ex_it_opt1[0]);
			$ex_it_opt_qty = explode(",",$ex_it_opt1[1]);
			if(strlen($row[it_opt1])>0){
				for($a=0; $a < count($ex_it_opt_num); $a++){
					$rows = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$ex_it_opt_num[$a]."'");
					if($rows[itop_amount] * $ex_it_opt_qty[$a] > 100) $option_amount += $rows[itop_amount] * $ex_it_opt_qty[$a];
				}
			}


			$option_amount_arr[$i]=$option_amount;
			$tot_option_amount+=$option_amount;

			$list[$i][it_opt] = $option_it_name;
			$list[$i][ct_qty]        = $row[ct_qty];
			$row[it_epay] = (($row[it_epay])>0)?$row[it_epay]:(($row[it_pay]>0)?$row[it_pay]:$row[it_epay]);
			$list[$i][ct_amount] = $row[it_epay];
			$list[$i][paytype]  = $default_paytype[$row[ct_paytype]];
			$list[$i][stotal_amount] = $list[$i][ct_amount] * $row[ct_qty] + $option_amount;
			$list[$i][stotal_point]  = $row[ct_point];

			if($row[ct_present]) {
				$present_i = explode("|", $row[ct_present]);

				for($p=0; $p<count($present_i); $p++) {
					$present_item = explode(",", $present_i[$p]);
					$sql_get = "select it_name from {$GnTable[shopitem]} where it_id = '{$present_item[0]}' ";
					$item_get = sql_fetch($sql_get);
					$present_item[it_name] = $item_get[it_name];



					$list[$i][present_item] .= "
					<tr>
						<td colspan=11 height=20 align=right>
							<table width='450' cellspacing='0' cellpadding='0' border=0>
								<tr>
									<td width='250'><font color='#9900FF'><b>{$list[$i][it_name]} ".number_format($present_item[2])."</font>원 이상 구매시 증정품</b></td>
									<td width='80' height='60' align=center><a href='./item.php?it_id=$present_item[0]'>".get_it_image($present_item[0]."_s", 50, 50)."</a></td>
									<td width='80'>$present_item[it_name]</td>
									<td width=40 align=center>$present_item[1]개</td>
								</tr>
							</table>
						</td>
					</tr>";
				}

			}
			$ttotal_amount_item += $list[$i][stotal_amount];
			$ttotal_point  += $list[$i][stotal_point];
			$option_amount="";
			$option_it_name = "";
		}
		mysql_free_result($result);
		
		$od_receipt_card = $LGD_AMOUNT;
		// 배송비가 있다면 총계에 더한다
		if ($od_send_cost) $ttotal_amount = $ttotal_amount_item + $od_send_cost;
		else  $ttotal_amount = $ttotal_amount_item;

		$subject = "$od_name님 주문감사합니다 [{$GnShop[shop_name]}]";
		ob_start();
		include $_SERVER["DOCUMENT_ROOT"]."$mail_skin/orderupdate3.skin.php";
		$content = ob_get_contents();
		ob_end_clean();
		
		/* ------------------------------------------------------------- [ 메일 보내기 관련 추가  - END ] ------------------------------------------------------------- */
		


		/* ------------------------------------------------------------- [ 결제 완료후 이동될 페이지 - START ] ------------------------------------------------------------- */
		if($cd_app_rt_flag == "승인")
		{
			################## [ 메일전송 - START ] ##################
			if($default[email_flag] == "오픈컴"){
			  include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
			  $mail = new Smtp("121.78.91.210");
			  $mail->send($od_name."|".$od_email, $GnShop[shop_name]."|".$GnShop[admin_email], $subject, $content);	
			}else{
				mailer($GnShop[shop_name], $GnShop[admin_email], $Receiver, $subject, $content, 1);
			}
			##################   [ 메일전송 - END ]  ##################

			$ok_msg = "결제가 완료되었습니다.";
			//$ok_url = "/shop/myorder_list.php";
			//$ok_url = "/shop/myorder_view.php?od_id=".$xpay->Response('LGD_OID',0)."&on_uid=".$s_on_uid."";
			$ok_url = $site_domain."/shop/order_confirm.php";
			alert($ok_msg, $ok_url);
		}
		else if($cd_app_rt_flag == "입금대기")	// 가상계좌일때
		{
			################## [ 메일전송 - START ] ##################
			if($default[email_flag] == "오픈컴"){
			  include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
			  $mail = new Smtp("121.78.91.210");
			  $mail->send($od_name."|".$od_email, $GnShop[shop_name]."|".$GnShop[admin_email], $subject, $content);	
			}else{
				mailer($GnShop[shop_name], $GnShop[admin_email], $Receiver, $subject, $content, 1);
			}
			##################   [ 메일전송 - END ]  ##################

			$ok_msg = "결제가 완료되었습니다.";
			//$ok_url = "/shop/myorder_view.php?od_id=".$xpay->Response('LGD_OID',0)."&on_uid=".$s_on_uid."";
			//include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/basic/order_complite_virtual.php";		//		가상계좌 스킨
			$ok_url = $site_domain."/shop/order_confirm.php";
			alert($ok_msg, $ok_url);
		}
		else
		{
			alert("결제실패", "/main.php");
		}
	}
	
	// 결제요청 실패일때 ---------------------------------------------------------------------------------------------------------------
	else
	{
		//최종결제요청 결과 실패 DB처리
		// $cd_app_rt_flag = "미승인";
		alert("최종결제요청 결과 실패");
		//alert("최종결제요청 결과 실패", "/main.php");
		//echo " DB처리하시기 바랍니다..<br>";
	}
}
// 결제 모듈 실행의 문제가 있을경우
else 
{
	//2)API 요청실패 화면처리
	echo "결제요청이 실패하였습니다.  <br>";
	echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
	echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
		
	//최종결제요청 결과 실패 DB처리
	echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.<br>";
}
?>
<?include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>
