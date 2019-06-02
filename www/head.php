<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";

	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port && $ssl_ch != "ok") goto_url("http://".$new_sever_name.$_SERVER[REQUEST_URI]);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
?>
<div id="wrap">
	<div id="header">
		<div class="inner">
			<?if($PHP_SELF=="/curriculum.php"){?>
			<h1 class="logo"><a href="/curriculum.php">
			<?}else {?>
			<h1 class="logo"><a href="/curriculum.php">
			<?}?>		
				<img src="/images/main/logo.png" alt="주식회사 블록체인투자연구소" />
			</a></h1>
			<div class="h-button"><!--원래는 resist.php --><a href="/resist.php">과정등록<img src="/images/main/h_arrow.png" alt=">"></a></div>
			<div class="lang">
				<div class="lang_tit"><span>KOR</span></div>
				<div class="lang_list">
					<p><a href="/curriculum.php">KOR</a></p>
					<p><a href="/e_curriculum.php">ENG</a></p>
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
