<style>
.sch {color:#496386; font-size:16px; font-family:돋움; font-weight:bold;}
.sch1 {color:#424242; font-size:16px; font-family:돋움; font-weight:bold;}
.sch2 {color:#FFFFFF; font-family:돋움; font-size:12px; background:ea9c98; padding:5px; font-weight:bold;}
.sch3 {color:#666666; font-family:돋움; font-size:12px; background:FFFFFF; padding:5px; border:1px solid #e0e0e0;}
.sch4 {color:#8b5a63; font-family:돋움; font-size:12px; background:eeeeee; padding:5px;}
.sch5 {color:#999999; font-family:돋움; font-size:12px; padding:5px;}
.sch6 {color:#d14966; font-family:돋움; font-size:12px; background:FFFFFF;padding:5px; }
.sch7 {color:#777777; font-family:돋움; font-size:12px; background:FFFFFF; padding:5px;}
</style>

<script language='javascript'>
function check_confirm(str) {
    var f = document.ListCheck;
    var chk_count = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "list_ck[]" && f.elements[i].checked)
            chk_count++;
    }
    if (!chk_count) {
        alert(str + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

// 선택한 게시물 삭제
function select_delete() {
	var f = document.ListCheck;
	str = "삭제";
	if (!check_confirm(str))
		return;
	if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n원글 삭제시 답변글까지 모두 삭제됩니다.\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
		return;
	f.submit();
}
window.onload = function(){
	var schedulemonth = '<?=$chk_month?>';
	var Mons = document.all.moon;
	for(var i=0; i<Mons.length; i++){
		if(schedulemonth == (i+1)){
			Mons[i].style.fontWeight = "bold";
		}
	}
}
</script>

<?//if($LogAdmin==TRUE){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="1" colspan="2" bgcolor="#eeeeee"></td>
				</tr>
				<tr>
					<td height="10" colspan="2"></td>
				</tr>
				<tr>
					<td width="20%">
						<a href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=<?=$chk_month?>&alim_year=<?=($chk_year-1)?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/pre.gif" width=11 height=11  align=absmiddle /></a>
						<b><?=$chk_year?>년</b>
						<a href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=<?=$chk_month?>&alim_year=<?=($chk_year+1)?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/next.gif" width=11 height=11 align=absmiddle /></a>
					</td>
					<td width="80%">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr align="center">
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=1&alim_year=<?=$chk_year?>">1월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=2&alim_year=<?=$chk_year?>">2월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=3&alim_year=<?=$chk_year?>">3월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=4&alim_year=<?=$chk_year?>">4월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=5&alim_year=<?=$chk_year?>">5월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=6&alim_year=<?=$chk_year?>">6월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=7&alim_year=<?=$chk_year?>">7월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=8&alim_year=<?=$chk_year?>">8월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=9&alim_year=<?=$chk_year?>">9월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=10&alim_year=<?=$chk_year?>">10월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=11&alim_year=<?=$chk_year?>">11월</a></td>
								<td><a id="moon" href="/bbs/board.php?tbl=<?=$Table?>&mode=&page=1&alim_month=12&alim_year=<?=$chk_year?>">12월</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="10" colspan="2"></td>
				</tr>
				<tr>
					<td height="1" colspan="2" bgcolor="#eeeeee"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
	$alim_year=$chk_year;
	$alim_month=$chk_month;

	//해당월의 총날짜수를 구한다.
	function getTotaldays($y, $m) {
		$d = 1;
		while(checkdate($m, $d, $y)) {
			$d++;
		}
		$d = $d - 1;
		return $d;
	}

	//토,일요일을 색상으로 구분해준다.
	function getDayColor($day, $date) {
		$cstr = "";
		switch($day) {
			case(0) :
				$cstr = "<font class='sch6'>$date</font>";
			break;
			case(6) :
				$cstr = "<font class='sch7'>$date</font>";
			break;
			default :
				$cstr = $date;
			break;
		}
		return $cstr;
	}

	//넘어오는 년월정보가 없으면 현재 년월을..
	if(!$alim_year) {
		$alim_year = date(Y);
	}
	if(!$alim_month) {
		$alim_month = date(m);
	}

	//해당 년월의 총 날짜수를 구한다.
	$tot_days = getTotaldays($alim_year, $alim_month);

	//해당 년월의 1일에 해당하는 timestamp값을 구한다.
	$tstamp = mktime(0,0,0,$alim_month,1,$alim_year);

	//timestamp값으로 날짜정보(요일)를 구한다.
	$tinfo = getdate($tstamp);
	$start_day = $tinfo["wday"];

	$start_chk = false;
	$week_end = false;
	$dayno = 0;

	function getAlim($y,$m,$d){
		global $Table;
		$chkin = date("Y-m-d H:i:s",mktime(0,0,0,$m,$d,$y));
		$chkout = date("Y-m-d H:i:s",mktime(23,59,59,$m,$d,$y));
		$sql = "SELECT b_no,b_subject,b_content FROM Gn_Board_Item_{$Table} WHERE b_regist BETWEEN '".$chkin."' AND '".$chkout."' ORDER BY b_regist DESC LIMIT 0,1";
		$row = sql_fetch($sql);

		return $row;
	}function getAlim1($y,$m,$d){
		global $Table;
		$chkin = date("Y-m-d H:i:s",mktime(0,0,0,$m,$d,$y));
		$chkout = date("Y-m-d H:i:s",mktime(23,59,59,$m,$d,$y));
		$sql = "SELECT b_no,b_subject,b_content FROM Gn_Board_Item_{$Table} WHERE b_regist BETWEEN '".$chkin."' AND '".$chkout."' ORDER BY b_regist DESC LIMIT 1,1";
		$row = sql_fetch($sql);

		return $row;
	}function getAlim2($y,$m,$d){
		global $Table;
		$chkin = date("Y-m-d H:i:s",mktime(0,0,0,$m,$d,$y));
		$chkout = date("Y-m-d H:i:s",mktime(23,59,59,$m,$d,$y));
		$sql = "SELECT b_no,b_subject,b_content FROM Gn_Board_Item_{$Table} WHERE b_regist BETWEEN '".$chkin."' AND '".$chkout."' ORDER BY b_regist DESC LIMIT 2,1";
		$row = sql_fetch($sql);

		return $row;
	}
?>



<!-- 상단월부분 START  -->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr valign="top">
		<td align="center" valign="top" style="padding-top:20px">
			<table width="216"  border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td width="53"><?if($alim_month-1=="0"){?>
					<a href="<?=$PHP_SELF?>?alim_year=<?=$alim_year-1?>&alim_month=12&tbl=<?=$Table?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_m_prev.gif"></a>
					<?}else{?>
					<a href="<?=$PHP_SELF?>?alim_year=<?=$alim_year?>&alim_month=<?=$alim_month-1?>&tbl=<?=$Table?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_m_prev.gif"></a>
					<?}?>
					</td>
					<td align="center" class="sch"><font class="sch1"><?=$alim_year?></font>년 <font class="sch1"><?=$alim_month?></font>월</td>
					<td width="53" align="right"><?if($alim_month+1=="13"){?>
					<a href="<?=$PHP_SELF?>?alim_year=<?=$alim_year+1?>&alim_month=1&tbl=<?=$Table?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_m_next.gif"></a>
					<?}else{?>
					<a href="<?=$PHP_SELF?>?alim_year=<?=$alim_year?>&alim_month=<?=$alim_month+1?>&tbl=<?=$Table?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_m_next.gif"></a>
					<?}?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
</table>
<div align="center">
  <!-- 상단월부분 END -->

  <!-- 하단 일부분 START  -->
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr><td><img src="<?=$Board_Admin["skin_dir"]?>/images/06_top.gif" width="100%"></td></tr>
	<tr><td height="5"></td></tr>
</table>
<div align="center"></div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" style="margin-top:10px;">
 <?
	while(!$week_end) {
	?>
			<tr height="75" valign=top>
	<?
	   for($j=0; $j<7; $j++) {
		unset($board_content);
		  if(!$start_chk && $start_day==$j) {
			 $dayno = 1;
			 $start_chk = true;
		  }
		  if($dayno>0 && $dayno<=$tot_days) {
			 $colorstr = getDayColor($j, $dayno);
			 // $board_content = getAlim($alim_year,$alim_month,$dayno);
			$chkin = date("Y-m-d H:i:s",mktime(0,0,0,$alim_month,$dayno,$alim_year));
			$chkout = date("Y-m-d H:i:s",mktime(23,59,59,$alim_month,$dayno,$alim_year));
			$sql = sql_query("SELECT b_no,b_subject,b_content FROM Gn_Board_Item_{$Table} WHERE b_regist BETWEEN '".$chkin."' AND '".$chkout."' ORDER BY b_regist DESC");
			while($rows = mysql_fetch_array($sql)){
				$board_content[] = $rows;
			}

			 $board_content1 = getAlim1($alim_year,$alim_month,$dayno);
			 $board_content2 = getAlim2($alim_year,$alim_month,$dayno);


			 if($board_content){
				 $OverLiv = ""; //" title=\"".$board_content[b_subject]."\" ";
				 $CuroSor = " style=\"cursor:hand;\"";
				 $AlimLink = "<a href=\"/bbs/board.php?tbl=".$Table."&mode=VIEW&num=".$board_content[b_no]."\" >";
				 $AlimLink1 = "<a href=\"/bbs/board.php?tbl=".$Table."&mode=VIEW&num=".$board_content1[b_no]."\" >";
				 $AlimLink2 = "<a href=\"/bbs/board.php?tbl=".$Table."&mode=VIEW&num=".$board_content2[b_no]."\" >";
				 $admin_write = "<a href=\"/bbs/board.php?tbl=".$Table."&mode=WRITE&writedate=".date("Y-m-d",mktime(0,0,0,$alim_month,$dayno,$alim_year))."\"><font class=\"sch5\">[글쓰기]</a>";
			 }else{
				 $OverLiv = "";
				 $CuroSor = " style=\"cursor:default;\"";
				 $AlimLink = "";
				 if($_SESSION[sess][userlevel] == 100){
					$admin_write = "<a href=\"/bbs/board.php?tbl=".$Table."&mode=WRITE&writedate=".date("Y-m-d",mktime(0,0,0,$alim_month,$dayno,$alim_year))."\"><font class=\"sch5\">[글쓰기]</a>";
				 }else{
					$admin_write = "";
				 }
			 }
			 if($alim_month==date(m) && $dayno==date(d) && $alim_year==date(Y)){   //오늘날짜의 칸 색
				?>
				<td class="sch4" width="14%">
					<div align="left" <?=$OverLiv?> <?=$CuroSor?>><b><?=$colorstr?></b><?if($LogAdmin==TRUE){?> <?=$admin_write?><?}?><br />
					<?for($x=0; $x < count($board_content); $x++){?>
						<a href="/bbs/board.php?tbl=<?=$Table?>&mode=VIEW&num=<?=$board_content[$x][b_no]?>"><b><?=$board_content[$x][b_subject]?></a><br>
					<? } ?>
					</div>
				</td>
				<?
			 }else{
				?>
				<td class="sch3" width="14%">
					<div align="left" <?=$OverLiv?> <?=$CuroSor?>><b><?=$colorstr?></b><?if($LogAdmin==TRUE){?> <?=$admin_write?><?}?><br />
					<?for($x=0; $x < count($board_content); $x++){?>
						<a href="/bbs/board.php?tbl=<?=$Table?>&mode=VIEW&num=<?=$board_content[$x][b_no]?>"><b><?=$board_content[$x][b_subject]?></a><br>
					<? } ?>
					</div>
				</td>
				<?
			 }
			 $dayno++;
		  }else{
		  ?>
				<td class="sch3" width="14%">&nbsp;</td>
		  <?
		  }
	   }
	   if($dayno>$tot_days) {
	   $week_end = true;
	   }
	?>
			</tr>
	<?
	}
	?>
</table>
<div align="center"></div></td></tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:35px; ">
<form name="ListCheck" id="test" method="post" action="/bbs/process.php" enctype="multipart/form-data" validate="UTF-8" onsubmit="return listChk(this)">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
<input type="hidden" name="mode" value="LISTDEL">
<input type="hidden" name="tbl" value="<?=$Table?>">
<input type="hidden" name="category" value="<?=$category?>">
<input type="hidden" name="findType" value="<?=$findType?>">
<input type="hidden" name="findword" value="<?=$findword?>">
<input type="hidden" name="sort1" value="<?=$sort1?>">
<input type="hidden" name="sort2" value="<?=$sort2?>">
<input type="hidden" name="page" value="<?=$page?>">
<!-- ######### 주요 히든 필드 수정하지 마세요 ########### -->
	<tr bgcolor="#888"><td height="2" colspan="20"></td></tr>
	<tr align="center" style="background-color:#f8f8f8;">
		<td height="33" class="r_tt" style="color:#444; font-weight:bold;">번호</td>
		<? if($Board_Admin["use_category"] == TRUE) { ?>
		<td width="50"><img src="<?=$Board_Admin["skin_dir"]?>/images/t6.gif"></td>
		<? } ?>
		<td width="50%" class="r_tt" style="color:#444; font-weight:bold;"><?if($LogAdmin==TRUE){?><input type="checkbox" onclick="List_Checked_Sel(this.form,this);"><?}?>제목</td>
		<td class="r_tt" style="color:#444; font-weight:bold;">글쓴이</td>
		<td class="r_tt" style="color:#444; font-weight:bold;">날짜</td>
		<td width="70" class="r_tt" style="color:#444; font-weight:bold;">조회수</td>
		<? if($Board_Admin["use_best"] == TRUE) { ?>
		<td><img src="<?=$Board_Admin["skin_dir"]?>/images/t7.gif"></td>
		<? } ?>
	</tr>
	<tr><td height="1" bgcolor="#e4e0dc" colspan="20"></td></tr>
	<? for ($i=0; $i<$list_total; $i++) { ?>
	<tr  align="center">
		<td height="30"><?=$list[$i]["no"]?></td>
		<? if($Board_Admin["use_category"] == TRUE) { ?>
		<td><?=$list[$i]["b_category"]?></td>
		<? } ?>
		<td align="left">
		<?if($LogAdmin==TRUE){?><input type=checkbox name='list_ck[]' value='<?=$list[$i]["b_no"]?>'><?}?>
		<a href="<?=$list[$i]["viewUrl"]?>"><?=$list[$i]["subject"]?></a> <?=$list[$i]["comment"]?> <?=$list[$i]["secret"]?> <?=$list[$i]["new"]?></td>
		<td><?=$list[$i]["b_writer"]?></td>
		<td><?=cut_str($list[$i]["b_regist"],10,'')?></td>
		<td><?=$list[$i]["hit"]?></td>
		<? if($Board_Admin["use_best"] == TRUE) { ?>
		<td><?=$list[$i]["best"]?></td>
		<? } ?>
	</tr>
	<tr bgcolor="#e4e0dc"><td height="1" colspan="20"></td></tr>
	<? } ?>
	<? if($i==0) { ?>
	<tr><td height="80" colspan="20" align="center">등록된 게시물이 없습니다.</td></tr>
	<? } ?>
	<tr><td height="1" bgcolor="#e4e0dc" colspan="20"></td></tr>
</form>
</table>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="50" align="left"><!-- <? if($Url["admin"]==TRUE) { ?><a href="<?=$Url["admin"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_admin.gif" border="0"></a><? } ?> --></td>
		<td height="50" align="right">
		<!--
		<? if($Url["write"]==TRUE) { ?>
		<a href="<?=$Url["write"]?>"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_write.gif" border="0"></a>
		<? } ?>
		-->
		<? if ($LogAdmin==TRUE) { ?>
		<a href="javascript:select_delete();"><img src="<?=$Board_Admin["skin_dir"]?>/images/btn_delete.gif" border="0"></a>
		<? } ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><?=$PageLinks?></td>
	</tr>
</table>

<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
				<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=tbl value="<?=$Table?>">
				<input type=hidden name=mode value="">
				<input type=hidden name=page value="<?=$page?>">
					<td>
					<? if($Board_Admin["use_category"] == TRUE) { ?>
					<select name="category" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
						<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
						<?=$Category_option?>
					</select>
					<? } ?>
					<!--
					<select name="findType" style="height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
						<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
						<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
						<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
						<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
					</select>
					<input type="text" name="findWord" style="width:100; height:19px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid" value="<?=$findword?>">&nbsp;<input type=image src='<?=$Board_Admin["skin_dir"]?>/images/icon_search.gif' align=absmiddle> -->
					</td>
				</form>
				</tr>
			</table>
		</td>
	</tr>
</table>