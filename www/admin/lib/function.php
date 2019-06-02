<?
header("charset='".$charset."'");
/*************************************************************************
**
**  SQL 관련 함수 모음
**
*************************************************************************/
// DB 연결
function sql_connect($host, $user, $pass)
{
    return @mysql_connect($host, $user, $pass);
}


// DB 선택
function sql_select_db($db, $connect)
{
    return @mysql_select_db($db, $connect);
}


// mysql_query 와 mysql_error 를 한꺼번에 처리
function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;
}


// 쿼리를 실행한 후 결과값에서 한행을 얻는다.
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    $row = sql_fetch_array($result);
    return $row;
}


// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($result)
{
    $row = @mysql_fetch_assoc($result);
    return $row;
}


// $result에 대한 메모리(memory)에 있는 내용을 모두 제거한다.
// sql_free_result()는 결과로부터 얻은 질의 값이 커서 많은 메모리를 사용할 염려가 있을 때 사용된다.
// 단, 결과 값은 스크립트(script) 실행부가 종료되면서 메모리에서 자동적으로 지워진다.
function sql_free_result($result)
{
    return mysql_free_result($result);
}


function sql_password($value)
{
	$value = md5($value);
 //   $row = sql_fetch(" select MD5('$value') as pass ");
//    return $row[pass];
	return $value;
}

function sql_db_check($name, $error=TRUE)   // 테이블이 존제하는지 체크합니다.
{
		$qry = "show tables like '".$name."'";
		$result= sql_query($qry, $error);
		$re = mysql_affected_rows();
		return $re;
}

// PHPMyAdmin 참고
function get_table_define($table, $crlf="\n")
{
    // For MySQL < 3.23.20
    $schema_create .= 'CREATE TABLE ' . $table . ' (' . $crlf;

    $sql = 'SHOW FIELDS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $schema_create .= '    ' . $row['Field'] . ' ' . $row['Type'];
        if (isset($row['Default']) && $row['Default'] != '')
        {
            $schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
        }
        if ($row['Null'] != 'YES')
        {
            $schema_create .= ' NOT NULL';
        }
        if ($row['Extra'] != '')
        {
            $schema_create .= ' ' . $row['Extra'];
        }
        $schema_create     .= ',' . $crlf;
    } // end while
    sql_free_result($result);

    $schema_create = ereg_replace(',' . $crlf . '$', '', $schema_create);

    $sql = 'SHOW KEYS FROM ' . $table;
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $kname    = $row['Key_name'];
        $comment  = (isset($row['Comment'])) ? $row['Comment'] : '';
        $sub_part = (isset($row['Sub_part'])) ? $row['Sub_part'] : '';

        if ($kname != 'PRIMARY' && $row['Non_unique'] == 0) {
            $kname = "UNIQUE|$kname";
        }
        if ($comment == 'FULLTEXT') {
            $kname = 'FULLTEXT|$kname';
        }
        if (!isset($index[$kname])) {
            $index[$kname] = array();
        }
        if ($sub_part > 1) {
            $index[$kname][] = $row['Column_name'] . '(' . $sub_part . ')';
        } else {
            $index[$kname][] = $row['Column_name'];
        }
    } // end while
    sql_free_result($result);

    while (list($x, $columns) = @each($index)) {
        $schema_create     .= ',' . $crlf;
        if ($x == 'PRIMARY') {
            $schema_create .= '    PRIMARY KEY (';
        } else if (substr($x, 0, 6) == 'UNIQUE') {
            $schema_create .= '    UNIQUE ' . substr($x, 7) . ' (';
        } else if (substr($x, 0, 8) == 'FULLTEXT') {
            $schema_create .= '    FULLTEXT ' . substr($x, 9) . ' (';
        } else {
            $schema_create .= '    KEY ' . $x . ' (';
        }
        $schema_create     .= implode($columns, ', ') . ')';
    } // end while

    $schema_create .= $crlf . ')';

    return $schema_create;
} // end of the 'PMA_getTableDef()' function

/*************************************************************************
**
**  SQL 관련 함수 모음 끝
**
*************************************************************************/


/*************************************************************************
**
**  일반함수 함수 모음 여기부터
**
*************************************************************************/
// 리퍼러 체크
function referer_check($url="")
{
	global $ssl_port;
    if (!$url)
        $url = "/";

	if($_SERVER[SERVER_PORT] != $ssl_port){
		if (!preg_match("/^http[s]?:\/\/".$_SERVER[HTTP_HOST]."/", $_SERVER[HTTP_REFERER]))
        alert("제대로 된 접근이 아닌것 같습니다.", $url);
	}
}

// 마이크로 타임을 얻어 계산 형식으로 만듦
function get_microtime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}

// 접속통계에서 브라우저값 가져오기
function get_brow($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match("/msie 5.0[0-9]*/", $agent))     { $s = "MSIE 5.0"; }
    else if(preg_match("/msie 5.5[0-9]*/", $agent)) { $s = "MSIE 5.5"; }
    else if(preg_match("/msie 6.0[0-9]*/", $agent)) { $s = "MSIE 6.0"; }
    else if(preg_match("/msie 7.0[0-9]*/", $agent)) { $s = "MSIE 7.0"; }
    else if(preg_match("/msie 4.[0-9]*/", $agent))  { $s = "MSIE 4.x"; }
    else if(preg_match("/firefox/", $agent))        { $s = "FireFox"; }
    else if(preg_match("/x11/", $agent))            { $s = "Netscape"; }
    else if(preg_match("/opera/", $agent))          { $s = "Opera"; }
    else if(preg_match("/gec/", $agent))            { $s = "Gecko"; }
    else if(preg_match("/bot|slurp/", $agent))      { $s = "Robot"; }
    else { $s = "기타"; }

    return $s;
}
// 접속통계에서 OS값 가져오기
function get_os($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match("/windows 98/", $agent))                 { $s = "98"; }
    else if (preg_match("/windows 95/", $agent))            { $s = "95"; }
    else if(preg_match("/windows nt 4\.[0-9]*/", $agent))   { $s = "NT"; }
    else if(preg_match("/windows nt 5\.0/", $agent))        { $s = "2000"; }
    else if(preg_match("/windows nt 5\.1/", $agent))        { $s = "XP"; }
    else if(preg_match("/windows nt 5\.2/", $agent))        { $s = "2003"; }
    else if(preg_match("/windows 9x/", $agent))             { $s = "ME"; }
    else if(preg_match("/windows ce/", $agent))             { $s = "CE"; }
    else if(preg_match("/mac/", $agent))                    { $s = "MAC"; }
    else if(preg_match("/linux/", $agent))                  { $s = "Linux"; }
    else if(preg_match("/sunos/", $agent))                  { $s = "sunOS"; }
    else if(preg_match("/irix/", $agent))                   { $s = "IRIX"; }
    else if(preg_match("/phone/", $agent))                  { $s = "Phone"; }
    else if(preg_match("/bot|slurp/", $agent))              { $s = "Robot"; }
    else { $s = "기타"; }

    return $s;
}

// 출력순서
function order_select($fld, $sel="")
{
    $s = "<select name='$fld'>";
    for ($i=1; $i<=100; $i++) {
        $s .= "<option value='$i' ";
        if ($sel) {
            if ($i == $sel) {
                $s .= "selected";
            }
        } else {
            if ($i == 50) {
                $s .= "selected";
            }
        }
        $s .= ">$i</option>";
    }
    $s .= "</select>\n";

    return $s;
}

// 자동 링크
function url_auto_link($str)
{
    global $config;

    // 속도 향상 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='$config[cf_link_target]'>\\2</A>", $str);
    $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    // 이메일 정규표현식 수정 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}

// 내용을 변환
function conv_content($content, $html="")
{
    if ($html)
    {
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        if ($html == 2) { // 자동 줄바꿈
            $source[] = "/\n/";
            $target[] = "<br/>";
        }

		// 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace($source, $target, $content);
    }
    else // text 이면
    {
        // & 처리 : &amp; &nbsp; 등의 코드를 정상 출력함
        $content = html_symbol($content);

        // 공백 처리
		//$content = preg_replace("/  /", "&nbsp; ", $content);
		$content = str_replace("  ", "&nbsp; ", $content);
		$content = str_replace("\n ", "\n&nbsp;", $content);

        $content = get_text($content, 1);

        $content = url_auto_link($content);
    }

    return $content;
}

// TEXT 형식으로 변환
function get_text($str, $html=0)
{
    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}

// 한글 한글자(2byte, 유니코드 3byte)는 길이 2, 공란.영숫자.특수문자는 길이 1
if($charset == "euc-kr") {
	// EUCKR용 cut_str
	function cut_str($str, $len, $suffix="…")
	{
		$s = substr($str, 0, $len);
		$cnt = 0;
		for ($i=0; $i<strlen($s); $i++)
			if (ord($s[$i]) > 127)
				$cnt++;
		if (strtoupper($g4['charset']) == 'UTF-8')
			$s = substr($s, 0, $len - ($cnt % 3));
		else
			$s = substr($s, 0, $len - ($cnt % 2));
		if (strlen($s) >= strlen($str))
			$suffix = "";
		return $s . $suffix;
	}
} else {
	// UTF8용 cut_str mj
	function cut_str($str, $len, $suffix="…")
	{
		global $charset;
		$s = substr($str, 0, $len);
		$cnt = 0;
		for ($i=0; $i<strlen($s); $i++)
			if (ord($s[$i]) > 127)
				$cnt++;
		if ($charset == 'utf-8')
			$s = substr($s, 0, $len - ($cnt % 3));
		else
			$s = substr($s, 0, $len - ($cnt % 2));
		if (strlen($s) >= strlen($str))
			$suffix = "";
		return $s . $suffix;
	}
}



// HTML 특수문자 변환 htmlspecialchars
function htmlspecialchars2($str)
{
    $trans = array("\"" => "&#034;", "'" => "&#039;", "<"=>"&#060;", ">"=>"&#062;");
    $str = strtr($str, $trans);
    return $str;
}

// HTML SYMBOL 변환
// &nbsp; &amp; &middot; 등을 정상으로 출력
function html_symbol($str)
{
    return preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $str);
}

function goto_url($url)
{
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

// 기본 페이징 함수 : 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
	global $default,$DOCUMENT_ROOT;

	$starticon	= $DOCUMENT_ROOT.$default[paging_icon]."start.gif";
	$backicon	= $DOCUMENT_ROOT.$default[paging_icon]."back.gif";
	$nexticon	= $DOCUMENT_ROOT.$default[paging_icon]."next.gif";
	$endicon	= $DOCUMENT_ROOT.$default[paging_icon]."end.gif";

	$str = "
	<style>
			.paginate{line-height:normal;text-align:center}
			.paginate a{display:inline-block;position:relative;z-index:2;margin:0 -3px;padding:1px 8px;background-color:#fff;font:11px/16px Tahoma, Sans-serif;color:#323232;text-decoration:none;vertical-align:top}
			.paginate a:hover,
			.paginate a:active,
			.paginate a:focus{background-color:#f8f8f8}
			.paginate strong{color:#4174dc;font-weight:bold;}
			.paginate .none{border-left:none;border-right:none;}
			.paginate .direction{border:0;font-weight:normal;color:#767676;text-decoration:none !important;z-index:1}
			.paginate .direction:hover,
			.paginate .direction:active,
			.paginate .direction:focus{color:#323232;background-color:#fff}
			.top_15    {padding-top:15px;}
			.line2 {background:url('/images/center_line2.gif') 0 3px no-repeat;}
	</style>

	<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td class=\"top_15\" align=\"center\">
							<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"paginate\">
								<tr>";
    if ($cur_page > 1) {
			$str .= "<td><a href='" . $url . "1{$add}'><img src=\"/images/btn_first.gif\" alt=\"\" /></td></a>";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) {
			$str .= " <td><a href='" . $url . ($start_page-1) . "{$add}'><img src=\"/images/btn_prv.gif\" alt=\"\" /></a></td>";
	}
	
	$str .="<td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= " <td class=\"line2\"><a href='$url$k{$add}'>$k</a></td>";
            else
                $str .= "<td class=\"line2\"><a><strong>$k</strong></a></td>";
        }
    }

		$str .="</tr></table></td>";									

	if ($total_page > $end_page) {
			$str .= "<td><a href='" . $url . ($end_page+1) . "{$add}'><img src=\"/images/btn_next.gif\" alt=\"\" /></a></td>";
	}

    if ($cur_page < $total_page) {
			$str .= "<td><a href='$url$total_page{$add}'><img src=\"/images/btn_end.gif\" alt=\"\" /></a></td>";
    }
    $str .= "</tr></table></td></tr></table>";

    return $str;
}


// 디자인 적용 페이징 함수(기존함수와 인자같음) : 페이지블록, 현재페이지, 전체페이지, 꼬리값 전달
// css파일위치 : /css/style.css
################## [ 사용하려는 페이지에서 아래와 같이 사용 ] ################## 
/*
<div class="paginate mt35">
	<ul>
		<?=custom_paging(10, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?>
	</ul>
</div>
*/
######################################################################
function custom_paging($write_pages, $cur_page, $total_page, $url, $add="")
{
   global $default,$DOCUMENT_ROOT;
	// 1. 이미지 정의 ----------------------------------------------------------------------------------------------------------------------------
    $starticon  = "<img src='/images/paging/left_.jpg' border='0' style='vertical-align:middle;'>";			//		맨처음
    $backicon   = "<img src='/images/paging/left.jpg' border='0' style='vertical-align:middle;'>";			//		이전
    $nexticon   = "<img src='/images/paging/right.jpg' border='0' style='vertical-align:middle;'>";		//		다음
    $endicon    = "<img src='/images/paging/right_.jpg' border='0' style='vertical-align:middle;'>";		//		맨끝
    
	// 2. 맨처음 아이콘 출력부분 --------------------------------------------------------------------------------------------------------------
	if ($cur_page > 1) {
		if(file_exists($starticon)) $str .= "<a href='" . $url . "1{$add}'>".$starticon."</a>";
		else $str .= "<li style='padding-left:5px; padding-right:5px;'><a href='" . $url . "1{$add}'>".$starticon."</a></li>";
	}
	
    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;
    if ($end_page >= $total_page) $end_page = $total_page;
	
	// 3. 이전 아이콘 출력부분 ------------------------------------------------------------------------------------------------------------------
	if ($start_page > 1) {
		if(file_exists($backicon)) $str .= " &nbsp;<a href='" . $url . ($start_page-1) . "{$add}'>".$backicon."</a>";
		else $str .= "<a href='" . $url . ($start_page-1) . "{$add}'><li>".$backicon."</li></a>";
	}
 
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
				// 4.  현재 페이지가 아닌 나머지 페이지 버튼들 ( 비활성화 )
                $str .= "<li style='padding:2px;'><span class='over_page'><a href='$url$k{$add}'>$k</a></span></li>";
            else
				// 5. 현재 페이지 표시부분 ( 활성화 )
                $str .= "<li style='padding:2px;'><strong>$k</strong></li>";
        }
    }
	
	// 6. 다음 아이콘 출력부분 ------------------------------------------------------------------------------------------------------------------
	if ($total_page > $end_page) {
		if(file_exists($nexticon)) $str .= "<a href='" . $url . ($end_page+1) ."{$add}'>".$nexticon."</a>";
		else $str .= "<a href='" . $url . ($end_page+1) . "{$add}'><li>".$nexticon."</li></a>";
	}
	
	// 7. 맨끝 아이콘 출력부분 -------------------------------------------------------------------------------------------------------------------
	if ($cur_page < $total_page) {
		if(file_exists($endicon)) $str .= " &nbsp;<a href='$url$total_page{$add}'>".$endicon."</a>";
		else $str .= "<li style='padding-left:5px; padding-right:5px;'><a href='$url$total_page{$add}'>".$endicon."</a></li>";
	}
	$str .= "";
 
    return $str;
}

// 디자인 적용 페이징 함수(기존함수와 인자같음) : 페이지블록, 현재페이지, 전체페이지, 꼬리값 전달
// css파일위치 : /GnCommon/css/custom_paging.css
################## [ 사용하려는 페이지에서 아래와 같이 사용 ] ################## 
/*
<div class="paging_wrap">
	<ul class="paging mt30">
		<?=custom_paging_story2(10, $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page="); ?>
	</ul>
</div>
*/
######################################################################
function custom_paging_story2($write_pages, $cur_page, $total_page, $url, $add="")
{
   global $default,$DOCUMENT_ROOT;
	// 1. 이미지 정의 ----------------------------------------------------------------------------------------------------------------------------
    $starticon  = "<img src='/images/paging/btn_first.jpg' border='0' style='vertical-align:middle;'>";			//		맨처음
    $backicon   = "<img src='/images/paging/btn_prev.jpg' border='0' style='vertical-align:middle;'>";			//		이전
    $nexticon   = "<img src='/images/paging/btn_next.jpg' border='0' style='vertical-align:middle;'>";		//		다음
    $endicon    = "<img src='/images/paging/btn_last.jpg' border='0' style='vertical-align:middle;'>";		//		맨끝
    
	// 2. 맨처음 아이콘 출력부분 --------------------------------------------------------------------------------------------------------------
	if ($cur_page > 1) {
		$str .= "<li class='page_arrow'><a href='" . $url . "1{$add}'>".$starticon."</a></li>";
	}
	
    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;
    if ($end_page >= $total_page) $end_page = $total_page;
	
	// 3. 이전 아이콘 출력부분 ------------------------------------------------------------------------------------------------------------------
	if ($start_page > 1) {
		$str .= "<li class='page_arrow'><a href='" . $url . ($start_page-1) . "{$add}'>".$backicon."</a></li>";
	}
 
    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
				// 4.  현재 페이지가 아닌 나머지 페이지 버튼들 ( 비활성화 )
                $str .= "<li><a href='$url$k{$add}'>$k</a></li>";
            else
				// 5. 현재 페이지 표시부분 ( 활성화 )
                $str .= "<li class='on'><a href='#'>$k</a></li>";
        }
    }
	
	// 6. 다음 아이콘 출력부분 ------------------------------------------------------------------------------------------------------------------
	if ($total_page > $end_page) {
		$str .= "<li class='page_arrow'><a href='" . $url . ($end_page+1) . "{$add}'>".$nexticon."</a></li>";
	}
	
	// 7. 맨끝 아이콘 출력부분 -------------------------------------------------------------------------------------------------------------------
	if ($cur_page < $total_page) {
		$str .= "<li class='page_arrow'><a href='$url$total_page{$add}'>".$endicon."</a></li>";
	}
	$str .= "";
 
    return $str;
}

// 날짜, 조회수의 경우 높은 순서대로 보여져야 하므로 $flag 를 추가
// $flag : asc 낮은 순서 , desc 높은 순서
// 제목별로 컬럼 정렬하는 QUERY STRING
function subject_sort_link($col, $query_string='', $flag='asc')
{
    global $sst, $sod, $sfl, $stx, $page;

    $q1 = "sst=$col";
    if ($flag == 'asc')
    {
        $q2 = 'sod=asc';
        if ($sst == $col)
        {
            if ($sod == 'asc')
            {
                $q2 = 'sod=desc';
            }
        }
    }
    else
    {
        $q2 = 'sod=desc';
        if ($sst == $col)
        {
            if ($sod == 'desc')
            {
                $q2 = 'sod=asc';
            }
        }
    }

    return "<a href='$_SERVER[PHP_SELF]?$query_string&$q1&$q2&sfl=$sfl&stx=$stx&page=$page'>";
}

// 제목별로 컬럼 정렬하는 QUERY STRING
// $type 이 1이면 반대
function title_sort($col, $type=0)
{
    global $sort1, $sort2, $findType, $findword;
    global $_SERVER;
    global $page;

    $q1 = "sort1=$col";
    if ($type) {
        $q2 = "sort2=desc";
        if ($sort1 == $col) {
            if ($sort2 == "desc") {
                $q2 = "sort2=asc";
            }
        }
    } else {
        $q2 = "sort2=asc";
        if ($sort1 == $col) {
            if ($sort2 == "asc") {
                $q2 = "sort2=desc";
            }
        }
    }
    #return "$_SERVER[PHP_SELF]?$q1&$q2&page=$page";
    return "$_SERVER[PHP_SELF]?findType=$findType&findword=$findword&$q1&$q2&page=$page";
}

function get_yn($val, $case='')
{
    switch ($case) {
        case '1' : $result = ($val > 0) ? 'Y' : 'N'; break;
        default :  $result = ($val > 0) ? '예' : '아니오';
    }
    return $result;
}

function icon($act, $link="", $target="_parent")
{

    $img = array("입력"=>"insert", "추가"=>"insert", "생성"=>"insert", "수정"=>"modify", "삭제"=>"delete", "이동"=>"move", "메뉴"=>"move", "보기"=>"view", "미리보기"=>"view");
    $icon = "<img src='/btn/icon_{$img[$act]}.gif' border=0 align=absmiddle title='$act' >";
    if ($link)
    {
        $s = "<a href=\"$link\" target=\"$target\">$icon</a>";
    }
    else
        $s = $icon;
    return $s;
}

// 경고메세지를 경고창으로
function alert($msg='', $url='')
{
	global $charset;
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';

	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$charset\">";
	echo "<script type='text/javascript'>alert('$msg');";
    if (!$url)
        echo "history.go(-1);";
    echo "</script>";
    if ($url)
        goto_url($url);
    exit;
}

// 경고메세지를 경고창으로
function alert2($msg='')
{
	global $charset;
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$charset\">";
	echo "<script language='javascript'>alert('$msg');";
    echo "</script>";
    if ($url)
        // 4.06.00 : 불여우의 경우 아래의 코드를 제대로 인식하지 못함
        //echo "<meta http-equiv='refresh' content='0;url=$url'>";
    exit;
}

// 경고메세지후 창닫기
function alert_close($msg='', $url='')
{
	global $charset;
    if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$charset\">";
	echo "<script language='javascript'>alert('$msg');";
	if (!$url) {
		echo "
			window.opener.parent.focus();
			self.close();
		";
	} else {
		echo "
			window.opener.parent.location.href='$url';
			self.close();
		";
	}
    echo "</script>";
    exit;
}

// 텍스트에리어 늘리기, 줄이기
function textarea_size($fld)
{

    $size = 10;
    $s  = "<table cellpadding=2 cellspacing=0 border=0 width=100%><tr><td align=right>";
    $s .= "<a href='javascript:textarea_size($fld, {$size})'><img src='/btn/btn_up.gif' border=0 align=absmiddle></a> ";
    $s .= "<a href='javascript:textarea_size($fld, ".$size*(-1).")'><img src='/btn/image/btn_down.gif' border=0 align=absmiddle></a>";
    $s .= "&nbsp;&nbsp;</td></tr></table>";
    return $s;
}


// 시간이 비어 있는지 검사
function is_null_time($datetime)
{
	// 공란 0 : - 제거
	$datetime = ereg_replace("[ 0:-]", "", $datetime);
	if ($datetime == "")
	    return true;
	else
	    return false;
}

// 일자 시간을 검사한다.
function check_datetime($datetime)
{
	if ($datetime == "0000-00-00 00:00:00")
	    return true;

    $year   = substr($datetime, 0, 4);
    $month  = substr($datetime, 5, 2);
    $day    = substr($datetime, 8, 2);
    $hour   = substr($datetime, 11, 2);
    $minute = substr($datetime, 14, 2);
    $second = substr($datetime, 17, 2);

    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

    $tmp_datetime = date("Y-m-d H:i:s", $timestamp);
    if ($datetime == $tmp_datetime)
        return true;
    else
        return false;
}

// 일자형식변환
function date_conv($date, $case=1)
{
    if ($case == 1) { // 년-월-일 로 만들어줌
        $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $date);
    } else if ($case == 2) { // 년월일 로 만들어줌
        $date = preg_replace("/-/", "", $date);
    } else if ($case == 3) { // 년월일 로 만들어줌
        $date = preg_replace("/([0-9]{4})-([0-9]{2})-([0-9]{2})/", "\\1년 \\2월 \\3일", $date);
    }

    return $date;
}

// 한글 요일
function get_yoil($date, $full=0)
{
    $arr_yoil = array ("일", "월", "화", "수", "목", "금", "토");

    $yoil = date("w", strtotime($date));
    $str = $arr_yoil[$yoil];
    if ($full) {
        $str .= "요일";
    }
    return $str;
}

// 숫자요일을 한글요일로 변환
function get_yoil2($date)
{
    switch($date){
		case 0:echo "일요일";break;
		case 1:echo "월요일";break;
		case 2:echo "화요일";break;
		case 3:echo "수요일";break;
		case 4:echo "목요일";break;
		case 5:echo "금요일";break;
		case 6:echo "토요일";break;
	}
}

// 날짜를 select 박스 형식으로 얻는다
function date_select($date, $name="",$pp='3',$pm='3',$sdate='0000',$style='')
{
    $s = "";
    if (substr($sdate, 0, 4) == "0000") {
        $sdate = date("Y-m-d",time());
    }
	$m = explode("-", $sdate);
	$dat = explode("-", $date);

    // 년
    $s .= "<select name='{$name}_y' $style>";
    for ($i=$m[0]-$pm; $i<=$m[0]+$pp; $i++) {
        $s .= "<option value='$i'";
        if ($i == $dat[0]) {
            $s .= " selected";
        }
        $s .= ">$i";
    }
    $s .= "</select>년 \n";

    // 월
    $s .= "<select name='{$name}_m' $style>";
    for ($i=101; $i<=112; $i++) {
		$c = substr($i,-2);
        $s .= "<option value='$c'";
        if ($c == $dat[1]) {
            $s .= " selected";
        }
        $s .= ">$c";
    }
    $s .= "</select>월 \n";

    // 일
    $s .= "<select name='{$name}_d' $style>";
    for ($i=101; $i<=131; $i++) {
		$c = substr($i,-2);
        $s .= "<option value='$c'";
        if ($c == $dat[2]) {
            $s .= " selected";
        }
        $s .= ">$c";
    }
    $s .= "</select>일 \n";

    return $s;
}

function AgeYear($start=18, $end=70, $age) {
	$age_list  = "";
	for($i=$start;$i<=$end;$i++) {
		$get_time = (date("Y")-($i-1));
		if($get_time==$age) $selected = "selected"; else $selected = "";
		$age_list .= "<option value='{$get_time}' $selected>{$i}세</option>";
	}
	return $age_list;
}

function AgeNum($year) {
	$nowyear  = date("Y");
	$getyear = ($nowyear-$year)+1;

	return $getyear;
}

//생년월일로 만 나이 구하기
function AgeTime($birth) {

 if($birth) {
  $birth = explode("-", $birth);

  $birth_year = $birth[0];
  $birth_month = $birth[1];
  $birth_day = $birth[2];

  $birth_day = mktime(0,0,0,$birth_month,$birth_day,$birth_year); // 생일

  $event_day = time(); // 특정일
  $event_year = date("Y",$event_day);

  $b_day = date("z",$birth_day);
  $e_day = date("z",$event_day);

  for($i=$birth_year;$i<$event_year;$i++) $count_day += 365;

  $count_day += $e_day - $b_day;

  return ceil($count_day/365);
 }
}

// 연령대 구하기
function Yearch($oldy,$type) {

	$to_Year = date("Y",time());
	$to_year = date("y",time());

	if($type=="P") {
		if($to_year > $oldy) {  // $oldy = 81 / 79 / 95 ...
			$reoldy =  $to_year - $oldy + 1;
			$reoldy = sprintf("%d0대",($reoldy/10));
		} else {
			$to_year = $to_year + 100;
			$reoldy =  $to_year - $oldy + 1;
			$reoldy = sprintf("%d0대",($reoldy/10));
		}

		return $reoldy;
	}

	if($type=="S"){  // $oldy = 10 / 20 / 30 ...
		$oldy = substr($oldy,0,2);
		$seachw1 = $to_Year - $oldy;
		$seachw2 = $to_Year - ($oldy+9);
		$seachw1 = substr($seachw1,2,2);
		$seachw2 = substr($seachw2,2,2);
		$reoldy = " and left(jumin1,2) > '$seachw2' and left(jumin1,2) < $seachw1 ";

		return $reoldy;
	}
}

// 메일 보내기 (파일 여러개 첨부 가능)
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $charset="UTF-8", $cc="", $bcc="") {
	global $charset;
    // type : text=0, html=1, text+html=2

	//@중복에 의한 대량메일 방지
	$toemch = explode("@", $to);
	$to = "$toemch[0]@$toemch[1]";
	$fremch = explode("@", $fmail);
	$fmail = "$fremch[0]@$fremch[1]";

    $fname   = "=?$charset?B?" . base64_encode($fname) . "?=";
    $subject = "=?$charset?B?" . base64_encode($subject) . "?=";

    $header  = "Return-Path: <$fmail>\n";
    $header .= "From: $fname <$fmail>\n";
    $header .= "Reply-To: <$fmail>\n";
    if ($cc)  $header .= "Cc: $cc\n";
    if ($bcc) $header .= "Bcc: $bcc\n";
    $header .= "MIME-Version: 1.0\n";

    if ($file != "") {
        $boundary = uniqid("http://www.gamgakdesign.com/");

        $header .= "Content-type: MULTIPART/MIXED; BOUNDARY=\"$boundary\"\n\n";
        $header .= "--$boundary\n";
    }

    if ($type) {
        $header .= "Content-Type: TEXT/HTML; charset=$charset\n";
        if ($type == 2)
            $content = nl2br($content);
    } else {
        $header .= "Content-Type: TEXT/PLAIN; charset=$charset\n";
        $content = stripslashes($content);
    }
    $header .= "Content-Transfer-Encoding: BASE64\n\n";
    $header .= chunk_split(base64_encode($content)) . "\n";

    if ($file != "") {
        foreach ($file as $f) {
            $header .= "\n--$boundary\n";
            $header .= "Content-Type: APPLICATION/OCTET-STREAM; name=\"$f[name]\"\n";
            $header .= "Content-Transfer-Encoding: BASE64\n";
            $header .= "Content-Disposition: inline; filename=\"$f[name]\"\n";

            $header .= "\n";
            $header .= chunk_split(base64_encode($f[data]));
            $header .= "\n";
        }
        $header .= "--$boundary--\n";
    }

    $ok = @mail($to, $subject, "", $header);
	return $ok;
}
// 파일 첨부시
/*
$fp = fopen(__FILE__, "r");
$file[] = array(
    "name"=>basename(__FILE__),
    "data"=>fread($fp, filesize(__FILE__)));
fclose($fp);
*/

// 파일을 첨부함
function attach_file($filename, $file)
{
    $fp = fopen($file, "r");
    $tmpfile = array(
        "name" => $filename,
        "data" => fread($fp, filesize($file)));
    fclose($fp);
    return $tmpfile;
}

// 파일을 업로드 함
function upload_file($srcfile, $destfile, $dir)
{
	if ($destfile == "") return false;
    // 업로드 한후 , 퍼미션을 변경함
	@move_uploaded_file($srcfile, "$dir/$destfile");
	@chmod("$dir/$destfile", 0606);
	return true;
}

// 파일 확장자 가져오기
function file_type($file_name)
{
		$arr_name = explode(".",$file_name);
		$ext = strtolower($arr_name[sizeof($arr_name)-1]);
		return $ext;
}

/// 폴더를 생성합니다.
function Make_Dir($dir_name,$path)
{
	if(!is_dir($path)) {
		@umask(000);
		if(!@mkdir($path,0777)) error('폴더 생성에 실패했어요');
	}

	if(!is_dir($path."/".$dir_name)) {
		@umask(000);
		if(!@mkdir($path."/".$dir_name,0777)) error('폴더 생성에 실패했어요');
	}
}

/// 분리하여 늘어놓기
function array_text($varry,$tag="|",$poin=" , ")
{
	$arry_value =  explode($tag,$varry) ;
	$arry_cnt = count($arry_value);
	$re_value = "";
	for($i=0; $i<$arry_cnt; $i++) {
		if($arry_value[$i]==TRUE) {
			if($i!=0 && $re_value==TRUE) $re_value .= $poin;
			$re_value .= $arry_value[$i];
		}
	}
	return $re_value;
}

//썸네일 이미지 사이지 결정하여 썸네일 생성
//$src_file_size, $dest_file_size 이미지 정보를 담은 배열 0은 너비 1은 높이
function Ysumnail_rule($src_file, $dest_file, $src_file_size, $dest_file_size, $image_quality=90){
	//생성도중 에러가 날수 있는 것들을 체크 하여 return false
	if (!is_array($src_file_size) || !is_array($dest_file_size) || empty($src_file_size[0]) || empty($src_file_size[1]) || empty($dest_file_size[0]) || empty($dest_file_size[0])) {

	return false;
	}

	$rate = $src_file_size[1] / $src_file_size[0];
	$temp[1] = (int)($dest_file_size[0] * $rate);

	if ($dest_file_size[1] < $temp[1]) {

	$rate = $src_file_size[0] / $src_file_size[1];
	$dest_file_size[0] = (int)($dest_file_size[1] * $rate);
	}
	else{

	$dest_file_size[1] = $temp[1];
	}

	//썸네일의 너비나 높이가 10 미만인것은 만들지 않는다.
	if ($dest_file_size[0] < 10 || $dest_file_size[1] < 10) {

	return false;
	}

	//썸네일 이미지가 원본이미지 크기보다 크게 설정되었을 경우, 원본이미지와 동일하게
	if ($dest_file_size[0] > $src_file_size[0]) {

	$dest_file_size = $src_file_size;
	}

	return Ymake_sumnail_gd($src_file, $dest_file, $src_file_size, $dest_file_size, $image_quality);
}

//섬네일 생성
function Ymake_sumnail_gd($src_file, $dest_file, $src_file_size, $dest_file_size, $image_quality=90){
	//생성도중 에러가 날수 있는 것들을 체크 하여 return false
	if (empty($src_file) || empty($dest_file) || !is_file($src_file) || !is_array($src_file_size) || !is_array($dest_file_size) || empty($src_file_size[0]) || empty($src_file_size[1]) || empty($src_file_size[2]) || empty($dest_file_size[0]) || empty($dest_file_size[0])) {

	return false;
	}

	//$image_quality 확인후 조건에 맞지 않으면 기본값 세팅
	if(!is_numeric($image_quality) || empty($image_quality)) $image_quality = 90;

	//원본사이즈보다 썸네일 사이즈가 더 크면 원본사이즈와 같게 썸네일을 생성
	if ($dest_file_size[0] > $src_file_size[0]) {

	$dest_file_size = $src_file_size;
	}

	switch($src_file_size[2]) {

	case 1: // GIF image
	  @exec( "gifsicle -I " . $src_file, $tempinfo);
	  $info = @join(" " , $tempinfo);

	  //gifsicle rpm이 설치되었을 경우 움직인는 gif도 썸네일 가능하다.
	  if (preg_match("'(loop forever|loop count)'", $info)) {

		@exec( "gifsicle -O " . $image_quality . " --resize " . $dest_file_size[0] . "x" . $dest_file_size[1] . " " . $src_file . " > " . $dest_file );

		//퍼미션 변경가능 여부를 가지고 썸네일 생성 실패 판단
		return @chmod($dest_file, 0777);
	  }
	  else {

		$src = @ImageCreateFromGIF($src_file);
	  }
	  break;

	case 2: // JPEG image
	  $src = @ImageCreateFromJPEG($src_file); break;

	case 3: // PNG image
	  $src = @ImageCreateFromPNG($src_file); break;

	default: // 정해진 이외의 포맷은 return false
	  return false;
	}

	if (function_exists("imagecreatetruecolor")) {

	// This function requires GD 2.0.1 or later.
	$dst = @ImageCreateTrueColor($dest_file_size[0], $dest_file_size[1]);
	}
	else {

	$dst = @ImageCreate($dest_file_size[0], $dest_file_size[1]);
	}

	// 1.00.05 gd 버전에 따라
	if (function_exists("imagecopyresampled")) {

	@imagecopyresampled($dst, $src, 0, 0, 0, 0, $dest_file_size[0], $dest_file_size[1], $src_file_size[0], $src_file_size[1]);
	}
	else {

	// 1.00.02 imagecopyresized -> imagecopyresampled 로 교체
	@imagecopyresized($dst, $src, 0, 0, 0, 0, $dest_file_size[0], $dest_file_size[1], $src_file_size[0], $src_file_size[1]);
	}

	@ImageJPEG($dst, $dest_file, $image_quality);
	@ImageDestroy($src);
	@ImageDestroy($dst);

	//퍼미션 변경가능 여부를 가지고 썸네일 생성 실패 판단
	return @chmod($dest_file, 0777);
}

/*************************************************************************
**
**  일반함수 함수 모음 끝
**
*************************************************************************/

##################################################
##########  프로그램 관련함수
##################################################
// 관리자 체크
function Admin_check(){
	if($_SESSION["userlevel"]<100) {
		alert('허용하지 않는 접근입니다. 관리자로 로그인해주시기 바랍니다.','/admin/');
	}
}
// 로그인 체크
function Login_check() {
	if(strcmp($_SESSION["userid"],"") && $_SESSION["userid"]==FALSE || $_SESSION["userlevel"]<10) return false;
	else return true;
}
// 회원 체크하기
function Member_check($thisid) {
	if(Login_check()==TRUE) {
		if($_SESSION["userlevel"]==100 || $thisid==$_SESSION["userid"]) return true;
			else return false;
	} else {
		return false;
	}
}
// 회원정보 가져오기
function Get_member($id)
{
	global $GnTable;

	$sql = " select * from {$GnTable[member]} where mem_id = '$id' ";
    $row = sql_fetch($sql);

    return $row;
}
// 회원이미지를 가져오기
function Get_photo($img, $name, $width=0, $height=0)
{
	global $default;

	$full_img = $_SERVER["DOCUMENT_ROOT"]."$img";

	if (file_exists($full_img) && $img)
    {
        if (!$width)
        {
            $size = getimagesize($full_img);
            $width = $size[0];
            $height = $size[1];
        }
        $str = "<img src='$img' width='$width' height='$height' border='0' name='$name'>";
    }
    else
    {
        $str = "<img name='$name' src='/btn/no_img.gif' border='0' ";
        if ($width)
            $str .= "width='$width' height='$height'";
        else
            $str .= " ";
        $str .= ">";
    }
     return $str;
}
// 회원실명 가져오기
function Get_Real($id)
{
	global $GnTable;

	$sql = " select mem_name from {$GnTable[member]} where mem_id = '$id' ";
    $row = sql_fetch($sql);
	$mem_name = $row["mem_name"];

    return $mem_name;
}
// 회원이름 가져오기
function Get_Nick($id)
{
	global $GnTable;

	$sql = " select mem_nick from {$GnTable[member]} where mem_id = '$id' ";
    $row = sql_fetch($sql);
	$mem_nick = $row["mem_nick"];

    return $mem_nick;
}
// 회원등급 가져오기
function Get_level($value,$type="SELECT",$search=FALSE) {
	global $GnTable;

	$sql = " select leb_level, leb_name from {$GnTable[memberlevel]} $search order by leb_level";
	$result = sql_query($sql,FALSE);
	$Level = "";

	for ($i=0; $row=sql_fetch_array($result,FALSE); $i++) {

		if($row[leb_level]==$value) {
			$selec = "selected";
			$check = "checked";
		} else {
			$selec = "";
			$check = "";
		}
		if($type=="SELECT") {
			$Level .= "<option value='$row[leb_level]' $selec>".$row[leb_name];
		} else if($type=="RADIO") {
			$Level .= "<input type='radio' value='$row[leb_level]' $check>".$row[leb_name];
		} else if($type=="ARR") {
			$Level[$i] = $row;
		} else {
			$Level .= " $row[leb_name]";
		}
	}

	return $Level;
}
// 회원포인트및캐쉬 가져오기
function Get_MemPoint($id)
{
	global $GnTable;

	$sql = " select mem_point,mem_cash from {$GnTable[member]} where mem_id = '$id' ";
    $row = sql_fetch($sql);
	$RE["POINT"] = $row["mem_point"];
	$RE["CASH"] = $row["mem_cash"];

    return $RE;
}
// 회원 포인트 적립하기
function input_point($point,$memo,$member)
{
	global $GnTable, $default, $datetime;

	if($default["use_point"]==FALSE) return FALSE;

	// 현재 보유한 포인트 내역의 합을 구하고
	$sql = " select sum(p_point) as sum_point from {$GnTable[point]} where p_member = '$member' ";
	$row = sql_fetch($sql);
	$now_point = $row[sum_point];
	$pointch = $now_point + $point;
	if($pointch <0 ) {
		return FALSE;
	}

	$memo = addslashes($memo);

	if(!$point || !$memo || !$member) return false;

	$sql = " insert {$GnTable[point]} set
			p_member = '$member',
			p_time = '$datetime',
			p_memo = '$memo',
			p_point = '$point' ";
	sql_query($sql);

    // 포인트 내역의 합을 구하고
    $sql = " select sum(p_point) as sum_point from {$GnTable[point]} where p_member = '$member' ";
    $row = sql_fetch($sql);
    $sum_point = $row[sum_point];

    // 포인트 UPDATE
    $sql = " update {$GnTable[member]} set mem_point = '$sum_point' where mem_id = '$member' ";
    sql_query($sql);

    return TRUE;
}
// 회원 새메모 가져오기
function Get_Newmemo($id)
{
	global $GnTable;

	$sql = " select count(*) as cnt from {$GnTable[memo]} where m_send_id = '$id' and m_read_time = '0000-00-00 00:00:00' and m_send_del='0' ";
    $row = sql_fetch($sql);
	$new = $row["cnt"];

    return $new;
}

// 스킨폴더 목록 불러오기
function Get_skin($name, $skin) {
	$dir=opendir($_SERVER["DOCUMENT_ROOT"]."/skin/$name/");
	$skin_temp = "";

	while($file=readdir($dir)) {
		if($file != "." && $file != ".."){
			$arr[] = $file;
		}
	}
	closedir($dir);

	sort($arr);
	foreach($arr as $key=>$value) {
		if($arr[$key] == $skin) $sele = " selected"; else $sele = "";
		$skin_temp .= "<option value='$arr[$key]'$sele>$arr[$key]</option>\n";
	}

	return $skin_temp;
}
// 게시판 카테고리 불러오기
function Get_BoardCate($catevalue,$category="") {
	global $DB,$adminBoardNum;

		$categoryTemp = "<option value=''>전체분류</option>\n";
		// 카테고리 값을 배열에 저장합니다.
		$categoryRES= explode(",",$catevalue);
		$categoryCNT = count($categoryRES);
		for($i=0; $i<$categoryCNT; $i++) {
			if($categoryRES[$i]==$category) $select = "selected"; else $select = "";
			$categoryTemp .= "<option value='{$categoryRES[$i]}' $select>{$categoryRES[$i]}</option>\n";
		}

	return $categoryTemp;
}
// 회원 통계를 가져오기 위한 함수
function Get_MemTotal(){
	global $GnTable, $date;

		$yesterday = date("Y-m-d",time()-86400);
		$tomonth = date("Y-m",time());
		$yesmonth = time()-((date("d")+2)*86400);
		$yesmonth = date("Y-m",$yesmonth);

		$sql_level = " select leb_level, leb_name from {$GnTable[memberlevel]} where leb_level>0 order by leb_level";
		$result_level = sql_query($sql_level,FALSE);
		$level_plus = "";
		for ($i=0; $row=sql_fetch_array($result_level,FALSE); $i++) {
			$level[$i] = $row;
			$level_plus .= " sum(IF(mem_leb = '{$row[leb_level]}', 1, 0)) as level_{$row[leb_level]}, ";
		}

		$sql = "
			select
				sum(IF(mem_leb > 0, 1, 0)) as total,
				sum(IF(mem_leb = 0, 1, 0)) as exitm,
				$level_plus
				sum(IF(mem_leb > 0 and mem_sex = 'm', 1, 0)) as man,
				sum(IF(mem_leb > 0 and mem_sex = 'w', 1, 0)) as woman,
				sum(IF(mem_leb > 0 and mem_remail = 'y', 1, 0)) as yesmail,
				sum(IF(mem_leb > 0 and mem_sms = 'y', 1, 0)) as yessms,
				avg(visited) as visited,
				sum(IF(left(first_regist,10) = '$date', 1, 0)) as today,
				sum(IF(left(first_regist,10) = '$yesterday', 1, 0)) as yesterday,
				sum(IF(left(first_regist,7) = '$tomonth', 1, 0)) as tomonth,
				sum(IF(left(first_regist,7) = '$yesmonth', 1, 0)) as yesmonth
			from {$GnTable[member]}";
		$total = sql_fetch($sql);

	return $total;
}
// 접속현황 저장하기
function Put_Counter()
{
	global $GnTable, $_SERVER, $default ;

	$SalfUrl = "http://".str_replace("www.","",$_SERVER["HTTP_HOST"]);
	$RefUrl = str_replace("www.","",$_SERVER["HTTP_REFERER"]);
	if($RefUrl) {
		$Url = explode("/",$RefUrl);
		$ref_site = $Url[0]."//".$Url[1].$Url[2];
	}

	$con_ip = $_SERVER["REMOTE_ADDR"];
	$con_date = date("Y-m-d",time());
	$con_time = date("H:i:s",time());
	$ref_url = $_SERVER["HTTP_REFERER"];
	$get_page =$_SERVER["PHP_SELF"];
	$get_query = $_SERVER["QUERY_STRING"];
	$get_agent = $_SERVER["HTTP_USER_AGENT"];

	$qry =" insert into {$GnTable[counter]} set
					con_ip				 = '$con_ip',
					con_date			 = '$con_date',
					con_time			 = '$con_time',
					ref_url				 = '$ref_url',
					ref_site				 = '$ref_site',
					get_page			 = '$get_page',
					get_query			 = '$get_query',
					get_agent			 = '$get_agent',
					site					 = '{$default[site_code]}'
			";

	$sql = sql_fetch("select count(*) as cnt from {$GnTable[counter]} where con_date= '$con_date' and con_ip='$con_ip' ");

	if($sql[cnt] <=0) {
			sql_query($qry);
	}

	return TRUE;
}
// 접속자 통계를 가져오기 위한 함수
function Get_CntTotal()
{
	global $GnTable, $date;
		$yesterday = date("Y-m-d",time()-86400);
		$tomonth = date("Y-m",time());
		$yesmonth = time()-((date("d")+2)*86400);
		$yesmonth = date("Y-m",$yesmonth);
		$sql = "
			select
				sum(IF(con_id > 0, 1, 0)) as total,
				sum(IF(con_date = '$date', 1, 0)) as today,
				sum(IF(con_date = '$yesterday', 1, 0)) as yesterday,
				sum(IF(left(con_date,7) = '$tomonth', 1, 0)) as tomonth,
				sum(IF(left(con_date,7) = '$yesmonth', 1, 0)) as yesmonth
			from {$GnTable[counter]}";
		$total = sql_fetch($sql);
	return $total;
}

//접속카운트 저장하기_20111103(관리자메인 로딩속도때문에 기존테이블에서 분리)
function counter_total_save() {
	global $GnTable,$_COOKIE;
	if ($_COOKIE["counter_total_ok"]!="1") {
		$today=date("Y-m-d");
		$today_m=date("m");
		$today_d=date("d");

		$sql="select * from {$GnTable[countertotal]} ";
		$res=sql_query($sql);
		$total=mysql_num_rows($res);
		$row=mysql_fetch_array($res);
		if ($total) {
			$this_date_arr=explode("-",$row[this_date]);
			if ($today>$row[this_date]) {
				if ($today_m!=$this_date_arr[1]) {
					$sql="update {$GnTable[countertotal]} set ysmon_cnt=tomon_cnt, ysday_cnt=today_cnt, tomon_cnt='0', today_cnt='0', this_date='{$today}' ";
					sql_query($sql);
				}else if ($today_d!=$this_date_arr[2]) {
					$sql="update {$GnTable[countertotal]} set ysday_cnt=today_cnt, today_cnt='0', this_date='{$today}' ";
					sql_query($sql);
				}
			}
			$sql="update {$GnTable[countertotal]} set today_cnt=today_cnt+1, tomon_cnt=tomon_cnt+1, total_cnt=total_cnt+1 ";
			sql_query($sql);
		}
		else {
			$sql="insert into {$GnTable[countertotal]} set today_cnt='1', tomon_cnt='1', this_date='{$today}', total_cnt='1' ";
			sql_query($sql);
		}
		setcookie("counter_total_ok","1",time()+60*60*24, "/" );
	}
	return TRUE;
}

//접속카운트 불러오기_20111103(관리자메인 로딩속도때문에 기존테이블에서 분리)
function counter_total_list() {
	global $GnTable;
	$sql="select * from {$GnTable[countertotal]} ";
	$counter_total=sql_fetch($sql);
	return $counter_total;
}


// 은행계좌정보 가져오기 위한 함수
function Get_BankList() {
	global $GnTable, $default;
		// 계좌번호 옵션값 만들기
		$str = explode("\n", $default[bank_info]);
		$banklist = "";
		for ($i=0; $i<count($str); $i++)
		{
			$str[$i] = str_replace("\r", "", $str[$i]);
			$banklist  .= "<option value='$str[$i]'>$str[$i] \n";
		}

	return $banklist;
}
// 각 시도군의 이름을 가져오기 위한 함수
function Get_SidoName($Cvalue,$Cstyle,$Cname="",$Ctype="sido") {
	global $GnTable, $default;

	if($Ctype=="gu") {
		if($Cvalue==FALSE) return false;
			else $Cvalue = explode(" ",$Cvalue);
		$sido = $Cvalue[0];
		$Cvalue = $Cvalue[1];
		$search = "where sido='$sido'";
	}

		$sql = " select distinct $Ctype from {$GnTable[zipname]} $search ORDER BY $Ctype";
		$result = sql_query($sql,FALSE);

		for ($i=0; $row=sql_fetch_array($result); $i++)
		{
			if($Cstyle=="SELECT") {
				if($Cvalue==$row[$Ctype]) $selected = "selected"; else $selected = "";
				$Coption .= "<option value='{$row[$Ctype]}' $selected>{$row[$Ctype]}";
			}
			if($Cstyle=="ARR") {
				$Coption[$i] = $row;
			}
			if($Cstyle=="RADIO") {
				if($Cvalue==$row[$Ctype]) $selected = "checked"; else $selected = "";
				$Coption .= "<input type='radio' name='$Cname' value='{$row[$Ctype]}' $selected>{$row[$Ctype]} ";
			}
		}

	return $Coption;
}

// 나이 목록 만들기
function Get_age($start=18, $end=70, $age="") {
	$age_list  = "";
	for($i=$start;$i<=$end;$i++) {
		$get_time = (date("Y")-($i-1));
		if($get_time==$age) $selected = "selected"; else $selected = "";
		$age_list .= "<option value='{$get_time}' $selected>{$i}세 ({$get_time}년생)</option>";
	}
	return $age_list;
}
##################################################
##########  최근게시물 가져오기
##################################################

 function latest($Table, $tburl, $skinname, $line, $maxstring, $search="order by b_notice desc, b_tno desc, b_dep, b_no desc") {

	global $GnTable, $Get_Login;

		if(!$skinname) $skinname = "basic";
		$BB_table = $GnTable["bbsitem"].$Table;
		$BC_table = $GnTable["bbscomm"].$Table;

		$str = file_exists($_SERVER["DOCUMENT_ROOT"]."/skin/latest/".$skinname."/main.php");

		if(!$str) {
			echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
			return;
		}
		$skindir = $_SERVER["DOCUMENT_ROOT"]."/skin/latest/".$skinname;
		$skin = "/skin/latest/".$skinname;

		$newdate = time() - 86400;

	$sql = " select * from {$GnTable[bbsconfig]} where dbname = '$Table' ";
    $Board_Admin = sql_fetch($sql);

		$sql  = " select * from $BB_table $search limit 0 , $line";
		$result = sql_query($sql);

	for ($i=0; $row=mysql_fetch_array($result); $i++) {

		$list[$i] = $row;

		// 파일 테이블에서 해당하는 파일 정보를 불러옵니다.
		$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '{$row[b_no]}' ";
		$Get_File_result = sql_query($Get_File_sql,FALSE);
		//다운파일이 있으면
		for ($f=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $f++) {
			if($Get_File["bf_save_name"] && $Board_Admin["use_data"]==TRUE) {
				##### 등록파일이 있을경우
					$getsavename = $Get_File["bf_save_name"];
					$getfilename = $Get_File["bf_real_name"];
					//이미지 파일의 경우 화면에서 출력
					$size=@GetImageSize($_SERVER["DOCUMENT_ROOT"]."/bbs/data/$Table/".$getsavename);	// 이미지 싸이즈 추출
					$resize = ($size[0]> $Board_Admin["imgsize"]) ? $Board_Admin["imgsize"] : $size[0];

					$ext = file_type($getfilename);

					if(!strCmp($ext,"jpeg") || !strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {
						$list[$i]["img_".$f] = "/bbs/data/$Table/$getsavename";
					} else if(!strCmp($ext,"mov") || !strCmp($ext,"wmv") || !strCmp($ext,"avi") || !strCmp($ext,"asf") || !strCmp($ext,"asx") || !strCmp($ext,"mpeg") || !strCmp($ext,"mpg")) {
						$list[$i]["img_".$f] = "{$Board_Admin[skin_dir]}/images/media_img.gif";
					} else {
						$list[$i]["img_".$f] = "{$Board_Admin[skin_dir]}/images/no_img.gif";
					}
			}
		}
		
		// 20141107 mj추가 // 최근게시물도 첨부이미지가 없으면 에디터로 등록한 이미지 출력하기
		if($f==1) {
			//첨부이미지가 없을경우 에디터이미지가있으면 대체 (2012_03_06)
			$pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i"; 
			preg_match($pattern,stripslashes(str_replace('&amp;','&',$list[$i][b_content])), $match);
			$only_img = substr($match['url'],1);
			if(strlen($only_img)>0) {
				$list[$i]["img_1"]="/".$only_img;
			} else {			
				$no_size=@GetImageSize($_SERVER["DOCUMENT_ROOT"].$Board_Admin["skin_dir"]."/images/no_img.gif");
				list($img_width[$i],$img_height[$i])=img_resize_size($no_size[0],$no_size[1],$Board_Admin[sum_width],$Board_Admin[sum_height]);
				$list[$i]["img_1"]="/skin/bbs/gallery_basic/images/no_img.gif";
			}			
		}		
		/*
		if($list[$i]["img_1"]==FALSE) {
			$list[$i]["img_1"] = $skin."/images/no_img.gif";
		}
		*/

			// 글내용 미리보기
			$list[$i][content] = stripslashes(str_replace('&amp;','&',htmlspecialchars(strip_tags($list[$i][b_content]))));

			$subject = stripslashes(str_replace('&amp;','&',htmlspecialchars($row["b_subject"])));

			if($list[$i]["b_dep"]!="A") {
				$list[$i]["subject"] = " └ ".cut_str($subject,$maxstring);
			} else $list[$i]["subject"] = cut_str($subject,$maxstring);

			$newdate = date("Y-m-d h:i:s",time() - 86400);
			if($row["b_modify"] > $newdate)  {
				$newch[$i] = 1;
				$list[$i]["subject"] = cut_str($list[$i]["subject"],$maxstring-5);
			} else $newch[$i] = 0;

		if($tburl=="bbs") {
			// 글보기 링크 설정
			if($_SESSION["userlevel"] >= $Board_Admin["level_view"]) {
				if($row["b_secret"]==TRUE && $row["b_dep"]=="A") {
					if($Get_Login==TRUE && Member_check($row["b_member"])==TRUE) {
						$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
					} else if($row["b_member"]==FALSE) {
						$list[$i]["latesturl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
					} else {
						$list[$i]["latesturl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
					}
				// 비밀글이며, 답변글일 경우
				} else if($row["b_secret"]==TRUE && strlen($row["b_dep"])>1) {
					// 원본글을 가져옵니다.
					$BoardSql_old = " select b_no,b_member from $BB_table where b_tno = '{$row[b_tno]}' and b_dep='A' ";
					$old = sql_fetch($BoardSql_old);
					// 관리자,원본글작성자,본글작성자가 아닐경우
						if($Get_Login==TRUE && ( Member_check($row["b_member"])==TRUE || $old["b_member"]==$_SESSION["userid"] ) ) {
							$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
						} else if($row["b_member"]==FALSE || $old["b_member"]==FALSE) {
							$list[$i]["latesturl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
						} else {
							$list[$i]["latesturl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
						}
				} else {
					$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
				}
			} else {
				$list[$i]["latesturl"] ="javascript:alert('게시글 열람 권한이 없습니다.');";
			}
		} else {
			$list[$i]["latesturl"] = $tburl.$list[$i][num];
		}

		if($row["comment"] > 0) { $list[$i]["comment"] = "(".number_format($row["comment"]).")"; } else { $list[$i]["comment"] = "";}
	}
		include $skindir."/main.php";
 }

##################################################
##########  외부 로그인 표시하기
##################################################
 function outlogin($skin="basic",$URL="") {
	 global $page_loc,$default,$ssl_url;

	 $skindir = $_SERVER["DOCUMENT_ROOT"]."/skin/outlogin/".$skin;
	 $skinurl = "/skin/outlogin/".$skin;

	 if(!$URL) $URL = "{$_SERVER[PHP_SELF]}?{$_SERVER[QUERY_STRING]}";

	 if( Login_check()==FALSE ) {
		include $skindir."/logout.php";
	 } else {
		$name	= $_SESSION["nickname"];
		$ID		= $_SESSION["userid"];
		if($_SESSION["userlevel"]==100) $admin	= "<a href='/admin/admin.php'>[관리모드]</a>";
		$Imember = get_member($ID);
		$cash = number_format($Imember["mem_cash"]);
		$point = number_format($Imember["mem_point"]);
		$memo = number_format(Get_Newmemo($ID));

		include $skindir."/login.php";
	 }

 }

##################################################
##########  인기검색어 출력 함수
##################################################
function hotsearch($num,$fontcolor="#FFFFFF",$spase=", ")
{
	global $GnTable;
	include $_SERVER["DOCUMENT_ROOT"]."/admin/search/newtext.php";

		if($isnewtext==TRUE) {
			$text = explode(" ",$isnewtext);
			$textcnt = count($text);
			$word = "";
			for ($i=0; $i<$textcnt; $i++) {
				if($i!=0) $word .= "<font color='$fontcolor'>$spase</font>";
				$word .= "<a href='/search/search.php?findword=".$text[$i]."'><font color='$fontcolor'>".$text[$i]."</font></a>";
			}
		} else {
			// 인기검색어를 불러옵니다.
			$sql = " select command from {$GnTable[search]} order by num desc limit 0,$num";
			$result = sql_query($sql);

			$word = "";
			for ($i=0; $row=mysql_fetch_array($result); $i++) {
				if($i!=0) $word .= "<font color='$fontcolor'>$spase</font>";
				$word .= "<a href='/search/search.php?findword=".$row[command]."'><font color='$fontcolor'>".$row[command]."</font></a>";
			}
		}

	return $word;
}

##################################################
##########  통합검색 코드 함수
##################################################
## 게시판 분류별 검색
function SearcH_BBSloc($skin="basic",$ctype,$num,$curstr,$order="b_no desc",$fontcolor="orange")
{
	global $GnTable,$Get_Login,$SearchWord,$SearchWord_cnt,$findword;

	if($order==FALSE) $order="b_no desc";
	if($fontcolor==FALSE) $fontcolor="orange";

	 $skindir = $_SERVER["DOCUMENT_ROOT"]."/skin/search/".$skin;
	 $skinurl = "/skin/search/".$skin;

	// 게시판 총관리 DB에서 분류에 해당하는게시판을 검색합니다.
	$sql_AB = " select dbname, title, level_list, level_view from {$GnTable[bbsconfig]} where page_loc='$ctype' ";
	$result_AB = sql_query($sql_AB);

	$where = "where ";
	// 검색어에 부합하는 데이터를 찾습니다.
	for($S=0;$S<$SearchWord_cnt;$S++) {
		if($S!=0) { $and_str = " or "; }
		$where .= " $and_str ( b_subject like '%{$SearchWord[$S]}%' or b_content like '%{$SearchWord[$S]}%' or b_writer like '%{$SearchWord[$S]}%' )";
	}

	if($S==0) {
		$where .= " 1 ";
	}

	for($AB=0; $row_AB=mysql_fetch_array($result_AB); $AB++) {
		$AdBBS[$AB] = $row_AB;
		$Table = $row_AB["dbname"];
		$BB_table = $GnTable["bbsitem"].$Table;
			// 검색합니다.
			$sql = " select * from $BB_table $where order by $order limit 0,$num";
			$result = sql_query($sql);

			for ($i=0; $row=mysql_fetch_array($result); $i++) {
				$search[$AB][$i] = $row;
		///////// 검색 필드 정리 /////////////////////////
				$NextUrl = "findType=title&findWord=$findword";
				// 글보기 링크 설정
					if($_SESSION["userlevel"] >= $Board_Admin["level_view"]) {
						if($row["b_secret"]==TRUE && $row["b_dep"]=="A") {
							if($Get_Login==TRUE && Member_check($row["b_member"])==TRUE) {
								$search[$AB][$i]["gourl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
							} else if($row["b_member"]==FALSE) {
								$search[$AB][$i]["gourl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
							} else {
								$search[$AB][$i]["gourl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
							}
						// 비밀글이며, 답변글일 경우
						} else if($row["b_secret"]==TRUE && strlen($row["b_dep"])>1) {
							// 원본글을 가져옵니다.
							$BoardSql_old = " select b_no,b_member from $BB_table where b_tno = '{$row[b_tno]}' and b_dep='A' ";
							$old = sql_fetch($BoardSql_old);
							// 관리자,원본글작성자,본글작성자가 아닐경우
								if($Get_Login==TRUE && ( Member_check($row["b_member"])==TRUE || $old["b_member"]==$_SESSION["userid"] ) ) {
									$search[$AB][$i]["gourl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
								} else if($row["b_member"]==FALSE || $old["b_member"]==FALSE) {
									$search[$AB][$i]["gourl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
								} else {
									$search[$AB][$i]["gourl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
								}
						} else {
							$search[$AB][$i]["gourl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
						}
					} else {
						$search[$AB][$i]["gourl"] ="javascript:alert('게시글 열람 권한이 없습니다.');";
					}
				$search[$AB][$i][subject] = $row[b_subject];
				$search[$AB][$i][content] = $row[b_content];
				$search[$AB][$i][writer] = $row[b_writer];
		///////// 검색 내용 정리 /////////////////////////
				for($S=0;$S<$SearchWord_cnt;$S++) {
					$search[$AB][$i][subject] = str_replace($SearchWord[$S],"<font color='$fontcolor'><strong>{$SearchWord[$S]}</strong></font>",$search[$AB][$i][subject]);
					$search[$AB][$i][content] = str_replace($SearchWord[$S],"<font color='$fontcolor'><strong>{$SearchWord[$S]}</strong></font>",$search[$AB][$i][content]);
					$search[$AB][$i][writer] = str_replace($SearchWord[$S],"<font color='$fontcolor'><strong>{$SearchWord[$S]}</strong></font>",$search[$AB][$i][writer]);
				}
			}

			$AdBBS[$AB]['total'] = count($search[$AB]);
	}
	$AdBBS_total = count($AdBBS);
	include $skindir."/bbs.php";
}

function extSep($file_name)
{
	$arr_name = explode(".",$file_name);
	$ext = strtolower($arr_name[sizeof($arr_name)-1]);
	return $ext;
}

//이미지리사이즈태그(New)
function img_resize_tag($img_fsrc,$wsize,$hsize,$add_tag="",$no_img="",$noresize=""){
	$image = $_SERVER["DOCUMENT_ROOT"].$img_fsrc;
	if(file_exists($image) == false || !$img_fsrc) {
		if (!$no_img) $no_img="/skin/bbs/gallery_basic/images/no_img.jpg"; 
		$image=$_SERVER["DOCUMENT_ROOT"].$no_img;
		$img_fsrc=$no_img;
	}
	$size = getimagesize($image);
	$width=$size[0];
	$height=$size[1];
	
	if ($noresize) {
		$resize_arr[0]=$size[0];
		$resize_arr[1]=$size[1];
	}
	else {
		list($resize_arr[0],$resize_arr[1]) = img_resize_size($width,$height,$wsize,$hsize);
	}
	$return_value="<img src='{$img_fsrc}' width='{$resize_arr[0]}' height='{$resize_arr[1]}' {$add_tag}>";
	return $return_value;
} 

//이미지리사이즈태그(New)
function img_resize_tag2($img_fsrc,$wsize,$hsize,$add_tag="",$no_img="",$noresize=""){
	$image = $_SERVER["DOCUMENT_ROOT"].$img_fsrc;
	if(file_exists($image) == false || !$img_fsrc) {
		if (!$no_img) $no_img="/skin/bbs/gallery_basic/images/no_img.jpg"; 
		$image=$_SERVER["DOCUMENT_ROOT"].$no_img;
		$img_fsrc=$no_img;
	}
	$size = getimagesize($image);
	$width=$size[0];
	$height=$size[1];
	
	if ($noresize) {
		$resize_arr[0]=$size[0];
		$resize_arr[1]=$size[1];
	}
	else {
		list($resize_arr[0],$resize_arr[1]) = img_resize_size($width,$height,$wsize,$hsize);
	}
	$return_value="<img src='http://{$_SERVER[SERVER_NAME]}{$img_fsrc}' width='{$resize_arr[0]}' height='{$resize_arr[1]}' {$add_tag}>";
	return $return_value;
} 

//이미지리사이즈(신)
function img_resize_size($width,$height,$wsize,$hsize){
	$rwidth = $wsize ? $wsize:"150";  //입력받은값
	$rheight = $hsize ? $hsize:"130"; //입력받은값

	if($width < $wsize && $height < $hsize) {
		$result_w=$width;
		$result_h=$height;
	}
	else {
		if($width > $height || ($width == $height && $rwidth < $rheight)){ //리사이즈가 넓이가 높이보다 클때
			$rate = $width / $rwidth;
			$result_w = $rwidth;
			$result_h = round(($height / $rate));
			if ($result_h>$rheight) { //최종리사이즈의 높이값이 최대높이를 초과할때
				$rate=$result_h / $rheight;
				$result_h = $rheight;
				$result_w = round(($result_w / $rate));
			}
		}
		elseif($width < $height|| ($width == $height && $rwidth > $rheight)){ //리사이즈가 높이가 넓이보다 클때
		   $rate = $height / $rheight;
		   $result_w = round(($width / $rate));
		   $result_h = $rheight;
		   if ($result_w>$rwidth) { //최종리사이즈의 넓이값이 최대넓이를 초과할때
				$rate=$result_w / $rwidth;
				$result_w = $rwidth;
				$result_h = round(($result_h / $rate));
		   }
		}
		else {	
		   $result_w=$rwidth;
		   $result_h=$rheight;
		}	
	} 
	//$return_value=array($result_w,$result_h);
	$return_value= array($result_w,$result_h);

	return $return_value;
}



//이미지리사이즈태그(위치로받기)
function img_resize_size_src($img_fsrc,$wsize,$hsize){
	$image = $_SERVER["DOCUMENT_ROOT"].$img_fsrc;
	if(file_exists($image) == false || !$img_fsrc) {
		if (!$no_img) $no_img="/skin/bbs/gallery_basic/images/no_img.jpg"; 
		$image=$_SERVER["DOCUMENT_ROOT"].$no_img;
		$img_fsrc=$no_img;
	}
	$size = getimagesize($image);
	$width=$size[0];
	$height=$size[1];
	
	if ($noresize) {
		$resize_arr[0]=$size[0];
		$resize_arr[1]=$size[1];
	}
	else {
		$resize_arr=explode("|",img_resize_size($width,$height,$wsize,$hsize));
	}
	$return_value="{$resize_arr[0]}|{$resize_arr[1]}";
	return $return_value;
} 


//2009.4.3 imgresize
//ImgResize($img[$i][0],$img[$i][1],"width","124","105");
function ImgResize($width,$height,$wsize,$hsize){
	$rwidth = $wsize ? $wsize:"150";  //입력받은값
	$rheight = $hsize ? $hsize:"130"; //입력받은값
	
	/*
	if($width == $height){	//이미지가 넓이와 높이가 같을때
		$vwidth = $rwidth;  // 150
		$vheight = $rheight;// 130
	}elseif($width > $height){	//이미지가 넓이가 높이보다 클때
		$vwidth = $rwidth;
		$vheight = round(($height*$rwidth)/$width);
	}else{	//이미지가 높이가 넓이보다 클때
		$vwidth = round(($width*$rheight)/$height);
		$vheight = $rheight;
	}
	*/

	if($width > $height || $width == $height){	//리사이즈가 넓이가 높이보다 클때
		$rate = round(($width / $rwidth));
		
		$result_w = $rwidth;
		$result_h = round(($height / $rate));
	}elseif($width < $height){	//리사이즈가 높이가 넓이보다 클때
		$rate = round(($height / $rheight));
		
		$result_w = round(($width / $rate));
		$result_h = $rheight;
	}
	
	$value = $result_w."|".$result_h;
	return $value;
}

function Get_dbname($dbname){
	global $GnTable;
	$row = sql_fetch("SELECT * FROM {$GnTable[bbsconfig]} where dbname='$dbname' ");
	
	return $row[title];
}
function AllTable($nowtable,$typedbname){
	global $GnTable;
	
	$row = sql_fetch("SELECT * FROM {$GnTable[bbsconfig]} where dbname='$nowtable' ");
	$selectdbname = explode("=",$row[copymove]);
	
	$view = "<div style=\"position:relative;\">\n";
	$view.= "<div id=\"dbname_view\" style=\"position:absolute;display:none;top:-2px;left:-350px;width:300px;height:22px;overflow:hidden;\">\n";
	$view.= "<select name=\"dbname\" onchange=\"BbsSelectCategory(this.value,'bbs_category')\">\n";
	$view.= "	<option value=\"\">선택해 주십시오.</option>\n";
	for($i=0;$i<count($selectdbname);$i++){
		if($selectdbname[$i]!="") $view.= "	<option value=\"".$selectdbname[$i]."\">".Get_dbname($selectdbname[$i])."</option>\n";
	}
	$view.= "</select>\n";
	
	$view.= "<select name=\"bbs_category\" id=\"bbs_category\" style=\"visibility:hidden;\" onchange=\"second_category(this.value);\">\n";
	$view.= "<option value=\"\"> ::: 카테고리 선택 ::: </option>\n";
	$view.= "</select>\n";
	$view.= "<iframe name=\"ifm_bbs_select_category\" width=\"600\" height=\"400\" style=\"display:none;\"></iframe>\n";
	$view.= "<script>\n";
	$view.= "function second_category(f){\n";
	$view.= "	document.ListCheck.tablecategory.value=f;\n";
	$view.= "}\n";
	$view.= "function BbsSelectCategory(code,next){\n";
	$view.= "	$typedbname.value=code;\n";
	$view.= "	document.ListCheck.tablecategory.value=\"\";\n";
	$view.= "	if(code!=\"\"){\n";
	$view.= "		var sub = document.getElementById(\"ifm_bbs_select_category\").contentWindow.document;\n";
	$view.= "		sub.location.replace(\"/bbs/bbs_copy_category.php?code=\"+code+\"&next=\"+next);\n";
	$view.= "	}\n";
	$view.= "}\n";
	$view.= "</script>\n";
	
	$view.= "</div>\n";
	$view.= "</div>\n";
    
	return $view;
}
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = preg_replace("/ /", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
}

//샵카테고리한글명
function category_name($number){
	global $GnTable;
	$sql="select ca_name from {$GnTable[shopcategory]} where ca_id='{$number}' ";
	$row_leb=sql_fetch($sql);
	return $row_leb[ca_name];
}

//샵아이템한글명
function item_name($number){
	global $GnTable;
	$sql="select it_name from {$GnTable[shopitem]} where it_id='{$number}' ";
	$row_leb=sql_fetch($sql);
	return $row_leb[it_name];
}

//멤버등급한글명
function level_name($number){
	global $GnTable;
	$sql="select leb_name from {$GnTable[memberlevel]} where leb_level='{$number}' ";
	$row_leb=sql_fetch($sql);
	return $row_leb[leb_name];
}

//게시판메뉴셀렉트박스
function group_select($db_value) {
	global $GnTable;
	$sql="select gr_id,gr_name from {$GnTable[bbsgroup]} ORDER BY gr_id ASC";
	$res_group=sql_query($sql);
	for ($f=0; $row_group=mysql_fetch_array($res_group); $f++) {
		$len = strlen($row_group[gr_id]) / 2 - 1;
		if (strlen($row_group[gr_id])=="2") $style="style='color:blue;'";
		else $style="";
		$nbsp = "";
		for ($j=0; $j<$len; $j++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;";
		}
		if ($row_group[gr_id]==$db_value) $selected="selected";
		else $selected="";
		$value.="<option value='{$row_group[gr_id]}' {$selected} {$style}>{$nbsp}{$row_group[gr_name]}</option>";
	}
	return $value;
}

//게시판메뉴명
function group_name($db_id){
	global $GnTable;
	$sql="select gr_name from {$GnTable[bbsgroup]} where gr_id='{$db_id}' ";
	$row_group=sql_fetch($sql);
	return $row_group[gr_name];
}

function set_session($session_name, $value)
{
    if (PHP_VERSION < '5.3.0'){
		if (!function_exists('session_register')){
			$$session_name = $_SESSION[$session_name] = $value;
		}else{
			session_register($session_name);
			 $$session_name = $_SESSION[$session_name] = $value;
		}
    // PHP 버전별 차이를 없애기 위한 방법
	}else{
		$$session_name = $_SESSION[$session_name] = $value;
	}
}

// 세션변수값 얻음
function get_session($session_name)
{
    return isset($_SESSION[$session_name]) ? $_SESSION[$session_name] : '';
}

function Get_list_array($table="", $add_sql=""){
	$query = mysql_query("select * from ".$table." ".$add_sql);
	while($rows = mysql_fetch_array($query)){
		$list[] = $rows;
	}
	return $list;
}
/*추가*/
function cfm_go($chkMSG,$denyMSG,$TO){
	echo "
	<script language='javascript'>
	<!--
	var chk = confirm('$chkMSG');
	if(chk == true){
	location.replace('$TO');
	}else{
	alert('$denyMSG');
	}
	//-->
	</script>
	";
}
function f_go($TO){
	echo "
	<script language='javascript'>
	<!--
	parent.location.replace('$TO');
	//-->
	</script>
	";
}


function get_it_name($it_id, $gubun) {
    global $GnTable;
    if($gubun == "PRODUCT") {
        $db_table = $GnTable[proditem];
    } else if ($gubun == "SHOP"){
        $db_table = $GnTable[shopitem];
    }
 
    $sql = "SELECT it_name FROM {$db_table} WHERE it_id='".$it_id."'";
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
 
    $this_it_name = $row[it_name];
    return $this_it_name;
}

// 생성은 있는데 폴더와 하위 모든파일들을 삭제시키는 처리가 되어있지 않다.
// 디렉토리내의 모든 파일 삭제시키기 추가 20141103 mj
function directoryDelete($dir) 
{ 
   if(substr($dir, -1)!='/') { $dir = $dir.'/'; } 
   else { $dir = $dir; } 

   if(is_dir($dir)) { 
       if ($dh = opendir($dir)) { 
           $i = 0; 
           while (($file = readdir($dh)) !== false) 
           { 
               if(($file!='.' && $file!='..') && (filetype($dir . $file)!='dir')) { 
                   $filename[$i] = $file; 
                   $i++; 
               } else if(($file!='.' && $file!='..') && (filetype($dir . $file)=='dir')) { 
                   //재귀함수로 하위 디렉토리를 일괄 삭제한다. 
                   directoryDelete($dir.$file); 
               } 
           } 
           closedir($dh); 
       } 
        
       for($ii = 0 ; $ii < $i ; $ii++) 
       { 
           if(!unlink($dir . $filename[$ii])){ echo "파일삭제실패"; exit; } 
       } 
       rmdir($dir); 
       return true; 
   } 
   return true; 
}


// 유일키를 생성
function get_unique_code($len=32)
{
	global $GnTable;
    $unique = false;
    srand(time());
    do
    {
        $uid = substr(md5(rand()),0,$len);

        // 혹시 장바구니에도 겹치는게 있을 수 있으므로 ...
        $sql = "select COUNT(*) as cnt from {$GnTable[shopcart]} where on_uid = '$uid' ";
        $result = sql_query($sql);
        $row = mysql_fetch_array($result);
        $cnt = $row[cnt];
        if ($cnt == 0)
            $unique = true;
        mysql_free_result($result);
    }
    while ($unique == false);

	return $uid;
}


// 파일풀네임을 인자로받아 파일의 확장자를 반환한다. ( .txt  .jpg .gif .exe 와 같이 . 이 붙은 형태로 반환)  mj
function get_file_ext($file_fullname) {
	$upload_file_name_array = explode(".",$file_fullname);
	$upload_file_ext = ".".$upload_file_name_array[count($upload_file_name_array) - 1];
	return $upload_file_ext;
}

// 파일풀네임을 인자로 받아 이미지 확장자인지 검사후 TRUE,FALSE 반환 mj
function check_img_type($file_fullname) {
	// 확장자 구함
	$upload_file_name_array = explode(".",$file_fullname);
	$upload_file_ext = $upload_file_name_array[count($upload_file_name_array) - 1];
	
	// 이미지 확장자 정의
	$img_ext = array("gif","GIF","jpg","JPG","jpg","JPEG","png","PNG");
	return in_array($upload_file_ext,$img_ext);
}

/*--------------------------------------------------------------------------------------------------------------------
|	get_category_full_name // SHOP, PRODUCT 관리자 분류관리연동 - 자동 타이틀 생성 - Start
|----------------------------------------------------------------------------------------------------------------------
|
|	관리자 분류관리와 연동된 풀 분류네임을 생성해 출력한다.
|	ex)	더마비쥬얼스 > 클렌징 > 클렌징폼
|	ex)	마지막 카테고리에는 특정 클래스를 주거나 스타일을 줘서 마무리(함수수정필요)
|	
|	- 현재 카테고리를 인자로 받아 현재 카테고리의 길이를 구하고 현재카테고리의 길이가 될때까지
|	- 2자리씩 더하면서 전체 카테고리 네임을 만든다.
|
|	// gubun : SHOP,PRODUCT 둘중 하나 전달
|	// ca_id	: 카테고리 아이디
|
|	2015 - MJ																									*/

function get_category_full_name($gubun, $ca_id) {
	if($gubun=="SHOP") { $category_table = "Gn_Shop_Category"; } 
	else if($gubun=="PRODUCT") { $category_table = "Gn_Product_Category"; }

	$ca_id_length = strlen($ca_id);
	for($p=0; $p<=$ca_id_length; $p=$p+2) {
		$search_ca_id = substr($ca_id,0,$p);
		$get_ca_name_sql = " SELECT * FROM ".$category_table." WHERE ca_id='".$search_ca_id."' ";
		$get_ca_name_query = mysql_query($get_ca_name_sql);
		$get_ca_name_row = mysql_fetch_array($get_ca_name_query);

		// 카테고리 네임이 있을때만 변수 만들기
		if($get_ca_name_row[ca_name] != "") {
			// 현재카테고리가 해당분류의 마지막 분류라면 굵게 표시
			if($p == $ca_id_length) {
				$full_ca_name .= "<span class='blue' >".$get_ca_name_row[ca_name]."</span>";
			} else {
				$full_ca_name .= $get_ca_name_row[ca_name];
			}
			// 마지막에 > 기호 안붙이기 위함
			if($ca_id_length > $p) {
				$full_ca_name .= " > ";
			}
		}
	}
	return $full_ca_name;
}
/*-------------------------------------------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------------------------------------------------------
|	검색 쇼핑몰,프로덕트 전용 - Start
|---------------------------------------------------------------------------------------------------------------------------
|
|	해당폼으로 넘기는 item_search 값은 /shop/list.php or /product/list.php 파일에 이미 처리되어있다.
|	쇼핑몰 상품을 검색하려면 인자로 'SHOP' 을 전달 
|	제품관리 상품을 검색하려면 인자를 'PRODUCT'로 전달만 해주면 끝.
|	
|	function item_search_form(gubun)
|	// gubun :	'SHOP' or 'PRODUCT'
|
|	사용 할 곳에서 아래와 같은 형태로 호출
|	ex) <?=item_search_form("SHOP")?>			// 쇼핑몰 검색
|	ex) <?=item_search_form("PRODUCT")?>	// 제품관리 검색
|	
|	2015 - MJ
|
*/
function item_search_form($gubun) 
{
	$gubun = strtoupper($gubun);
	?>
	<script type="text/javascript">
	function search_ok(form) 
	{
		var gubun = "<?=$gubun?>";

		var search_value = form.item_search.value;
		if( search_value=="" ) 
		{
			alert("검색하실 제품명을 입력하세요.");
			form.item_search.focus();
			return false;
		}
		
		// 쇼핑몰, 제품관리 구분
		if (gubun=="SHOP") {
			form.action = "/shop/list.php";
		}
		else if (gubun == "PRODUCT")
		{
			form.action = "/product/list.php";
		}
		else 
		{
			form.action = "/shop/list.php";
		}

		form.submit();
		return;
	}
	</script>
	<form name="gosearch" method="POST" onsubmit="search_ok(this); return false;">
	<input name="item_search" id="item_search" type="text" placeholder="검색어를 입력하세요." value="<?=$search?>" />
	<input type="submit" value="SEARCH"  class="submit" src="/images/main_img/submit.jpg" />
	<!-- <input type="image" value="SEARCH"  class="submit" src="/images/main_img/submit.jpg" /> 이미지사용시 경로설정 -->
	</form>
	<?
}
/*
|--------------------------------------------------------------------------------------------------------------------------------
|	검색 쇼핑몰, 프로덕트 전용 - End
|-------------------------------------------------------------------------------------------------------------------------------*/

/*
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	다중 게시판 최근게시물 추출 - Start
|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|	- 배열로 다수의 테이블이름들을 선언하고 그 배열값으로 유니온 쿼리하여 최신날짜순으로 정렬
|
|	@ $arr_table			:	테이블이름 배열선언 ex) $arr_table = array("bbs64","bbs63","bbs62","bbs61","bbs53","bbs5","bbs43","bbs4","bbs33","bbs3");
|	@ $skinname		:	/skin/latest/ 디렉토리내의 사용할 디렉토리명
|	@ $show_count		:	출력할 라인수
|	@ $subject_length	:	출력할 제몰 글자수
|	@ $search			:	ORDER BY 정렬 쿼리
|
|	201611 - KH
|
*/
function latest_array( $arr_table, $skinname, $show_count, $subject_length, $search="ORDER by b_regist DESC, b_notice DESC, b_tno DESC, b_dep DESC, b_no DESC" ) {
	global $GnTable, $Get_Login;

	// 스킨 디렉토리 설정
	$skindir = $_SERVER["DOCUMENT_ROOT"]."/skin/latest/".$skinname;
	$skin = "/skin/latest/".$skinname;
	
	// 다중 게시판용 합치기 - 유니온 쿼리 -----------------------------------------------------------------
	for($i=0; $i < count($arr_table); $i++) {
		if($i != 0) { $union_add = " UNION "; }		//	두번째열부터 union 추가
		$union_sql .= $union_add." SELECT * FROM ".$GnTable["bbsitem"]."".$arr_table[$i];
	}
	$union_sql .= " ".$search." LIMIT ".$show_count;
	$union_query = sql_query($union_sql);
	$list_total = mysql_num_rows($union_query);
	// -------------------------------------------------------------------------------------------------------------
	
	// 출력 $list 변수 생성
	for( $i=0;$i<$list_total;$i++ ) {
		$list[$i] = sql_fetch_array($union_query);
		$list[$i]["subject"] = cut_str($list[$i]["b_subject"],$subject_length-5);
		$Table = $list[$i]['dbname'];
		$BB_table = $GnTable["bbsitem"].$Table;

		// 게시판 설정 내용을 불러옵니다.
		$BoardSql = " select* from {$GnTable[bbsconfig]} where dbname = '$Table' ";
		$Board_Admin = sql_fetch($BoardSql);

		// 파일 테이블에서 해당하는 파일 정보를 불러옵니다.
		$Get_File_sql= "select* from {$GnTable[bbsfile]} where bf_table = '$Table' and bf_tno = '{$list[$i][b_no]}' ";
		$Get_File_result = sql_query($Get_File_sql,FALSE);
		//다운파일이 있으면
		for ($f=1; $Get_File=sql_fetch_array($Get_File_result,FALSE); $f++) {
			if($Get_File["bf_save_name"] && $Board_Admin["use_data"]==TRUE) {
				##### 등록파일이 있을경우
					$getsavename = $Get_File["bf_save_name"];
					$getfilename = $Get_File["bf_real_name"];
					//이미지 파일의 경우 화면에서 출력
					$size=@GetImageSize($_SERVER["DOCUMENT_ROOT"]."/bbs/data/$Table/".$getsavename);	// 이미지 싸이즈 추출
					$resize = ($size[0]> $Board_Admin["imgsize"]) ? $Board_Admin["imgsize"] : $size[0];

					$ext = file_type($getfilename);

					if(!strCmp($ext,"jpeg") || !strCmp($ext,"jpg") || !strCmp($ext,"gif") || !strCmp($ext,"png") || !strCmp($ext,"bmp")) {
						if ($Board_Admin[sum_flag]=="1" && file_exists($_SERVER[DOCUMENT_ROOT]."/bbs/data/$Table/sum_{$getsavename}")){
							$sum_key="sum_";
						}else {
							$sum_key="";
						}
						$list[$i]["img_".$f] = "/bbs/data/$Table/{$sum_key}{$getsavename}";
					} else if(!strCmp($ext,"mov") || !strCmp($ext,"wmv") || !strCmp($ext,"avi") || !strCmp($ext,"asf") || !strCmp($ext,"asx") || !strCmp($ext,"mpeg") || !strCmp($ext,"mpg")) {
						$list[$i]["img_".$f] = "{$Board_Admin[skin_dir]}/images/media_img.gif";
					} else {
						$list[$i]["img_".$f] = "{$Board_Admin[skin_dir]}/images/no_img.gif";
					}
			}
		}


		// 글보기 링크 설정
		$row = $list[$i];
		/* ------------------------------------------------------------- [ 기존 최신글 보기 소스 - START ] ------------------------------------------------------------- */
		if($_SESSION["userlevel"] >= $Board_Admin["level_view"]) {
			if($row["b_secret"]==TRUE && $row["b_dep"]=="A") {
				if($Get_Login==TRUE && Member_check($row["b_member"])==TRUE) {
					$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
				} else if($row["b_member"]==FALSE) {
					$list[$i]["latesturl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
				} else {
					$list[$i]["latesturl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
				}
			// 비밀글이며, 답변글일 경우
			} else if($row["b_secret"]==TRUE && strlen($row["b_dep"])>1) {
				// 원본글을 가져옵니다.
				$BoardSql_old = " select b_no,b_member from $BB_table where b_tno = '{$row[b_tno]}' and b_dep='A' ";
				$old = sql_fetch($BoardSql_old);
				// 관리자,원본글작성자,본글작성자가 아닐경우
					if($Get_Login==TRUE && ( Member_check($row["b_member"])==TRUE || $old["b_member"]==$_SESSION["userid"] ) ) {
						$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
					} else if($row["b_member"]==FALSE || $old["b_member"]==FALSE) {
						$list[$i]["latesturl"] = "/bbs/board.php?tbl=$Table&mode=PASS&type=VIEW&num={$row[b_no]}&$NextUrl";
					} else {
						$list[$i]["latesturl"] ="javascript:alert('비밀글입니다.\n\n열람하실 수 없습니다.');";
					}
			} else {
				$list[$i]["latesturl"] ="/bbs/board.php?tbl=$Table&mode=VIEW&num={$row[b_no]}&$NextUrl";
			}
		} else {
			$list[$i]["latesturl"] ="javascript:alert('게시글 열람 권한이 없습니다.');";
		}
		/* ------------------------------------------------------------- [ 기존 최신글 보기 소스 - END ] ------------------------------------------------------------- */

	}
	// 스킨 호출
	include $skindir."/main.php";
}
/*
|
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|	다중 게시판 최근게시물 추출 - End
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
?>