<div class="breadcrumb">
    <ul>
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="" title="<?=$row_setting['ten_'.$lang]?>" itemprop="item">
                <span itemprop="name"><?=_trangchu?></span>
            </a>
            <meta itemprop="position" content="1">
        </li>
        <?php for($k=1; $k<=count($arr_bread); $k++) { ?>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <a href="<?=$arr_bread[$k]['link']?>" title="<?=$arr_bread[$k]['name']?>" itemprop="item">
                    <span itemprop="name"><?=$arr_bread[$k]['name']?></span>
                </a>
                <meta itemprop="position" content="<?=$arr_bread[$k]['pos']?>">
            </li>
        <?php } ?>
        
    </ul>
</div>