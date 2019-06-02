<? 
include $_SERVER["DOCUMENT_ROOT"]."/head.php";  
include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";


$PG_table = $GnTable["shopitem"];
$JO_table = $GnTable["shopcategory"];


//베스트아이템 4개추출
$sql="select * from $PG_table where it_type1='1' and it_use='1' order by it_id desc limit 0,4";
$res_best=sql_query($sql);

$no_img="/skin/bbs/gallery_basic/images/no_img.jpg";
for ($b=0; $row_best=mysql_fetch_array($res_best); $b++) {
	$list_best[$b]=$row_best;
	if($list_best[$b][it_epay]>0) $list_best[$b][it_pay] = $list_best[$b][it_epay];
	$img="/shop/data/item/{$list_best[$b][it_id]}_m";
	if (file_exists($_SERVER["DOCUMENT_ROOT"].$img)) {
		$list_best[$b][list_img]="<img src='{$img}'>";
	}
	else {
		$list_best[$b][list_img]="<img src='{$no_img}' width='141' height='140'>";
	}
}
$qstr = "page=$page&sort1=$sort1&sort2=$sort2";


include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/main.skin.php";
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>