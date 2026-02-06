jQuery(window).on('load', function(){

    //背景部分の高さ調整-----------------------
    const surHeight = jQuery('.l-mainContent').height();
    jQuery('.backBoard').css({
        'height': surHeight + 'px'
    });

    //l-emptyの高さ調整-----------------------
    const headerHeight = jQuery('.l-header').height();
    jQuery('.l-empty').css({
        'height': headerHeight + 'px'
    });

    //フォーカス・クリックによる各種変化-----------------------
    //クリックによるドロップダウンメニュー展開
    jQuery('.headerMain_humburgerContainer').click(
        function(){
            jQuery('.hamburgerLine__1').addClass('hamburgerLine__1__is-active');
            jQuery('.hamburgerLine__2').addClass('hamburgerLine__2__is-active');
            jQuery('.hamburgerLine__3').addClass('hamburgerLine__3__is-active');
            jQuery('.dropdown-wrapper').slideDown();

            jQuery(this).attr("aria-expanded", "false");
            jQuery('.navSp_dropdown').attr("aria-hidden", "false");
        }
    )
    //キーボード操作によるドロップダウンメニュー展開
    jQuery('.headerMain_humburgerContainer').keydown(
        function(){
            jQuery('.hamburgerLine__1').addClass('hamburgerLine__1__is-active');
            jQuery('.hamburgerLine__2').addClass('hamburgerLine__2__is-active');
            jQuery('.hamburgerLine__3').addClass('hamburgerLine__3__is-active');
            jQuery('.dropdown-wrapper').slideDown();

            jQuery(this).attr("aria-expanded", "false");
            jQuery('.navSp_dropdown').attr("aria-hidden", "false");
        }
    );
    
    //クリックによるドロップダウンメニュー閉鎖
    jQuery('.dropdown_closeButton').click(
        function(){
            jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
            jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
            jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
            jQuery('.dropdown-wrapper').slideUp();

            jQuery(this).attr("aria-expanded", "true");
            jQuery('.navSp_dropdown').attr("aria-hidden", "true");
        }
    );
    //キーボード操作によるドロップダウンメニュー閉鎖
    jQuery('.dropdown_closeButton').keydown(
        function(){
            jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
            jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
            jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
            jQuery('.dropdown-wrapper').slideUp();

            jQuery(this).attr("aria-expanded", "true");
            jQuery('.navSp_dropdown').attr("aria-hidden", "true");
        }
    )
})
