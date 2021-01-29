jQuery(function($){
    $('.open-modal').click(function(){
        var id = $(this).data('id');
        $('#modal-'+id).css({display:'flex'}).hide().fadeIn(500);
        $('body').addClass('no-scroll');
    });
    $('.modal .close').click(function(){
        $('.modal').fadeOut(500);
        $('body').removeClass('no-scroll');
    });
    $('.toggle-search-bar').click(function() {
        $('.search-bar').toggle();
        return false;
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 90
                }, 500);
                return false;
            }
        }
    });
});