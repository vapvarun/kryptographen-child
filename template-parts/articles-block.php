<?php

$posts = $args['posts'];

global $page_posts_ids;

if ( ! $page_posts_ids ) $page_posts_ids = [];

if ( $posts ) :
    foreach ( $posts as $post ) : ?>
        <?php $page_posts_ids[] = $post->ID; ?>
        <article class="latest-item">
            <div class="latest-item-image">
                <a href="<?php echo get_permalink( $post ) ?>">
                    <?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
                </a>
            </div>
            <div class="latest-item-caption">
                <h4 class="latest-item-title">
                    <a href="<?php echo get_permalink( $post ) ?>"><?php echo $post->post_title; ?></a>
                </h4>
                <div class="latest-item-info">
                    <div class="latest-item-date">
                        <span><?php echo get_the_date('d, M Y', $post->ID ); ?></span>
                    </div>
                    <div class="latest-item-category"><?php echo get_the_category($post->ID)[0]->name; ?></div>
                </div>
            </div>
        </article>
    <?php endforeach;
endif;
