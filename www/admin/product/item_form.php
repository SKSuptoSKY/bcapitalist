<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$title_page = "팀";

if ($mode=="W") {
	$title_page .= "입력";

	// 옵션은 쿠키에 저장된 값을 보여줌. 다음 입력을 위한것임
	$it[ca_id] = $_COOKIE[ck_ca_id];
	if (!$it[ca_id])
	{
		$sql = " select ca_id from $JO_table order by ca_id limit 1 ";
		$row = sql_fetch($sql);
		if (!$row[ca_id])
			alert("등록된 분류가 없습니다. 우선 분류를 등록하여 주십시오.");
		$it[ca_id] = $row[ca_id];
	}
	//$it[it_maker]  = stripslashes($_COOKIE[ck_maker]);
	//$it[it_origin] = stripslashes($_COOKIE[ck_origin]);

} else if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * from $PG_table where it_id = '$it_id' ";
	$it = sql_fetch($sql);
	$content  = $it[it_explan];

	if (!$ca_id)
		$ca_id = $it[ca_id];

	$sql = " select * from $JO_table where ca_id = '$ca_id' ";
	$ca = sql_fetch($sql);
} else {
	alert("잘못된 경로로 접근하셨습니다.");
}

if (!$it[it_explan_html])
{
	$it[it_explan] = get_text($it[it_explan], 1);
}

$qstr = "sca=$sca&page=$page";
?>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
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

<script language='JavaScript' src='./lib/javascript.js'></script>
<form name=WriteForm method=post action="./item_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="codedup" value="<?=$default[de_code_dup_use]?>">
<input type=hidden name="page" value="<?=$page?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">분류</td>
		<td>
			<select name="ca_id">
				<option>= 카테고리선택 =
				<?
					// 분류
					$ca_list  = "";
					$sql = " select * from $JO_table order by ca_id ";
					$result = sql_query($sql);

					for ($i=0; $row=sql_fetch_array($result); $i++)
					{
						$len = strlen($row[ca_id]) / 2 - 1;
						$nbsp = "";
						for ($i=0; $i<$len; $i++) {
							$nbsp .= "&nbsp;&nbsp;&nbsp;";
						}
						if($it[ca_id]==$row[ca_id]) $selected = "selected"; else $selected = "";
						$ca_list .= "<option value='$row[ca_id]' $selected>$nbsp$row[ca_name]";
					}
					echo $ca_list;
				?>
			</select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">코드</td>
		<td>
	<? if ($mode == "W") { // 추가 ?>
		<input type=text class=ed name=it_id value="<?=time()?>" size=12 maxlength=10 required nospace alphanumeric itemname="제품코드">
        <? if ($default[de_code_dup_use]) { ?><a href='javascript:;' onclick="codedupcheck(document.all.it_id.value)"><img src='./img/btn_code.gif' border=0 align=absmiddle></a><? } ?>
	<? } else { ?>
		<input type=hidden name=it_id value="<?=$it[it_id]?>"><?=$it[it_id]?>
		<!-- | <a href='/product/item.php?ca_id=<?=$ca[ca_id]?>&it_id=<?=$it_id?>'>보기</a> -->
		<!--
		<a href='./itemps_list.php?sel_ca_id=<?=$it[ca_id]?>&it_id=<?=$it_id?>'>사용후기</a>
		<a href='./itemqa_list.php?sel_ca_id=<?=$it[ca_id]?>&it_id=<?=$it_id?>'>제품문의</a>
		-->
	<? } ?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">성명</td>
		<td>
			<input type="text"  name="it_name" value="<?=get_text(cut_str($it[it_name], 250, ""))?>" style="width:50%; height:19px;" class="text">
		</td>
	</tr>
	<!--tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력유형</td>
		<td>
			<input type="checkbox" name="it_gallery" value="1" <?=($it[it_gallery] ? "checked" : "")?>> 갤러리로 사용
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력순서</td>
		<td>
        	<select name="it_order">
            	<? for($i=1;$i<=30;$i++){?>
                <option value="<?=$i?>"<?=($i==$it[it_order]||($mode=="W"&&$i=="30"))?" selected":"";?>><?=$i?></option>
                <? }?>
            </select>
		</td>
	</tr-->
	<!--
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">제품유형</td>
		<td>
			<input type="checkbox" name="it_type1" value="1" <?=($it[it_type1] ? "checked" : "");?>>메인추출제품
			<input type="checkbox" name="it_type2" value="1" <?=($it[it_type2] ? "checked" : "");?>>행사제품
			<input type="checkbox" name="it_type3" value="1" <?=($it[it_type3] ? "checked" : "");?>>추천제품
			<input type="checkbox" name="it_type4" value="1" <?=($it[it_type4] ? "checked" : "");?>>메인추출제품
		</td>
	</tr>
	-->
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">학력</td>
		<td>
			<input type="text" name="it_ex1" value="<?=get_text($it[it_ex1])?>" style="width:50%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">약력</td>
		<td>
			<textarea name="it_explan" rows=6 cols=108><?=get_text(strip_tags($it[it_explan]))?></textarea>
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">항목3</td>
		<td>
			<input type="text" name="it_ex3" value="<?=get_text($it[it_ex3])?>" style="height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">가격</td>
		<td>
			<input type="text" name="it_pay" value="<?=$it[it_pay]?>" style="height:19px;" class="text"> 원
		</td>
	</tr>
	-->
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">성명(영문)</td>
		<td>
			<input type="text"  name="it_name_en" value="<?=get_text(cut_str($it[it_name_en], 250, ""))?>" style="width:50%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">학력(영문)</td>
		<td>
			<input type="text" name="it_ex1_en" value="<?=get_text($it[it_ex1_en])?>" style="width:50%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">약력(영문)</td>
		<td>
			<textarea name="it_explan_en" rows=6 cols=108><?=get_text(strip_tags($it[it_explan_en]))?></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">노출여부</td>
		<td>
			<input type="checkbox" name='it_use' <? echo ($it[it_use] || $mode=="W") ? "checked" : ""; ?> value='1'> 예
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">순서</td>
		<td>
			<input type="text" name='it_order' value='<?=$it[it_order]?>'>
			<span>숫자가 높을수록 우선 출력됩니다.</span>
		</td>
	</tr>
</table>
<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
	<!--
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 내용</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<input type="hidden" name="it_explan_html" value="1">
			<textarea name="it_explan" id="it_explan" rows="20" style="width:100%;" class="text"><?=$it[it_explan]?></textarea>
            <font color="#FF9933">
            에디터 사용시 가로 670픽셀 넘지 않도록 엔터로 조절해 주세요
            <br />
            이미지도 670필셀 넘지 않도록 올려 주세요(너무 큰 이미지는 로딩시간이 길어 질 수 있습니다)
            </font>
            <br />
		</td>
	</tr>
	-->
	<!--
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 저자소개</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<textarea name="it_explan2" cols="90" rows="15"></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 목차</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<textarea name="it_explan3" cols="90" rows="15"></textarea>
		</td>
	</tr>
	-->
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 이미지 등록</b>
		</td>
	</tr>
	<? for ($i=1; $i<=$GnProd["max_img_count"]; $i++) { ?>
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#F0F0F0" style="width:150px; padding-left:10px">이미지</td>
			<td>
				<input type="file" name="it_limg<?=$i?>" style="width:90%; height:19px;" class="text"><br>
				<?
				################## [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력. - START ] ##################
				$file_name[$i]["small"] = str_replace($it[it_id]."_l", $it[it_id]."_s", $it["it_file".$i]);
				$limg = $GnProd["prod_item_dir"]."/".$file_name[$i]["small"];

				if ( $file_name[$i]["small"] ) {
					$limg= img_resize_tag($GnProd["prod_item_url"]."/".$file_name[$i]["small"],100,100);
					echo "{$limg}<input type=checkbox name=it_limg{$i}_del value='1'>삭제";
				}
				##################   [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력 - END ]  ##################
				?>
			</td>
		</tr>
	<? } ?>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
			<a href="./item_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
var f = document.WriteForm;

function codedupcheck(id)
{
    if (!id) {
        alert('제품코드를 입력하십시오.');
        f.it_id.focus();
        return;
    }

    window.open("./codedupcheck.php?it_id="+id+"&frmname=WriteForm", "hiddenframe");
}

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }
    if (f.mode.value == "W") {
        if (f.codedup.value == '1') {
            alert("코드 중복검사를 하셔야 합니다.");
            return false;
        }
    }
    oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	return true;
}

document.WriteForm.it_name.focus();
</script>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "it_explan",
		sSkinURI: "/editor/SmartEditor3Skin.html",	
		htParams : {bUseToolbar : true,
			fOnBeforeUnload : function(){
			}
		}, //boolean
			fOnAppLoad : function(){
			//예제 코드
			},
		fCreator: "createSEditor2"
	});

	function pasteHTML() {
		var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
		oEditors.getById["it_explan"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["it_explan"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["it_explan"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("it_explan").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["it_explan"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["it_explan"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>