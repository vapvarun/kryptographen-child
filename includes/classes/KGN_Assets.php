<?php

if ( ! class_exists( 'KGN_Assets' ) ) {
    class KGN_Assets
    {
        public function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        }

        public function enqueue_scripts()
        {
            $theme_version = wp_get_theme()->get('Version');

            wp_enqueue_style(
                'kgn_styles',
                get_stylesheet_directory_uri() . '/assets/css/styles.css',
                [],
                $theme_version
            );

            wp_enqueue_style(
                'annonse-label-style',
                get_stylesheet_directory_uri() . '/assets/css/annonse-label.css',
                [ 'child-style' ],
                $theme_version
            );

            if( is_singular() && has_category() ){
                wp_enqueue_style(
                    'advertisement',
                    get_stylesheet_directory_uri() . '/assets/css/advertisement-style.css',
                    [],
                    $theme_version
                );
            }

            if( is_singular() && ! is_user_logged_in() ){
                wp_enqueue_style(
                    'nopriv-advertisement',
                    get_stylesheet_directory_uri() . '/assets/css/nopriv-advertisement-style.css',
                    [],
                    $theme_version
                );
            }

            if (is_category()) {
                wp_enqueue_style(
                    'category-page',
                    get_stylesheet_directory_uri() . '/assets/css/category-page.css',
                    ['cig-style', 'child-style'],
                    $theme_version
                );
            }

//            global $wp_query;
//
//                wp_enqueue_script(
//                    'kgn_load_more',
//                    get_stylesheet_directory_uri() . '/assets/js/kgn_load_more.js',
//                    [],
//                    time()
//                );
//
//                wp_localize_script(
//                    'kgn_load_more',
//                    'load_more_params',
//                    [
//                        'ajax_url' => admin_url( 'admin-ajax.php' ),
//                        'posts' => json_encode( $wp_query->query_vars ),
//                        'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
//                        'max_page' => $wp_query->max_num_pages,
//                    ]
//                );


            // Only load responsive block script on singular posts/pages
            if (is_singular()) {
                wp_enqueue_script(
                    'kgn_responsive_block',
                    get_stylesheet_directory_uri() . '/assets/js/kgn_responsive_block.js',
                    [],
                    $theme_version,
                    true
                );
            }

        }
    }

    new KGN_Assets();
}
