<?
	include $_SERVER["DOCUMENT_ROOT"]."/admin/lib/lib.php"; 

	$PG_table = $GnTable["online"];

	if(!$URL) $URL = "/mobile/online/online.php?type=$type";

if($type=="") alert("���������� ������ּ���");

if($mode=="") {			//////////////////  ���� �Է��ϱ� //////////////////////////////////////////////////////////////////////////////////

	$online_Invalue = "";
	for($i=1;$i<=3;$i++) {
		##### ��������� �������
		if ($_FILES["userfile".$i]["name"])
		{

			$ext = file_type($_FILES["userfile".$i]["name"]);
			if(!strCmp($ext,"php") || !strCmp($ext,"htm") || !strCmp($ext,"html") || !strCmp($ext,"inc") || !strCmp($ext,"shtm") || !strCmp($ext,"ztx") || !strCmp($ext,"dot") || !strCmp($ext,"cgi") || !strCmp($ext,"pl") || !strCmp($ext,"phtm") || !strCmp($ext,"ph") || !strCmp($ext,"exe")) {
				alert("�ش� ������ ���ε��� �� ���� �����Դϴ�.","");
				exit;
			}

			// ���������̸� ����
			$Upfile_Oname[$i] = $_FILES["userfile".$i]["name"];

			// ����Ʈ ���˿�
			$site_url = $default["site_url"];

			// �����̸� ����üũ
			$Upfile = explode(".",$_FILES["userfile".$i]["name"]);
			$Upfile_total = count($Upfile) - 1;

			$Upfile_Rename[$i] = $Upfile[0].".".$Upfile[$Upfile_total];

			// �����̸� �ߺ�üũ
			$bimg = $G_online["data_dir"]."/".$Upfile_Rename[$i];
			for($pn = 1; file_exists($bimg); $pn++) {
				$Upfile_Rename[$i] = $Upfile[0]."_($pn).".$Upfile[$Upfile_total];
				$bimg = $G_online["data_dir"]."/".$Upfile_Rename[$i];
			}
			upload_file($_FILES["userfile".$i]["tmp_name"], $Upfile_Rename[$i], $G_online["data_dir"]."/");

			$online_Invalue .= ", userfile{$i} =  '$Upfile_Rename[$i]' ";
		}
	}

	///������� ������ ������ �������ݽô� ��������������///
	$subject 			= addslashes($subject);
	$content			= addslashes($content);

	if(is_array($option1)==TRUE) $option1 			= @implode("|",$option1);
	if(is_array($option2)==TRUE) $option2 			= @implode("|",$option2);
	if(is_array($option3)==TRUE) $option3 			= @implode("|",$option3);
	if(is_array($option4)==TRUE) $option4 			= @implode("|",$option4);
	if(is_array($option5)==TRUE) $option5 			= @implode("|",$option5);

	$option1 			= addslashes($option1);
	$option2 			= addslashes($option2);
	$option3 			= addslashes($option3);
	$option4 			= addslashes($option4);
	$option5 			= addslashes($option5);

	if($retime_h) $visiteDate		= mktime($retime_h, 0, 0, $retime_m, $retime_d, $retime_y);

	$retime			= time();
	///������� ������ ������ �������ݽô� ��������������///

	$qry =" insert into $PG_table
				set	type				= '$type',
						username		= '$username', 
						subject			= '$subject', 
						phone			= '$phone',
						mobile			= '$mobile',
						fax				= '$fax',
						email				= '$email',
						option1			= '$option1',
						option2			= '$option2',
						option3			= '$option3',
						option4			= '$option4',
						option5			= '$option5',
						content			= '$content',
						visiteDate		= '$visiteDate',
						regist				= '$retime',
						link1				= '$link1',
						link2				= '$link2',
						site				= '{$default[site_code]}'
						$online_Invalue
			";

	sql_query($qry);

	// ��ϵ� ���� ��ȣ�� �ҷ��ɴϴ�.
	$num = mysql_insert_id();
	$_SESSION["OnlineNum"] = $num;

	//�����ڿ��� ���� ������
	$to = $username;
	if($email==""){$Receiver = "help@test.net";}//�����¸���//
	else{$Receiver = $email;}
	
	$fname = $default["site_name"];
	//$fmail = "sagsin@naver.com";//�޴� ����//
	$fmail = $default["admin_email"];
	$subject = "$to ���� ��� ��û�Ͽ����ϴ�.";

	
	ob_start();
	include $_SERVER["DOCUMENT_ROOT"]."/mobile/skin/online/type.skin.php";
	$content = ob_get_contents();
	ob_end_clean();

		if($default[email_flag] == "������"){
			include $_SERVER[DOCUMENT_ROOT]."/admin/lib/Smtp.class.php";
			$mail = new Smtp("121.78.91.210");
			$mail->send($to."|".$Receiver, $fname."|".$fmail, $subject, $content);	
		}else{
			mailer($to, $Receiver, $fmail, $subject, $content, 1);
		}
	//mailer($to, $Receiver, $fmail, $subject, $content, 1);

	//���� ��ϵǾ� List�� �̵�
	alert("���� ��ϵǾ����ϴ�.",$url);
} 
?>