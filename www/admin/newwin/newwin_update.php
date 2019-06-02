<?
$page_loc = "site";
include "../head.php";

$PG_table = $GnTable["newwin"];
$JO_table = "";

$nw_content=str_replace("<A href","<A target=\'_blank\' href",$nw_content);

$sql_common = " nw_begin_time = '$nw_begin_time',
                nw_end_time = '$nw_end_time',
                nw_disable_hours = '$nw_disable_hours',
                nw_left = '$nw_left',
                nw_top = '$nw_top',
                nw_height = '$nw_height',
                nw_width = '$nw_width',
				nw_skin = '$nw_skin',
                nw_subject = '$nw_subject',
                nw_content = '$nw_content',
                nw_disable_layer = '$nw_disable_layer',
                nw_content_html = '$nw_content_html' ";

if($mode == "") {
	$sql = " alter table $PG_table auto_increment=1 ";
	sql_query($sql);

	$sql = " insert $PG_table set $sql_common ";
	sql_query($sql);

	$nw_id = mysql_insert_id();
}else if ($mode == "E") {
    $sql = " update $PG_table set $sql_common where  nw_id = '$nw_id' ";
    sql_query($sql);
}else if ($mode == "D") {
    $sql = " delete from $PG_table where nw_id = '$nw_id' ";
    sql_query($sql);
}

	goto_url("./newwin_list.php?$qstr");
?>
