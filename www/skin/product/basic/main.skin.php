	<table width="1" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				
				<table width="720" border="1" cellpadding="0" cellspacing="0" bordercolor="#dedddd" style="border-collapse:collapse;">
					<? for ($b=0; $b<4; $b++) { ?>
					<tr>
						<td><a href="/product/list.php?ca_id=<?=$ca_id[$b]?>"><img src="<?=$ca_img[$b]?>"></a></td>
						<? for ($i=0; $i<4; $i++) { ?>
						<td>
							<table width="<?if(!$i){?>138<?}else{?>144<?}?>" border="0" cellspacing="0" cellpadding="0" bgcolor="">
								<tr>
									<td class="table_b"><a href="/product/item.php?ca_id=<?=$ca_id[$b]?>&it_id=<?=$list[$b][$i]["it_id"]?>"><?=$list[$b][$i][list_img]?></a></td>
								</tr>
								<tr>
									<td class="table_t"><a href="/product/item.php?ca_id=<?=$ca_id[$b]?>&it_id=<?=$list[$b][$i]["it_id"]?>"><?=cut_str($list[$b][$i][it_name],20,"...")?></a></td>
								</tr>
							</table>
						</td>					
						<? } ?>
					</tr>
					<? } ?>
					<!--
					<tr>
						<td><img src="/images/main/chair.jpg"></td>
						<td>
							<table width="138" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (월넛)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (연체리)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (망펄비치)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">목재구스 책상</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><img src="/images/main/bookcase.jpg"></td>
						<td>
							<table width="138" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (월넛)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (연체리)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (망펄비치)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">목재구스 책상</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><img src="/images/main/table.jpg"></td>
						<td>
							<table width="138" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (월넛)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (연체리)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">프레지던트 책상 (망펄비치)</td>
								</tr>
							</table>
						</td>
						<td>
							<table width="144" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="table_b"><img src="/images/main/desk_s.jpg"></td>
								</tr>
								<tr>
									<td class="table_t">목재구스 책상</td>
								</tr>
							</table>
						</td>
					</tr>
					-->
				</table>
			</td>
		</tr>
	</table>