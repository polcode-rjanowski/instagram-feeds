<?php foreach ($posts as $post) {
    list($imageWidth, $imageHeight) = getimagesize($post['Posts']['instagram_image_url']);
    ?>
    <div class="image-box">
        <?php
        if (isset($post['Points'])) {
            foreach ($post['Points'] as $point) {
                $position = explode(',', $point['Points']['position']);
                $positionPercent = explode(',', $point['Points']['position_percent']);

                $left = ($positionPercent[0] * 190) / 100 - 10;
                $top = ($positionPercent[1] * 190) / 100 - 10;
                ?>
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>" target="_blank">
                    <div
                        style="position: absolute; left: <?php echo $left; ?>px; top: <?php echo $top; ?>px;"
                        class="dot-div">&nbsp;</div>
                </a>
            <?php }
        } ?>
        <a class="lightview" href="#inline_example_<?php echo $post['Posts']['id']; ?>"
           data-lightview-options="overlay: {
                  background: '#ffffff',
                  opacity: 0
                }"
           data-lightview-title="Click on image to add dot with link"
        >
            <img width="190" src="<?php echo $post['Posts']['instagram_image_url']; ?>"
                 alt="<?php echo $post['Posts']['text']; ?>"/>
        </a>
    </div>

    <div id="inline_example_<?php echo $post['Posts']['id']; ?>" style="display: none">
        <?php
        if (isset($post['Points'])) {
            foreach ($post['Points'] as $point) {
                $position = explode(',', $point['Points']['position']);

                ?>
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>">
                    <div data-dot-id="<?php echo $point['Points']['id']; ?>"
                         style="position: absolute; left: <?php echo $position[0]; ?>px; top: <?php echo $position[1]; ?>px;"
                         class="dot-div">&nbsp;</div>
                </a>
            <?php }
        } ?>
        <img class="image-edit" width="<?php echo $imageWidth; ?>" height="<?php echo $imageHeight; ?>"
             src="<?php echo $post['Posts']['instagram_image_url']; ?>"
             data-image-id="<?php echo $post['Posts']['id']; ?>"/>
    </div>
<?php } ?>
<!-- Modal -->
<div id="addImageLinkModal" class="modal fade" role="dialog" style="z-index: 100000;">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add link to image</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="dot-id" name="dot-id"/>
                <input type="hidden" id="link-x" name="link-x"/>
                <input type="hidden" id="link-y" name="link-y"/>
                <input type="hidden" id="image-width" name="image-width"/>
                <input type="hidden" id="image-height" name="image-height"/>
                <input type="hidden" id="image-id" name="image-id" value="0"/>
                <input type="text" class="form-control" id="image-link" name="image-link"/>
            </div>
            <div class="modal-footer">
                <button id="remove-link" style="display: none" type="button" class="btn btn-danger">Remove</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add-image-link" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>

    </div>
</div>
