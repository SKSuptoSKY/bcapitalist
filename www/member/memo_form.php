<?
include_once($_SERVER["DOCUMENT_ROOT"]."/head.lib.php");

	if(Login_check()==FALSE) alert_close("회원만 이용하실 수 있습니다.\n\n로그인 해주세요","/member/login.php");

	if($default["use_memo"]==FALSE) alert_close("회원 쪽지기능을 사용할 수 없습니다.");

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/memo_form.skin.php";

include_once($_SERVER["DOCUMENT_ROOT"]."/foot.lib.php");
?>
