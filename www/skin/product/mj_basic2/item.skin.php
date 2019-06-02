<!--
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	관리자->제품관리->상세등록에 입력된 리스트를 겔러리 형태로 출력하는 스킨 - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	관리자->제품관리->상세등록에 입력한 리스트를 출력
|	겔러리 형태로 작은 이미지를 클릭시 뷰 이미지가 바뀌는 형태
|	현재 스킨을 /skin/product/basic/item.skin.php 에 덮어쓰면 바로 작동함.
|	
|	적용 예 : http://dosim.gamgakdesign.com/product/list.php?ca_id=1010
|	2015 - MJ
|
-->

<!-- ------------------------------------------------------------- [ 디자인 - Start ] ------------------------------------------------------------- -->
<div class="sub03view_wrap">
	<div class="sub03view_img">
		<p><div id="big_img_area" width="<?=$GnProd["mimg_width"]?>" height="<?=$GnProd["mimg_height"]?>" style="text-align:center; line-height:<?=$GnProd["mimg_height"]?>px"><?=$view[m_img_1]?></div></p>		
	</div>
	<div class="sub03view_cont md30 ">
	 <h4>Product Detail </h4>
		<div class="select_imgbox " >
			<?
			// it_id로 제품관리->확장테이블 리스트 가져오기
			$ex_sql = "SELECT * FROM {$EX_table} WHERE d_it_id='$view[it_id]' ";
			$ex_query = sql_query($ex_sql);
			$ex_count = mysql_num_rows($ex_query);

			for( $i=0; $i<$ex_count; $i++) 
			{
				$ex_view[$i] = sql_fetch_array($ex_query);
				//이미지를 리사이징 처리
				$wsize = 85;
				$hsize = 101;

				// 현재 파일이름이 이미지 확장자 일때만 리사이징 함수를 호출하고 이미지 배열변수($Ex_table_img)를 생성
				$imgtypecheck = check_img_type($ex_view[$i][d_file_rname]);
				if( $imgtypecheck == TRUE) {
					$Ex_table_img[] = img_resize_tag($GnProd["ex_target_url"]."/".$ex_view[$i]["d_file_rname"],$wsize,$hsize,"style='vertical-align:middle; cursor:pointer;' onclick='click_small_img(this.src)' ");
				}
			}
			?>

			<?
			// 생성된 리사이징 배열만큼 반복
			for($i=0; $i<count($Ex_table_img); $i++) 
			{
				?><div class="img_s" style="height:101px; line-height:101px;"><?=$Ex_table_img[$i]?></div><? 
			}
			// 이미지가 없을때
			if( count($Ex_table_img) == 0 ) 
			{
				?>no-images<?
			}
			?>
	
		</div>
		<div class="detail_cont mt10">
			<h5>사옥 신축검사</h5>
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tbl_detail_cont mt10">
					<colgroup>
						<col width="25%" />
						<col width="65%" />
					</colgroup>
					<tr>
						<th>위치</th>
						<td><?=$view[it_ex1]?></td>
					</tr>
					<tr>
						<th>연면적</th>
						<td><?=$view[it_ex2]?></td>
					</tr>
					<tr>
						<th>규모</th>
						<td><?=$view[it_ex3]?></td>
					</tr>
					<tr>
						<th>용도</th>
						<td><?=$view[it_ex4]?></td>
					</tr>
					<tr>
						<th>구조</th>
						<td><?=$view[it_ex5]?></td>
					</tr>
				</table>
		</div>
	</div>
</div>


<style type="text/css">
.sub03view_wrap{width:800px; position:relative; overflow:hidden; }
.sub03view_img{float:left; width:430px; height:512px;}
.sub03view_cont{position:relative; float:left; width:335px;}
.sub03view_cont h4{font-weight:bold; color:#222; font-size:14px;}
.select_imgbox{float:left;width:330px; height:252px; border-top:1px solid #ccc;border-bottom:1px solid #ccc; min-height:250px;padding-left:10px; overflow-y:scroll;}
.img_s{float:left; width:100px; margin-top:16px;}
.detail_cont{float:left;width:335px;}
.detail_cont h5{ font-weight:bold; font-size:14px; color:#222;background:url(/images/sub/point01.jpg) no-repeat 0 6px; padding-left:18px;}

/*표*/
.tbl_detail_cont,.tbl_detail_cont th,.tbl_detail_cont td{border:0px;}
.tbl_detail_cont{width:100%;border-bottom:1px solid #ccc;font-family:'돋움',dotum;font-size:12px;border-collapse:collapse}
.tbl_detail_cont th{padding:4px;border-top:1px solid #ccc;  font-weight:bold; text-align:left; padding-left:20px;background-color:#f5f5f5; font-weight:bold; color:#333;}
.tbl_detail_cont td{padding:4px;color:#4c4c4c; border-top:1px solid #ccc; border-bottom:1px solid #ccc; text-align:left; padding-left:20px;}
</style>


<table width="100%">
<tr>
<td style="padding-top:50px;" align="center"><a href="./list.php?ca_id=<?=$ca_id?>"><img src="/btn/btn_list.gif"></a></td>
</tr>
</table>
</td>
</tr>
</table>


<script type="text/javaScript">
/* ------------------------------------------------------------- [ 이미지경로로 리사이징될 width|height 반환 - mj - Start ] ------------------------------------------------------------- */
function sum_imgResize(mwidth, mheight, src) 
{
    maxsize		=	mwidth;		// 최대 가로
	maxheight	=	mheight;		// 최대 세로
	src				=	src				// 이미지 경로

	// 이미지 경로로부터 원본 이미지의 사이즈 구하기
	img = document.body.appendChild(document.createElement('img'));
    img.src = src;
    var w = img.offsetWidth; 
    var h = img.offsetHeight; 
    document.body.removeChild(img);
	
	// 가로 이미지일 경우
	if ( w > maxsize ) 
	{
		var heightSize = ( h * maxsize ) / w ; 
		w = maxsize; 
		h = heightSize; 
	}
	// 세로 이미지일 경우
	if ( h > maxheight ) 
	{ 
		var widthSize = (w * maxheight )/h; 
		h = maxheight; 
		w = widthSize;
	}
	
	var return_value = w+"|"+h;
	return return_value;
}

/* ------------------------------------------------------------- [ 특정 클래스,아이디영역 이미지 리사이징 비율로 출력하기 - mj - End ] ------------------------------------------------------------- */
function click_small_img(src) 
{
	//	리사이징 처리함수 호출 -> 구분자가 포함된 width|height 값을 반환받게 됨
	var sum_size = sum_imgResize(430,512,src);
	// "|" 구분자로 배열로 저장
	var sum_size_array = sum_size.split("|");
	// 가로, 세로 사이즈 변수 저장
	var sum_width = sum_size_array[0];
	var sum_height = sum_size_array[1];

	// 이미지를 감싸는 div 영역
	var img = $("#big_img_area").find("img");
	img.hide();

	// 이미지의 크기를 재 정의 한다.
	img.attr("width",sum_width).attr("height",sum_height);

	// 뷰이미지의 경로를 클릭한 이미지의 경로로 변경한다.
	img.fadeIn("fast").attr("src",src);
}
</script>