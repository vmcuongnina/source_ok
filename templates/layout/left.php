<div class="sub_left">
  <div class="title_left"><span><?=_danhmucsanpham?></span></div>
    <div class="content_left">
      <div class="menu_left">
        <?php if(count($list)>0){ ?>
          <ul>
            <?php foreach ($list as $key => $value_l) { ?>
              <li><a href="<?=$value_l['tenkhongdau']?>"><?=$value_l['ten']?></a></li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </div>
</div>



