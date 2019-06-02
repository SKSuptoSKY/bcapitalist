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
function content_view(name) {
	var Browser = {
		a: navigator.userAgent.toLowerCase()
		}
		Browser = {
			ie : Browser.a.indexOf('msie') != -1
			,safari : Browser.a.indexOf('safari') != -1
			,firefox : Browser.a.indexOf('firefox') != -1
			,chrome : Browser.a.indexOf('chrome') != -1
		}
		//참고로..jquery서  xml 태그들  잡아올때 "<im:image>" < 이런식의 태그가있다.
		//크롬에선 $("image")만 해줘도 되지만
		//파폭이나, 익스서는 잡아오지못해서 $("im\\:artist") 해줘야한다. 이건 또 크롬에서 안된다 ㅡ.ㅡ;;
	if(Browser.chrome) var browser_check="c";
	else if(Browser.ie) var browser_check="i";
	else if(Browser.firefox) var browser_check="f";
	else var browser_check="d";
	submenu=eval(name+".style");
	if (old!=submenu) {
		if(old!='') {
		old.display='none';
	}
	if(browser_check == "c" || browser_check == "f") {
		submenu.display='table-row';
		} else {
		submenu.display='block';
		}
		old=submenu;
		} else {
		submenu.display='none';
	old='';
	}
	parent.autoResize("item_iframe");
}

function deleteChk(url) {
	yes_no = confirm('삭제하시면 다시 복구하실 수 없습니다.\n\n삭제하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때
			location.href=url
	}
}
//parent.resize_frame("ok");
</script>

<!-- ------------------------------------------------------------- [ 원본 게시판 스킨 - START ] ------------------------------------------------------------- -->
<div id="mainContent">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="shop_boardtb">
			<caption></caption>
			<col width="10%" />
			<col width="65%" />
			<col width="15%" />
			<col width="10%" />
			<tbody>
				<tr height="35">
					<th class="ttal">번호</th>
					<th class="ttal">제목</th>
					<th class="ttal">작성일</th>
					<th class="ttal">조회수</th>
				</tr>
				<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr>
					<td class="ttal"><?=$list[$i]["no"]?></td>
					<!-- 제목 -->
					<?
						//원본글이 비밀글이면 비밀글 아이콘 표시한다. (list.php 에서 비밀글 아이콘이 뎁스만큼 들여쓰기가 안되 뎁스부분에 $list[$i]["secret"]을 직접 넣었기때문에 원본글에 비밀글 표시가 안뜬다).
						if( $list[$i][b_dep]=="A" ) {
							$secret_icon = $list[$i]["secret"];
						}
						else {
							$secret_icon = "";
						}
					?>
					<td><a href="<?=$list[$i]["viewUrl"]?>"><?=$list[$i]["subject"]?></a><span class="iconpd"><?=$list[$i]["comment"]?><?=$list[$i]["secret"]?> <?=$list[$i]["new"]?><?=$list[$i]["file_icon"]?></span></td>
					<td class="ttal"><?=cut_str($list[$i]["b_regist"],10,'')?></td>
					<td align="center"><?=$list[$i]["hit"]?></td>
				</tr>
				<? } ?>
				<? if($i==0) { ?>
				<tr>
					<td height="80" colspan="4" align="center" class="last">등록된 게시물이 없습니다.</td>
				</tr>
				<? } ?>
				</tbody>
			</form>
		</table>
		<div class="shop_bd_btn" >
			<div style="float:right;">
				<? if($Table == "shop_review" && $_GET[review_flag] == "ok"){ ?>
					<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" alt="글쓰기" /></a>
				<? } ?>
				<?if($Table == "shop_qna") {?>
					<? if($Url["write"]) {?>
						<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" alt="글쓰기" /></a>
					<? } ?>
				<?}?>
			</div>
		</div>
		<div class="nblink"><?=$PageLinks?></div>
</div> <!-- main_contents 끝 -->
<!-- ------------------------------------------------------------- [ 원본게시판스킨 - START ] ------------------------------------------------------------- -->