<ul>
    <li class="home"><a href="" title="<?=_trangchu?>"><img src="images/home.png" alt="Trang chủ"></a></li>
    <?php if(!empty($arr_list)){ ?>
       
            <?php foreach($arr_list as $list){ ?>
                <li><h2><a href="<?=$list['tenkhongdau']?>"><?=$list['ten']?></a></h2>
                    <?php 
                    $d->reset();
                    $d->query("select ten_$lang as ten,id,tenkhongdau from #_product_cat where  type='product' and hienthi=1 and id_list='$list[id]' order by stt,id desc");
                    $arr_cat = $d->result_array();
                    if(!empty($arr_cat)){
                    ?>
                        <ul>
                            <?php foreach($arr_cat as $cat){ ?>
                                <li><h3><a href="<?=$cat['tenkhongdau']?>"><?=$cat['ten']?></a></h3></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <li class="line"></li>
             <?php } ?>
    
    <?php } ?>
   
    <li><a href="cam-nang-suc-khoe" title="Cẩm nang sức khỏe">Cẩm nang sức khỏe</a>
        <?php if(!empty($arr_cn)){ ?>
            <ul>
                <?php foreach($arr_cn as $list){ ?>
                    <li><h3><a href="<?=$list['tenkhongdau']?>"><?=$list['ten']?></a></h3></li>
                 <?php } ?>
            </ul>
        <?php } ?>
    </li>
    <li class="line"></li>
    <li><a href="gioi-thieu" title="Giới thiệu">Giới thiệu</a></li>
    <li class="line"></li>
    <li><a href="lien-he" title="<?=_lienhe?>"><?=_lienhe?></a></li>
</ul>