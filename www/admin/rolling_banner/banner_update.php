<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";
include "./lib/fileupload_mj.php";

if (!$bn_no) {
	$sql="select max(bn_no) as no_max from {$PG_table}";
	$row_max=sql_fetch($sql);
	$bn_no=$row_max["no_max"]+40;
}

$sql_values="
	bn_subject='$bn_subject',
	type='$type',
	bn_category='$bn_category',
	bn_content='$bn_content',
	bn_link='$bn_link',
	bn_link_target='$bn_link_target',
	bn_ex1='$bn_ex1',
	bn_ex2='$bn_ex2',
	bn_ex3='$bn_ex3',
	bn_ex4='$bn_ex4',
	bn_ex5='$bn_ex5',
	bn_sort='$bn_sort'
";

if($type==2) $sql_values .= ", bn_subject_en = '$bn_subject_en', bn_content_en = '$bn_content_en'";

// 파일 업로드를 시킨다면
if($_FILES[bn_img]) {
	$sql_values .= "
		, bn_dir='$upload_url'
	";
}

// 첨부파일 업로드 2014.1.8 [필수 설정 변수]
$upfile = $_FILES[bn_img];								//				파일전역변수 [fileup]은 [인풋네임값]
$target_dir = $upload_url;								//				저장될 디렉토리 (lib.php 정의됨)
$table_name = $PG_table;								//				저장될 테이블 이름
$field_name_real = "bn_oname	";					//				필드이름   ( 원본파일이름이 저장될 필드 )
$field_name_virture = "bn_rname";					//				필드이름2 ( 가상파일이름이 저장될 필드 )
$where_value = " bn_no = '$bn_no'";				//				조건 = '값'

if($bn_img_del) {
//기존파일삭제
$old_fild_url = $_SERVER[DOCUMENT_ROOT].$target_dir."/".$old_file;
@unlink($old_fild_url);
	$delete_file_sql = "UPDATE $table_name SET $field_name_real='', $field_name_virture='' WHERE $where_value";
	$delete_file_query = mysql_query($delete_file_sql);
}


if ($mode=="W") {
	$sql="insert {$PG_table} set bn_no='$bn_no', {$sql_values}";
	sql_query($sql,FALSE);
	
	if($upfile[tmp_name]!="") {
		fileupload_1($upfile, $target_dir, $table_name, $field_name_real, $field_name_virture, $where_value);			//				함수 호출
	}

	alert ("등록되었습니다.","./banner_list.php?type=$type");
}
else if ($mode=="E") {
	$sql="update {$PG_table} set {$sql_values} where bn_no='{$bn_no}'";
	sql_query($sql,FALSE);
	
	if($upfile[tmp_name]!="") {
		fileupload_1($upfile, $target_dir, $table_name, $field_name_real, $field_name_virture, $where_value);			//				함수 호출
	}

	alert ("수정되었습니다.","./banner_list.php?type=$type");
}
else if ($mode=="D") {
	$file_sql = "SELECT bn_rname FROM {$PG_table} WHERE bn_no='$bn_no' ";
	$file_row = sql_fetch($file_sql);
	
	@unlink($_SERVER[DOCUMENT_ROOT].$target_dir."/".$file_row['bn_rname']);

	$sql="delete from {$PG_table} where bn_no='{$bn_no}'";
	sql_query($sql,FALSE);

	
	alert ("삭제되었습니다.","./banner_list.php?type=$type");
}
?>