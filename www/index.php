<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	if (is_file("./opentest.php")) {
		include "./opentest.php";
	} else {
		if(THIS_AEGNT == "mobile"){
			//include "./mobile/main.php";//������۾� �Ϸ�� �ּ� ����
			//include "./curriculum.php";
			include "./mobile/curriculum.php";
		}else{
			include "./curriculum.php";
		}
	}
?>