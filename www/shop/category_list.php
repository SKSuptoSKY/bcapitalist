<?
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/admin/shop/lib/lib.php";
?>
<table width="240" border="0" cellspacing="0" cellpadding="0">
    <tr>
    	<td><img src="/images/shop/cate_01.jpg" width="240" height="14" /></td>
    </tr>
    <tr>
      <td style="background:url(/images/shop/cate_02.jpg) repeat-y;" align="center"><table width="158" border="0" cellspacing="0" cellpadding="0">
        <?
					$CategoryFirstResult = sql_query("select ca_id,ca_name from {$GnTable[shopcategory]} where length(ca_id)=2 and ca_use='1' order by ca_id ASC");
					for($cf=0;$CategoryFirst=mysql_fetch_array($CategoryFirstResult);$cf++){ //first category
						if($cf!=0) echo "<tr><td height=\"1\" bgcolor=\"#ededed\"></td></tr>\n";
				?>
        <tr>
          <td height="24" valign="middle"><a href="/shop/list.php?ca_id=<?=$CategoryFirst[ca_id]?>" >
            <?//=$CategoryFirst[ca_name]?>
            <img src="/images/shop/menu_<? if (substr($CategoryFirst[ca_id], 0, 2)==substr($ca_id, 0, 2)) { echo $CategoryFirst[ca_id]."_r"; } else { echo $CategoryFirst[ca_id]; } ?>.jpg" />
            </a>  
<? if (substr($CategoryFirst[ca_id], 0, 2)==substr($ca_id, 0, 2)) { ?>
                 <table width="100%" border="0" cellpadding="0" cellspacing="1" style="border:solid 1px #ededed;filter:Alpha(Opacity=80)" bgcolor="#FFFFFF">
                    <?       
										$CategorySecondResult = sql_query("select ca_id,ca_name from {$GnTable[shopcategory]} where length(ca_id)=4 and ca_id like '".$CategoryFirst[ca_id]."%' and ca_use='1' order by ca_id ASC");
										for($cs=0;$CategorySecond=mysql_fetch_array($CategorySecondResult);$cs++){
											if($cs!=0) echo "<tr><td height=\"1\" bgcolor=\"#ededed\"></td></tr>\n";
									?>
                    <tr>
                      <td style="padding:3px 0 3px 10px;"><a href="/shop/list.php?ca_id=<?=$CategorySecond[ca_id]?>" ><font color="#333333">
                        <?=$CategorySecond[ca_name]?>
                      </font></a></td>
                    </tr>
                    <? }?>
                  </table>
  <? } ?>
              
              </td>
        </tr>
        <? }?>
      </table></td>
    </tr>
    <tr>
      <td><img src="/images/shop/cate_03.jpg" width="240" height="11" /></td>
    </tr>
</table>
