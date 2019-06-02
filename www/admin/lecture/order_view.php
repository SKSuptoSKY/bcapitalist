<?
$page_loc="lecture";
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

// 주문서
$sql = " select * from Gn_Lecture_History where tno = '$tno' ";
$view_h = sql_fetch($sql);

$sql = " select * from Gn_Lecture where lec_no = '$view_h[order_lec]'";
$view_l = sql_fetch($sql);

$qstr1 = "sel_ca_id=$sel_ca_id&findType=$findType&findword=$findword";
$qstr = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";
?>
<script language=javascript src="/admin/shop/lib/javascript.js"></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 신청내역보기</font></strong>
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
        <td><b>결제내역</b></td>
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
				<input type=hidden name=ct_status value=''>
				<input type=hidden name=sort1 value="<? echo $sort1 ?>">
				<input type=hidden name=sort2 value="<? echo $sort2 ?>">
				<input type=hidden name=sel_field  value="<? echo $sel_field ?>">
				<input type=hidden name=search     value="<? echo $search ?>">
				<input type=hidden name=page       value="<? echo $page ?>">
				<input type=hidden name=pay_mny value='<?=$view_h[pay_mny]?>'>
				<input type=hidden name=cancel_mny value='<?=$view_h[cancel_mny]?>'>
				<input type="hidden" name="total_pay" value="<?=$view_h[total_pay]?>">
				<input type="hidden" name="order_lec" value="<?=$view_h[order_lec]?>">
				<input type="hidden" name="tno" value="<?=$view_h[tno]?>">
				<tr align="center" bgcolor="#F6F6F6">
					<td>강의명</td>
					<td width="120">결제금액</td>
					<td width="100">부가세</td>
					<td width="150">실 결제금액</td>
					<td width="100">상태</td>
					<!-- <td width="70">재고 반영</td>
					<td width="70">포인트 반영</td> -->
					<!-- <td width="100">추가 입력사항</td> -->
				</tr>
				<tr bgcolor='#FFFFFF'>
					<td align=center><?=$view_h[order_subject]?></td>
					<td align=center><?=number_format($view_h[order_pay])?>원</td>
					<td align=center><?=number_format($view_h[order_tax])?>원</td>
					<td align=center><?=number_format($view_h[pay_mny])?>원</td>
					<td align=center><?=$view_h[status]?></td>
				</tr>

			</table>
			<table width="99%" border="0" cellpadding="3" cellspacing="1" align="center">
				<tr bgcolor="#ffffff">
					<td colspan=4><font color=red>상태변경 : </font>&nbsp;&nbsp;&nbsp;
						<a href="javascript:form_submit('미입금')">미입금</a>
						|
						<a href="javascript:form_submit('결제완료')">결제완료</a>
						|
						<a href="javascript:form_submit('취소')">취소</a>
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

<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
	<tr align="center" bgcolor="#F6F6F6">
		<!-- <td>주문번호</td> -->
		<td>결제방법</td>
		<td>결제금액</td>
		<td>실 결제금액(부가세 포함)</td>
		<td>주문취소</td>
		<!-- <td>현금영수증</td> -->
	</tr>
	<tr align="center" bgcolor="#FFFFFF">
		<!-- <td><?=$view_h[order_idxx]?></td> -->
		<td><?=$view_h[type]?></td>
		<td><?=number_format($view_h[order_pay])?>원</td>
		<td><?=number_format($view_h[pay_mny])?>원</td>
		<td><?=number_format($view_h[cancel_mny])?>원</td>
		<!--
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
		-->
	</tr>
</table>


<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>결제상세정보</b>
		 <?if($view_h[type]=="신용카드" || $view_h[type]=="계좌이체"){?>
			 <a href="https://admin8.kcp.co.kr/assist/login.LoginAction.do" target="_blank" style="color:green;">[KCP 상점관리자 이동]</a>
		 <?}?>
		</td>
    </tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td valign=top align=left>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align="center">
        <form name=frmorderreceiptform method=post action="./order_receiptup.php" autocomplete=off>

        <input type=hidden name=sort1     value="<?=$sort1?>">
        <input type=hidden name=sort2     value="<?=$sort2?>">
        <input type=hidden name=sel_field value="<?=$sel_field?>">
        <input type=hidden name=search    value="<?=$search?>">
        <input type=hidden name=page      value="<?=$page?>">
		<input type="hidden" name="tno" value="<?=$view_h[tno]?>">

        <colgroup width=110 class=tdsl></colgroup>
        <colgroup width='' bgcolor=#ffffff></colgroup>

		<!--
		<tr height=29>
            <td bgcolor="#F6F6F6">계좌번호</td>
            <td></td>
        </tr>

		-->
        <tr height=29>
            <td bgcolor="#F6F6F6">무통장 입금액</td>
            <td>
                <input type=text class=edit name=pay_mny size=10 value='<?=number_format($view_h[pay_mny]) ?>'>원
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">입금자명</td>
            <td>
                <input type=text class=edit name=account_name size=19 value='<?=$view_h[account_name] ?>'>
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F6F6F6">입금 확인일시</td>
            <td>
                <input type=text class=edit name=pay_date size=19 maxlength=19 value='<? echo is_null_time($view_h[pay_date]) ? "" : $view_h[pay_date]; ?>'>
                <input type=checkbox name=od_card_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.pay_date.value=this.form.od_card_chk.value; else this.form.pay_date.value = this.form.od_bank_time.defaultValue;">현재 시간
            </td>
        </tr>



		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        <? if ($view_h[type]=="신용카드") { ?>
        <!-- 신용카드결제 -->
        <tr height=29>
            <td bgcolor="#F8FFED">신용카드 결제액</td>
            <td>
                <input type=text class=edit name=pay_mny size=10
                    value='<?=number_format($view_h[pay_mny])?>'>원
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
                <input type=text class=edit name=pay_date size=19 maxlength=19 value='<? echo is_null_time($view_h[pay_date]) ? "" : $view_h[pay_date]; ?>'>
                <input type=checkbox name=od_card_chk
                    value="<? echo date("Y-m-d H:i:s", time()); ?>"
                    onclick="if (this.checked == true) this.form.pay_date.value=this.form.od_card_chk.value; else this.form.pay_date.value = this.form.od_card_time.defaultValue;">현재 시간
            </td>
        </tr>
        <tr height=29>
            <td bgcolor="#F8FFED">카드 승인취소</td>
            <td>
                <input type=text class=edit name=cancel_mny size=10 value='<?=number_format($view_h[cancel_mny]);?>'>원
            </td>
        </tr>
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
        </table>

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
<input type=hidden name="mode"	value="memo">
<input type=hidden name="sort1"	value="<?=$sort1 ?>">
<input type=hidden name="sort2"	value="<?=$sort2 ?>">
<input type=hidden name="sel_field" value="<?=$sel_field ?>">
<input type=hidden name="search"	value="<?=$search ?>">
<input type=hidden name="page"	value="<?=$page ?>">
<input type="hidden" name="tno" value="<?=$view_h[tno]?>">
<tr>
	<td width=90%>
        <textarea name="order_memo" rows=8 style='width:99%;' class=edit><? echo stripslashes($view_h[order_memo]) ?></textarea>
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

<!--
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
        <td><b>결제정보</b></td>
    </tr>
</table>
-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td width=100% valign=top bgcolor=#ffffff>
        <table width=100% cellpadding=4 cellspacing=1 border=0>
        <colgroup width=150 class=tdsl></colgroup>
        <colgroup width='' bgcolor=#ffffff></colgroup>

        <tr>
            <td colspan=4 bgcolor=#ffffff align=left><B>결제하신 분</B></td>
        </tr>
		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>

        <tr>
            <td>성명</td>
            <td><?=stripslashes($view_h[order_name])?></td>
		</tr>
        <tr>
            <td>회사/기관명</td>
            <td>
				<?=$view_h[order_company]?>
			</td>
		</tr>

		<tr>
            <td>E-mail</td>
            <td><?=stripslashes($view_h[order_email])?></td>
        </tr>

		<tr>
            <td>핸드폰</td>
            <td><?=stripslashes($view_h[order_mobile])?></td>
        </tr>

        <tr>
            <td>남기실말씀</td>
            <td colspan=3 height=49><?=nl2br($view_h[order_coment])?></td>
        </tr>

		<tr>
            <td>IP Address</td>
            <td><?=$view_h[order_ip]?></td>
        </tr>

		<tr><td colspan=2 height=1 bgcolor=CCCCCC></td></tr>
        </table>
    </td>
    <td width=1%></td>

</tr>
</table><br>

<div align=center>
    <a href='./order_list.php?<?=$qstr?>'><img src='/btn/btn_list.gif' border=0></a>&nbsp;<a href="javascript:del('<?="./order_delete.php?order_idxx=$view_h[order_idxx]&$qstr"?>');"><img src='/btn/btn_delete.gif' border=0></a>
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

	//if (confirm("\'" + status + "\'을(를) 선택하셨습니다.\n\n포인트가 이미 적용된 주문은 포인트 회수가 되지 않습니다.\n\n이대로 처리 하시겠습니까?") == true) {
	if (confirm("\'" + status + "\'을(를) 선택하셨습니다.\n\n이대로 처리 하시겠습니까?") == true) {
		f.ct_status.value = status;
		f.action = "./order_update.php";
		f.submit();
	}

	return;
}
</script>