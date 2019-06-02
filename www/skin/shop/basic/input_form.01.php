<script language='javascript' src='/admin/lib/javascript.js'></script>
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 17px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#7EABD2;}
input.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
select.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
textarea.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
img { border:0; }
</style>
<table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><!-- 시작--><table width="680" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="E2E2E2">
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[0]" value="규격 가로">
			  <input type="hidden" name="u_subject[1]" value="규격 세로">
                <td width="113"><div align="center"><strong>* 규격</strong></div></td>
                <td width="544">가로: <input class="text" type="text" name="u_opt0" value="<?=$input["u_opt0"]?>" size="5">cm 세로: <input class="text" type="text" name="u_opt1" value="<?=$input["u_opt1"]?>" size="5">cm *가로, 세로가 바뀌지 않도록 유의하세요.</td>
              </tr>
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[2]" value="수량">
                <td><div align="center"><strong>* 수량</strong></div></td>
                <td><input class="text" type="text" name="u_opt2" value="<?=$input["u_opt2"]?>" size="5">개</td>
              </tr>
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[3]" value="마감처리">
                <td><div align="center"><strong>* 마감처리</strong></div></td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="/images/view_banner_icon1.gif" width="48" height="48"></td>
                      <td><img src="/images/view_banner_icon2.gif" width="48" height="48"></td>
                      <td><img src="/images/view_banner_icon3.gif" width="48" height="48"></td>
                      <td><img src="/images/view_banner_icon4.gif" width="48" height="48"></td>
                    </tr>
                    <tr>
                      <td><input type="radio" name="u_opt3" value="깨끗하게 재단"> 깨끗하게 재단</td>
                      <td><input type="radio" name="u_opt3" value="사방타공"> 사방타공</td>
                      <td><input type="radio" name="u_opt3" value="큐방"> 큐방</td>
                      <td><input type="radio" name="u_opt3" value="봉미싱"> 봉미싱</td>
                    </tr>
                    <tr>
                      <td><img src="/images/view_banner_icon5.gif" width="48" height="48"></td>
                      <td><img src="/images/view_banner_icon6.gif" width="48" height="48"></td>
                      <td colspan="2"><img src="/images/view_banner_icon7.gif" width="48" height="48"></td>
                    </tr>
                    <tr>
                      <td><input type="radio" name="u_opt3" value="끈고리"> 끈고리</td>
                      <td><input type="radio" name="u_opt3" value="줄미싱"> 줄미싱</td>
                      <td colspan="2"><input type="radio" name="u_opt3" value="각목+끈"> 각목+끈(별도구매:2,000원)</td>
                    </tr>
                  </table></td>
              </tr>
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[4]" value="시안확인선택">
                <td><div align="center"><strong>* 시안확인선택</strong><br>
                    <strong>(필수항목)</strong></div></td>
                <td><input type="radio" name="u_opt4" value="시안올려주십시요"> 시안올려주십시요. (시안을 제작하여 시안확인 게시판에 올려드립니다.)<br>
                  <input type="radio" name="u_opt4" value="바로 제작해 주십시요"> 바로 제작해 주십시요. (시안확인 없이 바로 작업해 드립니다.)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[5]" value="원고">
                <td><div align="center"><strong>* 원고</strong></div></td>
                <td><TEXTAREA class="text" name="u_opt5" rows=5 wrap=VIRTUAL style="width:100%;">소제목:
대제목:
기타(일시.장소 등): </TEXTAREA></td>
              </tr>
              <tr bgcolor="#FFFFFF">
			  <input type="hidden" name="u_subject[6]" value="첨부파일1">
			  <input type="hidden" name="u_subject[7]" value="첨부파일2">
			  <input type="hidden" name="u_subject[8]" value="첨부파일3">
			  <input type="hidden" name="u_subject[9]" value="첨부파일4">
			  <input type="hidden" name="u_subject[10]" value="첨부파일5">
                <td><div align="center"><strong>* 파일첨부</strong></div></td>
                <td>주의: 대용량(2M이상) 파일은 웹하드를 이용해주세요.<br>
                    <input class="text" type="file" name="u_opt6"><br>
                    <input class="text" type="file" name="u_opt7"><br>
                    <input class="text" type="file" name="u_opt8"><br>
					<input class="text" type="file" name="u_opt9"><br>
                    <input class="text" type="file" name="u_opt10">
				</td>
              </tr>
            </table><!-- 끝--></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
