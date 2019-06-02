<? 
	if($page_loc=="intro"){ //회사소개
		$mNum="0";
		if($PHP_SELF=="/intro/sub01.php"){
		$sNum="0";
	} else if($PHP_SELF=="/intro/sub02.php"){
	$sNum="1";
	}
	}

	
	if($page_loc=="product"){ //제품소개
		$mNum="1";
		if($PHP_SELF=="/product/sub01.php"){
		$sNum="0";
	} else if($PHP_SELF=="/product/sub02.php"){
	$sNum="1";
	} else if($PHP_SELF=="/product/sub03.php"){
	$sNum="2";
	} else if($PHP_SELF=="/product/sub03_1.php"){
	$sNum="2";
	} else if($PHP_SELF=="/product/sub03_2.php"){
	$sNum="2";
	} else if($PHP_SELF=="/product/sub03_3.php"){
	$sNum="2";
	} else if($PHP_SELF=="/product/sub04.php"){
	$sNum="3";
	} else if($PHP_SELF=="/product/sub05.php"){
	$sNum="4";
	} else if($PHP_SELF=="/product/sub06.php"){
	$sNum="5";
	}
	}
	

	
	if($page_loc=="date"){ //자료실
		$mNum="2";
		if($Table == "date1"){
		$sNum="0";
	} else if($Table == "gallery"){
	$sNum="1";
	}
	}
	

	
	if($page_loc=="customer"){ //고객지원
		$mNum="3";
		if($Table == "recruit"){
		$sNum="0";
	} else if($Table == "qna1"){
	$sNum="1";
	} else if($Table == "customer_4"){
	$sNum="3";
	} else if($Table == "customer_5"){
	$sNum="4";
	}
	}
	
	if($page_loc=="online"){ //고객지원
		$mNum="3";
		if($PHP_SELF=="/online/online.php"){
		$sNum="2";
	} 
	}

	
	if($page_loc=="ptm"){ //PTM소개
		$mNum="4";
		if($PHP_SELF=="/ptm/sub01.php"){
		$sNum="0";
	} else if($PHP_SELF=="/ptm/sub02.php"){
	$sNum="1";
	}
	}

	
	if($page_loc=="sitemap"){ //사이트맵
		$mNum="6";
		if($PHP_SELF=="/sitemap/sub01.php"){
		$sNum="0";
	}
	}

	
	if($page_loc=="membership"){ //회원약관
		$mNum="7";
		if($PHP_SELF=="/membership/sub01.php"){
		$sNum="0";
	} else if($PHP_SELF=="/membership/sub02.php"){
	$sNum="1";
	}
	}
	
	
?>

<? if($page_loc=="intro") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=0&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>


<? if($page_loc=="product") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=1&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>


<? if($page_loc=="date") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=2&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>

<? if($page_loc=="customer") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=3&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>

<? if($page_loc=="online") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=3&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>

<? if($page_loc=="ptm") { ?>
<script>flashview('/flash/sub_navi.swf?mNum=4&sNum=<?=$sNum?>',940,100,'');</script>
<? } ?>

<? if($page_loc=="sitemap") { ?>
<script>flashview('/flash/sub_navi.swf',940,100,'');</script>
<? } ?>

<? if($page_loc=="membership") { ?>
<script>flashview('/flash/sub_navi.swf',940,100,'');</script>
<? } ?>