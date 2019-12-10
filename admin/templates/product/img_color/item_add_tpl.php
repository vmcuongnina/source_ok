<?php  
	function get_main_color(){
	  	global $item,$d;
	    $sql="select id,ten_vi from table_tags where type='color' and hienthi=1 order by stt asc";
	    $d->query($sql);
	    $result = $d->result_array();
	    $str='
	      <select id="colorId" name="colorId" class="main_select">
	      <option value="">Chọn màu</option>';
	    foreach ($result as $key => $row) {
	    	if($row["id"]==(int)@$item["colorId"])
	        	$selected="selected";
	      	else 
	        	$selected="";
	      	$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
	    }
	    $str.='</select>';
	    return $str;
  	}
  	function get_main_size(){
	  	global $item,$d;
	    $sql="select id,ten_vi from table_tags where type='size' and hienthi=1 order by stt asc";
	    $d->query($sql);
	    $result = $d->result_array();
	    $str='
	      <select id="sizeId" name="sizeId" class="main_select">
	      <option value="">Chọn size</option>';
	    foreach ($result as $key => $row) {
	    	if($row["id"]==(int)@$item["sizeId"])
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
        	<li><a href="index.php?com=product&act=add_imgcolor<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm màu sản phẩm</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_imgcolor<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>&id_product=<?=$_GET['id_product']?>" method="post" enctype="multipart/form-data">


<!--thong tin chung-->
<div class="widget">
<?php if($config_images=="true"){ ?>
	<div class="formRow">
		<label>Tải hình ảnh:</label>
		<div class="formRight">
        	<input type="file" id="file" name="file" />
			<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
			<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
		</div>
		<div class="clear"></div>
	</div>

	<?php if($_GET['act']=='edit_imgcolor'){?>
		<div class="formRow">
			<label>Hình Hiện Tại :</label>
			<div class="formRight">
			
			<div class="mt10"><img src="<?=_upload_product.$item['thumb']?>"  alt="NO PHOTO"  /></div>
			</div>
			<div class="clear"></div>
		</div>
	<?php } ?>	
<?php } ?>
	<div class="formRow">
		<label>Chọn màu :</label>
		<div class="formRight">
			<?=get_main_color()?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow ">
		<label>Mã Color:</label>
		<div class="formRight">
			<input type="text" class="color" name="color" title="Nhập màu sản phẩm" class="tipS validate[required]" value="<?=@$item['color']?>" size="15" />
		</div>

		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Chọn size:</label>
		<div class="formRight">
			<?=get_main_size()?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Giá bán</label>
		<div class="formRight">
            <input type="text" name="giaban" title="Nhập giá" id="giaban" class="conso tipS validate[required]" value="<?=@$item['giaban']?>" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Giá cũ (Nếu có)</label>
		<div class="formRight">
            <input type="text" name="giacu" title="Nhập giá" id="giacu" class="conso tipS validate[required]" value="<?=@$item['giacu']?>" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label>Số thứ tự: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
    </div>

</div>  

	<div class="widget">
		<div class="formRow">
			<div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            	<a href="index.php?com=product&act=man_imgcolor<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>

			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>        </div>
