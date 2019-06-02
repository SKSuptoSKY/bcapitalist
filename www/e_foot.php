<?
$sql = "select * from Gn_Link where li_no = '1'";
$link = sql_fetch($sql);
?>
	<div id="footer">
		<div class="inner">
			<?if($PHP_SELF=="/e_curriculum.php"){?>
			<div class="footer_logo"><a href="/e_curriculum.php">
			<?}else {?>
			<div class="footer_logo"><a href="/e_academy.php">
			<?}?>					
				<img src="/e_images/main/footer_logo.jpg" alt="주식회사 블록체인투자연구소" />
			</a></div>
			<div class="footer_sns">
				<span><a href="<?=$link[li_link]?>" target="<?=$link[li_target]?>"><img src="/e_images/main/sns01.jpg" alt="블로그"></a></span>
				<span><a href="<?=$link[li_link2]?>" target="<?=$link[li_target2]?>"><img src="/e_images/main/sns02.jpg" alt="페이스북"></a></span>
				<span><a href="<?=$link[li_link3]?>" target="<?=$link[li_target3]?>"><img src="/e_images/main/sns03.jpg" alt="카카오톡"></a></span>
				<span><a href="<?=$link[li_link4]?>" target="<?=$link[li_target4]?>"><img src="/e_images/main/sns04.jpg" alt="인스타그램"></a></span>
			</div>
			<div class="footer_top">
				<?if($PHP_SELF=="/e_academy.php"){?>
				<span><a href="#section1" class="anchorLink">COMPANY</a></span>
				<?}else {?>
				<span><a href="/academy.php#section1">COMPANY</a></span>
				<?}?>	
				<?if($PHP_SELF=="/e_academy.php"){?>
				<span><a href="#section3" class="anchorLink">TEAM</a></span>
				<?}else {?>
				<span><a href="/academy.php#section3">TEAM</a></span>
				<?}?>	
				<?if($PHP_SELF=="/e_curriculum.php"){?>
				<span><a href="#c_section4" class="anchorLink">PARTNERS</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section4">PARTNERS</a></span>
				<?}?>
				<?if($PHP_SELF=="/e_curriculum.php"){?>
				<span><a href="#c_section1" class="anchorLink">ABOUT</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section1">ABOUT</a></span>
				<?}?>
				<?if($PHP_SELF=="/e_curriculum.php"){?>
				<span><a href="#c_section2" class="anchorLink">CURRICULUM</a></span>
				<?}else {?>
				<span><a href="/curriculum.php#c_section2">CURRICULUM</a></span>
				<?}?>	
			</div>
			<!-- <div class="f-button"><a href="#">COURSE REGISTER</a></div> -->
			<div class="footer_lang">
				<div class="footer_lang_tit"><span>KOR</span></div>
				<div class="footer_lang_list">
					<p><a href="/academy.php">KOR</a></p>
					<p><a href="/e_academy.php">ENG</a></p>
				</div>
			</div>
			<address>
			925 Manhattan Building, 33 Gukjegeumyung-Ro, 6-Gil, Yeongdeungpo-Gu, Seoul, Korea 07731<br/>
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