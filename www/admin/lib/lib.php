<?
$realdir = dirname(__FILE__);			//실제 경로
$thisdir = explode("/",$realdir);	//현재 폴더명

//========================================================================================================================== 
// extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음  
//-------------------------------------------------------------------------------------------------------------------------- 
 $ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST', 
                   'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 
                   'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS','userid','userlevel','super'); // super (감각직원용) 또한 변조되지 못하도록 차단
 $ext_cnt = count($ext_arr); 
 for ($i=0; $i<$ext_cnt; $i++) { 
     // POST, GET 으로 선언된 전역변수가 있다면 unset() 시킴 
     if (isset($_GET[$ext_arr[$i]]))  unset($_GET[$ext_arr[$i]]); 
     if (isset($_POST[$ext_arr[$i]])) unset($_POST[$ext_arr[$i]]); 
 } 
 //========================================================================================================================== 

//header, session_start() 중복대비
ob_start();
session_start();

//register_globals = off 일때
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

///////////// 프록시 차단 //////////////////////
$proxy_headers = array 
(  
'HTTP_VIA',  
'HTTP_X_FORWARDED_FOR',  
'HTTP_FORWARDED_FOR',  
'HTTP_X_FORWARDED',  
'HTTP_FORWARDED',  
'HTTP_CLIENT_IP',  
'HTTP_FORWARDED_FOR_IP',  
'VIA',  
'X_FORWARDED_FOR',  
'FORWARDED_FOR',  
'X_FORWARDED',  
'FORWARDED',  
'CLIENT_IP',  
'FORWARDED_FOR_IP',  
'HTTP_PROXY_CONNECTION' 
); 

foreach($proxy_headers as $x) 
{ 
if (isset($_SERVER[$x])) die("You are using a proxy!"); 
}

/////// 환경 변수 파일을 불러옵니다. ////////////////////////
include_once $realdir."/config.php";
include_once $realdir."/function.php";
include_once $realdir."/session.php";		//SESSION
include_once("$realdir/dbconfig.php");

/////// DB에 접속합니다. ////////////////////////
$connect_db = sql_connect($mysql_host, $mysql_user, $mysql_password);
$select_db = sql_select_db($mysql_db, $connect_db);
@mysql_query("set names utf8");        //        추가

/////// 프로그램설치를 확인합니다. ////////////////////////
	if($mysql_db==TRUE) {
		if (!$select_db) die("<script language='JavaScript'> alert('DB 접속 오류'); </script>");
	} else {
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$charset\">";
		echo "
		<script language='JavaScript'>
		alert('DB 설정 파일이 존재하지 않습니다.\\n\\n프로그램 설치 후 실행하시기 바랍니다.');
		location.href = '/install/';
		</script>
		";
		exit;
	}

///////////// register_globals = on 일때 $_SESSION 변수가 _POST 또는 _GET 으로 넘어온 변수의 이름이 동일할때 $_SESSION 변수가 변조되는 치명적인 문제/////////////
//예) register_globals = on 일때 $_SESSION[userlevel] = 0 인상태에서 $userlevel 변수가 _POST 또는 _GET 으로 value 값이 100 으로 넘어오면 $_SESSION[userlevel] 값은 100이 된다
//해결 방안 : userid 란 변수로 넘어온 값이 있다면 무조건 초기화 시키며 실시간으로 $_SESSION[userid] 를 체크 하여 $_SESSION[userid] 해당된 회원 정보를
//$_SESSION[] 배열변수에 선언한다.

if($_SESSION["userid"] != null){
	$member = sql_fetch("select * from {$GnTable[member]} where mem_leb>0 and mem_check>0 and mem_id = '".$_SESSION["userid"]."' and mem_leb = '".$_SESSION["userlevel"]."' ");
		if($_SESSION["super"] == "SUPER"){
			set_session('super', $_SESSION["super"]);								//감각직원용 환경설정
		}
		set_session('userid', $member[mem_id]);								//아이디
		set_session('userlevel', $member[mem_leb]);			//레벨
		set_session('username', $member[mem_name]);		//이름
		set_session('nickname', $member[mem_nick]);			//닉네임
		set_session('phone', $member[mem_tel]);			//전화번호
		set_session('mobile', $member[mem_phone]);		//핸드폰번호
		set_session('email', $member[mem_email]);			//이메일
		set_session('post', $member[mem_post]);			//우편번호
		set_session('homepage', $member[mem_home]);	//홈페이지
		set_session('address', $member[mem_add1]." ".$member[mem_add2]);	//주소
		set_session('address1', $member[mem_add1]);		//주소1
		set_session('address2', $member[mem_add2]);		//주소2
}
///////////// register_globals = on 일때 $_SESSION 변수가 _POST 또는 _GET 으로 넘어온 변수의 이름이 동일할때 $_SESSION 변수가 변조되는 치명적인 문제/////////////

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
//페이스북//
if($mode=="VIEW" and $PHP_SELF == "/bbs/board.php") {
// 저장된 파일 이름 가져오기
	function get_filesavename2($b_no,$Table) {
		$board_imgfile_sql = "SELECT * FROM Gn_Board_File WHERE bf_tno='$b_no' and bf_table = '$Table' and bf_fno = '1'";
		$board_imgfile_query = mysql_query($board_imgfile_sql);
		$board_imgfile_row = mysql_fetch_array($board_imgfile_query);
		return $board_imgfile_row["bf_save_name"];
	}
 
	function get_bbs_subject($Table, $b_no) {
		$tablename = "Gn_Board_Item_".$Table;
		$bbs_content_sql = "SELECT * FROM {$tablename} WHERE b_no='$b_no'";
		$bbs_content_query = mysql_query($bbs_content_sql);
		$bbs_content_row = mysql_fetch_array($bbs_content_query);
		return $bbs_content_row["b_subject"];
	}
	// 페이스북으로 보낼 현재 게시물의 대표 이미지 구하기
	$bbs_save_filename = get_filesavename2($num,$tbl);   //  게시물넘버로 게시물에 업로드한 첫번재 세이브파일네임 가져오기 함수(mj)
	
	// 페이스북으로 보낼 현재 게시물의 설명 구하기
	$bbs_content = stripslashes(get_bbs_subject($tbl, $num));
	$bbs_kako_content = stripslashes(get_bbs_subject($tbl, $num));
	$bbs_content_noimage = preg_replace("/<img[^>]*>/","",$bbs_content);
}

// Security XSS + SQL Attack
$uri_array = explode("/",$_SERVER["PHP_SELF"]);

// 관리자 -> 악성코드유형관리 페이지가 아닐때만 보안필터처리페이지 로드
if($uri_array[1] == "admin" && $uri_array[2]!="page") {
	//include_once $_SERVER[DOCUMENT_ROOT]."/admin/lib/security.php";
} else if( $uri_array[1] != "admin" and $PHP_SELF!="/bbs/process.php") {
	//include_once $_SERVER[DOCUMENT_ROOT]."/admin/lib/security.php";
}

//////////////////////////////////////////////////////////////////////

// SSL 관련 추가
$site_domain = $default[site_url];

// 관리자 체크 변수 (/bbs/board.php에서 이동)
if($_SESSION["userlevel"] ==100) $LogAdmin = TRUE; else $LogAdmin = FALSE;

///////////////////////////////////////////////////////////////////////
//// 기타 프로그램 실행하기
//////////////////////////////////////////////////////////////////////

/* ------------------------------------------------------------- [ ip차단 mj - START ] ------------------------------------------------------------- */
// 차단 리스트 (스팸업자의 근성이보인다)
$ip_ban_list = array(
	"193.201.227.45",
	"188.143.234.155"
);//스팸 관련 아이피 추가
if( in_array( $_SERVER[REMOTE_ADDR], $ip_ban_list) ) {
	alert("The IP has been blocked.");
}
if(substr($_SERVER[REMOTE_ADDR],0,11)=="193.201.227"){
	alert("The IP has been blocked.");
}
/* ------------------------------------------------------------- [ ip차단mj - END ] ------------------------------------------------------------- */

// 커운터 저장
	counter_total_save(); //접속자수 순수통계
	Put_Counter(); //기존통계(세부정보)

?>