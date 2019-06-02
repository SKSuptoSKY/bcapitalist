<?
$fileDir = $DOCUMENT_ROOT."/online/data/".$file; //실제 파일명 또는 경로

//$dnurl = "다운될 파일 이름(경로)" ;
$dnfile = urlencode("$fileDir"); // 파일명이나 경로에 한글이나 공백이 포함될 경우를 고려

$dn = "1"; // 1 이면 다운 0 이면 브라우져가 인식하면 화면에 출력
$dn_yn = ($dn) ? "attachment" : "inline";

$bin_txt = "1"; // 아랫글보구 수정해섭...
$bin_txt = ($bin_txt) ? "r" : "rb"; 

// attachment 면 바로 다운 inline 브라우져가 인식하면 화면에 출력

if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) // 브라우져 구분
{ 
    Header("Content-type: application/octet-stream"); 
    Header("Content-Length: ".filesize("$fileDir"));   // 이부부을 넣어 주어야지 다운로드 진행 상태가 표시 됩니다.
    Header("Content-Disposition: $dn_yn; filename=$file");  
    Header("Content-Transfer-Encoding: binary");  
    Header("Pragma: no-cache");  
    Header("Expires: 0");  
} else { 
    Header("Content-type: file/unknown");     
    // Header("Content-type: application/octet-stream");
    Header("Content-Length: ".filesize("$fileDir")); 
    Header("Content-Disposition: $dn_yn; filename=$file"); 
    Header("Content-Description: PHP3 Generated Data");    
    Header("Pragma: no-cache"); 
    Header("Expires: 0"); 
} 

if (is_file("$fileDir")) 
{ 
    $fp = fopen("$fileDir", "$bin_txt");
        if (!fpassthru($fp))  // 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
        fclose($fp); 
} else {
    echo "해당 파일이나 경로가 존재하지 않습니다.";
} 
?>