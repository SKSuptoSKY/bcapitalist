<? 
	include $_SERVER["DOCUMENT_ROOT"]."/e_head.lib.php";  
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
	$sql = "select * from Gn_Curriculum_File where f_no=8";
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
		$list_it1[$i][it_explan_en] = explode("\n",$list_it1[$i][it_explan_en]);
	}
	$sql = "select * from Gn_Product_Item where ca_id = '20' and it_use ='1' order by it_order desc, it_id desc";
	$result = sql_query($sql);
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list_it2[$i] = $row;
		$list_it2[$i][it_explan] = explode("\n",$list_it2[$i][it_explan]);
		$list_it2[$i][it_explan_en] = explode("\n",$list_it2[$i][it_explan_en]);
	}
	$sql = "select * from Gn_Product_Item where ca_id = '30' and it_use ='1' order by it_order desc, it_id desc";
	$result = sql_query($sql);
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list_it3[$i] = $row;
		$list_it3[$i][it_explan] = explode("\n",$list_it3[$i][it_explan]);
		$list_it3[$i][it_explan_en] = explode("\n",$list_it3[$i][it_explan_en]);
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
<!-- <h2 style="color:red; font-size:30px; position:absolute; left:30px; top:30px; z-index:999999">영문</h2> -->
<? include $_SERVER["DOCUMENT_ROOT"]."/e_head.php"; ?>
	<div id="visual_wrap">
		<link rel="stylesheet" href="/e_css/main_slider.css" type="text/css">		
		<script type="text/javascript" src="/e_css/js/bxslider.js"></script>

		<ul id="visual">
			<?for($i=0; $i<count($r_list); $i++){?>
				<li><p style="background:url(<?=$r_list[$i]["img_src"]?>) center top no-repeat; height:980px;"></p></li>
			<?}?>
		</ul>
		<ul class="visual_btn clfix">
			<li class="visual_btn01"><a href="#">COURSE REGISTER</a></li>
			<li class="visual_btn02">
				<a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">CURRICULUM</a>
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
				<div class="m_tit">
					<span>01</span>
					<h2>ABOUT US</h2>
				</div>
				<p>
				DConference is education, financing, and marketing platform for blockchain ecosystems.<br/>
				We provide various trainings for blockchain investors and entrepreneurs.<br/>
				DConference’s mission is to contribute to the progress of global blockchain community<br/>
				by providing opportunities to share knowledge and form meaningful partnership.
				</p>
				<div class="sec1_con">
					<img src="/e_images/main/sec1_con_bg.jpg" alt="">
					<div class="sec1_box sec1_box01">
						<div class="sec1_tit">
							<h3>Market</h3>
						</div>
						<ul>
							<li>Partners</li>
							<li>Corporations</li>
							<li>Users</li>
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
							<h3>Investors</h3>
						</div>
						<ul>
							<li>Institutional</li>
							<li>Corporate</li>
							<li>HNWI</li>
							<li>Angel</li>
						</ul>
					</div>

					<div class="sec1_box sec1_box04">
						<div class="sec1_tit">
							<h3>
								Government<br/>
								Lawyer<br/>
								Accelerator<br/>
								Consultants
							</h3>
						</div>							
					</div>

					<div class="sec1_box sec1_box05">
						<div class="sec1_tit">
							<h3>Exchange</h3>
						</div>							
					</div>
					
					<strong class="sec1_strong01">Marketing</strong>
					<strong class="sec1_strong02">Financing</strong>
					<strong class="sec1_strong03">Outsourcing<br/>Other Services</strong>
					<strong class="sec1_strong04">Listing</strong>
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
						Find investment opportunities in<br/>
						promising blockchain startups.<br/>
						Create new business opportunities by<br/>
						applying blockchain to existing businesses.<br/>
						We provide matchmaking between stakeholders<br/>
						for funding, marketing, and listing.
						</p>
					</div>
					<ul class="sec2_txt clfix">
						<li>
							<div class="sec2_img">
								<img src="/e_images/main/sec2_icon01.jpg" alt="">
							</div>
							<h4>Project Sponsors</h4>
							<p>
							On top of pitching, promoting and<br/>
							funding projects, projects can form<br/>
							critical strategic partnerships<br/>
							with established enterprises
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/e_images/main/sec2_icon02.jpg" alt="">
							</div>
							<h4>Corporate Attendees</h4>
							<p>
							Corporate can enhance understanding<br/>
							of blockchain and formulate blockchain<br/>
							business/tech/finance models along<br/>
							with blockchain partnerships
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/e_images/main/sec2_icon03.jpg" alt="">
							</div>
							<h4>Exchanges</h4>
							<p>
							Exchanges can find and secure listing<br/>
							clients from either current blockchain<br/>
							projects or potential reverse-ICOs of<br/>
							corporate participants.
							</p>
						</li>
						<li>
							<div class="sec2_img">
								<img src="/e_images/main/sec2_icon04.jpg" alt="">
							</div>
							<h4>Crypto Funds</h4>
							<p>
							Crypto Funds can find and secure<br/>
							promising investees from either current<br/>
							blockchain projects or potential<br/>
							reverse-ICOs of corporate attendees.
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
						Learn from professional blockchain<br/>
						investors and industry experts
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
					<h2>TEAM</h2>
				</div>
				<ul class="tab clfix">
					<li class="on"><span>LEADERSHIP</span></li>
					<li><span>ADVISORS</span></li>
					<li><span>TEAM MEMBER</span></li>
				</ul>	

				<div class="tab_con">
					<div class="clfix"><!-- 경영진 부분 -->
						<div id="slider_wrap">
							<ul class="slider slider01">
								<?for($i=0; $i<count($list_it1); $i++){?>
									<li>
										<img src="/product/data/item/<?=$list_it1[$i][it_id]?>/<?=$list_it1[$i][it_file1]?>" alt="">
										<div class="slider_txt">
											<h3><?=$list_it1[$i][it_name_en]?></h3>
											<span><?=$list_it1[$i][it_ex1_en]?></span>
										</div>
										<div class="slider_hover">
											<strong>Career</strong>
											<?for($a=0; $a<count($list_it1[$i][it_explan_en]); $a++){?>
												<span><a href="#"><?=$list_it1[$i][it_explan_en][$a]?></a></span>
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
											<h3><?=$list_it2[$i][it_name_en]?></h3>
											<span><?=$list_it2[$i][it_ex1_en]?></span>
										</div>
										<div class="slider_hover">
											<strong>Career</strong>
											<?for($a=0; $a<count($list_it2[$i][it_explan_en]); $a++){?>
												<span><a href="#"><?=$list_it2[$i][it_explan_en][$a]?></a></span>
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
											<h3><?=$list_it3[$i][it_name_en]?></h3>
											<span><?=$list_it3[$i][it_ex1_en]?></span>
										</div>
										<div class="slider_hover">
											<strong>Career</strong>
											<?for($a=0; $a<count($list_it3[$i][it_explan_en]); $a++){?>
												<span><a href="#"><?=$list_it3[$i][it_explan_en][$a]?></a></span>
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
					<h2>GALLERY</h2>
				</div>

				<div class="cascade-slider_container" id="cascade-slider" >
					<div class="cascade-slider_slides">
						<?for($i=0; $i<count($g_list); $i++){?>
							<div class="cascade-slider_item">
								<div class="cascade-slider_slides_img"><a href="#">
									<img src="<?=$g_list[$i]["img_src"]?>" alt="" <?=$ratio_style[$i]?>>
								</a></div>	
								<h3><?=$g_list[$i][bn_subject_en]?></h3>
								<span><?=$g_list[$i][bn_content_en]?></span>
							</div>
						<?}?>
					</div>
					<span class="cascade-slider_arrow cascade-slider_arrow-left" data-action="prev"></span>
					<span class="cascade-slider_arrow cascade-slider_arrow-right" data-action="next"></span>
				</div><!-- //cascade-slider -->				
			</div><!-- //inner -->
		</div><!-- //section4 -->
		
		<script src="/e_css/js/cascade-slider.js"></script>
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
					925 Manhattan Building, 33 Gukjegeumyung-Ro,<br/>
					6-Gil, Yeongdeungpo-Gu, Seoul, Korea 07731
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

	<? include $_SERVER["DOCUMENT_ROOT"]."/e_foot.php"; ?>

</div><!-- //wrap -->


<? include $_SERVER["DOCUMENT_ROOT"]."/e_foot.lib.php"; ?>