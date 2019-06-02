<?
header("Content-type: application/vnd.ms-excel;charset=utf-8" ); 
header("Content-Disposition: attachment; filename=member(".date("Y-m-d").").xls ;" ); 
header("Content-Description: PHP5 Generated Data" );
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];
$sql_search = " where mem_leb > 0 ";

	if($findword != "") $sql_search .= "and $findType like '%$findword%' ";
if ($registS && $registE) {
	if ($registS==$registE) $sql_search.=" and a.last_modify =  '".$registS."' ";
	else $sql_search.=" and a.last_modify >= '".$registS."' and a.last_modify <= '".$registE."'";
}
else {
	if ($registS) $sql_search.=" and a.last_modify >='".$registS."' ";
	else if ($registE) $sql_search.=" and a.last_modify <= '".$registE."' ";
}

$sql = " select count(*) as cnt from $PG_table a $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];
$sort1  = "a.last_modify";
$sort2 = "desc";
$sql_order = "order by $sort1 $sort2";
$sql  = " select a.*, b.leb_name from $PG_table a left join $JO_table b on (a.mem_leb = b.leb_level)
		   $sql_search
           $sql_order";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	if($list[$i][mem_sex]=="m") { $list[$i][mem_sex] = "남"; } else { $list[$i][mem_sex] = "여"; }
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
					<td>아이디</td>
					<td>이름</td>
					<td>닉네임</td>
					<td>생년월일</td>
					<td>우편번호</td>
					<td>주소</td>
					<td>나머지주소</td>
					<td>전화번호</td>
					<td>핸드폰</td>
					<td>이메일</td>
					<td>관리자 메모</td>
					<td>가입일</td>
					<td>정보메일</td>
					<td>SMS</td>
				</tr>
			<? for ($i=0; $i<$list_total; $i++) { ?>
				<tr>
					<td align="center"><?=$i+1?></td>
					<td align="center"><?=$list[$i][mem_id]?></td>
					<td align="center"><?=$list[$i][mem_name]?></td>
					<td align="center"><?=$list[$i][mem_nick]?></td>
					<td align="center"><?=$list[$i][mem_birth]?></td>
					<td align="left"><?=$list[$i][mem_post]?></td>
					<td align="left"><?=stripslashes($list[$i][mem_add1])?></td>
					<td align="left"><?=stripslashes($list[$i][mem_add2])?></td>
					<td align="center"><?=$list[$i][mem_tel]?></td>
					<td align="center"><?=$list[$i][mem_phone]?></td>
					<td align="center"><?=$list[$i][mem_email]?></td>

					<td align="left"><?=stripslashes(nl2br($list[$i][mem_content]))?></td>
					<td align="center"><?=substr($list[$i][first_regist],0,10)?></td>

					<td align="center">
					<?if($list[$i][mem_remail] == "y"){?>
					수신
					<?}else{?>
					미수신
					<?}?>
					</td>
					<td align="center">
					<?if($list[$i][mem_sms] == "y"){?>
					수신
					<?}else{?>
					미수신
					<?}?>
					</td>
				</tr>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>

