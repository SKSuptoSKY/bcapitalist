<?
##-------------------------------------------------------------------##
##  ���α׷��� : gmEditor v1.2
##-------------------------------------------------------------------##
##  ���� ���� �Ϸ��� : 2006-01-05
##  ���߻� �� ���۱��� : PHP����
##  ������Ʈ : http://www.phpmonster.co.kr
##  �� �� �� : �ڿ��� (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           ī�Ƕ���Ʈ
##-------------------------------------------------------------------##
##  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
##  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
##  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
##  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           ����ȯ��
##-------------------------------------------------------------------##
##  Browser: �ͽ��÷η�, ���̾�����, �׽�������
##  Server : PHP�� �����Ǵ� ��� ����
##-------------------------------------------------------------------##

// �̹����� ����Ǵ� ���
$dir = $_SERVER[DOCUMENT_ROOT]."/editor/upload";
$tmp_dir2 = "/editor/upload/img";

/***************************************************************************************
*************************   ���� ����
****************************************************************************************/
if(is_uploaded_file($_FILES['imgfile']['tmp_name']) && ($_FILES['imgfile']['size'] > 0)) {
	$ext = substr($_FILES['imgfile']['name'],strrpos(stripslashes($_FILES['imgfile']['name']),'.')+1);
	$upfile = time().'.'.$ext;
	// �̹���, �̵�� ����
	$tmp_dir = $dir.'/img';
	
	if(!is_dir($tmp_dir)){
		@mkdir($tmp_dir,0707);
		@chmod($tmp_dir,0707);
	} // end if
	// �̹����̸�..

			//2017-05-15 kisa ��û���� �߰�
			function file_type($file_name)
			{
					$arr_name = explode(".",$file_name);
					$ext = strtolower($arr_name[sizeof($arr_name)-1]);
					return $ext;
			}

			$ext = file_type($_FILES['imgfile']["name"]);
			if(!strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {
			}else{
				ECHO "<script>alert('�������� ������ �ƴմϴ�.')</script>";
				exit;
			}
			//2017-05-15 kisa ��û���� �߰�

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
*************************   ������ �����Ϳ� ����
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