<div class="dmsp <?php if($source!='index') echo 'pagein'; ?>">
	<div class="name">Danh mục sản phẩm</div>
	<div class="list_dmsp">
		<div class="wrap">
			<?php if(!empty($arr_list)){ ?>
		        <ul>
		            <?php foreach($arr_list as $list){ ?>
		                <li><a href="<?=$list['tenkhongdau']?>"><?=$list['ten']?></a>
		                    <?php 
		                    $d->reset();
		                    $d->query("select ten_$lang as ten,id,tenkhongdau from #_product_cat where  type='product' and hienthi=1 and id_list='$list[id]' order by stt,id desc");
		                    $arr_cat = $d->result_array();
		                    if(!empty($arr_cat)){
		                    ?>
		                    	<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		                        <ul>
		                            <?php foreach($arr_cat as $cat){ ?>
		                                <li><a href="<?=$cat['tenkhongdau']?>"><?=$cat['ten']?></a></li>
		                            <?php } ?>
		                        </ul>
		                    <?php } ?>
		                </li>
		             <?php } ?>
		        </ul>
		    <?php } ?>
		    <div class="gau"></div>
	    </div>
	</div>
</div>