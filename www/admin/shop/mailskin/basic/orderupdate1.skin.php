<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<title>운영자께 주문서 메일 드리기</title>
</head>

<style>
body, th, td, form, input, select, text, textarea, caption { font-size: 12px; font-family:굴림;}
.line {border: 1px solid #868F98;}
</style>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" cellspacing="0" cellpadding="0" border=0>
    <tr><td width="25" height="25" colspan=3>&nbsp;</td></tr>
    <tr><td width="25" valign="top">&nbsp;</td>
    <td class="line" align=center>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td height="30"  style='padding-left:20px'>
            <strong><font color="#02253A">본 메일은 <?=$isnow?> (<?=get_yoil($isnow)?>)을 기준으로 작성되었습니다.스킨1번</font></strong>
            </td>
        </tr>
        </table>
        <p>
        <!-- 주문내역  -->
        <table width="95%" cellpadding="0" cellspacing="0">
        <colgroup width=200>
        <colgroup width=110>
        <colgroup width=150>
        <colgroup width=1>
        <colgroup width=''>
        <? for ($i=0; $i<count($list); $i++) { ?>
        <tr>
            <td rowspan=11 align=center><a href='<?="$default[shop_url]/shop/item.php?it_id={$list[$i][it_id]}"?>' target=_blank><?=$list[$i][it_simg]?></a></td>
            <td height=22> ▒  주문제품명</td>
            <td colspan=3>: <B><?=$list[$i][it_name]?></B></td>
        </tr>
        <tr><td colspan=4 bgcolor=#DDDDDD height=1></td></tr>
        <tr>
            <td height=22> ▒  주문번호</td>
            <td>: <font color=#CC3300><B><?=$od_id?></B></font></td>
            <td rowspan=9 bgcolor=#DDDDDD></td>
            <td>&nbsp; ▒  선택옵션 </td>
        </tr>
        <tr><td colspan=2 bgcolor=#DDDDDD height=1></td></tr>
        <tr>
            <td height=22> ▒  판매가격</td>
            <td>: <?=display_amount($list[$i][ct_amount])?></td>
            <td rowspan=9 valign=top style='padding-left:10px; padding-top:5px'><?=$list[$i][it_opt]?></td>
        </tr>
        <tr><td colspan=2 bgcolor=#DDDDDD height=1></td></tr>
        <tr>
            <td height=22> ▒  수량</td>
            <td>: <b><?=number_format($list[$i][ct_qty])?></b>개</td>
        </tr>
        <tr><td colspan=2 bgcolor=#DDDDDD height=1></td></tr>
        <tr>
            <td height=22> ▒  소계</td>
            <td>: <?=display_amount($list[$i][stotal_amount])?></td>
        </tr>
        <tr><td colspan=4 bgcolor=#DDDDDD height=1></td></tr>
        <tr><td colspan=3 height=20></td></tr>
			<?
				if($list[$i][present_item]) {
			?>
				<?=$list[$i][present_item]?>
			<?
				}
			?>
        <? } ?>
        <? if ($present[it_id]) { // 배송비가 있다면 ?>
        <tr>
			<td colspan=11 height=20 align=right>
				<table width="400" cellspacing="0" cellpadding="0" border=0>
					<tr>
						<td width="200"><font color="#9900FF"><b><?if($p==0){?><?=number_format($present[odto_pay])?></font>원 이상<? } ?> 구매시 증정품</b></td>
						<td width="80" height="60" align=center><a href='<?="$GnShop[shop_url]/shop"?>/item.php?it_id=<?=$present[it_id]?>'><?=get_image($present[it_id]."_s", 50, 50);?></a></td>
						<td width="80"><?=$present[it_name]?></td>
						<td width="40" align=center><?=$present[pr_num]?>개</td>
					</tr>
				</table>
			</td>
		</tr>
        <? } ?>
        <? if ($od_send_cost > 0) { // 배송비가 있다면 ?>
        <tr>
            <td></td>
            <td height=22> ▒  배송비</td>
            <td colspan=3 bgcolor=#F6F6F6>: <?=display_amount($od_send_cost)?></td>
        </tr>
        <? } ?>

        <tr>
            <td></td>
            <td height=22> ▒  주문합계</td>
            <td colspan=3 bgcolor=#F6F6F6>: <font color=#0066CC><b><?=display_amount($ttotal_amount)?></b></font></td>
        </tr>
        </table><p>
        <!-- 주문내역 END -->

        <!-- 결제정보 -->
        <table width="95%" align="center" cellpadding="0" cellspacing="0">
        <tr><td height=30><B>결제정보</B></td></tr>
        <tr>
            <td>
                <table width=100% cellpadding=4 cellspacing=0>
                <colgroup width=110>
                <colgroup width=''>
                <tr><td colspan=2 height=2 bgcolor=#D4E1EB></td></tr>

                <? if ($od_receipt_point > 0) { ?>
                <tr bgcolor="#F2F7FA">
                    <td> ▒ 포인트 입금액</td>
                    <td>: <font color=#0066CC><B><?=display_point($od_receipt_point)?></B></font></td>
                </tr>
                <? } ?>

                <? if ($od_receipt_card > 0) { ?>
                <tr bgcolor="#F2F7FA">
                    <td> ▒ 신용카드 입금액</td>
                    <td>: <font color=#0066CC><B><?=display_amount($od_receipt_card)?></B> (승인전 금액입니다.)</font></td>
                </tr>
                <? } ?>

                <? if ($od_receipt_bank > 0) { ?>
                <tr bgcolor="#F2F7FA">
                    <td> ▒ 무통장 입금액</td>
                    <td>: <font color=#0066CC><B><?=display_amount($od_receipt_bank)?></B></font></td>
                </tr>
                <tr bgcolor="#F2F7FA">
                    <td> ▒ 계좌번호</td>
                    <td>: <?=$od_bank_account?></td>
                </tr>
                <tr bgcolor="#F2F7FA">
                    <td> ▒ 입금자 이름</td>
                    <td>: <?=$od_deposit_name?></td>
                </tr>
                <? } ?>

                <tr><td colspan=2 height=2 bgcolor=#D4E1EB></td></tr>
                </table>
            </td>
        </tr>
        </table><p>
       <!-- 결제정보 END-->

       <!-- 주문자 정보 -->
        <table width="95%" align="center" cellpadding="0" cellspacing="0">
        <tr><td height=30><B>주문하신 분 정보</B></td></td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellpadding="4" cellspacing="0">
                <colgroup width=110>
                <colgroup width=''>
                <tr><td colspan=2 height=2 bgcolor=#DFDED9></td></tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 이 름</td>
                    <td>: <?=$od_name?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 전화번호</td>
                    <td>: <?=$od_tel?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 핸드폰</td>
                    <td>: <?=$od_hp?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 주 소</td>
                    <td>: <?=sprintf("(%s-%s) %s %s", $od_zip1, $od_zip2, $od_addr1, $od_addr2)?></td>
                </tr>

                <? if ($od_hope_date) { ?>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 희망배송일</td>
                    <td>: <?=$od_hope_date?> (<?=get_yoil($od_hope_date)?>)</td>
                </tr>
                <? } ?>
                <tr><td colspan=2 height=2 bgcolor=#DFDED9></td></tr>
                </table>
            </td>
        </tr>
        </table>
        <!-- 주문자 정보 END-->

        <p>
        <!-- 배송지 정보 -->
        <table width="95%" align="center" cellpadding="0" cellspacing="0">
        <tr><td height=30><B>배송지 정보</B></td></tr>
        <tr>
            <td>
                <table width="100%" cellpadding="4" cellspacing="0">
                <colgroup width=110>
                <colgroup width=''>
                <tr><td colspan=2 height=2 bgcolor=#DFDED9></td></tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 이 름</td>
                    <td>: <?=$od_b_name?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 전화번호</td>
                    <td>: <?=$od_b_tel?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 핸드폰</td>
                    <td>: <?=$od_b_hp?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td>▒ 주 소</td>
                    <td>: <?=sprintf("(%s-%s) %s %s", $od_b_zip1, $od_b_zip2, $od_b_addr1, $od_b_addr2)?></td>
                </tr>
                <tr bgcolor="#F8F7F2">
                    <td> ▒ 전하실 말씀</td>
                    <td>: <?=$od_memo?></td>
                </tr>
                <tr><td colspan=2 height=2 bgcolor=#DFDED9></td></tr>
                </table>
            </td>
        </tr>
        <tr><td align=right height=30 style='color:#A26217; font-size=11px; font-family:돋움'>상세한 내용은 운영자 화면에서 확인하실 수 있습니다. [<a href='<?="$GnShop[shop_url]/admin/index.php"?>'>바로가기</a>]</td></tr>
        </table>
        <!-- 배송지정보 END-->

        <table width=95%>
            <tr><td height=30 align=right></td></tr>
        </table>
    </td>
    <td width="25" valign="top">&nbsp;</td>
</tr>
</table>
<p>
</body>
</html>
