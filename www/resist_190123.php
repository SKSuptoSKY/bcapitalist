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
			</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl_list">
				<colgroup>
					<col width="412px" />
					<col width="351px" />
					<col width="231px" />
					<col width="206px" />
				</colgroup>
				<tr>
					<th>강의</th>
					<th>강의일정</th>
					<th>가격</th>
					<th>신청</th>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="/resist02.php">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
				<tr>
					<td>(강의)블록체인 전문 투자자과정</td>
					<td>2019년 2월 둘째주 ~ 2019년 3월 셋째주</td>
					<td>150만원(부가세별도)</td>
					<td><a href="#">자세히보기</a></td>
				</tr>
			</table>

			<div class="paging_wrap">
				<ul class="paging">
					<li class="page_arrow"><a href="#"><img src="/images/sub/btn_first.jpg" alt="" /></a></li>
					<li class="on"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
					<li><a href="#">7</a></li>
					<li class="page_arrow"><a href="#"><img src="/images/sub/btn_last.jpg" alt="" /></a></li>
				</ul>
			</div>
		</div><!-- //inner -->
	</div><!-- //sub_contents -->

<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>


<? include $_SERVER["DOCUMENT_ROOT"]."/foot.lib.php"; ?>