<? include $_SERVER["DOCUMENT_ROOT"]."/head.php"; ?>

<div class="section-block content-inner pt-0">
	<div id="recent-posts" class="grid-container " data-layout-mode="masonry" data-grid-ratio="1" data-animate-resize data-animate-resize-duration="700">
		<div class="grid clfix">
			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcT6lo78jNHDHdmc0XbnqtA6hMbE4YztyKqRjcR5y7uLzm2UCHzRSw" alt=""/>
				</a>
				<p class="img_Title"><a href="#">포토소식 게시물 제목입니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTNeIMZqmrbQYR-eJ0VKQIp80qUykAMuMY7Z12Xm-PRP8CLkJhNMQ" alt=""/>
				</a>
				<p class="img_Title"><a href="#">사단법인 전국간호학원협회입니다.  게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQWwLVIl_7AyoyR6OUO62Ahmo8ez3p463O2QUrPEoVuoKAErN33" alt=""/>
				</a>
				<p class="img_Title"><a href="#">포토소식 제목111 </a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="http://img.etnews.com/news/article/2015/03/31/article_31150549581121.jpg" alt=""/>
				</a>
				<p class="img_Title"><a href="#">사단법인 전국간호학원협회입니다.  게시물 제목입니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://i.ytimg.com/vi/lVB-6huT804/maxresdefault.jpg" alt=""/>
				</a>
				<p class="img_Title"><a href="#">게시물 제목입니다. 게시물 제목이 출력됩니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="http://cfile23.uf.tistory.com/image/222C0C5056297EF417C3DA" alt=""/>
				</a>
				<p class="img_Title"><a href="#">게시물 제목입니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://i.ytimg.com/vi/g4-ecNSENb0/maxresdefault.jpg" alt=""/>
				</a>
				<p class="img_Title"><a href="#">게시물 제목입니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="http://mblogthumb1.phinf.naver.net/20140617_156/imautumn_1402985672592wsxGI_PNG/%C4%AB%C4%AB%BF%C0%C7%C1%B7%BB%C1%EE1.png?type=w2" alt=""/>
				</a>
				<p class="img_Title"><a href="#">게시물 제목입니다. 사단법인 전국간호학원협회입니다. 사단법인 전국간호학원협회입니다.  게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->

			<div class="grid-item grid-sizer">
				<a class="overlay-link" href="#">
					<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTrv6ZydcMwMo9tptzfW1gv4y1TFlQ_hu93GkWffkGmNC64N-BM" alt=""/>
				</a>
				<p class="img_Title"><a href="#">게시물 제목입니다. 게시물 제목이 출력됩니다.</a></p>
			</div><!--// grid-item -->
		</div><!--// grid -->

	</div>
</div>






<div class="board_search mt20">
	<table width="<?=$Board_Admin["width"]?>" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
				<form name=search action="<?=$_SERVER[PHP_SELF]?>" autocomplete="off" style="margin:0px;">
				<input type=hidden name=tbl value="<?=$Table?>">
				<input type=hidden name=mode value="">
				<input type=hidden name=page value="<?=$page?>">
						<td>
						<? if($Board_Admin["use_category"] == TRUE) { ?>
							<select name="category" style="height:28px; color:#666666; font-size:9pt; background-color:#ffffff; border:1 #DFDFDF solid; font-size:13px;">
								<option value="" <?if($category==""){?>selected<?}?>>--분류--</option>
								<?=$Category_option?>
							</select>
						<? } ?>
							<select name="findType">
								<option value="" <?if($findType==""){?>selected<?}?>>--검색--</option>
								<option value="title" <?if($findType=="title"){?>selected<?}?>>제목</option>
								<option value="name" <?if($findType=="name"){?>selected<?}?>>작성자명</option>
								<option value="content" <?if($findType=="content"){?>selected<?}?>>내용</option>
							</select>
							&nbsp;<input type="text" name="findWord" class="board_search_area" placeholder="검색어를 입력하세요" value="<?=$findword?>">&nbsp;<input type="submit" value="검색" class="board_btn_seach"/>
						</td>
				</form>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>


<style>


/* ---- grid ---- */

.grid {
  max-width: 100%;
  margin:0 auto 0;
}
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- grid-item ---- */
.grid-item {
  width: 32%;
  height: auto;
  float: left;
  border: 1px solid #ddd;
  margin:0.666%;
  padding:2%; 
}
.grid-item img{width:100%; }
.grid-item p.img_Title{word-break:break-all; font-size:13px; color:#555555; line-height:20px; margin-top:8px; display:block; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
.grid-item p.img_Title a{color:#555555;}


@media screen and (max-width : 1023px) {
/* ---- grid ---- */
.grid {
  max-width: 100%;
  margin:0 auto;
}
/* ---- grid-item ---- */

.grid-item {
  width: 32%;
  height: auto;
  float: left;
  /* border: 1px solid #ddd; */
  margin:0.666%;
}
.grid-item img{width:100%; }

}


@media screen and (max-width : 768px) {
/* ---- grid ---- */
.grid {
  max-width: 100%;
  margin:0 auto;
}
/* ---- grid-item ---- */

.grid-item {
  width: 48%;
  height: auto;
  float: left;
  /* border: 1px solid #ddd; */
  margin:1%;
}
.grid-item img{width:100%; }
.grid-item p.img_Title{font-size:12px; }
}


.board_search{height:50px; background:#efefef; border:1px solid #ccc; padding:10px 0; }
.board_search select{height:28px; box-sizing:border-box; font-size:13px; border:1px solid #ccc; }
.board_search input{height:28px; box-sizing:border-box; font-size:13px; vertical-align:middle;}
.board_search .board_search_area{width:230px; border:1px solid #ccc; text-indent:10px; -webkit-border-radius:0px;  -webkit-appearance:none; }
.board_search .board_btn_seach{width:80px; background:#888; border:1px solid #666; color:#fff; font-weight:bold;
-webkit-border-radius:0px;  -webkit-appearance:none; }


@media screen and (max-width : 768px) {
.board_search .board_search_area{width:48%; text-indent:5px; }
.board_search .board_btn_seach{width:16%; background:#888; border:1px solid #666; color:#fff; font-weight:bold;}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */ color:#555555; font-size:12px; }
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color:#555555; font-size:12px; opacity:  1;}
::-moz-placeholder { /* Mozilla Firefox 19+ */ color:#555555; font-size:12px; opacity:  1;}
:-ms-input-placeholder { /* Internet Explorer 10-11 */ color:#555555; font-size:12px;}
:placeholder-shown { /* Standard (https://drafts.csswg.org/selectors-4/#placeholder) */ color:#555555; font-size:12px;}
}

</style>



<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://labs.funkhausdesign.com/examples/masonry/masonry.pkgd.min.js"></script>
<script src="/css/js/timber.master.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		// Start Masonry
		jQuery('.grid').masonry({
			//columnWidth: 150, //너비
			itemSelector: '.grid-item', //ㅇ안에 상자
			//gutter: 20, //간격
			//isFitWidth: true //너비맞출건지 여부
		});
		

	});
</script>

<? include $_SERVER["DOCUMENT_ROOT"]."/foot.php"; ?>