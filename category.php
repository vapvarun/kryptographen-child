<?php get_header(); ?>
<main>
    <?php if ( ! get_field('category__landing_type_template', 'term_' . get_queried_object_id() ) ) : ?>
        <?php get_template_part('template-parts/category/category-page-list'); ?>
    <?php else : ?>
        <?php get_template_part('template-parts/category/category-page-landing'); ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
