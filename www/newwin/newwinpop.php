<?
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$PG_table = $GnTable["newwin"];
$JO_table = "";

$sql = " select * from $PG_table where nw_id = '$nw_id' ";
$nw = sql_fetch($sql);

$html_title = $nw["nw_subject"];

$nw["nw_content"] = stripslashes($nw["nw_content"]);

$id = $nw[nw_id];
$subject = stripslashes($nw["nw_subject"]);
$content = conv_content($nw["nw_content"], $nw["nw_content_html"]);
if($nw["nw_skin"]) $skindir = "/skin/newwin/$nw[nw_skin]"; else $skindir = "/skin/newwin/basic";
$width = $nw["nw_width"];
$height = $nw["nw_height"];
$hours = $nw["nw_disable_hours"] ;

if($row_nw[nw_disable_layer] == "1"){ // layer 일때
	echo "
	<div id='pop_layer_{$id}' style=\"height:20px; position:relative; z-index:99999; \">
		<div style=\"height:20px; background-color:#333333; position:absolute;top:0px; left:0px;\">
			<table width=\"{$width}\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
				<tr>
					<td align='right' style='padding-right:10px;'><a href=\"javascript:win_layer_close_{$id}();\"><span style='font-size:12px; color:#ffffff;'><b>X</b> </span></a></td>
				</tr>
			</table>
		</div>
	  </div>";
}
?>

<script language='javascript' src='/GnCommon/js/javascript.js'></script>
<script language="JavaScript">
    function div_close_<?=$id?>() 
    {
		<?if($row_nw[nw_disable_layer] == "1"){?>
			set_cookie("ck_notice_<?=$id?>", "1" , <?=$hours?>);
			win_layer_close();
		<? }else{ ?>
			set_cookie("ck_notice_<?=$id?>", "1" , <?=$hours?>);
			window.close();
		<? } ?>
    }
</script>
<?
	include $_SERVER["DOCUMENT_ROOT"]."$skindir/popup.skin.php";
?>
<script type="text/javascript">
<!--
	function win_layer_close_<?=$id?>(){
		document.getElementById('div_notice_<?=$id?>').style.display="none";
		document.getElementById('pop_layer_<?=$id?>').style.display="none";
	}
//-->
</script>