<?
include "../head.php";

$PG_table = "Gn_Curriculum_File";

$input_value = "
	f_subject	= '{$f_subject}',
	f_type		= '{$type}'
";


/* ------------------------------------------------------------- [ 파일 - 업로드 / 삭제 관련 - START ] ------------------------------------------------------------- */

$down_dir = $_SERVER["DOCUMENT_ROOT"]."/curriculum/data/item/".$f_id;

@chmod($down_dir, 0707);


if($mode!="W"){
	$sql = "select * from $PG_table where f_id = '{$f_id}'";
	$view = sql_fetch($sql);
}


if ($file_del=="1") {
	// 해당 필드 초기화
	$update_sql = "UPDATE $PG_table set f_real_name = '' WHERE f_id = '$f_id' ";
	$update_query = sql_query($update_sql);

	@unlink($down_dir."/".$view[f_real_name]);
}

//파일업로드

if($_FILES[f_file][name]){
	$ext = file_type($_FILES["f_file"]["name"]);
	if(!strCmp($ext,"php") || !strCmp($ext,"htm") || !strCmp($ext,"html") || !strCmp($ext,"inc") || !strCmp($ext,"shtm") || !strCmp($ext,"ztx") || !strCmp($ext,"dot") || !strCmp($ext,"cgi") || !strCmp($ext,"pl") || !strCmp($ext,"phtm") || !strCmp($ext,"ph") || !strCmp($ext,"exe")) {
		alert("해당 파일은 업로드할 수 없는 형식입니다.","");
		exit;
	}
	@mkdir($down_dir, 0707);
	@chmod($down_dir, 0707);
	// 수정해업로드시에는 이전파일 지운다
	if($mode!="W") @unlink($down_dir."/".$view[f_real_name]);

	$filename = $_FILES["f_file"]["name"];
	$savename = $_FILES["f_file"]["tmp_name"];
	upload_file($savename, $filename, $down_dir."/");
	$input_value .= ", f_real_name = '{$filename}' ";
}

if ($mode=="W"){
    if (!trim($f_id)) {
        alert("잘못된 경로입니다.", "/admin");
    }

    $sql = " insert $PG_table
                set f_id = '$f_id',
					$input_value	";
    sql_query($sql);
}
else if ($mode=="E")
{
	$sql = " update $PG_table
				set $input_value
			  where f_id = '$f_id' ";
	sql_query($sql);
}else if ($mode=="D"){
	
	if($id) {
		// 해당 it_id 폴더내의 모든 이미지 삭제
		directoryDelete($down_dir);
	}

    // 제품 삭제
	$sql = " delete from $PG_table where f_id = '$f_id' ";
	sql_query($sql);
}

alert("수정되었습니다.", "./list.php?type=$type&page=$page");

?>