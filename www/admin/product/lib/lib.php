<?
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	제품관리 기본 환경변수 설정  - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	
|	* 업로드 이미지관련 설정 / 
|	* 제품관리 기본 디렉토리 설정 / 
|	* 제품관리 확장리스트 관련 설정 / 
|	
|	2015-05 / 수정시 각 파트별 배치 순서에 주의 !		*/

$PG_table		=	$GnTable["proditem"];			//	제품관리 테이블
$JO_table		=	$GnTable["prodcategory"];		//	카테고리 테이블
$EX_table		=	"Gn_Product_Detail";			//	확장 테이블

// 관리자 환경설정값 배열변수 ( $GnProd ) 생성
$sql = " select * from {$GnTable[prodconfig]} ";
$GnProd = sql_fetch($sql);

// 상품 고유번호 it_id 생성
if( empty($it_id) == TRUE ) { $it_id = time(); }
if( empty($d_it_id) == FALSE ) { $it_id = $d_it_id; }

/* ------------------------------------------------------------- [ 업로드 이미지관련 설정 - START ] ------------------------------------------------------------- */
// 업로드할 이미지 총 갯수 ( 갯수만큼 썸네일 2개가 생성된다, 중, 소 )
$GnProd["max_img_count"] = 1;

// 업로드할 이미지의 퀄리티 권장 (60~100) - 중,소 이미지에만 퀄리티 적용
$GnProd["img_quality"] = 100;

// 업로드 이미지가 없을때의 no_image 이미지 경로
$GnProd["no_img_src"] = "/skin/product/basic/images/no_image.jpg";
/* ------------------------------------------------------------- [ 업로드 이미지관련 설정 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 제품관리 기본 디렉토리 설정 - START ] ------------------------------------------------------------- */
// 기본 스킨 경로
if($GnProd[prod_skin] == "") $GnProd[prod_skin] = "basic";
$GnProd["skin_url"]		=	"/skin/product/".$GnProd[prod_skin];
$GnProd["skin_dir"]		=	$_SERVER["DOCUMENT_ROOT"].$GnProd["skin_url"];

// 제품 업로드 디렉토리
$GnProd['data_url']		=	"/product/data/item";
$GnProd['data_dir']		=	$DOCUMENT_ROOT.$GnProd['data_url'];

// 제품 이미지가 업로드될 경로
$GnProd["prod_item_url"] = "/product/data/item/".$it_id;														//		저장될 웹 디렉토리경로
$GnProd["prod_item_dir"] = $_SERVER["DOCUMENT_ROOT"].$GnProd["prod_item_url"];					//		서버상 실제 경로 (파일삭제,존재유무확인용)
/* ------------------------------------------------------------- [ 제품관리 기본 디렉토리 설정 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 확장 입력 기본 디렉토리 설정 - START ] ------------------------------------------------------------- */
$GnProd["ex_target_url"]				= $GnProd['data_url']."/".$it_id."/detail";								//		저장될 웹 디렉토리경로
$GnProd["ex_target_dir"]				= $_SERVER["DOCUMENT_ROOT"].$GnProd["ex_target_url"];		//		서버상 실제 경로  (파일삭제,존재유무확인용)
$GnProd["ex_table_name"]				= $EX_table;																//		저장될 테이블 이름
$GnProd["ex_field_name_real"]		= "d_file_oname	";														//		필드이름   ( 원본 파일이름이 저장될 필드 )
$GnProd["ex_field_name_virture"]		= "d_file_rname";														//		필드이름2  ( 변환된 파일이름이 저장될 필드 )
/* ------------------------------------------------------------- [ 확장 입력 기본 디렉토리 설정 - END ] ------------------------------------------------------------- */



/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	제품관리 사용시 적용되는 function - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	* /admin/lib/function.php로드 후 추가로 제품관리 사용시에만 로드되는 함수 모음입니다.
|	* 함수 추가시 /admin/lib/function.php 와 함수명이 같은것이 존재하지 않도록 주의 !
|	
|	~ 2015 */

// it_id로 해당 원하는 필드의 이름 알아내기------------------------------------------------
function get_it_value($it_id, $field) {
	global $GnTable;
	$product_sql = "SELECT $field FROM {$GnTable[proditem]} WHERE it_id='".$it_id."'";
	$product_query = mysql_query($product_sql);
	$product_row = mysql_fetch_array($product_query);
  
	$it_value = $product_row[$field];
	return $it_value;
}

// it_id, 상품인덱스번호를 인자로 받아 이미지 파일네임을 배열인덱스로 반환함.
// 반환형태 : 배열인덱스 s,m,l 을 키로 하는 벨류값(파일네임)을 반환한다.
function get_it_file_size_array( $it_id, $file_index ) {	
	global $GnTable;
	$get_file_sql = "SELECT it_file{$file_index} FROM {$GnTable[proditem]} WHERE it_id = '$it_id' ";
	$get_file_query = mysql_query($get_file_sql);
	$get_file_rows = mysql_fetch_array($get_file_query);
	$field_file_name = $get_file_rows["it_file".$file_index];
	
	$it_file_array["l"] = $field_file_name;
	$it_file_array["m"] = str_replace($it_id."_l", $it_id."_m", $field_file_name);
	$it_file_array["s"] = str_replace($it_id."_l", $it_id."_s", $field_file_name);
	
	return $it_file_array;
}



// 2014.1.8 test MJ (지정위치에 파일업로드 + 데이터베이스에 파일이름 저장시키기 / 원본네임 / 유니크네임
function fileupload_MJ($upfile, $target_dir, $table_name, $field_name_real, $field_name_virture, $where_value ) 
{
	//--------------------------------------- 파일 삭제 관련 -----------------------------
	// 기존 썸네일 이미지 업로드 파일을 FTP서버에서 지운다.
	$Old_FileSql = "select * from {$table_name} where {$where_value}";
	$Old_FileQuery = mysql_query($Old_FileSql);
	$Old_FileRow = mysql_fetch_array($Old_FileQuery);
	$Old_Row_Data = $Old_FileRow[$field_name_virture];

	// 파일이 있을 경우
	if($Old_Row_Data!="") {
		$Old_File_dir = $_SERVER[DOCUMENT_ROOT].$target_dir;
		@unlink("$Old_File_dir/$Old_Row_Data");
	}
		
	// ---------------------------------------// 파일 삭제 관련 ---------------------------

	//--------------------------------------- 파일 업로드 관련 ----------------------------------------------------------------------
	// 새로 업로드 한 첨부파일명 저장 하기
	$file_tmp_name = $upfile[tmp_name];						//			넘어온 임시파일네임
	$file_real_name = $upfile[name];								//			실제 파일네임
		
	// 유니크한 파일이름으로 변환
	// 실제 파일명중 한글이 깨져 서버에 저장되는 문제 발견 20141210
	// $file_virture_re_name = substr(md5(uniqid(mktime())),0,10)."_".$file_real_name;			//			db에 저장될 겹치지 않는 리네임 파일
	
	// 파일명은 저장하지 않고 확장자만 유니크한 값에 덧붙이는 방식으로 수정
	// 확장자를 붙이기 위함
	$file_name_array = explode(".",$file_real_name);
	$file_type_index = count($file_name_array) - 1;
	$get_file_type = $file_name_array[$file_type_index];
	$file_virture_re_name = substr(md5(uniqid(mktime())),0,10).".".$get_file_type;			//			db에 저장될 겹치지 않는 리네임 파일

	//저장될 디렉토리 ( 서버 절대경로 + 저장할 디렉토리 )
	$file_up_dir = $_SERVER["DOCUMENT_ROOT"].$target_dir;
	
	//실제 파일업로드 및 권한설정
	@move_uploaded_file($file_tmp_name, "$file_up_dir/$file_virture_re_name");
	@chmod("$file_up_dir/$file_virture_re_name", 0606);
	
	// db에 저장할 인수가 넘어왔다면 db에 파일 이름 저장 ( 실제, 리네임 )
	if($table_name != "" and $field_name_real != "" and $field_name_virture != "" and $where_value != "") {

		$fileup_sql = "UPDATE $table_name SET $field_name_real = '$file_real_name', $field_name_virture = '$file_virture_re_name' WHERE $where_value";
		$fileup_query = mysql_query($fileup_sql);
		/*
		if($fileup_query == TRUE) { echo "성공"; } else { echo "실패"; }
		*/
	}
	//--------------------------------------- // 파일 업로드 관련 ----------------------------------------------------------------------
	return true;
}


// 하나의 it_id에 등록된 확장 리스트의 갯수만 가져옴
// 확장 테이블명, it_id
function get_ex_list_count($table_name, $it_id) {
	$sql = "SELECT d_it_id FROM {$table_name} WHERE d_it_id='$it_id' ";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);

	return $count;
}
?>