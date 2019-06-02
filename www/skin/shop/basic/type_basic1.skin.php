<table width=100% height"100%" cellpadding=0 cellspacing=0 border=0>
<tr>
<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    if ($i > 0 && $i % $list_mod == 0) {
        echo "</tr>\n\n";
        // 가로줄
        //echo "<tr><td colspan=" . ($list_mod + $list_mod - 1) . " background='$cfg[d_url]/$cart_skin/line_h.gif' height=1></td></tr>\n\n";
        echo "<tr>\n";
    }

	// 상품가격적용
	if($row[it_epay]>0) $row[it_pay] = $row[it_epay];

    $href = "<a href='/shop/item.php?it_id=$row[it_id]' class=item>";
	
?>
								<td width="160" align="center">
								  <table width="120" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="120" height="90" align="center"><?=$href?><?=img_resize_tag("/shop/data/item/".$row[it_id]."_s", $img_width, $img_height)?></td>
                                    </tr>
                                    <tr>
                                      <td height="20" align="center"><?=$href?><?=stripslashes(cut_str(($row[it_name]),10))?></a></td>
                                    </tr>
                                    <tr>
                                      <td height="20" align="center"><img src="btn/btn_won.gif" width="10" height="10" /><?=display_amount($row[it_pay], $row[it_tel_inq])?> </td>
                                    </tr>
                                  </table>
								  </td>
								  <? if($i==3){?><?}else{?> <td width="9"><img src="images/main/bar.gif" width="6" height="127" /></td><?}?>
								   
<?
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "    <td>&nbsp;</td>\n";
?>
</tr>
</table>
