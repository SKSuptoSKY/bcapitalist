<? 
include $_SERVER["DOCUMENT_ROOT"]."/admin/banner/lib/lib.php"; 


//DB불러옴
$sql="select * from {$GnTable[banner]} where bn_begin_time<='{$datetime}' and bn_end_time>='{$datetime}' order by bn_sort desc, bn_no desc";
$res_bn=sql_query($sql);

for ($i=0; $row_bn=mysql_fetch_array($res_bn); $i++) {
	$list_bn[$i]=$row_bn;
	$img_src=$_SERVER["DOCUMENT_ROOT"]."/banner/item/{$list_bn[$i][bn_no]}.jpg";
	$no_img_src="<img src='/skin/bbs/gallery_basic/images/no_img.jpg' width='{$bn_width}' height='{$bn_height}'>";
	if (file_exists($img_src)) {
		$list_bn[$i][bn_img]="<img src='/banner/item/{$list_bn[$i][bn_no]}.jpg' width='{$bn_width}' height='{$bn_height}'>";
	}
	else {
		$list_bn[$i][bn_img]=$no_img_src;
	}
	$list_bn[$i][bn_img]="<a href='{$list_bn[$i][bn_link]}' target='{$list_bn[$i][bn_link_target]}'>{$list_bn[$i][bn_img]}</a>";
}
$total_bn=count($list_bn);


//스킨불러옴
include $_SERVER["DOCUMENT_ROOT"]."/skin/banner/basic/banner_list.skin.php"; 
?>