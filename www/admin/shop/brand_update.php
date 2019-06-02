<?
	include "../head.php";
	include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopbrand"];
$JO_table = "";

$br_img      = $_FILES["br_img"]["tmp_name"];
$br_img_name = $_FILES["br_img"]["name"];

if ($mode=="W") {
	if (!$id) {
		$sql="select max(br_id) as max_br_id from {$PG_table} ";
		$row_max=sql_fetch($sql);		
		if (!$row_max["max_br_id"]) $id=time();
		else $id=$row_max["max_br_id"]+50;
	}
}
if ($_FILES[br_bimg][name])  {
	upload_file($_FILES[br_bimg][tmp_name],  $id,  $_SERVER["DOCUMENT_ROOT"]."/shop/data/brand");
}
if ($br_bimg_del)  @unlink($DOCUMENT_ROOT."/shop/data/brand/$id");

if ($mode=="W")
{
    $sql = " insert into $PG_table
                set
					br_id			=	'$id',
					br_name        = '$br_name',
                    br_url        = '$br_url',
					br_use		= '$br_use',
                    br_order      = '$br_order' ";
    sql_query($sql);          

    $br_id = mysql_insert_id();
} 
else if ($mode=="E")
{
    $sql = " update $PG_table
                set br_name        = '$br_name',
                    br_url        = '$br_url',
					br_use		= '$br_use',
                    br_order      = '$br_order'
              where br_id = '$id' ";
    sql_query($sql);          
}
else if ($mode=="D") 
{
    @unlink($DOCUMENT_ROOT."/shop/data/brand/$id");

    $sql = " delete from $PG_table where br_id = $id ";
    $result = sql_query($sql);
}


	goto_url("./brand_list.php");
?>
