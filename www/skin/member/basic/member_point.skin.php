<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
?>
<table width="763" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td valign="top"><table width="743" border="0" align="center" cellpadding="2" cellspacing="1">
        <tr>
          <td height="30" colspan="3"><strong><?=$name?></strong>님의 현재 적립금 : <strong><font color="#FF6600"><?=$point?>포인트</font></strong></td>
        </tr>
        <tr align="center">
          <td width="100" height="25" bgcolor="F1ECE7"><strong><font color="694C41">날짜</font></strong></td>
          <td width="" bgcolor="F1ECE7"><strong><font color="694C41">내역</font></strong></td>
          <td width="80" bgcolor="F1ECE7"><strong><font color="694C41">적립금</font></strong></td>
        </tr>
        <tr>
          <td height="1" colspan="3" bgcolor="DACEC0"></td>
        </tr>
	<? for($i=0; $i<count($list); $i++) { ?>
        <tr>
          <td align="center"><?=$list[$i]["date"]?></td>
          <td align="left"><?=$list[$i]["memo"]?></td>
          <td align="right" style="padding-right:10px"><?=$list[$i]["cash"]?></td>
        </tr>
	<? } ?>
	<? if($i==0) {?>
		<tr>
			<td height=80 align=center colspan=20> 등록된 내용이 없습니다.</td>
		</tr>
	<? } ?>
        <tr>
          <td height="1" colspan="3" bgcolor="DDDDDD"></td>
        </tr>
        <tr>
          <td height="25" colspan="3"> <div align="center"><?=$pageList?></div></td>
        </tr>
      </table></td>
   </tr>
</table>
<?
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>