		<!--// sub_contents -->
	</div>
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
		<!--// footer -->
	</div>
</div><!--// wrap -->
<? include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php";  ?>