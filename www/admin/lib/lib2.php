<?
$realdir = dirname(__FILE__);			//실제 경로
$thisdir = explode("/",$realdir);	//현재 폴더명

//header, session_start() 중복대비
ob_start();
session_start();


//register_globals = off 일때
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

/////// 환경 변수 파일을 불러옵니다. ////////////////////////
include_once $realdir."/config.php";
include_once $realdir."/function.php";
include_once $realdir."/session.php";		//SESSION
include_once("$realdir/dbconfig.php");

/////// DB에 접속합니다. ////////////////////////
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);

/////// 프로그램설치를 확인합니다. ////////////////////////
	if($mysql_db==TRUE) {
		if (!$select_db) die("<script language='JavaScript'> alert('DB 접속 오류'); </script>");
	} else {
		echo "
		<script language='JavaScript'>
		alert('DB 설정 파일이 존재하지 않습니다.\\n\\n프로그램 설치 후 실행하시기 바랍니다.');
		location.href = '/install/';
		</script>
		";
		exit;
	}


// 홈페이지 기본정보 불러오기
$default = sql_fetch(" select * from {$GnTable[config]} ");


//현재 사이트의 이름
for($siteArr=0;$siteArr<count($thisdir);$siteArr++) {
	if($thisdir[$siteArr] == "html" || $thisdir[$siteArr] == "www") $SiteDir=$thisdir[$siteArr-1];
}
$default["site_code"] = $SiteDir;
$default["paging_icon"] = "/btn/";

// 홈페이지 메뉴정보 불러오기
$sitemenu = sql_fetch(" select * from {$GnTable[menu]} ");

// 로그인 상태를 변수에 저장합니다.
$Get_Login = Login_check();

///////////////////////////////////////////////////////////////////////
//// 기본 프로그램 환경변수를 설정합니다. ///////////////////////
//////////////////////////////////////////////////////////////////////
$G_member["data_dir"] = $_SERVER["DOCUMENT_ROOT"]."/member/data";
$G_member["data_url"] = "/member/data";
$G_member["skin_dir"] = $default["member_skin"];
$G_member["skin_url"] = "/skin/member/".$default["member_skin"];

if($default[ssl_flag] == "Y"){
	$ssl_port = $default["ssl_port"];
	$new_sever_name =  str_replace("http://","",$default[site_url]);
	$ssl_url = "https://".$new_sever_name.":".$ssl_port; //SSL 
}

$G_board["data_dir"] = $_SERVER["DOCUMENT_ROOT"]."/bbs/data";
$G_board["skin_dir"] = $_SERVER["DOCUMENT_ROOT"]."/skin/bbs";

$G_online["data_dir"] = $_SERVER["DOCUMENT_ROOT"]."/online/data";
$G_online["skin_url"] = "/skin/online";

///////////////////////////////////////////////////////////////////////
//// 기타 프로그램 실행하기
//////////////////////////////////////////////////////////////////////

// 커운터 저장
	counter_total_save(); //접속자수 순수통계
	Put_Counter(); //기존통계(세부정보)
?>