<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
<script language="JavaScript">
<!--
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
</script>
<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
-->
</style>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #CC0000;
	font-weight: bold;
}
.style2 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
<body onLoad="MM_preloadImages('<?=$GnShop["skin_url"]?>/images/tab1r.gif','images/view_buy.gif','images/view_cart_on.gif','images/view_wish_on.gif')">
<table width="700" border="0" cellspacing="0" cellpadding="0" align=center>
<!-- 쇼핑몰 현재위치 테이블 여기부터 -->
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
			$img = "/shop/data/design/{$view[ca_id]}_Top";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$img)) {
		?>
		<? } ?>
				<tr>
					<td height="22" class="naviall"><img src="<?=$GnShop["skin_url"]?>/images/add_icon.gif" width="11" height="11">&nbsp;<a href="../main.php">HOME</a> <span class="navi2"><?=get_location($view["ca_id"]);?></span></td>
				</tr>
<tr><td><img src="<?=$GnShop["skin_url"]?>/images/addr_line.gif"></td></tr>				
			</table>
		</td>
	</tr>	
	<tr>
		<td height="19"></td>
	</tr>
<!-- 쇼핑몰 현재위치 테이블 여기까지 -->
	<tr>
		<td>
			<table width="700" border="0" cellspacing="0" cellpadding="0">
<FORM name="fitem"  Method="post" action="./shopbag_update.php" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<input type="hidden" name="it_point" value="<?=$view[it_point]?>">
<input type="hidden" name="it_name" value="<?=$view[it_name]?>">
<input type=hidden name=sw_direct value=''>
<input type=hidden name=url value=''>
				<tr>
					<td>
						<table width="700" border="0" cellpadding="0" cellspacing="0" bordercolor="#990033">
							<tr>
							  <td width="331"><table width="330" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="330" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="330" height="276" align="center" valign="middle" background="<?=$GnShop["skin_url"]?>/images/view_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td><img src="<?=$GnShop["skin_url"]?>/images/view_top_left.gif" width="10" height="7"></td>
                                              <td background="<?=$GnShop["skin_url"]?>/images/view_top_m.gif"></td>
                                              <td><img src="<?=$GnShop["skin_url"]?>/images/view_top_right.gif" width="10" height="7"></td>
                                            </tr>
                                            <tr background="<?=$GnShop["skin_url"]?>/images/view_bg.gif">
                                              <td>&nbsp;</td>
                                              <td height="276" align="center" valign="middle"><table width="208" border="0" cellpadding="0" cellspacing="3">
                                                  <tr>
                                                    <td width="202" bgcolor="#FFFFFF"><img src="<?=$bigimg_0?>" width="300" height="250" border=0  id="photo_0" style=""> <img src="<?=$bigimg_1?>" width="300" height="250" border=0  id="photo_1" style="display:none"> <img src="<?=$bigimg_2?>" width="300" height="250" border=0  id="photo_2" style="display:none"> <img src="<?=$bigimg_3?>" width="300" height="250" border=0  id="photo_3" style="display:none"> </td>
                                                  </tr>
                                              </table></td>
                                              <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td><img src="<?=$GnShop["skin_url"]?>/images/view_btm_left.gif" width="10" height="7"></td>
                                              <td background="<?=$GnShop["skin_url"]?>/images/view_btm_m.gif"></td>
                                              <td><img src="<?=$GnShop["skin_url"]?>/images/view_btm_right.gif" width="10" height="7"></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td height="20" align="center"><img src="<?=$GnShop["skin_url"]?>/images/view_big_btn.gif" border="0" <?=$bigimg_link?>> </td>
                                      </tr>
                                      <tr>
                                        <td height="72" align="center"><table width="" border="0" cellpadding="0" cellspacing="1" bgcolor="#DFDFDF">
                                            <tr>
                                              <td bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="5">
                                                  <tr>
                                                    <td width="72" height="60"><img src="<?=$bigimg_0?>" width="70" height="58" onClick="swapObj(0); return true;" style="cursor:hand"></td>
                                                    <td width="11"></td>
                                                    <td width="72" height="60"><img src="<?=$bigimg_1?>" width="70" height="58" onClick="swapObj(1); return true;" style="cursor:hand"></td>
                                                    <td width="11"></td>
                                                    <td width="72" height="60"><img src="<?=$bigimg_2?>" width="70" height="58" onClick="swapObj(2); return true;" style="cursor:hand"></td>
                                                    <td width="11"></td>
                                                    <td width="72" height="60"><img src="<?=$bigimg_3?>" width="70" height="58" onClick="swapObj(3); return true;" style="cursor:hand"></td>
                                                  </tr>
                                              </table></td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                  </table></td>
                                  <td width="339" valign="top"></td>
                                </tr>
                              </table></td>
						      <td width="20">&nbsp;</td>
                              <td valign="top" align="right">
              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
<tr>
														<td height="25" colspan="2"><strong><font color="4d4d4d" style="font-size:15px;">
														  <?=$view[it_name]?> <!--<?=$item_type?>-->
														  </font></strong></td>
				      </tr>
													  <tr>
														<td colspan="2"><img src="<?=$GnShop["skin_url"]?>/images/view_tit_line.gif"></td>
													  </tr>
													  <tr>
														<td colspan="2" height="10"></td>
													  </tr>
													  <tr>
														<td width="83" height="25"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;<font color="858585">정가</font><br>														</td>
														<td width="256">: <font color="9d6363" style="text-decoration:line-through"><strong>
												      <input type=hidden name=it_pay value='0'><?=number_format($view[it_pay])?>
														  <input type=hidden name=disp_sell_amount value="<?=number_format($view[it_pay])?>" size=5 style='text-align:left; border;none; border-width:0px; font-color:#9d6363; font-weight:bold; background-color:#ffffff' class=amount readonly>
													    원</strong></font></td>
					  </tr>
													  <tr>
														<td height="25"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;<font color="858585">할인가</font></td>
												        <td>: <strong><font color="#9d6363">
														  <?=number_format($view[it_pay])?>
														  원</font></strong></td>
													  </tr>
                                                      <? if($GnShop['use_vat']==TRUE){?>
													  <tr>
														<td height="25" bgcolor="#FFFFFF"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;<span class="style2">VAT</span></td>
												        <td>: <span class="style1">VAT별도 <?=$GnShop['vat_num']?>%</span></td>
													  </tr>													  
													  <tr><td height="20" valign="middle" colspan="2"><img src="<?=$GnShop["skin_url"]?>/images/view_dot_line.gif"></td></tr>
                                                      <? }?>
														<tr>
														<td height="25"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;<font color="858585">배송안내</font></td>
						<td>: 평균 5일내 배송 90%완료</td>
													  </tr>
													  <!--<tr bgcolor="#F2F5F9">
														<td height="20" bgcolor="#FFFFFF"><img src="/images/view/view_icon.gif">&nbsp;<font color="858585">포 인 트</font></td>
														<td bgcolor="#FFFFFF">: <font color="9d6363"><strong>
														  <?=$view[it_point]?>
														  point</strong></font></td>
													  </tr>-->
													<?
													// 선택옵션 출력
													for ($i=1; $i<=6; $i++) {
														if($view["it_opt{$i}_subject"]){
													?>
																  <tr>
																	<td><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;<?=$view["it_opt{$i}_subject"]?></td>
																	<td>: <?=$view["it_opt{$i}"]?></td>
																  </tr>
                                                                  <tr><td colspan="2"><img src="<?=$GnShop["skin_url"]?>/images/view_dot_line.gif"></td></tr>
													<?
														}
													}
													?>
													  <tr>
														<td height="20" valign="middle" colspan="2">&nbsp;</td>
													  </tr>
													  <tr>
														<td height="25"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;재고수량</td>
														<td>: <?=number_format($view[it_stock])?>
														  EA</td>
													  </tr>
													  <tr>
														<td height="25"><img src="<?=$GnShop["skin_url"]?>/images/view_icon.gif">&nbsp;구매수량</td>
														<td>:
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
														  EA
														  <? } ?>														</td>
													  </tr>
													  <tr>
														<td height="20" valign="middle" colspan="2"><img src="<?=$GnShop["skin_url"]?>/images/view_dot_line.gif"></td>
													  </tr>
													  <tr>
														<td height="15" colspan="2"></td>
													  </tr>
													  <tr>
														<td colspan="2" align="right">
														  <? if($itstock >= 1 && !$view[it_gallery]) { ?>
														  <!--<input type="image" src="/images/view/view_buy.gif" style="border:0;" value="바로구매" onClick="javascript:fitemcheck(document.fitem, 'direct_buy');">-->

														 <input type="image" src="/images/btn_buy.jpg" style="border:0;" value="바로구매" onClick="javascript:fitemcheck(document.fitem, 'direct_buy');">

                                                      
														  
														  <input type="image" src="/images/btn_cart.jpg" style="border:0;"  value="장바구니" onClick="javascript:return fitemcheck(document.fitem, 'cart_update');">

														  <? } ?>

														  <input type="image" src="/images/btn_list.jpg" style="border:0;"  value="찜하기" onClick="javascript:item_wish(document.fitem, '<?=$view[it_id]?>');">
													  

                                                          



														</td>
													  </tr>
													  <tr>
														<td colspan="2" valign="bottom">&nbsp;</td>
					  </tr>
						      </table></td>
						  </tr>
					  </table>
				  </td>
				</tr>
			<? if($code["ca_input"]==TRUE) { ?>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<!--table width="700" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td height="100">
								<? include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/{$GnShop[shop_skin]}/{$code[ca_input]}"; ?>
								</td>
							</tr>
						</table-->
					</td>
				</tr>
			<? } ?>
			</form>
				<tr>
					<td ><a name="1"></a>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><!--탭버튼시작-->
                                    <table width="700" border="0" cellspacing="0" cellpadding="0" background="<?=$GnShop["skin_url"]?>/images/tab_bar.gif" style="background-repeat:repeat-x;">
                                      <tr>
                                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab1','','<?=$GnShop["skin_url"]?>/images/tab1r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab1r.gif" name="tab1" border="0"></a></td>
                                        <td width="3">&nbsp;</td>
                                        <td><a href="#2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab2','','<?=$GnShop["skin_url"]?>/images/tab3r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab3.gif" name="tab2" border="0"></a></td>
                                        <td width="3">&nbsp;</td>
                                        <td><a href="#3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab3','','<?=$GnShop["skin_url"]?>/images/tab2r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab2.gif" name="tab3" border="0"></a></td>
                                        <td width="3">&nbsp;</td>
                                        <td><a href="#4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab4','','<?=$GnShop["skin_url"]?>/images/tab4r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab4.gif" name="tab4" border="0"></a></td>
                                        <td width="11">&nbsp;</td>
                                      </tr>
                                    </table>
                                  <!--탭버튼끝--></td>
							</tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td style="padding:5px; border:0px solid #000000">
						<?
							if($view[it_explan])  {
								echo  $view[it_explan];
							} else {
								echo "입력된 자료가 없습니다.";
							}
						?>
								</td>
							</tr>
					  </table>
					</td>
				</tr>
				<tr>
					<td><a name="2"></a>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td><!--탭버튼시작-->
							  <table width="700" border="0" cellspacing="0" cellpadding="0" background="<?=$GnShop["skin_url"]?>/images/tab_bar.gif" style="background-repeat:repeat-x;">
                                    <tr>
                                      <td><a href="#1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab5','','<?=$GnShop["skin_url"]?>/images/tab1r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab1.gif" name="tab5" border="0" id="tab5" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab6','','<?=$GnShop["skin_url"]?>/images/tab3r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab3r.gif" name="tab6" border="0" id="tab6" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab7','','<?=$GnShop["skin_url"]?>/images/tab2r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab2.gif" name="tab7" border="0" id="tab7" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab8','','<?=$GnShop["skin_url"]?>/images/tab4r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab4.gif" name="tab8" border="0" id="tab8" /></a></td>
                                      <td width="11">&nbsp;</td>
                                    </tr>
                                </table>
                                <!--탭버튼끝--></td>
						  </tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td style="padding:5px; border:0px solid #000000">
						<!-- 사용후기 여기부터-->
									<table width=100% cellpadding=0 cellspacing=0 border=0>
										<tr>
											<td align=right><input type=image onClick="addition_write(itemvalue);" src='../btn/btn_up.gif' alt ="사용후기쓰기" style="border:0;"></td>
										</tr>
										<tr>
											<td colspan=2 align=center>
												<div id=itemvalue style='display:none;'>
												<table width=100% cellpadding=0 cellspacing=0>
												<form name="fitemvalue" method="post" action="./itemps_update.php" autocomplete=off>
												<input type=hidden name=it_id value="<?=$view[it_id]?>">
												<tr>
													<td align=center>
														<table width=100% cellpadding=0 cellspacing=0 border=0>
															<tr>
															  <td width="11%" height=25>&nbsp;</td>
															  <td width="89%"><table width=100% cellpadding=0 cellspacing=0>
																  <tr>
																	<td><input type=radio name=is_score value='10' class='radd' checked>
																	  <img src='<?=$GnShop["skin_url"]?>/images/star5.gif' align=absmiddle></td>
																	<td><input type=radio name=is_score class='radd' value='8'>
																	  <img src='<?=$GnShop["skin_url"]?>/images/star4.gif' align=absmiddle></td>
																	<td><input type=radio name=is_score class='radd' value='6'>
																	  <img src='<?=$GnShop["skin_url"]?>/images/star3.gif' align=absmiddle></td>
																	<td><input type=radio name=is_score  class='radd' value='4'>
																	  <img src='<?=$GnShop["skin_url"]?>/images/star2.gif' align=absmiddle></td>
																	<td><input type=radio name=is_score  class='radd' value='2'>
																	  <img src='<?=$GnShop["skin_url"]?>/images/star1.gif' align=absmiddle></td>
																	<td width="31%" height=50 align=center> <div align="right">
																	  </div></td>
																  </tr>
																</table></td>
															</tr>
															<tr>
															  <td height=25>제목&nbsp;</td>
															  <td>&nbsp; <input type="text" name="is_subject" class=edit  required itemname="제목" style="width:98%;"></td>
															</tr>
															<tr>
															  <td height=30>내용&nbsp;</td>
															  <td>&nbsp; <textarea name="is_content" rows="4" cols="69" class=edit required itemname="내용" style="width:98%;"></textarea></td>
															</tr>
															<tr>
															  <td height=30 colspan="2"><div align="right">
																  <input type=image src="../btn/btn_write.gif" alt="확인" class='radd' border=0>
																</div></td>
															</tr>
													  </table>													</td>
												</tr>
												</form>
												</table>
												</div>
                                            </td>
										</tr>
										<tr>
											<td colspan=2 align=center>
												<table width=100% cellpadding=5 cellspacing=0 border=0>
												  <?
												for ($i=0; $ps[$i][is_id]; $i++) {
													if ($i > 0) echo "<tr><td colspan=3 height=1 bgcolor=#EEEEEE></td></tr>\n";
												?>
												  <tr>
													<td><strong>ㆍ</strong></td>
													<td> <a href='javascript:;' onClick="menu('iv<?=$i?>')"><b>
													  <?=$ps[$i][is_subject]?>
													  </b></a> | <span class=small>
													  <?=$ps[$i][mem_name]?>
													  님 |
													  <?=$ps[$i][is_time]?>
													  </span> |&nbsp;&nbsp;<img src='<?=$GnShop["skin_url"]?>/images/star<?=$ps[$i][star]?>.gif' border=0 align=absmiddle>
                                                      </td>
                                                      <td width="100"b align="right">
                                                      <?
                                                      	if($_SESSION[userid]==$ps[$i][mb_id]){
													  		echo "<a href=\"javascript:;\" onclick=\"menu('mo".$i."');\"><img src=\"$GnShop[skin_url]/images/icon_m.gif\" border=0 align=absmiddle></a> &nbsp;";
															echo "<a href=\"itemps_update.php?it_id=".$view[it_id]."&is_id=".$ps[$i][is_id]."&mode=delete\" onclick=\"return confirm('정말 삭제하시겠습니까?');\"><img src=\"$GnShop[skin_url]/images/icon_x.gif\" border=0 align=absmiddle></a>";
														}
													  ?>
                                                      </td>
												  </tr>
                                                  <tr>
                                                  	<td colspan="3">
                                                    	<div id='mo<?=$i?>' style='display:none;'>
                                                        	<table width=100% cellpadding=0 cellspacing=0>
                                                                <form name="after<?=$i?>" method="post" action="./itemps_update.php" autocomplete=off>
                                                                <input type=hidden name=it_id value="<?=$view[it_id]?>">
                                                                <input type=hidden name=is_id value="<?=$ps[$i][is_id]?>">
                                                                <tr>
                                                                    <td align=center>
                                                                        <table width=100% cellpadding=0 cellspacing=0 border=0>
                                                                            <tr>
                                                                              <td width="11%" height=25>&nbsp;</td>
                                                                              <td width="89%"><table width=100% cellpadding=0 cellspacing=0>
                                                                                  <tr>
                                                                                    <td><input type=radio name=is_score value='10' class='radd'<?=($ps[$i][star]==5)?" checked":"";?>>
                                                                                      <img src='<?=$GnShop["skin_url"]?>/images/star5.gif' align=absmiddle></td>
                                                                                    <td><input type=radio name=is_score class='radd' value='8'<?=($ps[$i][star]==4)?" checked":"";?>>
                                                                                      <img src='<?=$GnShop["skin_url"]?>/images/star4.gif' align=absmiddle></td>
                                                                                    <td><input type=radio name=is_score class='radd' value='6'<?=($ps[$i][star]==3)?" checked":"";?>>
                                                                                      <img src='<?=$GnShop["skin_url"]?>/images/star3.gif' align=absmiddle></td>
                                                                                    <td><input type=radio name=is_score  class='radd' value='4'<?=($ps[$i][star]==2)?" checked":"";?>>
                                                                                      <img src='<?=$GnShop["skin_url"]?>/images/star2.gif' align=absmiddle></td>
                                                                                    <td><input type=radio name=is_score  class='radd' value='2'<?=($ps[$i][star]==1)?" checked":"";?>>
                                                                                      <img src='<?=$GnShop["skin_url"]?>/images/star1.gif' align=absmiddle></td>
                                                                                    <td width="31%" height=50 align=center> <div align="right">
                                                                                      </div></td>
                                                                                  </tr>
                                                                                </table></td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td height=25>제목&nbsp;</td>
                                                                              <td>&nbsp; <input type="text" name="is_subject" class=edit  required itemname="제목" value="<?=$ps[$i][is_subject]?>" style="width:98%;"></td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td height=30>내용&nbsp;</td>
                                                                              <td>&nbsp; <textarea name="is_content" rows="4" cols="69" class=edit required itemname="내용" style="width:98%;"><?=str_replace("<br />","",$ps[$i][is_content])?></textarea></td>
                                                                            </tr>
                                                                            <tr>
                                                                              <td height=30 colspan="2"><div align="right">
                                                                                  <input type=image src="../btn/btn_modify.gif" alt="수정" class='radd' border=0>
                                                                                </div></td>
                                                                            </tr>
                                                                      </table>
                                                                    </td>
                                                                </tr>
                                                                </form>
                                                            </table>
                                                        </div>
                                                    </td>
                                                  </tr>
												  <tr>
													<td colspan=3> <div id='iv<?=$i?>' style='display:none;'><br>
														<?=$ps[$i][is_content]?>
													  </div></tr>
												  <?
												}
												?>
												</table>
                                            </td>
										</tr>
									</table>
								<!--사용후기 여기까지 -->
                        		</td>
							</tr>
					  </table>
					</td>
				</tr>
				<tr>
					<td><a name="3"></a>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td><!--탭버튼시작-->
                                <table width="700" border="0" cellspacing="0" cellpadding="0" background="<?=$GnShop["skin_url"]?>/images/tab_bar.gif" style="background-repeat:repeat-x;">
                                    <tr>
                                      <td><a href="#1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab9','','<?=$GnShop["skin_url"]?>/images/tab1r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab1.gif" name="tab9" border="0" id="tab9" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab10','','<?=$GnShop["skin_url"]?>/images/tab3r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab3.gif" name="tab10" border="0" id="tab10" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab11','','<?=$GnShop["skin_url"]?>/images/tab2r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab2r.gif" name="tab11" border="0" id="tab11" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab12','','<?=$GnShop["skin_url"]?>/images/tab4r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab4.gif" name="tab12" border="0" id="tab12" /></a></td>
                                      <td width="11">&nbsp;</td>
                                    </tr>
                                </table>
                                <!--탭버튼끝--></td>
						  </tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td style="padding:5px; border:0px solid #000000">
						<?
							if($GnShop[explan_trans])  {
								echo  $GnShop[explan_trans];
							}
						?>	
						</td>
							</tr>
					  </table>
					</td>
				</tr>				
				<tr>
					<td><a name="4"></a>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td><!--탭버튼시작-->
                                  <table width="700" border="0" cellspacing="0" cellpadding="0" background="<?=$GnShop["skin_url"]?>/images/tab_bar.gif" style="background-repeat:repeat-x;">
                                    <tr>
                                      <td><a href="#1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab13','','<?=$GnShop["skin_url"]?>/images/tab1r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab1.gif" name="tab13" border="0" id="tab13" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab14','','<?=$GnShop["skin_url"]?>/images/tab3r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab3.gif" name="tab14" border="0" id="tab14" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab15','','<?=$GnShop["skin_url"]?>/images/tab2r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab2.gif" name="tab15" border="0" id="tab15" /></a></td>
                                      <td width="3">&nbsp;</td>
                                      <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('tab16','','<?=$GnShop["skin_url"]?>/images/tab4r.gif',1)"><img src="<?=$GnShop["skin_url"]?>/images/tab4r.gif" name="tab16" border="0" id="tab16" /></a></td>
                                      <td width="11">&nbsp;</td>
                                    </tr>
                                  </table>
                                <!--탭버튼끝--></td>
						  </tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td style="padding:5px; border:0px solid #000000">
						<!-- 교환환불 시작-->
						<?
							if($GnShop[explan_chan])  {
								echo  $GnShop[explan_chan];
							}
						?>
						<br>
						<?
							if($GnShop[explan_other])  {
								echo  $GnShop[explan_other];
							}
						?>
						 <!--교환환불 end --></td>
							</tr>
					  </table>
					</td>
				</tr>
                <tr>
                    <td height="20">&nbsp;</td>
                </tr>
				<tr>
					<td><img src="<?=$GnShop["skin_url"]?>/images/btm_line.gif"></td>
				</tr>
                <tr>
                    <td height="14">&nbsp;</td>
                </tr>
				<tr>
					<td align="center"><a href="/shop/list.php"><img src="<?=$GnShop["skin_url"]?>/images/btn_list.gif" border="0"></a></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
		  </table>
		</td>
	</tr>
</table>



<script>

    var basic_amount = parseInt('<?=$view[it_pay]?>');
    var basic_point  = parseInt('<?=$view[it_point]?>');

    function get_amount(data)
    {
        var str = data.split(";");
        var num = parseInt(str[1]);
        if (isNaN(num)) {
            return 0;
        } else {
            return num;
        }
    }

    function amount_change()
    {
        var f = document.fitem;
        var opt1 = 0;
        var opt2 = 0;
        var opt3 = 0;
        var opt4 = 0;
        var opt5 = 0;
        var opt6 = 0;
        var ct_qty = 0;

        if (typeof(f.ct_qty) != 'undefined')
            ct_qty = parseInt(f.ct_qty.value);

        if (typeof(f.it_opt1) != 'undefined') opt1 = get_amount(f.it_opt1.value);
        if (typeof(f.it_opt2) != 'undefined') opt2 = get_amount(f.it_opt2.value);
        if (typeof(f.it_opt3) != 'undefined') opt3 = get_amount(f.it_opt3.value);
        if (typeof(f.it_opt4) != 'undefined') opt4 = get_amount(f.it_opt4.value);
        if (typeof(f.it_opt5) != 'undefined') opt5 = get_amount(f.it_opt5.value);
        if (typeof(f.it_opt6) != 'undefined') opt6 = get_amount(f.it_opt6.value);

        var amount = basic_amount + opt1 + opt2 + opt3 + opt4 + opt5 + opt6;
        var point  = basic_point;

        if (typeof(f.it_pay) != 'undefined')
            f.it_pay.value = amount;

       // if (typeof(f.disp_sell_amount) != 'undefined')
           // f.disp_sell_amount.value = number_format(String(amount * ct_qty));

        //if (typeof(f.it_point) != 'undefined') {
        //    f.it_point.value = point;
        //    f.disp_point.value = number_format(String(point * ct_qty));
        //}
    }

    // 처음시작시 한번 실행
    amount_change();

    // 상품보관
    function item_wish(f, it_id)
    {
        f.url.value = "/shop/wish_update.php?it_id="+it_id;
        f.action = "./wish_update.php";
        f.submit();
    }

    // 바로구매 또는 장바구니 담기
    function fitemcheck(f, act) {

        // 판매가격이 0 보다 작다면
        if (f.it_pay.value < 0) {
            alert("전화로 문의해 주세요.");
            return false;
        }

        for (i=1; i<=6; i++) {
            if (typeof(f.elements["it_opt"+i]) == 'object') {
                if (f.elements["it_opt"+i].value == '선택') {
                    alert(f.elements["it_opt"+i+"_subject"].value + '을(를) 선택해 주십시오.');
                    f.elements["it_opt"+i].focus();
                    return false;
                }
            }
        }

        if (act == "direct_buy") {
            f.sw_direct.value = 1;
        } else {
            f.sw_direct.value = 0;
        }

        if (!f.ct_qty.value) {
            alert("수량을 입력해 주십시오.");
            f.ct_qty.focus();
            return false;
        } else if (isNaN(f.ct_qty.value)) {
            alert("수량을 숫자로 입력해 주십시오.");
            f.ct_qty.select();
            f.ct_qty.focus();
            return false;
        } else if (parseInt(f.ct_qty.value) < 1) {
            alert("수량은 1 이상 입력해 주십시오.");
            f.ct_qty.focus();
            return false;
        }
	return true;
    }
</script>
