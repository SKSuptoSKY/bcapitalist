<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	//세션이 있으면 멤버 폴더로 이동
	if($_SESSION["userlevel"] > 0) alert("이미 로그인 정보가 있습니다.", "/main.php");

	if($default["namesys_code"]==TRUE) {
		include $_SERVER["DOCUMENT_ROOT"]."/JmCode/Jm_scrip.inc.php";
		$juminch = "0";
	} else {
		$juminch = "1";
	}

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/join.skin.php";
?>