<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

?>
<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
	
	<div id="sub_visual_wrap">
		<p class="bg01"></p>
		<p class="bg02"></p>
		<p class="bg03"></p>
	</div><!-- //sub_visual_wrap -->	
	<script type="text/javascript">
		$('#sub_visual_wrap p').hover(function(){
			$(this).addClass('on');
		}, function(){
			$(this).removeClass('on');
		});
	</script>
<style>
#sub_visual_wrap {height:980px; background:#000;}
#sub_visual_wrap p.on {z-index:999;}
.bg01 {position:absolute; top:200px; left:200px; width:300px; height:300px; background:url(/images/main/visual01.jpg) center top no-repeat; background-size:cover; cursor:pointer; transition:all 0.3s ease-in-out;}
.bg01:hover {position:absolute; top:0; left:0; width:100%; height:980px;}

.bg02 {position:absolute; top:300px; left:800px; width:300px; height:300px; background:url(/images/main/visual02.jpg) center top no-repeat; background-size:cover; cursor:pointer; transition:all 0.3s ease-in-out;}
.bg02:hover {position:absolute; top:0; left:0; width:100%; height:980px;}

.bg03 {position:absolute; top:400px; left:1300px; width:300px; height:300px; background:url(/images/main/visual03.jpg) center top no-repeat; background-size:cover; cursor:pointer; transition:all 0.3s ease-in-out;}
.bg03:hover {position:absolute; top:0; left:0; width:100%; height:980px;}
</style>



	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>



<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>