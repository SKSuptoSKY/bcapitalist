<?
	include "../head.php";

$PG_table = $GnTable["memberlevel"];
$JO_table = $GnTable["member"];

/////// DB에 들어갈 값들을 변환합니다.

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	leb_level		= '$leb_level', 
	leb_name	= '$leb_name',
	leb_dc		= '$leb_dc'
";

if($mode=="E") {
	referer_check();
	//등급 필드의 중복정보 추출
	$sql = " select leb_id from $PG_table where leb_level = '$leb_level' ";
    $ch = sql_fetch($sql);
	
	if($ch[leb_id]!=$leb_id) {
		alert("이미 등록된 등급입니다.");	
	} else {
		//수정할 필드의 정보 추출
		$sql = " select count(*) as cnt from $PG_table where leb_id = '$leb_id' ";
		$ch = sql_fetch($sql);

		if($ch[cnt]==FALSE) {
			alert("등록된 글이 없습니다.");	
		} else {
			$sql = " update $PG_table set $input_value where leb_id = '$leb_id' ";
			sql_query($sql);
		}
	}
} 

if($mode=="D") {
	//등급 필드의 중복정보 추출
	$sql = " select count(*) as cnt from $JO_table where mem_leb = '$id' ";
	$ch = sql_fetch($sql);

	if($id=="0"){
		alert("비회원은 삭제하실 수 없습니다..");
	} else if($ch[cnt]) {
		alert("회원이 등록된 등급은 삭제하실 수 없습니다.");
	} else {
		$sql = " delete from $PG_table where leb_level = '$id' ";
		sql_query($sql);
	}
}

if($mode=="W") {
	referer_check();
	//등급 필드의 중복정보 추출
	$sql = " select count(*) as cnt from $PG_table where leb_level = '$leb_level' ";
    $ch = sql_fetch($sql);
	
	if($ch[cnt]==TRUE) {
		alert("이미 등록된 등급입니다.");	
	} else {
		$sql = " insert $PG_table set $input_value ";
		sql_query($sql);
	}
}

    goto_url("./level_list.php?page=$page&$qstr");
?>