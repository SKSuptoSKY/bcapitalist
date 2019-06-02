
<table width="725" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="725">
							  <!--상단추출 -->
							  <table width="725" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="6" rowspan="2" valign="bottom">&nbsp;</td>
                                  <td width="713"><table width="713" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="713" height="20">Home &gt; <strong>SERACH LIST</strong></td>
                                    </tr>

                                    <tr>
                                      <td height="1" bgcolor="b6b6b6"></td>
                                    </tr>
                                    <tr>
                                      <td height="20"></td>
                                    </tr>
                                    <tr>
                                      <td ><img src="../images/sub/list_title_st.jpg" width="254" height="24"></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
                                    </tr>
                                  </table>
								  </td>
                                  <td width="6" rowspan="2" valign="bottom">&nbsp;</td>
                                </tr>
				<? if($category_show1 || $category_show2 || $category_show3 || $category_show4){?>
                                <tr>
                                  <td valign="top" bgcolor="80bbe9" style="padding:3px;">
								  <table width="707" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
								  <tr>
                                      <td width="707" style=" padding:5px;">
									  <table width="697" border="0" cellspacing="0" cellpadding="0">
								   <?if($category_show1){?>
										<tr>
                                          <td width="697"><img src="../images/sub/cat_1.jpg" width="226" height="25" /></td>
                                        </tr>
                                        <tr>
                                          <td align=left>
											<table width="697" border="0" cellspacing="0" cellpadding="0" align=left>
												<tr>
												 <?=$category_show1?>
												</tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="7"></td>
                                        </tr>
										<?}?>
										<?if($category_show2){?>
										<tr>
                                          <td width="697"><img src="../images/sub/cat_2.jpg" width="226" height="25" /></td>
                                        </tr>
                                        <tr>
                                          <td>
											<table width="697" border="0" cellspacing="0" cellpadding="0">
												<tr>
												 <?=$category_show2?>
												</tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="7"></td>
                                        </tr>
										<?}?>
										<?if($category_show3){?>
										<tr>
                                          <td width="697"><img src="../images/sub/cat_3.jpg" width="226" height="25" /></td>
                                        </tr>
                                        <tr>
                                          <td>
											<table width="697" border="0" cellspacing="0" cellpadding="0">
												<tr>
												 <?=$category_show3?>
												</tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="7"></td>
                                        </tr>
										<?}?>
										<?if($category_show4){?>
										<tr>
                                          <td width="697"><img src="../images/sub/cat_4.jpg" width="226" height="25" /></td>
                                        </tr>
                                        <tr>
                                          <td>
											<table width="697" border="0" cellspacing="0" cellpadding="0">
												<tr>
												 <?=$category_show4?>
												</tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="7"></td>
                                        </tr>
										<?}?>
                                  </table>
								  </td>
                                </tr>
                              </table>
							    </td>
                                </tr>
									<?}else{?>
							 <tr>
                              <td height="100" align=center>검색결과가 없습니다.</td>
                            </tr>
							<?}?>
                              </table>
							  <!--상단추출 -->
							  </td>
                            </tr>
						
                            <tr>
                              <td height="20">&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
							  <!--뿌려질 리스트 -->
							  <table width="725" border="0" cellspacing="0" cellpadding="0">
                                  <? for($i=0; $list[$i][it_id]; $i++) { 
								   if($i%4==0){echo "<tr>";}
								   ?>
                                  <td>&nbsp;</td>
                                  <td width="135">
										  <!--추출이미지 -->
								  			<table width="135" border="0" cellspacing="0" cellpadding="0">
                                   			 <tr>
                                    			  <td height="135" align="center" bgcolor="bcbcbc"><table width="129" height="129" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                      <td align="center"><a href="/shop/item.php?it_id=<?=$list[$i][it_id]?>"><?=img_resize_tag("/shop/data/item/{$list[$i][it_id]}_m", 129, 129)?></a></td>
                                                    </tr>
                                                  </table></td>
                                   			 </tr>
                                    <tr>
                                      <td height="20" align="center"><a href="/shop/item.php?it_id=<?=$list[$i][it_id]?>">
              <?=$list[$i][it_name]?><?=($list[$i][it_stock] == 0)?"<span style=\"color:#ff0000;\"> [품 절]</span>":"";?></td>
                                    </tr>
                                    <tr>
                                      <td height="20" align="center" class="list1"><img src="/btn/btn_won.gif" width="10" height="10" /><?=$list[$i][Get_pay]?></td>
                                    </tr>
                                  			</table>
								  <!--추출이미지 -->								  </td>
                                  <td>&nbsp;</td>
                                  <td width="135">&nbsp;</td>
								     <?if($i%4==3){?></tr><?}else{?><?}?>
                               
                              <?}?>
                                  
                              </table>
							  <!--뿌려질 리스트 -->
							  </td>
                            </tr>
                            <tr>
                              <td height="50" align="center">
							  <table width="" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                 
                                  <td><?=get_paging($default[de_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
                                 
                                </tr>
                              </table>
							  </td>
                            </tr>
                          </table>
