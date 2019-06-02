<?
##-------------------------------------------------------------------##
##  프로그램명 : gmEditor v1.2
##-------------------------------------------------------------------##
##  최초 개발 완료일 : 2006-01-05
##  개발사 및 저작권자 : PHP몬스터
##  웹사이트 : http://www.phpmonster.co.kr
##  개 발 자 : 박요한 (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           카피라이트
##-------------------------------------------------------------------##
##  본 프로그램은 무료 프로그램으로 배포됩니다.
##  gmEditor는 GNU General Public License(GPL) 를 따릅니다.
##  보다 자세한 내용은 LICENSE를 참조하십시요.
##  참고: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           개발환경
##-------------------------------------------------------------------##
##  Browser: 익스플로러, 파이어폭스, 네스케이프
##  Server : PHP가 지원되는 모든 서버
##-------------------------------------------------------------------##

// 이미지가 저장되는 경로
$dir = $_SERVER[DOCUMENT_ROOT]."/editor/upload";
$tmp_dir2 = "/editor/upload/img";

/***************************************************************************************
*************************   파일 전송
****************************************************************************************/
if(is_uploaded_file($_FILES['imgfile']['tmp_name']) && ($_FILES['imgfile']['size'] > 0)) {
	$ext = substr($_FILES['imgfile']['name'],strrpos(stripslashes($_FILES['imgfile']['name']),'.')+1);
	$upfile = time().'.'.$ext;
	// 이미지, 미디어 폴더
	$tmp_dir = $dir.'/img';
	
	if(!is_dir($tmp_dir)){
		@mkdir($tmp_dir,0707);
		@chmod($tmp_dir,0707);
	} // end if
	// 이미지이면..

			//2017-05-15 kisa 요청으로 추가
			function file_type($file_name)
			{
					$arr_name = explode(".",$file_name);
					$ext = strtolower($arr_name[sizeof($arr_name)-1]);
					return $ext;
			}

			$ext = file_type($_FILES['imgfile']["name"]);
			if(!strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {
			}else{
				ECHO "<script>alert('정상적인 파일이 아닙니다.')</script>";
				exit;
			}
			//2017-05-15 kisa 요청으로 추가

		$tmp_file = @getimagesize($_FILES['imgfile']['tmp_name'],&$type);
		// (1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp
		if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 3) && ($tmp_file[2] != 6)) {
			ECHO "<script>window.alert(editor_lang[74]);</script>";
			exit;
		}
		//echo $tmp_dir.'/'.$upfile;
	if(!@move_uploaded_file($_FILES['imgfile']['tmp_name'],$tmp_dir.'/'.$upfile)) {
		echo "ddddddd";
		@unlink($tmp_dir.'/'.$upfile);
		ECHO "<script>window.alert(editor_lang[76]);</script>";
		exit;
	}
	@chmod($tmp_dir.'/'.$upfile,0606);
} // end if

/***************************************************************************************
*************************   내용을 에디터에 삽입
****************************************************************************************/
if(is_file($tmp_dir.'/'.$upfile) || !empty($link)){
	$imgsize = (int)$_POST['imgsize'];
	$title = addslashes($_POST['title']);
	$alignment = "center";
	$upfile_ok = $tmp_dir2.'/'.addslashes($upfile);
	$rootdir_url = '/admin/editor/'.$upfile_ok;
} // end if

?>
<script language=javascript>
	//parent.parent.insertIMG('http://image.weaidyou.co.kr/sns/upload/". $file_upload ."');
	parent.opener.parent.insertIMG('<?=$upfile_ok?>');
	//parent.opener.parent.oEditors.getById["caContent"].exec("SE_TOGGLE_FILEUPLOAD_LAYER");
	//window.location="imgupload.asp";
	parent.window.close();
</script>
</BODY>
</HTML>