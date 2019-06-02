<?
		////////////////////// 카테고리 등록 게시판이면
		if($Board_Admin["use_category"] == TRUE) {
			if($view["b_category"] == TRUE) {
				$Category_option = Get_BoardCate($Board_Admin["category"],$view["b_category"]);
			} else {
				$Category_option = Get_BoardCate($Board_Admin["category"],$category);
			}
		}
		
		$view["b_subject"]=stripslashes($view["b_subject"]);
		//$content=stripslashes($view["b_content"]);
		$content=stripslashes(htmlspecialchars($view["b_content"]));

		if($Board_Admin["use_notice"]==TRUE && $Board_Admin["level_notice"] <= $_SESSION["userlevel"]) {
			$checked = ($view["b_notice"]==TRUE)?"checked":"";
			$Input_Notice = "<input type='checkbox' name='b_notice' value='1' $checked style='border:0;vertical-align:middle;'> <span style='padding-top:7px;'>공지</span>";
		}
		if($Board_Admin["use_html"]==TRUE && $Board_Admin["level_html"] <= $_SESSION["userlevel"]) {
			if($mode=="MODIFY") $checked= ($view["b_html"]==TRUE)?"checked":"";
			else  $checked = "checked";
			$Input_Html = "<input type='checkbox' name='b_html' value='1' $checked style='border:0;vertical-align:middle;'> HTML";
		}
		if($Board_Admin["use_secret"]==TRUE) {
			if($mode=="MODIFY") $checked = ($view["b_secret"]==TRUE)?"checked":"";
			else  $checked = "checked";
			$Input_Secret = "<input type='checkbox' name='b_secret' value='1' $checked style='border:0;vertical-align:middle;'> 비밀";
		}
		if($Board_Admin["use_asecret"]==TRUE) {
			$Input_Secret = "<input type='hidden' name='b_secret' value='1'>";
		}
		////////////////////// 파일 업로드 게시판이면
		if($Board_Admin["use_data"]==TRUE) {
			// 파일 테이블에서 해당하는 파일 정보를 불러옵니다.
			$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$num' ";
			$Get_File_result = sql_query($Get_File_sql,FALSE);
			//다운파일이 있으면
			for ($i=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $i++) {
				if($Get_File["bf_no"]) {
					$i = $Get_File["bf_fno"];
					##### 등록파일이 있을경우
					if($Get_File["bf_save_name"]) {
						$getsavename = $Get_File["bf_save_name"];
						$getfilename = $Get_File["bf_real_name"];
						//파일 삭제 선택 INPUT 을 넣어줍니다.
						$view["b_file".$i] = "$getfilename <input type='checkbox' name='file_del[$i]' value='1'> 삭제";
					}
				}
			}
		}
?>