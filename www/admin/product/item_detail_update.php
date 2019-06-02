<?
include "../head.php";
include "./lib/lib.php";

/* ------------------------------------------------------------- [ 파일업로드 관련 기본 설정 - START ] ------------------------------------------------------------- */
$ex_target_url			= $GnProd["ex_target_url"];				//		저장될 웹 디렉토리경로
$ex_target_dir			= $GnProd["ex_target_dir"];				//		서버상 실제 경로  (파일삭제,존재유무확인용)
$ex_table_name			= $GnProd["ex_table_name"];				//		저장될 테이블 이름
$ex_field_name_real		= $GnProd["ex_field_name_real"];			//		필드이름   ( 원본파일이름이 저장될 필드 )
$ex_field_name_virture = $GnProd["ex_field_name_virture"];		//		필드이름2 ( 가상파일이름이 저장될 필드 )
$upfile					= $_FILES[fileup];							//		파일전역변수 [fileup]은 [넘어오는 인풋네임값] 

@mkdir($ex_target_dir, 0707);
@chmod($ex_target_dir, 0707);
/* ------------------------------------------------------------- [ 파일업로드 관련 기본 설정 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 필드 - START ] ------------------------------------------------------------- */
$input_value = "
	d_it_id				= '$d_it_id',
	d_ex1				= '$d_ex1',
	d_ex2				= '$d_ex2',
	d_ex3				= '$d_ex3',
	d_ex4				= '$d_ex4',
	d_ex5				= '$d_ex5',
	d_ex6				= '$d_ex6',
	d_ex7				= '$d_ex7',
	d_ex8				= '$d_ex8',
	d_ex9				= '$d_ex9',
	d_ex10			= '$d_ex10',
	d_use				= '$d_use',
	d_sort				= '$d_sort'
";
/* ------------------------------------------------------------- [ 필드 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 모드 처리 - START ] ------------------------------------------------------------- */

//////// 등록
if ($mode=="W")	
{
    if (!trim($d_it_id)) 
	{
        alert("제품 코드가 없으므로 제품을 추가하실 수 없습니다.");
    }

	// 데이터베이스 인서트
    $sql = " insert $EX_table set $input_value	,d_regist='$datetime' ";
    sql_query($sql);
	$instert_num = mysql_insert_id();
	
	// 첨부파일 업로드
	$where_value = " d_no = '$instert_num'";			//		조건 = '값'
	if($upfile[tmp_name]!="") 
	{
		fileupload_MJ($upfile, $ex_target_url, $ex_table_name, $ex_field_name_real, $ex_field_name_virture, $where_value);			//	함수 호출
	}

}

//////// 수정
else if ($mode=="E")
{
	// 데이터 베이스 업데이트
	$sql = " update $EX_table set $input_value where d_no = '$d_no' ";
	sql_query($sql);

	/* --------------------------------- [ 첨부파일 등록 - START ] -------------------------------------- */
	// 첨부파일 업로드
	$where_value = " d_no = '$d_no'";			//		조건 = '값'
	
	// 기존 파일 삭제 - 체크박스 체크 유무
	if($delet_file == "D") 
	{
		// 기존 업로드 파일명 조회
		$find_file_sql = "SELECT {$ex_field_name_virture} FROM {$EX_table} WHERE d_no = '$d_no' ";
		$find_file_query = mysql_query($find_file_sql);
		$find_file_row = mysql_fetch_array($find_file_query);
		
		// 기존 파일 삭제
		$old_fild_url = $ex_target_dir."/".$find_file_row[$ex_field_name_virture];
		@unlink($old_fild_url);

		// 데이터베이스 해당 필드 초기화
		$delete_file_sql = "UPDATE $ex_table_name SET $ex_field_name_real='', $ex_field_name_virture='' WHERE $where_value";
		$delete_file_query = mysql_query($delete_file_sql);
	}

	if($upfile[tmp_name]!="") 
	{
		//	함수 호출
		fileupload_MJ($upfile, $ex_target_url, $ex_table_name, $ex_field_name_real, $ex_field_name_virture, $where_value);			
	}
	/* ------------------------------ [ 첨부파일 등록 - END ] ------------------------------ */
	
}

//////// 삭제
else if ($mode=="D")
{
	// 기존 업로드 파일명 조회
	$find_file_sql = "SELECT {$ex_field_name_virture} FROM {$EX_table} WHERE d_no = '$d_no' ";
	$find_file_query = mysql_query($find_file_sql);
	$find_file_row = mysql_fetch_array($find_file_query);
	
	// 기존 파일 삭제
	$old_fild_url = $ex_target_dir."/".$find_file_row[$ex_field_name_virture];
	@unlink($old_fild_url);

	// 데이터베이스 로우 삭제
	$sql = " delete from $EX_table where d_no = '$d_no' ";
	sql_query($sql);
}
/* ------------------------------------------------------------- [ 모드 처리 - END ] ------------------------------------------------------------- */




/* ------------------------------------------------------------- [ 페이지 이동 - START ] ------------------------------------------------------------- */
$qstr = "$qstr&it_id=$d_it_id&sca=$sca&page=$page";
if ($mode=="E" || $mode == "D")  {
	goto_url("./item_detail_list.php?$qstr");
}

?>

<script>
	if (confirm("계속 입력하시겠습니까?"))
		location.href = "<?="./item_detail_form.php?mode=W&$qstr"?>";
	else
		location.href = "<?="./item_detail_list.php?$qstr"?>";
</script>