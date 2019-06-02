<?
include_once($_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/online_check.php");

	$PG_table = $GnTable["online"];

	if($type==FALSE) {
		$type = "0";
	}

// 스킨페이지가 있는지 확인합니다.
$bimg = $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/online/online.$type.php";
if (!file_exists($bimg)) {
	alert("잘못된 경로로 접속하셨습니다.", "/mobile/main.php");
}

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/online/online.$type.php";

include_once($_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php");
?>
