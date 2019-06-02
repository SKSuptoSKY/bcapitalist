<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	//메인 이미지
	$r_list = get_rolling_list(0);
	
	//첨부 파일
	$sql = "select * from Gn_Curriculum_File where f_no=5";
	$file = sql_fetch($sql);

	//page_item (Education)
	$sql = "select * from Gn_Page_Item where pg_no = 1";
	$page = sql_fetch($sql);

	//Team 
	$sql = "select * from Gn_Product_Item where ca_id = '10' and it_use ='1' order by it_order desc, it_id desc";
	$result = sql_query($sql);
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list_it1[$i] = $row;
		$list_it1[$i][it_explan] = explode("\n",$list_it1[$i][it_explan]);
	}
	$sql = "select * from Gn_Product_Item where ca_id = '20' and it_use ='1' order by it_order desc, it_id desc";
	$result = sql_query($sql);
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list_it2[$i] = $row;
		$list_it2[$i][it_explan] = explode("\n",$list_it2[$i][it_explan]);
	}
	$sql = "select * from Gn_Product_Item where ca_id = '30' and it_use ='1' order by it_order desc, it_id desc";
	$result = sql_query($sql);
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list_it3[$i] = $row;
		$list_it3[$i][it_explan] = explode("\n",$list_it3[$i][it_explan]);
	}

	//Gallery
	$g_list = get_rolling_gallery(2);
	
	//Gallery 이미지 Resize
	$frame_width = 900;
	$frame_height = 450;

	$frame_ratio = $frame_width/$frame_height;

	for($i=0; $i<count($g_list); $i++){

		$img_info = getimagesize($_SERVER["DOCUMENT_ROOT"].$g_list[$i]["img_src"]);

		if($frame_ratio>$img_info[0]/$img_info[1]){
			$ratio_style[$i] = " style='width:auto; height:".$frame_height."px;' ";
		}else{
			$ratio_style[$i] = " style='width:".$frame_width."px; height:auto;' ";
		}
	}

?>
<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
	
	<div id="visual_wrap">
		<link rel="stylesheet" href="/css/main_slider.css" type="text/css">		
		<script type="text/javascript" src="/css/js/bxslider.js"></script>

		<ul id="visual">
			<?for($i=0; $i<count($r_list); $i++){?>
				<li><p style="background:url(<?=$r_list[$i]["img_src"]?>) center top no-repeat; height:980px;"></p></li>
			<?}?>
		</ul>
		<ul class="visual_btn clfix">
			<li class="visual_btn01"><a href="#">투자자과정 과정등록</a></li>
			<li class="visual_btn02">
				<a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">투자자과정 커리큘럼</a>
			</li>
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
				<div class="m_tit black">
					<span>01</span>
					<h2>회사소개</h2>
				</div>
				<div class="sec1_con">
					<img src="/images/main/aboutus_no_img01.jpg" alt="">
				</div> <!-- // sec1_con -->
			</div><!-- //inner -->
		</div><!-- //section1 -->

		<div id="section2">
			<div class="inner">
				<div class="m_tit black">
					<span>02</span>
					<h2>서비스</h2>
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
					<h3>모집요강</h3>
					<P>
						세계적인 블록체인 투자전문가 및 관련 분야의<br/>
						산업전문가가 교육합니다.
					</P>
				</div><!-- //edu_txt -->
				<div class="edu_cont">
					<?=$page[pg_content]?>
				</div>
			</div><!-- //inner -->
		</div><!-- //section-edu -->

		<div id="section3">		
			<div class="inner">
				<div class="m_tit black">
					<span>03</span>
					<h2>팀소개</h2>
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
								<?for($i=0; $i<count($list_it1); $i++){?>
									<li>
										<img src="/product/data/item/<?=$list_it1[$i][it_id]?>/<?=$list_it1[$i][it_file1]?>" alt="">
										<div class="slider_txt">
											<h3><?=$list_it1[$i][it_name]?></h3>
											<span><?=$list_it1[$i][it_ex1]?></span>
										</div>
										<div class="slider_hover">
											<strong>약력</strong>
											<?for($a=0; $a<count($list_it1[$i][it_explan]); $a++){?>
												<span><a href="javascript:" style="cursor:default;"><?=$list_it1[$i][it_explan][$a]?></a></span>
											<?}?>
										</div>
									</li>
								<?}?>
							</ul>
						</div>
					</div>
					<div class="clfix"><!-- 고문 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider02">
								<?for($i=0; $i<count($list_it2); $i++){?>
									<li>
										<img src="/product/data/item/<?=$list_it2[$i][it_id]?>/<?=$list_it2[$i][it_file1]?>" alt="">
										<div class="slider_txt">
											<h3><?=$list_it2[$i][it_name]?></h3>
											<span><?=$list_it2[$i][it_ex1]?></span>
										</div>
										<div class="slider_hover">
											<strong>약력</strong>
											<?for($a=0; $a<count($list_it2[$i][it_explan]); $a++){?>
												<span><a href="javascript:" style="cursor:default;"><?=$list_it2[$i][it_explan][$a]?></a></span>
											<?}?>
										</div>
									</li>
								<?}?>
							</ul>
						</div>
					</div>
					<div class="clfix"><!-- 팀원 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider03">
								<?for($i=0; $i<count($list_it3); $i++){?>
									<li>
										<img src="/product/data/item/<?=$list_it3[$i][it_id]?>/<?=$list_it3[$i][it_file1]?>" alt="">
										<div class="slider_txt">
											<h3><?=$list_it3[$i][it_name]?></h3>
											<span><?=$list_it3[$i][it_ex1]?></span>
										</div>
										<div class="slider_hover">
											<strong>약력</strong>
											<?for($a=0; $a<count($list_it3[$i][it_explan]); $a++){?>
												<span><a href="javascript:" style="cursor:default;"><?=$list_it3[$i][it_explan][$a]?></a></span>
											<?}?>
										</div>
									</li>
								<?}?>
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
							minSlides: 3,
							maxSlides: 3,
							moveSlides: 1,
							slideWidth: 384,
						});
						bx_slider02 = $('.slider02').bxSlider({
							auto:false,
							pager:false,
							controls:true,
							autoControls: false,
							minSlides: 3,
							maxSlides: 3,
							moveSlides: 1,
							slideWidth: 384,
						});
						bx_slider03 = $('.slider03').bxSlider({
							auto:false,
							pager:false,
							controls:true,
							autoControls: false,
							minSlides: 3,
							maxSlides: 3,
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
					<h2>갤러리</h2>
				</div>

				<div class="cascade-slider_container" id="cascade-slider" >
					<div class="cascade-slider_slides">
						<?for($i=0; $i<count($g_list); $i++){?>
							<div class="cascade-slider_item">
								<div class="cascade-slider_slides_img"><a href="#">
									<img src="<?=$g_list[$i]["img_src"]?>" alt="" <?=$ratio_style[$i]?>>
								</a></div>	
								<h3><?=$g_list[$i][bn_subject]?></h3>
								<span><?=$g_list[$i][bn_content]?></span>
							</div>
						<?}?>
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
					9층 25호 블록체인투자센터
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

	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>

</div><!-- //wrap -->


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>