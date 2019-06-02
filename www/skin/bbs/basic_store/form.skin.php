<link rel="stylesheet" href="<?=$Board_Admin["skin_dir"]?>/style.css" type="text/css" media="screen" />
<script language='javascript'>
function writeChk(form) {
	if(!form.b_writer.value) {
		alert('작성자명을 입력하세요');
		form.b_writer.focus();
		return false;
	}
	if(!form.b_subject.value) {
		alert('글 제목을 입력하세요');
		form.b_subject.focus();
		return false;
	}
	<? if($Category_option==TRUE) {?>
		if(!form.b_category.value){
			alert("분류를 선택해주세요");
			return false;
		}
	<? } ?>
	<? if($Board_Admin["use_spam"]==TRUE){?>
	if(!form.zsfCode.value) {
		alert('스팸 방지를 위하여 \n\n이미지에 보이는 글자를 입력하여 주십시오     ');
		form.zsfCode.focus();
		return false;
	}
	<? }?>
    if (typeof(form.passwd) != 'undefined') {
		if(!form.passwd.value) {
			alert('비밀번호를 입력하세요. 수정 삭제시 필요합니다.');
			form.passwd.focus();
			return false;
		}
	}
	return true;
}
</script>

<style type="text/css">
.bbs_btn{width:100px; height:32px; background:#f1f1f1;  font-weight:700; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:30px; vertical-align:top; cursor:pointer; display:inline-block; }
input[type="text"].text{border:1px solid #dddddd; }
</style>


<form name="writeform" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="num" value="<?=$view["b_no"]?>">
<input type="hidden" name="b_tno" value="<?=$view["b_tno"]?>">
<input type="hidden" name="b_dep" value="<?=$view["b_dep"]?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="b_member" value="<?=$view["b_member"]?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<? if($Board_Admin["use_html"]==TRUE){?>
<input type="hidden" name="b_html" value="1">
<? }?>
<!-- ######### 게시물 복사/이동시 필요 합니다 ########### -->
<input type="hidden" name="typedbname">
<input type="hidden" name="tablecategory">


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="store_board">
	<colgroup>
		<col width="20%">
		<col width="80%">
	</colgroup>
	<tr>
		<th scope="row" >작성자</th>
		<td><input type="text" name="b_writer" style="width:80%;" value="<?=$view["b_writer"]?>" <?if($view["b_writer"]){?>readonly<?}?>/></td>
	</tr>
	<tr>
		<th scope="row" >지역</th>
		<td>
				<select name="b_category" id="b_category" style="width:30%;">
					<option value="--선택하세요--" <?if($view[b_category]==""){?> selected="selected"<?}?>>----선택하세요----</option>
					<option value="서울특별시" <?if($view[b_category]=="서울특별시"){?> selected="selected"<?}?>>서울특별시</option>
					<option value="부산광역시" <?if($view[b_category]=="부산광역시"){?> selected="selected"<?}?>>부산광역시</option>
					<option value="대구광역시" <?if($view[b_category]=="대구광역시"){?> selected="selected"<?}?>>대구광역시</option>
					<option value="인천광역시" <?if($view[b_category]=="인천광역시"){?> selected="selected"<?}?>>인천광역시</option>
					<option value="광주광역시" <?if($view[b_category]=="광주광역시"){?> selected="selected"<?}?>>광주광역시</option>
					<option value="대전광역시" <?if($view[b_category]=="대전광역시"){?> selected="selected"<?}?>>대전광역시</option>
					<option value="울산광역시" <?if($view[b_category]=="울산광역시"){?> selected="selected"<?}?>>울산광역시</option>
					<option value="경기도" <?if($view[b_category]=="경기도"){?> selected="selected"<?}?>>경기도</option>
					<option value="강원도" <?if($view[b_category]=="강원도"){?> selected="selected"<?}?>>강원도</option>
					<option value="충청북도" <?if($view[b_category]=="충청북도"){?> selected="selected"<?}?>>충청북도</option>
					<option value="충청남도" <?if($view[b_category]=="충청남도"){?> selected="selected"<?}?>>충청남도</option>
					<option value="전라북도" <?if($view[b_category]=="전라북도"){?> selected="selected"<?}?>>전라북도</option>
					<option value="전라남도" <?if($view[b_category]=="전라남도"){?> selected="selected"<?}?>>전라남도</option>
					<option value="경상북도" <?if($view[b_category]=="경상북도"){?> selected="selected"<?}?>>경상북도</option>
					<option value="경상남도" <?if($view[b_category]=="경상남도"){?> selected="selected"<?}?>>경상남도</option>
					<option value="제주도" <?if($view[b_category]=="제주도"){?> selected="selected"<?}?>>제주도</option>
				</select>
		</td>
	</tr>
	<tr>
		<th scope="row" >대리점명</th>
		<td><input type="text" name="b_subject" style="width:80%;" value="<?=$view["b_subject"]?>"/></td>
	</tr>
	<tr>
		<th scope="row" >주소</th>
		<td><input type="text" name="b_ex2" id="b_ex2" style="width:80%;" value="<?=$view["b_ex2"]?>"/></td>
	</tr>
	<tr>
		<th scope="row" >전화</th>
		<td><input type="text" name="b_ex3" id="b_ex3" style="width:80%;" value="<?=$view["b_ex3"]?>"/></td>
	</tr>
	<tr>
		<th scope="row" >팩스</th>
		<td><input type="text" name="b_ex4" id="b_ex4" style="width:80%;" value="<?=$view["b_ex4"]?>"/></td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="50" valign="middle">
		<td style="padding-left:50px;">
			<input type="submit" border="0" onclick="return writeChk(writeform)" value="확인" class="bbs_btn">&nbsp;
			<a href="<?=$Url["list"]?>"><div class="bbs_btn" style="background:#ffffff">목록</div></a>
		</td>
	</tr>
</table>

</form>