<?php
if ( ! class_exists( 'KGN_Category' ) ) {
    class KGN_Category
    {
        public function __construct() {
            add_action( 'pre_get_posts', [ $this, 'modify_category_query' ] );
        }

        public function modify_category_query( $query ) {
            if ( ! is_admin() && $query->is_main_query() && $query->is_category() ) {

                $category = get_queried_object();

                if ( ! $category || ! isset( $category->term_id ) ) {
                    return;
                }

                $posts_count = (int) get_field( 'category__posts_count', 'term_' . $category->term_id );

                $posts_count = $posts_count > 0 ? $posts_count : 51;

                global $child_categories_ids;

                $child_categories = get_categories([
                    'parent' => $category->term_id
                ]);

                $child_categories_ids = [];

                foreach ( $child_categories as $child_category ) {
                    $child_categories_ids[] = $child_category->term_id;
                }

                $query->set('category__not_in', $child_categories_ids);
                

                $query->set( 'posts_per_page', $posts_count );

                $meta_query = [
                    'relation' => 'OR',
                    [
                        'key'     => 'kgn_hide_from_archive',
                        'compare' => 'NOT EXISTS'
                    ],
                    [
                        'key'     => 'kgn_hide_from_archive',
                        'value'   => 1,
                        'compare' => '!='
                    ]
                ];

                $query->set( 'meta_query', $meta_query );
            }
        }

    }

    new KGN_Category();
}
