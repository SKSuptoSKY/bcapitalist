<?if($PHP_SELF=="/academy.php"){?>
<ul class="gnb clfix">
	<li><a href="/curriculum.php">강의</a>
		<ul class="gnb_2depth">
			<li><a href="/curriculum.php#c_section1">강의소개</a></li>
			<li><a href="/curriculum.php#c_section2">커리큘럼</a></li>
			<li><a href="/curriculum.php#section-edu">강의개요</a></li>
			<li><a href="/curriculum.php#c_section3">강사</a></li>
			<li><a href="/curriculum.php#c_section4">파트너</a></li>
		</ul>
	</li>
	<li><a href="#section5" class="anchorLink">Contact</a></li>	
	<li><a href="/academy.php">회사소개</a>
		<ul class="gnb_2depth">
			<li><a href="#section1" class="anchorLink">회사소개</a></li>
			<li><a href="#section2" class="anchorLink">서비스</a></li>
			<li><a href="#section3" class="anchorLink">팀소개</a></li>
			<li><a href="#section4" class="anchorLink">갤러리</a></li>
		</ul>
	</li>	
</ul>	

<?}else {?>
<ul class="gnb clfix">
	<li><a href="/curriculum.php">강의</a>
		<ul class="gnb_2depth">
			<li><a href="#c_section1" class="anchorLink">강의소개</a></li>
			<li><a href="#c_section2" class="anchorLink">커리큘럼</a></li>
			<li><a href="#section-edu" class="anchorLink">강의개요</a></li>
			<li><a href="#c_section3" class="anchorLink">강사</a></li>
			<li><a href="#c_section4" class="anchorLink">파트너</a></li>
		</ul>
	</li>
	<li><a href="/academy.php#section5">Contact</a></li>	
	<li><a href="/academy.php">회사소개</a>
		<ul class="gnb_2depth">
			<li><a href="/academy.php#section1">회사소개</a></li>
			<li><a href="/academy.php#section2">서비스</a></li>
			<li><a href="/academy.php#section3">팀소개</a></li>
			<li><a href="/academy.php#section4">갤러리</a></li>
		</ul>
	</li>	
</ul>	

<?}?>

<script>
	$('.gnb > li').hover(function(){
		$(this).find('.gnb_2depth').stop(true,true).fadeIn();
	}, function(){
		$(this).find('.gnb_2depth').stop(true,true).fadeOut();
	});
</script>