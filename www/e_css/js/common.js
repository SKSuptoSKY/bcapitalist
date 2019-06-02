
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ���� ��ħ�޴� 3depth ���� */

(function($) {

	/*********************** �·ε� ���� �Լ� ***********************/
	$(function() {
		/* ie6 png �̹���ó��*/
		if($.browser.className=="msie6"){
			DD_belatedPNG.fix('.png');
		}

		explicitLabel("label-wrap");

		/* LNB */
		$lnb = $(".lnb");
		
		//lnb �ʱ⼳��
		$lnb.find("ul").hide();
		$lnb.find("li.on").parent("ul").show();
		$lnb.find(">ul>li").each(function(){
			if($(this).find("ul").length) $(this).find(">a").addClass("sub");
		});

		//���������� ��Ÿ�� ����
		$lnb_thispage = $lnb.find(".on");
		$lnb_thispage.find(">a img").attr("src", function(){return $(this).attr("src").replace("_off","_on")});

		//1��ī�װ� Ŭ���̺�Ʈ
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

		//2��ī�װ� Ŭ���̺�Ʈ
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

		//�̹�����������
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

// �Ͻ��� ���̺� ��� ��������� ����
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

