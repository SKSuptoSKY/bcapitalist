<?
$page_loc = "site";
include "../head.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

if($mode=="E") {
	$html_title = "설문조사 수정";
	$sql = " select * from $PG_table where poll_num = '$poll_num' ";
	$poll = sql_fetch($sql);
	$content = $poll[poll_content];

	if($poll[poll_num]==FALSE) alert("등록된 자료가 없습니다.");
}else{
	$mode="W";
	$html_title = "설문조사 등록";
}

$qstr  = "$qstr&type=$type&sca=$sca&page=$page";
?>
<script language="javascript">
function frmpoll_check(f) 
{
    errmsg = "";
    errfld = "";
    check_field(f.poll_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }              

	oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
}
</script>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
//******************************************************************************
// 상세검색 달력 스크립트
//******************************************************************************

var clareCalendar = {
monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
dayNamesMin: ['일','월','화','수','목','금','토'],
weekHeader: 'Wk',
dateFormat: 'yy-mm-dd', //형식(20120303)
autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
changeMonth: true, //월변경가능
changeYear: true, //년변경가능
showMonthAfterYear: true, //년 뒤에 월 표시
buttonImageOnly: true, //이미지표시
buttonText: '달력선택', //버튼 텍스트 표시
buttonImage: '/images/sub/icon_date.jpg', //이미지주소
showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
yearRange: '1914:2020' //1990년부터 2020년까지
};
$("#poll_sdate").datepicker(clareCalendar);
$("#poll_edate").datepicker(clareCalendar);

$("img.ui-datepicker-trigger").attr("style","margin-left:5px; *margin-top:-11px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
$("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김

}
);
//-->
</script>


<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$html_title?></font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"></td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="20"></td>
	</tr>
</table>

<form name="frmpoll" id="frmpoll" method=post action="./poll_update.php" onsubmit="return frmpoll_check(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="poll_num" value="<?=$poll_num?>">
<input type="hidden" name="qstr"  value="<?=$qstr?>">
<input type="hidden" name="old_count" value="<?=$poll["poll_question"]?>">
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">

	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" align=center>
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">설문조사 기간</td>
					<td>
					<input type="text" name="poll_sdate" id="poll_sdate" value="<?=$poll[poll_sdate]?>" style="width:80px;">
					~
					<input type="text" name="poll_edate" id="poll_edate" value="<?=$poll[poll_edate]?>" style="width:80px;">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제목</td>
					<td><input type=text class="ed" name="poll_subject" size="80" value="<?=stripslashes($poll[poll_subject]) ?>">
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">상태</td>
					<td>
					<input type="radio" name="poll_state" value="1" <?if($poll[poll_state] == 1){?>checked<?}?> style='vertical-align:middle;'>
					<span style='vertical-align:middle;'>
					결과보기
					</span>
					&nbsp;&nbsp;
					<input type="radio" name="poll_state" value="0" <?if($poll[poll_state] == 0){?>checked<?}?> style='vertical-align:middle;'>
					<span style='vertical-align:middle;'>
					비공개
					</span>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내용</td>
					<td><textarea name="poll_content" id="poll_content" rows="20" style="width:100%;" class="text"><?=$poll[poll_content]?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>

</table>


<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0>
			<a href="./poll_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>
</form>

	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "poll_content",
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
		oEditors.getById["poll_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["poll_content"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["poll_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("poll_content").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["poll_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["poll_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>