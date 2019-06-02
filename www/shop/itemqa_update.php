<? 
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

if (!$_SESSION[userid] || $_SESSION[userid]=="GUEST") alert("회원만 가능합니다.");
if (!$iq_subject || !$iq_question) alert("질문 제목과 내용을 입력하십시오.");

$sql = " select max(iq_id) from {$GnTable[shopinquire]} ";
$row = sql_fetch($sql);
$max_iq_id = $row[0];

$sql = " select max(iq_id) from {$GnTable[shopinquire]}
          where it_id = '$it_id'
            and mb_id = '$_SESSION[userid]' ";
$row = sql_fetch($sql);
if ($row[0] && $row[0] == $max_iq_id) alert("계속해서 질문하실 수 없습니다.");

$iq_subject = addslashes($iq_subject);
$iq_content = addslashes($iq_content);

$sql = "insert {$GnTable[shopinquire]}
           set it_id = '$it_id',
               mb_id = '$_SESSION[userid]',
               iq_subject  = '$iq_subject',
               iq_question = '$iq_question',
               iq_time = '$datetime',
               iq_ip = '$REMOTE_ADDR' ";
sql_query($sql);

goto_url($HTTP_REFERER);
?>
