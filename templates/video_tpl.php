<div class="sub_main">
    <div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
      <div class="content_main">
            <?php
            $d->reset();
            $sql="select * from #_video where hienthi=1 and type='video' order by stt asc, id desc";
            $d->query($sql);
            $video=$d->result_array();
        ?>
        <?php if(!empty($video)) { ?>
            <div class="wrap_video">
        
            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="100%" data-thumbheight="67" data-thumbwidth="100">
                <?php for($i=0; $i<count($video); $i++){?>
                    <a href="http://youtube.com/watch?v=<?=youtobi($video[$i]['links'])?>">
                        <img src="https://img.youtube.com/vi/<?=youtobi($video[$i]['links'])?>/0.jpg" alt="<?=$video[$i]['ten_'.$lang]?>">
                    </a>
                <?php } ?>  
            </div>

            </div>
        <?php } ?>

       </div><!--content main-->
</div><!--end sub main-->
