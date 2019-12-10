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

		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'product_photo';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});

		$('.delete_images').click(function(){
	      if (confirm('Bạn có muốn xóa hình này ko ? ')) {
	        var id = $(this).attr('title');
			var table = 'product_photo';
			var links = "../upload/product/";
	        $.ajax ({
	          type: "POST",
	          url: "ajax/delete_images.php",
	          data: {id:id,table:table,links:links},
	          success: function(result) { 
	          }
	        });
	        $(this).parent().slideUp();
	      }
	      return false;
	    });

	    $('.themmoi').click(function(e) {
			$.ajax ({
				type: "POST",
				url: "ajax/khuyenmai.php",
				success: function(result) { 
					$('.load_sp').append(result);
				}
			});
        });

		$('.delete').click(function(e) {
			$(this).parent().remove();
		});
		

	});

	$(function(){
		 $("#states").select2();
        ///
        $("#states").change(function(){
        	$tags = $(this).val();
        	
        	if($tags>0){
        	$("#tags_name").append("<p class='delete_tags'>"+$("#states option:selected").text()+"<input name='tags[]' value='"+$tags+"'  type='hidden' /> <span></span> </p>");
        	}

	       	$(".delete_tags span").click(function(){
	        	$(this).parent().remove();
	        });
        });
        //
        $(".delete_tags span").click(function(){
        	$(this).parent().remove();
        });
	});
	
</script>

<?php
 function get_main_list()
  {
  	global $d,$item;
    $sql="select * from table_product_list where type='".$_GET['type']."' order by stt asc";
    $d->query($sql);
    $result = $d->result_array();
    $str='
      <select id="id_list" name="id_list" data-level="0" data-type="'.$_GET['type'].'" data-table="table_product_cat" data-child="id_cat" class="main_select select_danhmuc">
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

  function get_main_cat()
  {
  	global $d,$item;
    $sql="select * from table_product_cat where id_list='".$item['id_list']."' and type='".$_GET['type']."' order by stt asc";
    $d->query($sql);
    $result = $d->result_array();
    $str='
      <select id="id_cat" name="id_cat" data-level="1" data-type="'.$_GET['type'].'" data-table="table_product_item" data-child="id_item" class="main_select select_danhmuc">
      <option value="">Chọn danh mục 2</option>';
   	foreach ($result as $key => $row) {
   		if($row["id"]==(int)@$item["id_cat"])
        	$selected="selected";
      	else 
        	$selected="";
      	$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
   	}
    $str.='</select>';
    return $str;
  }

  function get_main_item()
  {
  	global $d,$item;
    $sql = "select * from table_product_item where id_cat='".$item['id_cat']."' and type='".$_GET['type']."' order by stt asc";
    $d->query($sql);
    $result = $d->result_array();
    $str='
      <select id="id_item" name="id_item" data-level="2" data-type="'.$_GET['type'].'" data-table="table_product_sub" data-child="id_sub" class="main_select select_danhmuc">
      <option value="">Chọn danh mục 3</option>';
    foreach ($result as $key => $row) {
    	if($row["id"]==(int)@$item["id_item"])
        	$selected="selected";
      	else 
        	$selected="";
      	$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
    }
    $str.='</select>';
    return $str;
  }
function get_main_sub()
  {
  	global $d,$item;
    $sql="select * from table_product_sub where id_item='".$item['id_item']."' and type='".$_GET['type']."' order by stt asc";
    $d->query($sql);
    $result = $d->result_array();
    $str='
      <select id="id_sub" name="id_sub" class="main_select">
      <option value="">Chọn danh mục 3</option>';
    foreach ($result as $key => $row) {
    	if($row["id"]==(int)@$item["id_sub"])
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
        	<li><a href="index.php?com=product&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

<!--thong tin chung-->
<div class="widget">
<?php if($config_list=='true'){ ?>
		<div class="formRow">
			<label>Chọn danh mục 1</label>
			<div class="formRight">
			<?=get_main_list()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if($config_cat=='true'){ ?>
		<div class="formRow">
			<label>Chọn danh mục 2</label>
			<div class="formRight">
			<?=get_main_cat()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if($config_item=='true'){ ?>
        <div class="formRow">
			<label>Chọn danh mục 3</label>
			<div class="formRight">
			<?=get_main_item()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if($config_sub=='true'){ ?>
		<div class="formRow">
			<label>Chọn danh mục 4</label>
			<div class="formRight">
			<?=get_main_sub()?>
			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
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
			
			<div class="mt10"><img src="<?=_upload_product.$item['thumb']?>"  alt="NO PHOTO" width="100" /></div>

			</div>
			<div class="clear"></div>
		</div>
		<?php } ?>
        
         <div class="formRow">
      <label>Hình ảnh kèm theo: </label>
      <div class="formRight">
          <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><img src="images/image_add.png" alt="" width="100"></a>                
         
     
    <?php if($act=='edit'){?>
      <?php if(count($ds_photo)!=0){?>       
            <?php for($i=0;$i<count($ds_photo);$i++){?>
              <div class="item_trich">
                  <img class="img_trich" width="140px" height="110px" src="<?=_upload_product.$ds_photo[$i]['photo']?>" />
                  <input type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS" />
                  <a class="delete_images" title="<?=$ds_photo[$i]['id']?>"><img src="images/delete.png"></a>
              </div>
            <?php } ?>
        
      <?php }?>

    <?php }?>
      </div>
          <div class="clear"></div>
        </div> 
		
        <div class="formRow">
			<label class="price">Giá bán</label>
			<div class="formRight">
                <input type="text" name="giaban" title="Nhập giá bán" id="giaban" class="conso" value="<?=@$item['giaban']?>"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Giá cũ (Nếu có)</label>
			<div class="formRight">
                <input type="text" name="giacu" title="Nhập giá cũ" id="giacu" class="conso" value="<?=@$item['giacu']?>"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Mã SP </label>
			<div class="formRight">
                <input type="text" name="masp" title="Nhập mã sản phẩm" id="masp" class="tipS" value="<?=@$item['masp']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<!-- <div class="formRow">
			<label>Giói tính</label>
			<div class="formRight">
				<select class="main_select sele2" multiple="multiple" name="gioitinh[]">
					<?php 
					$d->reset();
                    $sql = "select id,ten_vi from #_thuoctinh where type='sex' order by stt,id desc";
                    $d->query($sql);
                    $row_list = $d->result_array();
					for ($i=0; $i < count($row_list) ; $i++) { ?>
						<option value="<?=$row_list[$i]['id']?>" <?php if(in_array($row_list[$i]['id'], explode(',', $item['gioitinh']))) echo 'selected'; ?>><b><?=$row_list[$i]['ten_vi']?></b></option>
	                <?php } ?>
				</select>
			</div>
			<div class="clear"></div>
		</div> 

		<div class="formRow">
			<label>Chất liệu</label>
			<div class="formRight">
				<select class="main_select sele2" multiple="multiple" name="chatlieu[]">
					<?php 
					$d->reset();
                    $sql = "select id,ten_vi from #_thuoctinh where type='chatlieu' order by stt,id desc";
                    $d->query($sql);
                    $row_list = $d->result_array();
					for ($i=0; $i < count($row_list) ; $i++) { ?>
						<option value="<?=$row_list[$i]['id']?>" <?php if(in_array($row_list[$i]['id'], explode(',', $item['chatlieu']))) echo 'selected'; ?>><b><?=$row_list[$i]['ten_vi']?></b></option>
		                
	                <?php } ?>
				</select>
			</div>
			<div class="clear"></div>
		</div>  -->


		<!-- <div class="formRow">
			<label>Màu sắc</label>
			<div class="formRight">
                <input type="hidden" name="color" value="<?=@$item['arr_id_color']?>" id="color_product">
                <?php
                	$d->reset();
                	$sql = "select * from table_thuoctinh where hienthi=1 and type='mausac' order by stt, id desc";
                	$d->query($sql);
                	$arr_color = $d->result_array();
                	if(!empty($arr_color)){ ?>
                		
                        <?php
                        foreach ($arr_color as $v) { 
                            ?>
                            <div class="item_color <?php if(in_array($v['id'],explode(',',$item['arr_id_color']))) echo 'active'; ?>" data-id="<?=$v['id']?>" style="width: 30px; height: 30px; background: #<?=$v['color']?>;" title="<?=$v['ten_vi']?>"></div>
                        <?php
                        }
                        ?>
                	<?php	
                	}
                ?>
			</div>
			<div class="clear"></div>
		</div>
		<script type="text/javascript">
			$().ready(function(){
				$(".item_color").click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
					}
					$("#color_product").val(get_arr_color());
				})

				function get_arr_color(){
					var str = '';
					$(".item_color.active").each(function() {
						var id = $(this).attr('data-id');
						str += id + ',';
					});
					return str.slice(0, -1);
				}
			})
		</script> -->

		<?php /* <div class="formRow">
			<label>Size</label>
			<div class="formRight">
                <?php
                	$d->reset();
                	$sql = "select id,ten_vi from table_thuoctinh where hienthi=1 and type='size' order by stt, id desc";
                	$d->query($sql);
                	$arr_size = $d->result_array();
                	if(!empty($arr_size)){ ?>
                		
                        <?php
                        foreach ($arr_size as $v) { 
                            
                            ?>
                          
                            	<div class="td_sel">
									<input type="checkbox" name="size[]" id="check_<?=$v['id']?>" value="<?=$v['id']?>" <?php if(in_array($v['id'],explode(',',$item['arr_id_size']))) echo 'checked="checked"';?> />
             						<label for="check_<?=$v['id']?>"><?=$v['ten_vi']?></label>
								</div>
                        <?php
                        }
                        ?>
                	<?php	
                	}
                ?>
			</div>
			<div class="clear"></div>
		</div> */ ?>

		<!-- <div class="formRow">
            <label>Size + Giá </label>
            <div class="formRight">
            	
            	<style>
				table.tbl_size, table.tbl_size th, table.tbl_size td {
				    border: 1px solid #ccc;
				    border-collapse: collapse;
				    text-align: center;
				}
				table.tbl_size th, table.tbl_size td {
				    padding: 8px;
				}
				table.tbl_size tfoot{background: #2e373f;}
				.tbl_size input[type='number'],.tbl_size input[type='text']{padding: 7px 5px !important; width: calc(100% - 10px) !important;}
				.form input[type=number]{
				    font-size: 12px;
				    padding: 7px 6px;
				    background: white;
				    text-align: center;
				    border: 1px solid #DDD;
				    width: 100%;
				    font-family: Arial, Helvetica, sans-serif;
				    box-shadow: 0 0 0 2px #f4f4f4;
				    -webkit-box-shadow: 0 0 0 2px #f4f4f4;
				    -moz-box-shadow: 0 0 0 2px #f4f4f4;
				    color: #656565;
				}
				table.tbl_size input.data_size{max-width: calc(100% - 20px); text-align: center;}
				a.del_size{color: #fff; display: inline-block; padding: 2px 10px 1px 10px; font-size: 11px; background: #c02026; display: inline-block}
				a.edit_size{color: #fff; display: inline-block; padding: 2px 10px 1px 10px; font-size: 11px; background: #5ebc5e; display: inline-block;}
				a.save_size_cur{color: #fff; display: inline-block; padding: 2px 10px 1px 10px; font-size: 11px; background: #3774a3; display: inline-block;}
				</style>
                <table style="width:600px;" class="tbl_size">
                	<thead>
                		<th width="15%">STT</th>
                		<th>Size</th>
                		<th>Giá cũ</th>
                		<th>Giá bán</th>
                		<th width="10%"></th>
                	</thead>
                	<tbody>
                		<?php 
                		$d->reset();
	                	$sql = "select id,ten_vi from table_thuoctinh where hienthi=1 and type='size' order by stt, id desc";
	                	$d->query($sql);
	                	$arr_size = $d->result_array();

	                	$d->reset();
	                	$sql = "select stt,size,giacu,giaban from table_size where id_product='$item[id]' order by stt, id desc";
	                	$d->query($sql);
	                	$arr_size_cur = $d->result_array();
                		if(!empty($arr_size_cur)){
                			$k=1;
                			foreach($arr_size_cur as $s){ ?>
                				<tr class="row_size row_size_<?=$s['id']?>" data-k="<?=$k?>">
		                			<td align="center"><input type="number" name="data_size[<?=$k?>][]" value="<?=$s['stt']?>"></td>
		                			<td align="center">
		                				<input type="text" value="<?=get_size($s['size'])?>" readonly>
        								<input type="hidden" name="data_size[<?=$k?>][]" value="<?=$s['size']?>">
		                			</td>
		                			<td align="center"><input type="text" name="data_size[<?=$k?>][]" value="<?=$s['giacu']?>" class="conso"></td>
		                			<td align="center"><input type="text" name="data_size[<?=$k?>][]" value="<?=$s['giaban']?>" class="conso"></td>
		                			<td align="center">
		                				<a href="javascript:void(0);" class="del_size">Xóa</a>
		                			</td>
		                		</tr>
                		<?php
                				$k++;
                			}
                		}
                		?>
                		
                	</tbody>
                	<tfoot>
                		<tr>
                			<td><input type="number" min="0" id="data_stt" class="data_size" placeholder="STT"></td>
                			<td>
								<select id="data_size" class="data_size main_select">
									<option value="">-- Chọn Size --</option>
									<?php if(!empty($arr_size)){
										foreach($arr_size as $s){ ?>
											<option value="<?=$s['id']?>"><?=$s['ten_vi']?></option>
									<?php
										}
									} ?>
								</select>
                			</td>
                			<td><input type="text" id="data_gia" class="data_size conso" placeholder="Giá cũ"></td>
                			<td><input type="text" id="data_giakm" class="data_size conso" placeholder="Giá bán"></td>
                			<td><input type="button" id="add_size" class="blueB" value="Thêm"></td>
                		</tr>
                	</tfoot>
                </table>
                <script type="text/javascript">
                	$().ready(function(){
                		$("#add_size").click(function(){
                			var max=0;
                			$(".row_size").each(function(index, el) {
                				var k = parseInt($(this).attr('data-k'));
                				if(k>max){
                					max = k;
                				}
                			});
                			max = max + 1;
                			console.log(max);
                			var stt = $("#data_stt").val();
                			var size = $("#data_size").val();
                			var txt_size = $("#data_size option:selected").text();
                			var giacu = $("#data_gia").val();
                			var giaban = $("#data_giakm").val();

                			if(!stt){
                				alert('Vui lòng nhập STT');
                				$("#data_stt").focus();
                				return false;
                			}
                			if(!size){
                				alert('Vui lòng nhập Size');
                				$("#data_size").focus();
                				return false;
                			}
                			if(!giacu){
                				alert('Vui lòng nhập giá');
                				$("#data_gia").focus();
                				return false;
                			}
                			if(!giaban){
                				alert('Vui lòng nhập giá khuyến mãi');
                				$("#data_giakm").focus();
                				return false;
                			}
                			var rows = '<tr class="row_size" data-k="'+max+'">\
                							<td align="center"><input type="number" name="data_size['+max+'][]" value="'+stt+'"></td>\
                							<td align="center">\
                								<input type="text" value="'+txt_size+'" readonly>\
                								<input type="hidden" name="data_size['+max+'][]" value="'+size+'">\
                							</td>\
                							<td align="center"><input type="text" name="data_size['+max+'][]" value="'+giacu+'" class="conso"></td>\
                							<td align="center"><input type="text" name="data_size['+max+'][]" value="'+giaban+'" class="conso"></td>\
                							<td align="center"><a href="javascript:void(0);" class="del_size">Xóa</a></td>\
                						</tr>';


        					$(".tbl_size tbody").append(rows);
        					$("#data_stt").val('');
        					$("#data_size").val('');
        					$("#data_gia").val('');
        					$("#data_giakm").val('');
        					
                		})


						$(".tbl_size").on('click','.del_size',function(){
							if(confirm("Bạn muốn xóa Size này ?")){
                				var tr_row = $(this).parent().parent();
	                			tr_row.remove();
                			}
						})              		
                	})
                </script>
           
            </div>
            <div class="clear"></div>
        </div> -->

		

		
	<div class="formRow">
		<label>Tags</label>
		<div class="formRight">
			<select name="tags[]" class="sele2" multiple>
				<?php  
				$d->reset();
				$sql = "select id,ten_vi from table_tags where 1=1 order by ten_vi desc";
				$d->query($sql);
				$arr_tags = $d->result_array();
				if(!empty($arr_tags)){
					foreach($arr_tags as $tag){ ?>
						<option value="<?=$tag['id']?>" <?php if(in_array($tag['id'], explode(',', $item['tags']))) echo 'selected'; ?>><?=$tag['ten_vi']?></option>
				<?php
					}
				}
				?>
			</select>
        </div>
		<div class="clear"></div>
	</div>
		

    <div class="formRow">
      <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
      <div class="formRight">
     
        <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
         <label>Số thứ tự: </label>
          <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
      </div>
      <div class="clear"></div>
    </div>
</div>  
<!--end thong tin chung-->


<!--phan ngon ngu-->
<div class="widget">
<?php
 if(count($config['lang'])>1) {?>
	<div class="title chonngonngu">
		<ul>
		<?php foreach ($config['lang'] as $key => $value) { ?>
			<li><a href="<?=$key?>" class="<?=$key==$config['lang_active']?'active':''?> tipS validate[required]" title="Chọn <?=$value?>"><?=$value?></a></li>
		<?php } ?>
		</ul>
	</div>
<?php } ?>

<?php foreach ($config['lang'] as $key => $value) { ?>
<div class="contain_lang_<?=$key?> contain_lang <?=$key==$config['lang_active']?'active':''?>">
	<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
		<h6>Nội dung <?=$value?></h6>
	</div>
	
        <div class="formRow">
			<label>Tiêu đề <?=$key!=$config['lang_active']?'('.$key.')':''?></label>
			<div class="formRight">
                <input type="text" name="data[ten_<?=$key?>]" title="Nhập tên danh mục" id="ten_<?=$key?>" class="tipS validate[required]" value="<?=@$item['ten_'.$key]?>" />
			</div>
			<div class="clear"></div>
		</div>

		<!-- <div class="formRow">
			<label>Text <?=$key!=$config['lang_active']?'('.$key.')':''?></label>
			<div class="formRight">
                <input type="text" name="data[name_<?=$key?>]" title="Nhập tên danh mục" id="name_<?=$key?>" class="tipS" value="<?=@$item['name_'.$key]?>" />
			</div>
			<div class="clear"></div>
		</div> -->
		
<?php if($config_mota=='true'){ ?>
		<div class="formRow">
			<label>Mô tả <?=$key!=$config['lang_active']?'('.$key.')':''?></label>
			<div class="ck_editor">
                <textarea id="mota_<?=$key?>" title="Nhập mô tả . " class="tipS" name="data[mota_<?=$key?>]"><?=@$item['mota_'.$key]?></textarea>
			</div>
			<div class="clear"></div>
		</div>

		
<?php } ?>

		<div class="formRow">
			<label>Nội Dung <?=$key!=$config['lang_active']?'('.$key.')':''?></label>
			<div class="ck_editor">
                <textarea id="noidung_<?=$key?>" name="data[noidung_<?=$key?>]"><?=@$item['noidung_'.$key]?></textarea>
			</div>
			<div class="clear"></div>
		</div>
</div><!--lang-->
<?php } ?>
</div>
<!--end phan ngon ngu-->
 
	<div class="widget">
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
		
		<div class="formRow">
			<div class="formRight">
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
            	<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            	<a href="index.php?com=product&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</form>        </div>



<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input type="text" name="stthinh[]" class="stthinh" placeholder="Nhập STT" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>
