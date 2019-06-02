<?
	include $_SERVER["DOCUMENT_ROOT"]."/head.php";  
	include $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";

//쿠폰정보불러옴
$sql="select * from {$GnTable[shopcoupon]} ";
$row_coupon=sql_fetch($sql);


// 회원인 경우
if ( $Get_Login==TRUE )
{
    $sql_common = " from {$GnTable[shoporder]}
                   where mb_id = '$_SESSION[userid]' ";
}
// 비회원인 경우 주문서번호와 비밀번호가 넘어왔다면
else if ($od_id && $od_pwd)
{
	$od_pwd = md5($od_pwd);
    $sql_common = " from {$GnTable[shoporder]} where od_id = '$od_id' and od_pwd = '$od_pwd' ";
}
// 그렇지 않다면 로그인으로 가기
else
{
    alert ("로그인 회원만 이용하실 수 있습니다.","/shop/login_order.php?URL=/shop/myorder_list.php");
}

$sql = " select COUNT(*) as cnt $sql_common";
$row = sql_fetch($sql);
$cnt = $row[cnt];

////////////////////////////////////////////////////////////////
// 1.04.12
// 비회원 주문확인시 비회원의 모든 주문이 다 출력되는 오류 수정
////////////////////////////////////////////////////////////////
// 조건에 맞는 주문서가 없다면
if ($cnt == 0) {
    // 회원일 경우는 메인으로 이동
    // 비회원일 경우는 이전 페이지로 이동
    if ( $Get_Login==TRUE )
        alert("주문이 존재하지 않습니다.", "/main.php");
    else alert("주문이 존재하지 않습니다.");
}
////////////////////////////////////////////////////////////////
// 1.04.12 END
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// 1.04.15
// 비회원 주문확인의 경우 바로 주문서 상세조회로 이동
if ( $Get_Login==FALSE ) {
    $sql = " select od_id, on_uid
               from {$GnTable[shoporder]}
              where od_id = '$od_id'
                and od_pwd = '$od_pwd' ";
    $row = sql_fetch($sql);
    if ($row[od_id]) {
        goto_url("./myorder_view.php?od_id=$row[od_id]&on_uid=$row[on_uid]");
        exit;
    }
}
////////////////////////////////////////////////////////////////
	$PG_table = $GnTable["shoporder"];
	$JO_table = "";
	$sql_where = "where mb_id  = '$_SESSION[userid]' ";
	$sql_order = " order by od_time desc";

	$sql = " select count(*) as cnt from $PG_table $sql_where $sql_order";
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $default[page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql = " select * from  $PG_table $sql_where $sql_order LIMIT $from_record, $rows";
	$result = sql_query($sql);
	for ($i=0; $row=mysql_fetch_array($result); $i++) {
		$od[$i] = $row;

		if ($od[$i][od_temp_bank] > 0) {
			if ($od[$i][od_receipt_point]) $sell_cost[$i] = $od[$i][od_temp_bank]-$od[$i][od_receipt_point];
			else $sell_cost[$i] = $od[$i][od_temp_bank];
		}
		else if ($od[$i][od_temp_card] > 0) {
			if ($od[$i][od_receipt_point]) $sell_cost[$i] = $od[$i][od_temp_card]-$od[$i][od_receipt_point];
			else $sell_cost[$i] = $od[$i][od_temp_card];
		}

		$sql_cart = " select * from {$GnTable[shopcart]} where on_uid = '$row[on_uid]' ";
		$CT[$i] = sql_fetch($sql_cart);
			if($CT[$i][ct_status]=="주문") $od[$i][state] = "주문완료";
			else if($CT[$i][ct_status]=="준비") $od[$i][state] = "상품준비중";
			else if($CT[$i][ct_status]=="배송") $od[$i][state] = "배송중";
			else if($CT[$i][ct_status]=="완료") $od[$i][state] = "배송완료";
			else if($CT[$i][ct_status]=="취소") $od[$i][state] = "주문취소";
			else if($CT[$i][ct_status]=="반품") $od[$i][state] = "반품";
			else if($CT[$i][ct_status]=="품절") $od[$i][state] = "품절";

		/// 주문서를 기준으로한 주문상태를 불러옵니다.
		if($CT[$i][ct_status]=="주문" && ($row[od_receipt_bank]>0 || $row[od_receipt_card]>0)) $od[$i][state] = "입금완료";

		$sql="select dl_url from {$GnTable[shopdelivery]} where dl_id='{$od[$i][dl_id]}' ";
		$row_dl=sql_fetch($sql);
		$od[$i][dl_url]=$row_dl[dl_url];
	}

	$qstr = "sort1=$sort1&sort2=$sort2&page=";

	$page_loc = "member";

	include $_SERVER["DOCUMENT_ROOT"]."/skin/shop/$GnShop[shop_skin]/myorder_list.skin.php";
	include $_SERVER["DOCUMENT_ROOT"]."/foot.php";  
?>