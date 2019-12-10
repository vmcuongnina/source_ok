<?php  
	function get_main_list()
  {
  	global $item,$d;
    $sql="select id,ten_vi from table_tags where type='".$_GET['type']."' and hienthi=1 order by stt asc";
    $d->query($sql);
    $result = $d->result_array();
    $str='
      <select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" class="main_select">
      <option value="">Chọn danh mục 1</option>';
    foreach ($result as $key => $row) {
    	if($row["id"]==(int)@$item["id_list"])
        	$selected="selected";
      	else 
        	$selected="";
      	$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
    }
    $str.='</select>';
    return $str;
  }
?>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=download&act=man&type=<?=$_GET['type']?>"><span><?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=download&act=save&type=<?=$_GET['type']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<?php if(count($config['lang'])>1) { ?>
			<div class="title chonngonngu">
				<ul>
				<?php foreach ($config['lang'] as $key => $value) { ?>
					<li><a href="<?=$key?>" class="<?=$key==$config['lang_active']?'active':''?> tipS validate[required]" title="Chọn <?=$value?>"><?=$value?></a></li>
				<?php } ?>
				</ul>
			</div>
		<?php } ?>
			<div class="formRow">
				<label>Danh mục cấp 1 :</label>
				<div class="formRight">
					<?=get_main_list()?>
				</div>
				<div class="clear"></div>
			</div>
		<?php foreach ($config['lang'] as $key => $value) { ?>
			<div class="contain_lang_<?=$key?> contain_lang <?=$key==$config['lang_active']?'active':''?>">
				<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
					<h6>Nội dung <?=$value?></h6>
				</div>
				
		        <div class="formRow">
					<label>Tiêu đề <?=$key!=$config['lang_active']?'('.$key.')':''?></label>
					<div class="formRight">
		                <input type="text" name="data[ten_<?=$key?>]" title="Nhập tên tài liệu" id="ten_<?=$key?>" class="tipS validate[required]" value="<?=@$item['ten_'.$key]?>" />
					</div>
					<div class="clear"></div>
				</div>
			</div>
		<?php } ?>
		<?php if($config_img=="true"){ ?>
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
				
				<div class="mt10"><img src="<?=_upload_hinhanh.$item['thumb']?>"  alt="NO PHOTO" width="100" /></div>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
		<?php } ?>
		

		<div class="formRow">
			<label>Tải File :</label>
			<div class="formRight">
            	<input type="file" id="file_download" name="file_download" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
				<div class="note"> Type  : pdf , doc , docx</div>
			</div>
			<div class="clear"></div>
		</div>
        <?php if($_GET['act']=='edit'){?>
		<div class="formRow">
			<label>File Hiện Tại :</label>
			<div class="formRight">
			
			<div class="mt10"><?=$item['file']?></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
       
       
        
		
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
           
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>            
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id_this_download" value="<?=@$item['id']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>