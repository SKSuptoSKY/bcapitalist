<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
##### 이미지 파일도 열리지 않고 다운로드 가능하게 함
$filename = $_GET[filename];			//		파일명 변환시킨 ftp상 존재하는 실제 파일이름
$filename2 = $_GET[filename2];		//		파일명 변환되기전 원본파일이름
$save_dir = $_GET[fileurl]; 
$filedir = $_SERVER["DOCUMENT_ROOT"].$save_dir."/".$filename; 

// $filedir2 = $_SERVER["DOCUMENT_ROOT"].$save_dir."/".$filename2; 
/*
if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) // 브라우져 구분
{ 
    Header("Content-type: application/octet-stream"); 
    Header("Content-Length: ".filesize("$fileDir"));   // 이부부을 넣어 주어야지 다운로드 진행 상태가 표시 됩니다.
    Header("Content-Disposition: $dn_yn; filename=$filename2");  
    Header("Content-Transfer-Encoding: binary");  
    Header("Pragma: no-cache");  
    Header("Expires: 0");  
} else { 
    Header("Content-type: file/unknown");     
    // Header("Content-type: application/octet-stream");
    Header("Content-Length: ".filesize("$fileDir")); 
    Header("Content-Disposition: $dn_yn; filename=$filename2"); 
    Header("Content-Description: PHP3 Generated Data");    
    Header("Pragma: no-cache"); 
    Header("Expires: 0"); 
} 

if (is_file("$fileDir")) 
{ 
    $fp = fopen("$fileDir");
        if (!fpassthru($fp))  // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
        fclose($fp); 
} else {
    echo "해당 파일이나 경로가 존재하지 않습니다.";
} 
*/

if (file_exists($filedir)) {
    if(eregi("msie", $_SERVER[HTTP_USER_AGENT]) && eregi("5\.5", $_SERVER[HTTP_USER_AGENT])) {
        header("content-type: doesn/matter");
        header("content-length: ".filesize("$filedir"));
        header("content-disposition: attachment; filename=\"$filename2\"");
        header("content-transfer-encoding: binary");
    } else {
        header("content-type: file/unknown");
        header("content-length: ".filesize("$filedir"));
        header("content-disposition: attachment; filename=\"$filename2\"");
        header("content-description: php generated data");
    }

	session_cache_limiter('none'); 
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false); 
	header("Pragma: no-cache"); 
	flush();

	if (is_file("$filedir")) {
	$fp = fopen("$filedir", "rb");

	// 4.00 대체
	// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
	//if (!fpassthru($fp)) {
	//    fclose($fp);
	//}

	while(!feof($fp)) {
		echo fread($fp, 100*1024);
		flush();
	}
	fclose ($fp);
	flush();
    } else {
        alert("해당 파일이나 경로가 존재하지 않습니다.");
    }

} else {
    alert("파일을 찾을 수 없습니다.");
}

/*
	Header("Content-type: application/x-msdownload"); 
	Header("Content-Disposition: attachment; filename=".$filename.""); 
	Header("Content-Transfer-Encoding: binary"); 
	Header("Pragma: no-cache"); 
	Header("Expires: 0"); 
	*/
/*
$fp = fopen($filedir, "rb"); 
while(!feof($fp)) { 
    echo fread($fp,100*1024); 
    //flush(); 
} 
fclose ($fp); 
flush();
exit;

*/

/*
	$handle    = fopen($filedir, "r"); 
	while(!feof($handle)){ 
			echo fread($handle,4096); 
	}; 
	//fclose ($handle); 
*/


##### 이미지 파일 다운로드_END
?>