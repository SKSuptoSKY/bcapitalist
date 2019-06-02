<?
set_time_limit(0);

include_once ("../admin/lib/config.php");
include_once ("../admin/lib/function.php");

// site_code 추가
$realdir = dirname(__FILE__);			//실제 경로
$thisdir = explode("/",$realdir);	//현재 폴더명

//현재 사이트의 이름
for($siteArr=0;$siteArr<count($thisdir);$siteArr++) {
	if($thisdir[$siteArr] == "html" || $thisdir[$siteArr] == "www") $SiteDir=$thisdir[$siteArr-1];
}
$default["site_code"] = $SiteDir;


$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

$mysql_host  = $_POST[mysql_host];
$mysql_user  = $_POST[mysql_user];
$mysql_pass  = $_POST[mysql_pass];
$mysql_db    = $_POST[mysql_db];
$admin_id    = $_POST[admin_id];
$admin_pass  = $_POST[admin_pass];
$admin_name  = $_POST[admin_name];
$admin_email = $_POST[admin_email];

$dblink = @mysql_connect($mysql_host, $mysql_user, $mysql_pass);
if (!$dblink) {
    echo "<meta http-equiv='content-type' content='text/html; charset=$charset'>";
    echo "<script language='JavaScript'>alert('MySQL Host, User, Password 를 확인해 주십시오.');history.back();</script>";
    exit;
}

$select_db = @mysql_select_db($mysql_db, $dblink);
if (!$select_db) {
    echo "<meta http-equiv='content-type' content='text/html; charset=$charset'>";
    echo "<script language='JavaScript'>alert('MySQL DB 를 확인해 주십시오.');history.back();</script>";
    exit;
}
@mysql_query("set names utf8");        //        추가

$select_table = sql_db_check($GnTable["config"]);
if ($select_table) {
    echo "<meta http-equiv='content-type' content='text/html; charset=$charset'>";
    echo "<script language='JavaScript'>alert('이미 게시판이 설치되어 있습니다.');history.back();</script>";
    exit;
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<title>게시판 설치중입니다.</title>
<style type="text/css">
<!--
.body {
	font-size: 12px;
}
.box {
	background-color: #FCFCFC;
    color:#18307B;
	font-size: 12px;
}
.nobox {
	background-color: #FCFCFC;
    border-style:none;
    font-size: 12px;
}
-->
</style>
</head>

<body background="img/all_bg.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="587" border="0" cellspacing="0" cellpadding="0">
    <form name=frminstall2>
    <tr>
                <td colspan="3"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="587" height="22">
                        <param name="movie" value="img/top.swf">
                        <param name="quality" value="high">
                        <embed src="img/top.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="587" height="22"></embed></object></td>
    </tr>
    <tr>
      <td width="3"><img src="img/box_left.gif" width="3" height="340"></td>
      <td width="581" valign="top" bgcolor="#FCFCFC"><table width="581" border="0" cellspacing="0" cellpadding="0">
          <!-- <tr>
            <td><img src="img/box_title.gif" width="581" height="56"></td>
          </tr> -->
        </table>
        <br>
        <table width="541" border="0" align="center" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td>설치를 시작합니다. <font color="#CC0000">설치중 작업을 중단하지 마십시오. </font></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="status_bar" type="text" class="box" size="76" readonly></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="350" border="0" align="center" cellpadding="5" cellspacing="0" class="body">
                <tr>
                  <td width="50"> </td>
                  <td width="300"><input type=text name=job1 class=nobox size=80 readonly></td>
                </tr>
                <tr>
                  <td width="50"> </td>
                  <td width="300"><input type=text name=job2 class=nobox size=80 readonly></td>
                </tr>
                <tr>
                  <td width="50"> </td>
                  <td width="300"><input type=text name=job3 class=nobox size=80 readonly></td>
                </tr>
                <tr>
                  <td width="50">
                    <div align="center"></div></td>
                  <td width="300"><input type=text name=job4 class=nobox size=80 readonly></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type=text name=job5 class=nobox size=90 readonly></td>
          </tr>
        </table>
        <table width="562" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height=20><img src="img/box_line.gif" width="562" height="2"></td>
          </tr>
        </table>
        <table width="551" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right">
              <input type="button" name="btn_next" disabled value="메인화면" onclick="location.href='../admin/';">
            </td>
          </tr>
        </table></td>
      <td width="3"><img src="img/box_right.gif" width="3" height="340"></td>
    </tr>
    <tr>
      <td colspan="3"><img src="img/box_bottom.gif" width="587" height="3"></td>
    </tr>
    </form>
  </table>
</div>
<?
flush(); usleep(50000);

// 테이블 생성 ------------------------------------
$file = implode("", file("./sql_install.sql"));
eval("\$file = \"$file\";");

$f = explode(";", $file);
for ($i=0; $i<count($f); $i++) {
    if (trim($f[$i]) == "") continue;
    mysql_query($f[$i]) or die(mysql_error());
}
// 테이블 생성 ------------------------------------

echo "<script>document.frminstall2.job1.value='전체 테이블 생성중';</script>";
flush(); usleep(50000);

for ($i=0; $i<43; $i++)
{
    echo "<script language='JavaScript'>document.frminstall2.status_bar.value += '■';</script>\n";
    flush();
    usleep(500);
}

echo "<script>document.frminstall2.job1.value='전체 테이블 생성 완료';</script>";
flush(); usleep(50000);

$site_url = "http://".$_SERVER["SERVER_NAME"];

/////// 환경설정 테이블 설정
$sql = "INSERT INTO {$GnTable[config]} set title='홈페이지', site_name = 'Gn글로벌', site_url = '$site_url', page_list = '10', page_rows = '10', member_skin = 'basic', use_point='0', login_point='0', memo_del='7', visit_time='9', version='0.20', vuptime='$now', site='{$default[site_code]}' ";
@mysql_query($sql);

/////// 운영자 회원가입
$admin_pass = sql_password("123456");
$mem_sch = sql_password("");

$sql = " insert into {$GnTable[member]}
            set mem_id = 'admin',
                mem_pass = '$admin_pass',
                mem_name = '관리자',
                mem_nick = '관리자',
                mem_sch = '$mem_sch',
                mem_leb = '100',
                mem_remail = 'y',
                mem_sms = 'y',
                mem_check = '$datetime',
                first_regist = '$datetime',
                join_ip = '$_SERVER[REMOTE_ADDR]',
				site='{$default[site_code]}'
                ";
@mysql_query($sql);

/////// 회원레벨 기본설정
$sql = "INSERT INTO {$GnTable[memberlevel]} (`leb_id`, `leb_level`, `leb_name`, `leb_dc`) VALUES (1, 100, '관리자', 0),(2, 20, '정회원', 0),(3, 10, '준회원', 0),(4, 0, '손님', 0);";
@mysql_query($sql);

////// 사이트 메뉴 설정
$sql = "INSERT INTO `Gn_Menu` SET
			mn_no = '1', 
			mn_banner_use = '0', 
			mn_banner_memo = '', 
			mn_popup_use = '0', 
			mn_popup_memo = '', 
			mn_shop_use = '0', 
			mn_shopmodule_use = '0', 
			mn_shop_memo = '', 
			mn_product_use = '0', 
			mn_product_memo = '', 
			mn_shop_review_memo = '', 
			mn_shop_review_use = '0', 
			mn_shop_qna_memo = '', 
			mn_shop_qna_use = '0', 
			mn_shop_option_use = '0', 
			mn_shop_related_use = '0', 
			mn_group_mail_use = '0',
			mn_counter_memo = '', 
			mn_counter_use = '0'
			mn_statistics_memo = '',
			mn_statistics_use = '0',
			point_use = '0',
			use_type = '0',
			trans_pay = '1',
			mn_sms_memo = '',
			mn_sms_use = '0',
			duplicate_login = '0'
		";
@mysql_query($sql);

////// 제품 메뉴 설정
// site필드가 비어있어 최초 관리자에서 업데이트시 인서트 되버리는 문제 주석
//$sql="INSERT INTO `Gn_Product_Config` (`shop_name`, `shop_skin`, `shop_inc_head`, `shop_inc_foot`, `mimg_width`, `mimg_height`, `simg_width`, `simg_height`, `shop_url`, `admin_email`, `use_bank`, `use_real`, `use_card`, `use_phon`, `bankinfo`, `point_chk`, `point_use`, `use_bill`, `use_vat`, `cardsys_mid`, `explan_trans`, `explan_chan`, `explan_other`, `trans_all`, `trans_grub`, `trans_gpay`, `trans_pay`, `present_pay`, `present_item`, `main_cont`, `site`) VALUES ('', '', '', '', 400, 300, 100, 75, '', '', 0, 0, 0, 0, '', 0, 0, '', '', '', '', '', '', 0, '', '', 0, '', '', '', '')";

$sql=" INSERT INTO `Gn_Product_Config` SET
			shop_name			= '',
			shop_skin			= '',
			shop_inc_head		= '',
			shop_inc_foot		= '',
			mimg_width			= '400',
			mimg_height			= '300',
			simg_width			= '100',
			simg_height			= '75',
			shop_url				= '',
			admin_email			= '',
			use_bank				= '0',
			use_real				= '0',
			use_card				= '0',
			use_phon				= '0',
			bankinfo				= '',
			point_chk				= '0',
			point_use				= '0',
			use_bill				= '',
			use_vat				= '',
			cardsys_mid			= '',
			explan_trans			= '',
			explan_chan			= '',
			explan_other			= '',
			trans_all				= '0',
			trans_grub			= '',
			trans_gpay			= '',
			trans_pay				= '0',
			present_pay			= '',
			present_item			= '',
			main_cont			= '',
			site					= '{$default[site_code]}' 
		";
@mysql_query($sql);

////// 쇼핑몰 환경설정
$sql="INSERT INTO `Gn_Shop_Config` SET 
			shop_name			= '',
			shop_skin			= 'basic',
			shop_inc_head		= '',
			shop_inc_foot		= '',
			mimg_width			= '400',
			mimg_height			= '300',
			simg_width			= '140',
			simg_height			= '140',
			shop_url				= '',
			shop_tel				= '070-1234-5678',
			admin_email			= '',
			use_bank				= '1',
			use_card				= '0',
			use_trans				= '0',
			use_virtual			= '0',
			use_phon				= '0',
			use_type1				= '0',
			use_type2				= '0',
			use_type3				= '0',
			use_type4				= '0',
			use_type5				= '0',
			sms_text1				= '1',
			sms_text2				= '2',
			sms_text3				= '3',
			sms_text4				= '4',
			sms_text5				= '5',
			sms_text6				= '6',
			sms_text7				= '7',
			bankinfo				= '국민은행 12345-12345 홍길동',
			point_chk				= '0',
			point_use				= '5',
			point_min_use		= '0',
			point_max_use		= '10',
			use_bill				= '',
			use_vat				= '',
			cardsys_mid			= '',
			explan_trans			= '',
			explan_chan			= '',
			explan_other			= '',
			trans_all				= '50000',
			trans_grub			= '',
			trans_gpay			= '',
			trans_pay				= '3000',
			present_pay			= '',
			present_item			= '',
			main_cont			= '',
			pg_status				= 'test',
			pg_module			= '',
			LG_pg_id				= '',
			LG_pg_key			= '',
			LG_pg_casurl			= '',
			INI_pg_id				= '',
			KCP_pg_id			= '',
			site					= '{$default[site_code]}'
		";

/*
$sql="INSERT INTO `Gn_Shop_Config` (`shop_name`, `shop_skin`, `shop_inc_head`, `shop_inc_foot`, `mimg_width`, `mimg_height`, `simg_width`, `simg_height`, `shop_url`, `admin_email`, `use_bank`, `use_card`, `use_trans`, `use_virtual`, `use_phon`, `use_type1`, `use_type2`, `use_type3`, `use_type4`, `use_type5`, `sms_text1`, `sms_text2`, `sms_text3`, `sms_text4`, `sms_text5`, `sms_text6`, `sms_text7`, `bankinfo`, `point_chk`, `point_use`, `point_max_use`, `use_bill`, `use_vat`, `cardsys_mid`, `explan_trans`, `explan_chan`, `explan_other`, `trans_all`, `trans_grub`, `trans_gpay`, `trans_pay`, `present_pay`, `present_item`, `main_cont`, `site`) VALUES ('', 'basic', '', '', 400, 300, 140, 140, '', '', 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, '1', '2', '3', '4', '5', '6', '7', '국민은행/12345-12345', 1, 5, 0, 10, '', '', '', '', '', '', 0, '', '', 0, '', '', '', '')";
*/
@mysql_query($sql);


$sql="INSERT INTO `Gn_Board_Config` (`code`, `boardgroup`, `dbname`, `title`, `skin`, `width`, `page_rows`, `page_block`, `listcount`, `listsubject`, `imgsize`, `sum_width`, `sum_height`, `sum_resize`, `sum_flag`, `fileupnum`, `fileupsize`, `page_loc`, `head`, `headtag`, `foot`, `foottag`, `category`, `copymove`, `use_view`, `use_spam`, `use_comment`, `use_category`, `use_category_top`, `use_secret`, `use_asecret`, `use_html`, `use_notice`, `use_data`, `use_reply`, `use_best`, `use_combest`, `use_kakotalk`, `use_kakostory`, `use_facebook`, `use_twitter`, `view_list`, `view_sort`, `level_list`, `level_write`, `level_reple`, `level_view`, `level_com`, `level_html`, `level_notice`, `point_write`, `point_replay`, `point_comment`, `point_chu`, `boardsort`, `view`, `regist`, `site`) VALUES 
(1, '', 'notice', '공지사항', 'basic_white', 100, 10, 10, 4, 0, 700, 150, 150, 1, 0, 1, 60000000, '', '../head.php', '', '../foot.php', '', '', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 10, 0, 10, 100, 100, 0, 0, 0, 0, 0, 1, 0, ''),
(2, '', 'shop_review', '상품후기', 'basic_white', 100, 10, 10, 4, 60, 700, 150, 150, 1, 0, 1, 60000000, '', '../head.php', '', '../foot.php', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 100, 100, 100, 0, 0, 0, 0, 0, 1, 0, ''),
(3, '', 'shop_qna', '상품Q&A', 'basic_white', 100, 10, 10, 4, 60, 700, 150, 150, 1, 0, 1, 60000000, '', '../head.php', '', '../foot.php', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 100, 0, 0, 0, 0, 0, 1, 0, '')";
@mysql_query($sql);


// 배송사 등록
$sql="INSERT INTO `Gn_Shop_Delivery` (`dl_id`, `dl_company`, `de_code`, `dl_url`, `dl_tel`, `dl_order`) VALUES 
(1, '우체국택배', 'PO', 'http://parcel.epost.go.kr', '1588-1300', 1),
(2, 'CJ 대한통운', 'KE', 'http://www.doortodoor.co.kr', '1588-1255', 3),
(3, '현대택배', 'HD', 'http://www.hlc.co.kr', '02-2170-3355', 5),
(4, '옐로우캡', 'YC', 'http://www.kgyellowcap.co.kr', '1588-0123', 2),
(5, '로젠택배', 'LG', 'http://www.ilogen.com/d2d/index.jsp', '1588-9988', 4),
(6, '한진택배', 'HJ', 'http://hanex.hanjin.co.kr/', '1588-0011', 6),
(7, 'KGB택배', 'KB', 'http://www.kgbls.co.kr/', '1577-4577', 7)";
@mysql_query($sql);

echo "<script>document.frminstall2.job2.value='DB설정 완료';</script>";
flush(); usleep(50000);
//-------------------------------------------------------------------------------------------------

// DB 설정 파일 생성
$file = "../admin/lib/dbconfig.php";
$f = @fopen($file, "w");

@fwrite($f, "<?\n");
@fwrite($f, "\$mysql_host = \"$mysql_host\";\n");
@fwrite($f, "\$mysql_user = \"$mysql_user\";\n");
@fwrite($f, "\$mysql_password = \"$mysql_pass\";\n");
@fwrite($f, "\$mysql_db = \"$mysql_db\";\n");
@fwrite($f, "?>");

@fclose($f);
@chmod($file, 0606);
echo "<script>document.frminstall2.job3.value='DB설정 파일 생성 완료';</script>";

flush(); usleep(50000);


// 1.00.09 - data/log 삽입
// 디렉토리 생성
$dir_arr = array (
                  "../bbs/data",
                  "../member/data"
				  );
for ($i=0; $i<count($dir_arr); $i++)
{
    @mkdir($dir_arr[$i], 0707);
    @chmod($dir_arr[$i], 0707);

    // 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
    $file = $dir_arr[$i] . "/index.php";
    $f = @fopen($file, "w");
    @fwrite($f, "");
    @fclose($f);
    @chmod($file, 0606);
}

@rename("../install", "../install.bak");
//-------------------------------------------------------------------------------------------------

echo "<script language='JavaScript'>document.frminstall2.status_bar.value += '■';</script>\n";
flush();
sleep(1);

echo "<script>document.frminstall2.job4.value='필요한 Table, File, 디렉토리 생성을 모두 완료 하였습니다.';</script>";
echo "<script>document.frminstall2.job5.value='* 메인화면에서 운영자 로그인을 한 후 운영자 화면으로 이동하여 환경설정을 변경해 주십시오.';</script>";
flush(); usleep(50000);
?>

<script>document.frminstall2.btn_next.disabled = false;</script>
<script>document.frminstall2.btn_next.focus();</script>

</body>
</html>