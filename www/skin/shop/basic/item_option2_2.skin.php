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
<input type="hidden" name="ct_qty" id="ct_qty" value="1"> <!-- 구매수량 : 옵션가에 원가포함 -> 원가포함시 옵션가에 원가 포함되기때문에 본제품 수량이 필요없다 -->
<input type="hidden" name="total_amount" id="total_amount" value="">

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
						<td><?=$view["it_opt{$i}"]?></td>
					</tr>
					<?
					}
				}
				?>

				<!-- 총 상품금액 -->				
				<tr>
					<td colspan="2">
						<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#dddddd" style="border-collapse:collapse;">
							<tr>
								<td>
									<table width="100%" border="0" cellpadding="5" cellspacing="0" id="addTable">
										<col />
										<col width="45" />
										<col width="80" />
										<col width="10" />
										<tr>
											<td style="padding:8px" height="30" align="right" colspan="4">
												총 상품금액: 
												<input type="text" name="option_total_amount_text" id="option_total_amount_text" value="<?=($view[it_opt_use2] == "1")?"0":$view[it_pay];?>" style="width:60px;border:0px;font-weight:bold;text-align:right;color:red;">
												<input type="hidden" name="option_total_amount" id="option_total_amount" value="<?=($view[it_opt_use2] == "1")?"0":$view[it_pay];?>" >
												원 
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
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

function amount_this_change(sel_op)
{

	$.ajax({
	type:"POST",
	url:"/GnAjax/shop/php/op_amount.php",
	data: {
	itop_no: sel_op
	},

	// 옵션 출력 하기
	success:function(result) {
	return_this_op_amount(result);		// 생성된 셀렉트 박스 출력
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
	if(!result) result = 0;
	else if(result == "+품절") {
		alert("품절입니다");
		result = 0;
	}
	amount = parseInt(basic_amount) + parseInt(result);
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
	document.getElementById("total_amount").innerHTML= number_format(String(amount * ct_qty));
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

function amount_change2(qty){
	var price_amount = "<?=$real_pay?>";
	var result_amount = parseInt(price_amount) * parseInt(qty);
	document.fitem.price_amount.value = result_amount;
	input_tot_amount(result_amount,"");
}

function amount_once_change(qty){
	var f = document.fitem;
	var price_amount = f.it_pay.value;
	var result_amount = parseInt(price_amount) * parseInt(qty);
	document.fitem.price_amount.value = result_amount;
	document.getElementById("total_amount").innerHTML= number_format(String(result_amount));
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

//다중구입옵션s
function add_option(sel_op) {

	//다중옵션 셀렉
	//if(!sel_op) return false;  //추가 (옵션 value 값이 없을때 스크립트 실행시 오류 막아준다)
	var default_amount = "<?=$real_pay?>";
	var op_num_flag = document.fitem.op_num_flag.value; //중복체크를 위한
	if(op_num_flag != "") {
		var ex_op_num_flag = op_num_flag.split("|");
		for(i=0; i < ex_op_num_flag.length; i++){
			if(ex_op_num_flag[i] == sel_op) {
				alert("이미 선택되어있는 옵션입니다");
				return false;
			}
		}
	}

	$.ajax({
	type:"POST",
	url:"/GnAjax/shop/php/add_option.php",
	data: {
	itop_no: sel_op
	},
	// 옵션 출력 하기
	success:function(result) {
	return_add_option(result);		// 생성된 셀렉트 박스 출력
	}
	});
}

function return_add_option(req){
	var option_amount = document.fitem.op_amount.value;
	/*추가*/
	var default_amount = "<?=$real_pay?>";
	/**/

	var result = req;
	if(result == "품절") {
		alert("선택하신 옵션은 품절입니다");
		return false;
	}
	else {
		var result_val = result.split("|");
	}

	var oTbl = document.getElementById("addTable");
	var add_inx = document.fitem.in_inx.value;
	var total_amount = document.fitem.option_total_amount.value;

	var r_inx = add_inx;

	var oRow = oTbl.insertRow(r_inx);
	oRow.onmouseover=function(){
		oTbl.clickedRowIndex=this.rowIndex}
	;


	if ((navigator.appName).indexOf("Microsoft")!=-1) {
		var oCell1 = oRow.insertCell();
		var oCell2 = oRow.insertCell();
		var oCell3 = oRow.insertCell();
		var oCell4 = oRow.insertCell();
	}
	else{
		var oCell1 = oRow.insertCell();
		var oCell2 = oRow.insertCell();
		var oCell3 = oRow.insertCell();
		var oCell4 = oRow.insertCell();
	}

	var result1="";
	var result2="";
	var result3="";
	var result4="";
	
	// 옵션 수량 화살표 위치 제대로 나오게 수정 -mj
	result1 = result_val[0]+"<input type='hidden' name='option_no"+result_val[0]+"' id='option_no"+result_val[0]+"' value='"+result_val[2]+"'><input type='hidden' name='itop_no[]' value='"+result_val[2]+"'>";
	result2 ="<table border='0' cellpadding='0' cellspacing='0'>";
	result2 +="<tr height='30px'>";
	result2 +="<td style='padding-right:5px;vertical-align:middle;' ><input type='text' name='option_qty[]' id='option_qty"+result_val[2]+"' size='1' value='1' style='width:25px;border:0px;text-align:right;'  readonly></td>";
	result2 +="<td style='vertical-align:middle;'>";
	result2 +="<table border='0' cellpadding='0' cellspacing='0'>";
	result2 +="<tr>";
	result2 +="<td height='7' valign='top'>";
	result2 +="<div style='width:50px; height:22px; position:relative; text-align:left;'>";
	result2 += "<img src='/shop/img/btn_up.gif' onclick=\"option_cal('option_qty"+result_val[2]+"','option_amount"+result_val[2]+"','option_txt_amount"+result_val[2]+"','"+result_val[3]+"','p','"+result_val[1]+"','"+result_val[5]+"')\" style='cursor:pointer; position:absolute; top:1px; padding:0px margin:0px;' alt='+'>";
	result2 += "<img src='/shop/img/btn_down.gif' onclick=\"option_cal('option_qty"+result_val[2]+"','option_amount"+result_val[2]+"','option_txt_amount"+result_val[2]+"','"+result_val[3]+"','m','"+result_val[1]+"','"+result_val[5]+"')\" style='cursor:pointer; position:absolute; top:11px; padding:0px margin:0px;' alt='-'>";
	result2 +="</div>";
	result2 +="</td>";
	result2 +="</tr>";
	result2 +="</table>";
	result2 +="</td>";
	result2 +="<td style='padding-left:5px;vertical-align:middle;'>개</td>";
	result2 +="</tr>";
	result2 +="</table>";
	//result3 ="<input type='text' name='option_amount"+result_val[2]+"' id='option_amount"+result_val[2]+"' value='"+number_format(String(parseInt(result_val[3])))+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	result3 ="<input type='hidden' name='option_amount"+result_val[2]+"' id='option_amount"+result_val[2]+"' value='"+parseInt(result_val[3])+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly><input type='text' name='option_txt_amount"+result_val[2]+"' id='option_txt_amount"+result_val[2]+"' value='"+number_format(String(parseInt(result_val[3])))+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	//result3 ="<input type='hidden' name='option_amount_text"+result_val[2]+"' id='option_amount_text"+result_val[2]+"' value='"+parseInt(result_val[3])+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	result4 ="<img src='/shop/img/btn_close.gif' alt='삭제' onclick=\"removeRow()\" align='absmiddle' style='cursor:pointer;'>";


	/* 옵션 방향 화살표가 위로 달라붙고 정렬이 제대로 안되는 문제
	result1 = result_val[0]+"<input type='hidden' name='option_no"+result_val[0]+"' id='option_no"+result_val[0]+"' value='"+result_val[2]+"'><input type='hidden' name='itop_no[]' value='"+result_val[2]+"'>";
	result2 ="<table border='0' cellpadding='0' cellspacing='0'>";
	result2 +="<tr height='30px'>";
	result2 +="<td style='padding-right:5px;vertical-align:middle;' ><input type='text' name='option_qty[]' id='option_qty"+result_val[2]+"' size='1' value='1' style='width:25px;border:0px;text-align:right;'  readonly></td>";
	result2 +="<td style='vertical-align:middle;'>";
	result2 +="<table border='0' cellpadding='0' cellspacing='0'>";
	result2 +="<tr>";
	result2 +="<td height='10' valign='top'><img src='/shop/img/btn_up.gif' onclick=\"option_cal('option_qty"+result_val[2]+"','option_amount"+result_val[2]+"','option_txt_amount"+result_val[2]+"','"+result_val[3]+"','p','"+result_val[1]+"','"+result_val[5]+"')\" alt='+'></td>";
	result2 +="</tr>";
	result2 +="<tr>";
	result2 +="<td height='10' valign='bottom'><img src='/shop/img/btn_down.gif' onclick=\"option_cal('option_qty"+result_val[2]+"','option_amount"+result_val[2]+"','option_txt_amount"+result_val[2]+"','"+result_val[3]+"','m','"+result_val[1]+"','"+result_val[5]+"')\" alt='-'></td>";
	result2 +="</tr>";
	result2 +="</table>";
	result2 +="</td>";
	result2 +="<td style='padding-left:5px;vertical-align:middle;'>개</td>";
	result2 +="</tr>";
	result2 +="</table>";
	//result3 ="<input type='text' name='option_amount"+result_val[2]+"' id='option_amount"+result_val[2]+"' value='"+number_format(String(parseInt(result_val[3])))+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	result3 ="<input type='hidden' name='option_amount"+result_val[2]+"' id='option_amount"+result_val[2]+"' value='"+parseInt(result_val[3])+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly><input type='text' name='option_txt_amount"+result_val[2]+"' id='option_txt_amount"+result_val[2]+"' value='"+number_format(String(parseInt(result_val[3])))+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	//result3 ="<input type='hidden' name='option_amount_text"+result_val[2]+"' id='option_amount_text"+result_val[2]+"' value='"+parseInt(result_val[3])+"' style='width:60px;border:0px;font-weight:bold;text-align:right;' readonly> 원";
	result4 ="<img src='/shop/img/btn_close.gif' alt='삭제' onclick=\"removeRow()\" align='absmiddle' style='cursor:pointer;'>";
	*/

	if ((navigator.appName).indexOf("Microsoft")!=-1) {

		oCell4.innerHTML=result4;
		oCell3.innerHTML=result3;
		oCell2.innerHTML=result2;
		oCell1.innerHTML=result1;
	}
	else{
		oCell1.innerHTML=result1;
		oCell2.innerHTML=result2;
		oCell3.innerHTML=result3;
		oCell4.innerHTML=result4;
	}

	add_inx++;
	document.fitem.in_inx.value = add_inx;
	if(document.getElementById("it_opt_use2").value == 1){
		//다중 옵션 원가 포함 처리시 확인해야할 부분
		<? if($view[packing_option] == "Y"){
			?> it_add_opt2 = document.getElementById("packing_option").value;
			<? }
		?>
		var option_total_amount =parseInt(total_amount) + parseInt(result_val[3]) + parseInt(default_amount);
		document.fitem.option_total_amount.value = option_total_amount;
		document.fitem.option_total_amount_text.value = number_format(String(document.fitem.option_total_amount.value));
	}
	else{
		var op_amount = document.fitem.op_amount.value = parseInt(option_amount) + parseInt(result_val[3]);
		input_tot_amount("",op_amount);
	}
	op_num_input();  // 중복체크를 위한 설정 (선택 된 옵션의 번호를 인풋에 담아둔다)
}

function input_tot_amount(price_amount,option_amount){
	if(!price_amount) var price_amount = document.fitem.price_amount.value; // 담품가격
	if(!option_amount) var option_amount = document.fitem.op_amount.value;  // 옵션가격
	document.fitem.option_total_amount.value = parseInt(option_amount) + parseInt(price_amount);
	document.fitem.option_total_amount_text.value = number_format(String(document.fitem.option_total_amount.value));
}




function op_num_input(){
	var op_num_flag="";
	//alert(document.all.length);
	for (z = 0; z < document.all.length; z++) {
		var obj = document.all(z);
		if(obj.id != "" && obj.id.substring(0,9) == "option_no"){
			if(op_num_flag == "") op_num_flag = obj.value;
			else op_num_flag += "|"+obj.value;
		}
	}
	document.fitem.op_num_flag.value = op_num_flag;
}

function option_cal(option_num_id,option_amount_id,option_txt_amount_id,option_amount,mode,itop_stock,itop_amount_op) {
	var option_num_id=eval(document.getElementById(option_num_id));
	var option_amount_id=eval(document.getElementById(option_amount_id));
	var option_amount_txt_id=eval(document.getElementById(option_txt_amount_id));
	var option_total_amount=eval(document.getElementById("option_total_amount"));
	var option_total_amount_text=eval(document.getElementById("option_total_amount_text"));
	var default_amount = "<?=$real_pay?>";
	var tot_option_amount = document.fitem.op_amount.value;
	if(itop_amount_op == "-") option_amount = parseInt(option_amount) * -1;
	else option_amount = parseInt(option_amount);


	if (mode=="p") {
		if (parseInt(itop_stock)<=parseInt(option_num_id.value)) {
			alert ("옵션당 최대구매횟수를 초과하였습니다.");
			return false;
		}
		else {
			if(document.getElementById("it_opt_use2").value == 1){
				option_num_id.value=parseInt(option_num_id.value)+1;
				//option_amount_id.value=parseInt(option_num_id.value)*(parseInt(option_amount)+parseInt(default_amount));
				option_amount_id.value=parseInt(option_num_id.value)*(parseInt(option_amount));
				option_amount_txt_id.value=number_format(String(option_amount_id.value));//number_format 추가
				option_total_amount.value=parseInt(option_total_amount.value)+option_amount+parseInt(default_amount);
				option_total_amount_text.value=number_format(String(option_total_amount.value));
			}
			else{
				option_num_id.value=parseInt(option_num_id.value)+1;
				option_amount_id.value=parseInt(option_num_id.value)*option_amount;
				option_amount_txt_id.value=number_format(String(option_amount_id.value));//number_format 추가
				option_total_amount.value=parseInt(option_total_amount.value)+option_amount;
				option_total_amount_text.value=number_format(String(option_total_amount.value));
			}

			document.fitem.op_amount.value = parseInt(tot_option_amount) + parseInt(option_amount);
		}
	}

	if (mode=="m") {
		if (1>=parseInt(option_num_id.value)) {
			return false;
		}
		else {

			if(document.getElementById("it_opt_use2").value == 1){
				option_num_id.value=parseInt(option_num_id.value)-1;
				//option_amount_id.value=parseInt(option_num_id.value)*(parseInt(option_amount)- parseInt(default_amount));
				option_amount_id.value=parseInt(option_num_id.value)*(parseInt(option_amount));
				option_amount_txt_id.value=number_format(String(option_amount_id.value));//number_format 추가
				option_total_amount.value=parseInt(option_total_amount.value) - option_amount- parseInt(default_amount);
				option_total_amount_text.value=number_format(String(option_total_amount.value));
			}
			else{
				option_num_id.value=parseInt(option_num_id.value)-1;
				option_amount_id.value=parseInt(option_num_id.value)*option_amount;
				option_amount_txt_id.value=number_format(String(option_amount_id.value));//number_format 추가
				option_total_amount.value=parseInt(option_total_amount.value) - option_amount;
				option_total_amount_text.value=number_format(String(option_total_amount.value));
			}

			document.fitem.op_amount.value = parseInt(tot_option_amount) - parseInt(option_amount);
		}
	}
}


function removeRow() {

	var r_inx = document.fitem.in_inx.value;
	oTbl = document.getElementById("addTable");
	oTbl.deleteRow(oTbl.clickedRowIndex);
	r_inx--;

	document.fitem.in_inx.value = r_inx;
	result_total_amount(r_inx);
}

//다중옵션 최종 체크
function result_total_amount(num)
{
	var tot_amount=0;
	var tot_qty=0;
	var it_add_opt2=0;

	if (document.getElementById("it_opt_use2").value == "1")
	{
		var basic_amount = parseInt('<?=$real_pay?>');

		for (z = 0; z < document.all.length; z++)
		{
			var obj = document.all(z);
			if(obj.id != "" && obj.id.substring(0,13) == "option_amount")
			{
				var this_id = obj.id;
				var this_qty_id = this_id.replace("option_amount","option_qty");

				var this_option_amount = document.getElementById(this_id).value;
				var this_option_qty = document.getElementById(this_qty_id).value;

				tot_amount = parseInt(tot_amount) + ( ( parseInt(basic_amount) * parseInt(this_option_qty) ) + parseInt(this_option_amount) );
			}
			if(obj.id != "" && obj.id.substring(0,10) == "option_qty"){
				var this_qty = parseInt(obj.value); //추가 mj
			}
		}

		if(num == 0) basic_amount=0;

		<? if($view[packing_option] == "Y"){
			?> it_add_opt2 = document.getElementById("packing_option").value;
			<? }
		?>
		document.fitem.option_total_amount.value = tot_amount;
	}
	else
	{
		// 기존 ------------------------------------------------------------------------------------------------------------------------------------
		for (z = 0; z < document.all.length; z++)
		{
			var obj = document.all(z);

			if(obj.id != "" && obj.id.substring(0,13) == "option_amount"){
				tot_amount = parseInt(tot_amount) + parseInt(obj.value);
			}
			if(obj.id != "" && obj.id.substring(0,10) == "option_qty"){
				var this_qty = parseInt(obj.value); //추가 mj
			}
		}
		tot_qty = parseInt(document.fitem.ct_qty.value);//추가되었습니다

		var basic_amount = parseInt('<?=$real_pay?>');

		if(document.getElementById("it_opt_use2").value == 1){
			if(num == 0) basic_amount=0;
		}

		<? if($view[packing_option] == "Y"){
			?> it_add_opt2 = document.getElementById("packing_option").value;
			<? }
		?>
		document.fitem.option_total_amount.value = (basic_amount + parseInt(it_add_opt2)) * tot_qty + tot_amount;
		//--------------------------------------------------------------------------------------------------------------------------------------------
	}


	document.fitem.op_amount.value = tot_amount;//추가됨
	document.fitem.option_total_amount_text.value = number_format(String(document.fitem.option_total_amount.value));
	op_num_input();
}

//다중구입옵션e
function qty_flag(sel_op){
	$.ajax({
	type:"POST",
	url:"/GnAjax/shop/php/op_qty_flag.php",
	data: {
	itop_no: sel_op
	},

	// 옵션 출력 하기
	success:function(result) {
	return_op_qty_flag(result);		// 생성된 셀렉트 박스 출력
	}
	});
	/////////////옵션 ajax /////////////////////////////////////

}
function return_op_qty_flag(req){
	var result = req.responseText;
	var _objName = document.getElementById("ct_qty");

	var sel = _objName;
	var opt = document.createElement('OPTION');
	removeOptions(sel);
	if(result > 10) result = 10;
	for(k = 2; k < parseInt(result)+1; k++){
		addOption(sel,k,k);
	}
}

function removeOptions(selectbox){
	var i;
	for(i=selectbox.options.length;i>=0;i--){
		selectbox.remove(i+1);
	}
}

function addOption(selectbox,text,value )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

function autoResize(id){
	var newheight;
	if(document.getElementById){
		newheight = $("#"+id).contents().find("#mainContent").height();
		newheight = 5+newheight;	// 버튼들이 짤려나와 세로길이를 조금더 추가 했다.
		//alert(newheight);
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

