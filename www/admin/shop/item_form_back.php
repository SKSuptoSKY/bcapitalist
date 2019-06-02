<?
include "../head.php";
include "./lib/lib.php"; // 확장팩 사용함수

$PG_table = $GnTable["shopitem"];
$JO_table = $GnTable["shopcategory"];

$title_page = "상품";

if ($mode=="W") {
	$title_page .= "입력";

	// 옵션은 쿠키에 저장된 값을 보여줌. 다음 입력을 위한것임
	$it[ca_id] = $_COOKIE[ck_ca_id];
	if (!$it[ca_id])
	{
		$sql = " select ca_id from $JO_table order by ca_id limit 1 ";
		$row = sql_fetch($sql);
		if (!$row[ca_id])
			alert("등록된 분류가 없습니다. 우선 분류를 등록하여 주십시오.");
		$it[ca_id] = $row[ca_id];
	}
	//$it[it_maker]  = stripslashes($_COOKIE[ck_maker]);
	//$it[it_origin] = stripslashes($_COOKIE[ck_origin]);

} else if ($mode=="E") {
	$title_page .= "수정";

	$sql = " select * from $PG_table where it_id = '$it_id' ";
	$it = sql_fetch($sql);
	$content  = $it[it_explan];

	if (!$ca_id)
		$ca_id = $it[ca_id];

	$sql = " select * from $JO_table where ca_id = '$ca_id' ";
	$ca = sql_fetch($sql);

	$it_op_count = it_op_count($it[it_opt1]);  //옵션 속성 갯수
	$ex_data = explode("\n",$it[it_opt1]);
	
} else {
	alert("잘못된 경로로 접근하셨습니다.");
}

if (!$it[it_explan_html])
{
	$it[it_explan] = get_text($it[it_explan], 1);
}


$add_list = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='1' and itop_flag != 'x' order by itop_no asc;");
$add_list2 = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='2' and itop_flag != 'x' order by itop_no asc;");
$add_list3 = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='3' and itop_flag != 'x' order by itop_no asc;");

$add_list4 = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='4' and itop_flag != 'x' order by itop_no asc;");

$add_list5 = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='5' and itop_flag != 'x' order by itop_no asc;");

$add_list6 = Get_list_array("Gn_Shop_Add_option","where itop_it_id='".$it[it_id]."' and itop_type='6' and itop_flag != 'x' order by itop_no asc;");



$qstr  = "sca=$sca&sst=$sst&sod=$sod&sfl=$sfl&stx=$stx&ity=$ity&ius=$ius&fmDt=$fmDt&toDt=$toDt&page=$page";
?>
<script type="text/javascript" src="/editor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function option_view(mode) {
		var op_count = document.option_form.option_count.value;
		var option_tot_count = document.option_form.option_tot_count.value;
		var f = document.WriteForm;
		var opt_view=eval(document.getElementById("opt_view"));
		var opt_view2=eval(document.getElementById("opt_view2"));
		var opt_view3=eval(document.getElementById("opt_view3"));
		var opt_view4=eval(document.getElementById("opt_view4"));
		var opt_view5=eval(document.getElementById("opt_view5"));
		var opt_view6=eval(document.getElementById("opt_view6"));
		var opt_view_text=eval(document.getElementById("opt_view_text"));
		if (mode=="1") {
			opt_view.style.display="";
			opt_view2.style.display="";
			opt_view3.style.display="";
			opt_view4.style.display="";
			opt_view5.style.display="";
			opt_view6.style.display="";
		}
		else if (mode=="2") {
			opt_view.style.display="";
			opt_view2.style.display="none";
			opt_view3.style.display="none";
			opt_view4.style.display="none";
			opt_view5.style.display="none";
			opt_view6.style.display="none";
		}
		else {						
			
			opt_view.style.display="none";
			opt_view2.style.display="none";
			opt_view3.style.display="none";
			opt_view4.style.display="none";
			opt_view5.style.display="none";
			opt_view6.style.display="none";
		}
	}
//-->
</SCRIPT>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
	<tr>
		<td height="30" bgcolor="#F5F5F5" style="padding-left:5px;">
			<strong><font color="#004080"><img src="/admin/images/title_icon.gif" width="10" height="9"> <?=$title_page?></font></strong>
		</td>
	</tr>
	<tr>
		<td height="1" bgcolor="#E0E0E0"> </td>
	</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="20"></td></tr>
</table>

<script language='JavaScript' src='./lib/javascript.js'></script>
<form name=WriteForm method=post action="./item_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name="mode" value="<?=$mode?>">
<input type=hidden name="qstr"  value="<?=$qstr?>">
<input type=hidden name="codedup" value="<?=$default[de_code_dup_use]?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="in_inx1" id="in_inx1" value="1">
<input type=hidden name="in_inx2" id="in_inx2" value="1">
<input type=hidden name="in_inx3" id="in_inx3" value="1">
<input type=hidden name="in_inx4" id="in_inx4" value="1">
<input type=hidden name="in_inx5" id="in_inx5" value="1">
<input type=hidden name="in_inx6" id="in_inx6" value="1">
<input type=hidden name="in_inx" value="1">

<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
<colgroup width=100>
<colgroup width="">
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">분류명</td>
		<td>
			<select name="ca_id">
				<option>= 카테고리선택 =
				<?
					// 분류
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
						if($it[ca_id]==$row[ca_id]) $selected = "selected"; else $selected = "";
						$ca_list .= "<option value='$row[ca_id]' $selected>$nbsp$row[ca_name]";
					}
					echo $ca_list;
				?>
			</select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품코드</td>
		<td>
	<? if ($mode == "W") { // 추가 ?>
		<input type=hidden name=it_id value="<?=time()?>"><?=time()?>
        <? if ($default[de_code_dup_use]) { ?><a href='javascript:;' onclick="codedupcheck(document.all.it_id.value)"><img src='./img/btn_code.gif' border=0 align=absmiddle></a><? } ?>
	<? } else { ?>
		<input type=hidden name=it_id value="<?=$it[it_id]?>"><?=$it[it_id]?> |
		<a href='/shop/item.php?it_id=<?=$it_id?>'>보기</a>
		<!--
		|
		<a href='./itemps_list.php?sel_ca_id=<?=$it[ca_id]?>&it_id=<?=$it_id?>'>사용후기</a> |
		<a href='./itemqa_list.php?sel_ca_id=<?=$it[ca_id]?>&it_id=<?=$it_id?>'>상품문의</a>
		-->
	<? } ?>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품명</td>
		<td>
			<input type="text"  name="it_name" value="<?=get_text(cut_str($it[it_name], 250, ""))?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력유형</td>
		<td>
			<input type="checkbox" name="it_gallery" value="1" <?=($it[it_gallery] ? "checked" : "")?>> 갤러리로 사용
		</td>
	</tr>
	-->
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">출력순서</td>
		<td>
        	<select name="it_order">
            	<? for($i=1;$i<=30;$i++){?>
                <option value="<?=$i?>"<?=($i==$it[it_order]||($mode=="W"&& $i=="1"))?" selected":"";?>><?=$i?></option>
                <? }?>
            </select> <span style="color:#ff0000"> * 숫자가 높은것부터 앞에 나옵니다</span>
		</td>
	</tr>
	<? if ($GnShop[use_type1] || $GnShop[use_type2] || $GnShop[use_type3] || $GnShop[use_type4] || $GnShop[use_type5]) { ?>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품유형</td>
		<td>
			<? if ($GnShop[use_type1]) { ?><input type="checkbox" name="it_type1" value="1" <?=($it[it_type1] ? "checked" : "");?>>메인추출상품<? } ?>
			<? if ($GnShop[use_type2]) { ?><input type="checkbox" name="it_type2" value="1" <?=($it[it_type2] ? "checked" : "");?>>신상품<? } ?>
			<? if ($GnShop[use_type3]) { ?><input type="checkbox" name="it_type3" value="1" <?=($it[it_type3] ? "checked" : "");?>>베스트상품<? } ?>
			<? if ($GnShop[use_type4]) { ?><input type="checkbox" name="it_type4" value="1" <?=($it[it_type4] ? "checked" : "");?>>히트상품<? } ?>
			<? if ($GnShop[use_type5]) { ?><input type="checkbox" name="it_type5" value="1" <?=($it[it_type5] ? "checked" : "");?>>사은품제공상품<? } ?>
		</td>
	</tr>
	<? } ?>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">제조사</td>
		<td>
			<input type="text" name="it_maker" value="<?=get_text($it[it_maker])?>" style="height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">원산지</td>
		<td>
			<input type="text" name="it_origin" value="<?=get_text($it[it_origin])?>" style="height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">브랜드</td>
		<td>
			<select name="it_brand">
				<option value="">없음
				<?=get_brand_option($it["it_brand"],"SELECT","it_brand");?>
			</select>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">옵션사용</td>
		<td>
			<input type="radio" name="it_opt_use" value="" <? if (!$it[it_opt_use]) { ?>checked<? } ?> onclick="option_view('')">미사용&nbsp;
			<input type="radio" name="it_opt_use" value="1" <? if ($it[it_opt_use]=="1") { ?>checked<? } ?> onclick="option_view('1')">사용(단일구입옵션)
			 <input type="radio" name="it_opt_use" value="2" <? if ($it[it_opt_use]=="2") { ?>checked<? } ?> onclick="option_view('2')">사용(다중구입옵션)  <input type="checkbox" name="it_opt_use2" value="1" <?=($it[it_opt_use2] == "1")?"checked":"";?>>다중 원가포함
		</td> 
	</tr>
	<tr bgcolor="#FFFFFF" id="opt_view" style="display:<? if (!$it[it_opt_use]) { ?>none;<? } ?>;">
	<!--<tr bgcolor="#FFFFFF" id="opt_view">-->
		<td bgcolor="#F0F0F0" style="padding-left:10px">상품옵션</td>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
							<input type=hidden name="itop_no[]" value="<?=$add_list[0][itop_no]?>">
							<col width="67" />
							<col width="800" />
							<tr align="center" bgcolor="#F6F6F6">
								<td>옵션명1</td>
								<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt1_subject" size="20" class="text" value="<?=get_text($it[it_opt1_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',1)">속성추가+</a></td>
							</tr>
							<tr align="center" bgcolor="#FFFFFF">
								
								<td colspan="2" style="text-align:left; padding-left:50px;">
									<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable1">
										<col width="220" />
										<col width="150" />
										<col />
										<tr>
											<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list [0][itop_opt1]?>"></td>
											<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list [0][itop_stock]?>" onkeyup="stock_add()">개</td>
											<td> 가격 : 
												<select name="it_op_amount_sel[]">
													<option value="+" <?=($add_list [0][itop_amount_op] == "+" || !$add_list [0][itop_amount_op])?"selected":"";?>>+</option>
													<option value="-" <?=($add_list [0][itop_amount_op] == "-")?"selected":"";?>>-</option>
												</select>
												<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list [0][itop_amount]?>" class="text" style="width:100px;"> 원
												<input type="hidden" name="it_op_type[]" value="1">
												&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
											</td>
											<td style="padding-top:4px;">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					<input type=hidden name="itop_no[]" value="<?=$add_list2[0][itop_no]?>">
					<table id="opt_view2" style="display:<? if ($it[it_opt_use] != "1") { ?>none;<? } ?>;" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
							<col width="67" />
							<col width="800" />
							<tr align="center" bgcolor="#F6F6F6">
								<td>옵션명2</td>
								<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt2_subject" size="20" class="text" value="<?=get_text($it[it_opt2_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',2)">속성추가+</a></td>
							</tr>
							<tr align="center" bgcolor="#FFFFFF">
								
								<td colspan="2" style="text-align:left; padding-left:50px;">
									<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable2">
										<col width="220" />
										<col width="150" />
										<col />
										<tr>
											<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list2[0][itop_opt1]?>"></td>
											<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list2[0][itop_stock]?>" onkeyup="stock_add()">개</td>
											<td> 가격 : 
												<select name="it_op_amount_sel[]">
													<option value="+" <?=($add_list2[0][itop_amount_op] == "+" || !$add_list2[0][itop_amount_op])?"selected":"";?>>+</option>
													<option value="-" <?=($add_list2[0][itop_amount_op] == "-")?"selected":"";?>>-</option>
												</select>
												<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list2[0][itop_amount]?>" class="text" style="width:100px;"> 원
												<input type="hidden" name="it_op_type[]" value="2">
												&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list2[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list2[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
											</td>
											<td style="padding-top:4px;">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>

						</table>

					<input type=hidden name="itop_no[]" value="<?=$add_list3[0][itop_no]?>">
					<table id="opt_view3" style="display:<? if ($it[it_opt_use] != "1") { ?>none;<? } ?>;" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
							<col width="67" />
							<col width="800" />
							<tr align="center" bgcolor="#F6F6F6">
								<td>옵션명3</td>
								<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt3_subject" size="20" class="text" value="<?=get_text($it[it_opt3_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',3)">속성추가+</a></td>
							</tr>
							<tr align="center" bgcolor="#FFFFFF">
								
								<td colspan="2" style="text-align:left; padding-left:50px;">
									<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable3">
										<col width="220" />
										<col width="150" />
										<col />
										<tr>
											<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list3[0][itop_opt1]?>"></td>
											<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list3[0][itop_stock]?>" onkeyup="stock_add()">개</td>
											<td> 가격 : 
												<select name="it_op_amount_sel[]">
													<option value="+" <?=($add_list3[0][itop_amount_op] == "+" || !$add_list3[0][itop_amount_op])?"selected":"";?>>+</option>
													<option value="-" <?=($add_list3[0][itop_amount_op] == "-")?"selected":"";?>>-</option>
												</select>
												<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list3[0][itop_amount]?>" class="text" style="width:100px;"> 원
												<input type="hidden" name="it_op_type[]" value="3">
												&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list3[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list3[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
											</td>
											<td style="padding-top:4px;">&nbsp;</td>
										</tr>
									</table>
								</td>
							</tr>

						</table>


						<input type=hidden name="itop_no[]" value="<?=$add_list4[0][itop_no]?>">
						<table id="opt_view4" style="display:<? if ($it[it_opt_use] != "1") { ?>none;<? } ?>;" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
								<col width="67" />
								<col width="800" />
								<tr align="center" bgcolor="#F6F6F6">
									<td>옵션명4</td>
									<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt4_subject" size="20" class="text" value="<?=get_text($it[it_opt4_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',4)">속성추가+</a></td>
								</tr>
								<tr align="center" bgcolor="#FFFFFF">
									
									<td colspan="2" style="text-align:left; padding-left:50px;">
										<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable4">
											<col width="220" />
											<col width="150" />
											<col />
											<tr>
												<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list4[0][itop_opt1]?>"></td>
												<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list4[0][itop_stock]?>" onkeyup="stock_add()">개</td>
												<td> 가격 : 
													<select name="it_op_amount_sel[]">
														<option value="+" <?=($add_list4[0][itop_amount_op] == "+" || !$add_list4[0][itop_amount_op])?"selected":"";?>>+</option>
														<option value="-" <?=($add_list4[0][itop_amount_op] == "-")?"selected":"";?>>-</option>
													</select>
													<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list4[0][itop_amount]?>" class="text" style="width:100px;"> 원
													<input type="hidden" name="it_op_type[]" value="4">
												&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list4[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list4[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
												</td>
												<td style="padding-top:4px;">&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>

							</table>

							<input type=hidden name="itop_no[]" value="<?=$add_list5[0][itop_no]?>">
							<table id="opt_view5" style="display:<? if ($it[it_opt_use] != "1") { ?>none;<? } ?>;" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
									<col width="67" />
									<col width="800" />
									<tr align="center" bgcolor="#F6F6F6">
										<td>옵션명5</td>
										<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt5_subject" size="20" class="text" value="<?=get_text($it[it_opt5_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',5)">속성추가+</a></td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										
										<td colspan="2" style="text-align:left; padding-left:50px;">
											<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable5">
												<col width="220" />
												<col width="150" />
												<col />
												<tr>
													<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list5[0][itop_opt1]?>"></td>
													<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list5[0][itop_stock]?>" onkeyup="stock_add()">개</td>
													<td> 가격 : 
														<select name="it_op_amount_sel[]">
															<option value="+" <?=($add_list5[0][itop_amount_op] == "+" || !$add_list5[0][itop_amount_op])?"selected":"";?>>+</option>
															<option value="-" <?=($add_list5[0][itop_amount_op] == "-")?"selected":"";?>>-</option>
														</select>
														<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list5[0][itop_amount]?>" class="text" style="width:100px;"> 원
														<input type="hidden" name="it_op_type[]" value="5">
														&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list5[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list5[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
													</td>
													<td style="padding-top:4px;">&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>

								</table>

							<input type=hidden name="itop_no[]" value="<?=$add_list6[0][itop_no]?>">
							<table id="opt_view6" style="display:<? if ($it[it_opt_use] != "1") { ?>none;<? } ?>;" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
									<col width="67" />
									<col width="800" />
									<tr align="center" bgcolor="#F6F6F6">
										<td>옵션명6</td>
										<td bgcolor="#ffffff" style="text-align:left;"><input type="text" name="it_opt6_subject" size="20" class="text" value="<?=get_text($it[it_opt6_subject])?>"> &nbsp;<a href="javascript:;" onclick="op_add('',6)">속성추가+</a></td>
									</tr>
									<tr align="center" bgcolor="#FFFFFF">
										
										<td colspan="2" style="text-align:left; padding-left:50px;">
											<table width="100%" cellpadding="0" cellspacing="0" border="0" id="addTable6">
												<col width="220" />
												<col width="150" />
												<col />
												<tr>
													<td><b>┗</b> 속성 : <input type="text" name="it_op_name[]" id="it_op_name[]" class="text" style="width:150px;" value="<?=$add_list6[0][itop_opt1]?>"></td>
													<td> 재고 : <input type="text" name="it_op_stock[]" id="it_op_stock[]" class="text" style="width:50px;" value="<?=$add_list6[0][itop_stock]?>" onkeyup="stock_add()">개</td>
													<td> 가격 : 
														<select name="it_op_amount_sel[]">
															<option value="+" <?=($add_list6[0][itop_amount_op] == "+" || !$add_list6[0][itop_amount_op])?"selected":"";?>>+</option>
															<option value="-" <?=($add_list6[0][itop_amount_op] == "-")?"selected":"";?>>-</option>
														</select>
														<input type="text" name="it_op_amount[]" id="it_op_amount[]" value="<?=$add_list6[0][itop_amount]?>" class="text" style="width:100px;"> 원
														<input type="hidden" name="it_op_type[]" value="6">
														&nbsp;&nbsp;<select name="it_op_flag[]"><option value="" <?if($add_list6[0][itop_flag]==''){?>selected<?}?>>보기</option><option value="h" <?if($add_list6[0][itop_flag]=='h'){?>selected<?}?>>숨기기</option></select>
													</td>
													<td style="padding-top:4px;">&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>

								</table>



					</td>
				</tr>
				<tr>
					<td style="padding:5px,0px;"><span id="opt_view_text"></span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">가격/재고 설정</td>
		<td>
			<table width="100%" cellpadding=0 cellspacing=0>
				<tr>
					<td width="8%">정가</td>
					<td width="92%"><input type=text class=ed name=it_pay size=8 value='<?=$it[it_pay]?>' style='text-align:right; background-color:#DDE6FE;'></td>
				</tr>
				<tr>
					<td>할인가</td>
					<td><input type=text class=ed name=it_epay size=8 value='<?=$it[it_epay]?>' style='text-align:right; background-color:#DDE6FE;'> (<font color=red>할인가</font>를 입력하면 모든 가격및 할인율보다 우선 적용됩니다.)</td>
				</tr>
				<tr>
					<td>재고수량</td>
					<td><input type=text class=ed name=it_stock size=8 value='<? echo $it[it_stock] ?>' style='text-align:right;'> 개</td>
				</tr>
				<!--
				<tr>
					<td>적립포인트</td>
					<td><input type=text class=ed name=it_point size=8 value='<? echo $it[it_point] ?>' style='text-align:right;'> 점</td>
				</tr>
				-->
			</table>
		</td>
	</tr>
	<!--
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">요약설명</td>
		<td>
			<input type="text"  name="it_basic" value="<?=get_text($it[it_basic])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	-->
	<!--tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">추가링크1</td>
		<td>
			<input type="text"  name="it_link1" value="<?=get_text($it[it_link1])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">추가링크2</td>
		<td>
			<input type="text"  name="it_link2" value="<?=get_text($it[it_link2])?>" style="width:100%; height:19px;" class="text">
		</td>
	</tr-->
	<!--tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">전화문의</td>
		<td>
			<input type="checkbox" name='it_tel_inq' <? echo ($it[it_tel_inq]) ? "checked" : ""; ?> value='1'> 예 
            <font color=red>체크시 구입 불가능합니다</font>
		</td>
	</tr-->
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">판매</td>
		<td>
			<input type="checkbox" name='it_use' <? echo ($it[it_use] || $mode=="W") ? "checked" : ""; ?> value='1'> 예
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">관련상품등록</td>
		<td><input type="text" name="it_other" value="<?=$it[it_other]?>" maxlength="120" style="width:40%; height:19px;" class="text"> (상품코드를 공백없이 <font color=red><b>,</b></font> 로 구분해서 입력해주세요.)</td>
	</tr>
</table>
<br>
<table width="99%" align="center" border="0" cellpadding="3" cellspacing="1" bgcolor="#E0E0E0">
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 상품설명</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2">
			<input type="hidden" name="it_explan_html" value="1">
			<textarea name="it_explan" id="it_explan" rows="20" style="width:100%;" class="text"><?=$it[it_explan]?></textarea>
            <font color="#FF9933">
            에디터 사용시 가로 670픽셀 넘지 않도록 엔터로 조절해 주세요
            <br />
            이미지도 670필셀 넘지 않도록 올려 주세요(너무 큰 이미지는 로딩시간이 길어 질 수 있습니다)
            </font>
            <br />
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2" style="padding-left:10px">
			<b> * 상품 이미지 등록</b>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="8%" bgcolor="#F0F0F0" style="padding-left:10px">이미지(대) 1<br /><font color="#FF0000">대표이미지</font></td>
		<td width="92%">
			<input type="file" name="it_limg1" style="width:90%; height:19px;" class="text">
			<?
			$limg1 = "/shop/data/item/{$it[it_id]}_l1";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$limg1)) {
				$limg1= img_resize_tag("/shop/data/item/{$it[it_id]}_l1",30,30);
				echo "{$limg1}<input type=checkbox name=it_limg1_del value='1'>삭제";
			}
			?>
			<? if (function_exists("imagecreatefromjpeg")) { echo "<input type=hidden name=createimage value='1'>"; } ?>
		</td>
	</tr>
<? for ($i=2; $i<=4; $i++) { // 이미지(대)는 5개 ?>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#F0F0F0" style="padding-left:10px">이미지(대) <?=$i?><br /><font color="#FF9900">더보기 이미지</font></td>
		<td>
			<input type="file" name="it_limg<?=$i?>" style="width:90%; height:19px;" class="text">
			<?
			$limg = "/shop/data/item/{$it[it_id]}_l{$i}";
			if (file_exists($_SERVER["DOCUMENT_ROOT"].$limg)) {
				$limg= img_resize_tag("/shop/data/item/{$it[it_id]}_l{$i}",30,30);
				echo "{$limg}<input type=checkbox name=it_limg{$i}_del value='1'>삭제";
			}
			?>
		</td>
	</tr>
<? } ?>
</table>

<table width="100%">
	<tr>
		<td align=center height=50>
			<input type=image src="/btn/btn_ok.gif" border=0>
			<a href="./item_list.php?<?=$qstr?>"><img src="/btn/btn_list.gif" border=0></a>
		</td>
	</tr>
</table>

</form>
<form name="option_form">
<input type="hidden" name="option_count" value="1">
<input type="hidden" name="option_tot_count" value="1">
</form>
<script language='javascript'>
var f = document.WriteForm;
var op_count = document.option_form.option_count.value;

function codedupcheck(id)
{
    if (!id) {
        alert('상품코드를 입력하십시오.');
        f.it_id.focus();
        return;
    }

    window.open("./codedupcheck.php?it_id="+id+"&frmname=WriteForm", "hiddenframe");
}

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }
    if (f.mode.value == "W") {
        if (f.codedup.value == '1') {
            alert("코드 중복검사를 하셔야 합니다.");
            return false;
        }
    }
    oEditors[0].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용된다.
}

/*
function op_add(){
	var result="";
	var option_tot_count = document.option_form.option_tot_count.value;

	result += "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
	result += "<col width=\"220\" />";
	result += "<col width=\"150\" />";
	result += "<col width=\"200\" />";
	result += "<tr><td>";
	result += "<b>┗</b> 속성 : <input type=\"text\" name=\"it_op_name[]\" id=\"it_op_name[]\" class=\"text\" style=\"width:150px;\"></td><td> 재고 : <input type=\"text\" name=\"it_op_stock[]\" id=\"it_op_stock[]\" class=\"text\" style=\"width:50px;\" onkeyup=\"stock_add()\">개</td><td> 가격 : <select name=\"it_op_amount_sel[]\" id=\"it_op_amount_sel[]\"><option value=\"+\">+</option><option value=\"-\">-</option></select> <input type=\"text\" name=\"it_op_amount[]\" id=\"it_op_amount[]\" class=\"text\" style=\"width:100px;\"> 원</td><td style=\"padding-top:4px;\"> <a href=\"javascript:;\" onclick=\"op_sub('"+op_count+"')\">삭제</td></tr></table>";

	document.getElementById("op_html_"+op_count).innerHTML=result;
	op_count++;
	option_tot_count++;
	document.option_form.option_count.value = op_count;
	document.option_form.option_tot_count.value = option_tot_count;
}
*/

function op_add(id,op_type){
	var oTbl = document.getElementById("addTable"+op_type);
	var add_inx = document.getElementById("in_inx"+op_type).value;
	var r_inx = add_inx;

	var oRow = oTbl.insertRow(r_inx);
	oRow.onmouseover=function(){oTbl.clickedRowIndex=this.rowIndex}; 

		  if ((navigator.appName).indexOf("Microsoft")!=-1) {
			  var oCell1 = oRow.insertCell();
			  var oCell2 = oRow.insertCell();
			  var oCell3 = oRow.insertCell();
		  }else{
			var oCell1 = oRow.insertCell();
			var oCell2 = oRow.insertCell();
			var oCell3 = oRow.insertCell();
		  }
	//oCell4.style.padding-top="30px;";
	var result1="";
	var result2="";
	var result3="";
	var option_tot_count = document.option_form.option_tot_count.value;

	result1 = "<b>┗</b> 속성 : <input type=\"text\" name=\"it_op_name[]\" id=\"it_op_name"+op_type+id+"\" class=\"text\" style=\"width:150px;\">";
	result2 = "재고 : <input type=\"text\" name=\"it_op_stock[]\" id=\"it_op_stock"+op_type+id+"\" class=\"text\" style=\"width:50px;\" onkeyup=\"stock_add()\">개";
	result3 = "가격 : <select name=\"it_op_amount_sel[]\" id=\"it_op_amount_sel"+op_type+id+"\"><option value=\"+\">+</option><option value=\"-\">-</option></select> <input type=\"text\" name=\"it_op_amount[]\" id=\"it_op_amount"+op_type+id+"\" class=\"text\" style=\"width:100px;\"> 원 &nbsp; <input type='hidden' name='it_op_type[]' value="+op_type+"><select name=\"it_op_flag[]\" id=\"it_op_flag"+op_type+id+"\"><option value=\"\">보기</option><option value=\"h\">숨기기</option></select><a href=\"javascript:;\" onclick=\"removeRow('"+op_type+"') \">삭제<input type='hidden' name='itop_no[]' id=\"itop_no"+op_type+id+"\">";


		  if ((navigator.appName).indexOf("Microsoft")!=-1) {
			oCell3.innerHTML=result3;
			oCell2.innerHTML=result2;
			oCell1.innerHTML=result1;
		  }else{
			oCell1.innerHTML=result1;
			oCell2.innerHTML=result2;
			oCell3.innerHTML=result3;		  
		  }

		  add_inx++;
		  document.getElementById("in_inx"+op_type).value = add_inx;
}

function removeRow(op_type) {
	var r_inx = document.getElementById("in_inx"+op_type).value;
	oTbl = document.getElementById("addTable"+op_type);
	oTbl.deleteRow(oTbl.clickedRowIndex);
	r_inx--;
	document.getElementById("in_inx"+op_type).value = r_inx;
	stock_add();
}


function stock_add(){
	var obj = document.getElementsByName("it_op_stock[]");
	var add_stock = 0;
	var stock;
	for(i=0; i<obj.length; i++){
		if(!obj[i].value){
			//obj[i].value = 0;
			stock=0;
		}else{
			stock = obj[i].value;
		}
		add_stock = parseInt(add_stock) + parseInt(stock);
	}
	document.WriteForm.it_stock.value=parseInt(add_stock);

}

<?if(count($add_list) > 1){?>
	 <?for($i=1; $i < count($add_list) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list[$i][itop_type]?><?=$i?>").value = "<?=$add_list[$i][itop_no]?>";
	<? } ?>
<? } ?>

<?if(count($add_list2) > 1){?>
	 <?for($i=1; $i < count($add_list2) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list2[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list2[$i][itop_type]?><?=$i?>").value = "<?=$add_list2[$i][itop_no]?>";
	<? } ?>
<? } ?>

<?if(count($add_list3) > 1){?>
	 <?for($i=1; $i < count($add_list3) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list3[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list3[$i][itop_type]?><?=$i?>").value = "<?=$add_list3[$i][itop_no]?>";
	<? } ?>
<? } ?>

<?if(count($add_list4) > 1){?>
	 <?for($i=1; $i < count($add_list4) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list4[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list4[$i][itop_type]?><?=$i?>").value = "<?=$add_list4[$i][itop_no]?>";
	<? } ?>
<? } ?>

<?if(count($add_list5) > 1){?>
	 <?for($i=1; $i < count($add_list5) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list5[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list5[$i][itop_type]?><?=$i?>").value = "<?=$add_list5[$i][itop_no]?>";
	<? } ?>
<? } ?>

<?if(count($add_list6) > 1){?>
	 <?for($i=1; $i < count($add_list6) ; $i++){?>
		op_add("<?=$i?>","<?=$add_list6[$i][itop_type]?>");
		document.getElementById("it_op_name<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_opt1]?>";
		document.getElementById("it_op_stock<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_stock]?>";
		document.getElementById("it_op_amount_sel<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_amount_op]?>";
		document.getElementById("it_op_amount<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_amount]?>";
		document.getElementById("it_op_flag<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_flag]?>";
		document.getElementById("itop_no<?=$add_list6[$i][itop_type]?><?=$i?>").value = "<?=$add_list6[$i][itop_no]?>";
	<? } ?>
<? } ?>

document.WriteForm.it_name.focus();
</script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "it_explan",
	sSkinURI: "/editor/SmartEditor3Skin.html",	
	htParams : {bUseToolbar : true,
		fOnBeforeUnload : function(){
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["it_explan"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["it_explan"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["it_explan"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("it_explan").value를 이용해서 처리하면 됩니다.
	
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["it_explan"].setDefaultFont(sDefaultFont, nFontSize);
}

function insertIMG(fname){
  var sHTML = "<img src='" + fname + "' border='0'>";
  oEditors.getById["it_explan"].exec("PASTE_HTML", [sHTML]);
  //alert("===>" + sHTML);
}
</script>