<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/rolling_banner/lib/banner_function.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	$sql_where = "where lec_use = '1'";
	//$sql_date = "and '$date' between lec_frDT and lec_enDT";
	//Paging 및 목록 생성
	$BoardSql = " select count(*) as cnt from Gn_Lecture $sql_where $sql_date order by lec_order desc";
	$row = sql_fetch($BoardSql,FALSE);
	$total_count = $row[cnt];

	$rows = 10;
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql = "select * from Gn_Lecture $sql_where $sql_date order by lec_order desc limit $from_record,$rows";
	$result = sql_query($sql);
	
	for($i=0; $row = mysql_fetch_array($result); $i++){
		$list[$i] = $row;
	}

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
			<div class="resist_con">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list">
					<colgroup>
						<col width="35%" />
						<col width="25%" />
						<col width="15%" />
						<col width="15%" />
					</colgroup>
					<tr>
						<th>과정</th>
						<th>과정일정</th>
						<th>가격</th>
						<th>신청</th>
					</tr>
					<?for($i=0; $i<count($list); $i++){?>
					<tr>
						<td><?=$list[$i][lec_subject]?></td>
						<td><?=substr($list[$i][lec_frDT],0,10)?> ~ <?=substr($list[$i][lec_enDT],0,10)?></td>
						<td><?=number_format($list[$i][lec_pay])?>원</td>
						<td><a href="./resist02.php?no=<?=$list[$i][lec_no]?>">과정등록</a></td>
					</tr>
					<?}?>
				</table>

				<div class="paging_wrap">
					<ul class="paging">
						<?=custom_paging_story2($default[page_list],$page, $total_page, "$_SERVER[PHP_SELF]?$PageNext&$NextUrl&page=");?>
					</ul>
				</div>
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
</script>


<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php"; ?>

