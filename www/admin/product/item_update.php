<?
include "../head.php";
include "./lib/lib.php";	//	제품관리 라이브러리


/* ------------------------------------------------------------- [ Gn_Prod_Item - Query - START ] ------------------------------------------------------------- */
$input_value = "
	ca_id					= '$ca_id',
	it_name				= '$it_name',
	it_gallery			= '$it_gallery',
	it_brand				= '$it_brand',
	it_maker				= '$it_maker',
	it_origin				= '$it_origin',
	it_link1				= '$it_link1',
	it_link2				= '$it_link2',
	it_opt1_subject	= '$it_opt1_subject',
	it_opt2_subject	= '$it_opt2_subject',
	it_opt3_subject	= '$it_opt3_subject',
	it_opt4_subject	= '$it_opt4_subject',
	it_opt5_subject	= '$it_opt5_subject',
	it_opt6_subject	= '$it_opt6_subject',
	it_opt1				= '$it_opt1',
	it_opt2				= '$it_opt2',
	it_opt3				= '$it_opt3',
	it_opt4				= '$it_opt4',
	it_opt5				= '$it_opt5',
	it_opt6				= '$it_opt6',
	it_type1				= '$it_type1',
	it_type2				= '$it_type2',
	it_type3				= '$it_type3',
	it_type4				= '$it_type4',
	it_type5				= '$it_type5',
	it_ex1				= '$it_ex1',
	it_ex2				= '$it_ex2',
	it_ex3				= '$it_ex3',
	it_ex4				= '$it_ex4',
	it_ex5				= '$it_ex5',
	it_ex6				= '$it_ex6',
	it_other1				= '$it_other1',
	it_other2				= '$it_other2',
	it_other3				= '$it_other3',
	it_other4				= '$it_other4',
	it_other5				= '$it_other5',
	it_other6				= '$it_other6',
	it_basic				= '$it_basic',
	it_explan			= '$it_explan',
	it_explan_html	= '$it_explan_html',
	it_cust_amount	= '$it_cust_amount',
	it_pay				= '$it_pay',
	it_epay				= '$it_epay',
	it_point				= '$it_point',
	it_sell_email		= '$it_sell_email',
	it_use				= '$it_use',
	it_stock				= '$it_stock',
	it_head_html		= '$it_head_html',
	it_tail_html			= '$it_tail_html',
	it_time				= '$datetime',
	it_ip					= '$_SERVER[REMOTE_ADDR]',
	it_order				= '$it_order',
	it_tel_inq			= '$it_tel_inq',
	it_name_en			= '$it_name_en',
	it_ex1_en			= '$it_ex1_en',
	it_explan_en		= '$it_explan_en'
";


/* ------------------------------------------------------------- [ 파일 - 업로드 / 삭제 관련 - START ] ------------------------------------------------------------- */
@chmod("/product/data/item/".$it_id, 0707);

for($i=1; $i<=$GnProd["max_img_count"]; $i++) 
{
	$GnProd['prod_dir'] = $GnProd['data_dir']."/".$it_id;
	################## [ 필드에 저장된 _l1 파일네임으로  _l1, _m1, _s1 파일이름을 배열변수로 만들기 - START ] ##################
	// 기존 업로드된 파일이름 배열로 저장
	$file_name[$i]["large"] = get_it_value($_POST[it_id], "it_file".$i);
	
	// 예) 123456789_l1.jpg 파일이 필드에 등록이 되어있다면
	if( $file_name[$i]["large"] != "" )
	{
		//	_l 만 _m의 형태로 바꾸게되면 혹시 파일이름에 저런 문자가 들어있을수 있으므로 it_id까지 포함하여 변경한다.
		$file_name[$i]["midium"]	=		str_replace($_POST[it_id]."_l", $_POST[it_id]."_m", $file_name[$i]["large"]);
		$file_name[$i]["small"]		=		str_replace($_POST[it_id]."_l", $_POST[it_id]."_s", $file_name[$i]["large"]);
	}
	##################   [ 필드에 저장된 _l1 파일네임으로  _l1, _m1, _s1  파일이름을 배열변수로 만들기 - END ]  ##################
	// 상품 이미지 개별 삭제 처리
	if ($_POST["it_limg".$i."_del"]==TRUE) 
	{
		// 해당 필드 초기화
		$update_sql = "UPDATE {$GnTable['proditem']} SET it_file{$i} = '' WHERE it_id = '$it_id' ";
		$update_query = sql_query($update_sql);

        @unlink($GnProd['prod_dir']."/".$file_name[$i]['large']);
        @unlink($GnProd['prod_dir']."/".$file_name[$i]['midium']);
        @unlink($GnProd['prod_dir']."/".$file_name[$i]['small']);
    }

	// 상품 이미지 개별 업로드 처리
	if($_FILES["it_limg".$i]["name"]) 
	{
		@mkdir($GnProd['prod_dir'], 0707);
		@chmod($GnProd["prod_dir"], 0707);
		// 해당 넘버로 업로드된 기존파일이 있다면 지우기
        @unlink($GnProd['prod_dir']."/".$file_name[$i]['large']);
        @unlink($GnProd['prod_dir']."/".$file_name[$i]['midium']);
        @unlink($GnProd['prod_dir']."/".$file_name[$i]['small']);

		// 파일 확장자 구하기
		$this_file_ext = get_file_ext($_FILES["it_limg".$i]["name"]);

		// 파일업로드시 파일이름 변환하여 필드저장하는 추가 $input_value 쿼리 생성
		$this_filename = $it_id."_l".$i.$this_file_ext;			//		ex) 124812005_l1.jpg
		$input_value .= ", it_file".$i." = '$this_filename' ";
		
		/***************************************/
		/********2017-05-26 gamgak K.H***********/
		/*******이미지 확장자에 따른 리사이징*******/
		/***************************************/
			/*이미지 확장자  검색에 따른 개발*/
			// 원본사이즈 업로드
			upload_file($_FILES["it_limg".$i]["tmp_name"], $this_filename, $GnProd["prod_dir"]);
			$image = $GnProd["prod_dir"]."/".$this_filename;
			$size = getimagesize($image);
			//$size[2] == 1 ==> GIF 
			//$size[2] == 2 ==> JPG
			//$size[2] == 3 ==> PNG
			/*이미지 확장자  검색에 따른 개발*/
			if($size[2] == 2){//JPG
				// 이미지생성 라이브러리 지원유무에 따른 처리
				if ( function_exists("imagecreatefromjpeg") ) 
				{	
					$src = @imagecreatefromjpeg($image);
					if (!$src) 
					{
						echo "<script>alert('이미지(대)가 JPG 파일이 아닙니다.');</script>";
					} 
					else 
					{
						/* ------------------------------------------------------------- [ 썸네일 생성 - START ] ------------------------------------------------------------- */
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnProd[simg_width],$GnProd[simg_height]);
						// gd 버전에 따라
						if (function_exists("imagecopyresampled")) {
							// 이미지(소) 생성
							$dst = imagecreatetruecolor($simg_width, $simg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						} else {
							// 이미지(소) 생성
							$dst = imagecreate($simg_width, $simg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnProd["img_quality"]);

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnProd[mimg_width],$GnProd[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnProd["img_quality"]);
						/* ------------------------------------------------------------- [ 썸네일 생성 - END ] ------------------------------------------------------------- */
					}
				}
				// imagecopyresampled를 지원하지 않으면
				else 
				{
					echo "<script>alert('호스팅 서버에서 imagecreatefromjpeg를 지원하는지 확인하시기 바랍니다. ');</script>";
				}
			}else if($size[2] == 1){//GIF
				// 이미지생성 라이브러리 지원유무에 따른 처리
				if ( function_exists("imagecreatefromgif") ) 
				{	
					$src = @imagecreatefromgif($image);
					if (!$src) 
					{
						echo "<script>alert('이미지(대)가 GIF 파일이 아닙니다.');</script>";
					} 
					else 
					{
						/* ------------------------------------------------------------- [ 썸네일 생성 - START ] ------------------------------------------------------------- */
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnProd[simg_width],$GnProd[simg_height]);
						// gd 버전에 따라
						if (function_exists("imagecopyresampled")) {
							// 이미지(소) 생성
							$dst = imagecreatetruecolor($simg_width, $simg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						} else {
							// 이미지(소) 생성
							$dst = imagecreate($simg_width, $simg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnProd["img_quality"]);//imagegif 는 불안하므로 imagejpeg으로 재 업로드

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnProd[mimg_width],$GnProd[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnProd["img_quality"]);//imagegif 는 불안하므로 imagejpeg으로 재 업로드
						/* ------------------------------------------------------------- [ 썸네일 생성 - END ] ------------------------------------------------------------- */
					}
				}
				// imagecopyresampled를 지원하지 않으면
				else 
				{
					echo "<script>alert('호스팅 서버에서 imagecreatefromjpeg를 지원하는지 확인하시기 바랍니다. ');</script>";
				}
			}else if($size[2] == 3){//PNG
				// 이미지생성 라이브러리 지원유무에 따른 처리
				if ( function_exists("imagecreatefrompng") ) 
				{	
					$src = @imagecreatefrompng($image);
					if (!$src) 
					{
						echo "<script>alert('이미지(대)가 PNG 파일이 아닙니다.');</script>";
					} 
					else 
					{
						/* ------------------------------------------------------------- [ 썸네일 생성 - START ] ------------------------------------------------------------- */
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnProd[simg_width],$GnProd[simg_height]);
						// gd 버전에 따라
						if (function_exists("imagecopyresampled")) {
							// 이미지(소) 생성
							$dst = imagecreatetruecolor($simg_width, $simg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						} else {
							// 이미지(소) 생성
							$dst = imagecreate($simg_width, $simg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $simg_width, $simg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnProd["img_quality"]);//imagepng 는 이미지 생성이 안됨

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnProd[mimg_width],$GnProd[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnProd["prod_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnProd["img_quality"]);//imagepng 는 이미지 생성이 안됨
						/* ------------------------------------------------------------- [ 썸네일 생성 - END ] ------------------------------------------------------------- */
					}
				}
				// imagecopyresampled를 지원하지 않으면
				else 
				{
					echo "<script>alert('호스팅 서버에서 imagecreatefrompng를 지원하는지 확인하시기 바랍니다. ');</script>";
				}
			}else{
				echo "<script>alert('이미지(대)가 JPG 또는 GIF 또는 PNG 파일이 아닙니다.');</script>";
			}
		/***************************************/
		/********2017-05-26 gamgak K.H***********/
		/*******이미지 확장자에 따른 리사이징*******/
		/***************************************/
    }
}

/* ------------------------------------------------------------- [ mode 처리 - START ] ------------------------------------------------------------- */
if ($mode=="W"){
    if (!trim($it_id)) {
        alert("제품 코드가 없으므로 제품을 추가하실 수 없습니다.");
    }

    $sql = " insert $PG_table
                set it_id = '$it_id',
					$input_value	";
    sql_query($sql);
}
else if ($mode=="E")
{
	$sql = " update $PG_table
				set $input_value
			  where it_id = '$it_id' ";
	sql_query($sql);
}else if ($mode=="D"){
	
	if($_GET[it_id]) {
		// 해당 it_id 폴더내의 모든 이미지 삭제
		directoryDelete($GnProd["prod_dir"]);
	}

    // 제품 삭제
	$sql = " delete from $PG_table where it_id = '$it_id' ";
	sql_query($sql);


	// 확장 입력있을시 삭제
	$ex_sql = " delete from $EX_table where d_it_id = '$it_id' ";
	sql_query($ex_sql);
}

$qstr = "$qstr&sca=$sca&page=$page";

if ($mode=="E" || $mode == "D")  {
	goto_url("./item_list.php?$qstr");
}
?>

<script>
	if (confirm("계속 입력하시겠습니까?"))
		location.href = "<?="./item_form.php?mode=W&ca_id=$ca_id&$qstr"?>";
	else
		location.href = "<?="./item_list.php?$qstr"?>";
</script>