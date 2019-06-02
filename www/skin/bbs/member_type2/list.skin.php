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

<style type="text/css">
.f_right{float:right; }
.bbs_btn{width:80px; height:27px; background:#ffffff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:25px; display:inline-block;}
.professor {width:100%; position:relative; overflow:hidden; }
.professor .pf_con {float:left; position:relative; overflow:hidden; margin-bottom:40px; width:48%;  }
.md_p{margin-left:4%; }
.professor .pf_con .pf_img {width:112px; height:132px; float:left; border:1px solid #ddd; }
.professor .pf_con .pf_img .pf_img_sizing{width:110px; height:130px; display:table-cell; text-align:center; vertical-align:middle; }
.professor .pf_con .pf_img img{max-width:110px; max-height:130px}
.professor .pf_con .pf_txt {float:left; width:65%; margin-left:5%;}
.professor .pf_con .pf_txt dl {overflow:hidden; line-height:24px;}
.professor .pf_con .pf_txt dt {float:left; width:60px; font-size:13px; font-weight:bold;}
.professor .pf_con .pf_txt dd {float:left; width:120px; font-size:13px;}

</style>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
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

<tr>
	<td>



<div class="professor">


	<? for($i=0; $i<$list_total; $i++){

	if($i%2==0){$md_p="";}

	else{$md_p="md_p";}
	?>

	<div class="pf_con <?=$md_p?>" >
		<div class="pf_img">
			<a href="<?=$list[$i]["viewUrl"]?>">
				<div class="pf_img_sizing">
					<img src="<?=$list[$i]["img_1"]?>"  border="0">
				</div>
			</a>
		</div>
		<div class="pf_txt"  >

			<dl ><?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>' style="vertical-align:middle;border:0;"><?}?>
				<dt>성명</dt>
				<dd ><?=$list[$i]["b_writer"]?></dd>
			</dl>
			<dl>
				<dt>학위과정</dt>
				<dd><?=$list[$i]["b_ex1"]?></dd>
			</dl>
			<dl>
				<dt>이메일</dt>
				<dd style="width: 160px;word-break:break-all;"><?=$list[$i]["b_email"]?></dd>
			</dl>
			<dl>
				<dt>연구분야</dt>
				<dd style="width: 160px;"><?=$list[$i]["b_ex3"]?></dd>
			</dl>
		</div>
	</div>

	<?}?>

		 <? if($i==0) { ?>
			  <tr>
				<td height="80" colspan="26" align="center">등록된 게시물이 없습니다.</td>
			  </tr>
		 <? } ?>
	</div>

	<div class="mt30 f_right">
	<? if($Url["write"]==TRUE) { ?>
	<a href="<?=$Url["write"]?>"><div class="bbs_btn">글쓰기</div></a>
	<? } ?>
	<? if ($LogAdmin==TRUE) { ?>
	<a href="javascript:select_delete();"><div class="bbs_btn">삭제</div></a>
	<? } ?>
	</div>



	<table width="80%"  >
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






</td>
</tr>

</form>
</table>