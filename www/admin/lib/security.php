<?
/*
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	크로스 사이트 스크립팅(XSS) + SQL 인젝션 공격 차단용 함수 - Start
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	사용 : 해당 파일을 공격을 차단하려는 페이지 상단이나, 공통적으로 로드시키는 페이지에 인클루드 시킴.
|	예	:	include_once $_SERVER[DOCUMENT_ROOT]."/admin/lib/security.php";
|	
|	설명 : 모든 넘어오는 GET값과 POST값에 대하여, XSS필터 함수처리후 그 값을 다시 SQL 인젝션 필터 처리시킨다.
|			함수처리로 반환되는 값들은 foreach 반복문을 돌며 넘어온 파라미터명을 그대로 반환하기때문에
|			원래 코드를 수정할필요 없다.
|	
|	201505 - MJ
|
*/


/* ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 * RemoveXSS
 *
 * @param	string
 * @return	string
 */
function RemoveXSS($val) 
{ 
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed 
   // this prevents some character re-spacing such as <java\0script> 
   // note that you have to handle splits with \n, \r, and \t later since they *are* 
   // allowed in some inputs 
   $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val); 
    
   // straight replacements, the user should never need these since they're normal characters 
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&
   // #X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29> 
   $search = 'abcdefghijklmnopqrstuvwxyz'; 
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
   $search .= '1234567890!@#$%^&*()'; 
   $search .= '~`";:?+/={}[]-_|\'\\'; 
   for ($i = 0; $i < strlen($search); $i++) { 
   // ;? matches the ;, which is optional 
   // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 
    
   // &#x0040 @ search for the hex values 
      $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); 
      // with a ; 

      // @ @ 0{0,7} matches '0' zero to seven times 
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
   } 
    
   // now the only remaining whitespace attacks are \t, \n, and \r 
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 
'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'base');	//title 제거 
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
   $ra = array_merge($ra1, $ra2); 
    
   $found = true; // keep replacing as long as the previous round replaced something 
   while ($found == true) { 
      $val_before = $val; 
      for ($i = 0; $i < sizeof($ra); $i++) { 
         $pattern = '/'; 
         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
            if ($j > 0) { 
               $pattern .= '('; 
               $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?'; 
               $pattern .= '|(&#0{0,8}([9][10][13]);?)?'; 
               $pattern .= ')?'; 
            } 
            $pattern .= $ra[$i][$j]; 
         } 
         $pattern .= '/i'; 
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag 
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags 
         if ($val_before == $val) { 
            // no replacements were made, so exit the loop 
            $found = false; 
         } 
      } 
   } 
   return $val; 
}
/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */



/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
 * quote_smart
 *
 * @param	string
 * @return	string
 *
 * sql 인젝션 공격 차단용 함수
 * Quote variable to make safe 
 */
function quote_smart($value)
{
    // Stripslashes
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Quote if not integer
    if (!is_numeric($value)) {
        $value = mysql_real_escape_string($value);
    }
    return $value;
}
/* ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */



/* -------------------------------------------------------------- [ 파라미터 필터처리 - START ] ------------------------------------------------------------- */
foreach ($_REQUEST as $key => $value)
{
	$this_key = RemoveXSS(${$key});		//	XSS 필터처리
	${$key} = quote_smart($this_key);	//	SQL 인젝션 처리후 원래 파라미터값으로 저장.
	
	// 결과 확인용 출력문 주석처리
	//echo $key." : ".${$key}."<br>";
}
/* -------------------------------------------------------------- [ 파라미터 필터처리 - END ] --------------------------------------------------------------- */

/*2016-11-08 kh 추가 (%27) 방어*/
function stripslashes_deep($var){
    $var = is_array($var)?
                  array_map('stripslashes_deep', $var) :
                  stripslashes($var);
 
    return $var;
}
 
function mysql_real_escape_string_deep($var){
    $var = is_array($var)?
                  array_map('mysql_real_escape_string_deep', $var) :
                  mysql_real_escape_string($var);
 
    return $var;
}
 
if( get_magic_quotes_gpc() ){
    if( is_array($_POST) )
        $_POST = array_map( 'stripslashes_deep', $_POST );
    if( is_array($_GET) )
        $_GET = array_map( 'stripslashes_deep', $_GET );
}
 
if( is_array($_POST) )
    $_POST = array_map( 'mysql_real_escape_string_deep', $_POST );
if( is_array($_GET) )
    $_GET = array_map( 'mysql_real_escape_string_deep', $_GET);
/*2016-11-08 kh 추가 (%27) 방어*/

?>