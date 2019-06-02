<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/product/lib/lib.php";

	$PG_table = $GnTable["proditem"];
	$JO_table = $GnTable["prodcategory"];


	//DB 데이터 불러옴
	$ca_id[0]="10";
	$ca_id[1]="20";
	$ca_id[2]="30";
	$ca_id[3]="40";
	$ca_img[0]="/images/main/desk.jpg";
	$ca_img[1]="/images/main/chair.jpg";
	$ca_img[2]="/images/main/bookcase.jpg";
	$ca_img[3]="/images/main/table.jpg";


	for ($b=0; $b<4; $b++) {
		$sql_where = "where ca_id like '$ca_id[$b]%' and it_use=1 and it_type1=1";
		$sql_order = " order by it_id desc";

		$sql  = " select * from $PG_table $sql_where $sql_order limit 4 ";	
		$result = sql_query($sql);

		$no_img="/skin/bbs/gallery_basic/images/no_img.jpg";
		for ($i=0; $row=mysql_fetch_array($result); $i++) {
			$list[$b][$i] = $row;
			$list[$b][$i]["list_img"] = get_it_image($row["it_id"]."_s", $GnProd[simg_width], $GnProd[simg_height], '', 1);
			
			// 상품 타입 이미지
			$item_type[$i] ="";
			if($list[$b][$i][it_type1]==1) $item_type[$i] .="<img src='{$GnProd[skin_url]}/images/icon_type1.gif' border=0 align='absmiddle'> ";
			if($list[$b][$i][it_type2]==1) $item_type[$i] .="<img src='{$GnProd[skin_url]}/images/icon_type2.gif' border=0 align='absmiddle'> ";
			if($list[$b][$i][it_type3]==1) $item_type[$i] .="<img src='{$GnProd[skin_url]}/images/icon_type3.gif' border=0 align='absmiddle'> ";
			if($list[$b][$i][it_type4]==1) $item_type[$i] .="<img src='{$GnProd[skin_url]}/images/icon_type4.gif' border=0 align='absmiddle'> ";
			if($list[$b][$i][it_type5]==1) $item_type[$i] .="<img src='{$GnProd[skin_url]}/images/icon_type5.gif' border=0 align='absmiddle'> ";
		}
	}

	include $_SERVER["DOCUMENT_ROOT"]."/skin/product/basic/main.skin.php";
?>