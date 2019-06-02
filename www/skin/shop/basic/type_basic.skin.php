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

    $href = "<a href='/shop/item.php?it_id=$row[it_id]&ca_id=$ca_id' class=item>";
	
	//아이콘 출력
	$icon = "<br>";
	if($row['it_type1']==TRUE) $icon.= "<img src=\"/shop/img/icon_type1.gif\" border=\"0\"> ";
	if($row['it_type2']==TRUE) $icon.= "<img src=\"/shop/img/icon_type2.gif\" border=\"0\"> ";
	if($row['it_type3']==TRUE) $icon.= "<img src=\"/shop/img/icon_type3.gif\" border=\"0\"> ";
	if($row['it_type4']==TRUE) $icon.= "<img src=\"/shop/img/icon_type4.gif\" border=\"0\"> ";
	if($row['it_type5']==TRUE) $icon.= "<img src=\"/shop/img/icon_type5.gif\" border=\"0\"> ";
?>
    <td width="<?=$td_width?>%" height="<?=$td_height?>" align=center valign=top>
        <table width=90% cellpadding=0 cellspacing=0 border=0>
        <tr><td align=center style="background:url(../../../btn/item_bg.gif) no-repeat center top; padding:5px;"><?=$href?><?=img_resize_tag("/shop/data/item/".$row[it_id]."_l1", 162, 140)?></a></td></tr>
        <tr><td align=center style="padding-top:5;word-break:break-all; text-decoration:underline; font-family:'굴림', '돋움'; font-size:15px; color:#000000; font-weight:bold;"><?=$href?><?=stripslashes(cut_str(($row[it_name]),10))?></a> <?=($row[it_stock] == 0)?"<span style=\"color:#ff0000;\"> [품 절]</span>":"";?></td></tr>
        <tr><td align=center><?=display_amount($row[it_pay])?></td></tr>
        <!--시중가격<tr><td align=center><strike><?=display_amount($row[it_cust_amount])?></strike></td></tr>-->
        <!--tr><td align=center><span class=amount><font color=#ff6600><?=display_amount($row[it_pay], $row[it_tel_inq])?></font></span></td></tr-->
		<tr><td align=center><span style="text-decoration:underline; font-family:'굴림', '돋움'; font-size:15px; color:#000000;"><?=$row[br_name];?></span></td></tr>
		<!--tr><td height=15></td></tr-->
        </table></td><td width=22>&nbsp;</td>
<?
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "    <td>&nbsp;</td>\n";
?>
</tr>
</table>
