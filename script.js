jQuery(function($){
    $('.open-modal').click(function(){
        var id = $(this).data('id');
        $('#modal-'+id).fadeIn(500);
        $('body').addClass('no-scroll');
    });
    $('.modal .close').click(function(){
        $('.modal').fadeOut(500);
        $('body').removeClass('no-scroll');
    });
});