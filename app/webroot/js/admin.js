$(document).ready(function () {

    $('.image-edit').click(function (e) {
        var offset = $(this).offset();

        $('#image-link').val("");
        $('#image-url').val("");
        $('#name').val("");
        $('#sku').val("");
        $('#price').val("");
        $('#locale').val("");
        $('#remove-link').css('display', 'none');
        $('#dot-id').val(0);

        $('#link-x').val(e.pageX - offset.left - 15);
        $('#link-y').val(e.pageY - offset.top - 15);
        $('#image-width').val($(this).attr('width'));
        $('#image-height').val($(this).attr('height'));
        $('#image-id').val($(this).attr('data-image-id'));

        $('#addImageLinkModal').modal('toggle');
    });

    $('#add-image-link').click(function () {
        var dot_id = $('#dot-id').val();
        var position_x = $('#link-x').val();
        var position_y = $('#link-y').val();
        var image_width = $('#image-width').val();
        var image_height = $('#image-height').val();
        var image_id = $('#image-id').val();
        var link = $('#image-link').val();
        var imageUrl = $('#image-url').val();
        var name = $('#name').val();
        var price = $('#price').val();
        var sku = $('#sku').val();
        var locale = $('#locale').val();

        $.post('/admin/addLinkToImage', {
            dot_id: dot_id,
            pos_x: position_x,
            pos_y: position_y,
            img_width: image_width,
            img_height: image_height,
            image_id: image_id,
            link: link,
            imageUrl: imageUrl,
            name: name,
            price: price,
            sku: sku,
            locale: locale
        }, function (data) {
            // $('img[data-image-id="' + image_id + '"]').parent().prepend('<a class="dot-link" href="' + link + '" target="_blank"><div style="position: absolute; left: ' + position_x + 'px; top: ' + position_y + 'px" class="dot-div">&nbsp;</div></a>');
            window.location.reload(true);
        });
    });

    $('.dot-div').click(function (e) {
        e.preventDefault();
        $('#remove-link').css('display', 'inline');
        $('#dot-id').val($(this).attr('data-dot-id'));
        $('#image-link').val($(this).parent().attr('href'));
        $('#image-url').val($(this).parent().attr('data-image-url'));
        $('#name').val($(this).parent().attr('data-name'));
        $('#price').val($(this).parent().attr('data-price'));
        $('#sku').val($(this).parent().attr('data-sku'));
        $('#locale').val($(this).parent().attr('data-locale'));
        $('#image-id').val($(this).parent().siblings('.image-edit').attr('data-image-id'));
        $('#addImageLinkModal').modal('toggle');
    })

    $('#remove-link').click(function () {
        var dot_id = $('#dot-id').val();

        $.post('/admin/removeDot', {
            dot_id: dot_id,
        }, function (data) {
            window.location.reload(true);
        });
    })


});