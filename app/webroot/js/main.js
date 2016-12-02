$(document).ready(function () {

    //---------foucus on one image, dot showing----------------
    var enterThumb = false;
    $('.image-thumb').mouseenter(function (e) {
        if (!enterThumb) {
            $(this).siblings('.thumbs-dot-box').toggle(500);
            $(this).addClass('active');
            $('.image-thumb').not('.active').animate({opacity: 0.25});
            enterThumb = true;
        }
    }).mouseleave(function (e) {
        if (!$('.dot-link:hover').length > 0) {
            $(this).siblings('.thumbs-dot-box').toggle(500);
            $(this).removeClass('active');
            $('.image-thumb').animate({opacity: 1});
            enterThumb = false;
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
        $('#small-product-price').text("£" + $(this).attr('data-price'));
        $('#small-product-link').attr('href', $(this).attr('href'));

        $('#smallShoppableModal').dialog("option", "position", {my: "left+15 top-15", at: "left bottom", of: e.target});
        if ($('#smallShoppableModal').dialog('isOpen')) {
            $('#smallShoppableModal').dialog('close');
        } else {
            $('#smallShoppableModal').dialog('open');
        }
        $(".ui-dialog-titlebar").hide();
    });
    //--------------------------------------------------------

    //----------large image UI--------------------------------
    $('.lv_content').css('overflow-x', 'hidden');
    var enterImage = false;
    $('.post-large-image').mouseover(function (e) {
        if (!enterImage) {
            $('.lv_window').css('width', $('.lv_window').width() + 200);
            $('.lv_content').css('width', $('.lv_content').width() + 200);
            $('.lv_content_wrapper').css('width', $('.lv_content_wrapper').width() + 200);
            $('.lv_bubble').css('width', $('.lv_bubble').width() + 200);
            $('.inline-example').css('width', $('.inline-example').width() + 200);
            $('.image-dot-box').toggle(500);
            $('.large-shoppable-ui').toggle(500);
            $('.shopping-basket-corner').toggle(500);
            enterImage = true;
        }
    }).mouseleave(function (e) {
        if (!$('.dot-link:hover').length > 0 && !$('.inline-example:hover').length > 0) {
            $('.lv_window').css('width', $('.lv_window').width() - 200);
            $('.lv_content').css('width', $('.lv_content').width() - 200);
            $('.lv_content_wrapper').css('width', $('.lv_content_wrapper').width() - 200);
            $('.lv_bubble').css('width', $('.lv_bubble').width() - 200);
            $('.inline-example').css('width', $('.inline-example').width() - 200);
            $('.image-dot-box').toggle(500);
            $('.large-shoppable-ui').toggle(500);
            $('.shopping-basket-corner').toggle(500);
            enterImage = false;
        }
    });
    //--------------------------------------------------------
});