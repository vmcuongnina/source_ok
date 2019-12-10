<?php 
session_start();
error_reporting(0);



    if(!empty($_SESSION['lang'])){
      $lang=$_SESSION['lang'];
    }else{
      $lang='vi';
    }
  
    @define ( '_lib' , '../libraries/');
    @define ( '_source' , '../sources/');
    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."class.database.php";
    include_once _lib.'Pagination.class.php';
    include_once _lib."functions.php";
     

    $d = new database($config['database']);
    
    include_once _source."lang_$lang.php"; 

    // Set some useful configuration 
    $id_list = (int) $_POST['id_list'];
    $id_cat = (int) $_POST['id_cat'];
    $type_bar = $d->escape_str($_POST['type_bar']);
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 8; 
     
    // Count of all records 
    $d->reset();
    $sql = "SELECT COUNT(*) as rowNum FROM table_product where hienthi=1 and type='$type_bar' and noibat=1 and id_cat='$id_cat'";
    $d->query($sql);
    $result = $d->fetch_array();
    $rowCount= $result['rowNum']; 
     
    // Initialize pagination class 
    $pagConfig = array( 
        'id_list' => $id_list, 
        'id_cat' => $id_cat, 
        'id_item' => 0, 
        'type_bar' => $type_bar, 
        'baseURL' => 'ajax/load_pro.php', 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'show_list_'.$id_list,
        'showCount' => false,
    ); 
    $pagination =  new Pagination($pagConfig); 
 
    // Fetch records based on the limit 
  $d->reset();
  $sql = "SELECT id,tenkhongdau,ten_$lang as ten,photo,giacu,giaban FROM table_product where hienthi=1 and type='product' and noibat=1 and id_cat='$id_cat' order by stt, id desc";
  $sql .= " limit $offset,$limit";
  $d->query($sql); 
  $arr_pro = $d->result_array();
  if(!empty($arr_pro)){  ?>
      
      <div class="all_pro">
          <?php foreach($arr_pro as $value){ ?>
              <div class="col-pro col-md-3 col-sm-4 col-xs-6">
                <div class="item_dv">
                  <div class="img">
                    <a href="<?=$value['tenkhongdau']?>">
                      <img class="img-responsive" src="thumb/262x249/2/<?=_upload_product_l.$value['photo']?>" alt="<?=$value['ten']?>"><div class="icon"></div>
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

  <?php }

  die();
?>