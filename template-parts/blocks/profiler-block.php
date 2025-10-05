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
<section id="<?php echo esc_attr( $id ); ?>" class="profiler <?php echo esc_attr( $classes ); ?>">
    <div class="container">
        <div class="profiler-wrap">
            <div class="profiler-head">
                <h2 class="bigger profiler-head-title"><?php the_field( 'title' ); ?></h2>
                <div class="profiler-head-text">
					<?php the_field( 'description' ); ?>
                </div>
            </div>
			<?php $select_coins_selected_options = get_field( 'coins' ); ?>


			<?php if ( $select_coins_selected_options ) : ?>
                <div class="profiler-list">
					<?php $search = []; ?>
					<?php foreach ( $select_coins_selected_options as $select_coins_selected_option ) : ?>
                        <?php $search[] = '"' . esc_html( $select_coins_selected_option['select_coins'] ) . '"' ?>
					<?php endforeach; ?>
					<?php
					global $wpdb;
					$results = $wpdb->get_results(
						'SELECT * FROM  ' . $wpdb->prefix . 'mcw_coins  WHERE `symbol` IN (' . implode( ",", $search ) . ')'
					);
					?>
					<?php $currencies = get_currencies() ?>
					<?php foreach ( $results as $key => $result ) { ?>
                        <a href="<?php echo esc_url($select_coins_selected_options[ $key ][ 'link' ]); ?>"
                           class="profiler-item <?php echo ( $result->percent_change_24h > 0 ) ? 'stonks' : ''; ?>" rel="dofollow">
                            <div class="profiler-item-image">
                                <img src="<?php echo $result->img ?>" alt="<?php echo $result->symbol ?>">
                            </div>
                            <div class="profiler-item-caption">
                                <h4 class="profiler-item-title"><?php echo $result->name ?>
                                    <span><?php echo $result->symbol ?></span></h4>
                                <div class="profiler-item-info">
                                    <span>kr <?php echo number_format( floatval( $result->price_usd * $currencies ), '4', ',', '.' ) ?></span>
                                    <span class="profiler-item-info--growing"><?php echo $result->percent_change_24h ?></span>
                                </div>
                            </div>
                        </a>
					<?php } ?>
                </div>
			<?php endif; ?>
            <div class="profiler-buttons">
				<?php $button = get_field( 'button' ); ?>
				<?php if ( $button ) : ?>
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="profiler-button">
                        <span><?php echo esc_html( $button['title'] ); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M3.33337 8.5H12.6667" stroke="#00D084" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                            <path d="M8 3.83333L12.6667 8.5L8 13.1667" stroke="#00D084" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
				<?php endif; ?>
            </div>
        </div>
    </div>
</section>
