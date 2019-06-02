<?
	include "../head.php";
	include "../shop/lib/lib.php"; // 확장팩 사용함수


//여기부터는 날짜설정
	if (!function_exists("get_first_day")) {
		// mktime() 함수는 1970 ~ 2038년까지만 계산되므로 사용하지 않음
		// 참고 : http://phpschool.com/bbs2/inc_view.html?id=3924&code=tnt2&start=0&mode=search&s_que=mktime&field=title&operator=and&period=all
		function get_first_day($year, $month)
		{
			$day = 1;
			$spacer = array(0, 3, 2, 5, 0, 3, 5, 1, 4, 6, 2, 4);
			$year = $year - ($month < 3);
			$result = ($year + (int) ($year/4) - (int) ($year/100) + (int) ($year/400) + $spacer[$month-1] + $day) % 7;
			return $result;
		}
	}

	// 오늘
	$new_datetime = time();
	$today = getdate($new_datetime);

	
	//echo $new_datetime;
	
	if(!$schedule_ym) $schedule_ym = $_datetime;

	$year  = (int)substr($schedule_ym, 0, 4);
	$month = (int)substr($schedule_ym, 4, 2);
	if ($year  < 1)                $year  = $today[year];
	if ($month < 1 || $month > 12) $month = $today[mon];
	$current_ym = sprintf("%04d%02d", $year, $month);

	$end_day = array(1=>31, 28, 31, 30 , 31, 30, 31, 31, 30 ,31 ,30, 31);
	// 윤년 계산 부분이다. 4년에 한번꼴로 2월이 28일이 아닌 29일이 있다.
	if( $year%4 == 0 && $year%100 != 0 || $year%400 == 0 )
		$end_day[2] = 29; // 조건에 적합할 경우 28을 29로 변경

	// 해당월의 1일을 mktime으로 변경
	$mktime = mktime(0,0,0,$month,1,$year);
	$mkdate = getdate(strtotime(date("Y-m-1", $mktime)));

	// 1일의 첫번째 요일 (0:일, 1:월 ... 6:토)

	$first_day = get_first_day($year, $month);
	// 해당월의 마지막 날짜,
	$last_day  = $end_day[$month];

//여기까지 날짜설정=====================================================================================

	$PG_table = $GnTable["shoporder"];
	$JO_table = $GnTable["shopcart"];


	$where = " where ";
	$sql_search = "";

	if ($_POST[search_02] != "" || $_POST[search_03] != "" || strlen($_POST[mem_leb]) > 0)
	{
		if($_POST[search_02]){
			if(strlen($_POST[search_star_day]) == 1) $_POST[search_star_day] = "0".$_POST[search_star_day];
			if(strlen($_POST[search_end_day]) == 1) $_POST[search_end_day] = "0".$_POST[search_end_day];

			if(strlen($_POST[search_star_month]) == 1) $_POST[search_star_month] = "0".$_POST[search_star_month];
			if(strlen($_POST[search_end_month]) == 1) $_POST[search_end_month] = "0".$_POST[search_end_month];
			
			$search_star = $_POST[search_star_year]."-".$_POST[search_star_month]."-".$_POST[search_star_day];
			$search_end = $_POST[search_end_year]."-".$_POST[search_end_month]."-".$_POST[search_end_day];
			if($_POST[search_02] == "1"){ // 결제일 기준
				
				$sql_search .= " $where ((SUBSTRING(od_bank_time,1,10) >= '$search_star' and SUBSTRING(od_bank_time,1,10) <= '$search_end') or (SUBSTRING(od_card_time,1,10) >= '$search_star' and SUBSTRING(od_card_time,1,10) <= '$search_end'))";
				$where = " and ";
			}else{                        // 주문일 기준
				$sql_search .= " $where (SUBSTRING(od_time,1,10) >= '$search_star' and SUBSTRING(od_time,1,10) <= '$search_end')";
				$where = " and ";		
			}
		}
		if($_POST[search_03]){
			echo $_POST[search_03];
				$sql_search .= " $where $_POST[search_01] = '$_POST[search_03]'";
				$where = " and ";			
			}
		if(strlen($_POST[mem_leb]) > 0){
			
			$sql_search .= " $where od_mb_leb = '$_POST[mem_leb]'";
			$where = " and ";			
		}

	}
	
	$sql_search .= " $where (od_receipt_bank != '' or od_receipt_card != '')";			

	if ($sel_field == "")  $sel_field = "od_time";
	if ($sort1 == "") $sort1 = "od_time";
	if ($sort2 == "") $sort2 = "desc";

	$sql_common = " from $PG_table a
					left join $JO_table b on (a.on_uid=b.on_uid)
					$sql_search ";

	$result = sql_query(" select DISTINCT od_id ".$sql_common);
	$total_count = mysql_num_rows($result);

	$rows = 100;
	// 전체 페이지 계산
	$total_page  = ceil($total_count / $rows);
	// 페이지가 없으면 첫 페이지 (1 페이지)
	if ($page == "") $page = 1;
	// 시작 레코드 구함
	$from_record = ($page - 1) * $rows;

	$sql  = " select a.od_id,
					 a.*, b.ct_status, ".$misuqry."
			   $sql_common
			   group by a.od_id
			   order by $sort1 $sort2
			   limit $from_record, $rows ";
	$result = sql_query($sql);

	$count=1;
	while($row = mysql_fetch_array($result)){
			$array_od_bank_time[] =  substr($row[od_bank_time],8,2);
			$array_od_card_time[] = substr($row[od_bank_time],8,2);
			$array_od_bank_time2[] =  $row[od_bank_time];
			$array_od_card_time2[] =  $row[od_card_time];
			$array_od_bank_amount[] = $row[od_receipt_bank];
			$array_od_card_amount[] = $row[od_receipt_card];
			$array_od_point_amount[] = $row[od_receipt_point];
	$count++;
	}


	$qstr1 = "sel_ca_id=$sel_ca_id&findType=$findType&findword=$findword";
	$qstr = "$qstr1&sort1=$sort1&sort2=$sort2&page=$page";

?>
<script language="javascript">
function chkDel(id) {
    if(confirm("삭제하면 복구하실 수 없습니다.\n삭제하시겠습니까?")) 
	document.location.href = "./online_up.php?mode=D&type=<?=$type?>&page=<?=$page?>&num=" +id;
}
</script>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> 회원별 매출통계</font></strong>
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
	<!-- <tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr> 
			<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
					<td>
						기간 : <input type='text' name='fr_date' size=11 maxlength=10 value='<?=$fr_date?>' style="height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid"> - <input type='text' name='to_date' size=11 maxlength=10 value='<?=$to_date?>' style="height:19px;color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid">
						&nbsp;&nbsp;
						<input type=image src='/btn/btn_search.gif' align=absmiddle>
					</td>
			</form>
				</tr>
			</table>
		</td>
	</tr> -->
	<tr><td height="10"></td></tr>
	<tr>
		<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" style="word-break:break-all;">
			<form name=search method="post" action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
			<input type=hidden name=page value="<?=$page?>">
			<tr>
				<td width="150" align="center" bgcolor="#F6F6F6">회 원 구 분</td>
				<td bgcolor="#ffffff" style="padding-left:10px;">
						<select name=mem_leb>
							<?=Get_level($_POST[mem_leb],"SELECT","","ok");?>
						</select>
				</td>
			</tr>
			<tr bgcolor="#F6F6F6">
				<td align="center" bgcolor="#F6F6F6">기 간 조 회</td>
				<td bgcolor="#ffffff" style="padding-left:10px;">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="100">
								<select name="search_02">
									<option value="1" <?=($_POST[search_02] == "1")?"selected":"";?>>결제일기준</option>
									<option value="2" <?=($_POST[search_02] == "2")?"selected":"";?>>주문일기준</option>
								</select>
							</td>
							<td width="215">
								<select name="search_star_year">
								<?
									if(!$_POST[search_star_year]) $_POST[search_star_year] = date("Y");
									for($i=2004; $i <= date("Y"); $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_star_year])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 년
								<select name="search_star_month">
								<?
									if(!$_POST[search_star_month]) $_POST[search_star_month] = date("m");
									for($i=1; $i <= 12; $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_star_month])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 월
								<select name="search_star_day">
								<?
									if(!$_POST[search_star_day]) $_POST[search_star_day] = 1;
									for($i=1; $i <= 31; $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_star_day])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 일 ~ 
							</td>

							<td width="215">
								<select name="search_end_year">
								<?
									if(!$_POST[search_end_year]) $_POST[search_end_year] = date("Y");
									for($i=2004; $i <= date("Y"); $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_end_year])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 년
								<select name="search_end_month">
								<?
									if(!$_POST[search_end_month]) $_POST[search_end_month] = date("m");
									for($i=1; $i <= 12; $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_end_month])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 월
								<select name="search_end_day">
								<?
									if(!$_POST[search_end_day]) $_POST[search_end_day] = 31;
									for($i=1; $i <= 31; $i++){
								?>
									<option value="<?=$i?>" <?=($i==$_POST[search_end_day])?"selected":""?>><?=$i?></option>
								<?
								}
								?>
								</select> 일 
								<td>&nbsp;</td>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<input type=hidden name=page value="<?=$page?>">
			<tr>
				<td width="150" align="center" bgcolor="#F6F6F6">
					<select name="search_01">
						<option value="mb_id" <?=($_POST[search_01] == "mb_id")?"selected":"";?>>회원아이디</option>
						<option value="od_name" <?=($_POST[search_01] == "od_name")?"selected":"";?>>이름</option>
					</select>
				</td>
				<td bgcolor="#ffffff" style="padding-left:10px;">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="170"><input type="text" name="search_03" value="<?=$_POST[search_03]?>"></td>
							<td><input type="submit" value="검색하기" alt="검색하기"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table></td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0" style="word-break:break-all;">
				<? 
						$list_count = $total_count;?>
				<tr align="center" bgcolor="#F6F6F6"> 
					<td>날짜</td>
					<td>검색 된 총매출[<b><span id="tot_amount_view"></span>0원</b> <b>(<span id="tot_count_view">0</span> 건)</b>] </td>
					<td width="180">매출액</td>
					<td width="180">PG</td>
					<td width="180">현금</td>
					<td width="180">포인트</td>
				</tr>
			
				<?

				function print_line($save,$idx="")
				{
					echo "<tr align='center' bgcolor='#FFFFFF'>";
					echo "<td>";
					if($save[bank_time]) echo $save[bank_time];
					else echo $save[card_time];
					echo "</td>";
							echo "<td align='left'>				
								<table width='370' cellpadding='0' cellspacing='0' border='0'>
									<tr>
											<td id='graph_".$idx."' width='80%'>&nbsp;</td>
											<td>";
													echo "(<span style='color:#ff0000'>".$save[count2]."건</span>)";
											echo "</td>
									</tr>
								</table>
							</td>
							<td style='color:#ff0000'>";
							if($save[card_amount] || $save[bank_amount]) echo number_format($save[add_amount])."원";
							else echo "#nbsp;";
							echo "</td></td>";
							echo "<td>";
							if($save[card_amount] || $save[bank_amount]) echo "<span style='color:#0000ff'>".number_format($save[card_amount])."</span>원";
							else echo "#nbsp;";
							echo "</td>";
							echo "<td>";
							if($save[card_amount] || $save[bank_amount]) echo "<span style='color:#0000ff'>".number_format($save[bank_amount])."</span>원";
							else echo "#nbsp;";
							echo "</td>";
							echo "<td>";
							if($save[card_amount] || $save[bank_amount] || $save[point_amount]) echo "<span style='color:#0000ff'>".number_format($save[point_amount])."</span>원";
							else "#nbsp;";
							echo "</td>";
							echo "</tr>\n";	
				}

				// 루프 시작
				$tot_count=0;
				$grapg_percent_count=1;


				for($i=1; $i <= $list_count; $i++){
					if($first_day == 0) {
						$style_star = "<font color='#ff0000'>";
						$style_end = "</font>";
					}else if($first_day == 6) {
						$style_star = "<font color='#0000ff'>";
						$style_end = "</font>";
					}

					$od_bank_time = substr($array_od_bank_time2[$i-1],0,10);
					$od_card_time = substr($array_od_card_time2[$i-1],0,10);
				    if ($i == 1){
						if($array_od_bank_time2[$i-1] != "0000-00-00 00:00:00") $save[od_date] = $od_bank_time;
						else if($array_od_card_time2[$i-1] != "0000-00-00 00:00:00") $save[od_date] = $od_card_time;
					}
					
					if ($save[od_date] != $od_bank_time && $save[od_date] != $od_card_time) {
						print_line($save,$grapg_percent_count);
						$grapg_percent[$grapg_percent_count] = $save[add_amount];
						unset($save);
						if($array_od_bank_time2[$i-1] != "0000-00-00 00:00:00") $save[od_date] = $od_bank_time;
						else if($array_od_card_time2[$i-1] != "0000-00-00 00:00:00") $save[od_date] = $od_card_time;
						$grapg_percent_count++;
					}
					$save[count2]++;
					$save[bank_amount] += $array_od_bank_amount[$i-1];
					$save[card_amount] += $array_od_card_amount[$i-1];
					$save[point_amount] += $array_od_point_amount[$i-1];
					$save[bank_time] = $od_bank_time;
					$save[card_time] = $od_bank_card;
				
					$tot_count ++;   //월전체건수
					$tot_bank_amount += $array_od_bank_amount[$i-1];  //월전체카드매출
					$tot_card_amount += $array_od_card_amount[$i-1];  //월전체무통장매출
					$tot_point_amount += $array_od_point_amount[$i-1];  //월전체포인트매출
					$save[add_amount] += $array_od_bank_amount[$i-1] + $array_od_card_amount[$i-1];  
					
					$result_amount += $array_od_bank_amount[$i-1] + $array_od_card_amount[$i-1]; //월전체매출
					//매출
				?>
				<?
					} 
				?>
				<!--$list_count-->
				<?if(!$list_count) {echo "<tr><td bgcolor='#ffffff' colspan='7' align='center' height='100'>검색 된 매출이 없습니다</td></tr>";
				}else{
					print_line($save,$grapg_percent_count);
					$grapg_percent[$grapg_percent_count] = $save[add_amount];
				}?>
				<tr align="center" bgcolor="#F6F6F6">
					<td <?=$colspan?>>합계</td>
					<td><span style="color:#0000ff"><?=$tot_count?>건</span></td>
					<td><span style='color:#0000ff'><?=number_format($result_amount)?></span>원</td>
					<td><span style='color:#0000ff'><?=number_format($tot_card_amount)?></span>원</td>
					<td><span style='color:#0000ff'><?=number_format($tot_bank_amount)?></span>원</td>
					<td><span style='color:#0000ff'><?=number_format($tot_point_amount)?></span>원</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height="30"></td>
	</tr>
</table>
<script type="text/javascript">
<!--
		document.getElementById("tot_amount_view").innerHTML = "<?=number_format($result_amount)?>";
		document.getElementById("tot_count_view").innerHTML = "<?=number_format($tot_count)?>";
	
	<?for($i=1; $i <= $grapg_percent_count; $i++){
			$div = $result_amount / 100;
			$result_percent = $grapg_percent[$i] / $div;
			$result_percent = round($result_percent);
		?>
		//style='background-color:#0000CC; width:0%'
		//<?=$result_percent?>%
		document.getElementById("graph_<?=$i?>").innerHTML = "<div style='background-color:#cccccc; width:<?=$result_percent?>%'></div>";
	<? } ?>
//-->
</script>