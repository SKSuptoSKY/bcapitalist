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
			<h1 class="logo"><a href="/main.php">
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
		<div id="section1">
			<div class="inner">
				<div class="m_tit">
					<span>01</span>
					<h2>ABOUT US</h2>
				</div>
				<p>
				DConference 는 모든 블록체인 생태계를 위한 교육, 파이낸싱, 마케팅 플랫폼입니다.<br/>
				투자자와 사업자를 양성하고, 블록체인 프로젝트가 필요로 하는 여러 기능을 매칭방식으로 지원합니다.<br/>
				 DConference 의 미션은 지식 공유의 장과 의미있는 파트너십 형성의 기회를 창조함으로써<br/>
				 글로벌 블록체인 커뮤니티의 진보에 기여하는것입니다.
				</p>
				<div class="sec1_con">
					<img src="/images/main/sec1_con_bg.jpg" alt="">
					<div class="sec1_box sec1_box01">
						<div class="sec1_tit">
							<h3>시장</h3>
						</div>
						<ul>
							<li>파트너</li>
							<li>기업</li>
							<li>사용자</li>
						</ul>
					</div>

					<div class="sec1_box sec1_box02">
						<div class="sec1_tit">
							<h3>
								BLOCK CHAIN<br/>
								PROJECT
							</h3>
						</div>
						<ul>
							<li>ICO</li>
							<li>Reverse ICO</li>
							<li>STO</li>
							<li>IEO</li>
						</ul>
					</div>

					<div class="sec1_box sec1_box03">
						<div class="sec1_tit">
							<h3>투자자</h3>
						</div>
						<ul>
							<li>기관투자자</li>
							<li>기업투자자</li>
							<li>고액자산과</li>
							<li>엔젤투자자</li>
						</ul>
					</div>

					<div class="sec1_box sec1_box04">
						<div class="sec1_tit">
							<h3>
								정부<br/>
								변호사<br/>
								엑셀러레이터<br/>
								컨설턴트
							</h3>
						</div>							
					</div>

					<div class="sec1_box sec1_box05">
						<div class="sec1_tit">
							<h3>거래소</h3>
						</div>							
					</div>
					
					<strong class="sec1_strong01">마케팅</strong>
					<strong class="sec1_strong02">투자</strong>
					<strong class="sec1_strong03">제휴서비스</strong>
					<strong class="sec1_strong04">상장</strong>
				</div>
			</div><!-- //inner -->
		</div><!-- //section1 -->

		<div id="section2">
			<div class="inner">
				<div class="m_tit black">
					<span>02</span>
					<h2>SERVICE</h2>
				</div>
				<div class="sec2_con clfix">
					<div class="sec2_tit">
						<h3>CONFERENCE</h3>
						<p>
						투자자에게는 투자대상 발굴 기회를,<br/>
						기업에게는 기존사업의 블록체인화를 통한<br/> 
						신규사업 발굴 기회를 제공하는 것을 목적으로 합니다.<br/> 
						펀딩, 마케팅, 상장을 위한 참가자간의 매칭을 제공합니다.
						</p>
					</div>
					<ul class="sec2_txt clfix">
						<li>
							<div class="sec2_img">
								<img src="/images/main/sec2_icon01.jpg" alt="">
							</div>
							<h4>프로젝트 스폰서</h4>
							<p>
							입증된 프로젝트는 발표를 통한 홍보 및<br/>
							펀딩뿐 아니라 글로벌 기업들과 전략적<br/>
							파트너십 형성의 기회를 얻습니다.
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/images/main/sec2_icon02.jpg" alt="">
							</div>
							<h4>기업참가자</h4>
							<p>
							기업참가자들은 블록체인을 심도있게 이해<br/>
							하게 되며, 블록체인 사업, 펀딩 및 토큰<br/>
							이코노미 모델을 만들고, 입증된 블록체인<br/> 
							스타트업과  파트너십 체결의 기회를 얻습니다.
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/images/main/sec2_icon03.jpg" alt="">
							</div>
							<h4>거래소</h4>
							<p>
							거래소는 현재 입증된 블록체인 및<br/>
							잠재적으로 리버스 ICO를 행할 글로벌<br/>
							기업들을 상장고객으로 모집 가능합니다.
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/images/main/sec2_icon04.jpg" alt="">
							</div>
							<h4>크립토펀드</h4>
							<p>
							크립토펀드는 입증된 블록체인 스타트업에<br/> 
							건전한 투자를 유치할 수 있고,  잠재적으로<br/> 
							리버스 ICO 를 행할 글로벌 기업들을 블루오션<br/>
							투자처로 모집할 수 있습니다.
							</p>
						</li>
					</ul>
				</div>			
			</div><!-- //inner -->
		</div><!-- //section2 -->

		<div id="section-edu">
			<div class="inner">
				<div class="edu_txt">
					<h3>EDUCATION</h3>
					<P>
						세계적인 블록체인 투자전문가 및 관련 분야의<br/>
						산업전문가가 교육합니다.
					</P>
				</div><!-- //edu_txt -->				
				<div class="edu_cont">
					<img src="/images/main/edu_cont.jpg" alt="">
				</div>
			</div><!-- //inner -->
		</div><!-- //section-edu -->

		<div id="section3">		
			<div class="inner">
				<div class="m_tit black">
					<span>03</span>
					<h2>TEAM</h2>
				</div>
				<ul class="tab clfix">
					<li class="on"><span>경영진</span></li>
					<li><span>고문</span></li>
					<li><span>팀원</span></li>
				</ul>	

				<div class="tab_con">
					<div class="clfix"><!-- 경영진 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider01">
								<li>
									<img src="/images/main/img01.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img02.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img03.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>								
							</ul>
						</div>
					</div>
					<div class="clfix"><!-- 고문 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider02">
								<li>
									<img src="/images/main/img01.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img02.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img03.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>								
							</ul>
						</div>
					</div>
					<div class="clfix"><!-- 팀원 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider03">
								<li>
									<img src="/images/main/img01.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img02.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>
								<li>
									<img src="/images/main/img03.jpg" alt="">
									<div class="slider_txt">
										<h3>Name Name</h3>
										<span>Professor at Cornell University</span>
									</div>
									<div class="slider_hover">
										<strong>약력</strong>
										<span><a href="#">약력1 입니다.</a></span>
										<span><a href="#">약력2 입니다.</a></span>
										<span><a href="#">약력3 입니다.</a></span>
										<span><a href="#">약력4 입니다.</a></span>
										<span><a href="#">약력5 입니다.</a></span>
										<span><a href="#">약력6 입니다.</a></span>
									</div>
								</li>								
							</ul>
						</div>
					</div>
				</div><!-- //tab_con -->

				<script>
					var cnt = 0;
					$('.tab_con > div').hide().eq(0).show();
					$('.tab li').click(function() {
						cnt = $(this).index()
						$('.tab li').removeClass('on').eq(cnt).addClass('on');
						$('.tab_con > div').hide().eq(cnt).fadeIn();
						bx_slider01.reloadSlider();
						bx_slider02.reloadSlider();
						bx_slider03.reloadSlider();
					});
					
					var bx_slider01;
					var bx_slider02;
					var bx_slider03;
					$(document).ready(function(){
						bx_slider01 = $('.slider01').bxSlider({
							auto:false,
							pager:false,
							controls:true,
							autoControls: false,
							minSlides: 5,
							maxSlides: 5,
							moveSlides: 1,
							slideWidth: 384,
						});
						bx_slider02 = $('.slider02').bxSlider({
							auto:false,
							pager:false,
							controls:true,
							autoControls: false,
							minSlides: 5,
							maxSlides: 5,
							moveSlides: 1,
							slideWidth: 384,
						});
						bx_slider03 = $('.slider03').bxSlider({
							auto:false,
							pager:false,
							controls:true,
							autoControls: false,
							minSlides: 5,
							maxSlides: 5,
							moveSlides: 1,
							slideWidth: 384,
						});
					});

					$(document).on("mouseenter", ".slider li", function(e) {
						$(this).find('.slider_hover').stop(true,true).fadeIn();
						$(this).find('.slider_txt').stop(true,true).fadeOut();
					});

					$(document).on("mouseleave", ".slider li", function(e) {
						$(this).find('.slider_hover').stop(true,true).fadeOut();
						$(this).find('.slider_txt').stop(true,true).fadeIn();
					});				

				</script>			
			</div><!-- //inner -->
		</div><!-- //section3 -->

		<div id="section4">
			<div class="inner">
				<div class="m_tit">
					<span>04</span>
					<h2>GALLERY</h2>
				</div>

				<div class="cascade-slider_container" id="cascade-slider" >
					<div class="cascade-slider_slides">
						<div class="cascade-slider_item">
							<div class="cascade-slider_slides_img"><a href="#">
								<img src="/images/main/gallery01.jpg" alt="">
							</a></div>	
							<h3>프로젝트 스폰서</h3>
							<span>입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라 글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.</span>
						</div>
						<div class="cascade-slider_item">
							<div class="cascade-slider_slides_img"><a href="#">
								<img src="/images/main/gallery01.jpg" alt="">
							</a></div>	
							<h3>프로젝트 스폰서2</h3>
							<span>입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라 글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.</span>
						</div>
						<div class="cascade-slider_item">
							<div class="cascade-slider_slides_img"><a href="#">
								<img src="/images/main/gallery01.jpg" alt="">
							</a></div>	
							<h3>프로젝트 스폰서3</h3>
							<span>입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라 글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.</span>
						</div>
						<div class="cascade-slider_item">
							<div class="cascade-slider_slides_img"><a href="#">
								<img src="/images/main/gallery01.jpg" alt="">
							</a></div>	
							<h3>프로젝트 스폰서4</h3>
							<span>입증된 프로젝트는 발표를 통한 홍보 및 펀딩뿐 아니라 글로벌 기업들과 전략적 파트너십 형성의 기회를 얻습니다.</span>
						</div>
					</div>
					<span class="cascade-slider_arrow cascade-slider_arrow-left" data-action="prev"></span>
					<span class="cascade-slider_arrow cascade-slider_arrow-right" data-action="next"></span>
				</div><!-- //cascade-slider -->				
			</div><!-- //inner -->
		</div><!-- //section4 -->
		
		<script src="/css/js/cascade-slider.js"></script>
		<script>
			$(document).ready(function(){
				$('#cascade-slider').cascadeSlider({
				});			
			});
		</script>

		<div id="section5">			
			<div class="m_tit black">
				<span>05</span>
				<h2>CONTACT</h2>
			</div>
			<div class="map_wrap">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.4554140782766!2d126.9247043157141!3d37.52076057980633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9f3dfb883601%3A0xc4b6bbf69bd8b4f5!2z7ISc7Jq47Yq567OE7IucIOyYgeuTse2PrOq1rCDsl6zsnZjrj4Trj5kg6rWt7KCc6riI7Jy166GcNuq4uCAzMyA57Li1IDI17Zi4!5e0!3m2!1sko!2skr!4v1547173715425" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div><!-- //map_wrap -->			
			<div class="contact">
				<div class="contanct_inner">
					<div class="contact_btn"></div>
					<strong class="mt0">ADDRESS</strong>
					<P>
					서울특별시 영등포구 국제금융로6길 33,<br/>
					9층 25호 블록체인투자연구소
					</P>

					<strong>E-MAIL</strong>
					<P>
					ik@dconference.io
					</P>

					<strong>TEL</strong>
					<P>
					02-783-2792 
					</P>

					<strong>MOBILE</strong>
					<P>
					010-4952-4681
					</P>

					<strong>FAX</strong>
					<P>
					02-783-2793
					</P>
				</div>
			</div><!-- //contact -->		
		</div><!-- //section5 -->

		<script>
		$('.contact_btn').click(function() {
			$(this).toggleClass('on');
			$('.contact').toggleClass('on');
		});
		</script>

	</div><!-- //contents -->

	<div id="footer">
		<div class="inner">
			<div class="footer_logo"><a href="/main.php">
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