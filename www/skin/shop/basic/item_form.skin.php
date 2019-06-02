<form name=fitemform method=post action="./item_update.php" onsubmit="return fitemformcheck(this)" enctype="MULTIPART/FORM-DATA" autocomplete="off" style="margin:0px;">
<input type=hidden name=mode           value="<?=$mode?>">
<input type=hidden name=sca  value="<?=$sca?>">
<input type=hidden name=sst  value="<?=$sst?>">
<input type=hidden name=sod  value="<?=$sod?>">
<input type=hidden name=sfl  value="<?=$sfl?>">
<input type=hidden name=stx  value="<?=$stx?>">
<input type=hidden name=page value="<?=$page?>">
<input type=hidden name=it_id value="<?=$it[it_id]?>">
<input type=hidden name=it_sell_email value="<?=$it[it_sell_email]?>">
<input type=hidden name=it_seller value="<?=$it[it_seller]?>">
<input type=hidden name=it_use value="<?=$it[it_use]?>">

<table width="695" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="6%"><img src="images/title_productup.gif" width="106" height="36"></td>
          <td width="94%" align="right" background="/mall/images/title_back.gif"><img src="/mall/images/title_blit.gif" width="13" height="13" align="absmiddle"> <a href="/main.php">홈으로</a> &gt; 용품몰  &gt; <font color="#0080C0"><strong>용품등록하기</strong></font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="10"> </td>
  </tr>
  <tr> 
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/title_viewinfor5.gif" width="182" height="33"></td>
      </tr>
      <tr>
        <td height="1" bgcolor="#E6E6E6"> </td>
      </tr>
      <tr>
        <td height="8"> </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E7E7E7">
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ제품분류</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;">
				<select name="ca_id">
					<option>= 카테고리선택 =
					<?
						// 분류
						$ca_list  = "";
						$sql = " select * from $cate_tbl order by ca_id ";
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
			<tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ제품코드</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;">
					<input type=hidden name=it_id value="<?=$it[it_id]?>">
					<?=$it[it_id]?>
			  </td>
            </tr>
			<tr>
              <td width="21%" height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ제품명</strong></td>
              <td width="79%" bgcolor="#FFFFFF" style="padding-left:5px;"><input type="text" name="it_name" value="<?=get_text(cut_str($it[it_name], 250, ""))?>" style="WIDTH:400PX; font-size:9pt; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ상품가격</strong></td>
              <td width="79%" bgcolor="#FFFFFF" style="padding-left:5px;"><input type="text" name=it_pay value='<?=$it[it_pay]?>' style="WIDTH:100PX; font-size:9pt; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ판매자</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;"><?=$it[it_seller]?></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ제조사</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;"><input type="text" name=it_maker value='<?=$it[it_maker]?>' style="WIDTH:100PX; font-size:9pt; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ브랜드</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;"><input type="text" name="it_origin" value='<?=$it[it_origin]?>' style="WIDTH:100PX; font-size:9pt; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"></td>
            </tr>
            <tr>
              <td height="25" bgcolor="#FAFAFA" style="padding-left:5px;"><strong>ㆍ판매수량</strong></td>
              <td bgcolor="#FFFFFF" style="padding-left:5px;">
                <input type="text" name=it_stock value='<?=$it[it_stock]?>' style="WIDTH:50PX; font-size:9pt; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff">
        개 </td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="images/title_viewinfor1.gif" width="212" height="33"></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9" style="padding:5px; border:1px solid #E0E0E0"><textarea name="it_explan" style="WIDTH:100%; font-size:9pt; HEIGHT:150PX; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"><?=$it[it_explan]?></textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="images/title_viewinfor2.gif" width="235" height="33"></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9" style="padding:5px; border:1px solid #E0E0E0"><textarea name="it_explanA" style="WIDTH:100%; font-size:9pt; HEIGHT:150PX; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"><?=$it[it_explanA]?></textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="images/title_viewinfor3.gif" width="137" height="33"></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9" style="padding:5px; border:1px solid #E0E0E0"><textarea name="it_explanB" style="WIDTH:100%; font-size:9pt; HEIGHT:150PX; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"><?=$it[it_explanB]?></textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="images/title_viewinfor4.gif" width="144" height="33"></td>
        </tr>
        <tr> 
          <td height="1" bgcolor="#E6E6E6"> </td>
        </tr>
        <tr> 
          <td height="8"> </td>
        </tr>
        <tr> 
          <td bgcolor="#F9F9F9" style="padding:5px; border:1px solid #E0E0E0"><textarea name="it_explanC" style="WIDTH:100%; font-size:9pt; HEIGHT:150PX; BORDER-RIGHT:#d3d3d3 1px solid; BORDER-TOP: #d3d3d3 1px solid; BORDER-LEFT: #d3d3d3 1px solid; BORDER-BOTTOM: #d3d3d3 1px solid;  BACKGROUND-COLOR: #ffffff"><?=$it[it_explanC]?></textarea></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
			  <td><img src="images/title_viewinfor6.gif" border=0></td>
			</tr>
			<tr> 
			  <td height="1" bgcolor="#E6E6E6"> </td>
			</tr>
			<tr> 
			  <td height="8"> </td>
			</tr>
	  </table>

		<table width=95% cellpadding=0 cellspacing=0 align=center>
		<colgroup width=15%></colgroup>
		<colgroup width=85% bgcolor=#FFFFFF></colgroup>
		<tr>
			<td>이미지(대)<br>280*280</td>
			<td colspan=3>
				<input type=file class=ed name=it_limg1 size=40>
				<?
				$limg1 = $DOCUMENT_ROOT."/shop/data/item/{$it[it_id]}_l1";
				if (file_exists($limg1)) {
					$size = getimagesize($limg1);
					echo "<input type=checkbox name=it_limg1_del value='1'>삭제";
					echo "<div id='limg1' style='left:0; top:0; z-index:+1; display:none; position:absolute;'><img src='$limg1' border=1></div>";
				}
				?>

				<?
				if (function_exists("imagecreatefromjpeg")) {
					//echo "<input type=checkbox name=createimage value='1'> <FONT COLOR=FF6600>이미지(중), 이미지(소)를 자동생성 하시려면 체크하세요. JPG 파일만 가능합니다.</FONT> ";
					echo "<br><input type=checkbox name=createimage value='1'> 중, 소 이미지를 자동으로 생성하시는 경우에 체크하세요. (JPG 파일만 가능)";
				}
				?>
			</td>
		</tr>
		<tr class=ht>
			<td>이미지(중)<br>85*85</td>
			<td colspan=3>
				<input type=file class=ed name=it_mimg size=40>
				<?
				$mimg = $DOCUMENT_ROOT."/shop/data/item/{$it[it_id]}_m";
				if (file_exists($mimg)) {
					$size = getimagesize($mimg);
					echo "<input type=checkbox name=it_mimg_del value='1'>삭제";
					echo "<div id='mimg' style='left:0; top:0; z-index:+1; display:none; position:absolute;'><img src='$mimg' border=1></div>";
				}
				?>
			</td>
		</tr>
		<tr class=ht>
			<td>이미지(소)<br>60*60</td>
			<td colspan=3>
				<input type=file class=ed name=it_simg size=40>
				<?
				$simg = $DOCUMENT_ROOT."/shop/data/item/{$it[it_id]}_s";
				if (file_exists($simg)) {
					$size = getimagesize($simg);
					echo "<input type=checkbox name=it_simg_del value='1'>삭제";
					echo "<div id='simg' style='left:0; top:0; z-index:+1; display:none; position:absolute;'><img src='$simg' border=1></div>";
				}
				?>
			</td>
		</tr>

		<? for ($i=2; $i<=5; $i++) { // 이미지(대)는 5개 ?>
		<tr class=ht>
			<td>이미지(대) <?=$i?></td>
			<td colspan=3>
				<input type=file class=ed name=it_limg<?=$i?> size=40>
				<?
				$limg = $DOCUMENT_ROOT."/shop/data/item/{$it[it_id]}_l{$i}";
				if (file_exists($limg)) {
					$size = getimagesize($limg);
					echo "<input type=checkbox name=it_limg{$i}_del value='1'>삭제";
					echo "<span id=limg{$i} style='left:0; top:0; z-index:+1; display:none; position:absolute;'><img src='$limg' border=1></div>";
				}
				?>
			</td>
		</tr>
		<? } ?>
		</table>

	</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td align="center"><input type=image src="/btn/upload_btn.gif" width="90" height="26">  <a href="./list.php"><img src="/btn/cancle_btn.gif" width="90" height="26"></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<script language='javascript'>
var f = document.fitemform;

function fitemformcheck(f)
{
    if (!f.ca_id.value) {
        alert("기본분류를 선택하십시오.");
        f.ca_id.focus();
        return false;
    }
    return true;
}

document.fitemform.it_name.focus();
</script>