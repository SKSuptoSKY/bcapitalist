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
	<?/* if($Board_Admin["use_html"]==TRUE){?>
		oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
	<? }*/?>
	
	return true;
}
</script>

<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=950d59f34ee2f9e3c8945dcff3ba7aa9&libraries=services"></script>


<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
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

<style>
.tit {font-weight:bold;color:#333;text-align:center;}
</style>

<? 
	include $_SERVER["DOCUMENT_ROOT"].$Board_Admin["skin_dir"]."/lib.php";
	switch($view["b_category"]){
		case "서울특별시"     : $locatelist = $list1; break;
		case "부산광역시"     : $locatelist = $list2; break;
		case "대구광역시"     : $locatelist = $list3; break;
		case "인천광역시"     : $locatelist = $list4; break;
		case "광주광역시"     : $locatelist = $list5; break;
		case "대전광역시"     : $locatelist = $list6; break;
		case "울산광역시"     : $locatelist = $list7; break;
		case "경기도"         : $locatelist = $list8; break;
		case "강원도"         : $locatelist = $list9; break;
		case "충청북도"       : $locatelist = $list10; break;
		case "충청남도"       : $locatelist = $list11; break;
		case "전라북도"       : $locatelist = $list12; break;
		case "전라남도"       : $locatelist = $list13; break;
		case "경상북도"       : $locatelist = $list14; break;
		case "경상남도"       : $locatelist = $list15; break;
		case "제주도" : $locatelist = $list16; break;
	}
?>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="2" bgcolor="#888888" colspan="2"></td></tr>
<? if($Category_option==TRUE) {?>
	<tr>
		<td height="40" class="tit">분류</td>
		<td style="padding-left:5px;">
			<select name="b_category" id="b_category" style='width:80px;' class="text"  onchange="print_select(this.value);">
				<?=$Category_option?>
			</select>
			<select name="b_ex2" id="b_ex2">
				<option value="">세부지역</option>
				<?foreach($locatelist as $key => $value):?>
					<option value="<?=$value?>" <?=($view[b_ex2] == $value)?"selected":""?>><?=$value?></option>
				<?endforeach;?>
			</select>
			<script type="text/javascript">
			<!--
				
			
				function print_select(value){
					$("#b_ex2").val("");
					$("#b_ex2").find("option").remove();
					$("#b_ex2").append('<option value="">세부지역</option>');
					$.ajax({
						url: '<?=$Board_Admin["skin_dir"]?>/category.ajax.php',
						type: 'POST',
						data: {
							locate : value
						},
						success: function(response){
							$("#b_ex2").append(response);
						}
					});
				}
			//-->
			</script>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? } ?>
	<tr height="40">
		<td width="20%" height="40" class="tit">작성자</td>
		<td width="" style="padding-left:5px;"><input type="text" name="b_writer" style="width:98%; height:24px;" value="<?=$view["b_writer"]?>" class="text" <?if($view["b_writer"]){?>readonly<?}?>></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<!-- <tr>
		<td height="40" class="tit">이메일</td>
		<td style="padding-left:5px;"><input type="text" name="b_email" size="70" style="width:98%; height:20px;" value="<?=$view["b_email"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr> -->
	<tr height="40">
		<td height="40" class="tit">매장명</td>
		<td style="padding-left:5px;">
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr>
					<td>
						<input type="text" name="b_subject" size="70" style="width:70%; height:24px;" value="<?=$view["b_subject"]?>" class="text">
						<?=$Input_Notice?> <?=$Input_Secret?> <?=$Input_Html?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">주소</td>
		<td style="padding-left:5px;">
			<input type="text" name="b_ex3" id="b_ex3" size="70" style="width:70%; height:24px;" value="<?=$view["b_ex3"]?>" class="text">
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">좌표</td>
		<td style="padding-left:5px;padding-top:5px;padding-bottom:5px;">
			<input type="text" id="set_addr" size="70" style="width:40%; height:24px;" class="text">
			<input type="button" value="주소검색" onclick="openDaumPostcode2('set_addr');">
			<input type="button" value="좌표출력" onclick="result_map_point('set_addr','b_ex6','b_ex7');">
			<p class="mt5">
				X 좌표 : <input type="text" name="b_ex6" id="b_ex6" size="70" style="width:10%; height:24px;" value="<?=$view["b_ex6"]?>" class="text">
				Y 좌표 : <input type="text" name="b_ex7" id="b_ex7" size="70" style="width:10%; height:24px;" value="<?=$view["b_ex7"]?>" class="text">
			</p>
			<p class="mt5" style="font-size:0.5em;color:red;">
				※ 반드시 도로명주소를 입력하세요.<br/>
			</p>
			<p class="mt5" style="font-size:0.5em;">※ 주소 검색 으로도 좌표 검색 에서 주소가 잘못되었다고 나왔을때는.&nbsp;&nbsp;<a href="http://www.google.co.kr/maps" style="color:blue;">구글지도</a> 에서 주소를 검색후 해당 지점을 좌클릭 또는 우클릭후 <br>&nbsp;&nbsp;&nbsp;&nbsp;(이곳이 궁금한가요?) 를 통해서 경도,위도 를 알수 있습니다.</p>
		</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">전화번호</td>
		<td style="padding-left:5px;"><input type="text" name="b_ex4" size="70" style="width:98%; height:24px;" value="<?=$view["b_ex4"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">영업시간</td>
		<td style="padding-left:5px;"><input type="text" name="b_ex5" size="70" style="width:98%; height:24px;" value="<?=$view["b_ex5"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">주차 가능여부</td>
		<td style="padding-left:5px;"><input type="radio" name="b_ex9" size="70" value="1" class="text" <?=($view["b_ex9"] != "0")?"checked":""?>>&nbsp;가능&nbsp;<input type="radio" name="b_ex9" size="70" value="0" class="text" <?=($view["b_ex9"] == "0")?"checked":""?>>&nbsp;불가</td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">노출순서</td>
		<td style="padding-left:5px;"><input type="text" name="b_ex1" size="70" style="width:10%; height:24px;" value="<?=$view["b_ex1"]?>" class="text">&nbsp;&nbsp;<span style="font-size:0.5em;color:red;">※ 높은순으로 정렬됩니다.</span></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">신규 오픈매장 안내 등록</td>
		<td style="padding-left:5px;"><input type="checkbox" name="b_ex8" size="70" value="1" class="text" <?=($view["b_ex8"])?"checked":""?>>&nbsp;&nbsp;<span style="font-size:0.5em;color:red;">※ 신규매장에 등록이 됩니다.</span></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	
	
<?
if($Board_Admin["use_data"]==TRUE) {
for($i=1; $i<=$Board_Admin["fileupnum"]; $i++) {
?>
	<tr>
		<td height="40" class="tit">
			매장사진<?=$i?><br/>
			<span style="font-size:0.5em;color:red;">권장 사이즈 520 X 432</span>
		</td>
		<td style="padding-left:5px;"><input type="file" name="b_file<?=$i?>" style="width:98%; height:24px;" class="text"> <?=$view["b_file".$i]?></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<?
}
}
?>
	<!--
	<tr>
		<td height="40" class="tit">링크1</td>
		<td style="padding-left:5px;"><input type="text" name="b_link1" size="70" style="width:98%; height:19px;" value="<?=$view["b_link1"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	<tr>
		<td height="40" class="tit">링크2</td>
		<td style="padding-left:5px;"><input type="text" name="b_link2" size="70" style="width:98%; height:20px;" value="<?=$view["b_link2"]?>" class="text"></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
	-->
<?
if($Board_Admin["use_spam"]==TRUE) {

$listNo=1;	# 목록 번호
$solveNo=1;	# 문제해결 번호
?>		<tr>
		<td height="40" class="tit">스팸방지</td>
		<td style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="100" style="padding:2px;"><a href="#" onclick="document.getElementById('zsfImg').src='zmSpamFree.php?re&amp;zsfimg='+new Date().getTime(); return false;" title=""><img id="zsfImg" src="zmSpamFree.php?zsfimg" alt="[새로고침]을 클릭해 주세요." style="border: none; " /></a></td>
			<td>
				<input type="text" name="zsfCode" id="zsfCode" style="width:120px;height:20px;text-transform:uppercase;ime-mode:disabled;" class="text">
			    <img width="2" height="2" border="0" />
			    <font color="#FF0000" style="font-size:11px;">이미지에 보이는 글자를 입력하여 주십시오.</font>
			</td>
		  </tr>
	    </table>
	</td>
	</tr>
	<tr><td height="1" bgcolor="#888888" colspan="2"></td></tr>
<? } ?>
<? if($Get_Login!=TRUE) {?>
	<tr>
		<td height="40" class="tit">비밀번호</td>
		<td style="padding:5px;"><input type="password" name="passwd" size="10" style="height:19px; " class="text">
		<br /> <font color=red>*수정 또는 삭제시 반드시 필요 합니다.</font></td>
	</tr>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
<? } ?>
	<tr><td height="1" bgcolor="#EAEAEA" colspan="2"></td></tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="50" valign="middle">
		<td style="padding-left:50px;">
			<input type="submit" border="0" onclick="return writeChk(writeform)" value="확인" style="width:70px; height:27px; background:#f1f1f1;  font-weight:bold; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:25px; vertical-align:top; cursor:pointer;-webkit-border-radius:0px;  -webkit-appearance:none;">&nbsp;
			<a href="<?=$Url["list"]?>"><div class="btn_list" style="width:70px; height:27px; background:#fff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:25px; display:inline-block;">목록</div></a>
		</td>
	</tr>
</table>

</form>
<?/* if($Board_Admin["use_html"]==TRUE){?>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "b_content",
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
		oEditors.getById["b_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["b_content"].getIR();
		alert(sHTML);
	}

	function submitContents(elClickedObj) {
		oEditors.getById["b_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("b_content").value를 이용해서 처리하면 됩니다.

		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["b_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["b_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>
<? } */?>


<style type="text/css">

</style>

<script type="text/javascript">
<!--
function openDaumPostcode2(addr1) {
	new daum.Postcode({
		oncomplete: function(data) {
			   // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;

				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if(data.userSelectedType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}
			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(addr1).value = fullAddr;
		}
	}).open();
}
function result_map_point(addr1,pointx,pointy){
	// 검색값을 추출합니다.
	var addr = $("#"+addr1).val();
	// 주소-좌표 변환 객체를 생성합니다
	var geocoder = new daum.maps.services.Geocoder();
	geocoder.addr2coord(addr, function(status, result) {
		if (status === daum.maps.services.Status.OK) {
			//alert(result.addr[0].lat+result.addr[0].lng);
			$("#"+pointx).val(result.addr[0].lat);
			$("#"+pointy).val(result.addr[0].lng);
		}else{
			alert("검색값이 없습니다. 주소를 다시입력하거나 직접좌표를 입력 바랍니다.");
		}
	});
}
//-->
</script>