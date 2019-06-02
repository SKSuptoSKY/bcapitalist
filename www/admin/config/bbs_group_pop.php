<?
include "../lib/lib.php";

// 상단 카테고리 위치 가져오기
function get_location($gr_id) {
	global $GnTable;
	$ca_point1="<b>";
	$ca_point2="</b>";
	$ca_len=strlen($gr_id);
	$substr_len=0;
	for ($c=0; $c<4; $c++) {
		$substr_len+=2;
		${"ca_num".$substr_len}=substr($gr_id,0,$substr_len);
		$sql="select gr_name from {$GnTable[bbsgroup]} where gr_id='".${"ca_num".$substr_len}."' ";
		${"row_num".$substr_len}=sql_fetch($sql);
	}
	if ($ca_len==2) $ca_loc="{$ca_point1}{$row_num2[gr_name]}{$ca_point2}";
	if ($ca_len==4) $ca_loc="{$row_num2[gr_name]} > {$ca_point1}{$row_num4[gr_name]}{$ca_point1}";
	if ($ca_len==6) $ca_loc="{$row_num2[gr_name]} > {$row_num4[gr_name]} > {$ca_point1}{$row_num6[gr_name]}{$ca_point2}";			
	if ($ca_len==8) $ca_loc="{$row_num2[gr_name]} > {$row_num4[gr_name]} > {$row_num6[gr_name]} > {$ca_point1}{$row_num8[gr_name]}{$ca_point2}";			
	return $ca_loc;
}

if ($menu_pop_ok) {
	$add_option_arr=explode("/",$add_option);
	if ($add_option_arr[0]=="1") {
		$sql = " update $GnTable[bbsconfig] set boardgroup='{$gr_id}' where dbname = '{$add_option_arr[1]}' ";
		sql_query($sql);
	}
	else if ($add_option_arr[0]=="2") {
		$sql = " update $GnTable[pageitem] set pg_group='{$gr_id}' where pg_code = '{$add_option_arr[1]}' ";
		sql_query($sql);
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
		alert ("추가되었습니다.");
		opener.location.reload();
	//-->
	</SCRIPT>
	<?
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>관리자님 환영합니다.</title>
<style type="text/css">
td {font-family: "돋음"; color: #666666; font-size: 9pt; line-height: 15px;}
A:link     {text-decoration:none;      color:#666666;}
A:visited  {text-decoration:none;      color:#666666;}
A:active   {text-decoration:none;      color:#666666;}
A:hover    {text-decoration:none;      color:#E0820A;}

td.tmenu {font-family: "돋음"; color: #FFFFFF; font-size: 9pt; line-height: 15px;}
A.tmenu:link     {text-decoration:none;      color:#FFFFFF;}
A.tmenu:visited  {text-decoration:none;      color:#FFFFFF;}
A.tmenu:active   {text-decoration:none;      color:#FFFFFF;}
A.tmenu:hover    {text-decoration:none;      color:#FFFFFF;}

input.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
select.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}
textarea.text {
	color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid
}

img { border:0; }
</style>
<script language='javascript' src='/admin/lib/javascript.js'></script>
</head>
<body>
<form name="menu_pop" method="post">
<input type="hidden" name="menu_pop_ok" value="y">
<input type="hidden" name="gr_id" value="<?=$gr_id?>">
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#bbbbbb" style="border-collapse:collapse;">
	<tr>
		<td width="20%" bgcolor="#eeeeee" style="padding:5px;" height="30">메뉴명</td>
		<td width="80%" style="padding:5px;"><?=get_location($gr_id)?></td>
	<tr>
		<td bgcolor="#eeeeee" style="padding:5px;">추가항목선택</td>
		<td style="padding:5px;">
			<?
			$sql="select dbname as code,title as title,boardsort as fsort,'게시판' as gubun,'1' as gubun2 from {$GnTable[bbsconfig]} a where boardgroup='' UNION ALL ";
			$sql.="select pg_code as code,pg_subject as title ,pg_sort as fsort,'페이지' as gubun,'2' as gubun2 from {$GnTable[pageitem]} b where pg_group='' ";
			$sql.="order by fsort asc ";
			$res_list=sql_query($sql);
			$res_total=mysql_num_rows($res_list);

			if ($res_total) {
			?>
			<select name="add_option">
				<?
				for ($l=0; $row_list=mysql_fetch_array($res_list); $l++) {
				?>
					<option value="<?=$row_list[gubun2]?>/<?=$row_list[code]?>"><b>·</b> [<?=$row_list[gubun]?>] <?=$row_list[title]?> (<?=$row_list[code]?>)</option>
				<? } ?>
			</select>
			<input type="button" value=" 추가 " onclick="document.menu_pop.submit();">
			<? } else { ?>
			추가 가능한 항목이 없습니다.
			<? } ?>
		</td>
	</tr>
</table>
</form>
<table width="100%">
	<tr>
		<td align="center" style="padding-top:10px;"><input type="button" value=" 닫기 " onclick="window.close();"></td>
	</tr>
</table>

<SCRIPT LANGUAGE="JavaScript">
<!--
	//새로고침방지
	function noEvent() {
		if (event.keyCode==116) {
			event.keyCode=2;
			return false;
		}
	}
	document.onkeydown=noEvent;
//-->
</SCRIPT>