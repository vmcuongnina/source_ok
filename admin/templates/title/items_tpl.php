<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.timkiem button').click(function(event) {
            var keyword = $(this).parent().find('input').val();
            window.location.href="index.php?com=title&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
        });
    });
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=title&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý SEO</span></a></li>
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
            <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=title&act=add&type=<?=$_REQUEST['type']?>'" />
            <?php if($config_delete=="true"){ ?><input type="button" class="blueB" value="Xoá Chọn" id="xoahet" /><?php } ?>
        </div>  
    </div>
    <div class="widget">
        <div class="title"><span class="titleIcon">
            <input type="checkbox" id="titleCheck" name="titleCheck" />
            </span>
            <h6>Chọn tất cả</h6>
            <div class="timkiem">
                <input type="text" value="" placeholder="Nhập từ tên define">
                <button type="button" class="blueB"  value="">Tìm kiếm</button>
            </div>
        </div>
    
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
            <thead>
              <tr>
                <td></td>   
                <td class="tb_data_small">Thứ tự</td>
                <?php if($config_developer=='true'){ ?>  
                    <td width="200">Com</td>
                <?php } ?>
                <td width="200">Title</td>
                <td width="200">Keywords</td>
                <td width="200">Description</td>
                <td width="10%">Thao tác</td>
              </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i < count($items); $i++) { ?>
                <tr>
                    <td><input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" /></td>
                    <td><input type="text" readonly value="<?=$i+1?>" class="tipS smallText" original-title="Nhập số thứ tự" /></td>
                    <td align="center"><?=@$items[$i]['com_page']?></td>
                    <td align="center"><?=@$items[$i]['title']?></td>
                    <td align="center"><?=@$items[$i]['keywords']?></td>
                    <td align="center"><?=@$items[$i]['description']?></td>
                    <td align="center">
                        <a href="index.php?com=title&act=edit&type=<?=$_REQUEST['type']?>&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa lang"><img src="./images/icons/dark/pencil.png" alt=""></a>
                        <?php if($config_delete=="true"){ ?>
                            <a href="index.php?com=title&act=delete&type=<?=$_REQUEST['type']?>&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</form>
<div class="paging"><?=$paging?></div>