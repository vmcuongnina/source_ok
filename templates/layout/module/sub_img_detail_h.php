<div id="sub_img_detail">
	<div class="list_sub_img_detail">
		<a href="javascript:" title="prev" class="prev_sub_detail transitionAll03"></a>
		<a href="javascript:" title="next" class="next_sub_detail transitionAll03"></a>
		<div id="owl_img_detail" class="owl-carousel owl-theme">

			<div class="item_owl_sub">
				<a href="<?=_upload_product_l.$row_detail['photo']?>" rel="zoom-id: Zoomer" rev="<?=_upload_product_l.$row_detail['photo']?>">
					<img src="thumb/100x100/2/<?=_upload_product_l.$row_detail['photo']?>"  class="w100" />
				</a>
			</div>
			<?php
			if(count($product_photo)>0){
				foreach ($product_photo as $key => $value) { ?>
				<div class="item_owl_sub">
					<a href="<?=_upload_product_l.$value['photo']?>" rel="zoom-id: Zoomer" rev="<?=_upload_product_l.$value['photo']?>">
						<img src="thumb/100x100/2/<?=_upload_product_l.$value['photo']?>"  class="w100" />
					</a>
				</div>
			<?php } } ?>
		</div>
	</div>
</div>

