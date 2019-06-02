<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];

// 해당 모드가 전달되지 않았다면
if($mode==FALSE) {
	goto_url("/main.php");
}

if($mode=="INFO") {
	//세션이 없으면 멤버 폴더로 이동
	if($_SESSION["userlevel"]<10) alert("로그인후 이용하실 수 있습니다.", "/member/login.php?URL=/member/member_form.php?mode=INFO");

	$title_page = "정보수정";

	$sql = " select a.*, b.leb_name from $PG_table a left join $JO_table b on (a.mem_leb = b.leb_level) where mem_id = '{$_SESSION[userid]}' ";
	$mem = sql_fetch($sql);
	$mem_name = $mem["mem_name"];
	$mem_tel = explode("-",$mem["mem_tel"]);
	$mem_phone = explode("-",$mem["mem_phone"]);
	$mem_fax = explode("-",$mem["mem_fax"]);
	$mem_photo = $G_member["data_url"]."/".$_SESSION["userid"];

	if (file_exists($G_member["data_dir"]."/".$_SESSION["userid"])) {
		$mem_photo_dele = "<input type=checkbox name=photo_del value='1'>삭제";
	}

	//// 올바른 접속 경로를 확인하고 되돌려줍니다 
	 if($mem==FALSE) {
		 sess_kill();
		alert("로그인 정보가 없습니다.", "/main.php");
	}

} else if($mode=="JOIN") {
	//세션이 있으면 멤버 폴더로 이동
	if($_SESSION["userlevel"] > 0) alert("이미 로그인 정보가 있습니다.", "/main.php");

	$title_page = "회원가입";
/*
	if($_POST["mem_name"]==FALSE) {
		alert("회원가입약관에 동의 하셔야 합니다.", "/member/join.php");
	}
	
	$mem_name = $_POST["mem_name"];
	$mem_sch = $_POST["ssn1"].$_POST["ssn2"];
	$mem_sch = sql_password($mem_sch);
	$mem_photo = "";

	// 주민등록번호 중복 체크 - 이미 가입한 회원을 검색한다
	$sql = " select count(*) as cnt from $PG_table where mem_sch = '$mem_sch' ";
	$mem = sql_fetch($sql);
	if($mem[cnt]>0) {
		alert("이미 회원으로 가입하셨습니다. 로그인 해주세요.", "/member/login.php?URL=$URL");
	}

	// 주민등록 번호를 이용하여 생일과 성별을 자동 입력해줍니다.
	$birth_Y = substr($_POST["ssn1"],0,2);
	if($birth_Y>date("y")) $birth_Y = "19".$birth_Y;
		else $birth_Y = "20".$birth_Y;
	$mem[mem_birth] = $birth_Y."-".substr($_POST["ssn1"],2,2)."-".substr($_POST["ssn1"],4,2);
	$sexwm = substr($_POST["ssn2"],0,1);
	if($sexwm%2==1) $mem[mem_sex] = "m";
		else $mem[mem_sex] = "w";
	$mem[mem_btype]="+";
	*/
}

//스킨페이지를 불러옵니다.
include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/member_form.skin.php";
?>