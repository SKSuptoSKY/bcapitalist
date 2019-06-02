<?
$page_loc = "site";
include "../head.php";
include "./lib/lib.php";

$sql_search = " where 1 and type='$type' ";
/// 검색값이 넘어왔을 경우 검색 코드를 적용합니다.
if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];

$rows = $default[page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "bn_sort";
	if($type==2) $sort2 = "DESC";
	else $sort2 = "ASC";
}
$sql_order = "order by $sort1 $sort2";

// 출력할 레코드를 얻음
$sql  = " select * from $PG_table
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);


//배너이미지용 변수
$a=1;
for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	$this_type = $list[$i]['type'];		
	$img_src=$_SERVER["DOCUMENT_ROOT"].$upload_url."/".$list[$i][bn_rname];
	$no_img_src="<img src='/skin/bbs/gallery_basic/images/no_img.jpg' width='{$b_admin_width[$this_type]}' height='{$bn_height[$this_type]}'>";
	if (file_exists($img_src)) {
	
		$size = getimagesize($img_src);		
		
		// 가로 고정 리사이징
		
		$list[$i][bn_img]="<img src='{$upload_url}/{$list[$i][bn_rname]}' width='{$b_admin_width[$this_type]}'>";
	}
	else {
		$list[$i][bn_img]=$no_img_src;
	}

	$a++;
}

$list_total = count($list);

$qstr = "findType=$findType&findword=$findword&type=$type&sort1=$sort1&sort2=$sort2";
?>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080">
				<img src="/admin/images/title_icon.gif" width="10" height="9"><?if($type!=2){?> 메인 이미지 관리<?}else{?> 갤러리 관리<?}?>
			</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>
<?if($type == 0 or $type == 1 or $type==100 or $type==101){?>
	<table width="30%" border="0" cellspacing="0" cellpadding="0" align="left">
		<tr>
			<td style="padding-left:10px;">
				<table width="100%" cellpadding="6" cellspacing="1" border="0" bgcolor="#cccccc">
						<colgroup>
							<col style="width: "/>
							<col style="width: 23%"/>
							<col style="width: 23%"/>
							<col style="width: 23%"/>
							<col style="width: 23%"/>
						</colgroup>
						<tr>
							<td rowspan="2" bgcolor="#F7F7F7" width="50" align="center" ><strong>분류</strong></td>
							<td colspan="2" bgcolor="#F7F7F7" align="center" style="<?=($type == 0 or $type == 1)?'font-weight:bold;color:#000082':'';?>">PC</td>
							<td colspan="2" bgcolor="#F7F7F7" align="center" style="<?=($type == 100 or $type == 101)?'font-weight:bold;color:#000082':'';?>">모바일</td>
						</tr>
						<tr>
							<td bgcolor="#ffffff" align="center" style="<?=($type == 0)?'font-weight:bold;color:#000082':'';?>">
							<a href="<?=$_SERVER[PHP_SELF]?>?type=0">회사소개</a></td>
							<td bgcolor="#ffffff" align="center" style="<?=($type == 1)?'font-weight:bold;color:#000082':'';?>">
							<a href="<?=$_SERVER[PHP_SELF]?>?type=1">강의</a></td>
							<td bgcolor="#ffffff" align="center" style="<?=($type == 100)?'font-weight:bold;color:#000082':'';?>">
							<a href="<?=$_SERVER[PHP_SELF]?>?type=100">회사소개</a></td>
							<td bgcolor="#ffffff" align="center" style="<?=($type == 101)?'font-weight:bold;color:#000082':'';?>">
							<a href="<?=$_SERVER[PHP_SELF]?>?type=101">강의</a></td>
						</tr>
				</table>
			</td>
		</tr>
	</table>

	<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr><td height="20"></td></tr>
	</table>
<?}?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr> 
					<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
					<input type=hidden name=page value="<?=$page?>">
					<td>건수 : <?=$total_count?>&nbsp;</td>
					<!--
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
							<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
								<option value="bn_subject" <?if($findType=="bn_subject"){?>selected<?}?>>제목</option>
								<option value="bn_category" <?if($findType=="bn_category"){?>selected<?}?>>구분</option>
								<option value="bn_begin_time" <?if($findType=="bn_begin_time"){?>selected<?}?>>시작일시</option>
							</select> 
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">
						&nbsp;&nbsp;
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
					-->
					</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6"> 
					<td width="7%"><a href="./banner_form.php?mode=W&type=<?=$type?>"><img src="/btn/btn_newup.gif" border="0"></a></td>
					<!-- <td width="5%">타입</td> -->
					<td width="20%">이미지</td>
					<td width="">제목</td>
					<td width="">사이즈</td>
					<td width="7%">순서</td>
					<!-- <td>링크주소</td> -->
				</tr>
			<? 
				for ($i=0; $i<$list_total; $i++) 
				{ 
					?>
					<tr align="center" bgcolor="#FFFFFF"> 
						<td style="font-weight:bold;">
							<a href="./banner_form.php?mode=E&bn_no=<?=$list[$i][bn_no]?>&type=<?=$type?>"><font color=#0033FF>수정</font></a> / 
							<a href='javascript:del("./banner_update.php?mode=D&bn_no=<?=$list[$i][bn_no]?>&type=<?=$type?>")'><font color=#FF3300>삭제</font></a>
						</td>
						<!-- <td><?//=$list[$i][type]?></td> -->
						<td><?=$list[$i][bn_img]?></td>
						<td align=left style="padding:10px;"><?=$list[$i][bn_subject]?></td>
						<td><?=$b_width[$type]?> x <?=$b_height[$type]?></td>
						<td><?=$list[$i][bn_sort]?></td>
						<!-- <td><?//=$list[$i][bn_link]?></td> -->
					</tr>
					<? 
				} 
			?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>
