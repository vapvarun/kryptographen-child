<?php

global $post;

$current_post_id = $post->ID;

$related_posts = get_crp_posts([
    'postid' => $current_post_id,
    'post_per_page' => 5,
    'fields' => 'ids'
]);

?>

<section id="<?php echo esc_attr( $current_post_id ); ?>" class="latest latest--news">
    <div class="container">
        <div class="latest-wrap">
            <div class="section-header">
                <div class="section-header-head">
                    <h2 class="section-header-title title">Relaterte artikler</h2>
                </div>
            </div>

            <div class="latest-wrap-left">
                <?php if ( $related_posts ) : ?>
                    <?php $counter = 0; ?>
                    <?php foreach ( $related_posts as $post_id ) : ?>

                        <?php if ( $counter > 2 ) break; ?>
                        <?php $thumbnail = get_the_post_thumbnail( $post_id, [ 400, 400 ] ); ?>
                        <?php if ( ! $thumbnail ) continue; ?>
                        <article class="latest-item">
                            <div class="latest-item-image">
                                <a href="<?php the_permalink( $post_id ); ?>" rel="nofollow">
                                    <?php echo $thumbnail ?>
                                </a>
                            </div>
                            <div class="latest-item-caption">
                                <h4 class="latest-item-title">
                                    <a href="<?php the_permalink( $post_id ); ?>" rel="nofollow"><?php echo get_the_title( $post_id ) ?></a>
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

