<div id="why">
    <div class="container">
        <?php include_once _template.'layout/why.php'; ?>
    </div>
</div>

<?php 
$d->reset();
$d->query("select photo_$lang as photo,hienthi,link from #_photo where type='qc'");
$qc1 = $d->fetch_array();
if(!empty($qc1) && $qc1['hienthi']==1){ ?>
<div class="qc">
    <a href="<?=$qc1['link']?>">
        <img class="lazy" data-src="<?=_upload_hinhanh_l.$qc1['photo']?>" alt="qc" />
    </a>
</div>
<?php } ?>

<div id="product_home">
    <div class="container">
        <?php  
        $d->reset();
        $d->query("select ten_$lang as ten,id,tenkhongdau,photo from #_product_list where type='product' and hienthi=1 and noibat=1 order by stt,id desc");
        $arr_list_nb = $d->result_array();
        if(!empty($arr_list_nb)){ $k=1;
            foreach($arr_list_nb as $list_nb){ ?>

                
                <div class="row_pro_home">
                    <div class="wrap_name wrap_name2">
                      <div class="name_home name_home2"><?=$list_nb['ten']?></div>
                    </div>
                    <?php 
                    $d->reset();
                    $d->query("select ten_$lang as ten,id,tenkhongdau from #_product_cat where type='product' and hienthi=1 and noibat=1 and id_list='".$list_nb['id']."' order by stt,id desc");
                    $arr_cat_nb = $d->result_array();
                    if(!empty($arr_cat_nb)){ $k_ca = 1; ?>
                        <div class="cats">
                            <?php
                                foreach($arr_cat_nb as $cat_nb){ ?>
                                    <a <?php if($k_ca==1) echo 'class="active"'; ?> href="javascript:void(0)" data-cat="<?=$cat_nb['id']?>" data-list="<?=$list_nb['id']?>"><?=$cat_nb['ten']?></a>
                            <?php
                                $k_ca++; } ?>
                        </div>
                        <div class="content_pro" id="show_list_<?=$list_nb['id']?>">
                            
                            <?php 
                            $limit = 8;

                            // Count of all records 
                            $d->reset();
                            $sql = "SELECT COUNT(*) as rowNum FROM table_product where hienthi=1 and type='product' and noibat=1 and id_cat='".$arr_cat_nb[0]['id']."'";
                            $d->query($sql);
                            $result = $d->fetch_array();
                            $rowCount= $result['rowNum']; 
                            
                            // Initialize pagination class 
                            $pagConfig = array( 
                                'id_list' => $list_nb['id'], 
                                'id_cat' => $arr_cat_nb[0]['id'], 
                                'id_item' => 0, 
                                'type_bar' => 'product', 
                                'baseURL' => 'ajax/load_pro.php',
                                'totalRows' => $rowCount,
                                'perPage' => $limit,
                                'contentDiv' => 'show_list_'.$list_nb['id']
                            ); 
                            $pagination =  new Pagination($pagConfig); 
                             
                            // Fetch records based on the limit 
                            $d->reset();
                            $sql = "SELECT id,tenkhongdau,ten_$lang as ten,photo,giacu,giaban FROM table_product where hienthi=1 and noibat=1 and type='product' and id_cat='".$arr_cat_nb[0]['id']."' order by stt, id desc";
                            $sql .= " limit $limit";
                            $d->query($sql); 
                            $arr_pro = $d->result_array();
                            if(!empty($arr_pro)){ 
                            ?>
                                <div class="all_pro">
                                    <?php foreach($arr_pro as $value){ ?>
                                        <div class="col-pro col-md-3 col-sm-4 col-xs-6">
                                          <div class="item_dv">
                                            <div class="img">
                                              <a href="<?=$value['tenkhongdau']?>">
                                                <img class="img-responsive lazy" data-src="thumb/262x249/2/<?=_upload_product_l.$value['photo']?>" alt="<?=$value['ten']?>"><div class="icon"></div>
                                                <?php if($value['giacu']>0){ ?><div class="sale"><?=get_sale($value['giacu'],$value['giaban'])?></div><?php } ?>
                                              </a>
                                              <div class="buy" data-id="<?=$value['id']?>"><a href="javascript:void(0);">Thêm vào giỏ hàng</a></div>
                                            </div>
                                            <div class="info">
                                              <div class="name"><h3><a href="<?=$value['tenkhongdau']?>"><?=$value['ten']?></a></h3></div>
                                              <div class="price">
                                                <span class="giaban"><?php if($value['giaban']>0) echo number_format($value['giaban'],0,',','.').'đ';else echo 'Liên hệ'; ?></span>
                                                <?php if($value['giacu']>0){ ?><span class="giacu"><?=number_format($value['giacu'],0,',','.').'đ'; ?></span><?php } ?>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                                <?php echo $pagination->createLinks(); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
        <?php
            $k++; }
        }
        ?>
    </div>
</div>
 
<?php 
$d->reset();
$d->query("select photo_$lang as photo,hienthi,link from #_photo where type='qc2'");
$qc2 = $d->fetch_array();
if(!empty($qc2) && $qc2['hienthi']==1){ ?>
<div class="qc">
    <a href="<?=$qc2['link']?>">
        <img class="lazy" data-src="<?=_upload_hinhanh_l.$qc2['photo']?>" alt="qc2" />
    </a>
</div>
<?php } ?>

<?php  
$d->reset();
$sql = "select ten_$lang,tenkhongdau,id from table_tags where type='tags' order by ten_$lang";
$d->query($sql);
$arr_tags = $d->result_array();
if(!empty($arr_tags)){ ?>
<div id="tags" class="hidden">
    <div class="container">
        <div class="link_tag">
            <span class="txt">Tags:</span>
            <?php foreach($arr_tags as $tag){ ?>
                <a href="tag/<?=$tag['tenkhongdau']?>"><?=$tag['ten_'.$lang]?></a>
                <span class="phay">/</span>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>

<div id="camnang">
    <div class="container">
        <?php include_once _template.'layout/camnang.php'; ?>
    </div>
</div>

<div id="other" class="full_bg full_bg_mobile">
    <div class="container">
        <?php include_once _template.'layout/other2.php'; ?>
    </div>
</div>