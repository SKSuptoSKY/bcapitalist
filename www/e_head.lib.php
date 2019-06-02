<?
session_cache_limiter('no-cache, must-revalidate');
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$page_loc;
$Loc_url = explode("/",$_SERVER["PHP_SELF"]);
/// 일반 페이지는 폴더명에서 위치 불러오기
if(!$page_loc) {
	$page_loc = $Loc_url[1];
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="user-scalable=yes, maximum-scale=1.0, minimum-scale=0.25, width=1200">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--[if lt IE 9]>
  <script src="/css/js/selectivizr-min.js"></script>
  <script src="/css/js/selectivizr.js"></script>
<![endif]-->

<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_meta.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_css.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_script.php"; ?>

<title><?=$default[site_name]?> - <?=$default[title]?></title>
<!-- ------------------------------------------------------------- [ 디자인 CSS 영역 - S ] ------------------------------------------------------------- -->

<link rel="stylesheet" href="/e_css/style.css" type="text/css">			<!-- 디자인 CSS -->
<link rel="stylesheet" href="/e_css/style_ex1.css" type="text/css">		<!-- 추가 CSS -->
<link rel="stylesheet" href="/e_css/font.css" type="text/css">		<!-- 추가 CSS -->
<link rel="stylesheet" href="/e_css/skin.css" type="text/css">		<!-- 스킨 CSS -->

<script src="/e_css/js/jquery.anchor.js"></script>
<link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700" rel="stylesheet">

<!-- ------------------------------------------------------------- [ 디자인 CSS 영역 - E ] ------------------------------------------------------------- -->
</head>

<body leftmargin="0" topmargin="0">
<DIV ID="objContents">