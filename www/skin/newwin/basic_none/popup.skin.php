<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$subject?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
</head>

<body leftmargin="0" topmargin="0">
<div id="div_notice_<?=$id?>" style="position:absolute; z-index:99999; background-color:#ffffff;">
<table  width="<?=$width?>" height="<?=($height-100)?>" border="0" align="center" cellpadding="0" cellspacing="0">	
	<tr> 
	  <td valign=top>
	  <table width="100%"  height="<?=$height?>" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr> 
			<td align="center" valign="middle"><?=$content?></td>
		  </tr>
		</table></td>
	</tr>
	<tr> 
	  <td height=19><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td><div align="right"><a href="#"><img src="<?=$skindir?>/images/pop_design_x.jpg" width="149" height="19" border="0" onClick="div_close_<?=$id?>();"></a></div></td>
		  </tr>
		</table></td>
	</tr>
  </table>
</div>
</body>
</html>
