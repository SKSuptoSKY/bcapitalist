<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	if(!$_POST[lec_no]) alert("잘못된 접근입니다.","/mobile/academy.php");
	$sql = "select * from Gn_Lecture where lec_no = '{$_POST[lec_no]}'";
	$lec = sql_fetch($sql);

	//메인이미지
	$main_img = get_rolling_list(101);
?>

<div id="wrap">
	<div id="header">
		<h1 class="logo"><a href="/mobile/curriculum.php">
			<img src="/mobile/images/main/logo.png" alt="주식회사 블록체인투자연구소">
		</a></h1>		
	</div><!-- //header -->	

	<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/navigation.php"; ?>

	<div id="visual_wrap">
		<link rel="stylesheet" href="/mobile/css/main_slider.css" type="text/css">
		<script type="text/javascript" src="/mobile/css/js/bxslider.js"></script>
		<ul id="visual">
			<?for($i=0; $i<count($main_img); $i++){?>
				<li><img src="<?=$main_img[$i]["img_src"]?>" style="width:100%;" alt=""></li>
			<?}?>
		</ul>

		<div class="visual_text">
			<strong>Blockchain Investment<br />Academy</strong>
			<p>Blockchain Education and<br />Matchmaking Platform</p>
			<div class="visual_more">
				<p class="btn_registration"><a href="#none">투자자과정 과정등록</a></p>
				<p class="btn_curriculum"><a href="#none">투자자과정 커리큘럼</a></p>
			</div>
		</div>		
	</div><!-- //visual_wrap -->

	<div id="contents">
		<div id="r_section1">
			<div class="m_tit">
				<em>01</em>
				<h2>과정등록</h2>
			</div>
			<p class="r_section_top_txt">작성해주신 <em>등록 내용을 확인</em>해주세요</p>
			<div class="resist_con">
				<form name="up_form" method="post">
					<input type="hidden" name="order_name" value="<?=$_POST[order_name]?>">
					<input type="hidden" name="order_company" value="<?=$_POST[order_company]?>">
					<input type="hidden" name="order_position" value="<?=$_POST[order_position]?>">
					<input type="hidden" name="order_email" value="<?=$_POST[order_email]?>">
					<input type="hidden" name="order_mobile" value="<?=$_POST[order_mobile]?>">
					<input type="hidden" name="order_referral" value="<?=$_POST[order_referral]?>"><!-- 추가한것 -->
					<input type="hidden" name="order_content" value="<?=$_POST[order_content]?>">
					<input type="hidden" name="total_pay" value="<?=$total_pay?>">
					<input type="hidden" name="order_pay" value="<?=$order_pay?>">
					<input type="hidden" name="lec_no" value="<?=$lec[lec_no]?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_view">
						<colgroup>
							<col width="30%" />
							<col width="*" />
						</colgroup>
						<tr>
							<th>과정</th>
							<td><?=$lec[lec_subject]?></td>
						</tr>
						<tr>
							<th>과정일정</th>
							<td><?=substr($lec[lec_frDT],0,10)?> ~ <?=substr($lec[lec_enDT],0,10)?></td>
						</tr>
						<tr>
							<th>총 결제금액</th>
							<td><!--<?=number_format($total_pay)?>--> <?=number_format($lec[lec_pay])?>원 (VAT 없음)</td>
						</tr>
						<tr>
							<th>성명</th>
							<td><?=$_POST[order_name]?></td>
						</tr>
						<tr>
							<th>회사기관명</th>
							<td><?=$_POST[order_company]?></td>
						</tr>
						<tr>
							<th>직책</th>
							<td><?=$_POST[order_position]?></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><?=$_POST[order_email]?></td>
						</tr>
						<tr>
							<th>휴대번호</th>
							<td><?=$_POST[order_mobile]?></td>
						</tr>
						<tr>
							<th>추천인</th>
							<td><?=$_POST[order_referral]?></td> <!-- 추가한것 -->
						</tr>
						<tr>
							<th>남기실말씀</th>
							<td><?=$_POST[order_content]?></td>
						</tr>
					</table>
					<div class="view_btn_wrap" id="display_pay_button">
						<a class="view_btn_cancel" href="resist.php">취소하기</a>
						<a class="view_btn_payment" href="javascript:sub_form(document.up_form);">수강신청</a>
					</div>
				</form>
			</div>
		</div><!-- //r_section1 -->
		
	</div><!-- //contents -->

	<div id="footer">
		<div class="footer_logo"><a href="/mobile/curriculum.php">
			<img src="/mobile/images/main/footer_logo.jpg" alt="주식회사 블록체인투자연구소">
		</a></div>
		<div class="fooer_sns">
			<span><a href="<?=$link[li_link]?>" target="<?=$link[li_target]?>"><img src="/mobile/images/main/f_sns01.jpg" alt="blog"></a></span>
			<span><a href="<?=$link[li_link2]?>" target="<?=$link[li_target2]?>"><img src="/mobile/images/main/f_sns02.jpg" alt="facebook"></a></span>
			<span><a href="<?=$link[li_link3]?>" target="<?=$link[li_target3]?>"><img src="/mobile/images/main/f_sns03.jpg" alt="kakao"></a></span>
			<span><a href="<?=$link[li_link4]?>" target="<?=$link[li_target4]?>"><img src="/mobile/images/main/f_sns04.jpg" alt="instagram"></a></span>
		</div>
		<div class="f_menu">
			<span><a href="/mobile/academy.php#section1">회사소개</a></span>
			<span><a href="/mobile/academy.php#section4">Team</a></span>
			<span><a href="/mobile/curriculum.php#c_section4">파트너</a></span>
			<span><a href="/mobile/curriculum.php#c_section1">과정개요</a></span>
			<span><a href="/mobile/curriculum.php#c_section2">커리큘럼</a></span>
		</div>
		<div class="f_btn">
			<div class="f-button"><a href="/mobile/resist.php">과정등록<img src="/mobile/images/main/f_arrow.png" alt=">"></a></div>
			<div class="footer_lang">
				<div class="footer_lang_tit"><span>KOR</span></div>
				<div class="footer_lang_list">
					<p><a href="/mobile/academy.php">KOR</a></p>
					<p><a href="#">ENG</a></p>
				</div>
			</div>
		</div><!-- //f_btn -->
		<address>
		서울특별시 영등포구 국제금융로6길 33, 9층 25호 블록체인투자연구소<br/>
		TEL : 02-783-2792   |    FAX : 02-783-2793<br/>
		E-mail : ik@dconference.io
		</address>
		<p class="copyright">Coyprihts 2019 DConference. All rights reserved.</p>
	</div><!-- //footer -->

</div><!-- //wrap -->


<script>
$(document).ready(function(){
	$('#visual').bxSlider({
		mode:'fade',
		pager:false,
		controls:false,
		autoControls: false
	});		
	$('.visual_text').addClass('on');

	$('.footer_lang_tit').click(function(){
		$('.footer_lang_list').fadeToggle('fast');
	})
	
});

function sub_form(form){
	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/resist_update.php";
	<? }else{ ?>
		form.action = "./resist_update.php";
	<? } ?>

	form.submit();
}
</script>


<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php"; ?>

