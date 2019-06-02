<? 
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

if($page_loc==FALSE) {
	$page_loc = explode("/",$_SERVER["PHP_SELF"]);
	if($page_loc[2]=="admin.php") $page_loc[2] = "admin";
	$page_loc = $page_loc[2];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_meta.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_css.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_script.php"; ?>
<? Admin_check(); // 관리자 체크 : 메타태그 문자셋 정의하는것보다 아래 있어야 함. ?>

<title>관리자님 환영합니다.</title>

<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 15px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#E0820A;}

td.tmenu {font-family: "돋음"; color: #FFFFFF; font-size: 9pt; line-height: 15px; cursor:pointer;}
A.tmenu:link     {text-decoration:none;      color:#FFFFFF;}
A.tmenu:visited  {text-decoration:none;      color:#FFFFFF;}
A.tmenu:active   {text-decoration:none;      color:#FFFFFF;}
A.tmenu:hover    {text-decoration:none;      color:#FFFFFF;}

input.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
select.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
textarea.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
img { border:0; }

/* 기본버튼*/
.adm_btnN{
	height:19px;
	background: #FFFFFF;
	padding: 0px 0 0 0;
	display: inline-block; 
	color: #000000; 
	text-decoration: none; 
	border: 1px solid #000000; 
	position: relative; 
	cursor: pointer; 
}
.adm_btnN:hover{background: #ECECEC; }
</style>

<script type="text/javascript">
var old='';
function adminmenu(name){
	submenu=eval(name+".style");

	if (old!=submenu)
	{
		if(old!='')
		{
			old.display='none';
		}
		submenu.display='block';
		old=submenu;
	}
}
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="adminmenu('<?=$page_loc?>');">
<!-- doquery 를 실행하기 위한 아이프레임 -->
<iframe name='doquery' width='100%' height='200' align='center' style='display:none;'></iframe>
<!-- doquery 를 실행하기 위한 아이프레임 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="150" align="center" rowspan=2><a href="/admin/admin.php">관리자</a></td>
		<td bgcolor="#004A95" style="padding-left:10px">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr height="30">
				<?
				//외부 도메인 자동주석 처리     Won-Kyu Son 2009-11-27 
				$spr = explode('.', $_SERVER[HTTP_HOST],-1); 
				if ($_SESSION["super"] == "SUPER")
				{ ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/config/")) { ?>
						<!-- <td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('config')">[환경설정]</td> -->
					<? } ?>
				<? } ?>

				<? if(@opendir("$DOCUMENT_ROOT/admin/member/")) { ?>
					<td width="80" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('member')">[정보관리]</td>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/cash/")) { ?>
					<td width="80" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('cash')">[캐쉬관리]</td>
				<? } ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('site')">[사이트관리]</td>
				<!--
				<? if(@opendir("$DOCUMENT_ROOT/admin/online/")) { ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('online')">[온라인신청]</td>
				<? } ?>
				-->
				<? if(@opendir("$DOCUMENT_ROOT/admin/shop/")) { ?>
				<? if ($sitemenu["mn_shop_use"]) { ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('shop')">[쇼핑몰관리]</td>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('order')">[주문서관리]</td>
				<? } ?>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/statistics/")) { ?>
				<? if ($sitemenu["mn_statistics_use"]) { ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('statistics')">[매출 및 통계]</td>
				<? } ?>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/bill/")) { ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('bill')">[세금계산서]</td>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/product/")) { ?>
				<? if ($sitemenu["mn_product_use"]) { ?>
					<td width="90" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('product')">[팀관리]</td>
				<? } ?>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/search/")) { ?>
					<td width="100" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('search')">[통합검색관리]</td>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/counter/")) { ?>
				<? if ($sitemenu["mn_counter_use"]) { ?>
					<td width="80" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('counter')">[접속관리]</td>
				<? } ?>
				<? } ?>
				<? if(@opendir("$DOCUMENT_ROOT/admin/lecture/")) { ?>
					<td width="90" align="center" class="tmenu" style="font-size:10pt;cursor:hand;font-weight:bold" onClick="adminmenu('lecture')">[과정관리]</td>
				<? } ?>
					<td width="" align="right" style="padding-right:10px"><a href="/index.php" class="tmenu" target="_blank">[홈페이지]</a> <a href="/admin/logout.php" class="tmenu">[로그아웃]</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#DFDFDF" style="padding-left:10px">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr height="25">
					<td align="left" colspan="100">
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="admin" style='display:none;'>
							<tr>
								<td align="center"><b>관리자 모드에 접속하셨습니다.</b></td>
							</tr>
						</table>
					<? if(@opendir("$DOCUMENT_ROOT/admin/config/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="config" style='display:none;'>
							<tr>
								<td align="center"><b>환경설정</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/config/">사이트환경관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/config/config_list.php">게시판관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/config/page_list.php">페이지관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><!-- <a href="/admin/config/bbs_group_list.php"> --><a href="/admin/config/menu_list.php">메뉴관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/config/phpinfo.php" target="_blank">php정보</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/GGAdmin/" target="_blank">DB관리</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/member/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="member" style='display:none;'>
							<tr>
								<td align="center"><b>정보관리</b>&nbsp;:&nbsp;</td>
								<!-- <td align="center"><a href="/admin/member/level_list.php">회원등급관리</a>&nbsp;|&nbsp;</td> -->
								<td align="center"><a href="/admin/member/member_list.php">정보관리</a>&nbsp;|&nbsp;</td>
								<? if ($sitemenu["mn_shop_use"]) { ?>
								<!-- <td align="center"><a href="/admin/member/member_point.php">회원적립금</a>&nbsp;|&nbsp;</td> -->
								<?}?>
								<!-- <td align="center"><a href="/admin/member/member_exlist.php">탈퇴회원관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/member/">회원통계</a>&nbsp;|&nbsp;</td> -->
							</tr>
						</table>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/cash/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="cash" style='display:none;'>
							<tr>
								<td align="center"><b>캐쉬관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/cash/cash_code.php">결제금액</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/cash/cash_list.php">캐쉬관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/cash/cash_order.php">주문서</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/cash/cash_member.php">회원캐쉬</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="site" style='display:none;'>
							<tr>
								<td align="center"><b>사이트관리</b>&nbsp;:&nbsp;</td>
							<? if(@opendir("$DOCUMENT_ROOT/admin/bbs/")) { ?>
								<td align="center"><a href="/admin/bbs/bbs_list.php">게시판관리</a>&nbsp;|&nbsp;</td>
							<? } ?>
							<? if(@opendir("$DOCUMENT_ROOT/admin/streak/")) { ?>
								<td align="center"><a href="/admin/streak/streak_list.php">한줄광고관리</a>&nbsp;|&nbsp;</td>
							<? } ?>
							<!--
							<? if(@opendir("$DOCUMENT_ROOT/admin/banner/")) { ?>
								<? if ($sitemenu["mn_banner_use"]) { ?>
								<td align="center"><a href="/admin/banner/banner_list.php">배너관리</a>&nbsp;|&nbsp;</td>
								<? } ?>
							<? } ?>
							-->
							<? if(@opendir("$DOCUMENT_ROOT/admin/rolling_banner/")) { ?>
								<? if ($sitemenu["mn_banner_use"]) { ?>
								<td align="center"><a href="/admin/rolling_banner/banner_list.php">메인이미지관리</a>&nbsp;|&nbsp;</td>
								<? } ?>
							<? } ?>

							<? if(@opendir("$DOCUMENT_ROOT/admin/search/")) { ?>
								<td align="center"><a href="/admin/search/search.php">통합검색관리</a>&nbsp;|&nbsp;</td>
							<? } ?>
							<? if(@opendir("$DOCUMENT_ROOT/admin/newwin/")) { ?>
								<? if ($sitemenu["mn_popup_use"]) { ?>
								<td align="center"><a href="/admin/newwin/newwin_list.php">팝업관리</a>&nbsp;|&nbsp;</td>
								<? } ?>
							<? } ?>

							<? if(@opendir("$DOCUMENT_ROOT/admin/poll/")) { ?>
								<? if ($sitemenu["mn_poll_use"]) { ?>
									<td align="center"><a href="/admin/poll/poll_list.php">설문조사관리</a>&nbsp;|&nbsp;</td>
									<td align="center"><a href="/admin/poll/poll_request_list.php">설문조사신청관리</a>&nbsp;|&nbsp;</td>
								<? } ?>
							<? } ?>
								<!-- 
								<td align="center"><a href="/admin/page_item/page_form.php?mode=E&pg_no=1">Education</a>&nbsp;|&nbsp;</td> 
								-->
								<td align="center"><a href="/admin/rolling_banner/banner_list.php?type=2">Gallery</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/curriculum/list.php?type=0">파일관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/link/link_form.php?mode=E">하단링크관리</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>

						<? if(@opendir("$DOCUMENT_ROOT/admin/lecture/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="lecture" style='display:none;'>
							<tr>
								<td align="center"><b>과정관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/lecture/list.php">과정관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/page_item/page_form.php?mode=E&pg_no=5">계좌안내</a>&nbsp;|&nbsp;</td>
								<!--
								<td align="center"><a href="/admin/lecture/order_list.php">주문서관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/lecture/order_print.php">주문서출력</a>&nbsp;|&nbsp;</td>
								-->
							</tr>
						</table>
						<? } ?>

					<? if(@opendir("$DOCUMENT_ROOT/admin/shop/")) { ?>
						<? if ($sitemenu["mn_shop_use"]) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="shop" style='display:none;'>
							<tr>
								<td align="center"><b>쇼핑몰관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/shop/index.php">환경설정</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/explan_trans.php">안내사항
								</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/category_list.php">분류관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/item_list.php">상품관리</a>&nbsp;|&nbsp;</td>
								<? if ($sitemenu["mn_shop_review_use"]) { ?>
								<td align="center"><a href="/admin/item_review/list.php">상품후기</a>&nbsp;|&nbsp;</td>
								<?}?>
								<? if ($sitemenu["mn_shop_qna_use"]) { ?>
								<td align="center"><a href="/admin/item_qna/list.php">상품문의</a>&nbsp;|&nbsp;</td>
								<?}?>
								<!--
								<td align="center"><a href="/admin/shop/itemps_list.php">상품후기</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/itemqa_list.php">상품문의</a>&nbsp;|&nbsp;</td>
								-->
								<!--<td align="center"><a href="/admin/shop/presentpay_list.php">증정품관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/brand_list.php">브랜드관리</a>&nbsp;|&nbsp;</td>-->
								<td align="center"><a href="/admin/shop/delive_list.php">배송회사관리</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="order" style='display:none;'>
							<tr>
								<td align="center"><b>주문서관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/shop/order_list.php">주문서관리</a>&nbsp;|&nbsp;</td>
								<!-- <td align="center"><a href="/admin/shop/order_status_list.php">주문상품별관리</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/shop/inpay_list.php">배송전 입금완료목록</a>&nbsp;|&nbsp;</td> -->
								<td align="center"><a href="/admin/shop/order_print.php">주문출력</a>&nbsp;|&nbsp;</td>
								<!--
								<td align="center"><a href="/admin/shop/cash_list.php">현금영수증발급목록</a>&nbsp;|&nbsp;</td>
								-->
							</tr>
						</table>
						<? } ?>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/sms/")) { ?>
						<? if ($sitemenu["mn_sms_use"]) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="sms" style='display:none;'>
							<tr>
								<td align="center"><b>문자발송관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/sms/sms_list.php">문자발송</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/bill/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="bill" style='display:none;'>
							<tr>
								<td align="center"><b>세금계산서관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/bill/bill_code.php">환경설정</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/bill/bill_list.php">계산서목록</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/product/")) { ?>
						<? if ($sitemenu["mn_product_use"]) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="product" style='display:none;'>
							<tr>
								<td align="center"><b>팀관리</b>&nbsp;:&nbsp;</td>
								<!--
								<td align="center"><a href="/admin/product/index.php">환경설정</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/product/category_list.php">분류관리</a>&nbsp;|&nbsp;</td>
								-->
								<td align="center"><a href="/admin/product/item_list.php">팀관리</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
						<? } ?>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/online/")) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="online" style='display:none;'>
							<tr>
								<td align="center"><b>온라인신청</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/online/online_list.php?type=0">온라인신청관리</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/counter/")) { ?>
					<? if ($sitemenu["mn_counter_use"]) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="counter" style='display:none;'>
							<tr>
								<td align="center"><b>접속관리</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/counter/counter_list.php">접속리스트</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/counter/counter_total_time.php">접속자통계</a>&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/counter/counter_domain.php">접속경로통계</a>&nbsp;|&nbsp;</td>
							</tr>
						</table>
					<? } ?>
					<? } ?>
					<? if(@opendir("$DOCUMENT_ROOT/admin/statistics/")) { ?>
					<? if ($sitemenu["mn_statistics_use"]) { ?>
						<table height="20" border="0" cellspacing="0" cellpadding="0" id="statistics" style='display:none;'>
							<tr>
								<td align="center"><b>매출 및 통계</b>&nbsp;:&nbsp;</td>
								<td align="center"><a href="/admin/statistics/statistics_list.php">년/월 매출</a>
								&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/statistics/statistics_member.php">회원별 매출</a>
								&nbsp;|&nbsp;</td>
								<td align="center"><a href="/admin/statistics/sell_list.php">상품별매출</a>
							</tr>
						</table>
					<? } ?>
					<? } ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF"><td height=2 colspan=2></td></tr>
	<tr bgcolor="#004A95"><td height=2 colspan=2></td></tr>
	<tr bgcolor="#FFFFFF"><td height=5 colspan=2></td></tr>
</table>


