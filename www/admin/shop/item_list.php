<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopitem"];
$JO_table = $GnTable["shopcategory"];

// 분류 옵션 만들기 여기부터
	$ca_list  = "";
	$sql = " select * from $JO_table order by ca_id ";
	$result = sql_query($sql);

	for ($i=0; $row=sql_fetch_array($result); $i++)
	{
		$len = strlen($row[ca_id]) / 2 - 1;
		$nbsp = "";
		for ($i=0; $i<$len; $i++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;";
		}
		$ca_list .= "<option value='$row[ca_id]'>$nbsp$row[ca_name]";
	}
	$ca_list .= "</select>";
// 분류 옵션 만들기 여기까지

$where = " and ";

//검색
$sql_search = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
}

if ($sca != "") {
    $sql_search .= " $where a.ca_id like '$sca%' ";
}

if ($sfl == "")  $sfl = "it_name";

if ($ius) {
	if ($ius=="1") $sql_search.=" and it_use<>'' ";
	else if ($ius=="2") $sql_search.=" and it_use='0' ";
}

if ($ity) {
	$sql_search.=" and it_type{$ity}='1' ";
}

if ($fmDt && $toDt) {
	if ($fmDt==$toDt) $sql_search.=" and it_time like '{$fmDt}%' ";
	else $sql_search.=" and (it_time>='{$fmDt} 00:00:00' and it_time<='{$toDt} 00:00:00')";
}
else {
	if ($fmDt) $sql_search.=" and it_time>='{$fmDt} 00:00:00' ";
	else if ($toDt) $sql_search.=" and it_time<='{$toDt} 00:00:00' ";
}

$sql_common = " from $PG_table a , $JO_table b where (a.ca_id = b.ca_id) $sql_search";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst)
{
    $sst  = "it_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

// 출력할 레코드를 얻음
$sql  = " select *
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {
	$list[$i] = $row;
	//$list[$i]["IMG"] = img_resize_tag("/shop/data/item/{$row[it_id]}_s",50,50);
	################## [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력. - START ] ##################
	$file_name[$i]["small"] = str_replace($list[$i][it_id]."_l", $list[$i][it_id]."_s", $list[$i]["it_file1"]);
	if($list[$i]["it_file1"] != "") {
		$list[$i]["list_img_src"] = $GnShop['data_url']."/".$list[$i]["it_id"]."/".$file_name[$i]["small"];
	} 
	$list[$i]["IMG"] = img_resize_tag($list[$i]["list_img_src"],50,50);
	##################   [ 트래픽 최소화를 위해 s 사이즈 이미지를 출력 - END ]  ##################

	$list[$i]["URL"] = "/shop/item.php?it_id={$row[it_id]}";
	$list[$i]["NAME"] = htmlspecialchars2(cut_str($row[it_name],250, ""));
}

$list_total = count($list);
$qstr  = "sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&ity=$ity&ius=$ius&fmDt=$fmDt&toDt=$toDt";
?>
<script language="javascript">
function chkDel(code) {
    if(confirm("삭제하시겠습니까?"))
	document.location.href = "./item_update.php?mode=D&page=<?=$page?>&it_id=" +code;
}
</script>



<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 상품목록 관리</font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>


<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
				<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=page value="<?=$page?>">
					<td width="50"><a href='<?=$_SERVER[PHP_SELF]?>'>처음</a></td>
					<td width="" align=center>
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td style="padding-right:10px;"><img src="/btn/icon_search.gif"></td>
								<td>
									<input type="radio" name="ius" value="" <? if (!$ius) { ?>checked<?}?> >전체상품&nbsp;
									<input type="radio" name="ius" value="1" <? if ($ius=="1") { ?>checked<?}?>>판매상품&nbsp;
									<input type="radio" name="ius" value="2" <? if ($ius=="2") { ?>checked<?}?>>판매중지상품
								</td>
								<td style="padding:0 20px 0px 20px;">|</td>
								<td style="padding-right:4px;">등록일: 
								  <input name="fmDt" type="text" size="10" value="<?=$fmDt?>" readonly onfocus="showCalendarControl(this);"> ~
								  <input name="toDt" type="text" size="10" value="<?=$toDt?>" readonly onfocus="showCalendarControl(this);">
								</td>
								<td style="padding:0 20px 0px 20px;">|</td>
								<td style="padding-right:4px;">
									<select name="ity">
										<option value='' <? if (!$ity) { ?>selected<? } ?>> - 상품타입 - </option>
										<? if ($GnShop[use_type1]) { ?><option value='1' <? if ($ity=="1") { ?>selected<? } ?>>메인추출상품</option><? } ?>
										<? if ($GnShop[use_type2]) { ?><option value='2' <? if ($ity=="2") { ?>selected<? } ?>>신상품</option><? } ?>
										<? if ($GnShop[use_type3]) { ?><option value='3' <? if ($ity=="3") { ?>selected<? } ?>>베스트상품</option><? } ?>
										<? if ($GnShop[use_type4]) { ?><option value='4' <? if ($ity=="4") { ?>selected<? } ?>>히트상품</option><? } ?>
										<? if ($GnShop[use_type5]) { ?><option value='5' <? if ($ity=="5") { ?>selected<? } ?>>사은품제공상품</option><? } ?>
									</select>
								</td>
								<td style="padding-right:4px;">
									<select name="sca">
										<option value=''> - 전체분류 -
										<?
											$sql1 = " select ca_id, ca_name from $JO_table order by ca_id ";
											$result1 = sql_query($sql1);
											for ($i=0; $row1=sql_fetch_array($result1); $i++)
											{
												$len = strlen($row1[ca_id]) / 2 - 1;
												$nbsp = "";
												for ($i=0; $i<$len; $i++) $nbsp .= "&nbsp;&nbsp;&nbsp;";
												echo "<option value='$row1[ca_id]'>$nbsp$row1[ca_name]\n";
											}
										?>
									</select>
									<script> document.search.sca.value = '<?=$sca?>';</script>
									<select name=sfl>
										<option value='it_name' <? if ($sfl=="it_name") { ?>selected<? } ?>>상품명
										<option value='it_id' <? if ($sfl=="it_id") { ?>selected<? } ?>>상품코드
										<option value='it_maker' <? if ($sfl=="it_maker") { ?>selected<? } ?>>제조사
										<option value='it_origin' <? if ($sfl=="it_origin") { ?>selected<? } ?>>원산지
									<? if ($sel_field) echo "<script> document.flist.sel_field.value = '$sel_field';</script>"; ?>									
								</td>
								<td>
									<input type="text" name="stx" value='<?=$stx?>'>
									<input type="image" src='/btn/btn_search.gif' align=absmiddle>								
								</td>
							</tr>
						</table>
					</td>
					<td width="50" align="right">건수 : <? echo $total_count ?>&nbsp;</td>
			</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<form name=fitemlistupdate method=post action="./item_listupdate.php" autocomplete='off'>
			<input type=hidden name=sca  value="<?=$sca?>">
			<input type=hidden name=sst  value="<?=$sst?>">
			<input type=hidden name=sod  value="<?=$sod?>">
			<input type=hidden name=sfl  value="<?=$sfl?>">
			<input type=hidden name=stx  value="<?=$stx?>">
			<input type=hidden name=ity  value="<?=$ity?>">
			<input type=hidden name=ius  value="<?=$ius?>">
			<input type=hidden name=fmDt  value="<?=$fmDt?>">
			<input type=hidden name=toDt  value="<?=$toDt?>">
			<input type=hidden name=page value="<?=$page?>">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<tr align="center" bgcolor="#F6F6F6">
				<td width=120><a href='./item_form.php?mode=W'><img src="/btn/btn_newup.gif" border=0 title='상품등록'></a></td>
				<td width=70 height=25><?=subject_sort_link("it_id", "sca=$sca")?>상품코드</a></td>
				<td width='' colspan=2><?=subject_sort_link("it_name", "sca=$sca")?>상품명</a></td>
				<td width=70><?=subject_sort_link("it_pay", "sca=$sca")?>정가</a></td>
				<td width=70><?=subject_sort_link("it_epay", "sca=$sca")?>할인가</a></td>
				<td width=70><?=subject_sort_link("it_stock", "sca=$sca")?>재고</a></td>
				<!--
				<td width=30><?=subject_sort_link("it_order", "sca=$sca")?>순서</a></td>
				-->
				<td width=30><?=subject_sort_link("it_use", "sca=$sca", 1)?>판매</a></td>
				<td width=30><?=subject_sort_link("it_hit", "sca=$sca", 1)?>조회</a></td>
			</tr>
			<?
				for ($i=0; $i<$list_total; $i++) {
					$gallery = $list[$i][it_gallery] ? "Y" : "";

					$tmp_ca_list  = "<select id='ca_id_$i' name='ca_id[$i]'>" . $ca_list;
					$tmp_ca_list .= "<script language='javascript'>document.getElementById('ca_id_$i').value='{$list[$i][ca_id]}';</script>";
			?>
				<input type="hidden" name="it_id[<?=$i?>]" value="<?=$list[$i]["it_id"]?>">
				<tr align="center" bgcolor="#FFFFFF">
					<td style="font-weight:bold;">
						<a href="./item_form.php?mode=E&ca_id=<?=$list[$i]["ca_id"]?>&it_id=<?=$list[$i]["it_id"]?>&<?=$qstr?>&page=<?=$page?>"><font color="#0033FF">수정</font></a> /
						<a href="javascript:chkDel('<?=$list[$i]["it_id"]?>')"><font color="#FF3300">삭제</font></a> /
						<a href="<?=$list[$i]["URL"]?>" target="_blank"><font color="#0C9060">보기</font></a>
					</td>
					<td><?=$list[$i]["it_id"]?></td>
					<td style="padding-top:5px; padding-bottom:5px;">
						<table width="50" height="50" border="1" cellpadding="0" cellspacing="0" bordercolor="#eeeeee" style="border-collapse:collapse;">
							<tr>
								<td align="center" valign="middle"><a href="<?=$list[$i]["URL"]?>"><?=$list[$i]["IMG"]?></a></td>
							</tr>
						</table>
					</td>
					<td align="left"><?=$tmp_ca_list?><br><input type="text" name="it_name[<?=$i?>]" value="<?=$list[$i]["NAME"]?>" size="40" class="text"></td>
					<td width="70" align="center"><input type="text" name="it_pay[<?=$i?>]" value="<?=$list[$i]["it_pay"]?>" class="text" size="7" style="text-align:right; background-color:#DDE6FE;"></td>
					<td width="70" align="center"><input type="text" name="it_epay[<?=$i?>]" value="<?=$list[$i]["it_epay"]?>" class="text" size="7" style="text-align:right; background-color:#DDFEDE;"></td>
					<td width="70" align="center"><input type="text" name="it_stock[<?=$i?>]" value="<?=$list[$i]["it_stock"]?>" class="text" size="7" style="text-align:right;"></td>
					<!--
					<td><input type="text" name="it_order[<?=$i?>]" value="<?=$list[$i]["it_order"]?>" class="text" size="3" style="text-align:right;"></td>
					-->
					<td align="center"><input type="checkbox" name="it_use[<?=$i?>]" <?=$list[$i]["it_use"] ? "checked" : "";?> value="1"></td>
					<td align="center"><?=$list[$i]["it_hit"]?></td>
				</tr>
			<? } ?>
			<? if($i==0) { ?>
				<tr>
					<td colspan="20" align="center" height="80" bgcolor="#FFFFFF">등록된 상품이 없습니다.</td>
				</tr>
			<? } ?>
			</table>

			<table width="100%">
				<tr>
					<td width="50%"><input type="submit" value="일괄수정" accesskey="s"></td>
					<td width="50%" align="right"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>