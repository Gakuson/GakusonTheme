jQuery('.headerMain_spMenuImg').click(function(){
    if(jQuery('.dropdown-wrapper').is(':hidden')){
    jQuery('.dropdown-wrapper').slideDown();
}else{
    jQuery('.dropdown-wrapper').slideUp();
}
})

