<?
//기본테이블
$GnTable["member"]			 = "Gn_Member";
$GnTable["memberlevel"]		 = "Gn_Member_Level";
$GnTable["point"]			 = "Gn_Member_Point";
$GnTable["memo"]			 = "Gn_Member_Memo";
$GnTable["memosave"]		 = "Gn_Member_Semo";
$GnTable["zipcode"]			 = "Gn_Zipcode";
$GnTable["zipname"]			 = "Gn_Zipname";
$GnTable["config"]			 = "Gn_SiteConfig";
$GnTable["bbsconfig"]		 = "Gn_Board_Config";
$GnTable["bbsfile"]			 = "Gn_Board_File";
$GnTable["bbsitem"]			 = "Gn_Board_Item_";
$GnTable["bbscomm"]			 = "Gn_Board_Comm_";
$GnTable["bbsgroup"]		 = "Gn_Board_Group";
$GnTable["online"]			 = "Gn_Online";
$GnTable["counter"]			 = "Gn_Counter";
$GnTable["countertotal"]			 = "Gn_Counter_Total";
$GnTable["search"]			 = "Gn_SearchWord";
$GnTable["menu"]			 = "Gn_Menu";
$GnTable["banner"]			 = "Gn_Banner";
$GnTable["newwin"]			 = "Gn_Newwin";
$GnTable["poll"]			 = "Gn_Poll";
$GnTable["pollquestion"]			 = "Gn_Poll_Question";
$GnTable["pollscore"]			 = "Gn_Poll_Score";
$GnTable["pageitem"]			 = "Gn_Page_Item";

//쇼핑몰테이블
$GnTable["shopconfig"]				 = "Gn_Shop_Config";		//	환경설정
$GnTable["shopcategory"]				= "Gn_Shop_Category";		//	분류
$GnTable["shopitem"]					= "Gn_Shop_Item";				//	상품
$GnTable["shopoption"]				 = "Gn_Shop_Add_option";	//	상품옵션
$GnTable["shopbrand"]				 = "Gn_Shop_Brand";		//	브랜드
$GnTable["shoppresent"]				 = "Gn_Shop_Present";		//	사은품
$GnTable["shopafter"]					= "Gn_Shop_After";			//	상품후기
$GnTable["shopinquire"]				 = "Gn_Shop_Inquire";		//	상품문의
$GnTable["shopwish"]				 = "Gn_Shop_Wish";			//	위시리스트
$GnTable["shopinput"]				 = "Gn_Shop_Input";			//	상품추가정보
$GnTable["shopcart"]				 = "Gn_Shop_Cart";			//	장바구니
$GnTable["shoporder"]				 = "Gn_Shop_Order";			//	주문서
$GnTable["shophistory"]				 = "Gn_Shop_History";		//	카드결제 내용
$GnTable["shopdelivery"]			 = "Gn_Shop_Delivery";		//	배송회사
$GnTable["shopreceipt"]				 = "Gn_Shop_Receipt";		//	현금영수증
$GnTable["shoppoint"]				 = "Gn_Shop_Point";			//	적립금
$GnTable["shopsell"]				 = "Gn_Shop_Sell";			//	판매기록
$GnTable["shopcoupon"]				 = "Gn_Shop_Coupon";			//	쿠폰

//제품테이블
$GnTable["proditem"]="Gn_Product_Item";
$GnTable["prodcategory"]="Gn_Product_Category";
$GnTable["prodconfig"]="Gn_Product_Config";

/////// 공용 함수를 설정합니다. ////////////////////////
$now = time();
$date    = date("Y-m-d", $now);
$time    = date("H:i:s", $now);
$datetime = date("Y-m-d H:i:s", $now);
$weekday = array ('일', '월', '화', '수', '목', '금', '토');
$cookie_domain = "";
$charset= "utf-8";

//모바일 감지 분기
$ua = $_SERVER['HTTP_USER_AGENT'];
if( stristr($ua,"Android") || stristr($ua,"iPhone") || stristr($ua,"bada") || stristr($ua,"Mobile") || stristr($ua,"samsung") || stristr($ua,"lgtel") ){
	$this_agent = "mobile";
}else{
	$this_agent = "web";
}
define("THIS_AEGNT", $this_agent);

?>