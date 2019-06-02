<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<%' on error resume Next %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<%

	set Upload=server.createobject("ABCUpload4.XForm")'XForm객체 생성
	
	' UTF-8 의 한글입력을 위해 반드시 작성해주세요
	Upload.CodePage = 65001

	cmId = Upload("cmId")(1)

%>
<!-- #include virtual = "board/common/boardConfigUpload.asp" -->

<%
	DB.BeginTrans
	update_image = Upload("imgfile")(1)

	'response.write update_image
	'response.write gSubFileUploadSize & "<br>"
	'response.write boardBCAUploadPath & "<br>"
	
	'response.end
	
	If gSubFileUploadSize = "" Or IsNull(gSubFileUploadSize) Then 
		gSubFileUploadSize = 1024 * 1024 * 10
	End If 

	Upload.Maxuploadsize = gSubFileUploadSize  '최대 파일 사이즈 지정     
	Upload.AbsolutePath = True '절대 경로로 접근    
	Upload.Overwrite = True '같은 파일 있을 때 덮어쓰기 가능으로 설정    
	fileSaveDir = boardBCAUploadPath 'upload 패스     

	'response.write fileSaeDir
	'Upload.CodePage = 949 'euc-kr로 인코딩 한글텍스트와 파일이름을 받기위함.     
	upname = Upload("upname")    '엔코딩 되어 넘어오기 때문에 때문에 form방식을 사용하지 못한다.    
	'일반 텍스트항목등도 XForm객체를 이용하여 받아야만 한다.    
	'단 QueryString(get방식)의 경우는 기존과 같이 받을 수 있다.    
	'enctype="multipart/form-data"         
	Dim fso, fldr

	SET fso = CreateObject("Scripting.FileSystemObject") '파일시스템 오브젝트 생성         
	IF NOT(fso.FolderExists(fileSaveDir)) Then ' 폴더가 없으면        
		SET fldr = fso.CreateFolder(fileSaveDir) '폴더 생성    
	END If

	'SET fso = NOTHING  '오브젝트 생성 해제    

			
			'SQLQQ = "SELECT (NVL(MAX(F_ID),0) + 1) AS F_ID FROM BOARD_FILE"
			'Set rsqq = DB.execute(SQLQQ)

				If Upload("imgfile")(1) <> "" Then 
					Set getfile = Upload("imgfile")(1)     'XField객체를 생성하여 파일가져오기 (input file name을 써준다.)  
					
					If getfile.FileExists Then 
						strFileName = getfile.SafeFileName
						FileSize = getfile.Length
						FileType = getfile.FileType
						if getfile.Length > CDbl(gSubFileUploadSize) then
							Response.Write "<script language=javascript>"
							Response.Write "alert(""파일용량이 초과되었습니다."");"
							Response.Write "history.back();"
							Response.Write "</script>"
							Response.end
						else
							strFileWholePath = GetUniqueName(strFileName, fileSaveDir)
							
							response.write strFileWholePath
							'response.end
							getfile.Save fileSaveDir&strFileWholePath

%>
							<script language=javascript>
								//parent.parent.insertIMG('http://image.weaidyou.co.kr/sns/upload/". $file_upload ."');
								parent.opener.parent.insertIMG('<%=boardBCAUploadPathURL%><%=strFileWholePath%>');
								//parent.opener.parent.oEditors.getById["caContent"].exec("SE_TOGGLE_FILEUPLOAD_LAYER");
								//window.location="imgupload.asp";
								parent.window.close();
							</script>
<%

						End if
					End if
				End If 

Function GetUniqueName(byRef strFileName, DirectoryPath)
 
		Dim strName, strExt
		strName = Mid(strFileName, 1, InstrRev(strFileName, ".") - 1) ' 확장자를 제외한 파일명을 얻는다.
		strExt = Mid(strFileName, InstrRev(strFileName, ".") + 1) '확장자를 얻는다
	 
		Dim fso
		Set fso = Server.CreateObject("Scripting.FileSystemObject")
	 
		Dim bExist : bExist = True 
		'우선 같은이름의 파일이 존재한다고 가정
		Dim strFileWholePath : strFileWholePath = DirectoryPath & "\" & strName & "." & strExt 
		'저장할 파일의 완전한 이름(완전한 물리적인 경로) 구성
		Dim countFileName : countFileName = 0 
		'파일이 존재할 경우, 이름 뒤에 붙일 숫자를 세팅함.
	 
		Do While bExist ' 우선 있다고 생각함.
			If (fso.FileExists(strFileWholePath)) Then ' 같은 이름의 파일이 있을 때
				countFileName = countFileName + 1 '파일명에 숫자를 붙인 새로운 파일 이름 생성
				strFileName = strName&"("&countFileName&")."&strExt
				strFileWholePath = DirectoryPath&"\"&strFileName
			Else
				bExist = False
			End If
		Loop
		GetUniqueName = strFileName
	End Function 
%>