<div style="float:left; width:100%; ">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="50%" style="color:#505050; font-size:24px; font-weight:bold; line-height:30px;"><img src="<?=$title_img?>" alt="타이틀이미지"></td>
			<td width="50%" valign="bottom" align="right" style="font-size:11px; color:#727272; padding-top:15px;">HOME > 쇼핑몰 > <?=$ca_loc?></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="padding-top:10px; padding-bottom:20px;">
				<select name="go_orderby" onchange="go_orderby(this.value);">
					<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_id&sort2=desc" <?if ($sort1=="it_id") { ?>selected="selected"<?}?>>신상품순</option>
					<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_order&sort2=desc" <?if ($sort1=="it_order") { ?>selected="selected"<?}?>>인기순</option>
					<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_pay&sort2=asc" <?if ($sort1=="it_pay" && $sort2=="asc") { ?>selected="selected"<?}?>>낮은가격순</option>
					<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_pay&sort2=desc" <?if ($sort1=="it_pay" && $sort2=="desc") { ?>selected="selected"<?}?>>높은가격순</option>
				</select>
			</td>
		</tr>
	</table>
</div>
<div style="float:left; width:100%;">
	<ul>
		<? 
		################## [ CSS 기본설정 - START ] ##################
		$list_row_max_count = "4";	// 리스트 한줄이 보여지는 갯수 (스타일만적용됨)
		$list_left_padding = "30";		// 리스트간 왼쪽여백
		$list_row_padding = "50";		// 리스트간 세로여백
		##################   [ 기본설정 - END ]  ##################

		for($i=0; $i<$list_count; $i++) { 
			if($i%$list_row_max_count != "0") {
				$padding_left = $list_left_padding;
			} else {
				$padding_left = "0";
			}
		?>
		<li style="float:left; text-align:center; padding-left:<?=$padding_left?>px; padding-bottom:<?=$list_row_padding?>px;">
			<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
				<tr>
					<td align="center" valign="middle" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;"><a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><?=$list[$i][list_img]?></a></td>
				</tr>
				<tr>
					<td align="center" valign="middle">
						<a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><font color="#555555"><?=cut_str($list[$i][it_name],17,"...")?></font></a><?=$list[$i][max_text]?><?=($list[$i][it_stock] == 0)?"<span style=\"color:#ff0000;\"> [품 절]</span>":"";?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" style="color:#a20d1a; font-size:11px;"><?=number_format($list[$i][it_pay])?>원</td>
				</tr>
			</table>
		</li>
		<? } ?>
	</ul>
</div>


<div class="paginate mt40">
	<ul>
		<?=custom_paging("10", $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?>
	</ul>
</div>

<script type="text/javascript">
function go_orderby(value) {
	window.location.href=value;
}
</script>
