<?
	include $DOCUMENT_ROOT."/admin/lib/libvm.php";
	include $DOCUMENT_ROOT."/admin/shop/lib/shop_lib.php";

/*******************************************************************************
* AGSCash_ing.php 으로부터 넘겨받을 데이터
********************************************************************************/

$Retailer_id = trim($_POST["rRetailer_id"]);		//상점아이디

$Ord_No = trim($_POST["rDealno"]);				//주문번호

$Adm_no = trim($_POST["rAdm_no"]);				//승인번호

$Success = trim($_POST["rSuccess"]);				//성공여부 y,n 으로 표시

$rResMsg = trim($_POST["rResp_msg"]);		        //에러메시지

$Alert_msg1 = trim($_POST["rAlert_msg1"]);		//알림메세지1

$Alert_msg2 = trim($_POST["rAlert_msg2"]);		//알림메세지2

/***************************************************************************************************
* 상품의 상세정보(상품명, 상품갯수, 주문자명등)은 상점에서 처리를 해야함
****************************************************************************************************/
	isAdmin();
	include "../head.php";

if($Success=="y") $Successmsg = "발급취소";
	else  $Successmsg = "발급취소실패";

$sql = " update shop_cash set 
				cash_state			= '$Successmsg',
				cash_cenadmno	= '$Adm_no',
				cash_resmsg		= '$rResMsg',
                cash_ctime			= '$istime'
		where cash_id = '$cash_id'
		";
sql_query($sql);


?>
		<table width="630" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="padding:5px">
					<font size=2><b>현금영수증처리결과</b></font>
				</td>
			</tr>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="#848FF1"></td>
			</tr>
			<tr>
				<td>
				<table width="630" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px" width=120><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>결제종류 : </b></font> </b></font></td>
						<td style="padding:5px">
<?php
	if($Pay_kind == "cash-appr")
	{
		echo "현금영수증발행요청";
	}	
	else if($Pay_kind == "cash-cncl")
	{
		echo "현금영수증취소요청";
	}
?></td>
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px"><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>거래자구분 : </b></font> </td>
						<td style="padding:5px">
<?php
	if($Gubun_cd == "01")
	{
		echo "소득공제용";
	}	
	else if($Gubun_cd == "02")
	{
		echo "사업자지출증빙용";
	}
?></td>
					</tr>
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px"><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>결제방식 : </b></font> </td>
						<td style="padding:5px">
<?php
	if($Pay_type == "1")
	{
		echo "무통장입금";
	}	
	else if($Pay_type == "2")
	{
		echo "계좌이체";
	}
?></td>
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px"><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>주문번호 : </b></font> </td>
						<td style="padding:5px"><?=$Ord_No?></td>
					</tr>
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px"><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>승인번호 : </b></font> </td>
						<td style="padding:5px"><?=$Adm_no?></td>
					</tr>
					<tr>
						<td bgcolor="#EBEDFF" style="padding:5px"><font color=#4954B7>&nbsp;&nbsp;&nbsp;&nbsp;<b>성공여부 : </b></font> </td>
						<td style="padding:5px"><?if($Success == "y"){?>성공<?} else {?><font color=red>실패</font>(<?=$rResMsg?>)<?}?></td>
					</tr>						
				</table>
				</td>
			</tr>
			<tr bgcolor="#848FF1">
				<td height="2" bgcolor="#848FF1"></td>
			</tr>
		</table>
            <br>
            <table border="0" cellspacing="0" cellpadding="0" height="50">
              <tr> 
                <td width="308" align="center"><a href="./cash_list.php"><img src="image/order/button/order_l.gif" width="101" height="30" border="0"></a></td>
              </tr>
</form>
           </table>

<? include "../foot.php" ;?>		