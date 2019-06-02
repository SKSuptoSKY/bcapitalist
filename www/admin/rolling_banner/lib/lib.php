<?
// 타입넘버 가져오기
if($type == "") {
	$type = 0;
}

/* ------------------------------------------------------------- [ 이부분만 설정하면됨 - START ] ------------------------------------------------------------- */
// 롤링이미지 사이즈
$b_width[0] = "1920";
$b_height[0] = "980";
$b_width[1] = "1920";
$b_height[1] = "980";

$b_admin_width[0] = $b_width[0]/2;
$b_admin_height[0] = $b_hieght[0]/2;
$b_admin_width[1] = $b_width[1]/2;
$b_admin_height[1] = $b_height[1]/2;


//Gallery
$b_width[2] = "900";
$b_height[2] = "450";

$b_admin_width[2] = $b_width[2]/2;
$b_admin_height[2] = $b_height[2]/2;

$b_width[100] = "759";
$b_height[100] = "877";
$b_width[101] = "759";
$b_height[101] = "877";

$b_admin_width[100] = $b_width[100]/2;
$b_admin_height[100] = $b_hieght[100]/2;
$b_admin_width[101] = $b_width[101]/2;
$b_admin_height[101] = $b_height[101]/2;

// 롤링이미지 업로드 경로 ( 루트를 기준으로 절대경로 입력 : 맨마지막 '/' 는 빼고 입력)
$upload_url = "/rolling_banner/item";
/* ------------------------------------------------------------- [ 이부분만 설정하면 됨 - END ] ------------------------------------------------------------- */

// 테이블
$PG_table ="Gn_Rolling_Banner";

// upload_url 설정대로 모든 하위디렉토리 경로 자동생성하기 ---------------------------------------------
$upload_url_arr = explode("/",$upload_url);
$dir_depth = count($upload_url_arr) -1;

for($i=1; $i<=$dir_depth; $i++) {
	
	$this_dir = $upload_url_arr[$i];
	$make_fullpath .= "/".$this_dir;
	
	// 디렉토리가 존재하지 않는다면 생성
	if( file_exists($_SERVER["DOCUMENT_ROOT"].$make_fullpath) == FALSE) {
		
		$makde_dir = mkdir($_SERVER["DOCUMENT_ROOT"].$make_fullpath, 0777);
		if($makde_dir == TRUE || file_exists($_SERVER["DOCUMENT_ROOT"].$make_fullpath) ) {
			chmod($_SERVER["DOCUMENT_ROOT"].$make_fullpath, 0777);
		} else {
			echo $this_dir." 생성 실패 <br>";
		}
	}
}
// ---------------------------------------------------------------------------------------------------------------------


?>