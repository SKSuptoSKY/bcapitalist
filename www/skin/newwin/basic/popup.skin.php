<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$subject?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
</head>
<body leftmargin="0" topmargin="0">
<div id="div_notice_<?=$id?>" style="display:block">
<table  width="<?=$width?>" height="<?=$height?>" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
	  <td height=105 background="<?=$skindir?>/images/newpop_img.jpg"></td>
	</tr>
	<tr> 
	  <td valign=top>
	  <table width="96%"  height="<?=$height-104?>" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr> 
			<td width="0%" height=15><img src="<?=$skindir?>/images/pop_design_mo1.jpg" width="15" height="15"></td>
			<td width="98%" height="15" background="<?=$skindir?>/images/pop_design_top.jpg"></td>
			<td width="0%"><img src="<?=$skindir?>/images/pop_design_mo2.jpg" width="15" height="15"></td>
		  </tr>
		  <tr> 
			<td width="15" valign="top" background="<?=$skindir?>/images/pop_design_left.jpg"></td>
			<td bgcolor="F2F2F2"> <?=$st = str_replace("\"","'",$content); ?></td>
			<td width="15" valign="top" background="<?=$skindir?>/images/pop_design_right.jpg"></td>
		  </tr>
		  <tr> 
			<td height=15><img src="<?=$skindir?>/images/pop_design_mo4.jpg" width="15" height="15"></td>
			<td height="15" background="<?=$skindir?>/images/pop_design_down.jpg"></td>
			<td><img src="<?=$skindir?>/images/pop_design_mo3.jpg" width="15" height="15"></td>
		  </tr>
		</table></td>
	</tr>
	<tr> 
	  <td height=19><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td><div align="right"><a href="#"><img src="<?=$skindir?>/images/pop_design_x.jpg" width="149" height="19" border="0" onclick="div_close_<?=$id?>();"></a></div></td>
		  </tr>
		</table></td>
	</tr>
  </table>
</div>
</body>
</html>
