<script language="JavaScript">
<!--
//팝업시 원본크기로 s
function pop_imgResize(img2){
	poto=new Image();
	poto.src=(img2);
	Controlla(img2);
}
function Controlla(img2){
	if((poto.width!=0)&&(poto.height!=0)){
		winopen(img2,poto.width,poto.height);
	}
	else{
		funzione="Controll('"+img2+"')";
		intervallo=setTimeout(funzione,20);
	}
}
function winopen(img_view,Width,Height){
	var winHandle=window.open("","windowName","toolbar=no,scrollbars=auto,resizable=no,top=200,left=200,width="+Width+",height="+Height);
	if (winHandle !=null) {
		var htmlString="<html><head><title>이미지 미리보기</title></head>"
		htmlString+="<body topmargin=0 leftmargin=0>"
		htmlString+="<a href=javascript:window.close()><img src="+img_view+" border=0 alt=이미지클릭:화면닫기></a>"
		htmlString+="</body></html>";
		winHandle.document.open()
		winHandle.document.write(htmlString)
		winHandle.document.close()
	}
	if(winHandle!=null) winHandle.focus()
		return winHandle
}
//팝업시 원본크기로 e
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
function swapObj(id,i){
	for (var i = 0; i < 4; i++){
		obj = document.getElementById("photo_"+i).style;
		obj.display = "none";
	}
	obj = document.getElementById("photo_"+id).style;
	obj.display = "";
}

function MM_swapImgRestore() {//v3.0
  var i,x,a=document.MM_sr;for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() {//v3.0
  var d=document;if(d.images){if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments;for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){d.MM_p[j]=new Image;d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) {//v4.01
  var p,i,x;if(!d) d=document;if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document;n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n];for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n);return x;
}
function MM_swapImage() {//v3.0
  var i,j=0,x,a=MM_swapImage.arguments;document.MM_sr=new Array;for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x;if(!x.oSrc) x.oSrc=x.src;x.src=a[i+2];}
}
//-->
</script>

<table width="700" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="717">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#990033">
    <tr>
    <td width="300" align="center" valign="top" style="background:url(../../../images/product_bg.jpg) right top no-repeat;">

      <table width="258" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <!-- 이미지 -->
      <td>
        <table cellpadding="0" cellspacing="0">
        <tr>
        <td>
          <table width="260" height="260" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
          <tr>
          <td align="center"><?=$view[m_img_1]?><?=$view[m_img_2]?><?=$view[m_img_3]?><?=$view[m_img_4]?></td>
          </tr>
          </table>
        </td>
        </tr>
        <tr>
        <td height="10px"></td>
        </tr>
        <tr>
        <td>
          <table height="66" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
          <tr>
          <td align="center" width="64"><?=$view[s_img_1_resize]?></td>
          <td align="center" width="64"><?=$view[s_img_2_resize]?></td>
          <td align="center" width="64"><?=$view[s_img_3_resize]?></td>
          <td align="center" width="64"><?=$view[s_img_4_resize]?></td>
          </tr>
          </table>
        </td>
        </tr>
        </table>
      </td>
      <!-- //이미지 -->
      </tr>
      <!--
	  <tr>
	  <td align="right"><img src="<?=$GnShop["skin_url"]?>/images/view_big_btn.gif" border="0" <?=$bigimg_link?>></td>
	  </tr>
	  -->
      </table>

    </td>
    <td width="384" align="right" >

      <table width="367" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td height="40" colspan="2"><strong><font color="4d4d4d" style="font-size:16px; text-decoration:underline;"><?=$view[it_name]?> <?=$item_type?></font></strong> </td>
      </tr>
      <tr>
      <td colspan="2" height="10"></td>
      </tr>
      <tr>
      <td ><b>·</b>&nbsp;항목1</td>
      <td>: <?=get_text($view[it_ex1])?></td>
      </tr>
      <tr>
      <td ><b>·</b>&nbsp;항목2</td>
      <td>: <?=get_text($view[it_ex2])?></td>
      </tr>
      <tr>
      <td ><b>·</b>&nbsp;항목3</td>
      <td>: <?=get_text($view[it_ex3])?></td>
      </tr>
      <tr bgcolor="#F2F5F9">
      <td width="115" bgcolor="#FFFFFF"><b>·</b>&nbsp;가격</td>
      <td width="252" bgcolor="#FFFFFF">
        : <strong><font color="#9d6363">
        <?=number_format($view[it_pay])?>
        원</font></strong>
      </td>
      </tr>
	  </table>
  </td>
  </tr>
  </table>

</td>
</tr>
<tr>
<td height="25">&nbsp;</td>
</tr>
<tr>
<td>

<tr><td ><a name="1"></a></td></tr>
<tr>
<td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td height="17"><img src="" alt="상세정보"></td>
  </tr>
  <tr>
  <td height="8"></td>
  </tr>
  <tr>
  <td style=" border:0px solid #000000">
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
<td style="padding-top:50px;" align="center"><a href="./list.php?ca_id=<?=$ca_id?>"><img src="/btn/btn_list.gif"></a></td>
</tr>
</table>
</td>
</tr>
</table>