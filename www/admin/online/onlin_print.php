<?
include "../lib/lib2.php";
if(!$tbl) $tbl = "online";

    //header('Content-Type: text/x-csv');
		header('Content-Type: doesn/matter');
		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Content-Disposition: attachment; filename="' . date("ymd", time()) . '.csv"');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');

	if($findword != "") $find = "and `".$findType."` like '%".$findword."%' ";

	$re = $DB->SELECT($tbl,'*',"where type = '$type' ".$find." order by num desc");

	if($type)  { 
		echo "무료상담신청서\n"; 
		echo "번호,신청인,전화(연락처),제목,상담내용,등록일\n";
	} else { 
		echo "빠른상담신청서\n"; 
		echo "번호,신청인,전화(연락처),주소,이메일,나이,키,몸무게,상담내용,등록일\n";
	}


	for($i=0;$i<$re[cnt];$i++){
		$row = $DB->ARR($re[result]);

        echo '"' . $row[typenum] . '"' . ',';
        echo '"' . $row[username] . '"' . ',';
        echo '"' . $row[phone] . '"' . ',';
		if(!$type)  { 
			echo '"' . $row[option4] . '"' . ',';
			echo '"' . $row[email] . '"' . ',';
			echo '"' . $row[option1] . '"' . ',';
			echo '"' . $row[option2] . '"' . ',';
			echo '"' . $row[option3] . '"' . ',';
		} else {
			echo '"' . $row[subject] . '"' . ',';
		}
		echo '"' . $row[content] . '"' . ',';
        echo '"' . date("Y/m/d H시",$row[regist]) . '"';
        echo "\n";
    }
    if ($i == 0)
        echo "자료가 없습니다.\n";

    exit;
?>