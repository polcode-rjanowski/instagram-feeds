$(document).ready(function () {

    //---------foucus on one image, dot showing----------------
    var enterImage = false;
    $('.image-thumb').mouseenter(function (e) {
        if (!enterImage) {
            $(this).siblings('.image-dot-box').toggle(500);
            $(this).addClass('active');
            $('.image-thumb').not('.active').animate({opacity: 0.25});
            enterImage = true;
        }
    }).mouseleave(function (e) {
        if (!$('.dot-link:hover').length > 0) {
            $(this).siblings('.image-dot-box').toggle(500);
            $(this).removeClass('active');
            $('.image-thumb').animate({opacity: 1});
            enterImage = false;
        }
        $('#smallShoppableModal').dialog('close');
    });
    //---------------------------------------------------------


    //---------small modal after clicking on dots--------------
    $('#smallShoppableModal').dialog({
        autoOpen: false,
        resizable: false
    });
    $('.dot-link').click(function (e) {
        e.preventDefault();

        $('#small-product-image-url').attr('src', $(this).attr('data-image-url'));
        $('#small-product-name').text($(this).attr('data-name'));
        $('#small-product-price').text("£"+$(this).attr('data-price'));
        $('#small-product-link').attr('href', $(this).attr('href'));

        $('#smallShoppableModal').dialog("option", "position", { my: "left+15 top-15", at: "left bottom", of: e.target });
        if($('#smallShoppableModal').dialog('isOpen')){
            $('#smallShoppableModal').dialog('close');
        }else {
            $('#smallShoppableModal').dialog('open');
        }
        $(".ui-dialog-titlebar").hide();
    });
    //--------------------------------------------------------

});