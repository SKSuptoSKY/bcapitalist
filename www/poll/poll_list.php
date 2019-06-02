<?
include $_SERVER["DOCUMENT_ROOT"]."/head.php";

if($_SESSION["userlevel"]<10){
	alert("권한이 없습니다.", "/member/login.php?URL=/poll/poll_list.php");
}

$PG_table = $GnTable["poll"];
$JO_table = $GnTable["pollquestion"];
$SO_table = $GnTable["pollscore"];
$sql_search = " where 1 ";
if($findword != "") $sql_search .= "and $findType like '%$findword%' ";
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
if (!$sort1) 
{
    $sort1  = "poll_num";
    $sort2 = "desc";
}

$cur_num=$total_count - ($rows*($page-1));

$sql_order = "order by $sort1 $sort2";

// 출력할 레코드를 얻음
$sql  = " select * from $PG_table
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	$list[$i]["no"] = $cur_num - $i;
	if($date >= $list[$i]["poll_sdate"] and $date <= $list[$i]["poll_edate"]){
		$list[$i]["research_joy"] = "<a href='./poll_request.php?poll_num={$list[$i][poll_num]}'><img src='/images/sub/research_joy.jpg' alt='' /></a>";
	}else{
		$list[$i]["research_joy"] = "<img src='/images/sub/research_comple.jpg' alt='' />";
	}

	if($list[$i]["poll_state"]){
		$list[$i]["research_bi"] = "<a href='./poll_view.php?poll_num={$list[$i][poll_num]}'><img src='/images/sub/research_look.jpg' alt='' /></a>";
	}else{
		$list[$i]["research_bi"] = "<img src='/images/sub/research_bi.jpg' alt='' />";
	}

	$count_sql = " select count(*) as cnt from $PG_table";
	$count_row = sql_fetch($count_sql,FALSE);
	$list[$i][total] = $count_row[cnt];
}
$list_total = count($list);
$qstr = "findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<style>
.list_tbl{width:770px; border-top:2px #ccc solid;}
.list_tbl th{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc; padding:5px; font-size:13px;  font-weight:bold; color:#333; text-align:center;background-color:#f5f5f5;}
.list_tbl td{border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;  color:#666; font-size: 13px; padding:5px; text-align:center;}
.form_input  {border: 1px solid #d6d9de; width:50%; height:24px; color:#676767; font-size:13px;}
.form_input1  {border: 1px solid #d6d9de; width:90%; height:24px; color:#676767; font-size:13px;}
.form_input2  {border: 1px solid #d6d9de; width:80px; height:24px; color:#676767; font-size:13px;}
.form_input3  {border: 1px solid #d6d9de; width:25%; height:24px; color:#676767; font-size:13px;}
.form_input4  {border: 1px solid #d6d9de; width:30%; height:24px; color:#676767; font-size:13px;}
.form_input5  {border: 1px solid #d6d9de; width:210px; height:24px; color:#676767; font-size:13px;}
.form_input6 {border: 1px solid #d6d9de; width:40%; height:24px; color:#676767; font-size:13px;}
.list_tbl .talign_left{text-align:left;}
.question{padding:10px; border-bottom:1px solid #ccc;}
.question ul {border-top:2px solid #b38d51;}
.question li{padding:4px 10px; background-color:#f5f5f5; line-height:18px;font-size:12px;}
.head_view{font-size:14px; font-weight:bold; color:#555;}
.research_percent{border-top:2px solid #b38d51; }
.graph_wrap{position:relative; width:100%; overflow:hidden;}
.graph_content{float:left; height:22px;}
.graph_txt{float:left;  height:22px;padding-left:10px;}
.red{color:#f83f3f; font-weight:bold;}
.t_2{font-size:18px; font-weight:bold; color:#333; line-height:28px;background:url(/images/sub/dot01.jpg) no-repeat 0 8px; padding-left:18px;}
</style>
<!-- list -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="list_tbl">
<colgroup>
<col width="5%" />
<col width="35%" />
<col width="25%" />
<col width="8%" />
<col width="8%" />
</colgroup>
<tr>
	<th>No.</th>
	<th>제목</th>
	<th>설문조사 기간</th>
	<th>상태</th>
	<th>결과보기</th>
</tr>
<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr>
		<td><?=$list[$i]["no"]?></td>
		<td class="talign_left"><a href='./poll_request.php?poll_num=<?=$list[$i][poll_num]?>'><?=$list[$i][poll_subject]?></a></td>
		<td><?=str_replace("-",".",cut_str($list[$i][poll_sdate],10,''))?> ~ <?=str_replace("-",".",cut_str($list[$i][poll_edate],10,''))?></td>
		<td><?=$list[$i]["research_joy"]?></td>
		<td><?=$list[$i]["research_bi"]?></td>
	</tr>
<? } ?>
<?if($i==0){?>
	<tr>
		<td colspan="5" height="150">등록된 설문조사가 없습니다</td>
	</tr>
<?}?>
</table>

<table width="100%">
	<tr>
		<td width="100%" align="center"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
	</tr>
</table>

<?
include $_SERVER["DOCUMENT_ROOT"]."/foot.php";
?>
