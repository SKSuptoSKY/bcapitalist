<?
		/// 조회수를 변경합니다.
			if ($_COOKIE["ck_{$Table}_{$num}_hit"] != $num) {
				sql_query(" update $BB_table set b_hit = b_hit + 1 where b_no = '$num' "); // 1증가
				setcookie("ck_{$Table}_{$num}_hit", $num, time() + 3600, "/",$_SERVER["SERVER_NAME"]); // 1시간동안 저장
			}

	//########## 여기부터 게시글을 보기위한 변수들을 설정합니다 ######################//

		// 파일 테이블에서 해당하는 파일 정보를 불러옵니다.
		$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '$num' order by bf_fno";
		$Get_File_result = sql_query($Get_File_sql,FALSE);
		$imgFile = "";
		$downTag = "";
		//다운파일이 있으면
		for ($i=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $i++) {
			if($Get_File["bf_no"] && $Board_Admin["use_data"]==TRUE) {
				##### 등록파일이 있을경우
				if($Get_File["bf_save_name"]) {
					$getsavename = $Get_File["bf_save_name"];
					$getfilename = $Get_File["bf_real_name"];
					//이미지 파일의 경우 화면에서 출력
					$size=@GetImageSize($_SERVER["DOCUMENT_ROOT"]."/bbs/data/$Table/".$getsavename);	// 이미지 싸이즈 추출
					$resize = ($size[0]> $Board_Admin["imgsize"]) ? $Board_Admin["imgsize"] : $size[0];
					
					$ext = file_type($getfilename);

					if(!strCmp($ext,"jpeg") || !strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {
						$imgFile .= "<img src='/bbs/data/".$Table."/".$getsavename."' width='".$resize."'><br><br>";
						$view["img_".$i] = "/bbs/data/$Table/$getsavename";
					}else if(!strCmp($ext,"mov") || !strCmp($ext,"wmv") || !strCmp($ext,"avi") || !strCmp($ext,"asf") || !strCmp($ext,"asx") || !strCmp($ext,"mpeg") || !strCmp($ext,"mpg")) {
						$imgFile .= "<embed src='/bbs/data/".$Table."/".$getsavename."' autostart=true></embed><br><br>";
					} else {
						$view["img_".$i] = "";
					}
					if($downTag!="") $downTag .= " | ";
					$downTag .= "<a href='/bbs/download.php?tbl=$Table&no={$Get_File[bf_no]}'>{$getfilename}</a>";
				}
			}
		}
		
		if($Board_Admin[use_view] != "1") $imgFile="";
		// Link 필드가 있으면
		if($view['b_link1']) {
			$linkUrl1 = str_replace("http://","",$view['b_link1']);
			$linkUrl = "http://".$linkUrl1;
		}
		if($view['b_link2']) {
			$linkUrl2 = str_replace("http://","",$view['b_link2']);
			if($linkUrl==TRUE) $linkUrl = "<br> http://".$linkUrl2;
			 else $linkUrl = "http://".$linkUrl2;
		}
		//html 사용을 허가 한다면...
		if($view["b_html"]==FALSE) {
			$view["content"] = htmlspecialchars($view["b_content"]);
			$view["content"]=stripslashes(nl2br($view["content"]));
			// AUTO LINK
			$view["content"]= url_auto_link($view["content"]);
		} else {
			$view["content"] = stripslashes($view["b_content"]);
		}
		$view["subject"] = stripslashes(str_replace('&amp;','&',htmlspecialchars($view["b_subject"])));
		////////////////////// 카테고리 등록 게시판이면
		if($Board_Admin["use_category"] == "1") {
			if($view["b_category"]==FALSE) $view["b_category"] = "전체";
			$view["category"] = "[{$view[b_category]}]";
		}
	//########## 여기부터 게시글을 보기위한 변수들을 설정합니다 ######################//
		//2009.3.25 Ki-hong Park [이전글 다음글 표시]
		//$pre_next_result = sql_query("select b_no from $BB_table where b_dep='A' order by b_no ASC "); // 원글만 추출할때
		$pre_next_result = sql_query("select b_no from $BB_table where 1 order by b_tno DESC,b_dep ASC "); // 답변글과 함께
		
		if ($Table=="shop_qna" && $_SESSION[qna_config] == "qna_guest")
		{
			// 상품페이지속 상품문의에서 이전 다음글이 해당상품에 해당하는 이전 다음상품만 출력하기 위한 쿼리 
			$pre_next_result = sql_query("select b_no from $BB_table where b_ex2='$view[b_ex2]' order by b_tno DESC,b_dep ASC "); 
		}
		else
		{
			$pre_next_result = sql_query("select b_no from $BB_table where 1 order by b_tno DESC,b_dep ASC "); // 답변글과 함께
		}

		for($j=0;$pre_next=mysql_fetch_array($pre_next_result);$j++){
			$array[$j] = $pre_next[b_no];
		}
		for($k=0;$k<count($array);$k++){
			if($array[$k] == $num){
				$next_no = $array[$k - 1];
				$pre_no = $array[$k + 1];
			} 
		}
		if($pre_no!=""){
			$go_pre = sql_fetch(" select b_no,b_subject,b_dep from $BB_table where b_no='$pre_no' ");
			$Url["pre"] = "/bbs/board.php?tbl=$Table&mode=VIEW&num=".$go_pre[b_no]."&$NextUrl";
			if(strlen($go_pre['b_dep'])>1) $Url["pre_dep"] = "[답글] ";
			$Url["pre_subject"] = $Url["pre_dep"]."<a href=\"".$Url["pre"]."\">".cut_str(stripslashes($go_pre['b_subject']),80,"...")."</a>";
		}else{
			$Url["pre"] = "";
			$Url["pre_subject"] = "이전글이 없습니다.";
		}
		if($next_no!=""){
			$go_next = sql_fetch(" select b_no,b_subject,b_dep from $BB_table where b_no='$next_no' ");
			$Url["next"] = "/bbs/board.php?tbl=$Table&mode=VIEW&num=".$go_next[b_no]."&$NextUrl";
			if(strlen($go_next['b_dep'])>1) $Url["next_dep"] = "[답글] ";
			$Url["next_subject"] = $Url["next_dep"]."<a href=\"".$Url["next"]."\">".cut_str(stripslashes($go_next['b_subject']),80,"...")."</a>";
		}else{
			$Url["next"] = "";
			$Url["next_subject"] = "다음글이 없습니다.";
		}

		// 링크 변수를 설정합니다.
		if($_SESSION["userlevel"] >= $Board_Admin["level_write"]) {
			if($Get_Login==TRUE && ($_SESSION["userid"]==$view["b_member"] || $_SESSION["userlevel"]==100)) {
				$Url["modify"] = "/bbs/board.php?tbl=$Table&mode=MODIFY&num=$num&$NextUrl";
				$Url["delete"] = "/bbs/process.php?tbl=$Table&mode=DELETE&num=$num&$NextUrl";
			} else {
				$Url["modify"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=MODIFY&num=$num&$NextUrl";
				$Url["delete"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=DELETE&num=$num&$NextUrl";
			}
		} else {
			$Url["modify"] = "";
			$Url["delete"] = "";
		}
		if($Board_Admin["use_reply"]==TRUE && $_SESSION["userlevel"] >= $Board_Admin["level_reple"]) {
			$Url["reply"] = "/bbs/board.php?tbl=$Table&mode=REPLY&num=$num&$NextUrl";
		} else {
			$Url["reply"] = "";
		}
		if($Board_Admin["use_best"]==TRUE && $Get_Login==TRUE) {
			$Url["best"] = "/bbs/process.php?tbl=$Table&mode=BEST&num=$num&$NextUrl";
		} else {
			$Url["best"] = "";
		}

// 댓글을 사용하는 게시판이면
if($Board_Admin["use_comment"]==TRUE) {// 댓글 페이징 시키기 mj 추가
}


?>