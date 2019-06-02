<script type="text/javascript">
//2014 MJ
function mview(i) { 
	var get_sel_no = <?=$_GET[sel]?>;		// get변수로 넘어온 맵넘버가 있다면 저장
	if (get_sel_no != "") {
		$("#background_li").find("li").each(function(i){
			$(this).hide();
		});
		$("#mview_"+get_sel_no).show();
		$("#mview_"+get_sel_no).css("z-index","700").css("opacity","0.86");
		$("#mview_"+i).show();
		$("#mview_"+i).css("z-index","600").css("opacity","1");
	} else {
		$("#mview_"+i).show();
	}
}
</script>


<div class="map_Wrap">
	<!--지도 시작-->
		<div class="map">
			<li style="background:#fff url(/images/map/map.jpg) no-repeat; width:280px; height:350px; float:left;" >
				<ul style="position:relative; z-index:655;" >

					<a onmouseover="mview(1)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=GW&sel=1" title="강원도">
						<li style="position:absolute; width:55px; height:55px; margin-left:155px; margin-top:45px;  "></li>
					</a><!--강원도-->
					<a onmouseover="mview(2)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=GB&sel=2" title="경상북도">
						<li style="position:absolute; width:50px; height:20px; margin-left:180px; margin-top:145px; "></li>
					</a><!--경상북도-->
					<a onmouseover="mview(3)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=GG&sel=3" title="경기도">
						<li style="position:absolute; width:30px; height:20px; margin-left:110px; margin-top:90px;  "></li>
					</a><!--경기도-->
					<a onmouseover="mview(4)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=IC&sel=4" title="인천">
						<li style="position:absolute; width:20px; height:20px; margin-left:75px; margin-top:80px; "></li>
					</a><!--인천-->
					<a onmouseover="mview(5)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=CB&sel=5" title="충청북도">
						<li style="position:absolute; width:40px; height:20px; margin-left:130px; margin-top:125px; "></li>
					</a><!--충청북도-->

					<a onmouseover="mview(6)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=DG&sel=6" title="대구">
						<li style="position:absolute; width:10px; height:10px; margin-left:185px; margin-top:178px; "></li>
					</a><!--대구-->
					<a onmouseover="mview(7)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=US&sel=7" title="울산" title="울산">
						<li style="position:absolute; width:20px; height:10px; margin-left:210px; margin-top:195px; "></li>
					</a><!--울산-->

					<a onmouseover="mview(8)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=GN&sel=8" title="경상남도" title="경상남도">
						<li style="position:absolute; width:40px; height:30px;
					margin-left:150px; margin-top:200px;  "></li></a><!--경상남도-->

					<a onmouseover="mview(9)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=BS&sel=9" title="부산">
						<li style="position:absolute; width:20px; height:10px; margin-left:205px; margin-top:220px; "></li>
					</a><!--부산-->

					<a onmouseover="mview(10)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=JN&sel=10" title="전라남도">
						<li style="position:absolute; width:60px; height:30px; margin-left:70px; margin-top:240px; "></li>
					</a><!--전라남도-->

					<a onmouseover="mview(11)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=GJ&sel=11" title="광주">
						<li style="position:absolute; width:20px; height:10px; margin-left:100px; margin-top:220px;  "></li>
					</a><!--광주-->

					<a onmouseover="mview(12)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=JJ&sel=12" title="제주">
						<li style="position:absolute; width:30px; height:20px; margin-left:70px; margin-top:290px; "></li>
					</a><!--제주도-->

					<a onmouseover="mview(13)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=CN&sel=13" title="충청남도">
						<li style="position:absolute; width:45px; height:30px; margin-left:80px; margin-top:130px; "></li>
					</a><!--충청남도-->
					<a onmouseover="mview(14)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=JB&sel=14" title="전라북도">
						<li style="position:absolute; width:40px; height:20px; margin-left:100px; margin-top:180px;  "></li>
					</a><!--전라북도-->

					<a onmouseover="mview(15)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=SU&sel=15" title="서울">
						<li style="position:absolute; width:15px; height:10px; margin-left:110px; margin-top:80px; "></li>
					</a><!--서울-->
					<a onmouseover="mview(16)" style='cursor:hand' href="/bbs/board.php?tbl=<?=$Table?>&selcity=DJ&sel=16" title="대전">
						<li style="position:absolute; width:10px; height:10px; margin-left:130px; margin-top:155px; "></li>
					</a><!--대전-->
				</ul>
				<ul style="position:absolute; z-index:555;" id="background_li">
					<li style="position:absolute;  background:url(/images/map/map1.jpg) no-repeat; width:280px; height:350px; display:none; float:left; " id="mview_1"></li>
					<li style="position:absolute;  background:url(/images/map/map2.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_2"></li>
					<li style="position:absolute;  background:url(/images/map/map3.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_3"></li>
					<li style="position:absolute;  background:url(/images/map/map4.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_4"></li>
					<li style="position:absolute;  background:url(/images/map/map5.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_5"></li>
					<li style="position:absolute;  background:url(/images/map/map6.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_6"></li>
					<li style="position:absolute;  background:url(/images/map/map7.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_7"></li>
					<li style="position:absolute;  background:url(/images/map/map8.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_8"></li>
					<li style="position:absolute;  background:url(/images/map/map9.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_9"></li>
					<li style="position:absolute;  background:url(/images/map/map10.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_10"></li>
					<li style="position:absolute;  background:url(/images/map/map11.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_11"></li>
					<li style="position:absolute;  background:url(/images/map/map12.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_12"></li>
					<li style="position:absolute;  background:url(/images/map/map13.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_13"></li>
					<li style="position:absolute;  background:url(/images/map/map14.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_14"></li>
					<li style="position:absolute;  background:url(/images/map/map15.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_15"></li>
					<li style="position:absolute;  background:url(/images/map/map16.jpg) no-repeat; width:280px; height:350px; display:none; float:left;" id="mview_16"></li>
				</ul>
			</li>
		</div>
		<!--지도 끝-->

		<!--표 시작-->
		<form name="ListCheck" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return listChk(this)">
		<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
		<input type="hidden" name="mode" value="LISTDEL">
		<input type="hidden" name="tbl" value="<?=$Table?>">
		<input type="hidden" name="category" value="<?=$category?>">
		<input type="hidden" name="findType" value="<?=$findType?>">
		<input type="hidden" name="findword" value="<?=$findword?>">
		<input type="hidden" name="sort1" value="<?=$sort1?>">
		<input type="hidden" name="sort2" value="<?=$sort2?>">
		<input type="hidden" name="page" value="<?=$page?>">
		<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
		<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
		<input type="hidden" name="typedbname">
		<input type="hidden" name="tablecategory">


		<div class="store md30">
			<table width="440" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td >
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="view">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
										<colgroup>
											<col width="2%"/>
											<col width="15%"/>
											<col width="62%"/>
											<col width="21%"/>
										</colgroup>
										<tr>
											<td align="center" class="viewfont" style="padding:5px 0 5px 0;">&nbsp;</td>
											<td align="center" class="viewfontao" style="padding:5px 0 5px 0;">점포명</td>
											<td align="center" class="viewfontvo" style="padding:5px 0 5px 0;">주소</td>
											<td align="center" class="viewfonteo" style="padding:5px 0 5px 0;">전화번호</td>
										</tr>
									</table>
								</td>
							</tr>
							<?for($i=0; $i < count($list); $i++){?>
							<tr>
								<td class="view01">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
										<colgroup>
											<col width="2%"/>
											<col width="20%"/>
											<col width="58%"/>
											<col width="20%"/>
										</colgroup>
										<tr valign="top">
											<td align="center" style="padding:2px 0 5px 0;">&nbsp;</td>
											<td align="center" style="padding:2px 0 5px 0;">
												<? if($LogAdmin == TRUE) { ?>
													<a href='/bbs/board.php?tbl=<?=$Table?>&mode=MODIFY&num=<?=$list[$i][b_no]?>'><?=$list[$i][b_subject]?></a>
												<? } else { ?>
													<?=$list[$i][b_subject]?>
												<? } ?>
											</td>
											<td align="center" style="padding:2px 0 5px 0;">
											<?=$list[$i][b_ex1]?>
											</td>
											<td align="center" style="padding:2px 0 5px 0;"><?=$list[$i][b_ex2]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<? } ?>
							<?if($i == 0){?>
							<tr>
								<td width="100%" class="view01" align="center">
									등록된 지점이 없습니다.
								</td>
							</tr>
							<? } ?>
						</table>
					</td>
				</tr>
				<tr>
					<td style="height:50px;text-align:right;">
						<? if($Url["write"]==TRUE) { ?>
							<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif"></a>
						<? } ?>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2"><?=$PageLinks?></td>
				</tr>
			</table>
		</div>
	<!--표 끝-->
</div>
</form>
		
<script type="text/javascript">
//초기값셋팅
<?if($sel != ""){?>
	mview("<?=$sel?>");
<? } ?>

</script>

<script language='javascript'>
function check_confirm(str) {
    var f = document.ListCheck;
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "list_ck[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete() {
	var f = document.ListCheck;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n원글 삭제시 답변글까지 모두 삭제됩니다.\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.submit();
}
// 선택한 게시물 삭제
function select_delete() {
	var f = document.ListCheck;

	str = "삭제";
	if (!check_confirm(str))
		return;

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n원글 삭제시 답변글까지 모두 삭제됩니다.\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;

	f.submit();
}
// 선택한 게시물 복사
function bbscopy() {
	var f = document.ListCheck;

	str = "복사";
	if (!check_confirm(str)){ return false;}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){ return false;}

	f.mode.value="COPY";
	f.submit();
}
// 선택한 게시물 이동
function bbsmove() {
	var f = document.ListCheck;

	str = "이동";
	if (!check_confirm(str)){ return false;}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){ return false;}

	f.mode.value = "MOVE";
	f.submit();
}
</script>