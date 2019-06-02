<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$charset?>">
<title><?=$subject?></title>
</head>

<style>
body, th, td, form, input, select, text, textarea, caption { font-size: 12px; font-family:굴림;}
.line {border: 1px solid #dfdfdf;}
</style>

<body leftmargin="0" topmargin="20" marginwidth="0" marginheight="20">
<table width=600 cellpadding=1 cellspacing=1 bgcolor="dfdfdf">
  <tr> 
    <td colspan=4 bgcolor=#FFFFFF> <table width=100% cellpadding=3 cellspacing=0>
        <tr> 
          <td align=center> <table width=100% cellpadding=10 cellspacing=0>
              <tr> 
                <td height=30><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="18%"><img src="<?="$default[shop_url]/$mail_skin"?>/main_top_img.jpg" width="270" height="154"></td>
          <td width="82%"><div align="center"><img src="<?="$default[shop_url]/$mail_skin"?>/main_top_text.jpg" width="241" height="84"></div></td>
        </tr>
      </table></td>
              </tr>
              <tr> 
                <td bgcolor=#FFFFFF> <table width=100% cellpadding=1 cellspacing=0 bgcolor=#DFDFDF>
                    <tr> 
                      <td align=center> <table width=100% cellpadding=20 cellspacing=0 bgcolor=#F8F8F8>
                          <tr> 
                            <td style='line-height:150%'> 
                              <?=$content?>
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
