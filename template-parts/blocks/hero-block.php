<?php
/**
 * Block template file:
 *
 * Guider Block Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'guider-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-guider-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="hero <?php echo esc_attr( $classes ); ?>" style="background-image: url('<?php echo THEME_ASSETS_URL ?>/img/home/hero.jpg');">
    <div class="container">

        <div class="hero__slider-wrap">
            <h1><?php the_field( 'title' ); ?></h1>
            <div class="hero__slider swiper">
                <div class="swiper-wrapper">
					<?php if ( have_rows( 'posts' ) ) : ?>
						<?php while ( have_rows( 'posts' ) ) : the_row(); ?>
							<?php $post_id = get_sub_field( 'select_post' ); ?>
							<?php $author_id = get_post_field( 'post_author', $post_id ); ?>
                            <div class="swiper-slide">
                                <article class="hero__slider-item">
                                    <div class="hero__slider-item-content">
                                        <div class="hero__slider-item-category"><?php echo get_the_category( $post_id )[0]->name; ?></div>
                                        <h2 class="hero__slider-item-title">
                                            <a href="<?php echo get_the_permalink( $post_id ); ?>"><?php echo get_the_title( $post_id ); ?></a>
                                        </h2>
                                        <div class="hero__slider-item-header">
                                            <div class="hero__slider-item-author">

                                                <img src="<?php echo get_avatar_url( $author_id ) ?> " alt="">
                                                <span><?php echo get_the_author_meta( 'display_name', $author_id ) ?></span>
                                            </div>
                                            <div class="hero__slider-item-date">
                                                <span class="kgn-capitalize"><?php echo esc_html__('Oppdatert ', 'cigtextdomain'); ?></span>
<!--                                                <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar.svg" alt="">-->
                                                <span><?php echo get_the_date( '', $post_id ) ?></span>
                                            </div>
                                        </div>
                                        <div class="hero__slider-item-description">
											<?php echo get_the_excerpt( $post_id ); ?>
                                        </div>
                                    </div>
                                    <div class="hero__slider-item-image">
										<?php echo get_the_post_thumbnail( $post_id, 'full' ) ?>
                                    </div>
                                </article>
                            </div>
							<?php wp_reset_postdata(); ?>
						<?php endwhile; ?>
					<?php endif; ?>

                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>

    <div class="hero__coins">
        <div class="container">
			<?php $select_coins_selected_options = get_field( 'select_coins' ); ?>
			<?php if ( $select_coins_selected_options ) : ?>
                <div class="running-line">
                    <div class="running-line__wrap">
                        <div class="running-line__wrap-item">
							<?php $search = []; ?>
							<?php foreach ( $select_coins_selected_options as $select_coins_selected_option ) : ?>
								<?php $search[] = '"' . esc_html( $select_coins_selected_option['value'] ) . '"' ?>
							<?php endforeach; ?>
							<?php
							global $wpdb;
							$results = $wpdb->get_results(
								'SELECT * FROM  ' . $wpdb->prefix . 'mcw_coins  WHERE `symbol` IN (' . implode( ",", $search ) . ')'
							);
							?>
							<?php $currencies = get_currencies() ?>
							<?php foreach ( $results as $result ) { ?>
                                <div class="hero__coins-item">
                                    <h4 class="hero__coins-item-name">
										<?php echo $result->name ?>
                                        <span class="hero__coins-item-name--short"><?php echo $result->symbol ?></span>
                                    </h4>
                                    <div class="hero__coins-item-data">
                                        <span><?php _e('kr','cigtextdomain')?>  <?php  echo number_format_kr( intval( $result->price_usd * $currencies ) ) ?></span>
                                        <span class="hero__coins-item-data--growing <?php echo ( $result->percent_change_24h > 0 ) ? 'stonks' : ''; ?>"><?php echo ( $result->percent_change_24h > 0 ) ? '+' : ''; ?><?php echo $result->percent_change_24h ?></span>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>
</section>