<?php
/**
 * Block template file:
 *
 * Latest Block Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'latest-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-latest-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php $classes .= ' ' . get_field( 'view' ) ?>

<section id="<?php echo esc_attr( $id ); ?>" class="latest <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="latest-wrap">
            <div class="section-header">
                <div class="section-header-head">
                    <h2 class="section-header-title title"><?php the_field( 'title' ); ?></h2>
                    <div class="section-header-more">
						<?php $button_link = get_field( 'button_link' ); ?>
						<?php if ( $button_link ) : ?>

                            <a href="<?php echo esc_url( $button_link['url'] ); ?>">
                                <span><?php echo esc_html( $button_link['title'] ); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                                     fill="none">
                                    <path d="M3.33337 8.5H12.6667" stroke="#00D084" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8 3.83333L12.6667 8.5L8 13.1667" stroke="#00D084" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
            </div>
			<?php
			$category_post = get_field( 'category_post' );
			$post_per_page = ( get_field( 'view' ) === 'latest--news' ) ? 3 : 4;
			$args          = array(
				'posts_per_page' => $post_per_page,
                'cat'            => $category_post,
                // 'orderby'        => 'modified',
			);
			$query         = new WP_Query( $args );

			if ( $query->have_posts() ) {
			$count = 0;
			if ( get_field( 'view' ) === 'latest--news' ){ ?>
            <div class="latest-wrap-left">
				<?php }
				while ( $query->have_posts() ) {
				$count ++;
				$query->the_post();
				?>
				<?php if ( get_field( 'view' ) !== 'latest--news' ){ ?>
				<?php if ( $count === 1 ){ ?>
                    <div class="latest-wrap-left">
                        <article class="latest-item">
                            <div class="latest-item-image">
                                <a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), [ 400, 400 ] ) ?>
                                </a>
                            </div>
                            <div class="latest-item-caption">
                                <h4 class="latest-item-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                </h4>
                                <div class="latest-item-info">
                                    <div class="latest-item-date">
<!--                                        <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar.svg" alt="">-->
                                        <span><?php echo get_the_modified_date() ?></span>
                                    </div>
                                    <div class="latest-item-category"><?php echo get_the_category( get_the_ID() )[0]->name; ?></div>
                                </div>
                                <div class="latest-item-description">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </article>
                    </div>
				<?php }else{ ?>
				<?php if ( $count === 2 ){ ?>
                <div class="latest-wrap-right">
					<?php } ?>
                    <article class="latest-item latest-item--row">
                        <div class="latest-item-image">
                            <a href="<?php the_permalink(); ?>">
								<?php echo get_the_post_thumbnail( get_the_ID(), [ 400, 400 ] ) ?>
                            </a>
                        </div>
                        <div class="latest-item-caption">
                            <h4 class="latest-item-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                            </h4>
                            <div class="latest-item-info">
                                <div class="latest-item-date">
                                    <span class="kgn-capitalize"><?php echo esc_html__('Oppdatert ', 'cigtextdomain'); ?></span>
<!--                                    <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar.svg" alt="">-->
                                    <span><?php echo get_the_date() ?></span>
                                </div>
                                <div class="latest-item-category"><?php echo get_the_category( get_the_ID() )[0]->name; ?></div>
                            </div>
                            <div class="latest-item-description">
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    </article>
					<?php }

					} else { ?>
                        <article class="latest-item">
                            <div class="latest-item-image">
                                <a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), [ 400, 400 ] ) ?>
                                </a>
                            </div>
                            <div class="latest-item-caption">
                                <h4 class="latest-item-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                </h4>
                                <div class="latest-item-info">
                                    <div class="latest-item-date">

<!--                                        <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar.svg" alt="">-->
                                        <span><?php echo get_the_date() ?></span>
                                    </div>
                                    <div class="latest-item-category"><?php echo get_the_category( get_the_ID() )[0]->name; ?></div>
                                </div>
                                <div class="latest-item-description">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </article>
					<?php }
					}
					}
					?>
                </div>
            </div>
        </div>
</section>
