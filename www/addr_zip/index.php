<?
include_once("./_common.php");
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<link rel="stylesheet" href="uzipcss/style.css" type="text/css">
<title>우편번호검색 테스트</title>
<script type="text/javascript" src="Uzipjs/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="Uzipjs/UzipJs.js"></script>
</head>
<body topmargin="0" leftmargin="0">
<div id="spbox">
  <div class="samplebx_title">우편번호 검색 샘플</div>
  <div class="samplebx">
      <form name=fmember method=post autocomplete="off">
      <input type=text class=ed name='mb_zip1' size=4 maxlength=3 readonly itemname='우편번호 앞자리' value=''> -
      <input type=text class=ed name='mb_zip2' size=4 maxlength=3 readonly itemname='우편번호 뒷자리' value=''>
      <a href="#" onclick="win_zip('fmember', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');">우편번호검색</a>
      <br><input type=text class=ed name='mb_addr1' size=40 readonly value=''>
      <br><input type=text class=ed name='mb_addr2' size=25 itemname='상세주소' value=''> 상세주소 입력
      </form>
  </div>
</div>
</body>
</html>