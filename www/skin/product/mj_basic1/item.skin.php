<!--
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	관리자->제품관리->첨부파일에 업로드된 이미지를 겔러리 형태로 출력하는 스킨 - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	관리자->제품관리에 등록한 내용을 출력
|	겔러리 형태로 작은 이미지를 클릭시 뷰 이미지가 바뀌는 형태
|	현재 스킨을 /skin/product/basic/item.skin.php 에 덮어쓰면 바로 작동함.
|	
|	적용 예 : TIDPLAN : PROJECT 메뉴
|	2015 - MJ
|
-->

<!-- ------------------------------------------------------------- [ 디자인 - Start ] ------------------------------------------------------------- -->
<div class="right_content">
	<div class="left_con">
		<div class="view_h">
			<h3><?=$view[it_name]?></h3>
			<p><?=$view[it_ex1]?></p>
		</div>
		<p class="view_p mt30">
			<?=stripslashes(strip_tags($view[it_explan]))?>
		</p>
		<div class="inform">
			<table cellpadding="0" cellspacing="0" border="0">
				<colgroup>
					<col width="35%">
					<col width="65%">
				</colgroup>
				<tr>
					<th class="pt20">Location</th>
					<td class="pt18"><?=$view[it_ex2]?></td>
				</tr>
				<tr>
					<th class="pt5">Usage</th>
					<td class="pt5"><?=$view[it_ex3]?></td>
				</tr>
				<tr>
					<th class="pt5">Client</th>
					<td class="pt5"><?=$view[it_ex4]?></td>
				</tr>
				<tr>
					<th class="pt5">Project</th>
					<td class="pt5"><?=$view[it_ex5]?></td>
				</tr>
				<tr>
					<th class="pt5">Year</th>
					<td class="pt5"><?=$view[it_ex6]?></td>
				</tr>
			</table>
		</div>
		<div class="mt67"><a href="./list.php?ca_id=<?=$ca_id?>"><img src="/images/sub_img/list.jpg" alt="" /></a></div>
	</div>
	<div class="right_con">
		
		<div style="position:relative; width:610px; height:415px margin:0 auto; text-align:left;">
			<ul class="bxslider">
				<li><div id="big_img_area" width="<?=$GnProd["mimg_width"]?>" height="<?=$GnProd["mimg_height"]?>" style="text-align:center; line-height:<?=$GnProd["mimg_height"]?>px"><?=$view[m_img_1]?></div></li>
			</ul>
		</div>
		<div id="bx-pager" class="mt8">
			<?
			// 체인지 효과줄 작은이미지 만들기 (m사이즈 이미지로 리사이징)
			for( $i=1; $i<=$GnProd["max_img_count"]; $i++) 
			{
				if( $i%$GnProd["max_img_count"] != 0 ) { $md5 = "md5"; } else {  $md5 = ""; } 
				?><div class="img_s <?=$md5?>"><?=$view["m_img_".$i."_resize"]?></div><? 
			}
			?>
			<style type="text/css">.img_s{float:left; width:118px; height:82px; line-height:82px; text-align:center;}</style>
		</div>

	</div>
</div>


<style>
.f_left{float:left;}
.f_right{float:right;}
.right_content{width:1000px; margin:0 auto; height:500px;}
.view_h{width:340px; height:48px; background:url(/images/sub_img/title_bar.jpg) left top no-repeat; padding-top:10px; font-size:13px; color:#999;}
.view_h h3{font-size:15px; color:#b51626;}
.left_con{width:340px; height:505px; float:left;}
.right_con{width:610px; height:505px;  float:right;}
.view_p{font-size:13px; color:#444; line-height:20px;}
.inform{height:120px;  background:url(/images/sub_img/infor_top.png) left top no-repeat; margin-top:100px;}
.inform th{font-size:13px; color:#999; text-align:left;}
.inform td{font-size:13px; color:#444;}
#bx-pager a{float:left;}
</style>


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
	var sum_size = sum_imgResize(610,415,src);
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