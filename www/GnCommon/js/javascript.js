// 전역 변수
var errmsg = "";
var errfld;

// 필드 검사
function check_field(fld, msg) 
{
    if ((fld.value = trim(fld.value)) == "") 			   
        error_field(fld, msg);
    else
        clear_field(fld);
    return;
}

// 필드 오류 표시
function error_field(fld, msg) 
{
    if (msg != "")
        errmsg += msg + "\n";
    if (!errfld) errfld = fld;
    fld.style.background = "#BDDEF7";
}

// 필드를 깨끗하게
function clear_field(fld) 
{
    fld.style.background = "#FFFFFF";
}

function trim(s)
{
	var t = "";
	var from_pos = to_pos = 0;

	for (i=0; i<s.length; i++)
	{
		if (s.charAt(i) == ' ')
			continue;
		else 
		{
			from_pos = i;
			break;
		}
	}

	for (i=s.length; i>=0; i--)
	{
		if (s.charAt(i-1) == ' ')
			continue;
		else 
		{
			to_pos = i;
			break;
		}
	}	

	t = s.substring(from_pos, to_pos);
	//				alert(from_pos + ',' + to_pos + ',' + t+'.');
	return t;
}

// 자바스크립트로 PHP의 number_format 흉내를 냄
// 숫자에 , 를 출력
function number_format(data) 
{
    var tmp = '';
    var number = '';
    var cutlen = 3;
    var comma = ',';
    var i;
	var data = String(data);
    len = data.length;

    mod = (len % cutlen);
    k = cutlen - mod;
    for (i=0; i<data.length; i++) 
	{
        number = number + data.charAt(i);
		
        if (i < data.length - 1) 
		{
            k++;
            if ((k % cutlen) == 0) 
			{
                number = number + comma;
                k = 0;
			}
        }
    }

    return number;
}




// 새 창
function popup_window(url, winname, opt)
{
    window.open(url, winname, opt);
}


// 폼메일 창
function popup_formmail(url)
{
	opt = 'scrollbars=yes,width=417,height=385,top=10,left=20';
	popup_window(url, "wformmail", opt);
}

// , 를 없앤다.
function no_comma(data)
{
	var tmp = '';
    var comma = ',';
    var i;

	for (i=0; i<data.length; i++)
	{
		if (data.charAt(i) != comma)
		    tmp += data.charAt(i);
	}
	return tmp;
}

// 삭제 검사 확인
function del(href) 
{
    if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) 
        document.location.href = href;
}

// 쿠키 입력
function set_cookie(name, value, expirehours) 
{
	var today = new Date();
	today.setTime(today.getTime() + (60*60*1000*expirehours));
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
}

// 쿠키 얻음
function get_cookie(name) 
{
    var find_sw = false;
    var start, end;
    var i = 0;

	for (i=0; i<= document.cookie.length; i++)
	{
		start = i;
		end = start + name.length;

		if(document.cookie.substring(start, end) == name) 
		{
			find_sw = true
			break
		}
	}

    if (find_sw == true) 
	{
        start = end + 1;
        end = document.cookie.indexOf(";", start);

        if(end < start)
            end = document.cookie.length;

        return document.cookie.substring(start, end);
    }
    return "";
}

// 쿠키 지움
function delete_cookie(name) 
{
	var today = new Date();

	today.setTime(today.getTime() - 1);
	var value = getCookie(name);
	if(value != "")
		document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

// a 태그에서 onclick 이벤트를 사용하지 않기 위해
function winopen(url, name, option)
{
    window.open(url, name, option);
    return ;
}

// TEXTAREA 사이즈 변경
function textarea_size(fld, size)
{
	var rows = parseInt(fld.rows);

	rows += parseInt(size);
	if (rows > 0) {
		fld.rows = rows;
	}
}

var old='';
function menu(name){

	submenu=eval(name+".style");

	if (old!=submenu)
	{
		if(old!='')
		{
			old.display='none';
		}
		submenu.display='block';
		old=submenu;
	}
	else
	{
		submenu.display='none';
		old='';
	}
}

// 3.36
function image_window(img, w, h)
{
    var tmp_w = w;
    var tmp_h = h;
    winl = (screen.width-w)/2;
    wint = (screen.height-h)/3;

    if (w >= screen.width) {
        winl = 0;
        w = screen.width - 10;
        h = (parseInt)(w * (h / w));
    }

    if (h >= screen.height) {
        wint = 0;
        h = screen.height - 80;
        w = (parseInt)(h * (w / h));
    }

    var settings  ='width='+w+',';
        settings +='height='+h+',';
        settings +='top='+wint+',';
        settings +='left='+winl+',';
        settings +='scrollbars=no,';
        settings +='resizable=no,';
        settings +='status=no';

    win=window.open("","newWindow",settings);
    win.document.open();
    win.document.write ("<html><head><meta http-equiv='content-type' content='text/html; charset=euc-kr'>");
    win.document.write ("<title>이미지 보기</title></head>");
    win.document.write ("<body leftmargin=0 topmargin=0>");
    //win.document.write ("<img src='"+img+"' width='"+w+"' height='"+h+"'border=0 onclick='window.close();' style='cursor:hand' title='해상도 ("+tmp_w+"x"+tmp_h+")\n클릭하면 닫혀요'>");
    win.document.write ("<img src='"+img+"' width='"+w+"' height='"+h+"'border=0 onclick='window.close();' style='cursor:hand'>");
    win.document.write ("</body></html>");
    win.document.close();

    if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

////////////////////////////// 페이지열기 /////////////////////////////////
function Win_Open(page,value,style){
	window.open(page+value,"OpenWin",style).focus();
}

/// 선택형 이메일 입력폼 스크립트
	function Email_Select(OBJC,form) {
		if(OBJC.options[OBJC.selectedIndex].value=="") {
			form.email_url.value="입력하세요";
			form.email_url.disabled=false;
		} else {
			form.email_url.value=OBJC.options[OBJC.selectedIndex].value;
			form.email_url.disabled=true;
		}
	}

//지역선택 팝업
function SAddress(form,target){
	window.open("/member/pop_area.php?form="+form+"&target="+target,"SAddress","width=500,height=180").focus();
}

///택스트 필드에서 숫자와 ,만 사용가능하게 함
function numOnly(obj,isCash) { 
	//사용예 : <input type="text" name="text" onKeyUp="javascript:numOnly(this,true);"> 
	//세자리 콤마 사용시 true , 숫자만 입력 시 false 
	if (event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39) return; 
	var returnValue = ""; 
	for (var i = 0; i < obj.value.length; i++){ 
		if (obj.value.charAt(i) >= "0" && obj.value.charAt(i) <= "9") returnValue += obj.value.charAt(i); 
		else returnValue += ""; 
	} 
	
	if (isCash){ 
		obj.value = cashReturn(returnValue); 
		return; 
	} 
	
	obj.focus(); 
	obj.value = returnValue; 
} 

function cashReturn(numValue){ 
	//numOnly함수에 마지막 파라미터를 true로 주고 numOnly를 부른다. 
	var cashReturn = ""; 
	for (var i = numValue.length-1; i >= 0; i--){ 
		cashReturn = numValue.charAt(i) + cashReturn; 
		if (i != 0 && i%3 == numValue.length%3) cashReturn = "," + cashReturn; 
	} 
	return cashReturn; 
}


///택스트 필드에 한글 입력 처리 
function ketKorean(msg) { 
	if((event.keyCode < 12592) || (event.keyCode > 12687)) 
	alert("한글만 입력 됩니다") 
	event.returnValue = false 
} 

///택스트 필드에 한글 처리 
function isKorean(field){
	var chk;
	var chk2 = 0;
	var strLength = field.value.length
	for(i = 0 ; i < strLength ; i++){
		chk = field.value.charCodeAt(i)
		if((chk >= 44032 && chk <= 55203)){	}
		else {
			alert('한글만 입력할 수 있습니다.'); 
			return false;
		}
	}
}

//택스트 필드에 영어와 숫자만 허용
function isEnglish(field){
	var chk;
	var chk2 = 0;
	var strLength = field.value.length
	for(i = 0 ; i < strLength ; i++){
		chk = field.value.charCodeAt(i)
		if((chk >= 97 && chk <= 122) || (chk >= 48 && chk <= 57) || chk == 95){	}
		else {
			alert('a~z , 0~9 만 입력할 수 있습니다.'); 
			return false;
		}
	}
}

///길이 체크
function strLen(field,min,max,text) {
	// 201503 버그 수정 - mj text 인자를 넣지 않았을때의 처리가 없어 출력단에 
	// "Nan자 이상 입력하시기 바랍니다" 라는 문구가 출력되는 문제
	/* 기존 코드 
	if(field.value.length < min) {
		alert(text+min + "자 이상 입력하시기 바랍니다.");
		field.focus();
		return false;
	}
	*/
	if (text) {
		if(field.value.length < min) {
			alert(text + min + "자 이상 입력하시기 바랍니다.");
			field.focus();
			return false;
		}
	} else {
		if(field.value.length < min) {
			alert(min + "자 이상 입력하시기 바랍니다.");
			field.focus();
			return false;
		}
	}
	
	if(max != '') {
		if(field.value.length > max) {
			alert(min + "자 이상 " + max + "자 이하 입력하시기 바랍니다.");
			field.focus();
			return false;
		}
	}

	return;
}


///스크립트 필드 체크
function chkStr(field,msg) {
	if(field.value =="") {
		alert(msg);
		field.focus();
		return false;
	}
	return true;
}

// 스크립트 라디오 체크
function ridiaChk(v,meg){
	for (i=0;i<v.length;i++){if(v[i].checked==true){return true}};
	alert(meg);v[0].focus();return false;
}

///스크립트 배열 체크
function chkArr(field,msg) {
	var cnt = 0;
	for(var i=0;i<field.length;i++) if(field[i].checked == true) cnt++;

	if(cnt == 0) {
		alert(msg);
		field[0].focus();
		return false;
	}
	return true;
}

///Email 체크
function chkMail(email) {
	if (!email.value){
		alert("Email 주소를 입력해 주세요.");
		email.value = "";
		email.focus();
		return false;
	}
		
	if (email.value.indexOf("http") >= 0 ) {
		alert ('http://는 올바른 전자우편 주소가 아닙니다.');
		email.focus();
		return false;
	} 
	if (email.value.indexOf("@") <= 0 ) {
		alert ('Email 주소에 @(골뱅이)가 빠졌습니다.');
		email.focus();
		return false;
	} 
	if (email.value.indexOf(".") <= 0 ) {
		alert ('올바른 전자우편 주소가 아닙니다.');
		email.focus();
		return false;
	} 
	return true;
}

function chkDel(url) {
	yes_no = confirm('삭제하시겠습니가?');
	if(yes_no == true) { // 확인 선택해 했을때 
		location.href=url;
	} 
}

//ENTER 안먹게 하는것
function captureReturnKey(e) {
	if(e.keyCode==13 && e.srcElement.type != 'textarea')
	return false;
}

//우편번호 검색
function autoAddress(target1,target2,target3,form){
	window.open("/member/pop_address.php?form="+form+"&target1="+target1+"&target2="+target2+"&target3="+target3,"autoAddress","width=500,height=280").focus();
}


//이미지 롤 오버
// 이부분은 수정할 필요없습니다.
var cnj_str=new Array();
function Rollover(imgName, imgSrc){
	cnj_str[imgName] = new Image();
	cnj_str[imgName].src = imgSrc;
}
function turnOn(imgName) { 
		document.images[imgName].offSrc = document.images[imgName].src;
		document.images[imgName].src    = cnj_str[imgName].src;
} 
function turnOff(imgName){ 
		document.images[imgName].src = document.images[imgName].offSrc;
	} 
// 이부분까지 수정할 필요없습니다.

// 사진미리보기
function PhotoView(form)
{
	if (form.photo.value) {
		form.myphoto.src = form.photo.value;
	}
}

////////////////////////////// 플래쉬 라인을 없애기 위해 /////////////////////////////////
function cfShowEmbedObject(elementId){
 document.write(elementId.text);

 // 동일한 ID를 사용하기 위해 다시 elementID 를 초기화
 elementId.id = "";
}

function TextBoxObject(id) {
	document.write(document.getElementById(id).value);
}

////////////////////////////// 리스트 체크 /////////////////////////////////
function List_Checked_Box(form,sw) {

    for (var i=0; i<form.length; i++) {
        if (form.elements[i].name == "list_ck[]")
            form.elements[i].checked = sw;
    }
}
function List_Checked_Sel(form,box) {
	if (box.checked) {
		List_Checked_Box(form,true);
	} else {
		List_Checked_Box(form,false);
	}
}


////////////////////////////// 세금계산서 팝업 /////////////////////////////////
function TaxPaper_Print(value,type){
	window.open("/bill/bill_print.php?type="+type+"&id="+value,"Bill_Print","width=405,height=380, scrollbars=1").focus();
}

////////////////////////////// 설문조사 팝업 /////////////////////////////////
function Open_Poll(url)
{
	if (!url)
		url = "";
	window.open(url, "OpenPoll", "left=50, top=50, width=616, height=500, scrollbars=1");
}

////////////////////////////// 쪽지 팝업 /////////////////////////////////
function My_memo(id) {
	var window_left = (screen.width-510)/2;
	var window_top = (screen.height-450)/2;
	if(id) {
		window.open('/member/memo_form.php?id='+id,'memo',"width=500,height=500,status=no,top=" + window_top + ",left=" + window_left); 
	} else {
		window.open('/member/memo.php','memo',"width=500,height=500,status=no,top=" + window_top + ",left=" + window_left); 
	}
}

////////////////////////////// 캐쉬결제창 팝업 /////////////////////////////////
function cash_save(value){
	window.open("/cash/mycash_save.php?pay_type="+value,"cash_save","width=405,height=380").focus();
}

////////////////////////////// 아이디/비번 검색 팝업 /////////////////////////////////
function id_search(val) {
	var window_left = (screen.width-510)/2;
	var window_top = (screen.height-220)/2;
	
	if(!val) val="";
	window.open(val+'/member/pop_search.php','ID_PW_SEARCH',"width=470,height=320,status=no,top=" + window_top + ",left=" + window_left); 
}
////////////////////////////// 회원정보 전용 스크립트 /////////////////////////////////
function Break_member(){
	yes_no = confirm('탈퇴하시면 같은 아이디로는 다시 가입하실 수 없습니다.\n\n탈퇴 하시겠습니까?');
	if(yes_no == true) { // 확인 선택해 했을때 
		window.open("/member/pop_pass.php","autoAddress","width=420,height=200,status=yes").focus();
	} 
}

function autoSearch(target1,form,type){
window.open("./pop_check.php?type="+type+"&form="+form+"&target1="+target1,"autoAddress","width=420,height=200").focus();
}

//주민등록번호 체크
function chkSsn(ssn1,ssn2) {
	//주민번호 체크
	if (chkStr(ssn1,"주민번호 앞자리 6자를 입력하세요.") ==false) return false;
	if(strLen(ssn1,6,'') == false) return false;
	if (chkStr(ssn2,"주민번호 앞자리 7자를 입력하세요.") ==false) return false;
	if(strLen(ssn2,7,'') == false) return false;
	
	var reginum = ssn1.value.concat(ssn2.value);
	var weight = '234567892345'; // 자리수 weight 지정 
	var len = reginum.length; 
	var sum = 0; 
	
	if (len != 13) { 
		ssn1.value='';
		ssn2.value='';
		ssn1.focus();
		return false; 
	} 
	
	for (var i = 0; i < 12; i++) sum = sum + (reginum.substr(i,1)*weight.substr(i,1)); 
	
	var rst = sum%11; 
	var result = 11 - rst; 

	if (result == 10) result = 0;
	else if (result == 11) result = 1;
	
	var jumin = reginum.substr(12,1); 
	
	if (result != jumin) {
		ssn1.value='';
		ssn2.value='';
		ssn1.focus();
		return false;
	} else {
		return true;
	}
}

// 로그인 필드 체크
function login_chk(form)
{
	if(!form.mb_id.value) {
		alert('아이디를 입력해주세요.');
		form.mb_id.focus();
		return false;
	}

	if(!form.mb_pass.value) {
		alert('비밀번호를 입력해주세요.');
		form.mb_pass.focus();
		return false;
	}

	if(strLen(form.mb_pass,0,10) == false) {
		form.mb_pass.value='';
		form.mb_pass.focus();
		return false;
	}

    form.action = "/member/login.php";
    form.submit();
}

////////////////////////////// 페이지 일부 프린트 스크립트 여기부터 /////////////////////////////////
function printDiv () {
	if (document.all && window.print) {
		window.onbeforeprint = beforeDivs;
		window.onafterprint = afterDivs;
		window.print();
	}
}

function beforeDivs () {
	if (document.all) {
		objContents.style.display = 'none';
		objSelection.innerHTML = document.all['d1'].innerHTML;
	}
}

function afterDivs () {
	if (document.all) {
		objContents.style.display = 'block';
		objSelection.innerHTML = "";
	}
}

function doPrint(frame){
	printDiv('d1');
//	factory.printing.Print(false, frame);
}
////////////////////////////// 페이지 일부 프린트 스크립트 여기까지 /////////////////////////////////

// request 객체 생성
var AJ_Value = null;

function Get_Request() {
	if(window.ActiveXObject) {
		try
		{
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e1)
			{
				return null;
			}
		}
	} else if(window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}


function nextFocus(sFormName,sNow,sNext){
	var sForm = 'document.'+ sFormName +'.'
	var oNow = eval(sForm + sNow);
	if (typeof oNow == 'object'){
		if ( oNow.value.length == oNow.maxLength){
			var oNext = eval(sForm + sNext);
			if ((typeof oNext) == 'object') oNext.focus();
		}
	}
}

//2009.3.24 Ki-hong Park

function iframe_autoresize(arg) {
arg.height = 
eval(arg.name+".document.body.scrollHeight");
}

//byte체킹
function updateChar(FieldName, contentName, textlimitName){		
		var strCount = 0;
		var tempStr, tempStr2;	
		//var frm = document.getElementById(contentName);
		var frm = contentName;
		var size = frm.value.length;
		for(i = 0;i < size;i++)
		{
			tempStr = frm.value.charAt(i);
			if(escape(tempStr).length > 4) strCount += 2;
				else strCount += 1 ;
		}
		if (strCount > FieldName){
			alert("최대 " + FieldName + "byte이므로 초과된 글자수는 자동으로 삭제됩니다.");		
			strCount = 0;		
			tempStr2 = "";
			for(i = 0; i < size; i++) 
			{
				tempStr = frm.value.charAt(i);	
				if(escape(tempStr).length > 4) strCount += 2;
				else strCount += 1 ;
				if (strCount > FieldName)
				{
					if(escape(tempStr).length > 4) strCount -= 2;
					else strCount -= 1 ;	
					break;	      		
				}
				else tempStr2 += tempStr;
			}	    
			frm.value = tempStr2;			
		}		
		document.getElementById(textlimitName).innerHTML = strCount;
}

function MM_openBrWindow(theURL,winName,features) {
    //v2.0
    window.open(theURL,winName,features);
}


//팝업시 원본크기로 
function imgResize(img2){
	poto=new Image();
	poto.src=(img2);
	Controlla(img2);
}
function Controlla(img2){
	if((poto.width!=0)&&(poto.height!=0)){
		winopen(img2,poto.width,poto.height);
	}
	else{
		funzione="Controll('"+img2+"')";
		intervallo=setTimeout(funzione,20);
	}
}
function winopen(img_view,Width,Height){
	var winHandle=window.open("","windowName","toolbar=no,scrollbars=auto,resizable=no,top=200,left=200,width="+Width+",height="+Height);
	if (winHandle !=null) {
		var htmlString="<html><head><title>이미지 미리보기</title></head>"
		htmlString+="<body topmargin=0 leftmargin=0>"
		htmlString+="<a href=javascript:window.close()><img src="+img_view+" border=0 alt=이미지클릭:화면닫기></a>"
		htmlString+="</body></html>";
		winHandle.document.open()
		winHandle.document.write(htmlString)
		winHandle.document.close()
	}
	if(winHandle!=null) winHandle.focus()
		return winHandle
}
function bluring(){  // 이미지 or 링크 클릭시 주위에 ... 안생기게~
 if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;


// 웹표준용 스크립트 2009-11-17
function getObject(objectId) {
	if(document.getElementById && document.getElementById(objectId)) {
		return document.getElementById(objectId);
	}
	else if (document.all && document.all(objectId)) {
		return document.all(objectId);
	}
	else if (document.layers && document.layers[objectId]) {
		return document.layers[objectId];
	} else {
		return false;
	}
}

// 웹표준용 스크립트 2009-11-17
function getObjectNm(objectNm) {
	if(document.getElementsByName && document.getElementsByName(objectNm)) {
		return document.getElementsByName(objectNm);
	}
	else {
		return false;
	}
}


function log(str){
	if(window.console){
		console.log("log:"+str);
	}
}
//공백제거
function trim(str){
	str = str.replace(/(^\s*)|(\s*$)/g,"");
	return str;
}

function win_open(url, name, option)
{
    var popup = window.open(url, name, option);
    popup.focus();
}
function win_zip(frm_name, frm_zip1, frm_addr1, frm_addr2)
{
    url = "/addr_zip/zip.php?mode=p2&frm_name="+frm_name+"&frm_zip1="+frm_zip1+"&frm_addr1="+frm_addr1+"&frm_addr2="+frm_addr2;
    win_open(url, "winZip", "left=50,top=50,width=650,height=550,scrollbars=0");
}

/*Gn_Board 업데이트후 추가된 스크립*/
//체크박스 전체선택
function AllChk() {
	if($("#chk").prop("checked") == true) {
		$(".chk_box").prop("checked", true);
	}else {
		$(".chk_box").prop("checked", false);
	}
}

// 폼에 해당하는 컨트롤들의 기본값 쉽게 셋팅해 주기
function initForm(f){
	var nLen; // form 요소의 갯수
	var ival; // 각 요소의 default value 값 즉! 초기화하고자 하는값
	var fTyp; // form 요소의 타입(select, radio, checkbox...)

	for(var i = 0; i < f.elements.length; i++){
		fTyp = toUpperCase(f.elements[i].type);
		ival = f.elements[i].ival;

		if(ival && fTyp == "SELECT-ONE"){
			nLen = f.elements[i].options.length;
			for(var j = 0; j < nLen; j++){
				if(f.elements[i].options[j].value == ival)
					f.elements[i].options[j].selected = true;
			}
		}
		if(fTyp == "SELECT-MULTIPLE"){
			nLen = f.elements[i].options.length;
			for(var j = 0; j < nLen; j++){
				if(f.elements[i].options[j].value == f.elements[i].options[j].ival)
					f.elements[i].options[j].selected = true;
			}
		}
		if(ival &&(fTyp == "RADIO" || fTyp == "CHECKBOX")){
			if(f.elements[i].value == ival)
				f.elements[i].checked = true;
		}
	}
	return true;
}
/**/
