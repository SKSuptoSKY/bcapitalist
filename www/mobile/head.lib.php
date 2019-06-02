<?
session_cache_limiter('no-cache, must-revalidate');
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$Loc_url = explode("/",$_SERVER["PHP_SELF"]);

/// 일반 페이지는 폴더명에서 위치 불러오기
if(!$page_loc) {
	$page_loc = $Loc_url[2];
}

$sql = "select * from Gn_Link where li_no = '1'";
$link = sql_fetch($sql);
?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes"><!-- 브라우저의 UI를 안보이게 -->
<meta name="apple-mobile-web-app-status-bar-style" content="black"><!-- 상태바의 색상 지정 -->
<title><?=$default[site_name]?> - <?=$default[title]?></title>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_meta.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_css.php"; ?>
<? @include_once $_SERVER["DOCUMENT_ROOT"]."/GnCommon/load_script.php"; ?>
<!-- ------------------------------------------------------------- [ 디자인 CSS 영역 - S ] ------------------------------------------------------------- -->
<link rel="stylesheet" type="text/css" href="/mobile/css/style.css">

<script src="/mobile/css/js/menu.js"></script>
<script src="/css/js/jquery.anchor.js"></script>

<link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700" rel="stylesheet">

<!-- ------------------------------------------------------------- [ 디자인 CSS 영역 - E ] ------------------------------------------------------------- -->
</head>
<body leftmargin="0" topmargin="0">
<DIV ID="objContents" style="font-size: 0px">