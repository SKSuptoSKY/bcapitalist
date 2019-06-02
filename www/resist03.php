<? 
	include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ;  
	include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwin.php";  //메인에서만 삭제하지말아주세요 (서브에서는 삭제)
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	if($default[ssl_flag] == "Y"){
		if($_SERVER[SERVER_PORT] == $ssl_port) goto_url("http://".$new_sever_name);
	}
	#################### SSL관련코드 삭제하지말아주세요 ###########################
	
	if(!$_POST[lec_no]) alert("잘못된 접근입니다.","/academy.php");
	$sql = "select * from Gn_Lecture where lec_no = '{$_POST[lec_no]}'";
	$lec = sql_fetch($sql);
?>

	<div id="sub_visual_wrap">
		<p style="background:url(/images/sub/sub-visual.jpg) center top no-repeat; height:571px;"></p>
	</div><!-- //sub_visual_wrap -->	

	<div id="sub_contents">
		<div class="inner">
			<div class="sub_tit">
				<span>01</span>
				<h2>과정등록</h2>
				<p>작성해주신 <em>등록 내역을 확인</em>해주세요</p>
			</div>
			<div class="view_con">
				<form name="up_form" method="post">
					<input type="hidden" name="order_name" value="<?=$_POST[order_name]?>">
					<input type="hidden" name="order_company" value="<?=$_POST[order_company]?>">
					<input type="hidden" name="order_position" value="<?=$_POST[order_position]?>">
					<input type="hidden" name="order_team" value="<?=$_POST[order_team]?>"> <!--추가한것-->
					<input type="hidden" name="order_email" value="<?=$_POST[order_email]?>">
					<input type="hidden" name="order_mobile" value="<?=$_POST[order_mobile]?>">
					<input type="hidden" name="order_referral" value="<?=$_POST[order_referral]?>"> <!--추가한것-->
					<input type="hidden" name="order_root" value="<?=$_POST[order_root]?>"> <!--추가한것-->
					<input type="hidden" name="order_content" value="<?=$_POST[order_content]?>">
					<input type="hidden" name="total_pay" value="<?=$total_pay?>">
					<input type="hidden" name="order_pay" value="<?=$order_pay?>">
					<input type="hidden" name="lec_no" value="<?=$lec_no?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_view">
						<colgroup>
							<col width="371px" />
							<col width="*" />
						</colgroup>
						<tr>
							<th>과정</th>
							<td><?=$lec[lec_subject]?></td>
						</tr>
						<tr>
							<th>과정일정</th>
							<td><?=substr($lec[lec_frDT],0,10)?> ~ <?=substr($lec[lec_enDT],0,10)?></td>
						</tr>
						<tr>
							<th>총 결제금액</th>
							<td><!--<?=number_format($total_pay)?>--><?=number_format($lec[lec_pay])?>원 (VAT 없음)</td>
						</tr>
						<tr>
							<th>성명</th>
							<td><?=$_POST[order_name]?></td>
						</tr>
						<tr>
							<th>회사기관명</th>
							<td><?=$_POST[order_company]?></td>
						</tr>
						<tr>
							<th>직책</th>
							<td><?=$_POST[order_position]?></td>
						</tr>
						<tr>
							<th>부서</th>
							<td><?=$_POST[order_team]?></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><?=$_POST[order_email]?></td>
						</tr>
						<tr>
							<th>휴대번호</th>
							<td><?=$_POST[order_mobile]?></td>
						</tr>
						<tr>
							<th>추천인</th> <!--추가한것-->
							<td><?=$_POST[order_referral]?></td>
						</tr>
						<tr>
							<th>신청 경로</th> <!--추가한것-->
							<td><?=$_POST[order_root]?></td>
						</tr>
						<tr>
							<th>남기실말씀</th>
							<td><?=$_POST[order_content]?></td>
						</tr>
					</table>
					<div class="view_btn_wrap" id="display_pay_button">
						<a class="view_btn_cancel" href="resist.php">취소하기</a>
						<a class="view_btn_payment" href="javascript:sub_form(document.up_form);">수강신청</a>
					</div>
				</form>
			</div>
		</div><!-- //inner -->
	</div><!-- //sub_contents -->

<script>
function sub_form(form){
	<?if($default[ssl_flag] == "Y"){?>
		form.action = "<?=$ssl_url?>/resist_update.php";
	<? }else{ ?>
		form.action = "./resist_update.php";
	<? } ?>

	form.submit();
}
</script>

	<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<? //include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>