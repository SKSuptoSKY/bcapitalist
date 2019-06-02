<?
	include $_SERVER["DOCUMENT_ROOT"]."/e_head.lib.php";

	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port && $ssl_ch != "ok") goto_url("http://".$new_sever_name.$_SERVER[REQUEST_URI]);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
?>
<div id="wrap">
	<div id="header">
		<div class="inner">
			<?if($PHP_SELF=="/e_curriculum.php"){?>
			<h1 class="logo"><a href="/e_curriculum.php">
			<?}else {?>
			<h1 class="logo"><a href="/e_academy.php">
			<?}?>		
				<img src="/e_images/main/logo.png" alt="주식회사 블록체인투자연구소" />
			</a></h1>
			<!-- <div class="h-button"><a href="/resist.php">COURSE REGISTER</a></div> -->
			<div class="lang">
				<div class="lang_tit"><span>KOR</span></div>
				<div class="lang_list">
					<p><a href="/academy.php">KOR</a></p>
					<p><a href="/e_academy.php">ENG</a></p>
				</div>
			</div>
			<? include $_SERVER["DOCUMENT_ROOT"]."/e_gnb.php"; ?>
		</div><!-- //inner -->
	</div><!-- //header -->

	<script>
		$('.lang_tit').click(function(){
			$('.lang_list').fadeToggle('fast');
		});
	</script>
