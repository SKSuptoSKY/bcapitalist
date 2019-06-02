<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function swapObj(id,i)
{
		  for (var i = 0; i < 4; i++)
{
	obj = eval("photo_"+i+".style");
		 obj.display = "none";
}
obj = eval("photo_"+id+".style");
obj.display = "";
}
// -->
</script>
<table width="700" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
		<td width="50%"><img src="/images/shop/cart_t.jpg" alt="나의상품후기이미지타이틀" /></td>
		<td width="50%" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME > 마이페이지 > <b>나의상품후기</b></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td height="7"></td>
</tr>
<tr>
	<td>
<!-- 상품문의 start -->
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="2" colspan="7" bgcolor="#DBDBDB"> </td>
	</tr>
	<tr bgcolor="#F9F9F9" align="center">
		<td width="80" height="30"><strong></strong></td>
		<td width="200"><strong>상품명</strong></td>
		<td width="300"><strong>제목</strong></td>
		<td width="80"><strong>별점</strong></td>
		<!--td width="50" height="30"><strong>상태</strong></td-->
		<td width="150"><strong>등록일</strong></td>
	</tr>
	<tr bgcolor="#EEEEEE">
		<td height="1" colspan="7"> </td>
	</tr>
<?
	for ($i=0; $ps[$i][is_subject]; $i++) {
?>
	<tr align="center" bgcolor="#FFFFFF">
		<td height="75"><a href="/shop/item.php?it_id=<?=$ps[$i][it_id]?>"><?=img_resize_tag("/shop/data/item/{$ps[$i][it_id]}_s", 70, 58)?></a></td>
		<td><strong><a href="/shop/item.php?it_id=<?=$ps[$i][it_id]?>"><?=$ps[$i][name]?></a></strong></td>
		<td align="left"><strong><a href='javascript:;' onclick="menu('iq<?=$i?>')"><?=$ps[$i][is_subject]?></a></strong></td>
		<td><img src='<?=$GnShop["skin_url"]?>/images/star<?=$ps[$i][star]?>.gif' border=0 align=absmiddle></td>
		<!--td align="left"><strong><?=$ps[$i][is_confirm]?></strong></td-->
		<td><strong><?=$ps[$i][time]?></strong></td>
	</tr>
	<tr bgcolor="#F9F9F9">
		<td colspan="7" style="padding:10px">
		<div id='iq<?=$i?>' style='display:none;'>
			<?=$ps[$i][is_content]?>
		</dir>
		</td>
	</tr>
	<tr bgcolor="#EEEEEE">
		<td height="1" colspan="7"> </td>
	</tr>
<?
	}
	if($i<1) {
?>
	<tr onMouseOver="this.style.backgroundColor='#F5F5F5'" onMouseOut="this.style.backgroundColor=''">
		<td height="30" colspan="7" align="center">
			<img src="/member/images/none_img.gif" width="49" height="37" align="absmiddle"> 등록된 내용이 없습니다.
	  </td>
	</tr>
<? } ?>
	<tr bgcolor="#EEEEEE">
		<td height="1" colspan="7"> </td>
	</tr>
</table>
<!-- 상품문의 end -->

</td>
  </tr>
  <tr>
    <td align=center><?=get_paging($default[de_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
  </tr>
</table>





	</td>
  </tr>
</table>
