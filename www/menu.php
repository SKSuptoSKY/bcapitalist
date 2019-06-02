<? if($page_loc=="sub01")  { ?>
	<div class="lnb">
		<h3 <?=($PHP_SELF == "/sub01/sub01.php")?"class='on'":"class='#none'";?> ><a href="/sub01/sub01.php" <?if($PHP_SELF == "/sub01/sub01.php"){?> class="over"<? } ?> ><span>메뉴1</span></a></h3>
		<h3 <?=($PHP_SELF == "/sub01/sub02.php")?"class='on'":"class='#none'";?> ><a href="/sub01/sub02.php" <?if($PHP_SELF == "/sub01/sub02.php"){?> class="over"<? } ?> ><span>메뉴2</span></a></h3>
		<h3 <?=($PHP_SELF == "/sub01/sub03.php")?"class='on'":"class='#none'";?> ><a href="/sub01/sub03.php" <?if($PHP_SELF == "/sub01/sub03.php"){?> class="over"<? } ?> ><span>메뉴3</span></a></h3>
		<h3 <?=($PHP_SELF == "/sub01/sub04.php")?"class='on'":"class='#none'";?> ><a href="/sub01/sub04.php" <?if($PHP_SELF == "/sub01/sub04.php"){?> class="over"<? } ?> ><span>메뉴4</span></a></h3>
		<h3 <?=($PHP_SELF == "/sub01/sub05.php")?"class='on'":"class='#none'";?> ><a href="/sub01/sub05.php" <?if($PHP_SELF == "/sub01/sub05.php"){?> class="over"<? } ?> ><span>메뉴5</span></a></h3>
	</div>
<? } ?>



<? if($page_loc=="sub02")  { ?>
	<div class="lnb">
		<h3 <?=($PHP_SELF == "/sub02/sub01.php" or $PHP_SELF == "/sub02/sub01_2.php")?"class='on'":"class='#none'";?> ><a href="#none" <?if($PHP_SELF == "/sub02/sub01.php" or $PHP_SELF == "/sub02/sub01_2.php"){?> class="over"<? } ?> ><span>메뉴1</span></a></h3>
			<ul>
				<li class='deps1<?=($PHP_SELF == "/sub02/sub01.php")?" on":"";?>'><a href="/sub02/sub01.php" <?=($PHP_SELF == "/sub02/sub01.php")?" class='m_over'":"";?>>메뉴1_1</a></li>
				<li class='deps1<?=($PHP_SELF == "/sub02/sub01_2.php")?" on":"";?>'><a href="/sub02/sub01_2.php" <?=($PHP_SELF == "/sub02/sub01_2.php")?" class='m_over'":"";?>>메뉴1_2</a></li>
			</ul>
	</div>
<? } ?>