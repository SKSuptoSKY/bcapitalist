<?
$sql = "select * from Gn_Link where li_no = '1'";
$link = sql_fetch($sql);
?>
	<div id="footer">
		<div class="inner">
			<?if($PHP_SELF=="/curriculum.php"){?>
			<div class="footer_logo"><a href="/curriculum.php">
			<?}else {?>
			<div class="footer_logo"><a href="/academy.php">
			<?}?>					
				<img src="/images/main/footer_logo.jpg" alt="주식회사 블록체인투자연구소" />
			</a></div>
			<div class="footer_sns">
				<span><a href="<?=$link[li_link]?>" target="<?=$link[li_target]?>"><img src="/images/main/sns01.jpg" alt="블로그"></a></span>
				<span><a href="<?=$link[li_link2]?>" target="<?=$link[li_target2]?>"><img src="/images/main/sns02.jpg" alt="페이스북"></a></span>
				<span><a href="<?=$link[li_link3]?>" target="<?=$link[li_target3]?>"><img src="/images/main/sns03.jpg" alt="카카오톡"></a></span>
				<span><a href="<?=$link[li_link4]?>" target="<?=$link[li_target4]?>"><img src="/images/main/sns04.jpg" alt="인스타그램"></a></span>
			</div>
			<div class="footer_top">
				<?if($PHP_SELF=="/academy.php"){?>
				<span><a href="#section1" class="anchorLink">회사소개</a></span>
				<?}else {?>
				<span><a href="/academy.php#section1">회사소개</a></span>
				<?}?>	
				<?if($PHP_SELF=="/academy.php"){?>
				<span><a href="#section3" class="anchorLink">Team</a></span>
				<?}else {?>
				<span><a href="/academy.php#section3">Team</a></span>
				<?}?>	
				<?if($PHP_SELF=="/curriculum.php"){?>
				<span><a href="#c_section4" class="anchorLink">파트너</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section4">파트너</a></span>
				<?}?>
				<?if($PHP_SELF=="/curriculum.php"){?>
				<span><a href="#c_section1" class="anchorLink">과정개요</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section1">과정개요</a></span>
				<?}?>
				<?if($PHP_SELF=="/curriculum.php"){?>
				<span><a href="#c_section2" class="anchorLink">커리큘럼</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section2">커리큘럼</a></span>
				<?}?>	
			</div>
			<div class="f-button"><a href="/resist.php">과정등록<img src="/images/main/h_arrow.png" alt=">"></a></div>
			<div class="footer_lang">
				<div class="footer_lang_tit"><span>KOR</span></div>
				<div class="footer_lang_list">
					<p><a href="/academy.php">KOR</a></p>
					<p><a href="/e_academy.php">ENG</a></p>
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