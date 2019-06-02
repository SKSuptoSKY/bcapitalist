<?
include $DOCUMENT_ROOT."/admin/lib/lib.php";
include "./lib/shop_lib.php";

isAdmin();

include "../head.php";

$tbl = "shop_itemPS2";

if($w=="u") {
	$sql = " select * 
			   from $tbl  a
			   left join member b on (a.mb_id = b.userid) 
			   left join shop_item c on (a.it_id = c.it_id)
			  where is_id = '$is_id' ";
	$is = sql_fetch($sql);
	if (!$is[is_id]) alert("등록된 자료가 없습니다.");

	$name = $is[username];
	if(!$name) $name = $is[mb_id];

	$page_title = "상품평 공지수정";
} else if($w=="w") {
	$page_title = "상품평 공지입력";

	$is[is_name] = $sess_admin[username];
}
$qstr = "page=$page&sort1=$sort1&sort2=$sort2";
?>
<br><b><?=$page_title?></b>
<table cellpadding=4 cellspacing=1 width=100%>
<form name=frmitempsform method=post action="./itemps_update.php">
<input type=hidden name=w     value='<? echo $w ?>'>
<input type=hidden name=is_id value='<? echo $is_id ?>'>
<input type=hidden name=page  value='<? echo $page ?>'>
<input type=hidden name=sort1 value='<? echo $sort1 ?>'>
<input type=hidden name=sort2 value='<? echo $sort2 ?>'>

<input type=hidden name=type value='notice'>
<input type=hidden name=is_notice value='1'>
<colgroup width=120 class=tdsl></colgroup>
<colgroup width='' bgcolor=#ffffff></colgroup>
<tr><td colspan=4 height=3 bgcolor=0E87F9></td></tr>
<tr>
    <td>&nbsp;이 름</td>
    <td><input type=text class=edit name=is_name required itenmae='이름' style='width:99%;'
        value='<?=stripslashes($is[is_name])?>'></td>
</tr>
<tr>
    <td>&nbsp;제 목</td>
    <td><input type=text class=edit name=is_subject required itenmae='제목' style='width:99%;'
        value='<?=stripslashes($is[is_subject])?>'></td>
</tr>
<tr>
    <td>&nbsp;내 용</td>
    <td>
        <textarea name="is_content" rows="10" style='width:99%;' class=edit required itemname='내용'><? echo stripslashes($is[is_content]) ?></textarea>
    </td>
</tr>
<tr>
    <td>&nbsp;보이기</td>
    <td><input type=checkbox name=is_confirm value='1' <?=($is[is_confirm]?"checked":"")?>> 확인하였습니다.</td>
</tr>
<tr><td colspan=4 height=1 bgcolor=#CCCCCC></td></tr>
</table>

<br>
<center>
    <input type=image src='/btn/ok.gif' border=0> 
    <a href='<? echo "./itemps_list.php?$qstr" ?>'><img src='/btn/list.gif' border=0></a>
</center>
</form>

<? include "../foot.php"; ?>