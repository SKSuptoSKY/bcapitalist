<script language="JavaScript">
<!--
//팝업시 원본크기로 s
function imgResize(img2){
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
	if (name.style.display == 'none') {
		// 안보이면 보이게 하고
		name.style.display = 'block';
	}
	else {
		// 보이면 안보이게 하고
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

function MM_swapImgRestore() {
	//v3.0
	var i,x,a=document.MM_sr;
	for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() {
	//v3.0
	var d=document;
	if(d.images){
		if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments;
		for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){
				d.MM_p[j]=new Image;
			d.MM_p[j++].src=a[i];
		}
	}
}
function MM_findObj(n, d) {
	//v4.01
	var p,i,x;
	if(!d) d=document;
	if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document;
		n=n.substring(0,p);
	}
	if(!(x=d[n])&&d.all) x=d.all[n];
	for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		if(!x && d.getElementById) x=d.getElementById(n);
		return x;
}
function MM_swapImage() {
	//v3.0
	var i,j=0,x,a=MM_swapImage.arguments;
	document.MM_sr=new Array;
	for(i=0;i<(a.length-2);i+=3)
		if ((x=MM_findObj(a[i]))!=null){
			document.MM_sr[j++]=x;
		if(!x.oSrc) x.oSrc=x.src;
		x.src=a[i+2];
	}
}
//-->
</script>


<style type="text/css">
.por { position:relative; }
.poa { position:absolute; }
.bor { border:1px solid red; }
.bog { border:1px solid green; }
.bob { border:1px solid blue; }
.float_l { float:left; }
.float_r { float:right; }
.text_l { text-align:left; }
.text_r { text-align:right; }
.text_c { text-align:center; }
.mla { margin-left:auto; }
.mra { margin-right:auto; }
</style>


<form name="fitem"  Method="post" action="./shopbag_update.php" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<input type="hidden" name="it_point" value="<?=$view[it_point]?>">
<input type="hidden" name="it_name" value="<?=$view[it_name]?>">
<input type="hidden" name="sw_direct" value=''>
<input type="hidden" name="url" value=''>
<input type="hidden" name="it_opt_use" value="<?=$view[it_opt_use]?>">
<input type="hidden" name="it_opt_use2" id="it_opt_use2" value="<?=$view[it_opt_use2]?>">
<input type="hidden" name="in_inx" value="0">
<input type="hidden" name="op_num_flag">
<input type="hidden" name="price_amount" value="<?=$view[it_pay]?>">
<input type="hidden" name="op_amount" value="0">
<input type="hidden" id="it_pay" name="it_pay" value="<?=$view[it_pay]?>">
<input type="hidden" name="disp_sell_amount" value="<?=number_format($view[it_pay])?>">

<!-- ------------------------------------------------------------- [ div - START ] ------------------------------------------------------------- -->
<div class ="por float_l " style="width:100%; height:auto;">
	<!-- image 영역 -->
	<div class ="por float_l " style="width:350px; height:400px; text-align:center;">
		<div class="por  mla mra" style="width:300px; height:300px;">
			<table width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<!-- 큰이미지 -->
						<?=$view[bimg1]?><?=$view[bimg2]?><?=$view[bimg3]?><?=$view[bimg4]?>
					</td>
				</tr>
			</table>
		</div>
		<div class="por  mla mra mt10" style="width:300px; height:70px;">
			<table width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<!-- 작은이미지 -->
						<?=$view[simg1]?> <?=$view[simg2]?> <?=$view[simg3]?> <?=$view[simg4]?>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- detail 영역 -->
	<div class ="por float_r" style="width:390px; height:auto;">
		
		<!-- 상품이름 -->
		<div class="por float_l mla mra bob" style="width:390px; height:50px;"><?=$view[it_name]?> <?=$item_type?></div>

		<!-- 상품정보 -->
		<div class="por float_l mla mra mt10 bog" style="width:390px; height:auto; min-height:150px;">
			
			<!-- 가격 -->
			<? if ($aaaaaa) { ?>
				<div class="por float_l" style="width:120px; height:20px;">정가</div>
				<div class="por float_l" style="width:260px; height:20px;">
					<span style="text-decoration:line-through"><?=number_format($aaaaaa)?></span>원
				</div>
				<div class="por float_l" style="width:120px; height:20px;">할인가</div>
				<div class="por float_l" style="width:260px; height:20px;"><?=number_format($view[it_pay])?>원</div>
			<? } else { ?>
				<div class="por float_l" style="width:120px; height:20px;">가격</div>
				<div class="por float_l" style="width:260px; height:20px;"><?=number_format($view[it_pay])?>원</div>
			<? } ?>

			<!-- 원산지 -->
			<div class="por float_l" style="width:120px; height:20px;">원산지</div>
			<div class="por float_l" style="width:260px; height:20px;"><?=get_text($view[it_origin])?></div>
			
			<!-- 제조사 -->
			<div class="por float_l" style="width:120px; height:20px;">제조사</div>
			<div class="por float_l" style="width:260px; height:20px;"><?=get_text($view[it_maker])?></div>
	
			<!-- 브랜드 -->
			<? if($view[it_brand]) { ?>
			<div class="por float_l" style="width:120px; height:20px;">브랜드</div>
			<div class="por float_l" style="width:260px; height:20px;"><?=get_text($view[it_brand])?></div>
			<? } ?>
			
			<!-- 적립금 -->
			<? if ($GnShop[point_chk]) { ?>
			<div class="por float_l" style="width:120px;">적립금</div>
			<div class="por float_l" style="width:260px;"><span style="font-weight:bold;">배송료를 제외한 결제금액의 <span style="color:#ff0000"><?=$GnShop[point_use]?></span>%</span></div>
			<? } ?>

		</div>

		<!-- 구매수량 -->
		<div class="por float_l mla mra mt10 bob" style="width:390px; height:50px;">
			<div class="por float_l " style="width:120px; height:20px;">구매수량 : </div>
			<div class="por float_l " style="width:260px; height:20px;">
				<select style="width:50px" name="ct_qty" id="ct_qty" onchange="change_qty(this.value)">
				<?for($i=1; $i < 11; $i++){?>
				<option value="<?=$i?>" <?=($i == 1)?"selected":"";?>><?=$i?></option>
				<? } ?>
				</select>
			</div>
		</div>

		<!-- 총 상품 금액 -->
		<div class="por float_l mla mra mt10 bor" style="width:390px; height:50px;">
			총 상품금액: <span id="total_amount" style="width:60px;border:0px;font-weight:bold;text-align:right;color:red;"><?=number_format($real_pay)?></span>원
		</div>
		
		<!-- 버튼 -->
		<div class="por float_l mla mra mt10 bog" style="width:390px; height:50px;">
			<img src="/images/shop/btn_direct.jpg" alt="바로구매" style="cursor:pointer; padding-right:2px;" onClick="fitemcheck(document.fitem, 'direct_buy');">
			<img src="/images/shop/btn_cart.jpg" alt="장바구니"  style="cursor:pointer; padding-right:2px;" onClick="fitemcheck(document.fitem, 'cart_update');">
			<img src="/images/shop/btn_wish.jpg" alt="위시리스트"  style="cursor:pointer;" onClick="item_wish(document.fitem, '<?=$it_id?>');">
		</div>
	
	</div>
</div>
</form>


<!-- ------------------------------------------------------------- [ 기존 - START ] ------------------------------------------------------------- -->
<div class ="por float_l mt10" style="width:100%; height:auto;">

	<!-- 제품상세설명 -->
	<div class="mt50" ><img src="/images/shop/view_tab1.jpg"></div>
	<div class="mt30">
		<div id="DivContents">
			<? if($view[it_explan]) { echo  $view[it_explan]; } else { echo "입력된 자료가 없습니다."; } ?>
		</div>
	</div>

	<!-- 교환 및 환불규정 -->
	<div class="mt55" ><img src="/images/shop/view_tab2.jpg"></div>
	<div class="mt30"><? if($GnShop[explan_chan])  { echo $GnShop[explan_chan]; } else { echo "입력된 자료가 없습니다."; } ?></div>

	<!-- Q&A -->
	<div class="mt55" ><img src="/images/shop/view_tab3.jpg"></div>
	<div class="mt30">
		<iframe  name="item_iframe2" id="item_iframe2" src='/bbs/board.php?tbl=shop_qna&shop_flag=ok&it_id=<?=$view[it_id]?>&it_name=<?=$view[it_name]?>&page_flag=guest' frameborder=0 width="100%" scrolling=no onload="autoResize('item_iframe2')"></iframe>
	</div>

	<!-- 사용후기 -->
	<div class="mt55" ><img src="/images/shop/view_tab4.jpg"></div>
	<div class="mt30">
		<iframe  name="item_iframe" id="item_iframe" src='/bbs/board.php?tbl=shop_review<?=($review_flag == "ok")?"&mode=WRITE":"";?>&shop_flag=ok&it_id=<?=$it_id?>&review_flag=<?=$_GET[review_flag]?>&ct_id=<?=$_GET["ct_id"]?>' frameborder="0" width="100%" scrolling="no" onload="autoResize('item_iframe')"></iframe>
	</div>

</div>
<!-- ------------------------------------------------------------- [ 스크립트 - START ] ------------------------------------------------------------- -->
<script type="text/javascript">
var basic_amount = parseInt('<?=$real_pay?>');

// 수량변경
function change_qty(value){ 
	var this_qty = value;
	var total_amount = basic_amount * this_qty;
	var show_total_amount = number_format(total_amount);
	$("#it_pay").attr("value",total_amount);
	$("#total_amount").html(show_total_amount);
}

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
	if (f.it_pay.value <= 0) {
		alert("총 상품 금액이 0원 입니다");
		return false;
	}

	if(document.fitem.it_opt_use2.value==1){
		for (i=1; i<=6; i++) {
			if (typeof(f.elements["it_opt"+i]) == 'object') {


				if (f.elements["it_opt"+i].value == "" && f.option_total_amount.value=="0") {


					alert(f.elements["it_opt"+i+"_subject"].value + '을(를) 선택해 주십시오.');
					f.elements["it_opt"+i].focus();
					return false;
				}
			}
		}
		if(document.fitem.option_total_amount.value==0){
			var j = 1;
			alert(f.elements["it_opt"+j+"_subject"].value + '을(를) 선택해 주십시오.');
			return false;
		}
	}

	if (act == "direct_buy") {
		f.sw_direct.value = 1;
	}
	else {
		f.sw_direct.value = 0;
	}
	if (!f.ct_qty.value) {
		alert("수량을 입력해 주십시오.");
		f.ct_qty.focus();
		return false;
	}
	else if (isNaN(f.ct_qty.value)) {
		alert("수량을 숫자로 입력해 주십시오.");
		f.ct_qty.select();
		f.ct_qty.focus();
		return false;
	}
	else if (parseInt(f.ct_qty.value) < 1) {
		alert("수량은 1 이상 입력해 주십시오.");
		f.ct_qty.focus();
		return false;
	}
	f.submit();
}

function autoResize(id){
	var newheight;
	if(document.getElementById){
		newheight = $("#"+id).contents().find("#mainContent").height();
		newheight = 5+newheight;	// 버튼들이 짤려나와 세로길이를 조금더 추가 했다.
	}

	document.getElementById(id).height= (newheight) + "px";
}
</script>
