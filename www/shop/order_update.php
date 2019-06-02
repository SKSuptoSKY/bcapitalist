<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/icode.sms.lib.php";

// 장바구니가 비어있는가?
if (get_cart_count($s_on_uid) == 0)// 장바구니에 담기
    alert("장바구니가 비어 있습니다.\\n\\n이미 주문하셨거나 장바구니에 담긴 상품이 없는 경우입니다.", "./shopbag.php");

$error = "";
// 장바구니 상품 재고 검사
// 1.03.07 : and a.it_id = b.it_id : where 조건문에 이 부분 추가
$sql = " select a.it_id,
                a.ct_qty,
				a.it_opt1,
                b.it_name,b.it_epay,b.it_pay
           from {$GnTable[shopcart]} a,
                {$GnTable[shopitem]} b
          where a.on_uid = '$s_on_uid'
            and a.it_id = b.it_id ";
$result = sql_query($sql);
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    // 상품에 대한 현재고수량
    $it_stock_qty = (int)get_it_op_stock_qty($row[it_opt1],$row[it_id]);
    // 장바구니 수량이 재고수량보다 많다면 오류
    if ($row[ct_qty] > $it_stock_qty) $error .= "$row[it_name] 의 재고수량이 부족합니다. 현재고수량 : $it_stock_qty 개\\n\\n";
    if (!$row[it_epay] && !$row[it_pay]) $error2 .= "$row[it_name] 의 가격이 0원이므로 구매하실 수 없습니다. \\n\\n";
}

if ($error != "") {
    $error .= "다른 고객님께서 {$od_name}님 보다 먼저 주문하신 경우입니다. 불편을 끼쳐 죄송합니다.";
    alert($error,"/shop/list.php");
}
if ($error2 != "") {
    alert($error2,"/shop/list.php");
}

// , 를 없애고
$od_receipt_bank = (float)str_replace(",", "", $od_receipt_bank);
$od_receipt_card = (float)str_replace(",", "", $od_receipt_card);
$od_receipt_point = (float)str_replace(",", "", $od_receipt_point);

//2009.7.7 Ki-hong Park [ 적립금 사용으로 금액이 불규칙 ]
if($od_receipt_bank > 0) $od_receipt_bank = $od_receipt_bank + $od_receipt_point;
if($od_receipt_card > 0) $od_receipt_card = $od_receipt_card + $od_receipt_point;

// 새로운 주문번호를 얻는다.
$od_id = get_new_od_id();

if($od_receipt_bank) $present = item_presentresult($od_receipt_bank,"0","");
if($od_receipt_card) $present = item_presentresult($od_receipt_card,"0","");

if($present[it_id]) {
	$present_allre = "$present[it_id],$present[pr_num],$present[odto_pay]";
}

// 주문서에 입력
$sql = " insert {$GnTable[shoporder]}
            set od_id             = '$od_id',
                on_uid            = '$s_on_uid',
                mb_id             = '$_SESSION[userid]',
                od_pwd            = '$od_pwd',
                od_name           = '$od_name',
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
                od_deposit_name   = '$od_deposit_name',
                od_memo           = '$od_memo',
                od_send_cost      = '$od_send_cost',
                od_temp_bank      = '$od_receipt_bank',
                od_temp_card      = '$od_receipt_card',
                od_receipt_bank   = '0',
                od_receipt_card   = '0',
                od_receipt_point  = '$od_receipt_point',
                od_bank_account   = '$od_bank_account',
                od_shop_memo      = '',
				od_present			= '$present_allre',
                od_hope_date      = '$od_hope_date',
                od_bill          = '$od_bill',
				od_billinfo      = '$od_bill_info',
                od_time           = '$datetime',
                od_ip             = '$REMOTE_ADDR',
				od_settle_case    = '$od_settle_case'
				";
sql_query($sql);


// 장바구니 쇼핑에서 주문으로
// 신용카드로 주문하면서 신용카드 포인트 사용하지 않는다면 포인트 부여하지 않음
$sql_card_point = "";
if ($od_receipt_card > 0 &&  $default[de_card_point] == false) {
    $sql_card_point = " , ct_point = '0' ";
}
$sql = "update {$GnTable[shopcart]}
           set ct_status = '주문'
               $sql_card_point
         where on_uid = '$s_on_uid' ";
sql_query($sql);


// 회원이면서 포인트를 사용했다면 포인트 테이블에 사용을 추가
if ($_SESSION[userid] && $od_receipt_point) {

	// 멤버 테이블에 총 포인트를 차감한다.
	$sql="update {$GnTable[member]} set mem_point=mem_point-{$od_receipt_point} where mem_id='{$_SESSION[userid]}' ";
	sql_query($sql);
	
	$sum_point = (-1) * $od_receipt_point;

	$sql="insert into $GnTable[point] (p_member, p_time, p_memo, p_point) values('".$_SESSION[userid]."', '".$datetime."', '주문번호 [".$od_id."] 구입차감', '".$sum_point."') ";
	sql_query($sql);

	insert_point($_SESSION[userid], (-1) * $od_receipt_point, "주문번호 $od_id 결제");	
}


$od_memo = nl2br(htmlspecialchars2(stripslashes($od_memo))) . "&nbsp;";

unset($list);

$ttotal_amount = 0;
$ttotal_point      = 0;

//==============================================================================
// 메일보내기
//------------------------------------------------------------------------------
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
//------------------------------------------------------------------------------

// 배송비가 있다면 총계에 더한다
if ($od_send_cost) $ttotal_amount = $ttotal_amount_item + $od_send_cost;
else  $ttotal_amount = $ttotal_amount_item;

/*/------------------------------------------------------------------------------
// 운영자에게 메일보내기
//------------------------------------------------------------------------------
$subject = "{$default[shop_name]}에서 주문이 들어 왔습니다. ($od_name)";
ob_start();
include $DOCUMENT_ROOT."$mail_skin/orderupdate1.skin.php";
$content = ob_get_contents();
ob_end_clean();

mailer($od_name, $od_email,$default[admin_email], $subject, $content, 1);
//echo "mailer($od_name, $od_email, $default[admin_email], $subject, $content, 1)";
//------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------
// 주문자에게 메일보내기
//------------------------------------------------------------------------------
$subject = "$od_name님 주문감사합니다 [{$GnShop[shop_name]}]";
ob_start();
include $_SERVER["DOCUMENT_ROOT"]."$mail_skin/orderupdate2.skin.php";
$content = ob_get_contents();
ob_end_clean();

/*
$GnShop[admin_email] = "gotg3663@naver.com";
$od_email = "jobang@naver.com";
$GnShop[shop_name] = "Gn쇼핑몰";
$subject = "Gn쇼핑몰 제목";
$content = "Gn쇼핑몰 내용";
*/

	if($default[email_flag] == "오픈컴"){
	  include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
	  $mail = new Smtp("121.78.91.210");
	  $mail->send($od_name."|".$od_email, $GnShop[shop_name]."|".$GnShop[admin_email], $subject, $content);	
	}else{
		mailer($GnShop[shop_name], $GnShop[admin_email], $Receiver, $subject, $content, 1);
	}

//mailer($GnShop[shop_name], $GnShop[admin_email], $od_email, $subject, $content, 1);
//echo "mailer($default[shop_name], $default[admin_email], $od_email, $subject, $content, 1)";
//==============================================================================


// order_confirm 에서 사용하기 위해 tmp에 넣고
session_register("ss_temp_on_uid");
$ss_temp_on_uid = $_SESSION[ss_temp_on_uid] = $s_on_uid;

// ss_on_uid 기존자료 세션에서 제거
session_unregister("ss_on_uid");

goto_url("./order_confirm.php");
?>
