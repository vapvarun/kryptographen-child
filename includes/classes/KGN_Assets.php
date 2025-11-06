<?php

if ( ! class_exists( 'KGN_Assets' ) ) {
    class KGN_Assets
    {
        public function __construct()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        }

        /**
         * Get file version based on modification time
         */
        private function get_file_version($file_path)
        {
            $full_path = get_stylesheet_directory() . $file_path;

            if (file_exists($full_path)) {
                return filemtime($full_path);
            }

            $theme_version = wp_get_theme()->get('Version');
            return $theme_version ? $theme_version : '2.0.0';
        }

        public function enqueue_scripts()
        {
            // Enqueue Font Awesome from CDN
            wp_enqueue_style(
                'font-awesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
                [],
                '5.15.4'
            );

            // Enqueue all CSS files
            wp_enqueue_style(
                'kgn_styles',
                get_stylesheet_directory_uri() . '/assets/css/styles.css',
                [],
                $this->get_file_version('/assets/css/styles.css')
            );

            wp_enqueue_style(
                'annonse-label-style',
                get_stylesheet_directory_uri() . '/assets/css/annonse-label.css',
                [ 'child-style' ],
                $this->get_file_version('/assets/css/annonse-label.css')
            );

            wp_enqueue_style(
                'advertisement',
                get_stylesheet_directory_uri() . '/assets/css/advertisement-style.css',
                [],
                $this->get_file_version('/assets/css/advertisement-style.css')
            );

            wp_enqueue_style(
                'nopriv-advertisement',
                get_stylesheet_directory_uri() . '/assets/css/nopriv-advertisement-style.css',
                [],
                $this->get_file_version('/assets/css/nopriv-advertisement-style.css')
            );

            wp_enqueue_style(
                'category-page',
                get_stylesheet_directory_uri() . '/assets/css/category-page.css',
                ['cig-style', 'child-style'],
                $this->get_file_version('/assets/css/category-page.css')
            );

            wp_enqueue_style(
                'kgn_load_more_style',
                get_stylesheet_directory_uri() . '/assets/css/load-more.css',
                [],
                $this->get_file_version('/assets/css/load-more.css')
            );

            wp_enqueue_style(
                'kgn_custom_style',
                get_stylesheet_directory_uri() . '/assets/css/custom.css',
                [],
                $this->get_file_version('/assets/css/custom.css')
            );

            // Enqueue all JavaScript files
            wp_enqueue_script(
                'kgn_responsive_block',
                get_stylesheet_directory_uri() . '/assets/js/kgn_responsive_block.js',
                [],
                $this->get_file_version('/assets/js/kgn_responsive_block.js'),
                true
            );

            wp_enqueue_script(
                'table-of-contents-block',
                get_stylesheet_directory_uri() . '/assets/js/table-of-contents-block.js',
                [],
                $this->get_file_version('/assets/js/table-of-contents-block.js'),
                true
            );

            // Load more functionality with localized script
            global $wp_query;

            wp_enqueue_script(
                'kgn_load_more',
                get_stylesheet_directory_uri() . '/assets/js/kgn_load_more.js',
                [],
                $this->get_file_version('/assets/js/kgn_load_more.js'),
                true
            );

            wp_localize_script(
                'kgn_load_more',
                'load_more_params',
                [
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                    'posts' => json_encode( $wp_query->query_vars ),
                    'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                    'max_page' => $wp_query->max_num_pages,
                    'nonce' => wp_create_nonce('kgn_load_more_nonce'),
                ]
            );
        }
    }

    new KGN_Assets();
}
