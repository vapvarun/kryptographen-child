<?php

?>

<?php if ( false ) : ?>
    <div class="category-posts-filters_list">
        <?php $categories = get_categories( array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'exclude'    => 552
        ) );

        foreach( $categories as $category ) {
            echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
        }
        ?>
    </div>
<?php endif; ?>
