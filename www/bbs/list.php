<?
	/////////////////////// 주소 변수 / 다음페이지 설정
	$NextUrl = "category=$category&findType=$findType&findWord=$findWord&sort1=$sort1&sort2=$sort2&it_id=$it_id&shop_flag=$shop_flag&mobile_flag=$mobile_flag";

	$Search_Where = "where 1 ";
	if(($Table == "shop_review" || $Table == "shop_qna") && $it_id != "")
	{
			$Search_Where .= " and b_ex2 = '".$it_id."'";
	}
	//////////////////////////검색 하고자 하는 단어가 있으면
	if($findType==TRUE) {
		if($findType=="title") $findfile="b_subject";
			else if($findType=="name") $findfile="b_writer";
				else if($findType=="content") $findfile="b_content";

		$findword = urldecode($findWord); // search field (검색 필드)
		$Search_Where .="and $findfile like '%$findword%' ";
		$findword = stripslashes($findword); // search field (검색 필드)
	}
	//////////////////////////검색 하고자 하는 분류가 있으면
	if($category!='') {
		$Search_Where .= "and b_category = '$category' ";
	}

	////////////////////// 카테고리 등록 게시판이면
	if($Board_Admin["use_category"] == TRUE) {
		$Category_option = Get_BoardCate($Board_Admin["category"],$category);
	}
	if($Board_Admin[skin] == "basic_violet_alim"){
		if($alim_month) $chk_month = $alim_month;
		else $chk_month = date("m");

		if($alim_year) $chk_year = $alim_year;
		else $chk_year = date("Y");

		$Search_Date_S = date("Y-m-d H:i:s",mktime(0,0,0,$chk_month,1,$chk_year));
		$chk_last_day = date("t",mktime(0,0,0,$chk_month,1,$chk_year));
		$Search_Date_E = date("Y-m-d H:i:s",mktime(23,59,59,$chk_month,$chk_last_day,$chk_year));

		$Search_Where .= " and b_regist BETWEEN '".$Search_Date_S."' AND '".$Search_Date_E."' ";
	}

// 테이블의 전체 레코드수만 얻음
	$BoardSql = " select count(*) as cnt from $BB_table $Search_Where";
	$row = sql_fetch($BoardSql,FALSE);
	$total_count = $row[cnt];

	$rows = $Board_Admin["page_rows"];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	if (!$sort1)
	{
		$sort1  = "b_regist";
		$sort2 = "desc";
	}
	$List_Order .= ", $sort1 $sort2";

	// 페이지별 시작번호
	$cur_num=$total_count - ($Board_Admin["page_rows"]*($page-1));


	// 게시물 리스트를 불러옵니다.
	if($Table == "shop_review"){
		$BoardSql = " select a.*, count(b.c_no) as comment , i.it_name, i.it_id from $BB_table a left join  $BC_table b on (a.b_no = b.c_bno) left join Gn_Shop_Item  i on (a.b_ex2 = i.it_id) $Search_Where group by b_no $List_Order limit $from_record, $rows";
		$BoardResult = sql_query($BoardSql,FALSE);
	}else{
		$BoardSql = " select a.* from $BB_table a $Search_Where group by b_no $List_Order limit $from_record, $rows";
		$BoardResult = sql_query($BoardSql,FALSE);
	}

	// 게시물 리스트를 불러옵니다.
	//$BoardSql = " select a.*, count(b.c_no) as comment from $BB_table a left join $BC_table b on (a.b_no = b.c_bno) $Search_Where group by b_no $List_Order limit $from_record, $rows";
	//$BoardResult = sql_query($BoardSql,FALSE);
	for($B=0; $row=sql_fetch_array($BoardResult,FALSE); $B++) {
		$list[$B] = $row;

		if($Table == "shop_review"){
			$img="/shop/data/item/{$row[it_id]}_s";
			$list[$B]["it_img"]=img_resize_tag($img,64,66,"' border='0'");
		}
		if($shop_flag == "ok"){ // 상품상세 내에 리뷰게시판이라면
			// 링크 변수를 설정합니다.
			if($_SESSION["userlevel"] >= $Board_Admin["level_write"]) {
				if($Get_Login==TRUE && ($_SESSION["userid"]==$list[$B]["b_member"] || $_SESSION["userlevel"]==100)) {
					$list[$B]["modify"] = "/bbs/board.php?tbl=$Table&mode=MODIFY&num=$row[b_no]&$NextUrl";
					$list[$B]["delete"] = "/bbs/process.php?tbl=$Table&mode=DELETE&num=$row[b_no]&$NextUrl";
					$list[$B]["delete_flag"] = "ok";
				} else {
					$list[$B]["modify"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=MODIFY&num=$row[b_no]&$NextUrl";
					$list[$B]["delete"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=DELETE&row[b_no]=$num&$NextUrl";
					$list[$B]["delete_flag"] = "no";
				}
			} else {
				$Url["modify"] = "";
				$Url["delete"] = "";
			}
		}
		// 게시글 강제번호
		$list[$B]["no"] = $cur_num - $B;

		$list[$B]["subject"] =stripslashes(str_replace('&amp;','&',htmlspecialchars($row["b_subject"])));
		//$list[$B]["content"] = nl2br(stripslashes(str_replace('&amp;','&',htmlspecialchars($row["b_content"]))));	// 기존소스 주석처리 201504
		if($list[$B]["b_html"]==TRUE) {
			$list[$B]["content"] = nl2br(stripslashes(str_replace('&amp;','&',$row["b_content"])));
		} else {
			$list[$B]["content"] = strip_tags($row["b_content"]);
		}
		$list[$B]["hit"] = number_format($row["b_hit"]);
		$list[$B]["best"] = number_format($row["b_best"]);

			$c_result= sql_fetch("Select count(c_no) as comment from $BC_table where c_bno = '{$row[b_no]}' order by c_regist desc");
			$list[$B]["comment"] = $c_result[comment];
			if($list[$B]["comment"] > 0) { $list[$B]["comment"] = "(".number_format($list[$B]["comment"]).")"; } else { $list[$B]["comment"] = "";}
		// 카테고리 등록 게시판이면
		if($Board_Admin["use_category"] == "1") {
			if($row["b_category"]==FALSE) $list[$B]["b_category"] = "전체";
		}

			## 비밀글이면 제목에 아이콘 추가
			if($row["b_secret"]==TRUE) {
					$sbutton = $G_board["skin_dir"]."/{$Board_Admin[skin]}/images/btn_secret.gif";
					if (file_exists($sbutton)) {
						$list[$B]["secret"] = "<img src='{$Board_Admin[skin_dir]}/images/btn_secret.gif' border=0  align='absmiddle' style='vertical-align:middle;'>";
					} else {
						$list[$B]["secret"] = "[S]";
					}
			}
			## 공지글이면 글번호에 아이콘 추가
			if($row["b_notice"]==TRUE) {
					$sbutton = $G_board["skin_dir"]."/{$Board_Admin[skin]}/images/btn_notice.gif";
					if (file_exists($sbutton)) {
						$list[$B]["num"] = "<img src='{$Board_Admin[skin_dir]}/images/btn_notice.gif' border=0  align='absmiddle'>";
						$list[$B]["no"] = "<img src='{$Board_Admin[skin_dir]}/images/btn_notice.gif' border=0  align='absmiddle'>";
					} else {
						$list[$B]["num"] = "공지";
						$list[$B]["no"] = "공지";
					}
			} else {
						$list[$B]["num"] = $row["b_tno"];
			}
			## 새로 등록된 글이라면, 제목에 아이콘 추가
			$newdate = date("Y-m-d h:i:s",time() - (86400*3));
			if($row["b_regist"] > $newdate)  {
					$sbutton = $G_board["skin_dir"]."/{$Board_Admin[skin]}/images/btn_new.gif";
					if (file_exists($sbutton)) {
						$list[$B]["new"] = "<img src='{$Board_Admin[skin_dir]}/images/btn_new.gif' border=0  align='absmiddle' style='vertical-align:middle;'>";
					} else {
						$list[$B]["new"] = "[N]";
					}
			}
			/*새로운 댓글이 등록 됬을때 u 버튼 출력 로직입니다*/
			$c_newdate_chk = null;
			$c_newdate_chk = sql_fetch("Select * from $BC_table where c_bno = '{$row[b_no]}' order by c_regist desc");
			if($c_newdate_chk[c_regist] > $newdate){
				$list[$B]["new"] .= "<img src='/btn/btn_ripple.gif' border='0' align='absmiddle' style='padding-left:3px;vertical-align:middle;'>";
			}
			/*새로운 댓글이 등록 됬을때 u 버튼 출력 로직입니다*/
		// 게시글 제목 설정
			## 답글일 경우 제목 들여쓰기
			$depth="";
			$depth_num="";
			$length=strlen($row["b_dep"]);
			## 답변 아이콘 초기화
			$list[$B]["reicon"] = "";
			if($length !=1) {
				for($k=2;$k<=$length;$k++) {
					//들여쓰기
					$depth_num=$depth_num."&nbsp;&nbsp;";
				}
				$list[$B]["reicon"] = $depth_num."<font color=orange><b>[답변]</b></font>&nbsp;";
			}
			## 제목글 자르기
			if($Board_Admin["listsubject"]>0) {
				$SubCutStr = $Board_Admin["listsubject"] + ($length*3) + 6; // [제목글자수] + ( [들여쓰기횟수] * [들여쓰기공간] ) + [아이콘공간]
				$list[$B]["subject"] = $list[$B]["reicon"].cut_str($list[$B]["subject"],$SubCutStr);
			} else {
				$list[$B]["subject"] = $list[$B]["reicon"].$list[$B]["subject"];
			}

		// 파일 테이블에서 해당하는 파일 정보를 불러옵니다.
		$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '{$row[b_no]}' order by bf_fno asc limit 1";
		$Get_File_result = sql_query($Get_File_sql,FALSE);
		//다운파일이 있으면
		for ($i=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $i++) {
			if($Get_File["bf_save_name"] && $Board_Admin["use_data"]==TRUE) {
				##### 등록파일이 있을경우
					$getsavename = $Get_File["bf_save_name"];
					$getfilename = $Get_File["bf_real_name"];
					
					// 추가 : 게시판리스트에서 첨부파일 다운로드 가능하게 하려면 이 변수사용
					// ex ) 스킨페이지 : for문 안에서 $list_file_down[$i] 등으로 사용
					if($getsavename != "") {
						$getsavename = urlencode($getsavename);
						$list_file_down[$B] = "/admin/lib/download.php?fileurl=/bbs/data/$Table&filename=$getsavename&filename2=$getfilename";
					} else {
						$list_file_down[$B] = "";
					}

					//첨부파일이 이미지인지 검사후 이미지관련코드 실행 (2012_03_06)
					$ext = file_type($getsavename);
					if(!strCmp($ext,"jpeg") || !strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {		
						if ($Board_Admin[sum_flag]=="1" && file_exists($_SERVER[DOCUMENT_ROOT]."/bbs/data/$Table/sum_{$getsavename}")){
							$sum_key="sum_";
						}else {
							$sum_key="";
						}

						$list[$B]["img_".$i] = "/bbs/data/$Table/{$sum_key}{$getsavename}";						
						$size=@GetImageSize($_SERVER["DOCUMENT_ROOT"]."/bbs/data/$Table/".$getsavename);
						//$resize = ($size[0]> $Board_Admin["imgsize"]) ? $Board_Admin["imgsize"] : $size[0];
						if ($Board_Admin[sum_resize]=="1") {
							if(strCmp($ext,"bmp")){
								list($img_width[$B],$img_height[$B])=img_resize_size($size[0],$size[1],$Board_Admin[sum_width],$Board_Admin[sum_height]);
							}else{
								$img_width[$B]=$Board_Admin[sum_width];
								$img_height[$B]=$Board_Admin[sum_height];	
							}
						}
						else {
							$img_width[$B]=$Board_Admin[sum_width];
							$img_height[$B]=$Board_Admin[sum_height];	
						}
					} else if(!strCmp($ext,"mov") || !strCmp($ext,"wmv") || !strCmp($ext,"avi") || !strCmp($ext,"asf") || !strCmp($ext,"asx") || !strCmp($ext,"mpeg") || !strCmp($ext,"mpg")) {
						$list[$B]["img_".$i] = "{$Board_Admin[skin_dir]}/images/media_img.gif";
						$img_width[$B]=$Board_Admin[sum_width];
						$img_height[$B]=$Board_Admin[sum_height];
					} else {
						$list[$B]["img_".$i] = "{$Board_Admin[skin_dir]}/images/no_img.gif";
						$img_width[$B]=$Board_Admin[sum_width];
						$img_height[$B]=$Board_Admin[sum_height];
					}
			}
		}
		
		if($i==1) {
			//첨부이미지가 없을경우 에디터이미지가있으면 대체 (2012_03_06)
			$pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i"; 
			preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["b_content"])), $match);
			$only_img = substr($match['url'],1);
			if(strlen($only_img)>0 and $Board_Admin[skin] != "gallery_ReactiveType") {//2017-03-21 : gallery_ReactiveType : 반응형 갤러리 스킨일땐 제외 kh
				$list[$B]["img_1"]="/".$only_img; // 버그수정 : mj "/" 절대경로 처리 20141107
				$img_width[$B]=$Board_Admin[sum_width];
				$img_height[$B]=$Board_Admin[sum_height];
			}
			else {			
				$no_size=@GetImageSize($_SERVER["DOCUMENT_ROOT"].$Board_Admin["skin_dir"]."/images/no_img.gif");
				list($img_width[$B],$img_height[$B])=img_resize_size($no_size[0],$no_size[1],$Board_Admin[sum_width],$Board_Admin[sum_height]);
				$list[$B]["img_1"]=$Board_Admin["skin_dir"]."/images/no_img.gif";
						$img_width[$B]=$Board_Admin[sum_width];
						$img_height[$B]=$Board_Admin[sum_height];
			}			
		}

		// 글보기 링크 설정
		if($_SESSION["userlevel"] >= $Board_Admin["level_view"]) {
			if($row["b_secret"]==TRUE && $row["b_dep"]=="A") {
				if($Get_Login==TRUE && Member_check($row["b_member"])==TRUE) {
					$list[$B]["viewUrl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl&page=$page";
				} else if($row["b_member"]==FALSE) {
					$list[$B]["viewUrl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl&page=$page";
				} else {
					$list[$B]["viewUrl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
				}
			// 비밀글이며, 답변글일 경우
			} else if($row["b_secret"]==TRUE && strlen($row["b_dep"])>1) {
				// 원본글을 가져옵니다.
				$dep = substr($row["b_dep"],0,strlen($row["b_dep"])-1);
				$BoardSql_old = " select b_no,b_member from $BB_table where b_tno = '{$row[b_tno]}' and b_dep='$dep' ";
				$old = sql_fetch($BoardSql_old);
				// 관리자,원본글작성자,본글작성자가 아닐경우
					if($Get_Login==TRUE && ( Member_check($row["b_member"])==TRUE || $old["b_member"]==$_SESSION["userid"] ) ) {
						$list[$B]["viewUrl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl&page=$page";
					} else if($row["b_member"]==FALSE || $old["b_member"]==FALSE) {
						$list[$B]["viewUrl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl&page=$page";
					} else {
						$list[$B]["viewUrl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
					}
			} else {
				$list[$B]["viewUrl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl&page=$page";
			}
		} else {
			$list[$B]["viewUrl"] ="javascript:alert('게시글 열람 권한이 없습니다.');";
		}

	}
	
	$list_total = count($list);
	if($mode=="VIEW") $PageNext = "mode=$mode&num=$num"; else $PageNext = "";
	$PageLinks = get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=");
?>