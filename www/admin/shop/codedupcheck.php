<?
include $DOCUMENT_ROOT."/admin/lib/libvm.php";
include "./lib/shop_lib.php";

isAdmin();


if ($it_id) {
    $sql = " select it_name from shop_item where it_id = '$it_id' ";
    $row = sql_fetch($sql);
    $code = $it_id;
    $name = $row[it_name];
} else if ($ca_id) { 
    $sql = " select ca_name from shop_category where ca_id = '$ca_id' ";
    $row = sql_fetch($sql);
    $code = $ca_id;
    $name = $row[ca_name];
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	<? if ($row[0]) { ?>
	    alert("코드 '<?=$code?>' 는 '<?=$name?>' (으)로 이미 등록되어 있으므로\n\n사용하실 수 없습니다.");
	<? } else { ?>
        alert("'<?=$code?>' 은(는) 등록된 코드가 없으므로 사용하실 수 있습니다.");
        parent.document.<?=$frmname?>.codedup.value = '2';
	<? } ?>
	window.close();
//-->
</SCRIPT>