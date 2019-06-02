
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* 좌측 펼침메뉴 3depth 가능 */

(function($) {

	/*********************** 온로드 실행 함수 ***********************/
	$(function() {
		/* ie6 png 이미지처리*/
		if($.browser.className=="msie6"){
			DD_belatedPNG.fix('.png');
		}

		explicitLabel("label-wrap");

		/* LNB */
		$lnb = $(".lnb");
		
		//lnb 초기설정
		$lnb.find("ul").hide();
		$lnb.find("li.on").parent("ul").show();
		$lnb.find(">ul>li").each(function(){
			if($(this).find("ul").length) $(this).find(">a").addClass("sub");
		});

		//현재페이지 스타일 변경
		$lnb_thispage = $lnb.find(".on");
		$lnb_thispage.find(">a img").attr("src", function(){return $(this).attr("src").replace("_off","_on")});

		//1차카테고리 클릭이벤트
		$lnb.find("h2:not(.on)").bind("click",function(){
			if($(this).find(">a").attr("href")!="#none"){
				return true;
			}
			else{
				$lnb
					.find("h2:not(.on)")
						.removeClass("active")
						.removeClass("hover")
						.next("ul").slideUp()
						.end()
					.find("img").attr("src", function(){return $(this).attr("src").replace("_on","_off")});

				if($(this).next("ul:visible").length){
					$(this).next("ul").slideUp();
					$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_on","_off")});
					$(this).removeClass("active");
				}
				else{
					$(this).next("ul").slideDown();
					$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_off","_on")});
					$(this).addClass("active");
				}
			}
		});

		//2차카테고리 클릭이벤트
		$lnb.find(">ul>li:not(.on)>a").bind("click",function(){
			if($(this).attr("href")!="#none"){
				return true;
			}else{
				$lnb.find("ul>li:not(.on)").find("ul").slideUp();
				if($(this).parent().find("ul:visible").length) $(this).find("ul").slideUp();
				else  $(this).parent().find("ul").slideDown();
				return false;
			}
		});

		//이미지오버설정
		$lnb.find("h2").bind("focus mouseover",function(){
			$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_off","_on")});
			$(this).addClass("hover");
		});

		$lnb.find("h2:not(.on)").bind("blur mouseout",function(){
			if(!$(this).hasClass("active")){
				$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_on","_off")});
			}
			$(this).removeClass("hover");
		});

		$lnb.find("ul li:not(.on) a").hover(function(){
			$(this).addClass('hover');
			$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_off","_on")});
		},function(){
			$(this).removeClass('hover');
			$(this).find("img").attr("src", function(){return $(this).attr("src").replace("_on","_off")});
		});
	});

})(jQuery);

// 암시적 레이블 방식 명시적으로 적용
function explicitLabel(cssName, margin) {
	$('.'+cssName+" label").each(function(){
		$(this).css('padding-left', function() {return $(this).next().outerWidth(true)});
		$("#"+$(this).attr("for")).css({
			'margin-left' : function() {
				return -$(this).prev().outerWidth(true)
			},
			'margin-right' : function() {
				if (margin) {
					return $(this).prev().width() + margin;
				} else {
					return $(this).prev().width()+15;
				}
			}
		});
	});

}

