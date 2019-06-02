
<HTML>
<HEAD>
<TITLE>현금소득공제영수증</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?=$charset?>">

<style type="text/css">
     
.font {Font-Family:"돋움,verdana"; FONT-SIZE:9pt ; color:#383434; TEXT-DECORATION: none; line-height: 14px}

.font02 {font-family: 돋움,verdana; font-size:14px; ; color:#02469A; TEXT-DECORATION: none;  font-weight: bold;}

.font03 {Font-Family:"돋움,verdana"; FONT-SIZE:14px; color:#383434; TEXT-DECORATION: none;  font-weight: bold;}

A:link {COLOR: #F75B09; TEXT-DECORATION: none}
A:visited {COLOR: #F75B09; TEXT-DECORATION: none}
A:hover {COLOR: #669E02; TEXT-DECORATION: underline}

.img 
{border:0px;}


.td_body01 {padding-left:5px; padding-top:3px; font-family: 돋움,verdana; font-size:12px; color:#515151; text-decoration:none;}

.td_title {font-family: 돋움,verdana; font-size:12px; color:#053961; text-decoration:none; border-top:solid 1px #B7CCDC; vertical-align:middle;}

.td_title02 {font-family: 돋움,verdana; font-size:12px; color:#053961; text-decoration:none; border-top:solid 1px #B7CCDC; border-right:solid 1px #B7CCDC; vertical-align:middle;}


.td_body02 {padding-left:10px; font-family: 돋움,verdana; font-size:12px; color:#2D3032; text-decoration:none; border-top:solid 1px #B7CCDC;  margin:0px; text-align:left; vertical-align:middle;}

.td_body03 {padding-left:10px; font-family: 돋움,verdana; font-size:12px; color:#2D3032; text-decoration:none; border-top:solid 1px #B7CCDC;  margin:0px;  vertical-align:middle;}


</style>
<script language=javascript>
<!--
//영수증 구분에 따른 이미지 표시 자바스크립트
function show_receipt(){
  if("<%=Gubun_cd%>"=="01"){
       Display1.style.display = "";
	Display2.style.display = "none";
		}else {
      Display1.style.display = "none";
		Display2.style.display = "";
    }
   //영수증 창 크기 설정
   resizeTo(470,740)
}

-->
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function jsPrint(){
	window.print();
}
//-->
</SCRIPT>

</HEAD>

<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 onload="javascript:show_receipt();">
<TABLE WIDTH=440 BORDER=0 CELLPADDING=0 CELLSPACING=0>
<!---------현금영수증 구분에 따른 이미지 표시------>
	<TR id="Display1" STYLE="display:none;">
		<td><IMG SRC="/shop/images/title_cash.jpg" width="106" height="29"></td>
	</tr>
	<TR id="Display2" STYLE="display:'';">
		<td><IMG SRC="/shop/images/title_cash.jpg" width="106" height="29"></td>
	</tr>
<!---------현금영수증 구분에 따른 이미지 표시------>
	<tr>
		<td align=center valign=top>
			<!-------------본문 테이블 --------------->
			<TABLE WIDTH=400 BORDER=0 CELLPADDING=0 CELLSPACING=0>
				<tr><td height=20></td></tr>

				<tr>
					<td>
						<table width="400" border="0" cellpadding="0" cellspacing="1" bgcolor="E3D7C4">
							 <tr>
								<td>
									<!-------------상점명 및 정보 테이블  --------------->
									<!-------------상점정보는 고정으로 사용해되 됨 ------>
									<table width="400" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">

										 <tr bgcolor="#FFFFFF"> 
											<td width="120" height="22" bgcolor="#ECE4D7" class=font style="padding-left:10px;"><font color=053961>상점명</td>
											<td bgcolor="#F5F2EF" class=font style="padding-left:10px;">샤본다마 코리아 (주) / www.shabon.co.kr</td>
										</tr>

										 <tr bgcolor="#FFFFFF"> 
											<td height="22" bgcolor="#ECE4D7" class=font style="padding-left:10px;"><font color=053961>사업자등록번호</td>
											<td bgcolor="#F5F2EF" class=font style="padding-left:10px;">220-86-69325</td>
										</tr>

										 <tr bgcolor="#FFFFFF"> 
											<td height="22" bgcolor="#ECE4D7" class=font style="padding-left:10px;"><font color=053961>대표자명</td>
											<td bgcolor="#F5F2EF" class=font style="padding-left:10px;">이  숙 </td>
										</tr>
										 <tr bgcolor="#FFFFFF"> 
											<td height="22" bgcolor="#ECE4D7" class=font style="padding-left:10px;"><font color=053961>주 소</td>
											<td bgcolor="#F5F2EF" class=font style="padding-left:10px;">서울시 동작구 사당동 232-13</td>
										</tr>
										 <tr bgcolor="#FFFFFF"> 
											<td height="20" bgcolor="#ECE4D7" class=font style="padding-left:10px;"><font color=053961>대표전화</td>
											<td bgcolor="#F5F2EF" class=font style="padding-left:10px;">(02) 597 - 5204 / 5205 </td>
										</tr>
									
									</table>
								   <!-------------상점명 및 정보 테이블 끝 --------------->


								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr><td height=20></td></tr>

				<tr>
					<td>
						<!-------------상품명, 수량, 금액, 합계 --------------->
						<table width="400" border="0" cellpadding="0" cellspacing="0">
							 <tr>
								<td height=2 colspan=3 bgcolor=B7CCDC></td>
							</tr>

							 <tr>
								<td width=35 height=27 class=td_title align=right style="padding-right:10px;"><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td width=66 class=td_title02>상품명</td>
								<td width=299 class=td_body02><?=$prod_nm?></td>
							</tr>

							 <tr>
								<td height=27 class=td_title align=right style="padding-right:10px;"><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td class=td_title02>수 량</td>
								<td class=td_body02><?=$prod_set?>개</td>
							</tr>

							 <tr>
								<td height=27 class=td_title align=right style="padding-right:10px;"><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td class=td_title02>금 액</td>
								<td class=td_body02><?=number_format($Amtcash)?></td>
							</tr>

							 <tr>
								<td height=27 class=td_title align=right style="padding-right:10px;"><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td class=td_title02 valign=top>합 계</td>
								<td class=td_body03 align=right style="padding-top:10px;padding-right:10px;padding-bottom:10px;">
<!------------------------------승인시 취소시 금액표시법 다름------------------------->
<!------------------------------취소시 금액 앞에 - 표시 예) -5000 -------------------->

<? if ($Pay_kind == "cash-appr")	{ ?>	
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="100" class=font>과세물품가액 :</td>
											<td align=right class=font03><b><?=number_format($deal_won)?></b></td>
										</tr>
										<tr>
											<td width="100" class=font>부가세&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
											<td align=right class=font03><b><?=number_format($Amttex)?></b></td>
										</tr>
											<tr>
											<td width="100" class=font>봉사료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
											<td align=right class=font03><b><?=number_format($Amtadd)?></b></td>
										</tr>
										<tr>
											<td colspan=2 align=right class=font03><b><?=number_format($Amtcash)?></b></font></td>
										</tr>
									</table>
	<?}  else 	{?>
	<!-------------------취소시표기 ----------------------------------->
								<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="100" class=font>과세물품가액 :</td>
											<td align=right class=font03><b>- &nbsp;<?=number_format($deal_won)?></b></td>
										</tr>
										<tr>
											<td width="100" class=font>부가세&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
											<td align=right class=font03><b>- &nbsp;<?=number_format($Amttex)?></b></td>
										</tr>
											<tr>
											<td width="100" class=font>봉사료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
											<td align=right class=font03><b>- &nbsp;<?=number_format($Amtadd)?></b></td>
										</tr>
										<tr>
											<td colspan=2 align=right class=font03><b>- &nbsp;<?=number_format($Amtcash)?></b></font></td>
										</tr>
									</table>
<?}?>
<!------------------------------승인시 취소시 금액표시법 다름------------------------->

								</td>
							</tr>

							 <tr>
								<td height=3 colspan=3 bgcolor=B7CCDC></td>
							</tr>
						</table>
						<!-------------상품명, 수량, 금액, 합계  끝-------------->
					</td>
				</tr>


				<tr><td height=20></td></tr>

				<tr>
					<td>
						<!-------------신분확인번호 테이블 시작  --------------->
						<table width="400" border="0" cellpadding="0" cellspacing="0">
							 <tr>
								<td colspan=3 background="images/bg_dot.gif" height=1></td>
							</tr>

							 <tr>
								<td colspan=3 height=2 bgcolor=#ffffff></td>
							</tr>
<!------------------------------영수증 구분에 따른 신분확인번호 표시 ----------------------------------------------------------->
<? if ($Gubun_cd == "01")	{ 
?>					 <tr bgcolor=#EFF2F4>
								<td width=30 height=30 align=center><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td bgcolor="#F5F2EF">신분확인번호 :</td>
								<td align=right bgcolor="#F5F2EF" style="padding-right:10px;"><font class=font02>
							<?=$confirm_no = substr($Confirm_no,0,6);?>-*******</font></td>
							</tr>
<?}  else 	{?>					

	                  <tr bgcolor=#EFF2F4>
								<td width=30 height=30 align=center><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td bgcolor="#F5F2EF">신분확인번호 :</td>
								<td align=right bgcolor="#F5F2EF" style="padding-right:10px;"><font class=font02>
								 <?=$confirm_no = substr($Confirm_no,0,2);?>-<?=$confirm_no =substr($Confirm_no,3,4);?>-*****</font></td>
							</tr>
<?}?>
<!------------------------------영수증 구분에 따른 신분확인번호 표시 ----------------------------------------------------------->
<!------------------------------영수증 발행과 취소에 따른 구분 표시 ---------------------------------------------------------->
							 <tr bgcolor=#EFF2F4>
								<td width=30 height=30 align=center><img src="/btn/images/foot_right.gif" width="15" height="15"></td>
								<td bgcolor="#F5F2EF"><font class=font02>
<?php
	if($Pay_kind == "cash-appr")
	{
		echo "현금영수증승인";
	}	
	else if($Pay_kind == "cash-cncl")
	{
		echo "현금영수증취소";
	}
?> :</td>
<!------------------------------영수증 발행과 취소에 따른 구분 표시 ---------------------------------------------------------->
								<td align=right bgcolor="#F5F2EF" style="padding-right:10px;"><font class=font02><?=$Adm_no?></font></td>
							</tr>

							 <tr>
								<td colspan=3 height=2 bgcolor=#ffffff></td>
							</tr>

							 <tr>
								<td colspan=3 background="images/bg_dot.gif" height=1></td>
							</tr>
						</table>
						<!-------------신분확인번호 테이블 끝  --------------->
					</td>
				</tr>

				<tr>
					<td>
						<!-------------현금영수증 문의 안내  --------------->
						<table width="400" border="0" cellpadding="0" cellspacing="0">

						<tr>
							<td width=30><div align="center"><img src="/btn/images/foot_right.gif" width="15" height="15"></div></td>
							<td width=375 height=28 class=td_body01 align=left><b>현금영수증 문의 &nbsp;&nbsp;<?=$Alert_msg1?>  , <?=$Alert_msg2?></b></td>
						</tr>

						</table>
						<!-------------현금영수증 문의 안내  끝--------------->
					</td>
				</tr>

				<tr><td height=20></td></tr>
			</table>

			<!----------본문 테이블 끝 ------------>


		</td>
	</tr>

	<tr>
		<td height=40 align=right>
						
						<!-------------하단 인쇄하기 창닫기 버튼  --------------->

						<table border="0" cellpadding="0" cellspacing="0">
							 <tr>
								<td><IMG SRC="/member/images/btn_print.jpg" width="85" height="26"  style="cursor:hand" onclick="javascript:jsPrint();"></td>
								<td width=5></td>
								<td><IMG SRC="/member/images/btn_close.jpg" width="85" height="26"  style="cursor:hand" onclick="self.close();"></td>
								<td width=20></td>
							</tr>
						</table>

					   <!-------------하단 인쇄하기 창닫기 버튼 끝 --------------->
		</td>
	</tr>
</table>

</BODY>
</HTML>