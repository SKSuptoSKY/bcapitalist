<?
include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";

	$Imember = Get_member($_SESSION["userid"]);

	// 회원정보를 가져올 수 없을때에는
	if($Imember==FALSE) alert("로그인하셔야 이용하실 수 있습니다.", "/member/login.php?url=".$_SERVER[PHP_SELF]);

	// 정상적으로 로그인된후
	$name = $Imember["mem_nick"];
	$point = number_format($Imember["mem_point"]);

	$PG_table = $GnTable["point"];

	$sql_where = "where p_member = '{$Imember[mem_id]}' ";
	$sql_order = " order by p_id desc";

	//// 검색리스트 출력 /////////////////
	if($search) $sql_where .= " and ($search_type like '%$search%' or $search_type like '$search%' or $search_type like '%$search')";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql  = " select * from $PG_table $sql_where $sql_order limit $from_record, $rows ";
	$result = sql_query($sql);

	for ($i=0; $row=mysql_fetch_array($result); $i++) {
		$list[$i] = $row;

		$list[$i]["date"] = substr($list[$i]["p_time"],0,10);
		$list[$i]["memo"] = $list[$i]["p_memo"];
		$list[$i]["cash"] = number_format($list[$i]["p_point"]);
	}

	$pageList = get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");

$page_loc="member";

include $_SERVER["DOCUMENT_ROOT"]."/skin/member/{$G_member[skin_dir]}/member_point.skin.php";
?>