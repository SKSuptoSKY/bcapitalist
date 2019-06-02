<?
$tv_idx = get_session("ss_tv_idx");

function get_image1($img, $width=0, $height=0)
{

	$full_img = $_SERVER["DOCUMENT_ROOT"]."/shop/data/item/$img";

    if (file_exists($full_img) && $img)
    {
        if (!$width)
        {
            $size = getimagesize($full_img);
            $width = $size[0];
            $height = $size[1];
        }
        $str = "<img id='$img' src='$GnShop[shop_url]/shop/data/item/$img' width='$width' height='$height' border='0'>";
    }
    else
    {
        $str = "<img id='$img' src='$GnShop[shop_url]{$GnShop[skin_url]}/images/no_image.gif' border='0' ";
        if ($width)
            $str .= "width='$width' height='$height'";
        else
            $str .= " ";
        $str .= ">";
    }


    return $str;
}

$tv_div[top] = 0;
$tv_div[img_width] = 70;
$tv_div[img_height] = 105;
$tv_div[img_length] = 1; // 보여지는 최대 이미지수
?>

<table  width="92" cellpadding=0 cellspacing=0 border="0" bgcolor="#FFFFFF">
<?
// 오늘 본 상품이 있다면
if ($tv_idx)
{
    // 오늘 본 상품갯수가 보여지는 최대 이미지 수 보다 크다면 위로 화살표를 보임
    if ($tv_idx > $tv_div[img_length])
        echo "<tr><td align='center'><a href='javascript:;' onclick='javascript:todayview_up();'>▲</a></td></tr>";

    // 오늘 본 상품 이미지 출력
    echo "<tr><td><table width=100% cellpadding=2>";
    for ($i=1; $i<=$tv_div[img_length]; $i++)
    {
        echo "<tr><td align=center>";
        echo "<span id='todayview_{$i}'></span>";
        echo "</td></tr>";
    }
    echo "</table></td></tr>";

    // 오늘 본 상품갯수가 보여지는 최대 이미지 수 보다 크다면 아래로 화살표를 보임
    if ($tv_idx > $tv_div[img_length])
        echo "<tr><td align='center'><a href='javascript:;' onclick='javascript:todayview_dn();'>▽</a></td></tr>";
}
else
{
    echo "<tr><td></td></tr>";
}
?>
</table>
<!-- 오늘 본 상품 -->
<script language="JavaScript">
var goods_link = new Array();
<?
echo "var goods_max = ".(int)$tv_idx.";\n";
echo "var goods_length = ".(int)$tv_div[img_length].";\n";
echo "var goods_current = goods_max;\n";
echo "\n";

for ($i=1; $i<=$tv_idx; $i++)
{
    $tv_it_id = get_session("ss_tv[$i]");
    $rowx = sql_fetch(" select * from Gn_Shop_Item where it_id = '$tv_it_id' ");
    //$it_name = get_text(addslashes($rowx['it_name']));
    $img = get_image1("{$rowx[it_id]}_l1", 80, 50);
    $img = preg_replace("/\<a /", "<a title='$it_name' ", $img);
    echo "goods_link[$i] = \"<a href='/shop/item.php?it_id={$rowx[it_id]}'>{$img}</a><br/><br/><span style=color:#ff0000;>".cut_str($it_name,10,"")."</span>\";\n";
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
    echo "if (document.getElementById('todayviewcount')) document.getElementById('todayviewcount').innerHTML = '$tv_idx';\n";
}
?>
</script>

<script language=javascript>

<?
if ($_COOKIE['ck_tvhidden'])
    echo "todayview_hidden();";
?>
//-->
</script>
