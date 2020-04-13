jQuery(function($){
    $('#estates dl').click(function(){
        $('.modal').fadeIn(500)
    });
    $('#estates .modal .close').click(function(){
        $(this).parents('.modal').fadeOut(500)
    });
});