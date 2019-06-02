<table width=100% cellpadding=0 cellspacing=0 border=0 valign=top>
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
    <td width="<?=$td_width?>%" align=center valign=top>
        <table width=98% cellpadding=1 cellspacing=5 border=0 valign=top>
        <tr><td height=5></td></tr>
        <tr><td align=center><?=$href?><?=img_resize_tag("/shop/data/item/".$row[it_id]."_m", $img_width, $img_height)?></a></td></tr>
        <!-- <tr><td align=center style=padding-top:5><?=$href?><?=stripslashes($row[it_name])?></a></td></tr> -->
        <!--시중가격<tr><td align=center><strike><?=display_amount($row[it_cust_amount])?></strike></td></tr>-->
        <!-- <tr><td align=center><span class=amount><font color=#ff6600><?=display_amount($row[it_pay], $row[it_tel_inq])?></font></span></td></tr> -->
		<!-- <tr><td align=center><span class=amount><?=$row[br_name];?></span></td></tr> -->

        </table></td>
<?
}

// 나머지 td 를 채운다.
if (($cnt = $i%$list_mod) != 0)
    for ($k=$cnt; $k<$list_mod; $k++)
        echo "    <td>&nbsp;</td>\n";
?>
</tr>
</table>
