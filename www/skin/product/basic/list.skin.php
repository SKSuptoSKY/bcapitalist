<table width="700" cellpadding="0" cellspacing="0" border="0">
<!-- 제품 리스트 -->
<tr>
  <td style="padding-top:15px;" align="left">
    <!-- 리스트1 -->
  
    <table cellpadding="0" cellspacing="0">
    <tr>
    <?
    for($i=0; $i<$list_count; $i++) {
    if ($i%4==0) {
    echo "</tr><tr>";
    }
    if ($i) {
    $td_style="style='padding-left:35px;'";
    }
    else {
    $td_style="style='padding-left:15px;'";
    }
    ?>
    <td <?=$td_style?>
      align="center">
    
      <table cellpadding="0" cellspacing="0">
      <tr>
      <td>
        <table width="<?=$GnProd[simg_width]+2?>" height="<?=$GnProd[simg_height]+2?>" border="1" cellpadding="0" cellspacing="0" bordercolor="#cfcfcf" style="border-collapse:collapse;">
        <tr>
        <td align="center"><a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><?=$list[$i][list_img]?></a></td>
        </tr>
        </table>
      </td>
      </tr>
      <? if ($item_type[$i]) { ?>
      <tr>
      <td align="center" style="padding-top:5px;"><?=$item_type[$i]?></td>
      </tr>
      <? } ?>
      <tr>
      <td align="center" style="padding-top:5px; color:#4c4c4c; font-size:13px; font-weight:bold;"><a href="./item.php?it_id=<?=$list[$i][it_id]?>&<?=$qstr?>"><font color="#555555"><?=cut_str($list[$i][it_name],17,"...")?></font></a></td>
      </tr>
      <tr>
      <td style="color:#a20d1a; font-size:11px;" align="center">[<?=number_format($list[$i][it_pay])?>원]</td>
      </tr>
      </table>
      
    </td>
    <? } ?>
    </tr>
    </table>
    
    <!-- //리스트1 -->
  </td>
  </tr>
  <? if (!$total_count) { ?>
  <tr>
  <td height="100" align="center" colspan="20">검색된 상품이 없습니다.</td>
  </tr>
  <? } ?>
  <tr>
  <td align="center" style="color:#282828; padding-top:5px;">
  
    <table cellpadding="0" cellspacing="0">
    <tr>
    <td><?=get_paging($rows, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?></td>
    </tr>
    </table>
    
  </td>
  </tr>
  <!-- //제품 리스트 -->
  </table>
  
  <!-- //라이트 -->
