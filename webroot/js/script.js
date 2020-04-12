$(".movieCard").click(function(){
    window.location = 'film/' + $(this).data('id');
});
$('#genre').hide();
$('#deleteDiv').hide();
$('#addDiv').hide();
$('#showGenre').click(function(){
    if($('#genre').is(':hidden')) {
        $(this).css({'border-radius' : '20px 20px 0 0', 'background': 'white'});
        $('#genre').slideDown(400);
    } else {
        $('#genre').slideUp(400);
        setTimeout(() => {
            $(this).css({'border-radius' : '20px', 'background': '#E7EAED'});
        }, 400);
    }
});
$('.option input').click(function(){
    let bubble = $('<div>').addClass('bubble col-4 col-md-2').text('Genre: '+ $(this).data('g')).attr('data-g', $(this).data('g'));
    if($(this).is(':checked')){
        if($('.bubble:contains('+'Genre: '+ $(this).data('g')+')').length == 0){
            $('#searchForm').append($(bubble));
        }
    } else {
        if($('.bubble:contains('+'Genre: '+ $(this).data('g')+')').length != 0){
            $('.bubble:contains('+'Genre: '+ $(this).data('g')+')').remove();
        }
    }
});
$('#edit').click(function(){
    window.location = 'editer/'
});
$('#delete').click(function(){
    console.log('supprimer');
    if($('#deleteDiv').is(':hidden')) {
        $('#deleteDiv').slideDown(400);
    } else {
        $('#deleteDiv').slideUp(400);
    }
});
$('#editF').click(function(){
    window.location = 'editerfilm/'+$(this).data('id');
});
$('#deleteF').click(function(){
    console.log('supprimer');
    if($('#deleteDiv').is(':hidden')) {
        $('#deleteDiv').slideDown(400);
    } else {
        $('#deleteDiv').slideUp(400);
    }
});
$('#searchForm').before('<button class="col-12 add">Ajouter un film</button>');
$('h1:contains("GENRES")').before('<button class="col-12 addG">Ajouter un genre</button>');
$('#editF').before('<button class="col-12 addH">J\'ai vu ce film</button>');
$('#editF').before('<button class="col-12 rmH">J\'ai pas vu ce film</button>');
$('.rmH').hide();
$('.addG').after('<form action="" method="post" id="addDiv" class="col-12"><input placeholder="Nom du genre" class="col-8" type="text" name="nom" id="nom"><input class="col-2" type="submit" value="Entrer"></form>');
$('#addDiv').hide();
$('.add').click(function(){
    window.location = 'ajouterFilm' ;
});
$('.addG').click(function(){
    if($('#addDiv').is(':hidden')) {
        $('#addDiv').slideDown(400);
    } else {
        $('#addDiv').slideUp(400);
    }
});
$('.addH').click(function(){
    $(this).hide();
    $('.rmH').show();
    window.location = 'addH/' + $('#id').val();
});
$('.rmH').click(function(){
    $(this).hide();
    $('.addH').show();
});
$('.deleteG').click(function(){
    window.location = 'deleteG/'+ $(this).data('id');
});
$('.deleteH').click(function(){
    window.location = 'deleteH/'+ $(this).data('id');
});