<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopcoupon"];

$sql="select * from {$PG_table} where cp_no='1' ";
$row=sql_fetch($sql);

$content=$row[cp_content];

$title_page = "쿠폰관리";
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
<form name=WriteForm method=post action="./coupon_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page" value="<?=$page?>">
	
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 쿠폰내용</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<textarea name="cp_content" rows="20" style="width:100%;" class="text"><?=$row[cp_content]?></textarea>
            <font color="#FF9933">
            에디터 사용시 가로 670픽셀 넘지 않도록 엔터로 조절해 주세요
            <br />
            이미지도 670필셀 넘지 않도록 올려 주세요(너무 큰 이미지는 로딩시간이 길어 질 수 있습니다)
            </font>
            <br />
		</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
		</td>
	</tr>
</table>

</form>

<script language='javascript'>
var f = document.WriteForm;

function codedupcheck(id)
{
    if (!id) {
        alert('상품코드를 입력하십시오.');
        f.it_id.focus();
        return;
    }

    window.open("./codedupcheck.php?it_id="+id+"&frmname=WriteForm", "hiddenframe");
}

function fitemformcheck(f)
{
		oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	return false;
}

document.WriteForm.cp_content.focus();
</script>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "cp_content",
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
		oEditors.getById["cp_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["cp_content"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["cp_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("cp_content").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["cp_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["cp_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>
