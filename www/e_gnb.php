<?if($PHP_SELF=="/e_academy.php"){?>
<ul class="gnb clfix">
	<li><a href="/e_curriculum.php">MULTI CAMPUS</a>
		<ul class="gnb_2depth">
			<li><a href="/e_curriculum.php#c_section1">ABOUT COURSE</a></li>
			<li><a href="/e_curriculum.php#c_section2">CURRICULUM</a></li>
			<li><a href="/e_curriculum.php#section-edu">OUTLINE</a></li>
			<li><a href="/e_curriculum.php#c_section3">PROFESSORS</a></li>
			<li><a href="/e_curriculum.php#c_section4">PARTNERS</a></li>
		</ul>
	</li>
	<li><a href="#section5" class="anchorLink">CONTACT</a></li>	
	<li><a href="/e_academy.php">ABOUT</a>
		<ul class="gnb_2depth">
			<li><a href="#section1" class="anchorLink">ABOUT COURSE</a></li>
			<li><a href="#section2" class="anchorLink">SERVICE</a></li>
			<li><a href="#section3" class="anchorLink">TEAM</a></li>
			<li><a href="#section4" class="anchorLink">GALLERY</a></li>
		</ul>
	</li>	
</ul>	

<?}else {?>
<ul class="gnb clfix">
	<li><a href="/e_curriculum.php">MULTI CAMPUS</a>
		<ul class="gnb_2depth">
			<li><a href="#c_section1" class="anchorLink">ABOUT COURSE</a></li>
			<li><a href="#c_section2" class="anchorLink">CURRICULUM</a></li>
			<li><a href="#section-edu" class="anchorLink">OUTLINE</a></li>
			<li><a href="#c_section3" class="anchorLink">PROFESSORS</a></li>
			<li><a href="#c_section4" class="anchorLink">PARTNERS</a></li>
		</ul>
	</li>
	<li><a href="/e_academy.php#section5">CONTACT</a></li>	
	<li><a href="/e_academy.php">ABOUT</a>
		<ul class="gnb_2depth">
			<li><a href="/e_academy.php#section1">ABOUT COURSE</a></li>
			<li><a href="/e_academy.php#section2">SERVICE</a></li>
			<li><a href="/e_academy.php#section3">TEAM</a></li>
			<li><a href="/e_academy.php#section4">GALLERY</a></li>
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