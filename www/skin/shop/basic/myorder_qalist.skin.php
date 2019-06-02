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
	<td><table width="100%" cellpadding="0" cellspacing="0">
		<tr>
		<td width="50%"><img src="/images/shop/cart_t.jpg" alt="나의상품문의이미지타이틀" /></td>
		<td width="50%" valign="bottom" align="right" style="font-size:11px; color:#727272;">HOME > 마이페이지 > <b>나의상품문의</b></td>
		</tr>
		</table></td>
</tr>
<tr> 
	<td height="7"></td>
</tr>
<tr> 
	<td>

<!-- 상품문의 start -->	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td height="2" colspan="7" bgcolor="#DBDBDB"> </td>
	</tr>
	<tr bgcolor="#F9F9F9" align="center"> 
		<td width="80" height="30"></td>
		<td width="200">상품명</td>
		<td width="300">제목</td>
		<td width="150">등록일</td>
	</tr>
	<tr bgcolor="#EEEEEE"> 
		<td height="1" colspan="7"> </td>
	</tr>
<?
	for ($i=0; $qa[$i][iq_subject]; $i++) {
?>
	<tr align="center" bgcolor="#FFFFFF">
		<td height="75"><a href="/shop/item.php?it_id=<?=$qa[$i][it_id]?>"><?=img_resize_tag("/shop/data/item/{$qa[$i][it_id]}_s", 65, 65)?></a></td>
		<td align="left"><strong><a href="/shop/item.php?it_id=<?=$qa[$i][it_id]?>"><?=$qa[$i][name]?></a></strong></td>
		<td align="left"><strong><a href='javascript:;' onclick="menu('iq<?=$i?>')"><?=$qa[$i][iq_subject]?></a></strong></td>
		<td><strong><?=$qa[$i][iq_time]?></strong></td>
	</tr>
	<tr bgcolor="#F9F9F9"> 
		<td colspan="7" style="padding:10px">
		<div id='iq<?=$i?>' style='display:none;'> 
			질문 : <?=$qa[$i][iq_question]?>
			<br>
			<?
				if ($qa[$i][iq_answer]) {
					echo "답변 : ".$qa[$i][iq_answer];
				}
			?>
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
