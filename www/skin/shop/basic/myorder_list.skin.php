<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<style type="text/css">
<!--
.style1 {
color: #FFFFFF;
font-weight: bold;
}
.style2 {color: #FFFFFF}
-->
</style>
<body>
<!-- 테이블의 시작 -->
<table width="725" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="725" style="padding:0 0 0 6px;">
<!-- 테이블의 시작 -->
	<table width="713" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
		<td width="50%"><img src="/images/shop/cart_t.jpg" alt="주문배송조회이미지타이틀" /></td>
		<td width="50%" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME > 마이페이지 > <b>주문배송조회</b></td>
		</tr>
		</table>
	<!-- 테이블의 끝 -->
	</td>
	</tr>
	</table>
<!-- 테이블의 끝 -->
</td>
</tr>
<tr>
<td height="20">&nbsp;</td>
</tr>
<tr>
<td>
<!-- 테이블의 시작 -->
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td>
	<!-- 테이블의 시작 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td height="2" colspan="17" bgcolor="eeeeee"></td></tr>
		<tr align="center" bgcolor="f9f9f9">
		<td width="77" height="25">주문번호</td>
		<td width="80">주문자명</td>
		<td width="60">상태</td>
		<td width="76">주문금액</td>
		<td width="63">주문일</td>
		<td width="120">배송일</td>
		<td width="100">운송장번호</td>
		<td width="100">비고</td>
		</tr>
		<tr><td height="1" colspan="17" bgcolor="eeeeee"></td></tr>
		<? if(!$total_count) { ?>
		<tr align="center">
		<td colspan="16" height="30" valign="middle">
		입력된 자료가 없습니다.			</td>
		</tr>
		<? } ?>
		<? for($i=0; $i<count($od); $i++) { ?>
		<tr align="center">
		<td height="30"><?=$od[$i][od_id]?></td>
		<td><?=$od[$i][od_name]?></td>
		<td><?=$CT[$i][ct_status]?></td>
		<td><?=number_format($sell_cost[$i])?> 원</td>
		<td><?=substr($od[$i][od_time],0,10)?></td>
		<td><?if(is_null_time($od[$i][od_invoice_time])==FALSE) echo substr($od[$i][od_invoice_time],0,10); ?></td>
		<td><a href="<?=$od[$i][dl_url]?>" target="_blank"><font color="blue"><?=$od[$i][od_invoice]?></font></a></td>
		<td align="center"><a href="./myorder_view.php?od_id=<?=$od[$i][od_id]?>&on_uid=<?=$od[$i][on_uid]?>"><font color="red">[상세보기]</font></a></td>
		</tr>
		<? } ?>
		</table>
	<!-- 테이블의 끝 -->
	</td>
	</tr>
	<tr>
	<td height="17"></td>
	</tr>
	<tr>
	<td><?=get_paging(10, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr"); ?></td>
	</tr>
	<tr>
	<td height="30"></td>
	</tr>
	<tr>
	<td><?=$row_coupon[cp_content]?></td>
	</tr>
	</table>
<!-- 테이블의 끝 -->
</td>
</tr>
<tr>
<td height="50" align="center">&nbsp;</td>
</tr>
</table>
<!-- 테이블의 끝 -->
