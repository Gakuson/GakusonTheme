jQuery(function(){
    jQuery('.menu-icon').click(function(){
        if(jQuery('.dropdown-wrapper').is(':hidden')){
        jQuery('.dropdown-wrapper').slideDown();
    }else{
        jQuery('.dropdown-wrapper').slideUp();
    }
    })
});

jQuery('.sp-menu__menu-icon').click(function(){
    if(jQuery('.dropdown-wrapper').is(':hidden')){
    jQuery('.dropdown-wrapper').slideDown();
}else{
    jQuery('.dropdown-wrapper').slideUp();
}
})

jQuery('.picture-wrapper').slick({
    dots: true,
   });