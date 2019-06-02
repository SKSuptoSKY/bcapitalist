<?
/************************************************************************************************************
/ AGSCash_result.php 에서 넘겨받을 데이터
/************************************************************************************************************/


$Retailer_id = trim($_POST["Retailer_id"]);		//상점아이디

$Ord_No = trim($_POST["Ord_No"]);				//주문번호

$Amtcash = trim($_POST["Amtcash"]);				//거래금액

$deal_won = trim($_POST["deal_won"]);			//공급가액

$Dealno = trim( $_POST["Dealno"] );			    //거래고유번호

$Cust_no = trim($_POST["Cust_no"]);				//회원아이디

$Cat_id = trim($_POST["Cat_id"]);				//단말기번호

$Resp_msg = trim($_POST["Resp_msg"]);			//응답메시지

$Alert_msg1 = trim($_POST["Alert_msg1"]);		//알림메세지1

$Alert_msg2 = trim($_POST["Alert_msg2"]);		//알림메세지2

$Adm_no = trim($_POST["Adm_no"]);				//승인번호

$Amttex = trim($_POST["Amttex"]);				//부가가치세

$Amtadd = trim($_POST["Amtadd"]);				//봉사료

$prod_nm = trim($_POST["prod_nm"]);				//상품명

$prod_set = trim($_POST["prod_set"]);			//상품갯수

$deal_won = trim($_POST["deal_won"]);	        //거래금액

$Gubun_cd = trim($_POST["Gubun_cd"]);			//거래자구분    01.소득공제용 02.지출증빙용

$Confirm_no = trim($_POST["Confirm_no"]);		//신분확인번호

$Pay_kind = trim($_POST["Pay_kind"]);			//결제종류

$Success = trim($_POST["Success"]);				//성공여부 y,n 으로 표시

$Pay_type = trim($_POST["Pay_type"]);	        //결제방식 1.무통장임금 2.계좌이체

$Org_adm_no = trim($_POST["Org_adm_no"]);	    //취소시 승인번호


/*************************************************************************************
/ 상품의 상세정보(상품명, 상품갯수, 주문자명등)은 상점에서 처리를 해야함
/*************************************************************************************/
$page_loc = "member";

if($GnShop[shop_inc_head]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_head]";
include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_cashreceipt.skin.php";
if($GnShop[shop_inc_foot]) include $_SERVER["DOCUMENT_ROOT"]."/$GnShop[shop_inc_foot]";
?>