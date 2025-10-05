<?php
/**
 * Tips Block Template
 *
 * @param array $block The block settings and attributes.
 */
?>

<section class="info-box-block">
    <div class="info-box-content">
        <?php echo wp_kses_post( get_field('krypto__info_box') ); ?>
    </div>
</section>