var uzipurl  = "http://gamgakdesign.com/addr_ajax.php";਍瘀愀爀 甀稀椀瀀椀搀 㴀 ∀稀椀瀀䌀漀渀琀攀渀琀∀㬀ഀഀ
var uzippages = 10;਍ഀഀ
$(function() { ਍  ␀⠀∀⌀猀攀愀爀挀栀开戀琀渀∀⤀⸀挀氀椀挀欀⠀昀甀渀挀琀椀漀渀⠀⤀笀 ഀഀ
      var addr = $('#addr1').val();਍      瘀愀爀 琀礀瀀攀 㴀 ␀⠀✀⌀琀礀瀀攀㄀✀⤀⸀瘀愀氀⠀⤀㬀ഀഀ
      var mode = $('#mode').val();਍      瘀愀爀 瀀愀最攀 㴀 ㄀㬀ഀഀ
    ਍      椀昀 ⠀℀愀搀搀爀⤀ 笀ഀഀ
        alert("검색어를 입력하세요!");਍        爀攀琀甀爀渀㬀ഀഀ
      }਍      ഀഀ
      zipsearch(page);਍  紀⤀㬀 ഀഀ
});਍ഀഀ
function zipsearch(page)਍笀ഀഀ
਍ऀ  瘀愀爀 甀爀氀 㴀 甀稀椀瀀甀爀氀㬀ഀഀ
਍ऀ  瘀愀爀 瀀愀爀愀洀 㴀 ∀㼀愀挀琀椀漀渀㴀最漀☀猀琀愀琀甀猀㴀最漀漀搀∀ഀഀ
਍ऀऀ瘀愀爀 愀搀搀爀 㴀 ␀⠀✀⌀愀搀搀爀㄀✀⤀⸀瘀愀氀⠀⤀㬀ഀഀ
		var type = $('#type1').val();਍ऀऀ瘀愀爀 洀漀搀攀 㴀 ␀⠀✀⌀洀漀搀攀✀⤀⸀瘀愀氀⠀⤀㬀ഀഀ
	਍ऀऀ  ␀⸀愀樀愀砀⠀ഀഀ
		   {਍ऀऀऀ甀爀氀㨀甀爀氀Ⰰഀഀ
਍ऀऀऀ琀礀瀀攀㨀∀䜀䔀吀∀Ⰰഀഀ
਍ऀऀऀ愀猀礀渀挀㨀昀愀氀猀攀Ⰰഀഀ
਍ऀऀऀ挀漀渀琀攀渀琀吀礀瀀攀㨀∀愀瀀瀀氀椀挀愀琀椀漀渀⼀樀猀漀渀∀Ⰰഀഀ
਍ऀऀऀ搀愀琀愀吀礀瀀攀㨀∀樀猀漀渀瀀∀Ⰰഀഀ
			data: { ਍ऀऀऀ  ∀愀搀搀爀∀㨀 愀搀搀爀ഀഀ
			  ,"type": type਍ऀऀऀ  Ⰰ∀洀漀搀攀∀㨀 洀漀搀攀ഀഀ
			  ,"page": page਍ऀऀऀ紀Ⰰഀഀ
਍ऀऀऀ挀爀漀猀猀䐀漀洀愀椀渀㨀 琀爀甀攀Ⰰഀഀ
਍ऀऀऀ猀甀挀挀攀猀猀㨀昀甀渀挀琀椀漀渀⠀搀愀琀愀⤀笀ഀഀ
਍              ␀⠀∀⌀∀ ⬀ 甀稀椀瀀椀搀 ⬀ ∀∀⤀⸀栀琀洀氀⠀∀∀⤀㬀ഀഀ
              if (data.error) {਍                愀氀攀爀琀⠀搀愀琀愀⸀攀爀爀漀爀⤀㬀 ഀഀ
                window.close();਍                爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
              } else {਍                瘀愀爀 猀琀爀 㴀 ∀∀㬀ഀഀ
                str += '<div class="search_zip_result">';਍                椀昀 ⠀洀漀搀攀 ℀㴀 ✀瀀㈀✀⤀ 笀ഀഀ
					str += '<table cellspacing="0" class="list_table">';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀挀漀氀 眀椀搀琀栀㴀∀㜀　∀㸀✀㬀ഀഀ
					str += '<col width="*">';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀挀漀氀 眀椀搀琀栀㴀∀㈀㈀　∀㸀✀㬀ഀഀ
					str += '<thead>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀爀㸀✀㬀ഀഀ
					str += '<th>우편번호</th>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀栀 挀氀愀猀猀㴀∀氀攀昀琀∀㸀쐀岳薸ﲺ賈㳁⼀琀栀㸀✀㬀ഀഀ
					str += '<th class="left">지번주소</th>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀⼀琀爀㸀✀㬀ഀഀ
					str += '</thead>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀戀漀搀礀㸀✀㬀ഀഀ
                } else {਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀愀戀氀攀 挀攀氀氀猀瀀愀挀椀渀最㴀∀　∀ 挀氀愀猀猀㴀∀氀椀猀琀开琀愀戀氀攀∀㸀✀㬀ഀഀ
					str += '<col width="70">';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀挀漀氀 眀椀搀琀栀㴀∀⨀∀㸀✀㬀ഀഀ
					str += '<thead>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀爀㸀✀㬀ഀഀ
					str += '<th>우편번호</th>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀琀栀 挀氀愀猀猀㴀∀氀攀昀琀∀㸀ﰀ賈㳁⼀琀栀㸀✀㬀ഀഀ
					str += '</tr>';਍ऀऀऀऀऀ猀琀爀 ⬀㴀 ✀㰀⼀琀栀攀愀搀㸀✀㬀ഀഀ
					str += '<tbody>';਍                紀ഀഀ
਍                昀漀爀⠀瘀愀爀 椀㴀　㬀 椀㰀搀愀琀愀⸀甀稀椀瀀⸀氀攀渀最琀栀㬀 椀⬀⬀⤀ 笀ഀഀ
                  ZIPCODE1 = data.uzip[i].zip1;਍                  娀䤀倀䌀伀䐀䔀㈀ 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀稀椀瀀㈀㬀ഀഀ
                  SIDO = data.uzip[i].sido;਍                  䜀唀䜀唀一 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀最甀最甀渀㬀ഀഀ
                  STREET = data.uzip[i].street;਍                  䈀唀䤀䰀䐀䤀一䜀一唀䴀㄀ 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀戀甀椀氀搀椀渀最渀甀洀㄀㬀ഀഀ
                  BUILDINGNUM2 = data.uzip[i].buildingnum2;਍ഀഀ
                  BLDGCODE = data.uzip[i].bldgcode;਍                  䰀䤀 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀氀椀㬀ഀഀ
                  APT = data.uzip[i].apt2;਍                  䄀䐀䐀刀 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀愀搀搀爀㬀ഀഀ
                  BUILDING = data.uzip[i].building;਍                  䐀伀一䜀 㴀 搀愀琀愀⸀甀稀椀瀀嬀椀崀⸀搀漀渀最㬀ഀഀ
                  if (BUILDINGNUM2 > 0)਍                    䈀唀䤀䰀䐀䤀一䜀一唀䴀㈀开氀 㴀 ∀ⴀ∀ ⬀ 䈀唀䤀䰀䐀䤀一䜀一唀䴀㈀㬀ഀഀ
                  else ਍                    䈀唀䤀䰀䐀䤀一䜀一唀䴀㈀开氀 㴀 ∀∀㬀ഀഀ
                  //alert(BUILDING); ਍                  椀昀 ⠀洀漀搀攀 ℀㴀 ✀瀀㈀✀⤀ 笀ഀഀ
  		              str += '<tr onmouseover="this.className=\'list_on\';" onmouseout="this.className=\'\';">';਍                    猀琀爀 ⬀㴀 ✀㰀琀搀㸀✀ ⬀ 娀䤀倀䌀伀䐀䔀㄀ ⬀ ∀ⴀ∀ ⬀ 娀䤀倀䌀伀䐀䔀㈀ ⬀ ✀㰀⼀琀搀㸀✀㬀ഀഀ
                    str += '<td class="left"><a href="#" onclick="find_zip(\'' + ZIPCODE1 + '\', \'' + ZIPCODE2 + '\', \'' + SIDO + ' ' + GUGUN + ' ' + STREET + ' ' + BUILDINGNUM1 + '' + BUILDINGNUM2_l + '\', \'' + BUILDING + '\');">' + SIDO + ' ' + GUGUN + ' ' + STREET + ' ' + BUILDINGNUM1 + '' + BUILDINGNUM2_l + '</a></td>';਍                    猀琀爀 ⬀㴀 ✀㰀琀搀 挀氀愀猀猀㴀∀氀攀昀琀∀㸀✀ ⬀ 匀䤀䐀伀 ⬀ ✀ ✀ ⬀ 䜀唀䜀唀一 ⬀ ✀ ✀ ⬀ 䐀伀一䜀 ⬀  ✀ ✀ ⬀ 䈀䰀䐀䜀䌀伀䐀䔀 ⬀ ✀㰀⼀琀搀㸀✀㬀ഀഀ
                    str += '</tr>';਍ऀऀ              紀 攀氀猀攀 笀ഀഀ
		                str += '<tr onmouseover="this.className=\'list_on\';" onmouseout="this.className=\'\';">';਍                    猀琀爀 ⬀㴀 ✀㰀琀搀㸀✀ ⬀ 娀䤀倀䌀伀䐀䔀㄀ ⬀ ∀ⴀ∀ ⬀ 娀䤀倀䌀伀䐀䔀㈀ ⬀ ✀㰀⼀琀搀㸀✀㬀ഀഀ
                    str += '<td class="left"><a href="#" onclick="find_zip(\'' + ZIPCODE1 + '\', \'' + ZIPCODE2 + '\', \'' + SIDO + ' ' + GUGUN + ' ' + DONG + ' ' + LI + ' ' + APT + '\', \'' + BUILDING + '\');">' + ADDR + '</a></td>';਍                    猀琀爀 ⬀㴀 ✀㰀⼀琀爀㸀✀㬀ഀഀ
		              }਍                紀ഀഀ
                if (data.total_count < '1') {਍                  猀琀爀 ⬀㴀 ✀㰀琀爀㸀✀㬀ഀഀ
                  str += '<td';਍                  椀昀 ⠀洀漀搀攀 ℀㴀 ✀瀀㈀✀⤀ 笀ഀഀ
                  str += ' colspan="3"';਍                  紀 攀氀猀攀 笀ഀഀ
                  str += ' colspan="2"';਍                  紀ഀഀ
                  str += ' class="nolist">검색결과가 없습니다.</td>';਍                  猀琀爀 ⬀㴀 ✀㰀⼀琀爀㸀✀㬀ഀഀ
                }਍                ഀഀ
				  str += '</tbody>';਍ऀऀऀऀ  猀琀爀 ⬀㴀 ✀㰀⼀琀愀戀氀攀㸀✀㬀ഀഀ
				  ਍ऀऀऀऀ  猀琀爀 ⬀㴀 ✀㰀搀椀瘀 挀氀愀猀猀㴀∀猀攀愀爀挀栀开稀椀瀀开瀀愀最攀∀㸀✀㬀ഀഀ
				  str += '<table cellpadding=0 cellspacing=0>';਍ऀऀऀऀ  猀琀爀 ⬀㴀 ✀㰀琀爀㸀✀㬀ഀഀ
				  str += '<td>'਍ऀऀऀऀ  ഀഀ
				  str += zip_paging(uzippages, data.cur_page, data.total_page);਍ऀऀऀऀ  ഀഀ
				  str += '</td>';਍ऀऀऀऀ  猀琀爀 ⬀㴀 ✀㰀⼀琀爀㸀✀㬀ഀഀ
				  str += '</table>';਍ऀऀऀऀ  猀琀爀 ⬀㴀 ✀㰀⼀搀椀瘀㸀✀㬀ഀഀ
				  str += '</div>';਍ऀऀऀऀ  紀ഀഀ
				  ਍ऀऀऀऀ  ␀⠀∀⌀∀ ⬀ 甀稀椀瀀椀搀 ⬀ ∀∀⤀⸀栀琀洀氀⠀猀琀爀⤀㬀ഀഀ
਍    紀Ⰰഀഀ
਍    攀爀爀漀爀㨀昀甀渀挀琀椀漀渀⠀攀⤀笀ഀഀ
     alert(e.messages);਍    紀Ⰰഀഀ
    jsonp: 'jsonp'਍   紀ഀഀ
  );਍紀ഀഀ
਍昀甀渀挀琀椀漀渀 稀椀瀀开瀀愀最椀渀最⠀眀爀椀琀攀开瀀愀最攀猀Ⰰ 挀甀爀开瀀愀最攀Ⰰ 琀漀琀愀氀开瀀愀最攀⤀ഀഀ
{਍      ഀഀ
    var str = "<ul>";਍    ഀഀ
    if (cur_page > 1) {਍        猀琀爀 ⬀㴀 ∀㰀氀椀㸀㰀愀 挀氀愀猀猀㴀栀漀洀攀 栀爀攀昀㴀✀⌀✀ 漀渀挀氀椀挀欀㴀✀稀椀瀀猀攀愀爀挀栀⠀㄀⤀✀ 琀椀琀氀攀㴀尀∀頀䳌⃇頀瓓샇峉∀㸀嬀頀䳌巇㰀⼀愀㸀㰀⼀氀椀㸀∀㬀ഀഀ
    }਍   ഀഀ
    start_page = ( ( parseInt( (cur_page - 1 ) / write_pages ) ) * write_pages ) + 1;਍    攀渀搀开瀀愀最攀 㴀 猀琀愀爀琀开瀀愀最攀 ⬀ 眀爀椀琀攀开瀀愀最攀猀 ⴀ ㄀㬀ഀഀ
    ਍    椀昀 ⠀攀渀搀开瀀愀最攀 㸀㴀 琀漀琀愀氀开瀀愀最攀⤀ 攀渀搀开瀀愀最攀 㴀 琀漀琀愀氀开瀀愀最攀㬀ഀഀ
    ਍    椀昀 ⠀猀琀愀爀琀开瀀愀最攀 㸀 ㄀⤀ 猀琀爀 ⬀㴀 ∀㰀氀椀㸀㰀愀 挀氀愀猀猀㴀瀀爀攀 栀爀攀昀㴀✀⌀✀ 漀渀挀氀椀挀欀㴀✀稀椀瀀猀攀愀爀挀栀⠀∀ ⬀ ⠀猀琀愀爀琀开瀀愀最攀ⴀ㄀⤀ ⬀ ∀⤀✀ 琀椀琀氀攀㴀尀∀琀Ӈ⃈頀瓓샇峉∀㸀嬀琀Ӈ巈㰀⼀愀㸀㰀⼀氀椀㸀∀㬀ഀഀ
਍    椀昀 ⠀琀漀琀愀氀开瀀愀最攀 㸀 ㄀⤀ 笀ഀഀ
        for (var k=start_page; k<=end_page; k++) {਍            椀昀 ⠀挀甀爀开瀀愀最攀 ℀㴀 欀⤀ഀഀ
                str += "<li><a class=nm href='#' onclick='zipsearch(" + k + ")'><span>" + k + "</span></a></li>";਍            攀氀猀攀ഀഀ
                str += "<li class=on><a class=nm href='#'><b>" + k + "</b></a></li>";਍        紀ഀഀ
    }਍    ഀഀ
    if (total_page > end_page) str += "<li><a class=next href='#' onclick='zipsearch(" + (end_page+1) + ")' title=\"다음 페이지\">[다음]</a></li>";਍    ഀഀ
    if (cur_page < total_page) {਍        猀琀爀 ⬀㴀 ∀㰀氀椀㸀㰀愀 挀氀愀猀猀㴀攀渀搀 栀爀攀昀㴀✀⌀✀ 漀渀挀氀椀挀欀㴀✀稀椀瀀猀攀愀爀挀栀⠀∀ ⬀ 琀漀琀愀氀开瀀愀最攀 ⬀ ∀⤀✀ 琀椀琀氀攀㴀尀∀嶹₰頀瓓샇峉∀㸀嬀嶹嶰㰀⼀愀㸀㰀⼀氀椀㸀∀㬀ഀഀ
    }਍    ഀഀ
    ਍    猀琀爀 ⬀㴀 ∀㰀⼀甀氀㸀∀㬀ഀഀ
    ਍   爀攀琀甀爀渀 猀琀爀㬀ഀഀ
}਍ഀഀ
function zipLoad(page)਍笀 ഀഀ
  zipsearch(page);਍紀ഀഀ
਍ഀഀ
function win_open(url, name, option)਍笀ഀഀ
    var popup = window.open(url, name, option);਍    瀀漀瀀甀瀀⸀昀漀挀甀猀⠀⤀㬀ഀഀ
}਍ഀഀ
// 우편번호 창਍昀甀渀挀琀椀漀渀 眀椀渀开稀椀瀀⠀昀爀洀开渀愀洀攀Ⰰ 昀爀洀开稀椀瀀㄀Ⰰ 昀爀洀开愀搀搀爀㄀Ⰰ 昀爀洀开愀搀搀爀㈀⤀ഀഀ
{਍    甀爀氀 㴀 ∀⼀愀搀搀爀开稀椀瀀⼀稀椀瀀⸀瀀栀瀀㼀洀漀搀攀㴀瀀㈀☀昀爀洀开渀愀洀攀㴀∀⬀昀爀洀开渀愀洀攀⬀∀☀昀爀洀开稀椀瀀㄀㴀∀⬀昀爀洀开稀椀瀀㄀⬀∀☀昀爀洀开愀搀搀爀㄀㴀∀⬀昀爀洀开愀搀搀爀㄀⬀∀☀昀爀洀开愀搀搀爀㈀㴀∀⬀昀爀洀开愀搀搀爀㈀㬀ഀഀ
    win_open(url, "winZip", "left=50,top=50,width=650,height=550,scrollbars=0");਍紀ഀഀ
਍⼀⼀ 저낹꓆⃂␀磆붹⃊萀벼⃒가꧀⃆ࠀ삮෉ഀ
try{document.attachEvent('oncontextmenu', function() {return false;});} catch(e) {}਍ഀഀ
$(function() {਍    瘀愀爀 猀眀 㴀 猀挀爀攀攀渀⸀眀椀搀琀栀㬀ഀഀ
    var sh = screen.height;਍    瘀愀爀 挀眀 㴀 搀漀挀甀洀攀渀琀⸀戀漀搀礀⸀挀氀椀攀渀琀圀椀搀琀栀㬀ഀഀ
    var ch = document.body.clientHeight;਍    瘀愀爀 琀漀瀀  㴀 猀栀 ⼀ ㈀ ⴀ 挀栀 ⼀ ㈀ ⴀ ㄀　　㬀ഀഀ
    var left = sw / 2 - cw / 2;਍    洀漀瘀攀吀漀⠀氀攀昀琀Ⰰ 琀漀瀀⤀㬀ഀഀ
});਍�