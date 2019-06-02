<?
	include "../head.php";

$PG_table = $GnTable["bbsconfig"];
$JO_table = "";

if($mode=="E") {
	$title_page = "게시판 수정";

	$sql = " select * from $PG_table where code = '$id' ";
    $view = sql_fetch($sql);

	if($id==FALSE) alert("수정하실 게시판을 선택해주세요");
} else if($mode=="W") {
	$title_page = "게시판 등록";

	//// 게시판 기본설정 값을 입력합니다.
	$view["width"] = 100;
	$view["page_rows"] = 10;
	$view["page_block"] = 10;
	$view["listcount"] = 4;
	$view["imgsize"] = 500;
	$view["fileupnum"] = 1;
	$view["fileupsize"] = 60000000;
	$view["view"] = 1;
	$view["view_sort"]=0;
	$view["head"] = "../head.php";
	$view["foot"] = "../foot.php";
	$view["sum_width"]=150;
	$view["sum_height"]=150;
	$view["sum_resize"]=1;
	$view["use_html"]="1";
	$view["level_write"]="10";
	$view["level_reple"]="10";
	$view["level_com"]="10";
	$view["level_html"]="100";
	$view["level_notice"]="100";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function fitemformcheck(form) {

	if (typeof form.dbname != "undefined") {
		if(isEnglish(form.dbname) == false) { form.dbname.value=''; form.dbname.focus(); return false; }
		//if(strLen(form.dbname,4,15) == false) { form.dbname.value=''; form.dbname.focus(); return false; }
		if(strLen(form.dbname,1,25) == false) { form.dbname.value=''; form.dbname.focus(); return false; }
	}

	if(!form.title.value) {
		alert('게시판 제목을 입력하세요');
		form.title.focus();
		return false;
	}
	return true;
}
//-->  
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=F method=post action="./config_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="id"  value="<?=$id?>">
<input type=hidden name="page"  value="<?=$page?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
	<tr>
		<td width="55%" valign="top">
			<table width="99%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">테이블명</td>
					<td>
					<? if($mode=="W") { ?>
						<input type="text"  name="dbname" value="<?=$view["dbname"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					<? } else { ?>
						<input type=hidden name="dbname"  value="<?=$view["dbname"]?>"><?=$view["dbname"]?>
					<? } ?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
					<td>
						<input type="text"  name="title" value="<?=$view["title"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">메뉴</td>
					<td height="28">
						<select name="boardgroup">
							<option value="">- 메뉴선택 - </option>
							<?=group_select($view["boardgroup"]);?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">스킨</td>
					<td height="28">
						<select name="skin">
							<?=Get_skin("bbs",$view["skin"]);?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">테이블 너비</td>
					<td>
						<input type="text"  name="width" value="<?=$view["width"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">페이지 목록 수</td>
					<td>
						<input type="text"  name="page_rows" value="<?=$view["page_rows"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">페이지 블럭 수</td>
					<td>
						<input type="text"  name="page_block" value="<?=$view["page_block"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">리스트 이미지 수</td>
					<td>
						<input type="text"  name="listcount" value="<?=$view["listcount"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">리스트 제목글자수</td>
					<td>
						<input type="text"  name="listsubject" value="<?=$view["listsubject"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">이미지크기</td>
					<td>
						<input type="text"  name="imgsize" value="<?=$view["imgsize"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">썸네일크기</td>
					<td>
						Width: <input type="text"  name="sum_width" value="<?=$view["sum_width"]?>" style="width:50px; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> px,&nbsp;
						Height: <input type="text"  name="sum_height" value="<?=$view["sum_height"]?>" style="width:50px; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> px&nbsp;&nbsp;
						<input type="checkbox" name="sum_resize" value="1" <? if ($view["sum_resize"]) { ?>checked<? } ?>> 비율유지
						<input type="checkbox" name="sum_flag" value="1" <? if ($view["sum_flag"]) { ?>checked<? } ?>> 사용 <font color="red" style="font-size:9pt">* 갤러리게시판 사용시 체크 * 반응형 갤러리게시판 사용시 사용 미체크</font>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">view이미지</td>
					<td>
                    	<input type=radio name='use_view' <? echo ($view["use_view"]) ? "checked" : ""; ?> value='1'> 사용 &nbsp;<input type=radio name='use_view' <? echo (!$view["use_view"]) ? "checked" : ""; ?> value='0'> 미사용
                    </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">파일업로드수</td>
					<td>
						<input type="text"  name="fileupnum" value="<?=$view["fileupnum"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">업로드용량제한</td>
					<td>
						업로드 파일 한개당  <input type="text"  name="fileupsize" value="<?=$view["fileupsize"]?>" style="width:50px; height:19px;" class="text">bytes 이하
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">페이지코드</td>
					<td>
						<input type="text"  name="page_loc" value="<?=$view["page_loc"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시판 상단 파일</td>
					<td>
						<input type="text"  name="head" value="<?=$view["head"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시판 상단 태그</td>
					<td>
						<textarea NAME='headtag' style='width:95%; height:145'><?=stripslashes($view[headtag]);?></textarea>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시판 하단 파일</td>
					<td>
						<input type="text"  name="foot" value="<?=$view["foot"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시판 하단 태그</td>
					<td>
						<textarea NAME='foottag' style='width:95%; height:145'><?=stripslashes($view[foottag]);?></textarea>
					</td>
				</tr>
			</table>
		</td>
		<td width="45%" valign="top">
			<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
			<colgroup width=100>
			<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">카테고리</td>
					<td>
						<input type="text"  name="category" value="<?=$view["category"]?>" style="width:100%; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"><br><font color="red" style="font-size:8pt">* 각 분류는 쉽표 로 구분해주세요 예)공지,질문,답변</font><br><input type=radio name='use_category' <? echo ($view["use_category"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_category' <? echo (!$view["use_category"]) ? "checked" : ""; ?> value='0'> 미사용  <br><font color="blue" style="font-size:8pt">* 분류입력후 사용유무를 선택해주세요</font><br><input type=radio name='use_category_top' <? echo ($view["use_category_top"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_category_top' <? echo (!$view["use_category_top"]) ? "checked" : ""; ?> value='0'> 미사용<br><font color="blue" style="font-size:8pt">* 카테고리 상단 출력 사용유무를 선택해주세요</font><br>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시글<br>복사/이동 설정</td>
					<td>
                    	<?
							$bbs_cm_res = sql_query("select * from {$GnTable[bbsconfig]} where 1 and view=1 and code!='$id' order by dbname ASC ");
							for($bcm=1;$bbs_mc=sql_fetch_array($bbs_cm_res);$bcm++){
								if(eregi($bbs_mc[dbname],$view[copymove])) $checked = " checked";
								else $checked = "";
								if($bcm%2==0) echo "<input type=\"checkbox\" name=\"bbscm[]\" value=\"".$bbs_mc[dbname]."\" $checked> ".$bbs_mc[title]."<br>";
								else echo "<input type=\"checkbox\" name=\"bbscm[]\" value=\"".$bbs_mc[dbname]."\" $checked> ".$bbs_mc[title]."&nbsp;";
							}
						?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">스팸방지</td>
					<td>
                    	<input type=radio name='use_spam' <? echo ($view["use_spam"]) ? "checked" : ""; ?> value='1'> 사용 &nbsp;<input type=radio name='use_spam' <? echo (!$view["use_spam"]) ? "checked" : ""; ?> value='0'> 미사용
                    	<font color="red" style="font-size:8pt">* 스팸방지 폼 사용시 체크</font>
                    </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">댓글달기</td>
					<td><input type=radio name='use_comment' <? echo ($view["use_comment"]) ? "checked" : ""; ?> value='1'> 사용 &nbsp;<input type=radio name='use_comment' <? echo (!$view["use_comment"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">비밀게시글</td>
					<td><input type=radio name='use_secret' <? echo ($view["use_secret"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_secret' <? echo (!$view["use_secret"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">비밀게시판</td>
					<td><input type=radio name='use_asecret' <? echo ($view["use_asecret"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_asecret' <? echo (!$view["use_asecret"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">HTML태그</td>
					<td>
                    	<input type=radio name='use_html' <? echo ($view["use_html"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_html' <? echo (!$view["use_html"]) ? "checked" : ""; ?> value='0'> 미사용
                    	<font color="red" style="font-size:8pt">* 에디터박스 사용시 체크</font>
                    </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">공지사항</td>
					<td><input type=radio name='use_notice' <? echo ($view["use_notice"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_notice' <? echo (!$view["use_notice"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">자료실</td>
					<td><input type=radio name='use_data' <? echo ($view["use_data"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_data' <? echo (!$view["use_data"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">답글</td>
					<td><input type=radio name='use_reply' <? echo ($view["use_reply"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_reply' <? echo (!$view["use_reply"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">게시글추천</td>
					<td><input type=radio name='use_best' <? echo ($view["use_best"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_best' <? echo (!$view["use_best"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">댓글추천</td>
					<td><input type=radio name='use_combest' <? echo ($view["use_combest"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='use_combest' <? echo (!$view["use_combest"]) ? "checked" : ""; ?> value='0'> 미사용</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">
					SNS
					</td>
					<td style='vertical-align:middle;'>
					&nbsp;&nbsp;
					카카오톡
					<input type=checkbox name='use_kakotalk' <? echo ($view["use_kakotalk"]) ? "checked" : ""; ?> value='1' style='vertical-align:middle;'>
					&nbsp;&nbsp;
					카카오 스토리
					<input type=checkbox name='use_kakostory' <? echo ($view["use_kakostory"]) ? "checked" : ""; ?> value='1' style='vertical-align:middle;'>&nbsp;&nbsp;
					페이스북
					<input type=checkbox name='use_facebook' <? echo ($view["use_facebook"]) ? "checked" : ""; ?> value='1' style='vertical-align:middle;'> &nbsp;&nbsp;
					트위터
					<input type=checkbox name='use_twitter' <? echo ($view["use_twitter"]) ? "checked" : ""; ?> value='1' style='vertical-align:middle;'></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">보기 리스트<br></td>
					<td><input type=radio name='view_list' <? echo ($view["view_list"]) ? "checked" : ""; ?> value='1'> 사용&nbsp; <input type=radio name='view_list' <? echo (!$view["view_list"]) ? "checked" : ""; ?> value='0'> 미사용 <br>
						<input type=radio name=view_sort value='0' <? if($view[view_sort]=="0")  echo "checked"; else echo "";?>> 내용 하단 
						<input type=radio name=view_sort value='1' <? if($view[view_sort]=="1")  echo "checked"; else echo "";?>> 내용 상단 
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">리스트 접근 권한</td>
					<td>
						<select name="level_list">
							<?=Get_level($view[level_list]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">쓰기 권한</td>
					<td>
						<select name="level_write">
							<?=Get_level($view[level_write]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">답변 쓰기 권한</td>
					<td>
						<select name="level_reple">
							<?=Get_level($view[level_reple]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">보기 접근 권한</td>
					<td>
						<select name="level_view">
							<?=Get_level($view[level_view]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">코멘트 쓰기 권한</td>
					<td>
						<select name="level_com">
							<?=Get_level($view[level_com]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">HTML 쓰기 권한</td>
					<td>
						<select name="level_html">
							<?=Get_level($view[level_html]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">공지 쓰기 권한</td>
					<td>
						<select name="level_notice">
							<?=Get_level($view[level_notice]) ?>
						</select>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">글쓰기 포인트</td>
					<td><input type=text name='point_write' style="width:80px;text-align:right;" value='<?=$view["point_write"]?>'> </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">답글(답변) 포인트</td>
					<td><input type=text name='point_replay' style="width:80px;text-align:right;" value='<?=$view["point_replay"]?>'> </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">코멘트(댓글) 포인트</td>
					<td><input type=text name='point_comment' style="width:80px;text-align:right;" value='<?=$view["point_comment"]?>'> </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">추천시 포인트</td>
					<td><input type=text name='point_chu' style="width:80px;text-align:right;" value='<?=$view["point_chu"]?>'> </td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px;">보이기</td>
					<td><input type=checkbox name='view' <? echo ($view["view"]) ? "checked" : ""; ?> value='1'> 체크하셔야 사용하실 수 있습니다.</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./config_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>
</form>