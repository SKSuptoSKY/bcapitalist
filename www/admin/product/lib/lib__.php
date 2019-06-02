<?
//공통변수
$no_img_src="/skin/shop/basic/images/no_image.jpg";


// 이미지를 얻는다
function get_image($img, $width=0, $height=0, $resize=0, $tag='')
{
	global $GnShop,$no_img_src;
	$full_img = $_SERVER["DOCUMENT_ROOT"]."/product/item/$img";

    if (file_exists($full_img) && $img)
    {
        $size = getimagesize($full_img);
        $tr_width = $size[0];
        $tr_height = $size[1];

		if ($resize==1) {
			$re_width=ImgResize($size[0],$size[1],"width",$width,$height);
			$re_height=ImgResize($size[0],$size[1],"height",$width,$height);
		}
		else {
			$re_width=$width;
			$re_height=$height;
		}

        $str = "<img id='$img' src='/product/item/$img' width='$re_width' height='$re_height' border='0' {$tag}>";
    }
    else
    {
        $str = "<img id='$img' src='{$no_img_src}' border='0' ";
        if ($width)
            $str .= "width='$width' height='$height'";
        else
            $str .= " ";
        $str .= " {$tag}>";
    }


    return $str;
}


// 상품 이미지
function get_it_image($img, $width=0, $height=0, $id="", $resize=0)
{
    $str = get_image($img, $width, $height,$resize);
    if ($id) {
        $str = "<a href='/product/item.php?it_id=$id'>$str</a>";
    }
    return $str;
}


// 상단 카테고리 위치 가져오기
function get_location($ca_id) {
	global $GnTable;
	$ca_point1="<b>";
	$ca_point2="</b>";
	$ca_len=strlen($ca_id);
	$substr_len=0;
	for ($c=0; $c<4; $c++) {
		$substr_len+=2;
		${"ca_num".$substr_len}=substr($ca_id,0,$substr_len);
		$sql="select ca_name from {$GnTable[prodcategory]} where ca_id='".${"ca_num".$substr_len}."' ";
		${"row_num".$substr_len}=sql_fetch($sql);
	}
	if ($ca_len==2) $ca_loc="{$ca_point1}{$row_num2[ca_name]}{$ca_point2}";
	if ($ca_len==4) $ca_loc="{$row_num2[ca_name]} > {$ca_point1}{$row_num4[ca_name]}{$ca_point1}";
	if ($ca_len==6) $ca_loc="{$row_num2[ca_name]} > {$row_num4[ca_name]} > {$ca_point1}{$row_num6[ca_name]}{$ca_point2}";			
	if ($ca_len==8) $ca_loc="{$row_num2[ca_name]} > {$row_num4[ca_name]} > {$row_num6[ca_name]} > {$ca_point1}{$row_num8[ca_name]}{$ca_point2}";			
	return $ca_loc;
}

//DB환경설정불러옴
$sql = " select * from {$GnTable[prodconfig]} where site='{$default[site_code]}' ";
$GnProd = sql_fetch($sql);


//공통변수
$product_dir = $_SERVER["DOCUMENT_ROOT"]."/product/item"; // 이미지 경로
?>