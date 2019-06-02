<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.lib.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################

?>
<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>
	
	<div id="sub_visual_wrap">
		<p style="background:url(/images/sub/sub-visual.jpg) center top no-repeat; height:571px;"></p>
	</div><!-- //sub_visual_wrap -->	

	<div id="sub_contents">
		<div class="inner">
			<div class="sub_tit">
				<span>01</span>
				<h2>강의신청</h2>
				<p>다음의 절차에 따라 <em>등록 양식을 작성</em>해주세요</p>
			</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list form">
				<colgroup>
					<col width="370px" />
					<col width="*" />
					<col width="312px" />
				</colgroup>
				<tr>
					<th>강의</th>
					<th>강의일정</th>
					<th>가격</th>					
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자 과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td class="bold">150만원(부가세별도)</td>					
				</tr>	
			</table>

			<div class="price_box">
				<div class="price">
					<ul>
						<li>VAT 10% <span>150,000원</span></li>
					</ul>
				</div>
				<div class="price_total">
					<ul>
						<li>총 구매금액 <span>1,350,000원</span></li>
						<li>총 결제금액 <span>1,500,000원</span></li>
					</ul>
				</div>
			</div>

			<div class="sub-tit"><h3>등록자</h3></div>
			<div class="form01">
				<div class="form_line">
					<strong class="mr40">성명</strong>
					<strong>회사/기관명</strong>
					<span class="mr40"><input type="text"></span>
					<span><input type="text"></span>
				</div>
				<div class="form_line">
					<strong class="mr40">이메일</strong>
					<strong>휴대폰번호</strong>
					<span class="mr40"><input type="text"></span>
					<span><input type="text"></span>
				</div>
				<div class="form_line">
					<strong style="width:100%;">남기실 말씀</strong>
					<span style="width:100%;">
						<textarea></textarea>
					</span>					
				</div>
			</div><!-- //form01 -->

			<div class="sub-tit" style="height:215px;"><h3>결제방법</h3></div>
			<div class="form02">
				<strong>결제방법</strong>
				<span><input type="radio" id="radio_card" name="payment_method"><label for="radio_card">카드</label></span>
				<span><input type="radio" id="bank_transfer" name="payment_method"><label for="bank_transfer">계좌이체, 무통장입금</label></span>
			</div><!-- //form02 -->

			<div class="cautions-wrap">
				<div class="cautions">
					<p>결제 완료후 수강 신청이 완료됩니다.</p>
					<p>
						환불을 원하실 경우 <span>contact@dconference.io</span> 로 이메일 작성을 통해 문의해주세요.<br/>
						강의시작 7일전까지는 환불 수수료를 제외한 전액이 환불 가능합니다.<br/> 
						강의시작 6일 전부터는 환불이 불가능합니다.
					</p>
					<p>등록 후 참석이 불가능한 경우, 대리참석자를 지정하실 수 있습니다. </p>
					<p><span>contact@dconference.io</span> 로 이메일 작성을 통해 문의해주세요.</p>
					<p>입금정보: [나중에 송부드리도록하겠습니다.]</p>
					<p>입금자와 참가자가 다른경우는, 입금자명을 참가자명으로 수정하여 보내주세요.</p>
					<p>회사명으로 송부할경우에는 회사명과 참가자명을 함께 써주세요.</p>
					<p>세금계산서가 필요한 경우, 사업자등록증 및 발급할 이메일 주소를 <span>contact@dconference.io</span> 로 보내주시기 바랍니다.</p>
				</div><!-- //cautions -->
			</div><!-- //cautions-wrap -->

			<div class="form-btn"><a href="resist03.php">수강신청</a></div>

		</div><!-- //inner -->
	</div><!-- //sub_contents -->

	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>