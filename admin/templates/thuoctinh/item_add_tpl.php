
<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});

</script>
<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=thuoctinh&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=thuoctinh&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		
	<?php if(count($config['lang'])>1) {?>
		<div class="title chonngonngu">
		<ul>
			<?php foreach ($config['lang'] as $key => $value) { ?>
				<li><a href="<?=$key?>" class="<?=$key==$config['lang_active']?'active':''?> tipS" title="Chọn <?=$value?>"><?=$value?></a></li>
			<?php } ?>
		</ul>
		</div>	
	<?php } ?>

		<?php if($config_list_pro=='true' && isset($config_list_pro)) { ?>
				<div class="formRow">
					<label>Danh mục</label>
					<div class="formRight">
						<select name="id_list_pro" class="main_select">
							<option value="">Chọn danh mục</option>
							<?php 
							$d->reset();
							$sql = "select id, ten_vi from table_product_list where type='product' and id_parent=0 order by stt, id desc";
							$d->query($sql);
							$arr_list = $d->result_array();
							if(!empty($arr_list)){
								foreach($arr_list as $l){ ?>
									<option value="<?=$l['id']?>" <?php if($item['id_list_pro']==$l['id']) echo 'selected'; ?>><?=$l['ten_vi']?></option>
							<?php
								}
							}
							?>
						</select>
					</div>
					<div class="clear"></div>
				</div>
		<?php } ?>

		<?php if($config_images=='true') { ?>
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
	            	<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
				</div>
				<div class="clear"></div>
			</div>
	        <?php if($_GET['act']=='edit'){?>
			<div class="formRow">
				<label>Hình Hiện Tại :</label>
				<div class="formRight">
				
				<div class="mt10"><img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" width="100" /></div>

				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
		<?php } ?>

        <div class="formRow lang_hidden lang_vi active">
			<label>Tên</label>
			<div class="formRight">
                <input type="text" name="ten_vi" title="Nhập tên danh mục" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>
		

		<div class="formRow lang_hidden lang_en">
			<label>Tên (Tiếng anh)</label>
			<div class="formRight">
                <input type="text" name="ten_en" title="Nhập tên danh mục" id="ten_en" class="tipS validate[required]" value="<?=@$item['ten_en']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_kr">
			<label>Tên (Tiếng Hàn)</label>
			<div class="formRight">
                <input type="text" name="ten_kr" title="Nhập tên danh mục" id="ten_kr" class="tipS validate[required]" value="<?=@$item['ten_kr']?>" />
			</div>
			<div class="clear"></div>
		</div>

	<?php if($config_khoang=='true') { ?>
		<div class="formRow">
			<label>Giá trị từ <?php if(!empty($config_donvi)) echo '('.$config_donvi.')'; ?></label>
			<div class="formRight">
                <input type="text" name="giatu" title="Nhập giá từ" id="giatu" class="tipS conso" value="<?=@$item['giatu']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Giá trị đến <?php if(!empty($config_donvi)) echo '('.$config_donvi.')'; ?></label>
			<div class="formRight">
                <input type="text" name="giaden" title="Nhập giá đến" id="giaden" class="tipS conso" value="<?=@$item['giaden']?>" />
			</div>
			<div class="clear"></div>
		</div>
        
   <?php } ?>


   		<?php if($config_giatri=='true') { ?>
			<div class="formRow">
				<label>Giá trị</label>
				<div class="formRight">
	                <input type="text" name="giatri" title="Nhập giá trị" id="giatri" class="tipS conso" value="<?=@$item['giatri']?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>


		<?php if($config_color=='true') { ?>
			<div class="formRow">
				<label>Mã màu</label>
				<div class="formRight">
	                <input type="text" name="color" title="Nhập mã màu" id="color" class="jscolor" value="<?=@$item['color']?>" />
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

		<?php if($config_mota=='true') { ?>
			<div class="formRow lang_hidden lang_vi active">
				<label><?php if($_GET['type']=='doitac_tragop') echo 'Hồ sơ';else echo 'Mô tả'; ?></label>
				<div class="formRight">
	                <textarea rows="4" id="mota_vi" name="mota_vi"><?=@$item['mota_vi']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			

			<div class="formRow lang_hidden lang_en">
				<label><?php if($_GET['type']=='doitac_tragop') echo 'Hồ sơ';else echo 'Mô tả'; ?> (Tiếng anh)</label>
				<div class="formRight">
	                <textarea rows="4" id="mota_en" name="mota_en"><?=@$item['mota_en']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_kr">
				<label>Mô tả (Tiếng Hàn)</label>
				<div class="formRight">
	                <textarea rows="4" id="mota_kr" name="mota_kr"><?=@$item['mota_kr']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

		<?php if($config_noidung=='true') { ?>
			<div class="formRow lang_hidden lang_vi active">
				<label>Nội dung</label>
				<div class="formRight">
	                <textarea rows="4" id="noidung_vi" name="noidung_vi"><?=@$item['noidung_vi']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			

			<div class="formRow lang_hidden lang_en">
				<label>Nội dung (Tiếng anh)</label>
				<div class="formRight">
	                <textarea rows="4" id="noidung_en" name="noidung_en"><?=@$item['noidung_en']?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_kr">
				<label>Nội dung (Tiếng Hàn)</label>
				<div class="formRight">
	                <textarea rows="4" id="noidung_kr" name="noidung_kr"><?=@$item['noidung_kr']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>


        <div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label>Số thứ tự: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:50px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
		
	</div>  
	<div class="widget">
		<?php if($config_noseo=='false') { ?>
		<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
			<h6>Nội dung seo</h6>
		</div>
		
		<div class="formRow">
			<label>Title</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['title']?>" name="title" title="Nội dung thẻ meta Title dùng để SEO" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Từ khóa</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['keywords']?>" name="keywords" title="Từ khóa chính cho danh mục" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Description:</label>
			<div class="formRight">
				<textarea rows="4" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS" name="description"><?=@$item['description']?></textarea>
                <input readonly="readonly" type="text" style="width:25px; margin-top:10px; text-align:center;" name="des_char" value="<?=@$item['des_char']?>" /> ký tự <b>(Tốt nhất là 68 - 170 ký tự)</b>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<div class="formRow">
			<div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            	<a href="index.php?com=thuoctinh&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</form>        </div>
