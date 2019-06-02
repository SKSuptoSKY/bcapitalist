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

// 큰이미지 창
function popup_large_image(it_id, img, width, height)
{
	var top = 10;
	var left = 10;
	url = "/shop/imagepop.php?it_id=" + it_id + "&img=" + img;
	width = width + 18	;
	height = height + 7;
	opt = 'scrollbars=no,width='+width+',height='+height+',top='+top+',left='+left;
	popup_window(url, "largeimage", opt);
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

// 우편번호 창
function popup_zip(frm_name, frm_zip1, frm_zip2, frm_addr1, frm_addr2, dir, top, left)
{
    url = './?doc='+dir+'/mbzip.php&frm_name='+frm_name+'&frm_zip1='+frm_zip1+'&frm_zip2='+frm_zip2+'&frm_addr1='+frm_addr1+'&frm_addr2='+frm_addr2;
    opt = 'scrollbars=yes,width=417,height=250,top='+top+',left='+left;
    window.open(url, "mbzip", opt);
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
    win.document.write ("<html><head><meta http-equiv='content-type' content='text/html; charset=utf-8'>");
    win.document.write ("<title>이미지 보기</title></head>");
    win.document.write ("<body leftmargin=0 topmargin=0>");
    //win.document.write ("<img src='"+img+"' width='"+w+"' height='"+h+"'border=0 onclick='window.close();' style='cursor:hand' title='해상도 ("+tmp_w+"x"+tmp_h+")\n클릭하면 닫혀요'>");
    win.document.write ("<img src='"+img+"' width='"+w+"' height='"+h+"'border=0 onclick='window.close();' style='cursor:hand'>");
    win.document.write ("</body></html>");
    win.document.close();

    if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

function LayerCategoryMenuOver(ca_id){
	document.getElementById(ca_id).style.display = "block";
}

function LayerCategoryMenuOut(ca_id){
	document.getElementById(ca_id).style.display = "none";
}