$(document).ready(function(){

    $('#add-image').click(function(){
        //Je récupère le num des futurs champs
        const index = +$('#widgets_counter').val();
        //const index = $('#kal_platformbundle_ad_images div.form-group').length;

        //Je récupère le prototype des entrées
        const tmpl = $('#kal_platformbundle_ad_images').data('prototype').replace(/__name__/g, index);

        //J'injecte ce code au sein de la div
        $('#kal_platformbundle_ad_images').append(tmpl);

        $('#widgets_counter').val(index + 1);

        //Je gère le bouton supprimmer
        handleDeleteButtons();
    })

    function handleDeleteButtons(){
        $('button[data-action="delete"]').click(function(){
            const target= this.dataset.target;
            $(target).remove();
        })
    }

    function updateCounter(){
        const count = +$('#kal_platformbundle_ad_images div.form-group').length;

        $('#widgets-counter').val(count);
    }

    updateCounter();

    handleDeleteButtons();


})