<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

//과정명 출력
$sql = "select lec_subject from Gn_Lecture where lec_no = '$no'";
$lec = sql_fetch($sql);
$lec_subject = stripslashes(str_replace('&amp;','&',htmlspecialchars($lec[lec_subject])));

header("Content-type: application/vnd.ms-excel;charset=UTF-8" ); 
header("Content-Disposition: attachment; filename=$lec_subject(".date("Y년 m월 d일").").xls ;" ); 
header("Content-Description: PHP5 Generated Data" );
ini_set('memory_limit', -1); 

$PG_table = "Gn_Lecture_History";
$sql_search = " where status != '취소' and order_lec = '$no'";
if($sfl != "") $sql_search .= "and $sfl like '%$stx%' ";
$sql_order = "order by order_date desc";
$sql  = " select * from $PG_table $sql_search $sql_order";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
}
$list_total = count($list);
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$charset?>">
<style>
.list {border-top:2px solid #1c1815; border-bottom:1px solid #1c1815;}

/*****************************************************************************레이아웃 시작***************************************************************************************/
#all { position:relative; width:100%; margin:0 auto 0; height:768px;}
#head { position:relative; clear:both; width:100%; z-index:2; *zoom:1; background:url(/images/main/top_line.jpg) repeat-x; }
#head:after { content:""; display:block; clear:both; height:0; }
#sub_head { position:relative; clear:both; width:100%; z-index:2; *zoom:1; background:url(/images/sub1/sub_line.jpg) repeat-x; }
#sub_head:after { content:""; display:block; clear:both; height:0; }
#container{ position:relative;}
#header{ position:relative; clear:both; *zoom:1;}
#header:after{ content:""; display:block; clear:both;}
#body{ position:relative; clear:both; *zoom:1;}
#body:after{ content:""; display:block; clear:both;}
#content{ position:relative; text-align:justify; *zoom:1;}
#content:after{ content:""; display:block; clear:both;}
#foot{ position:relative; clear:both; *zoom:1; top:10px;  border-top:1px solid #dbdada;}
#foot:after{ content:""; display:block; clear:both;}
#footer address{ text-align:center;}
</style>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="1" cellpadding="3" cellspacing="1">
				<tr align="center" bgcolor="#F6F6F6">
					<td width="80">번호</td>
					<td>과정명</td>
					<td>성명</td>
					<td>회사/기관명</td>
					<td>직책</td>
					<td>이메일</td>
					<td>남기실 말씀</td>
					<td>결제상태</td>
					<td>신청일</td>
				</tr>
				<?for ($i=0; $i<$list_total; $i++) {?>
					<tr>
						<td style='mso-number-format:"\@";' ><?=$i+1?></td>
						<td style='mso-number-format:"\@";' ><?=$lec_subject?></td>
						<td style='mso-number-format:"\@";' ><?=$list[$i][order_name]?></td>
						<td style='mso-number-format:"\@";' ><?=$list[$i][order_company]?></td>
						<td style='mso-number-format:"\@";' ><?=$list[$i][order_position]?></td>
						<td style='mso-number-format:"\@";' ><?=$list[$i][order_email]?></td>
						<td style='mso-number-format:"\@";' ><?=stripslashes(nl2br($list[$i][order_coment]))?></td>
						<td style='mso-number-format:"\@";' ><?=$list[$i][status]?></td>
						<td style='mso-number-format:"\@";' ><?=date("Y/m/d H시i분s초",strtotime($list[$i][order_date]));?></td>
					</tr>
				<?}?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>