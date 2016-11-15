$(document).ready(function () {
    $('img').click(function (e) {
        var offset = $(this).offset();

        $('#link-x').val(e.pageX - offset.left - 10);
        $('#link-y').val(e.pageY - offset.top - 10);
        $('#image-id').val($(this).attr('data-image-id'));

        $('#addImageLinkModal').modal('toggle');
    });

    $('#add-image-link').click(function () {
        var position_x = $('#link-x').val();
        var position_y = $('#link-y').val();
        var image_id = $('#image-id').val();
        var link = $('#image-link').val();

        $.post('/instagram/addLinkToImage', {
            pos_x: position_x,
            pos_y: position_y,
            image_id: image_id,
            link: link
        }, function (data) {
            $('img[data-image-id="' + image_id + '"]').parent().prepend('<a class="dot-link" href="' + link + '" target="_blank"><div style="position: absolute; left: ' + position_x + 'px; top: ' + position_y + 'px" class="dot-div">&nbsp;</div></a>');
        });

        $('#addImageLinkModal').modal('toggle');
    });


});