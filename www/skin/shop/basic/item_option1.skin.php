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
		funzione="Controlla('"+img2+"')";
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

<!-- ------------------------------------------------------------- [ 출력 - START ] ------------------------------------------------------------- -->

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

.shop_info_detail { width:100%; }
.shop_info_detail th { width:120px; text-align:left; }
.shop_info_detail td { width:260px; }
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
<input type="hidden" name="it_pay" value='0'>
<input type="hidden" name="option_total_amount_text" id="option_total_amount_text" value="<?=($view[it_opt_use2] == "1")?"0":$view[it_pay];?>" style="width:60px;border:0px;font-weight:bold;text-align:right;color:red;">
<input type="hidden" name="option_total_amount" id="option_total_amount" value="<?=($view[it_opt_use2] == "1")?"0":$view[it_pay];?>">


<!-- ------------------------------------------------------------- [ 상단 - START ] ------------------------------------------------------------- -->
<div class ="por float_l " style="width:100%; height:auto;">
	<!-- image 영역 -->
	<div class ="por float_l " style="width:350px; height:400px; text-align:center;">
		<div class="por  mla mra" style="width:300px; height:300px;">
			<table width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<!-- 큰이미지 -->
						<?=$view[m_img_1]?><?=$view[m_img_2]?><?=$view[m_img_3]?><?=$view[m_img_4]?>
					</td>
				</tr>
			</table>
		</div>
		<div class="por  mla mra mt10" style="width:300px; height:70px;">
			<table width="100%" height="100%">
				<tr>
					<td align="center" valign="middle">
						<!-- 작은이미지 -->
						<?=$view[s_img_1_resize]?> <?=$view[s_img_2_resize]?> <?=$view[s_img_3_resize]?> <?=$view[s_img_4_resize]?>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<!-- detail 영역 -->
	<div class ="por float_r" style="width:390px; height:auto;">
		
		<!-- 상품이름 -->
		<div class="por float_l mla mra" style="width:390px; height:50px; font-size:18px; font-weight:bold;"><?=$view[it_name]?> <?=$item_type?></div>

		<!-- 상품정보 -->
		<div class="por float_l mla mra mt10" style="width:390px; height:auto; min-height:250px;">
			<table class="shop_info_detail">
				<!-- 가격 -->
				<? if ($view[it_epay]) { ?>
				<tr>
					<th>정가</th>
					<td><span style="text-decoration:line-through"><?=number_format($view[it_opay])?></span>원</td>
				</tr>
				<tr>
					<th>할인가</th>
					<td><?=number_format($view[it_epay])?>원</td>
				</tr>
				<? } else { ?>
				<tr>
					<th>가격</th>
					<td><?=number_format($view[it_pay])?>원</td>
				</tr>
				<? } ?>

				<!-- 원산지 -->
				<tr>
					<th>원산지</th>
					<td><?=get_text($view[it_origin])?></td>
				</tr>

				<!-- 제조사 -->
				<tr>
					<th>제조사</th>
					<td><?=get_text($view[it_maker])?></td>
				</tr>

				<!-- 브랜드 -->
				<? if($view[it_brand]) { ?>
				<tr>
					<th>브랜드</th>
					<td><?=get_text($view[it_brand])?></td>
				</tr>
				<? } ?>
				
				<!-- 적립금 -->
				<? if ($GnShop[point_chk]) { ?>
				<tr>
					<th>적립금</th>
					<td><span style="font-weight:bold;">배송료를 제외한 결제금액의 <span style="color:#ff0000"><?=$GnShop[point_use]?></span>%</span></td>
				</tr>
				<? } ?>

				<?
				// 선택옵션 출력
				for ($i=1; $i<=$OpFlag; $i++) {
					if($view["it_opt{$i}_subject"]){
					?>
					<tr>
						<th><?=$view["it_opt{$i}_subject"]?></td>
						<td>
							<?=$view["it_opt{$i}"]?>
							<!-- 옵션 가격-->
							
							<!-- ################## [ 필수 코드 삭제 금지 - START ] ################## -->
							<input type="hidden" name="it_opt<?=$i?>_amount" id="it_opt<?=$i?>_amount" value="0">
							<input type="hidden" name="opt_no_array[<?=$i?>]" id="opt_no_array_<?=$i?>" value="0">
							<input type="hidden" name="opt_qty_array[<?=$i?>]" id="opt_qty_array_<?=$i?>" value="1"><!-- 단일옵션은 옵션수량 1로 고정 : 전체구매수량으로만판단 -->
							<!-- ################## [ 필수 코드 삭제 금지 - END ] ################## -->
						</td>
					</tr>
					<?
					}
				}
				?>

				<!-- 구매수량 -->
				<tr>
					<th>구매수량 : </th>
					<td>
						<select style="width:50px" name="ct_qty" id="ct_qty" onchange="amount_once_change(this.value)">
						<?for($i=1; $i < 11; $i++){?>
						<option value="<?=$i?>" <?=($i == 1)?"selected":"";?>><?=$i?></option>
						<? } ?>
						</select>
					</td>
				</tr>

				<!-- 총 상품금액 -->
				<tr>
					<td align="right" colspan="2">  총 상품금액: <span id="total_amount" style="width:60px;border:0px;font-weight:bold;text-align:right;color:red;"></span>원</td>
				</tr>
			
			</table>
		</div>

		<!-- 버튼 -->
		<div class="por float_l mla mra mt10" style="width:390px; height:50px; text-align:center;">
			<table style="width:390px; height:50px; text-align:center;">
				<tr>
					<td align="center" valign="bottom" style="font-size:0pt;">
						<img src="/images/shop/btn_direct.jpg" alt="바로구매" style="cursor:pointer; padding-right:2px;" onClick="fitemcheck(document.fitem, 'direct_buy');">
						<img src="/images/shop/btn_cart.jpg" alt="장바구니"  style="cursor:pointer; padding-right:2px;" onClick="fitemcheck(document.fitem, 'cart_update');">
						<img src="/images/shop/btn_wish.jpg" alt="위시리스트"  style="cursor:pointer;" onClick="item_wish(document.fitem, '<?=$it_id?>');">
					</td>
				</tr>
			</table>
		</div>
	
	</div>
	<!-- 상품정보 끝-->

</div>
<!-- detail 영역 끝-->
</form>


<!-- ------------------------------------------------------------- [ 하단 - START ] ------------------------------------------------------------- -->
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
	<? if($sitemenu["mn_shop_qna_use"]==1) { ?>
	<div class="mt55" ><img src="/images/shop/view_tab3.jpg"></div>
	<div class="mt30">
		<iframe  name="item_iframe2" id="item_iframe2" src='/bbs/board.php?tbl=shop_qna&shop_flag=ok&it_id=<?=$view[it_id]?>&it_name=<?=$view[it_name]?>&page_flag=guest' frameborder=0 width="100%" scrolling=no onload="autoResize('item_iframe2')"></iframe>
	</div>
	<? } ?>

	<!-- 사용후기 -->
	<? if($sitemenu["mn_shop_review_use"]==1) { ?>
	<div class="mt55" ><img src="/images/shop/view_tab4.jpg"></div>
	<div class="mt30">
		<iframe  name="item_iframe" id="item_iframe" src='/bbs/board.php?tbl=shop_review<?=($review_flag == "ok")?"&mode=WRITE":"";?>&shop_flag=ok&it_id=<?=$view[it_id]?>&review_flag=<?=$_GET[review_flag]?>&ct_id=<?=$_GET["ct_id"]?>' frameborder="0" width="100%" scrolling="no" onload="autoResize('item_iframe')"></iframe>
	</div>
	<? } ?>

</div>


<!-- ------------------------------------------------------------- [ 스크립트 - START ] ------------------------------------------------------------- -->
<script type="text/javascript">
var it_opt_use="<?=$view[it_opt_use]?>";
var option_max_add="<?=$option_max_add?>";
var basic_amount = parseInt('<?=$real_pay?>');
var basic_point  = parseInt('<?=$view[it_point]?>');

// 처음시작시 한번 실행
amount_change();

function amount_this_change(sel_op,sel_op_index)
{
	var option_index = sel_op_index;
	$.ajax({
	type:"POST",
	url:"/GnAjax/shop/php/op_amount.php",
	data: {
	itop_no: sel_op
	},

	// 옵션 출력 하기
	success:function(result) {
		$("#opt_no_array_"+option_index).attr("value",sel_op);		// 옵션 넘버히든
		$("#opt_qty_array_"+option_index).attr("value",1);			// 옵션 수량히든 ( 단일옵션의 경우 옵션수량은 1로 고정됨 : 나중을 위해 형식을 맞춰둠)
		$("#it_opt"+option_index+"_amount").attr("value",result);	// 옵션 가격 히든
		return_this_op_amount(result);	// 생성된 셀렉트 박스 출력
	}
	});

	/////////////옵션 ajax /////////////////////////////////////
}

function amount_change(sel_op)
{
	/////////////옵션 ajax /////////////////////////////////////
	<? if($view["it_opt1_subject"] != null and ($view["it_opt_use"]=="2" or $view["it_opt_use"]=="1")){
		?>
		sel_op = document.getElementById("it_opt1").value;
		<? }
	?>

	$.ajax({
	type:"POST",
	url:"/GnAjax/shop/php/op_amount.php",
	data: {
	itop_no: sel_op
	},

	// 옵션 출력 하기
	success:function(result) {
		return_op_amount(result);		// 생성된 셀렉트 박스 출력
	}
	});

	/////////////옵션 ajax /////////////////////////////////////
}
function return_this_op_amount(req) {
	var f = document.fitem;
	var result = req;
	var basic_amount = f.it_pay.value;
	var basic_original_amount = "<?=$real_pay?>";
	var option_count = "<?=$OpFlag?>";	//	단일 옵션용 옵션 수량 구하기

	if(!result) result = 0;
	else if(result == "+품절") {
		alert("품절입니다");
		result = 0;
	}
	
	/* ------------------------------------------------------------- [ 단일전용 - START ] ------------------------------------------------------------- */
	var select_opt_total_amount = 0;
	var this_option_amount = 0;
	for (var i=1; i <= option_count; i++) {
		this_option_str = $("#it_opt"+i+"_amount").attr("value");	//	+1000원 -1000원 이런식의 부호가 붙은 값이 들어온다.
		
		if (this_option_str == 0) {
			this_option_amount = 0;
		} else {
			this_option_amount = this_option_str;	// 옵션의 가격
		}
		
		// 옵션값 합계 만들기
		select_opt_total_amount = parseInt(select_opt_total_amount) + parseInt(this_option_amount);
	}

	amount = parseInt(basic_original_amount) + parseInt(select_opt_total_amount);		//	상품가격 + 옵션가
	/* ------------------------------------------------------------- [ 단일전용 - END ] ------------------------------------------------------------- */

	if(amount < 0){
		amount = 0;
	}
	var ct_qty = 0;
	if (typeof(f.ct_qty) != 'undefined')
		ct_qty = parseInt(f.ct_qty.value);
	var point  = basic_point;
	if (typeof(f.it_pay) != 'undefined')
		f.it_pay.value = amount;
	if (typeof(f.disp_sell_amount) != 'undefined'){
		f.disp_sell_amount.value = number_format(String(amount * ct_qty));
	}
	
	t_amount = number_format(amount * ct_qty);
	$("#total_amount").html(t_amount);
}

function return_op_amount(req) {
	var f = document.fitem;
	var result = req;

	if(!result) result = 0;
	else if(result == "+품절") {
		alert("품절입니다");
		result = 0;
	}
	amount = basic_amount + parseInt(result);
	var ct_qty = 0;
	if (typeof(f.ct_qty) != 'undefined')
		ct_qty = parseInt(f.ct_qty.value);
	var point  = basic_point;
	if (typeof(f.it_pay) != 'undefined')
		f.it_pay.value = amount;
	if (typeof(f.disp_sell_amount) != 'undefined'){
		f.disp_sell_amount.value = number_format(String(amount * ct_qty));
	}
	document.getElementById("total_amount").innerHTML= number_format(String(amount * ct_qty));
}

function amount_once_change(qty){
	var f = document.fitem;
	var price_amount = f.it_pay.value;
	var result_amount = parseInt(price_amount) * parseInt(qty);
	document.fitem.price_amount.value = result_amount;
	document.getElementById("total_amount").innerHTML= number_format(String(result_amount));
}


/* ////////////////////////////////  바로구매 또는 장바구니 담기  ////////////////////////////////  */
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

/* ////////////////////////////////  위시리스트  ////////////////////////////////  */
function item_wish(f, it_id)
{
	f.url.value = "/shop/wish_update.php?it_id="+it_id;
	f.action = "./wish_update.php";
	f.submit();
}


function autoResize(id){
	var newheight;
	if(document.getElementById){
		newheight = $("#"+id).contents().find("#mainContent").height();
		newheight = 5+newheight;	// 버튼들이 짤려나와 세로길이를 조금더 추가 했다.
	}
	document.getElementById(id).height= (newheight) + "px";
	//$("#"+id).height(newheight);
}

function imgResize() 
{ 
    // DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌 
    maxsize = 760; // 가로사이즈 ( 다른값으로 지정하면됨) 
    var content = document.getElementById("DivContents"); 
    var img = content.getElementsByTagName("img"); 
    for(i=0; i<img.length; i++) 
    { 

        if ( eval('img[' + i + '].width > maxsize') ) 
        { 
            var heightSize = ( eval('img[' + i + '].height')*maxsize )/eval('img[' + i + '].width') ; 
            eval('img[' + i + '].width = maxsize') ; 
            eval('img[' + i + '].height = heightSize') ; 
        } 
    } 
} 
window.onload=function() {
	imgResize();
}
</script>



