<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

	if(!$no) alert("잘못된 접근입니다.","/academy.php");
	$sql = "select * from Gn_Lecture where lec_no = '$no'";
	$lec = sql_fetch($sql);

	$vat = $lec[lec_pay] * 0.1;
	$total_pay = $lec[lec_pay] + $vat;

	//계좌안내
	$sql = "select * from Gn_Page_Item where pg_no = 5";
	$pg = sql_fetch($sql);
?>
<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
	
	<div id="sub_visual_wrap">
		<p style="background:url(/images/sub/sub-visual.jpg) center top no-repeat; height:571px;"></p>
	</div><!-- //sub_visual_wrap -->	

	<div id="sub_contents">
		<div class="inner">
			<div class="sub_tit">
				<span>01</span>
				<h2>과정등록</h2>
				<p>다음의 절차에 따라 <em>등록 양식을 작성</em>해주세요</p>
			</div>
			<form name="resist" method="POST" enctype="multipart/form-data" validate="UTF-8">
				<input type="hidden" name="order_lec" value="<?=$no?>">
				<input type="hidden" name="emailChk" id="emailChk" value="">
				<input type="hidden" name="order_tax" value="<?=$vat?>">
				<input type="hidden" name="total_pay" value="<?=$total_pay?>">
				<input type="hidden" name="order_pay" value="<?=$order_pay?>">
				<input type="hidden" name="lec_no" value="<?=$lec[lec_no]?>">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list form">
					<colgroup>
						<col width="370px" />
						<col width="*" />
						<col width="312px" />
					</colgroup>
					<tr>
						<th>과정</th>
						<th>과정일정</th>
						<th>가격</th>
					</tr>
					<tr>
						<td><?=$lec[lec_subject]?></td>
						<td><?=substr($lec[lec_frDT],0,10)?> ~ <?=substr($lec[lec_enDT],0,10)?></td>
						<td class="bold"><?=number_format($lec[lec_pay])?>원 (VAT 없음)</td>					
					</tr>	
				</table>

				<div class="price_box">
					<div class="price">
						<ul>
							<!--<li>VAT 10% <span><?=number_format($vat)?>원</span></li>-->
						</ul>
					</div>
					<div class="price_total">
						<ul>
							<li>총 구매금액 <span><?=number_format($lec[lec_pay])?>원</span></li>
							<!--<li>총 결제금액 <span><?=number_format($total_pay)?>원</span></li>-->
						</ul>
					</div>
				</div>

				<div class="sub-tit"><h3>등록자</h3></div>
				<div class="form01">
					<div class="form_line">
						<strong class="mr40">성명<span>＊</span></strong>
						<strong>회사/기관명<span>＊</span></strong>
						<span class="mr40"><input type="text" name="order_name"></span>
						<span><input type="text" name="order_company"></span>
					</div>
					<div class="form_line">
						<strong class="mr40">직책<span>＊</span></strong>
						<strong>부서<span>＊</span></strong>
						<span class="mr40"><input type="text" name="order_position"></span>
						<span><input type="text" name="order_team"></span>
					</div>
					<div class="form_line">
						<strong class="mr40">이메일<span>＊</span></strong>
						<strong>휴대폰번호<span>＊</span></strong>
						<span class="mr40"><input type="text" name="order_email" onblur = "blur_email_input(this.value)"></span>
						<span><input type="text" name="order_mobile"></span>
					</div>
					<div class="form_line">
						<strong class="mr40">추천인<span>＊</span></strong>
						<strong>신청 경로<span>＊</span></strong>
						<span class="mr40"><input type="text" name="order_referral"></span>
						<input type='radio' name='order_root' value='페이스북' />페이스북
  							&nbsp;&nbsp; <input type='radio' name='order_root' value='포털 검색'/>포털 검색
  							&nbsp;&nbsp; <input type='radio' name='order_root' value='홍보물' />홍보물
  							&nbsp;&nbsp; <input type='radio' name='order_root' value='지인' />지인 
						
					</div>
					<div class="form_line">
						<strong style="width:100%;">남기실 말씀</strong>
						<span style="width:100%;">
							<textarea name="order_content"></textarea>
						</span>					
					</div>
				</div><!-- //form01 -->

				<div class="sub-tit" style="height:215px;"><h3>계좌안내</h3></div>
				<div class="form01">
					<div class="form_line">
						<strong class="mr40">예금주<span>＊</span></strong>
						<strong>계좌번호<span>＊</span></strong>
						<strong class="mr40">(주)멀티캠퍼스</strong>
						<strong>052 - 259245 - 13 - 201 (우리은행)</strong>
					</div>
					<div class="form_line">
						
						<br/>
						<br/>
						<br/>	
						<strong class="mr40">위의 계좌로 이체완료시 수강신청이 최종완료됩니다.</stong>
					</div>
				</div>
				
				<!-- <div class="form02">
					<strong>결제방법<span>＊</span></strong>
					<span><input type="radio" id="radio_card" name="payment_method" value="100000000000"><label for="radio_card">카드</label></span>
					<span><input type="radio" id="bank_transfer" name="payment_method" value="010000000000"><label for="bank_transfer">실시간계좌이체</label></span>
				</div> --> <!-- //form02 

				<div class="cautions-wrap">
					<div class="cautions">
						<p>
							환불을 원하실 경우 <span>contact@dconference.io</span> 로 이메일 작성을 통해 문의해주세요.<br/>
							강의시작 7일전까지는 환불 수수료를 제외한 전액이 환불 가능합니다.<br/> 
							강의시작 6일 전부터는 환불이 불가능합니다.
						</p>
						<p>등록 후 참석이 불가능한 경우, 대리참석자를 지정하실 수 있습니다. </p>
						<p><span>contact@dconference.io</span> 로 이메일 작성을 통해 문의해주세요.</p>
						<p>입금자와 참가자가 다른경우는, 입금자명을 참가자명으로 수정하여 보내주세요.</p>
						<p>회사명으로 송부할경우에는 회사명과 참가자명을 함께 써주세요.</p>
						<p>세금계산서가 필요한 경우, 사업자등록증 및 발급할 이메일 주소를 <span>contact@dconference.io</span> 로 보내주시기 바랍니다.</p>
					</div><!-- //cautions 
				</div><!-- //cautions-wrap -->
				<?//=$pg[pg_content]?>
				<div class="form-btn"><a href="javascript:writeChk(document.resist);">다음</a></div>
			</form>
		</div><!-- //inner -->
	</div><!-- //sub_contents -->

<script language='javascript'>
function writeChk(form) {
    if (typeof(form.order_name) != 'undefined') {
		if(!form.order_name.value) {
			alert('성명을 입력하세요');
			form.order_name.focus();
			return false;
		}
	}
	if (typeof(form.order_company) != 'undefined') {
		if(!form.order_company.value) {
			alert('회사/기관명을 입력하세요');
			form.order_company.focus();
			return false;
		}
	}
	if (typeof(form.order_position) != 'undefined') {
		if(!form.order_position.value) {
			alert('직책을 입력하세요');
			form.order_position.focus();
			return false;
		}
	}
	if (typeof(form.order_team) != 'undefined') {
		if(!form.order_team.value) {
			alert('부서를 입력하세요');
			form.order_team.focus();
			return false;
		}
	}
	if (typeof(form.order_email) != 'undefined') {
		if(!form.order_email.value) {
			alert('이메일을 입력하세요');
			form.order_email.focus();
			return false;
		}
	}
	if (typeof(form.order_mobile) != 'undefined') {
		if(!form.order_mobile.value) {
			alert('휴대폰번호를 입력하세요');
			form.order_mobile.focus();
			return false;
		}
	}

	//if(!ridiaChk(form.payment_method,"결제방법을 선택해주세요")) return;

	if (typeof(form.emailChk) != 'undefined') {
		if(form.emailChk.value != "Y") {
			alert('이메일을 다시 입력하세요');
			form.order_email.focus();
			return false;
		}
	}

	form.action = "./resist03.php";

	form.submit();
	return;
}

/* ------------------------------------------------------------- [ 이메일 정규식 체크 - Start ] ------------------------------------------------------------- */
function blur_email_input(value){
	$.ajax({
		type:"POST",
		url:"/GnAjax/check_valid/email_value.php",

		data:
		{
			email: value
		},

		success:function(result) {
			if (result=="true"){
				$("#email_valid_result_area").css("color","blue").html("사용가능한 이메일 주소입니다.");
				$("#emailChk").attr("value","Y");
			} else {
				$("#email_valid_result_area").css("color","#ff0000").html("이메일 형식이 올바르지 않습니다.");
				$("#emailChk").attr('value','');
			}
		}
	});
};
/* ------------------------------------------------------------- [ 이메일 정규식 체크 - End ] ------------------------------------------------------------- */

</script>
	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>

<?// include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>