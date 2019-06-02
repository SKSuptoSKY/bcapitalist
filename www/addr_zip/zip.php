<?php
include_once('./_common.php');

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
    
$g4['title'] = '우편번호 검색 서비스 - Ver 1.0';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $g4['charset']?>" />
<META http-equiv="imagetoolbar" content="no">
<title><?php echo $g4['title']?></title>
<link rel="stylesheet" type="text/css" href="./uzipcss/style.css" charset="UTF-8" media="all" />
<script type="text/javascript" src="./Uzipjs/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="./Uzipjs/UzipJs.js"></script>
</head>
<body>
<div id="pop_title">우편번호 검색</div>
<div id="pop_tab">
    <a href="?mode=p2&frm_name=<?=$frm_name?>&frm_zip1=<?=$frm_zip1?>&frm_zip2=<?=$frm_zip2?>&frm_addr1=<?=$frm_addr1?>&frm_addr2=<?=$frm_addr2?>" class="tab2<?=$mode=="p2"?"_on":""?>"></a>
    <a href="?frm_name=<?=$frm_name?>&frm_zip1=<?=$frm_zip1?>&frm_zip2=<?=$frm_zip2?>&frm_addr1=<?=$frm_addr1?>&frm_addr2=<?=$frm_addr2?>" class="tab1<?=$mode!="p2"?"_on":""?>"></a>
</div>
<input type="hidden" name="mode" id="mode" value="<?php echo $mode?>" />
<div class="pop_content">
<?php
if ($mode == "p2")
  include_once("./Uzipinc/zip_p2.php");
else 
  include_once("./Uzipinc/zip_p1.php");
?>
</div>
<script type="text/javascript">zipLoad(1);</script>
<form name="fzip" method="get">
<input type='hidden' name='frm_name'  value='<?php echo $frm_name?>' />
<input type='hidden' name='frm_zip1'  value='<?php echo $frm_zip1?>' />
<input type='hidden' name='frm_zip2'  value='<?php echo $frm_zip2?>' />
<input type='hidden' name='frm_addr1' value='<?php echo $frm_addr1?>' />
<input type='hidden' name='frm_addr2' value='<?php echo $frm_addr2?>' />
</form>
</body>
</html>
