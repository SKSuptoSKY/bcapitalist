</DIV>
<DIV ID="objSelection">
</DIV>

<?
// 쇼핑몰 - 오늘본상품
if ($sitemenu["mn_shop_use"] && $page_loc!="product" )
{
	// 제품관리와 같이 쓰게되면 제품관리와 쇼핑몰lib 파일의 함수가 겹치는 문제때문에 제품관리쪽에선 출력시키지 않는다.
	include $_SERVER["DOCUMENT_ROOT"]."/sub_quick.php";
}
?>
</body>
</html>
<? @mysql_close(); ?>


<!-- new post -->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript" src="/addr_zip/Uzipjs/new_UzipJs.js"></script><!-- openDaumPostcode -->
