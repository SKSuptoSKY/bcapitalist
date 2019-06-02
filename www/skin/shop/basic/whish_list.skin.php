<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
-->
</style>
<script language="JavaScript">
<!--
function out_cd_check(fld, out_cd,ct_qty,it_opt1,it_opt_use,it_opt_use2,wi_packing_pay)
{
	document.fwishlist.ct_qty.value=ct_qty;
	document.fwishlist.it_opt1.value=it_opt1;
	document.fwishlist.it_opt_use.value=it_opt_use;
	document.fwishlist.it_opt_use2.value=it_opt_use2;
	document.fwishlist.wi_packing_pay.value=wi_packing_pay;

	if (out_cd == 'tel_inq'){
		alert("이 상품은 전화로 문의해 주십시오.\n\n장바구니에 담아 구입하실 수 없습니다.");
		fld.checked = false;
		return;
	}
}

function fwishlist_check(f, act)
{
	var k = 0;
	var length = f.elements.length;

	for(i=0; i<length; i++) {
		if (f.elements[i].checked) {
			k++;
		}
	}

	if(k == 0)
	{
		alert("상품을 하나 이상 체크 하십시오");
		return;
	}

	if (act == "direct_buy")
	{
		f.sw_direct.value = 1;
	}
	else
	{
		f.sw_direct.value = 0;
	}

	f.action="/shop/shopbag_update.php";

	f.submit();
}
//-->
</script>
<table width="810" border="0" cellspacing="0" cellpadding="0">

   <tr>
     <td align="center">
	 <table width="810"align="center" border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td>
						<form name="fwishlist" method="post">
						<input type=hidden name="sw_direct" value=''>
						<input type=hidden name="wish_flag" value='ok'>
						<input type=hidden   name="ct_qty"    value="">
						<input type=hidden   name="it_opt1"    value="">
						<input type=hidden   name="it_opt_use"    value="">
						<input type=hidden   name="it_opt_use2"   value="">
						<input type=hidden   name="wi_packing_pay"   value="">

						<table width="100%" align="center" cellpadding="4" cellspacing="1">
							<col width="180" />
							<col width="*" />
							<col width="200" />
							<col width="100" />
							<col width="50" />
							<tr>
								<td height="2" colspan="5" bgcolor="#dddddd"> </td>
							</tr>
							<tr bgcolor="#F9F9F9">
								<td align="center">이미지</td>
								<td align="center">상품명</td>
								<td align="center">보관일시</td>
								<td align="center">상품체크</td>
								<td align="center">삭제</td>
							</tr>
							<tr>
								<td height="1" colspan="5" bgcolor="#EFEFEF"> </td>
							</tr>
							<?
							$sql = " select a.*, b.* from {$GnTable[shopwish]} a, {$GnTable[shopitem]} b where a.mb_id = '$_SESSION[userid]' and a.it_id  = b.it_id order by a.wi_id desc ";
							$result = sql_query($sql);
							for ($i=0; $row = mysql_fetch_array($result); $i++)
							{

								// 이미지 ------------------------------------------------------------------------------------
								$it_file_array = get_it_file_size_array( $row[it_id], "1" );
								$row["list_img_src"] = $GnShop["data_url"]."/".$row[it_id]."/".$it_file_array[s];
								$image = "<img src='".$row["list_img_src"]."' border='0' width='150'>";
								// ----------------------------------------------------------------------------------------------

								$out_cd = "";
								for($k=1; $k<=6; $k++){
									$opt = trim($row["it_opt{$k}"]);
									if(preg_match("/\n/", $opt)||preg_match("/;/" , $opt)) {
										$out_cd = "no";
										break;
									}
								}

								if ($row[it_tel_inq]) $out_cd = "tel_inq";

								if ($i > 0) echo "<tr><td colspan=5 height=1></td></tr>";
								$s_del = "<a href='./wish_update.php?mode=D&wi_id=$row[wi_id]'><img src='/btn/icon_x.gif' border='0' align=absmiddle alt='삭제'></a>";

								?>
								<tr>
									<td align="center" style="padding-top:5px;"><?=$image?></td>
									<td align="center" style="padding-top:5px;"><a href='./item.php?it_id=<?=$row[it_id]?>&ca_id=<?=$row[ca_id]?>'><?=stripslashes($row[it_name])?></a></td>
									<td align="center" style="padding-top:5px;"><?=$row[wi_time]?></td>
									<td align="center" style="padding-top:5px;">
										<input type="radio" name="it_id"  value="<?=$row[it_id]?>" onclick="out_cd_check(this, '<?=$out_cd?>','<?=$row[ct_qty]?>','<?=$row[it_opt1]?>','<?=$row[it_opt_use]?>','<?=$row[it_opt_use2]?>','<?=$row[wi_packing_pay]?>');">
										<input type="hidden" name="it_name" value="<?=$row[it_name]?>">
										<input type="hidden" name="it_pay" value="<?=$row[it_pay]?>">
										<input type="hidden" name="it_point" value="<?=$row[it_point]?>">
									</td>
									<td align="center" style="padding-top:5px;"><?=$s_del?></td>
								</tr>
								<?
							}

							if ($i == 0)
								echo "<tr><td colspan=5 align=center height=30><span class=point>보관함이 비었습니다.</span></td></tr>\n";
							?>
							<tr><td colspan=5 height=1></td></tr>
						</table>
						</form>
					</td>
				</tr>
				<tr>
					<Td>
						<div align=right style="padding-right:20px">
							<input type="hidden" name="itstock" value="$istock">
							<div onclick="javascript:fwishlist_check(document.fwishlist,'');"  style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; cursor:pointer;">장바구니</div>
							<div onclick="javascript:fwishlist_check(document.fwishlist,'direct_buy');"  style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; cursor:pointer;">바로구매</div>
						</div>
					</Td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50" align="center">&nbsp;</td>
	</tr>
</table>
