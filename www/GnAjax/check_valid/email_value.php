<?
/*
|--------------------------------------------------------------------------
|	이메일 정규식 체크 - Start
|--------------------------------------------------------------------------
|
|	넘어온 이메일값을 정규식을 사용하여 이메일 형식을 검사
|	true, false 를 반환한다.	
|
|	인자로 넘어오는 $email 변수를 $_REQUEST로 처리하였기때문에 
|	(ajax가 아닌 다른곳에서도 이 페이지를 호출하여 사용하기 위함)
|
|	2015 - MJ
|
*/
$email = $_REQUEST["email"];		

if (preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i',$email) ) {
	echo "true";
} else {
	echo "false";
}
?>