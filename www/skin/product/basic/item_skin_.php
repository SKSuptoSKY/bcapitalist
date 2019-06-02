<SCRIPT LANGUAGE="JavaScript">
<!--
	function change_img(num) {
		for (i=1; i<=4; i++) {
			if (i==num) {
				document.getElementById("main_img"+i).style.display="";
			}
			else {
				document.getElementById("main_img"+i).style.display="none";
			}
		}
	}
	function MM_openBrWindow(theURL,winName,features) { //v2.0
	  window.open(theURL,winName,features);
	}
	function member_check()
	{
		<?
		if (!$_SESSION[userid] || $_SESSION[userid]=="GUEST")
		{
			echo "alert('회원만 가능합니다.'); ";
			echo "location.href='/member/login.php?url=".urlencode("./?$QUERY_STRING")."';";
			echo "return false;";
		}
		?>
		return true;
	}
	function addition_write(name)
	{
		if (!member_check()) return;
		if (name.style.display == 'none') { // 안보이면 보이게 하고
			name.style.display = 'block';
		} else { // 보이면 안보이게 하고
			name.style.display = 'none';
		}
	}
	function swapObj(id,i){
		for (var i = 0; i < 4; i++){
			obj = document.getElementById("photo_"+i).style;
			obj.display = "none";
		}
		obj = document.getElementById("photo_"+id).style;
		obj.display = "";
	}

//-->
</SCRIPT>
		<!-- 라이트 -->
		<table cellpadding="0" cellspacing="0">
		<tr>
		<td style="background:url(/images/shop/shop_title_line.jpg) 0px 45px no-repeat; height:50px; padding-top:7px;">
			<table cellpadding="0" cellspacing="0">
			<tr>
			<td width="50%" style="color:#505050; font-size:24px; font-weight:bold; line-height:30px;">맥시루브</td>
			<td width="350px" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME<img src="/images/shop/rudgh_arr.jpg" />Shop<img src="/images/shop/rudgh_arr.jpg" /><span style="font-weight:bold; color:#727272;">맥시루브</span></td>
			</tr>
			</table>
		</td>
		</tr>
		<!-- 탑 -->
		<tr>
		<td align="center" valign="top" style="padding-top:25px; padding-left:0px;">
			<form name="fitem"  Method="post" action="./shopbag_update.php" enctype="MULTIPART/FORM-DATA">
			<input type="hidden" name="it_id" value="<?=$it_id?>">
			<input type="hidden" name="it_point" value="<?=$view[it_point]?>">
			<input type="hidden" name="it_name" value="<?=$view[it_name]?>">
			<input type=hidden name=sw_direct value=''>
			<input type=hidden name=url value=''>
			<table cellpadding="0" cellspacing="0">
			<tr>
			<!-- 이미지 -->
			<td>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
							<tr>
							<td width="258" height="258"><?=$view[bimg1]?><?=$view[bimg2]?><?=$view[bimg3]?><?=$view[bimg4]?></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="10px"></td>
					</tr>
					<tr>
						<td>
							<table border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
							<tr>
							<td style="width:64px; height:66px;"><?=$view[simg1]?></td>
							<td style="width:64px; height:66px;"><?=$view[simg2]?></td>
							<td style="width:64px; height:66px;"><?=$view[simg3]?></td>
							<td style="width:64px; height:66px;"><?=$view[simg4]?></td>
							</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<!-- //이미지 -->
			<!-- 내용 -->
			<td style="padding-left:25px;" valign="top" align="left">
				<table cellpadding="0" cellspacing="0">
				<tr>
				<td width="400px" height="40px" style="background:url(/images/shop/view_title_bottom_bg.jpg) 0px 32px no-repeat;">
					<table cellpadding="0" cellspacing="0">
					<tr>
					<td height="35px" style="background:url(/images/shop/view_title_bg.jpg) 5px 7px no-repeat; color:#4b4b4b; font-size:20px; font-weight:bold; padding-left:20px;"><?=$view[it_name]?></td>
					</tr>
					</table>
				</td>
				</tr>
				<tr>
				<td style="padding-top:10px;">
					<table cellpadding="0" cellspacing="0">
					<tr> 
					<td style="background:url(/images/shop/view_list_dot.jpg) 0px 8px no-repeat; padding-left:10px;"><img src="/images/shop/view_list_1.jpg" title="가격" /></td>
					<td style="font-weight:bold; font-size:12px; color:#034f9d; padding-left:3px;">: <?=number_format($view[it_pay])?>원
					<input type="hidden" name="it_pay" value="<?=$view[it_pay]?>">
					</td>
					</tr>
					<tr> 
					<td style="background:url(/images/shop/view_list_dot.jpg) 0px 8px no-repeat; padding-left:10px;"><img src="/images/shop/view_list_3.jpg" title="제조사" /></td>
					<td style="font-size:12px; color:#585858; padding-left:3px;">: <?=$view[it_maker]?></td>
					</tr>
					<tr> 
					<td style="background:url(/images/shop/view_list_dot.jpg) 0px 8px no-repeat; padding-left:10px;"><img src="/images/shop/view_list_2.jpg" title="원산지" /></td>
					<td style="font-size:12px; color:#585858; padding-left:3px;">: <?=$view[it_origin]?></td>
					</tr>
					<? if ($row_config[point_chk]) { ?>
					<tr> 
					<td style="background:url(/images/shop/view_list_dot.jpg) 0px 8px no-repeat; padding-left:10px;"><img src="/images/shop/view_list_4.jpg" title="포인트" /></td>
					<td style="font-size:12px; color:#585858; padding-left:3px;">: <?=$point_end?>점</td>
					</tr>
					<? } ?>
					<tr> 
					<td style="background:url(/images/shop/view_list_dot.jpg) 0px 8px no-repeat; padding-left:10px;"><img src="/images/shop/view_list_5.jpg" title="수량" /></td>
					<td style="font-size:12px; color:#585858; padding-left:3px;">: 			
					<? if($itstock < 1) {
					echo $max_text;
					} else { ?>
					<select style="WIDTH: 50px" name="ct_qty">
					<? for($j=1; $j<=$max_num; $j++)  { ?>
					<option value=<?=$j?>>
					<?=$j?>
					</option>
					<? } ?>
					</select>
					개
					<? } ?>	
					</td>
					</tr>
					</table>
				</td>
				</tr>
				<!-- 장바구니&구매 버튼 -->
				<tr>
				<td style="padding-top:40px;" align="center">
					<? if($itstock >= 1 && !$view[it_gallery]) { ?>
					<table cellpadding="0" cellspacing="0">
					<tr>
					<td><img src="/images/shop/view_cart.jpg" style="cursor:pointer;" onClick="javascript:fitemcheck(document.fitem, 'cart_update');" title="장바구니" /></a></td>
					<td style="padding-left:10px;"><img src="/images/shop/view_sell.jpg" style="cursor:pointer" onClick="javascript:return fitemcheck(document.fitem, 'direct_buy');" title="바로구매" /></td>
					</tr>
					</table>
					<? } ?> 
				</td>
				</tr>
				<!-- //장바구니&구매 버튼 -->
				</table>
			</td>
			<!-- //내용 -->
			</tr>
			</table>
			</form>
		</td>
		</tr>
		<!-- //탑 -->
		<!-- 상세정보 -->
		<tr>
		<td style="padding-top:20px;">
			<table cellpadding="0" cellspacing="0">
			<tr>
			<td style="background:url(/images/shop/view_tab_bg.jpg) no-repeat; padding-left:10px; width:717px;"><a name="tab1"><img src="/images/shop/view_tab11.jpg" title="상세정보" /></a><a href="#tab2"><img src="/images/shop/view_tab12.jpg" title="사용후기" /></a><a href="#tab3"><img src="/images/shop/view_tab13.jpg" title="배송정보" /></a><a href="#tab4"><img src="/images/shop/view_tab14.jpg" title="교환,환불" /></a></td>
			</tr>
			<tr>
			<td style="padding-top:15px;">
			<!--<img src="/images/shop/view_11.jpg" title="상세정보" />-->
			<?=$view[it_explan]?>
			</td>
			</tr>
			</table>
		</td>
		</tr>
		<!-- //상세정보 -->


		</table>
		<!-- //라이트 -->