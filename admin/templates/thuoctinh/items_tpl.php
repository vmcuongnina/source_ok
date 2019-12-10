<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'thuoctinh';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});

		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=thuoctinh&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		});

    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=thuoctinh&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

   function select_list()
    {
      var a=document.getElementById("id_list_pro");
      window.location ="index.php?com=thuoctinh&act=man&type=<?=$_GET['type']?>&id_list_pro="+a.value; 
      return true;
    }
</script>
<?php
  function get_list_pro()
  {
    $sql="select * from table_product_list where type='product' and id_parent=0 order by stt,id desc";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_list_pro" name="id_list_pro" onchange="select_list()" class="main_select">
      <option value="">Chọn danh mục</option>';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_list_pro"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=thuoctinh&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$title_main?></span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=thuoctinh&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

    </div>  
</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
    <div class="timkiem">
	    <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB"  value="">Tìm kiếm</button>
    </div>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
        <?php if($config_list_pro=='true' && isset($config_list_pro)) { ?><td class="tb_data_small"><?=get_list_pro()?></td><?php } ?>    
        <td class="sortCol"><div>Tên<span></span></div></td>
        <?php if($config_images=='true') { ?><td class="tb_data_small">Hình ảnh</td><?php } ?>
        <?php if($config_color=='true') { ?><td class="tb_data_small">Màu sắc</td><?php } ?>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <?php if($config_noibat=='true') { ?><td class="tb_data_small">Nổi bật</td><?php } ?>
        <td width="200">Thao tác</td>
      </tr>
    </thead>

    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>

       
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 

        <?php if($config_list_pro=='true' && isset($config_list_pro)){ ?>
         <td align="center">
          <?php
            $d->reset();
            $sql = "select ten_vi from table_product_list where id='".$items[$i]['id_list_pro']."'";
            $result=mysql_query($sql);
            $name_danhmuc =mysql_fetch_array($result);
            echo @$name_danhmuc['ten_vi'];
          ?>  
         </td>
         <?php } ?> 

        <td class="title_name_data">
            <a href="index.php?com=thuoctinh&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
        </td>

        <?php if($config_images=='true') { ?>
          <td align="center"><img src="<?=_upload_hinhanh.$items[$i]['photo']?>" onerror="this.onerror=null;this.src='../images/Noimage.png';" height="20"></td>
        <?php } ?>

        <?php if($config_color=='true') { ?>
          <td align="center"><div style="width: 70px; height: 30px; background: #<?=$items[$i]['color']?>"></div></td>
        <?php } ?>

        <td align="center">
            <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>

        <?php if($config_noibat=='true'){ ?> 
                <td align="center">
                <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
                </td>
        <?php } ?>
       
        <td class="actBtns">
            <a href="index.php?com=thuoctinh&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=thuoctinh&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

<div class="paging"><?=$paging?></div>