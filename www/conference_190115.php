<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

?>
<div id="wrap">
	<div id="header">
		<div class="inner">
			<h1 class="logo"><a href="/conference.php">
				<img src="/images/main/logo.png" alt="주식회사 블록체인투자연구소" />
			</a></h1>
			<div class="h-button"><a href="#">강의신청</a></div>
			<div class="lang">
				<div class="lang_tit"><span>KOR</span></div>
				<div class="lang_list">
					<p><a href="#">KOR</a></p>
					<p><a href="#">ENG</a></p>
				</div>
			</div>
			<? include $_SERVER["DOCUMENT_ROOT"]."/gnb.php"; ?>
		</div><!-- //inner -->
	</div><!-- //header -->

	<script>
		$('.lang_tit').click(function(){
			$('.lang_list').fadeToggle('fast');
		});
	</script>
	
	<div id="visual_wrap">
		<link rel="stylesheet" href="/css/main_slider.css" type="text/css">		
		<script type="text/javascript" src="/css/js/bxslider.js"></script>

		<ul id="visual">
			<li><p style="background:url(/images/main/visual01.jpg) center top no-repeat; height:980px;"></p></li>
			<li><p style="background:url(/images/main/visual02.jpg) center top no-repeat; height:980px;"></p></li>
			<li><p style="background:url(/images/main/visual03.jpg) center top no-repeat; height:980px;"></p></li>
		</ul>
		<ul class="visual_btn clfix">
			<li class="visual_btn01"><a href="#">투자자과정 강의신청</a></li>
			<li class="visual_btn02"><a href="#">투자자과정 커리큘럼</a></li>
		</ul>
	</div><!-- //visual_wrap -->
	<script>
		$(document).ready(function(){
			$('#visual').bxSlider({
				mode:'fade',
				pager:true,
				controls:false,
				autoControls: false
			});
		});
	</script>

	<div id="contents">
		<div id="c_section1">
			<div class="inner">
				<div class="m_tit">
					<span>01</span>
					<h2>ABOUT US</h2>
				</div>
				<em>
					배우면서 네트워킹하세요
				</em>
				<p>
				블록체인 기술의 활용사례는 금융, 유통, 게임, 에너지, 의료서비스 등<br/>
				산업 전반에 걸쳐 기하급수적으로 증가하고있습니다.<br/>
				DConference 아카데미는 세계적인 블록체인 투자전문가와 관련 분야의 산업 전문가를<br/> 
				한 자리에 모아 깊이있는 강연과 토론의 장을 제공하고자 합니다.<br/>
				블록체인 투자와 관련 산업 분야에 관심있는 기업인과 투자자를 수강생으로 모십니다.
				</p>
				<img src="/images/main/c_sec1_img.jpg" alt="">
			</div><!-- //inner -->
		</div><!-- //c_section1 -->

		<div id="c_section2">
			<div class="inner">
				<div class="m_tit black">
					<span>02</span>
					<h2>CURRICULUM</h2>
				</div>
				<div class="c_sec2_con">
					<img src="/images/main/c_sec2_con.jpg" alt="">
				</div><!-- //c_sec2_con -->
				<div class="c_sec2_btn"><a href="#">커리큘럼 다운로드</a></div>
			</div><!-- //inner -->
		</div><!-- //section2 -->

		<div id="section-edu" class="c-section-edu">
			<div class="inner">
				<div class="edu_txt">
					<h3>EDUCATION</h3>
					<P>
						세계적인 블록체인 투자전문가 및 관련 분야의<br/>
						산업전문가가 교육합니다.
					</P>
					<ul class="edu_btn clfix">
						<li class="edu_btn01"><a href="#">강의신청</a></li>
						<li class="edu_btn02"><a href="#">커리큘럼 다운로드</a></li>
					</ul>
				</div><!-- //edu_txt -->				
				<div class="edu_cont">
					<img src="/images/main/edu_cont.jpg" alt="">
				</div>
			</div><!-- //inner -->
		</div><!-- //section-edu -->

		<div id="c_section3">		
			<div class="inner">
				<div class="m_tit black">
					<span>03</span>
					<h2>LECTURER</h2>
				</div>	
				<div class="c_sec3_con">
					<img src="/images/main/c_sec3_con.jpg" alt="">
				</div><!-- //c_sec3_con -->
			</div><!-- //inner -->
		</div><!-- //section3 -->

		<div id="c_section4">
			<div class="inner">
				<div class="m_tit black">
					<span>04</span>
					<h2>PARTNERS</h2>
				</div>
				<div class="c_sec4_con">
					<img src="/images/main/c_sec4_con.jpg" alt="">
				</div><!-- //c_sec2_con -->				
			</div><!-- //inner -->
		</div><!-- //c_section4 -->

	</div><!-- //contents -->

	<div id="footer">
		<div class="inner">
			<div class="footer_logo"><a href="/conference.php">
				<img src="/images/main/footer_logo.jpg" alt="주식회사 블록체인투자연구소" />
			</a></div>
			<div class="footer_sns">
				<span><a href="#"><img src="/images/main/sns01.jpg" alt="블로그"></a></span>
				<span><a href="#"><img src="/images/main/sns02.jpg" alt="페이스북"></a></span>
				<span><a href="#"><img src="/images/main/sns03.jpg" alt="카카오톡"></a></span>
				<span><a href="#"><img src="/images/main/sns04.jpg" alt="인스타그램"></a></span>
			</div>
			<div class="footer_top">
				<span><a href="/conference.php">강의</a></span>
				<span><a href="/main.php">회사소개</a></span>
				<?if($PHP_SELF=="/main.php"){?>
				<span><a href="#section5" class="anchorLink">Contact</a></span>
				<?}else {?>
				<span><a href="/main.php#section5">Contact</a></span>
				<?}?>				
			</div>
			<div class="f-button"><a href="#">강의신청</a></div>
			<div class="footer_lang">
				<div class="footer_lang_tit"><span>KOR</span></div>
				<div class="footer_lang_list">
					<p><a href="#">KOR</a></p>
					<p><a href="#">ENG</a></p>
				</div>
			</div>
			<address>
			서울특별시 영등포구 국제금융로6길 33, 9층 25호 블록체인투자연구소<br/>
			TEL : 02-783-2792<span>|</span>FAX : 02-783-2793<span>|</span>E-mail : ik@dconference.io
			</address>
			<p class="copyright">Coyprihts 2019 DConference. All rights reserved.</p>
		</div><!-- //inner -->
	</div><!-- //footer -->

	<script>
		$('.footer_lang_tit').click(function(){
			$('.footer_lang_list').fadeToggle('fast');
		});
	</script>

</div><!-- //wrap -->


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>