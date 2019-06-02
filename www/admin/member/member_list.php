<?
	include "../head.php";

$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];

	$sql_search = " where mem_leb > 0 ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table a left join $JO_table b on (a.mem_leb = b.leb_level) $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1)
{
    $sort1  = "first_regist";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";


// 출력할 레코드를 얻음
$sql  = " select a.*, b.leb_name from $PG_table a left join $JO_table b on (a.mem_leb = b.leb_level)
		   $sql_search
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($list[$i][mem_sex]=="m") { $list[$i][mem_sex] = "남"; } else { $list[$i][mem_sex] = "여"; }
}

$list_total = count($list);

$qstr = "findType=".urlencode($findType)."&findword=".urlencode($findword)."&registS=$registS&registE=$registE&sort1=$sort1&sort2=$sort2";
?>
<script language="javascript">
function chkDel(id) {
    if(confirm("회원을 삭제하면 게시판 및 기타 프로그램에서는 삭제되지 않습니다.\n삭제하시겠습니까?"))
	document.location.href = "./member_update.php?mode=D&page=<?=$page?>&id=" +id;
}
function chkExe(id) {
    if(confirm("탈퇴하시면 같은 아이디로는 가입하실 수 없습니다.\n탈퇴하시겠습니까?"))
	document.location.href = "./member_update.php?mode=X&page=<?=$page?>&id=" +id;
}
</script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script language="javascript" type="text/javascript">
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
   buttonImage: '/admin/images/calender.gif', //이미지주소
   showOn: "both", //엘리먼트와 이미지 동시 사용(both,button)
   yearRange: '1990:2020' //1990년부터 2020년까지
  };
   $("#registS").datepicker(clareCalendar);
   $("#registE").datepicker(clareCalendar);
  $("img.ui-datepicker-trigger").attr("style","margin-left:5px; *margin-top:-11px; vertical-align:middle; cursor:pointer;"); //이미지버튼 style적용
  $("#ui-datepicker-div").hide(); //자동으로 생성되는 div객체 숨김
 });
</script>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 회원관리</font></strong>
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
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
							<td style="padding-right:5px;vertical-align:middle;" valign="top">
							<!-- &nbsp;&nbsp;<a href="./excel.php?<?=$qstr?>"><font color="green"><b>[엑셀다운로드]</b></font></a> -->
							</td>
							<td style="padding-right:5px" valign="top"><!-- <img src="/btn/icon_search.gif" border="0"> --></td>
							<td>가입일 : <input type="text" name="registS" id="registS" style="width:80px; height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$registS?>"> ~ <input type="text" name="registE" id="registE" style="width:80px; height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$registE?>"> </td>
							<td style="padding-right:5px" valign="top"></td>
							<td>
								<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
									<option value="mem_name" <?if($findType=="mem_name"){?>selected<?}?>>이름</option>
									<option value="mem_id" <?if($findType=="mem_id"){?>selected<?}?>>아이디</option>
									<option value="leb_name" <?if($findType=="leb_name"){?>selected<?}?>>등급</option>
								</select>
								<input type="text" name="findword" style="width:100px; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">
								&nbsp;&nbsp;
								<input type=image src='/btn/btn_search.gif' align=absmiddle>
							</td>
					</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<form method="post" name="ListForm">
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
					<tr align="center" bgcolor="#F6F6F6">
						<td width="80"><!-- <a href="./member_form.php?mode=W"><img src="/btn/btn_newup.gif" border="0"></a> --></td>
						<? if ($sitemenu["mn_group_mail_use"]) { ?>
						<td width="30"><input type="checkbox" name="chk" id="chk" onclick="AllChk()"></td>
						<? } ?>
						<td><a href='<? echo title_sort("mem_id"); ?>'>아이디</a></td>
						<td><a href='<? echo title_sort("mem_name"); ?>'>이름</a></td>
						<td><a href='<? echo title_sort("mem_nick"); ?>'>닉네임</a></td>
						<td><a href='<? echo title_sort("leb_name"); ?>'>회원등급</a></td>
						<td><a href='<? echo title_sort("mem_sex"); ?>'>성별</a></td>
						<td>이메일</td>
						<td>전화번호</td>
						<td>핸드폰</td>
						<td><a href='<? echo title_sort("first_regist"); ?>'>가입일</a></td>
						<td><a href='<? echo title_sort("last_regist"); ?>'>최근접속일</a></td>
						<td><a href='<? echo title_sort("last_modify"); ?>'>정보수정일</a></td>
						<td><a href='<? echo title_sort("visited"); ?>'>방문횟수</a></td>
					<? if(@opendir("$DOCUMENT_ROOT/admin/shop/")) { ?>
					<? if ($sitemenu["mn_shop_use"]) { ?>
						<td><a href='<? echo title_sort("mem_point"); ?>'>적립금</a></td>
						<td><a href='<? echo title_sort("mshop_count"); ?>'>구매횟수</a></td>
						<td><a href='<? echo title_sort("mshop_total"); ?>'>총구매액</a></td>
					<? } ?>
					<? } ?>
					</tr>
					<? for ($i=0; $i<$list_total; $i++) { ?>
						<tr align="center" bgcolor="#FFFFFF">
							<td style="font-weight:bold;">
								<a href="member_form.php?mode=E&id=<?=$list[$i][mem_id];?>&<?=$qstr?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> /
								<a href="javascript:chkExe('<?=$list[$i][mem_id];?>')"><font color="#FF3300">삭제</font></a>
							</td>
						<? if ($sitemenu["mn_group_mail_use"]) { ?>
							<td><input type='checkbox' name='check[]' value='<?= $list[$i][mem_code]?>' style="background-color:#FFFFFF; border:none;" class="chk_box"></td>
						<? } ?>
							<td><?=$list[$i][mem_id]?></td>
							<td><?=$list[$i][mem_name]?></td>
							<td><?=$list[$i][mem_nick]?></td>
							<td><?=$list[$i][leb_name]?>(<?=$list[$i][mem_leb]?>)</td>
							<td><?=$list[$i][mem_sex]?></td>
							<td><?=$list[$i][mem_email]?></td>
							<td><?=$list[$i][mem_tel]?></td>
							<td><?=$list[$i][mem_phone]?></td>
							<td><?=substr($list[$i][first_regist],0,10)?></td>
							<td><?=substr($list[$i][last_regist],0,10)?></td>
							<td><?=substr($list[$i][last_modify],0,10)?></td>
							<td><?=number_format($list[$i][visited])?></td>
						<? if(@opendir("$DOCUMENT_ROOT/admin/shop/")) { ?>
						<? if ($sitemenu["mn_shop_use"]) { ?>
							<td><?=number_format($list[$i][mem_point])?></td>
							<td><?=number_format($list[$i][mshop_count])?></td>
							<td><?=number_format($list[$i][mshop_total])?></td>
						<? } ?>
						<? } ?>
						</tr>
					<? } ?>
					<? if($i==0) { ?>
						<tr align="center" bgcolor="#FFFFFF">
							<td colspan="20" height="50">검색및 등록된 결과가 없습니다.</td>
						</tr>
					<? } ?>
				</table>
			</form>
		</td>
	</tr>
	<? if ($sitemenu["mn_group_mail_use"]) { ?>
	<tr>
		<td width="100%" align="left" style="padding-top:10px;">
			<button type="button" class="adm_btnN" style="width:95px;" onfocus="blur()" Onclick="Js_ck_mail();">체크메일발송</button>
		</td>
	</tr>
	<?}?>
	<tr>
		<td height="50" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>
<script type="text/javascript">
<!--
	function Js_ck_mail(){
	var frm = document.ListForm;
	var check_obj = document.getElementsByName('check[]');
	var num = 0;

	for(i=0; i<check_obj.length; i++){
		if(check_obj[i].checked == true) num++;
	}
	if(num == 0){
		alert("선택된 회원이 없습니다.");
		return false;
	}

	frm.action="mailing.php?group=check";
	frm.submit();
}
//-->
</script>