<?php

$posts = $args['posts'];
$title = $args['title'];

global $page_posts_ids;

if ( ! $page_posts_ids ) $page_posts_ids = [];

?>

<section class="latest landing-articles">
    <div class="landing-articles__background-block"></div>
    <div class="container">
        <div class="latest-wrap">
            <div class="section-header">
                <div class="section-header-head">
                    <h3 class="section-header-title title category-page-landing__section-title"><?php echo esc_html( $title ); ?></h3>
                </div>
            </div>
            <?php if ( $posts ) :
            $count = 0;
            ?>
                <?php foreach ( $posts as $post ) :
                $page_posts_ids[] = $post->ID;
                $count ++;
                ?>
                <?php if ( $count === 1 ) : ?>
                    <div class="latest-wrap-left landing-articles__left">
                        <article class="latest-item">
                            <div class="latest-item-image">
                                <a href="<?php echo get_permalink( $post ); ?>">
                                    <?php echo get_the_post_thumbnail( $post->ID, [ 400, 400 ] ) ?>
                                </a>
                            </div>
                            <div class="latest-item-caption">
                                <h4 class="latest-item-title">
                                    <a href="<?php echo get_permalink( $post ); ?>"><?php echo get_the_title( $post->ID ) ?></a>
                                </h4>
                                <div class="latest-item-info">
                                    <div class="latest-item-date">
                                        <!--                                        <img src="--><?php //echo THEME_ASSETS_URL ?><!--/img/calendar.svg" alt="">-->
                                        <span><?php echo get_the_modified_date( '', $post->ID ) ?></span>
                                    </div>
                                    <div class="latest-item-category"><?php echo get_the_category( $post->ID )[0]->name; ?></div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endif; ?>
                <?php if ( $count === 2 ) : ?>
                    <div class="latest-wrap-right landing-articles__right">
                <?php endif; ?>
                <?php if ( $count > 1 ) : ?>
                    <article class="latest-item landing-articles__right_item">
                        <div class="latest-item-image">
                            <a href="<?php echo get_permalink( $post ); ?>">
                                <?php if ( get_post_thumbnail_id() ) : ?>
                                    <?php echo get_the_post_thumbnail( $post->ID, [ 400, 400 ] ) ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/placeholder.png' ); ?>" alt="<?php the_title() ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="latest-item-caption landing-articles__right_caption">
                            <h4 class="latest-item-title">
                                <a href="<?php echo get_permalink( $post ); ?>"><?php echo get_the_title( $post ) ?></a>
                            </h4>
                            <div class="latest-item-info">
                                <div class="latest-item-date">
                                    <span><?php echo get_the_date( '', $post ) ?></span>
                                </div>
                                <div class="latest-item-category"><?php echo get_the_category( get_the_ID() )[0]->name; ?></div>
                            </div>
                        </div>
                    </article>
                    <?php endif;
                endforeach;
                endif;?>
                </div>
        </div>
</section>
