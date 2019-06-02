<?
include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

$PG_table = $GnTable["newwin"];
$JO_table = "";

$sql = " select * from $PG_table
          where '$datetime' between nw_begin_time and nw_end_time
          order by nw_id asc ";

$result = sql_query($sql);
?>
<script language="javascript" type="text/javascript">
isIE=document.all;
isNN=!document.all&&document.getElementById;
isN4=document.layers;
isHot=false;

function ddInit(e){
	topDog=isIE ? "BODY" : "HTML";
	whichDog=isIE ? document.all.theLayer : document.getElementById("theLayer");
	hotDog=isIE ? event.srcElement : e.target;
	while (hotDog.id!="titleBar"&&hotDog.tagName!=topDog){
		hotDog=isIE ? hotDog.parentElement : hotDog.parentNode;
	}
	if (hotDog.id=="titleBar"){
		offsetx=isIE ? event.clientX : e.clientX;
		offsety=isIE ? event.clientY : e.clientY;
		nowX=parseInt(whichDog.style.left);
		nowY=parseInt(whichDog.style.top);
		ddEnabled=true;
		document.onmousemove=dd;
	}
}

function dd(e){
	if (!ddEnabled) return;
	whichDog.style.left=isIE ? nowX+event.clientX-offsetx : nowX+e.clientX-offsetx;
	whichDog.style.top=isIE ? nowY+event.clientY-offsety : nowY+e.clientY-offsety;
	return false;
}

function ddN4(whatDog){
	if (!isN4) return;
	N4=eval(whatDog);
	N4.captureEvents(Event.MOUSEDOWN|Event.MOUSEUP);
	N4.onmousedown=function(e){
		N4.captureEvents(Event.MOUSEMOVE);
		N4x=e.x;
		N4y=e.y;
	}
	N4.onmousemove=function(e){
		if (isHot){
			N4.moveBy(e.x-N4x,e.y-N4y);
			return false;
		}
	}
	N4.onmouseup=function(){
		N4.releaseEvents(Event.MOUSEMOVE);
	}
}

function hideMe(){
	if (isIE||isNN) whichDog.style.visibility="hidden";
	else if (isN4) document.theLayer.visibility="hide";
}

function showMe(){
	if (isIE||isNN) whichDog.style.visibility="visible";
	else if (isN4) document.theLayer.visibility="show";
}

document.onmousedown=ddInit;
document.onmouseup=Function("ddEnabled=false");

function notice_setCookie( name, value, expiredays )
{
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + '=' + escape( value ) + '; path=/; expires=' + todayDate.toGMTString() + ';'
	return;
}
function notice_getCookie( name )
{
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
				endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 ) break;
	}
	return "";
}
</script>
<?
for ($i=0; $row_nw=sql_fetch_array($result); $i++) {
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["ck_notice_{$row_nw[nw_id]}"]) continue;
	if($row_nw[nw_disable_layer] != "1"){ // 팝업일시
?>

<script language='javascript' src='/GnCommon/js/javascript.js'></script>
<script language="JavaScript">

    var opt = "scrollbars=yes,width=<?=$row_nw[nw_width]+20?>,height=<?=($row_nw[nw_height]+30)?>,top=<?=$row_nw[nw_top]?>,left=<?=$row_nw[nw_left]?>";
    popup_window("/newwin/newwinpop.php?&nw_id=<?=$row_nw[nw_id]?>", "WINDOW_<?=$row_nw[nw_id]?>", opt);
</script>
<? }else{//레이어일시
	$nw_id = $row_nw[nw_id];
	?>  
	<div style="position:relative; width:500px;">
		<div style="position:absolute;top:<?=$row_nw[nw_top]?>px; left:<?=$row_nw[nw_left]?>px;">
			<?include $_SERVER["DOCUMENT_ROOT"]."/newwin/newwinpop.php";?>
		</div>
	</div>
<?}
	} ?>
