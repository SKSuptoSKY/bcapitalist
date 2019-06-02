<?
// 배너 넘버로 단일 이미지만 가져올때 아래 함수 사용
function get_rolling_banner($bn_no) {
	// 설정파일 로드
	include $_SERVER[DOCUMENT_ROOT]."/admin/rolling_banner/lib/lib.php";
	
	// $bn_no로 등록된 배너가 로우가 있는지 카운트
	$banner_sql = "SELECT * FROM {$PG_table} WHERE bn_no='$bn_no'";
	$banner_query = mysql_query($banner_sql);
	$banner_count = mysql_num_rows($banner_query);

	if($banner_count != 0) 
	{
		// 등록된 배너 로우가져오기
		$banner_row = mysql_fetch_array($banner_query);
		// 이미지의 경로
		$img_src = $banner_list[$i][bn_dir]."/".$banner_row[bn_rname]."";
		// 리사이징처리
		$this_type = $banner_list[$i][type];	// 배너의 타입
		$resize_img = img_resize_tag($img_src,$b_width[$this_type],$b_height[$this_type]);
		$bn_img = "<a href='$banner_row[bn_link]' target='$banner_row[bn_link_target]'>$resize_img</a>";
	} 
	else 
	{
		$bn_img = "등록된 이미지가 없습니다.";
	}
	
	return $bn_img;
}



// 같은 타입넘버에 해당하는 이미지리스트를 출력할때 아래 함수 사용
function get_rolling_list($type) {
	// 설정파일 로드
	include $_SERVER[DOCUMENT_ROOT]."/admin/rolling_banner/lib/lib.php";
	
	// $bn_no로 등록된 배너가 로우가 있는지 카운트
	$banner_sql = "SELECT * FROM {$PG_table} WHERE type='$type' ORDER BY bn_sort ASC, bn_no ASC ";
	$banner_query = mysql_query($banner_sql);
	$banner_count = mysql_num_rows($banner_query);

	if($banner_count != 0) 
	{
		// 등록된 배너 로우가져오기
		for($i=0; $i<$banner_count; $i++ ) {
			$banner_list[$i] = mysql_fetch_array($banner_query);

			// 이미지의 경로
			$banner_list[$i]["img_src"] = $banner_list[$i][bn_dir]."/".$banner_list[$i][bn_rname];

			// 리사이징처리
			$this_type = $banner_list[$i][type];	// 배너의 타입
			$resize_img = img_resize_tag($banner_list[$i]["img_src"],$b_width[$this_type],$b_height[$this_type]);
			$banner_list[$i]["bn_img"] = "<a href='$banner_row[bn_link]' target='$banner_row[bn_link_target]'>$resize_img</a>";
		}
		
		return $banner_list;
	}
	else 
	{
		$banner_list = array();
		return $banner_list;
	}
	
}

function get_rolling_gallery($type) {
	// 설정파일 로드
	include $_SERVER[DOCUMENT_ROOT]."/admin/rolling_banner/lib/lib.php";
	
	// $bn_no로 등록된 배너가 로우가 있는지 카운트
	$banner_sql = "SELECT * FROM {$PG_table} WHERE type='$type' ORDER BY bn_sort DESC, bn_no DESC ";
	$banner_query = mysql_query($banner_sql);
	$banner_count = mysql_num_rows($banner_query);

	if($banner_count != 0) 
	{
		// 등록된 배너 로우가져오기
		for($i=0; $i<$banner_count; $i++ ) {
			$banner_list[$i] = mysql_fetch_array($banner_query);

			// 이미지의 경로
			$banner_list[$i]["img_src"] = $banner_list[$i][bn_dir]."/".$banner_list[$i][bn_rname];

			// 리사이징처리
			$this_type = $banner_list[$i][type];	// 배너의 타입
			$resize_img = img_resize_tag($banner_list[$i]["img_src"],$b_width[$this_type],$b_height[$this_type]);
			$banner_list[$i]["bn_img"] = "<a href='$banner_row[bn_link]' target='$banner_row[bn_link_target]'>$resize_img</a>";
		}
		
		return $banner_list;
	}
	else 
	{
		$banner_list = array();
		return $banner_list;
	}
	
}
?>