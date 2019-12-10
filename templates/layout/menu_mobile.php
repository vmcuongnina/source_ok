<div class="wrap_menu_mb">
    <a id="btn_nav_mobi" href="#menu_mb"><i class="fa fa-bars" aria-hidden="true"></i> MENU</a>
    <nav id="menu_mb">
        <ul>
            <li><a href="" title="<?=_trangchu?>"><?=_trangchu?></a></li>
            <?php if(!empty($arr_list)){ ?>
                    <?php foreach($arr_list as $list){ ?>
                        <li><a href="<?=$list['tenkhongdau']?>"><?=$list['ten']?></a>
                            <?php 
                            $d->reset();
                            $d->query("select ten_$lang as ten,id,tenkhongdau from #_product_cat where  type='product' and hienthi=1 and id_list='$list[id]' order by stt,id desc");
                            $arr_cat = $d->result_array();
                            if(!empty($arr_cat)){
                            ?>
                                <ul>
                                    <?php foreach($arr_cat as $cat){ ?>
                                        <li><a href="<?=$cat['tenkhongdau']?>"><?=$cat['ten']?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                     <?php } ?>
            <?php } ?>
            <li><a href="cam-nang-suc-khoe" title="Cẩm nang sức khỏe">Cẩm nang sức khỏe</a>
                <?php if(!empty($arr_cn)){ ?>
                    <ul>
                        <?php foreach($arr_cn as $list){ ?>
                            <li><a href="<?=$list['tenkhongdau']?>"><?=$list['ten']?></a></li>
                         <?php } ?>
                    </ul>
                <?php } ?>
            </li>
            <li><a href="gioi-thieu" title="Giới thiệu">Giới thiệu</a></li>
            <li><a href="lien-he" title="<?=_lienhe?>"><?=_lienhe?></a></li>
        </ul>
    </nav>
</div>
<div class="gh_mb">
    <a href="gio-hang"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng của bạn (<span class="qty_cart"><?=count_total_item_cart()?></span>)</a>
</div>