<?
/* ------------------------------------------------------------- [ 멤버 - START ] ------------------------------------------------------------- */
if($page_loc=="member"){
	$title_id = "1";
	$title_id2 = "1";
	$title_text1="회원서비스";
	if($PHP_SELF=="/member/login.php"){
		$title_id2 = "1";
		$title_text2="로그인";
	} else if($PHP_SELF=="/member/join.php" || $mode=="JOIN"){
		$title_id2 = "2";
		$title_text2="회원가입";
	}else if($mode=="INFO" ){
		$title_id2 = "2";
		$title_text2="개인정보수정";
	}else if($PHP_SELF=="/member/privacy.php"){
		$title_id2 = "3";
		$title_text2="개인정보취급방침";
	}else if($PHP_SELF=="/member/terms_use.php"){
		$title_id2 = "3";
		$title_text2="이용약관";
	}
}

/* ------------------------------------------------------------- [ 사이트맵 - START ] ------------------------------------------------------------- */
if($page_loc=="sitemap"){
	if($PHP_SELF=="/sitemap/sitemap.php"){
		$title_text1="사이트맵";
		$title_text2="사이트맵";
	}
}

/* ------------------------------------------------------------- [ 일반페이지 - START ] ------------------------------------------------------------- */
if($page_loc=="sub01") {
	$title_text1="페이지타이틀1";
	if($PHP_SELF == "/sub01/sub01.php") {
		$title_text2="페이지타이틀1";
	} else if($PHP_SELF == "/sub01/sub02.php") {
		$title_text2="페이지타이틀2";
	} else if($PHP_SELF == "/sub01/sub03.php") {
		$title_text2="페이지타이틀3";
	} else if($Table == "notice") {
		$title_text2="공지사항";
	}
}

/* --------------------------------------------------- [ SHOP,PRODUCT 타이틀 자동생성 - START ] --------------------------------------------- */
if($page_loc=="shop") {
	if($PHP_SELF=="/shop/list.php" || $PHP_SELF=="/shop/item.php") {
		//$title_text1=" 타이틀1";
		$title_text2="제품소개 > ".get_category_full_name("SHOP",$ca_id);
	}
}