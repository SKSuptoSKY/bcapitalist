<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=<?=$charset?>'>
<script language="JavaScript" type="text/JavaScript">
<!--
function swapObj(id,i)
{
		  for (var i = 0; i < 4; i++)
{
	obj = eval("photo_"+i+".style");
		 obj.display = "none";
}
obj = eval("photo_"+id+".style");
obj.display = "";
}
//-->
</script>
<body leftmargin=0 topmargin=5 onLoad="resizeTo(420,document.body.scrollHeight + 40)">

<table width="390" border="0" cellspacing="0" cellpadding="0" align=center>
	<tr>
	  <td><div align="center">
			<table align="center" width="308" border="0" cellpadding="0" cellspacing="1" bgcolor="#DFDFDF">
				<tr>
					<td align="center">
						<table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#F6F6F6">
							<tr>
								<td bgcolor="#FFFFFF"><img src="<?=$bigimg_0?>"  width="300" height="250" border=0  id="photo_0" style=""><img src="<?=$bigimg_1?>" width="300" height="250" border=0  id="photo_1" style="display:none"><img src="<?=$bigimg_2?>" width="300" height="250" border=0  id="photo_2" style="display:none"><img src="<?=$bigimg_3?>" width="300" height="250" border=0  id="photo_3" style="display:none"></td>
							</tr>
					  </table>
					</td>
				</tr>
			</table>
		    </div></td>
	</tr>
	<tr>
		<td height="8"> </td>
	</tr>
	<tr>
		<td align="center">
			<table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#DFDFDF">
				<tr>
					<td bgcolor="#FFFFFF">
						<table border="0" align="center" cellpadding="0" cellspacing="5">
							<tr>
								<td bgcolor="#FFFFFF"><img src="<?=$bigimg_0?>" width="70" height="58" onClick="swapObj(0); return true;" style="cursor:hand"></td>
								<td bgcolor="#FFFFFF"><img src="<?=$bigimg_1?>" width="70" height="58" onClick="swapObj(1); return true;" style="cursor:hand"></td>
								<td bgcolor="#FFFFFF"><img src="<?=$bigimg_2?>" width="70" height="58" onClick="swapObj(2); return true;" style="cursor:hand"></td>
								<td bgcolor="#FFFFFF"><img src="<?=$bigimg_3?>" width="70" height="58" onClick="swapObj(3); return true;" style="cursor:hand"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="35" align="center" valign="top"><a href='#' onclick='window.close();'><img src="/btn/b_close.gif" border="0"></a></td>
	</tr>
</table>
</body>

</html>