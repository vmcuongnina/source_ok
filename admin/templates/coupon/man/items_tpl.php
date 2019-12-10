<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'coupon';
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
			window.location.href="index.php?com=coupon&act=man&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=coupon&act=delete&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

 

</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=coupon&act=man"><span>Quản lý mã giảm giá</span></a></li>
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
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=coupon&act=add'" />
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
        <td class="tb_data_small"><div>Mã giảm giá<span></span></div></td>
        <td class="tb_data_small"><div>Phần %<span></span></div></td>
        <td class="tb_data_small"><div>Số lần<span></span></div></td>
        <td class="tb_data_small"><div>Ngày bắt đầu<span></span></div></td>
        <td class="tb_data_small"><div>Ngày kết thúc<span></span></div></td>
        <td>Gửi mã</td>
        <td width="200"><div>Tình trạng<span></span></div></td>
        <td class="tb_data_small">Ẩn/Hiện</td>
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
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />
            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
       
        <td align="center" class="title_name_data">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ma']?></a>
        </td>
        <td align="center" class="title_name_data">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['phantram']?></a>
        </td>
        <td align="center" class="title_name_data">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['solan']?></a>
        </td>
        <td align="center" class="title_name_data">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=date('d/m/Y', $items[$i]['ngaybatdau'])?></a>
        </td>
        <td align="center" class="title_name_data">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=date('d/m/Y' ,$items[$i]['ngayketthuc'])?></a>
        </td>
        <td class="center"><a class="blueB" href="index.php?com=coupon&act=sendcode&id=<?=$items[$i]['id']?>">Gửi</a></td>
        <td align="center">
            <?php  
              switch ($items[$i]['tinhtrang']) {
                case '0':
                  echo "Chưa sử dụng";
                  break;
                case '1':
                  echo 'Đã sử dụng';
                  break;
                case '2':
                  echo 'Hết hạn';
                  break;
                case '3':
                  echo 'Đã gửi';  
                  break;
              }
            ?>
        </td>
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
       
        <td class="actBtns">
            <a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=coupon&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

<div class="paging"><?=$paging?></div>