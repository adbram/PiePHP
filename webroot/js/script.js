$(".movieCard").click(function(){
    window.location = 'film/' + $(this).data('id');
});