<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";
	if($_SESSION[userlevel] < 10){
		alert("접근권한이 없습니다.","/");
		exit;
	}
/*
	if($mem_del_flag == "ok"){
		$mem = sql_fetch("select * from $GnTable[member] where mem_id='".$_SESSION[userid]."' and mem_pass='".sql_password($_POST[mem_password])."'");

		if($mem[mem_id]) {
			sql_query("delete from $GnTable[member] where mem_id='".$_SESSION[userid]."'");
			sess_kill();
			alert("회원탈퇴 처리되었습니다","/main.php");
		}else{
			alert("비밀번호가 맞지않습니다\\n\\n정확히 다시 입력해주십시요",$_SERVER[PHP_SELF]);
		}

	}
	*/
?>
<script type="text/javascript">
<!--
	function form_ch(f){
		if(confirm("정말 탈퇴하시겠습니까?")){
			f.action = "./member_update.php";
			f.submit();
		}
	}
//-->
</script>

<p style="padding-top:75px;">&nbsp;</p><!-- 간격 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<form name="mem_delete" method="post" onsubmit="return form_ch(this)">
	<input type="hidden" name="mem_del_flag" value="ok">
	<input type="hidden" name="mode" value="BREAK">
	<tr>
		<td style="border:1px solid #e5e5e5; border-radius:5px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr align="center">
					<td style="padding-top:40px;">※회원님의 <span style="color:red;">모든 정보가 삭제</span>되며, 재가입시 <span style="color:red;">동일 아이디로 재가입이 불가능</span>합니다.</td>
				</tr>
				<tr align="center">
					<td style="padding:15px 0 40px 0;"><strong class="managbule1">패스워드 확인 : </strong>
					<input type="password" name="mb_pass" class="inputmsec" style="height:20px; border:1px solid #e4e4e4; background:#f2f3f4;">
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr align="center">
		<td class="formok">
		<input type="image" src="/images/member/btn_ok.gif" border="0" style="border:none;">
		<a href="/member/member_form.php?mode=INFO"><img src="/images/member/btn_cancel.gif" border="0"></a>
		</td>
	</tr>
</table>
</form>

<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php";  ?>