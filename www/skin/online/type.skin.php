<table width="643" border="0" cellspacing="0" cellpadding="0" align=left>
  <tr><td height="2" colspan="2" bgcolor=#bbb></td></tr>
  <tr height=28>
    <td width="20%" class="online_tt">작성자</td>
	<td width="80%" class="online_1"><?=$username?></td>
  </tr>
   <tr>
    <td height="1" colspan="2" bgcolor=#dcdcdc></td>
  </tr>
  <tr height=28>
    <td class="online_tt">제목</td>
	<td class="online_1"><?=$subject?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor=#dcdcdc></td>
  </tr>
  <tr height=28>
    <td class="online_tt">이메일</td>
	<td class="online_1"><?=$email?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor=#dcdcdc></td>
  </tr>
  <tr height=28>
    <td class="online_tt">핸드폰번호</td>
	<td class="online_1"><?=$mobile?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor=#dcdcdc></td>
  </tr>
  <tr height=28>
    <td class="online_tt">신청내용</td>
	<td class="online_1"><?=$content?></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor=#dcdcdc></td>
  </tr>
<?if($Upfile_Rename[1]){?>
	<tr height=28>
    <td class="online_tt" style="padding:5px;">첨부파일1</td>
	<td class="online_1" style="padding:5px;"><a href="<?=$site_url?>/admin/online/online_down.php?file=<?=$Upfile_Rename[1]?>"><?=$Upfile_Oname[1]?></a></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#d8d8d8"></td>
  </tr>
<?}?>
<?if($Upfile_Rename[2]){?>
  <tr height=28>
    <td class="online_tt" style="padding:5px;">첨부파일2</td>
	<td class="online_1" style="padding:5px;"><a href="<?=$site_url?>/admin/online/online_down.php?file=<?=$Upfile_Rename[2]?>"><?=$Upfile_Oname[2]?></a></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#d8d8d8"></td>
  </tr>
<?}?>


</table>

<style>
.online_tt{background:#efefef; padding-left:20px; font-size:13px; }
.online_1{height:35px; }
</style>