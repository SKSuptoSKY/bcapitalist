<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
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
			<li><img src="/mobile/images/main/visual.jpg" style="width:100%;" alt=""></li>
			<li><img src="/mobile/images/main/visual.jpg" style="width:100%;" alt=""></li>
			<li><img src="/mobile/images/main/visual.jpg" style="width:100%;" alt=""></li>
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
		<div id="section1">
			<div class="m_tit">
				<em>01</em>
				<h2>ABOUT COURSE</h2>
			</div>
			<div class="about_con">
				<img src="/mobile/images/main/about_area.jpg" style="width:100%;" alt="">
			</div>
		</div><!-- //section1 -->

		<div id="section2">
			<div class="m_tit">
				<em>02</em>
				<h2>SERVICE</h2>
				<strong>CONFERENCE</strong>
				<p>
				투자자에게는 투자대상 발굴 기회를,<br />
				기업에게는 기존사업의 블록체인화를 통한<br />
				신규사업 발굴 기회를 제공하는 것을 목적으로 합니다.<br />
				펀딩, 마케팅, 상장을 위한 참가자간의 매칭을 제공합니다.
				</p>
			</div>
			<div class="service_con">
				<div class="service_box">
					<dl>
						<dt><img src="/mobile/images/main/service_icon1.jpg" alt=""></dt>
						<dd>
							<strong>프로젝트 스폰서</strong>
							입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라 글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.
						</dd>
					</dl>
				</div>
				<div class="service_box">
					<dl>
						<dt><img style="width:51px;" src="/mobile/images/main/service_icon2.jpg" alt=""></dt>
						<dd>
							<strong>기업참가자</strong>
							기업참가자들은 블록체인을 심도있게 이해 하게 되며, 블록체인 사업, 펀딩 및 토큰 이코노미 모델을 만들고, 입증된 블록체인 스타트업과 파트너십 체결의 기회를 얻습니다.
						</dd>
					</dl>
				</div>
				<div class="service_box">
					<dl>
						<dt><img style="width:55px;" src="/mobile/images/main/service_icon3.jpg" alt=""></dt>
						<dd>
							<strong>거래소</strong>
							거래소는 현재 입증된 블록체인 및 잠재적으로 리버스 ICO를 행할 글로벌 기업들을 상장고객으로 모집 가능합니다.
						</dd>
					</dl>
				</div>
				<div class="service_box">
					<dl>
						<dt><img style="width:60px" src="/mobile/images/main/service_icon4.jpg" alt=""></dt>
						<dd>
							<strong>크립토펀드</strong>
							크립토펀드는 입증된 블록체인 스타트업에 건전한 투자를 유치할 수 있고, 잠재적으로 리버스 ICO 를 행할 글로벌 기업들을 블루오션 투자처로 모집할 수 있습니다.
						</dd>
					</dl>
				</div>
			</div>
		</div><!-- //section2 -->

		<div id="section3">
			<div class="outline_title">
				<h2>OUTLINE</h2>
				<p>세계적인 블록체인 투자전문가 및 관련 분야의<br />산업전문가가 교육합니다.</p>
			</div>
			<div class="outline_con">
				<img src="/mobile/images/main/outline.jpg" style="width:100%;" alt="">
			</div>
		</div><!-- //section3 -->

		<div id="section4">
			<div class="m_tit">
				<em>03</em>
				<h2>TEAM</h2>
			</div>
			<div class="team_con">
				<div class="team_tab_wrap">
					<ul class="tab clfix">
						<li>경영진</li>
						<li>고문</li>
						<li>팀원</li>
					</ul>

					<div class="tab_con">
						<!--경영진 -->
						<div class="clfix">
							<ul class="team team01">
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 1</dt>
											<dd>1 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 2</dt>
											<dd>1 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 3</dt>
											<dd>1 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 4</dt>
											<dd>1 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!--//경영진-->

						<!--고문 -->
						<div class="clfix">
							<ul class="team team02">
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 22</dt>
											<dd>21 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 22</dt>
											<dd>22 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 23</dt>
											<dd>23 Professor at<br />Cornell University</dd>
										</dl> 
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!--//고문-->

						<!--팀원-->
						<div class="clfix">
							<ul class="team team03">
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 33</dt>
											<dd>1 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 2</dt>
											<dd>2 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
								<li>
									<div class="img"><img src="/mobile/images/main/team1.jpg" alt=""></div>
									<div class="txt">
										<dl>
											<dt>Name Name 3</dt>
											<dd>3 Professor at<br />Cornell University</dd>
										</dl>
									</div>
									<div class="hover">
										<div class="inner">
											<strong>약력</strong>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
											<span>현, 고려대학교 겸임교수</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!--//팀원-->
					</div><!-- //tab_con -->					
				</div><!-- //team_tab_wrap -->
			</div><!-- //team_con -->
		</div><!-- //section4 -->
				

		<div id="section5">
			<div class="m_tit white">
				<em>04</em>
				<h2>GALLERY</h2>
			</div>
			<div id="g_slider_Wrap">
				<ul class="g_slider">
					<li>
						<div class="img">
							<img src="/mobile/images/main/img.jpg" alt="">
						</div>
						<div class="txt">
							<h3>프로젝트 스폰서</h3>
							<span>
							입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라
							글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.
							</span>
						</div>
					</li>
					<li>
						<div class="img">
							<img src="/mobile/images/main/img.jpg" alt="">
						</div>
						<div class="txt">
							<h3>프로젝트 스폰서2</h3>
							<span>
							입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라
							글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.
							</span>
						</div>
					</li>
					<li>
						<div class="img">
							<img src="/mobile/images/main/img.jpg" alt="">
						</div>
						<div class="txt">
							<h3>프로젝트 스폰서3</h3>
							<span>
							입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라
							글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.
							</span>
						</div>
					</li>
				</ul>
			</div>
		</div><!-- //section5 -->

		<div id="section6">
			<div class="m_tit">
				<em>05</em>
				<h2>CONTACT</h2>
			</div>
			<div class="map_wrap">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.4554140782766!2d126.9247043157141!3d37.52076057980633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9f3dfb883601%3A0xc4b6bbf69bd8b4f5!2z7ISc7Jq47Yq567OE7IucIOyYgeuTse2PrOq1rCDsl6zsnZjrj4Trj5kg6rWt7KCc6riI7Jy166GcNuq4uCAzMyA57Li1IDI17Zi4!5e0!3m2!1sko!2skr!4v1547173715425" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>			
			<div class="contact_wrap">
				<div class="contact_btn"></div>
				<ul class="contact_con">
					<li>
						<strong>ADDRESS</strong>
						<p>
						서울특별시 영등포구 국제금융로6길 33,<br/>
						9층 25호 블록체인투자센터
						</p>
					</li>
					<li>
						<strong>E-MAIL</strong>
						<p>ik@dconference.io</p>
					</li>
					<li>
						<strong>TEL</strong>
						<p>02-783-2792</p>
					</li>
					<li>
						<strong>MOBILE</strong>
						<p>010-4952-4681</p>
					</li>
					<li>
						<strong>FAX</strong>
						<p>02-783-2793</p>
					</li>
				</ul>
			</div>
		</div><!-- //section6 -->
	</div><!-- //contents -->

	<div id="footer">
		<div class="footer_logo"><a href="/mobile/curriculum.php">
			<img src="/mobile/images/main/footer_logo.jpg" alt="주식회사 블록체인투자연구소">
		</a></div>
		<div class="fooer_sns">
			<span><a href="#"><img src="/mobile/images/main/f_sns01.jpg" alt="blog"></a></span>
			<span><a href="#"><img src="/mobile/images/main/f_sns02.jpg" alt="facebook"></a></span>
			<span><a href="#"><img src="/mobile/images/main/f_sns03.jpg" alt="kakao"></a></span>
			<span><a href="#"><img src="/mobile/images/main/f_sns04.jpg" alt="instagram"></a></span>
		</div>
		<div class="f_menu">
			<span><a href="#section1" class="anchorLink">회사소개</a></span>
			<span><a href="#section4" class="anchorLink">Team</a></span>
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
	var bx_slider01;
	var bx_slider02;
	var bx_slider03;
	var cnt = 0;
	bx_slider01 = $('.team01').bxSlider({	
		pager:false,
		controls:true,
		autoControls: false,
		slideMargin:5,
		speed:600
	});
	bx_slider02 = $('.team02').bxSlider({
		pager:false,
		controls:true,
		autoControls: false,
		slideMargin:5,
		speed:600
	});
	bx_slider03 = $('.team03').bxSlider({
		pager:false,
		controls:true,
		autoControls: false,
		slideMargin:5,
		speed:600
	});						
	$('.tab_con > div').hide().eq(0).show()
	$('.tab li').click(function() {
		cnt = $(this).index()
		$('.tab li').removeClass('on').eq(cnt).addClass('on')
		$('.tab_con > div').hide().eq(cnt).fadeIn()
		bx_slider01.reloadSlider();
		bx_slider02.reloadSlider();
		bx_slider03.reloadSlider();
	});
	$('.team li').click(function() {
		$(this).toggleClass('on');
	});
	$('.g_slider').bxSlider({
		mode:'fade',
		pager:false,
		controls:true,
		autoControls: false,
		pause:3500,
		speed:800
	});
	$('.contact_btn').click(function() {
		$('.contact_wrap').toggleClass('on');
	});
	$('.footer_lang_tit').click(function(){
		$('.footer_lang_list').fadeToggle('fast');
	});
	
});					
</script>


<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php"; ?>

