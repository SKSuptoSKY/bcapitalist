function CheckID(ctrl) {
	/* ------------------------------------------------------------- [ 아이디 영문+숫자+특수기호 조합 - START ] ------------------------------------------------------------- */
	var alpha="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	var number ="1234567890";
	// var sChar = "-_=+\|()*&^%$#@!~`?></;,.:'";
	var total = alpha + number;
	//var total = alpha + number + sChar;
	var result_alpha = 0;
	var result_number = 0;
	//var result_sChar = 0;
	var result_hangle = 0;
	var result = 0;
	var msg = "아이디는 최소 5자리 이상 영문, 숫자 조합으로 해주십시오.";

	var id = ctrl.value;
	for (i=0; i<id.length ;i++ ) {
		if (total.indexOf(id.charAt(i)) == -1)
		{
			result_hangle = 1  
		}
		if (alpha.indexOf(id.charAt(i)) != -1)
		{
			result_alpha=1;
		}
		if (number.indexOf(id.charAt(i)) != -1)
		{
			result_number = 1;
		}
		/*
		if (sChar.indexOf(id.charAt(i)) != -1)
		{  
			result_sChar=1;
		}
		*/
	 }

	if (result_hangle==1)
	{
		document.getElementById("join_id_result").innerHTML=msg;
		document.getElementById("join_id_result").style.color="#ff0000";
		return;
	}

	//result = result_alpha + result_number + result_sChar;
	result = result_alpha + result_number;

	if (result != 2)	// 영문,숫자 조합이 아닐때
	//if (result != 3) // 영문,숫자,특수문자 조합이 아닐때
	{
		document.getElementById("join_id_result").innerHTML=msg;
		document.getElementById("join_id_result").style.color="#ff0000";
		return ;
	}
	/* ------------------------------------------------------------- [  아이디 영문+숫자+특수기호 조합 - END ] ------------------------------------------------------------- */


    $.ajax({
        type: 'POST',
        url: '/GnAjax/member/php/ajax_idck.php',
        data: {
            'id': encodeURIComponent($('#id').val())
        },
        cache: false,
        async: false,
        success: function(result) {
			switch(result) {
				/*
					case '100' : {
						document.getElementById("join_id_result").innerHTML="ID가 잘못되었습니다.";
						document.getElementById("join_id_result").style.color="#ff0000";
						document.member.idCk.value="N"; break;
					}
				*/
					case '200' : {
						document.getElementById("join_id_result").innerHTML="최소 5자이상 입력하세요.";
						document.getElementById("join_id_result").style.color="#ff0000";
						document.member.idCk.value="N"; break;
						 break;
					}
					case '210' : {
						document.getElementById("join_id_result").innerHTML="아이디는 15자이내입니다.";
						document.getElementById("join_id_result").style.color="#ff0000";
						document.member.idCk.value="N"; break;
					}
					case '300' : {
						document.getElementById("join_id_result").innerHTML="이미 사용중인 아이디입니다.";
						document.getElementById("join_id_result").style.color="#ff0000";
						document.member.idCk.value="N"; break;
					}
					case '400' : {
						msg.update('사용 금지 된 아이디입니다.').setStyle({ color: 'red' }); 
						document.getElementById("join_id_result").innerHTML="사용 금지 된 아이디입니다.";
						document.getElementById("join_id_result").style.color="#ff0000";						
						document.member.idCk.value="N"; break;
					}
					case '500' : {
						document.getElementById("join_id_result").innerHTML="사용 가능한 아이디입니다.";
						document.getElementById("join_id_result").style.color="#0000ff";			
						document.member.idCk.value="Y"; break;
					}
					default : {
						alert( '잘못된 접근입니다.\n\n' + result ); break;
						$('idCk').value="N";
					}
            }
        }
    });
}


/* ------------------------------------------------------------- [ 패스워드 영문+숫자+특수기호 조합 mj - START ] ------------------------------------------------------------- */
function CheckPASS(ctrl) {
	var alpha="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	var number ="1234567890";
	var sChar = "-_=+\|()*&^%$#@!~`?></;,.:'";
	//var total = alpha + number;

	var total = alpha + number + sChar;
	var result_alpha = 0;
	var result_number = 0;
	var result_sChar = 0;
	var result_hangle = 0;
	var result = 0;
	var msg = "패스워드는 최소 5자리 이상 영문+숫자+특수문자 조합으로 해주십시오.";

	var pass = ctrl.value;				//	전달된 패스워드 벨류
	var pass_length = pass.length;	//	전달된 패스워드 길이
	var min_legnth = 5;					//	패스워드 최소길이
	var max_length = 20;				//	패스워드 최대길이

	for (i=0; i<pass.length ;i++ ) {
		if (total.indexOf(pass.charAt(i)) == -1)
		{
			result_hangle = 1  
		}
		if (alpha.indexOf(pass.charAt(i)) != -1)
		{
			result_alpha=1;
		}
		if (number.indexOf(pass.charAt(i)) != -1)
		{
			result_number = 1;
		}
		
		if (sChar.indexOf(pass.charAt(i)) != -1)
		{  
			result_sChar=1;
		}
		
	 }

	if (result_hangle==1)
	{
		document.getElementById("join_pass_result").innerHTML=msg;
		document.getElementById("join_pass_result").style.color="#ff0000";
		document.getElementById('passCk').value="N";
		return;
	}
	
	// 모두 만족하는 조건인지 확인
	result = result_alpha + result_number + result_sChar;
	//result = result_alpha + result_number;

	// 영문,숫자 조합이 아닐때
	//if (result != 2)	

	// 영문+숫자+특수문자, 5자리이상 20자리 이하 조합이 아닐때
	if ( result != 3 || pass_length < min_legnth || pass_length > max_length )				
	{
		document.getElementById("join_pass_result").innerHTML=msg;
		document.getElementById("join_pass_result").style.color="#ff0000";
		document.getElementById('passCk').value="N";
		return ;
	}

	// 영문+숫자+특수문자, 5자리이상 20자리 이하 조합이면 통과
	if ( result == 3 && pass_length >= min_legnth && pass_length <= max_length )	
	{
		var ok_msg = "사용가능한 비밀번호 입니다.";
		document.getElementById("join_pass_result").innerHTML=ok_msg;
		document.getElementById("join_pass_result").style.color="#0000ff";
		document.getElementById('passCk').value="Y";
		return ;
	}
}
/* ------------------------------------------------------------- [  패스워드 영문+숫자+특수기호 조합 mj - END ] ------------------------------------------------------------- */


function CheckNick(ctrl) {
	str = ctrl.value;	

    $.ajax({
        type: 'POST',
        url: '/GnAjax/member/php/ajax_nickck.php',
        data: {
			'id': encodeURIComponent($('#id').val()),
            'nick': str
        },
        cache: false,
        async: false,
        success: function(result) {
				//alert(result);
				switch(result) {
					case '100' : {
						document.getElementById("join_nick_result").innerHTML="닉네임이 너무 짧습니다.";
						document.getElementById("join_nick_result").style.color="#ff0000";
						document.member.nickCk.value="N"; break;
					}
					case '110' : {
						document.getElementById("join_nick_result").innerHTML="닉네임은 6자 이하입니다.";
						document.getElementById("join_nick_result").style.color="#ff0000";
						document.member.nickCk.value="N"; break;
					}
					case '200' : {
						document.getElementById("join_nick_result").innerHTML="이미 사용중인 닉네임입니다.";
						document.getElementById("join_nick_result").style.color="#ff0000";
						document.member.nickCk.value="N"; break;
					}
					case '300' : {
						document.getElementById("join_nick_result").innerHTML="사용 가능한 닉네임입니다.";
						document.getElementById("join_nick_result").style.color="#0000ff";
						document.member.nickCk.value="Y"; break;
					}
					default : {
						alert( '잘못된 접근입니다.\n\n' + result ); break;
						$('nickCk').value="N";
					}
				}
        }
    });
}

function CheckEmail(ctrl) {
	str = ctrl.value;	
    $.ajax({
        type: 'POST',
        url: '/GnAjax/member/php/ajax_emailck.php',
        data: {
            'id': encodeURIComponent($('#id').val()),
            'email': str
        },
        cache: false,
        async: false,
        success: function(result) {
				switch(result) {
					case '100' : {
						document.getElementById("join_email_result").innerHTML="E-mail 주소를 입력해주십시요.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '200' : {
						document.getElementById("join_email_result").innerHTML="이미 사용중인 이메일입니다.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '300' : {
						document.getElementById("join_email_result").innerHTML="E-mail 주소가 형식에 맞지 않습니다.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '400' : {
						document.getElementById("join_email_result").innerHTML="사용 가능한 이메일입니다.";
						document.getElementById("join_email_result").style.color="#0000ff";
						document.member.EmailCk.value="Y"; break;
					}
					default : {
						alert( '잘못된 접근입니다.\n\n' + result ); break;
						$('EmailCk').value="N";
					}
				}
        }
    });

}

// 이메일 선택입력및 직접입력 기능용 Ajax 2014-09
function CheckEmail_New(ctrl) {
	str = ctrl;	
    $.ajax({
        type: 'POST',
        url: '/GnAjax/member/php/ajax_emailck.php',
        data: {
            'id': $('#id').val(),
            'email': str
        },
        cache: false,
        async: false,
        success: function(result) {
				switch(result) {
					case '100' : {
						document.getElementById("join_email_result").innerHTML="E-mail 주소를 입력해주십시요.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '200' : {
						document.getElementById("join_email_result").innerHTML="이미 사용중인 이메일입니다.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '300' : {
						document.getElementById("join_email_result").innerHTML="E-mail 주소가 형식에 맞지 않습니다.";
						document.getElementById("join_email_result").style.color="#ff0000";
						document.member.EmailCk.value="N"; break;
					}
					case '400' : {
						document.getElementById("join_email_result").innerHTML="사용 가능한 이메일입니다.";
						document.getElementById("join_email_result").style.color="#0000ff";
						document.member.EmailCk.value="Y"; break;
					}
					case '500' : {
						document.getElementById("join_email_result").innerHTML="기존 E-mail 그대로 사용합니다.";
						document.getElementById("join_email_result").style.color="#0000ff";
						document.member.EmailCk.value="Y"; break;
					}
					default : {
						alert( '잘못된 접근입니다.\n\n' + result ); break;
						$('EmailCk').value="N";
					}
				}
        }
    });

}