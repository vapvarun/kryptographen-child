<?php

global $wp_query;
global $page_posts_ids;
global $child_categories_ids;

$page_posts_ids = [];

?>

<section class="category-posts category-posts__hero">
    
    <?php if (strpos($_SERVER['REQUEST_URI'],'kryptovaluta')) { ?>
        <style>
            .breadcrumbs {display:none;}
        </style>
    <?php } ?>

    <section class="breadcrumbs">
        <div class="container">
            <?php
            if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
                yoast_breadcrumb( '<p id="breadcrumbs-green" class="breadcrumbs-green">', '</p>' );
            }
            ?>
        </div>
    </section>
    <div class="category-posts__hero_background"></div>
    <div class="container">
        <div class="category-posts__heading">
            <h1><?php echo single_cat_title(); ?></h1>
            <?php $category_description = category_description(); ?>
            <?php if ( ! empty( $category_description ) ) : ?>
                <div class="category-posts__description">
                    <?php echo $category_description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
$selected_articles = get_field( 'category__selected-articles', 'term_' . get_queried_object_id() );
$selected_category = get_field( 'category__selected-category', 'term_' . get_queried_object_id() );
?>
<?php if ($selected_articles) : ?>
    <?php
    $featured_posts = get_posts([
        'post__in' => $selected_articles,
        'post__not_in' => $page_posts_ids,
        'orderby'  => 'post__in'
    ]);

    get_template_part(
        'template-parts/landing-articles',
        '',
        [ 'posts' => $featured_posts, 'title' => 'Anbefalt innhold' ]
    );

    ?>
<?php endif; ?>
<section class="faq landing-faq">
    <div class="container">
        <h3 class="landing-faq__title category-page-landing__section-title">Ofte Stilte Spørsmål og Svar</h3>
        <?php if ( have_rows( 'category__faq', 'term_' . get_queried_object_id() ) ) : ?>
            <div class="faq-wrapper">
                <?php while ( have_rows( 'category__faq', 'term_' . get_queried_object_id() ) ) : the_row(); ?>
                    <div class="faq-block landing-faq__block">
                        <h3><?php the_sub_field( 'faq_question' ); ?></h3>
                        <p><?php the_sub_field( 'faq_answer' ); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php if ($selected_category) : ?>
    <?php
    $subcategory_posts = get_posts([
        'cat' => $selected_category,
        'post__not_in' => $page_posts_ids,
        'posts_per_page' => 5
    ]);

    get_template_part(
        'template-parts/landing-articles',
        '',
        [ 'posts' => $subcategory_posts, 'title' => get_term( $selected_category )->name ]
    );
    ?>
<?php endif; ?>
<section class="category-posts" >
    <div class="container">

        <h3 class="category-page-landing__title category-page-landing__section-title">Utforsk <?php echo single_cat_title(); ?></h3>

        <div class="category-post-wrapper" data-view="block">
            <?php
            $args = array_merge( $wp_query->query_vars, array( 'post__not_in' => $page_posts_ids ) );
            query_posts( $args );
            ?>

            <?php if ( have_posts() ) :

                while ( have_posts() ) : setup_postdata( the_post()); ?>
                    <article class="latest-item">
                        <div class="latest-item-image">
                            <a href="<?php the_permalink() ?>">
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                            </a>
                        </div>
                        <div class="latest-item-caption">
                            <h4 class="latest-item-title">
                                <a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
                            </h4>
                            <div class="latest-item-info">
                                <div class="latest-item-date">
                                    <span><?php echo get_the_date( 'd, M Y', get_the_ID() ) ?></span>
                                </div>
                                <div class="latest-item-category"><?php echo single_cat_title(); ?></div>
                            </div>
                        </div>
                    </article>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</section>
