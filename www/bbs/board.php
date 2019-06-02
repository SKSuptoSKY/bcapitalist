<?
 if ($mobile_flag == "ok") {
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	$G_board["skin_dir"] = $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/bbs";
 } else {
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
 }

if(!$_SESSION["userlevel"]) $_SESSION["userlevel"] = 0; //2017-06-01 비회원 체크 // 이부분이 문제

	if($_GET[tbl]==TRUE) {
		$Table = $_GET[tbl];
		$tbl = $_GET[tbl] = "";
	} else {
		alert("게시판 테이블이 설정되지 않았습니다.","/main.php");
	}

	// 지도관련 겟값이 있을때 카테고리 값에 넣어라.
	if($selcity != "" && $category == "") $category = $selcity;

	if(strlen($Table) > 15){
		alert("잘못된 게시판 테이블명입니다.","/main.php");
	}

	$BB_table = $GnTable["bbsitem"].$Table;
	$BC_table = $GnTable["bbscomm"].$Table;

// 게시판 설정 내용을 불러옵니다.
	$BoardSql = " select* from {$GnTable[bbsconfig]} where dbname = '$Table' ";
	$Board_Admin = sql_fetch($BoardSql);
	// 모바일이면 모바일 전용 게시판 스킨으로 불러오게 설정----------------
	if($mobile_flag=="ok" and $Table=="gallery"){
		$Board_Admin[skin] = "gallery_basic_m";
	}else if($mobile_flag=="ok" and $Table=="notice"){
		$Board_Admin[skin] = "basic_white_m";
	}else if($mobile_flag=="ok" and $Table=="faq"){
		$Board_Admin[skin] = "basic_faq_m";
	}
	// ---------------------------------------------------------------
	if($Board_Admin["dbname"]==FALSE) {
		alert("잘못된 게시판 테이블명입니다.","/main.php");
	}
	if($Board_Admin["view"]==FALSE) {
		alert("사용할 수 없는 게시판입니다.","/main.php");
	}

// 게시판 설정 내용 변수를 설정합니다.
	if($Board_Admin["width"] <=100) $Board_Admin["width"] = $Board_Admin["width"]."%";
	// 페이지 코드를 설정해줍니다.
	if($Board_Admin["page_loc"] == TRUE) $page_loc = $Board_Admin["page_loc"]; else $page_loc = "bbs";
	$Board_Admin["skin_dir"] = "/skin/bbs/{$Board_Admin[skin]}";

	// 리스트 출력 순서를 조절합니다.
	$List_Order = "order by b_notice desc, b_tno desc, b_dep, b_no desc";
	$Comm_Order = " order by c_regist desc";

	if(isset($findWord))  $findWord =  urlencode($findWord); // search field (검색 필드)
	// 주소 변수 / 다음페이지 설정
	$NextUrl = "category=$category&findType=$findType&findWord=$findWord&sort1=$sort1&sort2=$sort2&page=$page&mobile_flag=$mobile_flag";
	if($_SESSION["qna_config"] == "qna_admin") $NextUrl .= "&shop_flag=$shop_flag";
	else if($shop_flag == "ok") $NextUrl .= "&shop_flag=$shop_flag&it_id=$it_id&it_name=$it_name";

	// 링크 변수를 설정합니다.
	$Url["list"] = ($_SESSION["userlevel"] >= $Board_Admin["level_list"]) ? "/bbs/board.php?tbl=$Table&$NextUrl" : "";
	$Url["write"] = ($_SESSION["userlevel"] >= $Board_Admin["level_write"]) ? "/bbs/board.php?tbl=$Table&mode=WRITE&$NextUrl" : "";
	$Url["admin"] = ($_SESSION["userlevel"] ==100) ? "/admin/bbs/bbs_form.php?mode=E&id={$Board_Admin[code]}" : "";

	// 관리자 체크 변수
	//if($_SESSION["userlevel"] ==100) $LogAdmin = TRUE; else $LogAdmin = FALSE;

// 게시판 해드부분 추출
if($mobile_flag=="ok") {
	if($shop_flag == "ok") {
		include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.lib.php";
		$Board_Admin["skin"] = "shop_review";
	} else {
		include $_SERVER["DOCUMENT_ROOT"]."/mobile/head.php";
	}
} else {
	if($Board_Admin["head"]==TRUE) {
		if($shop_flag == "ok") {  // 상품상세에 포함 된 리뷰라면 해드를 제외하고 스킨도 다른스킨을 적용시킨다
			include "../head.lib.php";
			$Board_Admin["skin"] = "shop_review";
		}else{
			include $Board_Admin["head"];
		}
	}
}
if($Board_Admin["headtag"]==TRUE) echo stripslashes($Board_Admin["headtag"]);

// MODE에 따른 출력
switch ($mode) {

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  비밀번호 확인 폼
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	case "PASS" :

		if($type=="MODIFY" || $type=="VIEW") {
			$NextAction = "/bbs/board.php?tbl=$Table&mode=$type&num=$num&$NextUrl";
		} else {
			$NextAction = "/bbs/process.php";
		}
		// 해당 스킨파일 인클루드
		include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/passcheck.skin.php");

	break;

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  답글쓰기
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	case "REPLY" :
		// 권한을 체크합니다.
		if($_SESSION["userlevel"]<$Board_Admin["level_reple"]) alert("답변하실 권한이 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		if($Board_Admin["use_reply"]==FALSE) alert("본 게시판은 답변 기능을 사용하실 수 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");

		// 원본글을 가져옵니다.
		$BoardSql = " select b_tno, b_dep, b_subject, b_category, b_content, b_secret from $BB_table where b_no = '$num' ";
		$view = sql_fetch($BoardSql);

		//답글에 >> 표시 해주기
		//$tmp_body = split("\n", $view["b_content"]);
		//for ($R = 0; $R < sizeOf($tmp_body); $R++) { $view["b_content"] .= ">> ".$tmp_body[$R]."\n"; }
		$view["b_content"] = "<br><br><br>\n\n===================== 원글 내용 ====================<br>\r\n".$view["b_content"];
		$view["b_subject"] = $view["b_subject"];

		// 로그인 기본정보 불러오기
		$view["b_member"] = $_SESSION["userid"];
		$view["b_writer"] = $_SESSION["nickname"];
		$view["b_email"] = $_SESSION["email"];

		// 게시글 쓰기 코드파일을 불러옵니다.
		include_once("./form.php");

		// 해당 스킨파일 인클루드
		include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/form.skin.php");

	break;

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  글쓰기
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	case "WRITE" :

		// 권한을 체크합니다.
		if($_SESSION["userlevel"]<$Board_Admin["level_write"]) alert("게시글을 작성하실 권한이 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");

		// 로그인 기본정보 불러오기
		$view["b_member"] = $_SESSION["userid"];
		$view["b_writer"] = $_SESSION["nickname"];
		$view["b_email"] = $_SESSION["email"];

		$view["b_dep"] = "A";

		// 게시글 쓰기 코드파일을 불러옵니다.
		include_once("./form.php");

		// 해당 스킨파일 인클루드
		include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/form.skin.php");

	break;

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  글 수정
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	case "MODIFY" :

		// 글을 가져옵니다.
		$BoardSql = " select * from $BB_table where b_no = '$num' ";
		$view = sql_fetch($BoardSql);

		// 권한을 체크합니다.
		if($_SESSION["userlevel"]<$Board_Admin["level_write"]) alert("게시글을 작성하실 권한이 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		if($view["b_member"]==TRUE) {
			if(Member_check($view["b_member"])==FALSE) alert("본인이 작성하신 글이 아닙니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		}
		if($view["b_member"]==FALSE && $_POST["passwd"]==FALSE && $_SESSION["userlevel"]<100) {
			alert("비밀번호가 전달되지 않았습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		}
		if($_POST["passwd"]==TRUE) {
			$ChangePass = sql_password($_POST["passwd"]);
			if($view["b_passwd"]!=$ChangePass) alert("비밀번호가 맞지 않아 수정하실 수 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		}

		// 게시글 쓰기 코드파일을 불러옵니다.
		include_once("./form.php");

		// 해당 스킨파일 인클루드
		include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/form.skin.php");

	break;

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  보기 화면 출력
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	case "VIEW":

		// 글을 가져옵니다.
		$BoardSql = " select a.*, count(b.c_no) as comment from $BB_table a left join $BC_table b on (a.b_no = b.c_bno) where b_no = '$num' group by b_no";
		$view = sql_fetch($BoardSql);

		// 보는글이 답변 글일 경우
		if(strlen($view["b_dep"])>1) {
			// 원본글을 가져옵니다.
			$BoardSql = " select * from $BB_table where b_tno = '{$view[b_tno]}' and b_dep='A' ";
			$old = sql_fetch($BoardSql);
		}

		// 권한을 체크합니다.
		if($_SESSION["userlevel"]<$Board_Admin["level_view"]) alert("게시글을 열람하실 권한이 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
		if($view["b_no"]==FALSE) {
			 alert("열람하실 게시물을 선택하세요.","/bbs/board.php?tbl=$Table&$NextUrl");
		}

		if($view["b_secret"]==TRUE && $view["b_dep"]=="A") {
		// 비밀글이며, 답변글이 아닐 경우
			if($view["b_member"]==TRUE && Member_check($view["b_member"])==FALSE) {
				alert("본인이 작성하신 글이 아닙니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}
			if($Get_Login==FALSE && $_POST["passwd"]==FALSE && $_SESSION["userlevel"]<100) {
				alert("비밀번호가 전달되지 않았습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}
			if($_POST["passwd"]==TRUE) {
				$ChangePass = sql_password($_POST["passwd"]);
				if($view["b_passwd"]!=$ChangePass) alert("비밀번호가 맞지 않아 열람하실 수 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}

		// 비밀글이며, 답변글일 경우
		} else if($view["b_secret"]==TRUE && $old["b_no"]==TRUE) {
			if(($view["b_member"]==TRUE && Member_check($view["b_member"])==FALSE) && ($old["b_member"]==TRUE && Member_check($old["b_member"])==FALSE)) {
				alert("본인이 작성하신 글이 아닙니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}
			if($Get_Login==FALSE && $_POST["passwd"]==FALSE && $_SESSION["userlevel"]<100)  {
				alert("비밀번호가 전달되지 않았습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}
			if($_POST["passwd"]==TRUE) {
				$ChangePass = sql_password($_POST["passwd"]);
				if(($view["b_passwd"]!=$ChangePass || $view["b_member"]!="") && ($old["b_passwd"]!=$ChangePass || $old["b_member"]!="")) alert("비밀번호가 맞지 않아 열람하실 수 없습니다.","/bbs/board.php?tbl=$Table&$NextUrl");
			}
		}


		// 게시글 목록 코드파일을 불러옵니다.
		include_once("./view.php");

		// 댓글을 사용하는 게시판이면
		if($Board_Admin["use_comment"]==TRUE) {
			// 댓글 리스트를 불러옵니다.
			//---------------------------------------------------------------------------------------------------
			// 테이블의 전체 레코드수만 얻음
			$BoardSql = " select count(*) as cnt from $BC_table WHERE c_bno='$num'";
			$c_row = sql_fetch($BoardSql,FALSE);
			$c_total_count = $c_row[cnt];
			$c_rows = 5;
			$c_total_page  = ceil($c_total_count / $c_rows);  // 전체 페이지 계산
			if ($c_page == "") { $c_page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
			$c_from_record = ($c_page - 1) * $c_rows; // 시작 열을 구함
			// 페이지별 시작번호
			$c_cur_num=$c_total_count - ($c_rows * ($c_page-1));
			// 댓글 리스트를 불러옵니다.
			$Comm_Order = " order by c_tno asc, c_dep, c_no desc, c_regist desc";
			$BoardSql = " select * from $BC_table where c_bno = '$num' $Comm_Order limit $c_from_record, $c_rows";
			// ------------------------------------------------------------------------------------------------------------------------------------
			// 맨 하단 페이징시키기 변수 선언 (꼬리값 중요)
			$c_PageLinks2 = get_paging("10", $c_page, $c_total_page, "$_SERVER[PHP_SELF]?tbl=$Table&mode=VIEW&num=$num&category=$category&page=$page&c_page=");
			$BoardResult = sql_query($BoardSql,FALSE);
			for($C=0; $row = sql_fetch_array($BoardResult); $C++) {
				$comm[$C] = $row;

			#############################################################
			######## [2014.07.11 수정] 코멘트에 댓글 업그레이드 ################
			#############################################################
			$depth="";
			$depth_num="";
			$length=strlen($comm[$C]["c_dep"]);
			## 답변 아이콘 초기화
			$comm[$C]["reicon"] = "";
			$comm[$C]["reicon2"] = "";
			if($length !=1) {
				$space = 14;	// 들여쓰기 간격
				for($k=2;$k<=$length;$k++) {
					//들여쓰기
					$depth_num=$depth_num."<img src='{$Board_Admin[skin_dir]}/images/icon_22.jpg' border=0  align='absmiddle'> ";
					$depth_num2 = "<img style='padding-left:".$space."px;' src='{$Board_Admin[skin_dir]}/images/icon_22.jpg' border=0  align='absmiddle'> ";
					$space+=$space;
				}
				$comm[$C]["reicon"] = "<span style='padding-left:15px;'>".$depth_num."</span>";//."<font color=orange><b>[댓글]</b></font>&nbsp;";
				$left = $k*10;
				
				$comm[$C]["reicon2"] = $depth_num2;
			#############댓글에 비밀 답변 댓글을 달았을때 ##############
			$new_c_dep = null;
			for($c_dep_cnt=0;$c_dep_cnt < $length-1;$c_dep_cnt++){
				$new_c_dep .= "A";
			}
			$TopComSql = " select * from $BC_table where c_bno = '$num' and c_dep = '$new_c_dep'";
			//echo $TopComSql."<br>";
			$TopComView = sql_fetch($TopComSql);
			$comm[$C]["TopCom_writer"] = $TopComView[c_member];
			#############################################################
			}
			#############################################################

				$comm[$C]["subject"] =stripslashes(str_replace('&amp;','&',htmlspecialchars($row["c_subject"])));
				//$comm[$C]["content"] = nl2br(stripslashes(str_replace('&amp;','&',htmlspecialchars($row["c_content"]))));
				$comm[$C]["content"] = stripslashes(stripslashes(str_replace('&amp;','&',htmlspecialchars($row["c_content"]))));
				//$comm[$C]["regist"] = substr($row["c_regist"],0,10);
				$comm[$C]["regist"] = $row["c_regist"];
				$comm[$C]["UrlDel"] = "";
				if($_SESSION["userlevel"]==100)  // 관리자패스
				{
					$comm[$C]["comedit"]  = "/bbs/commodify.php?tbl=$Table&num=$num&cnum=".$comm[$C][c_no];
					$comm[$C]["comdele"] = "/bbs/process.php?tbl=$Table&mode=COMDEL&num={$row[c_no]}&$NextUrl";
				}else{
				if($row["c_member"]==TRUE && ($_SESSION["userid"]==$row["c_member"] || $_SESSION["userlevel"]==100)) {
					$comm[$C]["comedit"]  = "/bbs/commodify.php?tbl=$Table&num=$num&cnum=".$comm[$C][c_no];
					$comm[$C]["comdele"] = "/bbs/process.php?tbl=$Table&mode=COMDEL&num={$row[c_no]}&$NextUrl";
				} else if($row["c_member"]==TRUE) {
					$comm[$C]["comedit"]  = "";
					$comm[$C]["comdele"] = "";
				} else {
					$comm[$C]["comedit"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=MODIFY&num=$num&cnum=".$comm[$C][c_no];
					$comm[$C]["comdele"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=COMDEL&num={$row[c_no]}&$NextUrl";
				}
				}
				if($Board_Admin["use_combest"]==TRUE && $Get_Login==TRUE) {
					$comm[$C]["combest"] = "/bbs/process.php?tbl=$Table&mode=CBEST&num={$row[c_no]}&$NextUrl";
				} else {
					$comm[$C]["combest"] = "";
				}
			}
			$comm_total = count($comm);

		}

		//보기 화면에서 리스트 출력할 경우
		if($Board_Admin["view_list"] == TRUE) {
			// 게시글 목록 코드파일을 불러옵니다.
			include_once("./list.php");
		}//리스트 출력 끝

		// 해당 스킨파일 인클루드
		if($Board_Admin["view_sort"]==TRUE && $Board_Admin["view_list"] == TRUE) include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/list.skin.php");
		include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/view.skin.php");
		if($Board_Admin["view_sort"]==FALSE && $Board_Admin["view_list"] == TRUE) include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/list.skin.php");

	break;



	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////  리스트 화면 출력
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	default :

		// 권한을 체크합니다.
		if($_SESSION["userlevel"]<$Board_Admin["level_list"]) alert("게시글 목록을 열람하실 권한이 없습니다.","/");

		// 게시글 목록 코드파일을 불러옵니다.
		include_once("./list.php");

		// 해당 스킨파일 인클루드
		 include_once($G_board["skin_dir"]."/{$Board_Admin[skin]}/list.skin.php");

		break;
}

// 게시판 풋터부분 추출
if($Board_Admin["foottag"]==TRUE) echo stripslashes($Board_Admin["foottag"]);
if($mobile_flag=="ok") {
	if($shop_flag == "ok") {
		include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.lib.php";
	} else {
		include $_SERVER["DOCUMENT_ROOT"]."/mobile/foot.php";
	}
}else{
	if($Board_Admin["foot"]==TRUE) {
		if($shop_flag != "ok")  include $Board_Admin["foot"];
		else "../foot.lib.php";
	}
}
?>