<!--배너이미지 사이즈지정 파일위치: /admin/banner/lib/lib.php-->

<table width="<?=$bn_width?>" border="0" cellpadding="0" cellspacing="0">
	<? for ($b=0; $b<$total_bn; $b++) { ?>
	<tr>
		<td style="border:1px solid #eeeeee;padding-bottom:10px;"><?=$list_bn[$b]["bn_img"]?></td>
	</tr>
	<? } ?>
</table>