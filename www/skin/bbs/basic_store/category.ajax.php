<?
	include "lib.php";

	switch($_POST["locate"]){
		case "서울특별시"     : $list = $list1; break;
		case "부산광역시"     : $list = $list2; break;
		case "대구광역시"     : $list = $list3; break;
		case "인천광역시"     : $list = $list4; break;
		case "광주광역시"     : $list = $list5; break;
		case "대전광역시"     : $list = $list6; break;
		case "울산광역시"     : $list = $list7; break;
		case "경기도"         : $list = $list8; break;
		case "강원도"         : $list = $list9; break;
		case "충청북도"       : $list = $list10; break;
		case "충청남도"       : $list = $list11; break;
		case "전라북도"       : $list = $list12; break;
		case "전라남도"       : $list = $list13; break;
		case "경상북도"       : $list = $list14; break;
		case "경상남도"       : $list = $list15; break;
		case "제주도" : $list = $list16; break;
	}
?>
<?foreach($list as $key => $value):?>
	<option value="<?=$value?>"><?=$value?></option>
<?endforeach;?>