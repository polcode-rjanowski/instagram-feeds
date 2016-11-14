<?php foreach ($posts as $post) { ?>
    <div class="image-box">
        <?php
        if (isset($post['Points'])) {
            foreach ($post['Points'] as $point) {
                $position = explode(',', $point['Points']['position']);
                ?>
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>" target="_blank"><div
                   style="position: absolute; left: <?php echo $position[0]; ?>px; top: <?php echo $position[1]; ?>px;"
                   class="dot-div">&nbsp;</div></a>
            <?php }
        } ?>
        <img width="320" height="320" src="<?php echo $post['Posts']['instagram_image_url']; ?>"
             alt="<?php echo $post['Posts']['text']; ?>"
             data-image-id="<?php echo $post['Posts']['id']; ?>"
        />
    </div>
<?php } ?>

<!-- Modal -->
<div id="addImageLinkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add link to image</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="link-x" name="link-x"/>
                <input type="hidden" id="link-y" name="link-y"/>
                <input type="hidden" id="image-id" name="image-id"/>
                <input type="text" class="form-control" id="image-link" name="image-link"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add-image-link" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>

    </div>
</div>
