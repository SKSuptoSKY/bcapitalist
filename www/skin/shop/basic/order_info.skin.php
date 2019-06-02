<style type="text/css">
<!--
.Tb_line { border-bottom: 1px solid #999999 }
.T_icon { font-size:11px; color:red }
-->
</style>
<table width="725" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td width="725" style="padding:0 0 0 6px;">
    <table width="713" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td width="713" height="20" class="naviall"><img src="<?=$GnShop["skin_url"]?>/images/add_icon.gif"><a href="../main.php">&nbsp;HOME</a> > <span class="navi2">주문하기</span></td>
     </tr>
     <tr>
      <td height="1" bgcolor="b6b6b6"></td>
     </tr>
    </table>
   </td>
   </tr>
   <tr>
    <td height="20">&nbsp;</td>
   </tr>
   <tr>
    <td><img src="/images/shop/list_title_7t.jpg" width="254" height="24"></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
   </tr>
   <tr>
     <td style="padding:0 6px 0 6px;" align="center">
	 <table width="713" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr><td height="30"><span class="T_icon">▶</span> <strong>결제정보</strong></td>
				</tr>
<form name=forderform method=post action="./order_receipt.php" onsubmit="return forderform_check(this);">
<input type=hidden name=od_amount    value='<? echo $tot_sell_amount ?>'>
<input type=hidden name=od_send_cost value='<? echo $send_cost ?>'>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
              <tr>
                <td width="21%" height="30" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ결제방법</td>
                <td width="79%" style="padding-left:5px;"><input name='radiobutton' type='radio' class='radd' value='radiobutton' /> 무통장입금&nbsp;
				<input name='radiobutton' type='radio' class='radd' value='radiobutton' /> 현금영수증&nbsp;<input name='radiobutton' type='radio' class='radd' value='radiobutton' /> 세금계산서 발행(사업자)

				  </td>
              </tr>
              <tr>
                <td height="2" colspan="2" bgcolor="#E7E7E7"> </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="8"> </td>
        </tr>
        <tr>
          <td bgcolor="#F9F9F9"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
              </tr>
              <tr>
                <td width="144" height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ회사명</td>
                <td width="150" style="padding-left:5px;"><input name="" type="text" id="getname"  style="width:100px;" maxlength="20"></td>
                <td width="139" style="padding-left:5px;">ㆍ업태/종류</td>
                <td width="253" style="padding-left:5px;"><input name="" type="text" id="getname"  style="width:100px;" maxlength="20"></td>
              </tr>
              <tr bgcolor="#E7E7E7">
                <td height="1" colspan="4"> </td>
              </tr>
              <tr>
                <td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ대표자성명</td>
                <td style="padding-left:5px;"> <input name="" type="text" id="getname"  style="width:100px;" maxlength="20"></td>
                <td style="padding-left:5px;">ㆍ사업자등록번호</td>
                <td style="padding-left:5px;"><input name="" type="text" id="getname"  style="width:50px;">-<input name="" type="text" id="getname"  style="width:30px;">-<input name="" type="text" id="getname"  style="width:70px;"></td>
              </tr>
              <tr bgcolor="#E7E7E7">
                <td height="1" colspan="4"> </td>
              </tr>
              <tr>
                <td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ품목</td>
                <td style="padding-left:5px;"> <input name="" type="text" id="getname"  style="width:100px;" maxlength="20"></td>
                <td style="padding-left:5px;">ㆍ회사전화</td>
                <td style="padding-left:5px;"><input name="" type="text" id="getname"  style="width:100px;" maxlength="20"></td>
              </tr>
              <tr bgcolor="#E7E7E7">
                <td height="1" colspan="4"> </td>
              </tr>
              <tr>
                <td  height="25" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ홈페이지 URL</td>
                <td colspan="3" style="padding-left:5px;"> <input name="" type="text" id="getname"  style="width:300px;"></td>
              </tr>
              <tr bgcolor="#E7E7E7">
                <td height="1" colspan="4"> </td>
              </tr>
              <tr>
                <td  height="90" rowspan="2" bgcolor="#F9F9F9" style="padding-left:5px;">ㆍ사업장 주소</td>
                <td colspan="3" style="padding-left:5px;"> <input name="od_b_zip" type="text" id="od_b_zip"  style="width:100px;">
				  <a href="#asd" onclick="autoAddress('od_b_zip','od_b_addr1','od_b_addr2','forderform');"><img src="/btn/btn_address.gif" align="absmiddle" hspace="3" border="0"></a></td>
              </tr>
              <tr>
                <td colspan="3" style="padding-left:5px;"><input type=text name=od_b_addr1 size=35 maxlength=50 class=edit readonly  style="width:200px;">
                  <input type=text name=od_b_addr2 size=20 maxlength=50 class=edit  style="width:70px;">
                  [나머지주소입력]</td>
              </tr>
              <tr>
                <td height="2" colspan="4" bgcolor="#E7E7E7"> </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type=image  src="/btn/btn_next.gif" style="border:0">&nbsp;
      <a href="#asd" onclick="document.forderform.reset();"><img src="/btn/btn_cancel.gif" border="0"></a>
    </td>
  </tr>
</form>
</table></td>
   </tr>
   <tr>
    <td height="50" align="center">&nbsp;</td>
   </tr>
  </table>
<script language='javascript'>
function forderform_check(f)
{
    errmsg = "";
    errfld = "";
    var deffld = "";

    check_field(f.od_name, "주문하시는 분 이름을 입력하십시오.");
    if (typeof(f.od_pwd) != 'undefined')
    {
        clear_field(f.od_pwd);
        if( (f.od_pwd.value.length<3) || (f.od_pwd.value.search(/([^A-Za-z0-9]+)/)!=-1) )
            error_field(f.od_pwd, "회원이 아니신 경우 주문서 조회시 필요한 비밀번호를 3자리 이상 입력해 주십시오.");
    }
    check_field(f.od_tel, "주문하시는 분 전화번호를 입력하십시오.");
    check_field(f.od_addr1, "우편번호 찾기를 이용하여 주문하시는 분 주소를 입력하십시오.");
    check_field(f.od_addr2, " 주문하시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_zip, "");

    clear_field(f.od_email);
    if(f.od_email.value=='' || f.od_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1)
        error_field(f.od_email, "E-mail을 바르게 입력해 주십시오.");

    if (typeof(f.od_hope_date) != "undefined")
    {
        clear_field(f.od_hope_date);
        if (!f.od_hope_date.value)
            error_field(f.od_hope_date, "희망배송일을 선택하여 주십시오.");
    }

    check_field(f.od_b_name, "받으시는 분 이름을 입력하십시오.");
    check_field(f.od_b_tel, "받으시는 분 전화번호를 입력하십시오.");
    check_field(f.od_b_addr1, "우편번호 찾기를 이용하여 받으시는 분 주소를 입력하십시오.");
    check_field(f.od_b_addr2, "받으시는 분의 상세주소를 입력하십시오.");
    check_field(f.od_b_zip, "");

    // 배송비를 받지 않거나 더 받는 경우 아래식에 + 또는 - 로 대입
    f.od_send_cost.value = parseInt(f.od_send_cost.value);

    if (errmsg)
    {
        alert(errmsg);
        errfld.focus();
        return false;
    }

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    return true;
}

// 구매자 정보와 동일합니다.
function gumae2baesong(f)
{
    f.od_b_name.value = f.od_name.value;
    f.od_b_tel.value  = f.od_tel.value;
    f.od_b_hp.value   = f.od_hp.value;
    f.od_b_zip.value = f.od_zip.value;
    f.od_b_addr1.value = f.od_addr1.value;
    f.od_b_addr2.value = f.od_addr2.value;
}

if (typeof(forderform.od_name) != 'undefined')
    forderform.od_name.focus();
else
    forderform.od_b_name.focus();
</script>