<?
include "./lib/lib.php";

$PG_table = $GnTable["bbsitem"].$Table;

$sql_search = " where 1 ";

if($findword != "") $sql_search .= "and $findType like '%$findword%' ";

if($_GET[category]) $sql_search .= " and b_category='".$_GET[category]."' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from $PG_table a $sql_search";
$row = sql_fetch($sql,FALSE);
$total_count = $row[cnt];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sort1) 
{
    $sort1  = "b_notice desc, b_tno desc, b_dep, b_no";
    $sort2 = "desc";
}
$sql_order = "order by $sort1 $sort2";

// 출력할 레코드를 얻음
 $sql  = " select a.*, b.it_name from $PG_table a left join Gn_Shop_Item b on(a.b_ex2 = b.it_id)
		   $sql_search 
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql,FALSE);

for ($B=0; $row=sql_fetch_array($result,FALSE); $B++) {
	$list[$B] = $row;
		$Get_File_sql= "select * from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '{$row[b_no]}' order by bf_fno";
		$Get_File_result = sql_query($Get_File_sql,FALSE);
		//다운파일이 있으면
		for ($i=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $i++) {
				##### 등록파일이 있을경우
				##### 등록파일이 있을경우
					$getsavename = $Get_File["bf_save_name"];
					$getfilename = $Get_File["bf_real_name"];
					//첨부파일이 이미지인지 검사후 이미지관련코드 실행 (2012_03_06)
					$ext = file_type($getsavename);
					if(!strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {						
						if ($Board_Admin[sum_flag]=="1") $sum_key="sum_";
						else $sum_key="";

						$list[$B]["img_".$i] = "/bbs/data/$Table/{$sum_key}{$getsavename}";						
						$size=@GetImageSize($_SERVER["DOCUMENT_ROOT"]."/bbs/data/$Table/".$getsavename);
						//$resize = ($size[0]> $Board_Admin["imgsize"]) ? $Board_Admin["imgsize"] : $size[0];
						if ($Board_Admin[sum_resize]=="1") {
							if(strCmp($ext,"bmp")){
								$resize=img_resize_size($size[0],$size[1],$Board_Admin[sum_width],$Board_Admin[sum_height]);
								$resize_arr=explode("|",$resize);
								$img_width[$B]= $resize_arr[0];
								$img_height[$B]= $resize_arr[1];		
							}else{
								$list[$B]["img_".$i] = "/bbs/data/$Table/{$getsavename}";
								$img_width[$B]=$Board_Admin[sum_width];
								$img_height[$B]=$Board_Admin[sum_height];	
							}
						}
						else {
							$img_width[$B]=$Board_Admin[sum_width];
							$img_height[$B]=$Board_Admin[sum_height];	
						}
					} else if(!strCmp($ext,"mov") || !strCmp($ext,"wmv") || !strCmp($ext,"avi") || !strCmp($ext,"asf") || !strCmp($ext,"asx") || !strCmp($ext,"mpeg") || !strCmp($ext,"mpg")) {
						$list[$B]["img_".$i] = "{$Board_Admin[skin_dir]}/images/media_img.gif";
						$img_width[$B]=$Board_Admin[sum_width];
						$img_height[$B]=$Board_Admin[sum_height];
					} else {
						$list[$B]["img_".$i] = "{$Board_Admin[skin_dir]}/images/no_img.jpg";
						$img_width[$B]=$Board_Admin[sum_width];
						$img_height[$B]=$Board_Admin[sum_height];
					}
		}

		$depth="";
		$depth_num="";
		$length=strlen($row["b_dep"]);
		## 답변 아이콘 초기화
		$list[$B]["reicon"] = "";
		if($length !=1) {
			for($k=2;$k<=$length;$k++) {
				//들여쓰기
				$depth_num=$depth_num."&nbsp;&nbsp;&nbsp;";
			}
			$list[$B]["reicon"] = $depth_num."<font color=orange><b>[답변]</b></font>&nbsp;";
		}
		## 제목글 자르기
		if($Board_Admin["listsubject"]>0) {
			$SubCutStr = $Board_Admin["listsubject"] + ($length*3) + 6; // [제목글자수] + ( [들여쓰기횟수] * [들여쓰기공간] ) + [아이콘공간]
			$list[$B]["subject"] = $list[$B]["reicon"].cut_str($list[$B]["b_subject"],$SubCutStr);
		} else {
			$list[$B]["subject"] = $list[$B]["reicon"].$list[$B]["b_subject"];
		}
}

$list_total = count($list);
$qstr = "category=".$_GET[category]."&findType=$findType&findword=$findword&sort1=$sort1&sort2=$sort2";
?>
<style>input.calendar { behavior:url(/css/htc_calendar.htc); }</style>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$html_title?> 관리</font></strong>
		</td>
	</tr>
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>
<br>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr> 
					<td>건수 : <?=$total_count?>&nbsp;</td>
					<td style="padding-right:5px" valign="top"><img src="/btn/icon_search.gif" border="0"></td>
					<td>
							<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
								<option value="b_subject" <?if($findType=="b_subject"){?>selected<?}?>>제목</option>
								<option value="b_content" <?if($findType=="b_content"){?>selected<?}?>>내용</option>
							</select> 
						<input type="text" name="findword" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">
						&nbsp;&nbsp;
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
					</form>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="10" colspan="2"></td></tr>
	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
				<form name="list_form" method="post" action="./list_update.php">
				<input type="hidden" name="qstr"  value="<?=$qstr?>">
				<tr align="center" bgcolor="#F6F6F6" height="25"> 
					<td width="6%"><!-- <a href="./form.php?mode=W&category=<?=urlencode($_GET[category])?>"><img src="/btn/btn_newup.gif" border="0"></a> --></td>
					<td >제 목</td>
					<td width="15%">작성자/아이디</td>
					<td width="15%">등록날짜</td>
					<td width="10%">조회수</td>
				</tr>
			<?
			for ($i=0; $i<$list_total; $i++) { ?>
			<input type="hidden" name="list_num[]" value="<?=$list[$i][b_no]?>">
				<tr bgcolor="#FFFFFF"> 
					<td style="font-weight:bold;text-align:center">
						<a href="./form.php?mode=E&b_no=<?=$list[$i][b_no]?>&<?=$qstr?>&it_id=<?=$list[$i][b_ex2]?>"><font color=#0033FF>수정</font></a> / 
						<a href='javascript:del("./update.php?mode=D&b_no=<?=$list[$i][b_no]?>&<?=$qstr?>")'><font color=#FF3300>삭제</font></a>
					</td>
					<td  style="padding:10px;"><?=($list[$i][b_dep] == "A")?"[<a href='/shop/item.php?it_id=".$list[$i][b_ex2]."' target='_blank'>".$list[$i][it_name]."</a>] ":"";?><?=$list[$i][subject]?></td>
					<td style="text-align:center"><?=$list[$i][b_writer]?> / <?=($list[$i][b_member] != "")?$list[$i][b_member]:"GUEST";?></td>
					<td style="text-align:center"><?=$list[$i][b_regist]?></td>
					<td style="text-align:center"><?=$list[$i][b_hit]?></td>
				</tr>
			<? } ?>
			<?if($i == 0) echo "<tr><td height='150' align='center' colspan='7' bgcolor='#ffffff'><b>등록 된 게시물이 없습니다</b></td></tr>";?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="50"><?=get_paging($default[page_list], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
	</tr>
</table>
