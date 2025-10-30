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
$id = 'guider-block-' . $block[ 'id' ];
if ( ! empty( $block[ 'anchor' ] ) ) {
	$id = $block[ 'anchor' ];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-guider-block';
if ( ! empty( $block[ 'className' ] ) ) {
	$classes .= ' ' . $block[ 'className' ];
}
if ( ! empty( $block[ 'align' ] ) ) {
	$classes .= ' align' . $block[ 'align' ];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="latest latest--news <?php echo esc_attr( $classes ); ?>">
	<div class="container">
		<div class="latest-wrap">
			<div class="section-header">
				<div class="section-header-head">
					<h2 class="section-header-title title"><?php the_field( 'title' ); ?></h2>
				</div>
			</div>

			<div class="latest-wrap-left">
				<?php $guider_posts = get_field( 'feature_articles' ); ?>
				<?php if ( $guider_posts ) : ?>
                <?php $counter = 0; ?>
				<?php foreach ( $guider_posts as $post_id ) : ?>

                        <?php if ( $counter > 2 ) break; ?>
						<article class="latest-item">
							<div class="latest-item-image">
								<a href="<?php the_permalink( $post_id ); ?>" rel="<?php echo is_front_page() ? 'dofollow' : 'nofollow'?>">
									<?php echo get_the_post_thumbnail( $post_id, [ 400, 400 ] ) ?>
								</a>
							</div>
							<div class="latest-item-caption">
								<h4 class="latest-item-title">
									<a href="<?php the_permalink( $post_id ); ?>" rel="<?php echo is_front_page() ? 'dofollow' : 'nofollow'?>"><?php echo get_the_title( $post_id ) ?></a>
								</h4>
							</div>
						</article>
                        <?php $counter++; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
</section>
