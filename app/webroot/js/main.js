$(document).ready(function () {

    //---------foucus on one image, dot showing----------------
    var enterThumb = false;
    $('.image-thumb').mouseenter(function (e) {
        if (!enterThumb) {
            if ($(this).siblings('.thumbs-dot-box').has('.dot-link').length) {
                $(this).siblings('.thumbs-dot-box').toggle(500);
            }
            $(this).addClass('active');
            $('.image-thumb').not('.active').animate({opacity: 0.25});
            $('.inline-example').css('width', $(this).attr('data-origin-width'));
            enterThumb = true;
        }
    }).mouseleave(function (e) {
        if ($('.dot-link:hover').length == 0) {
            if ($(this).siblings('.thumbs-dot-box').has('.dot-link').length) {
                $(this).siblings('.thumbs-dot-box').toggle(500);
            }
            $(this).removeClass('active');
            $('.image-thumb').animate({opacity: 1});
            enterThumb = false;
        }
        $('#smallShoppableModal').dialog('close');
    });

    //---------small shoppable UI--------------
    $('#smallShoppableModal').dialog({
        autoOpen: false,
        resizable: false
    });
    $('.dot-link').click(function (e) {
        showSmallShoppableUI(this, e.target, e);
        if ($('#smallShoppableModal').dialog('isOpen')) {
            $('#smallShoppableModal').dialog('close');
        } else {
            $('#smallShoppableModal').dialog('open');
        }
    });

    function showSmallShoppableUI(element, target, evt) {
        evt.preventDefault();

        $('#small-product-image-url').attr('src', $(element).attr('data-image-url'));
        $('#small-product-name').text($(element).attr('data-name'));
        $('#small-product-price').text("£" + $(element).attr('data-price'));
        $('#small-product-link').attr('href', $(element).attr('href'));

        $('#smallShoppableModal').dialog("option", "position", {
            my: "left+15 top-15",
            at: "left bottom",
            of: target
        });

        $(".ui-dialog-titlebar").hide();
    }

    var enterDot = false;
    $('.dot-link-large').mouseenter(function (e) {
        if (!enterDot) {
            showSmallShoppableUI(this, e.target, e);
            $('#smallShoppableModal').dialog('open');
            $('.post-large-image').animate({opacity: 0.25});
            $('.points-list-image').not('[data-point-id=' + $(this).attr('data-point-id') + ']').animate({opacity: 0.25});
            enterDot = true;
        }
    });

    $('#smallShoppableModal').mouseleave(function () {
        $('#smallShoppableModal').dialog('close');
        $('.post-large-image').animate({opacity: 1});
        $('.points-list-image').animate({opacity: 1});
        enterDot = false;
    });

    $('.points-list-image').click(function (e) {
        if ($('#smallShoppableModal').dialog('isOpen')) {
            $('#smallShoppableModal').dialog('close');
            $('.post-large-image').animate({opacity: 1});
            $('.points-list-image').animate({opacity: 1});
        } else {
            var target = $(".dot-link-large[data-point-id='" + $(this).attr('data-point-id') + "']>div");

            $('.post-large-image').animate({opacity: 0.25});
            $('.points-list-image').not('[data-point-id=' + $(this).attr('data-point-id') + ']').animate({opacity: 0.25});

            showSmallShoppableUI(this, target, e);
            $('#smallShoppableModal').dialog('open');
        }
    });

    //----------large image UI--------------------------------
    $('.lv_content').css('overflow-x', 'hidden');
    var enterImage = false;
    $('.post-large-image').mouseenter(function (e) {
        if (!enterImage) {
            if ($(this).siblings('.large-shoppable-ui').has('.points-list-image').length) {
                $('.lv_window').css('width', $('.lv_window').width() + 200);
                $('.lv_content').css('width', $('.lv_content').width() + 200);
                $('.lv_content_wrapper').css('width', $('.lv_content_wrapper').width() + 200);
                $('.lv_bubble').css('width', $('.lv_bubble').width() + 200);
                $('.inline-example').css('width', $('.inline-example').width() + 200);
                $('.image-dot-box').toggle(500);
                $('.large-shoppable-ui').toggle(500);
                $('.shopping-basket-corner').toggle(500);
            }
            enterImage = true;
        }
    }).mouseleave(function (e) {
        if (!$('.dot-link-large:hover').length > 0 && !$('.inline-example:hover').length > 0 && !$('.ui-dialog:hover').length > 0) {
            if ($(this).siblings('.large-shoppable-ui').has('.points-list-image').length) {
                $('.lv_window').css('width', $('.lv_window').width() - 200);
                $('.lv_content').css('width', $('.lv_content').width() - 200);
                $('.lv_content_wrapper').css('width', $('.lv_content_wrapper').width() - 200);
                $('.lv_bubble').css('width', $('.lv_bubble').width() - 200);
                $('.inline-example').css('width', $('.inline-example').width() - 200);
                $('.image-dot-box').toggle(500);
                $('.large-shoppable-ui').toggle(500);
                $('.shopping-basket-corner').toggle(500);
            }
            enterImage = false;
        }
    });

});