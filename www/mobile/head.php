<?
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/title.php";
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
?>
<div id="wrap">
	<div id="header">
		<h1><a href="/mobile/main.php">mobile main</a></h1>
		<!--// header -->
	</div>
	<div class="sub_title">
		<h2><?=$title_text1?></h2><!--// sub_title -->
	</div>
	<div class="depth_menu">
		<?	include $_SERVER["DOCUMENT_ROOT"]."/mobile/menu.php";?><!--// depth_menu -->
	</div>
	<div id="sub_contents">