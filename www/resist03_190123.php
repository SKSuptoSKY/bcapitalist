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
			<div class="view_con">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_view">
					<colgroup>
						<col width="371px" />
						<col width="*" />
					</colgroup>
					<tr>
						<th>강의</th>
						<td>(강의)블록체인 전문 투자자 과정</td>
					</tr>
					<tr>
						<th>강의일정</th>
						<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					</tr>
					<tr>
						<th>가격</th>
						<td>150만원(부가세별도)</td>
					</tr>
					<tr>
						<th>성명</th>
						<td>성명에 관한 내용이 들어갑니다.</td>
					</tr>
					<tr>
						<th>회사기관명</th>
						<td>회사기관명에 관한 내용이 들어갑니다.</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>이메일에 관한 내용이 들어갑니다.</td>
					</tr>
					<tr>
						<th>휴대번호</th>
						<td>휴대번호에 관한 내용이 들어갑니다.</td>
					</tr>
					<tr>
						<th>남기실말씀</th>
						<td>남기실말씀에 관한 내용이 들어갑니다.</td>
					</tr>
					<tr>
						<th>결제방법</th>
						<td>결제방법에 관한 내용이 들어갑니다.</td>
					</tr>
				</table>

				<div class="view_btn_wrap">
					<a class="view_btn_cancel" href="resist02.php">취소하기</a>
					<a class="view_btn_payment" href="#">결제하기</a>
				</div>
			</div>
		</div><!-- //inner -->
	</div><!-- //sub_contents -->

	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>