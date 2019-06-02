<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	if(!$no) alert("잘못된 접근입니다.","/mobile/academy.php");
	$sql = "select * from Gn_Lecture where lec_no = '$no'";
	$lec = sql_fetch($sql);

	$vat = $lec[lec_pay] * 0.1;
	$total_pay = $lec[lec_pay] + $vat;

	//계좌안내
	$sql = "select * from Gn_Page_Item where pg_no = 5";
	$pg = sql_fetch($sql);

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
			<p class="r_section_top_txt">다음의 절차에 따라 <em>등록 양식을 작성</em>해주세요</p>
			<div class="resist_con">
				<form name="resist" method="POST" enctype="multipart/form-data" validate="UTF-8">
					<input type="hidden" name="order_lec" value="<?=$no?>">
					<input type="hidden" name="emailChk" id="emailChk" value="">
					<input type="hidden" name="order_tax" value="<?=$vat?>">
					<input type="hidden" name="total_pay" value="<?=$total_pay?>">
					<input type="hidden" name="order_pay" value="<?=$order_pay?>">
					<input type="hidden" name="lec_no" value="<?=$lec[lec_no]?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list form">
						<colgroup>
							<col width="50%" />
							<col width="25%" />
							<col width="25%" />
						</colgroup>
						<tr>
							<th>과정</th>
							<th>과정일정</th>
							<th>가격</th>
						</tr>
						<tr>
							<td><?=$lec[lec_subject]?></td>
							<td><?=substr($lec[lec_frDT],0,10)?> <br />
							~ <?=substr($lec[lec_enDT],0,10)?></td>
							<td class="bold"><?=number_format($lec[lec_pay])?>원</td>					
						</tr>
					</table>

					<div class="price_box">
						<div class="price">
							<ul>
								<li>VAT 10% <span><?=number_format($vat)?>원</span></li>
							</ul>
						</div>
						<div class="price_total">
							<ul>
								<li>총 구매금액 <span><?=number_format($lec[lec_pay])?>원</span></li>
								<li>총 결제금액 <span><?=number_format($total_pay)?>원</span></li>
							</ul>
						</div>
					</div>

					<div class="sub-tit"><h3>등록자</h3></div>
					<div class="form01">
						<div class="form_line">
							<strong class="pt0">성명<span>＊</span></strong>
							<span class=""><input type="text" name="order_name"></span>
							<strong>회사/기관명<span>＊</span></strong>
							<span><input type="text" name="order_company"></span>
						</div>
						<div class="form_line">
							<strong class="">이메일<span>＊</span></strong>
							<span class=""><input type="text" name="order_email" onblur = "blur_email_input(this.value)"></span>
							<strong>휴대폰번호<span>＊</span></strong>						
							<span><input type="text" name="order_mobile"></span>
							&nbsp;<br><span id="email_valid_result_area"></span>
						</div>
						<div class="form_line">
							<strong style="width:100%;">남기실 말씀</strong>
							<span style="width:100%;">
								<textarea name="order_content"></textarea>
							</span>					
						</div>
					</div>
				<div class="form-btn"><a href="javascript:writeChk(document.resist);">다음</a></div>
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
			<span><a href="<?=$link[li_link3]?>" target="<?=$link[li_target3]?>"></a></span>
			<span><a href="<?=$link[li_link4]?>" target="<?=$link[li_target4]?>"></a></span>
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
		서울특별시 서초구 방배로 117 (방배동) 전자조합회관3층<br/>
		TEL : 02.523.2825   |    FAX : 02.523.2863<br/>
		E-mail : gamgak2825@naver.com
		</address>
		<p class="copyright">Coyprihts 2018 Gamgakdesign. All rights reserved.</p>
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

function writeChk(form) {
    if (typeof(form.order_name) != 'undefined') {
		if(!form.order_name.value) {
			alert('성명을 입력하세요');
			form.order_name.focus();
			return false;
		}
	}
	if (typeof(form.order_company) != 'undefined') {
		if(!form.order_company.value) {
			alert('회사/기관명을 입력하세요');
			form.order_company.focus();
			return false;
		}
	}
	if (typeof(form.order_email) != 'undefined') {
		if(!form.order_email.value) {
			alert('이메일을 입력하세요');
			form.order_email.focus();
			return false;
		}
	}
	if (typeof(form.order_mobile) != 'undefined') {
		if(!form.order_mobile.value) {
			alert('휴대폰번호를 입력하세요');
			form.order_mobile.focus();
			return false;
		}
	}

	//if(!ridiaChk(form.payment_method,"결제방법을 선택해주세요")) return;

	if (typeof(form.emailChk) != 'undefined') {
		if(form.emailChk.value != "Y") {
			alert('이메일을 다시 입력하세요');
			form.order_email.focus();
			return false;
		}
	}

	form.action = "./resist03.php";

	form.submit();
	return;
}

/* ------------------------------------------------------------- [ 이메일 정규식 체크 - Start ] ------------------------------------------------------------- */
function blur_email_input(value){
	$.ajax({
		type:"POST",
		url:"/GnAjax/check_valid/email_value.php",

		data:
		{
			email: value
		},

		success:function(result) {
			if (result=="true"){
				$("#email_valid_result_area").css("color","blue").html("사용가능한 이메일 주소입니다.");
				$("#emailChk").attr("value","Y");
			} else {
				$("#email_valid_result_area").css("color","#ff0000").html("이메일 형식이 올바르지 않습니다.");
				$("#emailChk").attr('value','');
			}
		}
	});
};
</script>


<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php"; ?>

