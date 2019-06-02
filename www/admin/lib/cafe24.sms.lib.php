<?php
	/*  Gn_SiteConfig 참고하세요 단문전용 입니다. admin/lib/lib.php 필수 경고창 제거 : nointeractive=1 */
	function cafe24_sms_send($msg,$nointeractive="1") {

		global $default;

		$user_id = $default["cafe24_user_id"];
		$secure = $default["cafe24_secure"];
		$sphone = $default["cafe24_sphone"];
		$rphone = $default["cafe24_rphone"];
		$testflag = $default["cafe24_testflag"];
		$returnurl = $default["site_url"];
		$smsType = "S";


		if($msg == ""){
			echo "본문을 입력하세요";
			exit;
		}else{
			$msg = substr($msg,0,80); //무조건 80바이트로 짤리게 함
		}

		/******************** 인증정보 ********************/
		$sms_url = "https://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
		$sms['user_id'] = base64_encode($user_id); //SMS 아이디.
        $sms['secure'] = base64_encode($secure) ;//인증키
        $sms['msg'] = base64_encode(stripslashes($msg));
		if( $smsType == "L"){
              $sms['subject'] =  base64_encode($subject);
        }
		$sms['rphone'] = base64_encode($rphone);
		$sphone = explode("-",$sphone);
		$sphone = array_filter($sphone);
		$sms['sphone1'] = base64_encode($sphone[0]);
        $sms['sphone2'] = base64_encode($sphone[1]);
        $sms['sphone3'] = base64_encode($sphone[2]);
		$sms['rdate'] = base64_encode($rdate);
        $sms['rtime'] = base64_encode($rtime);
        $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.

		$sms['returnurl'] = base64_encode($returnurl);
        $sms['testflag'] = base64_encode($testflag);
        $sms['destination'] = strtr(base64_encode($destination), '+/=', '-,');

        $sms['repeatFlag'] = base64_encode($repeatFlag);
        $sms['repeatNum'] = base64_encode($repeatNum);
        $sms['repeatTime'] = base64_encode($repeatTime);
        $sms['smsType'] = base64_encode($smsType); // LMS일경우 L
        
		$host_info = explode("/", $sms_url);
        $host = $host_info[2];
        $path = $host_info[3]."/".$host_info[4];


		srand((double)microtime()*1000000);
        $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
        //print_r($sms); exit;

		// 헤더 생성
        $header = "POST /".$path ." HTTP/1.0\r\n";
        $header .= "Host: ".$host."\r\n";
        $header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";

		// 본문 생성
        foreach($sms AS $index => $value){
            $data .="--$boundary\r\n";
            $data .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
            $data .= "\r\n".$value."\r\n";
            $data .="--$boundary\r\n";
        }
        $header .= "Content-length: " . strlen($data) . "\r\n\r\n";

		$fp = fsockopen($host, 80);

        if ($fp) {
            fputs($fp, $header.$data);
            $rsp = '';
            while(!feof($fp)) {
                $rsp .= fgets($fp,8192);
            }
            fclose($fp);
            $msg = explode("\r\n\r\n",trim($rsp));
            $rMsg = explode(",", $msg[1]);
            $Result= $rMsg[0]; //발송결과
            $Count= $rMsg[1]; //잔여건수

            //발송결과 알림
            if($Result=="success") {
                $alert = "성공";
                $alert .= " 잔여건수는 ".$Count."건 입니다.";
            }
            else if($Result=="reserved") {
                $alert = "성공적으로 예약되었습니다.";
                $alert .= " 잔여건수는 ".$Count."건 입니다.";
            }
            else if($Result=="3205") {
                $alert = "잘못된 번호형식입니다.";
            }

            else if($Result=="0044") {
                $alert = "스팸문자는발송되지 않습니다.";
            }
			else if($Result=="Test Success!") {
                $alert = "테스트 성공";
            }

            else {
                $alert = "[Error]".$Result;
            }
        }
        else {
            $alert = "Connection Failed";
        }

         if($nointeractive=="1" && ($Result!="success" && $Result!="Test Success!" && $Result!="reserved") ) {
            //echo "<script>alert('".$alert ."')</script>";
			alert2($alert);
        }
        else if($nointeractive!="1") {
           // echo "<script>alert('".$alert ."')</script>";
		   alert2($alert);
        }
	}