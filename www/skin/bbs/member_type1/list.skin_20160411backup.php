
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

<style>
.tit {font-weight:bold;color:#666666;text-align:center;}
.bbs_categ {line-height:22px;}
.bbs_categ  td {line-height:24px; height:24px; color:#c2c2c2; text-decoration:none;}
.bbs_categ  td a:hover{line-height:24px; height:24px; color:#f26731; text-decoration:none;}
.sub_dot{background:url('/images/sub/sub_dot.jpg') 0 4px no-repeat; padding-left:12px; vertical-align:top;}
.bbs_btn{width:70px; height:25px; background:#f8f8f8; color:#111; font-weight:700; border:1px solid #dbdbdb; text-align:center; line-height:2; display:inline-block;}
</style>
<?if($Board_Admin["use_category"] == TRUE and $Board_Admin["use_category_top"] == TRUE) {?>
<table   width="100%" cellpadding="0" cellspacing="0" border="0" class="bbs_categ">
	<tr align="center">
	  <td style="border:1px solid #ffb497;" >
			<table   width="94%" cellpadding="0" cellspacing="0" border="0"  style="margin-top:10px; margin-bottom:10px;">
				<colgroup>
				<col width="25%"/>
				<col width="25%"/>
				<col width="25%"/>
				<col width="25%"/>
				</colgroup>
					<?
								$CategoryCntSql = " select count(*) as cnt from $BB_table where 1";
								$CategoryCntRow = sql_fetch($CategoryCntSql,FALSE);
								$Category_total_count = $CategoryCntRow[cnt];
								$categoryRES= explode(",",$Board_Admin["category"]);
								//print_r2($categoryRES);
								$categoryCNT = count($categoryRES);
					?>
							<td align="left" class="sub_dot">
								<a href="/bbs/board.php?tbl=<?=$Table?>" ><?
								if($category==null)
								{
									?><span style="color:#f26731;"><!-- font-weight:bold; --><?
								}
								?>전체(<?=$Category_total_count?>)
								</span></a>
							</td>
							<?
							if($categoryRES[0]){
								for($cs=1; $cs<$categoryCNT+1; $cs++) {
									$j = $cs-1;
									$CategoryCnt_Where = "where b_category = '".$categoryRES[$j]."' ";
									$CategoryCntSql = " select count(*) as cnt from $BB_table $CategoryCnt_Where";
									$CategoryCntRow = sql_fetch($CategoryCntSql,FALSE);
									$Category_total_count = $CategoryCntRow[cnt];
									if($cs%4 == "0" && $cs != 0)
									{
										echo "</tr><tr>";
									}
									?>
									<td align="left" class="sub_dot">
										<a href="/bbs/board.php?tbl=<?=$Table?>&category=<?=$categoryRES[$j]?>" >
										<?
										if($category==$categoryRES[$j])
										{
											?><span style="color:#f26731;"><!-- font-weight:bold; --><?
										}
										?>
										<?=cut_str($categoryRES[$j],50)?>(<?=$Category_total_count?>)
										</span></a>
									</td>
									<?
								}
							}

							for($i=$cs;$i<4;$i++)
							{
								?>
								<td width="20%" align="left">&nbsp;</td>
								<?
							}
							?>
			</table>
	  </td>
	</tr>
</table>
<?}?>
<br />

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

<DIV id="DivContents">
<? for ($i=0; $i<$list_total; $i++) { ?>
	<div class="lab_member">
		<div class="lab_member_pic">
			<table width="200px" height="180px">
				<tr>
					<td style="text-align: center;">
						<?if($list[$i]["img_1"]){?>
							<?if($LogAdmin==TRUE){?><a href="/bbs/board.php?tbl=<?=$Table?>&mode=MODIFY&num=<?=$list[$i]["b_no"]?>"><?}?>
								<img src="<?=$list[$i]["img_1"]?>" height="180px" alt="" />
							<?if($LogAdmin==TRUE){?></a><?}?>
						<?}else{?>
							<?if($LogAdmin==TRUE){?><a href="/bbs/board.php?tbl=<?=$Table?>&mode=MODIFY&num=<?=$list[$i]["b_no"]?>"><?}?>
								<img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97180&w=200&h=180" height="180px" alt="" />
							<?if($LogAdmin==TRUE){?></a><?}?>
						<?}?>
					</td>
				</tr>
			</table>
		</div>
		<div class="lab_member_profile">
			<table width="520" cellpadding="0" cellspacing="0" border="0" class="member_profile">
				<colgroup>
					<col width="130px"/>
					<col width="390px" />
				</colgroup>
				<tr>
					<th scope="row" class="top_bd">
						Name
						<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style="vertical-align:middle;border:0;"><?}?>
					</th>
					<td class="top_bd"><?=cut_str($list[$i]["subject"],"50")?></td>
				</tr>
				<tr>
					<th scope="row">Room</th>
					<td><?=cut_str($list[$i]["b_ex1"],"50")?></td>
				</tr>
				<tr>
					<th scope="row">Phone</th>
					<td><?=cut_str($list[$i]["b_ex2"],"50")?></td>
				</tr>
				<tr>
					<th scope="row">E-mail</th>
					<td><?=cut_str($list[$i]["b_email"],"50")?></td>
				</tr>
				<tr>
					<th scope="row">Remark</th>
					<td><?=cut_str($list[$i]["b_ex3"],"50")?></td>
				</tr>
				<tr>
					<th scope="row">Research interest</th>
					<td><?=cut_str($list[$i]["b_ex4"],"50")?></td>
				</tr>
			</table>
		</div>
	</div>
<? } ?>
<? if($i==0) { ?>
	<div class="lab_member">
		등록된 게시물이 없습니다.
	</div>
<? } ?>
</DIV>

</form>








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
			<div class="paginate mt20">
				<ul>
					<?=custom_paging($default[page_list] ,$page, $total_page, "$_SERVER[PHP_SELF]?tbl=$Table&$PageNext&$NextUrl&page=") ?>
				</ul>
			</div>
		<?//=$PageLinks?>
		</td>
	</tr>
</table>

<!-- <div class="board_search mt20 mb50">
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
						<? if($Board_Admin["use_category"] == TRUE) { ?>
							<select name="category" style="height:28px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid; font-size:13px;">
								<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
								<?=$Category_option?>
							</select>
						<? } ?>
							<select name="findType">
								<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
								<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
								<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
								<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
							</select>
							&nbsp;<input type="text" name="findWord" class="board_search_area" placeholder="검색어를 입력하세요" value="<?=$findword?>">&nbsp;<input type="submit" value="검색" class="board_btn_seach"/>
						</td>
				</form>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div> -->
<style>
.board_search{height:30px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc;}
.board_search input{height:28px; box-sizing:border-box; font-size:13px; }
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold; }
</style>

<script type="text/javascript">
function imgResize()
{
    // DivContents 영역에서 이미지가 maxsize 보다 크면 자동 리사이즈 시켜줌
    maxsize = "200";		// 가로사이즈 ( 다른값으로 지정하면됨)
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
window.onload = function(){
 imgResize();
}
</script>