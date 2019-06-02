<?
	/////////////////////////////////////////////////////////////////////////////////////////////
	///////////////// 타입별 상품 보이기 ///////////////////////////////////////////////////////////
	###################### 이곳에 값을 수정하세요 ##########################
		// main_type(스킨이름, 타입, 몇개씩, 몇줄, 이미지가로, 이미지세로, 카테고리코드);
		$nowitem		= main_type('basic', 1, 4, 1, 120, 100,$ca_id);
		$bestitem		= main_type('basic', 2, 4, 1, 120, 100,$ca_id);
		$pointitem		= main_type('basic', 3, 4, 1, 120, 100,$ca_id);
		$hititem		= main_type('basic', 4, 4, 1, 120, 100,$ca_id);
		$prstitem		= main_type('basic', 5, 4, 1, 120, 100,$ca_id);
	////////////////////////////////////////////////////////////////////////////////////////////
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

    // 상품보관
    function item_wish(f, it_id)
    {
        f.url.value = "/shop/wish_update.php?it_id="+it_id;
        f.action = "./wish_update.php";
        f.submit();
    }
//-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align=center>
<!-- 쇼핑몰 현재위치 테이블 여기부터 -->
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
			$img = "/images/subimg/subimgtype".$type.".jpg";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$img)) {
		?>
				<tr><td><img src="<?=$img?>" border="0"></td></tr>
				<tr><td height="9"></td></tr>
		<? }else{ ?>
				<tr><td height="130">서브이미지들어갈자리</td>
				</tr>
				<tr><td height="9"></td></tr>
        <? }?>
				<tr>
					<td height="22" class="naviall"><img src="<?=$GnShop["skin_url"]?>/images/add_icon.gif"><a href="../main.php">&nbsp;HOME</a> <span class="navi2"><?=$ca_name?></span></td>
				</tr>
<tr><td><img src="<?=$GnShop["skin_url"]?>/images/addr_line.gif"></td></tr>				
			</table></td>
	</tr>
	<tr><td height="1" bgcolor="#E5E5E5"></td></tr>
	<tr>
		<td height="5"></td>
	</tr>
<!-- 쇼핑몰 현재위치 테이블 여기까지 -->
<!-- 쇼핑몰 하위분류 테이블 여기부터 -->
	<tr>
		<td>
	<? if($cate[0][ca_name]) {?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr bgcolor="#FFFFFF">
					<td align="center">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_lefttop.gif" width="10" height="10"></td>
								<td background="<?=$GnShop["skin_url"]?>/images/blue_box_topback.gif"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_topback.gif" width="50" height="10"></td>
								<td width="10"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_righttop.gif" width="10" height="10"></td>
							</tr>
							<tr>
								<td background="<?=$GnShop["skin_url"]?>/images/blue_box_leftback.gif"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_leftback.gif" width="10" height="41"></td>
								<td>
									<!--table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td><strong><font color="086DB9"><img src="/btn/bu_blue_s.gif" width="7" height="7"> <b><?=$Cateinfo["ca_name"]?></font></strong>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
												<?
													for($ca=0; $cate[$ca][ca_name]; $ca++) {
												?>
													<strong>- <a href="/shop/list.php?ca_id=<?=$cate[$ca][ca_id]?>"><?=$cate[$ca][ca_name]?></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<? if($ca%4==3) {?><br><? } ?>
												<? } ?>
											</td>
										</tr>
									</table-->
                                    <table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    	<?
											for($ca=0; $cate[$ca][ca_name]; $ca++) {
												if($ca!=0) echo "<tr><td height=\"1\" colspan=\"3\" bgcolor=\"#f0f0f0\"></td></tr>";
										?>
                                        <tr>
                                        	<td width="17%" height="26" style="padding:0 10 0 0;">
                                            	<img src="/btn/bu_blue_s.gif" width="7" height="7">
                                            	<a href="/shop/list.php?ca_id=<?=$cate[$ca][ca_id]?>"><strong><font color="086DB9"><?=$cate[$ca][ca_name]?></font></strong></a>
                                            </td>
                                            <td>:</td>
                                            <td width="82%" style="padding:2px;">
                                            	<?
													for($ca2=0; $cate2[$ca][$ca2][ca_name]; $ca2++) {
														if($ca2==0) echo "&nbsp;&nbsp;";
														echo "<strong>- <a href=\"/shop/list.php?ca_id=".$cate2[$ca][$ca2][ca_id]."\">".$cate2[$ca][$ca2][ca_name]."</a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
														if($ca2%4==3) echo "<br>&nbsp;&nbsp;";
													}
												?>
                                            </td>
                                        </tr>
                                        <? }?>
									</table>
								</td>
								<td background="<?=$GnShop["skin_url"]?>/images/blue_box_rightback.gif"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_rightback.gif" width="10" height="44"></td>
							</tr>
							<tr>
								<td><img src="<?=$GnShop["skin_url"]?>/images/blue_box_leftfoot.gif" width="10" height="10"></td>
								<td background="<?=$GnShop["skin_url"]?>/images/blue_box_footback.gif"><img src="<?=$GnShop["skin_url"]?>/images/blue_box_footback.gif" width="50" height="10"></td>
								<td><img src="<?=$GnShop["skin_url"]?>/images/blue_box_rightfoot.gif" width="10" height="10"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
	<? } ?>
		</td>
	</tr>
<!-- 쇼핑몰 하위분류 테이블 여기까지 -->
	<tr><td colspan="8" height="5"></td></tr>
<!-- 쇼핑몰 정렬아이콘 테이블 여기부터 -->
	<tr>
		<td height="27" bgcolor="f0f0f0">
			<table border="0" align="right" cellpadding="0" cellspacing="3">
				<tr>
					<td width="84"><a href="?type=<?=$type?>&sort1=it_time&sort2=<?=$NextSort?>"><img src="<?=$GnShop["skin_url"]?>/images/add_menu.gif" align="absmiddle" border="0"> 상품등록순</a></td>
					<td width="84"><a href="?type=<?=$type?>&sort1=it_pay&sort2=desc"><img src="<?=$GnShop["skin_url"]?>/images/add_menu.gif" align="absmiddle" border="0"> 높은가격순</a></td>
					<td width="84"><a href="?type=<?=$type?>&sort1=it_pay&sort2=asc"><img src="<?=$GnShop["skin_url"]?>/images/add_menu.gif" align="absmiddle" border="0"> 낮은가격순</a></td>
					<td width="84"><a href="?type=<?=$type?>&sort1=it_name&sort2=<?=$NextSort?>"><img src="<?=$GnShop["skin_url"]?>/images/add_menu.gif" align="absmiddle" border="0"> 제품명순</a></td>
				</tr>
			</table>
	  </td>
	</tr>
<!-- 쇼핑몰 정렬아이콘 테이블 여기까지 -->
<!-- 쇼핑몰 정렬아이콘 테이블 여기부터 -->
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td colspan="8" height="5"></td></tr>
				<tr><td align="center" style="padding-top:20"><table width="97%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <? for($i=0; $list[$i][it_id]; $i++) { ?>
                    <td align="center"><table  width="120" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="top"><table width="100%" cellspacing="0" cellpadding="0" style="border:1 #E0DFDF solid">
                              <tr onclick="location.href='./item.php?it_id=<?=$list[$i][it_id]."&".$qstr?>'" style="cursor:hand" onmouseover="this.style.backgroundColor='#F5F5F5'" onmouseout="this.style.backgroundColor=''">
                                <td height="100" align="center"><?=img_resize_tag("/shop/data/item/{$list[$i][it_id]}_m", 120, 100)?></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="8"></td>
                        </tr>
                        <tr>
                          <td align="center" class="style1"><font color="#000000">
                            <?=$list[$i][it_name]?>
                            <?=$list[$i][max_text]?>
                          </font></td>
                        </tr>
                        <tr>
                          <td align="center" class="style1"><font style="text-decoration:line-through">정가:
                            <?=number_format($list[$i][it_cust_amount])?>
                            원</font></td>
                        </tr>
                        <tr>
                          <td align="center" class="style1"><font color="903075"><b>할인가:
                            <?=number_format($list[$i][it_pay])?>
                            원</b></font></td>
                        </tr>
						<!--tr>
							<td align="center" class="style1">
								브랜드:<?=$list[$i][br_name];?>
							</td>
						</tr-->
                    </table></td>
                    <? if($i%4==3){ ?>
                  </tr>
                  <tr>
                    <td height="11">&nbsp;</td>
                  </tr>
                  <tr>
                    <? } ?>
                    <? } ?>
                  </tr>
                  <? if(!$i) {?>
                  <tr>
                    <td height="50" align="center">등록된 상품이 없습니다. </td>
                  </tr>
                  <? } ?>
                </table></td>
				</tr>
		  </table>
		</td>
	</tr>
	<tr align="center">
		<td height="25" colspan="30">
			<?=get_paging($default[de_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?>
		</td>
	</tr>
<!-- 쇼핑몰 정렬아이콘 테이블 여기까지 -->
</table>