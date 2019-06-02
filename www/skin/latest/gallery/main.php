<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<? 
	for($i=0; $i<count($list); $i++) { 
	$date = str_replace("-","/",substr($list[$i][b_regist],0,10));
	if($newch[$i]) $newicon = "<img src='images/new_img.gif' width='22' height='11'>";
?>	
				<td width="100">
					<table width="80" border="0" cellpadding="2" cellspacing="1" bgcolor="dcdcdc">
					  <tr>
						<td bgcolor="#FFFFFF"><a href="<?=$list[$i][latesturl]?>"><img src="<?=$list[$i]["img_1"]?>" width="80"  border=0></a></td>
					  </tr>
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0"0>
					  <tr>
						<td width="160" valign="top" style="line-height:18px">
							<a href="<?=$list[$i][latesturl]?>"><b><?=cut_str($list[$i][subject],30)?>
						</td>
					  </tr>
					</table>
				</td>
<? } ?>
<? if(count($list)==0) { ?>
			<tr>
				<td height="20" align=center colspan="2" > 등록된 글이 없습니다.</td>
			</tr>
<? } ?>
  </tr>
</table>