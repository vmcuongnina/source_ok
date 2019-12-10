<button id="btn_filter" type="button" class="btn btn-success"><i class="fa fa-filter" aria-hidden="true"></i> BỘ LỌC</button>
<div class="product-filter">
  <!-- <div class="sel_filter"></div> -->

  <?php if(!empty($arr_filter_gioitinh)){ ?>
  <div class="row_filter">
    <div class="name_filter">
      Giới tính
    </div>
    <div class="content_filter">
      <?php  
      foreach($arr_filter_gioitinh as $f_cd){
      ?>
        <div class="item_filter filter_gioitinh sel_only_one <?php if($id_gioitinh==$f_cd['id']) echo 'active' ?>" data-id="<?=$f_cd['id']?>" data-name="<?=$f_cd['name']?>" data-link="<?=$f_cd['tenkhongdau']?>">
                <label><?=$f_cd['name']?>
                    <input type="checkbox" value="<?=$f_cd['id']?>" <?php if($id_gioitinh==$f_cd['id']) echo 'checked' ?>>
                    <span class="checkmark"></span>
                </label>
                <div class="clear"></div>
              </div>
            <?php } ?>
          <div class="clearfix"></div>
    </div>
  </div>
  <?php } ?>


  <?php if(!empty($arr_filter_price)){ ?>
  <div class="row_filter">
    <div class="name_filter">
      Giá
    </div>
    <div class="content_filter">
      <?php  
      $arr_all_mucgia = get_all_mucgia();
      foreach($arr_all_mucgia as $row_gia){
        if(in_array($row_gia['id'], $arr_filter_price)){
          $f_gia = get_info_price($row_gia['id']);
      ?>
        <div class="item_filter filter_price sel_only_one <?php if($filter_gia['id']==$f_gia['id']) echo 'active' ?>" data-id="<?=$f_gia['id']?>" data-name="<?=$f_gia['name']?>" data-link="<?=$f_gia['tenkhongdau']?>">
                <label><?=$f_gia['name']?>
                    <input type="checkbox" value="<?=$f_gia['id']?>" <?php if($filter_gia['id']==$f_gia['id']) echo 'checked' ?>>
                    <span class="checkmark"></span>
                </label>
                <div class="clear"></div>
              </div>
            <?php } } ?>
          <div class="clearfix"></div>
    </div>
  </div>
  <?php } ?>
  

  <?php if(!empty($arr_filter_size)){ ?>
  <div class="row_filter">
    <div class="name_filter">
      Size
    </div>
    <div class="content_filter">
      <?php  
      foreach($arr_filter_size as $f_loai){
      ?>
        <div class="item_filter filter_size <?php if(in_array($f_loai['tenkhongdau'], $arr_url_size)) echo 'active' ?>" data-id="<?=$f_loai['id']?>" data-name="<?=$f_loai['name']?>" data-link="<?=$f_loai['tenkhongdau']?>">
                <label><?=$f_loai['name']?>
                    <input type="checkbox" value="<?=$f_loai['id']?>" <?php if(in_array($f_loai['tenkhongdau'], $arr_url_size)) echo 'checked' ?>>
                    <span class="checkmark"></span>
                </label>
                <div class="clear"></div>
              </div>
            <?php } ?>
          <div class="clearfix"></div>
    </div>
  </div>
  <?php } ?>
  
  <?php if(!empty($arr_filter_color)){ ?>
  <div class="row_filter">
    <div class="name_filter">
      Màu sắc
    </div>
    <div class="content_filter">
      <?php  
      foreach($arr_filter_color as $mau){
      ?>
        <div class="item_filter filter_color color_item <?php if(in_array($mau['tenkhongdau'], $arr_url_color)) echo 'active' ?>" data-id="<?=$mau['id']?>" data-name="<?=$mau['name']?>" data-link="<?=$mau['tenkhongdau']?>">
                <span style="background: #<?=$mau['color']?>"></span>
              </div>
            <?php } ?>
          <div class="clearfix"></div>
    </div>
  </div>
  <?php } ?>

  <?php if(!empty($arr_filter_chatlieu)){ ?>
  <div class="row_filter">
    <div class="name_filter">
      Chất liệu
    </div>
    <div class="content_filter">
      <?php  
      foreach($arr_filter_chatlieu as $f_cl){
      ?>
        <div class="item_filter filter_chatlieu <?php if(in_array($f_cl['tenkhongdau'], $arr_url_chatlieu)) echo 'active' ?>" data-id="<?=$f_cl['id']?>" data-name="<?=$f_cl['name']?>" data-link="<?=$f_cl['tenkhongdau']?>">
                <label><?=$f_cl['name']?>
                    <input type="checkbox" value="<?=$f_cl['id']?>" <?php if(in_array($f_cl['tenkhongdau'], $arr_url_chatlieu)) echo 'checked' ?>>
                    <span class="checkmark"></span>
                </label>
                <div class="clear"></div>
              </div>
            <?php } ?>
          <div class="clearfix"></div>
    </div>
  </div>
  <?php } ?>
  
</div>