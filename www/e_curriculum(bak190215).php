<? 
	include $_SERVER["DOCUMENT_ROOT"]."/e_head.lib.php";  
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
	$sql = "select * from Gn_Curriculum_File where f_no=9";
	$file = sql_fetch($sql);

	//page_item (Education)
	$sql = "select * from Gn_Page_Item where pg_no = 2";
	$page = sql_fetch($sql);
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
			<li class="visual_btn02"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">CURRICULUM</a></li>
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
				<!-- <em>
					배우면서 네트워킹하세요
				</em> -->
				<p>
				Blockchain is growing every day. So does its application to variety of<br/>
				industries such as finance, supply chain, game, energy, healthcare, and so on.<br/>
				DConference Academy gathers professional blockchain investors<br/>
				and domain experts to provide quality lectures and in-depth discussion.<br/>
				Target Audience is Korean corporate stakeholders or investors interested in<br/>
				learning more about investment in blockchain or a specific domain of blockchain

				</p>
				<img src="/e_images/main/c_sec1_img.jpg" alt="">
			</div><!-- //inner -->
		</div><!-- //c_section1 -->

		<div id="c_section2">
			<div class="inner">
				<div class="m_tit black">
					<span>02</span>
					<h2>CURRICULUM</h2>
				</div>
				<div class="c_sec2_con">
					<img src="/e_images/main/c_sec2_con.jpg" alt="">
				</div><!-- //c_sec2_con -->
				<div class="c_sec2_btn"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">CURRICULUM</a></div>
			</div><!-- //inner -->
		</div><!-- //section2 -->

		<div id="section-edu" class="c-section-edu">
			<div class="inner">
				<div class="edu_txt">
					<h3>EDUCATION</h3>
					<P>
						Learn from professional blockchain<br/>
						investors and industry experts
					</P>
					<ul class="edu_btn clfix">
						<li class="edu_btn01"><a href="#">COURSE REGISTER</a></li>
						<li class="edu_btn02"><a href="/curriculum/download.php?fileurl=/curriculum/data/item/<?=$file["f_id"]?>&filename=<?=$file["f_real_name"]?>">CURRICULUM</a></li>
					</ul>
				</div><!-- //edu_txt -->				
				<div class="edu_cont">
					<!-- <img src="/e_images/main/edu_cont.jpg" alt=""> -->
					<?=$page[pg_content]?>
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
					<img src="/e_images/main/c_sec3_con.jpg" alt="">
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
					<img src="/e_images/main/c_sec4_con.jpg" alt="">
				</div><!-- //c_sec2_con -->				
			</div><!-- //inner -->
		</div><!-- //c_section4 -->

	</div><!-- //contents -->

	<? include $_SERVER["DOCUMENT_ROOT"]."/e_foot.php"; ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/e_foot.lib.php"; ?>