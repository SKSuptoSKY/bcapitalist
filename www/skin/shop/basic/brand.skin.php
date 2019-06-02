<table width="155" border="0" cellspacing="0" cellpadding="0">
<?
for ($i=0; $i < count($brand); $i++) {
    if (file_exists($brand[$i][imgurl])) 
    {
        $size = getimagesize($brand[$i][imgurl]);
		$view_size = "width='$size[0]' height='$size[1]'";

		if($brand[$i][link]=="#") $target = ""; else $target = "target='_blank'";
?>
                                      <tr> 
                                        <td valign="top"><table width="154" border="0" cellpadding="1" cellspacing="1" bgcolor="D1D1D1">
                                            <tr> 
                                              <td bgcolor="#FFFFFF"><a href="<?=$brand[$i][link]?>" <?=$target?>><img src="<?=$brand[$i][img]?>" width="152" height="38" border=0></a></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="5"></td>
                                      </tr>
<?
    }
}
?>
</table>