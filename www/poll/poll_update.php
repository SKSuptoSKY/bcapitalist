<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	if($poll_parent=="") alert("정상적으로 신청해주세요");

	$PG_table = $GnTable["poll"];
	$JO_table = $GnTable["pollquestion"];
	$SO_table = $GnTable["pollscore"];


	///↓↓↓↓↓↓ 데이터 내용을 정리해줍시다 ↓↓↓↓↓↓↓↓↓↓↓↓↓///
	$poll_username 			= addslashes($poll_username);
	$poll_mobile 			= addslashes($poll_mobile);
	$poll_email 			= addslashes($poll_email);
	$poll_ex1 			= addslashes($poll_ex1);
	$poll_ex2			= addslashes($poll_ex2);
	$poll_ex3 		= addslashes($poll_ex3);
	$poll_ex4 		= addslashes($poll_ex4);
	$poll_ex5 		= addslashes($poll_ex5);
	$poll_score = null;
	if(is_array($poll_question_idx)){
		for($i =0;$i < count($poll_question_idx);$i++){
			if(${'poll_score_'.$poll_question_idx[$i]} > 0){
				if($i == count($poll_question_idx)-1){
					$poll_score .= $poll_question_idx[$i]."|".${'poll_score_'.$poll_question_idx[$i]};
				}else{
					$poll_score .= $poll_question_idx[$i]."|".${'poll_score_'.$poll_question_idx[$i]}."|*1*|";
				}
			}
		}
	}
	if($_SESSION["userid"]){
		$user_id = $_SESSION["userid"];
	}else{
		$user_id = "GUEST";
	}

	// 회원정보를 불러옵니다.

	$sql = " select * from $SO_table where poll_user_id = '{$_SESSION[userid]}' and poll_parent = '{$poll_parent}'";
	$chm = sql_fetch($sql);

	if($chm[poll_user_id]){
		alert("이미 설문 신청 하셨습니다.");
	}
	///↑↑↑↑↑↑ 데이터 내용을 정리해줍시다 ↑↑↑↑↑↑↑↑↑↑↑↑↑///

	$qry =" insert into $SO_table
				set	poll_parent				= '$poll_parent',
						poll_user_id		= '$user_id', 
						poll_score		= '$poll_score', 
						poll_username		= '$poll_username', 
						poll_phone		= '$poll_phone', 
						poll_mobile		= '$poll_mobile', 
						poll_email		= '$poll_email', 
						poll_ex1		= '$poll_ex1', 
						poll_ex2		= '$poll_ex2', 
						poll_ex3		= '$poll_ex3', 
						poll_ex4		= '$poll_ex4', 
						poll_ex5		= '$poll_ex5', 
						poll_modify		= '$datetime',
						poll_regist		= '$datetime'
			";

	sql_query($qry);

	alert("설문조사 신청 완료",$url);

?>