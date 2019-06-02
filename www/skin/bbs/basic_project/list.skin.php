<!-- <?
////////// 게시판 리스트 페이지 추가코드 여기부터 //////////////////////////

////////// 게시판 리스트 페이지 추가코드 여기까지 //////////////////////////

/*///// 게시판 변수 안내
스킨경로 : $Board_Admin["skin_dir"]
게시판 너비 : $Board_Admin["width"]
/*///// 게시판 변수 안내
?> -->
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
	if (!check_confirm(str)){
		return false;
	}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){
		return false;
	}

	f.mode.value="COPY";
	f.submit();
}
// 선택한 게시물 이동
function bbsmove() {
	var f = document.ListCheck;

	str = "이동";
	if (!check_confirm(str)){
		return false;
	}

	if(!f.typedbname.value&&document.getElementById("dbname_view").style.display=="block"){
		alert('복사/이동할 게시판이 없습니다.\n\n관리자페이지>사이트관리>게시판관리에서     \n체크 하신후 이용 바랍니다.');
		return false;
	}

	if(!f.typedbname.value){
		alert(str+"할 테이블을 선택하여 주십시오");
		document.getElementById("dbname_view").style.display = "block";
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?")){
		return false;
	}

	f.mode.value = "MOVE";
	f.submit();
}
</script>

<style>
.bbs_btn{width:90px; height:28px; background:#ffffff; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:26px; display:inline-block;}
.sub0301_wrap{width:100%; position:relative; overflow:hidden}
.sub0301_cont{width:260px;height:280px; float:left; ; margin-left:20px; margin-bottom:20px; position:relative;  }
.sub0301_cont.md0{margin-left:0; }
.sub0301_img_sizing{width:258px; height:198px; display:table-cell; text-align:center; vertical-align:middle; z-index:9;}
.sub0301_img_sizing img{max-width:258px; max-height:198px; border:1px solid #ddd; }
.sub0301_cover{position:absolute; left:0; top:0; display:none; z-index:10; }


</style>

<!-- <div class="board_search mt20 mb50">
	<table  width="100%"  border="0" cellspacing="0" cellpadding="0" >
		<tr>
			<td>
				<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=tbl value="<?=$Table?>">
				<input type=hidden name=mode value="">
				<input type=hidden name=page value="<?=$page?>">
					<table  width="50%"  border="0" cellspacing="0" cellpadding="0" align="left" >
						<colgroup>
						<col width="15%" />
						<col width="35%" />
						<col width="15%" />
						<col width="*" />
						</colgroup>
						<tr>
							<td><span class="search_title">SEARCH</span></td>
							<td>
								<? if($Board_Admin["use_category"] == TRUE) { ?>
									<select name="category" class="form_input1" onchange="this.form.submit();">
										<option value="" <?if($category==""){?>selected<?}?>>--용도--</option>
										<?=$Category_option?>
									</select>
								<? } ?>
							</td>
							<td>
								<select name="year" style="width:80px;height:24px" onchange="this.form.submit();">
									<option value="">선택</option>
									<?for($date = date("Y"); $date >= 2007;$date--){?>
										<option value="<?=$date?>" <?if($year == $date){?>selected<?}?>><?=$date?></option>
									<?}?>
								</select>
							</td>
							
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</div> -->

<div class="sub0301_wrap clfix">
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
	<input type="hidden" name="gr_id" value="<?=$gr_id?>">
	<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
	<input type="hidden" name="typedbname">
	<input type="hidden" name="tablecategory">

		<?
		for ($i=0; $i<$list_total; $i++) {
		?>
		<div class="sub0301_cont <?if($i%3==0){?>md0<?}?>">
			<a href="<?=$list[$i]["viewUrl"]?>">
				<div class="sub0301_img_sizing">
					<div style="display: table; width: 258px; height: 198px; #position: relative; overflow: hidden;">
						<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
							<div style=" #position: relative; #top: -50%; #left: -50%;">
								<!-- <img src="<?=$list[$i]["img_1"]?>"> -->
								<img src="<?=$list[$i]["img_1"]?>" width="<?=$img_width[$i]?>" height="<?=$img_height[$i]?>" onerror="this.src='/images/sub/no-img.jpg'">
							</div>
						</div>
					</div>
				</div>
				<div class="sub0301_cover"><img src="/images/sub/over_img.png" alt="" /></div>
			</a>
		</div>
		<?
		}
		//for end
		if($i==0) {
		?>
		<div style="display: table; width: 1100px; height: 300px; #position: relative; overflow: hidden;">
			<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
				<div style=" #position: relative; #top: -50%; #left: -50%;">
					등록된 프로젝트가 없습니다.
				</div>
			</div>
		</div>
		<?
		}
		?>

	</form>

</div>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<?
			if($Url["admin"]==TRUE) {
			?>
			<a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a>
			<?=AllTable($Table,"document.ListCheck.typedbname")?>
				<? }
			?>
		</td>
		<td height="50" align="right">
			<?
			if($Url["write"]==TRUE) {
			?>
			<a href="<?=$Url["write"]?>"><div class="bbs_btn">글쓰기</div></a>
			<?
			}
			?>
			<?
			if ($LogAdmin==TRUE) {
			?>
			<!-- <a href="javascript:select_delete();"><div class="bbs_btn">삭제</div></a> -->
			<?
			}
			?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<div class="paginate mt20">
				<ul>
					<?=custom_paging($default[page_list]
					,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") 
					?>
				</ul>
			</div>
			<?//=$PageLinks?>
		</td>
	</tr>
</table>

<div class="board_search mt20 mb50" style="display:none;">
	<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
						<input type=hidden name=tbl value="<?=$Table?>">
						<input type=hidden name=mode value="">
						<input type=hidden name=page value="<?=$page?>">
						<td>
							<?
							if($Board_Admin["use_category"] == TRUE) {
							?>
							<select name="category" style="height:28px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid; font-size:13px;">
							<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
							<?=$Category_option?>
								</select>
								<? }
							?>
							<select name="findType">
							<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
							<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
							<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
							<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
							</select>
							&nbsp;
							<input type="text" name="findWord" class="board_search_area" placeholder="검색어를 입력하세요" value="<?=$findword?>">
							&nbsp;
							<input type="submit" value="검색" class="board_btn_seach"/>
						</td>
						</form>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<script type="text/javascript">
	$('.sub0301_cont').hover(function(){
		$('.sub0301_cover').hide();
		$(this).find('.sub0301_cover').stop(true,true).fadeIn();
	}, function(){
		$('.sub0301_cover').hide();
	});
</script>

<style>
.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; vertical-align:middle;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; }
</style>
