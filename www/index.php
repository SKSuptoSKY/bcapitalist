<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	if (is_file("./opentest.php")) {
		include "./opentest.php";
	} else {
		if(THIS_AEGNT == "mobile"){
			//include "./mobile/main.php";//모바일작업 완료시 주석 해제
			//include "./curriculum.php";
			include "./mobile/curriculum.php";
		}else{
			include "./curriculum.php";
		}
	}
?>