<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	//파일
	$sql = "select * from Gn_Curriculum_File where f_no=6";
	$file = sql_fetch($sql);

	//메인이미지
	$main_img = get_rolling_list(101);

	//파일
	$sql = "select * from Gn_Curriculum_File where f_no=6";
	$file = sql_fetch($sql);
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
				<p class="btn_registration"><!-- 원래는 ./resist.php --><a href="/mobile/resist.php">투자자과정 과정등록</a></p>
				<!-- <p class="btn_curriculum"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">투자자과정 커리큘럼</a></p> -->
			</div>
		</div>		
	</div><!-- //visual_wrap -->

	<div id="contents">
		<div id="c_section1">
			<div class="m_tit">
				<em>01</em>
				<h2>과정개요</h2>
			</div>
			<div class="about_con">
				<img src="/mobile/images/main/about_area.png" style="width:100%;" alt="">
			</div>
		</div><!-- //c_section1 -->

		<div id="c_section2">
			<div class="m_tit">
				<em>02</em>
				<h2>커리큘럼</h2>				
			</div>
			<div class="curriculum_con">
				<img src="/mobile/images/main/curriculum_area.png" style="width:100%" alt="">
			</div><!-- //curriculum_con -->
			<!--<div class="curriculum_btn">
				<a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">
					커리큘럼 다운로드
				</a>
			</div>-->
		</div><!-- //c_section2 -->

		<div id="c_section3">
			<div class="m_tit">
				<em>03</em>
				<h2>교수진</h2>				
			</div>
			<div class="professors_con">
				<img src="/mobile/images/main/professors_area.png" style="width:100%" alt="">
			</div><!-- //professors_con -->
		</div><!-- //c_section3 -->

		<div id="c_section4">
			<div class="m_tit">
				<em>04</em>
				<h2>참여회사</h2>
			</div>
			<div class="partners_con">
				<img src="/mobile/images/main/partners_area.png" style="width:100%" alt="">
			</div><!-- //partners_con -->
		</div><!-- //c_section4 -->
				

		<div id="c_section5">
			<div class="outline_title">
				<h2>장소안내</h2>
				<p></p>
				<ul class="outline_btn">
					<li class="outline_btn01"><a href="#"></a></li>
					<li class="outline_btn02"><a href="#"></a></li>
				</ul>
			</div>
			<div class="outline_con">
				<img src="/mobile/images/main/outline.jpg" style="width:100%;" alt="">
			</div>
		</div><!-- //c_section5 -->

		
	</div><!-- //contents -->
	<div class="top_btn on">
		<img src="/mobile/images/main/top_btn.png" alt="" />
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
	  var visible = false;
	  //Check to see if the window is top if not then display button
	  $(window).scroll(function() {
		var scrollTop = $(this).scrollTop()
		if (!visible && scrollTop > 266) {
		  $(".top_btn").fadeIn();
		  visible = true;
		} else if (visible && scrollTop <= 266) {
		  $(".top_btn").fadeOut();
		  visible = false;
		} 
	  });
	  //Click event to scroll to top
	  $(".top_btn").click(function() {
		$("html, body").animate({
		  scrollTop: 0
		}, 700);
		return false;
	  });

	});
	</script>

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
			<span><a href="#c_section4" class="anchorLink">파트너</a></span>
			<span><a href="#c_section1" class="anchorLink">과정개요</a></span>
			<span><a href="#c_section2" class="anchorLink">커리큘럼</a></span>
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
</script>


<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php"; ?>

