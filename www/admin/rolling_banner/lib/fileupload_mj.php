<?
// 2014.1.8 test MJ (지정위치에 파일업로드 + 데이터베이스에 파일이름 저장시키기 / 원본네임 / 유니크네임
function fileupload_1($upfile, $target_dir, $table_name, $field_name_real, $field_name_virture, $where_value ) 
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
	// $file_virture_re_name = substr(md5(uniqid(mktime())),0,10)."_".$file_real_name;			//			db에 저장될 겹치지 않는 가상 파일네임
	
	// 파일명은 저장하지 않고 확장자만 유니크한 값에 덧붙이는 방식으로 수정
	// 확장자를 붙이기 위함
	$file_name_array = explode(".",$file_real_name);
	$file_type_index = count($file_name_array) - 1;
	$get_file_type = $file_name_array[$file_type_index];
	$file_virture_re_name = substr(md5(uniqid(mktime())),0,10).".".$get_file_type;			//			db에 저장될 겹치지 않는 가상 파일네임

	//저장될 디렉토리 ( 서버 절대경로 + 저장할 디렉토리 )
	$file_up_dir = $_SERVER["DOCUMENT_ROOT"].$target_dir;
	
	//실제 파일업로드 및 권한설정
	@move_uploaded_file($file_tmp_name, "$file_up_dir/$file_virture_re_name");
	@chmod("$file_up_dir/$file_virture_re_name", 0606);
	
	// db에 저장할 인수가 넘어왔다면 db에 파일 이름 저장 ( 실제, 가상 )
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
?>