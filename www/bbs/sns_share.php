							<!-- sns tag -->
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<?
									if($_SERVER['QUERY_STRING']){
										$view_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
										$this_page = $view_page;
										$this_page =  urlencode($this_page);
									}else{
										$view_page = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
										$this_page = $view_page;
										$this_page =  urlencode($this_page);
									}
									$ua = $_SERVER['HTTP_USER_AGENT'];
									if( stristr($ua,"Android") || stristr($ua,"iPhone") || stristr($ua,"bada") || stristr($ua,"Mobile") || stristr($ua,"samsung") || stristr($ua,"lgtel") ){
									if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') $strRedirect .= '?'.$_SERVER['QUERY_STRING'];
									?>
										<td width="25" style="text-align:right;padding-right:5px;">
											<?if($Board_Admin["use_kakotalk"]){?>
											<span id="ktalk"><img src="/images/sns/kakaotalk.png" width="25"></span>
											<?}?>
											<?if($Board_Admin["use_kakostory"]){?>
											<span id="kstory"><img src="/images/sns/kakaostory.png" width="25"></span>
											<?}?>
											<?if($Board_Admin["use_facebook"]){?>
											<a href="javascript:;" onclick="sendFaceBook('<?=$bbs_content?>','<?=$this_page?>');" title="페이스북"><img src="/images/sns/icon_facebook.gif" title="페이스북" width="25" height="25"/></a>
											<?}?>
											<?if($Board_Admin["use_twitter"]){?>
											<!-- Twitter -->
											<a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="kr"data-size="small" data-count="none">Tweet</a>
											<?}?>
										</td>
									<?}else{?>
										<td width="25" align="right" style="padding-left:8px;">
											<?if($Board_Admin["use_facebook"]){?>
											<a href="javascript:;" onclick="sendFaceBook('<?=$bbs_content?>','<?=$this_page?>');" title="페이스북"><img src="/images/sns/icon_facebook.gif" title="페이스북 공유하기" width="25" height="25"/></a>
											<?}?>
											<?if($Board_Admin["use_twitter"]){?>
											<!-- Twitter -->
											<a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="kr"data-size="small" data-count="none">Tweet</a>
											<?}?>
										</td>
									<?}?>
								</tr>
							</table>
							<!-- sns tag -->
							<script type="text/javascript" src="/css/jquery-1.7.min.js"></script>
							<script language='javascript' src='/admin/lib/kakao.link.js'></script>
							<script type="text/javascript">
							<!--
								/*sns script*/
								// 페이스북 
								function sendFaceBook(message,url) {
										var url = 'http://www.facebook.com/sharer.php?u=' + url + '&t=' + encodeURIComponent(message);
										var facebook = window.open(url, 'facebook', '');
										facebook.focus();
								}

								!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

								  var curURL=location.href;
								  var curTitle = '<?=$bbs_kako_content?>';
								  function executeURLLink()
									{
									  kakao.link("talk").send({
									  msg : curTitle,
									  url : "<?=$view_page?>",
									  appid : "<?=$_SERVER['HTTP_HOST']?>",
									  appver : "1.0",
									  appname : "<?=$default[site_name]?>",
									  type : "link"
									});
								  };
								  function executeKakaoStoryLink()
									{kakao.link("story").send({   
									  post : "<?=$bbs_kako_content?>\n<?=$view_page?>",
									  appid : "<?=$_SERVER['HTTP_HOST']?>",
									  appver : "1.0",
									  appname : "<?=$bbs_kako_content?>",
									  urlinfo : JSON.stringify({title:"<?=$default[site_name]?>", desc:"", imageurl:[], type:"article"})
									});
								  }
								$(document).ready(function(){
								  $("#ktalk").click(function(){
								   executeURLLink();
								  });
								  $("#kstory").click(function(){
								   executeKakaoStoryLink();
								  });
								});
								/*sns script*/
								
							//-->
							</script>