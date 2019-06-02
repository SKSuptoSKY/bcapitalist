<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/download_function.php";
##### 이미지 파일도 열리지 않고 다운로드 가능하게 함
$filename = $_GET[filename];			//		파일명 변환시킨 ftp상 존재하는 실제 파일이름
$filename2 = $_GET[filename2];		//		파일명 변환되기전 원본파일이름
$save_dir = $_GET[fileurl]; 
$filedir = $_SERVER["DOCUMENT_ROOT"].$save_dir."/".$filename; 

$result = send_attachment($filename, $filedir);

if($result==false) alert("파일이 존재하지 않습니다.");

?>