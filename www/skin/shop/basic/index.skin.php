<?
	//include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
    include_once $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";
	###################### 이곳에 값을 수정하세요 ##########################
	// main_type(스킨이름, 타입, 몇개씩, 몇줄, 이미지가로, 이미지세로, 카테고리코드);
	$nowitem			= main_type('basic', 1, 3, 1, 120, 100,'');
	$bestitem			= main_type('basic', 2, 3, 1, 120, 100,'');
	$pointitem			= main_type('basic', 3, 3, 1, 120, 100,'');
	$hititem			= main_type('basic', 4, 5, 1, 120, 100,'');
	$hititem5			= main_type('basic', 4, 5, 1, 120, 100,'',5);
	$prstitem			= main_type('basic', 5, 3, 1, 120, 100,'');
	
	//브랜드 출력 print_brand(스킨, 타입("rand"/""), 몇개);
	//$print_brand = print_brand("", "", "");
	###############################################################
?>

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
<!---탭 게시판--------->
<script language="javascript">
<!--
function DisplaySpecial(index) {
for (i=1; i<=2; i++)
	if (index == i) {
		thisMenu = eval("special" + index + ".style");
		thisMenu.display = "";
	}else {
		otherMenu = eval("special" + i + ".style");
		otherMenu.display = "none";
	}
}

function DisplayMenu(index) {
for (i=1; i<=2; i++)
	if (index == i) {
		thisMenu = eval("menu" + index + ".style");
		thisMenu.display = "";
	}else {
		otherMenu = eval("menu" + i + ".style");
		otherMenu.display = "none";
	}
}
-->
</script>

<?	include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="670" height="175">
      <param name="movie" value="../../../flash/e-shop.swf" />
      <param name="quality" value="high" />
      <embed src="../../../flash/e-shop.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="670" height="175"></embed>
    </object></td>
  </tr>
  <tr>
    <td><img src="/images/shop/shop_title.jpg" width="670" height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="690" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="/images/shop/title_best.jpg" width="148" height="59"></td>
      </tr>
      <tr>
        <td><?=main_type('basic', '1', 3, 1, 120, 100,'');?></td>
      </tr>
	  <tr>
	  	<td>&nbsp;</td>
	</tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="/images/shop/shop_banner.jpg" width="670" height="949"></td>
  </tr>
</table>

<?	include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>