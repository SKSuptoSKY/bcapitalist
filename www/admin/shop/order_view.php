<?
$page_loc="order";
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shoporder"];
$JO_table = $GnTable["shopcart"];

// 주문서
$sql = " select * from $PG_table where od_id = '$od_id' ";
$result = sql_query($sql);
$od = mysql_fetch_array($result);
mysql_free_result($result);

$sql = " select a.*,
                b.it_name,
				b.it_pay,
				b.it_epay
           from $JO_table a, {$GnTable[shopitem]} b
          where a.on_uid = '$od[on_uid]'
            and a.it_id  = b.it_id
          order by a.ct_id ";
$result = sql_query($sql);


?>
<script language=javascript src="/admin/shop/lib/javascript.js"></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 주문내역보기</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>주문상품</b></td>
        <td align=right>
        <? if ($default[de_hope_date_use]) { ?>
            희망배송일은
            <b><?=$od[od_hope_date]?> (<?=get_yoil($od[od_hope_date])?>)</b> 입니다.
        <? } ?>
        </td>
    </tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=frmorderform method=post action=''>
<colgroup width=50></colgroup>
<colgroup width=''></colgroup>
<colgroup width=40></colgroup>
<colgroup width=50></colgroup>
<colgroup width=70></colgroup>
<colgroup width=70></colgroup>
<colgroup width=50></colgroup>
<colgroup width=50></colgroup>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width="50">
						<input type=hidden name=ct_status value=''>
						<input type=hidden name=on_uid    value='<? echo $od[on_uid] ?>'>
						<input type=hidden name=od_id     value='<? echo $od_id ?>'>
						<input type=hidden name=mb_id     value='<? echo $od[mb_id] ?>'>
						<input type=hidden name=od_email  value='<? echo $od[od_email] ?>'>
						<input type=hidden name=sort1 value="<? echo $sort1 ?>">
						<input type=hidden name=sort2 value="<? echo $sort2 ?>">
						<input type=hidden name=sel_field  value="<? echo $sel_field ?>">
						<input type=hidden name=search     value="<? echo $search ?>">
						<input type=hidden name=page       value="<? echo $page ?>">
						전체<br><input type=checkbox onclick='select_all();'></td>
					<td>상품명</td>
					<td width="100">상태</td>
					<td width="80">판매가</td>
					<td width="80">수량</td>
					<td width="80">소계</td>
					<td width="80">적립포인트</td>
					<!-- <td width="70">재고 반영</td>
					<td width="70">포인트 반영</td> -->
					<!-- <td width="100">추가 입력사항</td> -->
				</tr>
			<?
			for ($i=0; $row=mysql_fetch_array($result); $i++){
				$it_name = "<a href='/shop/item.php?it_id=$row[it_id]'>".stripslashes($row[it_name])."</a><br>";
				$it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);

				// 적립금계산
				$ct_point[소계] = $row[ct_point];

				// 판매가 계산
				if($row[it_epay] > 0) {
					$row[realpay] = $row[it_epay];
				} else {
					$row[realpay] = $row[it_pay];
				}

				if ($row[ct_status]=='주문' || $row[ct_status]=='준비' || $row[ct_status]=='배송' || $row[ct_status]=='완료')
					$t_ct_amount[정상] += $row[ct_amount];

				else if ($row[ct_status]=='취소' || $row[ct_status]=='반품' || $row[ct_status]=='품절')
					//$t_ct_amount[취소] +=  ($od['od_temp_bank']+$od['od_temp_card']);
					// 취소금액 만들기 : 기존변수 덮어씀 (mj)
					$t_ct_amount[취소] = get_state_amount($row[on_uid], "취소");

					/* ------------------------------------------------------------- [ S 이미지 만들기 - START ] ------------------------------------------------------------- */
					$it_file_array = get_it_file_size_array( $row["it_id"], "1" );
					$row["s_img_1_src"] = $GnShop['data_url']."/".$row["it_id"]."/".$it_file_array[s];
					$row["s_img_1_resize"] = img_resize_tag($row["s_img_1_src"],70,70," style='vertical-align:middle; cursor:pointer;' border='0'");
					$image = $row["s_img_1_resize"];
					/* ------------------------------------------------------------- [ S 이미지 만들기 - END ] ---------------------------------------------------------------- */
				?>
				<tr bgcolor='#FFFFFF'>
					<td align=center title='<?=$row[ct_id]?>'><input type=hidden name=ct_id[<?=$i?>] value='<?=$row[ct_id]?>'><input type=checkbox name=ct_chk[<?=$i?>] value='1'></td>
					<td><table width='100%'><tr><td width=40 align=center>
						<table width='80' height='80' border='1' cellpadding='0' cellspacing='0' bordercolor='#eeeeee' style='border-collapse:collapse;'>
							<tr>
								<td align='center' valign='middle'><?=$image?></td>
							</tr>
						</table>					
					</td><td><?=$it_name?></td></tr></table></td>
					<td align=center><?=$row[ct_status]?></td>
					<td align=center><?=$row[realpay]?></td>
					<td align=center><?=$row[ct_qty]?></td>
					<td align=center><?=number_format($row[ct_amount])?></td>
					<td align=center><?=number_format($row[ct_point])?></td>
				</tr>
				<?
				//2009.7.3 부가세로 인해서 수정함
				//$t_ct_amount[합계] += $ct_amount[소계];
				$t_ct_point[합계] += $ct_point[소계];
			}
			//2009.7.3 부가세로 인해서 수정 함
			$t_ct_amount[합계] = ($od['od_temp_bank']+$od['od_temp_card']);

			mysql_free_result($result);
			?>
			</table>
			<table width="99%" border="0" cellpadding="3" cellspacing="1" align="center">
				<tr bgcolor="#ffffff">
					<td colspan=4><font color=red>상태변경 : </font>&nbsp;&nbsp;&nbsp;
						<a href="javascript:form_submit('주문')">주문</a>
						|
						<a href="javascript:form_submit('준비')">상품준비중</a>
						|
						<a href="javascript:form_submit('배송')">배송중</a>
						|
						<a href="javascript:form_submit('완료')">완료</a>
						|
						<a href="javascript:form_submit('취소')">취소</a>
						<!-- |
						<a href="javascript:form_submit('반품')">반품</a>
						|
						<a href="javascript:form_submit('품절')">품절</a> -->
					</td>
					<td colspan=3 align=right>
						<input type=hidden name="chk_cnt" value="<? echo $i ?>">
						<b>주문합계 : <? echo number_format($t_ct_amount[합계]-$od[od_send_cost]); ?>원</B>
						<input type=hidden name="mone_all" value="<?=$t_ct_amount[합계]-$od[od_send_cost];?>"> 

					</td>
				</tr>
			</table>
		</td>
	</tr>
</form>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>주문결제</b></td>
    </tr>
</table>


<?
################## [ 기존 코드 - START ] ##################
// 주문금액 = 상품구입금액 + 배송비
$amount[정상] = $t_ct_amount[합계];
// 입금액 = 무통장 + 신용카드 + 포인트
$amount[입금] = $od[od_receipt_bank] + $od[od_receipt_card] + $od[od_receipt_point];
// 미수금 = (주문금액 - DC + 환불액) - (입금액 - 신용카드승인취소)
$amount[미수] = ($amount[정상] - $od[od_dc_amount] + $od[od_refund_amount]) - ($amount[입금] - $od[od_cancel_card]);

$s_plus;
if ($od[od_settle_case] == "무통장")
{
    $s_receipt_way = "무통장";
    $s_plus = "+";
}

if ($od[od_settle_case] == "가상계좌")
{
    $s_receipt_way = "가상계좌";
    $s_plus = "+";
}

if ($od[od_settle_case] == "계좌이체")
{
    $s_receipt_way = "계좌이체";
    $s_plus = "+";
}

##################   [ 기존 코드  - END ]  ##################

if ($od[od_settle_case] == "신용카드")
{
    // 미수금이 없고 카드 결제를 하지 않았다면 카드결제를 선택후 무통장 입금한 경우임
    if ($amount[미수] <= 0 && $od[od_receipt_card] == 0)
        ; // 화면 출력하지 않음
    else
    {
        $s_receipt_way .= $s_plus . "신용카드";
        $s_plus = "+";
    }
}
if ($od[od_receipt_point] > 0)
    $s_receipt_way .= $s_plus . "포인트";
?>


<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
	<tr align="center" bgcolor="#F6F6F6">
		<td>주문번호</td>
		<td>결제방법</td>
		<td>포인트 결제액</td>
		<td>배송비</td>
		<td>주문총액</td>
		<td>실 결제금액</td>
		<td>총 결제액(포인트포함)</td>
		<td>주문취소</td>
		<td>현금영수증</td>
	</tr>
	<tr align="center" bgcolor="#FFFFFF">
		<td><? echo $od[od_id] ?></td>
		<td><? echo $s_receipt_way ?></td>
		<td><?=$od[od_receipt_point]?></td>
		<td><? echo number_format($od[od_send_cost]) ?>원</td>
		<td><? echo display_amount($amount[정상] - $od[od_send_cost]) ?></td>
		<td>
			<?
			if($od[od_settle_case]=="신용카드" || $od[od_settle_case]=="계좌이체") {
				echo number_format($od[od_receipt_card]);
			} else {
				//무통장,가상계좌,계좌이체
				echo number_format($od[od_receipt_bank]);
			}
			?>
		</td>
		<td><? echo number_format($amount[입금]); ?>원</td>
		<td><? echo number_format($t_ct_amount[취소]) ?>원</td>
		<td>
			<?
			if($od[od_bill]=="1") 
			{ 
				// 이니시스 현금영수증 관련
				if($GnShop["pg_module"]=="INICIS") 
				{
					// 이니시스는 현금영수증 번호가 전달되지 않기때문에 용도만 표시해줌
					?>용도:<?=$od[od_billinfo]?><? 
				}
				else
				{
					if($od[od_billcode]=="0") 
					{ 
						?><span style='color:#ff0000;'>발행신청</span><br>승인번호: 승인대기중<? 
					}
					else 
					{ 
						?><span style='color:blue;'>발행완료</span><br>승인번호: <?=$od[od_billcode]?><? 
					}
				}
			}
			else 
			{
				?>미발행<? 
			} 
			?>
		</td>
	</tr>
</table>
<table width="99%" border="0" cellpadding="3" cellspacing="1" align="center">
	<tr bgcolor="#FFFFFF">
		<td colspan=8 align=right><b><font color=#FF6600><b>미수금 : <? echo display_amount($amount[미수]) ?></b></font></b></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>결제상세정보</b></td>
    </tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td valign=top align=left>
        <?
        // 은행계좌를 배열로 만든후
        $str = explode("\n", $default[bankinfo]);
        $bank_account = "\n<select name=od_bank_account>\n";
        $bank_account .= "<option value=''>------------ 선택하십시오 ------------\n";
		$bank_account .= Shop_BankList();

		if(!$select && $od[od_bank_account]=='계좌이체') $select = "selected"; else $select = "";
        $bank_account .= "<option value='계좌이체' $select>계좌이체 \n";

		if(!$select && $od[od_bank_account]=='신용카드') $select = "selected"; else $select = "";
		$bank_account .= "<option value='신용카드'  $select>신용카드 \n";
        $bank_account .= "</select> ";
        ?>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
        <form name=frmorderreceiptform method=post action="./order_receiptup.php" autocomplete=off>

        <input type=hidden name=od_id     value="<?=$od_id?>">
        <input type=hidden name=sort1     value="<?=$sort1?>">
        <input type=hidden name=sort2     value="<?=$sort2?>">
        <input type=hidden name=sel_field value="<?=$sel_field?>">
        <input type=hidden name=search    value="<?=$search?>">
        <input type=hidden name=page      value="<?=$page?>">
        <input type=hidden name=od_name   value="<?=$od[od_name]?>">
        <input type=hidden name=od_email   value="<?=$od[od_email]?>">
		<input type=hidden name=mb_id   value="<?=$od[mb_id]?>">
        <input type=hidden name=od_hp     value="<?=$od[od_hp]?>">
		<input type=hidden name=od_bank_account value="<?=$od[od_bank_account]?>">

        <colgroup width=110 class=tdsl></colgroup>
        <colgroup width='' bgcolor=#ffffff></colgroup>
        
		
		
		<?if($od[od_settle_case]=="무통장"){?>
		<tr height=29>
            <td bgcolor="#F6F6F6">계좌번호</td>
            <td><?=$od[od_bank_account]?></td>
        </tr>
        <script> document.frmorderreceiptform.od_bank_account.value = '<? echo str_replace("\r", "", $od[od_bank_account]) ?>'; </script>
        <tr height=29>
            <td bgcolor="#F6F6F6">무통장 입금액</td>
            <td>
                <input type=text class=edit name=od_receipt_bank size=10
                    value='<? echo $od[od_receipt_bank] ?>'>원
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">입금자명</td>
            <td>
                <input type=text class=edit name=od_deposit_name
                    value='<? echo $od[od_deposit_name] ?>'>
                <? if ($default[de_sms_use3]) { ?>
                    <input type=checkbox name=od_sms_ipgum_check> SMS 문자전송
                <? } ?>
            </td>
        </tr>
		
        <tr height=29>
            <td bgcolor="#F6F6F6">입금 확인일시</td>
            <td>
                <input type=text class=edit name=od_bank_time maxlength=19 value='<? echo is_null_time($od[od_bank_time]) ? "" : $od[od_bank_time]; ?>'>
                <input type=checkbox name=od_bank_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.od_bank_time.value=this.form.od_bank_chk.value; else this.form.od_bank_time.value = this.form.od_bank_time.defaultValue;">현재 시간
            </td>
        </tr>

		<?}?>
		<?if($od[od_settle_case]=="가상계좌"){?>
		<tr height=29>
            <td bgcolor="#F6F6F6">계좌번호</td>
            <td><?=$od[od_bank_account]?></td>
        </tr>
        <script> document.frmorderreceiptform.od_bank_account.value = '<? echo str_replace("\r", "", $od[od_bank_account]) ?>'; </script>
        <tr height=29>
            <td bgcolor="#F6F6F6">가상계좌 입금액</td>
            <td>
                <input type=text class=edit name=od_receipt_bank size=10
                    value='<? echo $od[od_receipt_bank] ?>'>원
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">입금자명</td>
            <td>
                <input type=text class=edit name=od_deposit_name
                    value='<? echo $od[od_deposit_name] ?>'>
                <? if ($default[de_sms_use3]) { ?>
                    <input type=checkbox name=od_sms_ipgum_check> SMS 문자전송
                <? } ?>
            </td>
        </tr>
		
        <tr height=29>
            <td bgcolor="#F6F6F6">입금 확인일시</td>
            <td>
                <input type=text class=edit name=od_bank_time maxlength=19 value='<? echo is_null_time($od[od_bank_time]) ? "" : $od[od_bank_time]; ?>'>
                <input type=checkbox name=od_bank_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.od_bank_time.value=this.form.od_bank_chk.value; else this.form.od_bank_time.value = this.form.od_bank_time.defaultValue;">현재 시간
            </td>
        </tr>
		<?}?>

		<?if($od[od_settle_case]=="계좌이체"){?>
		<tr height=29>
            <td bgcolor="#F6F6F6">계좌번호</td>
            <td><?=$od[od_bank_account]?></td>
        </tr>
        <script> document.frmorderreceiptform.od_bank_account.value = '<? echo str_replace("\r", "", $od[od_bank_account]) ?>'; </script>
        <tr height=29>
            <td bgcolor="#F6F6F6">계좌이체금액</td>
            <td>
                <input type=text class=edit name=od_receipt_bank size=10 value='<? echo $od[od_receipt_bank] ?>'>원
            </td>
        </tr>
		
        <tr height=29>
            <td bgcolor="#F6F6F6">입금 확인일시</td>
            <td>
                <input type=text class=edit name=od_bank_time size=19 maxlength=19 value='<? echo is_null_time($od[od_bank_time]) ? "" : $od[od_bank_time]; ?>'>
                <input type=checkbox name=od_card_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.od_bank_time.value=this.form.od_card_chk.value; else this.form.od_bank_time.value = this.form.od_bank_time.defaultValue;">현재 시간
            </td>
        </tr>
		<?}?>


		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        <? if ($od[od_settle_case]=="신용카드") { ?>
        <!-- 신용카드결제 -->
        <tr height=29>
            <td bgcolor="#F8FFED">신용카드 결재액</td>
            <td>
                <input type=text class=edit name=od_receipt_card size=10
                    value='<? echo $od[od_receipt_card] ?>'>원
                &nbsp;
                <?
                $card_url = $cfg[cardpg][$default[de_card_pg]];
                ?>
                <!--<a href='<? echo $card_url ?>' target=_new>결제대행사</a>-->
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F8FFED">카드 승인일시</td>
            <td>
                <input type=text class=edit name=od_card_time size=19 maxlength=19 value='<? echo is_null_time($od[od_card_time]) ? "" : $od[od_card_time]; ?>'>
                <input type=checkbox name=od_card_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.od_card_time.value=this.form.od_card_chk.value; else this.form.od_card_time.value = this.form.od_card_time.defaultValue;">현재 시간
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F8FFED">카드 승인취소</td>
            <td>
                <input type=text class=edit name=od_cancel_card size=10 value='<? echo $od[od_cancel_card] ?>'>원
            </td>
        </tr>
        <tr><td colspan=2 height=1 bgcolor=#84C718></td></tr>
        <!-- 신용카드결제 end -->
        <? } ?>
		<!--
        <tr height=29>
            <td bgcolor="#F6F6F6">DC</td>
            <td>
                <input type=text class=edit name=od_dc_amount size=10 value='<? echo $od[od_dc_amount] ?>'>원
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">환불액</td>
            <td>
                <input type=text class=edit name=od_refund_amount size=10 value='<? echo $od[od_refund_amount] ?>'>원
            </td>
        </tr>
        <tr><td colspan=2 height=1 bgcolor=#84C718></td></tr>
		-->
        <tr height=29>
            <td bgcolor="#F6F6F6">배송회사</td>
            <td>
                <select name=dl_id>
                    <option value=''>배송시 선택하세요.
                <?
                $sql = "select * from {$GnTable[shopdelivery]} order by dl_order desc, dl_id desc ";
                $result = sql_query($sql);
                for ($i=0; $row=mysql_fetch_array($result); $i++)
                    echo "<option value='$row[dl_id]'>$row[dl_company]\n";
                mysql_free_result($result);
                ?>
                </select>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">운송장번호</td>
            <td><input type=text class=edit name=od_invoice value='<? echo $od[od_invoice] ?>'>
				
				<?
					/* ------------------------------------------------------------- [ LG유플러스 에스크로 관련 [발송정보등록] - START ] ------------------------------------------------------------- */
					if($GnShop["pg_module"] == "LG") 
					{
						if($od[od_settle_case]=="가상계좌" or $od[od_settle_case]=="계좌이체")		// 에스크로 결제인 가상계좌와 계좌이체일때만 발송정보 등록여부 체크박스가 나오게 하기
						{
							if($od[LGD_ESCROWYN]=="Y") 
							{
								?>
								<input type="checkbox" name="LG_escrow" value="Y"> 
								<!-- 등록전 -->
								<? if($od[LG_escrow]=="Y") { ?><span style="font-size:8pt; color:green;">PG사로 발송정보가 등록되었습니다.</span>
								<!-- 등록후 -->
								<? } else { ?><span style="font-size:8pt; color:blue;">PG사로 발송정보를 등록하려면 체크</span><? } ?>

								<!-- 사용 안함
								<? if ($default[de_sms_use4]) { ?>
									<input type=checkbox name=od_sms_baesong_check> SMS 문자전송
								<? } ?>
								-->
								<?
							}
						}
					}
					/* ------------------------------------------------------------- [ 에스크로 관련 [발송정보등록] - END ] ------------------------------------------------------------- */
				?>
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">배송일시</td>
            <td>
                <input type=text class=edit name=od_invoice_time maxlength=19 value='<? echo is_null_time($od[od_invoice_time]) ? "" : $od[od_invoice_time]; ?>'>
                <input type=checkbox name=od_invoice_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.od_invoice_time.value=this.form.od_invoice_chk.value; else this.form.od_invoice_time.value = this.form.od_invoice_time.defaultValue;">현재 시간
            </td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        </table>
        <?
        if ($od[dl_id] > 0)
            echo "<script language='javascript'> document.frmorderreceiptform.dl_id.value = '$od[dl_id]' </script>";
        ?>

        <br>
		<div style="text-align:center;">
			<input type=image src='/btn/btn_modify.gif'>&nbsp;<a href='./order_list.php?<?=$qstr?>'><img src='/btn/btn_list.gif' border=0></a>
		</div>
        </form>


    </td>
</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>상점메모</b></td>
    </tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name="frmorderform2" method=post action="./order_update.php">
<input type=hidden name="od_id" value="<?=$od_id?>">
<input type=hidden name="mode"	value="memo">
<input type=hidden name="sort1"	value="<?=$sort1 ?>">
<input type=hidden name="sort2"	value="<?=$sort2 ?>">
<input type=hidden name="sel_field" value="<?=$sel_field ?>">
<input type=hidden name="search"	value="<?=$search ?>">
<input type=hidden name="page"	value="<?=$page ?>">
<tr>
	<td width=90%>
        <textarea name="od_shop_memo" rows=8 style='width:99%;' class=edit><? echo stripslashes($od[od_shop_memo]) ?></textarea>
	</td>
    <td width=10%>
        <input type=image src='/btn/btn_modify.gif'>
        <br><br>
    </td>
</tr>
</form>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>주소정보</b></td>
    </tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td width=49% valign=top bgcolor=#ffffff>
        <table width=100% cellpadding=4 cellspacing=1 border=0>
        <colgroup width=80 class=tdsl></colgroup>
        <colgroup width='' bgcolor=#ffffff></colgroup>
        <tr>
            <td colspan=4 bgcolor=#ffffff align=left><B>주문하신 분</B></td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        <tr>
            <td>이름</td>
            <td><?=$od[od_name]?></td>
		</tr>
        <tr>
            <td>전화번호</td>
            <td><?=$od[od_tel]?></td>
		</tr>
		<tr>
            <td>핸드폰</td>
            <td><?=$od[od_hp]?></td>
        </tr>
        <tr>
            <td>주소</td>
            <td colspan=3>
                (<?=$od[od_zip]?>)<br>
                <?="$od[od_addr1] $od[od_addr2]"?>
            </td>
        </tr>
		<tr>
            <td>E-mail</td>
            <td><?=$od[od_email]?></td>
        </tr>
		<tr>
            <td>IP Address</td>
            <td><?=$od[od_ip]?></td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        </table>
    </td>
    <td width=1%></td>
    <td width=50% valign=top align=left>
		<table width=100% cellpadding=4 cellspacing=1>
        <colgroup width=80 class=tdsl></colgroup>
        <colgroup width='' bgcolor=#ffffff></colgroup>
        <tr>
            <td colspan=4 bgcolor=#ffffff align=left><B>받으시는 분</B></td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        <tr>
            <td>이름</td>
            <td><?=$od[od_b_name]?></td>
        </tr>
        <tr>
            <td>전화번호</td>
            <td><?=$od[od_b_tel]?></td>
		</tr>
		<tr>
            <td>핸드폰</td>
            <td><?=$od[od_b_hp]?></td>
        </tr>
        <tr>
            <td>주소</td>
            <td colspan=3>
                (<?=$od[od_b_zip]?>)<br>
                <?="$od[od_b_addr1] $od[od_b_addr2]"?>
            </td>
        </tr>
        <tr>
            <td>전하실말씀</td>
            <td colspan=3 height=49><?=nl2br($od[od_memo])?></td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
		</table>
    </td>
</tr>
</table><br>

<div align=center>
    <a href='./order_list.php?<?=$qstr?>'><img src='/btn/btn_list.gif' border=0></a>&nbsp;<a href="javascript:del('<?="./order_delete.php?od_id=$od[od_id]&on_uid=$od[on_uid]&mb_id=$od[mb_id]&$qstr"?>');"><img src='/btn/btn_delete.gif' border=0></a>
</div>





<!-- ------------------------------------------------------------- [ 스크립트 - START ] ------------------------------------------------------------- -->
<script language="JavaScript" type="text/JavaScript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

var select_all_sw = false;
var visible_sw = false;

// 전체선택, 전체해제
function select_all()
{
	var f = document.frmorderform;

	for (i=0; i<f.chk_cnt.value; i++)
	{
		if (select_all_sw == false)
			f.elements["ct_chk["+i+"]"].checked = true;
		else
			f.elements["ct_chk["+i+"]"].checked = false;
	}

	if (select_all_sw == false)
		select_all_sw = true;
	else
		select_all_sw = false;
}

function form_submit(status)
{
	var f = document.frmorderform;
	var check = false;

	for (i=0; i<f.chk_cnt.value; i++) {
		if (f.elements["ct_chk["+i+"]"].checked == true) check = true;
	}

	if (check == false) {
		alert("처리할 자료를 하나 이상 선택해 주십시오.");
		return;
	}

	//if (confirm("\'" + status + "\'을(를) 선택하셨습니다.\n\n포인트가 이미 적용된 주문은 포인트 회수가 되지 않습니다.\n\n이대로 처리 하시겠습니까?") == true) {
	if (confirm("\'" + status + "\'을(를) 선택하셨습니다.\n\n이대로 처리 하시겠습니까?") == true) {
		f.ct_status.value = status;
		f.action = "./order_update.php";
		f.submit();
	}

	return;
}
</script>