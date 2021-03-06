<?php echo $this->Html->image('brandnation-logo-black.png', array('alt' => 'Brandnation', 'class' => 'brandnation-logo')); ?>
<hr style="border-color: #000000">
<div class="posts">
    <?php foreach ($posts as $post) {

        $thumbSize = 320;
        ?>
        <div class="image-box">
            <div class="thumbs-dot-box" style="display: none">
                <?php
                if (isset($post['Points'])) {
                    foreach ($post['Points'] as $point) {
                        $position = explode(',', $point['Points']['position']);
                        $positionPercent = explode(',', $point['Points']['position_percent']);

                        $left = ($positionPercent[0] * $thumbSize) / 100;
                        $top = ($positionPercent[1] * $thumbSize) / 100;
                        ?>
                        <a class="dot-link" href="<?php echo $point['Points']['link']; ?>"
                           data-image-url="<?php echo $point['Points']['image_url']; ?>"
                           data-price="<?php echo $point['Points']['price']; ?>"
                           data-name="<?php echo $point['Points']['name']; ?>"
                        >
                            <div
                                style="position: absolute; left: <?php echo $left; ?>px; top: <?php echo $top; ?>px;"
                                class="dot-div">&nbsp;</div>
                        </a>
                    <?php }
                } ?>
            </div>
            <a class="lightview image-thumb" href="#inline_example_<?php echo $post['Posts']['id']; ?>"
               data-lightview-options="skin: 'mac'"
               data-origin-width="<?php echo $post['Posts']['width']; ?>"
            >
                <img
                    width="320" src="<?php echo $post['Posts']['instagram_image_url']; ?>"
                    alt="<?php echo $post['Posts']['text']; ?>"
                /></a>
        </div>

        <div id="inline_example_<?php echo $post['Posts']['id']; ?>" style="display: none" class="inline-example">
            <div class="image-dot-box" style="display: none">
                <?php
                if (isset($post['Points'])) {
                    foreach ($post['Points'] as $point) {
                        $position = explode(',', $point['Points']['position']);

                        ?>
                        <a class="dot-link-large" href="<?php echo $point['Points']['link']; ?>"
                           data-image-url="<?php echo $point['Points']['image_url']; ?>"
                           data-price="<?php echo $point['Points']['price']; ?>"
                           data-name="<?php echo $point['Points']['name']; ?>"
                           data-point-id="<?php echo $point['Points']['id']; ?>"
                        >
                            <div
                                style="position: absolute; left: <?php echo $position[0]; ?>px; top: <?php echo $position[1]; ?>px;"
                                class="dot-div">&nbsp;</div>
                        </a>
                    <?php }
                } ?>
            </div>
            <div class="shopping-basket-corner"
                 style="position: absolute; left: <?php echo($post['Posts']['width'] - 120); ?>px; top: <?php echo($post['Posts']['width'] - 120); ?>px;">
                <?php echo $this->Html->image('shopping-basket.png', array('class' => 'shopping-basket-icon')); ?>
            </div>
            <div class="large-shoppable-ui"
                 style="display:none; position: absolute; left: <?php echo $post['Posts']['width']; ?>px; top: 0px">
                <?php
                if (isset($post['Points'])) {
                    foreach ($post['Points'] as $point) { ?>
                        <div class="points-list-image"
                             data-image-url="<?php echo $point['Points']['image_url']; ?>"
                             data-price="<?php echo $point['Points']['price']; ?>"
                             data-name="<?php echo $point['Points']['name']; ?>"
                             data-point-id="<?php echo $point['Points']['id']; ?>">
                            <img width="180px" src="<?php echo $point['Points']['image_url']; ?>">
                        </div>
                    <?php }
                } ?>
            </div>
            <img class="post-large-image" src="<?php echo $post['Posts']['instagram_image_url']; ?>" data-origin-width="<?php echo $post['Posts']['width']; ?>"/>
        </div>
    <?php } ?>
</div>

<!-- small shoppable UI modal -->
<div id="smallShoppableModal">
    <div style="" class="small_ui_close"></div>
    <table>
        <tr>
            <td rowspan="2"><img id="small-product-image-url" src=""></td>
            <td><span id="small-product-name"></span></td>
        </tr>
        <tr>
            <td><span id="small-product-price"></span></td>
        </tr>
        <tr>
            <td></td>
            <td><a id="small-product-link" href="" class="btn btn-dark" target="_blank">VIEW</a></td>
        </tr>
    </table>

</div>