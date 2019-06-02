
<?
	$row = mysql_fetch_array($result);
	// 상품가격적용
	if($row[it_epay]>0) $row[it_pay] = $row[it_epay];

    $href = "<a href='/shop/item.php?it_id=$row[it_id]' class=item>";
	
?>
								 
									<table width="90" border="0" cellspacing="0" cellpadding="0">
										<tr>
										 <td width="90" height="70" align="center" valign="middle" bgcolor="8d8d8d"><?=$href?><?=img_resize_tag("/shop/data/item/".$row[it_id]."_s", $img_width, $img_height)?></a></td>
										  </tr>
										  <tr>
											 <td height="20" align="center"><?=$href?><?=stripslashes(cut_str(($row[it_name]),10))?></td>
											</tr>
										   <tr>
										   <td height="20" align="center"><img src="/btn/btn_won.gif" width="10" height="10" /><?=display_amount($row[it_pay], $row[it_tel_inq])?></td>
										   </tr>
										</table>
									
	