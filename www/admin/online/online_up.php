<?
	include "../head.php";

	$PG_table = $GnTable["online"];

	///↓↓↓↓↓↓ 데이터 내용을 정리해줍시다 ↓↓↓↓↓↓↓↓↓↓↓↓↓///
	$subject 			= addslashes($subject);
	$content			= addslashes($content);
	$option1 			= addslashes($option1);
	$option2 			= addslashes($option2);
	$option3 			= addslashes($option3);
	$option4 			= addslashes($option4);
	$option5 			= addslashes($option5);

	if($retime_h) $visiteDate		= mktime($retime_h, 0, 0, $retime_m, $retime_d, $retime_y);

	$retime			= time();
	///↑↑↑↑↑↑ 데이터 내용을 정리해줍시다 ↑↑↑↑↑↑↑↑↑↑↑↑↑///

	// 저장할 데이터를 정렬합니다 
	$online_Invalue = "
						username		= '$username', 
						subject			= '$subject', 
						phone			= '$phone',
						mobile			= '$mobile',
						fax				= '$fax',
						email				= '$email',
						option1			= '$option1',
						option2			= '$option2',
						option3			= '$option3',
						option4			= '$option4',
						option5			= '$option5',
						content			= '$content',
						visiteDate		= '$visiteDate',
						link1				= '$link1',
						link2				= '$link2'
		";

	// 첨부파일의 이름을 저장합니다. 
	for($i=1;$i<=3;$i++) {
		##### 등록파일이 있을경우
		if ($_FILES["userfile".$i]["name"])
		{
			// 파일이름 정상체크
			$Upfile = explode(".",$_FILES["userfile".$i]["name"]);
			$Upfile_total = count($Upfile) - 1;
			$Upfile_Rename = $Upfile[0].".".$Upfile[$Upfile_total];

			// 파일이름 중복체크
			$bimg = $G_online["data_dir"]."/".$Upfile_Rename;
			for($pn = 1; file_exists($bimg); $pn++) {
				$Upfile_Rename = $Upfile[0]."_($pn).".$Upfile[$Upfile_total];
				$bimg = $G_online["data_dir"]."/".$Upfile_Rename;
			}
			upload_file($_FILES["userfile".$i]["tmp_name"], $Upfile_Rename, $G_online["data_dir"]."/");

			$online_Invalue .= ", userfile{$i} =  '$Upfile_Rename' ";
		}
	}

if($mode=="E") {		//////////////////  내용 수정하기 //////////////////////////////////////////////////////////////////////////////////
	//수정할 필드의 정보 추출
	$sql = " select * from $PG_table where num = '$num' ";
	$row = sql_fetch($sql);

	if($row[num]==TRUE) {
		$qry =" UPDATE $PG_table set
							$online_Invalue ,
							memo			= '$memo'
					where num = '$num'
				";
		sql_query($qry);
	} else {
		alert("등록된 글이 없습니다.");	
	}

	//글이 등록되어 List로 이동
	alert("글이 수정되었습니다.","./online_list.php?type=$type&page=$page");
}

if($mode=="W") {			//////////////////  내용 입력하기 //////////////////////////////////////////////////////////////////////////////////

	$qry =" insert into $PG_table set
						type				= '$type',
						$online_Invalue 
			";

		sql_query($qry);

	//글이 등록되어 List로 이동
	alert("글이 등록되었습니다.","./online_list.php?type=$type&page=$page");
}

if($mode=="D") {
	//수정할 필드의 정보 추출
	$sql = " select * from $PG_table where num = '$num' ";
	$row = sql_fetch($sql);

	if($row[num]==TRUE) {
		$qry = "DELETE FROM $PG_table WHERE num = '$num' ";
		sql_query($qry);
	} else {
		alert("등록된 글이 없습니다.");	
	}

	//글이 등록되어 List로 이동
	alert("글이 삭제되었습니다.","./online_list.php?type=$type&page=$page");
}
?>