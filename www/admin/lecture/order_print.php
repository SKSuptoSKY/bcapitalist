<?
$page_loc="lecture";
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 주문내역출력</font></strong>
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
<table width=550 align=center><tr><td>
<table cellpadding=4 cellspacing=1 border=0 width=100%>
<form name=forderprint onsubmit="return forderprintcheck(this);" autocomplete="off">
<input type=hidden name=case value="1">
<tr><td colspan=20 height=3 bgcolor=#0E87F9></td></tr>
<colgroup width=100 align=center bgcolor=#EEEEEE></colgroup>
<colgroup width='' bgcolor=#FFFFFF></colgroup>
<tr>
    <td>신청날짜구간</td>
    <td>
        <table width=100%>
        <tr>
            <td align=left>&nbsp; <input type=checkbox name=csv value=1>MS엑셀 다운로드</span></td>
        </tr>
        <tr>
            <td align=right>
                <input type=text name=fr_date size=10 value="<?=date("Y-m-d");?>" class=edit> 부터
                <input type=text name=to_date size=10  value="<?=date("Y-m-d");?>" class=edit> 까지
                &nbsp;
                <input type=image src='/btn/btn_search.gif' align=absmiddle>
            </td>
        </tr>
        </table>
    </td>
</tr>
<tr><td colspan=20 height=2 bgcolor=#0E87F9></td></tr>
</form>
</table>

<!-- 
<table cellpadding=4 cellspacing=1 border=0 width=100%>
<form name=forderprint  onsubmit="return forderprintcheck(this);" autocomplete="off">
<input type=hidden name=case value="2">
<tr><td colspan=20 height=2 bgcolor=#DDDDDD></td></tr>
<colgroup width=100 align=center bgcolor=#EEEEEE></colgroup>
<colgroup width='' bgcolor=#FFFFFF></colgroup>
<tr>
    <td>주문번호구간</td>
    <td>
        <table width=100% cellpadding=4>
        <tr>
            <td align=left>&nbsp; <input type=checkbox name=csv value=1>MS엑셀 다운로드</span></td>
        </tr>
        <tr>
            <td align=right>
                <input type=text name=fr_od_id size=10  class=ed> 부터
                <input type=text name=to_od_id size=10  class=ed> 까지
                &nbsp;
                <input type=image src='/btn/btn_search.gif' align=absmiddle>
            </td>
        </tr>
        </table>
    </td>
</tr>
<tr><td colspan=20 height=2 bgcolor=#0E87F9></td></tr>
</form>
</table>
 -->
<script>
    function forderprintcheck(f)
    {
        if (!f.csv.checked) {

            var win = window.open("", "winprint", "resizable=yes,scrollbars=yes,toolbar=yes,status=0, width=1100, height=600, left=50, top=50");
            f.target = "winprint";

//			var win = window.open("", "winprint", "left=10,top=10,width=670,height=800,menubar=yes,toolbar=yes,scrollbars=yes");
//            f.target = "winprint";

        }
		f.action="./order_presult.php";
        f.submit();
    }
</script>