<?
	include "../head.php";

$PG_table = $GnTable["member"];
$JO_table = $GnTable["memberlevel"];

/////// DB에 들어갈 값들을 변환합니다.
	$mem_content = addslashes($mem_content);
	for ($i=1; $i<=5; $i++) {
		$exvalue = "exe_".$i;
		$exe[$i] = addslashes($$exvalue);
	}

	// 비밀번호 값이 있을때만 비번을 변경한다.
	if($newpass==TRUE) {
		$newpass = sql_password($newpass);
		$PlusInput = ", mem_pass = '$newpass'";
	} else {
		$PlusInput = "";
	}
	$mem_birth = $mem_birth_y."-".$mem_birth_m."-".$mem_birth_d;

/////// DB에 들어갈 값들을 정리합니다.
$input_value = "
	mem_leb				=  '$mem_leb',
	mem_nick				=  '$mem_nick',
	mem_post				=  '$mem_post',
	mem_add1				=  '$mem_add1',
	mem_add2				=  '$mem_add2',
	mem_tel				=  '$mem_tel',
	mem_phone			=  '$mem_phone',
	mem_fax				=  '$mem_fax',
	mem_email				=  '$mem_email',
	mem_home			=  '$mem_home',
	mem_birth				=  '$mem_birth',
	mem_btype			=  '$mem_btype',
	mem_sex				=  '$mem_sex',
	mem_remail			=  '$mem_remail',
	mem_sms				=  '$mem_sms',
	mem_content			=  '$mem_content',
	com_num				=  '$com_num',
	com_ceo				=  '$com_ceo',
	com_charge			=  '$com_charge',
	com_cphone			=  '$com_cphone',
	com_post				=  '$com_post',
	com_add1				=  '$com_add1',
	com_add2				=  '$com_add2',
	exe_1				=  '{$exe[1]}',
	exe_2				=  '{$exe[2]}',
	exe_3				=  '{$exe[3]}',
	exe_4				=  '{$exe[4]}',
	exe_5				=  '{$exe[5]}',
	mem_chu				=  '$mem_chu'
	$PlusInput
";

//////////////////////////////////////////////////////////////
/////////////// 회원 이미지 파일 여기부터 /////////////////
	if($photo_del=="1") {
		// 이미지 삭제
		@unlink("$G_member[data_dir]/$id");
		@unlink("$G_member[data_dir]/$id");
	}

	/////// 올라온 파일을 이름을 바꿔올립니다.
	if ($_FILES[photo][name])
	{
		upload_file($_FILES[photo][tmp_name], $id, $G_member[data_dir]);
	}
/////////////// 회원 이미지 파일 여기까지 /////////////////
//////////////////////////////////////////////////////////////

	// 회원정보를 불러옵니다.
	$sql = " select * from $PG_table where mem_id = '$id' ";
	$chm = sql_fetch($sql);

if($mode=="E") {
referer_check();
	$sql = " update $PG_table set $input_value where mem_id = '$id' ";
	sql_query($sql);
} 

if($mode=="D") {
	if($chm[mem_leb]=="100") {
		alert("관리자 등급의 회원은 삭제할 수 없습니다. 등급설정 후 삭제 해주세요");
	}

	$sql = " delete from $PG_table where mem_id = '$id' ";
	sql_query($sql);
}

if($mode=="X") {
	if($chm[mem_leb]=="100") {
		alert("관리자 등급의 회원은 탈퇴할 수 없습니다");
	}

	$input_value = "
		mem_leb				=  '0',
		mem_pass				=  '',
		mem_name			=  '탈퇴회원',
		mem_sch				=  '',
		mem_nick				=  '탈퇴회원',
		mem_post				=  '',
		mem_add1				=  '',
		mem_add2				=  '',
		mem_tel				=  '',
		mem_phone			=  '',
		mem_fax				=  '',
		mem_email				=  '',
		mem_home			=  '',
		mem_birth				=  '',
		mem_btype			=  '',
		mem_remail			=  '',
		mem_sms				=  '',
		mem_content			=  '',
		com_num				=  '',
		com_ceo				=  '',
		com_charge			=  '',
		com_cphone			=  '',
		com_post				=  '',
		com_add1				=  '',
		com_add2				=  '',
		exe_1				=  '',
		exe_2				=  '',
		exe_3				=  '',
		exe_4				=  '',
		exe_5				=  '',
		last_modify			=  '$datetime'
	";

	$sql = " update $PG_table set $input_value where mem_id = '$id' ";
	sql_query($sql);
}

if($mode=="W") {
referer_check();
	$sql = " insert $PG_table set mem_id = '$id', mem_sch = '$mem_sch', mem_name = '$mem_name', $input_value, mem_check = '$datetime', first_regist = '$datetime', join_ip = '$_SERVER[REMOTE_ADDR]' , site = '{$default[site_code]}'";
	sql_query($sql);
}

    goto_url("./member_list.php?page=$page&$qstr");
?>