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

    //.slideInputの高さ位置調整-----------------------
    jQuery('.slideInput').css({
        'top': headerHeight + '10' +'px'
    });

    //フォーカス・クリックによる各種変化-----------------------
    //.header_searchButtonのクリックによる.slideInputの開閉
    jQuery('.header_searchButton').click(
        function(){
            jQuery('.slideInput').toggleClass('slideInput__is-open');

            if(jQuery('.slideInput').hasClass('slideInput__is-open')){
                jQuery('.slideInput').attr("aria-hidden", "false");
            }else{
                jQuery('.slideInput').attr("aria-hidden", "ture");
            }
        }
    )

    //ハンバーガーメニューフォーカスによる.slideInputの閉鎖
    jQuery('.headerMain_humburgerContainer').focus(
        function(){
            jQuery('.slideInput').removeClass('slideInput__is-open');
            jQuery('.slideInput').attr("aria-hidden", "ture");
        }
    )

    //ハンバーガーメニューのクリックによるドロップダウンメニュー開閉
    jQuery('.headerMain_humburgerContainer').click(
        function(){
            jQuery('.headerMain_humburgerContainer').toggleClass('active');

            if(jQuery(this).hasClass('active')){
                jQuery('.hamburgerLine__1').addClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').addClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').addClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideDown();

                jQuery(this).attr("aria-expanded", "false");
                jQuery('.navSp_dropdown').attr("aria-hidden", "false");
            }else{
                jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideUp();

                jQuery(this).attr("aria-expanded", "true");
                jQuery('.navSp_dropdown').attr("aria-hidden", "true");
            }
        }
    );
    
    
    //ドロップダウンメニュー内ボタンのクリックによるドロップダウンメニュー閉鎖
    jQuery('.dropdown_closeButton').click(
        function(){
            jQuery('.headerMain_humburgerContainer').removeClass('active');

            if(!jQuery('.headerMain_humburgerContainer').hasClass('active')){
                jQuery('.hamburgerLine__1').removeClass('hamburgerLine__1__is-active');
                jQuery('.hamburgerLine__2').removeClass('hamburgerLine__2__is-active');
                jQuery('.hamburgerLine__3').removeClass('hamburgerLine__3__is-active');
                jQuery('.dropdown-wrapper').slideUp();

                jQuery(this).attr("aria-expanded", "true");
                jQuery('.navSp_dropdown').attr("aria-hidden", "true");
            }
        }
    );
})
