<?
  header("Content-type: application/vnd.ms-excel"); 
  header("Content-Disposition: attachment; filename=order.xls"); 
  header("Expires: 0"); 
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0"); 
  header("Pragma: public"); 


include $_SERVER[DOCUMENT_ROOT]."/admin/lib/lib.php";
include $_SERVER[DOCUMENT_ROOT]."/admin/shop/lib/lib.php";
$ex_sql = stripslashes($ex_sql);
$result = sql_query($ex_sql);

?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
					<td width="7%"><a href='<?=title_sort("od_id", 1)."&$qstr1";?>'>주문번호</a></td>
					<td width="7%"><a href='<?=title_sort("mb_id")."&$qstr1"; ?>'>회원ID</a></td>
					<td width="7%"><a href='<?=title_sort("od_name")."&$qstr1";?>'>주문자</a></td>
					<td><a href='<?=title_sort("itemcount", 1)."&$qstr1";?>'>상품명</a></td>
					<td width="7%">판매가</td>
					<td width="7%">수량</td>
					<td width="7%">소계</td>
					<td width="7%">상태</td>
				</tr>
			<form name=frmorderlist method=post action="./order_update.php">
			<input type=hidden name=mode value="listup">
			<input type=hidden name=sort1 value="<? echo $sort1 ?>">
			<input type=hidden name=sort2 value="<? echo $sort2 ?>">
			<input type=hidden name=page  value="<? echo $page ?>">
			<?for ($i=0; $row=mysql_fetch_array($result); $i++) {
				$it_name = $row[it_name];
				$it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);

				$ct_amount[소계] = $row[ct_amount] * $row[ct_qty];
				$ct_point[소계] = $row[ct_point]      * $row[ct_qty];

				if ($row[ct_status]=='주문' || $row[ct_status]=='준비' || $row[ct_status]=='배송' || $row[ct_status]=='완료')
					$t_ct_amount[정상] += $row[ct_amount] * $row[ct_qty];
				else if ($row[ct_status]=='취소' || $row[ct_status]=='반품' || $row[ct_status]=='품절')
					$t_ct_amount[취소] += $row[ct_amount] * $row[ct_qty] + $od[od_send_cost];

				//$image = get_it_image("$row[it_id]_s", (int)($default[de_simg_width] / $image_rate), (int)($default[de_simg_height] / $image_rate), $row[it_id]);
				$img = "/shop/data/item/".$row["it_id"]."_l1";
				resize2($img, 50, 50);
				$image = "<img src='$img' $width_tag $height_tag>";				
				?>
				<tr align="center" bgcolor="#FFFFFF">
					<td align=center><?=$row[od_id]?></td>
					<td align=center><?=($row[mb_id] == "")?"비회원":$row[mb_id];?></td>
					<td align=center><span title='<?=$od_deposit_name?>'><?=cut_str($row[od_name],8,"")?></span></td>
					<td align=left style="padding:5px;"><?=$it_name?></td>
					<td align=right><FONT COLOR=1275D3><?=number_format($row[ct_amount])?></font></td>
					<td align=right><?=$row[ct_qty]?></td>
					<td align=right><?=number_format($ct_amount[소계])?></td>
					<td align=right><FONT COLOR=1275D3><?=$row[ct_status]?></font></td>
				</tr>
			<?
				$tot_amount += 	$row[ct_amount];
				$tot_qty += 	$row[ct_qty];
				$tot_resumt_amount += 	$ct_amount[소계];
				} ?>
			<? if($i==0) { ?>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
				</tr>
			<? } ?>
			</form>
				<tr align="center"><td colspan="20"></td></tr>
				<tr align="center" bgcolor="#FFFFFF">
					<td colspan="4" align="right">합계 : </td>
					<td align="right"><?=number_format($tot_amount)?></td>
					<td align="right"><?=$tot_qty?></td>
					<td align="right"><?=number_format($tot_resumt_amount)?></td>
					<td >&nbsp;</td>
				</tr>
			</table>