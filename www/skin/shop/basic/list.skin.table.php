<!-- ------------------------------------------------------------- [ 기본 - START ] ------------------------------------------------------------- -->
<table width="700" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
				</tr>
					<td width="50%" style="color:#505050; font-size:24px; font-weight:bold; line-height:30px;"><img src="<?=$title_img?>" alt="타이틀이미지"></td>
					<td valign="bottom" align="right" style="font-size:11px; color:#727272; padding-top:15px;">HOME > 쇼핑몰 > <?=$ca_loc?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right">
			<select name="go_orderby" onchange="go_orderby(this.value);">
			<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_id&sort2=desc" <?if ($sort1=="it_id") { ?>selected="selected"<?}?>>신상품순</option>
			<!-- <option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_order&sort2=desc" <?if ($sort1=="it_order") { ?>selected="selected"<?}?>>인기순</option> -->
			<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_pay&sort2=asc" <?if ($sort1=="it_pay" && $sort2=="asc") { ?>selected="selected"<?}?>>낮은가격순</option>
			<option value="<?=$_SERVER[PHP_SELF]?>?ca_id=<?=$ca_id?>&sort1=it_pay&sort2=desc" <?if ($sort1=="it_pay" && $sort2=="desc") { ?>selected="selected"<?}?>>높은가격순</option>
			</select>
		</td>
	</tr>
	<!-- 제품 리스트 -->
	<tr>
		<td style="padding-top:15px;" align="left">
			<!-- 리스트1 -->
			<table cellpadding="0" cellspacing="0">
				<tr>
				<? for($i=0; $i<$list_count; $i++) {
					if ($i%4==0) { echo "</tr><tr>"; }
					if ($i) { $td_style="style='padding-left:35px;'"; }
					else { $td_style="style='padding-left:15px;'"; }
					?>
					<td <?=$td_style?> align="center">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table width="<?=$GnShop[simg_width]+2?>" height="<?=$GnShop[simg_height]+2?>" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
										<tr>
											<td align="center"><a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><?=$list[$i][list_img]?></a></td>
										</tr>
									</table>
								</td>
							</tr>
							<? if ($item_type[$i]) { ?>
							<tr>
								<td align="center" style="padding-top:5px;"><?=$item_type[$i]?></td>
							</tr>
							<? } ?>
							<tr>
								<td align="center" style="padding-top:5px; color:#4c4c4c; font-size:13px; font-weight:bold;">
									<a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><font color="#555555"><?=cut_str($list[$i][it_name],17,"...")?></font></a><?=$list[$i][max_text]?><?=($list[$i][it_stock] == 0)?"<span style=\"color:#ff0000;\"> [품 절]</span>":"";?>
								</td>
							</tr>
							<tr>
								<td style="color:#a20d1a; font-size:11px;" align="center">[<?=number_format($list[$i][it_pay])?>원]</td>
							</tr>
						</table>
					</td>
					<? } ?>
				</tr>
			</table>
			<!-- //리스트1 -->
		</td>
	</tr>
	<? if (!$total_count) { ?>
	<tr>
		<td height="100" align="center" colspan="20">검색된 상품이 없습니다.</td>
	</tr>
	<? } ?>
	<tr>
		<td align="center" style="color:#282828; padding-top:5px;">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td><?=get_paging($rows, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- //제품 리스트 -->
</table>


<script type="text/javascript">
function go_orderby(value) {
	window.location.href=value;
}
</script>