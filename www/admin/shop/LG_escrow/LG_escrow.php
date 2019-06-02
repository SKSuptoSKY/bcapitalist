<?php
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";
Admin_check();

//**************************//
//
// 배송결과 송신 PHP 예제
//
//**************************//


if($GnShop["pg_status"] == "test") 
{
	// 테스트용
	$service_url = "http://pgweb.uplus.co.kr:7085/pg/wmp/mertadmin/jsp/escrow/rcvdlvinfo.jsp"; 
} 
else if($GnShop["pg_status"] == "service") 
{
	// 서비스용
	$service_url = "https://pgweb.uplus.co.kr/pg/wmp/mertadmin/jsp/escrow/rcvdlvinfo.jsp"; 
}

$mid = get_param("mid");							// 상점ID
$oid = get_param("oid");							// 주문번호
$dlvtype = get_param("dlvtype");					// 등록내용구분
$dlvdate = get_param("dlvdate");					// 발송일자
$dlvcompcode = get_param("dlvcompcode");	// 배송회사코드
$dlvno = get_param("dlvno");						// 운송장번호
//echo $dlvworker = get_param("dlvworker");	// 배송자명
$dlvworker = $GnShop["shop_name"];						// 배송자명
//echo $dlvworkertel = get_param("dlvworkertel");		// 배송자전화번호
$dlvworkertel = $GnShop["shop_tel"];						// 배송자전화번호		//	<- 해당항목 관리자연동으로 개발 해야함

$productid = get_param("productid");			// 상품ID
$orderdate = get_param("orderdate");			// 주문일자
$rcvdate = get_param("rcvdate");					// 실수령일자
$rcvname = get_param("rcvname");				// 실수령인명
$rcvrelation = get_param("rcvrelation");			// 관계
$dlvcomp = get_param("dlvcomp");				// 배송회사명

$mertkey = $GnShop["LG_pg_key"];
// 각 상점의 테스트용 상점키와 서비스용 상점키
// 테스트상점관리자와 서비스상점관리자의 계약정보관리에서 조회 가능

$datasize = 1;									// 여러건 전송일대 상점셋팅


	if($dlvtype=="03")
	{
		$hashdata = md5($mid.$oid.$dlvdate.$dlvcompcode.$dlvno.$mertkey);
	}

	$str_url = $service_url."?mid=$mid&oid=$oid&productid=$productid&orderdate=$orderdate&dlvtype=$dlvtype&rcvdate=$rcvdate&rcvname=$rcvname&rcvrelation=$rcvrelation&dlvdate=$dlvdate&dlvcompcode=$dlvcompcode&dlvno=$dlvno&dlvworker=$dlvworker&dlvworkertel=$dlvworkertel&hashdata=$hashdata"; 
	/*

		* windows
		curl 방식
		php 4.3 버전 이상에서 지원
		php.ini 파일 안에 extension=php_curl.dll 를 사용할수 있도록 풀어주어야 한다.

		* LINUX
		1. http://curl.haxx.se/download.html 에서 curl 을 다운 받는다.
		2. curl 설치
		shell>tar -xvzf curl-7.10.3.tar.gz 
		shell>cd curl-7.10.3
		shell>./configure 
		shell>make 
		shell>make instal
		※curl 라이브러리는 /usr/local/lib 나머지 헤더는/usr/local/include/curl 로 들어간다 
		3. PHP설치
		shell>./configure \
		아래 항목 추가
		--with-curl \
		shell>make
		shell>make install

	*/
	$ch = curl_init(); 

	curl_setopt ($ch, CURLOPT_URL, $str_url); 
	curl_setopt ($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
	curl_setopt ($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 

	$fp = curl_exec ($ch);

	if(curl_errno($ch)){
		// 연결실패시 DB 처리 로직 추가
		echo "연결실패";
		$escrow_return_msg = "발송정보 등록페이지 연결실패";
	}else{
		if(trim($fp)=="OK"){
			// 정상처리되었을때 DB 처리
			echo "성공";
			$escrow_return_msg = "발송정보가 성공적으로 등록되었습니다. http://pgweb.dacom.net/에서 현재 발송정보를 조회 가능합니다.";

			// 발송정보 등록여부 업데이트
			$sql = " update $PG_table set LG_escrow = 'Y' where od_id = '$oid' ";
			sql_query($sql);
		}else{
			// 비정상처리 되었을때 DB 처리
			echo "실패";
			$escrow_return_msg = "발송정보 등록 실패 : http://pgweb.dacom.net/에서 현재 배송 진행상태를 확인해주세요.";

			// 발송정보 등록여부 업데이트
			$sql = " update $PG_table set LG_escrow = 'N' where od_id = '$oid' ";
			sql_query($sql);
		}
	}
	curl_close($ch);
	alert_close($escrow_return_msg);

	/*
	*	fopen 방식
	*	php 4.3 버전 이전에서 사용가능
	*/
/*
	$fp = @fopen($str_url,"r");

	if(!$fp)
	{
		// 연결실패시 DB 처리 로직 추가
		echo "연결실패";
	}
	else
	{
		// 해당 페이지 return값 읽기
		while(!feof($fp))
		{
				$res .= fgets($fp,3000);
		}

		if(trim($res) == "OK")
		{
				// 정상처리되었을때 DB 처리
				echo "OK";
		}
		else
		{
				// 비정상처리 되었을때 DB 처리
				echo "비정상처리";
		}
	}
*/

//**********************************
// 아래 있는 그대로 사용하십시요.
//**********************************
function get_param($name)
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS;
	if (!isset($HTTP_POST_VARS[$name]) || $HTTP_POST_VARS[$name] == "") {
		if (!isset($HTTP_GET_VARS[$name]) || $HTTP_GET_VARS[$name] == "") {
			return false;
		} else {
			 return $HTTP_GET_VARS[$name];
		}
	}
	return $HTTP_POST_VARS[$name];
}

?>