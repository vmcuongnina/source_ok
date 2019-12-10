<?php
$d->reset();
$sql = "select ten_$lang as ten,photo,url from #_lkweb where hienthi=1 and type='lkweb3' order by stt, id desc";
$d->query($sql);
$arr_supp = $d->result_array();
if(!empty($arr_supp)) {
?>
    <div id="contact_btn"></div>
    <script src="js/jquery.contactus.min.js"></script>
    <script type="text/javascript">            
        var arCuMessages = ["Xin chào !", "Bạn cần hỗ trợ ?"];
        var arCuPromptClosed = false;
        var arCuDelayFirst = 500;
        var _arCuTimeOut = null;
        var arCuDelayFirst = 2000;
        var arCuTypingTime = 2000;
        var arCuMessageTime = 4000;
        var arCuCloseLastMessage = false;
        var arCuLoop = false;
        function arCuShowMessage(index){
            if (arCuPromptClosed){
                return false;
            }
            if (typeof arCuMessages[index] !== 'undefined'){
                jQuery('#contact_btn').contactUs('showPromptTyping');

                _arCuTimeOut = setTimeout(function(){
                    if (arCuPromptClosed){
                        return false;
                    }
                    jQuery('#contact_btn').contactUs('showPrompt', {
                        content: arCuMessages[index]
                    });
                    index ++;
                    _arCuTimeOut = setTimeout(function(){
                        if (arCuPromptClosed){
                            return false;
                        }
                        arCuShowMessage(index);
                    }, arCuMessageTime);
                }, arCuTypingTime);
            }else{
                if (arCuCloseLastMessage){
                    jQuery('#contact_btn').contactUs('hidePrompt');
                }
                if (arCuLoop){
                    arCuShowMessage(0);
                }
            }
        };
        function arCuShowMessages(){
            setTimeout(function(){
                clearTimeout(_arCuTimeOut);
                arCuShowMessage(0);
            }, arCuDelayFirst);
        }
        window.addEventListener('load', function(){
            $('#contact_btn').on('arcontactus.init', function(){
                $('#contact_btn').addClass('arcuAnimated').addClass('flipInY');
                setTimeout(function(){
                    $('#contact_btn').removeClass('flipInY');
                }, 1000);
                arCuShowMessages();
            });
            $('#contact_btn').contactUs({
                drag: false,
                //mode: 'callback',
                align: 'left',
                reCaptcha: false,
                menuSize: 'small',
                buttonSize: 'small',
                buttonText: false, //'contact<br/>us',
                iconsAnimationSpeed: 800,
                menuHeaderText: 'LIÊN HỆ VỚI CHÚNG TÔI',
                itemsIconType: 'rounded',
                countdown: 0,
                showMenuHeader: true,
                showHeaderCloseBtn: true,
                headerCloseBtnColor: '#ffffff',
                headerCloseBtnBgColor: '#f26364',
                promptPosition: 'side',
                theme: '#f26364',
                items: [
                    <?php foreach($arr_supp as $supp) { ?>
                        {
                            title: '<?=$supp['ten']?>',
                            <?php /* subTitle: 'Typically response in 30 minutes', */ ?>
                            icon: '<img src="<?=_upload_hinhanh_l.$supp['photo']?>" alt="mess">',
                            href: '<?=$supp['url']?>',
                            <?php /* color: '#31ADFF' */ ?>
                        },
                    <?php } ?>
                ]
            });
        });
    </script>
    <link href="css/jquery.contactus.css" rel="stylesheet" />
<?php } ?>