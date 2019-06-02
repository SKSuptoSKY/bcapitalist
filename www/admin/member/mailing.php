<?
//공통변수
include "../head.php";
sql_query("delete from Gn_Mailing_List where result is Null");
?>

	<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
	<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
				<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 그룹메일링</font></strong>
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
	<form name="mail_form" method="post" onsubmit="return js_mail_form()" enctype="multipart/form-data">
		<input type="hidden" name="mode" value="mailing_send">
		<?
			if($group=="check"){
				if(sizeof($check)<1){
					alert("선택된 메일주소가 없습니다.");
				}
				$ez=0;
				for($i=0; $i<sizeof($check); $i++){
					$send_date = date("Ymd");
					$load_mail = mysql_query("select * from Gn_Member where mem_code='$check[$i]'");
					$mail_arr = mysql_fetch_array($load_mail);
					if($mail_arr[mem_email]){
						sql_query("insert into Gn_Mailing_List (user_name, email, send_date) values('$mail_arr[mem_name]', '$mail_arr[mem_email]', '$send_date')");
						$ez++;
					}
				}
				if($ez<1){
					alert("이메일을 가진 회원이 없습니다.");
					exit;
				}
			}
		?>
			<table width="99%" align="center" border="0" cellpadding="6" cellspacing="1" bgcolor="#E0E0E0">
				<colgroup width=100>
				<colgroup width="">
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px"><div>발송대상</div></td>
					<td>
						<?
							for($i=0; $i<sizeof($check); $i++){
								$load_mail = mysql_query("select * from Gn_Member where mem_code='$check[$i]'");
								$mail_arr=mysql_fetch_array($load_mail);
								if($mail_arr[mem_email]){
									echo "$mail_arr[mem_email], ";
								}
							}
						?>
					</td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">스킨적용</td>
					<td>
						<input type="radio" name="skin_type" value="1" style="border:0px;" checked>기본스킨사용
						<input type="radio" name="skin_type" value="2"  style="border:0px;">자체디자인사용
					</td>
				</tr>

				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">제 목</td>
					<td><input type="text" style="width:95%" name="m_subject"></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td bgcolor="#F0F0F0" style="padding-left:10px">내 용</td>
					<!-- 에디터 사용안함 사용시 태그가 들어가는 문제 ( 쇼핑몰 상세와 똑같이 에디터 적용안함  ) -->
					<td><textarea name="m_content" id="m_content" rows="20" style="width:100%;" class="text"></textarea></td>
				</tr>
				<tr bgcolor="#FFFFFF"> 
					<td align="center" colspan="2">
						<button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="Js_mailpre();">내용미리보기</button>
						<button type="submit" class="adm_btnN" style="width:80px;" onfocus="blur()">발송하기</button>
						<button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="SEditor_reset();">다시작성</button>
						<button type="button" class="adm_btnN" style="width:80px;" onfocus="blur()" Onclick="location.href='../member/member_list.php';">취소</button>
					</td>
				</tr>
			</table>
	</form>
	</table>
	<script type="text/javascript">
	<!--
		function js_mail_form(){
			frm=document.mail_form;
			if(frm.m_subject.value == ""){
				alert("제목을 입력하세요.");
				frm.m_subject.focus();
				return false;
			}
			oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
			frm.target = "doquery";
			frm.action = "../library/php/gnquery.php";
		}
		function SEditor_reset(){
			var content="";
			oEditors.getById["m_content"].exec("SET_IR", [content]);
			document.mail_form.reset();
		}
		function Js_mailpre(){
			var frm=document.mail_form;
			oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
			//popupLayer('./pop/pop_mailing.php?idx=<?=$arr[idx]?>',600,500);
			window.open('../pop/pop_mailing.php', 'MailPre', 'width=100, height=100, status=no, scrollbars=yes, resizable=yes');
			frm.target = "MailPre";
			frm.action = "../pop/pop_mailing.php";
			frm.submit();
		}
	//-->
	</script>
	<script>initForm(mail_form);</script>
	<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "m_content",
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
		oEditors.getById["m_content"].exec("PASTE_HTML", [sHTML]);
	}

	function showHTML() {
		var sHTML = oEditors.getById["m_content"].getIR();
		alert(sHTML);
	}
		
	function submitContents(elClickedObj) {
		oEditors.getById["m_content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		
		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("m_content").value를 이용해서 처리하면 됩니다.
		
		try {
			elClickedObj.form.submit();
		} catch(e) {}
	}

	function setDefaultFont() {
		var sDefaultFont = '궁서';
		var nFontSize = 24;
		oEditors.getById["m_content"].setDefaultFont(sDefaultFont, nFontSize);
	}

	function insertIMG(fname){
	  var sHTML = "<img src='" + fname + "' border='0'>";
	  oEditors.getById["m_content"].exec("PASTE_HTML", [sHTML]);
	  //alert("===>" + sHTML);
	}
	</script>