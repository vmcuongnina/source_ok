<h3>Thêm Quận Huyện</h3>
<form name="frm" method="post" action="index.php?com=tinhthanh&act=save&id_cat=<?=$_GET['id_cat']?>" enctype="multipart/form-data" class="nhaplieu"><br />
	<b>Danh mục</b> <?=$list;?><br /><br />

	<b>Quận Huyện: </b> <input type="text" name="ten" value="<?=$item['ten']?>" class="input" /><br /><br />
    <b>Khu vực : </b>
	
    <input type="radio" value="1" name="vanchuyen" <?php if($item['vanchuyen']==1){?> checked="checked"<?php } ?> /> Nội Thành 
    <input type="radio" value="2" name="vanchuyen" <?php if($item['vanchuyen']==2){?> checked="checked"<?php } ?> /> Ngoại Thành 
	<input type="radio" value="" name="vanchuyen" <?php if($item['vanchuyen']==''){?> checked="checked"<?php } ?> /> Khác 
    <br /><br />

	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br />
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br /><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=tinhthanh&act=man'" class="btn" />
</form>