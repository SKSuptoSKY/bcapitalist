<?
$page_loc = "site";
include "../head.php";

$PG_table = "Gn_Link";

$sql_values="
	li_link			=	'$li_link',
	li_link2		=	'$li_link2',
	li_link3		=	'$li_link3',
	li_link4		=	'$li_link4',
	li_target		=	'$li_target',
	li_target2		=	'$li_target2',
	li_target3		=	'$li_target3',
	li_target4		=	'$li_target4'
";

if ($mode=="W") {
	$sql="insert {$PG_table} set {$sql_values}";
	sql_query($sql,FALSE);

	alert ("등록되었습니다.","./link_form.php?mode=E");
}
if ($mode=="E") {
	$sql="update {$PG_table} set {$sql_values} where li_no='1'";
	sql_query($sql,FALSE);

	alert ("수정되었습니다.","./link_form.php?mode=E");
}
?>