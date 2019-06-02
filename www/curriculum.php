<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	//메인이미지
	$r_list = get_rolling_list(1);

	//파일
	$sql = "select * from Gn_Curriculum_File where f_no=6";
	$file = sql_fetch($sql);

	//page_item (Education)
	$sql = "select * from Gn_Page_Item where pg_no = 2";
	$page = sql_fetch($sql);
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
			<li class="visual_btn01"><!-- 원래는 /resist.php --><a href="/resist.php">투자자과정 과정등록</a></li>
			<!-- <li class="visual_btn02"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">투자자과정 커리큘럼</a></li> -->
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
				<div class="m_tit black">
					<span>01</span>
					<h2>과정개요</h2>
				</div>
				<div class="c_sec1_con">
					<img src="/images/main/aboutus_no_img.png" alt="">
				</div><!-- //c_sec2_con -->
			</div><!-- //inner -->
		</div><!-- //c_section1 -->

		<div id="c_section2">
			<div class="inner">
				<div class="m_tit black">
					<span>02</span>
					<h2>커리큘럼</h2>
				</div>
				<div class="c_sec2_con">
					<img src="/images/main/c_sec2_con.png" alt="">
				</div><!-- //c_sec2_con -->
				<div class="c_sec2_btn"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">커리큘럼 다운로드</a></div>
			</div><!-- //inner -->
		</div><!-- //section2 -->

		<div id="c_section3">		
			<div class="inner">
				<div class="m_tit black">
					<span>03</span>
					<h2>교수진</h2>
				</div>	
				<div class="c_sec3_con">
					<img src="/images/main/c_sec3_con.png" alt="">
				</div><!-- //c_sec3_con -->
			</div><!-- //inner -->
		</div><!-- //section3 -->

		<div id="c_section4">
			<div class="inner">
				<div class="m_tit black">
					<span>04</span>
					<h2>협력사</h2>
				</div>
				<div class="c_sec4_con">
					<img src="/images/main/c_sec4_con.png" alt="">
				</div><!-- //c_sec2_con -->				
			</div><!-- //inner -->
		</div><!-- //c_section4 -->

		<div id="section-edu" class="c-section-edu">
			<div class="inner">
				<div class="edu_txt">
					<h3>장소안내</h3>
					<p>
						삼성 멀티캠퍼스 VIP실
					</p>
					
					
				</div><!-- //edu_txt -->				
				<div class="edu_cont">
					<!-- <img src="/images/main/edu_cont.jpg" alt=""> -->
					<?=$page[pg_content]?>
				</div>
			</div><!-- //inner -->
		</div><!-- //section-edu -->

	</div><!-- //contents -->

	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>