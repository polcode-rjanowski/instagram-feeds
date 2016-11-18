<?php foreach ($posts as $post) {
    $thumbSize = 320;
    ?>
    <div class="image-box">
        <?php
        if (isset($post['Points'])) {
            foreach ($post['Points'] as $point) {
                $position = explode(',', $point['Points']['position']);
                $positionPercent = explode(',', $point['Points']['position_percent']);

                $left = ($positionPercent[0] * $thumbSize) / 100;
                $top = ($positionPercent[1] * $thumbSize) / 100;
                ?>
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>" target="_blank">
                    <div
                        style="position: absolute; left: <?php echo $left; ?>px; top: <?php echo $top; ?>px;"
                        class="dot-div">&nbsp;</div>
                </a>
            <?php }
        } ?>
        <a class="lightview" href="#inline_example_<?php echo $post['Posts']['id']; ?>"><img
                width="320" src="<?php echo $post['Posts']['instagram_image_url']; ?>"
                alt="<?php echo $post['Posts']['text']; ?>"
            /></a>
    </div>

    <div id="inline_example_<?php echo $post['Posts']['id']; ?>" style="display: none">
        <?php
        if (isset($post['Points'])) {
            foreach ($post['Points'] as $point) {
                $positionPercent = explode(',', $point['Points']['position_percent']);


                ?>
                <a class="dot-link" href="<?php echo $point['Points']['link']; ?>" target="_blank">
                    <div
                        style="position: absolute; left: <?php echo $position[0]; ?>px; top: <?php echo $position[1]; ?>px;"
                        class="dot-div">&nbsp;</div>
                </a>
            <?php }
        } ?>
        <img src="<?php echo $post['Posts']['instagram_image_url']; ?>"/>
    </div>
<?php } ?>