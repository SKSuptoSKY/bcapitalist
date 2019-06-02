<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<div id="help1" class="search_help_zip">
  * 검색방법 : 도로명(~로,~길)+건물번호<br>
  - 서울시 송파구 <b>잠실로 51-33</b> 예) '<b>잠실로</b>(도로명) <b>51-33</b>(건물번호)'<br>
  - 서울시 강동구 <b>양재대로 112길 57</b> 예) '<b>양재대로 112길</b>(도로명) <b>57</b>(건물번호)'<br>
  - 업데이트 일자 : <span id="update"></span>
</div>
<div id="help2" class="search_help_zip">
  * 검색방법 : 동(읍/면/리)+지번<br>
  - 서울시 송파구 <b>잠실동 27-12</b> 예) '<b>잠실동</b>(동명) <b>27-12</b>(지번)'<br>
  - 서울시 강동구 <b>길동 403</b>예) '<b>길동</b>(동명) <b>403</b>(지번)'<br>
  - 업데이트 일자 : <span id="update1"></span>
</div>
<div class="search_area_zip">
    <select name='type1' id='type1' onchange="keyhelp(this.value)">
        <option value=''>도로명+건물번호</option>
        <option value='dong'<?=$type=="dong"?" selected='selected'":""?>>동(읍/면/리)명+지번</option>
    </select>
    <input type="text" name="addr1" id="addr1" class="text required minlength=2" title="검색어" value="<?php echo $addr1?>" />
    <input type="button" id="search_btn" class="search_btn" value="검색" style="cursor:pointer;">
</div>
<div id="zipContent"></div>
<div class="pop_tailer">
  <a href="#" class="btn_close" onclick="window.close();" title="창닫기">창닫기</a>
</div>
<script type="text/javascript">
function keyhelp(inx)
{
  if (inx == "dong") {
    document.getElementById('help1').style.display = "none";
    document.getElementById('help2').style.display = "block";
  } else {
    document.getElementById('help1').style.display = "block";
    document.getElementById('help2').style.display = "none";
  }
}

keyhelp('<?=$type?>');
</script>
<script type="text/javascript">
//<![CDATA[
function find_zip(zip1, zip2, addr1, addr2)
{
    var of = opener.document.<?=$frm_name?>;
    of.<?=$frm_zip1?>.value  = zip1+"-"+zip2;
    of.<?=$frm_addr1?>.value = addr1;
    of.<?=$frm_addr2?>.value = addr2;
    window.close();
    return false;
}
//]]>
</script>