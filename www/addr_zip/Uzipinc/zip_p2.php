<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<div class="search_help_zip">
  * 검색방법 : 동(읍/면/리)명<br>
  - 주소가 <b>광진구 자양2동 ...</b> 일 경우 '<b>자양2</b>또는 <b>자양2동</b>을 입력하십시오.<br>
  - 업데이트 일자 : <span id="update2"></span>
</div>
<div class="search_area_zip">
    <input type='hidden' name='type1' id='type1' value='<?php echo $type?>'>
    <input type="text" class="text1" value="동(읍/면/리)명" readonly />
    <input type="text" name="addr1" id="addr1" class="text required minlength=2" title="검색어" value="<?php echo $addr1?>" />
    <input type="button" class="search_btn"  id="search_btn" value="검색" style="cursor:pointer;">
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
</script>
<script type="text/javascript">
function find_zip(zip1, zip2, addr1, addr2)
{
    var of = opener.document.<?=$frm_name?>;
    of.<?=$frm_zip1?>.value  = zip1+"-"+zip2;
    of.<?=$frm_addr1?>.value = addr1;
    of.<?=$frm_addr2?>.value = addr2;
    window.close();
    return false;
}
</script>