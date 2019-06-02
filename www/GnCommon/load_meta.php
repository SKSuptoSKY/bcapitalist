<!-- 호환성 보기 제거 메타 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<!-- 사이트 전체 기본 문자셋 지정 -->
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">

<!-- 캐쉬 사용하지 않음 메타 -->
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>

<!-- <meta name="robots" content="noindex,nofollow"> -->

<!-- 페이스북 관련 메타 
<meta property="og:image" content="<?=$send_facebook_img_url?>"/>
<meta property="og:title" content="[<?=$default[site_name]?>]"/>
<meta property="og:description" content="<?=$bbs_content?>"/>
<meta property="og:type" content="website" />-->

<!-- 트위터 관련 메타 -->
<meta name="twitter:title"          content="[<?=$default[site_name]?>] <?=$bbs_content?>">
<meta name="twitter:image"          content="<?=$send_facebook_img_url?>">
<meta name="twitter:description"    content="<?=$bbs_content?>">

<!-- 네이버 사이트 등록 관련 메타 -->
<meta name="naver-site-verification" content="5db647b0060fec1122561de51f68628b1e717801"/>
<meta name="description" content="블록체인교육, 암호자산 전망, 블록체인컨퍼런스 및 전시회, 비트코인, 암호자산, 디컨퍼런스">
<meta property="og:type" content="website">
<meta property="og:title" content="블록체인 캐피탈리스트 과정 | 블록체인투자연구소">
<meta property="og:description" content="블록체인교육, 암호자산 전망, 블록체인컨퍼런스 및 전시회, 비트코인, 암호자산, 디컨퍼런스">
<meta property="og:image" content="http://www.bcapitalist.com/images/main/logo_naver.jpg">
<meta property="og:url" content="http://www.bcapitalist.com">
<link rel="canonical" href="http://www.bcapitalist.com">

<? if($default[keyword]==TRUE) { ?>
<meta name="keywords" content="<?=$default[keyword]?>">
<? } ?>