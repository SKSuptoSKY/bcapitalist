<?
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

/* ------------------------------------------------------------- [ 브라우져 구분 - START ] ------------------------------------------------------------- */
$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
if (preg_match('/opera/', $userAgent)) {
	$name = 'opera';
}
elseif (preg_match('/webkit/', $userAgent)) {
	$name = 'safari';
}
elseif (preg_match('/msie/', $userAgent)) {
	$name = 'msie';
}
elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
	$name = 'mozilla';
}
else {
	$name = 'unrecognized';
}
/* ------------------------------------------------------------- [ 브라우져 구분 - END ] ------------------------------------------------------------- */
?>


<script type="text/javascript">
// 퀵메뉴 시작
var stmnLEFT = "950"; // 스크롤메뉴의 좌측 위치
var stmnGAP1 = 0; // 페이지 헤더부분의 여백
var stmnGAP2 = 200; // 스크롤시 브라우저 상단과 약간 띄움. 필요없으면 0으로 세팅
var stmnBASE = 400; // 스크롤메뉴 초기 시작위치 (아무렇게나 해도 상관은 없지만 stmnGAP1과 약간 차이를 주는게 보기 좋음)
var stmnActivateSpeed = 0; // 움직임을 감지하는 속도 (숫자가 클수록 늦게 알아차림)
var stmnScrollSpeed = 0; // 스크롤되는 속도 (클수록 늦게 움직임)

var stmnTimer;

function ReadCookie(name) {
	var label = name + "=";
	var labelLen = label.length;
	var cLen = document.cookie.length;
	var i = 0;

	while (i < cLen) {
		var j = i + labelLen;

		if (document.cookie.substring(i, j) == label) {
			var cEnd = document.cookie.indexOf(";", j);
			if (cEnd == -1) cEnd = document.cookie.length;
			return unescape(document.cookie.substring(j, cEnd));
		}
		i++;
	}
	return "";
}

function SaveCookie(name, value, expire) {
	var eDate = new Date();
	eDate.setDate(eDate.getDate() + expire);
	document.cookie = name + "=" + value + "; expires=" +  eDate.toGMTString()+ "; path=/";
}

function RefreshStaticMenu()
{
	var stmnStartPoint, stmnEndPoint, stmnRefreshTimer;
	stmnStartPoint = parseInt(STATICMENU.style.top, 10);

	<?
	// 브라우져 구분하여 처리
	if($name=="safari")
	{
		?>stmnEndPoint = window.document.body.scrollTop + stmnGAP2;<?
	}
	else if($name=="msie")
	{
		?>stmnEndPoint = document.documentElement.scrollTop + stmnGAP2;<?
	}
	else
	{
		?>stmnEndPoint = document.documentElement.scrollTop + stmnGAP2;<?
	}
	?>

	stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(STATICMENU.offsetHeight) - 220 ; //하단에서 10만큼 위로 올려서....스톱
	if (stmnEndPoint > stmnLimit) stmnEndPoint = stmnLimit;
	if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1;
	stmnRefreshTimer = stmnActivateSpeed;
	if ( stmnStartPoint != stmnEndPoint ) {
		stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 );
		STATICMENU.style.top = parseInt(STATICMENU.style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount );
		stmnRefreshTimer = stmnScrollSpeed;
	}
	stmnTimer = setTimeout ("RefreshStaticMenu();", stmnRefreshTimer);
}


function ToggleAnimate() {
	if (ANIMATE.value == false) {
		RefreshStaticMenu();
		SaveCookie("ANIMATE", "true", 300);
	}
	else {
		clearTimeout(stmnTimer);
		STATICMENU.style.top = stmnGAP1;
		SaveCookie("ANIMATE", "false", 300);
	}
}

function InitializeStaticMenu() {
	STATICMENU.style.left = stmnLEFT;
	if (ReadCookie("ANIMATE") == "false") {
		ANIMATE.value = true;
		STATICMENU.style.top = document.documentElement.scrollTop + stmnGAP1;
	}
	else {
		ANIMATE.value = false;
		STATICMENU.style.top = document.documentElement.scrollTop + stmnBASE;
		RefreshStaticMenu();
	}
}
// 퀵메뉴 
</script>

<?
$tv_idx = get_session("ss_tv_idx");
$tv_div[top] = 0;
$tv_div[img_width]	= 62;
$tv_div[img_height] = 62;
$tv_div[img_length] = 3; // 보여지는 최대 이미지수


/*
function get_image1($img, $wsize=0, $hsize=0)
{
	$full_img = $_SERVER["DOCUMENT_ROOT"]."/shop/data/item/$img";
	if (file_exists($full_img) && $img)
	{
		//if (!$width)
		//{
			$size = getimagesize($full_img);
			$width = $size[0];
			$height = $size[1];
		//}
		list($resize_arr[0],$resize_arr[1]) = img_resize_size($width,$height,$wsize,$hsize);


		$str = "<img id='$img' src='/shop/data/item/$img' width='{$resize_arr[0]}' height='{$resize_arr[1]}' style='border:0px solid #c7c7c7;'>";
	}
	else
	{
		//$str = "<img id='$img' src='/images/quick/no-img.jpg' border='0' "; // 원본 주석처리
		$str = "<span style='style2'> no image </span ";
		if ($width)
			$str .= " width='$width' height='$height' border='0' style='border:1px solid #d2d6da;' border='0'";
		else
			$str .= " ";
		$str .= ">";
	}
	return $str;
}
*/

// 함수 재정의 - mj
// @parameter : ( 상품테이블로우, 출력가로사이즈, 출력세로사이즈, $GnShop배열변수 )
function get_image1($rowx, $wsize=0, $hsize=0,$GnShop)
{
	// 트래픽 최소화를 위해 s 사이즈 이미지를 가져와서 리사이징
	$file_name["small"] = str_replace($rowx["it_id"]."_l", $rowx["it_id"]."_s", $rowx["it_file1"]);
	$limg = $GnShop['data_dir']."/".$rowx["it_id"]."/".$file_name["small"];
	$s_img = img_resize_tag($GnShop['data_url']."/".$rowx["it_id"]."/".$file_name["small"],$wsize,$hsize," style='border:1px solid #c7c7c7;' ");
	$str = $s_img;

	return $str;
}
?>
<div id="STATICMENU" class="quick_all">
	<div class="sticky">
		<div class="quick_box">
			<h2>Today View</h2>
			<?if ($tv_idx){?>
			<div>
				<table width="64" cellpadding="0" cellspacing="0" border="0" style="margin-top:10px;">
					<? if ($tv_idx > $tv_div[img_length]){?>
					<!-- 위로 버튼 들어갈 자리 -->
					<tr>
						<td align="center"><a href='javascript:;' onclick='javascript:todayview_up();' onFocus="blur()">▲</a></td>
					</tr>
					<? } ?>
					<!-- 반복-->
					<tr>
						<td>
						<div >
							<table width="100%"cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td align="center" style="padding-top:5px; padding-bottom:0px; padding-left:0px; padding-right:0px;">
										<?for ($i=1; $i<=$tv_div[img_length]; $i++) {	?>
										<tr>
											<td align="center" style="padding-top:5px; padding-bottom:0px; padding-left:0px; padding-right:0px;">
												<div style="display: table; width: 62px; height: 62px; #position: relative; overflow: hidden;" >
													<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
														<div style=" #position: relative; #top: -50%; #left: -50%;">
															<span id='todayview_<?=$i?>'></span>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<?  } ?>
										<?
										if($tv_idx < $tv_div[img_length]){
										for($z=$tv_idx; $z < $tv_div[img_length];$z++){
										?>
										<!-- <tr>
											<td align="center" style="padding-top:5px; padding-bottom:5px; padding-left:0px; padding-right:0px;">
												<div style="display: table; width: 62px; height: 62px; #position: relative; overflow: hidden;background:white;">
													<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
														<div style=" #position: relative; #top: -50%; #left: -50%;">
															no image
														</div>
													</div>
												</div>
											</td>
										</tr> -->
										<?}}?>
									</td>
								</tr>
							</table>
							</div>
						</td>
					</tr>
					<!-- end for -->
					<? if ($tv_idx > $tv_div[img_length]){?>
					<!-- 아래 버튼 들어갈 자리 -->
					<tr>
						<td style="padding-top:5px;" align="center"><a href='javascript:;' onclick='javascript:todayview_dn();' onFocus="blur()">▼</a></td>
					</tr>
					<? } ?>
				</table>
			</div>
			<? }else{ ?>
			<div class="quick_list_box mt5">
				<div style="display: table; width: 62px; height: 240px; #position: relative; overflow: hidden;">
					<div style=" #position: absolute; #top: 50%; #left: 50%; display: table-cell; vertical-align: middle; text-align: center;">
						<div style=" #position: relative; #top: -50%; #left: -50%;">
							This item is not today.
						</div>
					</div>
				</div>
			</div>
			<!-- <table width="75" height="80" cellpadding="0" cellspacing="0" border="0" style="background:url('/images/main/quick_bg.png') 0 0 repeat-y;">
				<tr>
					<td id="q_bg" align="center">This item is not today.</td>
				</tr>
			</table> -->
			<? } ?>
			<table>
				<tr>
					<td><input id="ANIMATE" type="hidden" onClick="ToggleAnimate();" value="false"></td>
				</tr>
			</table>
		</div>
		<div class="btn_top"><a href="#wrapper">TOP</a></div>
	</div>
</div>
<script type="text/javascript">
<!--
InitializeStaticMenu(); // 스크롤메뉴를 가동하는 자바스크립트

var goods_link = new Array();
<?
echo "var goods_max = ".(int)$tv_idx.";\n";
echo "var goods_length = ".(int)$tv_div[img_length].";\n";
echo "var goods_current = goods_max;\n";
echo "\n";

for ($i=1; $i<=$tv_idx; $i++)
{
	$tv_it_id = get_session("ss_tv[$i]");


	$rowx = sql_fetch("select * from Gn_Shop_Item where it_id = '$tv_it_id' ");
	$it_name = get_text(addslashes($rowx['name']));
	
	//$img = get_image1("{$rowx[it_id]}_l1", 62, 62); // 사용안함
	$img = get_image1($rowx, 60, 40, $GnShop);

	$img = preg_replace("/\<a /", "<a title='$it_name' ", $img);
	echo "goods_link[$i] = \"<a href='/shop/item.php?it_id={$rowx[it_id]}'>{$img}</a>\";\n";
}
?>


var divSave = null;

function todayview_visible()
{
	set_cookie('ck_tvhidden', '', 1);
	document.getElementById('divToday').innerHTML = divSave;
}

function todayview_hidden()
{
	divSave = document.getElementById('divToday').innerHTML;
	set_cookie('ck_tvhidden', '1', 1);
	document.getElementById('divToday').innerHTML = document.getElementById('divTodayHidden').innerHTML;
}

function todayview_move(current)
{
	k = 0;
	for (i=goods_current; i>0 ; i--)
	{
		k++;
		if (k > goods_length)
			break;
		document.getElementById('todayview_'+k).innerHTML = goods_link[i];
	}
}

function todayview_up()
{
	if (goods_current + 1 > goods_max)
		alert("오늘 본 마지막 상품입니다.");
	else
		todayview_move(goods_current++);
}

function todayview_dn()
{
	if (goods_current - goods_length == 0)
		alert("오늘 본 처음 상품입니다.");
	else
		todayview_move(goods_current--);
}

<?
$k=0;
for ($i=$tv_idx; $i>0; $i--)
{
	$k++;
	if ($k > $tv_div[img_length])
		break;

	$tv_it_id = get_session("ss_tv[$i]");
	echo "document.getElementById('todayview_{$k}').innerHTML = goods_link[$i];\n";
}

if ($tv_idx)
{
	echo "if (document.getElementById('todayviewcount')) document.getElementById('todayviewcount').innerHTML = '($tv_idx)';\n";
}
?>

//-->
</script>

<script language=javascript>
<?
if ($_COOKIE['ck_tvhidden'])
	echo "todayview_hidden();";
?>
//-->
</script>