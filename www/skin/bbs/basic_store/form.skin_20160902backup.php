<table width="100%" border="0" cellspacing="0" cellpadding="0" class="store_board">
	<colgroup>
		<col width="20%">
		<col width="80%">
	</colgroup>
	<tr>
		<th scope="row" >작성자</th>
		<td><input type="text" name="textfield" id="textfield" style="width:80%;" /></td>
	</tr>
	<tr>
		<th scope="row" >지역</th>
		<td><select name="select" id="select" style="width:30%;">
					<option value="--선택하세요--" selected="selected">----선택하세요----</option>
					<option value="서울특별시">서울특별시</option>
					<option>부산광역시</option>
					<option>대구광역시</option>
					<option>인천광역시</option>
					<option>광주광역시</option>
					<option>대전광역시</option>
					<option>울산광역시</option>
					<option>경기도</option>
					<option>강원도</option>
					<option>충청북도</option>
					<option>충청남도</option>
					<option>전라북도</option>
					<option>전라남도</option>
					<option>경상북도</option>
					<option>경상남도</option>
					<option>제주도</option>
				</select></td>
	</tr>
	<tr>
		<th scope="row" >대리점명</th>
		<td><input type="text" name="textfield" id="textfield" style="width:80%;" /></td>
	</tr>
	<tr>
		<th scope="row" >주소</th>
		<td><input type="text" name="textfield" id="textfield" style="width:80%;" /></td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="50" valign="middle">
		<td style="padding-left:50px;">
			<input type="submit" border="0" onclick="return writeChk(writeform)" value="확인" style="width:70px; height:27px; background:#f1f1f1;  font-weight:bold; border:1px solid #dbdbdb; color:#111111; text-align:center; line-height:25px; vertical-align:top; cursor:pointer;-webkit-border-radius:0px;  -webkit-appearance:none;">&nbsp;
			<a href="<?=$Url["list"]?>"><div class="btn_list" style="width:70px; height:27px; background:#fff; color:#111; font-weight:bold; border:1px solid #dbdbdb; text-align:center; line-height:25px; display:inline-block;">목록</div></a>
		</td>
	</tr>
</table>