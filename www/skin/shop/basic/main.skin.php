		<!-- 라이트 -->
		<table cellpadding="0" cellspacing="0">
		<tr>
		<td style="background:url(/images/shop/shop_title_line.jpg) 0px 45px no-repeat; height:50px;">
			<table cellpadding="0" cellspacing="0">
			<tr>
			<td width="50%"><img src="/images/shop/title1.jpg" title="플러스오일테크 쇼핑몰" /></td>
			<td width="490px" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME<img src="/images/shop/rudgh_arr.jpg" /><span style="font-weight:bold; color:#727272;">E-SHOP</span></td>
			</tr>
			</table>
		</td>
		</tr>

		<tr>
		<td style="padding-top:28px;">
			<table cellpadding="0" cellspacing="0">
			<tr>
			<td><img src="/images/shop/best_title.jpg" title="베스트제품" /></td>
			</tr>
			<tr>
			<td height="25px"></td>
			</tr>
			<tr>
			<td style="background:url(/images/shop/best_pro_bg.jpg) no-repeat; width:717px; height:210px; text-align:center; padding:0px 30px;">
				<table cellpadding="0" cellspacing="0" align="left">
				<tr>
	              <? 
				  for($i=0; $i<count($list_best); $i++) { 
					  if ($i) {
						  $td_style="style='padding-left:25px;'";
					  }
					  else {
						  $td_style="";
				  	  }
				  ?>
				<td align="center" <?=$td_style?>> 
					<table cellpadding="0" cellspacing="0">
					<tr>
					<td>
						<table width="141" height="140" border="2" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
							<tr>
								<td><a href="./item.php?it_id=<?=$list_best[$i][it_id]?>&ca_id=<?=$list_best[$i][ca_id]?>&<?=$qstr?>"><?=$list_best[$i][list_img]?></a></td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td style="padding-top:5px; color:#4c4c4c; font-size:13px; font-weight:bold;"><a href="./item.php?it_id=<?=$list_best[$i][it_id]?>&<?=$qstr?>"><font color="#555555"><?=cut_str($list_best[$i][it_name],17,"...")?></font></a></td>
					</tr>
					<tr>
					<td style="color:#a20d1a; font-size:11px;">[<?=number_format($list_best[$i][it_pay])?>원]</td>
					</tr>
					</table>
				</td>
				<? } ?>

				</tr>
				</table>
			</td>
			</tr>
			</table>
		</td>
		</tr>
		
		<tr>
		<td align="center" style="padding-top:25px;"><?=nl2br($GnShop[main_cont])?></td>
		</tr>

		</table>
		<!-- //라이트 -->