<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];

$title_page = "문항";

if ($mode=="W") {
	$title_page .= "입력";

} else if ($mode=="E") {
	$title_page .= "수정";
	$sql = " select * from $JO_table where poll_num = '$poll_num' ";

	$question = sql_fetch($sql);
	$poll_parent = $question["poll_parent"];
	$poll_num = $question["poll_num"];
	$poll_answer = explode("|*1*|", $question["poll_answer"]);
} else {
	alert("잘못된 경로로 접근하셨습니다.");
}


$qstr = "poll_parent=$poll_parent&page=$page";
?>
<style type="text/css">
input, textarea {
	color:#777;
	border:1px solid #ccc;
	background:#fbfafa;
	color:#000;
}
</style>
<script type="text/javascript">
<!--
<?if ($poll_num){?>
var Ra = <?=sizeof($poll_answer)?>;
<?}else{?>
var Ra =0;
<?}?>

function relate_addRow(){
	var tb = document.getElementById("relate_tb").getElementsByTagName("TBODY")[0];
	var row = document.createElement("TR");
	var td1 = document.createElement("TD");
	var td2 = document.createElement("TD");	

	td1.style.padding="5px";
	td2.style.padding="5px";

	td1.insertAdjacentHTML('beforeEnd', "<input type=\"hidden\" name=\"poll_answer_idx[]\"><input type=\"hidden\" name=\"ral_hid\" value=\"R"+Ra+"\" size=\"2\"><input type=\"text\" name=\"poll_answer[]\" value=\"\" style=\"width:90%;\">");	
	td2.insertAdjacentHTML('beforeEnd', "<input type='button' value='삭제' onclick=\"relate_delRow('R"+Ra+"')\" style=\"width:100%;\">");

	row.appendChild(td1);
	row.appendChild(td2);	
	tb.appendChild(row);
	Ra++;
}
function relate_delRow(pst){
	var tb_id = "relate_tb";

	var hid = document.getElementsByName("ral_hid");
	for(i=0; i < hid.length; i++){
		if(hid[i].value == pst){
			break;
		}
	}
	
	var tb = document.getElementById(tb_id);
	tb.deleteRow(i+3);
}

function insert_relate(v_idx, v_code, v_name){
		var rl_idx = "poll_answer_idx[]";
		var rl_code = "poll_answer[]";
		var r_idx = document.getElementsByName(rl_idx);
		var r_code = document.getElementsByName(rl_code);
				
		if (typeof(r_idx.length) == "undefined") {
			r_idx.value = v_idx;
			r_code.value = v_code;
		}else{
			for (i=0;i<r_idx.length ;i++ ){
				if (r_idx[i].value==v_idx){return false;}
			}
			r_idx[currRelateIdx].value=v_idx;
			r_code[currRelateIdx].value=v_code;			
		}
}
//-->
</script>



<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9">  [ <?=get_poll_value($poll_parent, "poll_subject")?> ] <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<form name=WriteForm method=post action="./poll_question_update.php" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="poll_num" value="<?=$poll_num?>">
<input type=hidden name="poll_parent" value="<?=$poll_parent?>">
<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">문항</td>
		<td>
			<input type="text"  name="poll_question" value="<?=$question[poll_question]?>" style="width:100%; height:24px;" class="text">
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">답항</td>
		<td valign="top">
			<table cellpadding="0" width="50%" cellspacing="0" border="0" id="relate_tb">
				<tbody>
				<tr>
					<td style="text-align:right;" colspan="2"><span style="cursor:pointer;" Onclick="relate_addRow();"><img src="../images/btn_relate_plus1.gif" border="0" alt="추가" align="absmiddle"></span></td>
				</tr>
				<tr>
					<td height="5"></td>
				</tr>
				<tr>
					<th style="padding:5px; text-align:center;background:#F0F0F0;" >답항</th>
					<th style="padding:5px; text-align:center;background:#F0F0F0;" width="70">빼기</th>
				</tr>
				<?for($i=0;$i<sizeof($poll_answer) ;$i++ ){
				?>
				<tr>
					<td style="padding:5px;">
					<input type="hidden" name="poll_answer_idx[]" value="<?=$result[$i]?>">
					<input type="hidden" name="ral_hid" value="B<?=$i?>" size="2">
					<input type="text" name="poll_answer[]" value="<?=$poll_answer[$i]?>" style="width:90%;">
					</td>
					<td style="padding:5px; text-align:center;" width="70">
					<!-- <input type='button' value='삭제' onclick="relate_delRow('B<?=$i?>')" style="width:100%;"> -->
					<!-- 수정시 삭제 버튼 주석 설문조사 통계시 답항 선택시 기존 답항을 관리자에서 삭제하면 문제가 생길수 있으므로 -->
					</td>
				</tr>
				<?}?>
			</table>
			<br>
		</td>
	</tr>
</table>

<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">노출여부</td>
		<td>
			<input type="checkbox" name='poll_use' <? echo ($question[poll_use] || $mode=="W") ? "checked" : ""; ?> value='1' style="border:0px;"> 예
		</td>
	</tr>

	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding:10px;">노출순서</td>
		<td>
			<input type="text" name='poll_sort' value="<?=$question[poll_sort]?>" size="5"> &nbsp; <span style="color:#ff0000;">* 숫자가 클수록 상위에 게시됩니다.</span>
		</td>
	</tr>

</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_write.gif" border=0 style="border:none;">
			<a href="./poll_question_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>
