<?
include_once($_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/online_check.php");

	$PG_table = $GnTable["online"];

	if($type==FALSE) {
		$type = "0";
	}

// ��Ų�������� �ִ��� Ȯ���մϴ�.
$bimg = $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/online/online.$type.php";
if (!file_exists($bimg)) {
	alert("�߸��� ��η� �����ϼ̽��ϴ�.", "/mobile/main.php");
}

//��Ų�������� �ҷ��ɴϴ�.
include $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/online/online.$type.php";

include_once($_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php");
?>
