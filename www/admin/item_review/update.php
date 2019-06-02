<?
include "./lib/lib.php";


if(!$qstr) $qstr  = "findType=$findType&findword=$findword&type=$type&sca=$sca&page=$page&category=".urlencode($category);

	// 게시글 실제번호 불러오기
	if($mode=="R") {
		$BoardSql = "select b_dep,right(b_dep,1) as n_dep from $PG_table where b_tno='$b_tno' and length(b_dep)=length('$b_dep')+1 and locate('$b_dep',b_dep)=1 limit 1";
		$dep = sql_fetch($BoardSql);

		// 게시글의 깊이 설정
		if($dep["b_dep"]==TRUE) {
			$thread_head=substr($dep["b_dep"],0,-1);
			$thread_foot= ++$dep["n_dep"];
			$b_dep=$thread_head.$thread_foot;
		}else{
			$b_dep=$b_dep."A";
		}
	}

if($b_tno==FALSE) {
	$BoardSql = "select max(b_tno) as max from $PG_table ";
	$maxnum = sql_fetch($BoardSql);
	if($maxnum["max"]==TRUE) $b_tno=$maxnum["max"]+1; else $b_tno = 1;
}

	$b_subject = addslashes($b_subject);
	$b_content = addslashes($b_content);

$Board_Invalue = "
		b_tno				=  '$b_tno',
		b_dep				=  '$b_dep',
		b_category	=  '$b_category',
		b_member			=  '$b_member',
		b_writer				=  '$b_writer',
		b_subject			=  '$b_subject',
		b_email				=  '$b_email',
		b_content			=  '$b_content',
		b_secret				=  '$b_secret',
		b_notice				=  '$b_notice',
		b_html				=  '1',
		b_link1				=  '$b_link1',
		b_link2				=  '$b_link2',
		b_ex1				=  '$b_ex1',
		b_ex2				=  '$b_ex2',
		b_ex3				=  '$b_ex3',
		b_ex4				=  '$b_ex4',
		b_ex5				=  '$b_ex5',
		b_ex6				=  '$b_ex6',
		b_ex7				=  '$b_ex7',
		b_ex8				=  '$b_ex8',
		b_ex9				=  '$b_ex9',
		b_ex10				=  '$b_ex10'
	   ";

/////// 파일 업로드
function FileDb_Input($GetFile, $id, $fid) {
	global $Board_Admin, $GnTable, $_FILES, $G_board, $datetime, $Table, $default,$bbstype,$width_new,$height_new;

	if($Board_Admin["use_data"]==TRUE) {
		##### 등록파일이 있을경우
		if ($GetFile["name"])
		{
			$FileSql = "select bf_no, bf_save_name from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$id' and bf_fno = '$fid'";
			$FileRow = sql_fetch($FileSql);
			$FileSearch = $FileRow["bf_no"];

			// 업로드할 파일의 용량을 체크합니다.
			if($GetFile["size"]==0) {
				return $fale = "파일이 정상적이지 않아 업로드 하실 수 없습니다.";
			}
			if($GetFile["size"]>$Board_Admin["fileupsize"]) {
				return $fale = "파일의 용량이 너무 커서 업로드 하실 수 없습니다.";
			}

			// 이미 등록되어 있는 파일이 있을 경우
			if($FileSearch==TRUE) {
				@unlink("$G_board[data_dir]/$Table/$FileRow[bf_save_name]");
			}

			// 파일이름 정상체크
			$Upfile = explode(".",$GetFile["name"]);
			$Upfile_total = count($Upfile) - 1;
			$Upfile_Rename =substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($Upfile[0])).".".$Upfile[$Upfile_total];

			// 파일이름 중복체크
			$bimg = $G_board["data_dir"]."/$Table/".$Upfile_Rename;
			for($pn = 1; file_exists($bimg); $pn++) {
				$Upfile_Rename = substr(md5(uniqid($g4[server_time])),0,8).'_'.str_replace('%', '', urlencode($Upfile[0]))."_($pn).".$Upfile[$Upfile_total];
				$bimg = $G_board["data_dir"]."/$Table/".$Upfile_Rename;
			}

			upload_file($GetFile["tmp_name"], $Upfile_Rename, $G_board["data_dir"]."/$Table/");


			//썸네일관련추가코드
			if ($Board_Admin[sum_flag] == "1") {  // 썸네일 이미지 하나 더 생성
				$image = $G_board["data_dir"]."/$Table/{$Upfile_Rename}";
				$size = getimagesize($image);

					if ($size[2] == 1)
						$src = imagecreatefromgif($image);
					else if ($size[2] == 2)
						$src = imagecreatefromjpeg($image);
					else if ($size[2] == 3)
						$src = imagecreatefrompng($image);
					else
						break;

				if ($Board_Admin["sum_resize"]=="1") {
					$sum_result=ImgResize($size[0],$size[1],$Board_Admin[sum_width],$Board_Admin[sum_height]);
					$ex_sum_result = explode("|",$sum_result);
					$sum_width = $ex_sum_result[0];
					$sum_height = $ex_sum_result[1];

				}
				else {
					$sum_width=$Board_Admin[sum_width];
					$sum_height=$Board_Admin[sum_height];
				}
				if (!$src){
					alert('이미지(대)가 JPG 파일이 아닙니다.');
				}
				else {
					if (function_exists("imagecopyresampled")) {
						$dst = imagecreatetruecolor($sum_width, $sum_height);
						imagecopyresampled($dst, $src, 0, 0, 0, 0, $sum_width, $sum_height, $size[0], $size[1]);
					} 
					else {
						$dst = imagecreate($sum_width, $sum_height);
						imagecopyresized($dst, $src, 0, 0, 0, 0, $sum_width, $sum_height, $size[0], $size[1]);
					}
					imagejpeg($dst, $G_board["data_dir"]."/$Table/sum_{$Upfile_Rename}", 90);
				}
			}


			$Invalue = "
				bf_table = '$Table',
				bf_tno = '$id',
				bf_fno = '$fid',
				bf_save_name = '$Upfile_Rename',
				bf_real_name = '{$GetFile[name]}'
			";
			// 글입력하기
			if($FileSearch==TRUE) {
				$FileSql = "update {$GnTable[bbsfile]} set $Invalue , bf_time = '$datetime' where bf_no='$FileSearch' ";
			} else {
				$FileSql = "insert {$GnTable[bbsfile]} set $Invalue , bf_time = '$datetime', site = '{$default[site_code]}' ";
			}
			sql_query($FileSql);
			return ;
		}
	}
}

/////// 파일 업로드 사용하는 게시판이면
function FileDb_Delete($id, $fid="0") {
	global $Board_Admin, $GnTable, $_FILES, $G_board, $datetime, $Table, $default;

	##### 등록파일이 있을경우
		if ($fid==TRUE)
		{
			$FileSql = "select bf_no, bf_save_name from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$id' and bf_fno = '$fid'";
			$FileRow = sql_fetch($FileSql);
			$FileSearch = $FileRow["bf_no"];

			$Invalue = "
				bf_table = '$Table',
				bf_tno = '$id',
				bf_fno = '$fid',
				bf_save_name = '',
				bf_real_name = ''
			";

			// 이미 등록되어 있는 파일이 있을 경우
			if($FileSearch==TRUE) {
				@unlink("$G_board[data_dir]/$Table/sum_{$FileRow[bf_save_name]}");
				@unlink("$G_board[data_dir]/$Table/{$FileRow[bf_save_name]}");
				$FileSql = "update {$GnTable[bbsfile]} set $Invalue , bf_time = '$datetime' where bf_no='$FileSearch' ";
				sql_query($FileSql);
			}
		} else {
			$FileSql = "select bf_no, bf_save_name from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$id'";
			$FileResult = sql_query($FileSql,FALSE);
			for ($i=1; $FileRow=sql_fetch_array($FileResult,FALSE); $i++) {
				@unlink("$G_board[data_dir]/$Table/sum_{$FileRow[bf_save_name]}");
				@unlink("$G_board[data_dir]/$Table/$FileRow[bf_save_name]");
				$FileSql = "delete from {$GnTable[bbsfile]} where bf_tno ='{$FileRow[bf_tno]}' ";
				sql_query($FileSql);
			}
		}
}


if ($mode=="W" || $mode=="R") {
	if(strlen($writedate) == 10) $b_regist = $writedate." ".date("H:i:s");
			else $b_regist = $datetime;
			// 글입력하기
			$BoardSql = "insert $PG_table set $Board_Invalue , b_modify = '$datetime', b_regist = '".$b_regist."', b_addip = '{$_SERVER[REMOTE_ADDR]}', site = '{$default[site_code]}' ";
			sql_query($BoardSql);

			// 등록된 글의 번호를 불러옵니다.
			$b_no = mysql_insert_id();
			
			for($i=1;$i<=$Board_Admin["fileupnum"];$i++) {
				##### 등록파일이 있을경우
				if ($_FILES["b_file".$i]["name"]){
					$mess = FileDb_Input($_FILES["b_file".$i], $b_no, $i);
					if($mess==TRUE) alert($mess,"/bbs/board.php?tbl=$Table&$NextUrl");
				}
			}

	if($mode=="W") alert ("등록되었습니다.","./list.php?".$qstr);
	else alert ("답변이 등록되었습니다.","./list.php?".$qstr);
}
else if ($mode=="E") {
// 수정할 글을 가져옵니다.
		$BoardSql = " select * from $PG_table where b_no = '$b_no' ";
		$view = sql_fetch($BoardSql);


		// 글수정하기
		$BoardSql = "update $PG_table set $Board_Invalue , b_modify = '$datetime', b_addip = '{$_SERVER[REMOTE_ADDR]}' where b_no = '$b_no' ";
		sql_query($BoardSql);
		
		for($i=1;$i<=$Board_Admin["fileupnum"];$i++) {
			if ($_POST[file_del][$i])
			{
				FileDb_Delete($b_no, $i);
			}
			##### 등록파일이 있을경우
			if ($_FILES["b_file".$i]["name"])
			{
				$mess = FileDb_Input($_FILES["b_file".$i], $b_no, $i);
				if($mess==TRUE) alert($mess,"/bbs/board.php?tbl=$Table&$NextUrl");
			}
		}
		alert ("변경되었습니다.","./list.php?".$qstr);
}
else if ($mode=="D") {

			FileDb_Delete($view["b_no"]);
			$BoardSql="delete from $PG_table where b_no = '$b_no' ";
			$BoardTotal = 1;
			
			sql_query($BoardSql);
		

	alert ("삭제되었습니다.","./list.php?".$qstr);
}
?>