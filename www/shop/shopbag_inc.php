<form name=frmcartlist method=post>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td height="2" colspan="11" bgcolor="#DBDBDB"> </td>
	</tr>
	<tr>
		<td height="26" width="85" align="center">&nbsp;</font></td>
		<td width=""><b>주문하신 상품</b></td>
		<td width="54" align="center"><b>가격</b></td>
		<td width="95" align="center"><b>수량</b></td>
		<td width="54" align="center"><b>금액</b></td>
    <? if($sitemenu["point_use"]==TRUE) {  ?>
		<td width="54" align="center"><b>적립금</b></td>
	 <? } ?>
    <? if ($s_page == "shopbag.php") {  ?>
		<td width="48" align="center"><b>삭제</b></td>
	<? } else if ($s_page == "myorder_view.php") { ?>
		<td width="48" align="center"><b>상태</b></td>
	 <? } ?>
    </tr>
	<tr>
	  <td height="1" colspan="8" bgcolor="#EFEFEF"> </td>
	</tr>
<?
$tot_point = 0;
$tot_sell_amount = 0;
$option_amount = 0;
$tot_cancel_amount = 0;
$tot_items_qty = 0;

// $s_on_uid 로 현재 장바구니 자료 쿼리
$sql = " select a.*,
                b.it_id,
                b.it_name,
				b.it_pay,
				b.it_epay,
				b.it_cust_amount,
                b.ca_id,
				b.it_basic
           from {$GnTable[shopcart]} a,
                {$GnTable[shopitem]} b
          where a.on_uid = '$s_on_uid'
            and a.it_id  = b.it_id
          order by a.ct_id ";
$result = sql_query($sql);
$tot_list = mysql_num_rows($result);

for ($i=0; $row=mysql_fetch_array($result); $i++) {

    if ($i==0) { // 계속쇼핑
        $continue_ca_id = $row[ca_id];
    }
    if (!$goods)
    {
        //$goods = addslashes($row[it_name]);
        //$goods = get_text($row[it_name]);
        $goods = preg_replace("/\'|\"|\||\,|\&|\;/", "", $row[it_name]);
        $goods_it_id = $row[it_id];
    }
    $goods_count++;

	// it_id, 상품인덱스번호로 사이즈를 요소로하는 이미지네임 배열변수로 가져오기
	$it_file_array = get_it_file_size_array( $row["it_id"], 1 );

    if ($s_page == "shopbag.php" || $s_page == "myorder_view.php") { // 링크를 붙이고
        $a1 = "<a href='./item.php?it_id=$row[it_id]'>";
        $a2 = "</a>";

		$row["s_img_1_src"] = $GnShop["data_url"]."/".$row[it_id]."/".$it_file_array[s];
		$image=img_resize_tag($row["s_img_1_src"],$GnShop[simg_width],$GnShop[simg_width]," id={$row[it_id]}");

    } else { // 붙이지 않고
        $a1 = "";
        $a2 = "";

		$row["s_img_1_src"] = $GnShop["data_url"]."/".$row[it_id]."/".$it_file_array[s];
		$image=img_resize_tag($row["s_img_1_src"],$GnShop[simg_width],$GnShop[simg_width]);
    }

    $it_name = $a1 . stripslashes($row[it_name]) . $a2 . "<br>";
	$it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);


	//가격 옵션이 있을경우
	/*
	$option_str = print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);
	$ex_it_opt1 = explode(";",$row[it_opt1]);
	$ex_it_opt_num = explode("|",$ex_it_opt1[0]);
	$ex_it_opt_qty = explode(",",$ex_it_opt1[1]);
	if(strlen($row[it_opt1])>0){
		for($a=0; $a < count($ex_it_opt_num); $a++){
			$rows = sql_fetch("select * from Gn_Shop_Add_option where itop_no='".$ex_it_opt_num[$a]."'");
			if($rows[itop_amount] * $ex_it_opt_qty[$a] > 100) $option_amount += $rows[itop_amount] * $ex_it_opt_qty[$a];
		}
	}
	$option_amount_arr[$i]=$option_amount;
	$tot_option_amount+=$option_amount;
	$option_amount="";
	*/

	// 이것은 현금영수증 발급을 위한 부분입니다.
	$itcash_name = $row[it_name];
	$tot_items_qty = $tot_items_qty + $row[ct_qty];
	// $it_name .= print_item_options($row[it_id], $row[it_opt1], $row[it_opt2], $row[it_opt3], $row[it_opt4], $row[it_opt5], $row[it_opt6]);

	$it_only_name = stripslashes($row[it_name]);
	$paytype = $default_paytype[$row[ct_paytype]];	// 구매가격 타입을 출력합니다.
 	$point       = $row[ct_point];

	//$row[it_epay] = (($row[it_epay])>0)?$row[it_epay]:(($row[it_pay]>0)?$row[it_pay]:$row[it_epay]);
	//$sell_amount = $row[it_epay] * $row[ct_qty];
	$sell_amount = $row[ct_amount];

	if (!$row[it_epay] && !$row[it_pay]) $it_order_ok="n";

	?>
	<tr height="<?=$GnShop[simg_height]+10?>">
		<td align=center>
			<table width="<?=$GnShop[simg_width]+2?>" height="<?=$GnShop[simg_height]+2?>" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
				<tr>
					<td align="center"><a href="./item.php?it_id=<?=$row[it_id]?>&<?=$qstr?>"><?=$image?></a></td>
				</tr>
			</table>
		</td>
		<td style="word-break:break-all;padding-left:3px;">
			<input type=hidden name='ct_id[<?=$i?>]' value='<?=$row[ct_id]?>'>
			<input type=hidden name='it_id[<?=$i?>]' value='<?=$row[it_id]?>'>
			<input type=hidden name='it_name[<?=$i?>]' value='<?=$row[it_name]?>'>
			<?for($op=1;$op<=6;$op++){?>
			<?
				$op_name = "it_opt".$op;
				$ex_it_opt = explode(";",$row[$op_name]); //옵션 종류
				$ex_it_opt_num = explode("|",$ex_it_opt[0]); //옵션 번호
				$ex_it_opt_qty = explode(",",$ex_it_opt[1]); //옵션수
			?>
			<input type=hidden name='it_opt<?=$op?>' value='<?=$ex_it_opt_num[0]?>'>
			<!-- <input type=hidden name='it_opt<?=$op?>' value='<?=$ex_it_opt_qty[0]?>'> -->
			<?}?>
			<?=$it_name?>
		</td>
		<td align=right>
		<?
			// 할인가가 적용되어있으면 할인가 표시
			if($row[it_epay] > 0) {
				echo number_format($row[it_epay])."원";
			} else {
				echo number_format($row[it_pay])."원";
			}
		?>
        </td>
		<? // 수량, 입력(수량)
		if ($s_page == "shopbag.php") { ?>
		<td align="center">
			<input type=text id="ct_qty_<?=$i?>" name='ct_qty[<?=$i?>]' value='<?=$row[ct_qty]?>' size=4 maxlength=6   style="height:18px; BORDER-RIGHT: #d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid; HEIGHT: 17px; BACKGROUND-COLOR: #ffffff" autocomplete='off'>
			<div  hspace="1" onclick="javascript:form_check('AE')" style="width:35px; height:25px; background:#f8f8f8; color:#111;border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; font-size:12px; cursor:pointer">변경</div>
		</td>
		<? } else { ?>
		<td align="center"><?=$row[ct_qty]?></td>
		<? } ?>
		<!--<td align="center"><?=$paytype?></td>-->
		<td align="center"><?=number_format($sell_amount)?><?//=number_format($sell_amount+$option_amount_arr[$i])?>원</td>
		<? if ($sitemenu["point_use"]==TRUE) {  ?>
		<td align="center"><?=number_format($row[ct_point])?>원</td>
		<? } ?>
		<?
		$tot_point      += $point;
		$tot_sell_amount += $sell_amount;
		?>
		<? if ($s_page == "shopbag.php") { ?>
		<td align="center"><a href='./shopbag_update.php?mode=D&ct_id=<?=$row[ct_id]?>'><div style="width:35px; height:25px; background:#f8f8f8; color:#111; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; font-size:12px;">삭제</div></a></td>
		<? } else if ($s_page == "myorder_view.php") { ?>
		<?
		if ($row[ct_status] == '취소' || $row[ct_status] == '반품' || $row[ct_status] == '품절') {
			$tot_cancel_amount += $sell_amount;
		}
		?>
		<td align="center">
			<?=$row[ct_status]?><br>
			<?
			// 후기 아이콘 출력
			if($row[ct_status] == "배송") {
				echo "<a href='javascript:;' onclick='ct_status_change(\"".$row[ct_id]."\")'><img src='/images/btn_con.jpg'></a>";
				// 원본 else if($row[ct_status] == "완료") echo "<a href='/shop/item.php?it_id=".$row[it_id]."&ca_id=".$row[ca_id]."&review_flag=ok'><img src='/images/btn_hoo.jpg'></a>";
			}else if($row[ct_status] == "완료") {
				// 디비에 ct_review 칼럼이 yes 이면 버튼을 출력하지 말아라.
				if ( $row[ct_review]=="YES" ){
					echo "";
				}	else{
					?><a href="/shop/item.php?it_id=<?=$row[it_id]?>&ca_id=<?=$row[ca_id]?>&review_flag=ok&ct_id=<?=$row[ct_id]?>"><img src='/images/btn_hoo.jpg'></a><?
				}
			}else if($row[ct_status] != "취소" && $row[ct_status] != "반품" && $row[ct_status] != "품절"){
				//echo "<a href='javascript:;' onclick=\"status_cancel('".$row[ct_id]."','".$_GET[od_id]."','".$_GET[on_uid]."')\">취소</a>";
			}
			?>
		</td>
	</tr>
	<? }
	// 증정품을 보여줍니다.
	if($row[ct_present])
	{
		$present = explode("|", $row[ct_present]);
		?>
		<tr>
			<td width="" colspan=11 style="padding-left:100px;"><b><font color="#9900FF"><?=$row[it_name]?></font> 구매고객 증정상품</b></td>
		</tr>
		<tr>
			<td align="right" height="2" bgcolor="#FFFFFF" colspan="11">
				<table width="" border="0" cellspacing="0" cellpadding="0">
				<?
				for($p=0; $present[$p]; $p++) {
					$present_item = explode(",", $present[$p]);
					$sql_get = "select it_name from {$GnTable[shopitem]} where it_id = '$present_item[0]' ";
					$item_get = sql_fetch($sql_get);
					?>
					<tr><td colspan=6 height=1 bgcolor="#EEEEEE"></td></tr>
					<tr>
						<td width=""><b><font color="#9900FF"><?if($p==0){?><?=number_format($present_item[2])?></font>원 이상<? } ?></b></td>
						<td width="80" height="60" align="center"><a href='./item.php?it_id=<?=$present_item[0]?>'><?=img_resize_tag("/shop/data/item/".$present_item[0]."_s", 50, 50);?></a></td>
						<td width=""><?=$item_get[it_name]?></td>
						<td width="50" align="center"><?=$present_item[1]?>개</td>
					</tr>
					<?
				}
				?>
				</table>
			</td>
		</tr>
		<?
	}
	?>
	<tr>
		<td height="5px"></td>
	</tr>
	<?if($i < $tot_list-1){?>
	<tr bgcolor="#EEEEEE">
		<td height="1" colspan="11"> </td>
	</tr>
	<tr>
		<td height="5px"></td>
	</tr>
	<? } ?>

<? } // 장바구니 리스트 끝 ?>
	<tr>
		<td align="center" height="2" bgcolor="#D8D8D8" colspan="11"></td>
	</tr>
	<?
	// 주문금액별 증정품을 보여줍니다.
	$present = item_presentresult($tot_sell_amount,"0","");
	if($present[it_id])
	{
	?>
	<tr>
		<td align="right" height="2" bgcolor="#FFFFFF" colspan="11">
			<table width="" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="230"><b><font color="#9900FF"><?=number_format($present[odto_pay])?>원 이상</font> 구매고객 증정상품</b></td>
					<td width="80"><a href='./item.php?it_id=<?=$present[it_id]?>'><?=img_resize_tag("/shop/data/item/".$present[it_id]."_s", 50, 50);?></a></td>
					<td width=""><?=$present[it_name]?></td>
					<td width="50" align=center><?=$present[pr_num]?>개</td>
				</tr>
			</table>
		</td>
	</tr>
	<?
	}
	mysql_free_result($result);
?>
<? if($s_page != "myorder_view.php"){?>
	<tr align="right">
		<td colspan="11" height="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?
            if ($i == 0)
			{
                echo "<tr>\n";
                echo "<td colspan=7 align=center height=100><span class=textpoint>장바구니가 비어 있습니다.</span></td>\n";
                echo "</tr>\n";

                $ismemcostpay = $GnShop[trans_all];
            }
			else
			{
				// 배송비 계산
				// 관리자 /admin/config/menu_list.php 배송비사용여부에 따른 처리
				if( $sitemenu['trans_pay'] == true)
				{
					// 배송비가 넘어왔다면
					if ($_POST[od_send_cost])
					{
						$send_cost = (int)$_POST[od_send_cost];
					}
					else
					{
						if($_SESSION["userid"]=="GUEST" || !$_SESSION["userid"]) {
							if($tot_sell_amount >= $GnShop[trans_all] && $GnShop[trans_all]!=0)	$send_cost = 0;
								else $send_cost = $GnShop[trans_pay];

								$ismemcostpay = $GnShop[trans_all];
						} else {
							$send_cost_limit = explode(",", $GnShop[trans_grub]);
							$send_cost_list  = explode("\n", $GnShop[trans_gpay]);
							$send_cost = 0;

							for($k=0; $send_cost_limit[$k]; $k++) {
								if($_SESSION["userlevel"]==$send_cost_limit[$k]) {
									// 총판매금액이 배송비 상한가 보다 작다면
									if ($tot_sell_amount > $send_cost_list[$k]) {
										$send_cost = 0;
										$ismemcostpay = $send_cost_list[$k];
									}
								}
							}

							if(!$ismemcostpay) {
								if($tot_sell_amount >= $GnShop[trans_all] && $GnShop[trans_all]!=0)	$send_cost = 0;
									else $send_cost = $GnShop[trans_pay];

								$ismemcostpay = $GnShop[trans_all];
							}
						}
						$sql = "select od_send_cost as cnt from {$GnTable[shoporder]} where od_id = '$od_id' ";
						$row = sql_fetch($sql);
						if ($row[cnt] > 0) $send_cost = $row[cnt];
					}
				}
				else
				{
					// 배송비 사용안함이면 배송비 0
					$send_cost = 0;
				}

                $total_money =  $tot_sell_amount + $tot_option_amount;   		// 제품총가격 = 주문상품금액합계 + 가격 옵션
                if($GnShop['use_vat']==TRUE) $total_vat = ceil($total_money/10);	// 부가세 추가시 포함
                $tot_amount = $total_money + $total_vat + $send_cost;				// 총계 = 주문상품금액합계 + 배송비 + 가격 옵션
            ?>
            <tr>
              <td align="right" height="25"><font color="B60F04">총구매금액  <?=number_format($total_money)?>원</td>
              <td width="20">&nbsp;</td>
            </tr>
			<?     // 배송비가 0 보다 크다면 (있다면)
                if ($send_cost > 0) {
            ?>
            <tr>
              <td align="right" height="25">
              <font color="#2B2A2A">배송료  <?=number_format($send_cost)?>원</font>
              </td>
              <td>&nbsp;</td>
            </tr>
			<? } ?>
			<?
            // 적립금 사용에 체크 되어잇고 적립포인트가 0 보다 크다면 (있다면)
			if ($sitemenu["point_use"] =="1"  && $tot_point > 0) {
            ?>
            <tr>
              <td align="right" height="25">
                <? if(Login_check()==FALSE) { ?><font color="red">로그인후 구매하시면 포인트 해택을 받으실 수 있습니다.</font><? } ?>
                <font color="#2B2A2A">적립포인트  <?=number_format($tot_point)?>원</font>
              </td>
              <td>&nbsp;</td>
            </tr>
			<? } ?>
            <tr>
              <td align="right" class="big" height="27"><font color="#2233CB"><b>총결제금액 <?=number_format($tot_amount)?>원</b></font></td>
              <td>&nbsp;</td>
            </tr>
            <input type=hidden name=records value='<?=$i?>'>
            <input type=hidden name=mode value=''>
			<? } ?>
		  </table>
		</td>
	</tr>
    <? }?>
    <tr align="right">
		<td colspan="11">
        <?
        if ($s_page == "shopbag.php") {
        ?>
		  <table width="368" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td align="right" height="35">
				<font color="#FF7800"><b>
				<?
                	if($ismemcostpay>0) {
						echo number_format($ismemcostpay)."원 이상 주문시 택배비 무료입니다.";
					}
				?>
				</b>
                </font>
			  </td>
			  <td width="17" >&nbsp;</td>
			</tr>
		  </table>
		<? } ?>
		</td>
	</tr>
    <tr>
        <td colspan=11 align=center>

        <?
        if ($s_page == "shopbag.php") {
            if ($i == 0) {
        ?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center"><a href='/shop/list.php?ca_id=<?=$continue_ca_id?>'><div style="width:80px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">계속쇼핑하기</div></a></td>
				</tr>
			</table>
		<?
            } else {
		?>
			<? if( Login_check() ) { ?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<? if ($it_order_ok!="n") { ?>
						<a href="./order_form.php"><div class="btn_list" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">바로구매</div></a>
						<? } ?>
						<a href='/shop/list.php?ca_id=<?=$continue_ca_id?>'><div style="width:80px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">계속쇼핑하기</div></a>
					</td>
				</tr>
			</table>
			<? } else { ?>
			<script language="javascript">
			function login_go(){
				alert("\n회원구매를 위해서 로그인해주세요.\n");
				location.href="/member/login.php?URL=/shop/shopbag_update.php?mode=LO";
			}
			</script>
			<table border="0" cellspacing="0" cellpadding="0">
			  <tr>
					<td align="center">
						<? if ($it_order_ok!="n") { ?>
						<div onclick="login_go();" style="width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block; cursor:pointer;">회원구매</div>
						<a href='./order_form.php'><div style="width:80px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">비회원구매</div></a>
						<? } ?>
						<a href='/shop/list.php?ca_id=<?=$continue_ca_id?>'><div style="width:80px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;">목록</div></a>
					</td>
			  </tr>
			</table>
			<? } ?>
        <?
			}
        }
        ?>

        </td>
    </tr>
</table>
</form>

<? if ($s_page == "shopbag.php") { ?>
    <script language='javascript'>
    <? if ($i != 0) { ?>
        function form_check(act) {
            var f = document.frmcartlist;
            var cnt = f.records.value;

            if (act == "buy")
            {
            	f.mode.value = act;

            	f.action = "./order_form.php";
            	f.submit();
            }
            else if (act == "alldelete")
            {
            	f.mode.value = act;
            	f.action = "<?="./shopbag_update.php"?>";
            	f.submit();
            }
            else if (act == "AE")
            {
                for (i=0; i<cnt; i++)
                {
                    if (f.elements["ct_qty[" + i + "]"].value == "")
                    {
                        alert("수량을 입력해 주십시오.");
                        f.elements["ct_qty[" + i + "]"].focus();
                        return;
                    }
                    else if (isNaN(f.elements["ct_qty[" + i + "]"].value))
                    {
                        alert("수량을 숫자로 입력해 주십시오.");
                        f.elements["ct_qty[" + i + "]"].focus();
                        return;
                    }
                    else if (f.elements["ct_qty[" + i + "]"].value < 1)
                    {
                        alert("수량은 1 이상 입력해 주십시오.");
                        f.elements["ct_qty[" + i + "]"].focus();
                        return;
                    }
                }
            	f.mode.value = act;
            	f.action = "<?="./shopbag_update.php"?>";
            	f.submit();
            }

            return true;
        }
    <? } ?>
    </script>
<? } ?>
