<?php echo $this->Html->image('brandnation-logo-black.png', array('alt' => 'Brandnation', 'class' => 'brandnation-logo')); ?>
<hr style="border-color: #000000">
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
                        class="small-dot-div">&nbsp;</div>
                </a>
            <?php }
        } ?>
        <a class="lightview"
           href="#inline_example_<?php echo $post['Posts']['id']; ?>"
           data-lightview-options="skin: 'mac', overlay: {
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
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>"
                   data-image-url="<?php echo $point['Points']['image_url']; ?>"
                   data-name="<?php echo $point['Points']['name']; ?>"
                   data-sku="<?php echo $point['Points']['sku']; ?>"
                   data-price="<?php echo $point['Points']['price']; ?>"
                   data-locale="<?php echo $point['Points']['locale']; ?>"
                >
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
<div id="addImageLinkModal" class="modal fade" role="dialog" style="z-index: 100000;text-align: left">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add point to image</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="dot-id" name="dot-id"/>
                <input type="hidden" id="link-x" name="link-x"/>
                <input type="hidden" id="link-y" name="link-y"/>
                <input type="hidden" id="image-width" name="image-width"/>
                <input type="hidden" id="image-height" name="image-height"/>
                <input type="hidden" id="image-id" name="image-id" value="0"/>
                <div class="form-group">
                    <label for="image-link">URL</label>
                    <input type="text" class="form-control" id="image-link" name="image-link"/>
                </div>
                <div class="form-group">
                    <label for="image-url">Image URL</label>
                    <input type="text" class="form-control" id="image-url" name="image-url"/>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku"/>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"/>
                </div>
                <div class="form-group">
                    <label for="locale">Locale</label>
                    <input type="text" class="form-control" id="locale" name="locale"/>
                </div>

            </div>
            <div class="modal-footer">
                <button id="remove-link" style="display: none" type="button" class="btn btn-danger">Remove</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add-image-link" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>

    </div>
</div>
