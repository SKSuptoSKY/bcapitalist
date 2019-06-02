<?
include "../head.php";

$title_page = "과정";

if ($mode=="W") {
	$title_page .= "입력";

} else if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * from Gn_Lecture where lec_no = '$no' ";
	$lec = sql_fetch($sql);

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
<form name=WriteForm method=post action="./update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="codedup" value="<?=$default[de_code_dup_use]?>">
<input type=hidden name="page" value="<?=$page?>">
<input type="hidden" name="lec_no" value="<?=$no?>">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">강의명</td>
		<td>
			<input type="text" name="lec_subject" value="<?=get_text(cut_str($lec[lec_subject], 250, ""))?>" style="width:50%; height:19px;" class="text">
			<span>12글자 이내로 작성해주십시오.</span>
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">강의기간</td>
		<td>
			<input name="lec_frDT" type="text" size="10" value="<?=substr($lec[lec_frDT],0,10)?>" readonly onfocus="showCalendarControl(this);"> ~
			<input name="lec_enDT" type="text" size="10" value="<?=substr($lec[lec_enDT],0,10)?>" readonly onfocus="showCalendarControl(this);">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">가격</td>
		<td>
			<input type="text" name="lec_pay" value="<?=number_format($lec[lec_pay])?>" style="width:15%; height:19px;" class="text">원
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">노출여부</td>
		<td>
			<input type="checkbox" name='lec_use' <? echo ($lec[lec_use] || $mode=="W") ? "checked" : ""; ?> value='1'> 예
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">순서</td>
		<td>
			<input type="text" name='lec_order' value='<?=$lec[lec_order]?>'>
			<span>숫자가 높을수록 우선 출력됩니다.</span>
		</td>
	</tr>
</table>
<br>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
			<a href="./list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
var f = document.WriteForm;

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


//document.WriteForm.it_name.focus();
</script>

<!--
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
-->