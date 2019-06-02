
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

<script>
var old_i; // 전에 클릭했던 글의 번호값 저장
function mview(i) { // 답변 표시여부 조정하는 js함수
if (old_i==i) {
var mode=document.getElementById('mview_'+i).style.display;
if (mode=='inline') document.getElementById('mview_'+i).style.display='none';
else document.getElementById('mview_'+i).style.display='inline';
}
else {
if (old_i) document.getElementById('mview_'+old_i).style.display='none';
document.getElementById('mview_'+i).style.display='inline';
}
old_i=i;
}
</script>

<script type="text/javascript">
<!--
	<?if($sel != ""){?>
		mview("<?=$sel?>");
	<? } ?>
//-->
</script>



<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
<input type=hidden name=tbl value="<?=$Table?>">
<input type=hidden name=mode value="">
<input type=hidden name=page value="<?=$page?>">


<div class="select_area_wrap">
	<div class="select_area_inwrap clfix">
		<div class="left_map">
			<ul>
				<li style="background:url(/images/sub/map/map_bg.jpg) no-repeat; width:220px; height:327px; border-top:1px solid #adadad; ">

				<ul style="position:relative; z-index:655;">
					<a onmouseover="mview(1)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("강원도")?>&sel=1" title="강원도"><li style="position:absolute; width:55px; height:55px; margin-left:105px; margin-top:35px;"></li></a><!--강원도-->
					<a onmouseover="mview(2)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("경상북도")?>&sel=2" title="경상북도"><li style="position:absolute; width:55px; height:55px; margin-left:130px; margin-top:115px; "></li></a><!--경상북도-->
					<a onmouseover="mview(3)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("경기도")?>&sel=3" title="경기도"><li style="position:absolute; width:50px; height:55px; margin-left:50px; margin-top:40px;"></li></a><!--경기도-->
					<a onmouseover="mview(4)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("인천광역시")?>&sel=4" title="인천"><li style="position:absolute; width:20px; height:20px; margin-left:40px; margin-top:50px;"></li></a><!--인천-->
					<a onmouseover="mview(5)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("충청북도")?>&sel=5" title="충청북도"><li style="position:absolute; width:40px; height:40px; margin-left:90px; margin-top:100px;"></li></a><!--충청북도-->
					<a onmouseover="mview(6)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("대구광역시")?>&sel=6" title="대구"><li style="position:absolute; width:10px; height:10px; margin-left:145px; margin-top:165px;"></li></a><!--대구-->
					<a onmouseover="mview(7)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("울산광역시")?>&sel=7" title="울산"><li style="position:absolute; width:10px; height:10px; margin-left:180px; margin-top:183px; "></li></a><!--울산-->
					<a onmouseover="mview(8)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("경상남도")?>&sel=8" title="경상남도"><li style="position:absolute; width:50px; height:30px; margin-left:110px; margin-top:185px;"></li></a><!--경상남도-->
					<a onmouseover="mview(9)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("부산광역시")?>&sel=9" title="부산"><li style="position:absolute; width:20px; height:20px; margin-left:160px; margin-top:200px; "></li></a><!--부산-->
					<a onmouseover="mview(10)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=J<?=rawurlencode("전라남도")?>&sel=10" title="전라남도"><li style="position:absolute; width:80px; height:50px; margin-left:20px; margin-top:200px;"></li></a><!--전라남도-->
					<a onmouseover="mview(11)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("광주광역시")?>&sel=11" title="광주"><li style="position:absolute; width:15px; height:10px; margin-left:60px; margin-top:210px;"></li></a><!--광주-->
					<a onmouseover="mview(12)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("제주도")?>&sel=12" title="제주도"><li style="position:absolute; width:30px; height:20px; margin-left:19px; margin-top:280px;"></li></a><!--제주도-->
					<a onmouseover="mview(13)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("충청남도")?>&sel=13" title="충청남도"><li style="position:absolute; width:50px; height:40px; margin-left:23px; margin-top:98px;"></li></a><!--충청남도-->
					<a onmouseover="mview(14)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("전라북도")?>&sel=14" title="전라북도"><li style="position:absolute; width:53px; height:40px; margin-left:45px; margin-top:160px; "></li></a><!--전라북도-->
					<a onmouseover="mview(15)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("서울특별시")?>&sel=15" title="서울"><li style="position:absolute; width:10px; height:10px; margin-left:67px; margin-top:60px;"></li></a><!--서울-->
					<a onmouseover="mview(16)" style='cursor:hand' href="<?=$_SERVER[PHP_SELF]?>?tbl=<?=$Table?>&selcity=<?=rawurlencode("대전광역시")?>&sel=16" title="대전"><li style="position:absolute; width:10px; height:10px; margin-left:90px; margin-top:140px;"></li></a><!--대전-->
				</ul>
				<ul style="position:absolute; z-index:1;" >
					<li style="background:url(/images/sub/map/map01_1.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_1"></li>
					<li style="background:url(/images/sub/map/map01_2.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_2"></li>
					<li style="background:url(/images/sub/map/map01_3.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_3"></li>
					<li style="background:url(/images/sub/map/map01_4.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_4"></li>
					<li style="background:url(/images/sub/map/map01_5.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_5"></li>
					<li style="background:url(/images/sub/map/map01_6.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_6"></li>
					<li style="background:url(/images/sub/map/map01_7.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_7"></li>
					<li style="background:url(/images/sub/map/map01_8.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_8"></li>
					<li style="background:url(/images/sub/map/map01_9.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_9"></li>
					<li style="background:url(/images/sub/map/map01_10.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_10"></li>
					<li style="background:url(/images/sub/map/map01_11.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_11"></li>
					<li style="background:url(/images/sub/map/map01_12.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_12"></li>
					<li style="background:url(/images/sub/map/map01_13.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_13"></li>
					<li style="background:url(/images/sub/map/map01_14.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_14"></li>
					<li style="background:url(/images/sub/map/map01_16.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_16"></li>
					<li style="background:url(/images/sub/map/map01_15.jpg) no-repeat; width:220px; height:326px; display:none; float:left;" id="mview_15"></li>
					<!--<li style="background:url(/images/sub/map17.jpg) no-repeat; width:159px; height:235px; display:none; float:left;" id="mview_17"></li>-->
				</ul>
			</li>
		</ul>
		</div>
		<div class="right_search_option">
			<h4 class="mb5">Agents Search</h4>
			<p class="mb40">원하시는 지역을 클릭하시거나, 조건별로 검색하시면 해당 대리점을 알려드립니다.</p>

				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="store_con">
					<colgroup>
						<col width="30%">
						<col width="70%">
					</colgroup>
						<tr>
							<th scope="row" >지역</th>
							<td>
								<select name="select" id="select">
									<option value="--선택하세요--" selected="selected">---선택하세요---</option>
									<option value="서울특별시">서울특별시</option>
									<option>부산광역시</option>
									<option>대구광역시</option>
									<option>인천광역시</option>
									<option>광주광역시</option>
									<option>대전광역시</option>
									<option>울산광역시</option>
									<option>경기도</option>
									<option>강원도</option>
									<option>충청북도</option>
									<option>충청남도</option>
									<option>전라북도</option>
									<option>전라남도</option>
									<option>경상북도</option>
									<option>경상남도</option>
									<option>제주도</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row" >대리점명</th>
							<td><input type="text" name="textfield" id="textfield" style="width:100%;" /></td>
						</tr>
						<tr>
							<th scope="row" >주소</th>
							<td><input type="text" name="textfield" id="textfield" style="width:100%;" /></td>
						</tr>
				</table>
				<div class="align_r mt20"><input type="submit" value="검색" name="" class="btn_store_search1" /></div>

		</div>
	</div>
</div>

</form>

<?
	include $_SERVER["DOCUMENT_ROOT"].$Board_Admin["skin_dir"]."/lib.php";
	switch($category){
		case "서울특별시"     : $locatelist = $list1; break;
		case "부산광역시"     : $locatelist = $list2; break;
		case "대구광역시"     : $locatelist = $list3; break;
		case "인천광역시"     : $locatelist = $list4; break;
		case "광주광역시"     : $locatelist = $list5; break;
		case "대전광역시"     : $locatelist = $list6; break;
		case "울산광역시"     : $locatelist = $list7; break;
		case "경기도"         : $locatelist = $list8; break;
		case "강원도"         : $locatelist = $list9; break;
		case "충청북도"       : $locatelist = $list10; break;
		case "충청남도"       : $locatelist = $list11; break;
		case "전라북도"       : $locatelist = $list12; break;
		case "전라남도"       : $locatelist = $list13; break;
		case "경상북도"       : $locatelist = $list14; break;
		case "경상남도"       : $locatelist = $list15; break;
		case "제주도" : $locatelist = $list16; break;
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="store_board_list mt50">
	<colgroup>
		<col width="20%">
		<col width="40%">
		<col width="20%">
		<col width="20%">
	</colgroup>
	<tr>
		<th scope="row" >대리점명</th>
		<th scope="row" >주소</th>
		<th scope="row" >전화</th>
		<th scope="row" >팩스</th>
	</tr>
	<tr>
		<td class="sel_bg "> 방배점</td>
		<td> 서울특별시 서초구 방배1동 925-9 3층</td>
		<td> 02-523-2817</td>
		<td> 02-523-2863</td>
	</tr>
	<tr>
		<td class="sel_bg "> 방배점</td>
		<td> 서울특별시 서초구 방배1동 925-9 3층</td>
		<td> 02-523-2817</td>
		<td> 02-523-2863</td>
	</tr>
	<tr>
		<td class="sel_bg "> 방배점</td>
		<td> 서울특별시 서초구 방배1동 925-9 3층</td>
		<td> 02-523-2817</td>
		<td> 02-523-2863</td>
	</tr>
</table>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left">
			<? if($Url["admin"]==TRUE) { ?>
            <a href="<?=$Url["admin"]?>"><div class="bbs_btn">관리모드</div></a>
            <?=AllTable($Table,"document.ListCheck.typedbname")?>
            <? } ?>
        </td>
		<td height="50" align="right">
		<? if($Url["write"]==TRUE) { ?>
			<a href="<?=$Url["write"]?>"><div class="bbs_btn">글쓰기</div></a>
		<? } ?>
		<? if ($LogAdmin==TRUE) { ?>
			<a href="javascript:select_delete();"><div class="bbs_btn">삭제</div></a>
		<? } ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<div class="paging_wrap mt20">
				<ul class="paging">
					<?=custom_paging($default[page_list] ,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") ?>
				</ul>
			</div>
		<?//=$PageLinks?>
		</td>
	</tr>
</table>


<style>
.tit {font-weight:bold;color:#666666;text-align:center;}
.bbs_categ {line-height:22px;}
.bbs_categ  td {line-height:24px; height:24px; color:#c2c2c2; text-decoration:none;}
.bbs_categ  td a:hover{line-height:24px; height:24px; color:#f26731; text-decoration:none;}
.sub_dot{background:url('/images/sub/sub_dot.jpg') 0 4px no-repeat; padding-left:12px; vertical-align:top;}
p.mobile_regist_date{display:none; }
p.tablet_regist_date{display:none; }

.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; vertical-align:middle;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; vertical-align:middle;
-webkit-border-radius:0px;  -webkit-appearance:none; }
</style>