<?
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	상품업데이트
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	* 상품테이블 업데이트, 
|	* 상품옵션 업데이트, 
|	* 장바구니테이블 업데이트, 
|	* 상품디렉토리 생성,삭제,권한설정,
|	* 상품이지미 업데이트
|	
|	2015-02 mj
|
*/
include "../head.php";
include "./lib/lib.php"; // 쇼핑몰 라이브러리


/* ------------------------------------------------------------- [ 기본 변수 설정 - START ] ------------------------------------------------------------- */
$PG_table = $GnTable["shopitem"];
$JO_table = $GnTable["shopcategory"];


/* ------------------------------------------------------------- [ 옵션 쿼리 - START ] ------------------------------------------------------------- */
//먼저 기존 옵션 다 삭제 후 다시 넘어온걸 넣어준다!
sql_query("update Gn_Shop_Add_option set itop_flag = 'x' where itop_it_id='".$_POST[it_id]."'");

//먼저 기존 옵션 다 삭제 후 다시 넘어온걸 넣어준다!
for($i=0; $i < count($_POST[it_op_name]); $i++){
	if($_POST[itop_no][$i] == ""){ // 새로 등록 된 옵션
		$sql = "insert Gn_Shop_Add_option set
						itop_it_id = '".$_POST[it_id]."',
						itop_type = '".$_POST[it_op_type][$i]."',
						itop_opt1 = '".$_POST[it_op_name][$i]."',
						itop_stock = '".$_POST[it_op_stock][$i]."',
						itop_amount_op = '".$_POST[it_op_amount_sel][$i]."',
						itop_amount = '".$_POST[it_op_amount][$i]."',
						itop_flag = '".$_POST[it_op_flag][$i]."'
					";
	}else{ // 기존 등록 옵션
		$sql = "update Gn_Shop_Add_option set
						itop_it_id = '".$_POST[it_id]."',
						itop_type = '".$_POST[it_op_type][$i]."',
						itop_opt1 = '".$_POST[it_op_name][$i]."',
						itop_stock = '".$_POST[it_op_stock][$i]."',
						itop_amount_op = '".$_POST[it_op_amount_sel][$i]."',
						itop_amount = '".$_POST[it_op_amount][$i]."',
						itop_flag='".$_POST[it_op_flag][$i]."'
						where itop_no ='".$_POST[itop_no][$i]."'";
	}	
		sql_query($sql);


	if($_POST[it_op_type][$i] == 1) $it_opt1 = 1;
	if($_POST[it_op_type][$i] == 2) $it_opt2 = 1;
	if($_POST[it_op_type][$i] == 3) $it_opt3 = 1;
	if($_POST[it_op_type][$i] == 4) $it_opt4 = 1;
	if($_POST[it_op_type][$i] == 5) $it_opt5 = 1;
	if($_POST[it_op_type][$i] == 6) $it_opt6 = 1;
}


/* ------------------------------------------------------------- [ 금액 오류 검사 - START ] ------------------------------------------------------------- */
$cnt = 0;
if ($cnt > 0) {
	if ($it_opt_use=="1") alert("옵션의 금액 입력 오류입니다.\\n\\n추가되는 금액은 + 부호를\\n\\n할인되는 금액은 - 부호를 붙여 주십시오.");
	if ($it_opt_use=="2") alert("옵션의 금액 입력 오류입니다.\\n\\n추가되는 금액은 + 부호를\\n\\n할인되는 금액은 - 부호를 붙여 주십시오.\\n\\n다중구입옵션의 경우 - 부호는 사용하실 수 없습니다.");
}


/* ------------------------------------------------------------- [ Gn_Shop_Item - Query - START ] ------------------------------------------------------------- */
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
	it_opt_use			= '$it_opt_use',
	it_opt_use2			= '$it_opt_use2',
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
	it_other				= '$it_other',
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
	it_tel_inq			= '$it_tel_inq'
";


/* ------------------------------------------------------------- [ 파일 - 업로드 / 삭제 관련 - START ] ------------------------------------------------------------- */

// 파일디렉토리 퍼미션 변경
@chmod("/shop/data/brand", 0707);
@chmod("/shop/data/explan", 0707);
@chmod("/shop/data/item/".$it_id, 0707);


for($i=1; $i<=$GnShop["max_img_count"]; $i++) 
{
	$GnShop['shop_dir'] = $GnShop['data_dir']."/".$it_id;
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
		$update_sql = "UPDATE {$GnTable['shopitem']} SET it_file{$i} = '' WHERE it_id = '$it_id' ";
		$update_query = sql_query($update_sql);

        @unlink($GnShop['shop_dir']."/".$file_name[$i]['large']);
        @unlink($GnShop['shop_dir']."/".$file_name[$i]['midium']);
        @unlink($GnShop['shop_dir']."/".$file_name[$i]['small']);
    }

	// 상품 이미지 개별 업로드 처리
	if($_FILES["it_limg".$i]["name"]) 
	{
		@mkdir($GnShop['shop_dir'], 0707);
		@chmod($GnShop["shop_dir"], 0707);
		// 해당 넘버로 업로드된 기존파일이 있다면 지우기
        @unlink($GnShop['shop_dir']."/".$file_name[$i]['large']);
        @unlink($GnShop['shop_dir']."/".$file_name[$i]['midium']);
        @unlink($GnShop['shop_dir']."/".$file_name[$i]['small']);

		// 파일 확장자 구하기
		$this_file_ext = get_file_ext($_FILES["it_limg".$i]["name"]);

		// 파일업로드시 파일이름 변환하여 필드저장하는 추가 $input_value 쿼리 생성
		$this_filename = $it_id."_l".$i.$this_file_ext;			//		ex) 124812005_l1.jpg
		$input_value .= ", it_file".$i." = '$this_filename' ";
		
		/***************************************/
		/********2017-02-28 gamgak K.H***********/
		/*******이미지 확장자에 따른 리사이징*******/
		/***************************************/

			/*이미지 확장자  검색에 따른 개발*/

			// 원본사이즈 업로드
			upload_file($_FILES["it_limg".$i]["tmp_name"], $this_filename, $GnShop["shop_dir"]);
			$image = $GnShop["shop_dir"]."/".$this_filename;
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
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnShop[simg_width],$GnShop[simg_height]);
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
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnShop["img_quality"]);

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnShop[mimg_width],$GnShop[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnShop["img_quality"]);
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
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnShop[simg_width],$GnShop[simg_height]);
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
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnShop["img_quality"]);//imagegif 는 불안하므로 imagejpeg으로 재 업로드

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnShop[mimg_width],$GnShop[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnShop["img_quality"]);//imagegif 는 불안하므로 imagejpeg으로 재 업로드
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
						list($simg_width,$simg_height) = img_resize_size($size[0],$size[1],$GnShop[simg_width],$GnShop[simg_height]);
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
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_s".$i.$this_file_ext, $GnShop["img_quality"]);//imagepng 는 이미지 생성이 안됨

						list($mimg_width,$mimg_height) = img_resize_size($size[0],$size[1],$GnShop[mimg_width],$GnShop[mimg_height]);
						if (function_exists("imagecopyresampled")) {
							// 이미지(중) 생성
							$dst = imagecreatetruecolor($mimg_width, $mimg_height);
							imagecopyresampled($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						} else {
							// 이미지(중) 생성
							$dst = imagecreate($mimg_width, $mimg_height);
							imagecopyresized($dst, $src, 0, 0, 0, 0, $mimg_width, $mimg_height, $size[0], $size[1]);
						}
						@imagejpeg($dst, $GnShop["shop_dir"]."/".$it_id."_m".$i.$this_file_ext, $GnShop["img_quality"]);//imagepng 는 이미지 생성이 안됨
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
		/********2017-02-28 gamgak K.H***********/
		/*******이미지 확장자에 따른 리사이징*******/
		/***************************************/
    }
}




/* ------------------------------------------------------------- [ mode 처리 - START ] ------------------------------------------------------------- */

// 상품 업로드
if ($mode=="W"){
    if (!trim($it_id)) {
        alert("상품 코드가 없으므로 상품을 추가하실 수 없습니다.");
    }

    $sql = " insert $PG_table
                set it_id = '$it_id',
					$input_value	";
    sql_query($sql);
}

// 상품 수정
else if ($mode=="E")
{
	$sql = " update $PG_table
				set $input_value
			  where it_id = '$it_id' ";
	sql_query($sql);
}

// 상품 삭제
else if ($mode=="D")	
{
// 상품삭제
    $str = $comma = $od_id = "";
    $sql = " select b.od_id
               from {$GnTable[shopcart]} a,
                    {$GnTable[shoporder]} b
              where a.on_uid = b.on_uid
                and a.it_id = '$it_id'
                and a.ct_status != '쇼핑' ";
    $result = sql_query($sql);
    $i=0;
    while ($row = sql_fetch_array($result)){
        if (!$od_id)
            $od_id = $row[od_id];

        $i++;
        if ($i % 10 == 0) $str .= "\\n";
        $str .= "$comma$row[od_id]";
        $comma = " , ";
    }
    if ($str){
        alert("이 상품과 관련된 주문이 총 {$i} 건 존재하므로 주문서를 삭제한 후 상품을 삭제하여 주십시오.\\n\\n$str");
    }
	
	if($_GET[it_id]) {
		// 해당 it_id 폴더내의 모든 이미지 삭제
		directoryDelete($GnShop["shop_dir"]);
	}
	
    // 장바구니 삭제
	$sql = " delete from {$GnTable[shopcart]} where it_id = '$it_id' ";
	sql_query($sql);

    // 이벤트삭제
    $sql = " delete from {$GnTable[shoppresent]} where item_num = '$it_id' ";
	sql_query($sql);

    // 사용후기삭제
    $sql = " delete from {$GnTable[shopafter]} where it_id = '$it_id' ";
	sql_query($sql);

    // 상품 삭제
	$sql = " delete from $PG_table where it_id = '$it_id' ";
	sql_query($sql);
}



$qstr = "$qstr&sca=$sca&page=$page";
if($mode=="E"){
	goto_url("./item_form.php?mode=E&it_id=$it_id&$qstr");
}else if($mode == "D"){
	goto_url("./item_list.php?$qstr");
}
?>

<script>
	if (confirm("계속 입력하시겠습니까?"))
		location.href = "<?="./item_form.php?mode=W&ca_id=$ca_id&$qstr"?>";
	else
		location.href = "<?="./item_list.php?$qstr"?>";
</script>