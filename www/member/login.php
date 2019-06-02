<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

$PG_table = $GnTable["member"];
$JO_table = "";

//세션이 있으면 멤버 폴더로 이동
if($_SESSION["userlevel"] > 0) goto_url("/main.php");

//2009.06.08 Ki-hong Park 
$URL = ($URL)?$URL:$_SERVER['HTTP_REFERER'];

if($URL=="http://".$_SERVER[SERVER_NAME]."/member/member_update.php") {
	$URL = "";	// 회원가입직후의 로그인일때는 이전 $URL 변수 초기화
}

if($mode=="Login") {
	// 변수를 정리합니다.
	$mb_id = $_POST[mb_id];
	$mb_pass = $_POST[mb_pass];

	// 정보를 불러 세션에 저장하고 실패일 경우
	if(isset($mb_id) && isset($mb_pass)) {
		$check = sess_init($mb_id, $mb_pass,$mb_leb);
	}

	//// 올바른 접속 경로를 확인하고 되돌려줍니다 
	if($_POST[mb_id]==FALSE) {
		alert("정상적으로 로그인 하여 주세요", "/member/login.php");
	} else if($check==FALSE) {
		alert("일치하는 정보가 없습니다.", "/member/login.php?URL={$URL}");
	}
	//// 로그인 성공시 되돌아갑니다. 어디로?
	 if($check==TRUE) {
		 //중복로그인체크를 위하여 업데이트해준다

		if(strlen($URL)>0) {
			alert("{$_SESSION[nickname]}님 환영합니다.", $URL);
		} else {
			alert("{$_SESSION[nickname]}님 환영합니다.", "/main.php");
		}
	}
}

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/login.skin.php";
?>